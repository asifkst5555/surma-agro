@extends('admin.layouts.admin')

@section('title', 'Edit Product - ' . $product->name)
@section('header', 'Edit Product')

@section('content')
@php
$productImages = $product->images->map(function($img) use ($product) {
    return ['id' => $img->id, 'url' => \Storage::url($img->image_path), 'is_primary' => $img->is_primary, 'alt' => $product->name];
})->values();
@endphp
<div class="max-w-6xl">
    <form action="{{ route('admin.products.update', $product) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
            <h3 class="text-lg font-semibold text-forest-800 mb-6">Product Information</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Category *</label>
                    <select name="category_id" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                        <option value="">Select Category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Product Name *</label>
                        <input type="text" name="name" id="product-name" value="{{ old('name', $product->name) }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Slug *</label>
                        <input type="text" name="slug" id="product-slug" value="{{ old('slug', $product->slug) }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                        @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Short Description</label>
                    <textarea name="short_description" rows="2" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none resize-none">{{ old('short_description', $product->short_description) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Full Description</label>
                    <textarea name="description" rows="5" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none resize-none">{{ old('description', $product->description) }}</textarea>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
            <h3 class="text-lg font-semibold text-forest-800 mb-6">Trade Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Origin</label>
                    <input type="text" name="origin" value="{{ old('origin', $product->origin) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="e.g. Bangladesh">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">MOQ (Metric Tons)</label>
                    <input type="number" step="0.01" name="moq" value="{{ old('moq', $product->moq) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="e.g. 10">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Packaging</label>
                    <input type="text" name="packaging" value="{{ old('packaging', $product->packaging) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="e.g. 25kg/50kg bags">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Export Capacity</label>
                    <input type="text" name="export_capacity" value="{{ old('export_capacity', $product->export_capacity) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="e.g. 500 MT/month">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Shipment Details</label>
                    <input type="text" name="shipment_details" value="{{ old('shipment_details', $product->shipment_details) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="e.g. FOB Chittagong">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Shelf Life</label>
                    <input type="text" name="shelf_life" value="{{ old('shelf_life', $product->shelf_life) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="e.g. 12 months">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
            <h3 class="text-lg font-semibold text-forest-800 mb-6">Status</h3>
            <div class="flex flex-wrap gap-6">
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="w-5 h-5 rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                    <span class="text-sm text-forest-700">Active (visible on website)</span>
                </label>
                <label class="flex items-center space-x-3 cursor-pointer">
                    <input type="hidden" name="is_featured" value="0">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }} class="w-5 h-5 rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                    <span class="text-sm text-forest-700">Featured (show on homepage)</span>
                </label>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="px-8 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">Update Product</button>
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 bg-white text-forest-700 font-semibold rounded-xl border border-warm-gray/50 hover:bg-forest-50 transition-all">Cancel</a>
        </div>
    </form>

    {{-- ============================================ --}}
    {{-- IMAGE MANAGEMENT PANEL --}}
    {{-- ============================================ --}}
    <div class="mt-8 bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8" x-data="imageManager()">
        <h3 class="text-lg font-semibold text-forest-800 mb-4">Product Images</h3>

        {{-- Tabs --}}
        <div class="flex flex-wrap gap-2 mb-6 border-b border-warm-gray/50 pb-4">
            <button type="button" @click="tab = 'current'" :class="tab === 'current' ? 'bg-forest-700 text-white' : 'bg-cream text-forest-700 border border-warm-gray/50'" class="px-4 py-2 text-sm font-semibold rounded-lg transition-all">
                Current Images <span class="ml-1 text-xs" x-text="'(' + images.length + ')'"></span>
            </button>
            <button type="button" @click="tab = 'upload'" :class="tab === 'upload' ? 'bg-forest-700 text-white' : 'bg-cream text-forest-700 border border-warm-gray/50'" class="px-4 py-2 text-sm font-semibold rounded-lg transition-all">
                Upload
            </button>
            <button type="button" @click="tab = 'search'" :class="tab === 'search' ? 'bg-forest-700 text-white' : 'bg-cream text-forest-700 border border-warm-gray/50'" class="px-4 py-2 text-sm font-semibold rounded-lg transition-all">
                Search Images
            </button>
            <button type="button" @click="tab = 'library'; loadLibrary()" :class="tab === 'library' ? 'bg-forest-700 text-white' : 'bg-cream text-forest-700 border border-warm-gray/50'" class="px-4 py-2 text-sm font-semibold rounded-lg transition-all">
                Image Library
            </button>
        </div>

        {{-- Status Message --}}
        <div x-show="message" x-cloak class="mb-4 p-3 rounded-xl text-sm" :class="messageType === 'success' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-red-50 text-red-700 border border-red-200'">
            <span x-text="message"></span>
        </div>

        {{-- TAB: Current Images --}}
        <div x-show="tab === 'current'">
            <template x-if="images.length === 0">
                <div class="text-center py-8 text-forest-400">
                    <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <p>No images yet. Upload or search for images.</p>
                </div>
            </template>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <template x-for="img in images" :key="img.id">
                    <div class="relative group rounded-xl overflow-hidden border border-warm-gray/50">
                        <img :src="img.url" :alt="img.alt || 'Product image'" class="w-full aspect-square object-cover">
                        <template x-if="img.is_primary">
                            <span class="absolute top-2 left-2 px-2 py-1 bg-earth-600 text-white text-xs font-semibold rounded-lg">Primary</span>
                        </template>
                        <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center gap-2">
                            <template x-if="!img.is_primary">
                                <button type="button" @click="setPrimary(img.id)" class="px-3 py-1.5 bg-white text-forest-700 text-xs font-semibold rounded-lg hover:bg-forest-50">Set Primary</button>
                            </template>
                            <button type="button" @click="deleteImage(img.id)" class="px-3 py-1.5 bg-red-600 text-white text-xs font-semibold rounded-lg hover:bg-red-500">Delete</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        {{-- TAB: Upload --}}
        <div x-show="tab === 'upload'">
            <div class="border-2 border-dashed border-warm-gray rounded-xl p-8 text-center" @dragover.prevent="dragOver = true" @dragleave="dragOver = false" @drop.prevent="handleDrop($event)" :class="dragOver && 'border-forest-500 bg-forest-50'">
                <svg class="w-12 h-12 mx-auto mb-3 text-forest-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                <p class="text-forest-600 font-medium mb-2">Drag & drop images here</p>
                <p class="text-forest-400 text-sm mb-4">or click to browse (JPEG, PNG, WebP, GIF — max 5MB each)</p>
                <label class="inline-block px-6 py-2.5 bg-forest-700 text-white text-sm font-semibold rounded-xl cursor-pointer hover:bg-forest-600 transition-all">
                    Choose Files
                    <input type="file" multiple accept="image/jpeg,image/png,image/webp,image/gif" @change="handleFileSelect($event)" class="hidden">
                </label>
            </div>
            <div x-show="uploading" class="mt-4 text-center text-forest-500 text-sm">
                <svg class="animate-spin w-5 h-5 inline mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                Uploading...
            </div>
        </div>

        {{-- TAB: Search Unsplash --}}
        <div x-show="tab === 'search'">
            <div class="flex gap-3 mb-4">
                <select x-model="searchSource" class="px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 text-sm focus:ring-2 focus:ring-forest-500 outline-none">
                    <option value="unsplash">Unsplash</option>
                    <option value="pexels">Pexels</option>
                    <option value="pixabay">Pixabay</option>
                </select>
                <input type="text" x-model="searchQuery" @keydown.enter.prevent="searchImages()" placeholder="Search for images (e.g. rice, fish, spices...)" class="flex-1 px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none text-sm">
                <button type="button" @click="searchImages()" :disabled="searching" class="px-6 py-3 bg-forest-700 text-white text-sm font-semibold rounded-xl hover:bg-forest-600 transition-all disabled:opacity-50">
                    <span x-show="!searching">Search</span>
                    <span x-show="searching">Searching...</span>
                </button>
            </div>
            <div x-show="searchResults.length > 0" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <template x-for="result in searchResults" :key="result.id">
                    <div class="relative rounded-xl overflow-hidden border border-warm-gray/50">
                        <img :src="result.thumbnail || result.thumb || result.small || result.url" :alt="result.alt_description || result.alt || 'Search result'" class="w-full aspect-square object-cover">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                            <button type="button" @click="downloadFromSearch(result)" :disabled="result.downloading" class="px-3 py-2 bg-white text-forest-700 text-xs font-semibold rounded-lg hover:bg-forest-50 disabled:opacity-50">
                                <span x-show="!result.downloading">Download & Attach</span>
                                <span x-show="result.downloading">Downloading...</span>
                            </button>
                        </div>
                    </div>
                </template>
            </div>
            <div x-show="searchResults.length === 0 && searchDone" class="text-center py-8 text-forest-400">
                <p>No images found. Try a different search term.</p>
            </div>
        </div>

        {{-- TAB: Image Library --}}
        <div x-show="tab === 'library'">
            <div x-show="libraryLoading" class="text-center py-8 text-forest-400">
                <svg class="animate-spin w-6 h-6 inline mr-2" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                Loading library...
            </div>
            <div x-show="!libraryLoading && libraryImages.length > 0" class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <template x-for="img in libraryImages" :key="img.id">
                    <div class="relative rounded-xl overflow-hidden border border-warm-gray/50">
                        <img :src="img.url" :alt="'Library image'" class="w-full aspect-square object-cover">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity">
                            <button type="button" @click="assignFromLibrary(img.id)" class="px-3 py-2 bg-white text-forest-700 text-xs font-semibold rounded-lg hover:bg-forest-50">
                                Attach to Product
                            </button>
                        </div>
                    </div>
                </template>
            </div>
            <div x-show="!libraryLoading && libraryImages.length === 0" class="text-center py-8 text-forest-400">
                <p>No unassigned images in the library.</p>
            </div>
        </div>
    </div>
