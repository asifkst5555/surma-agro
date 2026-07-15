@extends('admin.layouts.admin')

@section('title', 'Content Rules - Surma Agro Admin')
@section('header', 'AI Settings: Content Rules')

@section('content')
<div class="flex gap-8">
    @include('admin.ai-settings.partials.sidebar', ['active' => 'content-rules'])

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

        <form method="POST" action="{{ route('admin.ai-settings.update-content-rules') }}">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
                <h3 class="text-lg font-semibold text-forest-800 mb-1">Response Content</h3>
                <p class="text-sm text-forest-500 mb-6">Control what the AI includes in its answers.</p>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Include Page Links</label>
                        <select name="ai_include_page_links" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            <option value="1" @selected((old('ai_include_page_links', $settings['ai_include_page_links'] ?? '1')) === '1')>Yes — Suggest relevant Surma Agro pages</option>
                            <option value="0" @selected((old('ai_include_page_links', $settings['ai_include_page_links'] ?? '1')) === '0')>No — Answer without page suggestions</option>
                        </select>
                        <p class="mt-1.5 text-xs text-forest-500">When enabled, AI suggests pages like /catalog, /contact, /about, etc.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Show Web Search Sources</label>
                        <select name="ai_show_sources" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            <option value="1" @selected((old('ai_show_sources', $settings['ai_show_sources'] ?? '0')) === '1')>Yes — Show source links at end</option>
                            <option value="0" @selected((old('ai_show_sources', $settings['ai_show_sources'] ?? '0')) === '0')>No — Hide source links</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Stay Focused on Question</label>
                        <select name="ai_stay_focused" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            <option value="1" @selected((old('ai_stay_focused', $settings['ai_stay_focused'] ?? '1')) === '1')>Strict — Only answer exactly what's asked</option>
                            <option value="0" @selected((old('ai_stay_focused', $settings['ai_stay_focused'] ?? '1')) === '0')>Flexible — Can provide broader context</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8 mt-6">
                <h3 class="text-lg font-semibold text-forest-800 mb-1">Style Rules</h3>
                <p class="text-sm text-forest-500 mb-6">Control the writing style and examples used.</p>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Avoid AI-Style Phrases</label>
                        <select name="ai_avoid_ai_phrases" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            <option value="1" @selected((old('ai_avoid_ai_phrases', $settings['ai_avoid_ai_phrases'] ?? '1')) === '1')>Yes — Block "Absolutely", "Great question", etc.</option>
                            <option value="0" @selected((old('ai_avoid_ai_phrases', $settings['ai_avoid_ai_phrases'] ?? '1')) === '0')>No — Allow natural phrases</option>
                        </select>
                        <p class="mt-1.5 text-xs text-forest-500">Blocks robotic phrases to sound more human.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Use Real-World Examples</label>
                        <select name="ai_use_real_examples" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            <option value="1" @selected((old('ai_use_real_examples', $settings['ai_use_real_examples'] ?? '1')) === '1')>Yes — Include real-world examples and scenarios</option>
                            <option value="0" @selected((old('ai_use_real_examples', $settings['ai_use_real_examples'] ?? '1')) === '0')>No — Stick to factual info only</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Professional Disclaimer</label>
                        <select name="ai_professional_disclaimer" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            <option value="1" @selected((old('ai_professional_disclaimer', $settings['ai_professional_disclaimer'] ?? '1')) === '1')>Yes — Recommend professional consultation for specific needs</option>
                            <option value="0" @selected((old('ai_professional_disclaimer', $settings['ai_professional_disclaimer'] ?? '1')) === '0')>No — Answer directly without disclaimer</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8 mt-6">
                <h3 class="text-lg font-semibold text-forest-800 mb-1">Uncertainty Handling</h3>
                <p class="text-sm text-forest-500 mb-6">How the AI handles questions when it's not confident.</p>

                <div>
                    <label class="block text-sm font-medium text-forest-700 mb-2">When AI is uncertain</label>
                    <select name="ai_uncertainty_handling" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                        <option value="say_uncertain" @selected((old('ai_uncertainty_handling', $settings['ai_uncertainty_handling'] ?? 'say_uncertain')) === 'say_uncertain')>Say "I'm not certain" and skip</option>
                        <option value="recommend" @selected((old('ai_uncertainty_handling', $settings['ai_uncertainty_handling'] ?? 'say_uncertain')) === 'recommend')>Recommend checking with our team</option>
                        <option value="best_guess" @selected((old('ai_uncertainty_handling', $settings['ai_uncertainty_handling'] ?? 'say_uncertain')) === 'best_guess')>Provide best available information</option>
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-8 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all shadow-lg shadow-forest-700/20">Save Content Rules</button>
            </div>
        </form>
    </div>
</div>
@endsection
