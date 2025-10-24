@extends('layouts.front.account', [
    'title' => __('Orders')
])

@section('content')
<div class="space-y-4 md:space-y-6">
    {{-- @if($orders->count() > 0)
        <div class="flex justify-end items-center mb-4">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Your Orders</h1>
            <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">{{ $orders->count() }} order(s)</p>
        </div>
    @endif --}}

    @forelse ($orders as $order)
        <div class="{{ FD['rounded'] }} bg-white border border-gray-200 dark:bg-gray-800 dark:border-gray-700 overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200">
            <!-- Order Header -->
            <div class="p-2 md:p-4 bg-gray-50 dark:bg-gray-700">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-4">
                            <a href="{{ route('front.order.detail', $order->order_number) }}" class="{{ FD['text-1'] }} font-semibold text-gray-900 dark:text-white underline hover:no-underline">
                                Order #{{ $order->order_number }}
                            </a>
                            <span class="px-3 py-1 text-xs font-medium rounded-full 
                                @if($order->status === 'delivered') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                @elseif($order->status === 'shipped') bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200
                                @elseif($order->status === 'processing') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                @else bg-gray-100 text-gray-800 dark:bg-gray-600 dark:text-gray-200 @endif">
                                {{ ucwords(str_replace('_', ' ', $order->status)) }}
                            </span>
                        </div>
                        <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400 mt-1">
                            Ordered on {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                        </p>
                    </div>
                    
                    <div class="flex items-center gap-3">
                        <a href="{{ route('front.order.invoice', $order->order_number) }}" 
                           class="inline-flex items-center px-3 py-2 {{ FD['text'] }} font-medium text-white bg-primary-600 {{ FD['rounded'] }} hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 transition-colors duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Invoice
                        </a>

                        @php
                            $supportMessage = "Hello, I need support for order number $order->order_number!";
                            $encodedMessage = rawurlencode($supportMessage);
                        @endphp

                        <a href="https://wa.me/{{ applicationSettings('support_contact') }}?text={{ $encodedMessage }}" 
                           class="inline-flex items-center px-3 py-2 {{ FD['text'] }} font-medium text-gray-700 bg-gray-100 {{ FD['rounded'] }} hover:bg-gray-200 dark:text-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors duration-200"
                           target="_blank">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893c0-3.189-1.248-6.189-3.515-8.444"/>
                            </svg>
                            Support
                        </a>

                        <a href="{{ route('front.order.detail', $order->order_number) }}" 
                           class="inline-flex items-center px-3 py-2 {{ FD['text'] }} font-medium text-gray-700 bg-gray-100 {{ FD['rounded'] }} hover:bg-gray-200 dark:text-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors duration-200">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m560-240-56-58 142-142H160v-80h486L504-662l56-58 240 240-240 240Z"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="p-2 md:p-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                    @foreach ($order->items as $item)
                        <div class="flex gap-4 p-3 bg-gray-50 dark:bg-gray-700 {{ FD['rounded'] }}">
                            <div class="flex-shrink-0 w-16 h-16 bg-white dark:bg-gray-600 rounded border border-gray-200 dark:border-gray-500 overflow-hidden">
                                <a href="{{ $item->product_url_with_variation ?? $item->product_url }}" target="_blank" class="block w-full h-full">
                                    @if (!empty($item->image_m))
                                        <img class="w-full h-full object-cover" 
                                             src="{{ str_replace('storage/storage', 'storage', Storage::url($item->image_m)) }}" 
                                             alt="{{ $item->product_title }}" 
                                             onerror="this.onerror=null; this.parentNode.innerHTML=`{!! addslashes(FD['brokenImageFront']) !!}`" />
                                    @else
                                        {!! FD['brokenImageFront'] !!}
                                    @endif
                                </a>
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <a href="{{ $item->product_url_with_variation ?? $item->product_url }}" 
                                   target="_blank" 
                                   class="block {{ FD['text'] }} font-medium text-gray-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400 truncate mb-1">
                                    {{ $item->product_title }}
                                </a>
                                
                                @if (!empty($item->variation_attributes))
                                    <p class="text-xs text-gray-600 dark:text-gray-400 mb-2">
                                        {{ $item->variation_attributes }}
                                    </p>
                                @endif
                                
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <span class="{{ FD['text'] }} font-semibold text-gray-900 dark:text-white">
                                            {{ $order->currency_symbol }}{{ formatIndianMoney($item->selling_price) }}
                                        </span>
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            × {{ $item->quantity }}
                                        </span>
                                    </div>
                                    <span class="{{ FD['text'] }} font-medium text-gray-900 dark:text-white">
                                        {{ $order->currency_symbol }}{{ formatIndianMoney($item->selling_price * $item->quantity) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">
                        @if($order->shipping_method_name)
                            <p class="mb-1">Shipping: {{ $order->shipping_method_name }}</p>
                        @endif
                        @if($order->payment_method_title)
                            <p>Payment: {{ ucwords($order->payment_method_title) }}</p>
                        @endif
                    </div>
                    
                    <div class="text-right">
                        <div class="flex items-center justify-end gap-4 mb-2">
                            @if($order->coupon_discount_amount > 0)
                                <div class="{{ FD['text'] }}">
                                    <span class="text-gray-600 dark:text-gray-400">Discount:</span>
                                    <span class="font-medium text-green-600 dark:text-green-400 ml-1">
                                        -{{ $order->currency_symbol }}{{ formatIndianMoney($order->coupon_discount_amount) }}
                                    </span>
                                </div>
                            @endif
                            
                            @if($order->shipping_cost > 0)
                                <div class="{{ FD['text'] }}">
                                    <span class="text-gray-600 dark:text-gray-400">Shipping:</span>
                                    <span class="font-medium text-gray-900 dark:text-white ml-1">
                                        {{ $order->currency_symbol }}{{ formatIndianMoney($order->shipping_cost) }}
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <div class="{{ FD['text-1'] }} font-bold text-gray-900 dark:text-white">
                            Total: {{ $order->currency_symbol }}{{ formatIndianMoney($order->total) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @endif
    @empty
        <div class="{{ FD['rounded'] }} bg-white p-8 shadow-sm dark:bg-gray-800 text-center">
            <div class="max-w-md mx-auto">
                <img src="{{ Storage::url('public/default/cart/undraw_web-shopping_m3o2.svg') }}" 
                     alt="No orders" 
                     class="w-48 h-48 mx-auto mb-4">
                
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">
                    No orders yet!
                </h3>
                
                <p class="text-gray-600 dark:text-gray-400 mb-4">
                    You haven't placed any orders. Start shopping to see your orders here.
                </p>
                
                <a href="{{ route('front.home.index') }}" 
                   class="inline-flex items-center px-6 py-3 bg-primary-600 text-white font-medium {{ FD['rounded'] }} hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Start Shopping
                </a>
            </div>
        </div>
    @endforelse
</div>
@endsection