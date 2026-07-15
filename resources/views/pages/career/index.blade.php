@extends('layouts.app')

@section('title', 'Careers - Join Surma Agro Team')
@section('meta_description', 'Explore career opportunities at Surma Agro. Join our global team in agriculture export, seafood, logistics, and more.')

@section('content')
    <section class="relative pt-32 pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-earth-600 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-6 border border-white/10">Careers</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">Join Our Team</h1>
            <p class="text-lg lg:text-xl text-forest-200 max-w-3xl mx-auto leading-relaxed">
                Be part of a global mission to connect markets with quality agricultural products. Grow your career with Surma Agro.
            </p>
        </div>
    </section>

    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Why Work With Us</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">At Surma Agro, we invest in our people and build careers that matter.</p>
            </div>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm text-center">
                    <div class="w-14 h-14 bg-forest-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <svg class="w-7 h-7 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Professional Growth</h3>
                    <p class="text-forest-500 text-sm">Continuous learning, mentorship, and clear career progression paths.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm text-center">
                    <div class="w-14 h-14 bg-forest-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <svg class="w-7 h-7 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Inclusive Culture</h3>
                    <p class="text-forest-500 text-sm">A diverse, respectful workplace where every voice is heard and valued.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm text-center">
                    <div class="w-14 h-14 bg-forest-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <svg class="w-7 h-7 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Comprehensive Benefits</h3>
                    <p class="text-forest-500 text-sm">Competitive salary, health coverage, and performance-based incentives.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm text-center">
                    <div class="w-14 h-14 bg-forest-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                        <svg class="w-7 h-7 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Global Impact</h3>
                    <p class="text-forest-500 text-sm">Work on projects that move economies and feed communities worldwide.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-warm-light">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Open Positions</h2>
                <p class="text-forest-500 text-lg">Find your next opportunity at Surma Agro.</p>
            </div>
            @forelse($careers as $career)
                <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm mb-4" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full flex items-center justify-between p-6 text-left">
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-forest-800">{{ $career->title }}</h3>
                            <div class="flex flex-wrap items-center gap-3 mt-2 text-sm text-forest-500">
                                <span>{{ $career->department }}</span>
                                <span class="text-warm-gray">&middot;</span>
                                <span>{{ $career->location }}</span>
                                <span class="px-2.5 py-0.5 bg-earth-100 text-earth-700 text-xs font-semibold rounded-full">{{ $career->type }}</span>
                            </div>
                        </div>
                        <svg class="w-5 h-5 text-forest-400 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" x-collapse>
                        <div class="px-6 pb-6">
                            <p class="text-forest-500 leading-relaxed mb-4">{{ $career->short_description }}</p>
                            <a href="{{ route('careers.show', $career->slug) }}" class="inline-block px-6 py-2.5 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all shadow-lg shadow-forest-700/20 text-sm">
                                Apply Now
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-16">
                    <div class="w-16 h-16 bg-forest-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-forest-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-forest-800 mb-2">No Open Positions</h3>
                    <p class="text-forest-500">We don't have any openings right now. Please check back later.</p>
                </div>
            @endforelse
        </div>
    </section>
@endsection
