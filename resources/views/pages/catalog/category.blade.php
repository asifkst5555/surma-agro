@extends('layouts.app')

@section('title', $category->name . ' - Surma Agro')
@section('meta_description', $category->description ?? 'Browse ' . $category->name . ' from Surma Agro for premium B2B export.')

@section('content')
    <section class="relative pt-32 pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-earth-500 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-6 border border-white/10">{{ $category->type ?? 'Category' }}</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">{{ $category->name }}</h1>
            @if($category->description)
                <p class="text-lg lg:text-xl text-forest-200 max-w-3xl mx-auto leading-relaxed">{{ $category->description }}</p>
            @endif
            <p class="text-forest-300 mt-4">{{ $totalProducts }} products available</p>
        </div>
    </section>

    <section id="category-nav" class="py-4 bg-cream border-b border-warm-gray/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap gap-3 justify-center">
                <a href="{{ route('catalog.index') }}" class="whitespace-nowrap px-5 py-2.5 bg-white text-forest-700 text-sm font-semibold rounded-xl border border-warm-gray/50 hover:bg-forest-700 hover:text-earth-300 transition-all">All Products</a>
                @foreach($categories as $cat)
                    <a href="{{ route('catalog.category', $cat->slug) }}" class="whitespace-nowrap px-5 py-2.5 {{ $cat->id === $category->id ? 'bg-forest-700 text-earth-300 border-forest-700' : 'bg-white text-forest-700 border-warm-gray/50' }} text-sm font-semibold rounded-xl border hover:bg-forest-700 hover:text-earth-300 transition-all">{{ $cat->name }}</a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-12 bg-cream">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($products->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="product-grid">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                @if($totalProducts > 12)
                    <div class="text-center mt-10" id="load-more-container">
                        <button
                            class="load-more-btn inline-flex items-center px-8 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all shadow-lg shadow-forest-700/20"
                            data-category="{{ $category->slug }}"
                            data-offset="12"
                            data-total="{{ $totalProducts }}">
                            <span class="btn-text">Load More Products</span>
                            <span class="btn-loading hidden">
                                <svg class="animate-spin w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </span>
                            <svg class="w-4 h-4 ml-2 btn-arrow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                        </button>
                        <p class="text-sm text-forest-400 mt-2">
                            Showing <span id="loaded-count">{{ min(12, $totalProducts) }}</span> of {{ $totalProducts }}
                        </p>
                    </div>
                @endif
            @else
                <div class="text-center py-16">
                    <p class="text-forest-500 text-lg">Products in this category are being updated. Please check back soon or contact us for specific inquiries.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center mt-6 px-6 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all">
                        Contact Us
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sticky category nav on scroll
    var nav = document.getElementById('category-nav');
    if (nav) {
        var navTop = nav.offsetTop;
        var navHeight = nav.offsetHeight;
        var placeholder = document.createElement('div');
        placeholder.style.height = navHeight + 'px';
        placeholder.style.display = 'none';
        nav.parentNode.insertBefore(placeholder, nav.nextSibling);

        function handleScroll() {
            if (window.pageYOffset > navTop - 80) {
                nav.style.position = 'fixed';
                nav.style.top = '80px';
                nav.style.left = '0';
                nav.style.right = '0';
                nav.style.zIndex = '40';
                nav.style.boxShadow = '0 4px 6px -1px rgba(0,0,0,0.1)';
                placeholder.style.display = 'block';
            } else {
                nav.style.position = '';
                nav.style.top = '';
                nav.style.left = '';
                nav.style.right = '';
                nav.style.zIndex = '';
                nav.style.boxShadow = '';
                placeholder.style.display = 'none';
            }
        }

        window.addEventListener('scroll', handleScroll, { passive: true });
        handleScroll();
    }

    // Load more functionality
    const btn = document.querySelector('.load-more-btn');
    if (!btn) return;

    // Intersection Observer for auto-loading on scroll
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting && !btn.disabled) {
                loadMore();
            }
        });
    }, { rootMargin: '300px', threshold: 0 });

    const container = document.getElementById('load-more-container');
    if (container) observer.observe(container);

    btn.addEventListener('click', loadMore);

    function loadMore() {
        if (btn.disabled) return;

        const category = btn.dataset.category;
        const offset = parseInt(btn.dataset.offset);
        const total = parseInt(btn.dataset.total);

        btn.disabled = true;
        btn.querySelector('.btn-text').textContent = 'Loading...';
        btn.querySelector('.btn-loading').classList.remove('hidden');
        btn.querySelector('.btn-arrow').classList.add('hidden');

        fetch('/catalog/load-more/' + category + '?offset=' + offset + '&limit=12', {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            const grid = document.getElementById('product-grid');
            const temp = document.createElement('div');
            temp.innerHTML = data.html;
            Array.from(temp.children).forEach(function(child) {
                child.style.opacity = '0';
                child.style.transform = 'translateY(20px)';
                child.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
                grid.appendChild(child);
                requestAnimationFrame(function() {
                    child.style.opacity = '1';
                    child.style.transform = 'translateY(0)';
                });
            });

            btn.dataset.offset = data.loaded;
            document.getElementById('loaded-count').textContent = data.loaded;

            if (!data.hasMore) {
                container.innerHTML = '<p class="text-sm text-forest-400 mt-4">All ' + total + ' products loaded</p>';
            } else {
                btn.disabled = false;
                btn.querySelector('.btn-text').textContent = 'Load More Products';
                btn.querySelector('.btn-loading').classList.add('hidden');
                btn.querySelector('.btn-arrow').classList.remove('hidden');
            }
        })
        .catch(function(error) {
            console.error('Error:', error);
            btn.disabled = false;
            btn.querySelector('.btn-text').textContent = 'Load More Products';
            btn.querySelector('.btn-loading').classList.add('hidden');
            btn.querySelector('.btn-arrow').classList.remove('hidden');
        });
    }
});
</script>
@endpush
