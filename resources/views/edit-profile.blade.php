@extends('layouts.app')

@section('content')
<header>
    <nav>
      <div class="logo">
          <a href="home"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
      </div>
      <ul class="nav-menu">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="about">About Us</a></li>
          <li><a href="blogs">Blog</a></li>
          <li><a href="contact">Contact Us</a></li>
          <li><a href="gallery">Gallery</a></li>
      </ul>
      <div id="burger" class="burger-menu">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="profile-icon">
          <a href="{{ route('login') }}">
              <i class="fas fa-user-circle"></i>
          </a>
      </div>
    </nav>
</header>

<div class="container mt-5">
    <h1>Edit Profile</h1>
    <form action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-4 text-center">
                <!-- Profile Image Section -->
                <div class="profile-image-section">
                    <img src="{{ Auth::user()->profile_image ? asset('storage/' . Auth::user()->profile_image) : 'https://via.placeholder.com/150' }}" alt="Profile Image" class="profile-image mb-3">
                    <input type="file" name="profile_image" id="uploadProfileImage" class="profile-input-file">
                    <label for="uploadProfileImage" class="upload-button">Upload Profile Image</label>
                </div>
            </div>

            <div class="col-md-8">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" class="profileInputBox" value="{{ Auth::user()->username }}" readonly disabled>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="profileInputBox" value="{{ Auth::user()->email }}" readonly disabled>
                </div>
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" name="first_name" class="profileInputBox" value="{{ Auth::user()->first_name }}">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" name="last_name" class="profileInputBox" value="{{ Auth::user()->last_name }}">
                </div>
                <div class="form-group">
                    <label for="business_email">Business Email (optional):</label>
                    <input type="email" name="business_email" class="profileInputBox" value="{{ Auth::user()->business_email }}">
                </div>
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" name="phone" class="profileInputBox" value="{{ Auth::user()->phone }}">
                </div>
                <div class="form-group">
                    <label for="about_me">About Me:</label>
                    <textarea name="about_me" class="profileInputBox">{{ Auth::user()->about_me }}</textarea>
                </div>
                <div class="form-group">
                    <label for="work_images">Upload Work Images:</label>
                    <input type="file" name="work_images[]" class="profileInputBox" multiple>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Save Profile</button>
            </div>
        </div>
    </form>
</div>

<<footer>
    <div class="footer-content">
        <h2>Got a Project in Mind?</h2>
            <a href="#" class="cta-button">Let's Talk</a>
            <div class="social-links">
                <a href="#" aria-label="Dribbble"><i class="fab fa-dribbble"><h3>@username</h3></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"><h3>@username</h3></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"><h3>@username</h3></i></a>
                <a href="#" aria-label="Behance"><i class="fab fa-behance"><h3>@username</h3></i></a>
            </div>
        </div>
    </footer>


@endsection
