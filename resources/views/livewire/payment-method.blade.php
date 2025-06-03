<div>
    <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">
        {{-- heading --}}
        <div class="space-y-4 flex items-center justify-between gap-2 sm:gap-6 sm:mb-2">
            <div class="w-full min-w-0 flex-1 md:order-2">
                <h2 class="flex space-x-2 items-center mb-1">
                    <div class="{{FD['iconClass']}}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z"/></svg>
                    </div>

                    <p class="{{FD['text-1']}} md:text-base leading-tight font-medium text-gray-900 hover:underline dark:text-gray-300">{{ __('Payment') }}</p>
                </h2>

                @if ( $shippingAddrExistCount > 0 )
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">{{ __('Complete Your Purchase') }}</p>
                @else
                    <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400">{!! __('Before we can process your payment, please provide your delivery address. It helps us calculate shipping and deliver your order correctly.') !!}</p>
                @endif

            </div>
        </div>

        @if ( $shippingAddrExistCount > 0 )
            <div class="w-full mt-4">

                {{-- <form action="{{ route('front.order.store') }}" method="post" id="place-order-form">@csrf --}}
                    <div class="flex flex-col space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($paymentMethods as $methodIndex => $method)
                                {{-- {{$methodIndex}} --}}
                                <div x-data="{ methodIndex: {{ $methodIndex }} }">
                                    <label class="flex items-start gap-3 p-3 border-2 border-gray-300 dark:border-gray-700/50 {{FD['rounded']}} cursor-pointer has-[:checked]:bg-gray-100 has-[:checked]:dark:bg-gray-600 has-[:checked]:border-gray-900 has-[:checked]:dark:border-gray-100">
                                        <input 
                                            type="radio" 
                                            id="paymentMethod{{ $methodIndex }}" 
                                            name="payment_method" 
                                            value="{{ $method->id }}" 
                                            data-charge="{{$method->charge_amount}}" 
                                            data-discount="{{$method->discount_amount}}" 
                                            class="hidden md:inline-block mt-1 accent-primary-600 dark:accent-red-500" 
                                            wire:model.lazy="selectedMethod"
                                            x-bind:checked="methodIndex == 0"
                                        />

                                        <div class="flex flex-col {{FD['text-1']}} text-gray-700">
                                            <span class="font-medium text-gray-900 dark:text-gray-300">{{ $method->title }}</span>
                                            <span class="{{FD['text']}} text-gray-500 dark:text-gray-400">{{ $method->description }}</span>

                                            @if ($method->charge_amount > 0)
                                                <div class="mt-1 text-neutral-700 dark:text-neutral-300 {{FD['text']}}">
                                                    +
                                                    @if ($method->charge_type == 'fixed')
                                                        {{COUNTRY['icon']}}{{ $method->charge_amount }} on {{ $method->title }}
                                                    @else
                                                        {{ $method->charge_amount }}% CHARGE on {{ $method->title }}
                                                    @endif
                                                </div>
                                            @elseif ($method->discount_amount > 0)
                                                <div class="mt-1 text-green-600 dark:text-green-500 {{FD['text']}}">
                                                    @if ($method->discount_type == 'fixed')
                                                        {{COUNTRY['icon']}}{{ $method->discount_amount }} on {{ $method->title }}
                                                    @else
                                                        {{ $method->discount_amount }}% OFF on {{ $method->title }}
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <div>
                            {{-- <input type="hidden" name="shipping_address_id" value=""> --}}
                            {{-- <input type="hidden" name="billing_address_id" value="0"> --}}

                            <button type="submit" class="flex w-full md:w-40 items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                Place Order
                            </button>
                        </div>
                    </div>
                {{-- </form> --}}

            </div>
        @endif
    </div>
</div>

<script>
    /*
    const selectedShipAddrEl = document.querySelector('input[name=shipping_address_id]');
    const selectedBillAddrEl = document.querySelector('input[name=billing_address_id]');
    const shippingAddresses = document.querySelectorAll('.shipping-address');
    const billingAddresses = document.querySelectorAll('.billing-address');

    // Shipping Address
    if (selectedShipAddrEl && shippingAddresses.length > 0) {
        shippingAddresses.forEach(el => {
            if (el.checked) {
                selectedShipAddrEl.value = el.value;
            }

            el.addEventListener('change', () => {
                if (el.checked) {
                    selectedShipAddrEl.value = el.value;
                }
            });
        })
    }
    // Billing Address
    if (selectedBillAddrEl && billingAddresses.length > 0) {
        billingAddresses.forEach(el => {
            if (el.checked) {
                selectedBillAddrEl.value = el.value;
            }

            el.addEventListener('change', () => {
                if (el.checked) {
                    selectedBillAddrEl.value = el.value;
                }
            });
        })
    }
    */
</script>
