<x-admin-app-layout
    screen="md:max-w-screen-2xl"
    title="{{ __('Order #:order', ['order' => $order->order_number]) }}"
    :breadcrumb="[
        ['label' => 'Orders', 'url' => route('admin.order.index')],
        ['label' => '#' . $order->order_number]
    ]"
>

    <div class="w-full mt-4 space-y-6">
        <!-- Order Header with Status -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 p-4 bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white">Order #{{ $order->order_number }}</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
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
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <!-- Left Column - Order Items & Summary -->
            <div class="xl:col-span-2 space-y-6">
                <!-- Order Items -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Order Items ({{ $order->total_items }})</h2>
                    </div>
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($order->items as $item)
                        <div class="p-4">
                            <div class="flex gap-4">
                                <!-- Product Image -->
                                <a href="{{ route('admin.product.listing.edit', $item->id) }}" target="_blank" class="flex-shrink-0">
                                    <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center overflow-hidden">
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
                                               class="text-sm font-medium text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 line-clamp-2">
                                                {{ $item->product_title }}
                                            </a>
                                            @if (!empty($item->variation_attributes))
                                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $item->variation_attributes }}</p>
                                            @endif
                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">SKU: {{ $item->sku ?? 'N/A' }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ $order->currency_symbol }}{{ formatIndianMoney($item->selling_price) }}
                                            </p>
                                            <p class="text-sm text-gray-500 dark:text-gray-400">Qty: {{ $item->quantity }}</p>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white mt-1">
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
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Order Timeline</h2>
                    </div>
                    <div class="p-4">
                        <div class="space-y-4">
                            <div class="flex items-center text-green-600 dark:text-green-400">
                                <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900 flex items-center justify-center mr-3">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium">Order Placed</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->created_at->format('M j, Y g:i A') }}</p>
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
            <div class="space-y-6">
                <!-- Order Summary -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Order Summary</h2>
                    </div>
                    <div class="p-4 space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Subtotal ({{ $order->total_items }} items)</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $order->currency_symbol }}{{ formatIndianMoney($order->sub_total) }}
                            </span>
                        </div>
                        
                        @if(($order->mrp - $order->sub_total) > 0)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Savings</span>
                            <span class="text-sm font-medium text-green-600 dark:text-green-400">
                                -{{ $order->currency_symbol }}{{ formatIndianMoney($order->mrp - $order->sub_total) }}
                            </span>
                        </div>
                        @endif

                        @if($order->shipping_cost > 0)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Shipping</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $order->currency_symbol }}{{ formatIndianMoney($order->shipping_cost) }}
                            </span>
                        </div>
                        @endif

                        @if($order->tax_amount > 0)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Tax</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $order->currency_symbol }}{{ formatIndianMoney($order->tax_amount) }}
                            </span>
                        </div>
                        @endif

                        @if($order->coupon_discount_amount > 0)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Coupon Discount</span>
                            <span class="text-sm font-medium text-green-600 dark:text-green-400">
                                -{{ $order->currency_symbol }}{{ formatIndianMoney($order->coupon_discount_amount) }}
                            </span>
                        </div>
                        @endif

                        @if($order->payment_method_charge > 0)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Payment Charge</span>
                            <span class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $order->currency_symbol }}{{ formatIndianMoney($order->payment_method_charge) }}
                            </span>
                        </div>
                        @elseif($order->payment_method_discount > 0)
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600 dark:text-gray-400">Payment Discount</span>
                            <span class="text-sm font-medium text-green-600 dark:text-green-400">
                                -{{ $order->currency_symbol }}{{ formatIndianMoney($order->payment_method_discount) }}
                            </span>
                        </div>
                        @endif

                        <div class="border-t border-gray-200 dark:border-gray-600 pt-3">
                            <div class="flex justify-between">
                                <span class="text-base font-semibold text-gray-900 dark:text-white">Total</span>
                                <span class="text-base font-bold text-gray-900 dark:text-white">
                                    {{ $order->currency_symbol }}{{ formatIndianMoney($order->total) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Customer</h2>
                        <x-admin.button-icon
                            element="a"
                            tag="secondary"
                            :href="route('admin.user.edit', ['id' => $order->user_id, 'redirect' => request()->url(), 'type' => 'order-detail'])">
                            @slot('icon')
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 -960 960 960">
                                    <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/>
                                </svg>
                            @endslot
                        </x-admin.button-icon>
                    </div>
                    <div class="p-4">
                        <div class="space-y-2">
                            <p class="font-medium text-gray-900 dark:text-white">
                                {{ $order->user->first_name }} {{ $order->user->last_name }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->email }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->phone_no }}</p>
                            <div class="flex items-center mt-2">
                                @if ($order->country->flag)
                                    <div class="inline-flex justify-center h-4 mr-2">
                                        {!! $order->country->flag !!}
                                    </div>
                                @endif
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->country->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shipping & Billing -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Shipping & Billing</h2>
                    </div>
                    <div class="p-4 space-y-4">
                        <div>
                            <h3 class="font-medium text-gray-900 dark:text-white mb-2">Shipping Address</h3>
                            @php $shippingAddress = json_decode($order->shipping_address); @endphp
                            <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
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
                            <h3 class="font-medium text-gray-900 dark:text-white mb-2">
                                {{ empty($order->billing_address) ? 'Billing Address' : 'Billing Address (Different)' }}
                            </h3>
                            @if(empty($order->billing_address))
                            <p class="text-sm text-gray-600 dark:text-gray-400">Same as shipping address</p>
                            @else
                            @php $billingAddress = json_decode($order->billing_address); @endphp
                            <div class="text-sm text-gray-600 dark:text-gray-400 space-y-1">
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
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Payment & Shipping</h2>
                    </div>
                    <div class="p-4 space-y-4">
                        <div>
                            <h3 class="font-medium text-gray-900 dark:text-white mb-2">Payment Method</h3>
                            <div class="flex items-center">
                                <div class="bg-gray-100 dark:bg-gray-700 p-2 rounded-lg mr-3">
                                    <svg class="w-5 h-5 text-gray-700 dark:text-gray-300" fill="currentColor" viewBox="0 -960 960 960">
                                        <path d="M713.82-61.54q-85.69 0-145.02-59.07-59.34-59.06-59.34-143.54 0-84.93 59.34-144.66 59.33-59.73 145.02-59.73 84.18 0 143.41 59.69 59.23 59.69 59.23 144.72 0 84.51-59.23 143.55Q798-61.54 713.82-61.54ZM145.39-225.39V-539.23-518.08v-216.53V-225.39Zm0-391.76h669.22v-105.16q0-4.61-3.84-8.46-3.85-3.84-8.46-3.84H157.69q-4.61 0-8.46 3.84-3.84 3.85-3.84 8.46v105.16ZM157.69-180q-23.53 0-40.61-17.08T100-237.69v-484.62q0-23.53 17.08-40.61T157.69-780h644.62q23.53 0 40.61 17.08T860-722.31v190.46q0 13.23-10.92 19.43-10.93 6.19-22.54-.04-26.51-12.99-56.22-19.88-29.71-6.89-61.63-6.89-31.84 0-62.46 6.92-30.61 6.92-58.15 19.92H145.39v274.7q0 4.61 3.84 8.46 3.85 3.84 8.46 3.84h269.77q9.67 0 16.18 6.57t6.51 16.31q0 9.74-6.51 16.12-6.51 6.39-16.18 6.39H157.69Zm566.77-87.31v-108.38q0-6.99-4.93-12.03-4.93-5.05-11.76-5.05-7.23 0-12.46 5.23t-5.23 12.46v109.39q0 5.6 2 10.6 2 5.01 5.61 9.63l79.39 80.61q5.33 5.23 12.51 5.43 7.18.19 12.41-5.43 5.61-5.23 5.61-12.21 0-6.99-5.61-12.71l-77.54-77.54Z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900 dark:text-white">{{ $order->paymentMethod->title ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $order->paymentMethod->after_order_title ?? 'Payment completed' }}
                                    </p>
                                </div>
                            </div>
                            @if($order->transaction_id)
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                Transaction ID: <span class="font-mono">{{ $order->transaction_id }}</span>
                            </p>
                            @endif
                        </div>

                        <div>
                            <h3 class="font-medium text-gray-900 dark:text-white mb-2">Shipping Method</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ $order->shipping_method_name ?? 'Standard Shipping' }}
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
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Actions</h2>
                    </div>
                    <div class="p-4 space-y-3">
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
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Order Notes</h2>
            </div>
            <div class="p-4">
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