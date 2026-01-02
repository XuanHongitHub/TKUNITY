@extends('layouts.app')

@section('title', 'Careers - ' . setting('site_name', 'TKUnity'))
@section('header_class', 'header-solid')

@section('head')
<style>

        /* Hero Section */
        .careers-hero {
            position: relative;
            padding: 10rem 4rem 6rem;
            text-align: center;
            overflow: hidden;
            background: linear-gradient(180deg, var(--accent-glow) 0%, var(--bg) 100%);
        }

        .careers-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            left: 50%;
            transform: translateX(-50%);
            width: 800px;
            height: 800px;
            background: radial-gradient(circle, var(--accent) 0%, transparent 60%);
            opacity: 0.1;
            pointer-events: none;
        }

        .careers-hero-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }

        .careers-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(220, 38, 38, 0.15);
            border: 1px solid var(--accent);
            font-size: 0.7rem;
            font-family: 'JetBrains Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--accent);
            margin-bottom: 2rem;
        }

        .careers-tag span {
            width: 6px;
            height: 6px;
            background: var(--success);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }

        .careers-hero h1 {
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 700;
            line-height: 1;
            letter-spacing: -0.03em;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
        }

        .careers-hero h1 span {
            color: var(--accent);
        }

        .careers-hero p {
            font-size: 1.125rem;
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .careers-stats {
            display: flex;
            justify-content: center;
            gap: 4rem;
        }

        .careers-stat {
            text-align: center;
        }

        .stat-number {
            display: block;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--accent);
        }

        .stat-text {
            font-size: 0.8125rem;
            color: var(--text-dim);
            text-transform: uppercase;
            letter-spacing: 0.1em;
        }

        /* Why Work Here */
        .why-section {
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

        .benefits-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .benefit-card {
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem 1.5rem;
            text-align: center;
            transition: all 0.3s;
        }

        .benefit-card:hover {
            border-color: var(--accent);
            transform: translateY(-4px);
        }

        .benefit-icon {
            width: 56px;
            height: 56px;
            background: rgba(220, 38, 38, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            color: var(--accent);
        }

        .benefit-icon svg {
            width: 28px;
            height: 28px;
        }

        .benefit-card h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .benefit-card p {
            font-size: 0.875rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Open Positions */
        .positions-section {
            padding: 6rem 4rem;
            background: var(--bg);
        }

        .positions-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 3rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .positions-header h2 {
            font-size: 2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -0.02em;
        }

        .positions-filters {
            display: flex;
            gap: 0.75rem;
        }

        .filter-btn {
            padding: 0.625rem 1.25rem;
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: 50px;
            color: var(--text-muted);
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.8125rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--accent);
            border-color: var(--accent);
            color: white;
        }

        .positions-list {
            max-width: 1000px;
            margin: 0 auto;
        }

        .position-card {
            background: var(--bg-alt);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 1rem;
            transition: all 0.3s;
            cursor: pointer;
        }

        .position-card:hover {
            border-color: var(--accent);
            transform: translateX(8px);
        }

        .position-card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 2rem;
        }

        .position-info {
            flex: 1;
        }

        .position-info h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .position-meta {
            display: flex;
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .position-meta span {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.8125rem;
            color: var(--text-muted);
        }

        .position-meta svg {
            width: 14px;
            height: 14px;
            color: var(--accent);
        }

        .position-dept {
            padding: 0.375rem 0.75rem;
            background: var(--bg-elevated);
            border-radius: 4px;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--accent);
            white-space: nowrap;
        }

        /* Job Detail Modal */
        .job-modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 200;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
        }

        .job-modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .job-modal-content {
            background: var(--bg-alt);
            border: 1px solid var(--border);
            border-radius: 16px;
            max-width: 700px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }

        .job-modal-header {
            padding: 2rem;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            background: var(--bg-alt);
            z-index: 1;
        }

        .job-modal-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .job-modal-header p {
            color: var(--text-muted);
            font-size: 0.9375rem;
        }

        .job-modal-close {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            width: 40px;
            height: 40px;
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .job-modal-close:hover {
            background: var(--accent);
            border-color: var(--accent);
        }

        .job-modal-body {
            padding: 2rem;
        }

        .job-modal-body h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin-top: 1.5rem;
            margin-bottom: 0.75rem;
        }

        .job-modal-body h3:first-child {
            margin-top: 0;
        }

        .job-modal-body p,
        .job-modal-body li {
            font-size: 0.9375rem;
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 0.5rem;
        }

        .job-modal-body ul {
            margin-left: 1.5rem;
            margin-bottom: 1rem;
        }

        .job-modal-footer {
            padding: 2rem;
            border-top: 1px solid var(--border);
            display: flex;
            gap: 1rem;
        }

        .job-modal-footer .btn {
            flex: 1;
            justify-content: center;
        }

        /* Culture Section */
        .culture-section {
            padding: 6rem 4rem;
            background: var(--bg-alt);
        }

        .culture-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            max-width: 1200px;
            margin: 0 auto;
            align-items: center;
        }

        .culture-content h2 {
            font-size: 2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -0.02em;
            margin-bottom: 1.5rem;
        }

        .culture-content h2 span {
            color: var(--accent);
        }

        .culture-content p {
            font-size: 1rem;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .culture-image {
            aspect-ratio: 4/3;
            background: linear-gradient(135deg, var(--accent-glow) 0%, var(--bg-elevated) 50%, var(--bg-alt) 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8rem;
            font-weight: 900;
            color: var(--accent);
            opacity: 0.2;
        }

        /* Testimonials */
        .testimonials-section {
            padding: 6rem 4rem;
            background: var(--bg);
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .testimonial-card {
            background: var(--bg-alt);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            transition: all 0.3s;
        }

        .testimonial-card:hover {
            border-color: var(--accent);
        }

        .testimonial-text {
            font-size: 0.9375rem;
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 1.5rem;
            font-style: italic;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .author-avatar {
            width: 44px;
            height: 44px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.9375rem;
        }

        .author-info h4 {
            font-size: 0.9375rem;
            font-weight: 600;
        }

        .author-info span {
            font-size: 0.75rem;
            color: var(--text-muted);
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
            .careers-hero,
            .why-section,
            .positions-section,
            .culture-section,
            .testimonials-section,
            .cta-section {
                padding-left: 2rem;
                padding-right: 2rem;
            }

            .benefits-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .testimonials-grid {
                grid-template-columns: 1fr;
            }

            .culture-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }

        @media (max-width: 640px) {
            .careers-hero {
                padding: 8rem 1.5rem 4rem;
            }

            .careers-stats {
                flex-direction: column;
                gap: 1.5rem;
            }

            .benefits-grid {
                grid-template-columns: 1fr;
            }

            .positions-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .position-card-header {
                flex-direction: column;
                gap: 1rem;
            }
        }
</style>
@endsection

@section('content')

    <!-- Hero Section -->
    <section class="careers-hero">
        <div class="careers-hero-content">
            <div class="careers-tag">
                <span></span>
                We're Hiring
            </div>
            <h1>Build the <span>Future</span> of Gaming</h1>
            <p>Join a team of passionate gamers and innovators. We're on a mission to make gaming accessible to everyone.</p>
            <div class="careers-stats">
                <div class="careers-stat">
                    <span class="stat-number">50+</span>
                    <span class="stat-text">Open Roles</span>
                </div>
                <div class="careers-stat">
                    <span class="stat-number">12</span>
                    <span class="stat-text">Locations</span>
                </div>
                <div class="careers-stat">
                    <span class="stat-number">5M+</span>
                    <span class="stat-text">Users Served</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Work Here -->
    <section class="why-section">
        <div class="section-header">
            <h2>Why TKUnity?</h2>
            <p>We believe in creating an environment where everyone can do their best work</p>
        </div>
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <h3>Competitive Pay</h3>
                <p>Top of market salary and equity packages for all employees.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                        <circle cx="8.5" cy="7" r="4"/>
                        <line x1="20" y1="8" x2="20" y2="14"/>
                        <line x1="23" y1="11" x2="17" y2="11"/>
                    </svg>
                </div>
                <h3>Flexible Work</h3>
                <p>Remote-first culture with flexible hours and work-from-anywhere policy.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M18 8h1a4 4 0 0 1 0 8h-1"/>
                        <path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/>
                        <line x1="6" y1="1" x2="6" y2="4"/>
                        <line x1="10" y1="1" x2="10" y2="4"/>
                        <line x1="14" y1="1" x2="14" y2="4"/>
                    </svg>
                </div>
                <h3>Unlimited PTO</h3>
                <p>Take the time you need. We trust you to manage your own schedule.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                        <line x1="8" y1="21" x2="16" y2="21"/>
                        <line x1="12" y1="17" x2="12" y2="21"/>
                    </svg>
                </div>
                <h3>Top Equipment</h3>
                <p>MacBook Pro or equivalent, plus any additional gear you need.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"/>
                    </svg>
                </div>
                <h3>Health & Wellness</h3>
                <p>Comprehensive health, dental, and vision insurance for you and your family.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                    </svg>
                </div>
                <h3>Gaming Perks</h3>
                <p>Free in-game currency and early access to new games on our platform.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
                    </svg>
                </div>
                <h3>Learning Budget</h3>
                <p>Annual budget for courses, books, and conferences to grow your skills.</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <path d="M8 14s1.5 2 4 2 4-2 4-2"/>
                        <line x1="9" y1="9" x2="9.01" y2="9"/>
                        <line x1="15" y1="9" x2="15.01" y2="9"/>
                    </svg>
                </div>
                <h3>Great Culture</h3>
                <p>Regular team events, game nights, and a supportive community.</p>
            </div>
        </div>
    </section>

    <!-- Open Positions -->
    <section class="positions-section">
        <div class="positions-header">
            <h2>Open Positions</h2>
            <div class="positions-filters">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="engineering">Engineering</button>
                <button class="filter-btn" data-filter="design">Design</button>
                <button class="filter-btn" data-filter="marketing">Marketing</button>
                <button class="filter-btn" data-filter="operations">Operations</button>
            </div>
        </div>
        <div class="positions-list">
            <div class="position-card" data-dept="engineering" onclick="openJobModal('senior-frontend')">
                <div class="position-card-header">
                    <div class="position-info">
                        <span class="position-dept">Engineering</span>
                        <h3>Senior Frontend Developer</h3>
                        <div class="position-meta">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                Remote / Ho Chi Minh City
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                Full-time
                            </span>
                        </div>
                    </div>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </div>
            </div>

            <div class="position-card" data-dept="engineering" onclick="openJobModal('senior-backend')">
                <div class="position-card-header">
                    <div class="position-info">
                        <span class="position-dept">Engineering</span>
                        <h3>Senior Backend Developer</h3>
                        <div class="position-meta">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                Remote / Hanoi
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                Full-time
                            </span>
                        </div>
                    </div>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </div>
            </div>

            <div class="position-card" data-dept="engineering" onclick="openJobModal('devops')">
                <div class="position-card-header">
                    <div class="position-info">
                        <span class="position-dept">Engineering</span>
                        <h3>DevOps Engineer</h3>
                        <div class="position-meta">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                Remote
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                Full-time
                            </span>
                        </div>
                    </div>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </div>
            </div>

            <div class="position-card" data-dept="design" onclick="openJobModal('product-designer')">
                <div class="position-card-header">
                    <div class="position-info">
                        <span class="position-dept">Design</span>
                        <h3>Product Designer</h3>
                        <div class="position-meta">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                Ho Chi Minh City
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                Full-time
                            </span>
                        </div>
                    </div>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </div>
            </div>

            <div class="position-card" data-dept="design" onclick="openJobModal('ui-designer')">
                <div class="position-card-header">
                    <div class="position-info">
                        <span class="position-dept">Design</span>
                        <h3>UI/UX Designer</h3>
                        <div class="position-meta">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                Remote
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                Full-time
                            </span>
                        </div>
                    </div>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </div>
            </div>

            <div class="position-card" data-dept="marketing" onclick="openJobModal('growth-manager')">
                <div class="position-card-header">
                    <div class="position-info">
                        <span class="position-dept">Marketing</span>
                        <h3>Growth Marketing Manager</h3>
                        <div class="position-meta">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                Ho Chi Minh City
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                Full-time
                            </span>
                        </div>
                    </div>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </div>
            </div>

            <div class="position-card" data-dept="marketing" onclick="openJobModal('content-writer')">
                <div class="position-card-header">
                    <div class="position-info">
                        <span class="position-dept">Marketing</span>
                        <h3>Content Writer</h3>
                        <div class="position-meta">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                Remote
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                Full-time
                            </span>
                        </div>
                    </div>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </div>
            </div>

            <div class="position-card" data-dept="operations" onclick="openJobModal('customer-support')">
                <div class="position-card-header">
                    <div class="position-info">
                        <span class="position-dept">Operations</span>
                        <h3>Customer Support Lead</h3>
                        <div class="position-meta">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                    <circle cx="12" cy="10" r="3"/>
                                </svg>
                                Da Nang
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/>
                                    <polyline points="12 6 12 12 16 14"/>
                                </svg>
                                Full-time
                            </span>
                        </div>
                    </div>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Culture Section -->
    <section class="culture-section">
        <div class="culture-grid">
            <div class="culture-content">
                <h2>Our <span>Culture</span></h2>
                <p>At TKUnity, we're gamers first and foremost. We understand the gaming community because we are part of it. Our culture is built on transparency, ownership, and a relentless pursuit of excellence.</p>
                <p>We believe in giving our team the autonomy to make decisions and the support they need to grow. Whether you're working from our office or from home, you'll be part of a collaborative team that values your unique perspective.</p>
                <p>From weekly game nights to quarterly hackathons, there's always something exciting happening at TKUnity. Come build the future of gaming with us.</p>
            </div>
            <div class="culture-image">PLAY</div>
        </div>
    </section>

    <!-- Team Testimonials -->
    <section class="testimonials-section">
        <div class="section-header">
            <h2>What the Team Says</h2>
            <p>Hear from people who've built their careers at TKUnity</p>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <p class="testimonial-text">"Joining TKUnity was the best career decision I've made. The team is incredibly supportive and the work is genuinely challenging in the best way possible."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">TH</div>
                    <div class="author-info">
                        <h4>Trần Hùng</h4>
                        <span>Senior Developer, 2 years</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <p class="testimonial-text">"As a gamer, I never thought I'd find a company that aligns so well with my passions. The remote work flexibility lets me balance life and gaming perfectly."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">NL</div>
                    <div class="author-info">
                        <h4>Ngọc Linh</h4>
                        <span>Product Designer, 1 year</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <p class="testimonial-text">"The growth opportunities here are amazing. In just 18 months, I've been promoted twice and worked on projects that impact millions of users."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">MV</div>
                    <div class="author-info">
                        <h4>Minh Việt</h4>
                        <span>Marketing Lead, 1.5 years</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta-section">
        <div class="cta-content">
            <h2>Ready to Join Us?</h2>
            <p>Don't see a role that fits? We're always looking for talented people. Reach out and let's chat.</p>
            <a href="{{ route('contact') }}" wire:navigate class="btn btn-outline">Get in Touch</a>
        </div>
    </section>

    <!-- Job Modal -->
    <div class="job-modal" id="jobModal">
        <div class="job-modal-content">
            <div class="job-modal-close" onclick="closeJobModal()">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </div>
            <div class="job-modal-header">
                <h2 id="modalTitle">Senior Frontend Developer</h2>
                <p id="modalSubtitle">Engineering · Remote / Ho Chi Minh City · Full-time</p>
            </div>
            <div class="job-modal-body">
                <h3>About the Role</h3>
                <p>We're looking for a Senior Frontend Developer to join our growing engineering team. You'll be responsible for building and maintaining our web platform, working closely with our design and product teams.</p>

                <h3>What You'll Do</h3>
                <ul>
                    <li>Build responsive, accessible web interfaces using React and TypeScript</li>
                    <li>Collaborate with designers to implement pixel-perfect UIs</li>
                    <li>Write clean, maintainable code with comprehensive tests</li>
                    <li>Mentor junior developers and conduct code reviews</li>
                    <li>Contribute to technical architecture decisions</li>
                </ul>

                <h3>Requirements</h3>
                <ul>
                    <li>5+ years of professional frontend development experience</li>
                    <li>Deep expertise in React, TypeScript, and modern CSS</li>
                    <li>Experience with state management (Redux, Zustand)</li>
                    <li>Strong understanding of web performance optimization</li>
                    <li>Excellent communication skills in English</li>
                </ul>

                <h3>Bonus Points</h3>
                <ul>
                    <li>Experience with Next.js or similar frameworks</li>
                    <li>Background in gaming or gaming platforms</li>
                    <li>Contributions to open source projects</li>
                </ul>
            </div>
            <div class="job-modal-footer">
                <a href="#" class="btn btn-outline">Save Job</a>
                <a href="#" class="btn btn-accent">Apply Now</a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
// Filter functionality
        const filterBtns = document.querySelectorAll('.filter-btn');
        const positionCards = document.querySelectorAll('.position-card');

        filterBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                filterBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filter = btn.dataset.filter;

                positionCards.forEach(card => {
                    if (filter === 'all' || card.dataset.dept === filter) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Job modal
        function openJobModal(jobId) {
            document.getElementById('jobModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeJobModal() {
            document.getElementById('jobModal').classList.remove('active');
            document.body.style.overflow = '';
        }

        document.getElementById('jobModal').addEventListener('click', (e) => {
            if (e.target.id === 'jobModal') {
                closeJobModal();
            }
        });
</script>
@endsection
