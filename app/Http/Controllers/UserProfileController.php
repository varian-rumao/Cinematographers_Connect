<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    // Show the profile edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('profile', compact('user'));

    }

    // Update the profile information
    public function update(Request $request, $id)
    {
        $request->validate([
            'business_email' => 'required|email',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'mobile_number' => 'nullable|string|max:15',
            'location' => 'nullable|string|max:255',
            'other_details' => 'nullable|string',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = User::findOrFail($id);

        // Update profile information
        $profile = $user->profile ?: new UserProfile();
        $profile->user_id = $user->id;
        $profile->business_email = $request->business_email;
        $profile->mobile_number = $request->mobile_number;
        $profile->location = $request->location;
        $profile->other_details = $request->other_details;

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            if ($profile->profile_picture) {
                Storage::delete('public/' . $profile->profile_picture);
            }
            $profile->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $profile->save();

        // Handle multiple photos upload
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('works', 'public');
                $user->works()->create(['image_url' => $path]);
            }
        }

        return redirect()->route('profile.edit', $user->id)->with('success', 'Profile updated successfully.');
    }
}
