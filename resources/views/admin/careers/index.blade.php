@extends('admin.layouts.admin')

@section('title', 'Careers - Surma Agro Admin')
@section('header', 'Careers')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <p class="text-forest-500 text-sm">Manage job listings</p>
        <a href="{{ route('admin.careers.create') }}" class="px-4 py-2 bg-forest-700 text-white text-sm font-semibold rounded-xl hover:bg-forest-600 transition-all">Add Job</a>
    </div>

    <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-warm-gray/50">
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Title</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Department</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Location</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Type</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Status</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Applications</th>
                    <th class="text-right p-4 text-sm font-semibold text-forest-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($careers as $career)
                    <tr class="border-b border-warm-gray/50 hover:bg-warm-light transition-colors">
                        <td class="p-4">
                            <p class="font-semibold text-forest-800">{{ $career->title }}</p>
                            <p class="text-xs text-forest-500">{{ $career->slug }}</p>
                        </td>
                        <td class="p-4 text-sm text-forest-500">{{ $career->department }}</td>
                        <td class="p-4 text-sm text-forest-500">{{ $career->location }}</td>
                        <td class="p-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-forest-50 text-forest-700 capitalize">{{ $career->type }}</span></td>
                        <td class="p-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $career->is_active ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                                {{ $career->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="p-4 text-sm text-forest-500">{{ $career->applications()->count() }}</td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('admin.careers.applications', $career) }}" class="text-sm text-forest-600 hover:text-forest-800">View Applications</a>
                            <a href="{{ route('admin.careers.edit', $career) }}" class="text-sm text-forest-600 hover:text-forest-800">Edit</a>
                            <form action="{{ route('admin.careers.destroy', $career) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:text-red-700" onclick="return confirm('Delete this job listing?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-forest-500">No job listings yet. <a href="{{ route('admin.careers.create') }}" class="text-forest-700 underline">Add one</a>.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $careers->links() }}</div>
@endsection
