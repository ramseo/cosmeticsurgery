<?php

namespace App\Http\Controllers\Auth;

use App\Events\Frontend\UserRegistered;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon as Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Flash;
class RegisteredVendorController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.vendor.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param \App\Http\Requests\LoginRequest $request
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string|max:191',
            'first_name' => 'required|string|max:191',
            // 'last_name'  => 'required|string|max:191',
            'password'   => 'required|string|confirmed|min:8',
            'city_id' => 'required',
            'type_id'  => 'required',
            'g-recaptcha-response' => 'required|recaptchav3:register,0.5',
        ]);
        if(trim($request->email) != 'mywedindia@gmail.com'){
            $request->validate(['email'      => 'required|string|email|max:191|unique:users']);
        }


        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'name'       => $request->first_name.' '.$request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
        ]);

        // username
//        $username = config('app.initial_username') + $user->id;
//        $user->username = $username;
        $user->username = strtolower($request->first_name . $request->last_name);
        if(trim($request->email) == 'mywedindia@gmail.com') {
            $user->email_verified_at =  Carbon::now();
        }
        $user->save();
        $user->assignRole('vendor');

        $vendor = [
            'user_id'        => $user->id,
            'city_id'        => $request->city_id,
            'type_id'        => $request->type_id,
            'business_name'  => $request->business_name,
            'slug'           => slug_format($request->business_name),
            'created_at'        => Carbon::now(),
            'updated_at'        => Carbon::now(),
        ];

        Vendor::create($vendor);


        Auth::login($user);

//        event(new Registered($user));
        event(new UserRegistered($user));
        if(trim($request->email) != 'mywedindia@gmail.com') {
            Flash::success("<i class='fas fa-check'></i> Registered: Please verify you email id")->important();
        }
        return redirect(route('vendor.dashboard'));
//        return redirect(RouteServiceProvider::HOME);
    }

}
