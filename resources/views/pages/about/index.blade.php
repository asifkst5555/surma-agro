@extends('layouts.app')

@section('title', 'About Us - Surma Agro')
@section('meta_description', 'Learn about Surma Agro, a premier global agriculture export and import company with decades of experience in international trade.')

@php
$aboutSchema = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'AboutPage',
    'name' => 'About Surma Agro',
    'description' => 'Premium global agriculture export and import company.',
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
@endphp

@push('schema')
<script type="application/ld+json">{!! $aboutSchema !!}</script>
@endpush

@section('content')
    {{-- Hero --}}
    <section class="relative pt-32 pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
        <div class="absolute inset-0">
            <img src="{{ asset('storage/ai-images/factory/agro-factory-IndTaYp9Hu.webp') }}" alt="" class="w-full h-full object-cover opacity-15" loading="eager">
        </div>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-earth-500 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-6 border border-white/10">About Us</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">Our Story</h1>
            <p class="text-lg lg:text-xl text-forest-200 max-w-3xl mx-auto leading-relaxed">
                From local roots to global reach — Surma Agro has been bridging international markets with premium agricultural products for over two decades.
            </p>
        </div>
    </section>

    {{-- Mission & Vision --}}
    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl p-10 border border-warm-gray/50 shadow-sm" data-gsap="fade-up">
                    <div class="w-14 h-14 bg-forest-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-forest-800 mb-4">Our Mission</h2>
                    <p class="text-forest-500 leading-relaxed">
                        To be the most reliable bridge between global agricultural producers and international markets, delivering quality, consistency, and trust in every transaction.
                    </p>
                </div>
                <div class="bg-white rounded-2xl p-10 border border-warm-gray/50 shadow-sm" data-gsap="fade-up">
                    <div class="w-14 h-14 bg-forest-100 rounded-2xl flex items-center justify-center mb-6">
                        <svg class="w-7 h-7 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <h2 class="text-2xl font-bold text-forest-800 mb-4">Our Vision</h2>
                    <p class="text-forest-500 leading-relaxed">
                        To become the leading South Asian agriculture export house, recognized globally for quality, innovation, and sustainable trade practices.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Values --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Our Core Values</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">The principles that guide every business relationship</p>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="text-center p-8" data-gsap="fade-up">
                    <div class="w-16 h-16 bg-forest-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Integrity</h3>
                    <p class="text-forest-500 text-sm">Transparent and honest business practices in every transaction</p>
                </div>
                <div class="text-center p-8" data-gsap="fade-up">
                    <div class="w-16 h-16 bg-forest-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Excellence</h3>
                    <p class="text-forest-500 text-sm">Uncompromising quality standards across all operations</p>
                </div>
                <div class="text-center p-8" data-gsap="fade-up">
                    <div class="w-16 h-16 bg-forest-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Global Reach</h3>
                    <p class="text-forest-500 text-sm">Connecting markets worldwide with seamless logistics</p>
                </div>
            </div>
        </div>
    </section>
@endsection
