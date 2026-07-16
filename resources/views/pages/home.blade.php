@extends('layouts.app')

@section('title', 'Surma Agro - Global Agriculture Export & Import Company')

@php
$schema = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Organization',
    'name' => 'Surma Agro',
    'description' => 'Premium global agriculture export and import company.',
    'url' => url('/'),
    'logo' => asset('images/logo.png'),
    'sameAs' => ['https://facebook.com/surmaagro', 'https://linkedin.com/company/surmaagro', 'https://twitter.com/surmaagro'],
    'address' => ['@type' => 'PostalAddress', 'addressCountry' => 'BD'],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
@endphp

@push('schema')
<script type="application/ld+json">{!! $schema !!}</script>
@endpush



@section('content')
    <style>
        /* === Hero Responsive Height System ===
           Apply only on desktop (lg+) where the hero spans full viewport.
           Content-driven min-height, never clips. */
        @media (min-width: 1024px) {
            /* Default: tall monitors (≥1080px) keep the current spacious look */
            .hero-section {
                min-height: 100dvh;
            }
            /* For screens ≥1080px tall, fill exactly like before */
            @media (min-height: 1080px) {
                .hero-section {
                    height: 100vh;
                    min-height: 0;
                }
            }
            /* Moderate laptop screens (800–899px tall): compact spacing */
            @media (max-height: 899px) {
                .hero-section {
                    padding-top: 5rem;        /* pt-20  – was pt-24 (6rem) */
                }
                .hero-section .hero-heading {
                    font-size: clamp(1.75rem, 3.5vw, 2.5rem);  /* ~text-4xl on small */
                    line-height: 1.2;
                }
                .hero-section .hero-subtitle {
                    font-size: 0.875rem;       /* text-sm  – was text-lg */
                    line-height: 1.5;
                }
                .hero-section .hero-left-gap > :not([hidden]) ~ :not([hidden]) {
                    margin-top: 1.5rem;         /* space-y-6 – was space-y-8 */
                }
                .hero-section .hero-v-gap {
                    gap: 2rem;                  /* gap-8    – was gap-12 */
                }
                .hero-section .hero-card {
                    padding: 1rem;              /* p-4      – was p-5 */
                }
                .hero-section .hero-right-gap > :not([hidden]) ~ :not([hidden]) {
                    margin-top: 1rem;            /* space-y-4 – was space-y-6 */
                }
                .hero-section .hero-card-gap > :not([hidden]) ~ :not([hidden]) {
                    margin-top: 0.5rem;          /* space-y-2 – was space-y-3 */
                }
                .hero-section .hero-trust {
                    padding-top: 1rem;           /* pt-4     – was pt-6 */
                }
                .hero-section .hero-trust-gap {
                    gap: 1rem;                   /* gap-x-4  – was gap-x-8 */
                }
            }
            /* Very short laptop screens (≤799px tall): aggressive compactness */
            @media (max-height: 799px) {
                .hero-section {
                    padding-top: 4rem;           /* pt-16    – was pt-24 */
                }
                .hero-section .hero-heading {
                    font-size: clamp(1.5rem, 3vw, 2rem);   /* ~text-3xl */
                }
                .hero-section .hero-subtitle {
                    font-size: 0.75rem;          /* text-xs */
                    line-height: 1.4;
                }
                .hero-section .hero-left-gap > :not([hidden]) ~ :not([hidden]) {
                    margin-top: 1rem;             /* space-y-4 */
                }
                .hero-section .hero-card {
                    padding: 0.75rem;            /* p-3 */
                }
                .hero-section .hero-card-gap > :not([hidden]) ~ :not([hidden]) {
                    margin-top: 0.25rem;          /* space-y-1 */
                }
                .hero-section .hero-btn {
                    padding: 0.625rem 1.25rem;   /* ~px-5 py-2.5 */
                    font-size: 0.8125rem;
                }
                .hero-section .hero-card-title {
                    font-size: 0.9375rem;        /* ~text-[15px] */
                }
                .hero-section .hero-card-text {
                    font-size: 0.6875rem;        /* ~text-[11px] */
                }
            }
        }
    </style>

    {{-- Redesigned SaaS Premium Hero Section --}}
    <section class="relative min-h-[100dvh] flex items-center bg-[#060f0c] pt-20 lg:pt-24 pb-8 lg:pb-0 z-10 hero-section">
        {{-- Vimeo Video Background Loop (full-cover on all devices) --}}
        <div aria-hidden="true" class="absolute inset-0 z-0 overflow-hidden pointer-events-none select-none bg-[#060f0c]">
            <div aria-hidden="true" class="absolute inset-0 opacity-50 pointer-events-none select-none bg-cover bg-center"
                 style="background-image: url('{{ asset('storage/ai-images/hero/rice-mill-0Xirz8ysRN.webp') }}');">
                <iframe 
                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 min-w-full min-h-full pointer-events-none select-none"
                    src="https://player.vimeo.com/video/1210138892?h=0c9f0b85ab&background=1&autoplay=1&loop=1&muted=1&dnt=1" 
                    frameborder="0" 
                    allow="autoplay; fullscreen" 
                    title="Surma Agro Hero Background"
                    loading="eager"
                    style="aspect-ratio: 16/9; width: auto; height: auto; pointer-events: none; user-select: none;">
                </iframe>
            </div>
            <div class="absolute inset-0 bg-gradient-to-b from-[#060f0c]/40 via-[#060f0c]/65 to-[#060f0c] z-10"></div>
            <div class="absolute inset-0 bg-grid-glow opacity-30 z-20"></div>
        </div>

        {{-- Ambient Aurora Glow Effects --}}
        <div class="absolute top-1/4 left-10 w-96 h-96 radial-glow-forest pointer-events-none -translate-y-1/2 z-10"></div>
        <div class="absolute bottom-1/4 right-10 w-[500px] h-[500px] radial-glow-gold pointer-events-none translate-y-1/3 z-10"></div>
        <div class="absolute top-1/2 left-1/3 w-80 h-80 radial-glow-forest pointer-events-none opacity-40 z-10"></div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 lg:py-0 w-full flex flex-col justify-center h-full">
            <div class="grid lg:grid-cols-12 gap-8 lg:gap-12 hero-v-gap items-center">
                {{-- Left Column: Headline, Subtitle, CTAs & Social Proof --}}
                <div class="lg:col-span-6 space-y-6 lg:space-y-8 hero-left-gap animate-hero-up text-center lg:text-left">
                    <div>
                        {{-- Verified supply chain pill --}}
                        <span class="inline-flex items-center gap-2 px-3 py-1 bg-forest-900/80 border border-emerald-500/20 text-emerald-300 text-[11px] lg:text-xs font-semibold rounded-full mb-4 lg:mb-6 backdrop-blur-md shadow-sm mx-auto lg:mx-0">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            Verified B2B Agricultural Sourcing
                        </span>
                        
                        {{-- SaaS Bold Heading --}}
                        <h1 class="text-4xl sm:text-5xl lg:text-5xl xl:text-6xl font-bold tracking-tight text-white leading-[1.15] mb-4 lg:mb-6 hero-heading">
                            Premium Agro, <br>
                            <span class="text-[#D4883A]">Globally</span> Connected
                        </h1>
                        
                        {{-- High-Converting Copy --}}
                        <p class="text-sm sm:text-base lg:text-lg text-forest-200/85 leading-relaxed max-w-xl mx-auto lg:mx-0 hero-subtitle">
                            Accelerate your international sourcing with our audited producers, end-to-end global cold chains, and real-time compliance automation. From origin to port, guaranteed.
                        </p>
                    </div>

                    {{-- Staggered CTAs --}}
                    <div class="flex flex-col sm:flex-row gap-3 lg:gap-4 justify-center lg:justify-start">
                        <a href="{{ route('catalog.index') }}" class="group relative inline-flex items-center justify-center px-6 lg:px-8 py-3.5 lg:py-4 hero-btn bg-earth-600 hover:bg-earth-500 text-white text-sm lg:text-base font-semibold rounded-xl transition-all duration-300 shadow-lg shadow-earth-600/20 hover:shadow-earth-600/35 hover:-translate-y-0.5 overflow-hidden">
                            <span>Explore Products</span>
                            <svg class="w-4 h-4 lg:w-5 lg:h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                        <a href="{{ route('contact') }}" class="group inline-flex items-center justify-center px-6 lg:px-8 py-3.5 lg:py-4 hero-btn bg-white/5 hover:bg-white/10 text-white text-sm lg:text-base font-semibold rounded-xl transition-all duration-300 border border-white/10 hover:border-white/20 hover:-translate-y-0.5">
                            Get a Quote
                        </a>
                    </div>

                    {{-- Trust Indicators / Certifications --}}
                    <div class="pt-6 border-t border-white/5 flex flex-wrap items-center justify-center lg:justify-start gap-y-3 gap-x-6 lg:gap-x-8 text-forest-200/60 text-[10px] lg:text-xs tracking-wider uppercase font-semibold hero-trust hero-trust-gap">
                        <div class="flex items-center gap-1.5">
                            <span class="text-earth-400 text-sm">★★★★★</span>
                            <span class="text-white">4.9 RATING</span>
                        </div>
                        <div class="h-4 w-px bg-white/10 hidden sm:block"></div>
                        <div class="flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>30+ GLOBAL MARKETS</span>
                        </div>
                        <div class="h-4 w-px bg-white/10 hidden sm:block"></div>
                        <div>
                            <span>ISO &bull; HACCP &bull; FDA COMPLIANT</span>
                        </div>
                    </div>
                </div>

                {{-- Right Column: Typographic Services Directory --}}
                <div class="lg:col-span-6 space-y-4 lg:space-y-6 hero-right-gap animate-hero-left hero-delay-200">
                    <div class="flex flex-col gap-4 lg:gap-5 max-w-lg mx-auto w-full">
                        
                        {{-- Header text --}}
                        <div class="mb-1 text-center lg:text-left">
                            <p class="text-emerald-400 text-[10px] lg:text-xs font-bold uppercase tracking-widest">Our Global Divisions</p>
                            <h2 class="text-white text-xl lg:text-2xl font-bold tracking-tight mt-1">Core Business Services</h2>
                        </div>

                        {{-- Service 1: Premium Agro Catalog --}}
                        <a href="{{ route('catalog.index') }}" class="group block glass-panel rounded-2xl p-4 lg:p-5 hero-card hover:bg-white/[0.04] transition-all duration-300 border border-white/10 hover:border-earth-500/35 relative overflow-hidden">
                            <div class="absolute right-4 top-4 text-white/5 group-hover:text-earth-500/10 text-4xl lg:text-5xl font-bold font-mono transition-colors duration-300">01</div>
                            <div class="space-y-2 lg:space-y-3 hero-card-gap">
                                <span class="text-earth-400 text-[9px] lg:text-[10px] uppercase font-bold tracking-widest block">Agricultural Commodities &amp; Food</span>
                                <h3 class="text-white text-base lg:text-lg font-bold tracking-tight group-hover:text-earth-300 transition-colors flex items-center gap-1.5 hero-card-title">
                                    Agro-Industrial Export Catalog
                                    <svg class="w-3.5 h-3.5 lg:w-4 lg:h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </h3>
                                <p class="text-forest-200/60 text-[11px] lg:text-xs leading-relaxed max-w-sm hero-card-text">
                                    Sourcing premium non-basmati rice, value-added processed food products, and traditional agricultural items under strict quality standards.
                                </p>
                                <div class="flex flex-wrap gap-1.5 pt-0.5 text-[9px] lg:text-[10px] text-forest-200/50">
                                    <span class="px-2 py-0.5 bg-white/5 rounded border border-white/5">Premium Rice</span>
                                    <span class="px-2 py-0.5 bg-white/5 rounded border border-white/5">Processed Foods</span>
                                    <span class="px-2 py-0.5 bg-white/5 rounded border border-white/5">ISO Certified</span>
                                </div>
                            </div>
                        </a>

                        {{-- Service 2: Surma Fish --}}
                        <a href="{{ route('surma-fish') }}" class="group block glass-panel rounded-2xl p-4 lg:p-5 hero-card hover:bg-white/[0.04] transition-all duration-300 border border-white/10 hover:border-earth-500/35 relative overflow-hidden">
                            <div class="absolute right-4 top-4 text-white/5 group-hover:text-earth-500/10 text-4xl lg:text-5xl font-bold font-mono transition-colors duration-300">02</div>
                            <div class="space-y-2 lg:space-y-3 hero-card-gap">
                                <span class="text-emerald-400 text-[9px] lg:text-[10px] uppercase font-bold tracking-widest block">Seafood Division</span>
                                <h3 class="text-white text-base lg:text-lg font-bold tracking-tight group-hover:text-emerald-300 transition-colors flex items-center gap-1.5 hero-card-title">
                                    Surma Fish Export
                                    <svg class="w-3.5 h-3.5 lg:w-4 lg:h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </h3>
                                <p class="text-forest-200/60 text-[11px] lg:text-xs leading-relaxed max-w-sm hero-card-text">
                                    Premium processing, quick-freeze IQF technology, and global cold-chain shipping for high-grade ocean and freshwater seafood.
                                </p>
                                <div class="flex flex-wrap gap-1.5 pt-0.5 text-[9px] lg:text-[10px] text-forest-200/50">
                                    <span class="px-2 py-0.5 bg-white/5 rounded border border-white/5">Frozen Seafood</span>
                                    <span class="px-2 py-0.5 bg-white/5 rounded border border-white/5">HACCP &amp; FDA</span>
                                    <span class="px-2 py-0.5 bg-white/5 rounded border border-white/5">Cold Chain</span>
                                </div>
                            </div>
                        </a>

                        {{-- Service 3: Change Box Services --}}
                        <a href="{{ route('change-box') }}" class="group block glass-panel rounded-2xl p-4 lg:p-5 hero-card hover:bg-white/[0.04] transition-all duration-300 border border-white/10 hover:border-earth-500/35 relative overflow-hidden">
                            <div class="absolute right-4 top-4 text-white/5 group-hover:text-earth-500/10 text-4xl lg:text-5xl font-bold font-mono transition-colors duration-300">03</div>
                            <div class="space-y-2 lg:space-y-3 hero-card-gap">
                                <span class="text-earth-400 text-[9px] lg:text-[10px] uppercase font-bold tracking-widest block">Business &amp; Logistics Hub</span>
                                <h3 class="text-white text-base lg:text-lg font-bold tracking-tight group-hover:text-earth-300 transition-colors flex items-center gap-1.5 hero-card-title">
                                    Change Box Services
                                    <svg class="w-3.5 h-3.5 lg:w-4 lg:h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </h3>
                                <p class="text-forest-200/60 text-[11px] lg:text-xs leading-relaxed max-w-sm hero-card-text">
                                    End-to-end B2B company incorporation, trade logistics, corporate travel management, and global supply chain compliance.
                                </p>
                                <div class="flex flex-wrap gap-1.5 pt-0.5 text-[9px] lg:text-[10px] text-forest-200/50">
                                    <span class="px-2 py-0.5 bg-white/5 rounded border border-white/5">Incorporation</span>
                                    <span class="px-2 py-0.5 bg-white/5 rounded border border-white/5">Freight Forwarding</span>
                                    <span class="px-2 py-0.5 bg-white/5 rounded border border-white/5">Global SLA</span>
                                </div>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-6 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-5 h-5 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>


    {{-- Company Overview --}}
    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div data-gsap="fade-right" class="text-center lg:text-left">
                    <span class="inline-block px-4 py-2 bg-forest-50 text-forest-700 text-sm font-semibold rounded-full mb-4 mx-auto lg:mx-0">About Surma Agro</span>
                    <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-6">
                        Your Trusted Partner in<br>
                        <span class="text-earth-600">Global Agriculture Trade</span>
                    </h2>
                    <p class="text-forest-500 text-lg leading-relaxed mb-6 max-w-xl mx-auto lg:mx-0">
                        Surma Agro is a premier B2B agriculture export and import company dedicated to bridging global markets with premium agricultural commodities. With decades of experience, we ensure quality, compliance, and reliability in every shipment.
                    </p>
                    <div class="space-y-4 inline-block text-left">
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-forest-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5 text-forest-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            </div>
                            <p class="text-forest-600 text-sm">ISO & HACCP certified processing facilities</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-forest-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5 text-forest-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            </div>
                            <p class="text-forest-600 text-sm">End-to-end logistics & supply chain management</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-6 h-6 bg-forest-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5 text-forest-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            </div>
                            <p class="text-forest-600 text-sm">Global network spanning 30+ countries</p>
                        </div>
                    </div>
                    <a href="{{ route('about') }}" class="inline-flex items-center mt-8 px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all mx-auto lg:mx-0">
                        Learn More About Us
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
                <div class="relative" data-gsap="fade-left">
                    <div class="aspect-[4/3] bg-gradient-to-br from-forest-100 to-forest-50 rounded-3xl overflow-hidden">
                        <img src="{{ asset('storage/ai-images/factory/about-surma-agro.png') }}" alt="Surma Agro - Global Agriculture Trade" class="w-full h-full object-cover" loading="eager">
                    </div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-earth-100 rounded-2xl -z-10"></div>
                    <div class="absolute -top-6 -right-6 w-24 h-24 bg-forest-100 rounded-2xl -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- Statistics Section --}}
    <section class="py-20 bg-forest-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-gsap="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">Surma Agro by the Numbers</h2>
                <p class="text-forest-300 text-lg">Our commitment to excellence reflected in every metric</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <x-stat-card label="Countries Served" :value="30" suffix="+" icon="" />
                <x-stat-card label="Years Experience" :value="25" suffix="+" icon="" />
                <x-stat-card label="Shipments Annually" :value="500" suffix="+" icon="" />
                <x-stat-card label="Product Categories" :value="50" suffix="+" icon="" />
            </div>
        </div>
    </section>

    {{-- Product Categories --}}
    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <span class="inline-block px-4 py-2 bg-forest-50 text-forest-700 text-sm font-semibold rounded-full mb-4">Our Products</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Premium Product Categories</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">Comprehensive range of agricultural commodities and food products for global B2B markets</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="{{ route('catalog.category', 'export-items') }}" class="group relative overflow-hidden rounded-2xl bg-white border border-warm-gray/50 hover:shadow-lg transition-all duration-300" data-gsap="fade-up">
                    <div class="aspect-[4/3] overflow-hidden relative">
                        <img src="{{ asset('storage/Premium%20Product%20Categories/Export%20Items.webp') }}" alt="Export Items - Agricultural Commodities" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-lg font-bold mb-1">Export Items</h3>
                            <p class="text-white/80 text-sm">Agricultural commodities & raw materials</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('catalog.category', 'frozen-export-items') }}" class="group relative overflow-hidden rounded-2xl bg-white border border-warm-gray/50 hover:shadow-lg transition-all duration-300" data-gsap="fade-up">
                    <div class="aspect-[4/3] overflow-hidden relative">
                        <img src="{{ asset('storage/Premium%20Product%20Categories/Frozen%20Export.webp') }}" alt="Frozen Export - Premium Frozen Seafood" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-lg font-bold mb-1">Frozen Export</h3>
                            <p class="text-white/80 text-sm">Premium frozen seafood & products</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('catalog.category', 'processed-food-products') }}" class="group relative overflow-hidden rounded-2xl bg-white border border-warm-gray/50 hover:shadow-lg transition-all duration-300" data-gsap="fade-up">
                    <div class="aspect-[4/3] overflow-hidden relative">
                        <img src="{{ asset('storage/Premium%20Product%20Categories/Processed%20Foods.webp') }}" alt="Processed Foods - Value-added Products" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-lg font-bold mb-1">Processed Foods</h3>
                            <p class="text-white/80 text-sm">Value-added food products</p>
                        </div>
                    </div>
                </a>

                <a href="{{ route('catalog.category', 'dried-fish-export-items') }}" class="group relative overflow-hidden rounded-2xl bg-white border border-warm-gray/50 hover:shadow-lg transition-all duration-300" data-gsap="fade-up">
                    <div class="aspect-[4/3] overflow-hidden relative">
                        <img src="{{ asset('storage/Premium%20Product%20Categories/Dried%20Fish.webp') }}" alt="Dried Fish - Traditional Products" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                            <h3 class="text-lg font-bold mb-1">Dried Fish</h3>
                            <p class="text-white/80 text-sm">Traditional dried fish products</p>
                        </div>
                    </div>
                </a>
            </div>

            <div class="text-center mt-10" data-gsap="fade-up">
                <a href="{{ route('catalog.index') }}" class="inline-flex items-center px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">
                    View Full Catalog
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Featured Products --}}
    @if($featuredProducts->count() > 0)
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <span class="inline-block px-4 py-2 bg-forest-50 text-forest-700 text-sm font-semibold rounded-full mb-4">Featured Products</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Our Top Export Products</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">Premium quality products trusted by buyers across 30+ countries</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="text-center mt-10" data-gsap="fade-up">
                <a href="{{ route('catalog.index') }}" class="inline-flex items-center px-6 py-3 bg-earth-600 text-white font-semibold rounded-xl hover:bg-earth-500 transition-all">
                    Browse All Products
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>
    @endif

    {{-- Why Choose Surma Agro --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <span class="inline-block px-4 py-2 bg-forest-50 text-forest-700 text-sm font-semibold rounded-full mb-4">Why Choose Us</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">The Surma Agro Advantage</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">What sets us apart in the global agriculture trade industry</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-cream rounded-2xl p-8 border border-warm-gray/50 hover:shadow-lg transition-all duration-300" data-gsap="fade-up">
                    <div class="w-14 h-14 bg-forest-100 rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Quality Compliance</h3>
                    <p class="text-forest-500 text-sm leading-relaxed">ISO, HACCP, and international food safety standards certified</p>
                </div>

                <div class="bg-cream rounded-2xl p-8 border border-warm-gray/50 hover:shadow-lg transition-all duration-300" data-gsap="fade-up">
                    <div class="w-14 h-14 bg-forest-100 rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Global Logistics</h3>
                    <p class="text-forest-500 text-sm leading-relaxed">End-to-end supply chain solutions across 30+ countries</p>
                </div>

                <div class="bg-cream rounded-2xl p-8 border border-warm-gray/50 hover:shadow-lg transition-all duration-300" data-gsap="fade-up">
                    <div class="w-14 h-14 bg-forest-100 rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Global Sourcing</h3>
                    <p class="text-forest-500 text-sm leading-relaxed">Strategic sourcing from premium agricultural regions worldwide</p>
                </div>

                <div class="bg-cream rounded-2xl p-8 border border-warm-gray/50 hover:shadow-lg transition-all duration-300" data-gsap="fade-up">
                    <div class="w-14 h-14 bg-forest-100 rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Expert Team</h3>
                    <p class="text-forest-500 text-sm leading-relaxed">Dedicated professionals with decades of trade expertise</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Sub-Brands CTA --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <span class="inline-block px-4 py-2 bg-forest-50 text-forest-700 text-sm font-semibold rounded-full mb-4">Our Brands</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Explore Our Sub-Brands</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">Discover specialized services and products across our dedicated brand platforms</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                {{-- Surma Fish --}}
                <div class="group relative bg-gradient-to-br from-blue-900 via-blue-800 to-forest-800 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500" data-gsap="fade-up">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute -top-10 -right-10 w-48 h-48 bg-blue-300 rounded-full blur-3xl"></div>
                    </div>
                    <div class="relative z-10 p-8 lg:p-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/10">
                                <svg class="w-6 h-6 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            </div>
                            <span class="text-blue-300 text-sm font-semibold">Seafood &amp; Fish Export</span>
                        </div>
                        <h3 class="text-2xl lg:text-3xl font-bold text-white mb-3">Surma Fish</h3>
                        <p class="text-blue-200 leading-relaxed mb-6">
                            Premium fish sourcing, processing, freezing, and export. HACCP certified facilities exporting to 10+ countries. Specializing in frozen fish, dried fish, and processed seafood.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-8">
                            <span class="px-3 py-1 bg-white/10 backdrop-blur-sm text-blue-200 text-xs rounded-full border border-white/10">Frozen Fish</span>
                            <span class="px-3 py-1 bg-white/10 backdrop-blur-sm text-blue-200 text-xs rounded-full border border-white/10">Dried Fish</span>
                            <span class="px-3 py-1 bg-white/10 backdrop-blur-sm text-blue-200 text-xs rounded-full border border-white/10">Processed Seafood</span>
                            <span class="px-3 py-1 bg-white/10 backdrop-blur-sm text-blue-200 text-xs rounded-full border border-white/10">IQF Technology</span>
                        </div>
                        <a href="https://www.surmafish.com/" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center px-6 py-3 bg-white text-blue-900 font-semibold rounded-xl hover:bg-blue-50 transition-all shadow-lg">
                            Visit SurmaFish.com
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                </div>

                {{-- Change Box Services --}}
                <div class="group relative bg-gradient-to-br from-earth-800 via-forest-800 to-forest-900 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500" data-gsap="fade-up">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute -bottom-10 -left-10 w-48 h-48 bg-earth-400 rounded-full blur-3xl"></div>
                    </div>
                    <div class="relative z-10 p-8 lg:p-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-xl flex items-center justify-center border border-white/10">
                                <svg class="w-6 h-6 text-earth-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="text-earth-300 text-sm font-semibold">Business, Logistics &amp; Travel</span>
                        </div>
                        <h3 class="text-2xl lg:text-3xl font-bold text-white mb-3">Change Box Services</h3>
                        <p class="text-forest-200 leading-relaxed mb-6">
                            All-in-one partner for business setup, accounting, logistics, and travel services. From company incorporation and freight forwarding to visa processing and work permits.
                        </p>
                        <div class="flex flex-wrap gap-2 mb-8">
                            <span class="px-3 py-1 bg-white/10 backdrop-blur-sm text-forest-200 text-xs rounded-full border border-white/10">Business Setup</span>
                            <span class="px-3 py-1 bg-white/10 backdrop-blur-sm text-forest-200 text-xs rounded-full border border-white/10">Logistics</span>
                            <span class="px-3 py-1 bg-white/10 backdrop-blur-sm text-forest-200 text-xs rounded-full border border-white/10">Travel &amp; Visa</span>
                            <span class="px-3 py-1 bg-white/10 backdrop-blur-sm text-forest-200 text-xs rounded-full border border-white/10">Compliance</span>
                        </div>
                        <a href="https://changeboxservices.com/" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center px-6 py-3 bg-white text-earth-900 font-semibold rounded-xl hover:bg-earth-50 transition-all shadow-lg">
                            Visit ChangeBoxServices.com
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Global Presence --}}
    <section class="py-24 bg-cream relative overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 left-10 w-96 h-96 bg-earth-200 rounded-full blur-3xl opacity-30"></div>
            <div class="absolute bottom-20 right-10 w-[32rem] h-[32rem] bg-forest-100 rounded-full blur-3xl opacity-40"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-16" data-gsap="fade-up">
                <span class="inline-block px-4 py-2 bg-forest-700 text-white text-sm font-semibold rounded-full mb-4">Global Network</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Our Global Presence</h2>
                <div class="w-20 h-1 bg-earth-500 rounded-full mx-auto mb-4"></div>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">Strategic offices connecting markets across continents</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5" data-gsap="fade-up">
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-forest-600 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <img src="https://flagcdn.com/w40/us.png" alt="US" class="w-12 h-8 object-cover rounded shadow-sm shrink-0">
                            <div>
                                <p class="font-bold text-forest-800 text-base">USA Office</p>
                                <p class="text-forest-500 text-sm">Jackson Heights, NY</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-transparent hover:border-forest-600 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <img src="https://flagcdn.com/w40/ca.png" alt="CA" class="w-12 h-8 object-cover rounded shadow-sm shrink-0">
                            <div>
                                <p class="font-bold text-forest-800 text-base">Canada Office</p>
                                <p class="text-forest-500 text-sm">Toronto, ON</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-transparent hover:border-forest-600 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <img src="https://flagcdn.com/w40/om.png" alt="OM" class="w-12 h-8 object-cover rounded shadow-sm shrink-0">
                            <div>
                                <p class="font-bold text-forest-800 text-base">Oman Office</p>
                                <p class="text-forest-500 text-sm">South Al Batinah</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-transparent hover:border-forest-600 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <img src="https://flagcdn.com/w40/bd.png" alt="BD" class="w-12 h-8 object-cover rounded shadow-sm shrink-0">
                            <div>
                                <p class="font-bold text-forest-800 text-base">Bangladesh Office</p>
                                <p class="text-forest-500 text-sm">Dhaka &amp; Chittagong</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-transparent hover:border-forest-600 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <img src="https://flagcdn.com/w40/th.png" alt="TH" class="w-12 h-8 object-cover rounded shadow-sm shrink-0">
                            <div>
                                <p class="font-bold text-forest-800 text-base">Thailand Office</p>
                                <p class="text-forest-500 text-sm">Bangkok</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 border-l-4 border-transparent hover:border-forest-600 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <img src="https://flagcdn.com/w40/mm.png" alt="MM" class="w-12 h-8 object-cover rounded shadow-sm shrink-0">
                            <div>
                                <p class="font-bold text-forest-800 text-base">Myanmar Office</p>
                                <p class="text-forest-500 text-sm">Yangon</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-10" data-gsap="fade-up">
                <a href="{{ route('presence') }}" class="inline-flex items-center px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all shadow-lg shadow-forest-700/20">
                    View All Locations
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Certificates / Logo Marquee --}}
    <section class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <span class="inline-block px-4 py-2 bg-forest-50 text-forest-700 text-sm font-semibold rounded-full mb-4">Our Certifications</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Certified Excellence</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">Internationally recognized certifications ensuring quality and compliance</p>
            </div>

            {{-- Continuous Scrolling Logos --}}
            <div class="flex justify-center" data-gsap="fade-up">
                <div class="logo-marquee">
                    <div class="logo-marquee-track">
                        @php
                            $certificateImages = ['L1.webp', 'L2.webp', 'L3.webp', 'L4.webp', 'L5.webp', 'L6.webp', 'L7.webp'];
                            // Duplicate images for seamless scroll
                            $allImages = array_merge($certificateImages, $certificateImages);
                        @endphp
                        @foreach($allImages as $image)
                            <img src="{{ asset('storage/certificate_images/' . $image) }}" alt="Certificate Image">
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-center mt-16" data-gsap="fade-up">
                <a href="{{ route('certificates') }}" class="inline-flex items-center px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">
                    View All Certifications
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <span class="inline-block px-4 py-2 bg-forest-50 text-forest-700 text-sm font-semibold rounded-full mb-4">Testimonials</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">What Our Partners Say</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">Trusted by leading importers and distributors worldwide</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <x-testimonial-card
                    name="James Mitchell"
                    company="Global Foods Inc."
                    designation="Procurement Director"
                    :rating="5"
                    content="Surma Agro has been our trusted partner for agricultural imports. Their consistency in quality and timely deliveries is exceptional."
                />
                <x-testimonial-card
                    name="Sarah Al-Rashid"
                    company="Middle East Food Supply"
                    designation="CEO"
                    :rating="5"
                    content="The professionalism and quality standards of Surma Agro set them apart. They understand B2B requirements perfectly."
                />
                <x-testimonial-card
                    name="Tanaka Hiroshi"
                    company="Asia Pacific Trading"
                    designation="Operations Manager"
                    :rating="5"
                    content="Working with Surma Agro has streamlined our supply chain. Their frozen seafood products meet the highest international standards."
                />
            </div>
        </div>
    </section>

    {{-- B2B CTA --}}
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-cta-section
                title="Ready to Start a Partnership?"
                description="Connect with our B2B trade experts. We respond to all inquiries within 24 hours."
                buttonText="Send Inquiry"
                buttonLink="{{ route('contact') }}"
            />
        </div>
    </section>

    <style>
        .floating-shape {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-20px) rotate(5deg); }
            66% { transform: translateY(10px) rotate(-3deg); }
        }

        .logo-marquee {
            overflow: hidden;
            width: 1172px; /* 7 images (140px each) + 6 gaps (32px each) = 980 + 192 = 1172px */
            max-width: 100%;
            mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
            -webkit-mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
        }

        .logo-marquee-track {
            display: flex;
            gap: 2rem;
            width: max-content;
            animation: scroll-right 30s linear infinite;
            will-change: transform;
            align-items: center;
        }

        .logo-marquee-track img {
            width: 140px;
            height: auto;
            object-fit: contain;
            flex-shrink: 0;
        }

        @keyframes scroll-right {
            0% { transform: translateX(-1172px); } /* Width of 7 images (140px each) + 6 gaps (32px each) = 980 + 192 = 1172px */
            100% { transform: translateX(0); }
        }
    </style>
@endsection
