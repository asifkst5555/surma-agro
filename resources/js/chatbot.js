/**
 * ==========================================================================
 * Surma Agro AI Chatbot Widget (Modular Frontend Logic)
 * Features: Lazy-loaded Lottie animations, 60fps native rendering,
 *           Tab inactive pauses, Escape & Click-Outside Close, Mobile Safe Areas.
 * ==========================================================================
 */

const SURMA_CHAT_KEY = 'surmaAgroChatConversationId';
const SURMA_VISITOR_KEY = 'surmaAgroChatVisitorId';

let surmaChatPanel = null;
let surmaChatToggle = null;
let surmaChatClose = null;
let surmaChatMinimize = null;
let surmaChatLog = null;
let surmaChatForm = null;
let surmaChatInput = null;
let surmaChatSend = null;
let surmaConversationId = window.localStorage.getItem(SURMA_CHAT_KEY) || '';
let surmaHasLoaded = false;
let surmaIsSubmitting = false;
let surmaThinkingEl = null;
let surmaChatConfirm = null;
let surmaPendingReset = false;

// Cached DOM references
let surmaChatBubble = null;
let surmaChatInteractionWrapper = null;

// Lottie Animation State
let lottieLib = null;
let chatAnimationData = null;
let mainLottieInstance = null;
let headLottieInstance = null;
let welcomeLottieInstance = null;

// Speech Bubble State Loops
let bubbleTimer = null;
let bubbleHideTimeout = null;

/**
 * Lazy loads the official lottie-web library dynamically to avoid blocking page parsing.
 */
async function surmaLoadLottieLib() {
    if (!lottieLib) {
        const module = await import('lottie-web');
        lottieLib = module.default || module;
    }
    return lottieLib;
}

/**
 * Fetches and parses the chat.json file once, caching the result in memory.
 */
async function surmaFetchAnimationData() {
    if (!chatAnimationData) {
        const resp = await fetch('/storage/logos/chat.json');
        if (!resp.ok) {
            throw new Error('Lottie file failed to fetch.');
        }
        chatAnimationData = await resp.json();
    }
    return chatAnimationData;
}

/**
 * Initializes the Lottie animation for the floating button toggle and header avatar.
 */
async function surmaInitLottie() {
    const mainContainer = document.getElementById('surma-lottie-container');
    const mainFallback = document.getElementById('surma-lottie-fallback');
    const headContainer = document.getElementById('surma-lottie-head-container');
    const headFallback = document.getElementById('surma-lottie-head-fallback');

    try {
        const lib = await surmaLoadLottieLib();
        const animData = await surmaFetchAnimationData();

        // 1. Floating Toggle Button Lottie
        if (mainContainer) {
            mainLottieInstance = lib.loadAnimation({
                container: mainContainer,
                renderer: 'svg',
                loop: true,
                autoplay: true,
                animationData: animData,
                rendererSettings: {
                    clearCanvas: true,
                    progressiveLoad: true,
                    hideOnTransparentPlay: true
                }
            });
            mainLottieInstance.addEventListener('data_failed', () => surmaShowFallback(mainContainer, mainFallback));
            mainLottieInstance.addEventListener('error', () => surmaShowFallback(mainContainer, mainFallback));
        }

        // 2. Chat Head Avatar Lottie
        if (headContainer) {
            headLottieInstance = lib.loadAnimation({
                container: headContainer,
                renderer: 'svg',
                loop: true,
                autoplay: true,
                animationData: animData,
                rendererSettings: {
                    clearCanvas: true,
                    progressiveLoad: true
                }
            });
            headLottieInstance.addEventListener('data_failed', () => surmaShowFallback(headContainer, headFallback));
            headLottieInstance.addEventListener('error', () => surmaShowFallback(headContainer, headFallback));
        }
    } catch (err) {
        console.error('Lottie initialization failed, showing SVG fallback:', err);
        surmaShowFallback(mainContainer, mainFallback);
        surmaShowFallback(headContainer, headFallback);
    }
}

/**
 * Initializes the Lottie avatar inside the greeting card dynamically after layout rendering.
 */
