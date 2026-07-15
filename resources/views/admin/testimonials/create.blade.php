@extends('admin.layouts.admin')

@section('title', 'Create Testimonial - Admin')
@section('header', 'Create Testimonial')

@section('content')
    <div class="max-w-lg bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Author Name *</label>
                <input type="text" name="author_name" value="{{ old('author_name') }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('author_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Company</label>
                <input type="text" name="company" value="{{ old('company') }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('company') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Quote *</label>
                <textarea name="quote" rows="3" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none resize-none">{{ old('quote') }}</textarea>
                @error('quote') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Rating</label>
                <select name="rating" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                    <option value="">Select Rating</option>
                    <option value="1" {{ old('rating') == '1' ? 'selected' : '' }}>1</option>
                    <option value="2" {{ old('rating') == '2' ? 'selected' : '' }}>2</option>
                    <option value="3" {{ old('rating') == '3' ? 'selected' : '' }}>3</option>
                    <option value="4" {{ old('rating') == '4' ? 'selected' : '' }}>4</option>
                    <option value="5" {{ old('rating') == '5' ? 'selected' : '' }}>5</option>
                </select>
                @error('rating') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Display Order</label>
                <input type="number" name="display_order" value="{{ old('display_order') }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('display_order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <label class="flex items-center space-x-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                <span class="text-sm text-forest-700">Active</span>
            </label>
            <div class="flex items-center gap-4">
                <button type="submit" class="px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">Create Testimonial</button>
                <a href="{{ route('admin.testimonials.index') }}" class="px-6 py-3 bg-white text-forest-700 font-semibold rounded-xl border border-warm-gray/50 hover:bg-forest-50 transition-all">Cancel</a>
            </div>
        </form>
    </div>
@endsection
