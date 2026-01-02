@extends('layouts.app')

@section('title', 'Contact Us - TK Unity')
@section('header_class', 'header-solid')

@section('content')
    <section class="page-header">
        <div class="container">
            <div class="page-header-content">
                <span class="section-label">Get in Touch</span>
                <h1 class="page-title">Contact <span class="accent">Us</span></h1>
                <p class="page-subtitle">We'd love to hear from you. Please send us a message and we'll get back to you
                    as soon as possible.</p>
            </div>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info">
                    <h2 class="contact-info-heading">Reach Us</h2>

                    <div class="contact-items">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="contact-item-title">Headquarters</h3>
                                <p class="contact-item-text">Lot 01 A3 Nguyen Sinh Sac, Hoa Minh Ward,<br>Lien Chieu
                                    District, Da Nang City, Vietnam</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="contact-item-title">Phone</h3>
                                <p class="contact-item-text">0935 309 099</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="contact-item-title">Email</h3>
                                <p class="contact-item-text"><a href="mailto:tkunity@support.com">tkunity@support.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact-form-wrapper">
                    <h2 class="contact-form-heading">Send a Message</h2>
                    <form class="contact-form" method="POST" action="{{ route('contact.submit') }}">
                        @csrf
                        <div class="form-group">
                            <label for="full_name" class="form-label">Name</label>
                            <input type="text" id="full_name" name="full_name" class="form-input" placeholder="Your Name"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" name="email" class="form-input" placeholder="you@example.com"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-input"
                                placeholder="How can we help?" required>
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-label">Message</label>
                            <textarea id="message" name="message" rows="5" class="form-textarea"
                                placeholder="Your message..." required></textarea>
                        </div>
                        <button type="submit" class="btn-primary btn-full">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
