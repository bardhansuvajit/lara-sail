@extends('layouts.front.account', [
    'title' => __('Edit :type Address', [
        'type' => $address->address_type == 'shipping' ? 'Delivery' : 'Billing'
    ])
])

@section('content')
    {{-- <p class="inline-block text-primary-500 dark:text-primary-300">Edit {{ $address->address_type == "shipping" ? "Delivery" : "Billing"}} Address</p> --}}

    @include('front.account.address.includes.edit', ['type' => $address->address_type])
@endsection
