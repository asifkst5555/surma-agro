@extends('layouts.app')
@section('title', $blog->title . ' - Surma Agro Blog')
@section('meta_description', $blog->excerpt)
@php $articleSchema = json_encode(['@context'=>'https://schema.org','@type'=>'Article','headline'=>$blog->title,'description'=>$blog->excerpt,'author'=>['@type'=>'Person','name'=>$blog->author??'Surma Agro'],'datePublished'=>$blog->published_at?->toIso8601String(),'image'=>$blog->image,], JSON_UNESCAPED_SLASHES); @endphp
@push('schema')
<script type="application/ld+json">{!! $articleSchema !!}</script>
@endpush
@section('content')
    <article class="py-24 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-3 gap-12">
                <div class="lg:col-span-2">
                    @if($blog->image)
                        <div class="aspect-[16/9] rounded-2xl overflow-hidden bg-forest-50 mb-8">
                            <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="aspect-[16/9] rounded-2xl bg-gradient-to-br from-forest-100 to-forest-50 flex items-center justify-center mb-8">
                            <span class="text-forest-300 text-6xl font-bold">{{ substr($blog->title, 0, 2) }}</span>
                        </div>
                    @endif
                    <div class="flex flex-wrap items-center gap-4 mb-6 text-sm">
                        @if($blog->category)<span class="px-3 py-1 bg-forest-50 text-forest-600 font-semibold rounded-full">{{ $blog->category }}</span>@endif
                        @if($blog->author)<span class="text-forest-500">By <span class="font-semibold text-forest-700">{{ $blog->author }}</span></span>@endif
                        <span class="text-forest-400">{{ $blog->published_at?->format('M d, Y') }}</span>
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-bold text-forest-800 mb-8">{{ $blog->title }}</h1>
                    <div class="text-forest-600 leading-relaxed space-y-4">
                        {!! $blog->content !!}
                    </div>
                    <div class="mt-12 pt-8 border-t border-warm-gray">
                        <a href="{{ route('blog.index') }}" class="inline-flex items-center text-forest-700 font-semibold hover:text-earth-600 transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"/></svg>
                            Back to Blog
                        </a>
                    </div>
                </div>
                <aside class="lg:col-span-1">
                    <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm sticky top-24">
                        <h3 class="text-lg font-bold text-forest-800 mb-6">Recent Posts</h3>
                        @if($recent->count() > 0)
                            <div class="space-y-5">
                                @foreach($recent as $post)
                                    <a href="{{ route('blog.show', $post->slug) }}" class="group flex items-start space-x-3">
                                        @if($post->image)
                                            <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0 bg-forest-50">
                                                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-forest-100 to-forest-50 flex items-center justify-center flex-shrink-0">
                                                <span class="text-forest-300 text-lg font-bold">{{ substr($post->title, 0, 2) }}</span>
                                            </div>
                                        @endif
                                        <div class="min-w-0">
                                            <h4 class="text-sm font-semibold text-forest-800 group-hover:text-earth-600 transition-colors line-clamp-2">{{ $post->title }}</h4>
                                            <p class="text-xs text-forest-400 mt-1">{{ $post->published_at?->format('M d, Y') }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p class="text-forest-500 text-sm">No recent posts available.</p>
                        @endif
                    </div>
                </aside>
            </div>
        </div>
    </article>
@endsection
