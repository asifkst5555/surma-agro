<div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-forest-700 to-forest-900 p-8 lg:p-12" data-gsap="fade-up">
    <div class="absolute top-0 right-0 w-64 h-64 bg-earth-500/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-earth-500/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    <div class="relative z-10 max-w-3xl mx-auto text-center">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">{{ $title }}</h2>
        <p class="text-forest-200 text-lg mb-8">{{ $description }}</p>
        <a href="{{ $buttonLink }}" class="inline-flex items-center px-8 py-3.5 bg-earth-600 text-white font-semibold rounded-xl hover:bg-earth-500 transition-all shadow-lg shadow-earth-600/30 hover:shadow-earth-600/40">
            {{ $buttonText }}
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
</div>
