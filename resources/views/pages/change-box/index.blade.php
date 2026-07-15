@extends('layouts.app')

@section('title', 'Change Box Services - Business, Logistics & Travel Solutions - Surma Agro')
@section('meta_description', 'Change Box Services is your all-in-one partner for Business Solutions, Logistics, and Travel Services. Company setup, accounting, freight forwarding, visa processing and more.')

@section('content')
    {{-- Visit Change Box Services Website CTA --}}
    <section class="min-h-screen pt-32 bg-gradient-to-br from-earth-800 via-forest-800 to-forest-900 relative overflow-hidden flex items-center">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 right-20 w-96 h-96 bg-earth-400 rounded-full blur-3xl"></div>
            <div class="absolute bottom-10 left-10 w-64 h-64 bg-forest-500 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-center lg:text-left" data-gsap="fade-right">
                    <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-6 border border-white/10 mx-auto lg:mx-0">Visit Our Website</span>
                    <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">Change Box Services</h2>
                    <p class="text-lg text-forest-200 leading-relaxed mb-8 max-w-xl mx-auto lg:mx-0">
                        Your all-in-one partner for Business Solutions, Logistics, and Travel Services. From company setup and accounting to freight forwarding and visa processing — we handle it all under one roof.
                    </p>
                    <div class="inline-block text-left">
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center gap-3 text-forest-200">
                                <svg class="w-5 h-5 text-earth-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Business setup, accounting, audit &amp; compliance services</span>
                            </li>
                            <li class="flex items-center gap-3 text-forest-200">
                                <svg class="w-5 h-5 text-earth-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Global logistics, freight forwarding &amp; cold chain solutions</span>
                            </li>
                            <li class="flex items-center gap-3 text-forest-200">
                                <svg class="w-5 h-5 text-earth-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>Travel services, visa processing &amp; work permit assistance</span>
                            </li>
                        </ul>
                    </div>
                    <a href="https://changeboxservices.com/" target="_blank" rel="noopener noreferrer"
                       class="inline-flex items-center px-8 py-4 bg-white text-earth-900 font-bold rounded-xl hover:bg-earth-50 transition-all shadow-xl shadow-earth-900/20 hover:shadow-earth-900/30 text-lg mx-auto lg:mx-0">
                        Visit ChangeBoxServices.com
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    </a>
                </div>
                <div class="hidden lg:grid grid-cols-2 gap-4" data-gsap="fade-left">
                    <img src="{{ asset('storage/changebox/changebox (1).webp') }}" alt="Change Box Business Solutions" class="rounded-2xl aspect-square object-cover shadow-lg">
                    <img src="{{ asset('storage/changebox/changebox (2).webp') }}" alt="Change Box Logistics" class="rounded-2xl aspect-square object-cover shadow-lg mt-8">
                    <img src="{{ asset('storage/changebox/changebox (3).webp') }}" alt="Change Box Travel Services" class="rounded-2xl aspect-square object-cover shadow-lg -mt-8">
                    <img src="{{ asset('storage/changebox/changebox (4).webp') }}" alt="Change Box Accounting" class="rounded-2xl aspect-square object-cover shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Business Solutions</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">Comprehensive business services to help you start, grow, and succeed in global markets</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" data-gsap="fade-up">
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-earth-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-earth-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 14h.01M12 7h.01M15 7h.01M21 21a2 2 0 01-2 2H5a2 2 0 01-2-2V5a2 2 0 012-2h14a2 2 0 012 2v16z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Accounting and Audit</h3>
                    <p class="text-forest-500 text-xs">Accurate accounting services and thorough audits to help businesses maintain financial transparency, comply with regulations, and make informed decisions.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-earth-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-earth-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Business Setup</h3>
                    <p class="text-forest-500 text-xs">End-to-end support for company formation, registration, and licensing — helping entrepreneurs and enterprises establish their presence seamlessly.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-earth-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-earth-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Business Process Outsourcing</h3>
                    <p class="text-forest-500 text-xs">Outsource non-core business tasks like payroll, customer service, and data entry so you can focus on growth and efficiency.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-earth-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-earth-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Immigration Consultation</h3>
                    <p class="text-forest-500 text-xs">Expert assistance with visa applications, work permits, and compliance for smooth international relocation or hiring of global talent.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-earth-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-earth-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Product Registration & Import</h3>
                    <p class="text-forest-500 text-xs">Regulatory approvals and paperwork for registering products and importing goods, ensuring legal and timely market entry.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-earth-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-earth-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Compliance & Secretarial Service</h3>
                    <p class="text-forest-500 text-xs">Stay compliant with corporate laws and governance — statutory filings, board meeting documentation, and other legal formalities managed end-to-end.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Logistics Services</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">Comprehensive logistics solutions ensuring smooth, timely, and cost-effective global delivery</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" data-gsap="fade-up">
                <div class="bg-cream rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10m2 0a2 2 0 100 4m8-4a2 2 0 100 4m3-4V8m0 0V6a1 1 0 011-1h3.75M17 8h3.75M17 8v4m0 0v4m0-4h3.75"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Freight Forwarding</h3>
                    <p class="text-forest-500 text-xs">Reliable transportation solutions via air, sea, or land, ensuring timely and secure delivery of goods worldwide.</p>
                </div>
                <div class="bg-cream rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Carrier Selection & Rate Negotiation</h3>
                    <p class="text-forest-500 text-xs">We select the best carriers and negotiate competitive rates to reduce shipping costs while maintaining efficiency and reliability.</p>
                </div>
                <div class="bg-cream rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Inventory Management</h3>
                    <p class="text-forest-500 text-xs">Track, manage, and optimize inventory levels to ensure product availability and reduce storage or holding costs.</p>
                </div>
                <div class="bg-cream rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Cold Storage</h3>
                    <p class="text-forest-500 text-xs">Temperature-controlled storage solutions that maintain product quality and extend shelf life for perishable goods.</p>
                </div>
                <div class="bg-cream rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Stock Level Monitoring</h3>
                    <p class="text-forest-500 text-xs">Real-time monitoring of stock to prevent overstocking or shortages, ensuring smooth order fulfillment and planning.</p>
                </div>
                <div class="bg-cream rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Demand Forecasting</h3>
                    <p class="text-forest-500 text-xs">Predict future demand using data-driven insights to improve inventory planning and reduce stock-related risks.</p>
                </div>
                <div class="bg-cream rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Import/Export Documentation</h3>
                    <p class="text-forest-500 text-xs">Preparation and management of all necessary documents to ensure smooth customs processing for import and export activities.</p>
                </div>
                <div class="bg-cream rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Customs Clearance</h3>
                    <p class="text-forest-500 text-xs">Expert handling of customs procedures to minimize delays, ensure compliance, and speed up international shipments.</p>
                </div>
                <div class="bg-cream rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Regulatory Compliance & Trade Consulting</h3>
                    <p class="text-forest-500 text-xs">Stay compliant with international trade laws and receive expert advice to navigate global trade regulations smoothly.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Travel and Tours</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">Complete travel solutions for a hassle-free experience — from ticketing to insurance</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6" data-gsap="fade-up">
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Air Ticket</h3>
                    <p class="text-forest-500 text-xs">Book domestic and international air tickets at the best prices with flexible options and 24/7 customer support.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Visa Processing</h3>
                    <p class="text-forest-500 text-xs">Fast and reliable visa application assistance for tourism, business, study, or work travel to any destination.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-4 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Hotel Booking</h3>
                    <p class="text-forest-500 text-xs">Affordable hotel bookings worldwide, tailored to your travel needs, preferences, and budget.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Work Permit</h3>
                    <p class="text-forest-500 text-xs">Professional support for obtaining work permits abroad, including documentation and legal processing.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Travel Insurance</h3>
                    <p class="text-forest-500 text-xs">Comprehensive travel insurance plans covering health, trip cancellations, baggage loss, and more.</p>
                </div>
                <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm hover:shadow-md transition-all">
                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center mb-3">
                        <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-1">Currency Exchange</h3>
                    <p class="text-forest-500 text-xs">Safe and secure foreign currency exchange services with competitive rates and quick processing.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Why Choose Change Box Services</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">We make complex business processes simple — whether you're starting a new venture, managing international logistics, or planning global travel.</p>
            </div>

            <div class="grid md:grid-cols-4 gap-6" data-gsap="fade-up">
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-earth-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-earth-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-2">One-Stop Solution</h3>
                    <p class="text-forest-500 text-sm">Business, logistics, and travel services under one roof</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-earth-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-earth-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-2">Expert Guidance</h3>
                    <p class="text-forest-500 text-sm">Professional support with local and global compliance</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-earth-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-earth-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-2">Customized Approach</h3>
                    <p class="text-forest-500 text-sm">Services tailored to your unique needs and goals</p>
                </div>
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-earth-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-earth-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="font-bold text-forest-800 mb-2">Reliable & Timely</h3>
                    <p class="text-forest-500 text-sm">Fast, accurate, and transparent service delivery</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center" data-gsap="fade-up">
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Global Reach</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto mb-12">Exceptional Service. Global Reach. Unmatched Quality.</p>
                <div class="grid md:grid-cols-3 gap-8 max-w-3xl mx-auto">
                    <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm">
                        <div class="text-4xl font-bold text-earth-600 mb-2">748+</div>
                        <p class="text-forest-500 text-sm">Distribution Centers & Offices</p>
                    </div>
                    <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm">
                        <div class="text-4xl font-bold text-earth-600 mb-2">437</div>
                        <p class="text-forest-500 text-sm">Cities Served Worldwide</p>
                    </div>
                    <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm">
                        <div class="text-4xl font-bold text-earth-600 mb-2">46</div>
                        <p class="text-forest-500 text-sm">Countries & Regions</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
