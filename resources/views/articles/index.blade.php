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
          <a href="home"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
      </div>
      <ul class="nav-menu">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="about">About Us</a></li>
          <li><a href="articles.index">Articles</a></li>
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
    @auth
    <li><a href="{{ route('articles.create') }}" class="btn btn-primary">New Article</a></li>
    @else
    <p>Please <a href="{{ route('login') }}">log in</a> to create an article.</p>
    @endauth
    <div class="search-bar mb-4">
        <form action="{{ route('articles.index') }}" method="GET">
            <input type="text" name="keyword" placeholder="Search by keyword" value="{{ request('keyword') }}" class="search-input">
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>
</header>

    <!-- Main Content Section -->
    <div class="row">
        <!-- Main Articles -->
        <div class="col-md-8">
            <div class="main-articles">
                @foreach($articles as $article)
                    <div class="article mb-4">
                        <a href="{{ route('articles.show', ['id' => $article->id]) }}">
                            <img src="https://via.placeholder.com/600x300" class="img-fluid mb-2" alt="{{ $article->title }}">
                            <h2 class="article-title">{{ $article->title }}</h2>
                        </a>
                        <p class="article-excerpt">{{ Str::limit($article->content, 150) }}</p>
                        <p class="article-meta">{{ $article->created_at->format('F j, Y') }} by {{ $article->user->name }}</p>
                    </div>
                @endforeach
            </div>
            {{ $articles->links() }} <!-- Pagination -->
        </div>

        <!-- Sidebar Section for Latest Articles -->
        <div class="col-md-4">
            <div class="sidebar">
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
</div>

<footer>
    <div class="footer-content">
        <h2>Got a Project in Mind?</h2>
            <a href="contact" class="cta-button">Let's Talk</a>
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
