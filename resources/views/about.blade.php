@extends('layouts.app')

@section('content')
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="css/about.css">
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
                <li><a href="articles">Articles</a></li>
                <li><a href="contact">Contact Us</a></li>
                <li><a href="gallery">Gallery</a></li>
            </ul>
            <div id="burger" class="burger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="profile-icon">
                @auth
                    <a href="#" class="dropdown-toggle" id="profileDropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                    </a>
                    <div class="dropdown-menu">
                        <ul>
                            <li><a href="{{ route('profile.edit', auth()->user()->id) }}">Manage Profile</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}"><i class="fas fa-user-circle"></i></a>
                @endauth
            </div>
        </nav>
    </header>

    <main>
        <!-- Introduction Section -->
        <section class="intro">
            <h1>We are <span>Here To Share</span> Fovisually Compelling Stories.</h1>
            <hr>
        </section>

        <section class="team-rules">
            <h2>Our Team Rules</h2>
            <h1>Authoritatively seize web readiness. Completely benchmark partnerships.</h1>
            <div class="rules-grid">
                <div class="rule-card">
                    <h3>Team Rule 01</h3>
                    <h4>Love what we do</h4>
                    <p>Completely plagiarize intermandated services whereas multifunctional mindshare. Monotonectally
                        mesh low-risk high-yield methods of empowerment after cross-functional testing procedures.</p>
                </div>
                <div class="rule-card">
                    <h3>Team Rule 02</h3>
                    <h4>Strive for Excellence</h4>
                    <p>Monotonectally mesh low-risk high-yield methods of empowerment after cross-functional testing
                        procedures. Completely plagiarize intermandated services whereas multifunctional mindshare.</p>
                </div>
                <div class="rule-card">
                    <h3>Team Rule 03</h3>
                    <h4>Innovate Continuously</h4>
                    <p>Completely plagiarize intermandated services whereas multifunctional mindshare. Monotonectally
                        mesh low-risk high-yield methods of empowerment after cross-functional testing procedures.</p>
                </div>
                <div class="rule-card">
                    <h3>Team Rule 04</h3>
                    <h4>Collaborate as a Team</h4>
                    <p>Completely plagiarize intermandated services whereas multifunctional mindshare. Monotonectally
                        mesh low-risk high-yield methods of empowerment after cross-functional testing procedures.</p>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact-section">
            <div class="contact-left">
                <h2>Got A Project Or A Partnership In Mind?</h2>
                <p>Holistically leverage user-friendly platforms with progressive products. Proactively matrix
                    exceptional content through B2C schemas. Seamlessly exploit cutting-edge niche markets rather than
                    premium results. Collaboratively restore pandemic e-business and plug-and-play data.</p>
                <div class="contact-info">
                    <p><strong>Phone:</strong> +99 (0)10 407 0888<br> +99 (0)10 407 0888</p>
                    <p><strong>Email:</strong> info@creatives.com<br> contact@creatives.com</p>
                </div>
            </div>
            <div class="contact-form">
                <form method="POST" action="{{ route('save.message') }}">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="name" placeholder="Name" value="{{ auth()->user()->name ?? '' }}"
                            required>
                        <input type="email" name="email" placeholder="Email" value="{{ auth()->user()->email ?? '' }}"
                            required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="title" placeholder="Title">
                    </div>
                    <div class="input-group">
                        <textarea name="message" placeholder="Message"></textarea>
                    </div>
                    <button type="submit">Send</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <h2>Got a Project in Mind?</h2>
            <a href="contact" class="cta-button">Let's Talk</a>
            <div class="social-links">
                <a href="#" aria-label="Dribbble"><i class="fab fa-dribbble">
                        <h3>@username</h3>
                    </i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter">
                        <h3>@username</h3>
                    </i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram">
                        <h3>@username</h3>
                    </i></a>
                <a href="#" aria-label="Behance"><i class="fab fa-behance">
                        <h3>@username</h3>
                    </i></a>
            </div>
        </div>
    </footer>

    <!-- SweetAlert for Popups -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Show success message if submission is successful
            var successMessage = "{{ session('status') }}";
            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: successMessage,
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            // Show error message if form validation fails
            var errorMessage = "{{ $errors->first() }}";
            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: errorMessage,
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            // Show warning message if any warning session exists
            var warningMessage = "{{ session('warning') }}";
            if (warningMessage) {
                Swal.fire({
                    icon: 'warning',
                    title: warningMessage,
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    </script>
</body>
</html>
@endsection
