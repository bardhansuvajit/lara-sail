<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Checkout') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="pt-4 sm:pt-6 px-2 sm:px-2 md:px-3 lg:px-4 xl:px-4 2xl:px-0">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white sm:text-lg">Checkout</h2>

            <div class="flex w-full items-center gap-3 sm:gap-4 {{FD['activeBgClass']}} px-2 sm:px-4 py-1 mt-2 sm:mt-4 font-light">
                <div class="{{FD['iconClass']}} lg:w-6 lg:h-6">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M608-522 422-708q14-6 28.5-9t29.5-3q59 0 99.5 40.5T620-580q0 15-3 29.5t-9 28.5ZM234-276q51-39 114-61.5T480-360q18 0 34.5 1.5T549-354l-88-88q-47-6-80.5-39.5T341-562L227-676q-32 41-49.5 90.5T160-480q0 59 19.5 111t54.5 93Zm498-8q32-41 50-90.5T800-480q0-133-93.5-226.5T480-800q-56 0-105.5 18T284-732l448 448ZM480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-155.5t86-127Q252-817 325-848.5T480-880q83 0 155.5 31.5t127 86q54.5 54.5 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Z"/></svg>
                </div>

                <p class="{{FD['text']}}">
                    You are not logged in right now.
                    <a href="#" class="font-medium underline hover:no-underline block">Log in to continue further...</a>
                </p>
            </div>

            <div class="mt-4 sm:mt-6 md:gap-6 lg:flex lg:items-start xl:gap-8">
                {{-- left part --}}
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl mb-8">
                    <div class="space-y-6">

                        {{-- single option --}}
                        <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">
                            <form action="" method="POST">
                                {{-- heading --}}
                                <div class="space-y-4 flex items-center justify-between gap-2 sm:gap-6 sm:mb-2">
                                    <div class="w-full min-w-0 flex-1 md:order-2">
                                        <h2 class="flex space-x-2 items-center mb-1">
                                            {{-- <div class="{{FD['iconClass']}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z"/></svg>
                                            </div> --}}

                                            <p class="text-lg leading-tight font-medium text-gray-900 hover:underline dark:text-gray-300">Account details</p>
                                        </h2>

                                        <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400">here lies the product description. Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro laudantium aut officia ipsa reiciendis provident</p>
                                    </div>
                                </div>

                                <div class="border-t dark:border-gray-700 my-5"></div>

                                {{-- if not logged in/ account exists --}}
                                <div class="w-full">
                                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                        <div>
                                            <x-front.input-label for="phone_no" :value="__('Phone number *')" />
                                            <x-front.text-input-with-dropdown 
                                                id="phone_no" 
                                                class="block w-auto" 
                                                type="tel" 
                                                name="phone_no" 
                                                :value="old('phone_no') ? old('phone_no') : ''" 
                                                placeholder="Enter Phone Number" 
                                                selectTitle="India (+91)" 
                                                selectId="phone_country_code" 
                                                selectName="phone_country_code" 
                                                required=true 
                                                focus
                                            >
                                                @slot('options')
                                                    @foreach ($activeCountries as $country)
                                                        <x-front.input-select-option 
                                                            value="{{$country->short_name}}" 
                                                            :selected="old('phone_country_code') ? old('phone_country_code') : $country->short_name == COUNTRY"
                                                        >
                                                            {{ $country->name }} ({{ $country->phone_code }})
                                                        </x-front.input-select-option>
                                                    @endforeach
                                                @endslot
                                            </x-front.text-input-with-dropdown>
                                            <x-front.input-error :messages="$errors->get('phone_no')" class="mt-2" />
                                            <x-front.input-error :messages="$errors->get('phone_country_code')" class="mt-2" />
                                        </div>

                                        <div>
                                            <x-front.input-label for="password" :value="__('Password *')" />
                                            <x-front.text-input id="password" class="block w-full" type="text" name="password" placeholder="Enter Password" autofocus required />
                                            <x-front.input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>

                                {{-- if not logged in/ no account exists --}}
                                {{-- <div class="w-full">
                                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                        <div>
                                            <x-front.input-label for="first_name" :value="__('First name *')" />
                                            <x-front.text-input id="first_name" class="block w-full" type="text" name="first_name" placeholder="Enter First Name" maxlength="50" autofocus required />
                                            <x-front.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                        </div>

                                        <div>
                                            <x-front.input-label for="last_name" :value="__('Last name *')" />
                                            <x-front.text-input id="last_name" class="block w-full" type="text" name="last_name" placeholder="Enter Last Name" maxlength="50" required />
                                            <x-front.input-error :messages="$errors->get('last_name')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                        <div>
                                            <x-front.input-label for="phone_no" :value="__('Phone number *')" />
                                            <x-front.text-input-with-dropdown 
                                                id="phone_no" 
                                                class="block w-auto" 
                                                type="tel" 
                                                name="phone_no" 
                                                :value="old('phone_no') ? old('phone_no') : ''" 
                                                placeholder="Enter Phone Number" 
                                                selectTitle="India (+91)" 
                                                selectId="phone_country_code" 
                                                selectName="phone_country_code" 
                                                required=true 
                                                focus
                                            >
                                                @slot('options')
                                                    @foreach ($activeCountries as $country)
                                                        <x-front.input-select-option 
                                                            value="{{$country->short_name}}" 
                                                            :selected="old('phone_country_code') ? old('phone_country_code') : $country->short_name == COUNTRY"
                                                        >
                                                            {{ $country->name }} ({{ $country->phone_code }})
                                                        </x-front.input-select-option>
                                                    @endforeach
                                                @endslot
                                            </x-front.text-input-with-dropdown>
                                            <x-front.input-error :messages="$errors->get('phone_no')" class="mt-2" />
                                            <x-front.input-error :messages="$errors->get('phone_country_code')" class="mt-2" />
                                        </div>

                                        <div>
                                            <x-front.input-label for="password" :value="__('Set password *')" />
                                            <x-front.text-input id="password" class="block w-full" type="password" name="password" placeholder="Enter Password" required />
                                            <x-front.input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                        <div>
                                            <x-front.input-label for="email" :value="__('Email')" />
                                            <x-front.text-input id="email" class="block w-full" type="email" name="email" placeholder="Enter Email Address" />
                                            <x-front.input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- form buttons --}}
                                <div class="fixed z-[1] sm:static bottom-16 sm:bottom-0 w-full -ml-[17px] -mb-[8px] sm:m-0 space-y-0 sm:space-y-4 {{FD['rounded']}} border sm:border-0 border-gray-200 bg-white px-2 py-3 sm:p-0 dark:border-0 dark:bg-gray-800">
                                    <div class="w-full sm:w-max flex space-x-2 sm:space-x-4 mt-2 sm:mt-8">
                                        <a href="{{ route('front.cart.index') }}" class="w-full sm:w-max flex space-x-4 items-center justify-center {{FD['rounded']}} bg-gray-300 focus:bg-gray-400 px-5 py-2.5 {{FD['text']}} font-medium text-gray=800 hover:bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                            <div class="w-3 h-3 me-2 text-gray-600 dark:text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-200 80-480l280-280 56 56-183 184h647v80H233l184 184-57 56Z"/></svg>
                                            </div>

                                            Back to Cart
                                        </a>

                                        <button type="submit" class="w-full sm:w-max flex items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                            {{-- Login --}}
                                            Create account
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

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
                                    <p class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-400"><span class="currency-icon">$</span>1,299</p>
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
                                    <p class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-400"><span class="currency-icon">$</span>1,299</p>
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
                                    <p class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-400"><span class="currency-icon">$</span>1,299</p>
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
                                    <p class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-400"><span class="currency-icon">$</span>1,299</p>
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
                                    <p class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-400"><span class="currency-icon">$</span>1,299</p>
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

                            <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pb-3 sm:pb-0"></div>
                        </div>

                        <dl class="flex items-center justify-between gap-4 border-0 dark:border-gray-700 pb-2 sm:pb-0">
                            <dt class="{{FD['text']}} font-bold text-gray-900 dark:text-white">Total</dt>
                            <dd class="{{FD['text']}} font-bold text-gray-900 dark:text-white">$8,191.00</dd>
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

</x-app-layout>