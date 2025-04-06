<x-front.dropdown width="96">
    <x-slot name="trigger">
        <button type="button" class="hidden sm:inline-flex items-center {{FD['rounded']}} justify-center p-2 hover:bg-gray-100 {{FD['text']}} font-medium leading-tight dark:text-white dark:hover:bg-gray-700/100">
            <svg class="w-4 h-4 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"></path></svg>

            <span class="hidden lg:block me-1.5">4 items</span>
            {{-- (<span class="currency-symbol">₹</span>106.7) --}}

            {!! FD['dropdownCaret'] !!}
        </button>
    </x-slot>
    <x-slot name="content">
        <div class="z-50 mx-auto divide-y-2 overflow-hidden {{FD['rounded']}} bg-white antialiased dark:divide-gray-600 dark:bg-gray-700">
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

            <div class="space-y-4 px-3 py-2 dark:border-gray-600">
                <dl class="flex items-center justify-between">
                    <dt class="font-medium {{FD['text-1']}} leading-tight dark:text-white">Total</dt>
                    <dd class="font-semibold {{FD['text-1']}} leading-tight dark:text-white"><span class="currency-symbol">₹</span>6,196</dd>
                </dl>

                <div class="flex space-x-2">
                    <a href="{{route('front.cart.index')}}" title="" class="inline-flex w-full items-center justify-center {{FD['rounded']}} bg-primary-600 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"> See your cart </a>

                    <a href="{{route('front.checkout.index')}}" title="" class="inline-flex w-full items-center justify-center {{FD['rounded']}} bg-primary-600 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"> Checkout </a>
                </div>
            </div>
        </div>
    </x-slot>
</x-front.dropdown>