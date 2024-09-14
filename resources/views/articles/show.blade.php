@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/show.articles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
<header>
    <nav>
      <div class="logo">
          <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
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
                <!-- New Article Button -->
                <a href="{{ route('articles.create') }}" class="btn btn-primary">New Article</a>
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
    <div class="article-detail">
        <!-- Article Image -->
        <img src="https://via.placeholder.com/800x400" class="article-image mb-4" alt="{{ $article->title }}">

        <!-- Article Title -->
        <h1 class="article-title">{{ $article->title }}</h1>

        <!-- Article Metadata -->
        <p class="article-meta">Published on {{ $article->created_at->format('F j, Y') }} by {{ $article->user->name }}</p>

        <!-- Article Content -->
        <div class="article-content">
            {!! nl2br(e($article->content)) !!}
        </div>
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
</body>
@endsection