async function surmaInitWelcomeLottie() {
    const welcomeContainer = document.getElementById('surma-lottie-welcome-container');
    if (!welcomeContainer) return;

    try {
        const lib = await surmaLoadLottieLib();
        const animData = await surmaFetchAnimationData();
        welcomeLottieInstance = lib.loadAnimation({
            container: welcomeContainer,
            renderer: 'svg',
            loop: true,
            autoplay: true,
            animationData: animData,
            rendererSettings: {
                clearCanvas: true,
                progressiveLoad: true
            }
        });
    } catch {
        // Default avatar fallback
        welcomeContainer.innerHTML = `
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #00a693;">
                <path d="M12 8V4H8" />
                <rect width="16" height="12" x="4" y="8" rx="2" />
                <path d="M9 13h.01" />
                <path d="M15 13h.01" />
                <path d="M10 16h4" />
            </svg>
        `;
    }
}

/**
 * Pauses/resumes Lottie animations depending on the window play state to save compute.
 */
function surmaSetAnimationsPlayState(playing) {
    if (playing) {
        mainLottieInstance?.play();
        headLottieInstance?.play();
        welcomeLottieInstance?.play();
    } else {
        mainLottieInstance?.pause();
        headLottieInstance?.pause();
        welcomeLottieInstance?.pause();
    }
}

/**
 * Starts the speech bubble repeat loop. Runs every 12-15 seconds.
 */
function surmaStartBubbleLoop() {
    surmaStopBubbleLoop();
    
    // Initial delay before showing bubble (e.g. 3s on reload)
    bubbleTimer = setTimeout(function showSequence() {
        surmaShowBubble();
        
        // Hide bubble after 5 seconds of active displaying
        bubbleHideTimeout = setTimeout(() => {
            surmaHideBubble();
            
            // Wait 10 seconds before starting next display sequence (total loop cycle of 15 seconds)
            bubbleTimer = setTimeout(showSequence, 10000);
        }, 5000);
    }, 3000);
}

/**
 * Stops and clears all speech bubble loops, removing visibility.
 */
function surmaStopBubbleLoop() {
    clearTimeout(bubbleTimer);
    clearTimeout(bubbleHideTimeout);
    surmaHideBubble();
}

function surmaShowBubble() {
    if (surmaChatBubble && (!surmaChatPanel || surmaChatPanel.hidden || !surmaChatPanel.classList.contains('is-open'))) {
        surmaChatBubble.classList.add('is-visible');
    }
}

function surmaHideBubble() {
    if (surmaChatBubble) {
        surmaChatBubble.classList.remove('is-visible');
    }
}

/**
 * Triggers a quick scale-bounce micro-animation on widget click.
 */
function surmaTriggerClickBounce() {
    if (surmaChatInteractionWrapper) {
        surmaChatInteractionWrapper.classList.remove('is-clicked');
        // Force reflow
        void surmaChatInteractionWrapper.offsetWidth;
        surmaChatInteractionWrapper.classList.add('is-clicked');
        setTimeout(() => {
            surmaChatInteractionWrapper.classList.remove('is-clicked');
        }, 400);
    }
}

function surmaGetVisitorId() {
    let id = window.localStorage.getItem(SURMA_VISITOR_KEY);
    if (!id) {
        id = window.crypto?.randomUUID
            ? window.crypto.randomUUID()
            : `visitor-${Date.now()}-${Math.random().toString(16).slice(2)}`;
        window.localStorage.setItem(SURMA_VISITOR_KEY, id);
    }
    return id;
}

function surmaScrollToBottom() {
    if (surmaChatLog) {
        surmaChatLog.scrollTop = surmaChatLog.scrollHeight;
    }
}

let surmaViewportTicking = false;
function surmaUpdateVisualViewport() {
    const height = window.visualViewport ? window.visualViewport.height : window.innerHeight;
    const offsetTop = window.visualViewport ? window.visualViewport.offsetTop : 0;
    
    if (surmaViewportTicking) return;
    
    surmaViewportTicking = true;
    requestAnimationFrame(() => {
        document.documentElement.style.setProperty('--visual-viewport-height', `${height}px`);
        document.documentElement.style.setProperty('--visual-viewport-offsetTop', `${offsetTop}px`);
        
        surmaScrollToBottom();
        surmaViewportTicking = false;
    });
}

