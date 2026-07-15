@extends('admin.layouts.admin')

@section('title', 'Edit Banner - Admin')
@section('header', 'Edit Banner')

@section('content')
    <div class="max-w-lg bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Title *</label>
                <input type="text" name="title" value="{{ old('title', $banner->title) }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Subtitle</label>
                <input type="text" name="subtitle" value="{{ old('subtitle', $banner->subtitle) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('subtitle') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Image URL</label>
                <input type="text" name="image" value="{{ old('image', $banner->image) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Link URL</label>
                <input type="url" name="link" value="{{ old('link', $banner->link) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('link') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Page</label>
                <select name="page" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                    <option value="">Select Page</option>
                    <option value="home" {{ old('page', $banner->page) == 'home' ? 'selected' : '' }}>Home</option>
                    <option value="catalog" {{ old('page', $banner->page) == 'catalog' ? 'selected' : '' }}>Catalog</option>
                    <option value="about" {{ old('page', $banner->page) == 'about' ? 'selected' : '' }}>About</option>
                    <option value="contact" {{ old('page', $banner->page) == 'contact' ? 'selected' : '' }}>Contact</option>
                </select>
                @error('page') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Display Order</label>
                <input type="number" name="display_order" value="{{ old('display_order', $banner->display_order) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('display_order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <label class="flex items-center space-x-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }} class="rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                <span class="text-sm text-forest-700">Active</span>
            </label>
            <div class="flex items-center gap-4">
                <button type="submit" class="px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">Update Banner</button>
                <a href="{{ route('admin.banners.index') }}" class="px-6 py-3 bg-white text-forest-700 font-semibold rounded-xl border border-warm-gray/50 hover:bg-forest-50 transition-all">Cancel</a>
            </div>
        </form>
    </div>
@endsection
