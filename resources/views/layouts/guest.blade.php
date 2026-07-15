<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Surma Agro') }} - Admin Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gradient-to-br from-forest-900 via-forest-800 to-forest-700 min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
    <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white/95 backdrop-blur-sm shadow-2xl rounded-2xl border border-white/10">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-forest-700 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg shadow-forest-700/30">
                <span class="text-white font-bold text-2xl">SA</span>
            </div>
            <h2 class="text-xl font-bold text-forest-800">Surma Agro Admin</h2>
            <p class="text-sm text-forest-500 mt-1">Sign in to manage your website</p>
        </div>
        {{ $slot }}
    </div>
</body>
</html>
