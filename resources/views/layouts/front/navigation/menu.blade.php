<div class="py-3 md:py-4 border-b border-gray-200 border-opacity-100 dark:border-gray-700">
    <div class="max-w-screen-xl px-2 md:px-4 mx-auto 2xl:px-0">
        <div class="flex flex-wrap items-center justify-between gap-x-4 sm:gap-x-16 gap-y-4 md:gap-x-8 lg:flex-nowrap">

            {{-- mobile hamburger menu --}}
            <div class="relative md:hidden">
                <button type="button" class="inline-flex items-center justify-center p-1 text-sm rounded-lg font-medium leading-tight dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700/100">
                    <svg class="w-5 h-5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"></path></svg>
                </button>
            </div>

            {{-- main logo --}}
            <div class="flex-shrink-0 md:order-1">
                <a href="{{ url('/') }}" title="" class="">
                    <img class="w-auto sm:flex h-6 sm:h-5 dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/logo-full.svg" alt="">
                    <img class="hidden w-auto h-6 sm:h-5 dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/logo-full-dark.svg" alt="">
                </a>
            </div>

            <div class="flex items-center justify-end md:order-3 lg:space-x-2">
                {{-- cart --}}
                @include('layouts.front.navigation.cart')

                {{-- account --}}
                @include('layouts.front.navigation.account')
            </div>

            {{-- search --}}
            @include('layouts.front.navigation.search')

            {{-- mobile only sidebar --}}
            @include('layouts.front.navigation.sidebar')

        </div>
    </div>
</div>