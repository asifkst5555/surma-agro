@extends('admin.layouts.admin')

@section('title', 'Dashboard - Surma Agro Admin')
@section('header', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-forest-500">Total Products</h3>
                <div class="w-10 h-10 bg-forest-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-forest-800">{{ \App\Models\Product::count() }}</p>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-forest-500">Categories</h3>
                <div class="w-10 h-10 bg-forest-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-forest-800">{{ \App\Models\Category::count() }}</p>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-forest-500">Inquiries</h3>
                <div class="w-10 h-10 bg-forest-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-forest-800">{{ \App\Models\Inquiry::count() }}</p>
        </div>

        <div class="bg-white rounded-2xl p-6 border border-warm-gray/50 shadow-sm">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-forest-500">Unread</h3>
                <div class="w-10 h-10 bg-red-50 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                </div>
            </div>
            <p class="text-3xl font-bold text-forest-800">{{ \App\Models\Inquiry::where('is_read', false)->count() }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
        <h2 class="text-lg font-bold text-forest-800 mb-4">Welcome to Surma Agro Admin</h2>
        <p class="text-forest-500">Manage your products, categories, inquiries, and more from this dashboard.</p>
    </div>
@endsection
