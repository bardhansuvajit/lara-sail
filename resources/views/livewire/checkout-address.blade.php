<div
    x-data="{
        // entangle with Livewire, so both Alpine and Livewire stay in sync
        showForm: @entangle('showAddressForm'),
        addressType: @entangle('address_type'),
        open(type) {
            this.addressType = type;
            this.showForm = true;
            // small timeout to let form render and then focus
            setTimeout(() => {
                if ($refs && $refs.addressLine1) $refs.addressLine1.focus();
            }, 50);
        },
        close() {
            this.showForm = false;
            // optionally reset addressType here, but Livewire will reset on close
        }
    }"
    class=""
>
    <div class="{{ FD['rounded'] }} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">

        {{-- heading --}}
        <div class="space-y-4 flex items-center justify-between gap-2 sm:gap-6">
            <div class="w-full min-w-0 flex-1 md:order-2">
                <h2 class="flex space-x-2 items-center mb-1">
                    <div class="{{FD['iconClass']}}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-301q99-80 149.5-154T680-594q0-90-56-148t-144-58q-88 0-144 58t-56 148q0 65 50.5 139T480-301Zm0 101Q339-304 269.5-402T200-594q0-125 78-205.5T480-880q124 0 202 80.5T760-594q0 94-69.5 192T480-200Zm0-320q33 0 56.5-23.5T560-600q0-33-23.5-56.5T480-680q-33 0-56.5 23.5T400-600q0 33 23.5 56.5T480-520ZM200-80v-80h560v80H200Zm280-520Z"/></svg>
                    </div>

                    <p class="{{FD['text-1']}} md:text-base leading-tight font-medium text-gray-900 dark:text-gray-300">{{ __('Address') }}</p>
                </h2>

                @if ( $shippingAddressesCount == 0 )
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">{!! __('Enter the address where you&apos;d like your items delivered') !!}</p>
                @elseif ( $shippingAddressesCount == 1 )
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">{{ __('Delivering to') }}</p>
                @else
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">{{ __('Select Delivery address') }}</p>
                @endif
            </div>
        </div>

        @if ( $shippingAddressesCount == 0 )
            <div class="border-t dark:border-gray-700 my-5"></div>

            {{-- No addresses yet — immediately show form for shipping --}}
            <div x-show="true" x-cloak>
                @include('livewire.includes.address-create')
            </div>
        @else
            <div wire:loading.flex wire:target="getAddresses" class="items-center justify-center">
                <svg class="animate-spin h-5 w-5 text-primary-600" ...></svg>
                <span>Loading addresses...</span>
            </div>

            <div id="address-list" class="mt-4">
                <div x-data="{ selectedAddress: '{{ $shippingAddresses->firstWhere('is_default', 1)?->id }}' }">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-4">
                        <!-- Shipping Address -->
                        @foreach ($shippingAddresses as $address)
                            <x-front.radio-input-button-checkout-address 
                                id="addressId{{$address->id}}" 
                                name="shipping_address_id" 
                                value="{{$address->id}}" 
                                :checked="$address->is_default == 1" 
                                class="shipping-address" 
                                form="place-order-form"
                                {{-- x-model="selectedAddress" --}}
                                :selectedElCheckoutAddress="true"
                                >
                                <div class="grid grid-cols-5">
                                    <div class="col-span-4">
                                        <h5 class="mb-1 {{FD['text-1']}} font-bold tracking-tight text-gray-700 dark:text-white">{{$address->first_name}} {{$address->last_name}}</h5>

                                        <p class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-300">
                                            {{$address->address_line_1}} 
                                            {{$address->address_line_2}} @if (!empty($address->landmark)), {{$address->landmark}} @endif
                                        </p>

                                        <p class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-300">
                                            {{$address->city}}, 
                                            {{strtoupper($address->stateDetail->name)}}, 
                                            {{$address->postal_code}}
                                        </p>

                                        <p class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-300">{{strtoupper($address->countryDetail->name)}}</p>
                                    </div>

                                    <div class="col-span-1">
                                        <x-front.dropdown width="32">
                                            <x-slot name="trigger">
                                                <button type="button" class="hidden sm:inline-flex items-center {{ FD['rounded'] }} justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-500/70 {{FD['text']}} font-medium leading-tight dark:text-white">
                                                    <svg class="w-4 h-4 lg:me-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/></svg>

                                                    {!! FD['dropdownCaret'] !!}
                                                </button>
                                            </x-slot>
                                            <x-slot name="content">
                                                <div class="{{ FD['rounded'] }} bg-white dark:bg-gray-700">
                                                    <ul class="text-sm {{ FD['text'] }} dark:text-white">
                                                        <li>
                                                            <a 
                                                                href="{{ route('front.address.edit', [
                                                                    'id' => $address->id,
                                                                    'redirect' => url()->current()
                                                                ]) }}"
                                                                class="flex items-center gap-2 px-3 py-2 
                                                                hover:bg-slate-50 hover:text-slate-700 
                                                                dark:hover:text-slate-300 dark:hover:bg-gray-600">
                                                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                                                Edit
                                                            </a>
                                                        </li>

                                                        {{-- <li class="group">
                                                            <button 
                                                                type="button" 
                                                                class="w-full flex items-center gap-2 px-3 py-2 text-red-600 
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
                                                        </li> --}}
                                                    </ul>
                                                </div>
                                            </x-slot>
                                        </x-front.dropdown>
                                    </div>
                                </div>

                                {{-- @if ($shippingAddressesCount > 0)
                                    <div class="mt-4">
                                        @if ($shippingAddressesCount > 1)
                                            @if ($address->is_default == 1)
                                                <p class="flex w-full items-center justify-center {{ FD['rounded'] }} bg-green-700 dark:bg-green-600 px-3 py-1 {{FD['text']}} font-medium text-white flex gap-2">
                                                    <span class="{{ FD['iconClass'] }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>
                                                    </span>
                                                    Your items will be delivered Here
                                                </p>
                                            @else
                                                <p class="flex w-full items-center justify-center {{ FD['rounded'] }} bg-slate-500 dark:bg-slate-500 px-3 py-1 {{FD['text']}} font-medium text-white flex gap-2">
                                                    <span class="{{ FD['iconClass'] }}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-200v80q-33 0-56.5-23.5T120-200h80Zm-80-80v-80h80v80h-80Zm0-160v-80h80v80h-80Zm0-160v-80h80v80h-80Zm80-160h-80q0-33 23.5-56.5T200-840v80Zm80 640v-80h80v80h-80Zm0-640v-80h80v80h-80Zm160 640v-80h80v80h-80Zm0-640v-80h80v80h-80Zm160 640v-80h80v80h-80Zm0-640v-80h80v80h-80Zm160 560h80q0 33-23.5 56.5T760-120v-80Zm0-80v-80h80v80h-80Zm0-160v-80h80v80h-80Zm0-160v-80h80v80h-80Zm0-160v-80q33 0 56.5 23.5T840-760h-80Z"/></svg>
                                                    </span>
                                                    Select to Deliver Here
                                                </p>
                                            @endif
                                        @endif
                                    </div>
                                @endif --}}
                            </x-front.radio-input-button-checkout-address>
                        @endforeach
                    </div>
                </div>

                <!-- Billing Address -->
                @if ( $billingAddressesCount > 0 )
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400 mt-4 mb-3">{{ __('Billing Address') }}</p>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-4">
                        @foreach ($billingAddresses as $billing_address)
                            <x-front.radio-input-button-checkout-address id="addressId{{$billing_address->id}}" name="billing_address_id" value="{{$billing_address->id}}" :checked="$billing_address->is_default == 1" class="billing-address" labelClass="mb-2" form="place-order-form">
                                <div class="grid grid-cols-5">
                                    <div class="col-span-4">
                                        <h5 class="mb-1 {{FD['text-1']}} font-bold tracking-tight text-gray-700 dark:text-white">{{$billing_address->first_name}} {{$billing_address->last_name}}</h5>

                                        <p class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-300">
                                            {{$billing_address->address_line_1}} 
                                            {{$billing_address->address_line_2}} @if (!empty($billing_address->landmark)), {{$billing_address->landmark}} @endif
                                        </p>

                                        <p class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-300">
                                            {{$billing_address->city}}, 
                                            {{strtoupper($billing_address->stateDetail->name)}}, 
                                            {{$billing_address->postal_code}}
                                        </p>

                                        <p class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-300">{{strtoupper($billing_address->countryDetail->name)}}</p>
                                    </div>

                                    <div class="col-span-1">
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
                                                        <li>
                                                            <a 
                                                                href="{{ route('front.address.edit', [
                                                                    'id' => $billing_address->id,
                                                                    'redirect' => url()->current()
                                                                ]) }}"
                                                                class="flex items-center gap-2 px-3 py-2 
                                                                hover:bg-slate-50 hover:text-slate-700 
                                                                dark:hover:text-slate-300 dark:hover:bg-gray-600">
                                                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                                                Edit
                                                            </a>
                                                        </li>

                                                        <li>
                                                            <button 
                                                                type="button" 
                                                                class="w-full flex items-center gap-2 px-3 py-2 text-red-600 dark:text-red-500 
                                                                hover:bg-red-50 hover:text-red-700 
                                                                dark:hover:text-red-400 dark:hover:bg-gray-600"
                                                                x-data
                                                                x-on:click="
                                                                    $dispatch('open-modal', 'confirm-address-delete'); 
                                                                    $dispatch('data-name', @js($billing_address->first_name.' '.$billing_address->last_name));
                                                                    $dispatch('data-addressline1', @js($billing_address->address_line_1));
                                                                    $dispatch('data-addressline2', @js($billing_address->address_line_2));
                                                                    $dispatch('data-landmark', @js($billing_address->landmark ?? ''));
                                                                    $dispatch('data-city', @js($billing_address->city));
                                                                    $dispatch('data-state', @js(strtoupper($billing_address->stateDetail?->name)));
                                                                    $dispatch('data-postalcode', @js($billing_address->postal_code));
                                                                    $dispatch('data-country', @js(strtoupper($billing_address->countryDetail?->name)));
                                                                    $dispatch('data-deleteroute', @js(route('front.address.delete', $billing_address->id)));
                                                                "
                                                            >
                                                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m757-317-57-57 80-106-180-240H354l-80-80h326q19 0 36 8.5t28 23.5l216 288-123 163Zm-597 77h448L160-688v448ZM820-28 661-187q-10 13-24 20t-31 7H160q-33 0-56.5-23.5T80-240v-480q0-11 2.5-20.5T90-758l-62-62 56-56L876-84l-56 56ZM567-547Zm-183 83Z"/></svg>
                                                                Remove
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </x-slot>
                                        </x-front.dropdown>
                                    </div>
                                </div>
                            </x-front.radio-input-button-checkout-address>
                        @endforeach
                    </div>
                @endif
            </div>

            <div id="shipping-address-ad-el" x-show="showForm && addressType === 'shipping'" x-cloak class="mt-4 p-4 border border-dashed border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-600/30 shadow">
                <div class="border-b border-dashed border-gray-300 dark:border-gray-600 mb-2 md:mb-4 pb-4">
                    <div class="w-full flex items-center justify-between">
                        <h5 class="{{ FD['text'] }}">Add Delivery Address</h5>

                        <button type="button" @click="close(); $wire.closeAddressForm()" class="flex gap-1 {{ FD['rounded'] }} p-1 text-xs active:ring-2 bg-gray-300 hover:bg-gray-400/90 ring-gray-100 dark:bg-gray-600/70 dark:hover:bg-gray-600/80 dark:ring-gray-700" id="shipping-address-close-btn">
                            Close
                            <div class="{{ FD['iconClass'] }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m336-280-56-56 144-144-144-143 56-56 144 144 143-144 56 56-144 143 144 144-56 56-143-144-144 144Z"/></svg>
                            </div>
                        </button>
                    </div>
                </div>

                @include('livewire.includes.address-create')
            </div>

            <div id="billing-address-ad-el" x-show="showForm && addressType === 'billing'" x-cloak class="mt-4 p-4 border border-dashed border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-600/30 shadow">
                <div class="border-b border-dashed border-gray-300 dark:border-gray-600 mb-2 md:mb-4 pb-4">
                    <div class="w-full flex items-center justify-between">
                        <h5 class="{{ FD['text'] }}">Add Billing Address</h5>

                        <button type="button" @click="close(); $wire.closeAddressForm()" class="flex gap-1 {{ FD['rounded'] }} p-1 text-xs active:ring-2 bg-gray-300 hover:bg-gray-400/90 ring-gray-100 dark:bg-gray-600/70 dark:hover:bg-gray-600/80 dark:ring-gray-700" id="billing-address-close-btn">
                            Close
                            <div class="{{ FD['iconClass'] }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m336-280-56-56 144-144-144-143 56-56 144 144 143-144 56 56-144 143 144 144-56 56-143-144-144 144Z"/></svg>
                            </div>
                        </button>
                    </div>
                </div>

                @include('livewire.includes.address-create')
            </div>

            <div id="address-add-btns" class="mt-4">
                <div class="flex justify-between">
                    <button type="button" class="inline-block {{ FD['text'] }} text-primary-500 hover:text-primary-600 dark:text-primary-300 dark:hover:text-primary-200 hover:underline" @click.prevent="open('shipping'); $wire.openAddressForm('shipping')">
                        Change Delivery address
                    </button>

                    @if ( $billingAddressesCount == 0 )
                        <button type="button" class="inline-block {{ FD['text'] }} text-primary-500 hover:text-primary-600 dark:text-primary-300 dark:hover:text-primary-200 hover:underline" @click.prevent="open('billing'); $wire.openAddressForm('billing')">
                            Add Billing address
                        </button>
                    @endif
                </div>
            </div>
        @endif
    </div>

    @include('layouts.front.includes.confirm-address-delete')
</div>