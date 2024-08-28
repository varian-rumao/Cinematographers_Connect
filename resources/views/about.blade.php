@extends('layouts.app')

@section('content')
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="css/about.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <div class="logo"><img src="logo.png" alt="Logo"></div>
            <ul class="nav-links">
                <li><a href="#">Home</a></li>
                <li><a href="#">Stories</a></li>
                <li><a href="#">Works</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <div class="search-bar">
                <input type="text" placeholder="Search">
                <button type="submit"><i class="fas fa-search"></i></button>
            </div>
        </nav>
    </header>

    <main>
        <!-- Introduction Section -->
        <section class="intro">
            <h1>We are <span>Here To Share</span> Fovisually Compelling Stories.</h1>
            <p>Authoritatively seize web readiness. Completely benchmark partnerships.</p>
        </section>

        <!-- Team Rules Section -->
        <section class="team-rules">
            <h2>Our Team Rules</h2>
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
                    <p><strong>Email:</strong> info@creatives.com<br>contact@creatives.com</p>
                </div>
            </div>
            <div class="contact-form">
                <form>
                    <div class="input-group">
                        <input type="text" placeholder="Name">
                        <input type="email" placeholder="Email">
                    </div>
                    <div class="input-group">
                        <input type="text" placeholder="Title">
                    </div>
                    <div class="input-group">
                        <textarea placeholder="Message"></textarea>
                    </div>
                    <button type="submit">Send</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <h2>Got a Project in Mind? <a href="#">Let's Talk</a></h2>
        <div class="social-links">
            <a href="#">Dribbble @username</a>
            <a href="#">Twitter @username</a>
            <a href="#">Instagram @username</a>
            <a href="#">Behance @username</a>
        </div>
    </footer>
</body>
</html>
@endsection