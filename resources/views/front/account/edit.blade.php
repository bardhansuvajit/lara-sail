<x-app-layout
    screen="max-w-screen-xl"
    title="{{ __('Product') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="pt-4 sm:pt-6 px-2 sm:px-2 md:px-3 lg:px-4 xl:px-4 2xl:px-0">
            <div class="flex space-x-2 items-center">
                <a href="{{ route('front.account.index') }}" class="hover:bg-gray-200 dark:hover:bg-gray-700 rounded-full block sm:hidden">
                    <div class="{{FD['iconClass']}}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M560-240 320-480l240-240 56 56-184 184 184 184-56 56Z"/></svg>
                    </div>
                </a>
                <h2 class="text-base font-semibold text-gray-900 dark:text-white sm:text-lg">Edit account</h2>
            </div>

            @include('layouts.front.global-alert')

            <div class="mt-4 sm:mt-6 md:gap-6 lg:flex lg:items-start xl:gap-8">
                {{-- left part --}}
                <div class="mx-auto mt-6 flex-1 space-y-6 lg:mt-0 lg:w-full mb-4 hidden sm:block">
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
                            <a href="{{route('front.account.index')}}" class="flex w-full items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Back to account
                            </a>
                        </div>
                    </div>
                </div>

                {{-- right part --}}
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
                    <div class="space-y-6">

                        {{-- basic information --}}
                        <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 lg:p-4">
                            <div>
                                <p class="mb-3 text-sm text-gray-600 dark:text-gray-500">Basic information</p>
                            </div>

                            <form action="{{ route('front.account.update') }}" method="POST">@csrf
                                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                                    <div>
                                        <x-front.input-label for="first_name" :value="__('First name *')" />
                                        <x-front.text-input id="first_name" class="block w-full" type="text" name="first_name" placeholder="Enter First Name" maxlength="50" value="{{ old('first_name') ? old('first_name') : Auth::guard('web')->user()->first_name }}" autofocus required />
                                        <x-front.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-front.input-label for="last_name" :value="__('Last name *')" />
                                        <x-front.text-input id="last_name" class="block w-full" type="text" name="last_name" placeholder="Enter Last Name" maxlength="50" value="{{ old('last_name') ? old('last_name') : Auth::guard('web')->user()->last_name }}" required />
                                        <x-front.input-error :messages="$errors->get('last_name')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                                    <div>
                                        <x-front.input-label for="phone_no" :value="__('Phone number *')" />
                                        <x-front.text-input-with-dropdown 
                                            id="phone_no" 
                                            class="block w-auto" 
                                            type="tel" 
                                            name="phone_no" 
                                            :value="old('phone_no') ? old('phone_no') : Auth::guard('web')->user()->primary_phone_no" 
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
                                                        :selected="old('phone_country_code') ? $country->short_name == old('phone_country_code') : $country->short_name == Auth::guard('web')->user()->country->short_name"
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
                                        <x-front.input-label for="alt_phone_no" :value="__('Alternate Phone number')" />
                                        <x-front.text-input id="alt_phone_no" class="block w-full" type="tel" name="alt_phone_no" placeholder="Enter Alternate Phone number" value="{{ old('alt_phone_no') ? old('alt_phone_no') : Auth::guard('web')->user()->alt_phone_no }}" />
                                        <x-front.input-error :messages="$errors->get('alt_phone_no')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                                    <div>
                                        <x-front.input-label for="email" :value="__('Email')" />
                                        <x-front.text-input id="email" class="block w-full" type="email" name="email" placeholder="Enter Email Address" maxlength="100" value="{{ old('email') ? old('email') : Auth::guard('web')->user()->email }}" />
                                        <x-front.input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="w-full sm:w-max flex items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        Update
                                    </button>
                                </div>
                            </form>
                        </div>

                        {{-- Optional information --}}
                        <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 lg:p-4">
                            <div>
                                <p class="mb-3 text-sm text-gray-600 dark:text-gray-500">Optional information</p>
                            </div>

                            <form action="{{ route('front.account.update.optional') }}" method="POST">@csrf
                                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                                    <div>
                                        <x-front.input-label for="gender_id" :value="__('Gender')" />

                                        <div class="w-full flex gap-2">
                                            <x-front.radio-input-button id="someId1" name="gender_id" value="1" :checked="Auth::guard('web')->user()->gender_id == 1">
                                                <div class="text-center">
                                                    <div class="flex flex-col items-center gap-2">
                                                        <div>
                                                            <div class="{{FD['text']}} font-semibold">Male</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </x-front.radio-input-button>

                                            <x-front.radio-input-button id="someId2" name="gender_id" value="2" :checked="Auth::guard('web')->user()->gender_id == 2">
                                                <div class="text-center">
                                                    <div class="flex flex-col items-center gap-2">
                                                        <div>
                                                            <div class="{{FD['text']}} font-semibold">Female</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </x-front.radio-input-button>

                                            <x-front.radio-input-button id="someId3" name="gender_id" value="3" :checked="Auth::guard('web')->user()->gender_id == 3">
                                                <div class="text-center">
                                                    <div class="flex flex-col items-center gap-2">
                                                        <div>
                                                            <div class="{{FD['text']}} font-semibold">Other</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </x-front.radio-input-button>

                                            <x-front.radio-input-button id="someId4" name="gender_id" value="4" :checked="Auth::guard('web')->user()->gender_id == 4">
                                                <div class="text-center">
                                                    <div class="flex flex-col items-center gap-2">
                                                        <div>
                                                            <div class="{{FD['text']}} font-semibold">Not specified</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </x-front.radio-input-button>
                                        </div>

                                        <x-front.input-error :messages="$errors->get('gender_id')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="grid gap-4 mb-4 sm:grid-cols-3">
                                    <div>
                                        <x-front.input-label for="date_of_birth" :value="__('Date of Birth')" />
                                        <x-front.text-input id="date_of_birth" class="block w-full" type="date" name="date_of_birth" placeholder="Enter Date of Birth" max="{{date('Y-m-d')}}" value="{{ Auth::guard('web')->user()->date_of_birth }}" />
                                        <x-front.input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" class="w-full sm:w-max flex items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                        Update
                                    </button>
                                </div>
                            </form>
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
    </section>
</x-app-layout>
