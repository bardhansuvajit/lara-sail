<!-- Quick Cart -->
@if (!request()->is('cart') && !request()->is('checkout'))
    @include('layouts.front.includes.cart-item-delete-confirm-modal')
@endif
