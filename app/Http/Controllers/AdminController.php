<?php

// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function __construct()
    {
        // Use Gate to check if user is admin
        $this->middleware(function ($request, $next) {
            if (Gate::denies('admin-access')) {
                return redirect('/home')->with('error', 'You do not have admin access.');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
