@extends('layouts.front.account', [
    'title' => __('Create Address')
])

@section('content')
    @include('front.account.address.includes.create', ['type' => 'shipping'])
@endsection
