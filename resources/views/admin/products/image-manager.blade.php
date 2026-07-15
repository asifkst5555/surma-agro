@extends('admin.layouts.admin')

@section('title', 'Images: ' . $product->name . ' - Surma Agro Admin')
@section('header', 'Images: ' . $product->name)

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.products.edit', $product) }}" class="text-sm text-forest-600 hover:text-forest-800">&larr; Back to Product</a>
    </div>

    <div x-data="imageManager()" class="space-y-8">
        {{-- Current Images --}}
        <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-forest-800">Current Images</h3>
                <button @click="collectImages()" :disabled="collecting" class="px-4 py-2 bg-forest-700 text-white text-sm font-semibold rounded-xl hover:bg-forest-600 transition-all disabled:opacity-50">
                    <span x-text="collecting ? 'Collecting...' : 'AI Collect Images'"></span>
                </button>
            </div>

            <div x-show="collecting" class="mb-4 p-4 bg-forest-50 rounded-xl text-forest-700 text-sm">
                AI is searching and downloading images for "{{ $product->name }}"...
            </div>

            <div id="current-images" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                @forelse($product->images as $image)
                    <div class="relative group rounded-xl overflow-hidden border border-warm-gray/50 bg-cream">
                        <img src="{{ $image->thumb_url }}" alt="{{ $image->alt_text }}" class="w-full h-32 object-cover">
                        <div class="absolute inset-0 bg-forest-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center space-x-2">
                            @if(!$image->is_primary)
                                <form action="{{ route('admin.image-manager.set-primary', $image) }}" method="POST">
                                    @csrf
                                    <button class="px-3 py-1.5 bg-earth-500 text-white text-xs font-semibold rounded-lg hover:bg-earth-600">Set Primary</button>
                                </form>
                            @endif
                            <form action="{{ route('admin.image-manager.destroy', $image) }}" method="POST" onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1.5 bg-red-500 text-white text-xs font-semibold rounded-lg hover:bg-red-600">Delete</button>
                            </form>
                        </div>
                        @if($image->is_primary)
                            <span class="absolute top-1 left-1 px-2 py-0.5 bg-earth-500 text-white text-[10px] font-semibold rounded">Primary</span>
                        @endif
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-forest-500">
                        <p>No images assigned yet. Click "AI Collect Images" to search and download.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- AI Suggestions --}}
        <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-forest-800">AI Image Suggestions</h3>
                <button @click="searchImages()" :disabled="searching" class="px-4 py-2 bg-earth-600 text-white text-sm font-semibold rounded-xl hover:bg-earth-500 transition-all disabled:opacity-50">
                    <span x-text="searching ? 'Searching...' : 'Find Suggestions'"></span>
                </button>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                <template x-for="(img, i) in suggestions" :key="i">
                    <div class="relative group rounded-xl overflow-hidden border border-warm-gray/50 bg-cream">
                        <img :src="img.thumbnail || img.url" :alt="img.alt" class="w-full h-28 object-cover">
                        <div class="absolute inset-0 bg-forest-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <button @click="downloadImage(img.url)" class="px-3 py-1.5 bg-white text-forest-800 text-xs font-semibold rounded-lg hover:bg-earth-500 hover:text-white transition-colors">Download</button>
                        </div>
                        <span class="absolute top-1 right-1 px-1.5 py-0.5 bg-black/50 text-white text-[10px] rounded" x-text="img.source"></span>
                    </div>
                </template>
            </div>
            <div x-show="!searching && suggestions.length === 0" class="text-center py-8 text-forest-500">
                Click "Find Suggestions" to see AI-recommended images for this product.
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function imageManager() {
    return {
        suggestions: [],
        searching: false,
        collecting: false,

        searchImages() {
            this.searching = true;
            fetch('{{ route('admin.image-manager.suggest', $product) }}')
                .then(r => r.json())
                .then(d => {
                    this.suggestions = d.results || [];
                    this.searching = false;
                })
                .catch(() => { this.searching = false; });
        },

        downloadImage(url) {
            fetch('{{ route('admin.image-manager.download') }}', {
                method: 'POST',
                headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                body: JSON.stringify({ url: url, product_id: {{ $product->id }}, product_name: '{{ $product->name }}' })
            })
            .then(r => r.json())
            .then(d => {
                if (d.success) {
                    location.reload();
                } else {
                    alert('Error: ' + d.error);
                }
            });
        },

        collectImages() {
            this.collecting = true;
            fetch('{{ route('admin.image-manager.collect', $product) }}', {
                method: 'POST',
                headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                body: JSON.stringify({ count: 5 })
            })
            .then(r => r.json())
            .then(d => {
                this.collecting = false;
                if (d.success) {
                    location.reload();
                } else {
                    alert('Error: ' + (d.error || 'Failed to collect images'));
                }
            })
            .catch(() => { this.collecting = false; });
        }
    }
}
</script>
@endpush
