@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <link rel="stylesheet" href="{{ asset('css/articles.css') }}">
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

        <!-- Profile and Authentication Buttons -->
        @auth
    <a href="{{ route('articles.create') }}" class="btn btn-primary">New Article</a>
    <a href="{{ route('profile.edit', auth()->user()->id) }}" class="btn btn-secondary">Manage Profile</a>
    <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <!-- Admin Buttons - Only visible if user is admin -->
        @if(Auth::user()->is_admin)
            <a href="{{ route('manage.users') }}" class="btn btn-secondary">Manage Users</a>
        @endif
    @else
        <a href="{{ route('login') }}" class="btn btn-primary">Member Login</a>
    @endauth


        <!-- Search Bar -->
        <div class="search-bar">
            <form action="{{ route('articles.index') }}" method="GET">
                <input type="text" name="keyword" placeholder="Search by keyword" value="{{ request('keyword') }}" class="search-input">
                <button type="submit" class="search-button">Search</button>
            </form>
        </div>
    </nav>
</header>

<!-- Main Content Section -->
<div class="content-container">
    <div class="main-content">
        <!-- Main Articles Section -->
        <div class="articles-section">
            @foreach($articles as $article)
                <div class="article mb-4">
                    <a href="{{ route('articles.show', ['id' => $article->id]) }}">
                        <img src="https://via.placeholder.com/600x300" class="img-fluid mb-2" alt="{{ $article->title }}">
                        <h2 class="article-title">{{ $article->title }}</h2>
                    </a>
                    <p class="article-excerpt">{{ Str::limit($article->content, 150) }}</p>
                    <p class="article-meta">{{ $article->created_at->format('F j, Y') }} by {{ $article->user->name }}</p>
                    
                    @if(Auth::user()->is_admin)
                        <!-- Admin Approve/Reject Buttons -->
                        <form action="{{ route('admin.approveArticle', $article) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>
                        <form action="{{ route('admin.rejectArticle', $article) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-warning">Reject</button>
                        </form>
                    @endif
                </div>
            @endforeach
            {{ $articles->links() }} <!-- Pagination -->
        </div>

        <!-- Vertical Line Divider -->
        <div class="vertical-divider"></div>

        <!-- Sidebar Section for Latest Articles -->
        <div class="sidebar-section">
            <h3>Latest Articles</h3>
            <ul class="list-group">
                @foreach($latestArticles as $latestArticle)
                    <li class="list-group-item">
                        <a href="{{ route('articles.show', ['id' => $latestArticle->id]) }}">{{ $latestArticle->title }}</a>
                    </li>
                @endforeach
            </ul>
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
