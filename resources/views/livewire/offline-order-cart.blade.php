<div>
    <div class="border border-gray-200 dark:border-gray-600 p-2 mb-3 shadow">
        <p class="text-xs mb-3">
            CART -
            <span class="cart-count">{{count($cart['items'])}} <span class="hidden md:inline-block">items</span></span>
        </p>

        <div id="cart-alert" class="space-y-4">

            {{-- Minimum cart Value to place Order --}}
            @if (isset($cart['items']) && count($cart['items']) > 0)
                @if ($cartSetting['min_order_value'] > $cart['total'])
                    <div class="border border-gray-200 {{FD['text']}} {{ FD['rounded'] }} px-2 sm:px-4 py-1 bg-orange-700 dark:bg-orange-700 dark:border-white/10 text-neutral-100 dark:text-neutral-100 mt-2 sm:mt-4" role="alert" tabindex="-1" aria-labelledby="hs-link-on-right-label">
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

        <div id="cart-products" class="">
            @forelse ($cart['items'] as $item)
                <div class="grid grid-cols-3 items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                    <div class="col-span-2">
                        <div class="flex items-center gap-3">
                            <a href="{{ $item['product_url_with_variation'] ? $item['product_url_with_variation'] : $item['product_url'] }}" class="flex aspect-[1/1] h-9 flex-shrink-0 items-center" target="_blank">
                                @if (!empty($item['image_s']))
                                    <img class="h-auto max-h-full w-full" src="{{Storage::url($item['image_s'])}}" alt="{{$item['product_title']}}" />
                                @else
                                    {!! FD['brokenImageFront'] !!}
                                @endif
                            </a>
                            <div class="w-full">
                                <a href="{{ $item['product_url_with_variation'] ? $item['product_url_with_variation'] : $item['product_url'] }}" class="inline-block text-xs ${{FD['text-0']}} text-gray-900 hover:underline dark:text-white" target="_blank">{{$item['product_title']}}</a>

                                @if (!empty($item['variation_attributes']))
                                    <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400">{{$item['variation_attributes']}}</p>
                                @endif

                                <p class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-300">
                                    <span class="currency-symbol">{{COUNTRY['icon']}}</span> {{formatIndianMoney($item['selling_price'])}}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-1">
                        <div class="flex items-center justify-end gap-3">
                            <div class="relative flex items-center">
                                <button 
                                    type="button" 
                                    class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center ${FDrounded} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-gray-300 dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700" 
                                    wire:click.prevent="updateQty({{$item['id']}}, 'desc', {{$item['quantity']}})"
                                >
                                    <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"></path></svg>
                                </button>

                                <input type="text" class="w-8 p-0 flex-shrink-0 border-0 bg-transparent text-center {{FD['text']}} font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="{{$item['quantity']}}" required="">

                                <button 
                                    type="button" 
                                    class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center ${FDrounded} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-gray-300 dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700" 
                                    wire:click.prevent="updateQty({{$item['id']}}, 'asc', {{$item['quantity']}})"
                                >
                                    <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"></path></svg>
                                </button>
                            </div>
                        </div>
                    </div>
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

                @if (!$loop->last)
                    <hr class="dark:border-gray-600 my-4">
                @endif
            @empty
                <div class="p-2 md:p-4">
                    <div class="w-full text-center">
                        <img src="{{ Storage::url('public/default/cart/undraw_web-shopping_m3o2.svg') }}" alt="empty-cart" class="w-72 m-auto mb-6">

                        <h5 class="block text-base leading-tight font-bold text-gray-900 dark:text-gray-300 mb-4">
                            Cart is empty!
                        </h5>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @if (count($cart['items']) > 0)
        <div id="order-summary-container" class="">
            @include('livewire.includes.order-summary')
        </div>
    @endif


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