<div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">

    {{-- heading --}}
    <div class="space-y-4 flex items-center justify-between gap-2 sm:gap-6">
        <div class="w-full min-w-0 flex-1 md:order-2">
            <h2 class="flex space-x-2 items-center mb-1">
                <div class="{{FD['iconClass']}}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-301q99-80 149.5-154T680-594q0-90-56-148t-144-58q-88 0-144 58t-56 148q0 65 50.5 139T480-301Zm0 101Q339-304 269.5-402T200-594q0-125 78-205.5T480-880q124 0 202 80.5T760-594q0 94-69.5 192T480-200Zm0-320q33 0 56.5-23.5T560-600q0-33-23.5-56.5T480-680q-33 0-56.5 23.5T400-600q0 33 23.5 56.5T480-520ZM200-80v-80h560v80H200Zm280-520Z"/></svg>
                </div>

                <p class="text-sm md:text-base leading-tight font-medium text-gray-900 hover:underline dark:text-gray-300">{{ __('Address') }}</p>
            </h2>

            {{-- When AUTH FOUND --}}
            @if (auth()->guard('web')->check())
                @if ( count($shippingAddresses) > 0 )
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ __('Delivering to') }}</p>
                @else
                    <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400">{!! __('Enter the address where you&apos;d like your items delivered') !!}</p>
                @endif
            @endif
        </div>
    </div>

    @if (auth()->guard('web')->check())
        @if ( count($shippingAddresses) > 0 )
            <div class="w-full mt-4">
                @foreach ($shippingAddresses as $address)
                    <x-front.radio-input-button id="addressId{{$address->id}}" name="shipping_address" value="{{$address->id}}" :checked="$address->is_default == 1" labelClass="mb-2">
                        <div class="{{FD['rounded']}} shadow-sm dark:border-gray-700">
                            <div class="flex justify-between">
                                <div>
                                    <h5 class="mb-1 {{FD['text-1']}} font-bold tracking-tight text-gray-900 dark:text-white">{{$address->first_name}} {{$address->last_name}}</h5>

                                    <p class="{{FD['text']}} font-normal text-gray-700 dark:text-gray-300">
                                        {{$address->address_line_1}} 
                                        {{$address->address_line_2}} @if (!empty($address->landmark)), {{$address->landmark}} @endif
                                    </p>

                                    <p class="{{FD['text']}} font-normal text-gray-700 dark:text-gray-300">
                                        {{$address->city}}, 
                                        {{strtoupper($address->stateDetail->name)}}, 
                                        {{$address->postal_code}}
                                    </p>

                                    <p class="{{FD['text']}} font-normal text-gray-700 dark:text-gray-300">{{strtoupper($address->countryDetail->name)}}</p>
                                </div>

                                @if (count($shippingAddresses) > 1)
                                <div class="flex items-center">
                                    <p class="flex w-24 items-center justify-center {{FD['rounded']}} bg-primary-700 px-3 py-1 {{FD['text']}} font-medium text-white dark:bg-primary-600">Deliver Here</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </x-front.radio-input-button>
                @endforeach

                {{-- BILLING ADDRESS --}}
                @if ( count($billingAddresses) > 0 )
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-4 mb-3">{{ __('Billing Address') }}</p>

                    @foreach ($billingAddresses as $billing_address)
                        <x-front.radio-input-button id="addressId{{$billing_address->id}}" name="billing_address" value="{{$billing_address->id}}" :checked="$billing_address->is_default == 1" labelClass="mb-2">
                            <div class="{{FD['rounded']}} shadow-sm dark:border-gray-700">
                                <div class="flex justify-between">
                                    <div>
                                        <h5 class="mb-1 {{FD['text-1']}} font-bold tracking-tight text-gray-900 dark:text-white">{{$billing_address->first_name}} {{$billing_address->last_name}}</h5>

                                        <p class="{{FD['text']}} font-normal text-gray-700 dark:text-gray-300">
                                            {{$billing_address->address_line_1}} 
                                            {{$billing_address->address_line_2}} @if (!empty($billing_address->landmark)), {{$billing_address->landmark}} @endif
                                        </p>

                                        <p class="{{FD['text']}} font-normal text-gray-700 dark:text-gray-300">
                                            {{$billing_address->city}}, 
                                            {{strtoupper($billing_address->stateDetail->name)}}, 
                                            {{$billing_address->postal_code}}
                                        </p>

                                        <p class="{{FD['text']}} font-normal text-gray-700 dark:text-gray-300">{{strtoupper($billing_address->countryDetail->name)}}</p>
                                    </div>

                                    <div class="flex items-center">
                                        <div class="flex flex-col items-center">
                                            {{-- <p class="flex w-24 items-center justify-center {{FD['rounded']}} bg-primary-700 px-3 py-1 {{FD['text']}} font-medium text-white dark:bg-primary-600">Select</p> --}}

                                            <form action="{{ route('front.address.delete', $billing_address->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="flex w-24 items-center justify-center {{FD['rounded']}} text-orange-700 px-3 py-1 {{FD['text']}} font-medium text-white dark:text-orange-600">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </x-front.radio-input-button>
                    @endforeach
                @endif

                @php
                    $submittedType = session('submitted_form_type');
                @endphp

                <div x-data="{
                        expanded: @json($errors->any()),
                        type: '{{ $submittedType ?? 'Delivery' }}'
                    }">

                    <div class="flex justify-between">
                        <a href="#" class="mt-3 inline-block {{ FD['text'] }} text-primary-300"
                        @click.prevent="expanded = true; type = 'Delivery'">Change Delivery address</a>

                        @if ( count($billingAddresses) == 0 )
                            <a href="#" class="mt-3 inline-block {{ FD['text'] }} text-primary-300"
                            @click.prevent="expanded = true; type = 'Billing'">Add Billing address</a>
                        @endif
                    </div>

                    <div x-show="expanded" x-collapse>
                        <div class="pt-3" x-show="type === 'Delivery'">
                            @include('front.account.address.includes.create', ['type' => 'Delivery'])
                        </div>
                        <div class="pt-3" x-show="type === 'Billing'">
                            @include('front.account.address.includes.create', ['type' => 'Billing'])
                        </div>
                    </div>
                </div>

            </div>
        @else
            <div class="border-t dark:border-gray-700 my-5"></div>

            @include('front.account.address.includes.create', ['type' => 'Delivery'])
        @endif
    @endif

</div>