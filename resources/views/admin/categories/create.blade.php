@extends('admin.layouts.admin')

@section('title', 'Create Category - Surma Agro Admin')
@section('header', 'Create Category')

@section('content')
    <div class="max-w-lg bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Name *</label>
                <input type="text" name="name" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Type *</label>
                <select name="type" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                    <option value="export">Export Items</option>
                    <option value="frozen">Frozen Export Items</option>
                    <option value="processed">Processed Food Products</option>
                    <option value="dried">Dried Fish Export Items</option>
                    <option value="import">Import Items</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="0" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
            </div>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="is_active" value="1" checked class="rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                <span class="text-sm text-forest-700">Active</span>
            </label>
            <button type="submit" class="px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">Create Category</button>
        </form>
    </div>
@endsection
