<div class="fixed z-1 sm:static bottom-16 sm:bottom-0 w-full -m-2 sm:m-0 space-y-0 sm:space-y-4 {{ FD['rounded'] }} border border-gray-200 bg-white px-2 py-3 lg:p-4 shadow-sm dark:border-0 lg:dark:border lg:dark:border-gray-700 dark:bg-gray-800">
    <div id="order-summary" class="hidden lg:block">
        <p class="{{FD['text-1']}} font-semibold text-gray-900 dark:text-white mb-2">Order summary</p>

        <div class="space-y-2">
            <dl class="flex items-center justify-between gap-4">
                <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Original price
                </dt>
                <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white"><span class="currency-symbol">{{COUNTRY['icon']}}</span>{{ formatIndianMoney($cart['mrp']) }}</dd>
            </dl>

            @if ($cart['mrp'] - $cart['sub_total'] != 0)
                <dl class="flex items-center justify-between gap-4">
                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Savings</dt>
                    <dd class="{{FD['text']}} font-medium text-green-600">-<span class="currency-symbol">{{COUNTRY['icon']}}</span>{{ formatIndianMoney($cart['mrp'] - $cart['sub_total']) }}</dd>
                </dl>
            @endif

            @if ( ($cart['shipping_cost'] > 0))
                <dl class="flex items-center justify-between gap-4">
                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Shipping</dt>
                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white"><span class="currency-symbol">{{COUNTRY['icon']}}</span>{{ formatIndianMoney($cart['shipping_cost']) }}</dd>
                </dl>
            @endif

            @if ( ($cart['tax_amount'] > 0))
                <dl class="flex items-center justify-between gap-4">
                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white"><span class="currency-symbol">{{COUNTRY['icon']}}</span>{{ formatIndianMoney($cart['tax_amount']) }}</dd>
                </dl>
            @endif

            {{-- Payment method Charge/ Discount --}}
            @if ( ($cart['payment_method_charge'] > 0))
                <dl class="flex items-center justify-between gap-4">
                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400" id="payment-method-summary-text">Payment method Charge</dt>
                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white" id="payment-method-summary-highlight">
                        <span id="payment-method-summary-icon"></span><span class="currency-symbol">{{COUNTRY['icon']}}</span><span id="payment-method-summary-amount">{{formatIndianMoney($cart['payment_method_charge'])}}</span>
                    </dd>
                </dl>
            @elseif ( $cart['payment_method_discount'] > 0 )
                <dl class="flex items-center justify-between gap-4">
                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400" id="payment-method-summary-text">Payment method Discount</dt>
                    <dd class="{{FD['text']}} font-medium text-green-600" id="payment-method-summary-highlight">
                        -<span id="payment-method-summary-icon"></span><span class="currency-symbol">{{COUNTRY['icon']}}</span><span id="payment-method-summary-amount">{{formatIndianMoney($cart['payment_method_discount'])}}</span>
                    </dd>
                </dl>
            @endif
            {{-- Payment method Charge/ Discount --}}

            @if (!is_null($cart['coupon_code_id']) && $cart['coupon_code_id'] > 0)
                <dl class="flex items-center justify-between gap-4">
                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Coupon Discount</dt>
                    @if ($cart['coupon_discount_amount'] > 0)
                        <dd class="{{FD['text']}} font-medium text-green-600" id="payment-method-summary-highlight">
                            -<span id="payment-method-summary-icon"></span><span class="currency-symbol">{{COUNTRY['icon']}}</span><span id="payment-method-summary-amount">{{formatIndianMoney($cart['coupon_discount_amount'])}}</span>
                        </dd>
                    @else
                        <dd class="{{FD['text']}} font-medium text-gray-500 dark:text-gray-400" id="payment-method-summary-highlight">
                            <span id="payment-method-summary-icon"></span><span class="currency-symbol">{{COUNTRY['icon']}}</span><span id="payment-method-summary-amount">{{formatIndianMoney($cart['coupon_discount_amount'])}}</span>
                        </dd>
                    @endif
                </dl>
                <div class="flex items-center justify-end gap-4">
                    <div class="flex items-center gap-3">
                        {{-- Coupon pill --}}
                        <div class="inline-flex items-center gap-1 rounded-full bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 ps-2 pe-1 py-1 shadow-sm">
                            <div class="flex items-center gap-2">
                                <div class="{{ FD['iconClass'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M160-280v80h640v-80H160Zm0-440h88q-5-9-6.5-19t-1.5-21q0-50 35-85t85-35q30 0 55.5 15.5T460-826l20 26 20-26q18-24 44-39t56-15q50 0 85 35t35 85q0 11-1.5 21t-6.5 19h88q33 0 56.5 23.5T880-640v440q0 33-23.5 56.5T800-120H160q-33 0-56.5-23.5T80-200v-440q0-33 23.5-56.5T160-720Zm0 320h640v-240H596l84 114-64 46-136-184-136 184-64-46 82-114H160v240Zm200-320q17 0 28.5-11.5T400-760q0-17-11.5-28.5T360-800q-17 0-28.5 11.5T320-760q0 17 11.5 28.5T360-720Zm240 0q17 0 28.5-11.5T640-760q0-17-11.5-28.5T600-800q-17 0-28.5 11.5T560-760q0 17 11.5 28.5T600-720Z"/></svg>
                                </div>

                                <span class="{{ FD['text-0'] }} font-medium text-gray-900 dark:text-white tracking-wide select-all">
                                    {{ strtoupper($cart['coupon_code']) }}
                                </span>
                            </div>

                            {{-- small vertical separator --}}
                            {{-- <span class="hidden sm:inline-block w-px h-5 bg-gray-200 dark:bg-gray-700 mx-2"></span> --}}

                            <button
                                type="button"
                                wire:click="removeCouponCode()"
                                class="ml-1 inline-flex items-center justify-center rounded-full p-1 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-red-500 hover:bg-red-50 dark:hover:bg-red-700 transition"
                                title="Remove coupon"
                                aria-label="Remove coupon {{ $cart['coupon_code'] }}"
                                >
                                <svg class="w-4 h-4 text-red-600 dark:text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @else
                <dl class="flex items-center justify-between gap-4">
                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Coupon Discount</dt>
                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">
                        <a href="javascript: void(0)" 
                            class="{{FD['activeClass']}} hover:text-green-600 dark:hover:text-green-700" 
                            x-data="" 
                            x-on:click.prevent="$dispatch('open-sidebar', 'coupons');"
                        >
                            Apply Coupon
                        </a>
                    </dd>
                </dl>
            @endif
        </div>

        <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pb-3 sm:pb-0"></div>
    </div>

    {{-- {{ dd($cart) }} --}}

    <dl class="flex items-center justify-between gap-4 border-0 dark:border-gray-700 pb-2 sm:pb-0">
        <dt class="{{FD['text']}} font-bold text-gray-900 dark:text-white">Total</dt>
        <dd class="{{FD['text']}} font-bold text-gray-900 dark:text-white">
            <span class="currency-symbol">{{COUNTRY['icon']}}</span><span id="total-amount-show">{{ formatIndianMoney($cart['total']) }}</span>
            <span id="total-amount" class="hidden">{{ $cart['total'] }}</span>
        </dd>
    </dl>

    <div class="flex space-x-2 lg:space-x-0">
        <button id="order-summary-toggle" class="flex lg:hidden w-full items-center justify-center {{ FD['rounded'] }} bg-gray-300 focus:bg-gray-400 px-5 py-2.5 {{FD['text']}} font-medium text-gray=800 hover:bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
            Order summary

            <div class="w-3 h-3 ms-1 text-gray-600 dark:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80 240-320l57-57 183 183 183-183 57 57L480-80ZM298-584l-58-56 240-240 240 240-58 56-182-182-182 182Z"/></svg>
            </div>
        </button>

        @if ($page == 'cart')
            @if (isset($cart['items']) && count($cart['items']) > 0)
                @if ($cartSetting['min_order_value'] > $cart['total'])
                    <a href="javascript: void(0)" class="flex w-full items-center justify-center {{ FD['rounded'] }} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 opacity-75 cursor-no-drop">
                @else
                    <a href="{{route('front.checkout.index')}}" class="flex w-full items-center justify-center {{ FD['rounded'] }} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                @endif
            @endif

                Proceed to Checkout
            </a>
        @endif
    </div>

    @if ($page == 'cart')
        <div class="items-center justify-center gap-2 hidden lg:flex">
            <span class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400"> or </span>
            <a href="{{ route('front.collection.index') }}" class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                Continue Shopping
                <svg class="{{FD['iconClass']}}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" /></svg>
            </a>
        </div>
    @endif

    @if ($page == 'checkout')
        <div class="items-center justify-center gap-2 hidden lg:flex">
            <a href="{{ route('front.cart.index') }}" class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                <svg class="{{FD['iconClass']}}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-200 80-480l280-280 56 56-183 184h647v80H233l184 184-57 56Z"/></svg>
                Back to Cart
            </a>
        </div>
    @endif
</div>