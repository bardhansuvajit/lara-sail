<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Application Settings') }}"
    :breadcrumb="[
        ['label' => 'Application settings']
    ]"
>

    <section class="mt-2">
        @include('admin.application.includes.navbar')

        <div class="py-5 px-5 bg-gray-50 dark:bg-gray-700">
            <div class="space-y-4">
                @foreach ($data as $item)
                    @php
                        $currencySymbol = $item->countryDetails->currency_symbol;
                    @endphp

                    <div class="flex items-center gap-3">
                        <div class="w-8">
                            {!! $item->countryDetails->flag !!}
                        </div>
                        <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ $item->countryDetails->name }}</p>
                    </div>

                    <div class="grid grid-cols-4">
                        <div class="col-span-1">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Method</p>
                            <p class="text-xs font-semibold text-gray-900 dark:text-white">{{ $item->method }}</p>
                        </div>

                        <div class="col-span-1">
                            <p class="text-xs  text-gray-500 dark:text-gray-400">Title</p>
                            <p class="text-xs font-semibold text-gray-900 dark:text-white">{{ $item->title }}</p>
                        </div>

                        <div class="col-span-1">
                            <p class="text-xs  text-gray-500 dark:text-gray-400">Subtitle</p>
                            <p class="text-xs font-semibold text-gray-900 dark:text-white">{{ $item->subtitle }}</p>
                        </div>

                        <div class="col-span-1">
                            <p class="text-xs  text-gray-500 dark:text-gray-400">Amount</p>
                            <p class="text-xs font-semibold text-gray-900 dark:text-white">
                                {{ $currencySymbol }}{{ $item->cost }}
                            </p>
                        </div>
                    </div>

                    <div class="grid grid-cols-4">
                        <div class="col-span-1">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Icon</p>
                            <div class="w-10 h-10">
                                {!! $item->icon !!}
                            </div>
                            <p class="text-xs font-semibold text-gray-900 dark:text-white"></p>
                        </div>

                        <div class="col-span-3">
                            <p class="text-xs  text-gray-500 dark:text-gray-400">Description</p>
                            <p class="text-xs font-semibold text-gray-900 dark:text-white">{{ $item->description }}</p>
                        </div>
                    </div>

                    @if (!$loop->last)
                        <div class="col-span-4">
                            <hr class="dark:border-gray-600">
                        </div>
                    @endif
                @endforeach

                <div class="col-span-4">
                    <div class="flex space-x-2 mt-2">
                        <x-admin.button
                            element="a"
                            tag="secondary"
                            class="w-40"
                            :href="route('admin.application.settings.edit', 'shipping')">
                            @slot('icon')
                                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path></svg>
                            @endslot
                        {{ __('Edit') }}
                        </x-admin.button>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-admin-app-layout>
