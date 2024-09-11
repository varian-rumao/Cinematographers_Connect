<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    // Update the profile information
    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('edit-profile', compact('user'));
}

public function update(Request $request, $id)
{
    $user = Auth::user();

    $validatedData = $request->validate([
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'business_email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:255',
        'about_me' => 'nullable|string',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'work_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    if ($request->hasFile('profile_image')) {
        $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
        $user->profile_image = $profileImagePath;
    }

    if ($request->hasFile('work_images')) {
        $workImages = [];
        foreach ($request->file('work_images') as $image) {
            $path = $image->store('work_images', 'public');
            $workImages[] = $path;
        }
        // Assuming you have a way to save work images (e.g., as JSON or in another table)
        $user->work_images = json_encode($workImages);
    }

    $user->first_name = $validatedData['first_name'];
    $user->last_name = $validatedData['last_name'];
    $user->business_email = $validatedData['business_email'];
    $user->phone = $validatedData['phone'];
    $user->about_me = $validatedData['about_me'];
    $user->save();

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