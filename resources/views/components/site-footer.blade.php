@props([
    'siteName' => setting('site_name', 'TKUnity'),
    'logoUrl' => setting_url('logo_red') ?? setting_url('site_logo') ?? asset('images/tkunity_red.webp'),
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
            <a href="{{ route('home') }}" wire:navigate class="logo" style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none;">
                @if ($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $siteName ?: 'Site Logo' }}" class="logo-img" style="height: 32px; width: auto; display: block;">
                @else
                    <span class="logo-text" style="font-weight: 700; color: #dc2626; font-size: 1.125rem;">{{ strtoupper($siteName) }}</span>
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
            <a href="{{ route('about') }}" wire:navigate>About</a>
            <a href="{{ $careersRoute }}" wire:navigate>Careers</a>
            <a href="{{ route('contact') }}" wire:navigate>Contact</a>
        </div>
        <div class="footer-column">
            <h4>Community</h4>
            @php
                $socialLinks = setting('social_links', []);
            @endphp
            @if(!empty($socialLinks))
                @foreach($socialLinks as $link)
                    @if(!empty($link['url']))
                        <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer">{{ $link['label'] ?? 'Social' }}</a>
                    @endif
                @endforeach
            @else
                <a href="#" target="_blank" rel="noopener noreferrer">Instagram</a>
            @endif
        </div>
        <div class="footer-column">
            <h4>Support</h4>
            <a href="{{ $helpRoute }}" wire:navigate>Help Center</a>
            <a href="{{ $termsRoute }}" wire:navigate>Terms</a>
            <a href="{{ $privacyRoute }}" wire:navigate>Privacy</a>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="footer-bottom-left">
            <img src="{{ asset('images/LOGO_ICON_TKUNITY.webp') }}" alt="{{ $siteName }}" class="footer-logo-icon">
            <span class="copyright">© {{ $currentYear }} {{ $siteName }}. All rights reserved.</span>
        </div>
        <div class="footer-legal">
            <a href="{{ $privacyRoute }}" wire:navigate>Privacy Policy</a>
            <a href="{{ $termsRoute }}" wire:navigate>Terms of Service</a>
        </div>
    </div>
</footer>
