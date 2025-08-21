<x-guest-layout 
    screen="max-w-screen-xl" 
    title="{{ __('Categories') }}">

    <div class="flex flex-col gap-4 px-2 sm:px-0">

        {{-- Header --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center justify-between mt-3">
            <div class="col-span-1">
                <h1 class="text-sm sm:text-lg font-bold text-gray-900 dark:text-white">{{ __('Explore categories') }}</h1>
                <p class="text-[10px] sm:text-xs text-gray-500 dark:text-gray-400 mt-1">{{ __('Browse by category - discover curated picks, deals and top brands.') }}</p>
            </div>

            <div class="col-span-1 sm:col-start-3 justify-self-end">
                <form action="" method="GET">
                    <div class="grid grid-cols-8 items-center gap-3">
                        <div class="col-span-6">
                            <x-front.text-input id="search" class="block w-full" type="text" name="search" placeholder="Search categories..." value="{{ request('search') }}" maxlength="80" autocomplete="search" required />
                        </div>

                        <div class="col-span-2">
                            <div class="flex gap-1">
                                <x-front.button
                                    type="submit"
                                    class="w-40"
                                    element="button">
                                    @slot('icon')
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M80-140v-320h320v320H80Zm80-80h160v-160H160v160Zm60-340 220-360 220 360H220Zm142-80h156l-78-126-78 126ZM863-42 757-148q-21 14-45.5 21t-51.5 7q-75 0-127.5-52.5T480-300q0-75 52.5-127.5T660-480q75 0 127.5 52.5T840-300q0 26-7 50.5T813-204L919-98l-56 56ZM660-200q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29ZM320-380Zm120-260Z"/></svg>
                                    @endslot
                                    {{ __('Search') }}
                                </x-front.button>
                            </div>
                        </div>
                    </div>

                    @if (request('search'))
                        <div class="flex justify-end mt-2">
                            <a href="{{ route('front.category.index') }}" class="text-[10px] inline-flex gap-2 items-center text-end text-amber-800/80 hover:text-amber-800 dark:text-amber-600/80 dark:hover:text-amber-600">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m592-481-57-57 143-182H353l-80-80h487q25 0 36 22t-4 42L592-481ZM791-56 560-287v87q0 17-11.5 28.5T520-160h-80q-17 0-28.5-11.5T400-200v-247L56-791l56-57 736 736-57 56ZM535-538Z"/></svg>

                                Clear Filter
                            </a>
                        </div>
                    @endif

                </form>
            </div>

        </div>

        {{-- Top banner ad --}}
        @if ($categoryPageAd1)
            <a href="{{ $categoryPageAd1->url }}" class="block {{ FD['rounded'] }} overflow-hidden shadow">
                <img src="{{ Storage::url($categoryPageAd1->image_l) }}" alt="Top ad" class="w-full h-auto object-cover">
            </a>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">

            {{-- Filters + Small Ads --}}
            {{-- <div class="hidden sm:block">
                @include('layouts.front.includes.categories-filter')
            </div> --}}

            {{-- Categories + Featured Products --}}
            <main class="lg:col-span-4 space-y-4">
                {{-- All categories --}}
                <div class="bg-white dark:bg-gray-800 p-2 sm:p-4 {{ FD['rounded'] }} shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-base">All categories</h3>
                        <div class="text-xs text-gray-500">Showing {{ $catCount .' '. ( ($catCount == 1) ? 'category' : 'categories' ) }}</div>
                    </div>

                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-2 sm:gap-3">
                        @foreach($parents as $cat)
                            <a href="{{ route('front.category.detail', $cat->slug) }}" class="block">
                                <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} p-1 sm:p-2 group transition h-full flex flex-col shadow-sm hover:shadow-md border dark:border-gray-700 overflow-hidden">
                                    {{-- Image --}}
                                    @if (!empty($cat->image_s))
                                        <img src="{{ Storage::url($cat->image_s) }}" alt=""
                                            class="w-full h-12 sm:h-16 object-contain mb-2 group-hover:scale-105 transition">
                                    @else
                                        <div class="flex-1 flex items-center justify-center mb-2 bg-gradient-to-br from-blue-500 to-purple-500 text-white overflow-hidden">
                                            <span class="text-xs sm:text-sm font-bold">{{ $cat->title }}</span>
                                        </div>
                                        @php $cat->title = null; @endphp
                                    @endif

                                    {{-- Title --}}
                                    @if (!empty($cat->title))
                                        <p class="text-[10px] sm:text-xs font-medium text-center line-clamp-2 text-gray-900 dark:text-white mb-0.5">
                                            {{ $cat->title }}
                                        </p>
                                    @endif

                                    {{-- Description --}}
                                    @if (!empty($cat->short_description))
                                        <p class="{{ FD['text-0'] }} sm:text-[10px] font-light text-center line-clamp-2 text-gray-500 dark:text-gray-500 leading-tight">
                                            {{ $cat->short_description }}
                                        </p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>


                <!-- Sub-category grid: 3 columns on mobile, 6 on desktop -->
                <div class="container mx-auto">
                    <div class="grid grid-cols-3 gap-4 lg:grid-cols-6">
                        @foreach ($children as $item)
                            <a href="{{ route('front.category.detail', $item->slug) }}" class="group block bg-white dark:bg-gray-800 {{ FD['rounded'] }} overflow-hidden shadow-sm hover:shadow-lg transition transform">
                                <div class="w-full h-20 overflow-hidden p-2">
                                    @if ($item->image_m)
                                        <img src="{{ Storage::url($item->image_m) }}" alt="{{ $item->slug }}" class="w-full h-full object-scale-down group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-500">
                                            {!! FD['brokenImageFront'] !!}
                                        </div>
                                    @endif
                                </div>
                                <div class="p-2 text-center">
                                    <h3 class="text-[10px] sm:text-xs font-semibold text-gray-900 dark:text-gray-100">{{ $item->title }}</h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ count($item->activeProducts) }} products</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>


                {{-- Trending categories --}}
                {{-- <div class="bg-gradient-to-t from-sky-500 to-indigo-500 p-3 sm:p-4 {{ FD['rounded'] }} shadow">
                    <div class="flex items-center justify-between mb-2 sm:mb-3">
                        <h3 class="font-bold text-white text-sm sm:text-base">Trending categories</h3>
                        <!-- <a href="#" class="text-xs text-indigo-200 hover:text-white">View more</a> -->
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-3">
                        @foreach($categories as $ind => $trenCategory)
                            <a href="{{ route('front.category.detail', $trenCategory->slug) }}" class="block">
                                <div class="bg-white dark:bg-gray-800 p-2 sm:p-3 {{ FD['rounded'] }} flex items-center gap-2 sm:gap-3 group hover:shadow-md transition-shadow">
                                    @if ($trenCategory->image_s)
                                        <img src="{{ Storage::url($trenCategory->image_s) }}" 
                                            alt="{{ $trenCategory->slug }}" 
                                            class="w-auto h-10 sm:h-12 object-cover {{ FD['rounded'] }} group-hover:scale-105 transition-transform">
                                    @endif

                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs sm:text-sm font-semibold truncate">{{ $trenCategory->title }}</p>
                                        @if ($trenCategory->short_description)
                                            <p class="{{ FD['text-0'] }} sm:text-[10px] mt-0.5 text-gray-500 dark:text-gray-400 line-clamp-1 sm:line-clamp-2 leading-tight">
                                                {{ $trenCategory->short_description }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div> --}}


                {{-- Featured products --}}
                @if (count($featuredProducts) > 0)
                    <section class="bg-gray-100 antialiased dark:bg-gray-900">
                        <div class="mx-auto max-w-screen-xl">
                            <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                                <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                            </div>

                            <div class="grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-4" id="featured-products">
                                {{-- Product Card Component --}}
                                @foreach ($featuredProducts as $featuredItem)
                                    <x-front.product-card :product="$featuredItem->product" />
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif


            </main>
        </div>

        {{-- Proudly Indian --}}
        <x-front.proudly-indian />

        <section class="max-w-7xl grid grid-cols-1 md:grid-cols-2 gap-4 items-stretch">

            <div class="bg-indigo-600 text-white {{ FD['rounded'] }} p-4 sm:p-6 h-full flex flex-col justify-between shadow-md overflow-hidden">
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 sm:gap-3">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-white/12 text-xs font-semibold tracking-tight">
                            <div class="{{ FD['iconClass'] }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M640-520q17 0 28.5-11.5T680-560q0-17-11.5-28.5T640-600q-17 0-28.5 11.5T600-560q0 17 11.5 28.5T640-520Zm-320-80h200v-80H320v80ZM180-120q-34-114-67-227.5T80-580q0-92 64-156t156-64h200q29-38 70.5-59t89.5-21q25 0 42.5 17.5T720-820q0 6-1.5 12t-3.5 11q-4 11-7.5 22.5T702-751l91 91h87v279l-113 37-67 224H480v-80h-80v80H180Zm60-80h80v-80h240v80h80l62-206 98-33v-141h-40L620-720q0-20 2.5-38.5T630-796q-29 8-51 27.5T547-720H300q-58 0-99 41t-41 99q0 98 27 191.5T240-200Zm240-298Z"/></svg>
                            </div>
                            <span class="ml-1">₹150 OFF - First order</span>
                        </span>

                        <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-white/10 text-xs font-medium">
                            <div class="{{ FD['iconClass'] }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M480-80q-24 0-46-9t-39-26q-29-29-50-38t-63-9q-50 0-85-35t-35-85q0-42-9-63t-38-50q-17-17-26-39t-9-46q0-24 9-46t26-39q29-29 38-50t9-63q0-50 35-85t85-35q42 0 63-9t50-38q17-17 39-26t46-9q24 0 46 9t39 26q29 29 50 38t63 9q50 0 85 35t35 85q0 42 9 63t38 50q17 17 26 39t9 46q0 24-9 46t-26 39q-29 29-38 50t-9 63q0 50-35 85t-85 35q-42 0-63 9t-50 38q-17 17-39 26t-46 9Zm0-80q8 0 15.5-3.5T508-172q41-41 77-55.5t93-14.5q17 0 28.5-11.5T718-282q0-58 14.5-93.5T788-452q12-12 12-28t-12-28q-41-41-55.5-77T718-678q0-17-11.5-28.5T678-718q-58 0-93.5-14.5T508-788q-5-5-12.5-8.5T480-800q-8 0-15.5 3.5T452-788q-41 41-77 55.5T282-718q-17 0-28.5 11.5T242-678q0 58-14.5 93.5T172-508q-12 12-12 28t12 28q41 41 55.5 77t14.5 93q0 17 11.5 28.5T282-242q58 0 93.5 14.5T452-172q5 5 12.5 8.5T480-160Zm100-160q25 0 42.5-17.5T640-380q0-25-17.5-42.5T580-440q-25 0-42.5 17.5T520-380q0 25 17.5 42.5T580-320Zm-202-2 260-260-56-56-260 260 56 56Zm2-198q25 0 42.5-17.5T440-580q0-25-17.5-42.5T380-640q-25 0-42.5 17.5T320-580q0 25 17.5 42.5T380-520Zm100 40Z"/></svg>
                            </div>
                            <span class="ml-1">Exclusive deals</span>
                        </span>
                    </div>

                    <div class="text-xs text-white/80 flex items-center gap-2 mt-2 sm:mt-0">
                        <div class="{{ FD['iconClass'] }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M0-240v-63q0-43 44-70t116-27q13 0 25 .5t23 2.5q-14 21-21 44t-7 48v65H0Zm240 0v-65q0-32 17.5-58.5T307-410q32-20 76.5-30t96.5-10q53 0 97.5 10t76.5 30q32 20 49 46.5t17 58.5v65H240Zm540 0v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780Zm-455-80h311q-10-20-55.5-35T480-370q-55 0-100.5 15T325-320ZM160-440q-33 0-56.5-23.5T80-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-440Zm640 0q-33 0-56.5-23.5T720-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-440Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Zm0-80q17 0 28.5-11.5T520-600q0-17-11.5-28.5T480-640q-17 0-28.5 11.5T440-600q0 17 11.5 28.5T480-560Zm1 240Zm-1-280Z"/></svg>
                        </div>
                        <span>Trusted · 1M+ users</span>
                    </div>
                </div>

                <div class="mt-4">
                    <h3 class="text-lg font-bold">Sign in & save more</h3>
                    <p class="text-xs mt-2 text-white/90 mb-3">
                        Login to unlock personalised deals, faster checkout, wishlist sync, and early-bird access to flash sales.
                    </p>

                    <ul class="grid grid-cols-2 gap-2 text-xs">
                        <li class="flex items-start gap-2">
                            <div class="{{ FD['iconClass'] }} text-white/95 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="m280-80 160-300-320-40 480-460h80L520-580l320 40L360-80h-80Zm222-247 161-154-269-34 63-117-160 154 268 33-63 118Zm-22-153Z"/></svg>
                            </div>
                            <span class="text-white/95">Faster checkout</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="{{ FD['iconClass'] }} text-white/95 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M160-280v80h640v-80H160Zm0-440h88q-5-9-6.5-19t-1.5-21q0-50 35-85t85-35q30 0 55.5 15.5T460-826l20 26 20-26q18-24 44-39t56-15q50 0 85 35t35 85q0 11-1.5 21t-6.5 19h88q33 0 56.5 23.5T880-640v440q0 33-23.5 56.5T800-120H160q-33 0-56.5-23.5T80-200v-440q0-33 23.5-56.5T160-720Zm0 320h640v-240H596l84 114-64 46-136-184-136 184-64-46 82-114H160v240Zm200-320q17 0 28.5-11.5T400-760q0-17-11.5-28.5T360-800q-17 0-28.5 11.5T320-760q0 17 11.5 28.5T360-720Zm240 0q17 0 28.5-11.5T640-760q0-17-11.5-28.5T600-800q-17 0-28.5 11.5T560-760q0 17 11.5 28.5T600-720Z"/></svg>
                            </div>
                            <span class="text-white/95">Exclusive coupons</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="{{ FD['iconClass'] }} text-white/95 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M216-720h528l-34-40H250l-34 40Zm184 270 80-40 80 40v-190H400v190ZM200-120q-33 0-56.5-23.5T120-200v-499q0-14 4.5-27t13.5-24l50-61q11-14 27.5-21.5T250-840h460q18 0 34.5 7.5T772-811l50 61q9 11 13.5 24t4.5 27v139q-21 0-41.5 3T760-545v-95H640v205l-77 77-83-42-160 80v-320H200v440h280v80H200Zm440-520h120-120Zm-440 0h363-363Zm360 520v-123l221-220q9-9 20-13t22-4q12 0 23 4.5t20 13.5l37 37q8 9 12.5 20t4.5 22q0 11-4 22.5T903-340L683-120H560Zm300-263-37-37 37 37ZM620-180h38l121-122-18-19-19-18-122 121v38Zm141-141-19-18 37 37-18-19Z"/></svg>
                            </div>
                            <span class="text-white/95">Personalised picks</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <div class="{{ FD['iconClass'] }} text-white/95 shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M200-80q-33 0-56.5-23.5T120-160v-480q0-33 23.5-56.5T200-720h80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720h80q33 0 56.5 23.5T840-640v480q0 33-23.5 56.5T760-80H200Zm0-80h560v-480H200v480Zm280-240q83 0 141.5-58.5T680-600h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85h-80q0 83 58.5 141.5T480-400ZM360-720h240q0-50-35-85t-85-35q-50 0-85 35t-35 85ZM200-160v-480 480Z"/></svg>
                            </div>
                            <span class="text-white/95">Orders saved</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-4 flex flex-col sm:flex-row items-stretch gap-2">
                    <a href="{{ route('front.login') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-3 py-2 {{ FD['rounded'] }} bg-white text-indigo-600 font-semibold text-sm
                            focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-600 transition"
                    aria-label="Login now">
                        Login Now
                    </a>

                    <a href="{{ route('front.register') }}"
                    class="w-full sm:w-auto inline-flex items-center justify-center px-3 py-2 {{ FD['rounded'] }} border border-white/25 text-white text-sm font-medium
                            hover:bg-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-600 transition"
                    aria-label="Create account">
                        Create account
                    </a>
                </div>
            </div>

            @php
                /** Type 1, when small image is square
                 *  Type 2, when small image is vertical
                 */
                $rightSideAdType = 1; // Type 1/2

                if ($rightSideAdType == 2) {
                    $adClass1 = "p-4 sm:p-6";
                    $adClass11 = "gap-4";
                    $adClass2 = "rounded-md";
                    $adClass3 = "w-20 h-20";
                    $adClass4 = "";
                } else {
                    $adClass1 = "p-0";
                    $adClass11 = "";
                    $adClass2 = FD['rounded'];
                    $adClass3 = "w-40 h-full";
                    $adClass4 = "p-4 sm:p-6";
                }
            @endphp

            <div class="bg-white dark:bg-gray-800 {{ $adClass1 }} flex {{ $adClass11 }} shadow-sm h-full {{ FD['rounded'] }} relative overflow-hidden items-center">
                <div class="absolute inset-0 opacity-30 dark:opacity-30 z-0">
                    <img src="/storage/default/testing/sale.jpg" alt="Indian Flag Background" class="w-full h-full object-cover object-center">
                </div>

                <!-- Optional -->
                <div class="hidden sm:block h-full z-0">
                    <img src="/storage/default/testing/big-yellow.jpg" alt="" class="{{ $adClass3 }} object-cover flex-shrink-0 {{ $adClass2 }} z-0" aria-hidden="true" />
                </div>

                <div class="flex-1 flex flex-col justify-between h-full z-0 {{ $adClass4 }}">
                    <div class="flex items-start justify-between gap-2">
                        <div class="flex items-center gap-2">
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-indigo-50 text-indigo-700 text-xs font-semibold">
                                <div class="{{ FD['iconClass'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="m438-338 226-226-57-57-169 169-84-84-57 57 141 141Zm42 258q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Zm0-84q104-33 172-132t68-220v-189l-240-90-240 90v189q0 121 68 220t172 132Zm0-316Z"/></svg>
                                </div>
                                <span class="ml-1">Secure payments</span>
                            </span>

                            <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-green-50 text-green-700 text-xs font-medium">
                                <div class="{{ FD['iconClass'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="m344-60-76-128-144-32 14-148-98-112 98-112-14-148 144-32 76-128 136 58 136-58 76 128 144 32-14 148 98 112-98 112 14 148-144 32-76 128-136-58-136 58Zm34-102 102-44 104 44 56-96 110-26-10-112 74-84-74-86 10-112-110-24-58-96-102 44-104-44-56 96-110 24 10 112-74 86 74 84-10 114 110 24 58 96Zm102-318Zm-42 142 226-226-56-58-170 170-86-84-56 56 142 142Z"/></svg>
                                </div>
                                <span class="ml-1">Verified sellers</span>
                            </span>
                        </div>

                        <div class="text-xs text-gray-600 dark:text-white/80 flex items-center gap-2">
                            <div class="{{ FD['iconClass'] }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M0-240v-63q0-43 44-70t116-27q13 0 25 .5t23 2.5q-14 21-21 44t-7 48v65H0Zm240 0v-65q0-32 17.5-58.5T307-410q32-20 76.5-30t96.5-10q53 0 97.5 10t76.5 30q32 20 49 46.5t17 58.5v65H240Zm540 0v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780Zm-455-80h311q-10-20-55.5-35T480-370q-55 0-100.5 15T325-320ZM160-440q-33 0-56.5-23.5T80-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-440Zm640 0q-33 0-56.5-23.5T720-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-440Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Zm0-80q17 0 28.5-11.5T520-600q0-17-11.5-28.5T480-640q-17 0-28.5 11.5T440-600q0 17 11.5 28.5T480-560Zm1 240Zm-1-280Z"/></svg>
                            </div>
                            <span>Trusted · 1M+ users</span>
                        </div>
                    </div>

                    <div class="mt-3">
                        <h3 class="text-lg font-bold dark:text-gray-50">Trusted marketplace</h3>
                        <p class="text-xs text-gray-600 dark:text-gray-300 mt-2 mb-3">
                            Secure checkout, verified sellers and fast support — shop confidently. Enjoy easy returns and transparent seller ratings on every order.
                        </p>

                        <ul class="grid grid-cols-2 gap-2 text-xs">
                            <li class="flex items-start gap-2">
                                <div class="{{ FD['iconClass'] }} shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="m480-320 56-56-63-64h167v-80H473l63-64-56-56-160 160 160 160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h168q13-36 43.5-58t68.5-22q38 0 68.5 22t43.5 58h168q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm280-590q13 0 21.5-8.5T510-820q0-13-8.5-21.5T480-850q-13 0-21.5 8.5T450-820q0 13 8.5 21.5T480-790ZM200-200v-560 560Z"/></svg>
                                </div>
                                <span class="text-gray-700 dark:text-gray-200">7-day easy returns</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <div class="{{ FD['iconClass'] }} shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M280-160q-50 0-85-35t-35-85H60l18-80h113q17-19 40-29.5t49-10.5q26 0 49 10.5t40 29.5h167l84-360H262l17-80h441l-37 160h117l120 160-40 200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H400q0 50-35 85t-85 35Zm357-280h193l4-21-74-99h-95l-28 120Zm-17-280-84 360 2-7 82-353ZM140-440v-120H40l140-200v120h100L140-440Zm140 200q17 0 28.5-11.5T320-280q0-17-11.5-28.5T280-320q-17 0-28.5 11.5T240-280q0 17 11.5 28.5T280-240Zm400 0q17 0 28.5-11.5T720-280q0-17-11.5-28.5T680-320q-17 0-28.5 11.5T640-280q0 17 11.5 28.5T680-240Z"/></svg>
                                </div>
                                <span class="text-gray-700 dark:text-gray-200">Fast shipping</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <div class="{{ FD['iconClass'] }} shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M440-120v-80h320v-284q0-117-81.5-198.5T480-764q-117 0-198.5 81.5T200-484v244h-40q-33 0-56.5-23.5T80-320v-80q0-21 10.5-39.5T120-469l3-53q8-68 39.5-126t79-101q47.5-43 109-67T480-840q68 0 129 24t109 66.5Q766-707 797-649t40 126l3 52q19 9 29.5 27t10.5 38v92q0 20-10.5 38T840-249v49q0 33-23.5 56.5T760-120H440Zm-80-280q-17 0-28.5-11.5T320-440q0-17 11.5-28.5T360-480q17 0 28.5 11.5T400-440q0 17-11.5 28.5T360-400Zm240 0q-17 0-28.5-11.5T560-440q0-17 11.5-28.5T600-480q17 0 28.5 11.5T640-440q0 17-11.5 28.5T600-400Zm-359-62q-7-106 64-182t177-76q89 0 156.5 56.5T720-519q-91-1-167.5-49T435-698q-16 80-67.5 142.5T241-462Z"/></svg>
                                </div>
                                <span class="text-gray-700 dark:text-gray-200">24/7 support</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <div class="{{ FD['iconClass'] }} shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-33 23.5-56.5T840-480v-160q-33 0-56.5-23.5T760-720H360q0 33-23.5 56.5T280-640v160q33 0 56.5 23.5T360-400Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z"/></svg>
                                </div>
                                <span class="text-gray-700 dark:text-gray-200">Secure payments</span>
                            </li>
                        </ul>
                    </div>

                    <div class="mt-4 flex gap-3">
                        <a href="/collection"
                        class="inline-flex items-center justify-center px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold {{ FD['rounded'] }}
                                focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-100 dark:focus-visible:ring-offset-gray-800 transition"
                        aria-label="See our Collections">
                            See our Collections
                        </a>

                        <a href="/about/trust"
                        class="inline-flex items-center justify-center px-3 py-2 border border-gray-200 dark:border-gray-700 text-xs sm:text-sm text-gray-700 dark:text-gray-200 {{ FD['rounded'] }}
                                hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 transition"
                        aria-label="Why trust us">
                            Why trust us
                        </a>
                    </div>
                </div>
            </div>

        </section>
    </div>

</x-guest-layout>
