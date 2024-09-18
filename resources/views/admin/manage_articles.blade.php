@extends('layouts.app')

@section('content')

<head>
    <link rel="stylesheet" href="{{ asset('css/manage_articles.css') }}">
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
        <p class="text-center">No pending articles found.</p>
    @else
        <div class="row">
            <!-- Loop through and display the pending articles -->
            @foreach($articles as $article)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ $article->content }}</p>

                            <div class="mt-auto">
                                <form action="{{ route('admin.approveArticle', $article->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                </form>
                                <form action="{{ route('admin.rejectArticle', $article->id) }}" method="POST" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                                </form>
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
