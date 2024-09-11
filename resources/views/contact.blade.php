@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/contact.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <header>
    <nav>
      <div class="logo">
          <a href="#"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
      </div>
      <ul class="nav-menu">
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="about">About Us</a></li>
          <li><a href="blogs">Blog</a></li>
          <li><a href="contact">Contact Us</a></li>
          <li><a href="gallery">Gallery</a></li>
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
    
    <main>
        <div class="contact-section">
        <div class="map-container">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d418339.5154594024!2d138.28152309824057!3d-34.999758868294535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ab735c7c526b33f%3A0x4033654628ec640!2sAdelaide%20SA!5e0!3m2!1sen!2sau!4v1724955920346!5m2!1sen!2sau"
            style="border:0; width: 100%; height: 100%; filter: grayscale(100%); border-radius: 20px;" 
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>
    </section>
            <div class="contact-form">
                <h1>Got A Project Or A Partnership In Mind?</h1>
                <p>Holistically leverage other's user friendly platforms with progressive products. Proactively matrix exceptional content through B2C schemas. Seamlessly exploit cutting-edge niche markets rather than premium results. Collaboratively restore pandemic e-business and plug-and-play data. Conveniently target exceptional platforms whereas standards compliant data.</p>
                <div class="contact-details">
                    <p><strong>Phone:</strong> +99 (0)10 407 0888<br> +99 (0)10 407 0888</p>
                    <p><strong>Email:</strong> info@creatives.com<br>contact@creatives.com</p>
                </div>
                <form method="POST" action="{{ route('save.message') }}">
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
        </div>
    </main>
    
    <<footer>
    <div class="footer-content">
        <h2>Got a Project in Mind?</h2>
            <a href="#" class="cta-button">Let's Talk</a>
            <div class="social-links">
                <a href="#" aria-label="Dribbble"><i class="fab fa-dribbble"><h3>@username</h3></i></a>
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"><h3>@username</h3></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"><h3>@username</h3></i></a>
                <a href="#" aria-label="Behance"><i class="fab fa-behance"><h3>@username</h3></i></a>
            </div>
        </div>
    </footer>
</body>
</html>
@endsection
