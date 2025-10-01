<x-app-layout
    screen="max-w-screen-xl"
    title="{{ $title ?? __('Account') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="pt-2 md:pt-4 px-2 md:px-4">

            <h2 class="{{ FD['text-2'] }} font-semibold text-gray-900 dark:text-white">{{ $title ?? __('Account') }}</h2>

            @include('layouts.front.global-alert')

            <div class="mt-2 md:mt-4 gap-2 md:gap-4 lg:flex lg:items-start">
                <div class="hidden md:block w-full">
                    @include('front.account.includes.account-overview')
                </div>

                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">

                    @include('front.account.includes.navbar')

                    <div class="bg-white dark:bg-gray-800 px-2 py-4 md:p-4 mb-2 md:mb-4">
                        {{-- <div class="block md:hidden">
                            @include('front.account.includes.account-overview')
                        </div> --}}

                        @yield('content')
                    </div>

                </div>
            </div>
        </div>
    </section>

    @yield('scripts')
</x-app-layout>