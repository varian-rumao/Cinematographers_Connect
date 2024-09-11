<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;

class AdminController extends Controller
{
    // Display the admin dashboard with user statistics
    public function dashboard()
    {
        $totalUsers = User::count();
        $totalCinematographers = User::where('role', 'cinematographer')->count();

        return view('admin.dashboard', compact('totalUsers', 'totalCinematographers'));
    }

    // Display the list of users for management
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // Delete a user by ID
    public function deleteUser($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.users')->with('message', 'User deleted successfully!');
    }

    // Display the settings page
    public function settings()
    {
        $settings = Setting::first();
        return view('admin.settings', compact('settings'));
    }

    // Update site settings
    public function updateSettings(Request $request)
    {
        $settings = Setting::first();
        $settings->site_name = $request->input('site_name');
        $settings->site_email = $request->input('site_email');
        $settings->save();

        return redirect()->route('admin.settings')->with('message', 'Settings updated successfully!');
    }
}
