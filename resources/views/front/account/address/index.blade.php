<x-app-layout
    screen="max-w-screen-xl"
    title="{{ __('Address') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="pt-4 sm:pt-6 px-2 sm:px-2 md:px-3 lg:px-4 xl:px-4 2xl:px-0">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white sm:text-lg">Address</h2>

            @include('layouts.front.global-alert')

            <div class="mt-4 sm:mt-6 md:gap-6 lg:flex lg:items-start xl:gap-8">
                {{-- left part --}}
                <div class="hidden sm:block w-full">
                    @include('front.account.includes.account-overview')
                </div>

                {{-- right part - order summary --}}
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">

                    @include('front.account.includes.navbar')

                    <div class="bg-white dark:bg-gray-800 p-4 mb-5">
                        @if (count($addresses) == 0)
                            <p class="mb-4">No delivery address found. Add an address for a faster checkout.</p>
                        @endif

                        <div x-data="{ expanded: {{ ( (count($addresses) == 0) || ($errors->any()) ) ? 'true' : 'false' }}, type: 'Delivery' }" class="mb-3">
                            <div class="flex justify-between">
                                <a href="javascript:void(0)" 
                                class="inline-block text-primary-500 dark:text-primary-300"
                                @click="expanded = ! expanded" >Add New Delivery address</a>
                            </div>

                            <div x-show="expanded" x-collapse>
                                <div class="pt-3" x-show="type === 'Delivery'">
                                    @include('front.account.address.includes.create', ['type' => 'shipping'])
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            @foreach ($addresses as $address)
                                <div class="">
                                    <div class="{{FD['rounded']}} shadow-sm dark:border-gray-700">
                                        <div class="flex justify-between">
                                            <div>
                                                <h5 class="mb-2 {{FD['text-1']}} font-bold tracking-tight text-gray-700 dark:text-white">
                                                    {{$address->first_name}} {{$address->last_name}}, {{$address->phone_no}}
                                                </h5>

                                                <p class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-300">
                                                    {{$address->address_line_1}} 
                                                    {{$address->address_line_2}} @if (!empty($address->landmark)), {{$address->landmark}} @endif
                                                </p>

                                                <p class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-300">
                                                    {{$address->city}}, 
                                                    {{strtoupper($address->stateDetail?->name)}}, 
                                                    {{$address->postal_code}}
                                                </p>

                                                <p class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-300">{{strtoupper($address->countryDetail?->name)}}</p>
                                            </div>

                                            <div class="flex items-center">
                                                <div class="flex flex-col space-y-2 items-center">
                                                    <a href="{{ route('front.address.edit', $address->id) }}" class="{{FD['text']}} inline-flex gap-2 items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:underline dark:text-gray-400 dark:hover:text-gray-500">Edit</a>

                                                    <button 
                                                        type="button" 
                                                        class="{{FD['text']}} inline-flex gap-2 items-center text-sm font-medium text-red-500 hover:text-red-700 hover:underline dark:text-red-600 dark:hover:text-red-700"
                                                        x-data=""
                                                        x-on:click="
                                                            $dispatch('open-modal', 'confirm-address-delete'); 
                                                            $dispatch('data-name', @js($address->first_name.' '.$address->last_name));
                                                            $dispatch('data-addressline1', @js($address->address_line_1));
                                                            $dispatch('data-addressline2', @js($address->address_line_2));
                                                            $dispatch('data-landmark', @js($address->landmark ?? ''));
                                                            $dispatch('data-city', @js($address->city));
                                                            $dispatch('data-state', @js(strtoupper($address->stateDetail?->name)));
                                                            $dispatch('data-postalcode', @js($address->postal_code));
                                                            $dispatch('data-country', @js(strtoupper($address->countryDetail?->name)));
                                                            $dispatch('data-deleteroute', @js(route('front.address.delete', $address->id)));
                                                        "
                                                    >
                                                        Remove
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if (!$loop->last)
                                    <hr class="border-t border-gray-300 dark:border-gray-600 my-6">
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @include('layouts.front.includes.confirm-address-delete')
</x-app-layout>
