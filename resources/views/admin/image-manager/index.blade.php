@extends('admin.layouts.admin')

@section('title', 'AI Image Manager - Surma Agro Admin')
@section('header', 'AI Image Manager')

@section('content')
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-forest-500">Total Images</p>
                    <p class="text-3xl font-bold text-forest-800 mt-1">{{ $stats['total_images'] }}</p>
                </div>
                <div class="w-12 h-12 bg-forest-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-forest-500">Total Downloads</p>
                    <p class="text-3xl font-bold text-forest-800 mt-1">{{ $stats['total_downloads'] }}</p>
                </div>
                <div class="w-12 h-12 bg-earth-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-earth-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-forest-500">Pending Downloads</p>
                    <p class="text-3xl font-bold text-forest-800 mt-1">{{ $stats['pending_downloads'] }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-50 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-forest-500">Products with Images</p>
                    <p class="text-3xl font-bold text-forest-800 mt-1">{{ $stats['products_with_images'] }}</p>
                </div>
                <div class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
        </div>
    </div>

    {{-- Unsplash Bulk Search Section --}}
    <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-6 mb-8" x-data="unsplashSearch()">
        <div class="flex items-center justify-between mb-4">
            <div>
                <h3 class="text-lg font-bold text-forest-800">Unsplash Bulk Image Search</h3>
                <p class="text-sm text-forest-500">Search, preview, and download images directly from Unsplash</p>
            </div>
            <span class="px-3 py-1 bg-green-50 text-green-700 text-xs font-semibold rounded-full">API Connected</span>
        </div>

        <div class="flex space-x-3 mb-4">
            <input type="text" x-model="query" @keydown.enter="search()" placeholder="e.g. rice mill, agro factory, wheat flour, frozen fish..." class="flex-1 px-4 py-3 rounded-xl border border-warm-gray bg-cream text-sm text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
            <select x-model="subfolder" class="px-4 py-3 rounded-xl border border-warm-gray bg-cream text-sm text-forest-700 focus:ring-2 focus:ring-forest-500 outline-none">
                <option value="hero">Hero</option>
                <option value="products">Products</option>
                <option value="gallery">Gallery</option>
                <option value="factory">Factory</option>
                <option value="about">About</option>
                <option value="export">Export</option>
                <option value="blog">Blog</option>
                <option value="banners">Banners</option>
            </select>
            <select x-model="resultCount" class="px-4 py-3 rounded-xl border border-warm-gray bg-cream text-sm text-forest-700 focus:ring-2 focus:ring-forest-500 outline-none">
                <option value="10">10</option>
                <option value="20" selected>20</option>
                <option value="30">30</option>
                <option value="50">50</option>
            </select>
            <button @click="search()" :disabled="loading" class="px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all disabled:opacity-50 flex items-center space-x-2">
                <svg x-show="!loading" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <svg x-show="loading" class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                <span x-text="loading ? 'Searching...' : 'Search'"></span>
            </button>
        </div>

        <div x-show="searched && !loading && results.length === 0" class="text-center py-8 text-forest-500">
            No images found for this query. Try different keywords.
        </div>

        <template x-if="results.length > 0">
            <div>
                <div class="flex items-center justify-between mb-3">
                    <p class="text-sm text-forest-500" x-text="`${results.length} images found`"></p>
                    <button @click="downloadAll()" :disabled="downloading" class="px-4 py-2 bg-earth-600 text-white text-sm font-semibold rounded-xl hover:bg-earth-500 transition-all disabled:opacity-50">
                        <span x-text="downloading ? 'Downloading...' : 'Download All (' + results.length + ')'"></span>
                    </button>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                    <template x-for="(img, i) in results" :key="i">
                        <div class="relative group rounded-xl overflow-hidden border border-warm-gray/50 bg-cream">
                            <img :src="img.thumbnail || img.url" :alt="img.alt" class="w-full h-28 object-cover" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-forest-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex flex-col justify-end p-2">
                                <p class="text-white text-[10px] truncate" x-text="img.credit"></p>
                                <div class="flex space-x-1 mt-1">
                                    <button @click="downloadOne(img)" class="flex-1 px-2 py-1 bg-white text-forest-800 text-[10px] font-semibold rounded hover:bg-earth-500 hover:text-white transition-colors">Download</button>
                                </div>
                            </div>
                            <span class="absolute top-1 right-1 px-1.5 py-0.5 bg-black/50 text-white text-[10px] rounded" x-text="img.width + 'x' + img.height"></span>
                            <div x-show="downloaded[img.id]" class="absolute top-1 left-1 px-1.5 py-0.5 bg-green-500 text-white text-[10px] font-semibold rounded">Done</div>
                        </div>
                    </template>
                </div>
            </div>
        </template>

        {{-- Download progress --}}
        <div x-show="downloadResults.length > 0" class="mt-4 p-4 bg-cream rounded-xl">
            <p class="text-sm font-semibold text-forest-700 mb-2">Download Results</p>
            <div class="space-y-1">
                <template x-for="(r, i) in downloadResults" :key="i">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-forest-600 truncate max-w-xs" x-text="r.url.substring(0, 50) + '...'"></span>
                        <span :class="r.status === 'success' ? 'text-green-600' : 'text-red-600'" x-text="r.status === 'success' ? 'Downloaded' : 'Failed'"></span>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-6 mb-8">
        {{-- Quick Search --}}
        <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-6">
            <h3 class="text-lg font-bold text-forest-800 mb-4">Quick Image Search</h3>
            <div x-data="{ query: '', results: [], loading: false, searched: false }">
                <div class="flex space-x-3">
                    <input type="text" x-model="query" @keydown.enter="
                        if(!query.trim()) return;
                        loading = true; searched = true;
                        fetch('{{ route('admin.image-manager.search') }}?q=' + encodeURIComponent(query) + '&count=12')
                            .then(r => r.json()).then(d => { results = d.results; loading = false; });
                    " placeholder="Search for product images..." class="flex-1 px-4 py-3 rounded-xl border border-warm-gray bg-cream text-sm text-forest-800 placeholder-forest-400 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                    <button @click="
                        if(!query.trim()) return;
                        loading = true; searched = true;
                        fetch('{{ route('admin.image-manager.search') }}?q=' + encodeURIComponent(query) + '&count=12')
                            .then(r => r.json()).then(d => { results = d.results; loading = false; });
                    " class="px-5 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">Search</button>
                </div>

                <div x-show="loading" class="text-center py-8 text-forest-500">Searching...</div>

                <template x-if="results.length > 0">
                    <div class="mt-4">
                        <div class="grid grid-cols-3 gap-3">
                            <template x-for="(img, i) in results" :key="i">
                                <div class="relative group cursor-pointer rounded-xl overflow-hidden border border-warm-gray/50">
                                    <img :src="img.thumbnail || img.url" :alt="img.alt" class="w-full h-24 object-cover">
                                    <div class="absolute inset-0 bg-forest-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center space-x-2">
                                        <button @click="
                                            fetch('{{ route('admin.image-manager.download') }}', {
                                                method: 'POST',
                                                headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                                                body: JSON.stringify({ url: img.url, product_name: query })
                                            }).then(r => r.json()).then(d => { if(d.success) alert('Downloaded!'); else alert('Error: ' + d.error); });
                                        " class="px-3 py-1.5 bg-white text-forest-800 text-xs font-semibold rounded-lg hover:bg-earth-500 hover:text-white transition-colors">Download</button>
                                    </div>
                                    <span class="absolute top-1 right-1 px-1.5 py-0.5 bg-black/50 text-white text-[10px] rounded" x-text="img.source"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-6">
            <h3 class="text-lg font-bold text-forest-800 mb-4">Quick Actions</h3>
            <div class="space-y-3">
                <a href="{{ route('admin.image-manager.gallery') }}" class="flex items-center justify-between p-4 bg-cream rounded-xl hover:bg-forest-50 transition-colors">
                    <span class="text-forest-700 font-medium">Browse All Images</span>
                    <svg class="w-5 h-5 text-forest-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('admin.image-manager.history') }}" class="flex items-center justify-between p-4 bg-cream rounded-xl hover:bg-forest-50 transition-colors">
                    <span class="text-forest-700 font-medium">Download History</span>
                    <svg class="w-5 h-5 text-forest-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center justify-between p-4 bg-cream rounded-xl hover:bg-forest-50 transition-colors">
                    <span class="text-forest-700 font-medium">Manage Products</span>
                    <svg class="w-5 h-5 text-forest-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>

            <div class="mt-6 space-y-3">
                <div class="p-4 bg-gradient-to-r from-forest-800 to-forest-700 rounded-xl">
                    <p class="text-white text-sm font-semibold mb-1">Collect Images by Query</p>
                    <p class="text-forest-200 text-xs mb-3">Download images directly from Unsplash</p>
                    <code class="block text-xs text-earth-300 bg-forest-900/50 px-3 py-2 rounded-lg">php artisan ai:collect-images "rice mill"</code>
                </div>
                <div class="p-4 bg-gradient-to-r from-earth-800 to-earth-700 rounded-xl">
                    <p class="text-white text-sm font-semibold mb-1">Bulk Product Collection</p>
                    <p class="text-forest-200 text-xs mb-3">Auto-assign images to all products</p>
                    <code class="block text-xs text-earth-300 bg-forest-900/50 px-3 py-2 rounded-lg">php artisan ai:collect-images --all</code>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Images --}}
    <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-forest-800">Recently Added Images</h3>
            <a href="{{ route('admin.image-manager.gallery') }}" class="text-sm text-forest-600 hover:text-forest-800">View All</a>
        </div>
        @if($recentImages->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach($recentImages as $image)
                    <div class="relative group rounded-xl overflow-hidden border border-warm-gray/50">
                        <img src="{{ $image->thumb_url }}" alt="{{ $image->alt_text }}" class="w-full h-32 object-cover">
                        <div class="absolute inset-0 bg-forest-900/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <a href="{{ route('admin.image-manager.destroy', $image) }}" onclick="return confirm('Delete this image?')" class="px-3 py-1.5 bg-red-500 text-white text-xs font-semibold rounded-lg hover:bg-red-600">Delete</a>
                        </div>
                        @if($image->is_primary)
                            <span class="absolute top-1 left-1 px-2 py-0.5 bg-earth-500 text-white text-[10px] font-semibold rounded">Primary</span>
                        @endif
                        @if($image->type)
                            <span class="absolute top-1 right-1 px-1.5 py-0.5 bg-forest-700/70 text-white text-[10px] rounded">{{ $image->type }}</span>
                        @endif
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 text-forest-500">
                <p>No images yet. Use the Unsplash bulk search above to get started.</p>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
function unsplashSearch() {
    return {
        query: '',
        subfolder: 'hero',
        resultCount: 20,
        results: [],
        loading: false,
        searched: false,
        downloading: false,
        downloaded: {},
        downloadResults: [],

        search() {
            if (!this.query.trim()) return;
            this.loading = true;
            this.searched = true;
            this.downloadResults = [];

            fetch('{{ route('admin.image-manager.search') }}?q=' + encodeURIComponent(this.query) + '&count=' + this.resultCount)
                .then(r => r.json())
                .then(d => {
                    this.results = d.results || [];
                    this.loading = false;
                })
                .catch(() => { this.loading = false; });
        },

        downloadOne(img) {
            fetch('{{ route('admin.image-manager.download') }}', {
                method: 'POST',
                headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
                body: JSON.stringify({
                    url: img.url || img.full_url,
                    product_name: this.query,
                    subfolder: this.subfolder
                })
            })
            .then(r => r.json())
            .then(d => {
                if (d.success) {
                    this.downloaded[img.id] = true;
                    this.downloadResults.push({ url: img.url, status: 'success' });
                } else {
                    this.downloadResults.push({ url: img.url, status: 'error: ' + (d.error || '') });
                }
            })
            .catch(e => {
                this.downloadResults.push({ url: img.url, status: 'error' });
            });
        },

        downloadAll() {
            this.downloading = true;
            this.downloadResults = [];
            let completed = 0;

            const next = (index) => {
                if (index >= this.results.length) {
                    this.downloading = false;
                    return;
                }
                const img = this.results[index];
                this.downloadOne(img);
                setTimeout(() => next(index + 1), 300);
            };

            next(0);

            // Poll for completion
            const check = setInterval(() => {
                completed = this.downloadResults.length;
                if (completed >= this.results.length) {
                    clearInterval(check);
                    this.downloading = false;
                }
            }, 500);
        }
    }
}
</script>
@endpush
