@props([
    'screen',
    'breadcrumb' => [],
    'title' => false
])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', $title ? $title : 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />

        <!-- Scripts -->
        @vite([
            'resources/css/app.css',
            'resources/js/app.js',
            'resources/js/front/custom.js'
        ])

        @livewireStyles
    </head>
    <body class="dark:bg-gray-800 dark:text-slate-300">
        <div class="antialiased bg-gray-100 dark:bg-gray-900">

            <!-- navigation -->
            {{-- @include('layouts.front.navigation') --}}

            <nav class="bg-white dark:bg-gray-800 antialiased fixed top-0 right-0 shadow w-full z-10 transition-all" id="navbar">
                {{-- @include('layouts.front.navigation.alert') --}}
            
                {{-- @include('layouts.front.navigation.quick') --}}
            
                @include('layouts.front.navigation.menu')
            
                {{-- @include('layouts.front.navigation.collections') --}}
            
                @include('layouts.front.navigation.mobile-menu')
            </nav>

            <div class="mx-auto {{$screen}}">
                <div class="mt-24 sm:mt-10">
                    {{ $slot }}
                </div>
            </div>

        <!-- footer -->
        {{-- @include('layouts.front.footer') --}}
        

        <footer class="bg-white shadow-sm m-0 dark:bg-gray-800 mb-16">
            <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
                <span class="{{FD['text']}} text-gray-500 sm:text-center dark:text-gray-400">&copy; {{date('Y')}} <a href="https://website.com/" class="hover:underline">Website&trade;</a>. All Rights Reserved.</span>
                <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-gray-400 sm:mt-0">
                    <li>
                        <a href="#" class="{{FD['text-0']}} hover:underline me-4 md:me-6">About</a>
                    </li>
                    <li>
                        <a href="#" class="{{FD['text-0']}} hover:underline me-4 md:me-6">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="{{FD['text-0']}} hover:underline me-4 md:me-6">Licensing</a>
                    </li>
                    <li>
                        <a href="#" class="{{FD['text-0']}} hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
        </footer>


        {{-- @include('layouts.admin.notification') --}}
        @include('layouts.front.includes.full-page-loader')

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                function dispatchNotification(message, options) {
                    window.dispatchEvent(new CustomEvent('show-notification', {
                        detail: { message, options }
                    }));
                }

                @if(Session::has('success'))
                    dispatchNotification('{{ Session::get("success") }}', { type: 'success' });
                @endif

                @if(Session::has('failure'))
                    dispatchNotification('{{ Session::get("failure") }}', { type: 'warning' });
                @endif

                @if(Session::has('error'))
                    dispatchNotification('{{ Session::get("error") }}', { type: 'error' });
                @endif
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        {{-- @yield('script') --}}
        @stack('scripts')

        @livewireScripts

    </body>
</html>
