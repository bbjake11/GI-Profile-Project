@extends('layouts.app')

@section('title', 'Login')

@section('social-login-css')
    <link href="{{ mix('css/social-login.css') }}" rel="stylesheet">
    <style>
        .login-container {
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

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            padding: 50px;
            max-width: 480px;
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

        .login-logo {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            display: block;
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }

        .login-title {
            color: #DC143C;
            font-weight: 700;
            font-size: 2.5rem;
            margin-bottom: 10px;
            text-align: center;
        }

        .login-subtitle {
            color: #666;
            text-align: center;
            margin-bottom: 40px;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 25px;
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
            padding: 14px 18px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #DC143C;
            box-shadow: 0 0 0 0.2rem rgba(220, 20, 60, 0.15);
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            z-index: 10;
        }

        .input-group .form-control {
            padding-left: 50px;
        }

        .btn-login {
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

        .btn-login:hover {
            background: linear-gradient(135deg, #B71C1C 0%, #8B0000 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(220, 20, 60, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
        }

        .register-link a {
            color: #DC143C;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #B71C1C;
            text-decoration: underline;
        }

        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }

        .forgot-password a {
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-password a:hover {
            color: #DC143C;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 30px 0;
            color: #999;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }

        .divider span {
            padding: 0 15px;
        }

        .invalid-feedback {
            display: block;
            color: #DC143C;
            font-size: 0.875rem;
            margin-top: 5px;
        }

        .samurai-decoration {
            text-align: center;
            margin-top: 30px;
        }

        .samurai-decoration i {
            color: #DC143C;
            font-size: 2rem;
            margin: 0 10px;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
    </style>
@endsection

@section('content')
<div class="login-container">
    <div class="login-card">
        <img src="{{ asset('assets/logo_red.png') }}" alt="Samurai Travel Logo" class="login-logo">
        <h1 class="login-title">Samurai Travel</h1>
        <p class="login-subtitle">Welcome back! Please login to continue</p>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">
                    <i class="fa-solid fa-envelope"></i>
                    {{ __('Email Address') }}
                </label>
                <div class="input-group">
                    <i class="fa-solid fa-envelope"></i>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus 
                           placeholder="Enter your email">
                </div>
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
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                           name="password" required autocomplete="current-password" 
                           placeholder="Enter your password">
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-login">
                <i class="fa-solid fa-right-to-bracket me-2"></i>
                {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
                <div class="forgot-password">
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif

            <div class="divider">
                <span>OR</span>
            </div>

            <div class="register-link">
                Don't have an account? 
                <a href="{{ route('register') }}">Register here</a>
            </div>

            <div class="samurai-decoration">
                <i class="fa-solid fa-shield-halved"></i>
                <i class="fa-solid fa-map-location-dot"></i>
                <i class="fa-solid fa-shield-halved"></i>
            </div>
        </form>
    </div>
</div>
@endsection
