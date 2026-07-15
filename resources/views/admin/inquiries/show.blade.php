@extends('admin.layouts.admin')

@section('title', 'Inquiry Details - Surma Agro Admin')
@section('header', 'Inquiry Details')

@section('content')
    <div class="max-w-3xl bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
        <div class="grid grid-cols-2 gap-6 mb-8">
            <div>
                <p class="text-xs text-forest-500 uppercase tracking-wider mb-1">Name</p>
                <p class="text-forest-800 font-semibold">{{ $inquiry->name }}</p>
            </div>
            <div>
                <p class="text-xs text-forest-500 uppercase tracking-wider mb-1">Email</p>
                <p class="text-forest-800 font-semibold">{{ $inquiry->email }}</p>
            </div>
            @if($inquiry->phone)
            <div>
                <p class="text-xs text-forest-500 uppercase tracking-wider mb-1">Phone</p>
                <p class="text-forest-800">{{ $inquiry->phone }}</p>
            </div>
            @endif
            @if($inquiry->company)
            <div>
                <p class="text-xs text-forest-500 uppercase tracking-wider mb-1">Company</p>
                <p class="text-forest-800">{{ $inquiry->company }}</p>
            </div>
            @endif
            @if($inquiry->country)
            <div>
                <p class="text-xs text-forest-500 uppercase tracking-wider mb-1">Country</p>
                <p class="text-forest-800">{{ $inquiry->country }}</p>
            </div>
            @endif
            <div>
                <p class="text-xs text-forest-500 uppercase tracking-wider mb-1">Type</p>
                <p class="text-forest-800 capitalize">{{ $inquiry->type }}</p>
            </div>
            <div>
                <p class="text-xs text-forest-500 uppercase tracking-wider mb-1">Date</p>
                <p class="text-forest-800">{{ $inquiry->created_at->format('F d, Y h:i A') }}</p>
            </div>
            <div>
                <p class="text-xs text-forest-500 uppercase tracking-wider mb-1">Status</p>
                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $inquiry->is_read ? 'bg-green-50 text-green-700' : 'bg-yellow-50 text-yellow-700' }}">
                    {{ $inquiry->is_read ? 'Read' : 'New' }}
                </span>
            </div>
        </div>
        <div>
            <p class="text-xs text-forest-500 uppercase tracking-wider mb-2">Message</p>
            <div class="p-4 bg-cream rounded-xl text-forest-700 leading-relaxed">{{ $inquiry->message }}</div>
        </div>
        <div class="mt-8 flex space-x-3">
            @if(!$inquiry->is_read)
                <form action="{{ route('admin.inquiries.mark-read', $inquiry) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="submit" class="px-4 py-2 bg-forest-700 text-white text-sm font-semibold rounded-xl hover:bg-forest-600">Mark as Read</button>
                </form>
            @endif
            <a href="mailto:{{ $inquiry->email }}" class="px-4 py-2 bg-earth-600 text-white text-sm font-semibold rounded-xl hover:bg-earth-500">Reply via Email</a>
            <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" class="inline">
                @csrf @method('DELETE')
                <button type="submit" class="px-4 py-2 bg-red-500 text-white text-sm font-semibold rounded-xl hover:bg-red-600" onclick="return confirm('Delete this inquiry?')">Delete</button>
            </form>
        </div>
    </div>
@endsection
