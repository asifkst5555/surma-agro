<nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-warm-gray/50 shadow-sm"
     x-data="{ open: false, megaOpen: null }"
     style="padding-top: env(safe-area-inset-top, 0px); padding-left: env(safe-area-inset-left, 0px); padding-right: env(safe-area-inset-right, 0px);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <img src="{{ asset('storage/logos/main_logo.webp') }}" alt="Surma Agro" class="h-12 w-auto">
            </a>

            <div class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('home') }}" class="px-4 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('home') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:text-earth-600 hover:bg-forest-50' }}">Home</a>
                <a href="{{ route('about') }}" class="px-4 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('about') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:text-earth-600 hover:bg-forest-50' }}">About</a>
                <a href="{{ route('catalog.index') }}" class="px-4 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('catalog*') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:text-earth-600 hover:bg-forest-50' }}">Products</a>

                {{-- Brands & Services Dropdown --}}
                @php $brandsActive = request()->routeIs('surma-fish') || request()->routeIs('change-box'); @endphp
                <div class="relative" @mouseenter="megaOpen = 'brands'" @mouseleave="megaOpen = null">
                    <button class="px-4 py-2 text-sm font-medium transition-colors rounded-lg flex items-center gap-1 whitespace-nowrap {{ $brandsActive ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:text-earth-600 hover:bg-forest-50' }}">
                        Brands & Services
                        <svg class="w-4 h-4 transition-transform" :class="megaOpen === 'brands' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="megaOpen === 'brands'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="absolute top-full left-0 pt-1">
                        <div class="w-52 bg-white rounded-xl shadow-xl border border-warm-gray/50 py-2">
                            <a href="{{ route('surma-fish') }}" class="block px-5 py-2.5 text-sm transition-colors whitespace-nowrap {{ request()->routeIs('surma-fish') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:text-earth-600 hover:bg-forest-50' }}">Surma Fish</a>
                            <a href="{{ route('change-box') }}" class="block px-5 py-2.5 text-sm transition-colors whitespace-nowrap {{ request()->routeIs('change-box') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:text-earth-600 hover:bg-forest-50' }}">Change Box</a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('team') }}" class="px-4 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('team') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:text-earth-600 hover:bg-forest-50' }}">Team</a>
                <a href="{{ route('gallery') }}" class="px-4 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('gallery') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:text-earth-600 hover:bg-forest-50' }}">Gallery</a>
                <a href="{{ route('blog.index') }}" class="px-4 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('blog*') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:text-earth-600 hover:bg-forest-50' }}">Blog</a>

                {{-- More Dropdown --}}
                @php $moreActive = request()->routeIs('presence') || request()->routeIs('certificates'); @endphp
                <div class="relative" @mouseenter="megaOpen = 'more'" @mouseleave="megaOpen = null">
                    <button class="px-4 py-2 text-sm font-medium transition-colors rounded-lg flex items-center gap-1 whitespace-nowrap {{ $moreActive ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:text-earth-600 hover:bg-forest-50' }}">
                        More
                        <svg class="w-4 h-4 transition-transform" :class="megaOpen === 'more' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="megaOpen === 'more'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" class="absolute top-full right-0 pt-1">
                        <div class="bg-white rounded-xl shadow-xl border border-warm-gray/50 py-2" style="min-width: 180px;">
                            <a href="{{ route('presence') }}" class="block px-5 py-2.5 text-sm transition-colors whitespace-nowrap {{ request()->routeIs('presence') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:text-earth-600 hover:bg-forest-50' }}">Global Presence</a>
                            <a href="{{ route('certificates') }}" class="block px-5 py-2.5 text-sm transition-colors whitespace-nowrap {{ request()->routeIs('certificates') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:text-earth-600 hover:bg-forest-50' }}">Certificates</a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('contact') }}" class="px-4 py-2 text-sm font-medium transition-colors rounded-lg {{ request()->routeIs('contact') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:text-earth-600 hover:bg-forest-50' }}">Contact</a>
            </div>

            <div class="flex items-center space-x-3">
<a href="{{ route('contact') }}" class="hidden sm:inline-flex items-center px-5 py-2.5 bg-forest-700 text-white text-sm font-semibold rounded-xl hover:bg-forest-600 transition-all shadow-lg shadow-forest-700/20 hover:shadow-forest-700/30">
                    Get a Quote
                </a>
                <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg hover:bg-warm-gray transition-colors" @click="open = !open">
                    <svg class="w-6 h-6 text-forest-700" :class="open ? 'hidden' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg class="w-6 h-6 text-forest-700" :class="open ? '' : 'hidden'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>

    <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-warm-gray/50"
         style="padding-left: env(safe-area-inset-left, 0px); padding-right: env(safe-area-inset-right, 0px); padding-bottom: env(safe-area-inset-bottom, 0px);">
        <div class="px-4 py-4 space-y-1">
            <a href="{{ route('home') }}" class="block px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('home') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:bg-forest-50' }}">Home</a>
            <a href="{{ route('about') }}" class="block px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('about') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:bg-forest-50' }}">About Us</a>
            <a href="{{ route('catalog.index') }}" class="block px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('catalog*') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:bg-forest-50' }}">Products</a>
            <a href="{{ route('team') }}" class="block px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('team') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:bg-forest-50' }}">Our Team</a>
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('surma-fish') || request()->routeIs('change-box') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:bg-forest-50' }}">
                    Brands & Services
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" class="pl-6 space-y-1 pb-2">
                    <a href="{{ route('surma-fish') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('surma-fish') ? 'text-earth-600 bg-forest-50' : 'text-forest-600 hover:bg-forest-50' }}">Surma Fish</a>
                    <a href="{{ route('change-box') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('change-box') ? 'text-earth-600 bg-forest-50' : 'text-forest-600 hover:bg-forest-50' }}">Change Box</a>
                </div>
            </div>
            <a href="{{ route('gallery') }}" class="block px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('gallery') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:bg-forest-50' }}">Gallery</a>
            <a href="{{ route('blog.index') }}" class="block px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('blog*') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:bg-forest-50' }}">Blog</a>
            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium rounded-xl {{ request()->routeIs('presence') || request()->routeIs('certificates') ? 'text-earth-600 bg-forest-50' : 'text-forest-700 hover:bg-forest-50' }}">
                    More
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" class="pl-6 space-y-1 pb-2">
                    <a href="{{ route('presence') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('presence') ? 'text-earth-600 bg-forest-50' : 'text-forest-600 hover:bg-forest-50' }}">Global Presence</a>
                    <a href="{{ route('certificates') }}" class="block px-4 py-2 text-sm rounded-lg {{ request()->routeIs('certificates') ? 'text-earth-600 bg-forest-50' : 'text-forest-600 hover:bg-forest-50' }}">Certificates</a>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="block px-4 py-3 text-sm font-medium rounded-xl mt-3 text-center {{ request()->routeIs('contact') ? 'bg-forest-600 text-white' : 'bg-forest-700 text-white hover:bg-forest-600' }}">Contact Us</a>
        </div>
    </div>
</nav>
