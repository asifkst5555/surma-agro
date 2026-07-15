@extends('admin.layouts.admin')

@section('title', 'Categories - Surma Agro Admin')
@section('header', 'Categories')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <p class="text-forest-500 text-sm">Manage product categories</p>
        <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-forest-700 text-white text-sm font-semibold rounded-xl hover:bg-forest-600 transition-all">Add Category</a>
    </div>

    <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-warm-gray/50">
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Name</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Type</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Products</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Status</th>
                    <th class="text-right p-4 text-sm font-semibold text-forest-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                    <tr class="border-b border-warm-gray/50 hover:bg-warm-light transition-colors">
                        <td class="p-4">
                            <p class="font-semibold text-forest-800">{{ $category->name }}</p>
                            <p class="text-xs text-forest-500">{{ $category->slug }}</p>
                        </td>
                        <td class="p-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-forest-50 text-forest-700 capitalize">{{ $category->type }}</span></td>
                        <td class="p-4 text-sm text-forest-500">{{ $category->products_count ?? $category->products()->count() }}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $category->is_active ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="text-sm text-forest-600 hover:text-forest-800 mr-3">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:text-red-700" onclick="return confirm('Delete this category?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-forest-500">No categories yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
