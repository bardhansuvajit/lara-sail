@extends('layouts.front.account', [
    'title' => __('Wishlist')
])

@section('content')
    @livewire('wishlist-data', ['userId' => $user->id])


    {{-- @livewire('wishlist-data', [
        'data' => $data
    ]) --}}
@endsection
