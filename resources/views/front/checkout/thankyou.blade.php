<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Thank you') }}">

    <section class="bg-gray-50 dark:bg-gray-900 min-h-screen py-5 px-2 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} shadow-md overflow-hidden transition-all duration-300 transform hover:shadow-lg">
            <div class="bg-green-500 px-6 py-6 text-center relative overflow-hidden">
                <!-- Confetti Container -->
                <div class="confetti-container absolute inset-0 overflow-hidden">
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                    <div class="confetti"></div>
                </div>

                <div class="relative z-10">
                    <div class="mx-auto flex items-center justify-center h-10 w-10 rounded-full bg-green-100 mb-3">
                        <svg class="h-5 w-5 text-green-600 animate-check" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    </div>

                    <h1 class="{{FD['text-1']}} font-bold text-white">Thank You For Your Order!</h1>
                    <p class="mt-1 {{FD['text']}} text-green-100">Your order has been placed successfully</p>

                    <div class="mt-4 text-center {{FD['text']}} text-white">
                        Order #{{$order->order_number}} &middot; Placed on {{ $order->created_at->format('F d, Y') }}
                    </div>
                </div>
            </div>

            <div class="p-2 md:p-4">
                <div class="mb-6">
                    <h2 class="{{FD['text-1']}} font-medium text-gray-900 dark:text-white mb-2 md:mb-4">Order Summary</h2>
                    <div class="border border-gray-200 dark:border-gray-700 {{ FD['rounded'] }} divide-y divide-gray-200 dark:divide-gray-700">
                        <div class="p-2 md:p-4">
                            <div class="flex flex-wrap space-x-8">
                                @foreach ($order->items as $item)
                                    <div class="flex flex-col space-y-2 items-center">
                                        <div class="h-[60px] object-cover">
                                            @if (!empty($item->image_m))
                                                <img class="h-auto max-h-full w-full" src="{{ str_replace('storage/storage', 'storage', Storage::url($item->image_m)) }}" alt="{{$item->product_title}}" />
                                            @else
                                                {!! FD['brokenImageFront'] !!}
                                            @endif
                                        </div>

                                        <div class="flex-1 min-w-0">
                                            <p class="{{FD['text']}} font-medium text-gray-900 dark:text-white truncate">{{ $item->product_title }}</p>
                                            @if (!empty($item->variation_attributes))
                                                <p class="{{FD['text']}} text-gray-600 dark:text-gray-400">{{ $item->variation_attributes }}</p>
                                            @endif
                                            <div class="flex space-x-2 mt-0.5">
                                                <p class="{{FD['text']}} font-medium text-gray-900 dark:text-white">
                                                    <span class="currency-icon">{{$order->currency_symbol}}</span>
                                                    {{ formatIndianMoney($item->selling_price) }}
                                                </p>
                                                <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">x{{ $item->quantity }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="p-2 md:p-4 space-y-2">
                            <div class="flex justify-between">
                                <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Original price</p>
                                <p class="{{FD['text']}} text-gray-900 dark:text-white">
                                    <span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->mrp) }}
                                </p>
                            </div>
                            <div class="flex justify-between">
                                <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Savings</p>
                                <p class="{{FD['text']}} text-green-600">
                                    -<span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->mrp - $order->sub_total) }}
                                </p>
                            </div>
                            <div class="flex justify-between">
                                <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Sub-Total</p>
                                <p class="{{FD['text']}} text-gray-900 dark:text-white">
                                    <span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->sub_total) }}
                                </p>
                            </div>

                            @if ($order->shipping_cost > 0)
                                <div class="flex justify-between">
                                    <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Shipping</p>
                                    <p class="{{FD['text']}} text-gray-900 dark:text-white">
                                        <span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->shipping_cost) }}
                                    </p>
                                </div>
                            @endif

                            @if ($order->tax_amount > 0)
                                <div class="flex justify-between">
                                    <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Tax</p>
                                    <p class="{{FD['text']}} text-gray-900 dark:text-white">
                                        <span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->tax_amount) }}
                                    </p>
                                </div>
                            @endif

                            @if ($order->coupon_discount_amount > 0)
                                <div class="flex justify-between pb-1">
                                    <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Coupon Discount</p>
                                    <p class="{{FD['text']}} text-green-600">
                                        -<span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->coupon_discount_amount) }}
                                    </p>
                                </div>
                            @endif

                            @if ($order->payment_method_charge > 0)
                                <div class="flex justify-between pb-1">
                                    <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Payment method Charge</p>
                                    <p class="{{FD['text']}} text-gray-900 dark:text-white">
                                        <span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->payment_method_charge) }}
                                    </p>
                                </div>
                            @elseif ($order->payment_method_discount > 0)
                                <div class="flex justify-between pb-1">
                                    <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Payment method Discount</p>
                                    <p class="{{FD['text']}} text-green-600">
                                        -<span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->payment_method_discount) }}
                                    </p>
                                </div>
                            @endif

                            <div class="border-t border-gray-200 dark:border-gray-700 pb-1"></div>

                            <div class="flex justify-between">
                                <p class="{{FD['text']}} font-medium text-gray-900 dark:text-white">Total</p>
                                <p class="{{FD['text']}} font-bold text-gray-900 dark:text-white">
                                    <span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->total) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                    <div class="flex flex-col">
                        <h2 class="{{FD['text-1']}} font-medium text-gray-900 dark:text-white mb-2 md:mb-4">Customer Information</h2>
                        <div class="bg-gray-50 dark:bg-gray-700 p-2 md:p-4 h-full flex flex-col justify-between {{ FD['rounded'] }}">
                            <p class="{{FD['text']}} text-gray-900 dark:text-white font-medium">{{$order->user->first_name}} {{$order->user->last_name}}</p>
                            <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">{{$order->email}}</p>
                            <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">{{$order->phone_no}}</p>

                            <div class="flex items-center mt-3">
                                @if ($order->country->flag)
                                    <div class="inline-flex justify-center h-4 mr-2">
                                        {!! $order->country->flag !!}
                                    </div>
                                @endif
                                <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">{{ $order->country->name }}</p>
                            </div>

                        </div>
                    </div>

                    <div class="flex flex-col">
                        <h2 class="{{FD['text-1']}} font-medium text-gray-900 dark:text-white mb-2 md:mb-4">Payment Details</h2>
                        <div class="bg-gray-50 dark:bg-gray-700 p-2 md:p-4 h-full flex flex-col justify-between {{ FD['rounded'] }}">
                            <div class="flex items-center">
                                <div class="bg-white p-1 {{ FD['rounded'] }} mr-2 md:mr-4">
                                    <svg class="h-5 w-5 text-gray-700" fill="currentColor"  xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="#e3e3e3"><path d="M713.82-61.54q-85.69 0-145.02-59.07-59.34-59.06-59.34-143.54 0-84.93 59.34-144.66 59.33-59.73 145.02-59.73 84.18 0 143.41 59.69 59.23 59.69 59.23 144.72 0 84.51-59.23 143.55Q798-61.54 713.82-61.54ZM145.39-225.39V-539.23-518.08v-216.53V-225.39Zm0-391.76h669.22v-105.16q0-4.61-3.84-8.46-3.85-3.84-8.46-3.84H157.69q-4.61 0-8.46 3.84-3.84 3.85-3.84 8.46v105.16ZM157.69-180q-23.53 0-40.61-17.08T100-237.69v-484.62q0-23.53 17.08-40.61T157.69-780h644.62q23.53 0 40.61 17.08T860-722.31v190.46q0 13.23-10.92 19.43-10.93 6.19-22.54-.04-26.51-12.99-56.22-19.88-29.71-6.89-61.63-6.89-31.84 0-62.46 6.92-30.61 6.92-58.15 19.92H145.39v274.7q0 4.61 3.84 8.46 3.85 3.84 8.46 3.84h269.77q9.67 0 16.18 6.57t6.51 16.31q0 9.74-6.51 16.12-6.51 6.39-16.18 6.39H157.69Zm566.77-87.31v-108.38q0-6.99-4.93-12.03-4.93-5.05-11.76-5.05-7.23 0-12.46 5.23t-5.23 12.46v109.39q0 5.6 2 10.6 2 5.01 5.61 9.63l79.39 80.61q5.33 5.23 12.51 5.43 7.18.19 12.41-5.43 5.61-5.23 5.61-12.21 0-6.99-5.61-12.71l-77.54-77.54Z"/></svg>
                                </div>
                                <div>
                                    <p class="{{FD['text']}} text-gray-900 dark:text-white font-medium">{!!$order->paymentMethod->title!!}</p>
                                    <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">{!!$order->paymentMethod->after_order_title!!}</p>
                                </div>
                            </div>
                            <p class="mt-2 {{FD['text-0']}} text-gray-600 dark:text-gray-300">{{$order->paymentMethod->after_order_description}}</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                    <div class="flex flex-col">
                        <h2 class="{{FD['text-1']}} font-medium text-gray-900 dark:text-white mb-2 md:mb-4">Address details</h2>
                        <div class="bg-gray-50 dark:bg-gray-700 p-2 md:p-4 h-full flex flex-col justify-between {{ FD['rounded'] }}">
                            @php
                                $shippingAddress = json_decode($order->shipping_address);
                            @endphp

                            <p class="{{FD['text']}} text-gray-900 dark:text-white font-medium">
                                {{ $shippingAddress->first_name }} {{ $shippingAddress->last_name }}, 
                                {{ $shippingAddress->phone_no }}
                            </p>

                            <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">
                                {{ $shippingAddress->address_line_1 }} 
                                {{ $shippingAddress->address_line_2 }} @if (!empty( $shippingAddress->landmark )), {{ $shippingAddress->landmark }} @endif
                            </p>

                            <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">
                                {{ $shippingAddress->city }}, 
                                {{ strtoupper($shippingAddress->state) }}, 
                                {{ $shippingAddress->postal_code }}
                            </p>

                            @if ($order->country->code != $shippingAddress->country_code)
                                <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">
                                    {{ $shippingAddress->country_code }}
                                </p>
                            @endif

                            @if (empty($order->billing_address))
                                <p class="mt-2 {{FD['text-0']}} text-gray-600 dark:text-gray-300">Billing address is same as shipping address.</p>
                            @endif

                        </div>
                    </div>

                    @if (!empty($order->billing_address))
                    <div class="flex flex-col">
                        <h2 class="{{FD['text-1']}} font-medium text-gray-900 dark:text-white mb-2 md:mb-4">Billing Address</h2>
                        <div class="bg-gray-50 dark:bg-gray-700 p-2 md:p-4 h-full flex flex-col justify-between {{ FD['rounded'] }}">
                            @php
                                $billingAddress = json_decode($order->billing_address);
                            @endphp

                            <p class="{{FD['text']}} text-gray-900 dark:text-white font-medium">
                                {{ $billingAddress->first_name }} {{ $billingAddress->last_name }}, 
                                {{ $billingAddress->phone_no }}
                            </p>

                            <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">
                                {{ $billingAddress->address_line_1 }} 
                                {{ $billingAddress->address_line_2 }} @if (!empty( $billingAddress->landmark )), {{ $billingAddress->landmark }} @endif
                            </p>

                            <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">
                                {{ $billingAddress->city }}, 
                                {{ strtoupper($billingAddress->state) }}, 
                                {{ $billingAddress->postal_code }}
                            </p>

                            @if ($order->country->code != $billingAddress->country_code)
                                <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">
                                    {{ $billingAddress->country_code }}
                                </p>
                            @endif

                        </div>
                    </div>
                    @endif

                    <div class="flex flex-col">
                        <h2 class="{{FD['text-1']}} font-medium text-gray-900 dark:text-white mb-2 md:mb-4">Delivery Details</h2>
                        <div class="bg-gray-50 dark:bg-gray-700 p-2 md:p-4 h-full flex flex-col justify-between {{ FD['rounded'] }}">
                            <div class="flex items-center">
                                <div class="bg-white p-1 {{ FD['rounded'] }} mr-2 md:mr-4">
                                    <svg class="h-5 w-5 text-gray-700 dark:text-gray-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M282.74-180q-45.82 0-75.7-32.7-29.88-32.7-26.42-77.92h-66.46q-9.65 0-16.17-6.58-6.53-6.58-6.53-16.3 0-9.73 6.53-16.12 6.52-6.38 16.17-6.38h82.99q12.31-22.23 34.97-35.81 22.65-13.58 50.57-13.58 27.93 0 50.58 13.58T368.62-336H567l91.62-398.61H233.54q-10.06 0-16.07-6.59-6.01-6.58-6.01-16.3 0-9.73 6.53-16.11 6.52-6.39 16.16-6.39h444.54q13.62 0 22.54 10.92 8.92 10.93 6.31 24.54l-28.31 121.85h77.31q13.52 0 25.63 5.94 12.1 5.94 20.44 17.29l76.93 103.15q7.61 10.62 10.11 21.54 2.5 10.92.5 23.54l-26.69 136.77q-2.31 10.17-10.53 17-8.23 6.84-18.7 6.84h-38.85q3.47 45.16-26.68 77.89Q738.55-180 692.74-180q-45.82 0-75.7-32.7-29.89-32.7-26.42-77.92H385.39q3.46 45.16-26.69 77.89Q328.55-180 282.74-180ZM634-427.69h205.77l6.77-37.23-83.85-112.39h-94.18L634-427.69Zm-56.69 46.84 5.85-23.87q5.84-23.86 13.23-58.82 4.38-17.92 7.57-33.77 3.2-15.84 6.2-26.46l5.84-23.87q5.85-23.87 13.2-58.8 7.34-34.94 12.92-58.83l5.57-23.88 10.93-45.46L567-336l10.31-44.85Zm-504.46-60q-9.9 0-15.8-6.53-5.89-6.53-5.89-16.18 0-9.65 6.39-16.16 6.4-6.51 16.3-6.51h154.23q9.64 0 16.17 6.58 6.52 6.58 6.52 16.31 0 9.72-6.52 16.11-6.53 6.38-16.17 6.38H72.85Zm80-142.92q-9.65 0-16.17-6.58-6.52-6.58-6.52-16.31 0-9.72 6.52-16.11 6.52-6.38 16.17-6.38h195.23q9.64 0 16.17 6.58 6.52 6.58 6.52 16.3 0 9.73-6.52 16.12-6.53 6.38-16.17 6.38H152.85Zm130.34 358.38q23.58 0 40.2-17.11Q340-259.62 340-283.19q0-23.58-16.49-40.2Q307.02-340 282.69-340q-23.07 0-40.19 16.49-17.11 16.49-17.11 40.82 0 23.07 17.11 40.19 17.12 17.11 40.69 17.11Zm410 0q23.58 0 40.2-17.11Q750-259.62 750-283.19q0-23.58-16.49-40.2Q717.02-340 692.69-340q-23.07 0-40.19 16.49-17.12 16.49-17.12 40.82 0 23.07 17.12 40.19 17.12 17.11 40.69 17.11Z"/></svg>
                                </div>
                                <div>
                                    <p class="{{FD['text']}} text-gray-900 dark:text-white font-medium">We Got Your Order</p>
                                    <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">
                                        Estimated Delivery by {{ $order->created_at->addDays($order->shippingMethod->max_delivery_day)->format('l, F d, Y') }}
                                    </p>
                                </div>
                            </div>
                            <p class="mt-2 {{FD['text-0']}} text-gray-600 dark:text-gray-300">Your order will be shipped within the next 24-48 hours. Once dispatched, we&apos;ll send you a tracking link.</p>
                        </div>
                    </div>
                </div>

                <div>
                    <h2 class="{{FD['text-1']}} font-medium text-gray-900 dark:text-white">Next Steps</h2>
                    <div class="space-y-2">
                        @if ($order->email)
                            <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">We've sent your order confirmation to <span class="font-medium text-gray-900 dark:text-white">{{ $order->email }}</span>.</p>
                        @endif

                        <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Your order will ship within 2 business days.</p>

                        <div class="flex flex-col sm:flex-row gap-2 pt-3">
                            <a href="{{ route('front.order.invoice', $order->order_number) }}" class="px-3 py-1.5 {{FD['text']}} bg-indigo-600 hover:bg-indigo-700 text-white {{ FD['rounded'] }} transition-colors duration-300">
                                Download Invoice (PDF)
                            </a>
                            <button class="px-3 py-1.5 {{FD['text']}} border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 {{ FD['rounded'] }} transition-colors duration-300">
                                Track Your Order
                            </button>
                            <button class="px-3 py-1.5 {{FD['text']}} text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 {{ FD['rounded'] }} transition-colors duration-300">
                                Continue Shopping
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

</x-guest-layout>
