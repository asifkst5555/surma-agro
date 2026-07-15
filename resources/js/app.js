import Alpine from 'alpinejs';

// We import Swiper CSS files so Vite bundles them into app.css. 
// The actual Swiper JS module will be lazy loaded dynamically when needed.
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-fade';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    // 1. Initialize Viewport Animations
    initAnimations();

    // 2. Lazy Load Swiper Sliders
    initLazySliders();

    // 3. Mobile menu toggle
    const mobileBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    if (mobileBtn && mobileMenu) {
        mobileBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // 4. Initialize Surma Agro AI Chatbot
    import('./chatbot.js').then(({ initSurmaChat }) => {
        initSurmaChat();
    });
});

// Lightweight unified viewport animation engine
function initAnimations() {
    const animElements = document.querySelectorAll('[data-gsap], [data-aos]');
    const animObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const delay = el.dataset.aosDelay || el.dataset.gsapDelay || 0;
                
                if (delay) {
                    el.style.transitionDelay = `${delay}ms`;
                }
                
                el.classList.add('animate-in');

                if (el.dataset.gsap === 'counter') {
                    animateCounter(el);
                }

                observer.unobserve(el);
            }
        });
    }, {
        rootMargin: '0px 0px -8% 0px',
        threshold: 0.05
    });

    animElements.forEach(el => animObserver.observe(el));
}

// Stats Counter Animator
function animateCounter(el) {
    const target = parseInt(el.dataset.target, 10);
    if (isNaN(target)) return;
    
    const suffix = el.dataset.suffix || '';
    const duration = 1200;
    const startTime = performance.now();

    function update(now) {
        const progress = Math.min((now - startTime) / duration, 1);
        const easeProgress = progress * (2 - progress); // Ease out quad
        const value = Math.floor(easeProgress * target);
        
        el.textContent = value + suffix;
        if (progress < 1) {
            requestAnimationFrame(update);
        } else {
            el.textContent = target + suffix;
        }
    }
    requestAnimationFrame(update);
}

// Swiper Lazy Loader (Dynamic Imports)
async function initLazySliders() {
    const heroSwiperEl = document.querySelector('.hero-swiper');
    const productsSwiperEl = document.querySelector('.products-swiper');
    const testimonialsSwiperEl = document.querySelector('.testimonials-swiper');

    if (heroSwiperEl || productsSwiperEl || testimonialsSwiperEl) {
        // Load Swiper chunks dynamically only if any slider elements exist on the page
        const [
            { default: Swiper },
            { Navigation, Pagination, Autoplay, EffectFade }
        ] = await Promise.all([
            import('swiper'),
            import('swiper/modules')
        ]);

        if (heroSwiperEl) {
            new Swiper(heroSwiperEl, {
                modules: [Navigation, Pagination, Autoplay, EffectFade],
                effect: 'fade',
                loop: true,
                autoplay: { delay: 5000, disableOnInteraction: false },
                pagination: { clickable: true, el: '.hero-pagination' },
                navigation: {
                    nextEl: '.hero-next',
                    prevEl: '.hero-prev',
                },
            });
        }

        if (productsSwiperEl) {
            new Swiper(productsSwiperEl, {
                modules: [Navigation, Autoplay],
                slidesPerView: 1,
                spaceBetween: 24,
                autoplay: { delay: 4000, disableOnInteraction: false },
                navigation: {
                    nextEl: '.products-next',
                    prevEl: '.products-prev',
                },
                breakpoints: {
                    640: { slidesPerView: 2 },
                    768: { slidesPerView: 3 },
                    1024: { slidesPerView: 4 },
                },
            });
        }

        if (testimonialsSwiperEl) {
            new Swiper(testimonialsSwiperEl, {
                modules: [Navigation, Autoplay, Pagination],
                slidesPerView: 1,
                spaceBetween: 24,
                autoplay: { delay: 6000, disableOnInteraction: false },
                pagination: { clickable: true, el: '.testimonials-pagination' },
                breakpoints: {
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                },
            });
        }
    }
}
