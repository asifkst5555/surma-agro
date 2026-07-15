<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Surma Agro'))</title>
    <meta name="description" content="@yield('meta_description', 'Surma Agro - Premium agro-industrial export company based in Bangladesh, serving global markets with quality agricultural products.')">
    <meta name="keywords" content="@yield('meta_keywords', 'Surma Agro, agro export, Bangladesh export, rice, frozen fish, agricultural products, B2B agro')">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', '@yield(\'title\')')">
    <meta property="og:description" content="@yield('og_description', '@yield(\'meta_description\')')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="@yield('og_image', asset('storage/ai-images/factory/agro-factory-9RDBBpasnk.webp'))">
    <meta name="twitter:card" content="summary_large_image">
    <link rel="preconnect" href="https://player.vimeo.com">
    <script>
        document.documentElement.classList.add('js-enabled');
    </script>
    @stack('meta')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('schema')
</head>
<body class="font-sans antialiased bg-cream text-forest-900">
    <x-navbar />
    <main>
        @yield('content')
    </main>
    <x-footer />
    <x-chatbot />
    @stack('scripts')
</body>
</html>
