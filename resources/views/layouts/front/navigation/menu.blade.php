<div class="py-3 md:py-4 border-b border-gray-200 border-opacity-100 dark:border-gray-700">
    <div class="max-w-screen-xl px-2 md:px-4 mx-auto 2xl:px-0">
        <div class="flex flex-wrap items-center justify-between gap-x-4 sm:gap-x-16 gap-y-4 md:gap-x-8 lg:flex-nowrap">

            {{-- Mobile hamburger menu --}}
            <div 
                class="relative md:hidden {{FD['iconClass-1']}}" 
                x-data=""
                x-on:click.prevent="$dispatch('open-sidebar', 'mob-sidebar');"
            >
                <button type="button" class="block items-center justify-center text-sm {{ FD['rounded'] }} font-medium leading-tight dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700/100">
                    <div class="{{FD['iconClass-1']}} dark:text-white">
                        {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M120-680v-80h720v80H120Zm0 480v-80h720v80H120Zm0-240v-80h720v80H120Z"/></svg> --}}

                        <svg viewBox="0 0 24.00 24.00" fill="currentcolor" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4 6H20M4 12H20M4 18H20" stroke="currentcolor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                    </div>
                </button>
            </div>

            {{-- Main logo --}}
            <div class="flex-shrink-0 md:order-1">
                <a href="{{ url('/') }}" title="" class="">
                    <img class="w-auto sm:flex h-6 sm:h-5 dark:hidden" src="{{ Storage::url('public/default/logo/logo-full.svg') }}" alt="">
                    <img class="hidden w-auto h-6 sm:h-5 dark:block" src="{{ Storage::url('public/default/logo/logo-full-dark.svg') }}" alt="">
                </a>
            </div>

            <div class="flex items-center justify-end md:order-3 lg:space-x-2">
                {{-- Cart --}}
                @if (!request()->is('cart') && !request()->is('checkout'))
                    @include('layouts.front.navigation.cart')
                @endif

                {{-- Account --}}
                @if (!request()->is('checkout'))
                    @if (Auth::guard('web')->check())
                        @include('layouts.front.navigation.account')
                    @else
                        <a href="{{ route('front.login', ['redirect' => url()->current()]) }}" class="hidden sm:inline-flex items-center {{ FD['rounded'] }} justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700/100 {{FD['text']}} font-medium leading-tight dark:text-white">
                            <svg class="w-4 h-4 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path></svg>
                            <span class="hidden lg:block">Login</span>
                        </a>
                    @endif
                @endif
            </div>

            {{-- Search --}}
            @if (!request()->is('checkout'))
                @include('layouts.front.navigation.search')
            @endif

            {{-- Mobile only Sidebar --}}
            @include('layouts.front.navigation.sidebar')

        </div>
    </div>
</div>