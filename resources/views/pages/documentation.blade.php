@extends('layouts.app')

@section('title', 'Documentation - TK Unity')
@section('header_class', 'header-solid')

@section('content')
    <section class="page-header">
        <div class="container">
            <div class="page-header-content">
                <span class="section-label">Resources</span>
                <h1 class="page-title">Documentation</h1>
                <p class="page-subtitle">Technical references and platform guides.</p>
            </div>
        </div>
    </section>

    <section class="legal">
        <div class="container">
            <div class="legal-content">
                <h2>Technical Resources</h2>
                <p>Product documentation and developer guides are provided for our partners and clients.</p>

                <h2>Need Access?</h2>
                <p>Contact us at <a href="mailto:tkunity@support.com">tkunity@support.com</a> or use the <a href="{{ route('contact') }}">contact page</a> for requests.</p>
            </div>
        </div>
    </section>
@endsection
