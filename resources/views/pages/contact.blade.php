@extends('layouts.app')

@section('title', 'Contact Us - TK Unity')

@section('content')
    <!-- Header -->
    <div class="bg-slate-50 py-16 sm:py-24 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">Contact Us</h1>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-500">
                    We'd love to hear from you. Please send us a message and we'll get back to you as soon as possible.
                </p>
            </div>
        </div>
    </div>


    <div class="flex-grow bg-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="max-w-lg mx-auto md:max-w-none md:grid md:grid-cols-2 md:gap-16">
                 <!-- Info Column -->
                <div class="mb-12 md:mb-0">
                    <h2 class="text-2xl font-bold text-slate-900 mb-8">Get in touch</h2>
                    
                    <div class="space-y-8">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-brand-50 text-brand-600">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-slate-900">Headquarters</h3>
                                <p class="mt-2 text-base text-slate-600">
                                    Lot 01 A3 Nguyen Sinh Sac, Hoa Minh Ward,<br>
                                    Lien Chieu District, Da Nang City, Vietnam
                                </p>
                            </div>
                        </div>

                         <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-brand-50 text-brand-600">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-slate-900">Phone</h3>
                                <p class="mt-2 text-base text-slate-600">
                                    0935309099
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <span class="inline-flex items-center justify-center h-12 w-12 rounded-lg bg-brand-50 text-brand-600">
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-slate-900">Email</h3>
                                <p class="mt-2 text-base text-slate-600">
                                    <a href="mailto:tkunity@support.com" class="hover:text-brand-600 transition-colors">tkunity@support.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Column -->
                <div class="bg-slate-50 rounded-2xl p-8 border border-slate-200">
                    <form action="{{ route('contact.submit') }}" method="POST" class="grid grid-cols-1 gap-y-6">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-slate-700">Full Name</label>
                            <div class="mt-1">
                                <input type="text" name="full_name" id="name" autocomplete="name" class="py-3 px-4 block w-full shadow-sm text-slate-900 focus:ring-brand-500 focus:border-brand-500 border-slate-300 rounded-lg bg-white" placeholder="John Doe">
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-slate-700">Email</label>
                            <div class="mt-1">
                                <input type="email" name="email" id="email" autocomplete="email" class="py-3 px-4 block w-full shadow-sm text-slate-900 focus:ring-brand-500 focus:border-brand-500 border-slate-300 rounded-lg bg-white" placeholder="you@example.com">
                            </div>
                        </div>
                         <div>
                            <label for="message" class="block text-sm font-medium text-slate-700">Message</label>
                            <div class="mt-1">
                                <textarea id="message" name="message" rows="4" class="py-3 px-4 block w-full shadow-sm text-slate-900 focus:ring-brand-500 focus:border-brand-500 border-slate-300 rounded-lg bg-white" placeholder="How can we help you?"></textarea>
                            </div>
                        </div>
                        {{-- Hidden fields for compatibility with existing controller if needed, or remove if not --}}
                        <input type="hidden" name="subject" value="Contact Form Submission">

                        <div>
                            <button type="submit" class="w-full inline-flex justify-center py-3 px-6 border border-transparent shadow-sm text-base font-medium rounded-lg text-white bg-brand-600 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-brand-500 transition-all">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
