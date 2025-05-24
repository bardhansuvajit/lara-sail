<div class="fixed z-1 sm:static bottom-16 sm:bottom-0 w-full -m-2 sm:m-0 space-y-0 sm:space-y-4 {{FD['rounded']}} border border-gray-200 bg-white px-2 py-3 lg:p-4 shadow-sm dark:border-0 lg:dark:border lg:dark:border-gray-700 dark:bg-gray-800">
    <div id="order-summary" class="hidden lg:block">
        <p class="{{FD['text-1']}} font-semibold text-gray-900 dark:text-white mb-2">Order summary</p>

        <div class="space-y-2">
            <dl class="flex items-center justify-between gap-4">
                <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Original price
                </dt>
                <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white"><span class="currency-symbol">{{COUNTRY['icon']}}</span>{{ formatIndianMoney($cart['mrp']) }}</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4">
                <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Savings</dt>
                <dd class="{{FD['text']}} font-medium text-green-600">-<span class="currency-symbol">{{COUNTRY['icon']}}</span>{{ formatIndianMoney($cart['mrp'] - $cart['sub_total']) }}</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4">
                <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Shipping</dt>
                <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white"><span class="currency-symbol">{{COUNTRY['icon']}}</span>{{ formatIndianMoney($cart['shipping_cost']) }}</dd>
            </dl>

            <dl class="flex items-center justify-between gap-4">
                <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white"><span class="currency-symbol">{{COUNTRY['icon']}}</span>{{ formatIndianMoney($cart['tax_amount']) }}</dd>
            </dl>

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
        </div>

        <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pb-3 sm:pb-0"></div>
    </div>

    <dl class="flex items-center justify-between gap-4 border-0 dark:border-gray-700 pb-2 sm:pb-0">
        <dt class="{{FD['text']}} font-bold text-gray-900 dark:text-white">Total</dt>
        <dd class="{{FD['text']}} font-bold text-gray-900 dark:text-white"><span class="currency-symbol">{{COUNTRY['icon']}}</span>{{ formatIndianMoney($cart['total']) }}</dd>
    </dl>

    <div class="flex space-x-2 lg:space-x-0">
        <button id="order-summary-toggle" class="flex lg:hidden w-full items-center justify-center {{FD['rounded']}} bg-gray-300 focus:bg-gray-400 px-5 py-2.5 {{FD['text']}} font-medium text-gray=800 hover:bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
            Order summary

            <div class="w-3 h-3 ms-1 text-gray-600 dark:text-white">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80 240-320l57-57 183 183 183-183 57 57L480-80ZM298-584l-58-56 240-240 240 240-58 56-182-182-182 182Z"/></svg>
            </div>
        </button>

        @if (request()->is('cart'))
            @if (isset($cart['items']) && count($cart['items']) > 0)
                @if ($cartSetting['min_order_value'] > $cart['total'])
                    <a href="javascript: void(0)" class="flex w-full items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 opacity-75 cursor-no-drop">
                @else
                    <a href="{{route('front.checkout.index')}}" class="flex w-full items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                @endif
            @endif

                Proceed to Checkout
            </a>
        @endif
    </div>

    @if (request()->is('cart'))
        <div class="items-center justify-center gap-2 hidden lg:flex">
            <span class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400"> or </span>
            <a href="{{ route('front.collection.index') }}" class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                Continue Shopping
                <svg class="{{FD['iconClass']}}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" /></svg>
            </a>
        </div>
    @endif

    @if (request()->is('checkout'))
        <div class="items-center justify-center gap-2 hidden lg:flex">
            <a href="{{ route('front.cart.index') }}" class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                <svg class="{{FD['iconClass']}}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-200 80-480l280-280 56 56-183 184h647v80H233l184 184-57 56Z"/></svg>
                Back to Cart
            </a>
        </div>
    @endif
</div>