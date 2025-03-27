<x-app-layout
    screen="max-w-screen-xl"
    title="{{ __('Dashboard') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased mt-36 sm:mt-44">
        <div class="pt-4 px-2 sm:pt-6 sm:px-0">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white sm:text-lg">Shopping Cart</h2>

            {{-- <ol class="items-center flex w-full max-w-2xl text-center text-sm font-medium text-gray-500 dark:text-gray-400 sm:text-base">
                <li
                    class="after:border-1 flex items-center text-primary-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 dark:text-primary-500 dark:after:border-gray-700 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
                    <span
                        class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:after:hidden">
                        <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Cart
                    </span>
                </li>

                <li
                    class="after:border-1 flex items-center text-primary-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-gray-200 dark:text-primary-500 dark:after:border-gray-700 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
                    <span
                        class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:after:hidden">
                        <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        Checkout
                    </span>
                </li>

                <li class="flex shrink-0 items-center">
                    <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Order summary
                </li>
            </ol> --}}

            <div class="flex w-full items-center gap-3 sm:gap-4 {{FD['activeBgClass']}} px-2 sm:px-4 py-1 mt-2 sm:mt-4 font-light">
                <div class="{{FD['iconClass']}} lg:w-6 lg:h-6">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M280-160q-50 0-85-35t-35-85H60l18-80h113q17-19 40-29.5t49-10.5q26 0 49 10.5t40 29.5h167l84-360H262l17-80h441l-37 160h117l120 160-40 200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H400q0 50-35 85t-85 35Zm357-280h193l4-21-74-99h-95l-28 120Zm-17-280-84 360 2-7 82-353ZM140-440v-120H40l140-200v120h100L140-440Zm140 200q17 0 28.5-11.5T320-280q0-17-11.5-28.5T280-320q-17 0-28.5 11.5T240-280q0 17 11.5 28.5T280-240Zm400 0q17 0 28.5-11.5T720-280q0-17-11.5-28.5T680-320q-17 0-28.5 11.5T640-280q0 17 11.5 28.5T680-240Z"/></svg>
                </div>

                <p class="{{FD['text']}}">
                    You are only 
                    <span class="font-medium"><span class="currency-icon">$</span><span id="free-shipping-amount">99.99</span></span> 
                    away from 
                    <span class="font-medium">Free Shipping</span> 
                    <a href="#" class="font-medium underline hover:no-underline block">How do i get this ?</a>
                </p>
            </div>

            <div class="mt-4 sm:mt-6 md:gap-6 lg:flex lg:items-start xl:gap-8">
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                    <div class="space-y-6" id="cart-products">

                        {{-- single product --}}
                        <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">
                            {{-- product details --}}
                            <div class="space-y-4 flex items-center justify-between gap-2 sm:gap-6 sm:mb-2">
                                <a href="#" class="w-24 shrink-1 md:order-1">
                                    <img class="h-20 w-20" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="imac image" />
                                </a>

                                <div class="w-full min-w-0 flex-1 md:order-2">
                                    <a href="#" class="block {{FD['text']}} leading-tight font-medium text-gray-900 hover:underline dark:text-gray-300 mb-1 sm:mb-2">
                                        PC system All in One APPLE iMac (2023) mqrq3ro/a, Apple M3, 24" Retina 4.5K, 8GB, SSD 256GB, 10-core GPU, Keyboard layout INT
                                    </a>

                                    <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400">here lies the product description. Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro laudantium aut officia ipsa reiciendis provident quibusdam soluta possimus. Quos, numquam excepturi nulla alias ab officiis! Illo, pariatur unde. Consequuntur, obcaecati?</p>

                                    <div class="flex space-x-4 items-center mt-3">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <button type="button" class="inline-flex h-5 w-5 shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" /></svg>
                                                </button>
        
                                                <input type="text" class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="2" />
        
                                                <button type="button" class="inline-flex h-5 w-5 shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" /></svg>
                                                </button>
                                            </div>
                                        </div>

                                        <p class="{{FD['text']}} font-bold text-gray-900 dark:text-gray-50"><span class="currency-icon">$</span>1,09,699</p>
                                    </div>

                                </div>
                            </div>

                            {{-- upsell --}}
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
                                                <span class="currency-icon">$</span>1,09,699
                                            </p>
                                            <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                                <span class="currency-icon">$</span>17,699
                                            </p>
                                            <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                                40% off
                                            </p>
                                        </div>

                                        <button class="{{FD['rounded']}} w-full {{FD['text-0']}} bg-primary-700 dark:bg-primary-600 hover:bg-primary-800 dark:hover:bg-primary-700 p-1">
                                            Add item
                                        </button>
                                    </a>
                                </div>
                            </div>

                            {{-- save for later & remove --}}
                            <div class="flex items-center gap-4 mt-2 pt-2 sm:pt-4 border-t dark:border-gray-700">
                                <button type="button" class="{{FD['text']}} inline-flex gap-2 items-center text-sm font-medium text-gray-600 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-white">
                                    <div class="{{FD['iconClass']}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120v-640q0-33 23.5-56.5T280-840h240v80H280v518l200-86 200 86v-278h80v400L480-240 200-120Zm80-640h240-240Zm400 160v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Z"/></svg>
                                    </div>
                                    Save for later
                                </button>

                                <button type="button" class="{{FD['text']}} inline-flex gap-2 items-center text-sm font-medium text-red-500 hover:text-red-700 hover:underline dark:text-red-600 dark:hover:text-red-700">
                                    <div class="{{FD['iconClass']}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                                    </div>
                                    Remove
                                </button>
                            </div>
                        </div>

                        {{-- single product --}}
                        <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">
                            {{-- product details --}}
                            <div class="space-y-4 flex items-center justify-between gap-2 sm:gap-6 sm:mb-2">
                                <a href="#" class="w-24 shrink-1 md:order-1">
                                    <img class="h-20 w-20" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/iphone-dark.svg" alt="imac image" />
                                </a>

                                <div class="w-full min-w-0 flex-1 md:order-2">
                                    <a href="#" class="block {{FD['text']}} leading-tight font-medium text-gray-900 hover:underline dark:text-gray-300 mb-1 sm:mb-2">
                                        PC system All in One APPLE iMac (2023) mqrq3ro/a, Apple M3, 24" Retina 4.5K, 8GB, SSD 256GB, 10-core GPU, Keyboard layout INT
                                    </a>

                                    <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400">here lies the product description. Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro laudantium aut officia ipsa reiciendis provident quibusdam soluta possimus. Quos, numquam excepturi nulla alias ab officiis! Illo, pariatur unde. Consequuntur, obcaecati?</p>

                                    <div class="flex space-x-4 items-center mt-3">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <button type="button" class="inline-flex h-5 w-5 shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" /></svg>
                                                </button>

                                                <input type="text" class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="2" />

                                                <button type="button" class="inline-flex h-5 w-5 shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" /></svg>
                                                </button>
                                            </div>
                                        </div>

                                        <p class="{{FD['text']}} font-bold text-gray-900 dark:text-gray-50"><span class="currency-icon">$</span>1,09,699</p>
                                    </div>

                                </div>
                            </div>

                            {{-- save for later & remove --}}
                            <div class="flex items-center gap-4 mt-2 pt-2 sm:pt-4 border-t dark:border-gray-700">
                                <button type="button" class="{{FD['text']}} inline-flex gap-2 items-center text-sm font-medium text-gray-600 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-white">
                                    <div class="{{FD['iconClass']}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120v-640q0-33 23.5-56.5T280-840h240v80H280v518l200-86 200 86v-278h80v400L480-240 200-120Zm80-640h240-240Zm400 160v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Z"/></svg>
                                    </div>
                                    Save for later
                                </button>

                                <button type="button" class="{{FD['text']}} inline-flex gap-2 items-center text-sm font-medium text-red-500 hover:text-red-700 hover:underline dark:text-red-600 dark:hover:text-red-700">
                                    <div class="{{FD['iconClass']}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                                    </div>
                                    Remove
                                </button>
                            </div>
                        </div>

                        {{-- single product --}}
                        <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">
                            {{-- product details --}}
                            <div class="space-y-4 flex items-center justify-between gap-2 sm:gap-6 sm:mb-2">
                                <a href="#" class="w-24 shrink-1 md:order-1">
                                    <img class="h-20 w-20" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ipad-light.svg" alt="imac image" />
                                </a>

                                <div class="w-full min-w-0 flex-1 md:order-2">
                                    <a href="#" class="block {{FD['text']}} leading-tight font-medium text-gray-900 hover:underline dark:text-gray-300 mb-1 sm:mb-2">
                                        PC system All in One APPLE iMac (2023) mqrq3ro/a, Apple M3, 24" Retina 4.5K, 8GB, SSD 256GB, 10-core GPU, Keyboard layout INT
                                    </a>

                                    <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400">here lies the product description. Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro laudantium aut officia ipsa reiciendis provident quibusdam soluta possimus. Quos, numquam excepturi nulla alias ab officiis! Illo, pariatur unde. Consequuntur, obcaecati?</p>

                                    <div class="flex space-x-4 items-center mt-3">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <button type="button" class="inline-flex h-5 w-5 shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" /></svg>
                                                </button>

                                                <input type="text" class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="2" />

                                                <button type="button" class="inline-flex h-5 w-5 shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" /></svg>
                                                </button>
                                            </div>
                                        </div>

                                        <p class="{{FD['text']}} font-bold text-gray-900 dark:text-gray-50"><span class="currency-icon">$</span>1,09,699</p>
                                    </div>

                                </div>
                            </div>

                            {{-- save for later & remove --}}
                            <div class="flex items-center gap-4 mt-2 pt-2 sm:pt-4 border-t dark:border-gray-700">
                                <button type="button" class="{{FD['text']}} inline-flex gap-2 items-center text-sm font-medium text-gray-600 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-white">
                                    <div class="{{FD['iconClass']}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120v-640q0-33 23.5-56.5T280-840h240v80H280v518l200-86 200 86v-278h80v400L480-240 200-120Zm80-640h240-240Zm400 160v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Z"/></svg>
                                    </div>
                                    Save for later
                                </button>

                                <button type="button" class="{{FD['text']}} inline-flex gap-2 items-center text-sm font-medium text-red-500 hover:text-red-700 hover:underline dark:text-red-600 dark:hover:text-red-700">
                                    <div class="{{FD['iconClass']}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                                    </div>
                                    Remove
                                </button>
                            </div>
                        </div>

                        {{-- single product --}}
                        <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">
                            {{-- product details --}}
                            <div class="space-y-4 flex items-center justify-between gap-2 sm:gap-6 sm:mb-2">
                                <a href="#" class="w-24 shrink-1 md:order-1">
                                    <img class="h-20 w-20" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/macbook-pro-light.svg" alt="imac image" />
                                </a>

                                <div class="w-full min-w-0 flex-1 md:order-2">
                                    <a href="#" class="block {{FD['text']}} leading-tight font-medium text-gray-900 hover:underline dark:text-gray-300 mb-1 sm:mb-2">
                                        PC system All in One APPLE iMac (2023) mqrq3ro/a, Apple M3, 24" Retina 4.5K, 8GB, SSD 256GB, 10-core GPU, Keyboard layout INT
                                    </a>

                                    <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400">here lies the product description. Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro laudantium aut officia ipsa reiciendis provident quibusdam soluta possimus. Quos, numquam excepturi nulla alias ab officiis! Illo, pariatur unde. Consequuntur, obcaecati?</p>

                                    <div class="flex space-x-4 items-center mt-3">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <button type="button" class="inline-flex h-5 w-5 shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" /></svg>
                                                </button>

                                                <input type="text" class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="2" />

                                                <button type="button" class="inline-flex h-5 w-5 shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" /></svg>
                                                </button>
                                            </div>
                                        </div>

                                        <p class="{{FD['text']}} font-bold text-gray-900 dark:text-gray-50"><span class="currency-icon">$</span>1,09,699</p>
                                    </div>

                                </div>
                            </div>

                            {{-- save for later & remove --}}
                            <div class="flex items-center gap-4 mt-2 pt-2 sm:pt-4 border-t dark:border-gray-700">
                                <button type="button" class="{{FD['text']}} inline-flex gap-2 items-center text-sm font-medium text-gray-600 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-white">
                                    <div class="{{FD['iconClass']}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120v-640q0-33 23.5-56.5T280-840h240v80H280v518l200-86 200 86v-278h80v400L480-240 200-120Zm80-640h240-240Zm400 160v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Z"/></svg>
                                    </div>
                                    Save for later
                                </button>

                                <button type="button" class="{{FD['text']}} inline-flex gap-2 items-center text-sm font-medium text-red-500 hover:text-red-700 hover:underline dark:text-red-600 dark:hover:text-red-700">
                                    <div class="{{FD['iconClass']}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                                    </div>
                                    Remove
                                </button>
                            </div>
                        </div>

                        {{-- single product --}}
                        <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">
                            {{-- product details --}}
                            <div class="space-y-4 flex items-center justify-between gap-2 sm:gap-6 sm:mb-2">
                                <a href="#" class="w-24 shrink-1 md:order-1">
                                    <img class="h-20 w-20" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/apple-watch-dark.svg" alt="imac image" />
                                </a>

                                <div class="w-full min-w-0 flex-1 md:order-2">
                                    <a href="#" class="block {{FD['text']}} leading-tight font-medium text-gray-900 hover:underline dark:text-gray-300 mb-1 sm:mb-2">
                                        PC system All in One APPLE iMac (2023) mqrq3ro/a, Apple M3, 24" Retina 4.5K, 8GB, SSD 256GB, 10-core GPU, Keyboard layout INT
                                    </a>

                                    <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400">here lies the product description. Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro laudantium aut officia ipsa reiciendis provident quibusdam soluta possimus. Quos, numquam excepturi nulla alias ab officiis! Illo, pariatur unde. Consequuntur, obcaecati?</p>

                                    <div class="flex space-x-4 items-center mt-3">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center">
                                                <button type="button" class="inline-flex h-5 w-5 shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16" /></svg>
                                                </button>

                                                <input type="text" class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="2" />

                                                <button type="button" class="inline-flex h-5 w-5 shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                    <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" /></svg>
                                                </button>
                                            </div>
                                        </div>

                                        <p class="{{FD['text']}} font-bold text-gray-900 dark:text-gray-50"><span class="currency-icon">$</span>1,09,699</p>
                                    </div>

                                </div>
                            </div>

                            {{-- save for later & remove --}}
                            <div class="flex items-center gap-4 mt-2 pt-2 sm:pt-4 border-t dark:border-gray-700">
                                <button type="button" class="{{FD['text']}} inline-flex gap-2 items-center text-sm font-medium text-gray-600 hover:text-gray-900 hover:underline dark:text-gray-400 dark:hover:text-white">
                                    <div class="{{FD['iconClass']}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120v-640q0-33 23.5-56.5T280-840h240v80H280v518l200-86 200 86v-278h80v400L480-240 200-120Zm80-640h240-240Zm400 160v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Z"/></svg>
                                    </div>
                                    Save for later
                                </button>

                                <button type="button" class="{{FD['text']}} inline-flex gap-2 items-center text-sm font-medium text-red-500 hover:text-red-700 hover:underline dark:text-red-600 dark:hover:text-red-700">
                                    <div class="{{FD['iconClass']}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                                    </div>
                                    Remove
                                </button>
                            </div>
                        </div>

                    </div>

                    <div class="bg-gray-50 mb-4 py-4 antialiased dark:bg-gray-900 mt-6 shadow">
                        <div class="mx-auto max-w-screen-xl px-2 sm:px-4">
                            <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                                <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                            </div>
                
                            <div class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-4" id="featured-products">
                
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
                                                <span class="currency-icon">$</span>1,09,699
                                            </p>
                                            <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                                <span class="currency-icon">$</span>17,699
                                            </p>
                                            <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                                40% off
                                            </p>
                                        </div>
                                    </a>
                                </div>
                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mx-auto mt-6 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">
                    <div class="fixed z-10 lg:static bottom-16 lg:bottom-0 w-full -m-2 lg:m-0 space-y-2 lg:space-y-4 {{FD['rounded']}} border border-gray-200 bg-white px-2 py-3 lg:p-6 shadow-sm dark:border-0 dark:drop-shadow-md lg:dark:border lg:dark:border-gray-700 dark:bg-gray-800">
                        <div class="hidden lg:block">
                            <p class="{{FD['text-1']}} font-semibold text-gray-900 dark:text-white mb-2">Order summary</p>

                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Original price
                                        </dt>
                                        <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">$7,592.00</dd>
                                    </dl>

                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Savings</dt>
                                        <dd class="{{FD['text']}} font-medium text-green-600">-$299.00</dd>
                                    </dl>

                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Tax</dt>
                                        <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">$799</dd>
                                    </dl>

                                    <dl class="flex items-center justify-between gap-4">
                                        <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Coupon Discount</dt>
                                        <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">
                                            <button class="{{FD['activeClass']}}">Apply Coupon</button>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 dark:border-gray-700"></div>

                        <dl class="flex items-center justify-between gap-4 border-0 dark:border-gray-700">
                            <dt class="{{FD['text']}} font-bold text-gray-900 dark:text-white">Total</dt>
                            <dd class="{{FD['text']}} font-bold text-gray-900 dark:text-white">$8,191.00</dd>
                        </dl>

                        <div class="flex space-x-2 lg:space-x-0">
                            <button class="flex lg:hidden w-full items-center justify-center {{FD['rounded']}} bg-gray-300 focus:bg-gray-400 px-5 py-2.5 {{FD['text']}} font-medium text-gray=800 hover:bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                Order summary
                            </button>

                            <a href="#" class="flex w-full items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Proceed to Checkout
                            </a>
                        </div>

                        <div class="items-center justify-center gap-2 hidden lg:flex">
                            <span class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400"> or </span>
                            <a href="#" class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">
                                Continue Shopping
                                <svg class="{{FD['iconClass']}}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" /></svg>
                            </a>
                        </div>
                    </div>

                    {{-- <div class="space-y-4 {{FD['rounded']}} border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                        <form class="space-y-4">
                            <div>
                                <label for="voucher" class="mb-2 block {{FD['text']}} font-medium text-gray-900 dark:text-white"> Do you have a Promo code or voucher? </label>
                                <input type="text" id="voucher" class="block w-full {{FD['rounded']}} border border-gray-300 bg-gray-50 p-2.5 {{FD['text']}} text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Enter here..." required />
                            </div>
                            <button type="submit" class="flex w-full items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Apply Code</button>
                        </form>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

</x-app-layout>