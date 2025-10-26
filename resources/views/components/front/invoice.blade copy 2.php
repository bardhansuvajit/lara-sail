<div id="invoice-content">
    <div class="min-h-screen bg-white dark:bg-gray-700 text-gray-800 {{FD['text-1']}} p-4 md:p-6">
        <!-- Header with Download Button -->
        <header class="mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-xl font-bold">Order Invoice</h1>
                    <p class="{{FD['text']}} text-gray-500">Invoice #{{$order->order_number}}</p>
                </div>
                <div class="flex flex-col items-end gap-2">
                    <div class="text-right">
                        <p class="font-medium">Order Placed</p>
                        <p class="{{FD['text']}} text-gray-500">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                    </div>
                    <a href="{{ route('front.order.download-invoice', $order->order_number) }}" 
                       class="flex items-center gap-2 px-4 py-2 bg-red-600 text-white {{ FD['rounded'] }} {{FD['text']}} font-medium hover:bg-red-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download PDF
                    </a>
                </div>
            </div>
        </header>

        <!-- Order Summary -->
        <div class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Shipping Address -->
            <div class="bg-gray-50 p-4 {{ FD['rounded'] }} shadow-sm">
                <h2 class="font-medium mb-2">Shipping Address</h2>
                @if($order->shipping_address)
                    @php
                        $shippingAddress = is_string($order->shipping_address) ? json_decode($order->shipping_address, true) : $order->shipping_address;
                    @endphp
                    @if(is_array($shippingAddress))
                        <p class="{{FD['text']}} mb-1">{{ $shippingAddress['first_name'] ?? '' }} {{ $shippingAddress['last_name'] ?? '' }}</p>
                        <p class="{{FD['text']}} mb-1">{{ $shippingAddress['address_line1'] ?? '' }}</p>
                        @if($shippingAddress['address_line2'] ?? '')
                            <p class="{{FD['text']}} mb-1">{{ $shippingAddress['address_line2'] }}</p>
                        @endif
                        <p class="{{FD['text']}} mb-1">{{ $shippingAddress['city'] ?? '' }}, {{ $shippingAddress['state'] ?? '' }} {{ $shippingAddress['zip_code'] ?? '' }}</p>
                        <p class="{{FD['text']}} mb-1">{{ $shippingAddress['country'] ?? '' }}</p>
                        <p class="{{FD['text']}} text-gray-500 mt-2">Phone: {{ $order->phone_no }}</p>
                    @else
                        <p class="{{FD['text']}} text-gray-500">{{ $order->shipping_address }}</p>
                    @endif
                @else
                    <p class="{{FD['text']}} text-gray-500">No shipping address provided</p>
                @endif
            </div>

            <!-- Payment Method -->
            <div class="bg-gray-50 p-4 {{ FD['rounded'] }} shadow-sm">
                <h2 class="font-medium mb-2">Payment Method</h2>
                <div class="flex items-center gap-2 mb-2">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                    </div>
                    <p class="{{FD['text']}}">{{ $order->payment_method_title ? ucwords($order->payment_method_title) : 'Not Specified' }}</p>
                </div>
                <p class="{{FD['text']}} text-gray-500">
                    {{ $order->same_as_shipping ? 'Billing address same as shipping' : 'Different billing address' }}
                </p>
                @if($order->transaction_id)
                    <p class="{{FD['text']}} text-gray-500 mt-1">
                        Transaction: {{ $order->transaction_id }}
                    </p>
                @endif
            </div>

            <!-- Order Summary -->
            <div class="bg-gray-50 p-4 {{ FD['rounded'] }} shadow-sm">
                <h2 class="font-medium mb-2">Order Summary</h2>
                <div class="flex justify-between {{FD['text']}} mb-1">
                    <span>Items ({{ $order->total_items }}):</span>
                    <span>{{ $order->currency_symbol }}{{ formatIndianMoney($order->mrp) }}</span>
                </div>
                @if($order->coupon_discount_amount > 0)
                <div class="flex justify-between {{FD['text']}} mb-1">
                    <span>Discount:</span>
                    <span class="text-green-600">-{{ $order->currency_symbol }}{{ formatIndianMoney($order->coupon_discount_amount) }}</span>
                </div>
                @endif
                <div class="flex justify-between {{FD['text']}} mb-1">
                    <span>Shipping:</span>
                    <span>{{ $order->currency_symbol }}{{ formatIndianMoney($order->shipping_cost) }}</span>
                </div>
                @if($order->tax_amount > 0)
                <div class="flex justify-between {{FD['text']}} mb-1">
                    <span>Tax:</span>
                    <span>{{ $order->currency_symbol }}{{ formatIndianMoney($order->tax_amount) }}</span>
                </div>
                @endif
                @if($order->payment_method_charge > 0)
                <div class="flex justify-between {{FD['text']}} mb-1">
                    <span>Payment Charge:</span>
                    <span>{{ $order->currency_symbol }}{{ formatIndianMoney($order->payment_method_charge) }}</span>
                </div>
                @endif
                <div class="border-t border-gray-300 my-2"></div>
                <div class="flex justify-between font-medium">
                    <span>Order Total:</span>
                    <span>{{ $order->currency_symbol }}{{ formatIndianMoney($order->total) }}</span>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mb-8">
            <h2 class="font-medium mb-4">Order Items</h2>
            <div class="bg-gray-50 {{ FD['rounded'] }} shadow-sm overflow-hidden">
                @forelse($order->items as $item)
                <div class="p-4 border-b border-gray-300 last:border-b-0">
                    <div class="flex gap-4">
                        <div class="w-20 h-20 bg-gray-200 rounded flex-shrink-0 overflow-hidden">
                            @if (!empty($item->image_m))
                                <img src="{{ str_replace('storage/storage', 'storage', Storage::url($item->image_m)) }}" 
                                     alt="{{ $item->product_title }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gray-300 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="flex-grow">
                            <h3 class="font-medium">{{ $item->product_title }}</h3>
                            @if (!empty($item->variation_attributes))
                                <p class="{{FD['text']}} text-gray-500 mb-1">{{ $item->variation_attributes }}</p>
                            @endif
                            <p class="{{FD['text']}} text-gray-500">SKU: {{ $item->sku ?? 'N/A' }}</p>
                        </div>
                        <div class="flex flex-col items-end">
                            <p class="font-medium">{{ $order->currency_symbol }}{{ formatIndianMoney($item->selling_price) }}</p>
                            <p class="{{FD['text']}} text-gray-500">Qty: {{ $item->quantity }}</p>
                            <p class="{{FD['text']}} font-medium mt-1">
                                Total: {{ $order->currency_symbol }}{{ formatIndianMoney($item->selling_price * $item->quantity) }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center">
                    <p class="{{FD['text']}} text-gray-500">No items found in this order</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Order Status -->
        <div class="mb-8">
            <h2 class="font-medium mb-4">Order Status</h2>
            <div class="bg-gray-50 p-4 {{ FD['rounded'] }} shadow-sm">
                <!-- Order Placed -->
                <div class="flex items-center gap-4 mb-4">
                    <div class="relative">
                        <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div class="absolute left-4 top-8 h-8 w-0.5 bg-green-500"></div>
                    </div>
                    <div>
                        <p class="font-medium">Order Placed</p>
                        <p class="{{FD['text']}} text-gray-500">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</p>
                    </div>
                </div>

                <!-- Payment Status -->
                <div class="flex items-center gap-4 mb-4">
                    <div class="relative">
                        <div class="w-8 h-8 rounded-full {{ $order->paid_at ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center">
                            @if($order->paid_at)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            @endif
                        </div>
                        <div class="absolute left-4 top-8 h-8 w-0.5 {{ $order->paid_at ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                    </div>
                    <div>
                        <p class="font-medium">Payment {{ $order->paid_at ? 'Completed' : 'Pending' }}</p>
                        <p class="{{FD['text']}} text-gray-500">
                            {{ $order->paid_at ? $order->paid_at->format('M d, Y \a\t h:i A') : 'Waiting for payment' }}
                        </p>
                    </div>
                </div>

                <!-- Processing -->
                <div class="flex items-center gap-4 mb-4">
                    <div class="relative">
                        <div class="w-8 h-8 rounded-full {{ $order->processed_at ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center">
                            @if($order->processed_at)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                            @endif
                        </div>
                        <div class="absolute left-4 top-8 h-8 w-0.5 {{ $order->processed_at ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                    </div>
                    <div>
                        <p class="font-medium">Processing</p>
                        <p class="{{FD['text']}} text-gray-500">
                            {{ $order->processed_at ? $order->processed_at->format('M d, Y \a\t h:i A') : 'In progress' }}
                        </p>
                    </div>
                </div>

                <!-- Shipped -->
                <div class="flex items-center gap-4 mb-4">
                    <div class="relative">
                        <div class="w-8 h-8 rounded-full {{ $order->shipped_at ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center">
                            @if($order->shipped_at)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            @endif
                        </div>
                        <div class="absolute left-4 top-8 h-8 w-0.5 {{ $order->shipped_at ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                    </div>
                    <div>
                        <p class="font-medium">Shipped</p>
                        <p class="{{FD['text']}} text-gray-500">
                            {{ $order->shipped_at ? $order->shipped_at->format('M d, Y \a\t h:i A') : 'Not shipped yet' }}
                        </p>
                    </div>
                </div>

                <!-- Delivered -->
                <div class="flex items-center gap-4">
                    <div class="relative">
                        <div class="w-8 h-8 rounded-full {{ $order->delivered_at ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center">
                            @if($order->delivered_at)
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            @endif
                        </div>
                    </div>
                    <div>
                        <p class="font-medium">Delivered</p>
                        <p class="{{FD['text']}} text-gray-500">
                            {{ $order->delivered_at ? $order->delivered_at->format('M d, Y \a\t h:i A') : 'Not delivered yet' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>