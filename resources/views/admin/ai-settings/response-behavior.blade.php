@extends('admin.layouts.admin')

@section('title', 'Response Behavior - Surma Agro Admin')
@section('header', 'AI Settings: Response Behavior')

@section('content')
<div class="flex gap-8">
    @include('admin.ai-settings.partials.sidebar', ['active' => 'response-behavior'])

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

        <form method="POST" action="{{ route('admin.ai-settings.update-response-behavior') }}">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
                <h3 class="text-lg font-semibold text-forest-800 mb-1">Response Structure</h3>
                <p class="text-sm text-forest-500 mb-6">Control how responses are formatted and sized.</p>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Max Bullet Points</label>
                        <input type="number" name="ai_max_bullets"
                               value="{{ old('ai_max_bullets', $settings['ai_max_bullets'] ?? 5) }}" min="1" max="10"
                               class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                        <p class="mt-1.5 text-xs text-forest-500">Maximum bullets per response. Default: 5.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Max Answer Length (characters)</label>
                        <input type="number" name="ai_max_length"
                               value="{{ old('ai_max_length', $settings['ai_max_length'] ?? 900) }}" min="200" max="2000"
                               class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                        <p class="mt-1.5 text-xs text-forest-500">Character limit per response. Default: 900.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Response Format</label>
                        <select name="ai_response_format" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            <option value="bullets" @selected((old('ai_response_format', $settings['ai_response_format'] ?? 'mixed')) === 'bullets')>Bullet Points Only</option>
                            <option value="mixed" @selected((old('ai_response_format', $settings['ai_response_format'] ?? 'mixed')) === 'mixed')>Mixed (Bullets + Paragraphs)</option>
                            <option value="paragraphs" @selected((old('ai_response_format', $settings['ai_response_format'] ?? 'mixed')) === 'paragraphs')>Paragraphs Only</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8 mt-6">
                <h3 class="text-lg font-semibold text-forest-800 mb-1">Tone & Language</h3>
                <p class="text-sm text-forest-500 mb-6">Set the personality and language of responses.</p>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Response Tone</label>
                        <select name="ai_response_tone" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            <option value="professional" @selected((old('ai_response_tone', $settings['ai_response_tone'] ?? 'professional')) === 'professional')>Professional — Experienced, calm, trustworthy</option>
                            <option value="friendly" @selected((old('ai_response_tone', $settings['ai_response_tone'] ?? 'professional')) === 'friendly')>Friendly — Warm, approachable, conversational</option>
                            <option value="concise" @selected((old('ai_response_tone', $settings['ai_response_tone'] ?? 'professional')) === 'concise')>Concise — Direct, minimal, straight to the point</option>
                            <option value="detailed" @selected((old('ai_response_tone', $settings['ai_response_tone'] ?? 'professional')) === 'detailed')>Detailed — Thorough explanations with examples</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Response Language</label>
                        <select name="ai_response_language" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            <option value="en" @selected((old('ai_response_language', $settings['ai_response_language'] ?? 'en')) === 'en')>English</option>
                            <option value="bn" @selected((old('ai_response_language', $settings['ai_response_language'] ?? 'en')) === 'bn')>Bengali</option>
                            <option value="hi" @selected((old('ai_response_language', $settings['ai_response_language'] ?? 'en')) === 'hi')>Hindi</option>
                            <option value="es" @selected((old('ai_response_language', $settings['ai_response_language'] ?? 'en')) === 'es')>Spanish</option>
                            <option value="ar" @selected((old('ai_response_language', $settings['ai_response_language'] ?? 'en')) === 'ar')>Arabic</option>
                            <option value="zh" @selected((old('ai_response_language', $settings['ai_response_language'] ?? 'en')) === 'zh')>Chinese</option>
                        </select>
                        <p class="mt-1.5 text-xs text-forest-500">Note: Knowledge base content is primarily in English.</p>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-8 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all shadow-lg shadow-forest-700/20">Save Behavior Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
