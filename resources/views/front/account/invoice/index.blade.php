@extends('layouts.front.account', [
    'showHeader' => true,
    'title' => __('Order Invoice'),
    'subtitle' => __('View and download the invoice for your order.'),
    'breadcrumb' => [
        [
            'title' => 'Order',
            'url' => route('front.order.index')
        ],
        [
            'title' => 'Order Detail',
            'url' => route('front.order.detail', $order->order_number)
        ],
        [
            'title' => 'Order Invoice'
        ]
    ]
])

@section('content')
    <x-invoice
        :order="$order"
    />
@endsection