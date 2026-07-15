@extends('admin.layouts.admin')

@section('title', 'Create Product - Surma Agro Admin')
@section('header', 'Create Product')

@section('content')
    <div class="max-w-2xl bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
        <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Category *</label>
                <select name="category_id" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Name *</label>
                <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Slug *</label>
                <input type="text" name="slug" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Short Description</label>
                <textarea name="short_description" rows="3" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Description</label>
                <textarea name="description" rows="6" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none"></textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Origin</label>
                    <input type="text" name="origin" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">MOQ (MT)</label>
                    <input type="number" step="0.01" name="moq" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Packaging</label>
                    <input type="text" name="packaging" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Export Capacity</label>
                    <input type="text" name="export_capacity" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="is_featured" value="1" class="rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                    <span class="text-sm text-forest-700">Featured Product</span>
                </label>
                <label class="flex items-center space-x-2">
                    <input type="checkbox" name="is_active" value="1" checked class="rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                    <span class="text-sm text-forest-700">Active</span>
                </label>
            </div>
            <button type="submit" class="px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">Create Product</button>
        </form>
    </div>
@endsection
