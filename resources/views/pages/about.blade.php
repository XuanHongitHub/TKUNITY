@extends('layouts.site')

@section('title', 'About Us - ' . setting('site_name', 'TKUnity'))
@section('nav_variant', 'default')

@section('styles')
<style>
        /* Page Header */
        .page-header {
            position: relative;
            padding: 10rem 4rem 6rem;
            text-align: center;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 60%);
            pointer-events: none;
        }

        .page-header-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }

        .breadcrumb {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
            font-size: 0.8125rem;
            color: var(--text-muted);
        }

        .breadcrumb a {
            color: var(--text-muted);
            text-decoration: none;
            transition: color 0.2s;
        }

        .breadcrumb a:hover {
            color: var(--accent);
        }

        .breadcrumb span {
            color: var(--text-dim);
        }

        .page-header h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            line-height: 1;
            letter-spacing: -0.03em;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
        }

        .page-header h1 span {
            color: var(--accent);
        }

        .page-header p {
            font-size: 1.125rem;
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
        }

        /* About Story Section */
        .story-section {
            padding: 6rem 4rem;
            background: var(--bg-alt);
        }

        .story-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .story-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .story-image {
            position: relative;
            aspect-ratio: 1;
            border-radius: 16px;
            overflow: hidden;
            background: linear-gradient(135deg, var(--accent-glow) 0%, var(--bg-elevated) 50%, var(--bg-alt) 100%);
        }

        .story-image::before {
            content: '2020';
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 6rem;
            font-weight: 900;
            color: var(--accent);
            opacity: 0.3;
        }

        .story-image::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, transparent 50%, var(--accent) 50%);
        }

        .story-content h2 {
            font-size: 2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -0.02em;
            margin-bottom: 1.5rem;
        }

        .story-content h2 span {
            color: var(--accent);
        }

        .story-content p {
            font-size: 1rem;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        .story-stats {
            display: flex;
            gap: 3rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border);
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            display: block;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--accent);
            line-height: 1;
        }

        .stat-label {
            font-size: 0.8125rem;
            color: var(--text-dim);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-top: 0.5rem;
        }

        /* Mission & Vision */
        .mission-section {
            padding: 6rem 4rem;
            background: var(--bg);
        }

        .mission-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .mission-card {
            background: var(--bg-alt);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 3rem 2rem;
            position: relative;
            overflow: hidden;
            transition: all 0.3s;
        }

        .mission-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--accent);
            transform: scaleX(0);
            transition: transform 0.3s;
        }

        .mission-card:hover::before {
            transform: scaleX(1);
        }

        .mission-card:hover {
            border-color: var(--accent);
            transform: translateY(-4px);
        }

        .mission-icon {
            width: 64px;
            height: 64px;
            background: rgba(220, 38, 38, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            color: var(--accent);
        }

        .mission-icon svg {
            width: 32px;
            height: 32px;
        }

        .mission-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -0.02em;
            margin-bottom: 1rem;
        }

        .mission-card p {
            font-size: 0.9375rem;
            color: var(--text-muted);
            line-height: 1.7;
        }

        /* Values Section */
        .values-section {
            padding: 6rem 4rem;
            background: var(--bg-alt);
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-size: 2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -0.02em;
            margin-bottom: 1rem;
        }

        .section-header p {
            font-size: 1rem;
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
        }

        .values-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .value-card {
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: all 0.3s;
        }

        .value-card:hover {
            border-color: var(--accent);
            transform: translateY(-4px);
        }

        .value-number {
            font-family: 'JetBrains Mono', monospace;
            font-size: 3rem;
            font-weight: 900;
            color: transparent;
            -webkit-text-stroke: 2px var(--border);
            line-height: 1;
            margin-bottom: 1rem;
            transition: all 0.3s;
        }

        .value-card:hover .value-number {
            -webkit-text-stroke-color: var(--accent);
            color: var(--accent);
            -webkit-text-fill-color: transparent;
        }

        .value-card h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .value-card p {
            font-size: 0.875rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Team Section */
        .team-section {
            padding: 6rem 4rem;
            background: var(--bg);
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .team-card {
            background: var(--bg-alt);
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .team-card:hover {
            border-color: var(--accent);
            transform: translateY(-4px);
        }

        .team-avatar {
            width: 100%;
            aspect-ratio: 1;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 700;
            color: white;
        }

        .team-info {
            padding: 1.5rem;
            text-align: center;
        }

        .team-info h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .team-role {
            font-size: 0.8125rem;
            color: var(--accent);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 1rem;
        }

        .team-bio {
            font-size: 0.8125rem;
            color: var(--text-muted);
            line-height: 1.5;
        }

        /* Partners Section */
        .partners-section {
            padding: 4rem 4rem;
            background: var(--bg-alt);
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
        }

        .partners-grid {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 4rem;
            flex-wrap: wrap;
        }

        .partner-logo {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-dim);
            text-transform: uppercase;
            letter-spacing: 0.15em;
            opacity: 0.5;
            transition: all 0.3s;
        }

        .partner-logo:hover {
            opacity: 1;
            color: var(--accent);
        }

        /* CTA Section */
        .cta-section {
            padding: 6rem 4rem;
            background: var(--accent);
            text-align: center;
            color: white;
        }

        .cta-content {
            max-width: 600px;
            margin: 0 auto;
        }

        .cta-section h2 {
            font-size: 2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -0.02em;
            margin-bottom: 1rem;
        }

        .cta-section p {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .cta-section .btn-outline {
            border-color: white;
            color: white;
        }

        .cta-section .btn-outline:hover {
            background: white;
            color: var(--accent);
        }


        /* Responsive */
        @media (max-width: 1100px) {
            .page-header,
            .story-section,
            .mission-section,
            .values-section,
            .team-section,
            .partners-section,
            .cta-section {
                padding-left: 2rem;
                padding-right: 2rem;
            }

            .story-grid,
            .mission-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .story-image {
                order: -1;
            }

            .values-grid,
            .team-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .page-header {
                padding: 8rem 1.5rem 4rem;
            }

            .story-section,
            .mission-section,
            .values-section,
            .team-section,
            .partners-section,
            .cta-section {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }

            .values-grid,
            .team-grid {
                grid-template-columns: 1fr;
            }

            .story-stats {
                flex-direction: column;
                gap: 1.5rem;
            }

            .partners-grid {
                gap: 2rem;
            }
        }
</style>
@endsection

@section('content')

    <!-- Page Header -->
    <section class="page-header">
        <div class="page-header-content">
            <div class="breadcrumb">
                <a href="{{ route('home') }}" wire:navigate>Home</a>
                <span>/</span>
                <span>About Us</span>
            </div>
            <h1>Empowering <span>Gamers</span> Worldwide</h1>
            <p>Founded by gamers, for gamers. We're building the future of digital gaming commerce.</p>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="story-container">
            <div class="story-grid">
                <div class="story-image" style="background-image: url('{{ setting_url('about_hero', 'images/home/landing_hero_bg.webp') }}'); background-size: cover; background-position: center;"></div>
                <div class="story-content">
                    <h2>Our <span>Story</span></h2>
                    <p>TKUnity was born from a simple frustration: why should topping up games be complicated, expensive, or slow? In 2020, our founders set out to create something better.</p>
                    <p>What started as a small side project has grown into a platform serving millions of gamers across Southeast Asia. We believe everyone deserves instant access to their favorite games, without the hassle.</p>
                    <p>Today, we're proud to support over 50+ games and counting, with a team of passionate gamers working around the clock to deliver the best possible experience.</p>
                    <div class="story-stats">
                        <div class="stat-item">
                            <span class="stat-number">5M+</span>
                            <span class="stat-label">Users</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">Games</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-number">24/7</span>
                            <span class="stat-label">Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="mission-section">
        <div class="mission-grid">
            <div class="mission-card">
                <div class="mission-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M12 16v-4"/>
                        <path d="M12 8h.01"/>
                    </svg>
                </div>
                <h3>Our Mission</h3>
                <p>To make gaming accessible to everyone by providing instant, secure, and affordable game topup services. We bridge the gap between players and their favorite games.</p>
            </div>
            <div class="mission-card">
                <div class="mission-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 14l5-5-5-5"/>
                        <path d="M4 20v-7a4 4 0 0 1 4-4h12"/>
                    </svg>
                </div>
                <h3>Our Vision</h3>
                <p>To become the leading gaming platform in Southeast Asia, known for trust, speed, and an unmatched user experience. We're building the future of gaming commerce.</p>
            </div>
        </div>
    </section>

    <!-- Values -->
    <section class="values-section">
        <div class="section-header">
            <h2>Our Values</h2>
            <p>The principles that guide everything we do</p>
        </div>
        <div class="values-grid">
            <div class="value-card">
                <span class="value-number">01</span>
                <h3>Speed First</h3>
                <p>We believe in instant gratification. Your credits should arrive immediately, every time.</p>
            </div>
            <div class="value-card">
                <span class="value-number">02</span>
                <h3>Trust & Security</h3>
                <p>Your security is our priority. Bank-grade encryption protects every transaction.</p>
            </div>
            <div class="value-card">
                <span class="value-number">03</span>
                <h3>Community</h3>
                <p>We're gamers too. We understand what matters because we're part of the community.</p>
            </div>
            <div class="value-card">
                <span class="value-number">04</span>
                <h3>Continuous Improvement</h3>
                <p>We never stop improving. Every day is a chance to make things better for our users.</p>
            </div>
        </div>
    </section>

    <!-- Team -->
    <section class="team-section">
        <div class="section-header">
            <h2>Meet the Team</h2>
            <p>The passionate people behind TKUnity</p>
        </div>
        <div class="team-grid">
            <div class="team-card">
                <div class="team-avatar">TH</div>
                <div class="team-info">
                    <h3>CEO & Founder</h3>
                    <span class="team-role">CEO & Founder</span>
                    <p class="team-bio">Former pro gamer turned entrepreneur. 10+ years in gaming industry.</p>
                </div>
            </div>
            <div class="team-card">
                <div class="team-avatar">LM</div>
                <div class="team-info">
                    <h3>CTO</h3>
                    <span class="team-role">CTO</span>
                    <p class="team-bio">Tech visionary ensuring our platform stays fast and secure.</p>
                </div>
            </div>
            <div class="team-card">
                <div class="team-avatar">PN</div>
                <div class="team-info">
                    <h3>Head of Operations</h3>
                    <span class="team-role">Head of Operations</span>
                    <p class="team-bio">Keeping everything running smoothly 24/7.</p>
                </div>
            </div>
            <div class="team-card">
                <div class="team-avatar">VL</div>
                <div class="team-info">
                    <h3>Community Lead</h3>
                    <span class="team-role">Community Lead</span>
                    <p class="team-bio">Your voice within the team. Always listening to our community.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners -->
    <section class="partners-section">
        <div class="partners-grid">
            <span class="partner-logo">Game 1</span>
            <span class="partner-logo">Game 2</span>
            <span class="partner-logo">Game 3</span>
            <span class="partner-logo">Game 4</span>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Join Our Journey</h2>
            <p>We're always looking for talented people who share our passion for gaming.</p>
            <a href="{{ route('contact') }}" wire:navigate class="btn btn-outline">Get in Touch</a>
        </div>
    </section>
@endsection
