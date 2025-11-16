<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="apple-touch-icon" sizes="180x180" href="{{ Storage::url('default/logo/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ Storage::url('default/logo/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ Storage::url('default/logo/favicon/favicon-16x16.png') }}">
        <link rel="manifest" href="{{ Storage::url('default/logo/favicon/site.webmanifest') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900 p-4">
            <div>
                <a href="/">
                    {{-- <x-admin.application-logo class="w-20 h-20 fill-current text-gray-500 dark:text-gray-200" /> --}}
                    <img src="{{ Storage::url('default/logo/logo-square.svg') }}" class="w-20 h-20" alt="Logo" />
                </a>
            </div>

            <div class="mt-6">
                <h2 class="text-xl tracking-tight font-extrabold text-primary-600 dark:text-primary-500">Admin Area</h2>
            </div>

            <div class="w-full sm:max-w-xs mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
