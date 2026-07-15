<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AiSettingController extends Controller
{
    private function getSettings(): array
    {
        $all = Setting::all()->keyBy('key')->map->value->toArray();
        return array_merge([
            'ai_assistant_enabled' => '1',
            'ai_assistant_title' => 'Surma Agro AI Assistant',
            'ai_assistant_subtitle' => 'Online • Usually replies instantly',
            'ai_assistant_greeting' => "👋 Welcome to Surma Agro! I'm your AI Assistant.\n\nI can help you with:\n\n🌾 Products\n🚚 Delivery\n💳 Payment\n📦 Orders\n📞 Contact\n💬 General Questions",
            'ai_openai_base_url' => 'https://api.groq.com/openai/v1',
            'ai_openai_api_key' => '',
            'ai_openai_model' => 'qwen/qwen3-32b',
            'ai_web_search_enabled' => '0',
            'ai_max_bullets' => '5',
            'ai_max_length' => '900',
            'ai_response_format' => 'mixed',
            'ai_response_tone' => 'professional',
            'ai_response_language' => 'en',
            'ai_include_page_links' => '1',
            'ai_show_sources' => '0',
            'ai_stay_focused' => '1',
            'ai_avoid_ai_phrases' => '1',
            'ai_use_real_examples' => '1',
            'ai_professional_disclaimer' => '1',
            'ai_uncertainty_handling' => 'say_uncertain',
            'ai_follow_up_phrase' => 'Let me know if you need more details about any of our products or services.',
            'ai_closing_phrase' => '',
            'ai_assistant_system_prompt' => '',
        ], $all);
    }

    private function saveSettings(Request $request, array $keys): void
    {
        foreach ($keys as $key) {
            if ($request->has($key)) {
                $value = $request->input($key);
                if (is_bool($value)) {
                    $value = $value ? '1' : '0';
                }
                Setting::updateOrCreate(
                    ['key' => $key],
                    ['value' => (string) $value],
                );
            }
        }
    }

    public function apiConnection(): View
    {
        $settings = $this->getSettings();
        return view('admin.ai-settings.api-connection', [
            'settings' => $settings,
            'hasAiApiKey' => filled($settings['ai_openai_api_key'] ?? ''),
        ]);
    }

    public function updateApiConnection(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ai_openai_base_url' => ['required', 'string', 'max:255'],
            'ai_openai_api_key' => ['nullable', 'string', 'max:255'],
            'ai_openai_model' => ['required', 'string', 'max:120'],
            'ai_web_search_enabled' => ['nullable', 'in:0,1'],
            'ai_openai_api_key_clear' => ['nullable', 'in:0,1'],
        ]);

        $existingApiKey = Setting::getValue('ai_openai_api_key', '');
        $submittedApiKey = trim((string) ($validated['ai_openai_api_key'] ?? ''));
        $clearApiKey = $request->boolean('ai_openai_api_key_clear');

        if ($clearApiKey) {
            $validated['ai_openai_api_key'] = '';
        } elseif ($submittedApiKey === '' && filled($existingApiKey)) {
            $validated['ai_openai_api_key'] = $existingApiKey;
        } else {
            $validated['ai_openai_api_key'] = $submittedApiKey;
        }

        $this->saveSettings($request, [
            'ai_openai_base_url',
            'ai_openai_api_key',
            'ai_openai_model',
            'ai_web_search_enabled',
        ]);

        Setting::where('key', 'ai_openai_api_key')->update(['value' => $validated['ai_openai_api_key']]);

        return back()->with('success', 'API connection settings saved successfully.');
    }

    public function chatAppearance(): View
    {
        return view('admin.ai-settings.chat-appearance', [
            'settings' => $this->getSettings(),
        ]);
    }

    public function updateChatAppearance(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ai_assistant_enabled' => ['nullable', 'in:0,1'],
            'ai_assistant_title' => ['required', 'string', 'max:120'],
            'ai_assistant_subtitle' => ['required', 'string', 'max:255'],
            'ai_assistant_greeting' => ['required', 'string', 'max:1000'],
        ]);

        $this->saveSettings($request, [
            'ai_assistant_enabled',
            'ai_assistant_title',
            'ai_assistant_subtitle',
            'ai_assistant_greeting',
        ]);

        return back()->with('success', 'Chat appearance settings saved successfully.');
    }

    public function responseBehavior(): View
    {
        return view('admin.ai-settings.response-behavior', [
            'settings' => $this->getSettings(),
        ]);
    }

    public function updateResponseBehavior(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ai_max_bullets' => ['nullable', 'integer', 'min:1', 'max:10'],
            'ai_max_length' => ['nullable', 'integer', 'min:200', 'max:2000'],
            'ai_response_tone' => ['nullable', 'in:professional,friendly,concise,detailed'],
            'ai_response_format' => ['nullable', 'in:bullets,mixed,paragraphs'],
            'ai_response_language' => ['nullable', 'in:en,hi,es,ar,zh,bn'],
        ]);

        $this->saveSettings($request, [
            'ai_max_bullets',
            'ai_max_length',
            'ai_response_tone',
            'ai_response_format',
            'ai_response_language',
        ]);

        return back()->with('success', 'Response behavior settings saved successfully.');
    }

    public function contentRules(): View
    {
        return view('admin.ai-settings.content-rules', [
            'settings' => $this->getSettings(),
        ]);
    }

    public function updateContentRules(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ai_include_page_links' => ['nullable', 'in:0,1'],
            'ai_show_sources' => ['nullable', 'in:0,1'],
            'ai_stay_focused' => ['nullable', 'in:0,1'],
            'ai_avoid_ai_phrases' => ['nullable', 'in:0,1'],
            'ai_use_real_examples' => ['nullable', 'in:0,1'],
            'ai_professional_disclaimer' => ['nullable', 'in:0,1'],
            'ai_uncertainty_handling' => ['nullable', 'in:say_uncertain,recommend,best_guess'],
        ]);

        $this->saveSettings($request, [
            'ai_include_page_links',
            'ai_show_sources',
            'ai_stay_focused',
            'ai_avoid_ai_phrases',
            'ai_use_real_examples',
            'ai_professional_disclaimer',
            'ai_uncertainty_handling',
        ]);

        return back()->with('success', 'Content rules saved successfully.');
    }

    public function customPrompts(): View
    {
        return view('admin.ai-settings.custom-prompts', [
            'settings' => $this->getSettings(),
        ]);
    }

    public function updateCustomPrompts(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'ai_follow_up_phrase' => ['nullable', 'string', 'max:500'],
            'ai_closing_phrase' => ['nullable', 'string', 'max:500'],
            'ai_assistant_system_prompt' => ['nullable', 'string', 'max:10000'],
        ]);

        $this->saveSettings($request, [
            'ai_follow_up_phrase',
            'ai_closing_phrase',
            'ai_assistant_system_prompt',
        ]);

        return back()->with('success', 'Custom prompts saved successfully.');
    }
}
