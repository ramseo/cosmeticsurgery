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
        if ($request->ajax()) {
            $vendors = User::select(['id', 'name', 'username', 'email', 'email_verified_at', 'updated_at', 'status', 'is_active'])->whereHas(
                'roles',
                function ($q) {
                    $q->where('name', 'user');
                }
            )->get();
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
        return view('backend.customer.index');
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
}
