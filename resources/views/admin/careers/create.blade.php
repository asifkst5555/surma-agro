@extends('admin.layouts.admin')

@section('title', 'Add Job - Surma Agro Admin')
@section('header', 'Add Job')

@section('content')
    <div class="max-w-2xl bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
        <form action="{{ route('admin.careers.store') }}" method="POST" class="space-y-5">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Title *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Department *</label>
                    <input type="text" name="department" value="{{ old('department') }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Location *</label>
                    <input type="text" name="location" value="{{ old('location') }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Type *</label>
                    <select name="type" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                        <option value="full-time">Full Time</option>
                        <option value="part-time">Part Time</option>
                        <option value="contract">Contract</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Short Description</label>
                <textarea name="short_description" rows="2" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">{{ old('short_description') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Full Description</label>
                <textarea name="description" rows="6" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Requirements (one per line)</label>
                <textarea name="requirements" rows="4" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="{{ old('requirements') }}"></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Benefits (one per line)</label>
                <textarea name="benefits" rows="4" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">{{ old('benefits') }}</textarea>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Application Deadline</label>
                    <input type="date" name="deadline" value="{{ old('deadline') }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
                <div class="flex items-end pb-3">
                    <label class="flex items-center space-x-2">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                        <span class="text-sm text-forest-700">Active</span>
                    </label>
                </div>
            </div>
            <button type="submit" class="px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">Create Job</button>
        </form>
    </div>
@endsection
