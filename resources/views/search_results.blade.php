<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/search.css">
</head>
<body>

<div class="page-wrap">
    <!-- Header Section -->
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
            <div class="search-bar">
            <form action="{{ route('search') }}" method="GET">
                <input type="text" name="query" placeholder="Search..." required>
                <button type="submit">Search</button>
            </form>
            </div>
            <div class="profile-buttons">
                @auth
                    <!-- Show different options for regular users and admin users -->
                    @if(!Auth::user()->is_admin)
                        <a href="{{ route('profile.edit', auth()->user()->id) }}" class="btn btn-secondary">Manage Profile</a>
                        <a href="{{ route('articles.create') }}" class="btn btn-primary">New Article</a>
                    @endif
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.manageUsers') }}" class="btn btn-secondary">Manage Users</a>
                        <a href="{{ route('admin.manageArticles') }}" class="btn btn-secondary">Manage Articles</a>
                        <a href="{{ route('admin.managePhotos') }}" class="btn btn-secondary">Manage Photos</a>
                    @endif
                    <!-- Logout Button -->
                    <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <!-- Login Button for non-authenticated users -->
                    <a href="{{ route('login') }}" class="btn btn-primary">Member Login</a>
                @endauth
            </div>
        </nav>
    </header>

    <!-- Main Content - Search Results -->
    <main class="content-wrapper">
        <div class="container">
            <h1>Search Results for "{{ $query }}"</h1>

            @if (count($results) > 0)
                <ul>
                    @foreach ($results as $result)
                        @if($result['type'] === 'works')
                            <li><a href="{{ route('works.show', ['id' => $result['id']]) }}">{{ $result['title'] }}</a></li>
                        @elseif($result['type'] === 'articles')
                            <li><a href="{{ route('articles.show', ['id' => $result['id']]) }}">{{ $result['title'] }}</a></li>
                        @endif
                    @endforeach
                </ul>
            @else
                <p>No results found for "{{ $query }}".</p>
            @endif
        </div>
    </main>

    <!-- Footer Section -->
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
</div>

</body>
</html>
