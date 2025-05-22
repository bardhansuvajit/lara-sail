<div>
    <div id="order-items" class="mb-2">
        <div class="{{FD['rounded']}} border border-gray-200 bg-white shadow-sm dark:border-0 dark:drop-shadow-md lg:dark:border lg:dark:border-gray-700 dark:bg-gray-800">
            <div class="mx-auto divide-y-2 overflow-hidden {{FD['rounded']}} antialiased dark:divide-gray-600 dark:drop-shadow-md shadow-sm">
                <div class="p-4">
                    <dl class="flex items-center gap-2">
                        <dt class="font-medium {{FD['text-1']}} leading-tight dark:text-white">Your shopping cart</dt>
                        <dd class="leading-tight {{FD['text-1']}} text-gray-500 dark:text-gray-400">
                            <span class="cart-count">{{count($cart['items'])}} <span class="hidden md:inline-block">items</span></span>
                        </dd>
                    </dl>
                </div>
            </div>

            <div id="cart-products" class="space-y-6 mb-4">
                @foreach ($cart['items'] as $item)
                    <div class="grid grid-cols-3 items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                        <div class="col-span-2">
                            <div class="flex items-center gap-3">
                                <a href="{{ $item['product_url_with_variation'] ? $item['product_url_with_variation'] : $item['product_url'] }}" class="flex aspect-[1/1] h-9 flex-shrink-0 items-center">
                                    @if (!empty($item['image_s']))
                                        <img class="h-auto max-h-full w-full" src="{{$item['image_s']}}" alt="{{$item['product_title']}}" />
                                    @else
                                        {!! FD['brokenImageFront'] !!}
                                    @endif
                                </a>
                                <div class="w-full">
                                    <a href="{{ $item['product_url_with_variation'] ? $item['product_url_with_variation'] : $item['product_url'] }}" class="inline-block text-xs ${{FD['text-0']}} text-gray-900 hover:underline dark:text-white">{{$item['product_title']}}</a>

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
                @endforeach
            </div>
        </div>
    </div>

    <div id="order-summary-container" class="">
        <div class="w-full space-y-4 {{FD['rounded']}} border border-gray-200 bg-white px-2 py-3 lg:p-4 shadow-sm dark:border-0 dark:drop-shadow-md lg:dark:border lg:dark:border-gray-700 dark:bg-gray-800">
            <div id="order-summary" class="hidden lg:block">
                <p class="{{FD['text-1']}} font-semibold text-gray-900 dark:text-white mb-2">Order summary</p>

                <div class="space-y-2">
                    <dl class="flex items-center justify-between gap-4">
                        <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Original price
                        </dt>
                        <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white"><span class="currency-symbol">{{COUNTRY['icon']}}</span>{{ formatIndianMoney($cart['sub_total']) }}</dd>
                    </dl>

                    <dl class="flex items-center justify-between gap-4">
                        <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Savings</dt>
                        <dd class="{{FD['text']}} font-medium text-green-600">-<span class="currency-symbol">{{COUNTRY['icon']}}</span>{{ formatIndianMoney($cart['discount_amount']) }}</dd>
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
                            <button class="{{FD['activeClass']}}">Apply Coupon</button>
                        </dd>
                    </dl>
                </div>

                <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pb-3 sm:pb-0"></div>
            </div>

            <dl class="flex items-center justify-between gap-4 border-0 dark:border-gray-700 pb-2 sm:pb-0">
                <dt class="{{FD['text']}} font-bold text-gray-900 dark:text-white">Total</dt>
                <dd class="{{FD['text']}} font-bold text-gray-900 dark:text-white"><span class="currency-symbol">{{COUNTRY['icon']}}</span>{{ formatIndianMoney($cart['total']) }}</dd>
            </dl>

            <div class="items-center justify-center gap-2 hidden lg:flex">
                <a href="{{ route('front.cart.index') }}" class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                    <svg class="{{FD['iconClass']}}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-200 80-480l280-280 56 56-183 184h647v80H233l184 184-57 56Z"/></svg>
                    Back to Cart
                </a>
            </div>

        </div>
    </div>
</div>