function surmaAdjustInputHeight() {
    if (!surmaChatInput) return;
    surmaChatInput.style.height = 'auto';
    surmaChatInput.style.height = `${surmaChatInput.scrollHeight}px`;
}

function surmaAttachViewportListeners() {
    if (window.visualViewport) {
        window.visualViewport.addEventListener('resize', surmaUpdateVisualViewport);
        window.visualViewport.addEventListener('scroll', surmaUpdateVisualViewport);
    } else {
        window.addEventListener('resize', surmaUpdateVisualViewport);
    }
    window.addEventListener('orientationchange', surmaUpdateVisualViewport);
}

function surmaDetachViewportListeners() {
    if (window.visualViewport) {
        window.visualViewport.removeEventListener('resize', surmaUpdateVisualViewport);
        window.visualViewport.removeEventListener('scroll', surmaUpdateVisualViewport);
    } else {
        window.removeEventListener('resize', surmaUpdateVisualViewport);
    }
    window.removeEventListener('orientationchange', surmaUpdateVisualViewport);
}

function surmaRemoveThinking() {
    if (surmaThinkingEl) {
        surmaThinkingEl.remove();
        surmaThinkingEl = null;
    }
}

function surmaShowFallback(container, fallback) {
    if (container) container.classList.add('hidden');
    if (fallback) fallback.classList.remove('hidden');
}

function surmaStripThinkBlocks(text) {
    return text
        .replace(/<think>[\s\S]*?<\/think>/g, '')
        .replace(/<thinking>[\s\S]*?<\/thinking>/g, '')
        .replace(/<reasoning>[\s\S]*?<\/reasoning>/g, '')
        .replace(/\[thinking\][\s\S]*?\[\/thinking\]/g, '')
        .replace(/\[reasoning\][\s\S]*?\[\/reasoning\]/g, '')
        .replace(/\[INST\][\s\S]*?\[\/INST\]/g, '')
        .replace(/```think[\s\S]*?```/g, '')
        .replace(/\n{3,}/g, '\n\n')
        .trim();
}

