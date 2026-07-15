<footer class="bg-forest-900 text-white">
    {{-- Main Footer --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            {{-- Brand --}}
            <div class="text-center md:text-left">
                <div class="flex items-center justify-center md:justify-start space-x-3 mb-4">
                    <img src="{{ asset('storage/logos/footer_logo.webp') }}" alt="Surma Agro" class="h-[68px] w-auto">
                </div>
                <p class="text-forest-200 text-sm leading-relaxed mb-6">
                    Premium global agriculture export and import company, delivering quality agricultural commodities, frozen seafood, and processed foods worldwide.
                </p>
                <div class="flex justify-center md:justify-start space-x-3">
                    <a href="#" class="w-10 h-10 bg-forest-800 rounded-lg flex items-center justify-center hover:bg-earth-600 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-forest-800 rounded-lg flex items-center justify-center hover:bg-earth-600 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-forest-800 rounded-lg flex items-center justify-center hover:bg-earth-600 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.373 0 0 5.372 0 12c0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.011-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 01.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12 24c6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z"/></svg>
                    </a>
                    <a href="#" class="w-10 h-10 bg-forest-800 rounded-lg flex items-center justify-center hover:bg-earth-600 transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="text-center md:text-left">
                <h3 class="text-sm font-semibold text-earth-400 uppercase tracking-wider mb-4">Quick Links</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('about') }}" class="text-forest-200 hover:text-white text-sm transition-colors">About Us</a></li>
                    <li><a href="{{ route('catalog.index') }}" class="text-forest-200 hover:text-white text-sm transition-colors">Product Catalog</a></li>
                    <li><a href="{{ route('surma-fish') }}" class="text-forest-200 hover:text-white text-sm transition-colors">Surma Fish</a></li>
                    <li><a href="{{ route('change-box') }}" class="text-forest-200 hover:text-white text-sm transition-colors">Change Box</a></li>
                    <li><a href="{{ route('presence') }}" class="text-forest-200 hover:text-white text-sm transition-colors">Global Presence</a></li>
                    <li><a href="{{ route('certificates') }}" class="text-forest-200 hover:text-white text-sm transition-colors">Certifications</a></li>
                    <li><a href="{{ route('timeline') }}" class="text-forest-200 hover:text-white text-sm transition-colors">Achievements</a></li>
                </ul>
            </div>

            {{-- Product Categories --}}
            <div class="text-center md:text-left">
                <h3 class="text-sm font-semibold text-earth-400 uppercase tracking-wider mb-4">Products</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('catalog.category', 'export-items') }}" class="text-forest-200 hover:text-white text-sm transition-colors">Export Items</a></li>
                    <li><a href="{{ route('catalog.category', 'frozen-export-items') }}" class="text-forest-200 hover:text-white text-sm transition-colors">Frozen Export</a></li>
                    <li><a href="{{ route('catalog.category', 'processed-food-products') }}" class="text-forest-200 hover:text-white text-sm transition-colors">Processed Foods</a></li>
                    <li><a href="{{ route('catalog.category', 'dried-fish-export-items') }}" class="text-forest-200 hover:text-white text-sm transition-colors">Dried Fish</a></li>
                    <li><a href="{{ route('catalog.category', 'import-items') }}" class="text-forest-200 hover:text-white text-sm transition-colors">Import Items</a></li>
                    <li><a href="{{ route('terms') }}" class="text-forest-200 hover:text-white text-sm transition-colors">Trade Policy</a></li>
                </ul>
            </div>

            {{-- Newsletter --}}
            <div class="text-center md:text-left">
                <h3 class="text-sm font-semibold text-earth-400 uppercase tracking-wider mb-4">Newsletter</h3>
                <p class="text-forest-200 text-sm mb-4 text-center md:text-left max-w-[70%] mx-auto md:mx-0 w-full">Subscribe for product updates, trade insights, and company news.</p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="space-y-3">
                    @csrf
                    <input type="email" name="email" placeholder="Your email address" required class="w-full px-4 py-3 rounded-xl bg-forest-800 border border-forest-700 text-white text-sm placeholder-forest-400 focus:ring-2 focus:ring-earth-500 focus:border-transparent outline-none transition-all">
                    <button type="submit" class="w-full px-4 py-3 bg-earth-600 text-white text-sm font-semibold rounded-xl hover:bg-earth-500 transition-all">Subscribe</button>
                </form>
                <div class="mt-6 space-y-2 text-forest-400 text-xs">
                    <p>info@surmaagro.com | +95 9797100016</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-forest-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-forest-400 text-sm text-center md:text-left w-full max-w-[70%] mx-auto md:mx-0">&copy; {{ date('Y') }} Surma Agro. All rights reserved. Premium Global Trade &amp; Export.</p>
                <div class="flex space-x-6">
                    <a href="{{ route('terms') }}" class="text-forest-400 hover:text-white text-sm transition-colors">Terms &amp; Policy</a>
                    <a href="#" class="text-forest-400 hover:text-white text-sm transition-colors">Privacy Policy</a>
                    <a href="{{ route('contact') }}" class="text-forest-400 hover:text-white text-sm transition-colors">Support</a>
                </div>
            </div>
        </div>
    </div>
</footer>
