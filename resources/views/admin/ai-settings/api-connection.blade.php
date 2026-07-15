@extends('admin.layouts.admin')

@section('title', 'AI API Connection - Surma Agro Admin')
@section('header', 'AI Settings: API Connection')

@section('content')
<div class="flex gap-8">
    @include('admin.ai-settings.partials.sidebar', ['active' => 'api-connection'])

    <div class="flex-1 max-w-2xl">
        @if (session('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl text-green-700 text-sm font-medium">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.ai-settings.update-api-connection') }}">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
                <h3 class="text-lg font-semibold text-forest-800 mb-1">API Configuration</h3>
                <p class="text-sm text-forest-500 mb-6">Configure your AI provider and API credentials.</p>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">API Provider</label>
                        <select id="api-provider-select" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            <option value="groq" @selected(str_contains($settings['ai_openai_base_url'] ?? '', 'api.groq.com'))>Groq (api.groq.com) — Default</option>
                            <option value="openai" @selected(str_contains($settings['ai_openai_base_url'] ?? '', 'api.openai.com'))>OpenAI (api.openai.com)</option>
                            <option value="openrouter" @selected(str_contains($settings['ai_openai_base_url'] ?? '', 'openrouter.ai'))>OpenRouter (openrouter.ai)</option>
                            <option value="custom" @selected(!(str_contains($settings['ai_openai_base_url'] ?? '', 'api.openai.com') || str_contains($settings['ai_openai_base_url'] ?? '', 'api.groq.com') || str_contains($settings['ai_openai_base_url'] ?? '', 'openrouter.ai')))>Custom URL</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">API Base URL</label>
                        <input type="text" name="ai_openai_base_url" id="ai-base-url"
                               value="{{ old('ai_openai_base_url', $settings['ai_openai_base_url'] ?? 'https://api.groq.com/openai/v1') }}"
                               class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none font-mono text-sm" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">API Key</label>
                        <input type="password" name="ai_openai_api_key"
                               value=""
                               placeholder="{{ $hasAiApiKey ? 'Key stored — leave blank to keep' : 'gsk_...' }}"
                               class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none font-mono text-sm" autocomplete="new-password">
                        @if ($hasAiApiKey)
                            <p class="mt-1.5 text-xs text-forest-500">A key is already stored. Leave blank to keep it.</p>
                        @else
                            <p class="mt-1.5 text-xs text-earth-600 font-semibold">No API key stored — AI uses knowledge base fallback only.</p>
                        @endif
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Clear stored API key</label>
                        <select name="ai_openai_api_key_clear" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            <option value="0" selected>No</option>
                            <option value="1">Yes, remove it</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">AI Model</label>
                        <input type="text" name="ai_openai_model"
                               value="{{ old('ai_openai_model', $settings['ai_openai_model'] ?? 'qwen/qwen3-32b') }}"
                               class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none font-mono text-sm" required>
                        <p class="mt-1.5 text-xs text-forest-500">
                            Groq: <code class="bg-forest-50 px-1 rounded">qwen/qwen3-32b</code> or <code class="bg-forest-50 px-1 rounded">llama-3.3-70b-versatile</code> |
                            OpenAI: <code class="bg-forest-50 px-1 rounded">gpt-4o-mini</code> |
                            OpenRouter: check available models
                        </p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Enable web search</label>
                        <select name="ai_web_search_enabled" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            <option value="1" @selected((old('ai_web_search_enabled', $settings['ai_web_search_enabled'] ?? '0')) === '1')>Enabled — AI can search the web for current facts</option>
                            <option value="0" @selected((old('ai_web_search_enabled', $settings['ai_web_search_enabled'] ?? '0')) === '0')>Disabled — AI uses knowledge base only</option>
                        </select>
                        <p class="mt-1.5 text-xs text-forest-500">Requires OpenAI Responses API or Groq with built-in web search.</p>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-8 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all shadow-lg shadow-forest-700/20">Save API Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var providerSelect = document.getElementById('api-provider-select');
    var baseUrlInput = document.getElementById('ai-base-url');
    var providerUrls = {
        groq: 'https://api.groq.com/openai/v1',
        openai: 'https://api.openai.com/v1',
        openrouter: 'https://openrouter.ai/api/v1',
        custom: baseUrlInput ? baseUrlInput.value : ''
    };
    if (providerSelect && baseUrlInput) {
        providerSelect.addEventListener('change', function() {
            var url = providerUrls[this.value];
            if (url && this.value !== 'custom') {
                baseUrlInput.value = url;
            }
        });
    }
});
</script>
@endpush
