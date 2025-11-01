@php
    $addressTypeTitle = $address->address_type === 'shipping' ? __('Delivery') : __('Billing');
    $addressType = $address->address_type === 'shipping' ? __('delivery') : __('billing');
@endphp

@extends('layouts.front.account', [
    'showHeader' => true,

    'title' => __('Edit :type Address', [
        'type' => $addressTypeTitle
    ]),

    'subtitle' => __('Update your :type address — keep your location details accurate for smooth deliveries.', [
        'type' => $addressType
    ]),

    'breadcrumb' => [
        [
            'title' => __('Address'),
            'url' => request()->query('redirect', route('front.address.index'))
        ],
        [
            'title' => __('Edit Address')
        ]
    ]
])

@section('content')
    {{-- <p class="inline-block text-primary-500 dark:text-primary-300">Edit {{ $address->address_type == "shipping" ? "Delivery" : "Billing"}} Address</p> --}}

    @include('front.account.address.includes.edit', ['type' => $address->address_type])
@endsection
