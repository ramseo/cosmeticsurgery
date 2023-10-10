<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// user models
use App\Models\User;
use App\Models\Userprofile;
use App\Models\UserProvider;
use App\Models\UserQuotation;
// user models

use App\Models\Album;
use App\Models\Image;
use Storage;

use Log;
use Flash;
use DB;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vendors = User::select(['id', 'name', 'username', 'email', 'email_verified_at', 'updated_at', 'status', 'is_active'])->whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'user');
            }
        )->orderBy("sortable")->get();

        if ($request->ajax()) {

            return Datatables::of($vendors)
                ->addIndexColumn()
                ->addColumn('action', function ($vendor) {
                    if ($vendor->is_active == 1) {
                        $checked = "checked";
                    } else {
                        $checked = "";
                    }

                    $btn = "";
                    $btn .= "<div class='switch-flex-cls'>";
                    $btn .= '<a href="' . route("backend.customer.edit", $vendor->id) . '" class="btn btn-sm btn-primary mt-1" data-toggle="tooltip" title="Edit Service"><i class="fas fa-wrench"></i></a>';
                    $btn .= '<label class="switch">
                    <input onclick="userIsActive(this)" user_id="' . $vendor->id . '" name="is_active" type="checkbox" ' . $checked . '>
                    <span class="slider"></span>
                    </label>';
                    $btn .= "</div>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.customer.index', array("surgeons" => $vendors));
    }

    public function sortable(Request $request)
    {
        parse_str($request->data, $output);

        $i = 0;
        foreach ($output['item'] as $value) {
            $result = DB::table('users')
                ->where('id', $value)
                ->update(['sortable' => $i]);
            $i++;
        }
    }

    function is_active(Request $request)
    {
        $is_active = $request->get('is_active');
        $user_id = $request->get('user_id');

        $status = DB::table('users')
            ->where('id', $user_id)
            ->update(array('is_active' => $is_active));

        $response = [];
        if ($status) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }

        echo json_encode($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    //    public function store(Request $request)
    //    {
    //        $vendor = User::create($request->all());
    //        Flash::success("<i class='fas fa-check'></i> Profile Added")->important();
    //        Log::info(label_case('Vendor Store | ' . $vendor->business_name . '(ID:' . $vendor->id . ')  by User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')'));
    //        return redirect("admin/vendor");
    //    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        Log::info(label_case('User Edit | ' . $user->name . '(ID:' . $user->id . ')  by User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')'));
        return view("backend.customer.edit")->with('user', $user);
    }



    public function update(Request $request, $id)
    {
        $data = $request->all();
        $vendor = User::findOrFail($id);
        if ($request->file('image')) {
            $file_image = fileUpload($request, 'image', 'customer/profile/');
            $data = array_merge($data, ['image' => $file_image]);
        }

        $vendor->update($data);

        Flash::success("<i class='fas fa-check'></i> Vendor Updated Successfully")->important();
        Log::info(label_case('Vendor Update | ' . $vendor->business_name . '(ID:' . $vendor->id . ')  by User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')'));
        return redirect("admin/customer/edit/" . $vendor->id);
    }


    public function destroy($id)
    {
        $module_action = 'destroy';

        $user = User::findOrFail($id);

        DB::table("users")->where('id', $id)->delete();
        DB::table("userprofiles")->where('user_id', $id)->delete();
        DB::table("user_quotation")->where('user_id', $id)->delete();
        DB::table("user_providers")->where('user_id', $id)->delete();

        Flash::success('<i class="fa fa-trash"></i> ' . label_case($user->name) . ' Deleted Successfully!')->important();

        Log::info(label_case('User' . ' ' . $module_action) . " | '" . $user->name . ', ID:' . $user->id . " ' by User:" . auth()->user()->name . '(ID:' . auth()->user()->id . ')');

        return redirect("admin/customer");
    }

    // REVIEW FUNCTIONS

    public function profileResults(Request $request, $doc_id)
    {
        $userprofile = Userprofile::where('user_id', $doc_id)->first();

        if ($request->ajax()) {
            $albums = DB::table('albums')->where('vendor_id', $doc_id)->select(['id', 'name', 'status'])->orderBy('id', 'desc');
            return Datatables::of($albums)
                ->addIndexColumn()
                ->editColumn('name', function ($album) {
                    return '<strong>' . $album->name . '</strong>';
                })
                ->editColumn('status', function ($album) {
                    return ($album->status == 1) ? "Enabled" : "Disabled";
                })
                ->addColumn('action', function ($album) {
                    $btn = "";
                    $btn .= '<div class="album-flex-cls">';
                    $btn .= '<a href="' . route("backend.customer.results.edit", $album->id) . '" class="btn btn-sm btn-primary mt-1" data-toggle="tooltip" title="Edit Service"><i class="fa fa-wrench"></i></a>';
                    $btn .= '<a href="' . route("backend.customer.results.image.index", $album->id) . '" class="btn btn-sm btn-success mt-1" data-toggle="tooltip" title="Album Gallery"><i class="fa fa-file-image"></i></a>';
                    $btn .= '<a href="' . route("backend.customer.results.delete", $album->id) . '" class="btn btn-sm btn-danger mt-1 del-link" data-toggle="tooltip" title="Album Delete"><i class="fa fa-trash"></i></a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action', 'name', 'status'])
                ->make(true);
        }
        return view("frontend.users.results", compact('user', 'userprofile'));
    }

    public function results_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->file('image')) {
            $file_image = fileUpload($request, 'image', 'album/image');
            $data = array_merge($data, ['image' => $file_image]);
        }

        $album = Album::create($data);

        Flash::success("<i class='fas fa-check'></i> New Album Added")->important();
        Log::info(label_case('Category Store | ' . $album->name . '(ID:' . $album->id . ')  by User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')'));
        return redirect("profile/results");
    }

    public function results_edit($id)
    {
        $album = Album::findOrFail($id);
        $get_user_id_by_album = get_user_id_by_album($id, 'albums');

        $user = User::findOrFail($get_user_id_by_album->vendor_id);

        Log::info(label_case('Service Edit | ' . $album->name . '(ID:' . $album->id . ')  by User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')'));
        return view('backend.users.result-edit', compact('album', 'user'));
    }

    public function results_update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $album = Album::findOrFail($id);
        $get_user_id_by_album = get_user_id_by_album($id, 'albums');

        $user = User::findOrFail($get_user_id_by_album->vendor_id);

        $data = $request->all();

        if ($request->file('image')) {
            $file_image = fileUpload($request, 'image', 'album/image/');
            $data = array_merge($data, ['image' => $file_image]);
        }

        $album->update($data);
        Flash::success("<i class='fas fa-check'></i> Album Updated Successfully")->important();
        Log::info(label_case('Service Update | ' . $album->name . '(ID:' . $album->id . ')  by User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')'));
        return redirect("admin/users/profile/$user->id/edit");
    }

    public function results_delete($id)
    {
        $get_user_id_by_album = get_user_id_by_album($id, 'albums');
        $user = User::findOrFail($get_user_id_by_album->vendor_id);

        rrmdir(storage_path('app/public/album/' . $id));
        Album::where(['id' => $id])->delete();
        Image::where(['album_id' => $id])->delete();
        Flash::success("<i class='fas fa-check'></i> Album Deleted")->important();
        return redirect("admin/users/profile/$user->id/edit");
    }

    public function results_image($albumId, Request $request)
    {
        $get_user_id_by_album = get_user_id_by_album($albumId, 'albums');
        $user = User::findOrFail($get_user_id_by_album->vendor_id);

        $album = Album::findOrFail($albumId);
        $images = Image::where('album_id', $albumId)->get();

        return view('backend.users.result-images', compact('images', 'album', 'user'));
    }

    public function results_image_store(Request $request, $id)
    {
        $album_id = $id;
        $fileName = fileUpload($request, 'file', "album/$album_id/", true);
        $input['album_id'] = $album_id;
        $input['name'] = $fileName;
        $image = Image::create($input);
        Log::info(label_case('Image Store | ' . $image->name . '(ID:' . $image->id . ')  by User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')'));
        return response()->json(['success' => $image->id]);
    }


    public function results_image_remove(Request $request)
    {
        $name = $request->get('name');
        $image = Image::where(['name' => $name])->first();
        Storage::delete('album/$album_id/' . $image->name);
        Image::where(['id' => $image->id])->delete();
        return $name;
    }

    public function results_image_delete($id)
    {
        $image = Image::findorfail($id);
        Storage::delete('album/$album_id/' . $image->name);
        Image::where(['id' => $image->id])->delete();

        Flash::success("<i class='fas fa-check'></i> Image Deleted")->important();

        return redirect("admin/customer/results/image/$image->album_id");
    }

    // REVIEW FUNCTIONS
}
