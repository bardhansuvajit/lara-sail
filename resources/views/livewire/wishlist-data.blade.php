<div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
        @forelse ($data as $wishlistData)
            @php
                $product = $wishlistData->product;
            @endphp

            <div class="{{ FD['rounded'] }} border border-gray-200 bg-white p-2 shadow-lg dark:border-gray-700 dark:bg-gray-800 relative overflow-hidden">
                <a href="{{ route('front.product.detail', $product->slug) }}">
                    <div class="h-40 w-full">
                        @if (count($product->activeImages) > 0)
                            <div class="flex items-center justify-center h-full">
                                <img src="{{ Storage::url($product->activeImages[0]->image_m) }}" alt="" class="max-w-full max-h-full">
                            </div>
                        @else
                            <div class="flex items-center justify-center h-full w-full">
                                {!!FD['brokenImageFront']!!}
                            </div>
                        @endif
                    </div>

                    <div class="absolute top-0 right-0 w-full h-8 p-1 overflow-hidden">
                        <div class="flex justify-between items-center">
                            @if ($product->average_rating > 0)
                                {!! frontRatingHtml($product->average_rating) !!}
                            @endif

                            <button class="p-2 rounded-full focus:outline-none wishlist-btn" data-prod-id="{{$product->id}}">
                                <svg class="transition-all duration-300 ease-in-out w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path class="transition-all duration-300 ease-in-out" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                            </button>
                        </div>
                    </div>

                    <p class="font-semibold text-gray-900 hover:underline dark:text-gray-300 {{FD['text-0']}} sm:text-xs inline-block leading-4 sm:leading-5 truncate">
                        {{ $product->title }}
                    </p>

                    @if (count($product->pricings) > 0)
                        @php
                            $singlePricing = $product->pricings[0];
                        @endphp

                        <div class="mt-2 flex items-center gap-2">
                            <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                <span class="currency-icon">{{$singlePricing->currency_symbol}}</span> {{ formatIndianMoney($singlePricing->selling_price) }}
                            </p>
                            @if ($singlePricing->mrp != 0)
                                <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                    <span class="currency-icon">{{$singlePricing->currency_symbol}}</span>{{ formatIndianMoney($singlePricing->mrp) }}
                                </p>
                                <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                    {{$singlePricing->discount}}% off
                                </p>
                            @endif
                        </div>
                    @endif
                </a>

                <div class="mt-3 text-center">
                    @if (count($product->variations) == 0)
                        <button class="w-full {{ FD['rounded'] }} {{ FD['text-0'] }} bg-primary-700 dark:bg-primary-600 hover:bg-primary-800 dark:hover:bg-primary-700 p-1 text-gray-100 add-to-cart"
                            data-prod-id="{{$product->id}}" 
                            data-purchase-type="cart"
                            {{-- data-variation-data="{{ json_encode($variation['data']) }}" --}}
                        >
                            Add to cart
                        </button>
                    @else
                        <a href="{{route('front.product.detail', $product->slug)}}" class="block w-full {{ FD['rounded'] }} {{ FD['text-0'] }} bg-primary-700 dark:bg-primary-600 hover:bg-primary-800 dark:hover:bg-primary-700 p-1 text-gray-100">View details</a>
                    @endif

                    {{-- <a href="" class="{{ FD['text-0'] }} text-orange-700 dark:text-orange-600 hover:text-orange-800 dark:hover:text-orange-700">Remove from wishlist</a> --}}
                </div>

            </div>
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