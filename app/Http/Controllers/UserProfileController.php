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
        return view('user.profile', compact('user'));
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

        // Update or create the user's profile
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

    // Show the works of an individual user
    public function showWorks($id)
{
    // Fetch the user by ID
    $user = User::findOrFail($id);

    // Fetch the user's profile details or create a new profile if none exists
    $profile = $user->profile; // This will attempt to fetch the profile related to the user

    // Check if the profile exists; if not, create a new one with default values
    if (!$profile) {
        $profile = new UserProfile([
            'user_id' => $user->id,
            'business_email' => $user->email, // Assuming default to user's email if business email is not provided
            'mobile_number' => '', // Default value if no mobile number is provided
            'location' => '', // Default value if no location is provided
            'other_details' => '', // Default value if no other details are provided
        ]);

        // Save the newly created profile
        $profile->save();
    }

    // Fetch the user's works
    $works = $user->works; // Assuming there is a relationship 'works' defined in the User model

    // Find the next user (this logic can be changed based on your requirement)
    $nextUser = User::where('id', '>', $id)->orderBy('id')->first();

    // If there's no next user, you can set it to null or cycle back to the first user
    if (!$nextUser) {
        $nextUser = User::orderBy('id')->first();
    }

    // Pass all the required data to the view
    return view('user.works', compact('user', 'profile', 'works', 'nextUser'));
}
}