@extends('admin.layouts.admin')

@section('title', 'Applications - Surma Agro Admin')
@section('header', 'Applications for ' . $career->title)

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.careers.index') }}" class="text-sm text-forest-600 hover:text-forest-800">&larr; Back to Jobs</a>
    </div>

    <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-warm-gray/50">
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Name</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Email</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Phone</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Date</th>
                    <th class="text-right p-4 text-sm font-semibold text-forest-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($applications as $application)
                    <tr class="border-b border-warm-gray/50 hover:bg-warm-light transition-colors">
                        <td class="p-4 font-semibold text-forest-800">{{ $application->name }}</td>
                        <td class="p-4 text-sm text-forest-500">{{ $application->email }}</td>
                        <td class="p-4 text-sm text-forest-500">{{ $application->phone ?? '—' }}</td>
                        <td class="p-4 text-sm text-forest-500">{{ $application->created_at->format('M d, Y') }}</td>
                        <td class="p-4 text-right">
                            <a href="#" class="text-sm text-forest-600 hover:text-forest-800">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-forest-500">No applications yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
