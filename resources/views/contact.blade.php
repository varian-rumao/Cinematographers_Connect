@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/contact.css">
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
        <div class="contact-section">
            <div class="map-image">
                <img src="map-image.png" alt="Map">
            </div>
            <div class="contact-form">
                <h1>Got A Project Or A Partnership In Mind?</h1>
                <p>Holistically leverage other's user friendly platforms with progressive products. Proactively matrix exceptional content through B2C schemas. Seamlessly exploit cutting-edge niche markets rather than premium results. Collaboratively restore pandemic e-business and plug-and-play data. Conveniently target exceptional platforms whereas standards compliant data.</p>
                <div class="contact-details">
                    <p><strong>Phone:</strong> +99 (0)10 407 0888<br> +99 (0)10 407 0888</p>
                    <p><strong>Email:</strong> info@creatives.com<br>contact@creatives.com</p>
                </div>
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
        </div>
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
