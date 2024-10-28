<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    public function index()
    {
        // Fetch user profiles associated with non-admin users
        $userProfiles = UserProfile::whereHas('user', function ($query) {
            $query->where('is_admin', false); // Exclude admin users
        })->with('user') // Load the related user data
          ->get();

        // Log or debug the fetched profiles
        if ($userProfiles->isEmpty()) {
            Log::info('No user profiles found.');
            return view('gallery.index')->with('message', 'No users found.');
        } else {
            Log::info('User profiles found: ', $userProfiles->toArray());
        }

        return view('gallery.index', compact('userProfiles'));
    }
}
