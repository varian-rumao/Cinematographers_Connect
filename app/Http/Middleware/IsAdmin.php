<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has the 'is_admin' property set to true
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // If the user is not an admin, redirect to the login page with an error message
        return redirect('/login')->with('error', 'Unauthorized access');
    }
}