@props([
    'siteName' => setting('site_name', 'TKUnity'),
    'logoUrl' => setting_url('logo_light') ?? setting_url('site_logo') ?? asset('images/tkunity_white.webp'),
])

@php
    $logoInitials = site_initials();
    $currentYear = date('Y');

    // Safe route helpers
    $careersRoute = \Route::has('careers') ? route('careers') : '#';
    $helpRoute = \Route::has('help') ? route('help') : '#';
    $termsRoute = \Route::has('terms') ? route('terms') : '#';
    $privacyRoute = \Route::has('privacy') ? route('privacy') : '#';
@endphp

<footer class="site-footer">
    <div class="footer-top">
        <div class="footer-brand">
            <a href="{{ route('home') }}" class="logo">
                @if ($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $siteName ?: 'Site Logo' }}" class="logo-img">
                @else
                    <div class="logo-icon">{{ $logoInitials }}</div>
                    <div class="logo-text">{{ strtoupper($siteName) }}</div>
                @endif
            </a>
        </div>
        <div class="footer-column">
            <h4>Platform</h4>
            <a href="{{ route('home') }}#games">Games</a>
            <a href="#">Top Up</a>
        </div>
        <div class="footer-column">
            <h4>Company</h4>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ $careersRoute }}">Careers</a>
            <a href="{{ route('contact') }}">Contact</a>
        </div>
        <div class="footer-column">
            <h4>Community</h4>
            <a href="#">Instagram</a>
        </div>
        <div class="footer-column">
            <h4>Support</h4>
            <a href="{{ $helpRoute }}">Help Center</a>
            <a href="{{ $termsRoute }}">Terms</a>
            <a href="{{ $privacyRoute }}">Privacy</a>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-logo">
            <span>{{ strtoupper($siteName) }}</span>
        </div>
        <div class="footer-legal">
            <span>© {{ $currentYear }} {{ $siteName }}. All rights reserved.</span>
            <a href="{{ $privacyRoute }}">Privacy Policy</a>
            <a href="{{ $termsRoute }}">Terms of Service</a>
        </div>
    </div>
</footer>
