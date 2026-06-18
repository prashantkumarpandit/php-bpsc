<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name', 'BPSC Tech Official') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body style="margin: 0; padding: 0;">
    <div class="login-container">
        <div class="login-split-left">
            <div class="login-left-overlay">
                <div class="login-brand-info">
                    <img src="/bpsc-logo-small.png" alt="BPSC Logo" class="login-brand-logo">
                    <h1>Bihar Public Service Commission (Only for BPSC Office Staff and Administration)</h1>
                    <p>Welcome to the Administrative Portal. Secure access for authorized personnel only.</p>
                </div>
            </div>
        </div>

        <div class="login-split-right">
            <div class="login-form-wrapper">

                <div class="login-mobile-header">
                    <img src="/bpsc-logo-small.png" alt="BPSC Logo" class="login-mobile-logo">
                    <h1 class="login-mobile-title">BPSC Portal</h1>
                </div>

                <div class="login-back-home">
                    <a href="{{ route('home') }}">
                        <i data-lucide="chevron-left" size="16"></i>
                        <span>Back to Home</span>
                    </a>
                </div>

                <div class="login-header">
                    <h2>Sign In</h2>
                    <p>Enter your credentials to access the dashboard</p>
                </div>

                @if ($errors->any())
                    <div class="login-alert-error">
                        <span>⚠</span>
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="login-form">
                    @csrf
                    <div class="login-input-group">
                        <label>Email Address</label>
                        <div class="login-input-icon-wrap">
                            <i data-lucide="mail" class="login-input-icon" size="18"></i>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@bpsc.bihar.gov.in" required>
                        </div>
                    </div>

                    <div class="login-input-group">
                        <label>Password</label>
                        <div class="login-input-icon-wrap">
                            <i data-lucide="lock" class="login-input-icon" size="18"></i>
                            <input type="password" name="password" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="login-form-options">
                        <label class="login-remember">
                            <input type="checkbox" name="remember">
                            <span>Remember me</span>
                        </label>
                        <a href="#" class="login-forgot">Forgot Password?</a>
                    </div>

                    <button type="submit" class="login-submit-btn">
                        <span>Secure Login</span>
                        <i data-lucide="chevron-right" size="18"></i>
                    </button>
                </form>

                <div class="login-footer-info">
                    <i data-lucide="shield-check" size="16"></i>
                    <span>Protected by 256-bit encryption.</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
