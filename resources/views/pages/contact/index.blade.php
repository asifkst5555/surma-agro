@extends('layouts.app')

@section('title', 'Contact Us - Surma Agro B2B Trade Inquiry')
@section('meta_description', 'Contact Surma Agro for B2B trade inquiries. Get in touch with our export team for agricultural commodities, frozen seafood, and processed food products.')

@php
$contactSchema = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ContactPage',
    'name' => 'Contact Surma Agro',
    'description' => 'Contact page for B2B trade inquiries',
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
@endphp

@push('schema')
<script type="application/ld+json">{!! $contactSchema !!}</script>
@endpush

@section('content')
    <section class="relative pt-32 pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-earth-500 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-6 border border-white/10">Get in Touch</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">Contact Us</h1>
            <p class="text-lg lg:text-xl text-forest-200 max-w-3xl mx-auto leading-relaxed">
                Ready to start a B2B partnership? Send us your inquiry and our trade team will respond within 24 hours.
            </p>
        </div>
    </section>

    {{-- Quick Contact Strip --}}
    <section class="py-10 bg-white border-b border-warm-gray/50" data-gsap="fade-up">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-center gap-6">
                <div class="flex items-center gap-3 px-6 py-3 bg-cream rounded-xl">
                    <div class="w-10 h-10 bg-forest-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-forest-400 font-medium">Email</p>
                        <p class="text-sm font-semibold text-forest-800">info@surmaagro.com</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 px-6 py-3 bg-cream rounded-xl">
                    <div class="w-10 h-10 bg-forest-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-forest-400 font-medium">Phone</p>
                        <p class="text-sm font-semibold text-forest-800">+95 9797100016</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 px-6 py-3 bg-cream rounded-xl">
                    <div class="w-10 h-10 bg-forest-100 rounded-lg flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs text-forest-400 font-medium">Office Hours</p>
                        <p class="text-sm font-semibold text-forest-800">Sun-Thu 9AM-6PM</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Main Content: Form + Offices --}}
    <section class="py-16 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-5 gap-10">
                {{-- Contact Form --}}
                <div class="lg:col-span-3" data-gsap="fade-right">
                    <div class="bg-white rounded-2xl p-8 lg:p-10 border border-warm-gray/50 shadow-sm h-full flex flex-col">
                        <h2 class="text-2xl font-bold text-forest-800 mb-2">Send Us an Inquiry</h2>
                        <p class="text-forest-500 mb-8">Fill out the form and our team will respond within 24 hours.</p>

                        @if(session('success'))
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('contact.submit') }}" method="POST" class="space-y-5 flex flex-col flex-1">
                            @csrf
                            <div class="grid md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-forest-700 mb-2">Full Name *</label>
                                    <input type="text" name="name" required
                                        class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-forest-700 mb-2">Email Address *</label>
                                    <input type="email" name="email" required
                                        class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none transition-all">
                                </div>
                            </div>
                            <div class="grid md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-medium text-forest-700 mb-2">Phone Number</label>
                                    <input type="tel" name="phone"
                                        class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none transition-all">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-forest-700 mb-2">Company Name</label>
                                    <input type="text" name="company"
                                        class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none transition-all">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-forest-700 mb-2">Country</label>
                                <input type="text" name="country"
                                    class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-forest-700 mb-2">Message *</label>
                                <textarea name="message" rows="7" required
                                    class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none transition-all resize-none"
                                    placeholder="Tell us about your requirements, product interests, and any specific questions..."></textarea>
                            </div>
                            <div class="mt-auto pt-4">
                                <button type="submit"
                                    class="w-full px-6 py-3.5 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all shadow-lg shadow-forest-700/20">
                                    Send Inquiry
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Global Offices --}}
                <div class="lg:col-span-2 space-y-6" data-gsap="fade-left">
                    <div class="text-center lg:text-left">
                        <span class="inline-block px-3 py-1 bg-forest-50 text-forest-700 text-xs font-semibold rounded-full mb-3">Our Locations</span>
                        <h2 class="text-2xl font-bold text-forest-800">Global Offices</h2>
                    </div>

                    <div class="space-y-4">
                        {{-- USA --}}
                        <div class="bg-white rounded-xl p-5 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-start gap-3">
                                <img src="https://flagcdn.com/w40/us.png" alt="US" class="w-8 h-6 object-cover rounded mt-1 flex-shrink-0">
                                <div class="min-w-0">
                                    <h4 class="font-bold text-forest-800 text-sm">USA Office</h4>
                                    <p class="text-xs text-forest-600 font-medium">SURMA RIVER WAVES INC</p>
                                    <p class="text-xs text-forest-400 mt-1">7230 Broadway, 2nd Floor, Jackson Heights, NY 11372</p>
                                    <p class="text-xs text-forest-400">License: 241203005247 | DOS ID: 7477523</p>
                                    <a href="mailto:director@surmaagro.com" class="text-xs text-earth-600 hover:underline mt-1 inline-flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>director@surmaagro.com</a>
                                </div>
                            </div>
                        </div>

                        {{-- Canada --}}
                        <div class="bg-white rounded-xl p-5 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-start gap-3">
                                <img src="https://flagcdn.com/w40/ca.png" alt="CA" class="w-8 h-6 object-cover rounded mt-1 flex-shrink-0">
                                <div class="min-w-0">
                                    <h4 class="font-bold text-forest-800 text-sm">Canada Office</h4>
                                    <p class="text-xs text-forest-600 font-medium">SURMA FOOD INC.</p>
                                    <p class="text-xs text-forest-400 mt-1">23 Latham Ave, Toronto, ON M1N 1M7</p>
                                    <p class="text-xs text-forest-400">Corporate No: 1599977-4</p>
                                    <a href="mailto:ceo@surmaagro.com" class="text-xs text-earth-600 hover:underline mt-1 inline-flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>ceo@surmaagro.com</a>
                                </div>
                            </div>
                        </div>

                        {{-- Oman --}}
                        <div class="bg-white rounded-xl p-5 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-start gap-3">
                                <img src="https://flagcdn.com/w40/om.png" alt="OM" class="w-8 h-6 object-cover rounded mt-1 flex-shrink-0">
                                <div class="min-w-0">
                                    <h4 class="font-bold text-forest-800 text-sm">Oman Office</h4>
                                    <p class="text-xs text-forest-600 font-medium">LPT Business and Contracting LLC</p>
                                    <p class="text-xs text-forest-400 mt-1">Al Billah / Baraka, South Al Batinah Governorate</p>
                                    <p class="text-xs text-forest-400">Reg: 1589201 | TIN: 2185336</p>
                                    <a href="mailto:info@surmaagro.com" class="text-xs text-earth-600 hover:underline mt-1 inline-flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>info@surmaagro.com</a>
                                </div>
                            </div>
                        </div>

                        {{-- Thailand --}}
                        <div class="bg-white rounded-xl p-5 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-start gap-3">
                                <img src="https://flagcdn.com/w40/th.png" alt="TH" class="w-8 h-6 object-cover rounded mt-1 flex-shrink-0">
                                <div class="min-w-0">
                                    <h4 class="font-bold text-forest-800 text-sm">Thailand Office</h4>
                                    <p class="text-xs text-forest-600 font-medium">SURMA RIVER FISH LTD</p>
                                    <p class="text-xs text-forest-400 mt-1">House No. 682-111, Alley 7, City Park Village, Soi Phatthanakan 38, Bangkok</p>
                                </div>
                            </div>
                        </div>

                        {{-- Myanmar --}}
                        <div class="bg-white rounded-xl p-5 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                            <div class="flex items-start gap-3">
                                <img src="https://flagcdn.com/w40/mm.png" alt="MM" class="w-8 h-6 object-cover rounded mt-1 flex-shrink-0">
                                <div class="min-w-0">
                                    <h4 class="font-bold text-forest-800 text-sm">Myanmar Office</h4>
                                    <p class="text-xs text-forest-600 font-medium">SURMA RIVER FISH LTD</p>
                                    <p class="text-xs text-forest-400 mt-1">House No. 28-28A, Pyae Son Condo, 55 Street, Middle Block, 5th Floor, Pazundaung Township, Yangon 11171</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Bangladesh Offices Section --}}
    <section class="pb-16 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl p-8 lg:p-10 border border-warm-gray/50 shadow-sm">
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-cream rounded-xl p-6 border border-warm-gray/50 hover:shadow-md transition-all">
                        <div class="flex items-start gap-4">
                            <img src="https://flagcdn.com/w40/bd.png" alt="BD" class="w-10 h-7 object-cover rounded mt-1 flex-shrink-0">
                            <div>
                                <h4 class="font-bold text-forest-800">Bangladesh Office (Dhaka)</h4>
                                <p class="text-sm text-forest-600 font-medium mt-1">Surma Agro</p>
                                <p class="text-sm text-forest-400 mt-2">House No. 9, Road No. 4, Block -A, Mirpur-2, Dhaka -1216, Bangladesh</p>
                                <p class="text-sm text-forest-400">Cell: +8801759115424</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-cream rounded-xl p-6 border border-warm-gray/50 hover:shadow-md transition-all">
                        <div class="flex items-start gap-4">
                            <img src="https://flagcdn.com/w40/bd.png" alt="BD" class="w-10 h-7 object-cover rounded mt-1 flex-shrink-0">
                            <div>
                                <h4 class="font-bold text-forest-800">Bangladesh Office (Chittagong)</h4>
                                <p class="text-sm text-forest-600 font-medium mt-1">Kazi Traders International</p>
                                <p class="text-sm text-forest-400 mt-2">1321 Strand Road (4th Floor), Bank Building, Chittagong</p>
                                <p class="text-sm text-forest-400">License: TRAD/CHTG/023208/2024</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
