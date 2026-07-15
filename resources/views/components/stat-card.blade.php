<div class="bg-white rounded-2xl shadow-sm border border-warm-gray/50 p-6 hover:shadow-md transition-all duration-300 flex flex-col items-center text-center" data-gsap="fade-up">
    @if($icon)
        <div class="w-16 h-16 bg-forest-50 rounded-2xl flex items-center justify-center mb-4">
            <img src="{{ $icon }}" alt="{{ $label }}" class="w-8 h-8">
        </div>
    @endif
    <div class="text-4xl font-bold text-forest-700 mb-1" data-gsap="counter" data-target="{{ $value }}" data-suffix="{{ $suffix }}">{{ $value }}{{ $suffix }}</div>
    <div class="text-forest-500 text-sm font-medium">{{ $label }}</div>
</div>
