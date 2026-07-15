<div class="relative pl-8 pb-12 border-l-2 border-forest-200 last:pb-0" data-gsap="fade-left">
    <div class="absolute -left-3 top-0 w-6 h-6 bg-forest-700 rounded-full border-4 border-cream flex items-center justify-center">
        <div class="w-2 h-2 bg-earth-400 rounded-full"></div>
    </div>
    <div class="bg-white rounded-2xl shadow-sm border border-warm-gray/50 p-6 hover:shadow-lg transition-all duration-300">
        <span class="inline-block px-3 py-1 bg-earth-50 text-earth-700 text-sm font-bold rounded-full mb-3">{{ $entry->year }}</span>
        <h3 class="text-lg font-bold text-forest-800 mb-2">{{ $entry->title }}</h3>
        @if($entry->description)
            <p class="text-forest-500 text-sm leading-relaxed">{{ $entry->description }}</p>
        @endif
    </div>
</div>
