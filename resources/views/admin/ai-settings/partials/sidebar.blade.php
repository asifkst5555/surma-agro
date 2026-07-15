<aside class="w-56 flex-shrink-0">
    <nav class="space-y-1">
        <a href="{{ route('admin.ai-settings.api-connection') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all
                  {{ $active === 'api-connection' ? 'bg-forest-700 text-white shadow-sm' : 'text-forest-600 hover:bg-forest-50 hover:text-forest-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            <span>API Connection</span>
        </a>
        <a href="{{ route('admin.ai-settings.chat-appearance') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all
                  {{ $active === 'chat-appearance' ? 'bg-forest-700 text-white shadow-sm' : 'text-forest-600 hover:bg-forest-50 hover:text-forest-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
            <span>Chat Appearance</span>
        </a>
        <a href="{{ route('admin.ai-settings.response-behavior') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all
                  {{ $active === 'response-behavior' ? 'bg-forest-700 text-white shadow-sm' : 'text-forest-600 hover:bg-forest-50 hover:text-forest-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
            <span>Response Behavior</span>
        </a>
        <a href="{{ route('admin.ai-settings.content-rules') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all
                  {{ $active === 'content-rules' ? 'bg-forest-700 text-white shadow-sm' : 'text-forest-600 hover:bg-forest-50 hover:text-forest-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <span>Content Rules</span>
        </a>
        <a href="{{ route('admin.ai-settings.custom-prompts') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all
                  {{ $active === 'custom-prompts' ? 'bg-forest-700 text-white shadow-sm' : 'text-forest-600 hover:bg-forest-50 hover:text-forest-800' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            <span>Custom Prompts</span>
        </a>
    </nav>
</aside>
