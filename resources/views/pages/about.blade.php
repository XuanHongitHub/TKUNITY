@extends('layouts.app')

@section('title', 'About Us - TK Unity')

@section('content')
    <!-- Header -->
    <div class="bg-slate-50 py-16 sm:py-24 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">We are TK Unity</h1>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-500">
                Pioneering the intersection of interactive entertainment and artificial intelligence.
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-grow bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:py-24 lg:px-8">
            
            <!-- Company Profile (Official) -->
            <div class="mb-20">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-6 py-8 sm:p-10">
                        <h2 class="text-2xl font-bold text-slate-900 mb-6">Company Profile</h2>
                        <div class="border-t border-slate-100">
                            <dl class="divide-y divide-slate-100">
                                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-slate-500">Company Name</dt>
                                    <dd class="mt-1 text-sm text-slate-900 sm:mt-0 sm:col-span-2">TK UNITY COMPANY LIMITED</dd>
                                </div>
                                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-slate-500">Tax Code (TIN)</dt>
                                    <dd class="mt-1 text-sm text-slate-900 sm:mt-0 sm:col-span-2 font-mono">0402271698</dd>
                                </div>
                                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-slate-500">Founded</dt>
                                    <dd class="mt-1 text-sm text-slate-900 sm:mt-0 sm:col-span-2">April 09, 2025</dd>
                                </div>
                                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-slate-500">Headquarters</dt>
                                    <dd class="mt-1 text-sm text-slate-900 sm:mt-0 sm:col-span-2">Lot 01 A3 Nguyen Sinh Sac, Hoa Minh Ward, Lien Chieu District, Da Nang City, Vietnam</dd>
                                </div>
                                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-slate-500">Representative</dt>
                                    <dd class="mt-1 text-sm text-slate-900 sm:mt-0 sm:col-span-2">Bui D.T</dd>
                                </div>
                                <div class="py-4 sm:grid sm:grid-cols-3 sm:gap-4">
                                    <dt class="text-sm font-medium text-slate-500">Primary Industry</dt>
                                    <dd class="mt-1 text-sm text-slate-900 sm:mt-0 sm:col-span-2">Software Publishing & Mobile Application Development</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-16 items-center">
                <!-- Vision -->
                <div>
                     <div class="mb-8 rounded-2xl overflow-hidden shadow-lg border border-slate-100 bg-slate-50">
                        <img src="{{ asset('images/pages/about_team.png') }}" alt="TK Unity Team" class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-500">
                    </div>
                     <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-brand-100 rounded-lg">
                            <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900">Our Vision</h2>
                    </div>
                    <p class="text-lg text-slate-600 leading-relaxed">
                        To become a leading technology powerhouse in Southeast Asia, known for creating digital experiences that not only entertain but also enhance the quality of human life through intelligent innovation.
                    </p>
                </div>

                <!-- Values -->
                <div>
                     <div class="flex items-center gap-3 mb-4">
                        <div class="p-2 bg-brand-100 rounded-lg">
                            <svg class="w-6 h-6 text-brand-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900">Core Values</h2>
                    </div>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="flex-shrink-0 h-6 w-6 flex items-center justify-center">
                                <span class="h-2 w-2 bg-brand-500 rounded-full"></span>
                            </div>
                            <p class="ml-2 text-base text-slate-600"><strong>Integrity:</strong> We operate with transparency and honesty in all our dealings.</p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 h-6 w-6 flex items-center justify-center">
                                <span class="h-2 w-2 bg-brand-500 rounded-full"></span>
                            </div>
                            <p class="ml-2 text-base text-slate-600"><strong>Excellence:</strong> We strive for perfection in every line of code and every pixel of design.</p>
                        </li>
                        <li class="flex items-start">
                            <div class="flex-shrink-0 h-6 w-6 flex items-center justify-center">
                                <span class="h-2 w-2 bg-brand-500 rounded-full"></span>
                            </div>
                             <p class="ml-2 text-base text-slate-600"><strong>Innovation:</strong> We constantly explore new technologies to solve real-world problems.</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
