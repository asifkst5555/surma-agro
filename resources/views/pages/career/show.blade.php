@extends('layouts.app')

@section('title', $career->title . ' - Surma Agro Careers')
@section('meta_description', $career->short_description)

@section('content')
    <section class="relative pt-32 pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-earth-600 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-6 border border-white/10">{{ $career->department }}</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">{{ $career->title }}</h1>
        </div>
    </section>

    <section class="py-24 bg-cream">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap gap-3 mb-10">
                <span class="px-4 py-2 bg-white border border-warm-gray/50 rounded-xl text-forest-700 text-sm font-medium shadow-sm">{{ $career->location }}</span>
                <span class="px-4 py-2 bg-earth-100 text-earth-700 text-sm font-semibold rounded-xl shadow-sm">{{ $career->type }}</span>
                <span class="px-4 py-2 bg-white border border-warm-gray/50 rounded-xl text-forest-700 text-sm font-medium shadow-sm">Deadline: {{ \Carbon\Carbon::parse($career->deadline)->format('M d, Y') }}</span>
            </div>

            <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm mb-8">
                <h2 class="text-2xl font-bold text-forest-800 mb-4">Description</h2>
                <div class="text-forest-500 leading-relaxed">{{ $career->description }}</div>
            </div>

            @if($career->requirements)
                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm mb-8">
                    <h2 class="text-2xl font-bold text-forest-800 mb-4">Requirements</h2>
                    <ul class="space-y-3 text-forest-500">
                        @foreach($career->requirements as $requirement)
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-forest-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                <span>{{ $requirement }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($career->benefits)
                <div class="bg-white rounded-2xl p-8 border border-warm-gray/50 shadow-sm mb-8">
                    <h2 class="text-2xl font-bold text-forest-800 mb-4">Benefits</h2>
                    <ul class="space-y-3 text-forest-500">
                        @foreach($career->benefits as $benefit)
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-forest-600 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>{{ $benefit }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-2xl p-8 lg:p-10 border border-warm-gray/50 shadow-sm">
                <h2 class="text-2xl font-bold text-forest-800 mb-2">Apply for This Position</h2>
                <p class="text-forest-500 mb-8">Fill out the form below and our HR team will review your application.</p>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>
                @endif

                <form action="{{ route('career.apply', $career->slug) }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-forest-700 mb-2">Full Name *</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-forest-700 mb-2">Email Address *</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Phone Number</label>
                        <input type="tel" name="phone" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Cover Letter *</label>
                        <textarea name="cover_letter" rows="6" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none transition-all resize-none" placeholder="Tell us why you're a great fit for this role..."></textarea>
                    </div>
                    <button type="submit" class="w-full px-6 py-3.5 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all shadow-lg shadow-forest-700/20">Submit Application</button>
                </form>
            </div>
        </div>
    </section>
@endsection
