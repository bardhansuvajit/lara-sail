@php
    $type = request()->query('type');
    $addressTypeTitle = $type === 'shipping' ? __('Delivery') : ($type === 'billing' ? __('Billing') : __('Delivery'));
    $addressType = $type === 'shipping' ? __('delivery') : ($type === 'billing' ? __('billing') : __('delivery'));
@endphp

@extends('layouts.front.account', [
    'showHeader' => true,

    'title' => __('Create :type Address', [
        'type' => $addressTypeTitle
    ]),

    'subtitle' => __('Add a new :type address — save home, work, or any location for faster checkout.', [
        'type' => $addressType
    ]),

    'breadcrumb' => [
        [
            'title' => __('Address'),
            'url' => request()->query('redirect', route('front.address.index'))
        ],
        [
            'title' => __('Create Address')
        ]
    ]
])


@section('content')
    @include('front.account.address.includes.create', ['type' => $type])
@endsection
