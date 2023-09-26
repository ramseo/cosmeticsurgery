<?php

namespace App\Http\Controllers\Frontend;

use App\Authorizable;
use App\Events\Frontend\UserProfileUpdated;
use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Userprofile;
use App\Models\UserProvider;
use App\Models\UserQuotation;
use App\Models\Quotation;

use App\Models\Album;
use App\Models\Image;

use Modules\Article\Entities\Category;
use Modules\Article\Events\PostCreated;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Type;
use App\Models\City;
use App\Models\Vendor;
use App\Rules\MatchOldPassword;
use Modules\Article\Http\Requests\Backend\PostsRequest;
use Modules\Article\Events\PostUpdated;

use Log;
use Flash;
use Auth;
use DB;
use Storage;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Users';

        // module name
        $this->module_name = 'users';

        // directory path of the module
        $this->module_path = 'users';

        // module icon
        $this->module_icon = 'fas fa-users';

        // module model name, path
        $this->module_model = "App\Models\User";
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($username)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Show';

        $$module_name_singular = $module_model::where('username', 'LIKE', $username)->first();

        $body_class = 'profile-page';

        $meta_page_type = 'profile';

        return view(
            "frontend.$module_name.show",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', "$module_name_singular", 'body_class', 'meta_page_type')
        );
    }

    /**
     * Display Profile Details of Logged in user.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        if (Auth::check() == false) {
            return redirect(base_url());
        }
        $user = Auth::user();
        $user = User::findOrFail($user->id);

        if ($user) {
            $userprofile = Userprofile::where('user_id', $user->id)->first();
        } else {
            Log::error('UserProfile Exception for Username: ' . $username);
            abort(404);
        }

        $body_class = 'profile-page';

        $meta_page_type = 'profile';

        return view("frontend.users.profile", compact('user', 'userprofile'));
    }


    public function profile_content(Request $request)
    {
        if (Auth::check() == false) {
            return redirect(base_url());
        }
        $user = Auth::user();
        $user = User::findOrFail($user->id);

        // dd($user->id);

        $userprofile = Userprofile::where('user_id', $user->id)->first();


        return view("frontend.users.content", compact('user', 'userprofile'));
    }

    public function profile_content_update($id, Request $request)
    {
        $request->validate([
            'description' => 'nullable|string',
        ]);

        $userprofile = Userprofile::where('user_id', $id)->get()->first();

        $data = [];
        $data['content'] = $request->content;

        DB::table('userprofiles')->where('user_id', $id)->update($data);

        Flash::success("<i class='fas fa-check'></i> Profile Content Updated Successfully")->important();
        Log::info(label_case('Profile Content Update | ' . $userprofile->name . '(ID:' . $userprofile->id . ')  by User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')'));
        return redirect("profile/content");
    }

    // PROFILE POSTS START
    public function profile_posts(Request $request)
    {
        if (Auth::check() == false) {
            return redirect(base_url());
        }
        $user = Auth::user();
        $user = User::findOrFail($user->id);

        $userprofile = Userprofile::where('user_id', $user->id)->first();
        $author = ucwords($user->first_name . " " . $user->last_name);

        if ($request->ajax()) {
            $albums = DB::table('posts')->Where('author', $author)->select(['id', 'name', 'status'])->orderBy('id', 'desc');
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
                    $btn .= '<div>';
                    $btn .= '<a href="' . route("frontend.profile_posts.edit", $album->id) . '" class="btn btn-sm btn-primary mt-1" data-toggle="tooltip" title="Edit Service"><i class="fa fa-wrench"></i></a>';
                    $btn .= '<a href="' . route("frontend.profile_posts.delete", $album->id) . '" class="btn btn-sm btn-danger mt-1 del-link" data-toggle="tooltip" title="Album Delete"><i class="fa fa-trash"></i></a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action', 'name', 'status'])
                ->make(true);
        }
        return view("frontend.users.posts", compact('user', 'userprofile'));
    }

    public function posts_create()
    {
        if (Auth::check() == false) {
            return redirect(base_url());
        }
        $user = Auth::user();
        $user = User::findOrFail($user->id);

        Log::info(label_case('Post Create | User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')'));
        return view("frontend.users.post-create")->with('user', $user);
    }

    public function posts_store(PostsRequest $request)
    {
        $request->validate([
            'name' => "required|max:191|unique:posts,name",
        ]);

        $module_title = "post";
        $module_name = "posts";
        $module_model = "Modules\Article\Entities\Post";
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Store';

        $data = $request->all();

        $data['related_posts'] = Null;
        if (isset($data['related_posts'])) {
            if ($data['related_posts']) {
                $jsonEncodeTags = json_encode($data['related_posts']);
                $data['related_posts'] = $jsonEncodeTags;
            }
        }

        $data['created_by_name'] = auth()->user()->name;

        $module_name_singular = $module_model::create($data);

        event(new PostCreated($module_name_singular));

        Flash::success("<i class='fas fa-check'></i> New '" . Str::singular($module_title) . "' Added")->important();

        Log::info(label_case($module_title . ' ' . $module_action) . " | '" . $module_name_singular->name . '(ID:' . $module_name_singular->id . ") ' by User:" . Auth::user()->name . '(ID:' . Auth::user()->id . ')');

        return redirect("profile/posts");
    }

    public function posts_edit($id)
    {
        $module_title = "post";
        $module_name = "posts";
        $module_model = "Modules\Article\Entities\Post";
        $module_name_singular_ac = Str::singular($module_name);

        $module_action = 'Edit';

        $module_name_singular = $module_model::findOrFail($id);

        $categories = Category::pluck('name', 'id');

        $user = Auth::user();
        $user = User::findOrFail($user->id);

        Log::info(label_case($module_title . ' ' . $module_action) . " | '" . $module_name_singular->name . '(ID:' . $module_name_singular->id . ") ' by User:" . Auth::user()->name . '(ID:' . Auth::user()->id . ')');

        return view(
            "frontend.users.post-edit",
            compact('categories', 'module_title', 'module_name', 'module_name_singular', 'module_action', 'user')
        );
    }

    public function posts_update(PostsRequest $request, $id)
    {
        $module_title = "Post";
        $module_name = "posts";
        $module_model = "Modules\Article\Entities\Post";
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        $module_name_singular = $module_model::findOrFail($id);
        if ($request->input('related_posts') == null) {
            $related_posts_list = Null;
        } else {
            $related_posts_list = json_encode($request->input('related_posts'));
        }

        $module_name_singular->related_posts = $related_posts_list;

        $module_name_singular->update($request->except('tag_ids'));

        event(new PostUpdated($module_name_singular));

        Flash::success("<i class='fas fa-check'></i>" . " " . Str::singular($module_title) . " " . "Updated Successfully")->important();

        Log::info(label_case($module_title . ' ' . $module_action) . " | '" . $module_name_singular->name . '(ID:' . $module_name_singular->id . ") ' by User:" . Auth::user()->name . '(ID:' . Auth::user()->id . ')');

        return redirect("profile/posts");
    }

    public function posts_delete($id)
    {
        $module_title = "Post";
        $module_name = "posts";
        $module_model = "Modules\Article\Entities\Post";
        $module_name_singular = Str::singular($module_name);

        $module_action = 'destroy';

        $$module_name_singular = $module_model::findOrFail($id);

        DB::table($module_name)->where('id', $id)->delete();

        Flash::success('<i class="fas fa-check"></i> ' . label_case($module_name_singular) . ' Deleted Successfully!')->important();

        Log::info(label_case($module_title . ' ' . $module_action) . " | '" . $$module_name_singular->name . ', ID:' . $$module_name_singular->id . " ' by User:" . Auth::user()->name . '(ID:' . Auth::user()->id . ')');

        return redirect("profile/posts");
    }


    // PROFILE POSTS FINISH

    // results section start

    public function profileResults(Request $request)
    {
        if (Auth::check() == false) {
            return redirect(base_url());
        }
        $user = Auth::user();
        $user = User::findOrFail($user->id);

        $userprofile = Userprofile::where('user_id', $user->id)->first();

        if ($request->ajax()) {
            $albums = DB::table('albums')->where('vendor_id', $user->id)->select(['id', 'name', 'status'])->orderBy('id', 'desc');
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
                    $btn .= '<a href="' . route("frontend.results.edit", $album->id) . '" class="btn btn-sm btn-primary mt-1" data-toggle="tooltip" title="Edit Service"><i class="fa fa-wrench"></i></a>';
                    $btn .= '<a href="' . route("frontend.results.image.index", $album->id) . '" class="btn btn-sm btn-success mt-1" data-toggle="tooltip" title="Album Gallery"><i class="fa fa-file-image-o"></i></a>';
                    $btn .= '<a href="' . route("frontend.results.delete", $album->id) . '" class="btn btn-sm btn-danger mt-1 del-link" data-toggle="tooltip" title="Album Delete"><i class="fa fa-trash"></i></a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action', 'name', 'status'])
                ->make(true);
        }
        return view("frontend.users.results", compact('user', 'userprofile'));
    }

    public function results_create()
    {
        if (Auth::check() == false) {
            return redirect(base_url());
        }
        $user = Auth::user();
        $user = User::findOrFail($user->id);

        Log::info(label_case('Album Create | User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')'));
        return view("frontend.users.result-create")->with('user', $user);
    }

    public function results_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $data = $request->all();

        // compress code
        // $x = 90;
        // $file = $request->file('image');
        // $file_name = time() . "_" . $file->getClientOriginalName();
        // $img = \Image::make($file);
        // $img->save(public_path("storage/album/image/$file_name"), $x);
        // $data = array_merge($data, ['image' => $file_name]);
        // compress code

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
        if (Auth::check() == false) {
            return redirect(base_url());
        }
        $user = Auth::user();
        $user = User::findOrFail($user->id);

        $album = Album::findOrFail($id);

        Log::info(label_case('Service Edit | ' . $album->name . '(ID:' . $album->id . ')  by User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')'));
        return view('frontend.users.result-edit', compact('album'))->with('user', $user);
    }

    public function results_update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $album = Album::findOrFail($id);

        $data = $request->all();
        // compress code
        // $x = 90;
        // $file = $request->file('image');
        // $file_name = time() . "_" . $file->getClientOriginalName();
        // $img = \Image::make($file);
        // $img->save(public_path("storage/album/image/$file_name"), $x);
        // $data = array_merge($data, ['image' => $file_name]);
        // compress code

        if ($request->file('image')) {
            $file_image = fileUpload($request, 'image', 'album/image/');
            $data = array_merge($data, ['image' => $file_image]);
        }

        $album->update($data);
        Flash::success("<i class='fas fa-check'></i> Album Updated Successfully")->important();
        Log::info(label_case('Service Update | ' . $album->name . '(ID:' . $album->id . ')  by User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')'));
        return redirect("profile/results");
    }

    public function results_delete($id)
    {
        rrmdir(storage_path('app/public/album/' . $id));
        Album::where(['id' => $id])->delete();
        Image::where(['album_id' => $id])->delete();
        Flash::success("<i class='fas fa-check'></i> Album Deleted")->important();
        return redirect("profile/results");
    }

    public function results_image($albumId, Request $request)
    {
        if (Auth::check() == false) {
            return redirect(base_url());
        }
        $user = Auth::user();
        $user = User::findOrFail($user->id);

        $album = Album::findOrFail($albumId);
        $images = Image::where('album_id', $albumId)->get();

        return view('frontend.users.result-images', compact('images', 'album', 'user'));
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

        return redirect("profile/results/image/$image->album_id");
    }


    // results section finish aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa

    /**
     * Show the form for Profile Paeg Editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function profileEdit()
    {

        if (Auth::check() == false) {
            return redirect(base_url());
        }

        $user = Auth::user();
        Log::info(label_case('Edit | ' . $user->name . '(ID:' . $user->id . ')  by User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')'));
        return view("frontend.users.edit")->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function profileUpdate(Request $request)
    {
        $id = Auth::user()->id;

        $this->validate($request, [
            'first_name' => 'required|string|max:191',
            // 'last_name'  => 'required|string|max:191',
            'avatar'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'city' => 'required',
        ]);

        $data = $request->all();
        $user = user::findOrFail($id);
        if ($request->file('avatar')) {
            $file_image = fileUpload($request, 'avatar', 'user/profile/');
            $data = array_merge($data, ['avatar' => $file_image]);
        }

        // add fields to update
        $data['name'] = $request->first_name . " " . $request->last_name;

        if ($request->last_name) {
            $f_name_l_name = $request->first_name . "-" . $request->last_name;
        } else {
            $f_name_l_name = $request->first_name;
        }

        $f_name_l_name = str_replace(" ", "-", $f_name_l_name);

        $data['username'] = strtolower($f_name_l_name);

        if ($data['city']) {
            $jsonEncodeTags = json_encode($data['city']);
            $data['city'] = $jsonEncodeTags;
        } else {
            $data['city'] = Null;
        }
        // add fields to update

        $user->update($data);

        // update userprofiles table
        $userprofiles = [];
        $userprofiles['date_of_birth'] = $data['date_of_birth'];
        $userprofiles['name'] = $data['name'];
        $userprofiles['first_name'] = $data['first_name'];
        $userprofiles['last_name'] = $data['last_name'];
        $userprofiles['username'] = strtolower($f_name_l_name);
        $userprofiles['address'] = $data['address'];
        $userprofiles['mobile'] = $data['mobile'];
        $userprofiles['gender'] = $data['gender'];
        $userprofiles['bio'] = $data['experience_years'];
        $userprofiles['degree'] = $data['education'];
        DB::table('userprofiles')->where('user_id', $id)->update($userprofiles);
        // update userprofiles table

        Flash::success("<i class='fas fa-check'></i> Vendor Updated Successfully")->important();
        Log::info(label_case('Update | ' . $user->name . '(ID:' . $user->id . ')  by User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')'));
        //        return redirect("admin/vendor/edit/" . $user->id);
        return redirect()->route('frontend.users.profileEdit')->with('flash_success', 'Update successful!');

        //        $module_title = $this->module_title;
        //        $module_name = $this->module_name;
        //        $module_path = $this->module_path;
        //        $module_icon = $this->module_icon;
        //        $module_model = $this->module_model;
        //        $module_name_singular = Str::singular($module_name);
        //        $module_action = 'Profile Update';
        //
        //
        //
        //        $module_name = $this->module_name;
        //        $module_name_singular = Str::singular($this->module_name);
        //
        //        if (!auth()->user()->can('edit_users')) {
        //            $id = auth()->user()->id;
        //            $username = auth()->user()->username;
        //        }
        //
        //        $$module_name_singular = $module_model::findOrFail($id);
        //        $filename = $$module_name_singular->avatar;
        //
        //        // Handle Avatar upload
        //        if ($request->hasFile('avatar')) {
        //            if ($$module_name_singular->getMedia($module_name)->first()) {
        //                $$module_name_singular->getMedia($module_name)->first()->delete();
        //            }
        //
        //            $media = $$module_name_singular->addMedia($request->file('avatar'))->toMediaCollection($module_name);
        //
        //            $$module_name_singular->avatar = $media->getUrl();
        //
        //            $$module_name_singular->save();
        //        }
        //
        //        $data_array = $request->except('avatar');
        //        $data_array['avatar'] = $$module_name_singular->avatar;
        //        $data_array['name'] = $request->first_name.' '.$request->last_name;
        //
        //        $user_profile = Userprofile::where('user_id', '=', $$module_name_singular->id)->first();
        //        $user_profile->update($data_array);
        //
        //        event(new UserProfileUpdated($user_profile));
        //
        //        return redirect()->route('frontend.users.profile', $$module_name_singular->id)->with('flash_success', 'Update successful!');
    }

    /**
     * Show the form for Profile Paeg Editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword()
    {

        if (Auth::check() == false) {
            return redirect(base_url());
        }

        $id = Auth::user()->id;

        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);
        $module_action = 'change Password';

        $body_class = 'profile-page';

        if ($id != auth()->user()->id) {
            return redirect()->route('frontend.users.profile', $id);
        }

        $id = auth()->user()->id;

        $$module_name_singular = $module_model::findOrFail($id);

        $body_class = 'profile-page';
        // dd($module_name); 
        return view("frontend.$module_name.changePassword", compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', "$module_name_singular", 'body_class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function changePasswordUpdate(Request $request)
    {

        if (Auth::check() == false) {
            return redirect(base_url());
        }

        $id = Auth::user()->id;
        // code
        $user = User::findOrFail($id);

        // code

        $this->validate($request, [
            'old_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_password_confirmation' => ['same:new_password'],
        ]);

        $module_name = $this->module_name;
        $module_name_singular = Str::singular($this->module_name);

        $$module_name_singular = auth()->user();

        $request_data = $request->only('new_password');
        $request_data['password'] = Hash::make($request_data['new_password']);

        $$module_name_singular->update($request_data);

        return redirect()->route('frontend.users.profileEdit', auth()->user()->id)->with('flash_success', 'Password updated successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);
        $module_action = 'Edit';

        if ($id != auth()->user()->id) {
            return redirect()->route('frontend.users.profile', $id);
        }

        $roles = Role::get();
        $permissions = Permission::select('name', 'id')->get();

        $$module_name_singular = User::findOrFail($id);

        $body_class = 'profile-page';

        $userRoles = $$module_name_singular->roles->pluck('name')->all();
        $userPermissions = $$module_name_singular->permissions->pluck('name')->all();

        return view("frontend.$module_name.edit", compact('userRoles', 'userPermissions', 'module_name', "$module_name_singular", 'module_icon', 'module_action', 'title', 'roles', 'permissions', 'body_class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $module_name = $this->module_name;
        $module_name_singular = Str::singular($this->module_name);

        if ($id != auth()->user()->id) {
            return redirect()->route('frontend.users.profile', $id);
        }

        $$module_name_singular = User::findOrFail($id);

        $$module_name_singular->update($request->except(['roles', 'permissions']));

        if ($id == 1) {
            $user->syncRoles(['administrator']);

            return redirect("admin/$module_name")->with('flash_success', 'Update successful!');
        }

        $roles = $request['roles'];
        $permissions = $request['permissions'];

        // Sync Roles
        if (isset($roles)) {
            $$module_name_singular->syncRoles($roles);
        } else {
            $roles = [];
            $$module_name_singular->syncRoles($roles);
        }

        // Sync Permissions
        if (isset($permissions)) {
            $$module_name_singular->syncPermissions($permissions);
        } else {
            $permissions = [];
            $$module_name_singular->syncPermissions($permissions);
        }

        return redirect("admin/$module_name")->with('flash_success', 'Update successful!');
    }

    /**
     * Remove the Social Account attached with a User.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function userProviderDestroy(Request $request)
    {
        $user_provider_id = $request->user_provider_id;
        $user_id = $request->user_id;

        if (!$user_provider_id > 0 || !$user_id > 0) {
            flash('Invalid Request. Please try again.')->error();

            return redirect()->back();
        } else {
            $user_provider = UserProvider::findOrFail($user_provider_id);

            if ($user_id == $user_provider->user->id) {
                $user_provider->delete();

                flash('<i class="fas fa-exclamation-triangle"></i> Unlinked from User, "' . $user_provider->user->name . '"!')->success();

                return redirect()->back();
            } else {
                flash('<i class="fas fa-exclamation-triangle"></i> Request rejected. Please contact the Administrator!')->warning();
            }
        }

        throw new GeneralException('There was a problem updating this user. Please try again.');
    }

    /**
     * Resend Email Confirmation Code to User.
     *
     * @param [type] $hashid [description]
     *
     * @return [type] [description]
     */
    public function emailConfirmationResend($id)
    {
        if ($id != auth()->user()->id) {
            if (auth()->user()->hasAnyRole(['administrator', 'super admin'])) {
                Log::info(auth()->user()->name . ' (' . auth()->user()->id . ') - User Requested for Email Verification.');
            } else {
                Log::warning(auth()->user()->name . ' (' . auth()->user()->id . ') - User trying to confirm another users email.');

                abort('404');
            }
        }

        $user = User::where('id', 'LIKE', $id)->first();

        if ($user) {
            if ($user->email_verified_at == null) {
                Log::info($user->name . ' (' . $user->id . ') - User Requested for Email Verification.');

                // Send Email To Registered User
                $user->sendEmailVerificationNotification();

                flash('Email Sent! Please Check Your Inbox.')->success()->important();

                return redirect()->back();
            } else {
                Log::info($user->name . ' (' . $user->id . ') - User Requested but Email already verified at.' . $user->email_verified_at);

                flash($user->name . ', You already confirmed your email address at ' . $user->email_verified_at->isoFormat('LL'))->success()->important();

                return redirect()->back();
            }
        }
    }

    public function getUserQuotations($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'My Quotations';

        $page_heading = ucfirst($module_title);
        $title = $page_heading . ' ' . ucfirst($module_action);

        if (!auth()->user()->can('edit_users')) {
            $id = auth()->user()->id;
        }

        if ($id != auth()->user()->id) {
            return redirect()->route('frontend.users.profile', $id);
        }

        // $$module_name_singular = $module_model::findOrFail($id);
        $quotations = Quotation::where('user_id', $id)->get();

        $body_class = 'profile-page';

        return view(
            "frontend.$module_name.quotations",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'quotations', 'body_class')
        );
    }

    public function getUserQuotation($id, $quotation_id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Quotation Details';

        $page_heading = ucfirst($module_title);
        $title = $page_heading . ' ' . ucfirst($module_action);

        if (!auth()->user()->can('edit_users')) {
            $id = auth()->user()->id;
        }

        if ($id != auth()->user()->id) {
            return redirect()->route('frontend.users.profile', $id);
        }

        // $$module_name_singular = $module_model::findOrFail($id);
        $quotations = Quotation::where('id', $quotation_id)->first();


        $vendor = Vendor::where('id', $quotations->vendor_id)->first();

        $vendor_user = User::where('id', $vendor->user_id)->first();
        $city = City::where('id', $vendor->city_id)->first();
        $type = Type::where('id', $vendor->type_id)->first();
        $vendor_url = url('/') . '/' . $type->slug . '/' . $city->slug . '/' . $vendor->slug;
        $vendor_data =  array('vendor_business_name' => $vendor->business_name,            'vendor_url' => $vendor_url);

        $body_class = 'profile-page';

        return view(
            "frontend.$module_name.quotations-details",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'quotations', 'body_class')
        );
    }


    public function getVendors($slug = 'wedding-photographers')
    {
        if (Auth::check() == false) {
            return redirect(base_url());
        }
        $user_id = Auth::user()->id;
        $type = DB::table('types')->where('slug', $slug)->first();


        $user_quotation = UserQuotation::where('type_id', $type->id)->where('user_id', $user_id)->first();
        $quotations = Quotation::where('user_id', $user_id)->get();

        $vendors = array();
        foreach ($quotations as $quotation) {
            $vendors[] = $quotation['vendor_id'];
        }


        // DB::enableQueryLog();
        if ($user_quotation) {
            $more_vendors = DB::table('vendors')->select('vendors.*')
                ->leftJoin('users', 'users.id', '=', 'vendors.user_id')
                ->leftJoin('types', 'types.id', '=', 'vendors.type_id')
                ->whereNotNull('users.email_verified_at')
                ->where('types.slug', $slug)
                ->where('vendors.city_id', $user_quotation->city_id)
                ->whereNotIn('vendors.id', $vendors)
                ->limit(20)
                ->get();
        } else {
            $more_vendors = DB::table('vendors')->select('vendors.*')
                ->leftJoin('users', 'users.id', '=', 'vendors.user_id')
                ->leftJoin('types', 'types.id', '=', 'vendors.type_id')
                ->whereNotNull('users.email_verified_at')
                ->where('types.slug', $slug)
                ->whereNotIn('vendors.id', $vendors)
                ->limit(20)
                ->get();
        }

        $vendors = DB::table('vendors')->select('vendors.*')
            ->leftJoin('users', 'users.id', '=', 'vendors.user_id')
            ->leftJoin('types', 'types.id', '=', 'vendors.type_id')
            ->whereNotNull('users.email_verified_at')
            ->where('types.slug', $slug)
            ->whereIn('vendors.id', $vendors)
            ->limit(20)
            ->get();

        // $vendors = DB::table('vendors')->whereIn('vendors.id', $vendors)->get();

        // dd(DB::getQueryLog());
        // dd($vendors);

        return view("frontend.users.vendor",  compact('user_quotation', 'type', 'more_vendors', 'vendors'));
    }


    public function get_user_cities(Request $request)
    {
        $module_name = $this->module_name;

        $term = trim($request->q);

        if (empty($term)) {
            return response()->json([]);
        }

        $query_data = DB::table('cities')->where('name', 'LIKE', "%$term%")->orWhere('slug', 'LIKE', "%$term%")->limit(7)->get();

        $$module_name = [];

        foreach ($query_data as $row) {
            $$module_name[] = [
                'id'   => $row->id,
                'text' => $row->name,
            ];
        }

        return response()->json($$module_name);
    }
}
