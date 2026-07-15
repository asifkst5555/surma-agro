<div class="bg-white rounded-2xl shadow-sm border border-warm-gray/50 overflow-hidden group hover:shadow-lg transition-all duration-300" data-gsap="fade-up">
    @if($member->image)
        <div class="aspect-square overflow-hidden bg-forest-50">
            <img src="{{ $member->image }}" alt="{{ $member->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        </div>
    @else
        <div class="aspect-square bg-gradient-to-br from-forest-100 to-forest-50 flex items-center justify-center">
            <span class="text-forest-300 text-5xl font-bold">{{ substr($member->name, 0, 1) }}{{ substr($member->name, strpos($member->name, ' ') + 1, 1) }}</span>
        </div>
    @endif
    <div class="p-5 text-center">
        <h3 class="text-lg font-bold text-forest-800">{{ $member->name }}</h3>
        <p class="text-earth-600 text-sm font-medium">{{ $member->designation }}</p>
        @if($member->company)
            <p class="text-forest-400 text-xs font-medium mb-3">{{ $member->company }}</p>
        @else
            <div class="mb-3"></div>
        @endif
        @if($member->bio)
            <p class="text-forest-500 text-sm leading-relaxed">{{ Str::limit($member->bio, 100) }}</p>
        @endif
        @if($member->linkedin || $member->email)
            <div class="flex justify-center space-x-3 mt-4 pt-4 border-t border-warm-gray/50">
                @if($member->linkedin)
                    <a href="{{ $member->linkedin }}" class="text-forest-400 hover:text-forest-600 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                @endif
                @if($member->email)
                    <a href="mailto:{{ $member->email }}" class="text-forest-400 hover:text-forest-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
