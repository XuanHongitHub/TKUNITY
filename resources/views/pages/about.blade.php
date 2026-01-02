@extends('layouts.app')

@section('title', 'About Us - TK Unity')
@section('header_class', 'header-solid')

@section('content')
    <section class="page-header">
        <div class="container">
            <div class="page-header-content">
                <span class="section-label">About Us</span>
                <h1 class="page-title">We Are <span class="accent">TK Unity</span></h1>
                <p class="page-subtitle">Pioneering the intersection of interactive entertainment and artificial
                    intelligence.</p>
            </div>
        </div>
    </section>

    <section class="about-profile">
        <div class="container">
            <div class="profile-card">
                <h2 class="profile-heading">Company Profile</h2>
                <div class="profile-grid">
                    <div class="profile-item">
                        <span class="profile-label">Company Name</span>
                        <span class="profile-value">TK UNITY COMPANY LIMITED</span>
                    </div>
                    <div class="profile-item">
                        <span class="profile-label">Tax Code (TIN)</span>
                        <span class="profile-value profile-mono">0402271698</span>
                    </div>
                    <div class="profile-item">
                        <span class="profile-label">Founded</span>
                        <span class="profile-value">April 09, 2025</span>
                    </div>
                    <div class="profile-item">
                        <span class="profile-label">Headquarters</span>
                        <span class="profile-value">Lot 01 A3 Nguyen Sinh Sac, Hoa Minh Ward, Lien Chieu District, Da
                            Nang City, Vietnam</span>
                    </div>
                    <div class="profile-item">
                        <span class="profile-label">Representative</span>
                        <span class="profile-value">Bui D.T</span>
                    </div>
                    <div class="profile-item">
                        <span class="profile-label">Primary Industry</span>
                        <span class="profile-value">Software Publishing & Mobile Application Development</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-vision">
        <div class="container">
            <div class="vision-grid">
                <div class="vision-image">
                    <img src="{{ asset('images/pages/about.png') }}" alt="TK Unity Team">
                </div>
                <div class="vision-content">
                    <span class="section-label">Our Vision</span>
                    <h2 class="focus-title">Leading Technology in <span class="accent">Southeast Asia</span></h2>
                    <p class="vision-text">
                        To become a leading technology powerhouse in Southeast Asia, known for creating digital
                        experiences that not only entertain but also enhance the quality of human life through
                        intelligent innovation.
                    </p>

                    <div class="values-list">
                        <div class="value-item">
                            <div class="value-marker"></div>
                            <div>
                                <h4 class="value-title">Integrity</h4>
                                <p class="value-desc">We operate with transparency and honesty in all our dealings.</p>
                            </div>
                        </div>
                        <div class="value-item">
                            <div class="value-marker"></div>
                            <div>
                                <h4 class="value-title">Excellence</h4>
                                <p class="value-desc">We strive for perfection in every line of code and every pixel of
                                    design.</p>
                            </div>
                        </div>
                        <div class="value-item">
                            <div class="value-marker"></div>
                            <div>
                                <h4 class="value-title">Innovation</h4>
                                <p class="value-desc">We constantly explore new technologies to solve real-world
                                    problems.</p>
                            </div>
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
                <h2 class="cta-title">Want to Work With Us?</h2>
                <p class="cta-desc">We're always looking for talented individuals and partners who share our vision.</p>
                <div class="cta-actions">
                    <a href="{{ route('contact') }}" class="btn-white">Get in Touch</a>
                </div>
            </div>
        </div>
    </section>
@endsection
