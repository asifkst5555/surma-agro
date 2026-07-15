@extends('admin.layouts.admin')

@section('title', 'Download History - Surma Agro Admin')
@section('header', 'Download History')

@section('content')
    <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-warm-gray/50">
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Query</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Source</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Results</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Downloaded</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($searches as $search)
                    <tr class="border-b border-warm-gray/50 hover:bg-warm-light transition-colors">
                        <td class="p-4 font-semibold text-forest-800">{{ $search->query }}</td>
                        <td class="p-4 text-sm text-forest-500">{{ $search->source }}</td>
                        <td class="p-4 text-sm text-forest-500">{{ $search->results_count }}</td>
                        <td class="p-4 text-sm text-forest-500">{{ $search->downloaded_count }}</td>
                        <td class="p-4 text-sm text-forest-500">{{ $search->created_at->format('M d, Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-forest-500">No search history yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $searches->links() }}</div>
@endsection
