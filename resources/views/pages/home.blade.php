@extends('layouts.site')

@section('nav_variant', 'landing')
@section('title', setting('site_name', 'TKUnity') . ' - Where Gamers Unite')
@section('meta_description', setting('site_description', 'Discover new worlds and compete with players worldwide.'))

@section('styles')
<style>
    /* ============================================
       HOME PAGE SPECIFIC STYLES
       ============================================ */

    /* Hero Section */
    .hero {
        position: relative;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 6rem 2rem 4rem;
        text-align: center;
    }

    .hero-image-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: 0;
        background-repeat: no-repeat;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg,
                rgba(8, 8, 8, 0.6) 0%,
                rgba(8, 8, 8, 0.3) 50%,
                rgba(8, 8, 8, 0.7) 100%);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 680px;
    }

    .hero-logo-3d {
        max-width: 500px;
        width: 100%;
        height: auto;
        margin-bottom: 1.5rem;
        filter: drop-shadow(0 5px 20px rgba(0, 0, 0, 0.4));
    }

    .hero-description {
        font-size: 1rem;
        color: rgba(244, 244, 245, 0.7);
        margin-bottom: 2rem;
        line-height: 1.7;
        max-width: 480px;
        margin-left: auto;
        margin-right: auto;
    }

    .hero-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    /* Marquee */
    .marquee {
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        padding: 1.25rem 0;
        overflow: hidden;
        background: var(--bg-alt);
        position: relative;
        z-index: 2;
    }

    .marquee::before,
    .marquee::after {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 200px;
        z-index: 1;
    }

    .marquee::before {
        left: 0;
        background: linear-gradient(to right, var(--bg-alt), transparent);
    }

    .marquee::after {
        right: 0;
        background: linear-gradient(to left, var(--bg-alt), transparent);
    }

    .marquee-track {
        display: flex;
        animation: scroll 30s linear infinite;
    }

    .marquee-item {
        flex-shrink: 0;
        padding: 0 2.5rem;
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--text-muted);
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .marquee-item::before {
        content: '';
        width: 4px;
        height: 4px;
        background: var(--border-bright);
        border-radius: 50%;
    }

    .marquee-item span {
        color: var(--accent);
    }

    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    /* Section Headers */
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
    }

    .section-header h2 {
        font-size: clamp(1.5rem, 3vw, 2rem);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: -0.02em;
    }

    .view-all {
        color: var(--accent);
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        transition: opacity 0.2s;
    }

    .view-all:hover { opacity: 0.7; }

    /* What's Happening Section */
    .whats-happening { padding: 6rem 4rem; }

    .news-grid {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 2rem;
    }

    .news-featured {
        text-decoration: none;
        color: inherit;
        display: block;
        transition: transform 0.3s;
    }

    .news-featured:hover { transform: translateY(-4px); }

    .news-featured-image {
        position: relative;
        aspect-ratio: 16/9;
        overflow: hidden;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        transition: box-shadow 0.3s;
    }

    .news-featured:hover .news-featured-image {
        box-shadow: 0 8px 30px rgba(220, 38, 38, 0.3);
    }

    .news-featured-image .news-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(220, 38, 38, 0.3) 0%, var(--bg-elevated) 50%, var(--bg-alt) 100%);
        transition: transform 0.5s ease;
    }

    .news-featured:hover .news-placeholder { transform: scale(1.05); }

    .news-featured-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        padding: 0.5rem 1rem;
        background: var(--accent);
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: white;
        border-radius: 4px;
    }

    .news-featured-content h3 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        line-height: 1.3;
        text-transform: uppercase;
        letter-spacing: -0.02em;
    }

    .news-featured-content h3 span { color: var(--accent); }

    .news-featured-content p {
        font-size: 1rem;
        color: var(--text-muted);
        line-height: 1.7;
        margin-bottom: 1rem;
    }

    .news-featured-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        font-size: 0.8125rem;
        color: var(--text-dim);
    }

    .news-featured-meta span { display: flex; align-items: center; gap: 0.375rem; }

    /* Secondary News */
    .news-secondary { display: flex; flex-direction: column; gap: 1.5rem; }

    .news-card-small {
        display: flex;
        gap: 1rem;
        text-decoration: none;
        color: inherit;
        padding: 1rem;
        background: var(--bg-elevated);
        border: 1px solid var(--border);
        border-radius: 8px;
        transition: all 0.3s;
        flex: 1;
    }

    .news-card-small:hover {
        border-color: var(--accent);
        transform: translateX(4px);
    }

    .news-card-small-image {
        width: 120px;
        flex-shrink: 0;
        aspect-ratio: 4/3;
        overflow: hidden;
        border-radius: 6px;
    }

    .news-card-small-image .news-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, var(--bg-alt) 0%, #1a1a1a 100%);
        transition: transform 0.3s;
    }

    .news-card-small:hover .news-placeholder { transform: scale(1.1); }

    .news-card-small-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .news-card-small-category {
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--accent);
        margin-bottom: 0.375rem;
    }

    .news-card-small-content h4 {
        font-size: 0.9375rem;
        font-weight: 600;
        margin-bottom: 0.375rem;
        line-height: 1.4;
    }

    .news-card-small-content p {
        font-size: 0.8125rem;
        color: var(--text-muted);
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-card-small-date {
        font-size: 0.7rem;
        color: var(--text-dim);
        margin-top: auto;
        padding-top: 0.5rem;
    }

    /* Games Section */
    .games-section {
        padding: 6rem 0;
        background: var(--bg-alt);
        overflow: hidden;
        position: relative;
    }

    .games-section::before,
    .games-section::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        height: 200px;
        background: linear-gradient(to bottom, var(--bg) 0%, transparent 100%);
        pointer-events: none;
        z-index: 1;
    }

    .games-section::before { top: 0; }
    .games-section::after {
        bottom: 0;
        background: linear-gradient(to top, var(--bg) 0%, transparent 100%);
    }

    .games-header {
        padding: 0 4rem;
        margin-bottom: 3rem;
        position: relative;
        z-index: 2;
    }

    .games-header-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 2rem;
    }

    .games-header-content h2 {
        font-size: clamp(1.5rem, 3vw, 2rem);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: -0.02em;
    }

    .games-header-content p { color: var(--text-muted); font-size: 0.9375rem; margin-top: 0.5rem; }

    .games-nav { display: flex; gap: 0.75rem; }

    .games-nav-btn {
        width: 48px;
        height: 48px;
        background: var(--bg-elevated);
        border: 1px solid var(--border);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        color: var(--text);
    }

    .games-nav-btn:hover {
        background: var(--accent);
        border-color: var(--accent);
        color: white;
    }

    .games-nav-btn:disabled { opacity: 0.3; cursor: not-allowed; }

    .games-nav-btn svg { width: 20px; height: 20px; }

    .games-slider-wrapper { position: relative; z-index: 2; }

    .games-slider {
        display: flex;
        gap: 1.5rem;
        padding: 0 4rem;
        transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        cursor: grab;
        user-select: none;
    }

    .games-slider.dragging { cursor: grabbing; }

    .games-slider.dragging a { pointer-events: none; }

    .game-card {
        flex-shrink: 0;
        width: 360px;
        text-decoration: none;
        color: inherit;
        position: relative;
    }

    .game-card-inner {
        position: relative;
        transform-style: preserve-3d;
        transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .game-card:hover .game-card-inner { transform: translateY(-12px) rotateX(5deg); }

    .game-card-visual {
        position: relative;
        aspect-ratio: 16/10;
        overflow: hidden;
        border-radius: 16px;
        margin-bottom: 1.25rem;
    }

    .game-card-visual::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, transparent 50%, var(--accent) 50%);
        z-index: 2;
        opacity: 0.9;
    }

    .game-card-visual::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, transparent 0%, transparent 50%, rgba(0, 0, 0, 0.8) 100%);
        z-index: 1;
    }

    .game-card-bg {
        width: 100%;
        height: 100%;
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .game-card:hover .game-card-bg { transform: scale(1.1); }

    .game-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        padding: 0.375rem 0.75rem;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(10px);
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: white;
        border-radius: 4px;
        z-index: 3;
    }

    .game-badge.new { background: var(--accent); }

    .game-badge.hot {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .game-card-content {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 1.5rem;
        z-index: 2;
    }

    .game-card-content h3 {
        font-size: 1.375rem;
        font-weight: 700;
        margin-bottom: 0.375rem;
        text-transform: uppercase;
        letter-spacing: -0.02em;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
    }

    .game-card-content p {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 1rem;
    }

    .game-card-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .game-card-meta span {
        display: flex;
        align-items: center;
        gap: 0.375rem;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: white;
    }

    .game-card-meta svg { width: 14px; height: 14px; color: var(--accent); }

    .game-action-btn {
        position: absolute;
        bottom: 1.5rem;
        right: 1.5rem;
        width: 48px;
        height: 48px;
        background: var(--accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.3s;
        z-index: 3;
    }

    .game-card:hover .game-action-btn { opacity: 1; transform: scale(1); }

    .game-action-btn svg { width: 20px; height: 20px; color: white; }

    .games-progress {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 2rem 4rem 0;
        position: relative;
        z-index: 2;
    }

    .games-progress-bar {
        flex: 1;
        height: 2px;
        background: var(--border);
        border-radius: 1px;
        overflow: hidden;
    }

    .games-progress-fill {
        height: 100%;
        background: var(--accent);
        width: 33%;
        transition: width 0.5s;
    }

    .games-progress-text {
        font-size: 0.8125rem;
        color: var(--text-muted);
        font-family: 'JetBrains Mono', monospace;
    }

    .game-placeholder-text {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        font-size: 0.875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: rgba(255, 255, 255, 0.8);
    }

    /* How It Works Section */
    .how-section {
        min-height: 100vh;
        padding: 4rem;
        background: #0a0a0a;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .how-bg {
        position: absolute;
        inset: 0;
        background:
            radial-gradient(ellipse at 20% 50%, rgba(220, 38, 38, 0.15) 0%, transparent 50%),
            radial-gradient(ellipse at 80% 50%, rgba(220, 38, 38, 0.1) 0%, transparent 50%),
            #0a0a0a;
    }

    .how-noise {
        position: absolute;
        inset: 0;
        opacity: 0.03;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%' height='100%' filter='url(%23noise)'/%3E%3C/svg%3E");
        pointer-events: none;
    }

    .how-giant-nums {
        position: absolute;
        inset: 0;
        pointer-events: none;
    }

    .giant-num {
        position: absolute;
        font-size: 25vw;
        font-weight: 900;
        line-height: 1;
        color: rgba(255, 255, 255, 0.02);
        -webkit-text-stroke: 1px rgba(220, 38, 38, 0.1);
    }

    .giant-num-1 { top: 5%; left: 5%; font-size: 20vw; }
    .giant-num-2 { top: 40%; right: -5%; font-size: 18vw; }
    .giant-num-3 { bottom: 5%; left: 20%; font-size: 15vw; }

    .how-wrapper {
        position: relative;
        z-index: 1;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
    }

    .how-right {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .device-mockups {
        width: 100%;
        max-width: 500px;
        height: auto;
        filter: drop-shadow(0 20px 60px rgba(0, 0, 0, 0.5));
        transition: transform 0.3s ease;
    }

    .mockup-composite:hover { transform: scale(1.02) translateY(-5px); }

    .how-eyebrow {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.4em;
        color: var(--accent);
        margin-bottom: 1rem;
        display: block;
    }

    .how-title {
        font-size: clamp(3rem, 8vw, 6rem);
        font-weight: 900;
        line-height: 0.9;
        text-transform: uppercase;
        margin-bottom: 4rem;
    }

    .how-title-line { display: block; }

    .how-title-accent { color: var(--accent); }

    .how-steps {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 3rem;
        padding: 0 2rem;
    }

    .how-step-item {
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .how-step-item[data-step="1"] { margin-top: 80px; }
    .how-step-item[data-step="3"] { margin-top: 120px; }

    .step-visual { margin-bottom: 1.25rem; }

    .step-circle {
        width: 100px;
        height: 100px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--accent);
        border-radius: 50%;
        background: rgba(220, 38, 38, 0.08);
        transition: all 0.3s ease;
    }

    .how-step-item:hover .step-circle {
        background: rgba(220, 38, 38, 0.15);
        transform: scale(1.05);
    }

    .step-num {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--accent);
    }

    .step-info h3 {
        font-size: 1.5rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }

    .step-info p { font-size: 0.9375rem; color: var(--text-muted); }

    /* Why Choose Us Section */
    .why-choose { padding: 6rem 4rem; background: var(--bg-alt); }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }

    .feature-card {
        background: var(--bg-elevated);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 2rem 1.5rem;
        transition: all 0.3s;
    }

    .feature-card:hover {
        border-color: var(--accent);
        transform: translateY(-4px);
    }

    .feature-icon {
        width: 48px;
        height: 48px;
        background: rgba(220, 38, 38, 0.1);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.25rem;
        color: var(--accent);
    }

    .feature-icon svg { width: 24px; height: 24px; }

    .feature-card h3 {
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .feature-card p {
        font-size: 0.875rem;
        color: var(--text-muted);
        line-height: 1.6;
    }

    /* Testimonials Section */
    .testimonials { padding: 6rem 4rem; background: var(--bg-alt); }

    .testimonials-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    .testimonial-card {
        background: var(--bg-elevated);
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 2rem;
        transition: all 0.3s;
    }

    .testimonial-card:hover { border-color: var(--accent); }

    .testimonial-stars {
        color: var(--gold);
        font-size: 1rem;
        margin-bottom: 1rem;
        letter-spacing: 2px;
    }

    .testimonial-text {
        font-size: 0.9375rem;
        color: var(--text);
        line-height: 1.7;
        margin-bottom: 1.5rem;
        font-style: italic;
    }

    .testimonial-author { display: flex; align-items: center; gap: 0.75rem; }

    .author-avatar {
        width: 40px;
        height: 40px;
        background: var(--accent);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .author-info { display: flex; flex-direction: column; }

    .author-name {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text);
    }

    .author-game { font-size: 0.75rem; color: var(--text-muted); }

    /* FAQ Section */
    .faq-section { padding: 6rem 4rem; background: var(--bg); }

    .faq-list { max-width: 800px; margin: 0 auto; }

    .faq-item { border-bottom: 1px solid var(--border); }

    .faq-question {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem 0;
        background: transparent;
        border: none;
        cursor: pointer;
        text-align: left;
    }

    .faq-question span:first-child {
        font-size: 1rem;
        font-weight: 500;
        color: var(--text);
    }

    .faq-icon {
        font-size: 1.5rem;
        color: var(--accent);
        transition: transform 0.3s;
    }

    .faq-item.active .faq-icon { transform: rotate(45deg); }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease, padding 0.3s ease;
    }

    .faq-item.active .faq-answer {
        max-height: 200px;
        padding-bottom: 1.5rem;
    }

    .faq-answer p {
        font-size: 0.9375rem;
        color: var(--text-muted);
        line-height: 1.7;
    }

    /* Careers Section */
    .careers-section {
        padding: 6rem 4rem;
        background: var(--accent);
        color: white;
        text-align: center;
    }

    .careers-content { max-width: 600px; margin: 0 auto; }

    .careers-tag {
        display: inline-block;
        padding: 0.4rem 1rem;
        background: rgba(255, 255, 255, 0.2);
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-bottom: 1.5rem;
    }

    .careers-content h2 {
        font-size: clamp(1.75rem, 4vw, 2.5rem);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: -0.02em;
        margin-bottom: 1rem;
    }

    .careers-content p { font-size: 1rem; opacity: 0.9; margin-bottom: 2rem; }

    .careers-stats {
        display: flex;
        justify-content: center;
        gap: 4rem;
        margin-bottom: 2rem;
    }

    .careers-stat { text-align: center; }

    .stat-number {
        display: block;
        font-size: 2.5rem;
        font-weight: 700;
    }

    .stat-text {
        font-size: 0.8125rem;
        opacity: 0.8;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .careers-section .btn-outline {
        border-color: white;
        color: white;
    }

    .careers-section .btn-outline:hover {
        background: white;
        color: var(--accent);
    }

    /* Responsive */
    @media (max-width: 1100px) {
        .whats-happening,
        .games-section,
        .careers-section,
        .how-section,
        .why-choose,
        .testimonials,
        .faq-section {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .games-header,
        .games-slider,
        .games-progress {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .news-grid { grid-template-columns: 1fr; }

        .news-secondary { flex-direction: row; gap: 1rem; }

        .news-card-small { flex-direction: column; flex: 1; }

        .news-card-small-image { width: 100%; aspect-ratio: 16/9; }

        .game-card { width: 300px; }

        .how-section { padding: 3rem 2rem; }

        .how-title { font-size: clamp(2.5rem, 6vw, 4rem); margin-bottom: 3rem; }

        .how-wrapper { grid-template-columns: 1fr; gap: 2rem; }

        .how-right { display: none; }

        .how-giant-nums { display: none; }

        .features-grid { grid-template-columns: repeat(2, 1fr); }

        .testimonials-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 640px) {
        .hero { padding: 5rem 1.5rem 3rem; }

        .hero h1 { font-size: 2rem; }

        .hero-actions { flex-direction: column; }

        .whats-happening,
        .games-section,
        .careers-section,
        .how-section,
        .why-choose,
        .testimonials,
        .faq-section {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .games-header,
        .games-slider,
        .games-progress {
            padding-left: 1.5rem;
            padding-right: 1.5rem;
        }

        .news-secondary { flex-direction: column; }

        .news-card-small { flex-direction: row; }

        .news-card-small-image { width: 100px; aspect-ratio: 4/3; }

        .game-card { width: 280px; }

        .games-nav { display: none; }

        .games-progress { display: none; }

        .how-section { padding: 3rem 1.5rem; min-height: auto; }

        .how-steps {
            flex-direction: row;
            justify-content: center;
            gap: 1rem;
            padding: 0;
        }

        .how-step-item { margin-top: 0 !important; flex: 0 0 auto; }

        .step-circle { width: 60px !important; height: 60px !important; }

        .step-num { font-size: 1rem !important; }

        .step-info h3 { font-size: 0.875rem !important; }

        .step-info p { font-size: 0.75rem !important; }

        .features-grid { grid-template-columns: 1fr; }

        .careers-stats { gap: 2rem; }
    }
</style>
@endsection

@section('content')
    <section class="hero">
        <div class="hero-image-bg" style="background-image: url('{{ setting_url('hero_banner', 'images/home/super_hero_bg.png') }}'); background-size: cover; background-position: center;"></div>
        <div class="hero-overlay"></div>

        <div class="hero-content">
            <img src="{{ setting_url('logo_3d', 'images/LOGO_3D.webp') }}" alt="{{ setting('site_name', 'TKUnity') }}" class="hero-logo-3d">
            <p class="hero-description">
                {{ setting('site_description', 'Your gateway to immersive gaming. Discover new worlds and compete with players worldwide.') }}
            </p>
            <div class="hero-actions">
                <a href="#games" class="btn btn-accent">Explore Games</a>
            </div>
        </div>
    </section>

    <!-- What's Happening Section -->
    <section class="whats-happening">
        <div class="section-header">
            <h2>What's Happening</h2>
            <a href="{{ route('news.index') }}" class="view-all">View All</a>
        </div>
        <div class="news-grid">
            @if ($featuredPost)
                @php
                    $featuredImage = $featuredPost->getFirstMediaUrl('thumbnail');
                @endphp
                <a href="{{ route('news.show', $featuredPost->slug) }}" class="news-featured">
                    <div class="news-featured-image" @if ($featuredImage) style="background-image: url('{{ $featuredImage }}'); background-size: cover; background-position: center;" @endif>
                        @unless ($featuredImage)
                            <div class="news-placeholder"></div>
                        @endunless
                        <span class="news-featured-badge">Featured</span>
                    </div>
                    <div class="news-featured-content">
                        <h3>{{ $featuredPost->title }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($featuredPost->getRawOriginal('content') ?? $featuredPost->content ?? ''), 140) }}</p>
                        <div class="news-featured-meta">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                    <line x1="16" y1="2" x2="16" y2="6" />
                                    <line x1="8" y1="2" x2="8" y2="6" />
                                    <line x1="3" y1="10" x2="21" y2="10" />
                                </svg>
                                {{ optional($featuredPost->published_at)->format('M d, Y') ?? $featuredPost->created_at->format('M d, Y') }}
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="14" height="14">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                    <circle cx="9" cy="7" r="4" />
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                </svg>
                                {{ $featuredPost->category?->name ?? 'Updates' }}
                            </span>
                        </div>
                    </div>
                </a>
            @endif

            <div class="news-secondary">
                @foreach ($latestPosts as $post)
                    @php
                        $postImage = $post->getFirstMediaUrl('thumbnail');
                    @endphp
                    <a href="{{ route('news.show', $post->slug) }}" class="news-card-small">
                        <div class="news-card-small-image" @if ($postImage) style="background-image: url('{{ $postImage }}'); background-size: cover; background-position: center;" @endif>
                            @unless ($postImage)
                                <div class="news-placeholder"></div>
                            @endunless
                        </div>
                        <div class="news-card-small-content">
                            <span class="news-card-small-category">{{ $post->category?->name ?? 'Updates' }}</span>
                            <h4>{{ $post->title }}</h4>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($post->getRawOriginal('content') ?? $post->content ?? ''), 80) }}</p>
                            <span class="news-card-small-date">{{ optional($post->published_at)->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Games Section -->
    <section class="games-section" id="games">
        <div class="games-header">
            <div class="games-header-content">
                <div>
                    <h2>Games</h2>
                    <p>Top up your favorite games instantly</p>
                </div>
                <div class="games-nav">
                    <button class="games-nav-btn" id="gamesPrev" disabled>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="15 18 9 12 15 6" />
                        </svg>
                    </button>
                    <button class="games-nav-btn" id="gamesNext">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="9 18 15 12 9 6" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div class="games-slider-wrapper">
            <div class="games-slider" id="gamesSlider">
                <a href="#" class="game-card">
                    <div class="game-card-inner">
                        <div class="game-card-visual">
                            <div class="game-card-bg game-placeholder" style="background: linear-gradient(135deg, #dc2626 0%, #7f1d1d 50%, #1a0a0a 100%);">
                                <span class="game-placeholder-text" style="font-size: 2rem; letter-spacing: 0.2em;">GAME 1</span>
                            </div>
                            <span class="game-badge new">New</span>
                            <div class="game-card-content">
                                <h3>Game 1</h3>
                                <p>Topup ready</p>
                                <div class="game-card-meta">
                                    <span>
                                        <svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" /></svg>
                                        Fast topup
                                    </span>
                                    <span>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /></svg>
                                        Secure checkout
                                    </span>
                                </div>
                            </div>
                            <div class="game-action-btn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3" /></svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="#" class="game-card">
                    <div class="game-card-inner">
                        <div class="game-card-visual">
                            <div class="game-card-bg game-placeholder" style="background: linear-gradient(135deg, #8b5cf6 0%, #6d28d9 50%, #1a0a1a 100%);">
                                <span class="game-placeholder-text" style="font-size: 2rem; letter-spacing: 0.2em;">GAME 2</span>
                            </div>
                            <span class="game-badge hot">Hot</span>
                            <div class="game-card-content">
                                <h3>Game 2</h3>
                                <p>Topup ready</p>
                                <div class="game-card-meta">
                                    <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" /></svg> Fast topup</span>
                                    <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /></svg> Secure checkout</span>
                                </div>
                            </div>
                            <div class="game-action-btn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3" /></svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="#" class="game-card">
                    <div class="game-card-inner">
                        <div class="game-card-visual">
                            <div class="game-card-bg game-placeholder" style="background: linear-gradient(135deg, #10b981 0%, #059669 50%, #0a1a1a 100%);">
                                <span class="game-placeholder-text" style="font-size: 2rem; letter-spacing: 0.2em;">GAME 3</span>
                            </div>
                            <div class="game-card-content">
                                <h3>Game 3</h3>
                                <p>Topup ready</p>
                                <div class="game-card-meta">
                                    <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" /></svg> Fast topup</span>
                                    <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /></svg> Secure checkout</span>
                                </div>
                            </div>
                            <div class="game-action-btn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3" /></svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="#" class="game-card">
                    <div class="game-card-inner">
                        <div class="game-card-visual">
                            <div class="game-card-bg game-placeholder" style="background: linear-gradient(135deg, #f97316 0%, #ea580c 50%, #1a0a0a 100%);">
                                <span class="game-placeholder-text" style="font-size: 2rem; letter-spacing: 0.2em;">GAME 4</span>
                            </div>
                            <div class="game-card-content">
                                <h3>Game 4</h3>
                                <p>Topup ready</p>
                                <div class="game-card-meta">
                                    <span><svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z" /></svg> Fast topup</span>
                                    <span><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /></svg> Secure checkout</span>
                                </div>
                            </div>
                            <div class="game-action-btn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="5 3 19 12 5 21 5 3" /></svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="games-progress">
            <div class="games-progress-bar">
                <div class="games-progress-fill" id="gamesProgressFill"></div>
            </div>
            <span class="games-progress-text" id="gamesProgressText">1 / 3</span>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-section" id="howSection">
        <div class="how-bg"></div>
        <div class="how-noise"></div>

        <div class="how-giant-nums">
            <span class="giant-num giant-num-1">01</span>
            <span class="giant-num giant-num-2">02</span>
            <span class="giant-num giant-num-3">03</span>
        </div>

        <div class="how-wrapper">
            <div class="how-left">
                <div class="how-eyebrow">THE PROCESS</div>
                <h2 class="how-title">
                    <span class="how-title-line">Three steps.</span>
                    <span class="how-title-line how-title-accent">That's it.</span>
                </h2>

                <div class="how-steps">
                    <div class="how-step-item" data-step="1">
                        <div class="step-visual">
                            <div class="step-circle">
                                <span class="step-num">01</span>
                            </div>
                        </div>
                        <div class="step-info">
                            <h3>Choose</h3>
                            <p>Pick what you need</p>
                        </div>
                    </div>

                    <div class="how-step-item" data-step="2">
                        <div class="step-visual">
                            <div class="step-circle">
                                <span class="step-num">02</span>
                            </div>
                        </div>
                        <div class="step-info">
                            <h3>Connect</h3>
                            <p>Link your account</p>
                        </div>
                    </div>

                    <div class="how-step-item" data-step="3">
                        <div class="step-visual">
                            <div class="step-circle">
                                <span class="step-num">03</span>
                            </div>
                        </div>
                        <div class="step-info">
                            <h3>Done</h3>
                            <p>Instant delivery</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="how-right">
                <div class="device-mockups">
                    <img src="{{ setting_url('process_mockup', 'images/tkunity_devices.png') }}" alt="{{ setting('site_name', 'TKUnity') }} Process" class="mockup-composite">
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-choose">
        <div class="section-header">
            <h2>Why Choose TKUnity</h2>
        </div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                </div>
                <h3>Instant Delivery</h3>
                <p>Credits are delivered to your account immediately after payment confirmation.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2" /><path d="M7 11V7a5 5 0 0 1 10 0v4" /></svg>
                </div>
                <h3>Secure Payments</h3>
                <p>Multiple payment methods with bank-grade encryption and fraud protection.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10" /><polyline points="12 6 12 12 16 14" /></svg>
                </div>
                <h3>24/7 Availability</h3>
                <p>Topup anytime, anywhere. Our service never sleeps.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" /></svg>
                </div>
                <h3>Rewards Program</h3>
                <p>Earn points with every purchase and redeem for exclusive bonuses.</p>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="section-header">
            <h2>What Gamers Say</h2>
        </div>
        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <p class="testimonial-text">"Fast and reliable. Got my credits within seconds. Will definitely use again!"</p>
                <div class="testimonial-author">
                    <div class="author-avatar">A</div>
                    <div class="author-info">
                        <span class="author-name">Alex</span>
                        <span class="author-game">Game 1</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <p class="testimonial-text">"Best topup service I've used. Great rates and instant delivery every time."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">M</div>
                    <div class="author-info">
                        <span class="author-name">Minh</span>
                        <span class="author-game">Game 3</span>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-stars">
                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                </div>
                <p class="testimonial-text">"Customer support is amazing. They helped me resolve my issue quickly."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">K</div>
                    <div class="author-info">
                        <span class="author-name">Kevin</span>
                        <span class="author-game">Game 2</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="section-header">
            <h2>Frequently Asked Questions</h2>
        </div>
        <div class="faq-list">
            <div class="faq-item">
                <button class="faq-question">
                    <span>How long does delivery take?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Most topups are delivered instantly within 1-5 minutes after payment confirmation. In rare cases, it may take up to 30 minutes depending on game server status.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    <span>What payment methods do you accept?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>We accept Visa, Mastercard, mobile wallets (Momo, Zalo Pay), bank transfers, Apple Pay, Google Pay, and select cryptocurrencies.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    <span>Is it safe to use TKUnity?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Yes, we use bank-grade encryption and never store your payment details. We are a registered business with a proven track record of secure transactions.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    <span>What if I don't receive my credits?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Contact our 24/7 support team with your transaction ID. We'll investigate and ensure you receive your purchase or provide a full refund.</p>
                </div>
            </div>
            <div class="faq-item">
                <button class="faq-question">
                    <span>Do you offer refunds?</span>
                    <span class="faq-icon">+</span>
                </button>
                <div class="faq-answer">
                    <p>Refunds are processed on a case-by-case basis. If you haven't received your credits, we'll issue a full refund. Please contact support for assistance.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Careers Section -->
    <section class="careers-section">
        <div class="careers-content">
            <span class="careers-tag">We're Hiring</span>
            <h2>Join the Team</h2>
            <p>Build the future of gaming with us. Explore open positions across disciplines.</p>
            <div class="careers-stats">
                <div class="careers-stat">
                    <span class="stat-number">50+</span>
                    <span class="stat-text">Open Roles</span>
                </div>
                <div class="careers-stat">
                    <span class="stat-number">12</span>
                    <span class="stat-text">Locations</span>
                </div>
            </div>
            <a href="{{ route('careers') }}" class="btn btn-outline">View Careers</a>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    // FAQ Accordion
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', () => {
            const faqItem = question.parentElement;
            const isActive = faqItem.classList.contains('active');

            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
            });

            if (!isActive) {
                faqItem.classList.add('active');
            }
        });
    });

    // Games Slider
    (function () {
        const slider = document.getElementById('gamesSlider');
        const prevBtn = document.getElementById('gamesPrev');
        const nextBtn = document.getElementById('gamesNext');
        const progressFill = document.getElementById('gamesProgressFill');
        const progressText = document.getElementById('gamesProgressText');
        const cards = slider.querySelectorAll('.game-card');

        let currentIndex = 0;
        let cardWidth;
        let gap;
        let cardsPerView;

        function getDimensions() {
            const card = cards[0];
            cardWidth = card.offsetWidth;
            const sliderStyle = window.getComputedStyle(slider);
            gap = parseFloat(sliderStyle.gap) || 24;
            const containerWidth = slider.parentElement.offsetWidth;
            const totalCardWidth = cardWidth + gap;
            cardsPerView = Math.floor((containerWidth - 64) / totalCardWidth) || 1;
            cardsPerView = Math.min(cardsPerView, cards.length);
        }

        function getMaxIndex() {
            return Math.max(0, cards.length - cardsPerView);
        }

        function updateSlider() {
            const offset = currentIndex * (cardWidth + gap);
            slider.style.transform = `translateX(-${offset}px)`;

            const maxIndex = getMaxIndex();
            prevBtn.disabled = currentIndex === 0;
            nextBtn.disabled = currentIndex >= maxIndex;
            progressFill.style.width = `${((currentIndex + 1) / (maxIndex + 1)) * 100}%`;
            progressText.textContent = `${currentIndex + 1} / ${maxIndex + 1}`;
        }

        function goToSlide(index) {
            const maxIndex = getMaxIndex();
            currentIndex = Math.max(0, Math.min(maxIndex, index));
            updateSlider();
        }

        let isDragging = false;
        let startX = 0;
        let startIndex = 0;
        let hasMoved = false;

        function onDragStart(x) {
            isDragging = true;
            hasMoved = false;
            startX = x;
            startIndex = currentIndex;
            slider.classList.add('dragging');
            slider.style.transition = 'none';
        }

        function onDragMove(x) {
            if (!isDragging) return;

            const diff = startX - x;
            if (Math.abs(diff) > 10) {
                hasMoved = true;
            }

            if (hasMoved) {
                const offset = startIndex * (cardWidth + gap) + diff;
                slider.style.transform = `translateX(-${offset}px)`;
            }
        }

        function onDragEnd() {
            if (!isDragging) return;
            isDragging = false;
            slider.classList.remove('dragging');
            slider.style.transition = 'transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94)';

            if (hasMoved) {
                const currentTransform = parseFloat(slider.style.transform.replace('translateX(-', '').replace('px)', '')) || 0;
                const startOffset = startIndex * (cardWidth + gap);
                const dragDistance = currentTransform - startOffset;
                const cardStep = cardWidth + gap;

                const slideChange = Math.round(dragDistance / cardStep);
                goToSlide(startIndex + slideChange);
            } else {
                updateSlider();
            }

            setTimeout(() => {
                hasMoved = false;
            }, 100);
        }

        slider.addEventListener('mousedown', (e) => {
            if (e.button !== 0) return;
            e.preventDefault();
            onDragStart(e.pageX);
        });

        window.addEventListener('mousemove', (e) => {
            if (isDragging) {
                onDragMove(e.pageX);
            }
        });

        window.addEventListener('mouseup', () => {
            if (isDragging) onDragEnd();
        });

        slider.addEventListener('touchstart', (e) => {
            onDragStart(e.touches[0].clientX);
        }, { passive: true });

        slider.addEventListener('touchmove', (e) => {
            if (isDragging) {
                onDragMove(e.touches[0].clientX);
            }
        }, { passive: true });

        slider.addEventListener('touchend', onDragEnd);

        slider.addEventListener('wheel', (e) => {
            if (e.deltaY !== 0 && !e.shiftKey) return;

            e.preventDefault();
            const direction = e.deltaX || e.deltaY;
            if (direction > 0) {
                goToSlide(currentIndex + 1);
            } else if (direction < 0) {
                goToSlide(currentIndex - 1);
            }
        }, { passive: false });

        slider.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', (e) => {
                if (hasMoved) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });
        });

        prevBtn.addEventListener('click', () => goToSlide(currentIndex - 1));
        nextBtn.addEventListener('click', () => goToSlide(currentIndex + 1));

        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') {
                goToSlide(currentIndex - 1);
            } else if (e.key === 'ArrowRight') {
                goToSlide(currentIndex + 1);
            }
        });

        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                getDimensions();
                goToSlide(currentIndex);
            }, 150);
        });

        getDimensions();
        updateSlider();
    })();
</script>
@endsection
