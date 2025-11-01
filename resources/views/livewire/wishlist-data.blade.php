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
            {{-- <div class="col-span-4 {{ FD['rounded'] }} bg-white p-2 shadow-sm dark:bg-gray-800 md:p-4">
                <div class="w-full text-center">
                    <img src="{{ Storage::url('public/default/cart/undraw_web-shopping_m3o2.svg') }}" alt="empty-cart" class="w-72 m-auto mb-6">

                    <h5 class="block text-base leading-tight font-bold text-gray-900 dark:text-gray-300 mb-4">
                        No items here!
                    </h5>
                </div>
            </div> --}}

            <div class="col-span-4 {{ FD['rounded'] }} bg-white p-8 shadow-sm dark:bg-gray-800 text-center">
                <div class="max-w-md mx-auto">
                    <img src="{{ Storage::url('public/default/cart/undraw_web-shopping_m3o2.svg') }}" 
                        alt="No items" 
                        class="w-48 h-48 mx-auto mb-4">
                    
                    <h3 class="{{ FD['text-1'] }} font-bold text-gray-900 dark:text-white mb-2">
                        No items here!
                    </h3>
                    
                    <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400 mb-4">
                        Your wishlist is empty — discover products you'll love!
                    </p>

                    <div class="flex justify-center">
                        <x-front.button
                            element="a"
                            tag="primary"
                            :href="route('front.collection.index')"
                            class="w-32"
                            >
                            @slot('icon')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m40-240 20-80h220l-20 80H40Zm80-160 20-80h260l-20 80H120Zm623 240 20-160 29-240 10-79-59 479ZM240-80q-33 0-56.5-23.5T160-160h583l59-479H692l-11 85q-2 17-15 26.5t-30 7.5q-17-2-26.5-14.5T602-564l9-75H452l-11 84q-2 17-15 27t-30 8q-17-2-27-15t-8-30l9-74H220q4-34 26-57.5t54-23.5h80q8-75 51.5-117.5T550-880q64 0 106.5 47.5T698-720h102q36 1 60 28t19 63l-60 480q-4 30-26.5 49.5T740-80H240Zm220-640h159q1-33-22.5-56.5T540-800q-35 0-55.5 21.5T460-720Z"/></svg>
                            @endslot
                            {{ __('Start Shopping') }}
                        </x-front.button>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>