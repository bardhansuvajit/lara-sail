<x-app-layout
    screen="max-w-screen-xl"
    title="{{ __('Edit account') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="pt-4 sm:pt-6 px-2 sm:px-2 md:px-3 lg:px-4 xl:px-4 2xl:px-0">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white sm:text-lg">Edit account</h2>

            @include('layouts.front.global-alert')

            <div class="mt-4 sm:mt-6 md:gap-6 lg:flex lg:items-start xl:gap-8">
                {{-- left part --}}
                <div class="hidden sm:block w-full">
                    @include('front.account.includes.account-overview')
                </div>

                {{-- right part --}}
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">

                    @include('front.account.includes.navbar')

                    <div class="bg-white dark:bg-gray-800 p-4 mb-5">
                        <div class="space-y-6">

                            {{-- basic information --}}
                            <div class="{{FD['rounded']}} bg-white shadow-sm dark:bg-gray-800">
                                <div>
                                    <p class="mb-3 text-sm text-gray-600 dark:text-gray-500">Basic information</p>
                                </div>

                                <form action="{{ route('front.account.update') }}" method="POST">@csrf
                                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                                        <div>
                                            <x-front.input-label for="first_name" :value="__('First name *')" />
                                            <x-front.text-input id="first_name" class="block w-full" type="text" name="first_name" placeholder="Enter First Name" maxlength="50" value="{{ old('first_name') ? old('first_name') : $user->first_name }}" autofocus required />
                                            <x-front.input-error :messages="$errors->get('first_name')" class="mt-2" />
                                        </div>

                                        <div>
                                            <x-front.input-label for="last_name" :value="__('Last name *')" />
                                            <x-front.text-input id="last_name" class="block w-full" type="text" name="last_name" placeholder="Enter Last Name" maxlength="50" value="{{ old('last_name') ? old('last_name') : $user->last_name }}" required />
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
                                                :value="old('phone_no') ? old('phone_no') : $user->primary_phone_no" 
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
                                                            value="{{$country->code}}" 
                                                            :selected="old('phone_country_code') ? $country->code == old('phone_country_code') : $country->code == $user->country->code"
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
                                            <x-front.text-input id="alt_phone_no" class="block w-full" type="tel" name="alt_phone_no" placeholder="Enter Alternate Phone number" value="{{ old('alt_phone_no') ? old('alt_phone_no') : $user->alt_phone_no }}" />
                                            <x-front.input-error :messages="$errors->get('alt_phone_no')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                                        <div>
                                            <x-front.input-label for="email" :value="__('Email')" />
                                            <x-front.text-input id="email" class="block w-full" type="email" name="email" placeholder="Enter Email Address" maxlength="100" value="{{ old('email') ? old('email') : $user->email }}" />
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

                            <hr class="border-t border-gray-300 dark:border-gray-600 my-6">

                            {{-- Optional information --}}
                            <div class="{{FD['rounded']}} bg-white shadow-sm dark:bg-gray-800">
                                <div>
                                    <p class="mb-3 text-sm text-gray-600 dark:text-gray-500">Optional information</p>
                                </div>

                                <form action="{{ route('front.account.update.optional') }}" method="POST">@csrf
                                    <div class="grid gap-4 mb-4 sm:grid-cols-3">
                                        <div>
                                            <x-front.input-label for="gender_id" :value="__('Gender')" />

                                            <div class="w-full flex gap-2">
                                                <x-front.radio-input-button id="someId1" name="gender_id" value="1" :checked="$user->gender_id == 1">
                                                    <div class="text-center">
                                                        <div class="flex flex-col items-center gap-2">
                                                            <div>
                                                                <div class="{{FD['text']}} font-semibold">Male</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </x-front.radio-input-button>

                                                <x-front.radio-input-button id="someId2" name="gender_id" value="2" :checked="$user->gender_id == 2">
                                                    <div class="text-center">
                                                        <div class="flex flex-col items-center gap-2">
                                                            <div>
                                                                <div class="{{FD['text']}} font-semibold">Female</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </x-front.radio-input-button>

                                                <x-front.radio-input-button id="someId3" name="gender_id" value="3" :checked="$user->gender_id == 3">
                                                    <div class="text-center">
                                                        <div class="flex flex-col items-center gap-2">
                                                            <div>
                                                                <div class="{{FD['text']}} font-semibold">Other</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </x-front.radio-input-button>

                                                <x-front.radio-input-button id="someId4" name="gender_id" value="4" :checked="$user->gender_id == 4">
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
                                            <x-front.text-input id="date_of_birth" class="block w-full" type="date" name="date_of_birth" placeholder="Enter Date of Birth" max="{{date('Y-m-d')}}" value="{{ $user->date_of_birth }}" />
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
                                            {{-- <img class="mx-auto h-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="" /> --}}
                                            <svg class="mx-auto h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M326-129v-79H165q-30.94 0-52.97-22.03Q90-252.06 90-283v-473q0-30.94 22.03-52.97Q134.06-831 165-831h630q30.94 0 52.97 22.03Q870-786.94 870-756v473q0 30.94-22.03 52.97Q825.94-208 795-208H634v79H326ZM165-283h630v-473H165v473Zm0 0v-473 473Z"/></svg>
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
