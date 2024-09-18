@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<link href="{{ asset('css/works.css') }}" rel="stylesheet">

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
                <a href="{{ route('articles.create') }}" class="btn btn-primary">New Article</a>
                <a href="{{ route('profile.edit', auth()->user()->id) }}" class="btn btn-secondary">Manage Profile</a>
                <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                
                <!-- Admin Buttons -->
                @if(Auth::user()->is_admin)
                    <a href="{{ route('manage.users') }}" class="btn btn-secondary">Manage Users</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Member Login</a>
            @endauth
        </div>
    </nav>
</header>
<main>
<div class="container body-content py-5">
    <!-- User Name and Contact Information -->
    <div class="row align-items-center mb-4">
        <div class="col-md-8">
            <h1 class="display-4 font-weight-bold">{{ $user->first_name }} {{ $user->last_name }}</h1>
            <p class="lead text-muted">{{ $profile->mobile_number }}</p>
        </div>
    </div>

    <!-- Horizontal Divider -->
    <hr class="my-4">

    <!-- Description Section -->
    <div class="row mb-5">
        <div class="col-md-12">
            <h5 class="text-uppercase text-secondary">About Me</h5>
            <p class="text-muted">{{ $user->about_me }}</p>
        </div>
    </div>

    <!-- Profile Picture -->
    @if($user->profile_image)
    <div class="row justify-content-center mb-5">
        <div class="col-md-4 text-center">
            <img src="{{ asset('storage/' . $user->profile_image) }}" class="img-fluid rounded-circle profile-picture shadow" alt="Profile Picture" style="width: 180px; height: 180px; object-fit: cover;">
        </div>
    </div>
    @endif

    <!-- Work Images Section -->
    <div class="row">
        @foreach($works->chunk(3) as $chunk)
            @foreach($chunk as $work)
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <img src="{{ asset('storage/' . $work->image_url) }}" class="card-img-top rounded work-image" alt="Work Image" style="height: 200px; object-fit: cover;">
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>

    <!-- Next Project Section -->
    @if($nextUser)
        <a href="{{ route('works.show', ['id' => $nextUser->id]) }}" class="next-project-link">
            <div class="row align-items-center mb-5">
                <div class="col-md-6">
                    <h5 class="text-uppercase">Next Project</h5>
                    <h2 class="font-weight-bold">{{ $nextUser->name }}</h2>
                </div>
                <div class="col-md-6">
                    <img src="{{ asset('storage/next_project_image.jpg') }}" class="img-fluid rounded" alt="Next Project Image">
                </div>
            </div>
        </a>
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
@endsection
