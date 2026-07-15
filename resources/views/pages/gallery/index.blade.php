@extends('layouts.app')

@section('title', 'Gallery - Surma Agro')
@section('meta_description', 'Explore our gallery showcasing Surma Agro\'s premium agricultural products, facilities, and global operations.')

@section('content')
    <section class="relative pt-32 pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-earth-500 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-6 border border-white/10">Gallery</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">Our Gallery</h1>
            <p class="text-lg lg:text-xl text-forest-200 max-w-3xl mx-auto leading-relaxed">
                A visual journey through our products, people, and global operations.
            </p>
        </div>
    </section>



    <section class="py-20 bg-cream" x-data="{ activeImage: null }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($items as $item)
                    <div class="group relative rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-lg transition-all duration-500 cursor-pointer"
                         @click="activeImage = {{ Js::from($item->image) }}">
                        <div class="relative overflow-hidden">
                            @if($item->image)
                                <img src="{{ $item->image }}" alt="{{ $item->title }}"
                                     class="w-full h-auto block group-hover:scale-105 transition-transform duration-700">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-forest-200 to-forest-400 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-forest-900/80 via-forest-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-5 translate-y-4 group-hover:translate-y-0 opacity-0 group-hover:opacity-100 transition-all duration-500">
                                <h3 class="text-lg font-bold text-white">{{ $item->title }}</h3>
                                @if($item->description)
                                    <p class="text-sm text-forest-200 mt-1 line-clamp-2">{{ $item->description }}</p>
                                @endif
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <svg class="w-16 h-16 text-forest-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-forest-500 text-lg">No gallery items available yet.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div x-show="activeImage" x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center bg-forest-900/90 backdrop-blur-sm p-4"
             @click.self="activeImage = null">
            <div class="relative max-w-4xl w-full bg-white rounded-2xl overflow-hidden shadow-2xl">
                <button @click="activeImage = null" class="absolute top-4 right-4 z-10 w-10 h-10 bg-white/90 rounded-full flex items-center justify-center text-forest-800 hover:bg-white transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
                <img :src="activeImage" alt="Gallery image" class="w-full h-auto max-h-[80vh] object-contain">
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush
