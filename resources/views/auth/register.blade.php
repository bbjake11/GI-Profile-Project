@extends('layouts.app')

@section('title', 'Register')

@section('social-login-css')
    <style>
        .register-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, rgba(220, 20, 60, 0.9) 0%, rgba(26, 26, 26, 0.95) 100%),
                        url("https://images.unsplash.com/photo-1492571350019-22de08371fd3?w=1920&q=80");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 40px 20px;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 50px;
            max-width: 600px;
            width: 100%;
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            display: block;
        }

        .register-title {
            color: #DC143C;
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 10px;
            text-align: center;
        }

        .register-subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            color: #333;
            font-weight: 600;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label i {
            color: #DC143C;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 12px 16px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #DC143C;
            box-shadow: 0 0 0 0.2rem rgba(220, 20, 60, 0.15);
        }

        .btn-register {
            background: linear-gradient(135deg, #DC143C 0%, #B71C1C 100%);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-size: 1.1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(220, 20, 60, 0.3);
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #B71C1C 0%, #8B0000 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 20, 60, 0.4);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
        }

        .login-link a {
            color: #DC143C;
            font-weight: 600;
            text-decoration: none;
        }

        .login-link a:hover {
            color: #B71C1C;
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')
<div class="register-container">
    <div class="register-card">
        <img src="{{ asset('assets/logo_red.png') }}" alt="Samurai Travel Logo" class="register-logo">
        <h1 class="register-title">Join Samurai Travel</h1>
        <p class="register-subtitle">Create your account and start planning your Japanese adventure</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="first_name" class="form-label">
                        <i class="fa-solid fa-user"></i>
                        First Name
                    </label>
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" 
                           name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col-md-6 form-group">
                    <label for="last_name" class="form-label">
                        <i class="fa-solid fa-user"></i>
                        Last Name
                    </label>
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" 
                           name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">
                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="fa-solid fa-envelope"></i>
                    {{ __('Email Address') }}
                </label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                       name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">
                    <i class="fa-solid fa-lock"></i>
                    {{ __('Password') }}
                </label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                       name="password" required autocomplete="new-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password-confirm" class="form-label">
                    <i class="fa-solid fa-lock"></i>
                    {{ __('Confirm Password') }}
                </label>
                <input id="password-confirm" type="password" class="form-control" 
                       name="password_confirmation" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-register">
                <i class="fa-solid fa-user-plus me-2"></i>
                {{ __('Register') }}
            </button>

            <div class="login-link">
                Already have an account? 
                <a href="{{ route('login') }}">Login here</a>
            </div>
        </form>
    </div>
</div>
@endsection
