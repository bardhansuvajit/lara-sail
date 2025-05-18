<div class="py-3 md:py-4 border-b border-gray-200 border-opacity-100 dark:border-gray-700">
    <div class="max-w-screen-xl px-2 md:px-4 mx-auto 2xl:px-0">
        <div class="flex flex-wrap items-center justify-between gap-x-4 sm:gap-x-16 gap-y-4 md:gap-x-8 lg:flex-nowrap">

            {{-- Mobile hamburger menu --}}
            <div 
                class="relative md:hidden" 
                x-data=""
                x-on:click.prevent="
                    $dispatch('open-sidebar', 'mob-sidebar');
                ">
                <button type="button" class="inline-flex items-center justify-center p-1 text-sm {{FD['rounded']}} font-medium leading-tight dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700/100">
                    <svg class="{{FD['iconClass']}} dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"></path></svg>
                </button>
            </div>

            {{-- Main logo --}}
            <div class="flex-shrink-0 md:order-1">
                <a href="{{ url('/') }}" title="" class="">
                    <img class="w-auto sm:flex h-6 sm:h-5 dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/logo-full.svg" alt="">
                    <img class="hidden w-auto h-6 sm:h-5 dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/logo-full-dark.svg" alt="">
                </a>
            </div>

            <div class="flex items-center justify-end md:order-3 lg:space-x-2">
                {{-- Cart --}}
                @if (!request()->is('cart') && !request()->is('checkout'))
                    @include('layouts.front.navigation.cart')
                @endif

                {{-- Account --}}
                @if (Auth::guard('web')->check())
                    @include('layouts.front.navigation.account')
                @else
                    <a href="{{route('front.login')}}" class="hidden sm:inline-flex items-center {{FD['rounded']}} justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700/100 {{FD['text']}} font-medium leading-tight dark:text-white">
                        <svg class="w-4 h-4 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path></svg>
                        <span class="hidden lg:block">Login</span>
                    </a>
                @endif
            </div>

            {{-- Search --}}
            @include('layouts.front.navigation.search')

            {{-- Mobile only Sidebar --}}
            @include('layouts.front.navigation.sidebar')

        </div>
    </div>
</div>