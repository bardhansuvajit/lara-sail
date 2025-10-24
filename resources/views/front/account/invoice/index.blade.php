@extends('layouts.front.account', [
    'title' => __('Invoice')
])

@section('content')
    <x-invoice
        :order="$order"
    />
@endsection