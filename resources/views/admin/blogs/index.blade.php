@extends('admin.layouts.admin')

@section('title', 'Blogs - Surma Agro Admin')
@section('header', 'Blogs')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <p class="text-forest-500 text-sm">Manage your blog posts</p>
        <a href="{{ route('admin.blogs.create') }}" class="px-4 py-2 bg-forest-700 text-white text-sm font-semibold rounded-xl hover:bg-forest-600 transition-all">Add Blog</a>
    </div>

    <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-warm-gray/50">
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Title</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Category</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Author</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Status</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Date</th>
                    <th class="text-right p-4 text-sm font-semibold text-forest-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($blogs as $blog)
                    <tr class="border-b border-warm-gray/50 hover:bg-warm-light transition-colors">
                        <td class="p-4">
                            <p class="font-semibold text-forest-800">{{ $blog->title }}</p>
                            <p class="text-xs text-forest-500">{{ $blog->slug }}</p>
                        </td>
                        <td class="p-4 text-sm text-forest-500">{{ $blog->category ?? 'Uncategorized' }}</td>
                        <td class="p-4 text-sm text-forest-500">{{ $blog->author }}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $blog->is_published ? 'bg-green-50 text-green-700' : 'bg-yellow-50 text-yellow-700' }}">
                                {{ $blog->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="p-4 text-sm text-forest-500">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : '—' }}</td>
                        <td class="p-4 text-right">
                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="text-sm text-forest-600 hover:text-forest-800 mr-3">Edit</a>
                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:text-red-700" onclick="return confirm('Delete this blog post?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-forest-500">No blog posts yet. <a href="{{ route('admin.blogs.create') }}" class="text-forest-700 underline">Write one</a>.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $blogs->links() }}</div>
@endsection
