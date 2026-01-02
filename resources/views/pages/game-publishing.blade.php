@extends('layouts.app')

@section('title', 'Game Publishing - TK Unity')
@section('header_class', 'header-solid')

@section('content')
    <section class="page-header">
        <div class="container">
            <div class="page-header-content">
                <span class="section-label">Products</span>
                <h1 class="page-title">Game <span class="accent">Publishing</span></h1>
                <p class="page-subtitle">Launch, scale, and sustain mobile games with a trusted partner.</p>
            </div>
        </div>
    </section>

    <section class="legal">
        <div class="container">
            <div class="legal-content">
                <h2>Publishing Support</h2>
                <p>We help teams bring games to market with a focus on quality, performance, and long-term growth.</p>

                <h2>What We Provide</h2>
                <ul class="legal-list">
                    <li>Release planning and store readiness</li>
                    <li>Performance optimization and QA review</li>
                    <li>Live operations support and content planning</li>
                    <li>User acquisition insights and analytics guidance</li>
                </ul>

                <h2>Start a Partnership</h2>
                <p>Share your project details via our <a href="{{ route('contact') }}">contact form</a>.</p>
            </div>
        </div>
    </section>
@endsection
