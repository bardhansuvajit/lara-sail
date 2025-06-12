<div>
    <div id="cart-alert" class="space-y-4">

        {{-- Minimum cart Value to place Order --}}
        @if (isset($cart['items']) && count($cart['items']) > 0)
            @if ($cartSetting['min_order_value'] > $cart['total'])
                <div class="border border-gray-200 {{FD['text']}} {{FD['rounded']}} px-2 sm:px-4 py-1 bg-orange-700 dark:bg-orange-700 dark:border-white/10 text-neutral-100 dark:text-neutral-100 mt-2 sm:mt-4" role="alert" tabindex="-1" aria-labelledby="hs-link-on-right-label">
                    <div class="flex items-center">
                        <div class="shrink-0">
                            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>
                        </div>
                        <div class="flex-1 md:flex md:justify-between ms-2">
                            <p class="{{FD['text']}}">
                                {!! __('You are only <span class="currency-symbol">:icon</span> :amount away from  <span class="font-medium">Placing an Order</span>', [
                                    'icon' => COUNTRY['icon'],
                                    'amount' => formatIndianMoney($cartSetting['min_order_value'] - $cart['total'])
                                ]) !!}
                            </p>
                            <p class="{{FD['text']}} mt-3 md:mt-0 md:ms-6">
                                <a class="text-neutral-100 hover:text-neutral-300 focus:outline-hidden focus:text-gray-500 font-medium whitespace-nowrap dark:text-neutral-200 dark:hover:text-neutral-400 dark:focus:text-neutral-400" href="javascript: void(0)" x-data="" x-on:click="$dispatch('open-modal', 'minimum-cart-order');">Details</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if ($cartSetting['free_shipping_threshold'] > $cart['sub_total'])
                <div class="flex w-full items-center gap-3 sm:gap-4 {{FD['activeBgClass']}} px-2 sm:px-4 py-1 mt-2 sm:mt-4 font-light">
                    <div class="{{FD['iconClass']}} lg:w-6 lg:h-6">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M280-160q-50 0-85-35t-35-85H60l18-80h113q17-19 40-29.5t49-10.5q26 0 49 10.5t40 29.5h167l84-360H262l17-80h441l-37 160h117l120 160-40 200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H400q0 50-35 85t-85 35Zm357-280h193l4-21-74-99h-95l-28 120Zm-17-280-84 360 2-7 82-353ZM140-440v-120H40l140-200v120h100L140-440Zm140 200q17 0 28.5-11.5T320-280q0-17-11.5-28.5T280-320q-17 0-28.5 11.5T240-280q0 17 11.5 28.5T280-240Zm400 0q17 0 28.5-11.5T720-280q0-17-11.5-28.5T680-320q-17 0-28.5 11.5T640-280q0 17 11.5 28.5T680-240Z"/></svg>
                    </div>

                    <div>
                        <p class="{{FD['text']}}">
                            {!! __('You are only <span class="currency-symbol">:icon</span> :amount away from  <span class="font-medium">Free Shipping</span>', [
                                'icon' => COUNTRY['icon'],
                                'amount' => formatIndianMoney($cartSetting['free_shipping_threshold'] - $cart['sub_total'])
                            ]) !!}
                        </p>
                        <p class="{{FD['text']}}">
                            <a href="javascript: void(0)" class="font-medium underline hover:no-underline inline-block" x-data="" x-on:click="$dispatch('open-modal', 'shipping-value');">How do i get this ?</a>
                        </p>
                    </div>
                </div>
            @endif
        @endif

    </div>

    <div class="mt-4 sm:mt-6 md:gap-6 lg:flex lg:items-start xl:gap-8">
        {{-- left part - cart products --}}
        <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
            {{-- cart products --}}
            <div id="cart-products" class="space-y-6 mb-4">

                @if (isset($cart['items']) && count($cart['items']) > 0)
                    @foreach ($cart['items'] as $item)

                        <div class="p-2 md:p-3 {{FD['rounded']}} border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                            <div class="space-y-2">
                                {{-- IMAGE && TITLE && DESCRIPTION --}}
                                <div class="flex gap-4 justify-start">
                                    <div class="basis-1/12 flex-shrink-0">
                                        <a 
                                            href="{{ $item['product_url_with_variation'] ? $item['product_url_with_variation'] : $item['product_url'] }}" 
                                            class="flex aspect-[1/1] h-12 md:h-16 flex-shrink-0 items-center"
                                        >
                                            @if (!empty($item['image_s']))
                                                <img class="h-auto max-h-full w-full" src="{{ Storage::url($item['image_s']) }}" alt="{{$item['product_title']}}" />
                                            @else
                                                {!! FD['brokenImageFront'] !!}
                                            @endif
                                        </a>
                                    </div>
                                    <div class="flex-1">
                                        <a href="{{ $item['product_url_with_variation'] ? $item['product_url_with_variation'] : $item['product_url'] }}" class="inline-block {{FD['text']}} leading-tight font-medium text-gray-900 hover:underline dark:text-gray-300 mb-1 sm:mb-2">
                                            {{$item['product_title']}}
                                        </a>

                                        @if (!empty($item['variation_attributes']))
                                            <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400">{{$item['variation_attributes']}}</p>
                                        @endif

                                        @if ($item['is_available'] == 1)
                                            <p class="{{FD['text-0']}} {{FD['activeClass']}} mt-1">{{$item['availability_message']}}</p>
                                        @endif
                                    </div>
                                </div>
                                {{-- QUANTITY && PRICING --}}
                                <div>
                                    @if ($item['is_available'] == 1)
                                        <div class="flex space-x-4 items-center">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <button type="button" class="inline-flex h-5 w-5 shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                                                        wire:click.prevent="updateQty({{$item['id']}}, 'desc', {{$item['quantity']}})"
                                                    >
                                                        <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" /></svg>
                                                    </button>

                                                    <input type="text" class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="{{$item['quantity']}}" />

                                                    <button type="button" class="inline-flex h-5 w-5 shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700"
                                                        wire:click.prevent="updateQty({{$item['id']}}, 'asc', {{$item['quantity']}})"
                                                    >
                                                        <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" /></svg>
                                                    </button>
                                                </div>
                                            </div>

                                            <p class="{{FD['text-0']}} md:text-xs font-bold text-gray-900 dark:text-gray-50">
                                                <span class="currency-symbol">{{COUNTRY['icon']}}</span>
                                                {{formatIndianMoney($item['selling_price'])}}
                                            </p>

                                            @if ($item['mrp'] > 0)
                                                <p class="{{FD['text-0']}} md:text-xs font-bold text-gray-400 dark:text-gray-400 line-through">
                                                    <span class="currency-symbol">{{COUNTRY['icon']}}</span>
                                                    {{formatIndianMoney($item['mrp'])}}
                                                </p>

                                                <p class="{{FD['text-0']}} md:text-xs font-black leading-tight {{FD['activeClass']}}">
                                                    {{discountPercentageCalc($item['selling_price'], $item['mrp'])}}% off
                                                </p>
                                            @endif
                                        </div>
                                    @else
                                        <p class="inline-block {{FD['text']}} leading-tight font-medium text-red-500 hover:underline dark:text-red-600 mb-1 sm:mb-2">
                                            {{ $item['availability_message'] }}
                                        </p>
                                    @endif
                                </div>
                                {{-- UPSELL --}}
                                {{-- <div>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 border-t dark:border-gray-700 mt-2 py-2">
                                        <div class="col-span-2 md:col-span-4">
                                            <h5 class="{{FD['text']}} flex space-x-2 items-center">
                                                {{ __('Bought together') }}
                                                <div class="{{FD['iconClass']}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-344 240-584l56-56 184 184 184-184 56 56-240 240Z"/></svg>
                                                </div>
                                            </h5>
                                        </div>

                                        <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 relative overflow-hidden">
                                            <a href="#">
                                                <div class="h-20 w-full mb-2">
                                                    <img class="mx-auto h-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="" />
                                                </div>

                                                <div class="absolute top-0 right-0 w-full h-8 p-1 overflow-hidden">
                                                    <div class="flex justify-between items-center">
                                                        <div class="w-10 h-5 flex space-x-1 items-center bg-gray-50 px-1 border">
                                                            <p class="{{FD['text-0']}} text-gray-900 font-bold">3.9</p>
                                                            <div class="{{FD['iconClass']}} text-yellow-400 flex items-center">
                                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"></path></svg>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <p class="font-semibold text-gray-900 hover:underline dark:text-gray-400 {{FD['text-0']}} block mb-2">
                                                    Apple iMac 27", 1TB HDD, Retina 5K Display, M3 Max some more texts to add here so that i can check it
                                                </p>

                                                <p class="{{FD['text-0']}} dark:text-gray-500">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum, nihil vel veritatis, laborum dolore</p>

                                                <div class="my-2 flex items-center gap-2">
                                                    <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                                        <span class="currency-symbol">{{COUNTRY['icon']}}</span>1,09,699
                                                    </p>
                                                    <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                                        <span class="currency-symbol">{{COUNTRY['icon']}}</span>17,699
                                                    </p>
                                                    <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                                        40% off
                                                    </p>
                                                </div>

                                                <button class="{{FD['rounded']}} w-full {{FD['text-0']}} bg-primary-700 dark:bg-primary-600 hover:bg-primary-800 dark:hover:bg-primary-700 p-1 text-gray-100">
                                                    Add item
                                                </button>
                                            </a>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- DIVIDER --}}
                                <div>
                                    <div class="border-t dark:border-gray-700"></div>
                                </div>
                                {{-- SAVE for LATER && REMOVE --}}
                                <div>
                                    <div class="flex items-center gap-4 pt-1">
                                        <button 
                                            type="button" 
                                            class="{{FD['text']}} inline-flex gap-2 items-center text-sm font-medium text-gray-600 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-white"
                                            x-data=""
                                            x-on:click="
                                                $dispatch('open-modal', 'confirm-livewire-cart-item-save-for-later'); 
                                                $dispatch('data-id', @js($item['id']));
                                                $dispatch('data-title', @js($item['product_title']));
                                                $dispatch('data-url', @js($item['product_url_with_variation'] ? $item['product_url_with_variation'] : $item['product_url']));
                                                $dispatch('data-attributes', @js($item['variation_attributes']));
                                                $dispatch('data-selling-price', @js(formatIndianMoney($item['selling_price'])));
                                                $dispatch('data-mrp', @js(formatIndianMoney($item['mrp'])));
                                                $dispatch('data-discount', @js(discountPercentageCalc($item['selling_price'], $item['mrp'])));
                                                $dispatch('data-image-path', @js($item['image_s'] ? Storage::url($item['image_s']) : ''));
                                            "
                                        >
                                            <div class="{{FD['iconClass']}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120v-640q0-33 23.5-56.5T280-840h240v80H280v518l200-86 200 86v-278h80v400L480-240 200-120Zm80-640h240-240Zm400 160v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Z"/></svg>
                                            </div>
                                            Save for later
                                        </button>

                                        <button 
                                            type="button" 
                                            class="{{FD['text']}} inline-flex gap-2 items-center text-sm font-medium text-red-500 hover:text-red-700 hover:underline dark:text-red-600 dark:hover:text-red-700"
                                            x-data=""
                                            x-on:click="
                                                $dispatch('open-modal', 'confirm-livewire-cart-item-deletion'); 
                                                $dispatch('data-id', @js($item['id']));
                                                $dispatch('data-title', @js($item['product_title']));
                                                $dispatch('data-url', @js($item['product_url_with_variation'] ? $item['product_url_with_variation'] : $item['product_url']));
                                                $dispatch('data-attributes', @js($item['variation_attributes']));
                                                $dispatch('data-selling-price', @js(formatIndianMoney($item['selling_price'])));
                                                $dispatch('data-mrp', @js(formatIndianMoney($item['mrp'])));
                                                $dispatch('data-discount', @js(discountPercentageCalc($item['selling_price'], $item['mrp'])));
                                                $dispatch('data-image-path', @js($item['image_s'] ? Storage::url($item['image_s']) : ''));
                                            "
                                        >
                                            <div class="{{FD['iconClass']}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                                            </div>
                                            Remove
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @else
                    <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">
                        <div class="w-full text-center">
                            <img src="{{ Storage::url('public/default/cart/undraw_web-shopping_m3o2.svg') }}" alt="empty-cart" class="w-72 m-auto mb-6">

                            <h5 class="block text-base leading-tight font-bold text-gray-900 dark:text-gray-300 mb-4">
                                Your cart is empty!
                            </h5>
                        </div>
                    </div>
                @endif

            </div>

            {{-- Saved for later products --}}
            @if (isset($savedItems) && count($savedItems) > 0)
            <div id="saved-product-container" class="bg-gray-50 mb-4 py-4 antialiased dark:bg-gray-800 mt-6 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="mx-auto max-w-screen-xl px-2 sm:px-4">
                    <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                        <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">SAVED FOR LATER</h2>
                    </div>

                    <div id="saved-products" class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-4 lg:grid-cols-4">

                        @foreach ($savedItems as $saved_item)
                            <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 relative overflow-hidden">
                                <a href="{{ $saved_item->product_url_with_variation ? $saved_item->product_url_with_variation : $saved_item->product_url }}">
                                    <div class="h-40 w-full">
                                        @if (count($saved_item->product->activeImages) > 0)
                                            <div class="flex items-center justify-center h-full">
                                                <img src="{{ Storage::url($saved_item->product->activeImages[0]->image_m) }}" alt="" class="max-w-full max-h-full">
                                            </div>
                                        @else
                                            <div class="flex items-center justify-center h-full w-full">
                                                {!!FD['brokenImageFront']!!}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="absolute top-0 right-0 w-full h-8 p-1 overflow-hidden">
                                        <div class="flex justify-between items-center">
                                            @if ($saved_item->product->average_rating > 0)
                                                {!! frontRatingHtml($saved_item->product->average_rating) !!}
                                            @endif

                                            <button type="button" class="rounded-full w-6 h-6 p-1 hover:bg-gray-100 dark:hover:bg-gray-300">
                                                <div class="{{FD['iconClass']}} text-gray-500">
                                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z" /></svg>
                                                </div>
                                            </button>
                                        </div>
                                    </div>

                                    <p class="font-semibold text-gray-900 hover:underline dark:text-gray-300 {{FD['text-0']}} sm:text-xs inline-block leading-4 sm:leading-5 truncate">
                                        {{ $saved_item->product_title }}
                                    </p>

                                    <p class="text-gray-500 dark:text-gray-400 {{FD['text-0']}} block -mt-2">
                                        {{ $saved_item->variation_attributes }}
                                    </p>

                                    <div class="mt-2 flex items-center gap-2">
                                        <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                            <span class="currency-icon">{{COUNTRY['icon']}}</span> {{ formatIndianMoney($saved_item->selling_price) }}
                                        </p>
                                        @if ($saved_item->mrp != 0)
                                            <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                                <span class="currency-icon">{{COUNTRY['icon']}}</span>{{ formatIndianMoney($saved_item->mrp) }}
                                            </p>
                                            <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                                {{discountPercentageCalc($saved_item->selling_price, $saved_item->mrp)}}% off
                                            </p>
                                        @endif
                                    </div>

                                    {{-- @if (count($saved_item->product->pricings) > 0)
                                        @php
                                            $singlePricing = $saved_item->product->pricings[0];
                                        @endphp

                                        <div class="mt-2 flex items-center gap-2">
                                            <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                                <span class="currency-icon">{{$singlePricing->currency_symbol}}</span> {{ formatIndianMoney($singlePricing->selling_price) }}
                                            </p>
                                            @if ($singlePricing->mrp != 0)
                                                <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                                    <span class="currency-icon">{{$singlePricing->currency_symbol}}</span>{{ formatIndianMoney($singlePricing->mrp) }}
                                                </p>
                                                <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                                    {{$singlePricing->discount}}% off
                                                </p>
                                            @endif
                                        </div>
                                    @endif --}}
                                </a>

                                <div class="flex gap-2 mt-3">
                                    <button class="flex-1 basis-[70%] {{ FD['rounded'] }} {{ FD['text-0'] }} bg-primary-700 dark:bg-primary-600 hover:bg-primary-800 dark:hover:bg-primary-700 p-1 text-gray-100"
                                        wire:click="moveItemToCart({{ $saved_item->id }})">
                                        Move to cart
                                    </button>

                                    <button class="basis-[30%] {{ FD['rounded'] }} {{ FD['text-0'] }} bg-orange-700 dark:bg-orange-600 hover:bg-orange-800 dark:hover:bg-orange-700 p-1 text-gray-100"
                                        wire:click="deleteItem({{ $saved_item->id }})">
                                        Remove
                                    </button>
                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            @endif

            {{-- featured products --}}
            {{-- <div id="featured-product-container" class="bg-gray-50 mb-4 py-4 antialiased dark:bg-gray-800 mt-6 shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="mx-auto max-w-screen-xl px-2 sm:px-4">
                    <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                        <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                    </div>

                    <div id="featured-products" class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-4 lg:grid-cols-4">

                        <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 relative overflow-hidden">
                            <a href="#">
                                <div class="h-40 w-full">
                                    <img class="mx-auto h-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="" />
                                </div>

                                <div class="absolute top-0 right-0 w-full h-8 p-1 overflow-hidden">
                                    <div class="flex justify-between items-center">
                                        <div class="w-10 h-5 flex space-x-1 items-center bg-gray-50 px-1 border">
                                            <p class="{{FD['text-0']}} text-gray-900 font-bold">3.9</p>
                                            <div class="{{FD['iconClass']}} text-yellow-400 flex items-center">
                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"></path></svg>
                                            </div>
                                        </div>

                                        <button type="button" class="rounded-full w-6 h-6 p-1 hover:bg-gray-100 dark:hover:bg-gray-300">
                                            <div class="{{FD['iconClass']}} text-gray-500">
                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z" /></svg>
                                            </div>
                                        </button>
                                    </div>
                                </div>

                                <p class="font-semibold text-gray-900 hover:underline dark:text-gray-400 {{FD['text-0']}} sm:text-xs block leading-4 sm:leading-5 truncate">
                                    Apple iMac 27", 1TB HDD, Retina 5K Display, M3 Max some more texts to add here so that i can check it
                                </p>

                                <div class="mt-2 flex items-center gap-2">
                                    <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                        <span class="currency-symbol">{{COUNTRY['icon']}}</span>1,09,699
                                    </p>
                                    <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                        <span class="currency-symbol">{{COUNTRY['icon']}}</span>17,699
                                    </p>
                                    <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                        40% off
                                    </p>
                                </div>
                            </a>

                            <button class="{{FD['rounded']}} w-full {{FD['text-0']}} bg-primary-700 dark:bg-primary-600 hover:bg-primary-800 dark:hover:bg-primary-700 p-1 mt-3 text-gray-100">
                                Add item
                            </button>
                        </div>

                    </div>
                </div>
            </div> --}}
        </div>

        {{-- right part - order summary --}}
        <div id="order-summary-container" class="mx-auto mt-6 mb-4 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full sticky top-36">

            @if (isset($cart['items']) && count($cart['items']) > 0)
                @include('livewire.includes.order-summary')

                @include('livewire.includes.shipping-methods')
            @endif

            <div class="w-full space-y-0 sm:space-y-4 {{FD['rounded']}} border border-gray-200 bg-white px-2 py-3 lg:p-4 shadow-sm dark:border-0 lg:dark:border lg:dark:border-gray-700 dark:bg-gray-800">
                <div class="text-center">
                    <img src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/promo-banner.jpg" class="bg-cover {{FD['rounded']}} w-full h-24 mb-4" alt="promo banner">
                        
                    <span class="text-green-100 font-medium text-sm leading-5 py-0.5 px-2.5 bg-green-500 {{FD['rounded']}} items-center inline-flex mb-4 dark:bg-green-300 dark:text-green-800">
                        <svg class="w-4 h-4 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>
                        Offer valid till today
                    </span>

                    <h3 class="text-gray-700 dark:text-gray-200 text-xl font-medium mb-1">20% Off All Gaming Gear</h3>

                    <p class="{{FD['text']}} dark:text-gray-500 mb-4">Simply enter your email to unlock this deal and stay in the loop for future promotions.</p>

                    <a href="{{ route('front.collection.index') }}" class="flex w-full items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Go to Collection
                    </a>
                </div>
            </div>

            {{-- <div>
                <div class="grid grid-cols-3 gap-2">
                    <div class="w-full max-w-sm bg-white border border-gray-200 {{FD['rounded']}} shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="p-2 {{FD['rounded']}}" src="https://flowbite.com/docs/images/products/apple-watch.png" alt="product image" />
                        </a>
                        <div class="p-1">
                            <a href="#">
                                <h5 class="{{FD['text-0']}} font-medium tracking-tight text-gray-900 dark:text-white">Priority Shipping</h5>
                            </a>

                            <p class="{{FD['text-0']}} dark:text-gray-500 line-clamp-2">Get in 1-2 days</p>

                            <div class="my-2 flex items-center gap-2">
                                <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                    <span class="currency-symbol">{{COUNTRY['icon']}}</span>1,09,699
                                </p>
                            </div>
                            <div class="my-2 flex items-center gap-2">
                                <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                    <span class="currency-symbol">{{COUNTRY['icon']}}</span>17,699
                                </p>
                                <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                    40% off
                                </p>
                            </div>

                            <button class="{{FD['rounded']}} w-full {{FD['text-0']}} bg-primary-700 dark:bg-primary-600 hover:bg-primary-800 dark:hover:bg-primary-700 p-1 text-gray-100">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                    <div class="w-full max-w-sm bg-white border border-gray-200 {{FD['rounded']}} shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="p-2 {{FD['rounded']}}" src="https://flowbite.com/docs/images/products/apple-watch.png" alt="product image" />
                        </a>
                        <div class="p-1">
                            <a href="#">
                                <h5 class="{{FD['text-0']}} font-medium tracking-tight text-gray-900 dark:text-white">Priority Shipping</h5>
                            </a>

                            <p class="{{FD['text-0']}} dark:text-gray-500 line-clamp-2">Get in 1-2 days</p>

                            <div class="my-2 flex items-center gap-2">
                                <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                    <span class="currency-symbol">{{COUNTRY['icon']}}</span>1,09,699
                                </p>
                            </div>
                            <div class="my-2 flex items-center gap-2">
                                <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                    <span class="currency-symbol">{{COUNTRY['icon']}}</span>17,699
                                </p>
                                <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                    40% off
                                </p>
                            </div>

                            <button class="{{FD['rounded']}} w-full {{FD['text-0']}} bg-primary-700 dark:bg-primary-600 hover:bg-primary-800 dark:hover:bg-primary-700 p-1 text-gray-100">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                    <div class="w-full max-w-sm bg-white border border-gray-200 {{FD['rounded']}} shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <img class="p-2 {{FD['rounded']}}" src="https://flowbite.com/docs/images/products/apple-watch.png" alt="product image" />
                        </a>
                        <div class="p-1">
                            <a href="#">
                                <h5 class="{{FD['text-0']}} font-medium tracking-tight text-gray-900 dark:text-white">Priority Shipping</h5>
                            </a>

                            <p class="{{FD['text-0']}} dark:text-gray-500 line-clamp-2">Get in 1-2 days</p>

                            <div class="my-2 flex items-center gap-2">
                                <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                    <span class="currency-symbol">{{COUNTRY['icon']}}</span>1,09,699
                                </p>
                            </div>
                            <div class="my-2 flex items-center gap-2">
                                <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                    <span class="currency-symbol">{{COUNTRY['icon']}}</span>17,699
                                </p>
                                <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                    40% off
                                </p>
                            </div>

                            <button class="{{FD['rounded']}} w-full {{FD['text-0']}} bg-primary-700 dark:bg-primary-600 hover:bg-primary-800 dark:hover:bg-primary-700 p-1 text-gray-100">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 relative overflow-hidden">
                        <a href="#">
                            <div class="h-20 w-full mb-2">
                                <img class="mx-auto h-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="" />
                            </div>

                            <div class="absolute top-0 right-0 w-full h-8 p-1 overflow-hidden">
                                <div class="flex justify-between items-center">
                                    <div class="w-10 h-5 flex space-x-1 items-center bg-gray-50 px-1 border">
                                        <p class="{{FD['text-0']}} text-gray-900 font-bold">3.9</p>
                                        <div class="{{FD['iconClass']}} text-yellow-400 flex items-center">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="font-semibold text-gray-900 hover:underline dark:text-gray-400 {{FD['text-0']}} mb-2 line-clamp-2" target="_blank">
                                Apple iMac 27", 1TB HDD, Retina 5K Display, M3 Max some more texts to add here so that i can check it
                            </p>

                            <p class="{{FD['text-0']}} dark:text-gray-500 line-clamp-2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum, nihil vel veritatis, laborum dolore</p>

                            <div class="my-2 flex items-center gap-2">
                                <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                    <span class="currency-symbol">{{COUNTRY['icon']}}</span>1,09,699
                                </p>
                                <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                    <span class="currency-symbol">{{COUNTRY['icon']}}</span>17,699
                                </p>
                                <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                    40% off
                                </p>
                            </div>

                            <button class="{{FD['rounded']}} w-full {{FD['text-0']}} bg-primary-700 dark:bg-primary-600 hover:bg-primary-800 dark:hover:bg-primary-700 p-1 text-gray-100">
                                Add to Cart
                            </button>
                        </a>
                    </div>

                    <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 relative overflow-hidden">
                        <a href="#">
                            <div class="h-20 w-full mb-2">
                                <img class="mx-auto h-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="" />
                            </div>

                            <div class="absolute top-0 right-0 w-full h-8 p-1 overflow-hidden">
                                <div class="flex justify-between items-center">
                                    <div class="w-10 h-5 flex space-x-1 items-center bg-gray-50 px-1 border">
                                        <p class="{{FD['text-0']}} text-gray-900 font-bold">3.9</p>
                                        <div class="{{FD['iconClass']}} text-yellow-400 flex items-center">
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"></path></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="font-semibold text-gray-900 hover:underline dark:text-gray-400 {{FD['text-0']}} mb-2 line-clamp-2" target="_blank">
                                Apple iMac 27", 1TB HDD, Retina 5K Display, M3 Max some more texts to add here so that i can check it
                            </p>

                            <p class="{{FD['text-0']}} dark:text-gray-500 line-clamp-2">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nostrum, nihil vel veritatis, laborum dolore</p>

                            <div class="my-2 flex items-center gap-2">
                                <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                    <span class="currency-symbol">{{COUNTRY['icon']}}</span>1,09,699
                                </p>
                                <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                    <span class="currency-symbol">{{COUNTRY['icon']}}</span>17,699
                                </p>
                                <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                    40% off
                                </p>
                            </div>

                            <button class="{{FD['rounded']}} w-full {{FD['text-0']}} bg-primary-700 dark:bg-primary-600 hover:bg-primary-800 dark:hover:bg-primary-700 p-1 text-gray-100">
                                Add to Cart
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full space-y-0 sm:space-y-4 {{FD['rounded']}} border border-gray-200 bg-white px-2 py-3 lg:p-4 shadow-sm dark:border-0 lg:dark:border lg:dark:border-gray-700 dark:bg-gray-800">
                <div class="text-center">
                    <img src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/promo-banner.jpg" class="bg-cover {{FD['rounded']}} w-full h-36 mb-4" alt="promo banner">
                        
                    <span class="text-green-100 font-medium text-sm leading-5 py-0.5 px-2.5 bg-green-500 {{FD['rounded']}} items-center inline-flex mb-4 dark:bg-green-300 dark:text-green-800">
                        <svg class="w-4 h-4 mr-1 -ml-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path></svg>
                        Offer valid till today
                    </span>

                    <h3 class="text-gray-700 dark:text-gray-200 text-xl font-medium mb-1">20% Off All Gaming Gear</h3>

                    <p class="{{FD['text']}} dark:text-gray-500 mb-4">Simply enter your email to unlock this deal and stay in the loop for future promotions.</p>

                    <button class="flex w-full items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 add-to-cart" 
                        data-prod-id="4" 
                        data-purchase-type="cart"
                        data-variation-data=""
                    >
                        Add to Cart
                    </button>
                </div>
            </div> --}}

        </div>
    </div>

    {{-- MODALS --}}
    @if (isset($cart['items']) && count($cart['items']) > 0)
        <!-- MINIMUM CART ORDER VALUE -->
        @include('layouts.front.includes.minimum-cart-order-modal-LIVEWIRE')

        <!-- SHIPPING VALLUE THRESHOLD -->
        @include('layouts.front.includes.shipping-value-threshold-modal-LIVEWIRE')

        <!-- DELETE CONFIRM -->
        @include('layouts.front.includes.cart-item-delete-confirm-modal-LIVEWIRE')

        <!-- SAVE FOR LATER -->
        @include('layouts.front.includes.cart-item-save-for-later-confirm-modal-LIVEWIRE')

        <!-- COUPONS -->
        @include('layouts.front.includes.coupons-sidebar')
    @endif

</div>