<x-dropdown width="96">
    <x-slot name="trigger">
        <button type="button" class="inline-flex items-center {{FD['rounded']}} justify-center p-2 hover:bg-gray-100 {{FD['text']}} font-medium leading-tight dark:text-white dark:hover:bg-gray-700/100">
            <svg class="w-4 h-4 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"></path></svg>

            <span class="hidden sm:flex me-1.5">4 items</span>
            {{-- ($106.7) --}}

            {!! FD['dropdownCaret'] !!}
        </button>
    </x-slot>
    <x-slot name="content">
        <div class="z-50 mx-auto divide-y-2 overflow-hidden {{FD['rounded']}} bg-white antialiased shadow dark:divide-gray-600 dark:bg-gray-700">
            <div class="px-4 py-4">
                <dl class="flex items-center gap-2">
                    <dt class="font-medium {{FD['text-1']}} leading-tight dark:text-white">Your shopping cart</dt>
                    <dd class="leading-tight {{FD['text-1']}} text-gray-500 dark:text-gray-400">(5 items)</dd>
                </dl>
            </div>

            <div class="grid grid-cols-2 items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                <div class="flex items-center gap-2">
                    <a href="#" class="flex aspect-[1/1] h-9 w-9 flex-shrink-0 items-center">
                        <img class="h-auto max-h-full w-full dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/iphone-light.svg" alt="imac image">

                        <img class="hidden h-auto max-h-full w-full dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/iphone-dark.svg" alt="imac image">
                    </a>
                    <div>
                        <a href="#" class="truncate {{FD['text']}} font-semibold leading-tight text-gray-900 hover:underline dark:text-white">Apple iPhone 15</a>

                        <p class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-400">$1,299</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <form action="#">
                        <div class="relative flex items-center">
                            <button type="button" class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center rounded border border-gray-300 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"></path>
                                </svg>
                            </button>

                            <input type="text" class="w-10 flex-shrink-0 border-0 bg-transparent text-center {{FD['text']}} font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="2" required="">

                            <button type="button" id="increment-button-20"
                            
                                class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center rounded border border-gray-300 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                <svg class="h-2.5 w-2.5 dark:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <button data-tooltip-target="tooltipRemoveItem20" type="button" class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-600">
                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z">
                            </path>
                        </svg>
                    </button>
                    <div id="tooltipRemoveItem20" role="tooltip"
                        class="invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 {{FD['text']}} font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                        data-popper-reference-hidden="" data-popper-escaped=""
                        data-popper-placement="bottom"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 8px);">
                        Remove
                        <div class="POMYoNHqN8pOsNYFYFHr" data-popper-arrow=""
                            style="position: absolute; left: 0px; transform: translate(0px, 0px);">
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 items-center p-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                <div class="flex items-center gap-2">
                    <a href="#"
                        class="flex aspect-[1/1] h-9 w-9 flex-shrink-0 items-center">
                        <img class="h-auto max-h-full w-full dark:hidden"
                            src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ipad-light.svg"
                            alt="imac image">
                        <img class="hidden h-auto max-h-full w-full dark:block"
                            src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ipad-dark.svg"
                            alt="imac image">
                    </a>
                    <div>
                        <a href="#" class="truncate {{FD['text']}} font-semibold leading-tight text-gray-900 hover:underline dark:text-white">Apple iPad PRO</a>
                        <p class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-400">$1,899</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <form action="#">
                        <div class="relative flex items-center">
                            <button type="button"
                            
                                class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center rounded border border-gray-300 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                <svg class="h-2.5 w-2.5 dark:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" d="M1 1h16"></path>
                                </svg>
                            </button>
                            <input type="text"
                                class="w-10 flex-shrink-0 border-0 bg-transparent text-center {{FD['text']}} font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                                placeholder="" value="3" required="">
                            <button type="button" id="increment-button-21"
                            
                                class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center rounded border border-gray-300 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                <svg class="h-2.5 w-2.5 dark:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <button data-tooltip-target="tooltipRemoveItem21" type="button"
                        class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-600">
                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z">
                            </path>
                        </svg>
                    </button>
                    <div id="tooltipRemoveItem21" role="tooltip"
                        class="invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 {{FD['text']}} font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                        data-popper-reference-hidden="" data-popper-escaped=""
                        data-popper-placement="bottom"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 8px);">
                        Remove
                        <div class="POMYoNHqN8pOsNYFYFHr" data-popper-arrow=""
                            style="position: absolute; left: 0px; transform: translate(0px, 0px);">
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 items-center p-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                <div class="flex items-center gap-2">
                    <a href="#"
                        class="flex aspect-[1/1] h-9 w-9 flex-shrink-0 items-center">
                        <img class="h-auto max-h-full w-full dark:hidden"
                            src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ps5-light.svg"
                            alt="imac image">
                        <img class="hidden h-auto max-h-full w-full dark:block"
                            src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ps5-dark.svg"
                            alt="imac image">
                    </a>
                    <div>
                        <a href="#"
                            class="truncate {{FD['text']}} font-semibold leading-tight text-gray-900 hover:underline dark:text-white">Apple
                            iPad PRO</a>
                        <p
                            class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-400">
                            $899</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <form action="#">
                        <div class="relative flex items-center">
                            <button type="button"
                            
                                class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center rounded border border-gray-300 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                <svg class="h-2.5 w-2.5 dark:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" d="M1 1h16"></path>
                                </svg>
                            </button>
                            <input type="text"
                                class="w-10 flex-shrink-0 border-0 bg-transparent text-center {{FD['text']}} font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                                placeholder="" value="1" required="">
                            <button type="button" id="increment-button-22"
                            
                                class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center rounded border border-gray-300 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                <svg class="h-2.5 w-2.5 dark:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <button data-tooltip-target="tooltipRemoveItem22" type="button"
                        class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-600">
                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z">
                            </path>
                        </svg>
                    </button>
                    <div id="tooltipRemoveItem22" role="tooltip"
                        class="invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 {{FD['text']}} font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                        data-popper-reference-hidden="" data-popper-escaped=""
                        data-popper-placement="bottom"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 8px);">
                        Remove
                        <div class="POMYoNHqN8pOsNYFYFHr" data-popper-arrow=""
                            style="position: absolute; left: 0px; transform: translate(0px, 0px);">
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 items-center p-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                <div class="flex items-center gap-2">
                    <a href="#"
                        class="flex aspect-[1/1] h-9 w-9 flex-shrink-0 items-center">
                        <img class="h-auto max-h-full w-full dark:hidden"
                            src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/iphone-light.svg"
                            alt="imac image">
                        <img class="hidden h-auto max-h-full w-full dark:block"
                            src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/iphone-dark.svg"
                            alt="imac image">
                    </a>
                    <div>
                        <a href="#"
                            class="truncate {{FD['text']}} font-semibold leading-tight text-gray-900 hover:underline dark:text-white">Apple
                            iPhone 15</a>
                        <p
                            class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-400">
                            $999</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <form action="#">
                        <div class="relative flex items-center">
                            <button type="button"
                            
                                class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center rounded border border-gray-300 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                <svg class="h-2.5 w-2.5 dark:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" d="M1 1h16"></path>
                                </svg>
                            </button>
                            <input type="text"
                                class="w-10 flex-shrink-0 border-0 bg-transparent text-center {{FD['text']}} font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                                placeholder="" value="1" required="">
                            <button type="button" id="increment-button-23"
                            
                                class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center rounded border border-gray-300 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                <svg class="h-2.5 w-2.5 dark:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <button data-tooltip-target="tooltipRemoveItem23" type="button"
                        class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-600">
                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z">
                            </path>
                        </svg>
                    </button>
                    <div id="tooltipRemoveItem23" role="tooltip"
                        class="invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 {{FD['text']}} font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                        data-popper-reference-hidden="" data-popper-escaped=""
                        data-popper-placement="bottom"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 8px);">
                        Remove
                        <div class="POMYoNHqN8pOsNYFYFHr" data-popper-arrow=""
                            style="position: absolute; left: 0px; transform: translate(0px, 0px);">
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 items-center p-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                <div class="flex items-center gap-2">
                    <a href="#"
                        class="flex aspect-[1/1] h-9 w-9 flex-shrink-0 items-center">
                        <img class="h-auto max-h-full w-full dark:hidden"
                            src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-light.svg"
                            alt="imac image">
                        <img class="hidden h-auto max-h-full w-full dark:block"
                            src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-dark.svg"
                            alt="imac image">
                    </a>
                    <div>
                        <a href="#"
                            class="truncate {{FD['text']}} font-semibold leading-tight text-gray-900 hover:underline dark:text-white">Apple
                            Watch</a>
                        <p
                            class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-400">
                            $1,099</p>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <form action="#">
                        <div class="relative flex items-center">
                            <button type="button"
                            
                                class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center rounded border border-gray-300 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                <svg class="h-2.5 w-2.5 dark:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 18 2">
                                    <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" d="M1 1h16"></path>
                                </svg>
                            </button>
                            <input type="text"
                                class="w-10 flex-shrink-0 border-0 bg-transparent text-center {{FD['text']}} font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                                placeholder="" value="2" required="">
                            <button type="button" id="increment-button-24"
                            
                                class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center rounded border border-gray-300 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700">
                                <svg class="h-2.5 w-2.5 dark:text-white"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </form>
                    <button data-tooltip-target="tooltipRemoveItem24" type="button"
                        class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-600">
                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z">
                            </path>
                        </svg>
                    </button>
                    <div id="tooltipRemoveItem24" role="tooltip"
                        class="invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 {{FD['text']}} font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                        data-popper-reference-hidden="" data-popper-escaped=""
                        data-popper-placement="bottom"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 8px);">
                        Remove
                        <div class="POMYoNHqN8pOsNYFYFHr" data-popper-arrow=""
                            style="position: absolute; left: 0px; transform: translate(0px, 0px);">
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-4 p-4 dark:border-gray-600">
                <dl class="flex items-center justify-between">
                    <dt
                        class="font-semibold leading-tight dark:text-white">
                        Total
                    </dt>

                    <dd
                        class="font-semibold leading-tight dark:text-white">
                        $6,196
                    </dd>
                </dl>

                <a href="#" title=""
                    class="mb-2 me-2 inline-flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                    role="button"> See your cart </a>
            </div>
        </div>
    </x-slot>
</x-dropdown>