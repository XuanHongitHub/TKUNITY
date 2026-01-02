@php   
    $heroBannerUrl = setting_url('hero_banner', 'images/home/hero.png');
    $logoUrl = setting_url('logo_red') ?? setting_url('site_logo') ?? asset('images/tkunity_red.webp');
@endphp

<nav class="landing-nav">


    <div class="logo-wrapper" id="logoWrapper" style="cursor: pointer;">
        <div class="logo">
            @if (isset($logoUrl) && $logoUrl)
                <img src="{{ $logoUrl }}" alt="{{ $siteName ?? 'TKUnity' }}" class="logo-image">
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
                                                    $linkImage = !empty($link['image']) ? asset($link['image']) : asset('images/home/hero.png');
                                                    $linkPath = parse_url($linkImage, PHP_URL_PATH);
                                                    if (!file_exists(public_path(urldecode($linkPath)))) {
                                                        $linkPath = '/images/home/hero.png';
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
                                        $featImagePath = '/images/home/hero.png';
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

</nav>
