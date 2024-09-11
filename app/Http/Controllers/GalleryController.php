<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $userProfiles = UserProfile::with('user')->get();
        return view('gallery.index', compact('userProfiles'));
    }
}
