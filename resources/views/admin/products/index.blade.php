@extends('admin.layouts.admin')

@section('title', 'Products - Surma Agro Admin')
@section('header', 'Products')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <p class="text-forest-500 text-sm">Manage your product catalog</p>
        <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-forest-700 text-white text-sm font-semibold rounded-xl hover:bg-forest-600 transition-all">Add Product</a>
    </div>

    <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-warm-gray/50">
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Name</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Category</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Status</th>
                    <th class="text-right p-4 text-sm font-semibold text-forest-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr class="border-b border-warm-gray/50 hover:bg-warm-light transition-colors">
                        <td class="p-4">
                            <p class="font-semibold text-forest-800">{{ $product->name }}</p>
                            <p class="text-xs text-forest-500">{{ $product->slug }}</p>
                        </td>
                        <td class="p-4 text-sm text-forest-500">{{ $product->category?->name ?? 'Uncategorized' }}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $product->is_active ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('admin.image-manager.index') }}?product_id={{ $product->id }}" class="text-sm text-earth-600 hover:text-earth-800">Images</a>
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-sm text-forest-600 hover:text-forest-800">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:text-red-700" onclick="return confirm('Delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-forest-500">No products yet. <a href="{{ route('admin.products.create') }}" class="text-forest-700 underline">Add one</a>.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">
        {{ $products->links() }}
    </div>
@endsection
