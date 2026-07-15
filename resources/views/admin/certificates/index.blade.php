@extends('admin.layouts.admin')

@section('title', 'Certificates - Surma Agro Admin')
@section('header', 'Certificates')

@section('content')
    <div class="mb-6 flex justify-between items-center">
        <p class="text-forest-500 text-sm">Manage certificates</p>
        <a href="{{ route('admin.certificates.create') }}" class="px-4 py-2 bg-forest-700 text-white text-sm font-semibold rounded-xl hover:bg-forest-600 transition-all">+ Create New</a>
    </div>

    <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="border-b border-warm-gray/50">
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Name</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Issuer</th>
                    <th class="text-left p-4 text-sm font-semibold text-forest-700">Status</th>
                    <th class="text-right p-4 text-sm font-semibold text-forest-700">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($certificates as $certificate)
                    <tr class="border-b border-warm-gray/50 hover:bg-warm-light transition-colors">
                        <td class="p-4">
                            <p class="font-semibold text-forest-800">{{ $certificate->name }}</p>
                        </td>
                        <td class="p-4 text-sm text-forest-500">{{ $certificate->issuer ?? '—' }}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $certificate->is_active ? 'bg-green-50 text-green-700' : 'bg-yellow-50 text-yellow-700' }}">
                                {{ $certificate->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="p-4 text-right">
                            <a href="{{ route('admin.certificates.edit', $certificate) }}" class="text-sm text-forest-600 hover:text-forest-800 mr-3">Edit</a>
                            <form action="{{ route('admin.certificates.destroy', $certificate) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-sm text-red-500 hover:text-red-700" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-forest-500">No certificates found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-6">{{ $certificates->links() }}</div>
@endsection
