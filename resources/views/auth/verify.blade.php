@extends('layouts.app')

@section('content')
<div class="verify-container">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card">
                <div class="card-body">
                    <!-- Email sent design using your code -->
                    <div class="tooltip-container">
                        <span class="tooltip">Email sent</span>
                        <span class="text">@</span>
                    </div>

                    <h2>{{ __('Verify Your Email') }}</h2>
                    <p>{{ __('We’ve sent an email to your address to verify your account. The link will expire in 24 hours.') }}</p>
                    <p>{{ __('If you didn’t receive the email, click below to resend it.') }}</p>

                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('Resend Verification Email') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<style>
/* Tooltip styles from your provided code */
.verify-container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    text-align: center;
    flex-direction: column;
}
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    text-align: center;
}
.tooltip-container {
  height: 70px;
  width: 110px;
  border-radius: 5px;
  background-color: #fff;
  background-image: linear-gradient(to left bottom, #f2f5f8, #ecf1f2, #e7eceb, #e3e7e4, #e1e2de);
  border: 1px solid white;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.151);
  position: relative;
  transition: transform 0.3s ease;
  z-index: 1;
}

.tooltip-container::before {
  position: absolute;
  content: "";
  top: -50%;
  clip-path: polygon(50% 0, 0 100%, 100% 100%);
  border-radius: 5px;
  background-color: fff;
  background-image: linear-gradient(to left bottom, #1288ff, #e4eaec, #d8dfde, #cdd3cf, #c5c7c1);
  width: 100%;
  height: 50%;
  transform-style: preserve-3d;
  transform: perspective(1000px) rotateX(-150deg) translateY(-110%);
  transition: transform 0.3s ease;
  z-index: -1;
}

.tooltip-container .text {
  color: rgb(32, 30, 30);
  font-weight: bold;
  font-size: 40px;
}

.tooltip {
  position: absolute;
  top: -20px;
  opacity: 0;
  background: linear-gradient(-90deg, rgba(0, 0, 0, 0.05) 1px, white 1px), linear-gradient(rgba(0, 0, 0, 0.05) 1px, white 1px), linear-gradient(-90deg, rgba(0, 0, 0, 0.04) 1px, white 1px), linear-gradient(rgba(0, 0, 0, 0.04) 1px, white 1px), linear-gradient(white 3px, #f2f2f2 3px, #f2f2f2 78px, white 78px), linear-gradient(-90deg, #aaa 1px, white 1px), linear-gradient(-90deg, white 3px, #f2f2f2 3px, #f2f2f2 78px, white 78px), linear-gradient(#aaa 1px, white 1px), #f2f2f2;
  padding: 5px 10px;
  border: 1px solid rgb(206, 204, 204);
  height: 70px;
  width: 110px;
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition-duration: 0.2s;
  pointer-events: none;
  letter-spacing: 0.5px;
  font-size: 18px;
  font-weight: 600;
  text-shadow: 10px salmon;
}

.tooltip-container:hover {
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

.tooltip-container:hover::before {
  transform: rotateY(0);
  background-image: none;
  background-color: white;
}

.tooltip-container:hover .tooltip {
  top: -90px;
  opacity: 1;
  transition-duration: 0.3s;
}
</style>
@endsection
