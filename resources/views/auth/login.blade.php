<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>
<body>
    <div class="main">      
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form method="POST" action="{{ route('register') }}">
            @csrf
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="name" placeholder="User name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                <button type="submit">Sign up</button>
            </form>
        </div>

        <div class="login">
            <form method="POST" action="{{ route('login') }}">
            @csrf
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
                <a href="{{ route('password.request') }}" class="forgot-password">Forgot Your Password?</a>
            </form>
        </div>
    </div>

    <!-- Photo frame (Unchanged) -->
    <div class="photo-frame">
        <img src="images/4.jpg" alt="Photo">
    </div>

    <!-- Include SweetAlert for pop-ups -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Show success message if present
            var successMessage = "{{ session('status') }}";
            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: successMessage,
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            // Show error message if present
            var errorMessage = "{{ $errors->first('email') }}";
            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: errorMessage,
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            // Show warning message if needed (e.g., password reset warning)
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
