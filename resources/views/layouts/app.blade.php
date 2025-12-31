<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TK Unity')</title>
    
    {{-- TAILWIND CSS (CDN as per mockups) --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            900: '#0c4a6e',
                        },
                        fitness: {
                             50: '#ecfdf5',
                             100: '#d1fae5',
                             500: '#10b981',
                             600: '#059669',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white text-slate-800 antialiased font-sans flex flex-col min-h-screen">
    {{-- NAVBAR --}}
    <nav class="bg-white fixed top-0 left-0 right-0 z-50 border-b border-slate-200 h-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
            <div class="flex justify-between h-full items-center">
                <div class="flex-shrink-0 flex items-center gap-3">
                     <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 bg-brand-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-sm">TK</div>
                        <div class="flex flex-col">
                            <span class="font-bold text-lg leading-none text-slate-900 tracking-tight">TK UNITY</span>
                        </div>
                    </a>
                </div>
                <!-- Desktop Nav -->
                <div class="hidden md:flex space-x-8 items-center h-full">
                    <a href="{{ route('home') }}" class="inline-flex items-center h-full px-1 transition-all group">
                         <span class="{{ request()->routeIs('home') ? 'border-brand-600 text-brand-600 font-semibold border-b-2' : 'border-transparent text-slate-600 font-medium group-hover:text-brand-600 group-hover:border-brand-600 group-hover:border-b-2' }} pb-1 transition-all">Home</span>
                    </a>
                    <a href="{{ route('games') }}" class="inline-flex items-center h-full px-1 transition-all group">
                         <span class="{{ request()->routeIs('games') ? 'border-brand-600 text-brand-600 font-semibold border-b-2' : 'border-transparent text-slate-600 font-medium group-hover:text-brand-600 group-hover:border-brand-600 group-hover:border-b-2' }} pb-1 transition-all">Games</span>
                    </a>
                    <a href="{{ route('ai-trainer') }}" class="inline-flex items-center h-full px-1 transition-all group">
                        <span class="{{ request()->routeIs('ai-trainer') ? 'border-fitness-500 text-fitness-500 font-semibold border-b-2' : 'border-transparent text-slate-600 font-medium group-hover:text-brand-600 group-hover:border-brand-600 group-hover:border-b-2' }} pb-1 transition-all">AI Trainer</span>
                    </a>
                    <a href="{{ route('about') }}" class="inline-flex items-center h-full px-1 transition-all group">
                        <span class="{{ request()->routeIs('about') ? 'border-brand-600 text-brand-600 font-semibold border-b-2' : 'border-transparent text-slate-600 font-medium group-hover:text-brand-600 group-hover:border-brand-600 group-hover:border-b-2' }} pb-1 transition-all">About Us</span>
                    </a>
                    <div class="pl-4">
                        <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-6 py-2 border border-transparent text-sm font-medium rounded-full text-white bg-brand-600 hover:bg-brand-700 shadow-sm hover:shadow transition-all">
                            Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="pt-20">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-slate-900 text-white border-t border-slate-800 mt-auto">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 lg:gap-12">
                <!-- Col 1: Brand -->
                <div class="col-span-1 md:col-span-1">
                     <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-brand-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">TK</div>
                        <span class="font-bold text-xl tracking-tight text-white">TK UNITY</span>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">
                        Premier software development studio delivering high-performance games and AI fitness solutions.
                    </p>
                </div>

                <!-- Col 2: Company -->
                <div>
                    <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-6">Company</h3>
                    <ul class="space-y-4 text-sm text-slate-400">
                        <li><a href="{{ route('home') }}" class="hover:text-brand-500 transition-colors">Home</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-brand-500 transition-colors">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-brand-500 transition-colors">Contact</a></li>
                        <li><a href="{{ route('privacy') }}" class="hover:text-brand-500 transition-colors">Privacy Policy</a></li>
                        <li><a href="{{ route('terms') }}" class="hover:text-brand-500 transition-colors">Terms of Service</a></li>
                    </ul>
                </div>
                
                 <!-- Col 3: Solutions -->
                 <div>
                    <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-6">Solutions</h3>
                    <ul class="space-y-4 text-sm text-slate-400">
                        <li><a href="{{ route('games') }}" class="hover:text-brand-500 transition-colors">Game Development</a></li>
                        <li><a href="{{ route('ai-trainer') }}" class="hover:text-brand-500 transition-colors">AI Personal Trainer</a></li>
                    </ul>
                </div>

                <!-- Col 4: Contact -->
                <div>
                     <h3 class="text-sm font-semibold text-white tracking-wider uppercase mb-6">Contact Us</h3>
                     <ul class="space-y-4 text-sm text-slate-400">
                        <li class="flex items-start">
                             <svg class="h-6 w-6 text-brand-500 shrink-0 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                             <span>Lot 01 A3 Nguyen Sinh Sac, Hoa Minh Ward, Lien Chieu District, Da Nang City, Vietnam</span>
                        </li>
                        <li class="flex items-center">
                             <svg class="h-6 w-6 text-brand-500 shrink-0 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                             <a href="mailto:tkunity@support.com" class="hover:text-white transition-colors">tkunity@support.com</a>
                        </li>
                        <li class="flex items-center">
                             <svg class="h-6 w-6 text-brand-500 shrink-0 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                             <span>0935309099</span>
                        </li>
                     </ul>
                </div>
            </div>
            
            <div class="mt-12 pt-8 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center text-sm text-slate-500">
                <p>&copy; 2025 TK UNITY COMPANY LIMITED. All rights reserved.</p>
                <p>Tax ID: 0402271698</p>
            </div>
        </div>
    </footer>
</body>
</html>
