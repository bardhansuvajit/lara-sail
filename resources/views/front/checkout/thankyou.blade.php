<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Thank you') }}">

    <section class="bg-gray-50 dark:bg-gray-900 min-h-screen py-5 px-2 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white dark:bg-gray-800 {{FD['rounded']}} shadow-md overflow-hidden transition-all duration-300 transform hover:shadow-lg">
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
                        <svg class="h-5 w-5 text-green-600 animate-check" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h1 class="{{FD['text-1']}} font-bold text-white">Thank You For Your Order!</h1>
                    <p class="mt-1 {{FD['text']}} text-green-100">Your order has been placed successfully</p>

                    <div class="mt-4 text-center {{FD['text']}} text-white">
                        Order #{{$order->order_number}} &middot; Placed on {{ $order->created_at->format('F d, Y') }}
                    </div>
                </div>
            </div>

            <div class="px-2 py-3 md:px-5 md:py-6">
                <div class="mb-6">
                    <h2 class="{{FD['text-1']}} font-medium text-gray-900 dark:text-white mb-3">Order Summary</h2>
                    <div class="border border-gray-200 dark:border-gray-700 {{FD['rounded']}} divide-y divide-gray-200 dark:divide-gray-700">
                        <div class="p-3">
                            <div class="flex flex-wrap space-x-8">
                                @foreach ($order->items as $item)
                                    <div class="flex flex-col space-y-2 items-center">
                                        <img src="https://placehold.co/100x100" alt="Premium T-Shirt" class="w-[60px] h-[60px] object-cover rounded border border-gray-200 dark:border-gray-600">

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

                        <div class="p-3">
                            <div class="flex justify-between py-1">
                                <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Original price</p>
                                <p class="{{FD['text']}} text-gray-900 dark:text-white">
                                    <span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->mrp) }}
                                </p>
                            </div>
                            <div class="flex justify-between py-1">
                                <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Savings</p>
                                <p class="{{FD['text']}} text-green-600">
                                    <span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->mrp - $order->sub_total) }}
                                </p>
                            </div>
                            <div class="flex justify-between py-1">
                                <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Sub-Total</p>
                                <p class="{{FD['text']}} text-gray-900 dark:text-white">
                                    <span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->sub_total) }}
                                </p>
                            </div>

                            @if ($order->shipping_cost > 0)
                                <div class="flex justify-between py-1">
                                    <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Shipping</p>
                                    <p class="{{FD['text']}} text-gray-900 dark:text-white">
                                        <span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->shipping_cost) }}
                                    </p>
                                </div>
                            @endif

                            @if ($order->tax_amount > 0)
                                <div class="flex justify-between py-1">
                                    <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Tax</p>
                                    <p class="{{FD['text']}} text-gray-900 dark:text-white">
                                        <span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->tax_amount) }}
                                    </p>
                                </div>
                            @endif

                            @if ($order->payment_method_charge > 0)
                                <div class="flex justify-between py-1">
                                    <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Payment method Charge</p>
                                    <p class="{{FD['text']}} text-gray-900 dark:text-white">
                                        <span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->payment_method_charge) }}
                                    </p>
                                </div>
                            @elseif ($order->payment_method_discount > 0)
                                <div class="flex justify-between py-1">
                                    <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Payment method Discount</p>
                                    <p class="{{FD['text']}} text-gray-900 dark:text-white">
                                        <span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->payment_method_discount) }}
                                    </p>
                                </div>
                            @endif

                            <div class="flex justify-between py-1 border-t border-gray-200 dark:border-gray-700 mt-2 pt-2">
                                <p class="{{FD['text']}} font-medium text-gray-900 dark:text-white">Total</p>
                                <p class="{{FD['text']}} font-bold text-gray-900 dark:text-white">
                                    <span class="currency-icon">{{$order->currency_symbol}}</span>{{ formatIndianMoney($order->total) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <h2 class="{{FD['text-1']}} font-medium text-gray-900 dark:text-white mb-3">Customer Information</h2>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 {{FD['rounded']}}">
                            <p class="{{FD['text']}} text-gray-900 dark:text-white font-medium">{{$order->user->first_name}} {{$order->user->last_name}}</p>
                            <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">{{$order->email}}</p>
                            <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">{{$order->phone_no}}</p>

                            <div class="flex items-center mt-3">
                                @if ($order->countryDetail->flag)
                                    <div class="inline-flex justify-center h-4 mr-2">
                                        {!! $order->countryDetail->flag !!}
                                    </div>
                                @endif
                                <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">{{ $order->countryDetail->name }}</p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="{{FD['text-1']}} font-medium text-gray-900 dark:text-white mb-3">Payment Details</h2>
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 {{FD['rounded']}}">
                        <div class="flex items-center">
                            <div class="bg-white p-1 rounded mr-2">
                            <svg class="h-5 w-5 text-gray-700" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 1.5C6.2 1.5 1.5 6.2 1.5 12S6.2 22.5 12 22.5 22.5 17.8 22.5 12 17.8 1.5 12 1.5zM9 16.5v-9l7.5 4.5L9 16.5z"/>
                            </svg>
                            </div>
                            <div>
                            <p class="{{FD['text']}} text-gray-900 dark:text-white font-medium">Visa ending in 4242</p>
                            <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Expires 12/2025</p>
                            </div>
                        </div>
                        <p class="mt-2 {{FD['text']}} text-gray-600 dark:text-gray-300">Billing address matches shipping address</p>
                        </div>
                    </div>
                </div>

                <!-- Invoice & Actions -->
                <div>
                <h2 class="{{FD['text-1']}} font-medium text-gray-900 dark:text-white mb-3">Next Steps</h2>
                <div class="space-y-2">
                    <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">We've sent your order confirmation to <span class="font-medium text-gray-900 dark:text-white">john@example.com</span>.</p>
                    <p class="{{FD['text']}} text-gray-600 dark:text-gray-300">Your order will ship within 2 business days.</p>
                    
                    <div class="flex flex-col sm:flex-row gap-2 pt-3">
                    <button class="px-3 py-1.5 {{FD['text']}} bg-indigo-600 hover:bg-indigo-700 text-white {{FD['rounded']}} transition-colors duration-300">
                        Download Invoice (PDF)
                    </button>
                    <button class="px-3 py-1.5 {{FD['text']}} border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 {{FD['rounded']}} transition-colors duration-300">
                        Track Your Order
                    </button>
                    <button class="px-3 py-1.5 {{FD['text']}} text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 {{FD['rounded']}} transition-colors duration-300">
                        Continue Shopping
                    </button>
                    </div>
                </div>
                </div>
            </div>
            </div>

            {{-- <!-- Order Number -->
            <div class="mt-4 text-center {{FD['text']}} text-gray-500 dark:text-gray-400">
            Order #W08643805 &middot; Placed on June 15, 2023
            </div> --}}
        </div>
    </section>

    <style>
        /* Checkmark animation */
        .animate-check {
            animation: check 0.5s;
        }
        @keyframes check {
            from {
            stroke-dashoffset: 26;
            stroke-dasharray: 26;
            }
            to {
            stroke-dashoffset: 0;
            stroke-dasharray: 26;
            }
        }

        /* Confetti styles */
        .confetti-container {
            pointer-events: none;
        }
        
        .confetti {
            position: absolute;
            width: 8px;
            height: 8px;
            background-color: #f0f;
            opacity: 0;
            animation: confetti 3s ease-in-out infinite;
        }
        
        /* Original 10 pieces with specific colors */
        .confetti:nth-child(1) { background-color: #f0f; left: 10%; animation-delay: 0; }
        .confetti:nth-child(2) { background-color: #0ff; left: 20%; animation-delay: 0.5s; }
        .confetti:nth-child(3) { background-color: #ff0; left: 30%; animation-delay: 1s; }
        .confetti:nth-child(4) { background-color: #f00; left: 40%; animation-delay: 1.5s; }
        .confetti:nth-child(5) { background-color: #0f0; left: 50%; animation-delay: 2s; }
        .confetti:nth-child(6) { background-color: #00f; left: 60%; animation-delay: 2.5s; }
        .confetti:nth-child(7) { background-color: #f0f; left: 70%; animation-delay: 0.5s; }
        .confetti:nth-child(8) { background-color: #0ff; left: 80%; animation-delay: 1s; }
        .confetti:nth-child(9) { background-color: #ff0; left: 90%; animation-delay: 1.5s; }
        .confetti:nth-child(10) { background-color: #f00; left: 100%; animation-delay: 2s; }
        
        /* Additional 30 pieces with random colors and positions */
        .confetti:nth-child(11) { background-color: #ff8c00; left: 5%; animation-delay: 0.2s; }
        .confetti:nth-child(12) { background-color: #4b0082; left: 15%; animation-delay: 0.7s; }
        .confetti:nth-child(13) { background-color: #ff1493; left: 25%; animation-delay: 1.2s; }
        .confetti:nth-child(14) { background-color: #7cfc00; left: 35%; animation-delay: 1.7s; }
        .confetti:nth-child(15) { background-color: #00bfff; left: 45%; animation-delay: 2.2s; }
        .confetti:nth-child(16) { background-color: #ff4500; left: 55%; animation-delay: 0.3s; }
        .confetti:nth-child(17) { background-color: #9400d3; left: 65%; animation-delay: 0.8s; }
        .confetti:nth-child(18) { background-color: #32cd32; left: 75%; animation-delay: 1.3s; }
        .confetti:nth-child(19) { background-color: #ff69b4; left: 85%; animation-delay: 1.8s; }
        .confetti:nth-child(20) { background-color: #1e90ff; left: 95%; animation-delay: 2.3s; }
        .confetti:nth-child(21) { background-color: #ff6347; left: 8%; animation-delay: 0.4s; }
        .confetti:nth-child(22) { background-color: #9932cc; left: 18%; animation-delay: 0.9s; }
        .confetti:nth-child(23) { background-color: #3cb371; left: 28%; animation-delay: 1.4s; }
        .confetti:nth-child(24) { background-color: #ffa500; left: 38%; animation-delay: 1.9s; }
        .confetti:nth-child(25) { background-color: #4169e1; left: 48%; animation-delay: 2.4s; }
        .confetti:nth-child(26) { background-color: #dc143c; left: 58%; animation-delay: 0.1s; }
        .confetti:nth-child(27) { background-color: #8a2be2; left: 68%; animation-delay: 0.6s; }
        .confetti:nth-child(28) { background-color: #20b2aa; left: 78%; animation-delay: 1.1s; }
        .confetti:nth-child(29) { background-color: #ffd700; left: 88%; animation-delay: 1.6s; }
        .confetti:nth-child(30) { background-color: #6a5acd; left: 98%; animation-delay: 2.1s; }
        .confetti:nth-child(31) { background-color: #ff7f50; left: 12%; animation-delay: 0.25s; }
        .confetti:nth-child(32) { background-color: #ba55d3; left: 22%; animation-delay: 0.75s; }
        .confetti:nth-child(33) { background-color: #66cdaa; left: 32%; animation-delay: 1.25s; }
        .confetti:nth-child(34) { background-color: #ffa07a; left: 42%; animation-delay: 1.75s; }
        .confetti:nth-child(35) { background-color: #4682b4; left: 52%; animation-delay: 2.25s; }
        .confetti:nth-child(36) { background-color: #cd5c5c; left: 62%; animation-delay: 0.35s; }
        .confetti:nth-child(37) { background-color: #da70d6; left: 72%; animation-delay: 0.85s; }
        .confetti:nth-child(38) { background-color: #98fb98; left: 82%; animation-delay: 1.35s; }
        .confetti:nth-child(39) { background-color: #ffb6c1; left: 92%; animation-delay: 1.85s; }
        .confetti:nth-child(40) { background-color: #6495ed; left: 2%; animation-delay: 2.35s; }
        
        @keyframes confetti {
            0% {
            opacity: 0;
            transform: translateY(0) rotate(0deg);
            }
            10% {
            opacity: 1;
            }
            100% {
            opacity: 0;
            transform: translateY(200px) rotate(360deg);
            }
        }
    </style>
    
</x-app-layout>

@push('scripts')
    <script>
        alert('hi');
    </script>
@endpush