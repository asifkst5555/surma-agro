<div class="bg-white rounded-2xl shadow-sm border border-warm-gray/50 p-8 hover:shadow-lg transition-all duration-300" data-gsap="fade-up">
    @php
        $rating = $rating ?? 5;
        $image = $image ?? null;
        $designation = $designation ?? null;
    @endphp
    <div class="flex items-start space-x-1 mb-4">
        @for($i = 1; $i <= 5; $i++)
            <svg class="w-5 h-5 {{ $i <= $rating ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
        @endfor
    </div>
    <p class="text-forest-600 text-sm leading-relaxed mb-6 italic">"{{ $content ?? '' }}"</p>
    <div class="flex items-center space-x-4">
        @if($image)
            <img src="{{ $image }}" alt="{{ $name ?? '' }}" class="w-12 h-12 rounded-full object-cover">
        @else
            <div class="w-12 h-12 rounded-full bg-forest-100 flex items-center justify-center">
                <span class="text-forest-500 font-bold">{{ substr($name ?? '?', 0, 1) }}</span>
            </div>
        @endif
        <div>
            <h4 class="text-sm font-bold text-forest-800">{{ $name ?? '' }}</h4>
            <p class="text-xs text-forest-500">{{ $company ?? '' }}@if($designation) &middot; {{ $designation }}@endif</p>
        </div>
    </div>
</div>
