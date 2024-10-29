@extends('layouts.app')

@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
      <div class="profile-buttons">
    @auth
        <!-- Show Manage Profile only if the user is not an admin -->
        @if(!Auth::user()->is_admin)
            <a href="{{ route('profile.edit', auth()->user()->id) }}" class="btn btn-secondary">Manage Profile</a>
            <a href="{{ route('articles.create') }}" class="btn btn-primary">New Article</a>
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
                    <p>Completely plagiarize intermandated services whereas multifunctional mindshare. Monotonectally mesh low-risk high-yield methods of empowerment after cross-functional testing procedures.</p>
                </div>
                <div class="rule-card">
                    <h3>Team Rule 02</h3>
                    <h4>Strive for Excellence</h4>
                    <p>Monotonectally mesh low-risk high-yield methods of empowerment after cross-functional testing procedures. Completely plagiarize intermandated services whereas multifunctional mindshare.</p>
                </div>
                <div class="rule-card">
                    <h3>Team Rule 03</h3>
                    <h4>Innovate Continuously</h4>
                    <p>Completely plagiarize intermandated services whereas multifunctional mindshare. Monotonectally mesh low-risk high-yield methods of empowerment after cross-functional testing procedures.</p>
                </div>
                <div class="rule-card">
                    <h3>Team Rule 04</h3>
                    <h4>Collaborate as a Team</h4>
                    <p>Completely plagiarize intermandated services whereas multifunctional mindshare. Monotonectally mesh low-risk high-yield methods of empowerment after cross-functional testing procedures.</p>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section class="contact-section">
            <div class="contact-left">
                <h2>Got A Project Or A Partnership In Mind?</h2>
                <p>Holistically leverage user-friendly platforms with progressive products. Proactively matrix exceptional content through B2C schemas. Seamlessly exploit cutting-edge niche markets rather than premium results. Collaboratively restore pandemic e-business and plug-and-play data.</p>
                <div class="contact-info">
                    <p><strong>Phone:</strong> +99 (0)10 407 0888<br> +99 (0)10 407 0888</p>
                    <p><strong>Email:</strong> info@creatives.com<br> contact@creatives.com</p>
                </div>
            </div>
            <div class="contact-form">
            <form method="POST" action="{{ route('save.message') }}" id="contactForm">
                @csrf
                <div class="input-group">
                    <input type="text" name="name" placeholder="Name" required>
                    <input type="email" name="email" placeholder="Email" required>
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
    <!-- Modal Structure -->
<div id="successModal" class="modal">
    <div class="modal-content">
        <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
            <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
            <path class="checkmark__check" fill="none" d="M14 27l7 7 16-16"/>
        </svg>
        <h2>Your message has been sent successfully!</h2>
        <p>We will get back to you soon.</p>
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
    <script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the form data
        var formData = new FormData(this);

        // Send the form data using fetch API
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (response.ok) {
                // Show the modal
                var modal = document.getElementById('successModal');
                modal.style.display = 'block';

                // Clear the form fields
                this.reset();

                // Hide the modal and reload the page after 2 seconds
                setTimeout(() => {
                    modal.style.display = 'none'; // Hide the modal
                    window.location.reload(); // Reload the page
                }, 2000); // Adjust the delay as needed
            } else {
                alert('There was an issue sending your message. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was an error sending your message. Please try again later.');
        });
    });
</script>
</script>>
</body>
</html>
@endsection