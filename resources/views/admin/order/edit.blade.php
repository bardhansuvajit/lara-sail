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

            @php
                $paymentClasses = [
                    'paid'    => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                    'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                    'failed'  => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                ];

                $defaultClass = 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200';

                $paymentStatusClass = $paymentClasses[$order->payment_status] ?? $defaultClass;

                // Order Status
                $orderStat = $order->orderStatus;
            @endphp

            <div class="flex flex-wrap gap-3">
                <div class="px-3 py-1 rounded-full text-xs font-medium {{ $orderStat->class }} flex items-center space-x-1">
                    <p>Order status:</p>
                    <div class="w-3 h-3">{!! $orderStat?->icon !!}</div>
                    <p>{{ ucfirst($orderStat->title) }}</p>
                </div>

                <div class="px-3 py-1 rounded-full text-xs font-medium {{ $paymentStatusClass }}">
                    Payment status: {{ ucfirst($order->payment_status) }}
                </div>
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
                                                class="text-xs font-medium text-gray-900 dark:text-white underline hover:no-underline hover:text-primary-600 dark:hover:text-primary-400 line-clamp-2 inline-block">
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

                <!-- Order Status -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-2 border-b border-gray-200 dark:border-gray-600">
                        <h2 class="text-sm font-semibold text-primary-500 dark:text-primary-300">Order Status</h2>
                    </div>
                    <div class="p-2">
                        <div class="grid grid-cols-8 gap-2">
                            @php
                                $groupedStatuses = $orderStatuses->groupBy('category');
                            @endphp

                            @foreach ($groupedStatuses as $category => $statuses)
                                <div class="grid-col-2">
                                    <div class="text-[10px] w-full font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        {{ ucfirst($category) }}
                                    </div>

                                    <div class="">
                                        @foreach ($statuses as $os)
                                            <button
                                                class="{{ $os->class }} mb-1 w-full text-[11px] flex items-center justify-start gap-2 rounded border-2 px-2 py-1 transition-all duration-150
                                                    {{ ($order->status == $os->slug) ? 'border-gray-900  font-bold shadow-sm' : 'border-transparent hover:border-gray-400/40 font-light' }}"
                                                x-data=""
                                                x-on:click.prevent="
                                                    $dispatch('open-modal', 'confirm-status-update');
                                                    $dispatch('data-cstat', '{{ $order->status }}');
                                                    $dispatch('data-slug', '{{ $os->slug }}');
                                                    $dispatch('data-title', '{{ $os->title }}');
                                                    $dispatch('data-class', '{{ $os->class }}');
                                                    $dispatch('data-description', '{{ $os->description }}');
                                                    $dispatch('data-icon', '{{ $os->icon }}');
                                                "
                                                >
                                                <div class="flex-shrink-0 w-4 h-4 flex items-center justify-center">
                                                    {!! $os->icon !!}
                                                </div>

                                                <p class="flex-1 text-left leading-tight" title="{{ $os->title }}">
                                                    #{{ $os->position }} {{ $os->title }}
                                                </p>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Payment Status -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-2 border-b border-gray-200 dark:border-gray-600">
                        <h2 class="text-sm font-semibold text-primary-500 dark:text-primary-300">Payment Status</h2>
                    </div>
                    <div class="p-2">
                        <div class="grid grid-cols-8 gap-2">
                            @php
                                $groupedStatuses = $paymentMethodStatuses->groupBy('category');
                            @endphp

                            @foreach ($groupedStatuses as $category => $statuses)
                                <div class="grid-col-2">
                                    <div class="text-[10px] w-full font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        {{ ucfirst($category) }}
                                    </div>

                                    <div class="">
                                        @foreach ($statuses as $os)
                                            <button
                                                class="{{ $os->class }} mb-1 w-full text-[11px] flex items-center justify-start gap-2 rounded border-2 px-2 py-1 transition-all duration-150
                                                    {{ ($order->payment_status == $os->slug) ? 'border-gray-900 dark:border-gray-50 font-semibold shadow-sm' : 'border-transparent hover:border-gray-400/40' }}"
                                                x-data=""
                                                x-on:click.prevent="
                                                    $dispatch('open-modal', 'confirm-status-update');
                                                    $dispatch('data-cstat', '{{ $order->status }}');
                                                    $dispatch('data-slug', '{{ $os->slug }}');
                                                    $dispatch('data-title', '{{ $os->title }}');
                                                    $dispatch('data-class', '{{ $os->class }}');
                                                    $dispatch('data-description', '{{ $os->description }}');
                                                    $dispatch('data-icon', '{{ $os->icon }}');
                                                "
                                                >
                                                <div class="flex-shrink-0 w-4 h-4 flex items-center justify-center">
                                                    {!! $os->icon !!}
                                                </div>

                                                <p class="flex-1 text-left leading-tight" title="{{ $os->title }}">
                                                    #{{ $os->position }} {{ $os->title }}
                                                </p>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Timeline -->
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                    <div class="p-2 border-b border-gray-200 dark:border-gray-600">
                        <div class="flex justify-between">
                            <h2 class="text-sm font-semibold text-primary-500 dark:text-primary-300">Order Timeline</h2>

                            <button 
                                type="button"
                                class="text-xs inline-block text-gray-600 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-500" 
                                id="positionToggleButton" 
                                >
                                <div class="flex items-center">
                                    <div class="w-3 h-3 mr-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M320-440v-287L217-624l-57-56 200-200 200 200-57 56-103-103v287h-80ZM600-80 400-280l57-56 103 103v-287h80v287l103-103 57 56L600-80Z"/></svg>
                                    </div>
                                    Change position
                                </div>
                            </button>
                        </div>
                    </div>

                    @livewire('order-status-history-timeline', [
                        'order' => $order
                    ])

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
                                @if (!empty($order->email))
                                    <a href="mailto:{{ $order->email }}" class="text-xs text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 hover:underline">
                                        {{ $order->email }}
                                    </a>
                                @else
                                    <p class="text-xs text-red-700 dark:text-red-500">
                                        NA
                                    </p>
                                @endif
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

    {{-- Modal --}}
    <x-admin.modal name="confirm-status-update" maxWidth="md" focusable>
        <div 
            class="p-6" 
            x-data="{ 
                cstat: '', 
                slug: '', 
                title: '', 
                icon: '', 
                statusClass: '', 
                description: '', 
            }" 
            x-on:data-cstat.window="cstat = $event.detail"
            x-on:data-slug.window="slug = $event.detail"
            x-on:data-title.window="title = $event.detail"
            x-on:data-icon.window="icon = $event.detail"
            x-on:data-class.window="statusClass = $event.detail"
            x-on:data-description.window="description = $event.detail"
            >
            <!-- Header Section -->
            <div class="flex items-center gap-3 mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        {{ __('Update Order Status') }}
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        {{ __('Confirm status change for order #') }}{{ $order->order_number }}
                    </p>
                </div>
            </div>

            <!-- Status Preview Card -->
            <div x-bind:class="statusClass" class="rounded-lg p-4 mb-4 border border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 flex items-center justify-center" x-html="icon"></div>
                        <div>
                            <h4 class="text-sm font-medium" x-text="title"></h4>
                            <p class="text-xs" x-text="description"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Current Status Indicator -->
            <div class="flex items-center justify-between py-3 px-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg border border-orange-200 dark:border-orange-800 mb-4">
                <div class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                    <span class="text-sm font-medium text-orange-800 dark:text-orange-200">
                        Current Status: 
                        <span class="capitalize" x-text="cstat"></span>
                    </span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center justify-end border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-3">
                    <x-admin.button
                        element="button"
                        tag="secondary"
                        class="px-4 py-2 border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                        x-on:click="$dispatch('close')"
                    >
                        {{ __('Cancel') }}
                    </x-admin.button>

                    <form action="{{ route('admin.order.update.status') }}" method="POST" class="m-0">@csrf
                        <input type="hidden" name="status" x-bind:value="slug" value="">
                        <input type="hidden" name="previous_status" x-bind:value="cstat" value="">
                        <input type="hidden" name="title" x-bind:value="title" value="">
                        <input type="hidden" name="notes" x-bind:value="description" value="">
                        <input type="hidden" name="icon" x-bind:value="icon" value="">
                        <input type="hidden" name="class" x-bind:value="statusClass" value="">
                        <input type="hidden" name="id" value="{{ $order->id }}">

                        <x-admin.button
                            element="button"
                            tag="primary"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 focus:ring-blue-500 text-white transition-colors"
                        >
                            <div class="flex items-center gap-2">
                                {{ __('Yes, Change Status') }}
                            </div>
                        </x-admin.button>
                    </form>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-4 p-3 bg-gray-50 dark:bg-gray-800/30 rounded-lg">
                <div class="flex items-start gap-2">
                    <svg class="w-4 h-4 text-gray-400 dark:text-gray-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-xs text-gray-500 dark:text-gray-400">
                        This action will update the order status and may trigger automated notifications to the customer.
                    </p>
                </div>
            </div>
        </div>
    </x-admin.modal>

</x-admin-app-layout>