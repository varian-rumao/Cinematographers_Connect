@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="{{ asset('css/blogs.css') }}">
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
    @auth
    <!-- Show this if the user is authenticated -->
    <li><a href="{{ route('blogs.create') }}" class="btn btn-primary">New Blog</a></li>
@else
    <!-- Show this if the user is not authenticated -->
    <p>Please <a href="{{ route('login') }}">log in</a> to create a blog.</p>
@endauth
</header>


    <main>
        <section class="blog-section">
        <div class="container">
    <form method="GET" action="{{ route('articles.index') }}">
        <input type="text" name="keyword" placeholder="Search by keyword" value="{{ request('keyword') }}">
        <button type="submit">Search</button>
    </form>

    <h1>Articles</h1>

    @foreach ($articles as $article)
        <div>
            <h2><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></h2>
            <p>{{ Str::limit($article->content, 100) }}</p>
        </div>
    @endforeach

    {{ $articles->links() }}
</div>
@endsection
        </section>
    </main>

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
