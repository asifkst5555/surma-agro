@extends('admin.layouts.admin')

@section('title', 'Gallery - Surma Agro Admin')
@section('header', 'Gallery')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <p class="text-forest-500 text-sm">Manage gallery items</p>
        <a href="{{ route('admin.gallery.create') }}" class="px-4 py-2 bg-forest-700 text-white text-sm font-semibold rounded-xl hover:bg-forest-600 transition-all">Add Item</a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($items as $item)
            <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm overflow-hidden">
                @if($item->image)
                    <img src="{{ $item->image }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-forest-100 to-forest-200 flex items-center justify-center">
                        <svg class="w-12 h-12 text-forest-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                @endif
                <div class="p-4">
                    <div class="flex items-start justify-between mb-2">
                        <h3 class="font-semibold text-forest-800">{{ $item->title }}</h3>
                        <span class="px-2 py-0.5 text-xs font-semibold rounded-full bg-forest-50 text-forest-700 capitalize">{{ $item->type }}</span>
                    </div>
                    <p class="text-xs text-forest-500 mb-3">{{ $item->category }}</p>
                    <div class="flex items-center justify-between">
                        <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $item->is_active ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                            {{ $item->is_active ? 'Active' : 'Inactive' }}
                        </span>
                        <div class="space-x-2">
                            <a href="{{ route('admin.gallery.edit', $item) }}" class="text-sm text-forest-600 hover:text-forest-800">Edit</a>
                            <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:text-red-700" onclick="return confirm('Delete this item?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8 text-center text-forest-500">
                No gallery items yet. <a href="{{ route('admin.gallery.create') }}" class="text-forest-700 underline">Add one</a>.
            </div>
        @endforelse
    </div>
@endsection
