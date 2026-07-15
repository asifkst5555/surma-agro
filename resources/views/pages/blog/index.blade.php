@extends('layouts.app')

@section('title', 'News & Insights - Surma Agro Blog')
@section('meta_description', 'Read the latest news, insights, and updates from Surma Agro about global agriculture trade, export markets, and industry trends.')

@section('content')
    <section class="relative pt-32 pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-earth-500 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-6 border border-white/10">Our Blog</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">News & Insights</h1>
            <p class="text-lg lg:text-xl text-forest-200 max-w-3xl mx-auto leading-relaxed">
                Stay updated with the latest industry trends, company news, and expert insights from the global agriculture trade.
            </p>
        </div>
    </section>

    <section class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($blogs->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($blogs as $blog)
                        <div class="bg-white rounded-2xl shadow-sm border border-warm-gray/50 overflow-hidden group hover:shadow-lg hover:border-forest-200 transition-all duration-300" data-aos="fade-up">
                            @if($blog->image)
                                <div class="aspect-[16/9] overflow-hidden bg-forest-50">
                                    <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                            @else
                                <div class="aspect-[16/9] bg-gradient-to-br from-forest-100 to-forest-50 flex items-center justify-center">
                                    <span class="text-forest-300 text-5xl font-bold">{{ substr($blog->title, 0, 2) }}</span>
                                </div>
                            @endif
                            <div class="p-6">
                                @if($blog->category)
                                    <span class="inline-block px-3 py-1 bg-forest-50 text-forest-600 text-xs font-semibold rounded-full mb-3">{{ $blog->category }}</span>
                                @endif
                                <h3 class="text-lg font-bold text-forest-800 mb-2 line-clamp-2">{{ $blog->title }}</h3>
                                @if($blog->excerpt)
                                    <p class="text-forest-500 text-sm leading-relaxed mb-4 line-clamp-3">{{ $blog->excerpt }}</p>
                                @endif
                                <div class="flex items-center justify-between">
                                    <span class="text-xs text-forest-400">{{ $blog->published_at?->format('M d, Y') }}</span>
                                    <a href="{{ route('blog.show', $blog->slug) }}" class="inline-flex items-center text-forest-700 font-semibold text-sm hover:text-earth-600 transition-colors">
                                        Read More
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-12" data-aos="fade-up">
                    {{ $blogs->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="w-20 h-20 bg-forest-100 rounded-2xl flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-forest-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <h3 class="text-2xl font-bold text-forest-800 mb-2">No Articles Yet</h3>
                    <p class="text-forest-500">Check back soon for the latest news and insights.</p>
                </div>
            @endif
        </div>
    </section>
@endsection
