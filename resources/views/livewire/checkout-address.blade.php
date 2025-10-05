<div>
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
                @else
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">{{ __('Delivering to') }}</p>
                @endif
            </div>
        </div>

        @if ( $shippingAddressesCount == 0 )
            <div class="border-t dark:border-gray-700 my-5"></div>

            @include('livewire.includes.address-create', ['type' => 'shipping'])
        @else
            <div wire:loading.flex wire:target="getAddresses" class="items-center justify-center">
                <svg class="animate-spin h-5 w-5 text-primary-600" ...></svg>
                <span>Loading addresses...</span>
            </div>

            <div class="mt-4">
                <div id="address-list" class="@if ($errors->any()) hidden @endif">
                    <!-- Shipping Address -->
                    @foreach ($shippingAddresses as $address)
                        <x-front.radio-input-button id="addressId{{$address->id}}" name="shipping_address_id" value="{{$address->id}}" :checked="$address->is_default == 1" class="shipping-address" :labelClass="(!$loop->last) ? 'mb-2' : ''" form="place-order-form">
                            <div class="{{ FD['rounded'] }} dark:border-gray-700">
                                <div class="flex justify-between">
                                    <div>
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

                                    @if ($shippingAddressesCount > 1)
                                    <div class="flex items-center">
                                        <div class="flex flex-col space-y-2 items-end md:items-center">
                                            <a 
                                                href="{{ route('front.address.edit', [
                                                    'id' => $address->id,
                                                    'redirect' => url()->current()
                                                ]) }}" 
                                                class="{{FD['text']}} inline-flex gap-2 items-center font-medium text-gray-500 hover:text-gray-700 hover:underline dark:text-gray-400 dark:hover:text-gray-500"
                                                >
                                                Edit
                                            </a>

                                            <p class="flex w-24 items-center justify-center {{ FD['rounded'] }} bg-primary-700 px-3 py-1 {{FD['text']}} font-medium text-white dark:bg-primary-600">Deliver Here</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </x-front.radio-input-button>
                    @endforeach
                </div>

                <div id="shipping-address-ad-el" class="@if (!$errors->any()) hidden @endif p-4 border border-dashed border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-600/30 shadow">
                    <div class="border-b border-dashed border-gray-300 dark:border-gray-600 mb-2 md:mb-4 pb-4">
                        <div class="w-full flex items-center justify-between">
                            <h5 class="{{ FD['text'] }}">Add Delivery Address</h5>

                            <button type="button" class="flex gap-1 {{ FD['rounded'] }} p-1 text-xs active:ring-2 bg-gray-300 hover:bg-gray-400/90 ring-gray-100 dark:bg-gray-600/70 dark:hover:bg-gray-600/80 dark:ring-gray-700" id="shipping-address-close-btn">
                                Close
                                <div class="{{ FD['iconClass'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m336-280-56-56 144-144-144-143 56-56 144 144 143-144 56 56-144 143 144 144-56 56-143-144-144 144Z"/></svg>
                                </div>
                            </button>
                        </div>
                    </div>

                    @include('livewire.includes.address-create', ['type' => 'shipping'])
                </div>

                <div id="billing-address-ad-el" class="hidden p-4 border border-dashed border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-600/30 shadow">
                    <div class="border-b border-dashed border-gray-300 dark:border-gray-600 mb-2 md:mb-4 pb-4">
                        <div class="w-full flex items-center justify-between">
                            <h5 class="{{ FD['text'] }}">Add Billing Address</h5>

                            <button type="button" class="flex gap-1 {{ FD['rounded'] }} p-1 text-xs active:ring-2 bg-gray-300 hover:bg-gray-400/90 ring-gray-100 dark:bg-gray-600/70 dark:hover:bg-gray-600/80 dark:ring-gray-700" id="billing-address-close-btn">
                                Close
                                <div class="{{ FD['iconClass'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m336-280-56-56 144-144-144-143 56-56 144 144 143-144 56 56-144 143 144 144-56 56-143-144-144 144Z"/></svg>
                                </div>
                            </button>
                        </div>
                    </div>

                    @include('livewire.includes.address-create', ['type' => 'billing'])
                </div>

                <div id="address-add-btns">
                    <div class="flex justify-between">
                        <a href="javascript: void(0)" class="mt-3 inline-block {{ FD['text'] }} text-primary-500 dark:text-primary-300 add-chk-address" data-type="shipping">Change Delivery address</a>

                        @if ( $billingAddressesCount == 0 )
                            <a href="javascript: void(0)" class="mt-3 inline-block {{ FD['text'] }} text-primary-500 dark:text-primary-300 add-chk-address" data-type="billing">Add Billing address</a>
                        @endif
                    </div>
                </div>

            </div>
        @endif

    </div>
</div>
