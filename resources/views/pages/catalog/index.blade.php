@extends('layouts.app')

@section('title', 'Product Catalog - Surma Agro Export Products')
@section('meta_description', 'Browse Surma Agro product catalog featuring agricultural commodities, frozen seafood, processed foods, dried fish, and import items for B2B buyers.')

@php
$catalogSchema = json_encode([
    '@context' => 'https://schema.org',
    '@type' => 'ItemList',
    'name' => 'Surma Agro Product Catalog',
    'description' => 'Premium agricultural commodities and food products for global B2B markets',
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
@endphp

@push('schema')
<script type="application/ld+json">{!! $catalogSchema !!}</script>
@endpush

@section('content')
    {{-- Hero --}}
    <section class="relative pt-32 pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-earth-500 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-sm font-semibold rounded-full mb-6 border border-white/10">Products</span>
            <h1 class="text-4xl lg:text-5xl font-bold text-white mb-6">Product Catalog</h1>
            <p class="text-lg lg:text-xl text-forest-200 max-w-3xl mx-auto leading-relaxed">
                Explore our comprehensive range of premium agricultural commodities and food products
            </p>
        </div>
    </section>

    {{-- Category Navigation --}}
    <section id="category-nav" class="py-4 bg-cream border-b border-warm-gray/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-wrap gap-3 justify-center">
                @foreach($categoriesWithProducts as $cat)
                    <a href="#category-{{ $cat->slug }}"
                       class="category-nav-link whitespace-nowrap px-5 py-2.5 bg-white text-forest-700 text-sm font-semibold rounded-xl border border-warm-gray/50 hover:bg-forest-700 hover:text-earth-300 transition-all"
                       data-category="{{ $cat->slug }}">
                        {{ $cat->name }}
                        <span class="ml-1 text-xs opacity-70">({{ $cat->total_products }})</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Category Sections --}}
    <div class="relative z-0">
    @foreach($categoriesWithProducts as $cat)
        @if($cat->total_products > 0)
        <section id="category-{{ $cat->slug }}" class="py-16 {{ $loop->even ? 'bg-white' : 'bg-cream' }} category-section" data-category="{{ $cat->slug }}">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Category Header --}}
                <div class="text-center mb-8">
                    <h2 class="text-2xl lg:text-3xl font-bold text-forest-800">{{ $cat->name }}</h2>
                    @if($cat->description)
                        <p class="text-forest-500 mt-2 max-w-2xl mx-auto">{{ $cat->description }}</p>
                    @endif
                    <p class="text-sm text-forest-400 mt-1">{{ $cat->total_products }} products</p>
                </div>

                {{-- Products Grid --}}
                <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 product-grid" id="grid-{{ $cat->slug }}">
                    @foreach($cat->initial_products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                {{-- Load More Button --}}
                @if($cat->total_products > 8)
                    <div class="text-center mt-10" id="load-more-{{ $cat->slug }}">
                        <button
                            class="load-more-btn inline-flex items-center px-8 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all shadow-lg shadow-forest-700/20"
                            data-category="{{ $cat->slug }}"
                            data-offset="8"
                            data-total="{{ $cat->total_products }}">
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
                            Showing <span class="loaded-count">{{ min(8, $cat->total_products) }}</span> of {{ $cat->total_products }}
                        </p>
                    </div>
                @endif
            </div>
        </section>
        @endif
    @endforeach
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Sticky category nav on scroll
    var nav = document.getElementById('category-nav');
    var navTop = nav.offsetTop;
    var navHeight = nav.offsetHeight;
    var placeholder = document.createElement('div');
    placeholder.style.height = navHeight + 'px';
    placeholder.style.display = 'none';
    nav.parentNode.insertBefore(placeholder, nav.nextSibling);

    function handleScroll() {
        if (window.pageYOffset > navTop - 80) {
            // 80px = navbar height (top-20 = 5rem = 80px)
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
    // Load More button click handler
    document.querySelectorAll('.load-more-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            loadMoreProducts(this);
        });
    });

    // Intersection Observer for auto-loading on scroll
    const observerOptions = {
        root: null,
        rootMargin: '200px',
        threshold: 0
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                const btn = entry.target.querySelector('.load-more-btn');
                if (btn && !btn.disabled) {
                    loadMoreProducts(btn);
                }
            }
        });
    }, observerOptions);

    // Observe all load-more containers
    document.querySelectorAll('[id^="load-more-"]').forEach(function(el) {
        observer.observe(el);
    });

    // Highlight active category in nav on scroll
    const sections = document.querySelectorAll('.category-section');
    const navLinks = document.querySelectorAll('.category-nav-link');

    const sectionObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                const slug = entry.target.dataset.category;
                navLinks.forEach(function(link) {
                    if (link.dataset.category === slug) {
                        link.classList.add('bg-forest-700', 'text-earth-300', 'border-forest-700');
                        link.classList.remove('bg-white', 'text-forest-700');
                    } else {
                        link.classList.remove('bg-forest-700', 'text-earth-300', 'border-forest-700');
                        link.classList.add('bg-white', 'text-forest-700');
                    }
                });
            }
        });
    }, { rootMargin: '-20% 0px -60% 0px', threshold: 0 });

    sections.forEach(function(section) {
        sectionObserver.observe(section);
    });

    // Smooth scroll for category nav links
    navLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offset = 160; // account for sticky nav
                const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top: top, behavior: 'smooth' });
            }
        });
    });
});

function loadMoreProducts(btn) {
    if (btn.disabled) return;

    const category = btn.dataset.category;
    const offset = parseInt(btn.dataset.offset);
    const total = parseInt(btn.dataset.total);

    // Show loading state
    btn.disabled = true;
    btn.querySelector('.btn-text').textContent = 'Loading...';
    btn.querySelector('.btn-loading').classList.remove('hidden');
    btn.querySelector('.btn-arrow').classList.add('hidden');

    fetch('/catalog/load-more/' + category + '?offset=' + offset + '&limit=8', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(function(response) { return response.json(); })
    .then(function(data) {
        const grid = document.getElementById('grid-' + category);
        // Append new products with fade-in animation
        const temp = document.createElement('div');
        temp.innerHTML = data.html;
        Array.from(temp.children).forEach(function(child) {
            child.style.opacity = '0';
            child.style.transform = 'translateY(20px)';
            child.style.transition = 'opacity 0.4s ease, transform 0.4s ease';
            grid.appendChild(child);
            // Trigger animation
            requestAnimationFrame(function() {
                child.style.opacity = '1';
                child.style.transform = 'translateY(0)';
            });
        });

        // Update offset
        btn.dataset.offset = data.loaded;

        // Update count display
        const container = document.getElementById('load-more-' + category);
        const countEl = container.querySelector('.loaded-count');
        if (countEl) countEl.textContent = data.loaded;

        // Hide button if no more products
        if (!data.hasMore) {
            container.innerHTML = '<p class="text-sm text-forest-400 mt-4">All ' + total + ' products loaded</p>';
        } else {
            // Reset button state
            btn.disabled = false;
            btn.querySelector('.btn-text').textContent = 'Load More Products';
            btn.querySelector('.btn-loading').classList.add('hidden');
            btn.querySelector('.btn-arrow').classList.remove('hidden');
        }
    })
    .catch(function(error) {
        console.error('Error loading products:', error);
        btn.disabled = false;
        btn.querySelector('.btn-text').textContent = 'Load More Products';
        btn.querySelector('.btn-loading').classList.add('hidden');
        btn.querySelector('.btn-arrow').classList.remove('hidden');
    });
}
</script>
@endpush
