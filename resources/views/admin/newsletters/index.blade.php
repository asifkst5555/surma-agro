@extends('admin.layouts.admin')

@section('title', 'Newsletter Subscribers - Surma Agro Admin')
@section('header', 'Newsletter Subscribers')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <p class="text-forest-500 text-sm">Manage newsletter subscribers</p>
        <a href="{{ route('admin.newsletters.export') }}" class="px-4 py-2 bg-forest-700 text-white text-sm font-semibold rounded-xl hover:bg-forest-600 transition-all">Export CSV</a>
    </div>

    <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-warm-gray/50">
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Email</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Subscribed At</th>
                    <th class="text-right p-4 text-sm font-semibold text-forest-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($subscribers as $subscriber)
                    <tr class="border-b border-warm-gray/50 hover:bg-warm-light transition-colors">
                        <td class="p-4">
                            <p class="font-semibold text-forest-800">{{ $subscriber->email }}</p>
                        </td>
                        <td class="p-4 text-sm text-forest-500">{{ $subscriber->created_at->format('M d, Y H:i') }}</td>
                        <td class="p-4 text-right">
                            <form action="{{ route('admin.newsletters.destroy', $subscriber) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:text-red-700" onclick="return confirm('Remove this subscriber?')">Remove</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-8 text-center text-forest-500">No subscribers found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $subscribers->links() }}</div>
@endsection
