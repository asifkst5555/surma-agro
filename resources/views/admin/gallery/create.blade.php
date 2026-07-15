@extends('admin.layouts.admin')

@section('title', 'Add Gallery Item - Surma Agro Admin')
@section('header', 'Add Gallery Item')

@section('content')
    <div class="max-w-2xl bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
        <form action="{{ route('admin.gallery.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Image URL *</label>
                <input type="url" name="image" value="{{ old('image') }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="https://example.com/image.jpg">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Category</label>
                    <input type="text" name="category" value="{{ old('category') }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="e.g. Factory, Products">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Type *</label>
                    <select name="type" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                        <option value="image" selected>Image</option>
                        <option value="video">Video</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Video URL</label>
                <input type="url" name="video_url" value="{{ old('video_url') }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="https://youtube.com/watch?v=...">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
                <div class="flex items-end pb-3">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                        <span class="text-sm text-forest-700">Active</span>
                    </label>
                </div>
            </div>
            <button type="submit" class="px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">Add Item</button>
        </form>
    </div>
@endsection
