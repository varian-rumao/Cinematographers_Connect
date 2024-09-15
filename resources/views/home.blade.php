<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- GSAP Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>
    <script src="{{ asset('app.js') }}"></script>
</head>
<body>

  <div class="page-wrap">
    <header class="page-header">
    <nav>
      <div class="logo">
          <a href="#"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
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
        <!-- Show New Article button for both users and admins -->
        <a href="{{ route('articles.create') }}" class="btn btn-primary">New Article</a>

        <!-- Show Manage Profile only if the user is not an admin -->
        @if(!Auth::user()->is_admin)
            <a href="{{ route('profile.edit', auth()->user()->id) }}" class="btn btn-secondary">Manage Profile</a>
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
    <main>
      <article id="hero-1" style="--i: 5">
        <div class="hero-info">
          <h2>Film of the</h2>
          <h1>Week</h1>
          <h3>Author Name</h3>
        </div>
        <div class="hero-image hi-1"></div>
      </article>

      <article id="hero-2" style="--i: 4">
        <div class="hero-info">
          <h2>Film of the</h2>
          <h1>Week</h1>
          <h3>Author Name</h3>
        </div>
        <div class="hero-image hi-2"></div>
      </article>

      <article id="hero-3" style="--i: 3">
        <div class="hero-info">
          <h2>Film of the</h2>
          <h1>Week</h1>
          <h3>Author Name</h3>
        </div>
        <div class="hero-image hi-3"></div>
      </article>

      <article id="hero-4" style="--i: 2">
        <div class="hero-info">
          <h2>Film of the</h2>
          <h1>Week</h1>
          <h3>Author Name</h3>
        </div>
        <div class="hero-image hi-4"></div>
      </article>

      <article id="hero-5" style="--i: 1">
        <div class="hero-info">
          <h2>Film of the</h2>
          <h1>Week</h1>
          <h3>Author Name</h3>
        </div>
        <div class="hero-image hi-5"></div>
      </article>
    </main>

  </header>

  <script>
        $(document).ready(function() {
            $('.profile-icon').on('click', function(e) {
                e.stopPropagation();
                $('.dropdown-menu').toggle(); // Toggle dropdown visibility
            });
        });
    </script>

</body>
</html>
