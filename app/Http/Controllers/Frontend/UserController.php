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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\Type;
use App\Models\City;
use App\Models\Vendor;

use Log;
use Flash;
use Auth;
use DB;

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
        if(Auth::check() == false) {
            return redirect(base_url());
        }
        $user = Auth::user();
        $user = User::findOrFail($user->id);

        if ($user) {
            $userprofile = Userprofile::where('user_id', $user->id)->first();
        } else {
            Log::error('UserProfile Exception for Username: '.$username);
            abort(404);
        }

        $body_class = 'profile-page';

        $meta_page_type = 'profile';

        return view("frontend.users.profile", compact( 'user', 'userprofile'));
    }

    /**
     * Show the form for Profile Paeg Editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function profileEdit()
    {

        if(Auth::check() == false) {
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
    public function profileUpdate(Request $request, $id)
    {

//        if ($id != auth()->user()->id) {
//            return redirect()->route('frontend.users.profile', $id);
//        }

        $this->validate($request, [
            'first_name' => 'required|string|max:191',
            'last_name'  => 'required|string|max:191',
            'avatar'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();
        $user = user::findOrFail($id);
        if ($request->file('avatar')) {
            $file_image = fileUpload($request, 'avatar', 'user/profile/');
            $data = array_merge($data, ['avatar' => $file_image]);
        }

        $user->update($data);

        Flash::success("<i class='fas fa-check'></i> Vendor Updated Successfully")->important();
        Log::info(label_case('Update | ' . $user->name . '(ID:' . $user->id . ')  by User:' . auth()->user()->name . '(ID:' . auth()->user()->id . ')'));
//        return redirect("admin/vendor/edit/" . $user->id);
        return redirect()->route('frontend.users.profileEdit', $user->id)->with('flash_success', 'Update successful!');

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

        if(Auth::check() == false) {
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
        if(Auth::check() == false) {
            return redirect(base_url());
        }

        $id = Auth::user()->id;

        $this->validate($request, [
            'password' => 'required|confirmed|min:6',
        ]);

        $module_name = $this->module_name;
        $module_name_singular = Str::singular($this->module_name);

        $$module_name_singular = auth()->user();

        $request_data = $request->only('password');
        $request_data['password'] = Hash::make($request_data['password']);

        $$module_name_singular->update($request_data);

        return redirect()->route('frontend.users.profile', auth()->user()->id)->with('flash_success', 'Update successful!');
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

                flash('<i class="fas fa-exclamation-triangle"></i> Unlinked from User, "'.$user_provider->user->name.'"!')->success();

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
                Log::info(auth()->user()->name.' ('.auth()->user()->id.') - User Requested for Email Verification.');
            } else {
                Log::warning(auth()->user()->name.' ('.auth()->user()->id.') - User trying to confirm another users email.');

                abort('404');
            }
        }

        $user = User::where('id', 'LIKE', $id)->first();

        if ($user) {
            if ($user->email_verified_at == null) {
                Log::info($user->name.' ('.$user->id.') - User Requested for Email Verification.');

                // Send Email To Registered User
                $user->sendEmailVerificationNotification();

                flash('Email Sent! Please Check Your Inbox.')->success()->important();

                return redirect()->back();
            } else {
                Log::info($user->name.' ('.$user->id.') - User Requested but Email already verified at.'.$user->email_verified_at);

                flash($user->name.', You already confirmed your email address at '.$user->email_verified_at->isoFormat('LL'))->success()->important();

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
        $title = $page_heading.' '.ucfirst($module_action);

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
        $title = $page_heading.' '.ucfirst($module_action);

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
        $vendor_url = url('/').'/'.$type->slug.'/'.$city->slug.'/'.$vendor->slug;
        $vendor_data =  array( 'vendor_business_name' => $vendor->business_name,            'vendor_url' => $vendor_url );

        $body_class = 'profile-page';

        return view(
            "frontend.$module_name.quotations-details",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', 'quotations', 'body_class')
        );
    }


   public function getVendors($slug = 'wedding-photographers')
    {
         if(Auth::check() == false) {
            return redirect(base_url());
        }
        $user_id = Auth::user()->id;
        $type = DB::table('types')->where('slug', $slug)->first();


        $user_quotation = UserQuotation::where('type_id',$type->id)->where('user_id', $user_id)->first();
        $quotations = Quotation::where('user_id', $user_id)->get();

        $vendors = array();
        foreach($quotations as $quotation){
            $vendors[]=$quotation['vendor_id'];
        }

// DB::enableQueryLog();
        $more_vendors = DB::table('vendors')->select('vendors.*')
        ->leftJoin('users', 'users.id', '=', 'vendors.user_id')
        ->leftJoin('types', 'types.id', '=', 'vendors.type_id')
        ->whereNotNull('users.email_verified_at')
        ->where('types.slug', $slug)
        ->whereNotIn('vendors.id', $vendors)
        ->limit(20)
        ->get();
        

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

}
