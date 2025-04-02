<x-app-layout
    screen="max-w-screen-xl"
    title="{{ __('Product') }}">

    <div class="py-4">
        <section class="mt-5">
            <div class="flex space-x-4">
                <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                    <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                </div>

                {{-- <img class="h-14 w-14 rounded-lg object-contain" src="{{ Storage::url(Auth::guard('web')->user()->profile_picture) }}" alt="Helene avatar" /> --}}
            <div>
            {{-- <span class="mb-2 inline-block rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300"> PRO Account </span> --}}
            <h2 class="flex items-center text-sm font-bold leading-none text-gray-900 dark:text-white mb-2">
                {{ Auth::guard('web')->user()->first_name }} {{ Auth::guard('web')->user()->last_name }}
            </h2>
            <p class="flex items-center text-xs font-bold leading-none text-gray-900 dark:text-gray-500">
                Customer Account
            </p>
        </section>

        <section class="mt-6 mb-10">
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="space-y-3">
                    <dl>
                        <dt class="text-xs font-semibold text-gray-900 dark:text-white">Email Address</dt>
                        <dd class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::guard('web')->user()->email }}</dd>
                    </dl>

                    <dl>
                        <dt class="text-xs font-semibold text-gray-900 dark:text-white">Phone Number</dt>
                        <dd class="text-xs text-gray-500 dark:text-gray-400">{{ Auth::guard('web')->user()->primary_phone_no }}</dd>
                    </dl>

                    <dl>
                        <dt class="text-xs font-semibold text-gray-900 dark:text-white">Home Address</dt>
                        <dd class="text-xs flex items-center gap-1 text-gray-500 dark:text-gray-400">
                            <svg class="hidden h-4 w-4 shrink-0 text-gray-400 dark:text-gray-500 lg:inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                            </svg>
                            2 Miles Drive, NJ 071, New York, United States of America
                        </dd>
                    </dl>

                    <dl>
                        <dt class="text-xs font-semibold text-gray-900 dark:text-white">Delivery Address</dt>
                        <dd class="text-xs flex items-center gap-1 text-gray-500 dark:text-gray-400">
                            <svg class="hidden h-4 w-4 shrink-0 text-gray-400 dark:text-gray-500 lg:inline" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                            </svg>
                            9th St. PATH Station, New York, United States of America
                        </dd>
                    </dl>

                    <dl>
                        <dt class="text-xs mb-1 font-semibold text-gray-900 dark:text-white">Payment Methods</dt>
                        <dd class="text-xs flex items-center space-x-2 text-gray-500 dark:text-gray-400">
                            <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-700">
                                <img class="h-4 w-auto dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa.svg" alt="" />
                                <img class="hidden h-4 w-auto dark:flex" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa-dark.svg" alt="" />
                            </div>
                            <div>
                                <div class="text-xs">
                                    <p class="mb-0.5 font-medium text-gray-900 dark:text-white">Visa ending in 7658</p>
                                    <p class="font-normal text-gray-500 dark:text-gray-400">Expiry 10/2024</p>
                                </div>
                            </div>
                        </dd>
                    </dl>
                </div>
            </div>
        </section>

        <section class="flex space-x-2">
            <x-front.button
                element="a"
                tag="secondary"
                class="w-40"
                href="">
                @slot('icon')
                    <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path></svg>
                @endslot
            {{ __('Edit your data') }}
            </x-front.button>

            <x-front.button
                element="a"
                tag="secondary"
                class="w-40"
                href="">
                @slot('icon')
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm0-80h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80ZM240-160v-400 400Z"/></svg>
                @endslot
            {{ __('Change password') }}
            </x-front.button>

            <x-front.button
                element="a"
                tag="secondary"
                class="w-40"
                href="">
                @slot('icon')
                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M80-600v-160q0-33 23.5-56.5T160-840h640q33 0 56.5 23.5T880-760v160h-80v-160H160v160H80Zm80 360q-33 0-56.5-23.5T80-320v-200h80v200h640v-200h80v200q0 33-23.5 56.5T800-240H160ZM40-120v-80h880v80H40Zm440-420ZM80-520v-80h240q11 0 21 6t15 16l47 93 123-215q5-9 14-14.5t20-5.5q11 0 21 5.5t15 16.5l49 98h235v80H620q-11 0-21-5.5T584-542l-26-53-123 215q-5 10-15 15t-21 5q-11 0-20.5-6T364-382l-69-138H80Z"/></svg>
                @endslot
            {{ __('Activity log') }}
            </x-front.button>
        </section>
    </div>
</x-app-layout>
