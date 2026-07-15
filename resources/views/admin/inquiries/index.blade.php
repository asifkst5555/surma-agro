@extends('admin.layouts.admin')

@section('title', 'Inquiries - Surma Agro Admin')
@section('header', 'Inquiries')

@section('content')
    <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-warm-gray/50">
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Name</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Email</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Type</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Date</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Status</th>
                    <th class="text-right p-4 text-sm font-semibold text-forest-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inquiries as $inquiry)
                    <tr class="border-b border-warm-gray/50 hover:bg-warm-light transition-colors {{ !$inquiry->is_read ? 'bg-forest-50/50' : '' }}">
                        <td class="p-4">
                            <p class="font-semibold text-forest-800">{{ $inquiry->name }}</p>
                            @if($inquiry->company)<p class="text-xs text-forest-500">{{ $inquiry->company }}</p>@endif
                        </td>
                        <td class="p-4 text-sm text-forest-500">{{ $inquiry->email }}</td>
                        <td class="p-4"><span class="px-3 py-1 text-xs font-semibold rounded-full bg-forest-50 text-forest-700 capitalize">{{ $inquiry->type }}</span></td>
                        <td class="p-4 text-sm text-forest-500">{{ $inquiry->created_at->format('M d, Y') }}</td>
                        <td class="p-4">
                            @if(!$inquiry->is_read)
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-50 text-yellow-700">New</span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-50 text-green-700">Read</span>
                            @endif
                        </td>
                        <td class="p-4 text-right space-x-2">
                            <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-sm text-forest-600 hover:text-forest-800">View</a>
                            @if(!$inquiry->is_read)
                                <form action="{{ route('admin.inquiries.mark-read', $inquiry) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="text-sm text-forest-600 hover:text-forest-800">Mark Read</button>
                                </form>
                            @endif
                            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:text-red-700" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-forest-500">No inquiries yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $inquiries->links() }}</div>
@endsection
