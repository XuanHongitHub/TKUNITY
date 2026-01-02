<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', setting('seo_description', setting('site_description', 'TK UNITY - Premier game development studio and AI solutions provider based in Da Nang, Vietnam.')))">
    <meta name="theme-color" content="#E31837">
    <title>@yield('title', setting('seo_title', setting('site_name', 'TK Unity')))</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @if (setting('favicon'))
        <link rel="icon" href="{{ setting_url('favicon') }}">
    @endif

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Oswald:wght@400;500;600;700&family=Source+Sans+3:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @settings('google_tags')
    @if (setting('google_verify'))
        <meta name="google-site-verification" content="{{ setting('google_verify') }}">
    @endif
    @livewireStyles
    @yield('head')
    @settings('site_head')
</head>
<body class="@yield('body_class')">
    @php
        $siteName = setting('site_name', 'TK Unity');
        $siteInitials = site_initials();
        
        // Header Logo (usually colored/red)
        $headerLogoUrl = setting_url('logo_red') ?? setting_url('site_logo') ?? asset('images/tkunity_red.webp');
        
        // Footer Logo (can be different, e.g. 3D or Light version)
        $footerLogoUrl = setting_url('logo_light') ?? setting_url('site_logo') ?? $headerLogoUrl;
    @endphp

    <header class="header @yield('header_class')" id="header">
        <div class="container-wide header-inner">
            <a href="{{ route('home') }}" wire:navigate class="logo">
                @if ($headerLogoUrl)
                    <img src="{{ $headerLogoUrl }}" alt="{{ $siteName }}" class="logo-image">
                @else
                    <div class="logo-icon">{{ $siteInitials }}</div>
                    <span class="logo-text">{{ $siteName }}</span>
                @endif
            </a>

            <nav class="nav">
                <ul class="nav-list">
                    <li><a href="{{ route('home') }}" wire:navigate class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                    <li><a href="{{ route('games') }}" wire:navigate class="nav-link {{ request()->routeIs('games') ? 'active' : '' }}">Games</a></li>
                    <li><a href="{{ route('ai-trainer') }}" wire:navigate class="nav-link {{ request()->routeIs('ai-trainer') ? 'active' : '' }}">AI Trainer</a></li>
                    <li><a href="{{ route('about') }}" wire:navigate class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                </ul>
                <a href="{{ route('contact') }}" wire:navigate class="btn-nav {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            </nav>

            <button class="menu-btn" aria-label="Menu" aria-expanded="false" aria-controls="mobile-nav" data-mobile-toggle>
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </header>

    <div class="mobile-nav-backdrop" data-mobile-close></div>
    <nav class="mobile-nav" id="mobile-nav" aria-label="Mobile" aria-hidden="true">
        <div class="mobile-nav-inner">
            <a href="{{ route('home') }}" wire:navigate class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
            <a href="{{ route('games') }}" wire:navigate class="mobile-nav-link {{ request()->routeIs('games') ? 'active' : '' }}">Games</a>
            <a href="{{ route('ai-trainer') }}" wire:navigate class="mobile-nav-link {{ request()->routeIs('ai-trainer') ? 'active' : '' }}">AI Trainer</a>
            <a href="{{ route('about') }}" wire:navigate class="mobile-nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
        </div>
        <div class="mobile-nav-actions">
            <a href="{{ route('contact') }}" wire:navigate class="btn-nav {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-company">
                    <div class="footer-brand-block">
                        <a href="{{ route('home') }}" wire:navigate class="footer-logo-large">
                            @if ($footerLogoUrl)
                                <img src="{{ $footerLogoUrl }}" alt="{{ $siteName }}" class="footer-logo-image">
                            @else
                                <div class="footer-logo-icon">{{ $siteInitials }}</div>
                                <span class="footer-logo-text">{{ strtoupper($siteName) }}</span>
                            @endif
                        </a>
                        <p class="footer-company-name">{{ strtoupper($siteName) }} COMPANY LIMITED</p>
                    </div>

                    <div class="footer-contact-details">
                        <div class="footer-detail-item">
                            <svg viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ setting('contact_address', 'Lot 01 A3 Nguyen Sinh Sac, Hoa Minh Ward, Lien Chieu District, Da Nang City, Vietnam') }}</span>
                        </div>
                        <div class="footer-detail-item">
                            <svg viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <a href="tel:{{ str_replace(' ', '', setting('contact_phone', '0935 309 099')) }}" wire:navigate>{{ setting('contact_phone', '0935 309 099') }}</a>
                        </div>
                        <div class="footer-detail-item">
                            <svg viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="mailto:{{ setting('contact_email', 'tkunity@support.com') }}" wire:navigate>{{ setting('contact_email', 'tkunity@support.com') }}</a>
                        </div>
                    </div>
                </div>

                <div class="footer-col">
                    <div class="footer-col-header">
                        <span class="footer-col-marker"></span>
                        <h4 class="footer-heading">Products</h4>
                    </div>
                    <ul class="footer-links">
                        <li><a href="{{ route('games') }}" wire:navigate>Mobile Games</a></li>
                        <li><a href="{{ route('ai-trainer') }}" wire:navigate>AI Personal Trainer</a></li>
                        <li><a href="{{ route('game-publishing') }}" wire:navigate>Game Publishing</a></li>
                        <li><a href="{{ route('enterprise-solutions') }}" wire:navigate>Enterprise Solutions</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <div class="footer-col-header">
                        <span class="footer-col-marker"></span>
                        <h4 class="footer-heading">Company</h4>
                    </div>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}" wire:navigate>About Us</a></li>
                        <li><a href="{{ route('news.index') }}" wire:navigate>News & Updates</a></li>
                        <li><a href="{{ route('contact') }}" wire:navigate>Contact</a></li>
                    </ul>
                </div>

                <div class="footer-col">
                    <div class="footer-col-header">
                        <span class="footer-col-marker"></span>
                        <h4 class="footer-heading">Resources</h4>
                    </div>
                    <ul class="footer-links">
                        <li><a href="{{ route('documentation') }}" wire:navigate>Documentation</a></li>
                        <li><a href="{{ route('help') }}" wire:navigate>Help Center</a></li>
                        <li><a href="{{ route('faqs') }}" wire:navigate>FAQs</a></li>
                        <li><a href="{{ route('privacy') }}" wire:navigate>Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}" wire:navigate>Terms of Service</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom">
                <div class="footer-copyright">
                    <div class="footer-copyright-icon">
                        @php
                            $iconValue = setting('logo_icon');
                            if ($iconValue === 'LOGO_ICON_TKUNITY.webp') {
                                $copyrightIcon = asset($iconValue);
                            } else {
                                $copyrightIcon = setting_url('logo_icon') ?? asset('LOGO_ICON_TKUNITY.webp');
                            }
                        @endphp
                        @if ($copyrightIcon)
                            <img src="{{ $copyrightIcon }}" alt="TK Unity" class="copyright-icon-img" style="width: 24px; height: 24px; object-fit: contain;">
                        @else
                             <div class="logo-icon-small">{{ $siteInitials }}</div>
                        @endif
                    </div>
                    <p>2025 TK UNITY COMPANY LIMITED. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
    @yield('scripts')
    @settings('tiktok_pixel')
    @settings('site_footer')
</body>
</html>

