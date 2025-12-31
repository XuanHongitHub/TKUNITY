@props([
    'variant' => 'default', // 'landing' or 'default'
    'siteName' => setting('site_name', 'TKUnity'),
    'logoUrl' => setting_url('site_logo') ?? asset('images/tkunity_white.webp'),
])

@php
    $logoInitials = site_initials();
    $logoText = strtoupper($siteName);

    // Safe route helpers
    $gamesRoute = \Route::has('games') ? route('games') : '#games';
    $helpRoute = \Route::has('help') ? route('help') : '#';
    $careersRoute = \Route::has('careers') ? route('careers') : '#';
    $heroBannerUrl = setting_url('hero_banner') ?? asset('images/home/super_hero_bg.png');

    // Active state helpers
    $isNewsPage = request()->routeIs('news.index') || request()->routeIs('news.show');

    // Shared navigation items
    $navItems = [
        ['label' => 'Home', 'url' => route('home'), 'target' => '_self', 'active' => request()->routeIs('home')],
        ['label' => 'Games', 'url' => $gamesRoute, 'target' => '_self', 'active' => false],
        ['label' => 'About', 'url' => route('about'), 'target' => '_self', 'active' => request()->routeIs('about')],
        ['label' => 'News', 'url' => route('news.index'), 'target' => '_self', 'active' => $isNewsPage],
        ['label' => 'Contact', 'url' => route('contact'), 'target' => '_self', 'active' => request()->routeIs('contact')],
    ];
