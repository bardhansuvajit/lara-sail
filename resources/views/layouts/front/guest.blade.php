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
            @include('layouts.front.navigation')

            <div class="mx-auto {{$screen}}">
                <div class="mt-36 sm:mt-44">
                    {{ $slot }}
                </div>
            </div>

            {{-- <main class="p-o md:p-4 md:ml-64 justify-center h-auto pt-10 md:pt-[4.3rem]">
                <div class="flex flex-col justify-center items-center">
                    <section class="bg-white w-full {!! $screen !!} py-8 md:px-4 rounded-lg antialiased dark:bg-gray-800 md:py-4">
                        <div class="mx-auto px-4 2xl:px-0">

                            <div class="flex space-x-2 mb-2 items-center">
                                <h2 class="text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">{{ $title ?? 'Admin' }}</h2>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700"></div>

                            {{ $slot }}
                        </div>
                    </section>

                    <!-- footer -->
                    @include('layouts.admin.footer')
                </div>
            </main> --}}
        </div>

        <!-- footer -->
        @include('layouts.front.footer')

        <!-- Quick Cart -->
        @if (!request()->is('cart') && !request()->is('checkout'))
            @include('layouts.front.includes.cart-item-delete-confirm-modal')
        @endif

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

        <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

        {{-- @yield('script') --}}
        @stack('scripts')

        @livewireScripts

    </body>
</html>
