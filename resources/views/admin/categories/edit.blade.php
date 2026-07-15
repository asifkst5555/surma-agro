@extends('admin.layouts.admin')

@section('title', 'Edit Category - ' . $category->name)
@section('header', 'Edit Category')

@section('content')
    <div class="max-w-lg bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Name *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none resize-none">{{ old('description', $category->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Type *</label>
                <select name="type" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                    <option value="export" {{ old('type', $category->type) === 'export' ? 'selected' : '' }}>Export Items</option>
                    <option value="frozen" {{ old('type', $category->type) === 'frozen' ? 'selected' : '' }}>Frozen Export Items</option>
                    <option value="processed" {{ old('type', $category->type) === 'processed' ? 'selected' : '' }}>Processed Food Products</option>
                    <option value="dried" {{ old('type', $category->type) === 'dried' ? 'selected' : '' }}>Dried Fish Export Items</option>
                    <option value="import" {{ old('type', $category->type) === 'import' ? 'selected' : '' }}>Import Items</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
            </div>
            <label class="flex items-center space-x-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                <span class="text-sm text-forest-700">Active</span>
            </label>
            <div class="flex items-center gap-4">
                <button type="submit" class="px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">Update Category</button>
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 bg-white text-forest-700 font-semibold rounded-xl border border-warm-gray/50 hover:bg-forest-50 transition-all">Cancel</a>
            </div>
        </form>
    </div>
@endsection