@endphp

    <nav class="site-nav {{ $variant === 'landing' ? 'landing-nav' : 'landing-nav default-nav-overrides' }}">
        <div class="logo-wrapper" id="logoWrapper">
            <a href="{{ route('home') }}" class="logo">
                @if ($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="logo-img">
                @else
                    <span class="logo-text">{{ $logoText }}</span>
                @endif
            </a>
            <svg class="logo-arrow" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                <path d="M7 10l5 5 5-5z" />
            </svg>
        </div>
        <ul class="nav-links">
            @if(isset($items))
                @foreach ($items as $item)
                    @if(empty($item['hidden_from_nav']))
                        <li>
                            <a href="{{ $item['url'] }}" target="{{ $item['target'] }}" class="{{ $item['active'] ? 'active' : '' }}">
                                <span>{{ $item['label'] ?? '' }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            @endif
        </ul>
        <div class="nav-right">
            @auth
                 <a href="{{ route('filament.admin.pages.dashboard') }}" class="btn btn-accent">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-accent">Sign In</a>
            @endauth
        </div>

        <!-- Mega Menu Dropdown -->
        <div class="mega-menu" id="megaMenu">
            <div class="mega-menu-content">
                @if(isset($items))
                    @foreach($items as $item)
                        @if(($item['type'] ?? '') === 'mega_menu' && !($item['hidden'] ?? false))
                            
                            {{-- Render Columns --}}
                            @if(!empty($item['columns']))
                                @foreach($item['columns'] as $column)
                                    <div class="mega-menu-category">
                                        <h4>{{ $column['title'] ?? 'Category' }}</h4>
                                        <ul>
                                            @foreach($column['links'] ?? [] as $link)
                                                <li>
                                                    <a href="{{ $link['url'] ?? '#' }}" 
                                                       data-image="{{ !empty($link['image']) ? asset($link['image']) : ($item['featured_image'] ? asset($item['featured_image']) : '') }}" 
                                                       data-caption="{{ $link['caption'] ?? '' }}">
                                                        {{ $link['label'] ?? 'Link' }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            @endif

                            {{-- Render Featured Spotlight (First one found takes precedence for layout if we only want one right col) --}}
                            @if($loop->first && !empty($item['featured_image']))
                                <div class="mega-menu-image-col">
                                    <img src="{{ !empty($item['featured_image']) ? asset($item['featured_image']) : setting_url('hero_banner', 'images/home/super_hero_bg.png') }}" alt="{{ $item['featured_title'] ?? 'Featured' }}" class="mega-feat-img">
                                    <div class="mega-feat-content">
                                        <h5>{{ $item['featured_title'] ?? '' }}</h5>
                                        <p>{{ $item['featured_description'] ?? '' }}</p>
                                    </div>
                                </div>
                            @endif

                        @endif
                    @endforeach
                @endif
            </div>
        </div>
        <div class="menu-backdrop"></div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const logoWrapper = document.getElementById('logoWrapper');
                const megaMenu = document.getElementById('megaMenu');
                const nav = document.querySelector('.site-nav');
                const isDefaultVariant = nav.classList.contains('default-nav-overrides');

                let backdrop = document.querySelector('.menu-backdrop');
                if (!backdrop) {
                    backdrop = document.createElement('div');
                    backdrop.className = 'menu-backdrop';
                    document.body.appendChild(backdrop);
                }

                function toggleMenu(forceClose = false) {
                    if (!megaMenu || !logoWrapper) return;
                    const isActive = megaMenu.classList.contains('active');

                    if (isActive || forceClose) {
                        megaMenu.classList.remove('active');
                        logoWrapper.classList.remove('active');
                        backdrop.classList.remove('active');
                        document.body.classList.remove('nav-open');
                    } else {
                        megaMenu.classList.add('active');
                        logoWrapper.classList.add('active');
                        backdrop.classList.add('active');
                        document.body.classList.add('nav-open');
                    }
                }

                if (logoWrapper) {
                    logoWrapper.addEventListener('click', (e) => {
                        e.preventDefault();
                        e.stopPropagation();
                        toggleMenu();
                    });
                }

                document.addEventListener('click', (e) => {
                    if (logoWrapper && megaMenu && !logoWrapper.contains(e.target) && !megaMenu.contains(e.target)) {
                        toggleMenu(true);
                    }
                });

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') toggleMenu(true);
                });

                if (nav) {
                    // Initial state handling
                    if (window.scrollY > 50) {
                        nav.classList.add('nav-scrolled');
                        if (isDefaultVariant) {
                            nav.style.background = 'rgba(8, 8, 8, 0.98)';
                            nav.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.3)';
                            nav.style.backdropFilter = 'blur(20px)';
                            nav.style.webkitBackdropFilter = 'blur(20px)';
                        }
                    } else {
                        nav.classList.remove('nav-scrolled');
                        if (isDefaultVariant) {
                            nav.style.background = 'transparent';
                            nav.style.boxShadow = 'none';
                            nav.style.backdropFilter = 'none';
                            nav.style.webkitBackdropFilter = 'none';
                            nav.style.borderBottomColor = 'transparent';
                        }
                    }

                    window.addEventListener('scroll', () => {
                        if (window.scrollY > 50) {
                            nav.classList.add('nav-scrolled');
                            if (isDefaultVariant) {
                                nav.style.background = 'rgba(8, 8, 8, 0.98)';
                                nav.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.3)';
                                nav.style.backdropFilter = 'blur(20px)';
                                nav.style.webkitBackdropFilter = 'blur(20px)';
                            }
                        } else {
                            nav.classList.remove('nav-scrolled');
                            if (isDefaultVariant) {
                                nav.style.background = 'transparent';
                                nav.style.boxShadow = 'none';
                                nav.style.backdropFilter = 'none';
                                nav.style.webkitBackdropFilter = 'none';
                                nav.style.borderBottomColor = 'transparent';
                            }
                        }
                    });
                }

                const megaLinks = document.querySelectorAll('.mega-menu-category a[data-image]');
                const megaImg = document.querySelector('.mega-feat-img');
                const megaTitle = document.querySelector('.mega-feat-content h5');
                const megaDesc = document.querySelector('.mega-feat-content p');

                if (megaLinks.length > 0 && megaImg) {
                    megaLinks.forEach(link => {
                        link.addEventListener('mouseenter', () => {
                            const newImage = link.getAttribute('data-image');
                            const newCaption = link.getAttribute('data-caption');
                            const newTitle = link.textContent;

                            if (newImage) {
                                megaImg.style.opacity = '0.8';
                                setTimeout(() => {
                                    megaImg.src = newImage;
                                    megaImg.style.opacity = '1';
                                }, 150);
                            }

                            if (megaTitle) megaTitle.textContent = newTitle;
                            if (megaDesc) megaDesc.textContent = newCaption;
                        });
                    });
                }
            });
        </script>
    </nav>
