<x-app-layout
    screen="max-w-screen-xl"
    title="{{ __('Account') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="pt-4 sm:pt-6 px-2 sm:px-2 md:px-3 lg:px-4 xl:px-4 2xl:px-0">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white sm:text-lg">Account</h2>

            @include('layouts.front.global-alert')

            <div class="mt-4 sm:mt-6 md:gap-6 lg:flex lg:items-start xl:gap-8">
                {{-- left part --}}
                <div class="hidden sm:block w-full">
                    @include('front.account.includes.account-overview')
                </div>

                {{-- right part --}}
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">

                    @include('front.account.includes.navbar')

                    <div class="bg-white dark:bg-gray-800 p-0 sm:p-4 mb-5">
                        <div class="block sm:hidden">
                            @include('front.account.includes.account-overview')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</x-app-layout>
