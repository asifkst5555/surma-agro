@extends('admin.layouts.admin')

@section('title', 'Edit Blog - Surma Agro Admin')
@section('header', 'Edit Blog')

@section('content')
    <div class="max-w-2xl bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
        <form action="{{ route('admin.blogs.update', $blog) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Title *</label>
                <input type="text" name="title" value="{{ old('title', $blog->title) }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Excerpt</label>
                <textarea name="excerpt" rows="3" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">{{ old('excerpt', $blog->excerpt) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Content</label>
                <textarea name="content" rows="10" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">{{ old('content', $blog->content) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Image URL</label>
                <input type="url" name="image" value="{{ old('image', $blog->image) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="https://example.com/image.jpg">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Author *</label>
                    <input type="text" name="author" value="{{ old('author', $blog->author) }}" required class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Category</label>
                    <input type="text" name="category" value="{{ old('category', $blog->category) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-forest-700 mb-2">Tags (comma separated)</label>
                <input type="text" name="tags" value="{{ old('tags', $blog->tags ? implode(', ', $blog->tags) : '') }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="tag1, tag2, tag3">
            </div>
            <label class="flex items-center space-x-2">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $blog->is_published) ? 'checked' : '' }} class="rounded border-warm-gray text-forest-600 focus:ring-forest-500">
                <span class="text-sm text-forest-700">Published</span>
            </label>
            <div class="flex items-center space-x-3">
                <button type="submit" class="px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">Update Blog</button>
                <a href="{{ route('admin.blogs.index') }}" class="px-6 py-3 text-forest-600 hover:text-forest-800 transition-all">Cancel</a>
            </div>
        </form>
    </div>
@endsection
