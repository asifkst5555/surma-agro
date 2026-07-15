@extends('admin.layouts.admin')

@section('title', 'Edit Gallery Item - Surma Agro Admin')
@section('header', 'Edit Gallery Item')

@section('content')
    <div class="max-w-2xl bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
        <form action="{{ route('admin.gallery.update', $galleryItem) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Title</label>
                <input type="text" name="title" value="{{ old('title', $galleryItem->title) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">{{ old('description', $galleryItem->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Image URL *</label>
                <input type="url" name="image" value="{{ old('image', $galleryItem->image) }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="https://example.com/image.jpg">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Category</label>
                    <input type="text" name="category" value="{{ old('category', $galleryItem->category) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="e.g. Factory, Products">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Type *</label>
                    <select name="type" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                        <option value="image" {{ $galleryItem->type == 'image' ? 'selected' : '' }}>Image</option>
                        <option value="video" {{ $galleryItem->type == 'video' ? 'selected' : '' }}>Video</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Video URL</label>
                <input type="url" name="video_url" value="{{ old('video_url', $galleryItem->video_url) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="https://youtube.com/watch?v=...">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $galleryItem->sort_order) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
                <div class="flex items-end pb-3">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $galleryItem->is_active) ? 'checked' : '' }} class="rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                        <span class="text-sm text-forest-700">Active</span>
                    </label>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <button type="submit" class="px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">Update Item</button>
                <a href="{{ route('admin.gallery.index') }}" class="px-6 py-3 text-forest-600 hover:text-forest-800 transition-all">Cancel</a>
            </div>
        </form>
    </div>
@endsection
