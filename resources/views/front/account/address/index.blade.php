@extends('layouts.front.account', [
    'title' => __('Address')
])

@section('content')
    @if (count($addresses) == 0)
        <div class="mb-4 rounded-lg border border-dashed border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 p-6 text-center">
            <div class="mx-auto h-10 w-10 text-gray-400 dark:text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-160v-240h240v240H360Zm80-80h80v-80h-80v80ZM88-440l-48-64 440-336 160 122v-82h120v174l160 122-48 64-392-299L88-440Zm392 160Z"/></svg>
            </div>

            <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-gray-100">No delivery address found</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Add an address for a faster checkout experience.</p>

            <div class="mt-4">
                <a href="{{ route('front.address.create') }}"
                    class="inline-flex items-center {{ FD['rounded'] }} bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
                    + Add New Delivery Address
                </a>
            </div>
        </div>
    @else
        <div>
            <div class="mb-4 flex justify-center md:justify-start">
                <a href="{{ route('front.address.create') }}"
                class="inline-flex items-center gap-1 {{ FD['text'] }} font-medium text-primary-600 hover:underline dark:text-primary-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="{{ FD['iconClass'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add New Delivery Address
                </a>
            </div>

            @foreach ($addresses as $address)
                <div class="border border-gray-200 dark:border-gray-700 p-2 md:p-4 {{ FD['rounded'] }} @if (!$loop->last) mb-2 md:mb-4 @endif">
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

                            <p class="{{ FD['text'] }} font-normal text-gray-500 dark:text-gray-300">{{strtoupper($address->countryDetail?->name)}}</p>
                        </div>

                        <div class="">
                            <x-front.dropdown width="32">
                                <x-slot name="trigger">
                                    <button type="button" class="hidden sm:inline-flex items-center {{ FD['rounded'] }} justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700/100 {{FD['text']}} font-medium leading-tight dark:text-white">
                                        <svg class="w-4 h-4 lg:me-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/></svg>

                                        {!! FD['dropdownCaret'] !!}
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <div class="{{ FD['rounded'] }} bg-white dark:bg-gray-700">
                                        <ul class="text-sm {{ FD['text'] }} dark:text-white">
                                            <li class="group">
                                                @if ($address->is_default == 1)
                                                    <span class="flex items-center gap-2 px-3 py-2 font-semibold text-green-700 bg-green-100 dark:text-green-400 dark:bg-green-900/40">
                                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        Default
                                                    </span>
                                                @else
                                                    <button 
                                                        type="button" 
                                                        class="w-full flex items-center gap-2 px-3 py-2 text-green-600 
                                                        group-hover:bg-green-50 group-hover:text-green-700 
                                                        dark:group-hover:text-green-400 dark:group-hover:bg-gray-600"
                                                        x-data
                                                        x-on:click="
                                                            $dispatch('open-modal', 'confirm-address-make-default'); 
                                                            $dispatch('data-name', @js($address->first_name.' '.$address->last_name));
                                                            $dispatch('data-addressline1', @js($address->address_line_1));
                                                            $dispatch('data-addressline2', @js($address->address_line_2));
                                                            $dispatch('data-landmark', @js($address->landmark ?? ''));
                                                            $dispatch('data-city', @js($address->city));
                                                            $dispatch('data-state', @js(strtoupper($address->stateDetail?->name)));
                                                            $dispatch('data-postalcode', @js($address->postal_code));
                                                            $dispatch('data-country', @js(strtoupper($address->countryDetail?->name)));
                                                            $dispatch('data-makedefaultroute', @js(route('front.address.default', $address->id)));
                                                        "
                                                    >
                                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-440h80v-110h80v110h80v-190l-120-80-120 80v190Zm120 254q122-112 181-203.5T720-552q0-109-69.5-178.5T480-800q-101 0-170.5 69.5T240-552q0 71 59 162.5T480-186Zm0 106Q319-217 239.5-334.5T160-552q0-150 96.5-239T480-880q127 0 223.5 89T800-552q0 100-79.5 217.5T480-80Zm0-480Z"/></svg>
                                                        Set Default
                                                    </button>
                                                @endif
                                            </li>

                                            <li class="group">
                                                <a href="{{ route('front.address.edit', $address->id) }}" 
                                                class="flex items-center gap-2 px-3 py-2 
                                                    group-hover:bg-slate-50 group-hover:text-slate-700 
                                                    dark:group-hover:text-slate-300 dark:group-hover:bg-gray-600">
                                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                                    Edit
                                                </a>
                                            </li>

                                            <li class="group">
                                                <button 
                                                    type="button" 
                                                    class="w-full flex items-center gap-2 px-3 py-2 text-red-600 
                                                    {{-- hover:bg-red-50 hover:text-red-700 dark:hover:bg-gray-600 --}}
                                                    group-hover:bg-red-50 group-hover:text-red-700 
                                                    dark:group-hover:text-red-300 dark:group-hover:bg-gray-600"
                                                    x-data
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
                                                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m757-317-57-57 80-106-180-240H354l-80-80h326q19 0 36 8.5t28 23.5l216 288-123 163Zm-597 77h448L160-688v448ZM820-28 661-187q-10 13-24 20t-31 7H160q-33 0-56.5-23.5T80-240v-480q0-11 2.5-20.5T90-758l-62-62 56-56L876-84l-56 56ZM567-547Zm-183 83Z"/></svg>
                                                    Remove
                                                </button>
                                            </li>
                                        </ul>
                                    </div>

                                    {{-- <div class="divide-y-2 overflow-hidden overflow-y-auto {{ FD['rounded'] }} bg-white antialiased dark:divide-gray-600 dark:bg-gray-700">
                                        <ul class="p-2 text-start {{FD['text']}} font-medium dark:text-white dark:border-gray-600">
                                            <li>
                                                @if ($address->is_default == 1)
                                                    <span class="inline-flex items-center gap-1 px-2 py-1 {{ FD['text'] }} font-semibold text-green-700 bg-green-100">
                                                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                        </svg>
                                                        Default
                                                    </span>
                                                @else
                                                    <button 
                                                        type="button" 
                                                        class="{{ FD['text'] }} inline-flex gap-2 items-center font-medium text-green-500 hover:text-green-700 hover:underline dark:text-green-600 dark:hover:text-green-700"
                                                        x-data=""
                                                        x-on:click="
                                                            $dispatch('open-modal', 'confirm-address-make-default'); 
                                                            $dispatch('data-name', @js($address->first_name.' '.$address->last_name));
                                                            $dispatch('data-addressline1', @js($address->address_line_1));
                                                            $dispatch('data-addressline2', @js($address->address_line_2));
                                                            $dispatch('data-landmark', @js($address->landmark ?? ''));
                                                            $dispatch('data-city', @js($address->city));
                                                            $dispatch('data-state', @js(strtoupper($address->stateDetail?->name)));
                                                            $dispatch('data-postalcode', @js($address->postal_code));
                                                            $dispatch('data-country', @js(strtoupper($address->countryDetail?->name)));
                                                            $dispatch('data-makedefaultroute', @js(route('front.address.default', $address->id)));
                                                        "
                                                    >
                                                        Set Default
                                                    </button>
                                                @endif
                                            </li>

                                            <li>
                                                <a href="{{ route('front.address.edit', $address->id) }}" class="{{ FD['text'] }} inline-flex gap-2 items-center font-medium text-gray-500 hover:text-gray-700 hover:underline dark:text-gray-400 dark:hover:text-gray-500">Edit</a>
                                            </li>

                                            <li>
                                                <button 
                                                    type="button" 
                                                    class="{{ FD['text'] }} inline-flex gap-2 items-center font-medium text-red-500 hover:text-red-700 hover:underline dark:text-red-600 dark:hover:text-red-700"
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
                                            </li>
                                        </ul>
                                    </div> --}}


                                    {{-- <div class="flex flex-col space-y-2 items-center">
                                        @if ($address->is_default == 1)
                                            <span class="inline-flex items-center gap-1 px-2 py-1 {{ FD['text'] }} font-semibold text-green-700 bg-green-100">
                                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                </svg>
                                                Default
                                            </span>
                                        @else
                                            <button 
                                                type="button" 
                                                class="{{ FD['text'] }} inline-flex gap-2 items-center font-medium text-green-500 hover:text-green-700 hover:underline dark:text-green-600 dark:hover:text-green-700"
                                                x-data=""
                                                x-on:click="
                                                    $dispatch('open-modal', 'confirm-address-make-default'); 
                                                    $dispatch('data-name', @js($address->first_name.' '.$address->last_name));
                                                    $dispatch('data-addressline1', @js($address->address_line_1));
                                                    $dispatch('data-addressline2', @js($address->address_line_2));
                                                    $dispatch('data-landmark', @js($address->landmark ?? ''));
                                                    $dispatch('data-city', @js($address->city));
                                                    $dispatch('data-state', @js(strtoupper($address->stateDetail?->name)));
                                                    $dispatch('data-postalcode', @js($address->postal_code));
                                                    $dispatch('data-country', @js(strtoupper($address->countryDetail?->name)));
                                                    $dispatch('data-makedefaultroute', @js(route('front.address.default', $address->id)));
                                                "
                                            >
                                                Set Default
                                            </button>
                                        @endif

                                        <a href="{{ route('front.address.edit', $address->id) }}" class="{{ FD['text'] }} inline-flex gap-2 items-center font-medium text-gray-500 hover:text-gray-700 hover:underline dark:text-gray-400 dark:hover:text-gray-500">Edit</a>

                                        <button 
                                            type="button" 
                                            class="{{ FD['text'] }} inline-flex gap-2 items-center font-medium text-red-500 hover:text-red-700 hover:underline dark:text-red-600 dark:hover:text-red-700"
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
                                    </div> --}}
                                </x-slot>
                            </x-front.dropdown>
                        </div>

                    </div>
                </div>
            @endforeach

            @include('layouts.front.includes.confirm-address-make-default')
            @include('layouts.front.includes.confirm-address-delete')
        </div>
    @endif
@endsection
