@extends('layouts.app')

@section('title', 'Help Center - TK Unity')
@section('header_class', 'header-solid')

@section('content')
    <section class="page-header">
        <div class="container">
            <div class="page-header-content">
                <span class="section-label">Support</span>
                <h1 class="page-title">Help <span class="accent">Center</span></h1>
                <p class="page-subtitle">Find answers fast or reach our support team.</p>
            </div>
        </div>
    </section>

    <section class="legal">
        <div class="container">
            <div class="legal-content">
                <p>We are here to help with product questions, technical issues, and partnership inquiries.</p>

                <h2>Contact Support</h2>
                <p>Email: <a href="mailto:tkunity@support.com">tkunity@support.com</a></p>
                <p>Phone: <a href="tel:0935309099">0935 309 099</a></p>

                <h2>Self-Service</h2>
                <ul class="legal-list">
                    <li><a href="{{ route('faqs') }}">FAQs</a></li>
                    <li><a href="{{ route('documentation') }}">Documentation</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>
        </div>
    </section>
@endsection
