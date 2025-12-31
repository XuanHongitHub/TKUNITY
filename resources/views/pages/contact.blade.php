@extends('layouts.site')

@section('title', 'Contact Us - ' . setting('site_name', 'TKUnity'))
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

        /* Contact Container */
        .contact-section {
            padding: 4rem;
            background: var(--bg-alt);
        }

        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 4rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Contact Info */
        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .info-card {
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            transition: all 0.3s;
        }

        .info-card:hover {
            border-color: var(--accent);
        }

        .info-card h3 {
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-dim);
            margin-bottom: 1rem;
        }

        .info-card p {
            font-size: 1rem;
            color: var(--text);
            margin-bottom: 0.5rem;
        }

        .info-card a {
            color: var(--accent);
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .info-card a:hover {
            opacity: 0.7;
        }

        .info-card .email {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.9375rem;
        }

        /* Social Links */
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-muted);
            transition: all 0.3s;
        }

        .social-link:hover {
            border-color: var(--accent);
            color: var(--accent);
            transform: translateY(-2px);
        }

        .social-link svg {
            width: 20px;
            height: 20px;
        }

        /* Contact Form */
        .contact-form-wrapper {
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 3rem;
        }

        .contact-form-wrapper h2 {
            font-size: 1.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -0.02em;
            margin-bottom: 0.5rem;
        }

        .contact-form-wrapper p {
            font-size: 0.9375rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .form-group label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }

        .form-group label .required {
            color: var(--accent);
            margin-left: 2px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 1rem;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 8px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.9375rem;
            color: var(--text);
            transition: all 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: var(--text-dim);
        }

        .form-group textarea {
            min-height: 150px;
            resize: vertical;
        }

        .form-group select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%2371717a' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 3rem;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem 2rem;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 8px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            cursor: pointer;
            transition: all 0.3s;
        }

        .submit-btn:hover {
            background: var(--accent-dark);
            box-shadow: 0 0 30px rgba(220, 38, 38, 0.4);
        }

        .submit-btn:disabled {
            background: var(--text-dim);
            cursor: not-allowed;
        }

        .form-success {
            margin-bottom: 1rem;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            background: rgba(34, 197, 94, 0.12);
            color: var(--success);
            border: 1px solid rgba(34, 197, 94, 0.3);
            font-size: 0.875rem;
            text-align: center;
        }

        .form-note {
            font-size: 0.75rem;
            color: var(--text-dim);
            margin-top: 1rem;
            text-align: center;
        }

        /* FAQ Section */
        .faq-section {
            padding: 6rem 4rem;
            background: var(--bg);
        }

        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-header h2 {
            font-size: 2rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -0.02em;
            margin-bottom: 0.5rem;
        }

        .section-header p {
            font-size: 1rem;
            color: var(--text-muted);
        }

        .faq-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .faq-card {
            background: var(--bg-alt);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1.5rem;
            transition: all 0.3s;
        }

        .faq-card:hover {
            border-color: var(--accent);
        }

        .faq-card h3 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--text);
        }

        .faq-card p {
            font-size: 0.875rem;
            color: var(--text-muted);
            line-height: 1.6;
        }

        /* Office Hours */
        .hours-section {
            padding: 4rem;
            background: var(--bg-alt);
            border-top: 1px solid var(--border);
        }

        .hours-container {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .hours-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 2rem;
        }

        .hours-item {
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1.5rem;
        }

        .hours-item .icon {
            width: 48px;
            height: 48px;
            background: rgba(220, 38, 38, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: var(--accent);
        }

        .hours-item .icon svg {
            width: 24px;
            height: 24px;
        }

        .hours-item h4 {
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.5rem;
        }

        .hours-item p {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        /* Responsive */
        @media (max-width: 1100px) {
            .page-header,
            .contact-section,
            .faq-section,
            .hours-section {
                padding-left: 2rem;
                padding-right: 2rem;
            }

            .contact-container {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .faq-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .page-header {
                padding: 8rem 1.5rem 4rem;
            }

            .contact-section,
            .faq-section,
            .hours-section {
                padding-left: 1.5rem;
                padding-right: 1.5rem;
            }

            .contact-form-wrapper {
                padding: 1.5rem;
            }

            .hours-grid {
                grid-template-columns: 1fr;
            }
        }
</style>
@endsection

@section('content')

    <!-- Page Header -->
    <section class="page-header">
        <div class="page-header-content">
            <div class="breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <span>/</span>
                <span>Contact</span>
            </div>
            <h1>Get in <span>Touch</span></h1>
            <p>Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact-section">
        <div class="contact-container">
            <!-- Contact Info -->
            <div class="contact-info">
                <div class="info-card">
                    <h3>Email Us</h3>
                    <p>For general inquiries:</p>
                    <a href="mailto:support@tkunity.com" class="email">support@tkunity.com</a>
                    <p style="margin-top: 1rem;">For business partnerships:</p>
                    <a href="mailto:business@tkunity.com" class="email">business@tkunity.com</a>
                </div>

                <div class="info-card">
                    <h3>Response Time</h3>
                    <p>We typically respond within:</p>
                    <p style="color: var(--accent); font-weight: 600;">24 hours</p>
                    <p style="font-size: 0.875rem; color: var(--text-muted); margin-top: 0.5rem;">For urgent issues, please use our live chat support.</p>
                </div>

                <div class="info-card">
                    <h3>Help Center</h3>
                    <p>Find answers, guides, and order help.</p>
                    <a href="{{ route('help') ?? '#' }}" class="email">Visit Help Center</a>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-wrapper">
                <h2>Send us a Message</h2>
                <p>Fill out the form below and we'll get back to you within 24 hours.</p>

                @if (session('status'))
                    <div class="form-success">{{ session('status') }}</div>
                @endif
                <form id="contactForm" action="{{ route('contact.submit') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Full Name <span class="required">*</span></label>
                            <input type="text" id="name" name="full_name" placeholder="Enter your name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address <span class="required">*</span></label>
                            <input type="email" id="email" name="email" placeholder="Enter your email" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="subject">Subject <span class="required">*</span></label>
                            <select id="subject" name="subject" required>
                                <option value="">Select a topic</option>
                                <option value="general">General Inquiry</option>
                                <option value="support">Technical Support</option>
                                <option value="payment">Payment Issue</option>
                                <option value="business">Business Partnership</option>
                                <option value="feedback">Feedback</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="game">Game (Optional)</label>
                            <select id="game" name="game">
                                <option value="">Select a game</option>
                                <option value="game-1">Game 1</option>
                                <option value="game-2">Game 2</option>
                                <option value="game-3">Game 3</option>
                                <option value="game-4">Game 4</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="order">Order ID (Optional)</label>
                        <input type="text" id="order" name="order" placeholder="e.g., TKU-123456">
                    </div>

                    <div class="form-group">
                        <label for="message">Message <span class="required">*</span></label>
                        <textarea id="message" name="message" placeholder="Describe your issue or question in detail..." required></textarea>
                    </div>

                    <button type="submit" class="submit-btn" id="submitBtn">Send Message</button>
                    <p class="form-note">
                        By submitting this form, you agree to our
                        <a href="{{ route('terms') }}">Terms of Service</a>
                        and
                        <a href="{{ route('privacy') }}">Privacy Policy</a>.
                    </p>
                </form>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq-section">
        <div class="section-header">
            <h2>Frequently Asked Questions</h2>
            <p>Quick answers to common questions</p>
        </div>
        <div class="faq-grid">
            <div class="faq-card">
                <h3>How long until I get a response?</h3>
                <p>We typically respond to all inquiries within 24 hours. For urgent issues, please use our live chat support available 24/7.</p>
            </div>
            <div class="faq-card">
                <h3>My topup hasn't arrived yet</h3>
                <p>First, check your email for the confirmation. If it's been more than 30 minutes, contact support with your order ID.</p>
            </div>
            <div class="faq-card">
                <h3>Can I request a refund?</h3>
                <p>Refunds are handled on a case-by-case basis. Please contact support with your order details and we'll review your request.</p>
            </div>
            <div class="faq-card">
                <h3>How do I become a partner?</h3>
                <p>For business partnerships and affiliate opportunities, please email business@tkunity.com with your proposal.</p>
            </div>
        </div>
    </section>

    <!-- Office Hours -->
    <section class="hours-section">
        <div class="hours-container">
            <div class="section-header">
                <h2>Support Hours</h2>
                <p>When our team is available to help you</p>
            </div>
            <div class="hours-grid">
                <div class="hours-item">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/>
                            <polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <h4>Live Chat</h4>
                    <p>24/7 Available</p>
                </div>
                <div class="hours-item">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                    </div>
                    <h4>Email Support</h4>
                    <p>Mon - Fri: 9AM - 6PM</p>
                </div>
                <div class="hours-item">
                    <div class="icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                        </svg>
                    </div>
                    <h4>Order Updates</h4>
                    <p>Status Notifications</p>
                </div>
            </div>
        </div>
    </section>
@endsection
