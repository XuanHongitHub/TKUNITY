@extends('layouts.app')

@section('title', 'Game Development - TK Unity')
@section('header_class', 'header-solid')

@section('content')
    <section class="page-header">
        <div class="container">
            <div class="page-header-content">
                <span class="section-label">Our Games</span>
                <h1 class="page-title">Mobile Game <span class="accent">Development</span></h1>
                <p class="page-subtitle">Immersive. Performant. Engaging.</p>
            </div>
        </div>
    </section>

    <section class="games-philosophy">
        <div class="container">
            <div class="philosophy-grid">
                <div class="philosophy-content">
                    <span class="section-label">Our Philosophy</span>
                    <h2 class="focus-title">Crafting Digital <span class="accent">Worlds</span></h2>
                    <p class="philosophy-text">
                        At TK Unity, we believe that great games start with a strong foundation. We utilize the Unity
                        engine's advanced rendering pipeline and physics system to create games that feel responsive and
                        look stunning on any device.
                    </p>

                    <div class="checklist">
                        <div class="checklist-item">
                            <div class="check-icon">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="check-title">Performance First</h4>
                                <p class="check-desc">Optimized for low-end and high-end devices alike.</p>
                            </div>
                        </div>
                        <div class="checklist-item">
                            <div class="check-icon">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="check-title">Cross-Platform</h4>
                                <p class="check-desc">Seamless experience on iOS & Android.</p>
                            </div>
                        </div>
                        <div class="checklist-item">
                            <div class="check-icon">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="check-title">Data-Driven Design</h4>
                                <p class="check-desc">Analytics-backed decisions for maximum engagement.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="philosophy-visual">
                    <img src="{{ asset('images/pages/game-page.png') }}" alt="Game Development Process">
                </div>
            </div>
        </div>
    </section>

    <section class="games-expertise">
        <div class="container">
            <div class="expertise-header">
                <div class="line"></div>
                <h2 class="expertise-title">Our Expertise</h2>
                <div class="line"></div>
            </div>

            <div class="expertise-grid">
                <div class="expertise-card">
                    <div class="expertise-number">01</div>
                    <h3 class="expertise-card-title">Casual Games</h3>
                    <p class="expertise-card-desc">Pick-up-and-play experiences designed for mass appeal and quick
                        sessions.</p>
                </div>
                <div class="expertise-card">
                    <div class="expertise-number">02</div>
                    <h3 class="expertise-card-title">Puzzle & Strategy</h3>
                    <p class="expertise-card-desc">Mind-bending challenges that keep players coming back for more.</p>
                </div>
                <div class="expertise-card">
                    <div class="expertise-number">03</div>
                    <h3 class="expertise-card-title">Hyper-Casual</h3>
                    <p class="expertise-card-desc">Minimalist mechanics with maximum fun for broad audiences.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="games-tech">
        <div class="container">
            <div class="tech-grid">
                <div class="tech-visual">
                    <img src="{{ asset('images/pages/unity-tech.png') }}" alt="Unity Engine">
                </div>
                <div class="tech-content">
                    <span class="section-label">Technology</span>
                    <h2 class="focus-title">Built on <span class="accent">Unity</span></h2>
                    <p class="tech-text">
                        Our primary development platform is Unity, empowering us to build high-fidelity graphics,
                        complex physics simulations, and seamless multiplayer experiences.
                    </p>
                    <div class="tech-features">
                        <div class="tech-feature">
                            <span class="tech-feature-icon">▸</span>
                            <span>Advanced Rendering Pipelines</span>
                        </div>
                        <div class="tech-feature">
                            <span class="tech-feature-icon">▸</span>
                            <span>Real-time Physics Engine</span>
                        </div>
                        <div class="tech-feature">
                            <span class="tech-feature-icon">▸</span>
                            <span>Cross-Platform Deployment</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta">
        <div class="cta-bg"></div>
        <div class="container">
            <div class="cta-inner">
                <h2 class="cta-title">Have a Game Idea?</h2>
                <p class="cta-desc">Let's bring your vision to life. Our team is ready to collaborate on your next hit
                    game.</p>
                <div class="cta-actions">
                    <a href="{{ route('contact') }}" class="btn-white">Start a Project</a>
                    <a href="{{ route('about') }}" class="btn-outline-white">Learn About Us</a>
                </div>
            </div>
        </div>
    </section>
@endsection