</div>

<script>
function imageManager() {
    return {
        tab: 'current',
        images: {!! json_encode($productImages) !!},
        message: '',
        messageType: 'success',
        uploading: false,
        dragOver: false,
        searchQuery: '{{ $product->name }}',
        searchSource: 'unsplash',
        searchResults: [],
        searching: false,
        searchDone: false,
        libraryImages: [],
        libraryLoading: false,

        showMessage(msg, type) {
            this.message = msg;
            this.messageType = type;
            setTimeout(() => { this.message = ''; }, 4000);
        },

        // Upload
        handleFileSelect(event) {
            this.uploadFiles(event.target.files);
        },
        handleDrop(event) {
            this.dragOver = false;
            this.uploadFiles(event.dataTransfer.files);
        },
        uploadFiles(files) {
            if (!files.length) return;
            this.uploading = true;
            var formData = new FormData();
            for (var i = 0; i < files.length; i++) {
                formData.append('images[]', files[i]);
            }
            fetch('{{ route("admin.products.upload-images", $product) }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body: formData
            })
            .then(r => r.json())
            .then(data => {
                this.uploading = false;
                if (data.success) {
                    this.showMessage(data.count + ' image(s) uploaded successfully.', 'success');
                    this.refreshImages();
                    this.tab = 'current';
                } else {
                    this.showMessage(data.error || 'Upload failed.', 'error');
                }
            })
            .catch(() => { this.uploading = false; this.showMessage('Upload failed.', 'error'); });
        },

        // Search Images (Unsplash/Pexels/Pixabay)
        searchImages() {
            if (!this.searchQuery.trim()) return;
            this.searching = true;
            this.searchDone = false;
            fetch('/admin/image-manager/search?q=' + encodeURIComponent(this.searchQuery) + '&count=12&source=' + this.searchSource, {
                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            })
            .then(r => r.json())
            .then(data => {
                this.searching = false;
                this.searchDone = true;
                this.searchResults = (data.results || []).map(r => ({...r, downloading: false}));
            })
            .catch(() => { this.searching = false; this.searchDone = true; });
        },

        downloadFromSearch(result) {
            result.downloading = true;
            var url = result.download_url || result.url || result.urls?.regular || result.urls?.full;
            fetch('/admin/image-manager/download', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body: JSON.stringify({ url: url, product_id: {{ $product->id }}, product_name: '{{ $product->name }}', subfolder: 'products' })
            })
            .then(r => r.json())
            .then(data => {
                result.downloading = false;
                if (data.success) {
                    this.showMessage('Image downloaded and attached.', 'success');
                    this.refreshImages();
                } else {
                    this.showMessage(data.error || 'Download failed.', 'error');
                }
            })
            .catch(() => { result.downloading = false; this.showMessage('Download failed.', 'error'); });
        },

        // Library - show all images NOT assigned to this product
        loadLibrary() {
            this.libraryLoading = true;
            fetch('/admin/image-manager/gallery?format=json', {
                headers: { 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => {
                this.libraryLoading = false;
                var currentIds = this.images.map(i => i.id);
                var allImages = data.images || data.data || [];
                this.libraryImages = allImages.filter(i => !currentIds.includes(i.id) && i.product_id !== {{ $product->id }}).map(i => ({
                    id: i.id,
                    url: '/storage/' + i.image_path
                })).slice(0, 40);
            })
            .catch(() => { this.libraryLoading = false; });
        },

        assignFromLibrary(imageId) {
            fetch('/admin/image-manager/assign', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' },
                body: JSON.stringify({ image_id: imageId, product_id: {{ $product->id }}, is_primary: false })
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    this.showMessage('Image attached to product.', 'success');
                    this.libraryImages = this.libraryImages.filter(i => i.id !== imageId);
                    this.refreshImages();
                }
            });
        },

        // Set Primary
        setPrimary(imageId) {
            fetch('/admin/image-manager/set-primary/' + imageId, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            })
            .then(() => {
                this.images = this.images.map(i => ({...i, is_primary: i.id === imageId}));
                this.showMessage('Primary image updated.', 'success');
            });
        },

        // Delete
        deleteImage(imageId) {
            if (!confirm('Delete this image permanently?')) return;
            fetch('/admin/image-manager/' + imageId, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
            })
            .then(() => {
                this.images = this.images.filter(i => i.id !== imageId);
                this.showMessage('Image deleted.', 'success');
            });
        },

        // Refresh current images
        refreshImages() {
            fetch('/admin/image-manager/product/{{ $product->id }}/images', {
                headers: { 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => {
                this.images = (data.images || []).map(i => ({
                    id: i.id,
                    url: '/storage/' + i.image_path,
                    is_primary: i.is_primary,
                    alt: '{{ $product->name }}'
                }));
            });
        }
    };
}
</script>

<script>
document.getElementById('product-name').addEventListener('blur', function() {
    var slugField = document.getElementById('product-slug');
    if (!slugField.value || slugField.value === '{{ $product->slug }}') {
        slugField.value = this.value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
    }
});
</script>
@endsection
