@php
    $_saTitle = trim($__env->yieldContent('title')) ?: config('app.name', 'Surma Agro');
    $_saDesc = trim($__env->yieldContent('meta_description')) ?: 'Surma Agro - Premium agro-industrial export company based in Bangladesh, serving global markets with quality agricultural products.';
    $_saImage = trim($__env->yieldContent('og_image')) ?: asset('storage/logos/main_logo.webp');
    $_saUrl = url()->current();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0c251d">

    {{-- Favicon set --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">

    {{-- Primary meta --}}
    <title>{{ $_saTitle }}</title>
    <meta name="description" content="{{ $_saDesc }}">
    <meta name="keywords" content="@yield('meta_keywords', 'Surma Agro, agro export, Bangladesh export, rice, frozen fish, agricultural products, B2B agro')">

    {{-- Canonical --}}
    <link rel="canonical" href="{{ $_saUrl }}">

    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('og_title', $_saTitle)">
    <meta property="og:description" content="@yield('og_description', $_saDesc)">
    <meta property="og:url" content="{{ $_saUrl }}">
    <meta property="og:image" content="{{ $_saImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Surma Agro">
    <meta property="og:locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', $_saTitle)">
    <meta name="twitter:description" content="@yield('og_description', $_saDesc)">
    <meta name="twitter:image" content="{{ $_saImage }}">

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
