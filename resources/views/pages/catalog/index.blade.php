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
    <style>
        /* Firefox Thin scrollbar */
        #custom-select-listbox {
            scrollbar-width: thin;
            scrollbar-color: #bcd9cd transparent;
        }
        /* Custom scrollbar for custom category select listbox */
        #custom-select-listbox::-webkit-scrollbar {
            width: 5px;
        }
        #custom-select-listbox::-webkit-scrollbar-track {
            background: transparent;
        }
        #custom-select-listbox::-webkit-scrollbar-thumb {
            background: #bcd9cd; /* forest-200 */
            border-radius: 10px;
        }
        #custom-select-listbox::-webkit-scrollbar-thumb:hover {
            background: #8fbeb0; /* forest-300 */
        }
        /* Rotate chevron when dropdown is expanded with premium easing */
        #custom-select-trigger[aria-expanded="true"] #custom-select-chevron {
            transform: rotate(180deg);
        }
        /* Layered shadow for premium trigger and open dropdown state */
        .premium-select-shadow {
            box-shadow: 0 1px 2px 0 rgba(0,0,0,0.02), 0 4px 12px 0 rgba(14,36,30,0.06);
        }
        .premium-panel-shadow {
            box-shadow: 0 10px 30px -10px rgba(14,36,30,0.15), 0 1px 3px 0 rgba(14,36,30,0.05);
        }
    </style>
    {{-- Hero --}}
    <section class="relative pt-24 pb-12 md:pt-32 md:pb-24 bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 overflow-hidden">
        {{-- Agricultural Background Image overlay --}}
        <div class="absolute inset-0">
            <img src="{{ asset('storage/ai-images/hero/rice-mill-0Xirz8ysRN.webp') }}" alt="" class="w-full h-full object-cover opacity-15" loading="eager">
        </div>
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-10 right-10 w-72 h-72 bg-earth-500 rounded-full blur-3xl"></div>
        </div>
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-earth-300 text-xs md:text-sm font-semibold rounded-full mb-3 md:mb-6 border border-white/10 select-none">Products</span>
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-2 md:mb-6 select-none">Product Catalog</h1>
            <p class="text-xs sm:text-sm md:text-lg lg:text-xl text-forest-200 max-w-2xl mx-auto leading-relaxed font-normal select-none">
                Premium agricultural commodities and export products trusted by global buyers.
            </p>
            {{-- Catalog Stats Badge --}}
            <div class="mt-4 flex items-center justify-center gap-2 text-xs font-semibold text-earth-300/90 bg-white/5 backdrop-blur-sm px-4 py-1.5 rounded-full border border-white/5 inline-flex select-none shadow-sm">
                <span>{{ $categoriesWithProducts->sum('total_products') }} Products</span>
                <span class="text-forest-400 font-bold">•</span>
                <span>{{ count($categoriesWithProducts) }} Categories</span>
            </div>
        </div>
    </section>

    {{-- Category Navigation --}}
    <section id="category-nav" class="py-3 bg-cream border-b border-warm-gray/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Desktop Categories Pill Grid --}}
            <div class="hidden md:flex flex-wrap gap-3 justify-center">
                @foreach($categoriesWithProducts as $cat)
                    <a href="#category-{{ $cat->slug }}"
                       class="category-nav-link whitespace-nowrap px-5 py-2.5 bg-white text-forest-700 text-sm font-semibold rounded-xl border border-warm-gray/50 hover:bg-forest-700 hover:text-earth-300 transition-all"
                       data-category="{{ $cat->slug }}">
                        {{ $cat->name }}
                        <span class="ml-1 text-xs opacity-70">({{ $cat->total_products }})</span>
                    </a>
                @endforeach
            </div>

            {{-- Mobile Categories Dropdown & Dynamic Count (Premium Custom Theme-Matched Listbox) --}}
            <div class="flex md:hidden items-center justify-between gap-3 py-1">
                <div class="flex-1 flex items-center gap-2">
                    <span class="text-xs font-bold text-forest-800 uppercase tracking-wider select-none">Category</span>
                    
                    {{-- Custom Select Wrapper --}}
                    <div class="relative flex-1 max-w-[240px]" id="custom-select-wrapper">
                        @if(count($categoriesWithProducts) === 0)
                            <button disabled class="w-full h-[48px] bg-warm-light text-forest-400 text-sm font-semibold rounded-2xl border border-warm-gray/40 px-4 py-2 flex items-center justify-between cursor-not-allowed select-none">
                                <span>No categories available</span>
                                <svg class="h-4 w-4 text-forest-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                        @else
                            {{-- Trigger Button --}}
                            <button id="custom-select-trigger" 
                                    type="button"
                                    aria-haspopup="listbox"
                                    aria-expanded="false"
                                    aria-controls="custom-select-listbox"
                                    class="w-full h-[48px] bg-white text-forest-700 text-sm font-semibold rounded-2xl border border-warm-gray/60 px-4 py-2 flex items-center justify-between focus:outline-none focus:ring-4 focus:ring-forest-500/10 focus:border-forest-700 transition-all duration-200 premium-select-shadow cursor-pointer select-none active:scale-[0.98]"
                                    aria-label="Select product category">
                                <span id="custom-select-label" class="truncate pr-2 text-left font-medium">-- Select --</span>
                                <svg id="custom-select-chevron" class="h-5 w-5 shrink-0 text-forest-500 transition-transform duration-300 ease-[cubic-bezier(0.4,0,0.2,1)]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            
                            {{-- Dropdown Option Panel --}}
                            <ul id="custom-select-listbox" 
                                role="listbox" 
                                tabindex="-1"
                                class="absolute top-full left-0 right-0 mt-2 max-h-[300px] overflow-y-auto bg-white/95 backdrop-blur-md rounded-2xl border border-warm-gray/60 z-50 transition-all duration-200 ease-out opacity-0 translate-y-2 scale-[0.98] pointer-events-none origin-top focus:outline-none p-1.5 premium-panel-shadow">
                                @foreach($categoriesWithProducts as $cat)
                                    <li class="custom-select-option px-3.5 py-2.5 text-sm text-forest-700 hover:bg-forest-50/80 focus:bg-forest-50/80 hover:text-forest-900 font-semibold rounded-xl cursor-pointer flex items-center justify-between transition-all duration-150 select-none focus:outline-none active:scale-[0.99] mb-0.5 last:mb-0"
                                        role="option"
                                        aria-selected="false"
                                        data-value="{{ $cat->slug }}"
                                        tabindex="0">
                                        <div class="flex items-center gap-2 truncate text-left">
                                            <svg class="option-check h-4 w-4 text-white shrink-0 hidden transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                            <span class="option-label truncate font-medium">{{ $cat->name }}</span>
                                        </div>
                                        <span class="option-count text-xs font-semibold px-2 py-0.5 rounded-full bg-forest-50 text-forest-600 transition-colors duration-150">{{ $cat->total_products }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
                <div class="text-right shrink-0">
                    <span id="mobile-product-count" class="text-xs font-semibold text-forest-700 bg-forest-50/80 border border-forest-100/50 px-3.5 py-2.5 rounded-full shadow-sm transition-all duration-300 select-none inline-block">-- Products</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Category Sections --}}
    <div class="relative z-0">
    @foreach($categoriesWithProducts as $cat)
        @if($cat->total_products > 0)
        <section id="category-{{ $cat->slug }}" class="py-8 md:py-16 {{ $loop->even ? 'bg-white' : 'bg-cream' }} category-section" data-category="{{ $cat->slug }}">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                {{-- Category Header --}}
                <div class="text-center mb-4 md:mb-8">
                    <h2 class="text-xl md:text-3xl font-bold text-forest-800">{{ $cat->name }}</h2>
                    @if($cat->description)
                        <p class="hidden md:block text-forest-500 mt-2 max-w-2xl mx-auto">{{ $cat->description }}</p>
                    @endif
                    <p class="text-xs md:text-sm text-forest-400 mt-1">{{ $cat->total_products }} products</p>
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
    let isAutoLoadingDisabled = false;
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
        if (isAutoLoadingDisabled) return;
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

    // Map category slugs to total products for dynamic mobile badge rendering
    const categoryCounts = {
        @foreach($categoriesWithProducts as $cat)
            "{{ $cat->slug }}": {{ $cat->total_products }},
        @endforeach
    };

    const wrapper = document.getElementById('custom-select-wrapper');
    const trigger = document.getElementById('custom-select-trigger');
    const listbox = document.getElementById('custom-select-listbox');
    const label = document.getElementById('custom-select-label');
    const options = document.querySelectorAll('.custom-select-option');
    const mobileCountBadge = document.getElementById('mobile-product-count');

    let activeIndex = -1;

    function openDropdown() {
        if (!trigger || !listbox) return;
        trigger.setAttribute('aria-expanded', 'true');
        listbox.classList.remove('opacity-0', 'translate-y-2', 'scale-[0.98]', 'pointer-events-none');
        listbox.classList.add('opacity-100', 'translate-y-0', 'scale-100', 'pointer-events-auto');
        listbox.focus();
    }

    // Direct scroll scrollbar highlight alignment helper
    function scrollActiveOptionIntoView(opt) {
        if (!listbox || !opt) return;
        const optTop = opt.offsetTop;
        const optHeight = opt.offsetHeight;
        const listboxHeight = listbox.clientHeight;
        const listboxScrollTop = listbox.scrollTop;
        if (optTop < listboxScrollTop) {
            listbox.scrollTop = optTop;
        } else if (optTop + optHeight > listboxScrollTop + listboxHeight) {
            listbox.scrollTop = optTop + optHeight - listboxHeight;
        }
    }

    function closeDropdown() {
        if (!trigger || !listbox) return;
        trigger.setAttribute('aria-expanded', 'false');
        listbox.classList.add('opacity-0', 'translate-y-2', 'scale-[0.98]', 'pointer-events-none');
        listbox.classList.remove('opacity-100', 'translate-y-0', 'scale-100', 'pointer-events-auto');
    }

    function updateActiveOption(index) {
        activeIndex = index;
        options.forEach((opt, idx) => {
            if (idx === index) {
                opt.classList.add('bg-forest-50', 'text-forest-900');
                opt.focus();
                scrollActiveOptionIntoView(opt);
            } else {
                opt.classList.remove('bg-forest-50', 'text-forest-900');
            }
        });
    }

    function selectOption(opt) {
        const slug = opt.dataset.value;
        const name = opt.querySelector('.option-label').textContent;
        
        // Update trigger label
        if (label) label.textContent = name;
        
        // Update active classes for options
        options.forEach(o => {
            const isSelected = o.dataset.value === slug;
            o.setAttribute('aria-selected', isSelected ? 'true' : 'false');
            const check = o.querySelector('.option-check');
            const labelSpan = o.querySelector('.option-label');
            const countSpan = o.querySelector('.option-count');
            
            if (isSelected) {
                o.classList.add('bg-forest-700', 'text-white');
                o.classList.remove('text-forest-700', 'hover:bg-forest-50/80', 'hover:text-forest-900');
                if (labelSpan) {
                    labelSpan.classList.add('font-bold');
                    labelSpan.classList.remove('font-medium');
                }
                if (countSpan) {
                    countSpan.classList.add('bg-white/20', 'text-white');
                    countSpan.classList.remove('bg-forest-50', 'text-forest-600');
                }
                if (check) check.classList.remove('hidden');
            } else {
                o.classList.remove('bg-forest-700', 'text-white');
                o.classList.add('text-forest-700', 'hover:bg-forest-50/80', 'hover:text-forest-900');
                if (labelSpan) {
                    labelSpan.classList.remove('font-bold');
                    labelSpan.classList.add('font-medium');
                }
                if (countSpan) {
                    countSpan.classList.remove('bg-white/20', 'text-white');
                    countSpan.classList.add('bg-forest-50', 'text-forest-600');
                }
                if (check) check.classList.add('hidden');
            }
        });
        
        closeDropdown();
        if (trigger) trigger.focus();
        
        // Scroll to category section
        smoothScrollToCategory(slug);
        
        // Update counts
        updateMobileCategoryState(slug, false);
    }

    function updateMobileCategoryState(slug, updateLabel = true) {
        if (mobileCountBadge && categoryCounts[slug] !== undefined) {
            const newText = `${categoryCounts[slug]} Products`;
            if (mobileCountBadge.textContent !== newText) {
                // Micro-interaction: scale pop animation on count change
                mobileCountBadge.classList.add('scale-90', 'opacity-50');
                setTimeout(() => {
                    mobileCountBadge.textContent = newText;
                    mobileCountBadge.classList.remove('scale-90', 'opacity-50');
                    mobileCountBadge.classList.add('scale-105');
                    setTimeout(() => {
                        mobileCountBadge.classList.remove('scale-105');
                    }, 150);
                }, 100);
            }
        }
        
        options.forEach(o => {
            const isSelected = o.dataset.value === slug;
            o.setAttribute('aria-selected', isSelected ? 'true' : 'false');
            const check = o.querySelector('.option-check');
            const labelSpan = o.querySelector('.option-label');
            const countSpan = o.querySelector('.option-count');
            
            if (isSelected) {
                if (updateLabel && label) {
                    label.textContent = o.querySelector('.option-label').textContent;
                }
                o.classList.add('bg-forest-700', 'text-white');
                o.classList.remove('text-forest-700', 'hover:bg-forest-50/80', 'hover:text-forest-900');
                if (labelSpan) {
                    labelSpan.classList.add('font-bold');
                    labelSpan.classList.remove('font-medium');
                }
                if (countSpan) {
                    countSpan.classList.add('bg-white/20', 'text-white');
                    countSpan.classList.remove('bg-forest-50', 'text-forest-600');
                }
                if (check) check.classList.remove('hidden');
            } else {
                o.classList.remove('bg-forest-700', 'text-white');
                o.classList.add('text-forest-700', 'hover:bg-forest-50/80', 'hover:text-forest-900');
                if (labelSpan) {
                    labelSpan.classList.remove('font-bold');
                    labelSpan.classList.add('font-medium');
                }
                if (countSpan) {
                    countSpan.classList.remove('bg-white/20', 'text-white');
                    countSpan.classList.add('bg-forest-50', 'text-forest-600');
                }
                if (check) check.classList.add('hidden');
            }
        });
    }

    // Toggle click trigger
    trigger?.addEventListener('click', function(e) {
        e.stopPropagation();
        const isExpanded = trigger.getAttribute('aria-expanded') === 'true';
        if (isExpanded) {
            closeDropdown();
        } else {
            openDropdown();
        }
    });

    // Option item click
    options.forEach(opt => {
        opt.addEventListener('click', function(e) {
            e.stopPropagation();
            selectOption(this);
        });
    });

    // Dismiss dropdown on outside clicks
    document.addEventListener('click', function(e) {
        if (wrapper && !wrapper.contains(e.target)) {
            closeDropdown();
        }
    });

    // Keydown handlers for trigger & options listbox
    trigger?.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowDown' || e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            openDropdown();
            // Find current selected index
            let startIdx = 0;
            const currentSlug = wrapper.querySelector('[aria-selected="true"]')?.dataset.value;
            if (currentSlug) {
                options.forEach((opt, idx) => {
                    if (opt.dataset.value === currentSlug) startIdx = idx;
                });
            }
            updateActiveOption(startIdx);
        }
    });

    listbox?.addEventListener('keydown', function(e) {
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            const nextIdx = (activeIndex + 1) % options.length;
            updateActiveOption(nextIdx);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            const prevIdx = (activeIndex - 1 + options.length) % options.length;
            updateActiveOption(prevIdx);
        } else if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            if (activeIndex >= 0 && activeIndex < options.length) {
                selectOption(options[activeIndex]);
            }
        } else if (e.key === 'Escape') {
            e.preventDefault();
            closeDropdown();
            trigger?.focus();
        } else if (e.key === 'Tab') {
            closeDropdown();
        }
    });

    // Initialize listbox default label & product counts
    const initialSelectedOption = listbox?.querySelector('[aria-selected="true"]') || options[0];
    if (initialSelectedOption) {
        const initialSlug = initialSelectedOption.dataset.value;
        updateMobileCategoryState(initialSlug);
    }

    // Highlight active category in nav on scroll
    const sections = document.querySelectorAll('.category-section');
    const navLinks = document.querySelectorAll('.category-nav-link');

    const sectionObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                const slug = entry.target.dataset.category;
                
                // Update desktop nav highlighted class
                navLinks.forEach(function(link) {
                    if (link.dataset.category === slug) {
                        link.classList.add('bg-forest-700', 'text-earth-300', 'border-forest-700');
                        link.classList.remove('bg-white', 'text-forest-700');
                    } else {
                        link.classList.remove('bg-forest-700', 'text-earth-300', 'border-forest-700');
                        link.classList.add('bg-white', 'text-forest-700');
                    }
                });

                // Update mobile active dropdown value & count badge
                updateMobileCategoryState(slug);
            }
        });
    }, { rootMargin: '-20% 0px -60% 0px', threshold: 0 });

    sections.forEach(function(section) {
        sectionObserver.observe(section);
    });

    // Smooth scroll helper
    function smoothScrollToCategory(slug) {
        const target = document.getElementById('category-' + slug);
        if (target) {
            isAutoLoadingDisabled = true;
            const offset = 160; // account for sticky navigation
            const top = target.getBoundingClientRect().top + window.pageYOffset - offset;
            window.scrollTo({ top: top, behavior: 'smooth' });
            
            // Re-enable auto-loading after smooth scroll completes
            setTimeout(function() {
                isAutoLoadingDisabled = false;
            }, 1000);
        }
    }

    // Smooth scroll for category nav links (Desktop)
    navLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            const slug = href.replace('#category-', '');
            smoothScrollToCategory(slug);
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
