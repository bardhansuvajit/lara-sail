@extends('layouts.front.account', [
    'title' => __('Address')
])

@section('content')
    {{-- @if (count($addresses) == 0)
        <p class="mb-4">No delivery address found. Add an address for a faster checkout.</p>
    @endif --}}

    @if (count($addresses) == 0)
        <div class="mb-4 rounded-lg border border-dashed border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 p-6 text-center">
            <div class="mx-auto h-10 w-10 text-gray-400 dark:text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-160v-240h240v240H360Zm80-80h80v-80h-80v80ZM88-440l-48-64 440-336 160 122v-82h120v174l160 122-48 64-392-299L88-440Zm392 160Z"/></svg>
            </div>

            <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-gray-100">No delivery address found</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add an address for a faster checkout experience.</p>

            {{-- <div class="mt-4">
                <a href="{{ route('front.address.create') }}"
                    class="inline-flex items-center rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    + Add Address
                </a>
            </div> --}}
        </div>
    @endif

    <div x-data="{ expanded: {{ ( (count($addresses) == 0) || ($errors->any()) ) ? 'true' : 'false' }}, type: 'Delivery' }" class="mb-3">
        <div class="flex justify-between">
            {{-- <button 
                class="inline-block text-primary-500 dark:text-primary-300"
                @click="expanded = ! expanded" 
                >
                Add New Delivery address
            </button> --}}
            <button 
                @click="expanded = ! expanded"
                class="inline-flex items-center gap-1 text-sm font-medium text-primary-600 hover:underline dark:text-primary-300"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Delivery Address
            </button>
        </div>

        <div x-show="expanded" x-collapse>
            <div class="pt-3" x-show="type === 'Delivery'">
                @include('front.account.address.includes.create', ['type' => 'shipping'])
            </div>
        </div>
    </div>

    @if (count($addresses) > 0)
        <div class="mt-5">
            @foreach ($addresses as $address)
                <div class="">
                    <div class="{{ FD['rounded'] }} shadow-sm dark:border-gray-700">
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
    @endif
@endsection
