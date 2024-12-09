@props([
    'screen',
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
                        <nav class="mb-4 flex" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                                <li class="inline-flex items-center">
                                    <a href="#" class="inline-flex items-center text-xs md:text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
                                        <svg class="me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                                        </svg>
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <div class="flex items-center">
                                        <svg class="mx-1 h-4 w-4 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                                        </svg>

                                        <a href="#" class="ms-1 text-xs md:text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white md:ms-2">My account</a>
                                    </div>
                                </li>
                                <li aria-current="page">
                                    <div class="flex items-center">
                                        <svg class="mx-1 h-4 w-4 text-gray-400 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                                        </svg>

                                        <span class="ms-1 text-xs md:text-sm font-medium text-gray-500 dark:text-gray-400 md:ms-2">Account</span>
                                    </div>
                                </li>
                            </ol>
                        </nav>

                        <h2 class="mb-4 text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl md:mb-4">{{ $title ?? 'Admin' }}</h2>

                        <div class="border-t border-gray-200 dark:border-gray-700"></div>

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
