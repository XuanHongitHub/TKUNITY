@props([
    'variant' => 'default', // 'landing' or 'default'
    'siteName' => setting('site_name', 'TKUnity'),
    'logoUrl' => setting_url('site_logo') ?? asset('images/tkunity_red.webp'),
])

@php
    $logoInitials = site_initials();
    $logoText = strtoupper($siteName);

    // Safe route helpers
    $gamesRoute = \Route::has('games') ? route('games') : '#games';
    $helpRoute = \Route::has('help') ? route('help') : '#';
    $careersRoute = \Route::has('careers') ? route('careers') : '#';
    $heroBannerUrl = setting_url('hero_banner') ?? asset('images/home/landing_hero_bg.webp');

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
        <div class="logo-wrapper" id="logoWrapper" style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; height: 100%;">
            <div class="logo" style="display: flex; align-items: center; gap: 0.25rem; text-decoration: none;">
                @if ($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="logo-img" style="height: 32px; width: auto; display: block;">
                @else
                    <span class="logo-text" style="font-weight: 700; color: #dc2626; font-size: 1.125rem;">{{ $logoText }}</span>
                @endif
            </div>
            <svg class="logo-arrow" viewBox="0 0 24 24" fill="currentColor" stroke="none" style="width: 14px; height: 14px; color: #dc2626; transition: transform 0.3s ease;">
                <path d="M7 10l5 5 5-5z" />
            </svg>
        </div>
        <ul class="nav-links">
            @if(isset($items))
                @foreach ($items as $item)
                    @if(empty($item['hidden_from_nav']))
                        <li>
                            <a href="{{ $item['url'] }}" wire:navigate target="{{ $item['target'] }}" class="{{ $item['active'] ? 'active' : '' }}">
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
                <a href="{{ route('login') }}" wire:navigate class="btn btn-accent">Sign In</a>
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
                                                    @php
                                                        $linkImage = !empty($link['image']) ? asset($link['image']) : asset('images/home/landing_hero_bg.webp');
                                                        $linkPath = parse_url($linkImage, PHP_URL_PATH);
                                                        // Check if file exists, if not fall back to placeholder
                                                        if (!file_exists(public_path(urldecode($linkPath)))) {
                                                            $linkPath = '/images/home/landing_hero_bg.webp';
                                                        }
                                                    @endphp
                                                    <a href="{{ $link['url'] ?? '#' }}" wire:navigate
                                                       data-image="{{ $linkPath }}" 
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
                                    @php
                                        $featImageUrl = asset($item['featured_image']);
                                        $featImagePath = parse_url($featImageUrl, PHP_URL_PATH);
                                        if (!file_exists(public_path(urldecode($featImagePath)))) {
                                            $featImagePath = '/images/home/landing_hero_bg.webp';
                                        }
                                    @endphp
                                    <img src="{{ $featImagePath }}" alt="{{ $item['featured_title'] ?? 'Featured' }}" class="mega-feat-img">
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
            function initHeader() {
                const logoWrapper = document.getElementById('logoWrapper');
                const megaMenu = document.getElementById('megaMenu');
                const nav = document.querySelector('.site-nav');
                if (!nav) return;
                const isDefaultVariant = nav.classList.contains('default-nav-overrides');

                let backdrop = document.querySelector('.menu-backdrop');
                if (!backdrop) {
                    backdrop = document.createElement('div');
                    backdrop.className = 'menu-backdrop';
                    document.body.appendChild(backdrop);
                }

                let hoverTimeout;
                const HOVER_DELAY = 150; 
                let clickLocked = false; // Prevent hover from re-opening immediately after click

                function setMenuState(open) {
                    if (!megaMenu || !logoWrapper) return;
                    if (open) {
                        if (clickLocked) return;
                        megaMenu.classList.add('active');
                        logoWrapper.classList.add('active');
                        backdrop.classList.add('active');
                        document.body.classList.add('nav-open');
                    } else {
                        megaMenu.classList.remove('active');
                        logoWrapper.classList.remove('active');
                        backdrop.classList.remove('active');
                        document.body.classList.remove('nav-open');
                    }
                }

                if (logoWrapper) {
                    // Remove any old listener if it existed (though this runs on fresh DOM usually)
                    logoWrapper.onclick = (e) => {
                        e.stopPropagation();
                        if (clickLocked) return;
                        const isOpen = megaMenu.classList.contains('active');
                        setMenuState(!isOpen);
                        
                        clickLocked = true;
                        setTimeout(() => { clickLocked = false; }, 300); 
                    };
                }

                if (megaMenu) {
                    // No more hover listeners for click-based menu
                }

                if (backdrop) {
                    backdrop.addEventListener('click', (e) => {
                        e.stopPropagation();
                        setMenuState(false);
                    });
                }

                document.addEventListener('click', (e) => {
                    const isOpen = megaMenu.classList.contains('active');
                    if (isOpen && !megaMenu.contains(e.target) && !logoWrapper.contains(e.target)) {
                        setMenuState(false);
                    }
                });

                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') setMenuState(false);
                });

                // Initial state handling
                if (window.scrollY > 50) {
                    nav.classList.add('nav-scrolled');
                    if (isDefaultVariant) {
                        nav.style.background = 'rgba(8, 8, 8, 0.4)';
                        nav.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.1)';
                        nav.style.backdropFilter = 'blur(8px)';
                        nav.style.webkitBackdropFilter = 'blur(8px)';
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

                const handleScroll = () => {
                    if (window.scrollY > 50) {
                        nav.classList.add('nav-scrolled');
                        if (isDefaultVariant) {
                            nav.style.background = 'rgba(8, 8, 8, 0.4)';
                            nav.style.boxShadow = '0 4px 30px rgba(0, 0, 0, 0.1)';
                            nav.style.backdropFilter = 'blur(8px)';
                            nav.style.webkitBackdropFilter = 'blur(8px)';
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
                };

                window.addEventListener('scroll', handleScroll);

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
            }

            document.addEventListener('DOMContentLoaded', initHeader);
            document.addEventListener('livewire:navigated', initHeader);
        </script>
    </nav>
