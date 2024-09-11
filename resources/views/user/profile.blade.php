@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Your Profile</h1>

    <!-- Display the profile form -->
    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Profile Picture -->
        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
            @if($user->profile && $user->profile->profile_picture)
                <img src="{{ asset('storage/' . $user->profile->profile_picture) }}" alt="Profile Picture" width="100">
            @endif
        </div>

        <!-- Business Email -->
        <div class="form-group">
            <label for="business_email">Business Email</label>
            <input type="email" class="form-control" id="business_email" name="business_email" value="{{ $user->profile->business_email ?? '' }}" required>
        </div>

        <!-- Mobile Number -->
        <div class="form-group">
            <label for="mobile_number">Mobile Number</label>
            <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ $user->profile->mobile_number ?? '' }}">
        </div>

        <!-- Location -->
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ $user->profile->location ?? '' }}">
        </div>

        <!-- Other Details -->
        <div class="form-group">
            <label for="other_details">Other Details</label>
            <textarea class="form-control" id="other_details" name="other_details" rows="3">{{ $user->profile->other_details ?? '' }}</textarea>
        </div>

        <!-- Upload New Photos -->
        <div class="form-group">
            <label for="upload_photos">Upload Photos</label>
            <input type="file" class="form-control" id="upload_photos" name="photos[]" multiple>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>
@endsection