function surmaEscapeHtml(text) {
    if (!text) return '';
    return text
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function surmaAppendMessage(role, content) {
    if (!surmaChatLog || !content) return;
    const msg = document.createElement('div');
    msg.className = `surma-chat-msg ${role === 'user' ? 'user' : role === 'assistant' ? 'bot' : 'system'}`;
    const escaped = surmaEscapeHtml(content);
    const cleaned = role !== 'user' ? surmaStripThinkBlocks(escaped) : escaped;
    const formatted = cleaned
        .replace(/(https?:\/\/[^\s<]+)/g, '<a href="$1" target="_blank" rel="noopener" class="surma-chat-link">$1</a>')
        .replace(/\n/g, '<br>');
    msg.innerHTML = formatted;
    surmaChatLog.appendChild(msg);
    surmaScrollToBottom();
}

function surmaAppendThinking() {
    if (!surmaChatLog) return;
    surmaRemoveThinking();
    const msg = document.createElement('div');
    msg.className = 'surma-chat-msg bot thinking';
    msg.innerHTML = `
        <div class="surma-chat-thinking-title">AI is thinking</div>
        <div class="surma-chat-thinking-copy">Planning the best answer for your question.</div>
        <div class="surma-chat-thinking-dots" aria-hidden="true">
            <span></span><span></span><span></span>
        </div>
    `;
    surmaChatLog.appendChild(msg);
    surmaThinkingEl = msg;
    surmaScrollToBottom();
}

function surmaRenderGreeting() {
    if (!surmaChatLog || surmaChatLog.childElementCount > 0) return;

    const msg = document.createElement('div');
    msg.className = 'surma-chat-msg bot welcome-card';

    msg.innerHTML = `
        <div class="surma-chat-welcome-header">
            <div id="surma-lottie-welcome-container" style="width: 34px; height: 34px;"></div>
            <div>
                <div class="surma-chat-welcome-name">Surma Agro AI Assistant</div>
                <div class="surma-chat-welcome-status">Online • Ready to help</div>
            </div>
        </div>
        <div class="surma-chat-welcome-text">👋 Welcome to Surma Agro! How can I help you today? Ask me anything about our premium agricultural exports.</div>
        
        <div class="surma-chat-welcome-section">Suggested Questions</div>
        <div class="surma-chat-welcome-chips">
            <button type="button" class="surma-chat-welcome-chip" data-suggestion="What products do you sell?">🌾 What products do you sell?</button>
            <button type="button" class="surma-chat-welcome-chip" data-suggestion="Do you export internationally?">🌍 Do you export internationally?</button>
            <button type="button" class="surma-chat-welcome-chip" data-suggestion="How can I contact sales?">📞 How can I contact sales?</button>
        </div>
    `;

    surmaChatLog.appendChild(msg);
    surmaScrollToBottom();

    // Trigger dynamic avatar rendering inside card
    surmaInitWelcomeLottie();
}

function surmaRemoveFirstMessage() {
    const first = surmaChatLog?.firstElementChild;
    if (first && first.classList.contains('welcome-card')) {
        first.remove();
    }
}

function surmaSetBusy(busy) {
    surmaIsSubmitting = busy;
    if (surmaChatInput) surmaChatInput.disabled = busy;
    if (surmaChatSend) {
        surmaChatSend.disabled = busy;
        surmaChatSend.innerHTML = busy
            ? '<span class="surma-btn-loading"></span>'
            : '<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>';
    }
    if (!busy && surmaChatInput) surmaChatInput.focus();
}

async function surmaRequestJson(url, options = {}) {
    const resp = await fetch(url, {
        ...options,
        headers: {
            Accept: 'application/json',
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            ...(options.headers || {}),
        },
    });
    const text = await resp.text();
    let payload = {};
    if (text) {
        try { payload = JSON.parse(text); } catch { payload = { message: 'Unexpected response.' }; }
    }
    if (!resp.ok) {
        const err = payload.message || (payload.errors ? Object.values(payload.errors).flat()[0] : null) || 'Something went wrong. Please try again.';
        throw new Error(err);
    }
    return payload;
}

async function surmaCreateSession(isReset = false) {
    const body = {
        channel: 'website_widget',
        visitor_id: surmaGetVisitorId(),
        language: 'en',
    };
    if (isReset && surmaConversationId) body.conversation_id = surmaConversationId;
    const ep = isReset ? '/api/chat/reset' : '/api/chat/session';
    const data = await surmaRequestJson(ep, { method: 'POST', body: JSON.stringify(body) });
    surmaConversationId = data.conversation_id || '';
    if (surmaConversationId) window.localStorage.setItem(SURMA_CHAT_KEY, surmaConversationId);
    return surmaConversationId;
}

async function surmaLoadHistory() {
    if (!surmaChatLog) return;
    if (!surmaConversationId) {
        surmaRenderGreeting();
        surmaHasLoaded = true;
        return;
    }
    try {
        const data = await surmaRequestJson(`/api/chat/history/${surmaConversationId}`);
        surmaChatLog.innerHTML = '';
        surmaRemoveThinking();
        const messages = data.messages || [];
        if (messages.length === 0) {
            surmaRenderGreeting();
        } else {
            messages.forEach(m => {
                surmaAppendMessage(m.role === 'assistant' ? 'assistant' : 'user', m.content || '');
            });
        }
        surmaHasLoaded = true;
    } catch {
        window.localStorage.removeItem(SURMA_CHAT_KEY);
        surmaConversationId = '';
        surmaChatLog.innerHTML = '';
        surmaRemoveThinking();
        surmaRenderGreeting();
        surmaHasLoaded = true;
    }
}

async function surmaEnsureReady() {
    if (surmaHasLoaded) return;
    await surmaLoadHistory();
}

function surmaShowConfirm() {
    if (!surmaChatConfirm) return;
    surmaChatConfirm.hidden = false;
    surmaPendingReset = true;
}

function surmaHideConfirm() {
    if (!surmaChatConfirm) return;
    surmaChatConfirm.hidden = true;
    surmaPendingReset = false;
}

async function surmaHandleReset() {
    if (!surmaChatLog) return;
    surmaHideConfirm();
    surmaChatLog.innerHTML = '';
    surmaRemoveThinking();
    try {
        await surmaCreateSession(true);
    } catch {
        window.localStorage.removeItem(SURMA_CHAT_KEY);
        surmaConversationId = '';
    }
    surmaHasLoaded = true;
    surmaRenderGreeting();
}

async function surmaSubmitMessage() {
    if (!surmaChatInput || surmaIsSubmitting) return;
    const content = surmaChatInput.value.trim();
    if (!content) return;
    surmaRemoveFirstMessage();
    surmaAppendMessage('user', content);
    surmaChatInput.value = '';
    surmaAdjustInputHeight();
    surmaRemoveThinking();
    surmaAppendThinking();
    surmaSetBusy(true);
    try {
        if (!surmaConversationId) await surmaCreateSession();
        const data = await surmaRequestJson(`/api/chat/message/${surmaConversationId}`, {
            method: 'POST',
            body: JSON.stringify({ content }),
        });
        surmaRemoveThinking();
        const reply = data.assistant?.content || 'I am here, but I could not generate a reply just now.';
        surmaAppendMessage('assistant', reply);
    } catch (err) {
        surmaRemoveThinking();
        surmaAppendMessage('system', err.message || 'Sorry, the AI assistant is unavailable right now.');
    } finally {
        surmaHasLoaded = true;
        surmaSetBusy(false);
    }
}

async function surmaOpenPanel() {
    if (!surmaChatPanel) return;
    
    // Stop and hide the speech bubble immediately when chat opens
    surmaStopBubbleLoop();
    
    document.body.classList.add('surma-chat-open');
    surmaAttachViewportListeners();
    surmaUpdateVisualViewport();
    surmaChatPanel.hidden = false;
    requestAnimationFrame(() => {
        surmaChatPanel.classList.add('is-open');
    });
    if (surmaChatToggle) surmaChatToggle.setAttribute('aria-expanded', 'true');
    await surmaEnsureReady();
    if (surmaChatInput) setTimeout(() => surmaChatInput.focus(), 250);
}

function surmaClosePanel() {
    if (!surmaChatPanel) return;
    document.body.classList.remove('surma-chat-open');
    surmaDetachViewportListeners();
    surmaChatPanel.classList.remove('is-open');
    if (surmaChatToggle) surmaChatToggle.setAttribute('aria-expanded', 'false');
    
    const onTransitionEnd = (e) => {
        if (e.propertyName === 'opacity' || e.propertyName === 'transform') {
            if (!surmaChatPanel.classList.contains('is-open')) {
                surmaChatPanel.hidden = true;
                // Wait 2-3 seconds after closing before starting the bubble loop again
                setTimeout(() => {
                    if (surmaChatPanel.hidden) {
                        surmaStartBubbleLoop();
                    }
                }, 2500);
            }
            surmaChatPanel.removeEventListener('transitionend', onTransitionEnd);
        }
    };
    surmaChatPanel.addEventListener('transitionend', onTransitionEnd);
    
    setTimeout(() => {
        if (!surmaChatPanel.classList.contains('is-open')) {
            surmaChatPanel.hidden = true;
            setTimeout(() => {
                if (surmaChatPanel.hidden) {
                    surmaStartBubbleLoop();
                }
            }, 2500);
        }
    }, 280);
}

function surmaMinimizePanel() {
    surmaClosePanel();
}

function surmaHandleSuggestion(text) {
    if (surmaChatInput) {
        surmaChatInput.value = text;
        surmaAdjustInputHeight();
        surmaSubmitMessage();
    }
}

function surmaHandleQuickAction(action) {
    const map = {
        products: 'Show me your product catalog',
        track: 'How can I track my order?',
        sales: 'I want to talk to the sales team',
        pricing: 'Tell me about your pricing',
        contact: 'How can I contact Surma Agro?',
    };
    const msg = map[action] || '';
    if (msg && surmaChatInput) {
        surmaChatInput.value = msg;
        surmaAdjustInputHeight();
        surmaSubmitMessage();
    }
}

export function initSurmaChat() {
    surmaChatPanel = document.querySelector('[data-chat-panel]');
    surmaChatToggle = document.querySelector('[data-chat-toggle]');
    surmaChatClose = document.querySelector('[data-chat-close]');
    surmaChatMinimize = document.querySelector('[data-chat-minimize]');
    surmaChatLog = surmaChatPanel?.querySelector('[data-chat-log]') || null;
    surmaChatForm = surmaChatPanel?.querySelector('[data-chat-form]') || null;
    surmaChatInput = surmaChatPanel?.querySelector('[data-chat-input]') || null;
    surmaChatSend = surmaChatForm?.querySelector('button[type="submit"]') || null;

    // Cached DOM lookup definitions
    surmaChatBubble = document.querySelector('[data-chat-bubble]');
    surmaChatInteractionWrapper = document.getElementById('ai-chat-widget-interaction-wrapper');

    surmaConversationId = window.localStorage.getItem(SURMA_CHAT_KEY) || '';

    // Initialize Lottie assets asynchronously
    surmaInitLottie();

    // Start the speech bubble loop
    surmaStartBubbleLoop();

    // Toggle click trigger (First click -> Open, Second click -> Close)
    surmaChatToggle?.addEventListener('click', (e) => {
        e.stopPropagation();
        surmaTriggerClickBounce();
        if (!surmaChatPanel) return;
        if (surmaChatPanel.hidden || !surmaChatPanel.classList.contains('is-open')) {
            surmaOpenPanel();
        } else {
            surmaClosePanel();
        }
    });

    // Clicking the speech bubble also opens the panel and stops the loop
    surmaChatBubble?.addEventListener('click', (e) => {
        e.stopPropagation();
        surmaTriggerClickBounce();
        surmaOpenPanel();
    });

    surmaChatClose?.addEventListener('click', surmaClosePanel);
    surmaChatMinimize?.addEventListener('click', surmaMinimizePanel);

    surmaChatConfirm = surmaChatPanel?.querySelector('[data-chat-confirm]') || null;
    const surmaChatReset = document.querySelector('[data-chat-reset]');
    surmaChatReset?.addEventListener('click', () => {
        if (!surmaChatLog || surmaChatLog.childElementCount === 0) {
            surmaHandleReset();
            return;
        }
        surmaShowConfirm();
    });

    surmaChatPanel?.querySelector('[data-chat-confirm-ok]')?.addEventListener('click', surmaHandleReset);
    surmaChatPanel?.querySelector('[data-chat-confirm-cancel]')?.addEventListener('click', surmaHideConfirm);

    // Form submit
    surmaChatForm?.addEventListener('submit', e => {
        e.preventDefault();
        surmaSubmitMessage();
    });

    surmaChatInput?.addEventListener('input', surmaAdjustInputHeight);

    // Viewport listeners are dynamically attached on open and detached on close to prevent memory leaks.

    // Event delegation for suggested question chips
    surmaChatLog?.addEventListener('click', e => {
        const suggestionBtn = e.target.closest('[data-suggestion]');
        if (suggestionBtn) {
            surmaHandleSuggestion(suggestionBtn.dataset.suggestion);
            return;
        }
        const actionBtn = e.target.closest('[data-action]');
        if (actionBtn) {
            surmaHandleQuickAction(actionBtn.dataset.action);
        }
    });

    // Keyboard controls: Enter sends message, Esc closes panel
    surmaChatInput?.addEventListener('keydown', e => {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            surmaSubmitMessage();
        }
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') {
            surmaClosePanel();
        }
    });

    // Click outside handler: Closes the panel if user clicks anywhere outside of it
    document.addEventListener('click', e => {
        if (!surmaChatPanel || surmaChatPanel.hidden || !surmaChatPanel.classList.contains('is-open')) return;
        const clickedInsidePanel = surmaChatPanel.contains(e.target);
        const clickedToggle = surmaChatToggle?.contains(e.target);
        if (!clickedInsidePanel && !clickedToggle) {
            surmaClosePanel();
        }
    });

    // Handle play state pause when browser tab is inactive to minimize memory consumption
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            surmaSetAnimationsPlayState(false);
            surmaStopBubbleLoop();
        } else {
            surmaSetAnimationsPlayState(true);
            if (surmaChatPanel && surmaChatPanel.hidden) {
                surmaStartBubbleLoop();
            }
        }
    });
}
