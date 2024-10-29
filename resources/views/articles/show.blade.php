@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $article->title }}</title>
    <link rel="stylesheet" href="{{ asset('css/show.articles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <div class="profile-buttons">
            @auth
                <!-- Show Manage Profile only if the user is not an admin -->
                @if(!Auth::user()->is_admin)
                    <a href="{{ route('profile.edit', auth()->user()->id) }}" class="btn btn-secondary">Manage Profile</a>
                    <a href="{{ route('articles.create') }}" class="btn btn-primary">New Article</a>
                @endif

                <!-- Show Admin Controls only for admin -->
                @if(Auth::user()->is_admin)
                    <a href="{{ route('admin.manageUsers') }}" class="btn btn-secondary">Manage Users</a>
                    <a href="{{ route('admin.manageArticles') }}" class="btn btn-secondary">Manage Articles</a>
                    <a href="{{ route('admin.managePhotos') }}" class="btn btn-secondary">Manage Photos</a>
                @endif

                <!-- Logout Button for all authenticated users -->
                <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <!-- Show Login button if the user is not authenticated -->
                <a href="{{ route('login') }}" class="btn btn-primary">Member Login</a>
            @endauth
        </div>
    </nav>
</header>

<div class="container mt-5">
    <div class="article-detail">
        <!-- Article Image -->
        <img src="{{ $article->image_path ? asset('storage/' . $article->image_path) : 'https://via.placeholder.com/800x400' }}" 
             class="article-image mb-4" 
             alt="{{ $article->title }}">

        <!-- Article Title -->
        <h1 class="article-title">{{ $article->title }}</h1>

        <!-- Article Metadata -->
        <p class="article-meta">Published on {{ $article->created_at->format('F j, Y') }} by {{ $article->user->name }}</p>

        <!-- Article Content -->
        <div class="article-content">
            {!! nl2br(e($article->content)) !!}
        </div>
        <!-- Approve/Reject Buttons (Visible for Admin only) -->
        @if(Auth::check() && Auth::user()->is_admin)
        <div class="mt-4 text-center">
            <form action="{{ route('admin.approveArticle', $article->id) }}" method="POST" style="display: inline-block;">
                @csrf
                <button type="submit" class="btn btn-success btn-lg">Approve</button>
            </form>

            <form action="{{ route('admin.rejectArticle', $article->id) }}" method="POST" style="display: inline-block;">
                @csrf
                <button type="submit" class="btn btn-danger btn-lg">Reject</button>
            </form>
        </div>
        @endif
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
