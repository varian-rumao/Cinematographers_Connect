<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Work;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Display the admin dashboard
    public function dashboard()
    {
        $usersCount = User::count();
        $activeSessions = Session::all()->count();
        return view('admin.dashboard', compact('usersCount', 'activeSessions'));
    }

    // Display the list of users
    public function manageUsers()
    {
        $users = User::all();
        return view('admin.manageUsers', compact('users'));
    }

    // Delete a user
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.manageUsers')->with('success', 'User deleted successfully.');
    }

    // Display the list of photos
    public function managePhotos()
    {
        $photos = Work::all(); // Assuming 'Work' model holds photo data
        return view('admin.managePhotos', compact('photos'));
    }

    // Delete a photo
    public function deletePhoto($id)
    {
        $photo = Work::findOrFail($id);
        $photo->delete();
        return redirect()->route('admin.managePhotos')->with('success', 'Photo deleted successfully.');
    }

    // Display session activity
    public function sessionActivity()
    {
        $sessions = Session::all();
        return view('admin.sessionActivity', compact('sessions'));
    }
}
