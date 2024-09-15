<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
                
                <!-- User Name -->
                <input type="text" name="name" placeholder="User name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror" required>
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                
                <!-- Email -->
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror" required>
                @error('email')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                
                <!-- Password -->
                <input type="password" name="password" placeholder="Password" class="@error('password') is-invalid @enderror" required>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                
                <!-- Confirm Password -->
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                
                <!-- Submit Button -->
                <button type="submit">Sign up</button>
            </form>
        </div>

        <div class="login">
            <form method="POST" action="{{ route('login') }}">
            @csrf
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button>Login</button>
            </form>
        </div>
    </div>

    <div class="photo-frame">
        <img src="images/4.jpg" alt="Photo">
    </div>

    <!-- Include SweetAlert for pop-ups -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Show success message if registration was successful
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

            // Show warning message for any additional warning (can add conditions)
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
