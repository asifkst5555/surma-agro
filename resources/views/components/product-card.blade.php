<div class="bg-white rounded-2xl shadow-sm border border-warm-gray/50 overflow-hidden group hover:shadow-lg hover:border-forest-200 transition-all duration-300">
    @if($product->featured_image)
        <div class="overflow-hidden bg-forest-50">
            <img src="{{ Str::startsWith($product->featured_image, 'http') ? $product->featured_image : asset('storage/' . $product->featured_image) }}" alt="{{ $product->name }}" class="w-full h-auto block group-hover:scale-105 transition-transform duration-500">
        </div>
    @else
        <div class="aspect-[4/3] bg-gradient-to-br from-forest-100 to-forest-50 flex items-center justify-center">
            <span class="text-forest-300 text-4xl font-bold">{{ substr($product->name, 0, 2) }}</span>
        </div>
    @endif
    <div class="p-5">
        <span class="inline-block px-3 py-1 bg-forest-50 text-forest-600 text-xs font-semibold rounded-full mb-3">{{ $product->category?->name }}</span>
        <h3 class="text-lg font-bold text-forest-800 mb-2">{{ $product->name }}</h3>
        @if($product->short_description)
            <p class="text-forest-500 text-sm leading-relaxed mb-4 line-clamp-2">{{ $product->short_description }}</p>
        @endif
        <div class="flex flex-wrap gap-2 text-xs text-forest-500">
            @if($product->moq)<span class="px-2 py-1 bg-warm-light rounded-md">MOQ: {{ $product->moq }} MT</span>@endif
        </div>
    </div>
</div>
