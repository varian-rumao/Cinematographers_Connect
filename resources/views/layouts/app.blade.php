<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cinematographer Connect')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
</head>
<body>
    <header>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
    </footer>

    @yield('scripts')
</body>
</html>
