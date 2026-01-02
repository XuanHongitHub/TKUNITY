@extends('layouts.app')

@section('title', 'AI Personal Trainer - TK Unity')
@section('header_class', 'header-solid')

@section('content')
    <section class="ai-hero">
        <div class="container">
            <div class="ai-hero-grid">
                <div class="ai-hero-content">
                    <div class="ai-badge">
                        <span class="ai-badge-dot"></span>
                        <span>Next Gen Health Tech</span>
                    </div>
                    <h1 class="ai-hero-title">Smart Fitness <span class="accent-green">Intelligence</span></h1>
                    <p class="ai-hero-desc">
                        We are building the future of personal well-being by combining Computer Vision with professional
                        fitness coaching.
                    </p>
                    <a href="#features" class="btn-green">Explore Technology</a>
                </div>
                <div class="ai-hero-visual">
                    <div class="ai-visual-frame">
                        <img src="{{ asset('images/pages/ai-page.png') }}" alt="AI Fitness Analysis">
                        <div class="ai-hud-tag">CV_TRACKING: ACTIVE</div>
                        <div class="ai-hud-status">
                            <div class="ai-hud-icon">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <div class="ai-hud-title">Form Correct</div>
                                <div class="ai-hud-subtitle">Analysis Complete</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ai-features" id="features">
        <div class="container">
            <div class="section-header">
                <span class="section-label section-label-green">Core Features</span>
                <h2 class="section-title">Technology for Better Health</h2>
            </div>

            <div class="ai-features-grid">
                <div class="ai-feature-card">
                    <div class="ai-feature-number">01</div>
                    <h3 class="ai-feature-title">Real-Time Correction</h3>
                    <p class="ai-feature-desc">AI analyzes your movements instantly to ensure perfect form and prevent
                        injury.</p>
                </div>
                <div class="ai-feature-card">
                    <div class="ai-feature-number">02</div>
                    <h3 class="ai-feature-title">Personalized Plans</h3>
                    <p class="ai-feature-desc">Dynamic workout plans that adapt to your progress and energy levels
                        daily.</p>
                </div>
                <div class="ai-feature-card">
                    <div class="ai-feature-number">03</div>
                    <h3 class="ai-feature-title">Progress Tracking</h3>
                    <p class="ai-feature-desc">Comprehensive analytics to visualize your journey and celebrate
                        milestones.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="ai-tech">
        <div class="container">
            <div class="ai-tech-grid">
                <div class="ai-tech-content">
                    <span class="section-label section-label-green">Powered By</span>
                    <h2 class="focus-title">Computer Vision <span class="accent-green">AI</span></h2>
                    <p class="ai-tech-text">
                        Our proprietary AI uses advanced pose estimation and biomechanical analysis to provide real-time
                        feedback that was previously only available to professional athletes.
                    </p>
                    <div class="ai-tech-features">
                        <div class="ai-tech-feature">
                            <span class="ai-tech-marker"></span>
                            <span>Skeleton Tracking</span>
                        </div>
                        <div class="ai-tech-feature">
                            <span class="ai-tech-marker"></span>
                            <span>Joint Angle Analysis</span>
                        </div>
                        <div class="ai-tech-feature">
                            <span class="ai-tech-marker"></span>
                            <span>Rep Counting & Tempo</span>
                        </div>
                        <div class="ai-tech-feature">
                            <span class="ai-tech-marker"></span>
                            <span>Injury Prevention Alerts</span>
                        </div>
                    </div>
                </div>
                <div class="ai-tech-visual">
                    <img src="{{ asset('images/pages/ai-skeleton.png') }}" alt="AI Skeleton Tracking">
                </div>
            </div>
        </div>
    </section>

    <section class="cta cta-green">
        <div class="cta-bg cta-bg-green"></div>
        <div class="container">
            <div class="cta-inner">
                <h2 class="cta-title">Ready to Transform Your Fitness?</h2>
                <p class="cta-desc">Join the waitlist for early access to our AI Personal Trainer platform.</p>
                <div class="cta-actions">
                    <a href="{{ route('contact') }}" class="btn-white">Get Early Access</a>
                    <a href="{{ route('about') }}" class="btn-outline-white">Learn More</a>
                </div>
            </div>
        </div>
    </section>
@endsection
