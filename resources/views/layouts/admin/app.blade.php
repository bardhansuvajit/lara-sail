@props([
    'screen',
    'breadcrumb' => [],
    'title' => false
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="dark:bg-gray-800 dark:text-slate-300">
        <div class="antialiased bg-gray-50 dark:bg-gray-900">

            <!-- navigation -->
            @include('layouts.admin.navigation')

            <!-- sidebar -->
            @include('layouts.admin.sidebar')

            <main class="p-o md:p-4 md:ml-64 h-auto pt-10 md:pt-20">
                <section class="bg-white py-8 md:px-4 rounded-lg antialiased dark:bg-gray-800 md:py-4">
                    <div class="mx-auto max-w-screen-{{ $screen }} px-4 2xl:px-0">

                        <!-- breadcrumb -->
                        @include('layouts.admin.breadcrumb')

                        <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl md:mb-4">{{ $title ?? 'Admin' }}</h2>

                        <div class="border-t border-gray-200 dark:border-gray-700 mb-3"></div>

                        {{ $slot }}

                    </div>
                </section>

                <!-- footer -->
                @include('layouts.admin.footer')
            </main>
        </div>

        @yield('script')

    </body>
</html>
