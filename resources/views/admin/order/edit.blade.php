<x-admin-app-layout
    screen="md:max-w-screen-2xl"
    title="{{ __('Order #:order', ['order' => $order->order_number]) }}"
    :breadcrumb="[
        ['label' => 'Orders', 'url' => route('admin.order.index')],
        ['label' => '#' . $order->order_number]
    ]"
>

    <div class="w-full mt-4 space-y-4">
        <!-- Order Header with Status -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 p-2 bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div>
                <h1 class="text-sm font-bold text-gray-900 dark:text-white">Order #{{ $order->order_number }}</h1>
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                    Placed on {{ $order->created_at->format('M j, Y \a\t g:i A') }}
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <span class="px-3 py-1 rounded-full text-xs font-medium 
                    @if($order->status === 'completed') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                    @elseif($order->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                    @elseif($order->status === 'processing') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                    @elseif($order->status === 'shipped') bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200
                    @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 @endif">
                    {{ ucfirst($order->status) }}
                </span>
                <span class="px-3 py-1 rounded-full text-xs font-medium 
                    @if($order->payment_status === 'paid') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                    @elseif($order->payment_status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                    @elseif($order->payment_status === 'failed') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                    @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 @endif">
                    Payment: {{ ucfirst($order->payment_status) }}
                </span>
            </div>
        </div>

        <!-- Main Grid Layout -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-4">
            <!-- Left Column - Order Items & Summary -->
            <div class="xl:col-span-2 space-y-4">
                <!-- Order Items -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-2 border-b border-gray-200 dark:border-gray-600">
                        <h2 class="text-sm font-semibold text-primary-500 dark:text-primary-300">Order Items ({{ $order->total_items }})</h2>
                    </div>
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($order->items as $item)
                        <div class="p-2">
                            <div class="flex gap-4">
                                <!-- Product Image -->
                                <a href="{{ route('admin.product.listing.edit', $item->id) }}" target="_blank" class="flex-shrink-0">
                                    <div class="w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center overflow-hidden">
                                        @if (!empty($item->image_m))
                                            <img class="w-full h-full object-cover" 
                                                 src="{{ str_replace('storage/storage', 'storage', Storage::url($item->image_m)) }}" 
                                                 alt="{{ $item->product_title }}" />
                                        @else
                                            <div class="text-gray-400">
                                                {!! FD['brokenImageFront'] !!}
                                            </div>
                                        @endif
                                    </div>
                                </a>

                                <!-- Product Details -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex justify-between">
                                        <div class="flex-1">
                                            <a href="{{ route('admin.product.listing.edit', $item->id) }}" target="_blank" 
                                               class="text-xs font-medium text-gray-900 dark:text-white underline hover:no-underline hover:text-primary-600 dark:hover:text-primary-400 line-clamp-2">
                                                {{ $item->product_title }}
                                            </a>
                                            @if (!empty($item->variation_attributes))
                                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">{{ $item->variation_attributes }}</p>
                                            @endif
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">SKU: {{ $item->sku ?? 'N/A' }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs font-semibold text-gray-900 dark:text-white">
                                                {{ $order->currency_symbol }}{{ formatIndianMoney($item->selling_price) }}
                                            </p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">Qty: {{ $item->quantity }}</p>
                                            <p class="text-xs font-medium text-gray-900 dark:text-white mt-1">
                                                {{ $order->currency_symbol }}{{ formatIndianMoney($item->selling_price * $item->quantity) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Order Timeline -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-2 border-b border-gray-200 dark:border-gray-600">
                        <h2 class="text-sm font-semibold text-primary-500 dark:text-primary-300">Order Timeline</h2>
                    </div>
                    <div class="p-2">
                        <div class="space-y-4">
                            <div class="flex items-center text-green-600 dark:text-green-400">
                                <div class="w-5 h-5 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium">Order Placed</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">{{ $order->created_at->format('M j, Y g:i A') }}</p>
                                </div>
                            </div>

                            @if($order->paid_at)
                            <div class="flex items-center text-green-600 dark:text-green-400">
                                <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium">Payment Received</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->paid_at->format('M j, Y g:i A') }}</p>
                                </div>
                            </div>
                            @endif

                            @if($order->processed_at)
                            <div class="flex items-center text-blue-600 dark:text-blue-400">
                                <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium">Order Processed</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->processed_at->format('M j, Y g:i A') }}</p>
                                </div>
                            </div>
                            @endif

                            @if($order->shipped_at)
                                <div class="flex items-center text-purple-600 dark:text-purple-400">
                                    <div class="w-8 h-8 rounded-full bg-purple-100 dark:bg-purple-900 flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"/>
                                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1v-1h4a1 1 0 001-1v-1h2a1 1 0 001-1V5a1 1 0 00-1-1H3z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-medium">Order Shipped</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->shipped_at->format('M j, Y g:i A') }}</p>
                                    </div>
                                </div>
                            @endif

                            @if($order->delivered_at)
                            <div class="flex items-center text-green-600 dark:text-green-400">
                                <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium">Order Delivered</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->delivered_at->format('M j, Y g:i A') }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Order Details -->
            <div class="space-y-4">
                <!-- Order Summary -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-2 border-b border-gray-200 dark:border-gray-600">
                        <h2 class="text-sm font-semibold text-primary-500 dark:text-primary-300">Order Summary</h2>
                    </div>

                    <div class="p-2">
                        <div class="space-y-1">
                            <div class="flex justify-between">
                                <span class="text-xs text-gray-600 dark:text-gray-400">Subtotal ({{ $order->total_items }} items)</span>
                                <span class="text-xs font-medium text-gray-900 dark:text-white">
                                    {{ $order->currency_symbol }}{{ formatIndianMoney($order->sub_total) }}
                                </span>
                            </div>
                            
                            @if(($order->mrp - $order->sub_total) > 0)
                                <div class="flex justify-between">
                                    <span class="text-xs text-gray-600 dark:text-gray-400">Savings</span>
                                    <span class="text-xs font-medium text-green-600 dark:text-green-400">
                                        -{{ $order->currency_symbol }}{{ formatIndianMoney($order->mrp - $order->sub_total) }}
                                    </span>
                                </div>
                            @endif

                            @if($order->shipping_cost > 0)
                                <div class="flex justify-between">
                                    <span class="text-xs text-gray-600 dark:text-gray-400">Shipping</span>
                                    <span class="text-xs font-medium text-gray-900 dark:text-white">
                                        {{ $order->currency_symbol }}{{ formatIndianMoney($order->shipping_cost) }}
                                    </span>
                                </div>
                            @endif

                            @if($order->tax_amount > 0)
                                <div class="flex justify-between">
                                    <span class="text-xs text-gray-600 dark:text-gray-400">Tax</span>
                                    <span class="text-xs font-medium text-gray-900 dark:text-white">
                                        {{ $order->currency_symbol }}{{ formatIndianMoney($order->tax_amount) }}
                                    </span>
                                </div>
                            @endif

                            @if($order->coupon_discount_amount > 0)
                                <div class="flex justify-between">
                                    <span class="text-xs text-gray-600 dark:text-gray-400">
                                        Coupon Discount
                                        <span class="text-gray-900 dark:text-gray-200 font-bold">({{ $order->coupon_code }})</span>
                                    </span>
                                    <span class="text-xs font-medium text-green-600 dark:text-green-400">
                                        -{{ $order->currency_symbol }}{{ formatIndianMoney($order->coupon_discount_amount) }}
                                    </span>
                                </div>
                            @endif

                            @if($order->payment_method_charge > 0)
                                <div class="flex justify-between">
                                    <span class="text-xs text-gray-600 dark:text-gray-400">Payment Charge</span>
                                    <span class="text-xs font-medium text-gray-900 dark:text-white">
                                        {{ $order->currency_symbol }}{{ formatIndianMoney($order->payment_method_charge) }}
                                    </span>
                                </div>
                            @elseif($order->payment_method_discount > 0)
                                <div class="flex justify-between">
                                    <span class="text-xs text-gray-600 dark:text-gray-400">Payment Discount</span>
                                    <span class="text-xs font-medium text-green-600 dark:text-green-400">
                                        -{{ $order->currency_symbol }}{{ formatIndianMoney($order->payment_method_discount) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                        <div class="space-y-3">
                            <hr class="mt-2 border-1 dark:border-gray-600">

                            <div>
                                <div class="flex justify-between">
                                    <span class="text-sm font-semibold text-gray-900 dark:text-white">Total</span>
                                    <span class="text-sm font-bold text-gray-900 dark:text-white">
                                        {{ $order->currency_symbol }}{{ formatIndianMoney($order->total) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Coupon Information -->
                @if (!empty($order->coupon_code_id) && !empty($order->coupon_code))
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-2 border-b border-gray-200 dark:border-gray-600 flex justify-between items-center">
                        <h2 class="text-sm font-semibold text-primary-500 dark:text-primary-300">Coupon Details</h2>
                    </div>
                    <div class="p-2">
                        <div class="space-y-2">
                            <p class="text-xs font-medium text-gray-900 dark:text-white">
                                {{ $order->coupon_code }}
                            </p>
                            @if($order->coupon_discount_amount > 0)
                                <div class="flex gap-4">
                                    <span class="text-xs text-gray-600 dark:text-gray-400">
                                        Coupon Discount
                                    </span>
                                    <span class="text-xs font-medium text-green-600 dark:text-green-400">
                                        -{{ $order->currency_symbol }}{{ formatIndianMoney($order->coupon_discount_amount) }}
                                    </span>
                                </div>
                            @endif

                            @php
                                $couponMeta = json_decode($order->coupon_meta, true);
                            @endphp

                            @if ($couponMeta)
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    Coupon Code: {{ $couponMeta['code'] ?? '-' }}
                                </p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    Name: {{ $couponMeta['name'] ?? '-' }}

                                </p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    Discount Type: {{ ucfirst($couponMeta['discount_type'] ?? '-') }}
                                </p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    Value: ₹{{ number_format($couponMeta['value'] ?? 0, 2) }}
                                </p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    Minimum Cart Value: ₹{{ number_format($couponMeta['min_cart_value'] ?? 0, 2) }}
                                </p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    Max Discount Amount: ₹{{ number_format($couponMeta['max_discount_amount'] ?? 0, 2) }}
                                </p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    Description: {{ $couponMeta['description'] ?? '-' }}
                                </p>
                            @endif

                        </div>
                    </div>
                </div>
                @endif

                <!-- Customer Information -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-2 border-b border-gray-200 dark:border-gray-600 flex justify-between items-center">
                        <h2 class="text-sm font-semibold text-primary-500 dark:text-primary-300">Customer</h2>
                        <a 
                            href="{{ route('admin.user.edit', ['id' => $order->user_id, 'redirect' => request()->url(), 'type' => 'order-detail']) }}"
                            class="p-1 bg-gray-200 dark:bg-gray-800 hover:bg-gray-300 dark:hover:bg-gray-700"
                            >
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h560v-280h80v280q0 33-23.5 56.5T760-120H200Zm188-212-56-56 372-372H560v-80h280v280h-80v-144L388-332Z"/></svg>
                        </a>
                    </div>
                    <div class="p-2">
                        <div class="space-y-2">
                            <p class="text-xs font-medium text-gray-900 dark:text-white">
                                {{ $order->user->first_name }} {{ $order->user->last_name }}
                            </p>
                            <div class="flex items-center gap-2">
                                <svg class="w-3 h-3 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/></svg>
                                <a href="mailto:{{ $order->email }}" class="text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 hover:underline">
                                    {{ $order->email }}
                                </a>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg class="w-3 h-3 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <a href="tel:{{ $order->phone_no }}" class="text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 hover:underline">
                                    {{ $order->phone_no }}
                                </a>
                            </div>
                            <div class="flex items-center gap-2 mt-2">
                                @if ($order->country->flag)
                                    <div class="inline-flex justify-center h-4 mr-1">
                                        {!! $order->country->flag !!}
                                    </div>
                                @else
                                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                @endif
                                <p class="text-xs text-gray-600 dark:text-gray-400">{{ $order->country->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping & Billing -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-2 border-b border-gray-200 dark:border-gray-600">
                        <h2 class="text-sm font-semibold text-primary-500 dark:text-primary-300">Shipping & Billing</h2>
                    </div>
                    <div class="p-2 space-y-4">
                        <div>
                            <h3 class="text-xs font-bold text-gray-900 dark:text-white mb-2">Shipping Address</h3>
                            @php $shippingAddress = json_decode($order->shipping_address); @endphp
                            <div class="text-xs text-gray-600 dark:text-gray-400">
                                <p>{{ $shippingAddress->first_name }} {{ $shippingAddress->last_name }}</p>
                                <p>{{ $shippingAddress->phone_no }}</p>
                                <p>{{ $shippingAddress->address_line_1 }}</p>
                                @if($shippingAddress->address_line_2)
                                <p>{{ $shippingAddress->address_line_2 }}</p>
                                @endif
                                @if($shippingAddress->landmark)
                                <p>Landmark: {{ $shippingAddress->landmark }}</p>
                                @endif
                                <p>{{ $shippingAddress->city }}, {{ strtoupper($shippingAddress->state) }} - {{ $shippingAddress->postal_code }}</p>
                                @if($order->country->code != $shippingAddress->country_code)
                                <p>{{ $shippingAddress->country_code }}</p>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h3 class="text-xs font-bold text-gray-900 dark:text-white mb-2">
                                {{ empty($order->billing_address) ? 'Billing Address' : 'Billing Address (Different)' }}
                            </h3>
                            @if(empty($order->billing_address))
                            <p class="text-xs text-gray-600 dark:text-gray-400">Same as shipping address</p>
                            @else
                            @php $billingAddress = json_decode($order->billing_address); @endphp
                            <div class="text-xs text-gray-600 dark:text-gray-400">
                                <p>{{ $billingAddress->first_name }} {{ $billingAddress->last_name }}</p>
                                <p>{{ $billingAddress->phone_no }}</p>
                                <p>{{ $billingAddress->address_line_1 }}</p>
                                @if($billingAddress->address_line_2)
                                <p>{{ $billingAddress->address_line_2 }}</p>
                                @endif
                                @if($billingAddress->landmark)
                                <p>Landmark: {{ $billingAddress->landmark }}</p>
                                @endif
                                <p>{{ $billingAddress->city }}, {{ strtoupper($billingAddress->state) }} - {{ $billingAddress->postal_code }}</p>
                                @if($order->country->code != $billingAddress->country_code)
                                <p>{{ $billingAddress->country_code }}</p>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Payment & Shipping Methods -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-2 border-b border-gray-200 dark:border-gray-600">
                        <h2 class="text-sm font-semibold text-primary-500 dark:text-primary-300">Payment & Shipping</h2>
                    </div>
                    <div class="p-2 space-y-4">
                        <div>
                            <h3 class="text-xs font-bold text-gray-900 dark:text-white mb-2">Payment Method</h3>
                            <div class="flex items-center">
                                <div>
                                    <p class="text-xs font-bold text-gray-900 dark:text-white">{{ $order->paymentMethod->title ?? 'N/A' }}</p>
                                    <p class="mt-1 px-2 py-1 text-xs text-gray-600 dark:text-gray-400 {{ $order->paymentStatus->class }}">
                                        {{ $order->paymentStatus->title }} - {{ $order->paymentStatus->description }}
                                    </p>
                                </div>
                            </div>
                            @if($order->transaction_id)
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-2">
                                    Transaction ID: <span class="font-mono">{{ $order->transaction_id }}</span>
                                </p>
                            @endif
                        </div>

                        <div>
                            <h3 class="text-xs font-bold text-gray-900 dark:text-white mb-2">Shipping Method</h3>
                            <p class="text-xs font-bold text-gray-600 dark:text-gray-400">
                                {{ strtoupper($order->shipping_method_name) ?? 'Standard Shipping' }}
                            </p>

                            @if($order->shippingMethod)
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                    Est. delivery: {{ $order->created_at->addDays($order->shippingMethod->max_delivery_day)->format('M j, Y') }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-2 border-b border-gray-200 dark:border-gray-600">
                        <h2 class="text-sm font-semibold text-primary-500 dark:text-primary-300">Actions</h2>
                    </div>
                    <div class="p-2 space-y-2">
                        <a href="{{ route('front.order.invoice', $order->order_number) }}" 
                           target="_blank"
                           class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Download Invoice
                        </a>
                        
                        <button class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                            Track Order
                        </button>
                        
                        <button class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-indigo-600 dark:text-indigo-400 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Refund Order
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notes Section -->
        @if($order->notes || $order->status_notes)
        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-2 border-b border-gray-200 dark:border-gray-600">
                <h2 class="text-sm font-semibold text-gray-900 dark:text-white">Order Notes</h2>
            </div>
            <div class="p-2">
                @if($order->notes)
                <div class="mb-4">
                    <h3 class="font-medium text-gray-900 dark:text-white mb-2">Customer Notes</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">{{ $order->notes }}</p>
                </div>
                @endif
                @if($order->status_notes)
                <div>
                    <h3 class="font-medium text-gray-900 dark:text-white mb-2">Status Notes</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">{{ $order->status_notes }}</p>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</x-admin-app-layout>