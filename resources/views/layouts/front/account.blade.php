<x-app-layout
    screen="max-w-screen-xl"
    title="{{ $title ?? __('Account') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="pt-2 md:pt-4 px-2 md:px-4">

            @include('layouts.front.global-alert')

            <div class="mt-2 md:mt-4 gap-2 md:gap-4 lg:flex lg:items-start">
                <div class="hidden md:block w-full">
                    @include('front.account.includes.account-overview')
                </div>

                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">

                    @include('front.account.includes.navbar')

                    <div class="bg-white dark:bg-gray-800 p-2 md:p-4 mb-2 md:mb-4">
                        <div class="space-y-2 md:space-y-4">

                            <!-- Header -->
                            @if (isset($showHeader) && $showHeader === true)
                                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
                                    <div class="flex items-center gap-4">
                                        @if (isset($breadcrumb))
                                            @php
                                                // Get the second last breadcrumb item for back button
                                                $backItem = $breadcrumb[count($breadcrumb) - 2];
                                                $backUrl = $backItem['url'] ?? route('front.account.index');
                                            @endphp

                                            <div>
                                                <a href="{{ $backUrl }}" class="inline-flex items-center justify-center p-1 md:p-2 border border-gray-300 dark:border-gray-600 {{ FD['rounded'] }} {{ FD['text'] }} font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                                    <svg class="{{ FD['iconClass-1'] }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-240 120-480l240-240 56 56-144 144h568v80H272l144 144-56 56Z"/></svg>
                                                </a>
                                            </div>
                                        @endif
                                        <div>
                                            <h1 class="{{ FD['text-2'] }} font-bold text-gray-900 dark:text-white">{{ $title }}</h1>
                                            @if (isset($subtitle))
                                                <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400 mt-1">{{ $subtitle }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Content -->
                            @yield('content')

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @yield('scripts')
</x-app-layout>