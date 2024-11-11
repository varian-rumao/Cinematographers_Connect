@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/forgetpassword.css') }}">

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Reset Password</h2>
    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Email Field -->
        <div class="form-group mb-3">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ $email ?? old('email') }}" required autofocus>
        </div>

        <!-- New Password Field with Toggle -->
        <div class="form-group mb-3 position-relative">
            <label for="password">New Password</label>
            <input type="password" id="password" name="password" class="form-control" required>
            <span class="toggle-password" onclick="togglePassword('password')" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;">
                <i class="fas fa-eye" id="password-icon"></i>
            </span>
        </div>

        <!-- Confirm Password Field with Toggle -->
        <div class="form-group mb-3 position-relative">
            <label for="password-confirm">Confirm New Password</label>
            <input type="password" id="password-confirm" name="password_confirmation" class="form-control" required>
            <span class="toggle-password" onclick="togglePassword('password-confirm')" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;">
                <i class="fas fa-eye" id="password-confirm-icon"></i>
            </span>
        </div>

        <!-- Display Errors if Any -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-3">Reset Password</button>
        </div>
    </form>
</div>

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = document.getElementById(fieldId + '-icon');
        
        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

<style>
    /* Style for the eye icon */
    .toggle-password i {
        font-size: 1.2rem;
        color: #888;
    }

    .toggle-password:hover i {
        color: #333;
    }
</style>
@endsection
