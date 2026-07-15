@extends('admin.layouts.admin')

@section('title', 'Chat Appearance - Surma Agro Admin')
@section('header', 'AI Settings: Chat Appearance')

@section('content')
<div class="flex gap-8">
    @include('admin.ai-settings.partials.sidebar', ['active' => 'chat-appearance'])

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

        <form method="POST" action="{{ route('admin.ai-settings.update-chat-appearance') }}">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl border border-warm-gray/50 shadow-sm p-8">
                <h3 class="text-lg font-semibold text-forest-800 mb-1">Widget Settings</h3>
                <p class="text-sm text-forest-500 mb-6">Configure the chat widget visibility and display text.</p>

                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Enable AI assistant</label>
                        <select name="ai_assistant_enabled" class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none">
                            <option value="1" @selected((old('ai_assistant_enabled', $settings['ai_assistant_enabled'] ?? '1')) === '1')>Enabled — Show chat widget on website</option>
                            <option value="0" @selected((old('ai_assistant_enabled', $settings['ai_assistant_enabled'] ?? '1')) === '0')>Disabled — Hide chat widget</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Assistant title</label>
                        <input type="text" name="ai_assistant_title"
                               value="{{ old('ai_assistant_title', $settings['ai_assistant_title'] ?? 'Surma Agro AI Assistant') }}"
                               class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Assistant subtitle</label>
                        <input type="text" name="ai_assistant_subtitle"
                               value="{{ old('ai_assistant_subtitle', $settings['ai_assistant_subtitle'] ?? 'Online • Usually replies instantly') }}"
                               class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-forest-700 mb-2">Assistant greeting message</label>
                        <textarea name="ai_assistant_greeting" rows="4"
                                  class="w-full px-4 py-3 rounded-xl border border-warm-gray bg-cream text-forest-800 focus:ring-2 focus:ring-forest-500 focus:border-transparent outline-none resize-none" required>{{ old('ai_assistant_greeting', $settings['ai_assistant_greeting'] ?? "👋 Welcome to Surma Agro! I'm your AI Assistant.\n\nI can help you with:\n\n🌾 Products\n🚚 Delivery\n💳 Payment\n📦 Orders\n📞 Contact\n💬 General Questions") }}</textarea>
                        <p class="mt-1.5 text-xs text-forest-500">This message appears when the user first opens the chat.</p>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="px-8 py-3 bg-forest-700 text-white font-semibold rounded-xl hover:bg-forest-600 transition-all shadow-lg shadow-forest-700/20">Save Appearance Settings</button>
            </div>
        </form>
    </div>
</div>
@endsection
