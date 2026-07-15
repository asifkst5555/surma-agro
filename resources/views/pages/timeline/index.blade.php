@extends('layouts.app')

@section('title', 'Corporate Achievements Timeline - Surma Agro')
@section('meta_description', 'Explore the journey and milestones of Surma Agro through our corporate achievements timeline.')

@section('content')
    <section class="relative pt-32 pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-earth-500 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-6 border border-white/10">Our Journey</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">Corporate Achievements</h1>
            <p class="text-lg lg:text-xl text-forest-200 max-w-3xl mx-auto leading-relaxed">
                Milestones that define our growth and commitment to excellence in global trade
            </p>
        </div>
    </section>

    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if(isset($entries) && $entries->count() > 0)
                <div class="max-w-3xl mx-auto">
                    @foreach($entries as $entry)
                        <x-timeline-card :entry="$entry" />
                    @endforeach
                </div>
            @else
                <div class="max-w-3xl mx-auto">
                    <x-timeline-card :entry="new App\Models\TimelineEntry(['year' => '2000', 'title' => 'Foundation of Surma Agro', 'description' => 'Surma Agro was established in Bangladesh with a vision to connect local agricultural producers with international markets.'])"/>
                    <x-timeline-card :entry="new App\Models\TimelineEntry(['year' => '2005', 'title' => 'First International Export', 'description' => 'Successfully completed our first major export shipment to the Middle East, marking our entry into global trade.'])"/>
                    <x-timeline-card :entry="new App\Models\TimelineEntry(['year' => '2010', 'title' => 'ISO 9001 Certification', 'description' => 'Achieved ISO 9001:2008 certification, establishing formal quality management systems across operations.'])"/>
                    <x-timeline-card :entry="new App\Models\TimelineEntry(['year' => '2013', 'title' => 'Expansion to 10 Countries', 'description' => 'Expanded export operations to 10 countries across Asia, Middle East, and Europe.'])"/>
                    <x-timeline-card :entry="new App\Models\TimelineEntry(['year' => '2015', 'title' => 'HACCP Certification', 'description' => 'Obtained HACCP certification for food safety management, enabling entry into regulated food markets.'])"/>
                    <x-timeline-card :entry="new App\Models\TimelineEntry(['year' => '2017', 'title' => 'US Office Opening', 'description' => 'Established our United States office in New York to serve the North American market directly.'])"/>
                    <x-timeline-card :entry="new App\Models\TimelineEntry(['year' => '2018', 'title' => '30 Countries Milestone', 'description' => 'Reached 30 countries served, with significant presence in Asia, Europe, North America, and Africa.'])"/>
                    <x-timeline-card :entry="new App\Models\TimelineEntry(['year' => '2020', 'title' => 'Surma Fish Brand Launch', 'description' => 'Launched the Surma Fish sub-brand, specializing in premium frozen and processed fish products.'])"/>
                    <x-timeline-card :entry="new App\Models\TimelineEntry(['year' => '2022', 'title' => 'Thailand Office Expansion', 'description' => 'Opened Southeast Asia regional hub in Bangkok, Thailand, strengthening our Asian supply chain.'])"/>
                    <x-timeline-card :entry="new App\Models\TimelineEntry(['year' => '2024', 'title' => 'Digital Transformation', 'description' => 'Launched comprehensive digital platform for B2B trade management and client engagement.'])"/>
                    <x-timeline-card :entry="new App\Models\TimelineEntry(['year' => '2025', 'title' => '500+ Products & Saudi Office', 'description' => 'Exceeded 500 product variants and opened Middle East office in Riyadh, Saudi Arabia.'])"/>
                </div>
            @endif
        </div>
    </section>
@endsection
