@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery</title>
    <link rel="stylesheet" href="{{ asset('css/gallery.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
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

                @if(Auth::user()->is_admin)
                    <a href="{{ route('gallery.index') }}" class="btn btn-danger">Delete Photos</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn btn-primary">Member Login</a>
            @endauth
        </div>
    </nav>
</header>

<main>
    <div id="app" class="container">
        @foreach($userProfiles as $profile)
            <a href="{{ route('works.show', ['id' => $profile->user->id]) }}">
                <card data-image="{{ asset('storage/' . $profile->profile_picture) }}">
                    <h1 slot="header">{{ $profile->user->name }}</h1>
                    <p slot="content">{{ $profile->bio }}</p>
                </card>
            </a>
        @endforeach
    </div>
</main>

<footer>
    <div class="footer-content">
        <h2>Got a Project in Mind?</h2>
        <a href="{{ route('contact') }}" class="cta-button">Let's Talk</a>
        <div class="social-links">
            <a href="#" aria-label="Dribbble"><i class="fab fa-dribbble"></i><h3>@username</h3></i></a>
            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i><h3>@username</h3></i></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i><h3>@username</h3></i></a>
            <a href="#" aria-label="Behance"><i class="fab fa-behance"></i><h3>@username</h3></i></a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
<script>
    Vue.config.devtools = true;

    Vue.component('card', {
        template: `
            <div class="card-wrap"
                @mousemove="handleMouseMove"
                @mouseenter="handleMouseEnter"
                @mouseleave="handleMouseLeave"
                ref="card">
                <div class="card"
                    :style="cardStyle">
                    <div class="card-bg" :style="[cardBgTransform, cardBgImage]"></div>
                    <div class="card-info">
                        <slot name="header"></slot>
                        <slot name="content"></slot>
                    </div>
                </div>
            </div>`,
        mounted() {
            this.width = this.$refs.card.offsetWidth;
            this.height = this.$refs.card.offsetHeight;
        },
        props: ['dataImage'],
        data: () => ({
            width: 0,
            height: 0,
            mouseX: 0,
            mouseY: 0,
            mouseLeaveDelay: null
        }),
        computed: {
            mousePX() {
                return this.mouseX / this.width;
            },
            mousePY() {
                return this.mouseY / this.height;
            },
            cardStyle() {
                const rX = this.mousePX * 30;
                const rY = this.mousePY * -30;
                return {
                    transform: `rotateY(${rX}deg) rotateX(${rY}deg)`
                };
            },
            cardBgTransform() {
                const tX = this.mousePX * -40;
                const tY = this.mousePY * -40;
                return {
                    transform: `translateX(${tX}px) translateY(${tY}px)`
                }
            },
            cardBgImage() {
                return {
                    backgroundImage: `url(${this.dataImage})`
                }
            }
        },
        methods: {
            handleMouseMove(e) {
                this.mouseX = e.pageX - this.$refs.card.offsetLeft - this.width/2;
                this.mouseY = e.pageY - this.$refs.card.offsetTop - this.height/2;
            },
            handleMouseEnter() {
                clearTimeout(this.mouseLeaveDelay);
            },
            handleMouseLeave() {
                this.mouseLeaveDelay = setTimeout(()=>{
                    this.mouseX = 0;
                    this.mouseY = 0;
                }, 500);
            }
        }
    });

    const app = new Vue({
        el: '#app'
    });
</script>
</body>
@endsection
