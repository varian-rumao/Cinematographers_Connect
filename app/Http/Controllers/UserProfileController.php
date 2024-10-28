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
        return view('edit-profile', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = Auth::user();

    if ($user->id != $id) {
        abort(403, 'Unauthorized action.');
    }
    
    // Validate the form input
    $validatedData = $request->validate([
        'first_name' => 'nullable|string|max:255',
        'last_name' => 'nullable|string|max:255',
        'business_email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:255',
        'about_me' => 'nullable|string',
        'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'work_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'work_videos.*' => 'nullable|mimetypes:video/mp4,video/x-matroska,video/quicktime|max:20000', // Video formats
    ]);
    
    // Handle profile image upload
    if ($request->hasFile('profile_image')) {
        $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
        $user->profile_image = $profileImagePath;
    }

    // Handle work images upload
    if ($request->hasFile('work_images')) {
        foreach ($request->file('work_images') as $image) {
            $imagePath = $image->store('work_images', 'public');
            $user->works()->create([
                'image_url' => $imagePath,
                'user_id' => $user->id,
            ]);
        }
    }

    // Handle work videos upload
    if ($request->hasFile('work_videos')) {
        foreach ($request->file('work_videos') as $video) {
            $videoPath = $video->store('work_videos', 'public');
            $user->works()->create([
                'video_url' => $videoPath,
                'user_id' => $user->id,
            ]);
        }
    }

    // Update the user details
    $user->first_name = $validatedData['first_name'] ?? $user->first_name;
    $user->last_name = $validatedData['last_name'] ?? $user->last_name;
    $user->business_email = $validatedData['business_email'] ?? $user->business_email;
    $user->phone = $validatedData['phone'] ?? $user->phone;
    $user->about_me = $validatedData['about_me'] ?? $user->about_me;
    $user->save();

    return redirect()->route('works.show', $user->id)->with('success', 'Profile updated successfully.');
}

    public function showWorks($id)
    {
        // Fetch the user by ID
        $user = User::findOrFail($id);

        // Fetch the user's profile details
        $profile = $user->profile; // Fetch related profile, assuming one-to-one relationship

        // If there's no profile, create a default one
        if (!$profile) {
            $profile = new UserProfile([
                'user_id' => $user->id,
                'business_email' => $user->email, // Default business email to user's email
                'mobile_number' => '', // Default value if no mobile number is provided
                'location' => '', // Default value if no location is provided
                'other_details' => '', // Default value if no other details are provided
            ]);
            $profile->save();
        }

        // Fetch the user's works
        $works = $user->works; // Assuming a one-to-many relationship with works

        // Find the next user (for navigating to the next profile)
        $nextUser = User::where('id', '>', $id)->orderBy('id')->first();

        // If there's no next user, set it to null or cycle back to the first user
        if (!$nextUser) {
            $nextUser = User::orderBy('id')->first();
        }

        // Pass all the required data to the view
        return view('user.works', compact('user', 'profile', 'works', 'nextUser'));
    }
}