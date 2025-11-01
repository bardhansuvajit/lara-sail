@extends('layouts.front.account', [
    'showHeader' => true,
    'title' => __('Wishlist'),
    'subtitle' => __('Your favorite products, all in one place.'),
])

@section('content')
    @livewire('wishlist-data', ['userId' => $user->id])

    {{-- @livewire('wishlist-data', [
        'data' => $data
    ]) --}}
@endsection
