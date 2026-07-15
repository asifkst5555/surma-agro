@extends('admin.layouts.admin')

@section('title', 'Edit Office - Admin')
@section('header', 'Edit Office')

@section('content')
    <div class="max-w-lg bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
        <form action="{{ route('admin.offices.update', $office) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">City *</label>
                <input type="text" name="city" value="{{ old('city', $office->city) }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('city') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Country *</label>
                <input type="text" name="country" value="{{ old('country', $office->country) }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('country') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Address</label>
                <textarea name="address" rows="3" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none resize-none">{{ old('address', $office->address) }}</textarea>
                @error('address') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $office->phone) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email', $office->email) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <label class="flex items-center space-x-2">
                <input type="hidden" name="is_headquarters" value="0">
                <input type="checkbox" name="is_headquarters" value="1" {{ old('is_headquarters', $office->is_headquarters) ? 'checked' : '' }} class="rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                <span class="text-sm text-forest-700">Headquarters</span>
            </label>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $office->sort_order) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('sort_order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <label class="flex items-center space-x-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $office->is_active) ? 'checked' : '' }} class="rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                <span class="text-sm text-forest-700">Active</span>
            </label>
            <div class="flex items-center gap-4">
                <button type="submit" class="px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">Update Office</button>
                <a href="{{ route('admin.offices.index') }}" class="px-6 py-3 bg-white text-forest-700 font-semibold rounded-xl border border-warm-gray/50 hover:bg-forest-50 transition-all">Cancel</a>
            </div>
        </form>
    </div>
@endsection
