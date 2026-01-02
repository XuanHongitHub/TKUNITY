@extends('layouts.app')

@section('title', 'FAQs - TK Unity')
@section('header_class', 'header-solid')

@section('content')
    <section class="page-header">
        <div class="container">
            <div class="page-header-content">
                <span class="section-label">Support</span>
                <h1 class="page-title">FAQs</h1>
                <p class="page-subtitle">Quick answers to the most common questions.</p>
            </div>
        </div>
    </section>

    <section class="legal">
        <div class="container">
            <div class="legal-content">
                <h2>What does TK Unity specialize in?</h2>
                <p>We focus on Unity game development and applied AI solutions.</p>

                <h2>How can I contact your team?</h2>
                <p>Reach us at <a href="mailto:tkunity@support.com">tkunity@support.com</a> or via the <a href="{{ route('contact') }}">contact page</a>.</p>

                <h2>Where can I find product documentation?</h2>
                <p>Visit our <a href="{{ route('documentation') }}">documentation</a> page for technical resources.</p>
            </div>
        </div>
    </section>
@endsection
