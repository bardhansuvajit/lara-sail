<x-app-layout
    screen="max-w-screen-xl"
    title="{{ __('Product') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="pt-4 sm:pt-6 px-2 sm:px-2 md:px-3 lg:px-4 xl:px-4 2xl:px-0">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white sm:text-lg">Account</h2>

            @include('layouts.front.global-alert')

            <div class="mt-4 sm:mt-6 md:gap-6 lg:flex lg:items-start xl:gap-8">
                {{-- left part --}}
                <div class="mx-auto mt-6 flex-1 space-y-6 lg:mt-0 lg:w-full mb-4">
                    <div class="space-y-4 {{FD['rounded']}} border border-gray-200 bg-white px-2 py-3 lg:p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                        <div class="block">
                            
                            <div class="flex justify-center sm:justify-start mb-5">
                                <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                    <span class="font-medium text-gray-600 dark:text-gray-300">
                                        {{ substr(Auth::guard('web')->user()->first_name, 0, 1) }}{{ substr(Auth::guard('web')->user()->last_name, 0, 1) }}
                                    </span>
                                </div>
                            </div>

                            {{-- <p class="{{FD['text-1']}} font-semibold text-gray-900 dark:text-white mb-2">Basic information</p> --}}

                            <div class="space-y-2">
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Full name</dt>
                                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">
                                        {{ Auth::guard('web')->user()->first_name }} {{ Auth::guard('web')->user()->last_name }}
                                    </dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Phone number</dt>
                                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">
                                        {{ Auth::guard('web')->user()->primary_phone_no }}
                                        @if (Auth::guard('web')->user()->alt_phone_no)
                                            / {{ Auth::guard('web')->user()->alt_phone_no }}
                                        @endif
                                    </dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Email</dt>
                                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">{{ Auth::guard('web')->user()->email }}</dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Gender</dt>
                                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">{{ genderString(Auth::guard('web')->user()->gender_id) }}</dd>
                                </dl>

                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400">Country</dt>
                                    <dd class="{{FD['text']}} font-medium text-gray-900 dark:text-white">
                                        <div class="flex items-center">
                                            @if (Auth::guard('web')->user()->country->flag)
                                                <div class="inline-flex justify-center h-4 mr-2">
                                                    {!! Auth::guard('web')->user()->country->flag !!}
                                                </div>
                                            @endif
                                            {{ Auth::guard('web')->user()->country->name }}
                                        </div>
                                    </dd>
                                </dl>
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pb-3 sm:pb-0"></div>
                        </div>

                        <div class="flex space-x-2 lg:space-x-0">
                            <a href="{{route('front.account.edit')}}" class="flex w-full items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Edit Profile
                            </a>
                        </div>

                        <div class="flex items-center justify-center gap-2">
                            <p class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-primary-700 dark:text-primary-500">
                                Not {{Auth::guard('web')->user()->first_name}}?
                            </p>
                            <form method="POST" action="{{ route('front.logout') }}" class="flex">@csrf
                                <button type="submit" class="inline-flex items-center underline hover:no-underline {{FD['text']}} font-medium text-primary-700 dark:text-primary-500">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- right part - order summary --}}
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">

                    @include('front.account.includes.navbar')

                    <div>
                        {{-- cart products --}}
                        <div id="cart-products" class="space-y-6">

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

                                            <p class="{{FD['text']}} font-bold text-gray-900 dark:text-gray-50"><span class="currency-symbol">₹</span>1,09,699</p>
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
                                                    <span class="currency-symbol">₹</span>1,09,699
                                                </p>
                                                <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                                    <span class="currency-symbol">₹</span>17,699
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

                                            <p class="{{FD['text']}} font-bold text-gray-900 dark:text-gray-50"><span class="currency-symbol">₹</span>1,09,699</p>
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

                                            <p class="{{FD['text']}} font-bold text-gray-900 dark:text-gray-50"><span class="currency-symbol">₹</span>1,09,699</p>
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

                                            <p class="{{FD['text']}} font-bold text-gray-900 dark:text-gray-50"><span class="currency-symbol">₹</span>1,09,699</p>
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

                                            <p class="{{FD['text']}} font-bold text-gray-900 dark:text-gray-50"><span class="currency-symbol">₹</span>1,09,699</p>
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

                        {{-- Saved for later products --}}
                        <div id="saved-product-container" class="bg-gray-50 mb-4 py-4 antialiased dark:bg-gray-800 mt-6 shadow-sm border border-gray-200 dark:border-gray-700">
                            <div class="mx-auto max-w-screen-xl px-2 sm:px-4">
                                <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                                    <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">SAVED FOR LATER</h2>
                                </div>

                                <div id="saved-products" class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-4 lg:grid-cols-4">

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
                                                    <span class="currency-symbol">₹</span>1,09,699
                                                </p>
                                                <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                                    <span class="currency-symbol">₹</span>17,699
                                                </p>
                                                <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                                    40% off
                                                </p>
                                            </div>
                                        </a>

                                        <button class="{{FD['rounded']}} w-full {{FD['text-0']}} bg-primary-700 dark:bg-primary-600 hover:bg-primary-800 dark:hover:bg-primary-700 p-1 mt-3 text-gray-100">
                                            Move to cart
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- featured products --}}
                        <div id="featured-product-container" class="bg-gray-50 mb-4 py-4 antialiased dark:bg-gray-800 mt-6 shadow-sm border border-gray-200 dark:border-gray-700">
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
                                                    <span class="currency-symbol">₹</span>1,09,699
                                                </p>
                                                <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                                    <span class="currency-symbol">₹</span>17,699
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
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</x-app-layout>
