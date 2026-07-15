@extends('layouts.app')

@section('title', $product->name . ' - Surma Agro')
@section('meta_description', $product->short_description ?? 'Premium ' . $product->name . ' available for B2B export from Surma Agro.')

@push('schema')
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@type": "Product",
    "name": "{{ $product->name }}",
    "description": "{{ $product->short_description ?? $product->name }}",
    "image": "{{ $product->featured_image ?? asset('images/placeholder.jpg') }}",
    "category": "{{ $product->category?->name ?? 'General' }}",
    "brand": {
        "@type": "Brand",
        "name": "Surma Agro"
    },
    "offers": {
        "@type": "Offer",
        "availability": "https://schema.org/InStock",
        "priceCurrency": "USD",
        "url": "{{ url()->current() }}"
    }
}
</script>
@endpush

@section('content')
    <section class="relative pt-32 pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-earth-500 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div data-gsap="fade-right">
                    <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-4 border border-white/10">{{ $product->category?->name }}</span>
                    <h1 class="text-4xl lg:text-5xl font-bold text-white mb-4">{{ $product->name }}</h1>
                    @if($product->short_description)
                        <p class="text-lg text-forest-200 leading-relaxed">{{ $product->short_description }}</p>
                    @endif
                </div>
                <div class="hidden lg:block" data-gsap="fade-left">
                    <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 border border-white/10">
                        @if($product->featured_image)
                            <div class="rounded-2xl overflow-hidden">
                                <img src="{{ Str::startsWith($product->featured_image, 'http') ? $product->featured_image : asset('storage/' . $product->featured_image) }}" alt="{{ $product->name }}" class="w-full h-auto block">
                            </div>
                        @else
                            <div class="aspect-[4/3] bg-white/5 rounded-2xl flex items-center justify-center">
                                <span class="text-forest-300 text-6xl font-bold">{{ substr($product->name, 0, 2) }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Product Image Gallery --}}
            @php $gallery = $product->image_gallery; @endphp
            @if($gallery && $gallery->count() > 0)
            <div class="mb-10" data-gsap="fade-up">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($gallery->take(8) as $image)
                        <div class="aspect-square rounded-2xl overflow-hidden bg-white border border-warm-gray/50">
                            <img src="{{ $image['url'] }}" alt="{{ $image['alt'] }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-300" loading="lazy">
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="grid lg:grid-cols-3 gap-10">
                <div class="lg:col-span-2 space-y-8" data-gsap="fade-right">
                    @if($product->description)
                        <div class="bg-white rounded-2xl p-8 border border-warm-gray/50">
                            <h2 class="text-xl font-bold text-forest-800 mb-4">Product Description</h2>
                            <div class="text-forest-500 leading-relaxed">{!! nl2br(e($product->description)) !!}</div>
                        </div>
                    @endif

                    @if($product->specifications)
                        <div class="bg-white rounded-2xl p-8 border border-warm-gray/50">
                            <h2 class="text-xl font-bold text-forest-800 mb-4">Specifications</h2>
                            <div class="grid grid-cols-2 gap-4">
                                @foreach($product->specifications as $key => $value)
                                    <div class="flex justify-between p-3 bg-cream rounded-xl">
                                        <span class="text-forest-500 text-sm">{{ $key }}</span>
                                        <span class="text-forest-800 text-sm font-semibold">{{ $value }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="bg-white rounded-2xl p-8 border border-warm-gray/50">
                        <h2 class="text-xl font-bold text-forest-800 mb-4">Shipping & Trade Info</h2>
                        <div class="grid grid-cols-2 gap-4">
                            @if($product->origin)
                                <div class="flex justify-between p-3 bg-cream rounded-xl">
                                    <span class="text-forest-500 text-sm">Origin</span>
                                    <span class="text-forest-800 text-sm font-semibold">{{ $product->origin }}</span>
                                </div>
                            @endif
                            @if($product->moq)
                                <div class="flex justify-between p-3 bg-cream rounded-xl">
                                    <span class="text-forest-500 text-sm">MOQ</span>
                                    <span class="text-forest-800 text-sm font-semibold">{{ $product->moq }} MT</span>
                                </div>
                            @endif
                            @if($product->packaging)
                                <div class="flex justify-between p-3 bg-cream rounded-xl">
                                    <span class="text-forest-500 text-sm">Packaging</span>
                                    <span class="text-forest-800 text-sm font-semibold">{{ $product->packaging }}</span>
                                </div>
                            @endif
                            @if($product->export_capacity)
                                <div class="flex justify-between p-3 bg-cream rounded-xl">
                                    <span class="text-forest-500 text-sm">Export Capacity</span>
                                    <span class="text-forest-800 text-sm font-semibold">{{ $product->export_capacity }}</span>
                                </div>
                            @endif
                            @if($product->shipment_details)
                                <div class="flex justify-between p-3 bg-cream rounded-xl">
                                    <span class="text-forest-500 text-sm">Shipment</span>
                                    <span class="text-forest-800 text-sm font-semibold">{{ $product->shipment_details }}</span>
                                </div>
                            @endif
                            @if($product->shelf_life)
                                <div class="flex justify-between p-3 bg-cream rounded-xl">
                                    <span class="text-forest-500 text-sm">Shelf Life</span>
                                    <span class="text-forest-800 text-sm font-semibold">{{ $product->shelf_life }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Inquiry Form Sidebar --}}
                <div class="lg:col-span-1" data-gsap="fade-left">
                    <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm sticky top-28">
                        <h3 class="text-lg font-bold text-forest-800 mb-4">Inquire About This Product</h3>
                        @if(session('success'))
                            <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>
                        @endif
                        <form action="{{ route('catalog.product.inquiry', $product->slug) }}" method="POST" class="space-y-4">
                            @csrf
                            <div>
                                <input type="text" name="name" placeholder="Full Name *" required
                                    class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-sm text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            </div>
                            <div>
                                <input type="email" name="email" placeholder="Email *" required
                                    class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-sm text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            </div>
                            <div>
                                <input type="tel" name="phone" placeholder="Phone"
                                    class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-sm text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            </div>
                            <div>
                                <input type="text" name="company" placeholder="Company"
                                    class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-sm text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            </div>
                            <div>
                                <input type="text" name="country" placeholder="Country"
                                    class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-sm text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            </div>
                            <div>
                                <textarea name="message" rows="4" placeholder="Your message / quantity required *" required
                                    class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-sm text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none resize-none"></textarea>
                            </div>
                            <button type="submit" class="w-full px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all shadow-lg shadow-forest-700/20">
                                Send Inquiry
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Related Products --}}
            @if($relatedProducts->count() > 0)
                <div class="mt-16" data-gsap="fade-up">
                    <h2 class="text-2xl font-bold text-forest-800 mb-6">Related Products</h2>
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($relatedProducts as $related)
                            <x-product-card :product="$related" />
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
