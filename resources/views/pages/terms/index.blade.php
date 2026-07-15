@extends('layouts.app')

@section('title', 'Terms & Trade Policy - Surma Agro')
@section('meta_description', 'Surma Agro terms and trade policy including payment terms, shipping conditions, quality assurance, and B2B trade agreements.')

@php
$termsSchema = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'WebPage',
    'name' => 'Terms & Trade Policy',
    'description' => 'Terms and trade policies for Surma Agro B2B transactions.',
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
@endphp

@push('schema')
<script type="application/ld+json">{!! $termsSchema !!}</script>
@endpush

@section('content')
    <section class="relative pt-32 pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-earth-500 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-6 border border-white/10">Policies</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">Terms & Trade Policy</h1>
            <p class="text-lg lg:text-xl text-forest-200 max-w-3xl mx-auto leading-relaxed">
                Clear, transparent terms that govern our international B2B trade relationships
            </p>
        </div>
    </section>

    <section class="py-24 bg-cream">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-8">
                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50" data-gsap="fade-up">
                    <h2 class="text-xl font-bold text-forest-800 mb-4">1. General Terms</h2>
                    <p class="text-forest-500 leading-relaxed mb-4">
                        These terms and conditions govern all transactions between Surma Agro ("Seller") and the buyer ("Buyer"). By placing an order, the Buyer accepts these terms in full. Any deviations require written confirmation from Surma Agro.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50" data-gsap="fade-up">
                    <h2 class="text-xl font-bold text-forest-800 mb-4">2. Orders & Contracts</h2>
                    <ul class="space-y-3 text-forest-500">
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>All orders are subject to written confirmation by Surma Agro</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>Minimum Order Quantity (MOQ) varies by product and is specified in product documentation</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>Order lead times are confirmed at the time of order placement</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>Contractual terms are governed by international trade laws (CISG)</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50" data-gsap="fade-up">
                    <h2 class="text-xl font-bold text-forest-800 mb-4">3. Pricing & Payment</h2>
                    <ul class="space-y-3 text-forest-500">
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>All prices are quoted in USD (United States Dollars) unless otherwise agreed</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>Payment terms: Typically L/C (Letter of Credit) or T/T (Telegraphic Transfer)</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>Proforma invoice valid for 15 days from date of issue</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>Prices are on FOB, CIF, or CNF basis as mutually agreed</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50" data-gsap="fade-up">
                    <h2 class="text-xl font-bold text-forest-800 mb-4">4. Quality & Inspection</h2>
                    <ul class="space-y-3 text-forest-500">
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>All products meet international quality standards (ISO, HACCP, etc.)</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>Pre-shipment inspection available by SGS, Bureau Veritas, or other nominated agencies</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>Quality claims must be filed within 7 days of arrival with supporting documentation</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>Samples available upon request for product evaluation</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50" data-gsap="fade-up">
                    <h2 class="text-xl font-bold text-forest-800 mb-4">5. Shipping & Delivery</h2>
                    <ul class="space-y-3 text-forest-500">
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>Incoterms: FOB, CIF, CNF, DAP as per agreement</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>Shipping documentation includes: Bill of Lading, Certificate of Origin, Phytosanitary Certificate, Health Certificate, Packing List, Commercial Invoice</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>Shipping modes: Sea freight (reefer/dry container), Air freight available for select products</span>
                        </li>
                        <li class="flex items-start space-x-3">
                            <span class="text-earth-600 font-bold">•</span>
                            <span>Insurance: Recommended and can be arranged upon request</span>
                        </li>
                    </ul>
                </div>

                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50" data-gsap="fade-up">
                    <h2 class="text-xl font-bold text-forest-800 mb-4">6. Force Majeure</h2>
                    <p class="text-forest-500 leading-relaxed">
                        Surma Agro shall not be liable for delays or non-performance due to circumstances beyond reasonable control including but not limited to natural disasters, political unrest, strikes, shipping disruptions, or global health emergencies.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50" data-gsap="fade-up">
                    <h2 class="text-xl font-bold text-forest-800 mb-4">7. Confidentiality</h2>
                    <p class="text-forest-500 leading-relaxed">
                        Both parties agree to maintain confidentiality of all commercial terms, product specifications, and business information shared during the course of the business relationship.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
