<div class="bg-white rounded-2xl shadow-sm border border-warm-gray/50 overflow-hidden group hover:shadow-lg transition-all duration-300" data-gsap="fade-up">
    @if($certificate->image)
        <div class="aspect-[4/3] overflow-hidden bg-forest-50">
            <img src="{{ $certificate->image }}" alt="{{ $certificate->name }}" class="w-full h-full object-contain p-6 group-hover:scale-105 transition-transform duration-500">
        </div>
    @endif
    <div class="p-5 text-center">
        <h3 class="text-base font-bold text-forest-800 mb-1">{{ $certificate->name }}</h3>
        <p class="text-sm text-forest-500">{{ $certificate->issuing_body }}</p>
    </div>
</div>
