@extends('layouts.app')

@section('title', 'TK Unity - Professional Mobile Game & AI Development')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-white overflow-hidden flex-grow flex items-center">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
            <div class="lg:grid lg:grid-cols-12 lg:gap-8 items-center">
                <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-6 lg:text-left">
                    <h1 class="text-4xl tracking-tight font-bold text-slate-900 sm:text-5xl md:text-6xl lg:text-5xl xl:text-6xl">
                        <span class="block">Innovation in</span>
                        <span class="block text-brand-600">Every Pixel</span>
                    </h1>
                    <p class="mt-3 text-base text-slate-500 sm:mt-5 sm:text-xl lg:text-lg xl:text-xl leading-relaxed">
                        TK UNITY COMPANY LIMITED is a premier software development studio based in Da Nang. We specialize in high-performance Unity game development and advanced AI solutions for the global market.
                    </p>
                    <div class="mt-8 sm:max-w-lg sm:mx-auto sm:text-center lg:text-left lg:mx-0 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('games') }}" class="flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-white bg-brand-600 hover:bg-brand-700 md:py-4 md:text-lg transition-all shadow-sm">
                            Our Games
                        </a>
                        <a href="{{ route('ai-trainer') }}" class="flex items-center justify-center px-8 py-3 border border-slate-300 text-base font-medium rounded-lg text-slate-700 bg-white hover:bg-slate-50 md:py-4 md:text-lg transition-all">
                            AI Solutions
                        </a>
                    </div>
                </div>
                <div class="mt-12 relative sm:max-w-lg sm:mx-auto lg:mt-0 lg:max-w-none lg:mx-0 lg:col-span-6 lg:flex lg:items-center">
                    <div class="relative mx-auto w-full rounded-2xl lg:max-w-md overflow-hidden p-2 flex items-center justify-center">
                        <img src="{{ asset('images/home/hero_illustration.png') }}" alt="TK Unity Development Dashboard" class="w-full h-auto object-contain transform hover:scale-105 transition-transform duration-500">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Excellence & Compliance Section -->
    <div class="py-16 bg-slate-50 border-y border-slate-200" id="trust-compliance">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h2 class="text-base text-brand-600 font-semibold tracking-wide uppercase">Why Choose TK Unity</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Built on Integrity & Excellence
                </p>
                <p class="mt-4 max-w-2xl text-xl text-slate-500 mx-auto">
                    We adhere to the highest standards of software development and regulatory compliance.
                </p>
            </div>

            <div class="mt-12 grid gap-8 grid-cols-1 md:grid-cols-3">
                <!-- Verified Data -->
                <div class="bg-white rounded-lg px-6 py-8 shadow-sm border border-slate-100 flex flex-col items-center text-center">
                     <div class="flex items-center justify-center h-12 w-12 rounded-md bg-brand-100 text-brand-600 mb-5">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-slate-900">Authentic Solutions</h3>
                    <p class="mt-2 text-base text-slate-500">
                        We deliver real, verifiable software products. No simulated data, no deceptive practices. Our portfolio consists of deployed, operational applications.
                    </p>
                </div>

                <!-- Professional Standards -->
                <div class="bg-white rounded-lg px-6 py-8 shadow-sm border border-slate-100 flex flex-col items-center text-center">
                     <div class="flex items-center justify-center h-12 w-12 rounded-md bg-brand-100 text-brand-600 mb-5">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-slate-900">Engineering Excellence</h3>
                    <p class="mt-2 text-base text-slate-500">
                        Our codebases follow strict industry standards for security, maintainability, and scalability. We prioritize clean architecture and robust performance.
                    </p>
                </div>

                 <!-- Regulatory Compliance -->
                 <div class="bg-white rounded-lg px-6 py-8 shadow-sm border border-slate-100 flex flex-col items-center text-center">
                     <div class="flex items-center justify-center h-12 w-12 rounded-md bg-brand-100 text-brand-600 mb-5">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-slate-900">Regulatory Compliance</h3>
                    <p class="mt-2 text-base text-slate-500">
                        Operating with full transparency and legal adherence. We are committed to contributing strictly to the digital economy under government regulations.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Mission & Core Competencies -->
    <div class="relative bg-white py-16 sm:py-24">
        <div class="lg:mx-auto lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-2 lg:gap-24 lg:items-start">
            <div class="relative sm:py-16 lg:py-0">
                <div class="relative mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:px-0 lg:max-w-none lg:py-20">
                    <!-- Image/Illustration -->
                    <div class="relative rounded-2xl shadow-xl overflow-hidden border border-slate-200 bg-slate-50 aspect-[4/3] flex items-center justify-center group">
                         <img src="{{ asset('images/home/core_pillars.png') }}" alt="Game Development and AI" class="absolute inset-0 w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-700">
                         <div class="absolute bottom-0 inset-x-0 bg-white/90 backdrop-blur p-4 border-t border-slate-100">
                             <p class="text-xs text-brand-600 uppercase tracking-widest font-bold text-center">Core Pillars</p>
                         </div>
                    </div>
                </div>
            </div>

            <div class="relative mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:px-0">
                <!-- Content -->
                <div class="pt-12 sm:pt-16 lg:pt-20">
                    <h2 class="text-3xl text-slate-900 font-extrabold tracking-tight sm:text-4xl">
                        Focused on Impact
                    </h2>
                    <div class="mt-6 text-slate-500 space-y-6">
                        <p class="text-lg">
                            We don't chase trends. We build substantial technology that serves a purpose. Our bifurcated focus allows us to specialize deeply in two critical areas of the modern digital landscape.
                        </p>
                        
                        <div class="border-t border-slate-200 pt-6">
                            <h3 class="text-lg font-medium text-slate-900">Game Development</h3>
                            <p class="mt-2 text-base">
                                Creating immersive experiences with Unity. From concept to deployment, we build optimized, engaging mobile games that perform across devices.
                            </p>
                        </div>
                        
                         <div class="border-t border-slate-200 pt-6">
                            <h3 class="text-lg font-medium text-slate-900">Artificial Intelligence</h3>
                            <p class="mt-2 text-base">
                                Utilizing advanced algorithms to solve complex problems. Our AI solutions are designed for accuracy, efficiency, and ethical application.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple Footer Call to Action -->
    <!-- Premier Footer Call to Action -->
    <div class="relative bg-brand-900 border-t border-brand-800">
        <!-- Abstract Background Pattern -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
             <div class="absolute top-0 left-0 -ml-20 -mt-20 w-80 h-80 rounded-full bg-brand-800/50 blur-3xl opacity-20"></div>
             <div class="absolute bottom-0 right-0 -mr-20 -mb-20 w-80 h-80 rounded-full bg-blue-800/50 blur-3xl opacity-20"></div>
             <svg class="absolute inset-0 w-full h-full opacity-[0.03]" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid-pattern" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 40L40 0H20L0 20M40 40V20L20 40" stroke="white" stroke-width="1" fill="none"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid-pattern)"/>
            </svg>
        </div>

        <div class="relative max-w-4xl mx-auto text-center py-20 px-4 sm:px-6 lg:px-8 z-10">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl md:text-5xl">
                Technical Excellence. Verified Integrity.
            </h2>
            <p class="mt-4 text-xl text-slate-300 max-w-2xl mx-auto">
                TK Unity adheres to strict industry standards. We provide transparent, high-performance software solutions for enterprise and government partners.
            </p>
            <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-lg font-medium rounded-lg text-white bg-brand-600 hover:bg-brand-700 md:text-xl transition-all shadow-lg hover:shadow-brand-500/25 ring-offset-2 focus:ring-2 ring-brand-500">
                    Contact Our Team
                </a>
                 <a href="{{ route('games') }}" class="inline-flex items-center justify-center px-8 py-3.5 border border-slate-700 text-lg font-medium rounded-lg text-slate-300 bg-slate-800 hover:bg-slate-700 md:text-xl transition-all">
                    Our Portfolio
                </a>
            </div>
        </div>
    </div>
@endsection
