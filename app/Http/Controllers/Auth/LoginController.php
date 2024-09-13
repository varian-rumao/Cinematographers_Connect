<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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

    // Override the authenticated method to flash a success message to the session
    protected function authenticated(Request $request, $user)
    {
        // Flash a success message to the session
        $request->session()->flash('status', 'Login successful!');

        // Redirect to the intended page (default is home)
        return redirect()->intended($this->redirectTo);
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
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login'); // Redirect to login page after logout
    }
}
