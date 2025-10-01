<div>
    <div class="grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-4" id="wishlist-products">
        @forelse ($data as $wishlistData)
            @php
                $product = $wishlistData->product;
            @endphp

            <x-front.product-card 
                :product="$product" 
                showAddToCart="true" />
        @empty
            <div class="col-span-4 {{ FD['rounded'] }} bg-white p-2 shadow-sm dark:bg-gray-800 md:p-4">
                <div class="w-full text-center">
                    <img src="{{ Storage::url('public/default/cart/undraw_web-shopping_m3o2.svg') }}" alt="empty-cart" class="w-72 m-auto mb-6">

                    <h5 class="block text-base leading-tight font-bold text-gray-900 dark:text-gray-300 mb-4">
                        No items here!
                    </h5>
                </div>
            </div>
        @endforelse
    </div>
</div>