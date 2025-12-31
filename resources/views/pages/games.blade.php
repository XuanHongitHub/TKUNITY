@extends('layouts.app')

@section('title', 'Game Development - TK Unity')

@section('content')
    <!-- Page Header -->
    <div class="bg-slate-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-20 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl text-center">Mobile Game Development</h1>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-500 text-center">
                Immersive. Performant. Engaging.
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-grow bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-20 lg:px-8">
            <!-- Section 1: Philosophy -->
            <div class="mb-20">
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 lg:items-center">
                    <div>
                        <h2 class="text-2xl font-bold text-slate-900 sm:text-3xl">Crafting Digital Worlds</h2>
                        <p class="mt-3 max-w-3xl text-lg text-slate-500">
                            At TK Unity, we believe that great games start with a strong foundation. 
                            We utilize the Unity engine's advanced rendering pipeline and physics system to create games that feel responsive and look stunning on any device.
                        </p>
                        <ul class="mt-8 space-y-4">
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <p class="ml-3 text-base text-slate-600">Optimized for low-end and high-end devices alike.</p>
                            </li>
                            <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <p class="ml-3 text-base text-slate-600">Cross-platform compatibility (iOS & Android).</p>
                            </li>
                             <li class="flex items-start">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <p class="ml-3 text-base text-slate-600">Data-driven design for maximum player engagement.</p>
                            </li>
                        </ul>
                    </div>
                    <div class="mt-8 lg:mt-0">
                         <div class="bg-white rounded-2xl overflow-hidden shadow-lg border border-slate-100 p-2">
                             <img src="{{ asset('images/pages/games_dev_process.png') }}" alt="Mobile Game Development Process" class="w-full h-auto object-contain transform hover:scale-105 transition-transform duration-500">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section 2: Areas of Expertise -->
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-8">Our Expertise</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                     <!-- Card 1 -->
                    <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                         <h3 class="text-lg font-bold text-slate-900 mb-2">Casual Games</h3>
                         <p class="text-slate-600 text-sm">Pick-up-and-play experiences designed for mass appeal and quick sessions.</p>
                    </div>
                     <!-- Card 2 -->
                    <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                         <h3 class="text-lg font-bold text-slate-900 mb-2">Mid-Core Strategy</h3>
                         <p class="text-slate-600 text-sm">Deeper systems and progression mechanics for dedicated players.</p>
                    </div>
                     <!-- Card 3 -->
                    <div class="bg-slate-50 p-6 rounded-xl border border-slate-200">
                         <h3 class="text-lg font-bold text-slate-900 mb-2">Live Operations</h3>
                         <p class="text-slate-600 text-sm">Long-term support, events, and content updates to keep communities alive.</p>
                    </div>
                </div>
            </div>
            
            <!-- CTA -->
            <div class="mt-20 bg-brand-600 rounded-3xl overflow-hidden shadow-xl lg:flex lg:items-center p-10 lg:p-14">
                <div class="flex-1">
                    <h2 class="text-2xl font-bold tracking-tight text-white mb-4">Have a game idea?</h2>
                    <p class="text-brand-100 text-lg">
                        We partner with brands and publishers to bring visions to life.
                    </p>
                </div>
                <div class="mt-8 lg:mt-0 lg:ml-8">
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-lg text-brand-600 bg-white hover:bg-brand-50 transition-colors">
                        Get in Touch
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
