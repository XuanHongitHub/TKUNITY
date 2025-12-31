@php   
   $heroBannerUrl = setting_url('hero_banner', 'images/home/super_hero_bg.webp');
    $logoUrl = setting_url('site_logo') ?? asset('images/tkunity_red.webp');
@endphp

<nav class="landing-nav">
    <style>
        /* Critical CSS for Landing Header */
        .landing-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 105;
            padding: 0 3rem;
            height: 80px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: transparent;
            backdrop-filter: none;
            -webkit-backdrop-filter: none;
            border-bottom: 1px solid transparent;
            transition: all 0.3s ease;
        }

        .landing-nav::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(90deg, transparent 0%, var(--accent) 50%, transparent 100%);
            opacity: 0;
            box-shadow: 0 0 10px var(--accent);
            transition: opacity 0.3s ease;
        }
        .landing-nav.nav-scrolled::after {
            opacity: 0.5;
        }

        .landing-nav.nav-scrolled {
            background: rgba(8, 8, 8, 0.95);
            border-bottom-color: rgba(255, 255, 255, 0.08);
        }

        .landing-nav .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
            z-index: 1;
        }

        .landing-nav .logo-img {
            height: 32px;
            width: auto;
            display: block;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .landing-nav .logo:hover .logo-img {
            transform: scale(1.05);
        }

        .landing-nav .logo-arrow {
            width: 16px;
            height: 16px;
            color: #dc2626; /* Match red logo */
            transition: transform 0.3s ease;
        }

        .landing-nav .nav-links {
            display: flex;
            gap: 0;
            list-style: none;
            position: relative;
            margin: 0 auto;
            z-index: 106;
        }

        .landing-nav .nav-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-size: 0.8125rem;
            font-weight: 700;
            transition: all 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            position: relative;
            padding: 8px 16px;
            display: block;
            margin: 0 2px;
            transform: skewX(-15deg);
        }

        .landing-nav .nav-links a span {
            display: block;
            transform: skewX(15deg);
        }

        .landing-nav .nav-links a::before {
            display: none;
        }

        .landing-nav .nav-links a:hover {
            color: white;
            background: var(--accent);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 20px var(--accent-glow);
        }

        .landing-nav .nav-right {
            position: relative;
            z-index: 106;
        }

        .landing-nav .logo-wrapper {
            position: relative;
            z-index: 106;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
        }

        .landing-nav .logo-arrow {
            width: 16px;
            height: 16px;
            color: #dc2626; /* Match red logo */
            transition: transform 0.3s ease;
        }

        .landing-nav .logo-wrapper:hover .logo-arrow {
            color: var(--accent);
        }

        .landing-nav .logo-wrapper.active .logo-arrow {
            transform: rotate(180deg);
            color: #dc2626;
        }

        .landing-nav .mega-menu {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: auto;
            min-height: 480px;
            background: #fff;
            z-index: 101;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-20px);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            padding-top: 80px;
            pointer-events: none;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .landing-nav .mega-menu.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
            pointer-events: auto;
        }

        .landing-nav .mega-menu-content {
            display: grid;
            grid-template-columns: repeat(4, 1fr) 320px;
            gap: 1.5rem;
            padding: 2.5rem 4rem 3.5rem;
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
        }

        .landing-nav .mega-menu-category h4 {
            font-size: 0.8rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #000;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .landing-nav .mega-menu-category ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .landing-nav .mega-menu-category li {
            margin-bottom: 0.25rem;
        }

        .landing-nav .mega-menu-category a {
            color: #555;
            text-decoration: none;
            font-size: 0.9375rem;
            font-weight: 400;
            display: block;
            padding: 6px 12px;
            margin-left: -12px;
            border-radius: 6px;
            transition: all 0.2s ease;
            position: relative;
        }

        .landing-nav .mega-menu-category a:hover {
            color: var(--accent);
            background: rgba(220, 38, 38, 0.05);
            padding-left: 18px;
        }

        .landing-nav .mega-menu-image-col {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            aspect-ratio: 16/9;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .landing-nav .mega-feat-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .landing-nav .mega-menu-image-col:hover .mega-feat-img {
            transform: scale(1.05);
        }

        .landing-nav .mega-feat-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1.5rem;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
            color: white;
            pointer-events: none;
        }

        .landing-nav .mega-feat-content h5 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
            text-transform: uppercase;
        }

        .landing-nav .mega-feat-content p {
            font-size: 0.875rem;
            opacity: 0.9;
        }

        .menu-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            z-index: 80;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
        }

        .menu-backdrop.active {
            opacity: 1;
            visibility: visible;
        }

        body.nav-open .landing-nav .logo-img {
            filter: brightness(0);
        }

        body.nav-open .landing-nav .nav-links a {
            color: #111;
        }

        body.nav-open .landing-nav .nav-links a:hover {
            background: rgba(0, 0, 0, 0.05);
            color: var(--accent);
        }

        body.nav-open .landing-nav .logo-arrow {
            color: #111;
        }

        body.nav-open .landing-nav .nav-globe {
            color: #111;
        }

        body.nav-open .landing-nav .nav-globe:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        body.nav-open .landing-nav .nav-search {
            background: rgba(0, 0, 0, 0.05);
            border-color: rgba(0, 0, 0, 0.1);
        }

        body.nav-open .landing-nav .nav-search input {
            color: #111;
        }

        body.nav-open .landing-nav .nav-search input::placeholder {
            color: #666;
        }

        body.nav-open .landing-nav .nav-search svg {
            color: #444;
        }
    </style>

    <div class="logo-wrapper" id="logoWrapper" style="cursor: pointer;">
        <div class="logo">
            @if (isset($logoUrl) && $logoUrl)
                <img src="{{ $logoUrl }}" alt="{{ $siteName ?? 'TKUnity' }}" class="logo-img">
            @else
                <span class="logo-text" style="color: #dc2626; font-weight: 700;">{{ $logoText ?? 'TKUnity' }}</span>
            @endif
        </div>
        <svg class="logo-arrow" viewBox="0 0 24 24" fill="currentColor" stroke="none">
            <path d="M7 10l5 5 5-5z" />
        </svg>
    </div>
    <ul class="nav-links">
        @if(isset($items))
            @foreach ($items as $item)
                <li>
                    <a href="{{ $item['url'] }}" target="{{ $item['target'] }}" class="{{ $item['active'] ? 'active' : '' }}">
                        <span>{{ $item['label'] ?? '' }}</span>
                    </a>
                </li>
            @endforeach
        @endif
    </ul>
    <div class="nav-right">
        <a href="{{ route('login') }}" class="btn btn-accent">Sign In</a>
    </div>

    <!-- Mega Menu Dropdown -->
    <div class="mega-menu" id="megaMenu">
        <div class="mega-menu-content">
            @if(isset($items))
                @foreach($items as $item)
                    {{-- Only process items that are Mega Menus --}}
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
                                                    $linkImage = !empty($link['image']) ? asset($link['image']) : asset('images/home/super_hero_bg.webp');
                                                    $linkPath = parse_url($linkImage, PHP_URL_PATH);
                                                    if (!file_exists(public_path(urldecode($linkPath)))) {
                                                        $linkPath = '/images/home/super_hero_bg.webp';
                                                    }
                                                @endphp
                                                <a href="{{ $link['url'] ?? '#' }}" 
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

                        {{-- Render Featured Spotlight (First one found takes precedence for layout) --}}
                        @if(!empty($item['featured_image']))
                            <div class="mega-menu-image-col">
                                @php
                                    $featImageUrl = asset($item['featured_image']);
                                    $featImagePath = parse_url($featImageUrl, PHP_URL_PATH);
                                    if (!file_exists(public_path(urldecode($featImagePath)))) {
                                        $featImagePath = '/images/home/super_hero_bg.webp';
                                    }
                                @endphp
                                <img src="{{ $featImagePath }}" alt="{{ $item['featured_title'] ?? 'Featured' }}" class="mega-feat-img">
                                <div class="mega-feat-content">
                                    <h5>{{ $item['featured_title'] ?? '' }}</h5>
                                    <p>{{ $item['featured_description'] ?? '' }}</p>
                                </div>
                            </div>
                        @else
                            {{-- Fallback or empty placeholder if layout requires it --}}
                            <div class="mega-menu-image-col" style="display:none;"></div>
                        @endif

                    @endif
                @endforeach
            @endif
        </div>
    </div>
    <div class="menu-backdrop"></div>

    <script>
        function initLandingHeader() {
            const logoWrapper = document.getElementById('logoWrapper');
            const megaMenu = document.getElementById('megaMenu');

            let backdrop = document.querySelector('.menu-backdrop');
            if (!backdrop) {
                backdrop = document.createElement('div');
                backdrop.className = 'menu-backdrop';
                document.body.appendChild(backdrop);
            }

            let clickLocked = false;

            function toggleMenu(forceClose = false) {
                if (!megaMenu || !logoWrapper) return;

                const isActive = megaMenu.classList.contains('active');

                if (isActive || forceClose) {
                    megaMenu.classList.remove('active');
                    logoWrapper.classList.remove('active');
                    backdrop.classList.remove('active');
                    document.body.classList.remove('nav-open');
                } else {
                    if (clickLocked) return;
                    megaMenu.classList.add('active');
                    logoWrapper.classList.add('active');
                    backdrop.classList.add('active');
                    document.body.classList.add('nav-open');
                }
            }

            if (logoWrapper) {
                logoWrapper.onclick = (e) => {
                    const isOpen = megaMenu.classList.contains('active');
                    toggleMenu(isOpen); // toggleMenu(true) closes, toggleMenu(false) opens
                    
                    clickLocked = true;
                    setTimeout(() => { clickLocked = false; }, 300);
                };
            }

            document.addEventListener('click', (e) => {
                if (logoWrapper && megaMenu && !logoWrapper.contains(e.target) && !megaMenu.contains(e.target)) {
                    toggleMenu(true);
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    toggleMenu(true);
                }
            });

            const nav = document.querySelector('nav');
            if (nav) {
                window.addEventListener('scroll', () => {
                    if (window.scrollY > 50) {
                        nav.classList.add('nav-scrolled');
                    } else {
                        nav.classList.remove('nav-scrolled');
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

                        if (!newImage) return;

                        megaImg.style.opacity = '0.8';
                        setTimeout(() => {
                            megaImg.src = newImage;
                            megaImg.style.opacity = '1';
                        }, 150);

                        if (megaTitle) megaTitle.textContent = newTitle;
                        if (megaDesc) megaDesc.textContent = newCaption;
                    });
                });
            }
        }

        document.addEventListener('DOMContentLoaded', initLandingHeader);
        document.addEventListener('livewire:navigated', initLandingHeader);
    </script>
</nav>
