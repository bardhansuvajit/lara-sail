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

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite([
            'resources/css/app.css',
            'resources/js/app.js',
            'resources/js/custom.js'
        ])

        @livewireStyles
    </head>
    <body class="dark:bg-gray-800 dark:text-slate-300">
        <div class="antialiased bg-gray-100 dark:bg-gray-900">

            <!-- navigation -->
            @include('layouts.admin.navigation')

            <!-- sidebar -->
            @include('layouts.admin.sidebar')

            <main class="p-o md:p-4 md:ml-64 justify-center h-auto pt-10 md:pt-[4.3rem]">
                <div class="flex flex-col justify-center items-center">
                    {{-- <section class="bg-white max-w-screen-{{ $screen }} py-8 md:px-4 rounded-lg antialiased dark:bg-gray-800 md:py-4"> --}}
                    <section class="bg-white w-full {!! $screen !!} py-8 md:px-4 rounded-lg antialiased dark:bg-gray-800 md:py-4">
                        <div class="mx-auto px-4 2xl:px-0">

                            <!-- breadcrumb -->
                            @include('layouts.admin.breadcrumb')

                            <div class="flex space-x-2 mb-2 items-center">
                                @if(isset($breadcrumb) && is_array($breadcrumb))
                                    @if (!empty($breadcrumb[0]['url']))
                                        <x-admin.button-icon
                                            element="a"
                                            tag="secondary"
                                            href="{{ $breadcrumb[0]['url'] }}"
                                        >
                                            @slot('icon')
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m432-480 156 156q11 11 11 28t-11 28q-11 11-28 11t-28-11L348-452q-6-6-8.5-13t-2.5-15q0-8 2.5-15t8.5-13l184-184q11-11 28-11t28 11q11 11 11 28t-11 28L432-480Z"/></svg>
                                            @endslot
                                        </x-admin.button-icon>
                                    @endif
                                @endif
                                <h2 class="text-xs sm:text-sm font-semibold text-gray-900 dark:text-white">{{ $title ?? 'Admin' }}</h2>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700"></div>

                            {{ $slot }}
                        </div>
                    </section>

                    <!-- footer -->
                    @include('layouts.admin.footer')
                </div>
            </main>
        </div>

        @include('layouts.admin.notification')

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                window.addEventListener('notificationSend', event => {
                    // console.log(event.detail[0]);

                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: {
                            variant: event.detail[0].variant,
                            title: event.detail[0].title,
                            message: event.detail[0].message
                        }
                    }));
                });

                @if(Session::has('success'))
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: {
                            variant: 'success',
                            title: 'Success!',
                            message: '{{ Session::get("success") }}'
                        }
                    }));
                @endif

                @if(Session::has('failure'))
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: {
                            variant: 'warning',
                            title: 'Action Needed!',
                            message: '{{ Session::get("failure") }}'
                        }
                    }));
                @endif

                @if(Session::has('error'))
                    window.dispatchEvent(new CustomEvent('notify', {
                        detail: {
                            variant: 'danger',
                            title: 'Oops!',
                            message: '{{ Session::get("error") }}'
                        }
                    }));
                @endif
            });
        </script>

        @yield('script')

        @livewireScripts

    </body>
</html>
