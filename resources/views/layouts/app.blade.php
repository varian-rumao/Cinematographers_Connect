<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cinematographer Connect')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<nav>
  <div class="profile-icon">
    <a href="#" id="profileDropdownToggle">
      <i class="fas fa-user-circle"></i>
    </a>
    <div id="profileDropdown" class="dropdown-menu">
      <a href="{{ route('profile.edit', auth()->id()) }}" class="dropdown-item">Manage Profile</a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
          <a href="#" class="dropdown-item" onclick="document.getElementById('logout-form').submit();">Logout</a>
      </form>
    </div>
  </div>
</nav>

<!-- Include JavaScript for Dropdown -->
<script>
  document.getElementById('profileDropdownToggle').addEventListener('click', function () {
      var dropdown = document.getElementById('profileDropdown');
      dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
  });
</script>
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
