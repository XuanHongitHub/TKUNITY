@extends('layouts.app')

@section('title', 'TK Unity - Next Gen Game Development & AI')
@section('meta_description', 'TK UNITY - Premier game development studio and AI solutions provider based in Da Nang, Vietnam.')

@section('content')
    <section class="hero">
        <div class="hero-bg">
            <img src="{{ setting_url('home_hero_bg') ?: asset('images/home/hero.png') }}"
                alt="{{ setting('site_name', 'TK Unity') }}">
        </div>

        <div class="container">
            <div class="hero-content">
                <div class="hero-label">
                    <span>{{ setting('home_hero_label', 'Architecting Virtual Worlds') }}</span>
                </div>

                <h1 class="hero-title">
                    {!! setting('home_hero_title', 'Innovation in <span class="accent">Every Pixel</span>') !!}
                </h1>

                <p class="hero-desc">
                    {{ setting('home_hero_subtitle', 'TK UNITY is a premier software development studio based in Da Nang. We fuse high-performance Unity game development with advanced AI solutions to create immersive digital experiences.') }}
                </p>

                <div class="hero-actions">
                    <a href="{{ setting('home_hero_cta_url', route('games')) }}"
                        class="btn-primary">{{ setting('home_hero_cta_text', 'Explore Games') }}</a>
                    <a href="{{ setting('home_hero_cta2_url', route('ai-trainer')) }}"
                        class="btn-secondary">{{ setting('home_hero_cta2_text', 'AI Solutions') }}</a>
                </div>
            </div>
        </div>
    </section>

    <section class="pillars">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Why Choose TK Unity</span>
                <h2 class="section-title">Built on Integrity & Excellence</h2>
            </div>

            <div class="pillars-grid">
                <div class="pillar-item">
                    <div class="pillar-number">01</div>
                    <h3 class="pillar-title">Authentic Solutions</h3>
                    <p class="pillar-desc">
                        We deliver real, verifiable software products. No simulated data, no deceptive practices.
                        Verified operational applications.
                    </p>
                </div>

                <div class="pillar-item">
                    <div class="pillar-number">02</div>
                    <h3 class="pillar-title">Engineering Excellence</h3>
                    <p class="pillar-desc">
                        Codebases following strict industry standards for security and scalability. We prioritize clean
                        architecture and robust performance.
                    </p>
                </div>

                <div class="pillar-item">
                    <div class="pillar-number">03</div>
                    <h3 class="pillar-title">Regulatory Compliance</h3>
                    <p class="pillar-desc">
                        Operating with full transparency. Committed to contributing strictly to the digital economy
                        under government regulations.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="focus">
        <div class="container">
            <div class="focus-grid">
                <div class="focus-visual">
                    <img src="{{ setting_url('home_focus_image') ?: asset('images/home/focus.png') }}"
                        alt="{{ setting('home_focus_title', 'Game Development and AI') }}" class="focus-image">
                    <div class="focus-badge">
                        <div class="focus-badge-label">{{ setting('home_focus_badge_label', 'Core Architecture') }}</div>
                        <div class="focus-badge-text">{{ setting('home_focus_badge_text', 'Dual-Engine Growth') }}</div>
                    </div>
                </div>

                <div class="focus-content">
                    <span class="section-label">{{ setting('home_focus_label', 'Our Focus') }}</span>
                    <h2 class="focus-title">{!! setting('home_focus_title', 'Focused on <span class="accent">Impact</span>') !!}</h2>

                    <p class="focus-intro">
                        {{ setting('home_focus_desc', "We don't chase trends. We build substantial technology that serves a purpose. Our bifurcated focus allows us to specialize deeply in two critical areas of the modern digital landscape.") }}
                    </p>

                    <div class="focus-list">
                        <a href="#games-section" class="focus-item">
                            <div class="focus-icon">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="focus-item-title">Game Development</h4>
                                <p class="focus-item-desc">
                                    Creating immersive experiences with Unity. From concept to deployment, we build
                                    optimized, engaging mobile games that perform across devices.
                                </p>
                            </div>
                        </a>

                        <a href="#ai-section" class="focus-item">
                            <div class="focus-icon focus-icon-green">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="focus-item-title">Artificial Intelligence</h4>
                                <p class="focus-item-desc">
                                    Utilizing advanced algorithms to solve complex problems. Our AI solutions are
                                    designed for accuracy, efficiency, and ethical application.
                                </p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-games" id="games-section">
        <div class="container">
            <div class="home-section-grid">
                <div class="home-section-content">
                    <span class="section-label">Game Development</span>
                    <h2 class="focus-title">{!! setting('home_section_games_title', 'Crafting Digital <span class="accent">Worlds</span>') !!}</h2>
                    <p class="home-section-text">
                        {{ setting('home_section_games_desc', 'We build mobile games that captivate millions. Using Unity\'s powerful engine, our team creates visually stunning, performance-optimized experiences for iOS and Android.') }}
                    </p>

                    <div class="home-features">
                        @foreach (setting('home_section_games_features', []) as $feature)
                            <div class="home-feature">
                                <span class="home-feature-marker"></span>
                                <span>{{ $feature }}</span>
                            </div>
                        @endforeach
                    </div>

                    <a href="{{ route('games') }}" class="btn-primary">View Our Games</a>
                </div>
                <div class="home-section-visual">
                    <img src="{{ setting_url('home_section_games_image') ?: asset('images/home/games.png') }}"
                        alt="{{ setting('home_section_games_title', 'Game Development') }}">
                    <div class="visual-badge">
                        <span class="visual-badge-label">{{ setting('home_section_games_badge_label', 'Engine') }}</span>
                        <span
                            class="visual-badge-text">{{ setting('home_section_games_badge_text', 'Unity') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="home-ai" id="ai-section">
        <div class="container">
            <div class="home-section-grid home-section-grid-reverse">
                <div class="home-section-visual">
                    <img src="{{ setting_url('home_section_ai_image') ?: asset('images/home/ai-trainer.png') }}"
                        alt="{{ setting('home_section_ai_title', 'AI Solutions') }}">
                    <div class="visual-badge visual-badge-green">
                        <span class="visual-badge-label">{{ setting('home_section_ai_badge_label', 'Technology') }}</span>
                        <span
                            class="visual-badge-text">{{ setting('home_section_ai_badge_text', 'Computer Vision') }}</span>
                    </div>
                </div>
                <div class="home-section-content">
                    <span class="section-label section-label-green">Artificial Intelligence</span>
                    <h2 class="focus-title">{!! setting('home_section_ai_title', 'Smart Fitness <span class="accent-green">Technology</span>') !!}</h2>
                    <p class="home-section-text">
                        {{ setting('home_section_ai_desc', 'Our AI Personal Trainer uses advanced pose estimation and biomechanical analysis to provide real-time feedback that was previously only available to professional athletes.') }}
                    </p>

                    <div class="home-features">
                        @foreach (setting('home_section_ai_features', []) as $feature)
                            <div class="home-feature home-feature-green">
                                <span class="home-feature-marker home-feature-marker-green"></span>
                                <span>{{ $feature }}</span>
                            </div>
                        @endforeach
                    </div>

                    <a href="{{ route('ai-trainer') }}" class="btn-green">Explore AI Trainer</a>
                </div>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="cta-bg"></div>
        <div class="container">
            <div class="cta-inner">
                <h2 class="cta-title">{!! setting('home_cta_title', 'Technical Excellence.<br>Verified Integrity.') !!}</h2>
                <p class="cta-desc">
                    {{ setting('home_cta_desc', 'TK Unity adheres to strict industry standards. We provide transparent, high-performance software solutions for enterprise and government partners.') }}
                </p>
                <div class="cta-actions">
                    <a href="{{ setting('home_cta_btn1_url', route('contact')) }}"
                        class="btn-white">{{ setting('home_cta_btn1_text', 'Contact Our Team') }}</a>
                    <a href="{{ setting('home_cta_btn2_url', route('about')) }}"
                        class="btn-outline-white">{{ setting('home_cta_btn2_text', 'About Us') }}</a>
                </div>
            </div>
        </div>
    </section>
@endsection
