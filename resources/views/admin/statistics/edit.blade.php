@extends('admin.layouts.admin')

@section('title', 'Edit Statistic - Admin')
@section('header', 'Edit Statistic')

@section('content')
    <div class="max-w-lg bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
        <form action="{{ route('admin.statistics.update', $statistic) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Label *</label>
                <input type="text" name="label" value="{{ old('label', $statistic->label) }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('label') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Value *</label>
                <input type="text" name="value" value="{{ old('value', $statistic->value) }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('value') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Suffix</label>
                <input type="text" name="suffix" value="{{ old('suffix', $statistic->suffix) }}" placeholder="+" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('suffix') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Icon</label>
                <input type="text" name="icon" value="{{ old('icon', $statistic->icon) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('icon') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Display Order</label>
                <input type="number" name="display_order" value="{{ old('display_order', $statistic->display_order) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                @error('display_order') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <label class="flex items-center space-x-2">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $statistic->is_active) ? 'checked' : '' }} class="rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                <span class="text-sm text-forest-700">Active</span>
            </label>
            <div class="flex items-center gap-4">
                <button type="submit" class="px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">Update Statistic</button>
                <a href="{{ route('admin.statistics.index') }}" class="px-6 py-3 bg-white text-forest-700 font-semibold rounded-xl border border-warm-gray/50 hover:bg-forest-50 transition-all">Cancel</a>
            </div>
        </form>
    </div>
@endsection
