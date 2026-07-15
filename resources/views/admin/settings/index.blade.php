@extends('admin.layouts.admin')

@section('title', 'Settings - Surma Agro Admin')
@section('header', 'Settings')

@section('content')
<div class="max-w-3xl" x-data="{ tab: 'company' }">
    {{-- Tabs --}}
    <div class="flex flex-wrap gap-2 mb-6">
        <button @click="tab = 'company'" :class="tab === 'company' ? 'bg-forest-700 text-white' : 'bg-white text-forest-700 border border-warm-gray/50'" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-all">Company</button>
        <button @click="tab = 'social'" :class="tab === 'social' ? 'bg-forest-700 text-white' : 'bg-white text-forest-700 border border-warm-gray/50'" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-all">Social Media</button>
        <button @click="tab = 'api'" :class="tab === 'api' ? 'bg-forest-700 text-white' : 'bg-white text-forest-700 border border-warm-gray/50'" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-all">API Integrations</button>
        <button @click="tab = 'seo'" :class="tab === 'seo' ? 'bg-forest-700 text-white' : 'bg-white text-forest-700 border border-warm-gray/50'" class="px-5 py-2.5 text-sm font-semibold rounded-xl transition-all">SEO</button>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf

        {{-- Company Tab --}}
        <div x-show="tab === 'company'" class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
            <h3 class="text-lg font-semibold text-forest-800 mb-6">Company Information</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Company Name</label>
                    <input type="text" name="company_name" value="{{ old('company_name', App\Models\Setting::getValue('company_name')) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Company Email</label>
                    <input type="email" name="company_email" value="{{ old('company_email', App\Models\Setting::getValue('company_email')) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Company Phone</label>
                    <input type="text" name="company_phone" value="{{ old('company_phone', App\Models\Setting::getValue('company_phone')) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Company Address</label>
                    <textarea name="company_address" rows="3" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none resize-none">{{ old('company_address', App\Models\Setting::getValue('company_address')) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Social Media Tab --}}
        <div x-show="tab === 'social'" class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
            <h3 class="text-lg font-semibold text-forest-800 mb-6">Social Media Links</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Facebook URL</label>
                    <input type="url" name="facebook_url" value="{{ old('facebook_url', App\Models\Setting::getValue('facebook_url')) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="https://facebook.com/...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Twitter / X URL</label>
                    <input type="url" name="twitter_url" value="{{ old('twitter_url', App\Models\Setting::getValue('twitter_url')) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="https://x.com/...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">LinkedIn URL</label>
                    <input type="url" name="linkedin_url" value="{{ old('linkedin_url', App\Models\Setting::getValue('linkedin_url')) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="https://linkedin.com/company/...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">WhatsApp Number (Contact Page)</label>
                    <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', App\Models\Setting::getValue('whatsapp_number')) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="+880...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Instagram URL</label>
                    <input type="url" name="instagram_url" value="{{ old('instagram_url', App\Models\Setting::getValue('instagram_url')) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="https://instagram.com/...">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">YouTube URL</label>
                    <input type="url" name="youtube_url" value="{{ old('youtube_url', App\Models\Setting::getValue('youtube_url')) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="https://youtube.com/@...">
                </div>
            </div>
        </div>

        {{-- API Integrations Tab --}}
        <div x-show="tab === 'api'" class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
            <h3 class="text-lg font-semibold text-forest-800 mb-2">API Integrations</h3>
            <p class="text-sm text-forest-500 mb-6">Configure API keys for image services and other integrations.</p>
            <div class="space-y-6">
                {{-- Unsplash --}}
                <div class="p-4 bg-cream rounded-xl border border-warm-gray/50">
                    <h4 class="font-semibold text-forest-800 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Unsplash
                    </h4>
                    <div class="space-y-3">
                        <div x-data="{ show: false }">
                            <label class="block text-sm font-medium text-forest-700 mb-1">Access Key</label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="unsplash_access_key" value="{{ old('unsplash_access_key', App\Models\Setting::getValue('unsplash_access_key')) }}" class="w-full px-4 py-3 pr-12 rounded-xl border border-warm-gray bg-white text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="Enter Unsplash Access Key">
                                <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-forest-400 hover:text-forest-600">
                                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                </button>
                            </div>
                        </div>
                        <div x-data="{ show: false }">
                            <label class="block text-sm font-medium text-forest-700 mb-1">Secret Key</label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" name="unsplash_secret_key" value="{{ old('unsplash_secret_key', App\Models\Setting::getValue('unsplash_secret_key')) }}" class="w-full px-4 py-3 pr-12 rounded-xl border border-warm-gray bg-white text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="Enter Unsplash Secret Key">
                                <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-forest-400 hover:text-forest-600">
                                    <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Pexels --}}
                <div class="p-4 bg-cream rounded-xl border border-warm-gray/50">
                    <h4 class="font-semibold text-forest-800 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Pexels
                    </h4>
                    <div x-data="{ show: false }">
                        <label class="block text-sm font-medium text-forest-700 mb-1">API Key</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="pexels_api_key" value="{{ old('pexels_api_key', App\Models\Setting::getValue('pexels_api_key')) }}" class="w-full px-4 py-3 pr-12 rounded-xl border border-warm-gray bg-white text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="Enter Pexels API Key">
                            <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-forest-400 hover:text-forest-600">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Pixabay --}}
                <div class="p-4 bg-cream rounded-xl border border-warm-gray/50">
                    <h4 class="font-semibold text-forest-800 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-forest-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Pixabay
                    </h4>
                    <div x-data="{ show: false }">
                        <label class="block text-sm font-medium text-forest-700 mb-1">API Key</label>
                        <div class="relative">
                            <input :type="show ? 'text' : 'password'" name="pixabay_api_key" value="{{ old('pixabay_api_key', App\Models\Setting::getValue('pixabay_api_key')) }}" class="w-full px-4 py-3 pr-12 rounded-xl border border-warm-gray bg-white text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="Enter Pixabay API Key">
                            <button type="button" @click="show = !show" class="absolute right-3 top-1/2 -translate-y-1/2 text-forest-400 hover:text-forest-600">
                                <svg x-show="!show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                <svg x-show="show" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                            </button>
                        </div>
                    </div>
                    <p class="text-xs text-forest-400 mt-2">Get your free API key at <a href="https://pixabay.com/api/docs/" target="_blank" class="underline">pixabay.com/api/docs</a></p>
                </div>
            </div>
        </div>

        {{-- SEO Tab --}}
        <div x-show="tab === 'seo'" class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
            <h3 class="text-lg font-semibold text-forest-800 mb-6">SEO & Analytics</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Default Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', App\Models\Setting::getValue('meta_title')) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="Surma Agro - Global Agriculture Export">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Default Meta Description</label>
                    <textarea name="meta_description" rows="3" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none resize-none" placeholder="Premium agro-industrial export company...">{{ old('meta_description', App\Models\Setting::getValue('meta_description')) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Google Analytics ID</label>
                    <input type="text" name="google_analytics_id" value="{{ old('google_analytics_id', App\Models\Setting::getValue('google_analytics_id')) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="G-XXXXXXXXXX">
                </div>
                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">Facebook Pixel ID</label>
                    <input type="text" name="facebook_pixel_id" value="{{ old('facebook_pixel_id', App\Models\Setting::getValue('facebook_pixel_id')) }}" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" placeholder="XXXXXXXXXXXXXXX">
                </div>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="px-8 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all shadow-lg shadow-forest-700/20">Save Settings</button>
        </div>
    </form>
</div>
@endsection
