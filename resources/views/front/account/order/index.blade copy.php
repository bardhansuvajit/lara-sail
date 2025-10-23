@extends('layouts.front.account', [
    'title' => __('Order')
])

@section('content')
    @forelse ($orders as $order)
        <div class="space-y-4 mb-3">
            <div class="flex items-center justify-between">
                <div>
                    <p class="block {{FD['text']}} leading-tight font-medium text-gray-900 dark:text-gray-300 mb-1 sm:mb-2">
                        Order number: #{{$order->order_number}}
                    </p>

                    <div class="flex space-x-2">
                        <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400">Ordered on {{$order->created_at}}</p>
                        <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400">{{ucwords($order->status)}}</p>
                    </div>
                </div>

                <div class="space-x-4">
                    <a href="{{ route('front.order.invoice', $order->order_number) }}" class="{{FD['text']}} font-medium text-primary-700 dark:text-primary-500">Invoice</a>

                    @php
                        $supportMessage = "Hello, I need support for order number $order->order_number!";
                        $encodedMessage = rawurlencode($supportMessage);
                    @endphp

                    <a href="https://wa.me/{{applicationSettings('support_contact')}}?text={{$encodedMessage}}" class="{{FD['text']}} font-medium text-gray-500 dark:text-gray-500" target="_blank">Support</a>
                </div>
            </div>

            <div>
                <div class="flex flex-wrap space-x-8">
                    @foreach ($order->items as $item)
                        <div class="flex flex-col space-y-2 items-center">
                            <div class="h-[60px] object-cover">
                                <a href="{{$item->product_url_with_variation ?? $item->product_url}}" target="_blank">
                                    @if (!empty($item->image_m))
                                        <img class="h-auto max-h-full w-full" src="{{ str_replace('storage/storage', 'storage', Storage::url($item->image_m)) }}" alt="{{$item->product_title}}" />
                                    @else
                                        {!! FD['brokenImageFront'] !!}
                                    @endif
                                </a>
                            </div>

                            <div class="flex-1 min-w-0">
                                <a href="{{$item->product_url_with_variation ?? $item->product_url}}" target="_blank" class="{{FD['text']}} font-medium text-gray-900 dark:text-white truncate underline hover:no-underline">
                                    {{ $item->product_title }}
                                </a>

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
        </div>

        @if (!$loop->last)
            <hr class="border-t border-gray-300 dark:border-gray-600 my-6">
        @endif
    @empty
        <div class="{{ FD['rounded'] }} bg-white p-2 shadow-sm dark:bg-gray-800 md:p-4">
            <div class="w-full text-center">
                <img src="{{ Storage::url('public/default/cart/undraw_web-shopping_m3o2.svg') }}" alt="empty-cart" class="w-72 m-auto mb-6">

                <h5 class="block text-base leading-tight font-bold text-gray-900 dark:text-gray-300 mb-4">
                    No orders yet!
                </h5>
            </div>
        </div>
    @endforelse
@endsection
