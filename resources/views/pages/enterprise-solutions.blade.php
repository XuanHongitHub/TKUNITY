@extends('layouts.app')

@section('title', 'Enterprise Solutions - TK Unity')
@section('header_class', 'header-solid')

@section('content')
    <section class="page-header">
        <div class="container">
            <div class="page-header-content">
                <span class="section-label">Products</span>
                <h1 class="page-title">Enterprise <span class="accent">Solutions</span></h1>
                <p class="page-subtitle">Custom software and AI systems built for scale and reliability.</p>
            </div>
        </div>
    </section>

    <section class="legal">
        <div class="container">
            <div class="legal-content">
                <h2>Solutions Overview</h2>
                <p>We design and deliver secure platforms that support enterprise workflows and government partners.</p>

                <h2>Capabilities</h2>
                <ul class="legal-list">
                    <li>Custom application development</li>
                    <li>AI model integration and automation</li>
                    <li>System architecture and performance optimization</li>
                    <li>Ongoing maintenance and support</li>
                </ul>

                <h2>Contact Our Team</h2>
                <p>Reach out through our <a href="{{ route('contact') }}">contact page</a> to discuss requirements.</p>
            </div>
        </div>
    </section>
@endsection
