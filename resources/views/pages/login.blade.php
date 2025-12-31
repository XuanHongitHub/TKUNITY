@extends('layouts.site')

@section('title', 'Login - ' . setting('site_name', 'TKUnity'))
@section('nav_variant', 'default')

@section('styles')
<style>
        /* Auth Container */
        .auth-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8rem 2rem 4rem;
            min-height: 100vh;
        }

        .auth-wrapper {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            max-width: 1000px;
            width: 100%;
            align-items: center;
        }

        /* Left Side - Info */
        .auth-info {
            padding: 2rem;
        }

        .auth-info h1 {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            line-height: 1;
            letter-spacing: -0.03em;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
        }

        .auth-info h1 span {
            color: var(--accent);
        }

        .auth-info p {
            font-size: 1.0625rem;
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 2rem;
        }

        .auth-features {
            list-style: none;
        }

        .auth-features li {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
            font-size: 0.9375rem;
            color: var(--text-muted);
        }

        .auth-features li svg {
            width: 20px;
            height: 20px;
            color: var(--success);
            flex-shrink: 0;
        }

        /* Right Side - Form */
        .auth-form-wrapper {
            background: var(--bg-alt);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 3rem;
        }

        .auth-tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
            border-bottom: 1px solid var(--border);
        }

        .auth-tab {
            flex: 1;
            padding: 1rem;
            background: transparent;
            border: none;
            border-bottom: 2px solid transparent;
            color: var(--text-muted);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.9375rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .auth-tab.active {
            color: var(--text);
            border-bottom-color: var(--accent);
        }

        .auth-tab:hover {
            color: var(--text);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .form-group label .required {
            color: var(--accent);
            margin-left: 2px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper svg {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 18px;
            height: 18px;
            color: var(--text-dim);
            pointer-events: none;
        }

        .form-group input {
            width: 100%;
            padding: 0.875rem 1rem 0.875rem 3rem;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.9375rem;
            color: var(--text);
            transition: all 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .form-group input::placeholder {
            color: var(--text-dim);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .remember-me input {
            width: 16px;
            height: 16px;
            accent-color: var(--accent);
        }

        .remember-me label {
            font-size: 0.8125rem;
            color: var(--text-muted);
            margin: 0;
            text-transform: none;
            letter-spacing: normal;
        }

        .forgot-link {
            font-size: 0.8125rem;
            color: var(--accent);
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 8px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            cursor: pointer;
            transition: all 0.3s;
        }

        .submit-btn:hover {
            background: var(--accent-dark);
            box-shadow: 0 0 30px rgba(220, 38, 38, 0.4);
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 2rem 0;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        .divider span {
            padding: 0 1rem;
            font-size: 0.75rem;
            color: var(--text-dim);
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        .social-login {
            display: flex;
            gap: 1rem;
        }

        .social-btn {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.75rem;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.8125rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .social-btn:hover {
            border-color: var(--accent);
            background: var(--bg-elevated);
        }

        .social-btn svg {
            width: 18px;
            height: 18px;
        }

        .social-btn.google svg {
            color: #ea4335;
        }

        /* Form Toggle */
        .form-content {
            display: none;
        }

        .form-content.active {
            display: block;
        }

        .terms-text {
            font-size: 0.75rem;
            color: var(--text-dim);
            text-align: center;
            margin-top: 1.5rem;
        }

        .terms-text a {
            color: var(--accent);
            text-decoration: none;
        }

        .terms-text a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 900px) {
            .auth-wrapper {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .auth-info {
                text-align: center;
                order: 2;
            }

            .auth-features {
                display: inline-block;
                text-align: left;
            }
        }

        @media (max-width: 640px) {
            .auth-container {
                padding: 6rem 1.5rem 2rem;
            }

            .auth-form-wrapper {
                padding: 2rem 1.5rem;
            }

            .auth-info h1 {
                font-size: 1.75rem;
            }
        }
</style>
@endsection

@section('content')
    <div class="auth-container">
        <div class="auth-wrapper">
            <!-- Left Side -->
            <div class="auth-info">
                <h1>Where <span>Gamers</span> Unite</h1>
                <p>Join gamers worldwide. Instant topups, exclusive rewards, and secure payments await.</p>
                <ul class="auth-features">
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                        Instant delivery on all topups
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                        Earn rewards with every purchase
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                        Access exclusive rewards
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                        24/7 customer support
                    </li>
                </ul>
            </div>

            <!-- Right Side - Form -->
            <div class="auth-form-wrapper">
                <div class="auth-tabs">
                    <button class="auth-tab active" onclick="switchTab('login')">Sign In</button>
                    <button class="auth-tab" onclick="switchTab('signup')">Sign Up</button>
                </div>

                <!-- Login Form -->
                <div class="form-content active" id="loginForm">
                    <form onsubmit="handleLogin(event)">
                        <div class="form-group">
                            <label>Email Address <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                                <input type="email" placeholder="Enter your email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Password <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                                <input type="password" placeholder="Enter your password" required>
                            </div>
                        </div>

                        <div class="form-options">
                            <label class="remember-me">
                                <input type="checkbox">
                                <span>Remember me</span>
                            </label>
                            <a href="#" class="forgot-link">Forgot password?</a>
                        </div>

                        <button type="submit" class="submit-btn">Sign In</button>
                    </form>
                </div>

                <!-- Signup Form -->
                <div class="form-content" id="signupForm">
                    <form onsubmit="handleSignup(event)">
                        <div class="form-group">
                            <label>Username <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                                <input type="text" placeholder="Choose a username" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Email Address <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <polyline points="22,6 12,13 2,6"/>
                                </svg>
                                <input type="email" placeholder="Enter your email" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Password <span class="required">*</span></label>
                            <div class="input-wrapper">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                                </svg>
                                <input type="password" placeholder="Create a password" required>
                            </div>
                        </div>

                        <button type="submit" class="submit-btn">Create Account</button>

                        <p class="terms-text">
                            By signing up, you agree to our <a href="{{ route('terms') }}" wire:navigate>Terms of Service</a> and <a href="{{ route('privacy') }}" wire:navigate>Privacy Policy</a>
                        </p>
                    </form>
                </div>

                <div class="divider">
                    <span>Or continue with</span>
                </div>

                <div class="social-login">
                    <button class="social-btn google">
                        <svg viewBox="0 0 24 24">
                            <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        Google
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
function switchTab(tab) {
            const tabs = document.querySelectorAll('.auth-tab');
            const forms = document.querySelectorAll('.form-content');

            tabs.forEach(t => t.classList.remove('active'));
            forms.forEach(f => f.classList.remove('active'));

            if (tab === 'login') {
                tabs[0].classList.add('active');
                document.getElementById('loginForm').classList.add('active');
            } else {
                tabs[1].classList.add('active');
                document.getElementById('signupForm').classList.add('active');
            }
        }

        function handleLogin(e) {
            e.preventDefault();
            alert('Login functionality would be implemented here');
        }

        function handleSignup(e) {
            e.preventDefault();
            alert('Signup functionality would be implemented here');
        }
</script>
@endsection
