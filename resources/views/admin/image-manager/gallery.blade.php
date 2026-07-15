@extends('admin.layouts.admin')

@section('title', 'Image Gallery - Surma Agro Admin')
@section('header', 'Image Gallery')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <p class="text-forest-500 text-sm">{{ $images->total() }} images total</p>
        <a href="{{ route('admin.image-manager.index') }}" class="px-4 py-2 bg-forest-700 text-white text-sm font-semibold rounded-xl hover:bg-forest-600 transition-all">Back to Dashboard</a>
    </div>

    <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-6">
        @if($images->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                @foreach($images as $image)
                    <div class="relative group rounded-xl overflow-hidden border border-warm-gray/50 bg-cream">
                        <img src="{{ $image->thumb_url }}" alt="{{ $image->alt_text }}" class="w-full h-36 object-cover">
                        <div class="absolute inset-0 bg-forest-900/70 opacity-0 group-hover:opacity-100 transition-opacity flex flex-col items-center justify-center space-y-2 p-2">
                            @if($image->product)
                                <span class="text-white text-xs text-center truncate w-full">{{ $image->product->name }}</span>
                            @endif
                            <div class="flex space-x-2">
                                @if(!$image->is_primary && $image->product_id)
                                    <form action="{{ route('admin.image-manager.set-primary', $image) }}" method="POST">
                                        @csrf
                                        <button class="px-2 py-1 bg-earth-500 text-white text-xs rounded-lg hover:bg-earth-600">Set Primary</button>
                                    </form>
                                @endif
                                <form action="{{ route('admin.image-manager.destroy', $image) }}" method="POST" onsubmit="return confirm('Delete this image?')">
                                    @csrf @method('DELETE')
                                    <button class="px-2 py-1 bg-red-500 text-white text-xs rounded-lg hover:bg-red-600">Delete</button>
                                </form>
                            </div>
                        </div>
                        @if($image->is_primary)
                            <span class="absolute top-1 left-1 px-2 py-0.5 bg-earth-500 text-white text-[10px] font-semibold rounded">Primary</span>
                        @endif
                        <span class="absolute top-1 right-1 px-1.5 py-0.5 bg-black/50 text-white text-[10px] rounded">{{ $image->source }}</span>
                    </div>
                @endforeach
            </div>
            <div class="mt-6">{{ $images->links() }}</div>
        @else
            <div class="text-center py-16 text-forest-500">
                <svg class="w-16 h-16 mx-auto mb-4 text-forest-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <p>No images in gallery.</p>
            </div>
        @endif
    </div>
@endsection
