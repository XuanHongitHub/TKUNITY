@extends('layouts.app')

@section('title', 'AI Personal Trainer - TK Unity')

@section('content')
     <div class="bg-fitness-50 border-b border-fitness-100">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8 lg:flex lg:items-center lg:justify-between">
            <div class="lg:w-1/2">
                <h1 class="text-3xl font-bold tracking-tight text-slate-900 sm:text-4xl">
                    Smart Fitness Intelligence
                </h1>
                <p class="mt-4 text-xl text-slate-600 max-w-lg">
                    We are building the future of personal well-being by combining Computer Vision with professional fitness coaching.
                </p>
            </div>
             <div class="mt-8 lg:mt-0 lg:w-1/2 flex justify-center lg:justify-end">
                <div class="relative w-full max-w-lg rounded-2xl overflow-hidden shadow-2xl border-4 border-white/50">
                    <img src="{{ asset('images/pages/ai_fitness_tech.png') }}" alt="AI Fitness Analysis" class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-700">
                </div>
            </div>
        </div>
    </div>


     <div class="py-16 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                 <h2 class="text-lg font-semibold text-fitness-500 tracking-wide uppercase">Core Features</h2>
                 <p class="mt-2 text-3xl font-bold text-slate-900">Technology for Better Health</p>
            </div>

             <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <div class="pt-6">
                    <div class="flow-root bg-slate-50 rounded-2xl px-6 pb-8 border border-slate-100 hover:border-fitness-500 transition-colors h-full">
                        <div class="-mt-6">
                            <div class="inline-flex items-center justify-center p-3 bg-fitness-500 rounded-xl shadow-lg">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="mt-8 text-lg font-bold text-slate-900 tracking-tight">Real-Time Correction</h3>
                            <p class="mt-5 text-base text-slate-500">
                                AI analyzes your movements instantly to ensure perfect form and prevent injury.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <div class="flow-root bg-slate-50 rounded-2xl px-6 pb-8 border border-slate-100 hover:border-fitness-500 transition-colors h-full">
                        <div class="-mt-6">
                            <div class="inline-flex items-center justify-center p-3 bg-fitness-500 rounded-xl shadow-lg">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="mt-8 text-lg font-bold text-slate-900 tracking-tight">Personalized Plans</h3>
                            <p class="mt-5 text-base text-slate-500">
                                Dynamic workout plans that adapt to your progress and energy levels daily.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="pt-6">
                    <div class="flow-root bg-slate-50 rounded-2xl px-6 pb-8 border border-slate-100 hover:border-fitness-500 transition-colors h-full">
                        <div class="-mt-6">
                            <div class="inline-flex items-center justify-center p-3 bg-fitness-500 rounded-xl shadow-lg">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="mt-8 text-lg font-bold text-slate-900 tracking-tight">Accessible Everywhere</h3>
                            <p class="mt-5 text-base text-slate-500">
                                No specialized hardware needed. Just your smartphone camera and our app.
                            </p>
                        </div>
                    </div>
                </div>
             </div>
        </div>
     </div>
@endsection
