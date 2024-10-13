@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <!-- Display Videos -->
    <h2 class="my-4">Videos</h2>
    <div class="row">
    @foreach($works->where('video_url', '!=', null) as $work)
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card border-0 shadow-sm h-100" data-bs-toggle="modal" data-bs-target="#mediaModal" data-type="video" data-src="{{ asset('storage/' . $work->video_url) }}">
                <video class="card-img-top" style="height: 200px; object-fit: cover;" muted>
                    <source src="{{ asset('storage/' . $work->video_url) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    @endforeach
</div>
<hr>
    <!-- Display Images -->
    <h2 class="my-4">Images</h2>
    <div class="row">
    @foreach($works->where('image_url', '!=', null) as $work)
        <div class="col-md-4 col-sm-6 mb-4">
            <div class="card border-0 shadow-sm h-100" data-bs-toggle="modal" data-bs-target="#mediaModal" data-type="image" data-src="{{ asset('storage/' . $work->image_url) }}">
                <img src="{{ asset('storage/' . $work->image_url) }}" class="card-img-top rounded work-image" alt="Work Image" style="height: 200px; object-fit: cover;">
            </div>
        </div>
    @endforeach
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="mediaModal" tabindex="-1" aria-labelledby="mediaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-body text-center">
        <!-- Dynamic content (image or video) will be inserted here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
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

<!-- JavaScript Section -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var mediaModal = document.getElementById('mediaModal');

        // Event listener when the modal is about to show
        mediaModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;  // Button that triggered the modal
            var mediaType = button.getAttribute('data-type'); // Get media type (image or video)
            var mediaSrc = button.getAttribute('data-src');   // Get the media source

            var modalBody = mediaModal.querySelector('.modal-body');
            modalBody.innerHTML = ''; // Clear previous content

            // Dynamically load media based on the type
            if (mediaType === 'image') {
                var imgElement = document.createElement('img');
                imgElement.src = mediaSrc;
                imgElement.classList.add('img-fluid'); // Make sure it scales well
                modalBody.appendChild(imgElement);
            } else if (mediaType === 'video') {
                var videoElement = document.createElement('video');
                videoElement.src = mediaSrc;
                videoElement.controls = true;  // Enable video controls (play, pause, etc.)
                videoElement.autoplay = true;  // Autoplay the video when modal opens
                videoElement.muted = true;     // Mute video (required for autoplay in most browsers)
                videoElement.classList.add('img-fluid');  // Make sure video scales well
                modalBody.appendChild(videoElement);
            }
        });
    });
</script>
@endsection