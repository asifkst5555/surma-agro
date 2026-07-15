<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - Surma Agro')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-warm-light">
    <div class="min-h-screen flex" x-data="{ sidebarOpen: false }">
        {{-- Mobile Sidebar Overlay --}}
        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-40 lg:hidden"></div>

        {{-- Sidebar --}}
        <aside class="fixed top-0 left-0 bottom-0 w-64 bg-forest-900 text-white z-50 overflow-y-auto transition-transform duration-200"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
               style="transform: translateX(0); height: 100vh;"
               @click.away="sidebarOpen = false">
            <div class="p-6 border-b border-forest-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-forest-700 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">SA</span>
                    </div>
                    <div>
                        <p class="font-bold text-sm">Surma Agro</p>
                        <p class="text-xs text-forest-400">Admin Panel</p>
                    </div>
                </a>
            </div>
            <nav class="p-4 space-y-1">
                {{-- Dashboard --}}
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl {{ request()->routeIs('admin.dashboard') ? 'bg-forest-700 text-white' : 'hover:bg-forest-800 text-forest-200' }} transition-colors text-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    <span>Dashboard</span>
                </a>

                {{-- Catalog --}}
                <div x-data="{ open: {{ request()->routeIs('admin.products.*') || request()->routeIs('admin.categories.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-forest-800 transition-colors text-sm text-forest-200">
                        <span class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            <span>Catalog</span>
                        </span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" class="pl-8 space-y-1 mt-1">
                        <a href="{{ route('admin.products.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.products.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Products</a>
                        <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.categories.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Categories</a>
                    </div>
                </div>

                {{-- Content --}}
                <div x-data="{ open: {{ request()->routeIs('admin.blogs.*') || request()->routeIs('admin.gallery.*') || request()->routeIs('admin.banners.*') || request()->routeIs('admin.timeline.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-forest-800 transition-colors text-sm text-forest-200">
                        <span class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                            <span>Content</span>
                        </span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" class="pl-8 space-y-1 mt-1">
                        <a href="{{ route('admin.blogs.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.blogs.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Blogs</a>
                        <a href="{{ route('admin.gallery.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.gallery.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Gallery</a>
                        <a href="{{ route('admin.banners.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.banners.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Banners</a>
                        <a href="{{ route('admin.timeline.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.timeline.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Timeline</a>
                    </div>
                </div>

                {{-- People --}}
                <div x-data="{ open: {{ request()->routeIs('admin.team.*') || request()->routeIs('admin.testimonials.*') || request()->routeIs('admin.careers.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-forest-800 transition-colors text-sm text-forest-200">
                        <span class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>People</span>
                        </span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" class="pl-8 space-y-1 mt-1">
                        <a href="{{ route('admin.team.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.team.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Team Members</a>
                        <a href="{{ route('admin.testimonials.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.testimonials.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Testimonials</a>
                        <a href="{{ route('admin.careers.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.careers.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Careers</a>
                    </div>
                </div>

                {{-- Business --}}
                <div x-data="{ open: {{ request()->routeIs('admin.inquiries.*') || request()->routeIs('admin.newsletters.*') || request()->routeIs('admin.offices.*') || request()->routeIs('admin.certificates.*') || request()->routeIs('admin.statistics.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-forest-800 transition-colors text-sm text-forest-200">
                        <span class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span>Business</span>
                        </span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" class="pl-8 space-y-1 mt-1">
                        <a href="{{ route('admin.inquiries.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.inquiries.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Inquiries</a>
                        <a href="{{ route('admin.newsletters.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.newsletters.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Newsletters</a>
                        <a href="{{ route('admin.offices.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.offices.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Offices</a>
                        <a href="{{ route('admin.certificates.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.certificates.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Certificates</a>
                        <a href="{{ route('admin.statistics.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.statistics.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Statistics</a>
                    </div>
                </div>

                {{-- System --}}
                <div x-data="{ open: {{ request()->routeIs('admin.image-manager.*') || request()->routeIs('admin.settings.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-forest-800 transition-colors text-sm text-forest-200">
                        <span class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <span>System</span>
                        </span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" class="pl-8 space-y-1 mt-1">
                        <a href="{{ route('admin.image-manager.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.image-manager.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Image Manager</a>
                        <a href="{{ route('admin.settings.index') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.settings.*') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Settings</a>
                    </div>
                </div>

                {{-- AI Assistant --}}
                <div x-data="{ open: {{ request()->routeIs('admin.ai-settings.*') ? 'true' : 'false' }} }">
                    <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 rounded-xl hover:bg-forest-800 transition-colors text-sm text-forest-200">
                        <span class="flex items-center space-x-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5"/></svg>
                            <span>AI Assistant</span>
                        </span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" class="pl-8 space-y-1 mt-1">
                        <a href="{{ route('admin.ai-settings.api-connection') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.ai-settings.api-connection') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">API Connection</a>
                        <a href="{{ route('admin.ai-settings.chat-appearance') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.ai-settings.chat-appearance') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Chat Appearance</a>
                        <a href="{{ route('admin.ai-settings.response-behavior') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.ai-settings.response-behavior') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Response Behavior</a>
                        <a href="{{ route('admin.ai-settings.content-rules') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.ai-settings.content-rules') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Content Rules</a>
                        <a href="{{ route('admin.ai-settings.custom-prompts') }}" class="block px-4 py-2 rounded-lg text-sm {{ request()->routeIs('admin.ai-settings.custom-prompts') ? 'text-earth-300 bg-forest-800' : 'text-forest-300 hover:text-white hover:bg-forest-800' }}">Custom Prompts</a>
                    </div>
                </div>

                {{-- Footer Links --}}
                <div class="pt-4 mt-4 border-t border-forest-800">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-forest-800 transition-colors text-sm text-forest-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span>Back to Site</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="mt-1">
                        @csrf
                        <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-xl hover:bg-red-900/30 transition-colors text-sm text-red-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </nav>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col" style="margin-left: 16rem;">
            <header class="bg-white border-b border-warm-gray/50 px-6 py-4 sticky top-0 z-30">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg hover:bg-forest-50">
                            <svg class="w-6 h-6 text-forest-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <h1 class="text-xl font-bold text-forest-800">@yield('header', 'Dashboard')</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <span class="text-sm text-forest-500">{{ auth()->user()->name ?? 'Admin' }}</span>
                    </div>
                </div>
            </header>
            <main class="flex-1 p-6">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">{{ session('error') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
