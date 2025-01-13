<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('My profile') }}"
    :breadcrumb="[
        ['label' => 'Profile']
    ]"
>

    <section class="mt-2">
        <div class="flex space-x-4">
            <img class="h-14 w-14 rounded-lg" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/helene-engels.png" alt="Helene avatar" />
        <div>
        <span class="mb-2 inline-block rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300"> PRO Account </span>
        <h2 class="flex items-center text-sm font-bold leading-none text-gray-900 dark:text-white sm:text-base">Helene Engels</h2>
    </section>

    <section class="mt-6 mb-10">
        <div class="grid gap-4 sm:grid-cols-2">
            <div class="space-y-3">
                <dl>
                    <dt class="text-xs font-semibold text-gray-900 dark:text-white">Email Address</dt>
                    <dd class="text-xs text-gray-500 dark:text-gray-400">helene@example.com</dd>
                </dl>
            
                <dl>
                    <dt class="text-xs font-semibold text-gray-900 dark:text-white">Phone Number</dt>
                    <dd class="text-xs text-gray-500 dark:text-gray-400">+1234 567 890 / +12 345 678</dd>
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

            <div class="space-y-3">
                <dl>
                    <dt class="text-xs font-semibold text-gray-900 dark:text-white">Email Address</dt>
                    <dd class="text-xs text-gray-500 dark:text-gray-400">helene@example.com</dd>
                </dl>
            
                <dl>
                    <dt class="text-xs font-semibold text-gray-900 dark:text-white">Phone Number</dt>
                    <dd class="text-xs text-gray-500 dark:text-gray-400">+1234 567 890 / +12 345 678</dd>
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

    <x-admin.button
        element="a"
        class="w-40"
        :href="route('admin.profile.edit')">
        @slot('icon')
            <svg class="-ms-0.5 me-1.5 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path></svg>
        @endslot
    {{ __('Edit your data') }}
    </x-admin.button>

</x-admin-app-layout>