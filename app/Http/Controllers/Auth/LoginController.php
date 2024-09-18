<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // Redirect users after login
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('verified')->only('authenticated'); // Ensure user is verified
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->is_admin) {
            return redirect()->route('home');
        }

        return redirect()->route('home');
    }

    // Handle failed login attempt
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                'email' => __('These credentials do not match our records.'),
            ]);
    }

    // Customize the logout method to redirect to login page
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
