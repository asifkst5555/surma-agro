@extends('layouts.app')

@section('title', 'Surma Fish - Premium Seafood & Fish Products - Surma Agro')
@section('meta_description', 'Discover Surma Fish sub-brand - premium quality frozen fish, dried fish, and processed seafood products for global B2B markets.')

@php
$surmaFishSchema = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'Brand',
    'name' => 'Surma Fish',
    'description' => 'Premium seafood and fish products sub-brand of Surma Agro',
    'url' => url()->current(),
    'brand' => ['@type' => 'Brand', 'name' => 'Surma Fish'],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
@endphp

@push('schema')
<script type="application/ld+json">{!! $surmaFishSchema !!}</script>
@endpush

@section('content')
    {{-- Visit Surma Fish Website CTA --}}
    <section class="min-h-screen pt-32 bg-gradient-to-br from-blue-900 via-blue-800 to-forest-800 relative overflow-hidden flex items-center">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 right-20 w-96 h-96 bg-blue-300 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 left-10 w-64 h-64 bg-forest-400 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left" data-gsap="fade-right">
                    <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-blue-300 text-sm font-semibold rounded-full mb-6 border border-white/10 mx-auto lg:mx-0">Visit Our Website</span>
                    <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">Explore Surma Fish</h2>
                    <p class="text-lg text-blue-200 leading-relaxed mb-8 max-w-xl mx-auto lg:mx-0">
                        Discover our complete range of premium fish and seafood products. From sourcing and processing to global delivery — learn more about our certifications, processing facilities, and quality commitment.
                    </p>
                    <div class="inline-block text-left">
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center gap-3 text-blue-200">
                                <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Specialized in fish sourcing, processing & export since 2016</span>
                            </li>
                            <li class="flex items-center gap-3 text-blue-200">
                                <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Exporting to 10+ countries worldwide</span>
                            </li>
                            <li class="flex items-center gap-3 text-blue-200">
                                <svg class="w-5 h-5 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>State-of-the-art processing facilities & HACCP certified</span>
                            </li>
                        </ul>
                    </div>
                    <a href="https://www.surmafish.com/" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center px-8 py-4 bg-white text-blue-900 font-bold rounded-xl hover:bg-blue-50 transition-all shadow-xl shadow-blue-900/20 hover:shadow-blue-900/30 text-lg mx-auto lg:mx-0">
                        Visit SurmaFish.com
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
                <div class="hidden lg:grid grid-cols-2 gap-4" data-gsap="fade-left">
                    <img src="{{ asset('storage/Surma Agro Products/Frozen Export Items/Frozen Hilsa.webp') }}" alt="Surma Fish Products" class="rounded-2xl aspect-square object-cover shadow-lg">
                    <img src="{{ asset('storage/Surma Agro Products/Frozen Export Items/Frozen Silver Pomfret.webp') }}" alt="Surma Fish Seafood" class="rounded-2xl aspect-square object-cover shadow-lg mt-8">
                    <img src="{{ asset('storage/Surma Agro Products/Dried Fish Export Items/Dried Hilsa Fish.webp') }}" alt="Surma Fish Dried" class="rounded-2xl aspect-square object-cover shadow-lg -mt-8">
                    <img src="{{ asset('storage/Surma Agro Products/Frozen Export Items/Frozen Rahu.webp') }}" alt="Surma Fish Hilsa" class="rounded-2xl aspect-square object-cover shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">About Surma Fish</h2>
                <p class="text-forest-500 text-lg max-w-3xl mx-auto">Surma Fish is a globally recognized company specializing in fish sourcing, processing, freezing, and export. Established in 2016, we are committed to quality and excellence, which has allowed us to expand operations and export fish products to ten destinations worldwide including Bangladesh, India, Malaysia, UAE, Qatar, Oman, South Korea, Italy, Canada, and the USA. Our goal is to become one of the leading fish processing companies in the industry by 2030.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8" data-gsap="fade-up">
                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all text-center lg:text-left">
                    <h3 class="text-xl font-bold text-forest-800 mb-3">Our Mission</h3>
                    <p class="text-forest-500 text-sm leading-relaxed">To provide premium-quality fish products to customers worldwide by maintaining the highest standards of sourcing, processing, and sustainability. Through innovation and excellence, we aim to empower communities, support local economies, and ensure environmental responsibility in every step of our operations.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all text-center lg:text-left">
                    <h3 class="text-xl font-bold text-forest-800 mb-3">Our Vision</h3>
                    <p class="text-forest-500 text-sm leading-relaxed">To become a global leader in the fish processing and export industry by 2030, renowned for our quality, sustainability, and innovation. We aspire to create a lasting impact by fostering partnerships, embracing cutting-edge technologies, and promoting a sustainable seafood ecosystem.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all text-center lg:text-left">
                    <h3 class="text-xl font-bold text-forest-800 mb-3">Our Values</h3>
                    <div class="flex flex-wrap gap-2 justify-center lg:justify-start">
                        <span class="px-3 py-1 bg-blue-50 text-blue-700 text-xs font-medium rounded-full">Quality Excellence</span>
                        <span class="px-3 py-1 bg-green-50 text-green-700 text-xs font-medium rounded-full">Sustainability</span>
                        <span class="px-3 py-1 bg-amber-50 text-amber-700 text-xs font-medium rounded-full">Integrity</span>
                        <span class="px-3 py-1 bg-purple-50 text-purple-700 text-xs font-medium rounded-full">Customer-Centricity</span>
                        <span class="px-3 py-1 bg-cyan-50 text-cyan-700 text-xs font-medium rounded-full">Innovation</span>
                        <span class="px-3 py-1 bg-rose-50 text-rose-700 text-xs font-medium rounded-full">Collaboration</span>
                        <span class="px-3 py-1 bg-indigo-50 text-indigo-700 text-xs font-medium rounded-full">Adaptability</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-cream overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <span class="inline-block px-4 py-2 bg-blue-50 text-blue-700 text-sm font-semibold rounded-full mb-4">Global Reach</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Export Destinations</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">We proudly serve customers across the globe</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-gsap="fade-up">
            <div class="country-marquee">
                <div class="country-marquee-track">
                    @php
                        $countries = [
                            ['code' => 'bd', 'name' => 'Bangladesh'],
                            ['code' => 'in', 'name' => 'India'],
                            ['code' => 'my', 'name' => 'Malaysia'],
                            ['code' => 'ae', 'name' => 'UAE'],
                            ['code' => 'qa', 'name' => 'Qatar'],
                            ['code' => 'om', 'name' => 'Oman'],
                            ['code' => 'kr', 'name' => 'South Korea'],
                            ['code' => 'it', 'name' => 'Italy'],
                            ['code' => 'ca', 'name' => 'Canada'],
                            ['code' => 'us', 'name' => 'USA'],
                        ];
                        $allCountries = array_merge($countries, $countries);
                    @endphp
                    @foreach($allCountries as $country)
                        <div class="country-marquee-item">
                            <img src="https://flagcdn.com/w40/{{ $country['code'] }}.png" alt="{{ $country['code'] }}" class="w-8 h-6 object-cover rounded shadow-sm">
                            <span>{{ $country['name'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

<style>
    .country-marquee {
        overflow: hidden;
        width: 100%;
        mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
        -webkit-mask-image: linear-gradient(to right, transparent 0%, black 10%, black 90%, transparent 100%);
    }

    .country-marquee-track {
        display: flex;
        gap: 1.5rem;
        width: max-content;
        animation: scroll-right 25s linear infinite;
        will-change: transform;
        align-items: center;
    }

    .country-marquee-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1.25rem;
        background: white;
        border-radius: 0.75rem;
        border: 1px solid rgba(0,0,0,0.05);
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        font-size: 0.875rem;
        font-weight: 600;
        color: #166534;
        flex-shrink: 0;
        transition: all 0.2s;
    }

    .country-marquee-item:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        border-color: #166534;
    }

    @keyframes scroll-right {
        0% { transform: translateX(-1172px); }
        100% { transform: translateX(0); }
    }
</style>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Our Fish Products</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">Premium quality fish and seafood for international B2B buyers</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-cream rounded-2xl overflow-hidden border border-warm-gray/50 hover:shadow-lg transition-all" data-gsap="fade-up">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ asset('storage/Surma Agro Products/Frozen Export Items/Frozen Hilsa.webp') }}" alt="Freshwater Fish" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-forest-800 mb-2">Freshwater Fish</h3>
                        <div class="text-forest-500 text-sm leading-relaxed">Rohu, Katla, Boal, Mrigel, Hilsa, Pangash, Ayer, Shar Puti, Deshi Puti, Rita, Shoil, Karfu, Deshi Baila, Deshi Moila, Batashi, Lotia, Poa, Tilapia, Koi, Tangra, Star Baim, Baila</div>
                    </div>
                </div>
                <div class="bg-cream rounded-2xl overflow-hidden border border-warm-gray/50 hover:shadow-lg transition-all" data-gsap="fade-up">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ asset('storage/Surma Agro Products/Dried Fish Export Items/Dried Hilsa Fish.webp') }}" alt="Dried Fish Products" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-forest-800 mb-2">Dried Fish</h3>
                        <div class="text-forest-500 text-sm leading-relaxed">Dry Lotia, Dry Anchovy, and other traditionally sun-dried and processed fish products, perfect for global markets seeking authentic preserved seafood.</div>
                    </div>
                </div>
                <div class="bg-cream rounded-2xl overflow-hidden border border-warm-gray/50 hover:shadow-lg transition-all" data-gsap="fade-up">
                    <div class="aspect-[4/3] overflow-hidden">
                        <img src="{{ asset('storage/Surma Agro Products/Frozen Export Items/Frozen Koral.webp') }}" alt="Marine Fish & Seafood" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                    </div>
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-forest-800 mb-2">Marine Fish & Seafood</h3>
                        <div class="text-forest-500 text-sm leading-relaxed">Koral, White Pomfret, and premium seafood products including fillets, peeled shrimp, and value-added items for discerning international buyers.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Quality Assurance</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">Commitment to quality at every stage — from sourcing to delivery</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6" data-gsap="fade-up">
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-2">Raw Material Sourcing</h3>
                    <p class="text-forest-500 text-xs">Supplier verification, quality inspection, and full traceability from the source.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm">
                    <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-2">Handling & Storage</h3>
                    <p class="text-forest-500 text-xs">Temperature-controlled environment, strict hygiene standards, and FIFO management.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm">
                    <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-2">Processing Procedures</h3>
                    <p class="text-forest-500 text-xs">Sanitation protocols, rigorous quality checks, and standardized processing methods.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm">
                    <div class="w-10 h-10 bg-cyan-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-2">Freezing & Packaging</h3>
                    <p class="text-forest-500 text-xs">Blast freezing, secure packaging, and proper labeling for export readiness.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm">
                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-2">Quality Testing</h3>
                    <p class="text-forest-500 text-xs">Microbiological testing, metal detector checks, and sensory evaluation for every batch.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm">
                    <div class="w-10 h-10 bg-rose-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-2">Compliance & Certification</h3>
                    <p class="text-forest-500 text-xs">Adherence to HACCP, FDA, EU regulations, ISO 22000, ISO 9001, ISO 14001, and Halal standards.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm">
                    <div class="w-10 h-10 bg-indigo-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-2">Shipping & Logistics</h3>
                    <p class="text-forest-500 text-xs">Pre-shipment checks, cold chain maintenance, and complete export documentation.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm">
                    <div class="w-10 h-10 bg-teal-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-2">Training & Development</h3>
                    <p class="text-forest-500 text-xs">Employee training programs and continuous process improvement initiatives.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm">
                    <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-2">Customer Feedback</h3>
                    <p class="text-forest-500 text-xs">Complaint handling and feedback monitoring for continuous improvement.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center" data-gsap="fade-up">
                <div class="text-center lg:text-left">
                    <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-6">Processing Facilities</h2>
                    <p class="text-forest-500 mb-8 max-w-xl mx-auto lg:mx-0">Surma Fish operates state-of-the-art processing facilities designed to meet the highest standards of hygiene, efficiency, and sustainability. Strategically located near major sourcing hubs, our facilities ensure rapid processing to maintain product freshness.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-cream rounded-xl p-4">
                            <h4 class="font-bold text-forest-800 text-sm mb-1">Hygienic Design</h4>
                            <p class="text-forest-500 text-xs">Purpose-built infrastructure</p>
                        </div>
                        <div class="bg-cream rounded-xl p-4">
                            <h4 class="font-bold text-forest-800 text-sm mb-1">Temperature Control</h4>
                            <p class="text-forest-500 text-xs">End-to-end cold chain</p>
                        </div>
                        <div class="bg-cream rounded-xl p-4">
                            <h4 class="font-bold text-forest-800 text-sm mb-1">Quality Stations</h4>
                            <p class="text-forest-500 text-xs">Dedicated QC checkpoints</p>
                        </div>
                        <div class="bg-cream rounded-xl p-4">
                            <h4 class="font-bold text-forest-800 text-sm mb-1">Global Standards</h4>
                            <p class="text-forest-500 text-xs">HACCP & ISO compliant</p>
                        </div>
                    </div>
                </div>
                <div class="text-center lg:text-left">
                    <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-6">Logistics & Distribution</h2>
                    <p class="text-forest-500 mb-8 max-w-xl mx-auto lg:mx-0">Surma Fish boasts a highly efficient logistics and distribution network, ensuring the freshness and quality of our fish products from sourcing to global delivery. Our advanced cold chain management preserves product integrity throughout the entire supply process.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-cream rounded-xl p-4">
                            <h4 class="font-bold text-forest-800 text-sm mb-1">Cold Chain</h4>
                            <p class="text-forest-500 text-xs">Temperature-monitored shipping</p>
                        </div>
                        <div class="bg-cream rounded-xl p-4">
                            <h4 class="font-bold text-forest-800 text-sm mb-1">Global Partners</h4>
                            <p class="text-forest-500 text-xs">Reliable shipping carriers</p>
                        </div>
                        <div class="bg-cream rounded-xl p-4">
                            <h4 class="font-bold text-forest-800 text-sm mb-1">10+ Countries</h4>
                            <p class="text-forest-500 text-xs">Worldwide delivery network</p>
                        </div>
                        <div class="bg-cream rounded-xl p-4">
                            <h4 class="font-bold text-forest-800 text-sm mb-1">Full Documentation</h4>
                            <p class="text-forest-500 text-xs">Export compliance & customs</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
