@extends('layouts.app')

@section('content')
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<!-- Link to the external CSS file -->
<link href="{{ asset('css/works.css') }}" rel="stylesheet">

<!-- Main Header -->
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
        <div class="profile-icon">
            <a href="{{ route('login') }}">
                <i class="fas fa-user-circle"></i>
            </a>
        </div>
    </nav>
</header>

<!-- Profile Header -->
<div class="container body-content">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="display-4 font-weight-bold">{{ $user->name }}</h1>
            <p class="lead">{{ $profile->mobile_number }}</p>
        </div>
        <div class="col-md-6 text-right">
            
        </div>
    </div>

    <hr>

    <!-- Description -->
    <div class="row mt-4 mb-5">
        <div class="col-md-12">
            <h5 class="text-uppercase">Description</h5>
            <p>{{ $profile->other_details }}</p>
        </div>
    </div>

    <!-- Hero Section -->
    @if($profile->profile_picture)
    <div class="row">
        <div class="col-md-12">
            <img src="{{ asset('storage/' . $profile->profile_picture) }}" class="img-fluid w-100 mb-5" alt="Profile Picture">
        </div>
    </div>
    @endif

    <!-- Works Grid Section -->
    <div class="row mb-5">
        @foreach($works as $work)
            <div class="col-6 col-md-4 col-lg-3 mb-4">
                <div class="card border-0">
                    <img src="{{ asset('storage/' . $work->image_url) }}" class="card-img-top rounded" alt="Work Image">
                </div>
            </div>
        @endforeach
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

    <!-- Footer Section -->
    <footer>
        <div class="footer-content">
            <h2>Got a Project in Mind?</h2>
            <a href="contact" class="cta-button">Let's Talk</a>
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
