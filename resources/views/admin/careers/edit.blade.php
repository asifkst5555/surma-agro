@extends('admin.layouts.admin')

@section('title', 'Edit Job - Surma Agro Admin')
@section('header', 'Edit Job')

@section('content')
    <div class="max-w-2xl bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
        <form action="{{ route('admin.careers.update', $career) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title', $career->title) }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Department *</label>
                    <input type="text" name="department" value="{{ old('department', $career->department) }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Location *</label>
                    <input type="text" name="location" value="{{ old('location', $career->location) }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Type *</label>
                    <select name="type" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                        <option value="full-time" {{ $career->type == 'full-time' ? 'selected' : '' }}>Full Time</option>
                        <option value="part-time" {{ $career->type == 'part-time' ? 'selected' : '' }}>Part Time</option>
                        <option value="contract" {{ $career->type == 'contract' ? 'selected' : '' }}>Contract</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Short Description</label>
                <textarea name="short_description" rows="2" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">{{ old('short_description', $career->short_description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Full Description</label>
                <textarea name="description" rows="6" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">{{ old('description', $career->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Requirements (one per line)</label>
                <textarea name="requirements" rows="4" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">{{ old('requirements', is_array($career->requirements) ? implode("\n", $career->requirements) : $career->requirements) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Benefits (one per line)</label>
                <textarea name="benefits" rows="4" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">{{ old('benefits', is_array($career->benefits) ? implode("\n", $career->benefits) : $career->benefits) }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Application Deadline</label>
                    <input type="date" name="deadline" value="{{ old('deadline', $career->deadline?->format('Y-m-d')) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
                <div class="flex items-end pb-3">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $career->is_active) ? 'checked' : '' }} class="rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                        <span class="text-sm text-forest-700">Active</span>
                    </label>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                <button type="submit" class="px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">Update Job</button>
                <a href="{{ route('admin.careers.index') }}" class="px-6 py-3 text-forest-600 hover:text-forest-800 transition-all">Cancel</a>
            </div>
        </form>
    </div>
@endsection
