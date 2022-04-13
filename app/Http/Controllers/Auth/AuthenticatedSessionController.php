<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param \App\Http\Requests\Auth\LoginRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $redirectTo = request()->redirectTo;
        if ($redirectTo) {
            return redirect($redirectTo);
        }

        $role = auth()->user()->getRoleNames()->first();

        if ($role){
            switch ($role) {
                case 'super admin':
                    return redirect('/admin/dashboard');
                    break;
                case 'vendor':
                    return redirect('/vendor/dashboard');
                    break;
                case 'user':
                    return redirect('/');
                    break;
                default:
                    return redirect(RouteServiceProvider::HOME);
                    break;
            }
        }

        return redirect(RouteServiceProvider::HOME);

    }

    /**
     * Destroy an authenticated session.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
