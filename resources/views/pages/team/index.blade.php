@extends('layouts.app')

@section('title', 'Meet Our Team - Surma Agro')
@section('meta_description', 'Meet the expert team behind Surma Agro - dedicated professionals driving global agriculture trade.')

@section('content')
    <section class="relative pt-32 pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-earth-500 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-6 border border-white/10">Our Team</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">Meet Our Leadership</h1>
            <p class="text-lg lg:text-xl text-forest-200 max-w-3xl mx-auto leading-relaxed">
                Seasoned professionals driving global trade with expertise and dedication
            </p>
        </div>
    </section>

    @if($managingDirector)
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-0 right-0 w-96 h-96 bg-forest-50 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-80 h-80 bg-earth-50 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-5 gap-12 items-center">
                <div class="lg:col-span-2" data-gsap="fade-right">
                    <div class="aspect-[3/4] rounded-3xl overflow-hidden bg-gradient-to-br from-forest-100 to-forest-50 shadow-xl">
                        <img src="{{ $managingDirector->image }}" alt="{{ $managingDirector->name }}" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="lg:col-span-3" data-gsap="fade-left">
                    <div class="pl-4 lg:pl-6">
                        <span class="inline-block px-4 py-2 bg-forest-50 text-forest-700 text-sm font-semibold rounded-full mb-4">Message from</span>
                        <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-8">Managing Director</h2>
                        <svg class="w-12 lg:w-16 h-12 lg:h-16 text-forest-200 mb-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10H14.017zM0 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151C7.546 6.068 5.983 8.789 5.983 11H10v10H0z"/>
                        </svg>
                        <p class="text-forest-600 text-lg lg:text-xl leading-relaxed italic mb-8">
                            At Surma Agro, our strength lies in the people who drive our vision forward every day. From our dedicated team in Bangladesh to our country directors across the globe, each member plays a vital role in delivering quality, trust, and excellence to our international partners. I am proud to lead such a passionate group of professionals who share a common commitment to bridging global markets with premium agricultural and seafood products. Together, we continue to build lasting partnerships and set new benchmarks in the industry.
                        </p>
                        <div class="border-l-4 border-earth-500 pl-6">
                            <h3 class="text-2xl font-bold text-forest-800">{{ $managingDirector->name }}</h3>
                            <p class="text-earth-600 font-medium">{{ $managingDirector->designation }}</p>
                            @if($managingDirector->company)
                                <p class="text-forest-400 text-sm mt-1">{{ $managingDirector->company }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-gsap="fade-up">
                <span class="inline-block px-4 py-2 bg-forest-50 text-forest-700 text-sm font-semibold rounded-full mb-4">Our Leadership Team</span>
                <h2 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-4">Meet the People Behind Surma Agro</h2>
                <p class="text-forest-500 text-lg max-w-2xl mx-auto">Dedicated professionals committed to excellence in global agriculture and seafood trade</p>
            </div>

            @if($members->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($members as $member)
                        <x-team-card :member="$member" />
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection