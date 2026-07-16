@php
    use App\Models\Setting;
    $enabled = Setting::getValue('ai_assistant_enabled', '1');
    $title = Setting::getValue('ai_assistant_title', 'AI Assistant');
    $subtitle = Setting::getValue('ai_assistant_subtitle', 'Online • Usually replies instantly');
    $greeting = Setting::getValue('ai_assistant_greeting', "👋 Welcome to Surma Agro! How can I help you today? Ask me anything about our premium agricultural exports.");
@endphp

@if($enabled === '1')
<!-- Dedicated Outermost Widget Container (Does not affect page layout, pointer-events: none) -->
<div class="surma-chat-widget-root">

    <!-- Speech bubble (Drift/Intercom style, pointer-events: auto) -->
    <div class="surma-chat-bubble" data-chat-bubble>
        <div class="surma-chat-bubble-header">
            <span class="surma-chat-bubble-title">Need Help?</span>
        </div>
        <div class="surma-chat-bubble-body">
            Ask our AI Assistant
        </div>
    </div>

    <!-- Interaction Wrapper for Hover Scale and Click Bounce -->
    <div id="ai-chat-widget-interaction-wrapper">
        <!-- Dedicated Fixed Wrapper for Lottie Robot -->
        <div id="ai-chat-widget">
            <button class="surma-chat-toggle" type="button" data-chat-toggle aria-expanded="false" aria-controls="surma-chat-panel" aria-label="Open AI Assistant">
                <div id="surma-lottie-container"></div>
                <div id="surma-lottie-fallback" class="hidden">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 8V4H8" />
                        <rect width="16" height="12" x="4" y="8" rx="2" />
                        <path d="M9 13h.01" />
                        <path d="M15 13h.01" />
                        <path d="M10 16h4" />
                    </svg>
                </div>
            </button>
        </div>
    </div>
    
    <!-- Chat Window Panel (Positioned next to the toggle button, pointer-events: auto) -->
    <div
        id="surma-chat-panel"
        class="surma-chat-panel"
        data-chat-panel
        data-chat-greeting="{{ $greeting }}"
        hidden
    >
        <div class="surma-chat-head">
            <div class="surma-chat-head-main">
                <div class="surma-chat-head-brand">
                    <div class="surma-chat-head-avatar-container">
                        <div id="surma-lottie-head-container"></div>
                        <div id="surma-lottie-head-fallback" class="hidden">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 8V4H8" />
                                <rect width="16" height="12" x="4" y="8" rx="2" />
                                <path d="M9 13h.01" />
                                <path d="M15 13h.01" />
                                <path d="M10 16h4" />
                            </svg>
                        </div>
                    </div>
                    <div>
                        <h2 class="surma-chat-title">{{ $title }}</h2>
                        <div class="surma-chat-subtitle-wrapper">
                            <span class="surma-chat-online-dot"></span>
                            <span class="surma-chat-sub">{{ $subtitle }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="surma-chat-head-actions">
                <button class="surma-chat-btn surma-chat-btn--clear" type="button" data-chat-reset aria-label="Clear conversation" title="Clear conversation">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2"/></svg>
                </button>
                <button class="surma-chat-btn surma-chat-btn--icon" type="button" data-chat-minimize aria-label="Minimize chat" title="Minimize">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 8h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
                <button class="surma-chat-btn surma-chat-btn--icon surma-chat-btn--close" type="button" data-chat-close aria-label="Close chat" title="Close">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M4 4l8 8M12 4l-8 8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
            </div>
        </div>
        <div class="surma-chat-log" data-chat-log role="log" aria-live="polite" aria-label="Chat conversation history"></div>
        <div class="surma-chat-confirm" data-chat-confirm hidden>
            <div class="surma-chat-confirm-text">Clear all messages?</div>
            <div class="surma-chat-confirm-actions">
                <button type="button" class="surma-chat-confirm-btn surma-chat-confirm-btn--cancel" data-chat-confirm-cancel>Cancel</button>
                <button type="button" class="surma-chat-confirm-btn surma-chat-confirm-btn--ok" data-chat-confirm-ok>Clear</button>
            </div>
        </div>
        <form class="surma-chat-form" data-chat-form>
            <div class="surma-chat-input-wrapper">
                <textarea class="surma-chat-input" name="message" data-chat-input rows="1" maxlength="1800" placeholder="Ask anything..." required autocomplete="off" aria-label="Write a message to the AI assistant"></textarea>
                <button class="surma-chat-send" type="submit" aria-label="Send message">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                </button>
            </div>
        </form>
    </div>
</div>
@endif
