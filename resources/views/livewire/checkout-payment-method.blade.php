<div>
    <div class="{{ FD['rounded'] }} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">
        {{-- heading --}}
        <div class="space-y-4 flex items-center justify-between gap-2 sm:gap-6 sm:mb-2">
            <div class="w-full min-w-0 flex-1 md:order-2">
                <h2 class="flex space-x-2 items-center mb-1">
                    <div class="{{FD['iconClass']}}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M880-720v480q0 33-23.5 56.5T800-160H160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720Zm-720 80h640v-80H160v80Zm0 160v240h640v-240H160Zm0 240v-480 480Z"/></svg>
                    </div>

                    <p class="{{FD['text-1']}} md:text-base leading-tight font-medium text-gray-900 dark:text-gray-300">{{ __('Payment') }}</p>
                </h2>

                @if ( $shippingAddressesCount == 0 )
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">{!! __('Before we can process your payment, please provide your delivery address. It helps us calculate shipping and deliver your order correctly.') !!}</p>
                @else
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">{{ __('Complete Your Purchase') }}</p>
                @endif

            </div>
        </div>

        @if ( $shippingAddressesCount > 0 )
            <div class="w-full mt-4">
                <div class="flex flex-col space-y-2 md:space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 md:gap-4">
                        @foreach ($paymentMethods as $methodIndex => $method)
                            <div x-data="{ methodIndex: {{ $methodIndex }} }">
                                <label class="flex items-start gap-3 p-2 md:p-4 border-2 border-gray-300 dark:border-gray-700/50 {{ FD['rounded'] }} cursor-pointer has-[:checked]:bg-gray-100 has-[:checked]:dark:bg-gray-600 has-[:checked]:border-gray-900 has-[:checked]:dark:border-gray-100">
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
                                        form="place-order-form"
                                        data-method="{{ $method->method ?? '' }}"
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

                    @if($this->selectedMethodType !== 'prepaid')
                        <div id="cod">
                            <form action="{{ route('front.order.store') }}" method="post" id="place-order-form">@csrf
                                <button type="submit" class="flex w-full md:w-40 items-center justify-center {{ FD['rounded'] }} bg-primary-700 px-5 py-2.5 {{FD['text-2']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                    Place Order
                                </button>
                            </form>
                        </div>
                    @endif

                    @if($this->selectedMethodType === 'prepaid' && count($paymentGateways) > 0)
                        <div id="prepaid">
                            <div class="flex gap-4">
                                @foreach ($paymentGateways as $gateway)
                                    @php
                                        $code = $gateway->code ?? $gateway['code'] ?? null;
                                        $settings = $gateway->settings ?? $gateway['settings'] ?? null;
                                        // ensure settings is JSON string when printing as data attribute
                                        $settingsJson = is_string($settings) ? $settings : json_encode($settings);
                                    @endphp

                                    @if ($code === 'razorpay')
                                        <button
                                            type="button"
                                            id="pay-with-razorpay"
                                            data-gateway-id="{{ $gateway->id ?? $gateway['id'] ?? '' }}"
                                            data-settings="{{ $settingsJson }}"
                                            class="flex w-full md:w-60 items-center justify-center {{ FD['rounded'] }} px-5 py-2.5 {{FD['text-2']}} font-medium text-gray-800 hover:opacity-95 focus:outline-none focus:ring-4 focus:ring-primary-300 bg-gray-100 hover:bg-gray-200">
                                            Pay with 
                                            <div class="ms-1 w-24 h-5">
                                                {!! $gateway->svg_icon !!}
                                            </div>
                                        </button>

                                    @elseif ($code === 'paypal')
                                        <button
                                            type="button"
                                            id="pay-with-paypal"
                                            data-gateway-id="{{ $gateway->id ?? $gateway['id'] ?? '' }}"
                                            data-settings="{{ $settingsJson }}"
                                            class="flex w-full md:w-60 items-center justify-center {{ FD['rounded'] }} px-5 py-2.5 {{FD['text-2']}} font-medium text-white hover:opacity-95 focus:outline-none focus:ring-4 focus:ring-yellow-100 bg-yellow-500 hover:bg-yellow-600">
                                            Pay with 
                                            <div class="ms-1 w-24 h-5">
                                                {!! $gateway->svg_icon !!}
                                            </div>
                                        </button>

                                    @elseif ($code === 'stripe')
                                        <button
                                            type="button"
                                            id="pay-with-stripe"
                                            data-gateway-id="{{ $gateway->id ?? $gateway['id'] ?? '' }}"
                                            data-settings="{{ $settingsJson }}"
                                            class="flex w-full md:w-60 items-center justify-center {{ FD['rounded'] }} px-5 py-2.5 {{FD['text-2']}} font-medium text-white hover:opacity-95 focus:outline-none focus:ring-4 focus:ring-primary-300 bg-slate-700">
                                            Pay with 
                                            <div class="ms-1 w-24 h-5">
                                                {!! $gateway->svg_icon !!}
                                            </div>
                                        </button>

                                    @else
                                        {{-- Generic online gateway button for other providers --}}
                                        <button
                                            type="button"
                                            class="flex w-full md:w-60 items-center justify-center {{ FD['rounded'] }} px-5 py-2.5 {{FD['text-2']}} font-medium text-white hover:opacity-95 focus:outline-none focus:ring-4 focus:ring-primary-300 bg-primary-700"
                                            data-gateway-id="{{ $gateway->id ?? $gateway['id'] ?? '' }}"
                                            data-gateway-code="{{ $code }}"
                                            data-settings="{{ $settingsJson }}">
                                            Pay with {{ $gateway->name ?? $gateway['title'] ?? ucfirst($code) }}
                                        </button>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Use event delegation on the parent container
    document.addEventListener('click', async function (e) {
        // Check if the clicked element is the razorpay button or inside it
        if (e.target.closest('#pay-with-razorpay')) {
            e.preventDefault();
            const btn = e.target.closest('#pay-with-razorpay');
            await handleRazorpayPayment(btn);
        }
        
        // Add similar handlers for other payment buttons if needed
        if (e.target.closest('#pay-with-paypal')) {
            e.preventDefault();
            const btn = e.target.closest('#pay-with-paypal');
            // Handle PayPal payment
            console.log('PayPal clicked');
        }
        
        if (e.target.closest('#pay-with-stripe')) {
            e.preventDefault();
            const btn = e.target.closest('#pay-with-stripe');
            // Handle Stripe payment
            console.log('Stripe clicked');
        }
    });

    async function handleRazorpayPayment(btn) {
        // data-settings contains gateway settings (stringified JSON). You stored it in the button.
        const settings = JSON.parse(btn.getAttribute('data-settings') || '{}');
        console.log(settings);
        
        // get your app order id from JS state or DOM (example: set data-order-id on the button)
        const appOrderId = btn.closest('[data-order-id]')?.getAttribute('data-order-id') || window.ORDER_ID;
        if (!appOrderId) {
            alert('Order id missing');
            return;
        }

        // create order on server (saves gateway_order_id on the Order)
        const res = await fetch("{{ route('front.payment.razorpay.create') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ order_id: appOrderId })
        });

        if (!res.ok) {
            const err = await res.json().catch(()=>({message:'Create order failed'}));
            alert(err.message || 'Could not create payment order');
            return;
        }

        const payload = await res.json(); // { key, order_id, amount, currency, name, description }
        const options = {
            key: payload.key, // public key
            amount: payload.amount, // in paise
            currency: payload.currency,
            name: payload.name,
            description: payload.description,
            order_id: payload.order_id, // razorpay order id
            handler: async function (response) {
                // response contains razorpay_payment_id, razorpay_order_id, razorpay_signature
                // send to server verify route
                const verifyRes = await fetch("{{ route('front.payment.razorpay.verify') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_signature: response.razorpay_signature,
                        order_id: appOrderId
                    }),
                });
                const verifyJson = await verifyRes.json().catch(()=>({status:false, message:'Verification failed'}));
                if (verifyRes.ok && verifyJson.status) {
                    // success — redirect / show success
                    window.location.href = "/order/success/" + appOrderId; // adapt to your flow
                } else {
                    alert(verifyJson.message || 'Payment verification failed');
                }
            },
            prefill: {
                // optional: fill based on user
                name: "{{ optional(auth()->user())->name }}",
                email: "{{ optional(auth()->user())->email }}"
            },
            theme: { color: '#3399cc' } // optional UI ; change as desired
        };

        const rzp = new Razorpay(options);
        rzp.on('payment.failed', function (resp) {
            console.error('Payment failed', resp);
            alert('Payment failed: ' + (resp.error?.description || 'Unknown error'));
        });

        rzp.open();
    }
});
</script>