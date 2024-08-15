@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top justify-content-center">
        <div class="container">
            <a class="navbar-brand mx-auto" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('stories') }}">Stories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('works') }}">Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gallery') }}">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="search-bar text-center">
        <form action="{{ route('search') }}" method="GET" class="d-flex justify-content-center">
            <input type="text" name="query" class="form-control search-input" placeholder="Search here..." aria-label="Search">
            <button class="btn search-button" type="submit">Search</button>
        </form>
    </div>

    @foreach ($images as $image)
    <section class="parallax-image" style="background-image: url('{{ asset($image) }}');" data-aos="fade-up" data-aos-duration="1000">
        <div class="overlay">
            <div class="caption">
                <h1 class="display-3">Explore Cinematic Excellence</h1>
                <p>Experience stunning visuals and connect with creative talents.</p>
                <a href="#" class="btn btn-primary">Learn More</a>
            </div>
        </div>
    </section>
    @endforeach

</div>
@endsection
