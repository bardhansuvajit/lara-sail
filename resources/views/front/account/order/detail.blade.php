@extends('layouts.front.account', [
    'title' => __('Order Details')
])

@section('content')
<div class="space-y-2 md:space-y-4">
    <!-- Order Header -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-6">
        <div class="flex items-start gap-4">
            <div>
                <a href="{{ route('front.order.index') }}" class="inline-flex items-center justify-center p-2 border border-gray-300 dark:border-gray-600 {{ FD['rounded'] }} {{ FD['text'] }} font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-240 120-480l240-240 56 56-144 144h568v80H272l144 144-56 56Z"/></svg>
                </a>
            </div>
            <div>
                <h1 class="{{ FD['text-1'] }} font-bold text-gray-900 dark:text-white">Order Details</h1>
                <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400 mt-1">Order #{{ $order->order_number }}</p>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <x-front.button
                element="a"
                size="md"
                tag="secondary"
                :href="route('front.order.invoice', $order->order_number)"
                >
                @slot('icon')
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                @endslot
                {{ __('View Invoice') }}
            </x-front.button>

            <x-front.button
                element="a"
                size="md"
                tag="success"
                :href="route('front.order.download-invoice', $order->order_number)"
                >
                @slot('icon')
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                @endslot
                {{ __('Download PDF') }}
            </x-front.button>
        </div>
    </div>

    <!-- Order Status Card -->
    <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} shadow-sm border border-gray-200 dark:border-gray-700 p-2 md:p-4">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="{{ FD['text-1'] }} font-semibold text-gray-900 dark:text-white mb-2">Order Status</h2>
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 rounded-full {{ FD['text'] }} font-medium
                        @if($order->status === 'delivered') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                        @elseif($order->status === 'cancelled') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                        @elseif($order->status === 'shipped') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                        @elseif($order->status === 'processing') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                        @elseif($order->status === 'pending') bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-200
                        @else bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200 @endif">
                        {{ ucwords(str_replace('_', ' ', $order->status)) }}
                    </span>
                    <span class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">
                        Ordered on {{ $order->created_at->format('F d, Y') }}
                    </span>
                </div>
                @if($order->status_notes)
                    <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400 mt-2">{{ $order->status_notes }}</p>
                @endif
            </div>
            <div class="text-right">
                <p class="{{ FD['text-1'] }} font-bold text-gray-900 dark:text-white">
                    {{ $order->currency_symbol }}{{ formatIndianMoney($order->total) }}
                </p>
                <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">Total Amount</p>
            </div>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 md:gap-4">
        <!-- Left Column - Order Items & Timeline -->
        <div class="lg:col-span-2 space-y-4">
            <!-- Order Items -->
            <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-2 md:p-4 border-b border-gray-200 dark:border-gray-700 bg-gray-200/40 dark:bg-gray-700/40">
                    <h2 class="{{ FD['text-1'] }} font-semibold text-gray-900 dark:text-white">Order Items ({{ $order->total_items }})</h2>
                </div>
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach($order->items as $item)
                    <div class="p-2 md:p-4">
                        <div class="flex gap-4">
                            <!-- Product Image -->
                            <div class="flex-shrink-0 w-16 h-16 bg-gray-100 dark:bg-gray-700 {{ FD['rounded'] }} overflow-hidden">
                                <a href="{{ $item->product_url_with_variation ?? $item->product_url }}" target="_blank">
                                    @if (!empty($item->image_m))
                                        <img class="w-full h-full object-cover" 
                                             src="{{ str_replace('storage/storage', 'storage', Storage::url($item->image_m)) }}" 
                                             alt="{{ $item->product_title }}"
                                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                        <div class="hidden w-full h-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-full h-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                            {!! FD['brokenImageFront'] !!}
                                            {{-- <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg> --}}
                                        </div>
                                    @endif
                                </a>
                            </div>

                            <!-- Product Details -->
                            <div class="flex-1 min-w-0">
                                <a href="{{ $item->product_url_with_variation ?? $item->product_url }}" 
                                   target="_blank" 
                                   class="{{ FD['text'] }} font-medium text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                                    {{ $item->product_title }}
                                </a>

                                @if (!empty($item->variation_attributes))
                                    <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400 mt-1">{{ $item->variation_attributes }}</p>
                                @endif

                                @if($item->sku)
                                    <p class="{{ FD['text-0'] }} text-gray-500 dark:text-gray-500 mt-1">SKU: {{ $item->sku }}</p>
                                @endif

                                <!-- Mobile Price -->
                                <div class="lg:hidden mt-3">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-2">
                                            <span class="{{ FD['text-1'] }} font-semibold text-gray-900 dark:text-white">
                                                {{ $order->currency_symbol }}{{ formatIndianMoney($item->selling_price) }}
                                            </span>
                                            <span class="{{ FD['text'] }} text-gray-500 dark:text-gray-400">× {{ $item->quantity }}</span>
                                        </div>
                                        <span class="{{ FD['text-1'] }} font-semibold text-gray-900 dark:text-white">
                                            {{ $order->currency_symbol }}{{ formatIndianMoney($item->selling_price * $item->quantity) }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Desktop Price -->
                            <div class="hidden lg:flex flex-col items-end justify-between">
                                <div class="text-right">
                                    <p class="{{ FD['text'] }} font-semibold text-gray-900 dark:text-white">
                                        {{ $order->currency_symbol }}{{ formatIndianMoney($item->selling_price) }}
                                    </p>
                                    <p class="{{ FD['text'] }} text-gray-500 dark:text-gray-400">Qty: {{ $item->quantity }}</p>
                                </div>
                                <p class="{{ FD['text'] }} font-semibold text-gray-900 dark:text-white">
                                    {{ $order->currency_symbol }}{{ formatIndianMoney($item->selling_price * $item->quantity) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-2 md:p-4 border-b border-gray-200 dark:border-gray-700 bg-gray-200/40 dark:bg-gray-700/40">
                    <h2 class="{{ FD['text-1'] }} font-semibold text-gray-900 dark:text-white">Order Timeline</h2>
                </div>
                <div class="p-2 md:p-4">
                    <div class="space-y-8">
                        <!-- Order Placed -->
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-green-500 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-white">Order Placed</p>
                                <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                                <p class="{{ FD['text'] }} text-gray-500 dark:text-gray-500 mt-1">Your order has been successfully placed.</p>
                            </div>
                        </div>

                        <!-- Payment -->
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full {{ $order->paid_at ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600' }} flex items-center justify-center">
                                    @if($order->paid_at)
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    @else
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-white">
                                    Payment {{ $order->paid_at ? 'Completed' : 'Pending' }}
                                </p>
                                <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">
                                    {{ $order->paid_at ? $order->paid_at->format('M d, Y \a\t h:i A') : 'Waiting for payment' }}
                                </p>
                                <p class="{{ FD['text'] }} text-gray-500 dark:text-gray-500 mt-1">
                                    Status: <span class="font-medium {{ $order->payment_status === 'paid' ? 'text-green-600 dark:text-green-400' : 'text-yellow-600 dark:text-yellow-400' }}">
                                        {{ ucfirst($order->payment_status) }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <!-- Processing -->
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full {{ $order->processed_at ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600' }} flex items-center justify-center">
                                    @if($order->processed_at)
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    @else
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-white">Processing</p>
                                <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">
                                    {{ $order->processed_at ? $order->processed_at->format('M d, Y \a\t h:i A') : 'In progress' }}
                                </p>
                                <p class="{{ FD['text'] }} text-gray-500 dark:text-gray-500 mt-1">
                                    Your order is being prepared for shipment.
                                </p>
                            </div>
                        </div>

                        <!-- Shipped -->
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full {{ $order->shipped_at ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600' }} flex items-center justify-center">
                                    @if($order->shipped_at)
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    @else
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-white">Shipped</p>
                                <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">
                                    {{ $order->shipped_at ? $order->shipped_at->format('M d, Y \a\t h:i A') : 'Not shipped yet' }}
                                </p>
                                @if($order->shipped_at)
                                <p class="{{ FD['text'] }} text-gray-500 dark:text-gray-500 mt-1">
                                    Your order has been shipped and is on its way.
                                </p>
                                @endif
                            </div>
                        </div>

                        <!-- Delivered -->
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full {{ $order->delivered_at ? 'bg-green-500' : 'bg-gray-300 dark:bg-gray-600' }} flex items-center justify-center">
                                    @if($order->delivered_at)
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    @else
                                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                    @endif
                                </div>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900 dark:text-white">Delivered</p>
                                <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">
                                    {{ $order->delivered_at ? $order->delivered_at->format('M d, Y \a\t h:i A') : 'Not delivered yet' }}
                                </p>
                                @if($order->cancelled_at)
                                <p class="{{ FD['text'] }} text-red-600 dark:text-red-400 mt-1">
                                    Cancelled on {{ $order->cancelled_at->format('M d, Y \a\t h:i A') }}
                                    @if($order->cancellation_reason)
                                        - {{ $order->cancellation_reason }}
                                    @endif
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Order Summary & Information -->
        <div class="space-y-4">
            <!-- Order Summary -->
            <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-2 md:p-4 border-b border-gray-200 dark:border-gray-700 bg-gray-200/40 dark:bg-gray-700/40">
                    <h2 class="{{ FD['text-1'] }} font-semibold text-gray-900 dark:text-white">Order Summary</h2>
                </div>
                <div class="p-2 md:p-4 space-y-1">
                    <div class="flex justify-between {{ FD['text'] }}">
                        <span class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">Subtotal</span>
                        <span class="{{ FD['text'] }} text-gray-900 dark:text-white">{{ $order->currency_symbol }}{{ formatIndianMoney($order->sub_total) }}</span>
                    </div>
                    
                    @if($order->coupon_discount_amount > 0)
                    <div class="flex justify-between {{ FD['text'] }}">
                        <span class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">Discount</span>
                        <span class="{{ FD['text'] }} text-green-600 dark:text-green-400">-{{ $order->currency_symbol }}{{ formatIndianMoney($order->coupon_discount_amount) }}</span>
                    </div>
                    @endif
                    
                    <div class="flex justify-between {{ FD['text'] }}">
                        <span class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">Shipping</span>
                        <span class="{{ FD['text'] }} text-gray-900 dark:text-white">{{ $order->currency_symbol }}{{ formatIndianMoney($order->shipping_cost) }}</span>
                    </div>
                    
                    @if($order->tax_amount > 0)
                    <div class="flex justify-between {{ FD['text'] }}">
                        <span class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">Tax</span>
                        <span class="{{ FD['text'] }} text-gray-900 dark:text-white">{{ $order->currency_symbol }}{{ formatIndianMoney($order->tax_amount) }}</span>
                    </div>
                    @endif
                    
                    @if($order->payment_method_charge > 0)
                    <div class="flex justify-between {{ FD['text'] }}">
                        <span class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">Payment Charge</span>
                        <span class="{{ FD['text'] }} text-gray-900 dark:text-white">{{ $order->currency_symbol }}{{ formatIndianMoney($order->payment_method_charge) }}</span>
                    </div>
                    @endif
                    
                    <div class="border-t border-gray-200 dark:border-gray-600 pt-3">
                        <div class="flex justify-between text-base font-semibold">
                            <span class="{{ FD['text'] }} text-gray-900 dark:text-white">Total</span>
                            <span class="{{ FD['text'] }} text-gray-900 dark:text-white">{{ $order->currency_symbol }}{{ formatIndianMoney($order->total) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-2 md:p-4 border-b border-gray-200 dark:border-gray-700 bg-gray-200/40 dark:bg-gray-700/40">
                    <h2 class="{{ FD['text-1'] }} font-semibold text-gray-900 dark:text-white">Shipping Information</h2>
                </div>
                <div class="p-2 md:p-4">
                    @if($order->shipping_address)
                        @php
                            $shippingAddress = is_string($order->shipping_address) ? json_decode($order->shipping_address, true) : $order->shipping_address;
                            // dd($shippingAddress)
                        @endphp
                        @if(is_array($shippingAddress))
                            <div class="space-y-1 {{ FD['text'] }}">
                                <p class="font-medium text-gray-900 dark:text-white">
                                    {{ $shippingAddress['first_name'] ?? '' }} {{ $shippingAddress['last_name'] ?? '' }}
                                </p>
                                <p class="text-gray-600 dark:text-gray-400">{{ $shippingAddress['address_line_1'] ?? '' }}</p>
                                @if($shippingAddress['address_line_2'] ?? '')
                                    <p class="text-gray-600 dark:text-gray-400">{{ $shippingAddress['address_line_2'] }}</p>
                                @endif
                                <p class="text-gray-600 dark:text-gray-400">
                                    {{ $shippingAddress['city'] ?? '' }}, {{ $shippingAddress['state'] ?? '' }} {{ $shippingAddress['postal_code'] ?? '' }}
                                </p>
                                <p class="text-gray-600 dark:text-gray-400">{{ $shippingAddress['country_detail']['name'] ?? '' }}</p>
                                <p class="text-gray-600 dark:text-gray-400 mt-3">
                                    <strong>Phone:</strong> {{ $order->phone_no }}
                                </p>
                                @if($order->email)
                                <p class="text-gray-600 dark:text-gray-400">
                                    <strong>Email:</strong> {{ $order->email }}
                                </p>
                                @endif
                            </div>
                        @else
                            <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">{{ $order->shipping_address }}</p>
                        @endif
                    @else
                        <p class="{{ FD['text'] }} text-gray-500 dark:text-gray-400">No shipping address provided</p>
                    @endif
                </div>
            </div>

            <!-- Payment Information -->
            <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-2 md:p-4 border-b border-gray-200 dark:border-gray-700 bg-gray-200/40 dark:bg-gray-700/40">
                    <h2 class="{{ FD['text-1'] }} font-semibold text-gray-900 dark:text-white">Payment Information</h2>
                </div>
                <div class="p-2 md:p-4 space-y-1 {{ FD['text'] }}">
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Method</span>
                        <span class="text-gray-900 dark:text-white font-medium">
                            {{ $order->payment_method_title ? ucwords($order->payment_method_title) : 'Not Specified' }}
                        </span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Status</span>
                        <span class="font-medium {{ $order->payment_status === 'paid' ? 'text-green-600 dark:text-green-400' : 'text-yellow-600 dark:text-yellow-400' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                    @if($order->transaction_id)
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Transaction ID</span>
                        <span class="text-gray-900 dark:text-white font-mono {{ FD['text-0'] }}">{{ $order->transaction_id }}</span>
                    </div>
                    @endif
                    @if($order->paid_at)
                    <div class="flex justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Paid On</span>
                        <span class="text-gray-900 dark:text-white">{{ $order->paid_at->format('M d, Y') }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Support -->
            <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} shadow-sm border border-gray-200 dark:border-gray-700">
                <div class="p-2 md:p-4">
                    <h2 class="{{ FD['text-1'] }} font-semibold text-gray-900 dark:text-white mb-4">Need Help?</h2>
                    @php
                        $supportMessage = "Hello, I need support for order number $order->order_number!";
                        $encodedMessage = rawurlencode($supportMessage);
                    @endphp

                    <x-front.button
                        element="a"
                        size="md"
                        tag="success"
                        href="https://wa.me/{{ applicationSettings('support_contact') }}?text={{ $encodedMessage }}"
                        >
                        @slot('icon')
                            <svg fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893c0-3.189-1.248-6.189-3.515-8.444"/></svg>
                        @endslot
                        {{ __('Contact Support') }}
                    </x-front.button>
                    {{-- <a href="https://wa.me/{{ applicationSettings('support_contact') }}?text={{ $encodedMessage }}" 
                       target="_blank"
                       class="inline-flex items-center justify-center w-full px-4 py-3 bg-green-600 text-white {{ FD['rounded'] }} {{ FD['text'] }} font-medium hover:bg-green-700 transition-colors mb-3">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893c0-3.189-1.248-6.189-3.515-8.444"/>
                        </svg>
                        Contact Support
                    </a> --}}
                    <p class="{{ FD['text-0'] }} text-gray-500 dark:text-gray-400 text-center mt-2">
                        Our support team is here to help with any questions about your order.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection