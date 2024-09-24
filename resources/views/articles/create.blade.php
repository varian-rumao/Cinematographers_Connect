@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit an Article</title>
    <link rel="stylesheet" href="{{ asset('css/articles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<header>
    <nav>
      <div class="logo">
          <a href="home"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
      </div>
      <ul class="nav-menu">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('about') }}">About Us</a></li>
          <li><a href="{{ route('articles.index') }}">Articles</a></li>
          <li><a href="{{ route('contact') }}">Contact Us</a></li>
          <li><a href="{{ route('gallery.index') }}">Gallery</a></li>
      </ul>
      <div id="burger" class="burger-menu">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div class="profile-buttons">
            @auth
                <!-- Manage Profile and Logout Buttons -->
                <a href="{{ route('profile.edit', auth()->user()->id) }}" class="btn btn-secondary">Manage Profile</a>
                <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <!-- Login Button -->
                <a href="{{ route('login') }}" class="btn btn-primary">Member Login</a>
            @endauth
        </div>
    </nav>
</header>

<div class="container mt-5">
    <h1>Submit an Article</h1>
    <form id="articleForm" action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" rows="5" class="form-control" required></textarea>
        </div>

        <div class="form-group">
            <label for="keywords">Keywords (optional)</label>
            <input type="text" name="keywords" id="keywords" class="form-control">
        </div>

        <div class="form-group">
            <label for="image">Upload Article Image</label>
            <input type="file" name="image" class="form-control-file" accept="image/*">
        </div>

        <button type="submit" class="btn-new-blog">Submit for Review</button>
    </form>
</div>

<!-- Modal Structure -->
<div id="successModal" class="modal">
    <div class="modal-content">
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
            <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
            <path class="checkmark__check" fill="none" d="M14 27l7 7 16-16"/>
        </svg>
        <h2>Article submitted successfully!</h2>
        <p>We will look over the article for approval.</p>
    </div>
</div>

<footer>
    <div class="footer-content">
        <h2>Got a Project in Mind?</h2>
        <a href="{{ route('contact') }}" class="cta-button">Let's Talk</a>
        <div class="social-links">
            <a href="#" aria-label="Dribbble"><i class="fab fa-dribbble"><h3>@username</h3></i></a>
            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"><h3>@username</h3></i></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"><h3>@username</h3></i></a>
            <a href="#" aria-label="Behance"><i class="fab fa-behance"><h3>@username</h3></i></a>
        </div>
    </div>
</footer>

<script>
    document.getElementById('articleForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Show the modal
        var modal = document.getElementById('successModal');
        modal.style.display = 'block';

        // Simulate form submission delay (e.g., network request)
        setTimeout(() => {
            this.submit(); // Proceed with the actual form submission after showing the popup
        }, 1500); // Adjust timing as needed
    });
</script>
</body>
@endsection
