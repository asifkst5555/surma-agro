@extends('layouts.app')

@section('title', 'Factory & Production - Surma Agro')
@section('meta_description', 'Explore Surma Agro\'s state-of-the-art manufacturing facilities, production process, and global export capacity.')

@section('content')
    <section class="relative pt-32 pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-earth-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 left-10 w-96 h-96 bg-earth-400 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-6 border border-white/10">Manufacturing Excellence</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">Factory & Production</h1>
            <p class="text-lg lg:text-xl text-forest-200 max-w-3xl mx-auto leading-relaxed">
                State-of-the-art manufacturing facilities equipped with modern technology, ensuring the highest standards of quality and efficiency in every product we export.
            </p>
        </div>
    </section>

    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Our Factory</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">Built for precision, scale, and uncompromising quality</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm" data-gsap="fade-up">
                    <div class="w-14 h-14 bg-forest-100 rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Modern Facility</h3>
                    <p class="text-forest-500 text-sm leading-relaxed">50,000 sq ft facility built to international standards with dedicated processing zones.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm" data-gsap="fade-up">
                    <div class="w-14 h-14 bg-forest-100 rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">High Capacity</h3>
                    <p class="text-forest-500 text-sm leading-relaxed">Processing capacity of 50+ metric tons daily with scalable production lines.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm" data-gsap="fade-up">
                    <div class="w-14 h-14 bg-forest-100 rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Advanced Technology</h3>
                    <p class="text-forest-500 text-sm leading-relaxed">Automated sorting, grading, and packaging systems with real-time monitoring.</p>
                </div>
                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm" data-gsap="fade-up">
                    <div class="w-14 h-14 bg-forest-100 rounded-2xl flex items-center justify-center mb-5">
                        <svg class="w-7 h-7 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Quality Control</h3>
                    <p class="text-forest-500 text-sm leading-relaxed">In-house lab with HACCP, ISO, and BRC-certified quality assurance protocols.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Production Process</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">From farm to shipment, every step is meticulously controlled</p>
            </div>
            <div class="grid md:grid-cols-4 gap-6">
                <div class="text-center relative" data-gsap="fade-up">
                    <div class="w-16 h-16 bg-forest-700 text-white rounded-2xl flex items-center justify-center mx-auto mb-4 text-xl font-bold shadow-lg">1</div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Sourcing</h3>
                    <p class="text-forest-500 text-sm leading-relaxed">Premium raw materials selected from trusted farms and suppliers worldwide.</p>
                </div>
                <div class="text-center relative" data-gsap="fade-up">
                    <div class="w-16 h-16 bg-forest-700 text-white rounded-2xl flex items-center justify-center mx-auto mb-4 text-xl font-bold shadow-lg">2</div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Processing</h3>
                    <p class="text-forest-500 text-sm leading-relaxed">Advanced cleaning, grading, and processing using automated machinery.</p>
                </div>
                <div class="text-center relative" data-gsap="fade-up">
                    <div class="w-16 h-16 bg-forest-700 text-white rounded-2xl flex items-center justify-center mx-auto mb-4 text-xl font-bold shadow-lg">3</div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Quality Check</h3>
                    <p class="text-forest-500 text-sm leading-relaxed">Rigorous lab testing for purity, size, moisture, and international compliance.</p>
                </div>
                <div class="text-center relative" data-gsap="fade-up">
                    <div class="w-16 h-16 bg-forest-700 text-white rounded-2xl flex items-center justify-center mx-auto mb-4 text-xl font-bold shadow-lg">4</div>
                    <h3 class="text-lg font-bold text-forest-800 mb-2">Packaging</h3>
                    <p class="text-forest-500 text-sm leading-relaxed">Export-ready packaging with custom branding, vacuum sealing, and labeling.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Factory Gallery</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">A glimpse inside our manufacturing facility</p>
            </div>
            <div class="grid md:grid-cols-3 gap-4">
                <div class="relative h-64 rounded-2xl overflow-hidden" data-gsap="fade-up">
                    <img src="{{ asset('storage/ai-images/factory/agro-factory-9RDBBpasnk.webp') }}" alt="Processing Unit" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute bottom-4 left-4 text-white text-lg font-semibold">Processing Unit</span>
                </div>
                <div class="relative h-64 rounded-2xl overflow-hidden" data-gsap="fade-up">
                    <img src="{{ asset('storage/ai-images/factory/agro-factory-IndTaYp9Hu.webp') }}" alt="Packaging Facility" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute bottom-4 left-4 text-white text-lg font-semibold">Packaging Facility</span>
                </div>
                <div class="relative h-64 rounded-2xl overflow-hidden" data-gsap="fade-up">
                    <img src="{{ asset('storage/ai-images/factory/agro-factory-su33Rl3o7E.webp') }}" alt="Cold Storage" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute bottom-4 left-4 text-white text-lg font-semibold">Cold Storage</span>
                </div>
                <div class="relative h-64 rounded-2xl overflow-hidden" data-gsap="fade-up">
                    <img src="{{ asset('storage/ai-images/hero/rice-mill-ceGKazReCp.webp') }}" alt="Quality Lab" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute bottom-4 left-4 text-white text-lg font-semibold">Quality Lab</span>
                </div>
                <div class="relative h-64 rounded-2xl overflow-hidden" data-gsap="fade-up">
                    <img src="{{ asset('storage/ai-images/hero/rice-mill-2oWOE4DarX.webp') }}" alt="Sorting & Grading" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute bottom-4 left-4 text-white text-lg font-semibold">Sorting & Grading</span>
                </div>
                <div class="relative h-64 rounded-2xl overflow-hidden" data-gsap="fade-up">
                    <img src="{{ asset('storage/ai-images/hero/rice-mill-0Xirz8ysRN.webp') }}" alt="Warehouse & Logistics" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <span class="absolute bottom-4 left-4 text-white text-lg font-semibold">Warehouse & Logistics</span>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-forest-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">Capacity & Export</h2>
                <p class="text-forest-200 text-lg max-w-2xl mx-auto">Powering global supply chains with scale and reliability</p>
            </div>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-10 text-center border border-white/10" data-gsap="fade-up">
                    <div class="text-4xl font-bold text-earth-300 mb-2">50,000+</div>
                    <div class="text-forest-200 text-lg">Monthly Capacity (MT)</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-10 text-center border border-white/10" data-gsap="fade-up">
                    <div class="text-4xl font-bold text-earth-300 mb-2">200+</div>
                    <div class="text-forest-200 text-lg">Daily Output (MT)</div>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-10 text-center border border-white/10" data-gsap="fade-up">
                    <div class="text-4xl font-bold text-earth-300 mb-2">30+</div>
                    <div class="text-forest-200 text-lg">Countries Exported To</div>
                </div>
            </div>
        </div>
    </section>
@endsection
