<x-checkout-layout
    screen="max-w-screen-xl"
    title="{{ __('Checkout') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="pt-4 sm:pt-6 px-2 sm:px-2 md:px-3 lg:px-4 xl:px-4 2xl:px-0">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white sm:text-lg">Checkout</h2>

            <!-- ALERT -->
            @include('front.checkout.includes.alert')

            <div class="mt-4 sm:mt-6 md:gap-6 lg:flex lg:items-start xl:gap-8">
                {{-- left part --}}
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl mb-8">
                    <div class="space-y-2">

                        <!-- ACCOUNT -->
                        @include('front.checkout.includes.account')

                        @if (auth()->guard('web')->check())
                            <!-- ADDRESS -->
                            @include('front.checkout.includes.address')

                            <!-- PAYMENT -->
                            @include('front.checkout.includes.payment')
                        @endif

                    </div>
                </div>

                {{-- right part - cart items & order summary --}}
                <div class="mx-auto mt-6 mb-8 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">

                    {{-- cart items --}}
                    <div class="mx-auto divide-y-2 overflow-hidden {{FD['rounded']}} bg-white antialiased dark:divide-gray-600 dark:bg-gray-800 border border-gray-200 dark:border-0 dark:drop-shadow-md lg:dark:border lg:dark:border-gray-700 shadow-sm">
                        <div class="p-4">
                            <dl class="flex items-center gap-2">
                                <dt class="font-medium {{FD['text-1']}} leading-tight dark:text-white">Your shopping cart</dt>
                                <dd class="leading-tight {{FD['text-1']}} text-gray-500 dark:text-gray-400">(5 items)</dd>
                            </dl>
                        </div>

                        <div class="grid grid-cols-2 items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                            <div class="flex items-center gap-2">
                                <a href="#" class="flex aspect-[1/1] h-9 flex-shrink-0 items-center">
                                    <img class="h-auto max-h-full w-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/iphone-light.svg" alt="imac image">
                                </a>
                                <div class="w-full">
                                    <a href="#" class="block {{FD['text-0']}} text-gray-900 hover:underline dark:text-white">Apple iPhone 15</a>
                                    <p class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-400"><span class="currency-symbol">₹</span>1,299</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-3">
                                <div class="relative flex items-center">
                                    <button type="button" class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                        <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"></path></svg>
                                    </button>

                                    <input type="text" class="w-8 flex-shrink-0 border-0 bg-transparent text-center {{FD['text']}} font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="2" required="">

                                    <button type="button" class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                        <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"></path></svg>
                                    </button>
                                </div>

                                <button type="button" class="text-red-600 hover:text-red-700 dark:text-red-600 dark:hover:text-red-700">
                                    <div class="h-4 w-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-168-88-88 224-224-224-224 88-88 224 224 224-224 88 88-224 224 224 224-88 88-224-224-224 224Z"/></svg>
                                    </div>
                                </button>

                            </div>
                        </div>

                        <div class="grid grid-cols-2 items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                            <div class="flex items-center gap-2">
                                <a href="#" class="flex aspect-[1/1] h-9 flex-shrink-0 items-center">
                                    <img class="h-auto max-h-full w-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ipad-light.svg" alt="imac image">
                                </a>
                                <div class="w-full">
                                    <a href="#" class="block {{FD['text-0']}} text-gray-900 hover:underline dark:text-white">Apple iPhone 15</a>
                                    <p class="{{FD['text-0']}} text-gray-400">some basic description to test the tab, another one</p>
                                    <p class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-400"><span class="currency-symbol">₹</span>1,299</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-3">
                                <div class="relative flex items-center">
                                    <button type="button" class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                        <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"></path></svg>
                                    </button>

                                    <input type="text" class="w-8 flex-shrink-0 border-0 bg-transparent text-center {{FD['text']}} font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="2" required="">

                                    <button type="button" class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                        <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"></path></svg>
                                    </button>
                                </div>

                                <button type="button" class="text-red-600 hover:text-red-700 dark:text-red-600 dark:hover:text-red-700">
                                    <div class="h-4 w-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-168-88-88 224-224-224-224 88-88 224 224 224-224 88 88-224 224 224 224-88 88-224-224-224 224Z"/></svg>
                                    </div>
                                </button>

                            </div>
                        </div>

                        <div class="grid grid-cols-2 items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                            <div class="flex items-center gap-2">
                                <a href="#" class="flex aspect-[1/1] h-9 flex-shrink-0 items-center">
                                    <img class="h-auto max-h-full w-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ps5-dark.svg" alt="imac image">
                                </a>
                                <div class="w-full">
                                    <a href="#" class="block {{FD['text-0']}} text-gray-900 hover:underline dark:text-white">Apple iPhone 15</a>
                                    <p class="{{FD['text-0']}} text-gray-400">some basic description to test the tab, another one</p>
                                    <p class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-400"><span class="currency-symbol">₹</span>1,299</p>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-3">
                                <div class="relative flex items-center">
                                    <button type="button" class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                        <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"></path></svg>
                                    </button>

                                    <input type="text" class="w-8 flex-shrink-0 border-0 bg-transparent text-center {{FD['text']}} font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="2" required="">

                                    <button type="button" class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                        <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"></path></svg>
                                    </button>
                                </div>
            
                                <button type="button" class="text-red-600 hover:text-red-700 dark:text-red-600 dark:hover:text-red-700">
                                    <div class="h-4 w-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-168-88-88 224-224-224-224 88-88 224 224 224-224 88 88-224 224 224 224-88 88-224-224-224 224Z"/></svg>
                                    </div>
                                </button>
            
                            </div>
                        </div>
            
                        <div class="grid grid-cols-2 items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                            <div class="flex items-center gap-2">
                                <a href="#" class="flex aspect-[1/1] h-9 flex-shrink-0 items-center">
                                    <img class="h-auto max-h-full w-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/iphone-dark.svg" alt="imac image">
                                </a>
                                <div class="w-full">
                                    <a href="#" class="block {{FD['text-0']}} text-gray-900 hover:underline dark:text-white">Apple iPhone 15</a>
                                    <p class="{{FD['text-0']}} text-gray-400">some basic description to test the tab, another one</p>
                                    <p class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-400"><span class="currency-symbol">₹</span>1,299</p>
                                </div>
                            </div>
            
                            <div class="flex items-center justify-end gap-3">
                                <div class="relative flex items-center">
                                    <button type="button" class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                        <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"></path></svg>
                                    </button>
            
                                    <input type="text" class="w-8 flex-shrink-0 border-0 bg-transparent text-center {{FD['text']}} font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="2" required="">
            
                                    <button type="button" class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                        <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"></path></svg>
                                    </button>
                                </div>
            
                                <button type="button" class="text-red-600 hover:text-red-700 dark:text-red-600 dark:hover:text-red-700">
                                    <div class="h-4 w-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-168-88-88 224-224-224-224 88-88 224 224 224-224 88 88-224 224 224 224-88 88-224-224-224 224Z"/></svg>
                                    </div>
                                </button>
            
                            </div>
                        </div>
            
                        <div class="grid grid-cols-2 items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                            <div class="flex items-center gap-2">
                                <a href="#" class="flex aspect-[1/1] h-9 flex-shrink-0 items-center">
                                    <img class="h-auto max-h-full w-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-light.svg" alt="imac image">
                                </a>
                                <div class="w-full">
                                    <a href="#" class="block {{FD['text-0']}} text-gray-900 hover:underline dark:text-white">Apple iPhone 15 Apple pro max 16GB, Sky Blue, Some more texts to check the heigh tfot on theis cart drawer</a>
                                    <p class="{{FD['text-0']}} text-gray-400">some basic description to test the tab, another one</p>
                                    <p class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-400"><span class="currency-symbol">₹</span>1,299</p>
                                </div>
                            </div>
            
                            <div class="flex items-center justify-end gap-3">
                                <div class="relative flex items-center">
                                    <button type="button" class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                        <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"></path></svg>
                                    </button>
            
                                    <input type="text" class="w-8 flex-shrink-0 border-0 bg-transparent text-center {{FD['text']}} font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="2" required="">
            
                                    <button type="button" class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                        <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"></path></svg>
                                    </button>
                                </div>

                                <button type="button" class="text-red-600 hover:text-red-700 dark:text-red-600 dark:hover:text-red-700">
                                    <div class="h-4 w-4">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-168-88-88 224-224-224-224 88-88 224 224 224-224 88 88-224 224 224 224-88 88-224-224-224 224Z"/></svg>
                                    </div>
                                </button>

                            </div>
                        </div>
                    </div>

                    {{-- order summary --}}
                    <div class="w-full space-y-4 {{FD['rounded']}} border border-gray-200 bg-white px-2 py-3 lg:p-4 shadow-sm dark:border-0 dark:drop-shadow-md lg:dark:border lg:dark:border-gray-700 dark:bg-gray-800">
                    {{-- <div class="fixed z-1 sm:static bottom-16 sm:bottom-0 w-full -m-2 sm:m-0 space-y-0 sm:space-y-4 {{FD['rounded']}} border border-gray-200 bg-white px-2 py-3 lg:p-6 shadow-sm dark:border-0 dark:drop-shadow-md lg:dark:border lg:dark:border-gray-700 dark:bg-gray-800"> --}}
                        <div id="order-summary" class="hidden lg:block">
                            <p class="{{FD['text-1']}} font-semibold text-gray-900 dark:text-white mb-2">Order summary</p>

                            <div class="space-y-2">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Original price
                                    </dt>
                                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white"><span class="currency-symbol">₹</span>7,592.00</dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Savings</dt>
                                    <dd class="{{FD['text']}} font-medium text-green-600">-<span class="currency-symbol">₹</span>299.00</dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white"><span class="currency-symbol">₹</span>799</dd>
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
                            <dd class="{{FD['text']}} font-bold text-gray-900 dark:text-white"><span class="currency-symbol">₹</span>8,191.00</dd>
                        </dl>

                        {{-- <div class="flex space-x-2 lg:space-x-0">
                            <button id="order-summary-toggle" class="flex lg:hidden w-full items-center justify-center {{FD['rounded']}} bg-gray-300 focus:bg-gray-400 px-5 py-2.5 {{FD['text']}} font-medium text-gray=800 hover:bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                Order summary

                                <div class="w-3 h-3 ms-1 text-gray-600 dark:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80 240-320l57-57 183 183 183-183 57 57L480-80ZM298-584l-58-56 240-240 240 240-58 56-182-182-182 182Z"/></svg>
                                </div>
                            </button> --}}

                            {{-- <a href="{{route('front.checkout.index')}}" class="flex w-full items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Proceed to Checkout
                            </a> --}}
                        {{-- </div> --}}

                        <div class="items-center justify-center gap-2 hidden lg:flex">
                            <a href="{{ route('front.cart.index') }}" class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                                <svg class="{{FD['iconClass']}}" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-200 80-480l280-280 56 56-183 184h647v80H233l184 184-57 56Z"/></svg>
                                Back to Cart
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</x-checkout-layout>