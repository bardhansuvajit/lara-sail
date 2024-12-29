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
        @vite([
            'resources/css/app.css', 
            'resources/js/app.js',
            'resources/js/custom.js'
        ])
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

        {{-- modal --}}
        {{-- <div x-data="{modalIsOpen: false}">
            <button @click="modalIsOpen = true" type="button" class="cursor-pointer whitespace-nowrap rounded-md bg-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">Open Modal</button>
            <div x-cloak x-show="modalIsOpen" x-transition.opacity.duration.200ms x-trap.inert.noscroll="modalIsOpen" @keydown.esc.window="modalIsOpen = false" @click.self="modalIsOpen = false" class="fixed inset-0 z-30 flex items-end justify-center bg-black/20 p-4 pb-8 backdrop-blur-md sm:items-center lg:p-8" role="dialog" aria-modal="true" aria-labelledby="defaultModalTitle">
                <!-- Modal Dialog -->
                <div x-show="modalIsOpen" x-transition:enter="transition ease-out duration-200 delay-100 motion-reduce:transition-opacity" x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100" class="flex max-w-lg flex-col gap-4 overflow-hidden rounded-md border border-neutral-300 bg-white text-neutral-600 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-300">
                    <!-- Dialog Header -->
                    <div class="flex items-center justify-between border-b border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20">
                        <h3 id="defaultModalTitle" class="font-semibold tracking-wide text-neutral-900 dark:text-white">Special Offer</h3>
                        <button @click="modalIsOpen = false" aria-label="close modal">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" stroke="currentColor" fill="none" stroke-width="1.4" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    <!-- Dialog Body -->
                    <div class="px-4 py-8"> 
                        <p>As a token of appreciation, we have an exclusive offer just for you. Upgrade your account now to unlock premium features and enjoy a seamless experience.</p>
                    </div>
                    <!-- Dialog Footer -->
                    <div class="flex flex-col-reverse justify-between gap-2 border-t border-neutral-300 bg-neutral-50/60 p-4 dark:border-neutral-700 dark:bg-neutral-950/20 sm:flex-row sm:items-center md:justify-end">
                        <button @click="modalIsOpen = false" type="button" class="cursor-pointer whitespace-nowrap rounded-md px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-600 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:text-neutral-300 dark:focus-visible:outline-white">Remind me later</button>

                        <button @click="modalIsOpen = false" type="button" class="cursor-pointer whitespace-nowrap rounded-md bg-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 dark:bg-white dark:text-black dark:focus-visible:outline-white">Upgrade Now</button>
                    </div>
                </div>
            </div>
        </div> --}}

        {{-- alert buttons --}}
        {{-- <div class="flex space-x-2 my-3">
            <!-- Message Trigger -->
            <div x-data>
                <button x-on:click="$dispatch('notify', { variant: 'message', sender:{name:'Jack Ellis', avatar:'https://penguinui.s3.amazonaws.com/component-assets/avatar-2.webp'}, message: 'Hey, can you review the PR I just submitted? Let me know if you spot any issues!' })" type="button" class="cursor-pointer whitespace-nowrap rounded-md bg-black px-4 py-2 text-center text-sm font-medium tracking-wide text-neutral-100 transition hover:opacity-75 focus-visible:neutral-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75 dark:bg-white dark:text-black dark:focus-visible:outline-white">Message</button>
            </div>
            <!-- Info Trigger -->
            <div x-data>
                <button x-on:click="$dispatch('notify', { variant: 'info', title: 'Update Available',  message: 'A new version of the app is ready for you. Update now to enjoy the latest features!' })" type="button" class="cursor-pointer whitespace-nowrap rounded-md bg-sky-500 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:opacity-75 focus-visible:neutral-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-sky-500 active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75">Info</button>
            </div>
            <!-- Success Trigger -->
            <div x-data>
                <button x-on:click="$dispatch('notify', { variant: 'success', title: 'Success!',  message: 'Your changes have been saved. Keep up the great work!' })" type="button" class="cursor-pointer whitespace-nowrap rounded-md bg-green-500 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:opacity-75 focus-visible:neutral-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500 active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75">Success</button>
            </div>
            <!-- Danger Trigger -->
            <div x-data>
                <button x-on:click="$dispatch('notify', { variant: 'danger', title: 'Oops!',  message: 'Something went wrong. Please try again. If the problem persists, we’re here to help!' })" type="button" class="cursor-pointer whitespace-nowrap rounded-md bg-red-500 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:opacity-75 focus-visible:neutral-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500 active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75">Danger</button>
            </div>
            <!-- Warning Trigger -->
            <div x-data>
                <button x-on:click="$dispatch('notify', { variant: 'warning', title: 'Action Needed',  message: 'Your storage is getting low. Consider upgrading your plan.' })" type="button" class="cursor-pointer whitespace-nowrap rounded-md bg-amber-500 px-4 py-2 text-center text-sm font-medium tracking-wide text-white transition hover:opacity-75 focus-visible:neutral-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-amber-500 active:opacity-100 active:outline-offset-0 disabled:cursor-not-allowed disabled:opacity-75">Warning</button>
            </div>
        </div> --}}

        @include('layouts.admin.notification')

        <script>
            document.addEventListener('DOMContentLoaded', function () {
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

    </body>
</html>
