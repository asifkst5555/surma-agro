@extends('admin.layouts.admin')

@section('title', 'Custom Prompts - Surma Agro Admin')
@section('header', 'AI Settings: Custom Prompts')

@section('content')
<div class="flex gap-8">
    @include('admin.ai-settings.partials.sidebar', ['active' => 'custom-prompts'])

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

        <form method="POST" action="{{ route('admin.ai-settings.update-custom-prompts') }}">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
                <h3 class="text-lg font-semibold text-forest-800 mb-1">Response Phrases</h3>
                <p class="text-sm text-forest-500 mb-6">Customize the phrases the AI uses at the end of responses.</p>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Custom Follow-up Phrase</label>
                        <input type="text" name="ai_follow_up_phrase"
                               value="{{ old('ai_follow_up_phrase', $settings['ai_follow_up_phrase'] ?? 'Let me know if you need more details about any of our products or services.') }}"
                               placeholder="Let me know if you need more details about any of our products or services."
                               class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                        <p class="mt-1.5 text-xs text-forest-500">Added at end of responses when more detail might be needed. Leave blank to disable.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Custom Closing Phrase</label>
                        <input type="text" name="ai_closing_phrase"
                               value="{{ old('ai_closing_phrase', $settings['ai_closing_phrase'] ?? '') }}"
                               placeholder="e.g., Thank you for choosing Surma Agro!"
                               class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                        <p class="mt-1.5 text-xs text-forest-500">Optional closing phrase added to every response. Leave blank for no closing.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8 mt-6">
                <h3 class="text-lg font-semibold text-forest-800 mb-1">Custom System Prompt</h3>
                <p class="text-sm text-forest-500 mb-6">Complete override of AI behavior. Use only if you need full custom control.</p>

                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">System Prompt (Full Control)</label>
                    <textarea name="ai_assistant_system_prompt" rows="12"
                              placeholder="Write complete instructions for the AI. This replaces ALL default behavior rules.&#10;&#10;Example:&#10;You are a friendly export advisor for Surma Agro.&#10;Always answer in exactly 3 bullet points.&#10;Never suggest contacting humans unless explicitly asked.&#10;Use professional English."
                              class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none resize-none font-mono text-sm">{{ old('ai_assistant_system_prompt', $settings['ai_assistant_system_prompt'] ?? '') }}</textarea>
                    <p class="mt-1.5 text-xs text-earth-600 font-semibold">⚠️ If filled, this REPLACES ALL settings on other tabs. Use only for complete custom control.</p>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-8 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all shadow-lg shadow-forest-700/20">Save Custom Prompts</button>
            </div>
        </form>
    </div>
</div>
@endsection
