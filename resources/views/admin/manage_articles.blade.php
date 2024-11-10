@extends('layouts.app')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/manage_articles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

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

<main>
<div class="container mt-4">
    <h1 class="text-center mb-4">Manage Pending Articles</h1>

    <!-- Check if there are any pending articles -->
    @if($articles->isEmpty())
        <p>No pending articles found.</p>
    @else
        <div class="row">
            @foreach($articles as $article)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex">
                            <!-- Circular Image -->
                            <div class="article-image-container">
                                @if($article->image_path)
                                    <img src="{{ asset('storage/' . $article->image_path) }}" alt="Article Image" class="article-image">
                                @else
                                    <img src="https://via.placeholder.com/150" alt="Default Image" class="article-image">
                                @endif
                            </div>
                            
                            <!-- Article Title and Description -->
                            <div class="article-content ml-3">
                                <h5>{{ $article->title }}</h5>
                                <p>{{ Str::limit($article->content, 100) }}</p> <!-- Truncate content to one line -->

                                <!-- Read Article Button -->
                                <a href="{{ route('articles.show', $article->id) }}" class="btn btn-primary">Read Article</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
</main>

<footer>
    <div class="footer-content">
        <h2>Got a Project in Mind?</h2>
        <a href="{{ route('contact') }}" class="cta-button">Let's Talk</a>
        <div class="social-links">
            <a href="#" aria-label="Dribbble"><i class="fab fa-dribbble"></i><h3>@username</h3></a>
            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i><h3>@username</h3></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i><h3>@username</h3></a>
            <a href="#" aria-label="Behance"><i class="fab fa-behance"></i><h3>@username</h3></a>
        </div>
    </div>
</footer>
@endsection
