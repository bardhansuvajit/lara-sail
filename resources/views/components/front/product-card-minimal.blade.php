@props([
    'product',
    'showAddToCart' => false
])

<div class="{{ FD['rounded'] }} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 relative overflow-hidden">
    <a href="{{ route('front.product.detail', $product->slug) }}">
        <div class="h-40 w-full">
            @if (count($product->activeImages) > 0)
                <div class="flex items-center justify-center h-full">
                    <img src="{{ Storage::url($product->activeImages[0]->image_m) }}" alt="" class="max-w-full max-h-full">
                </div>
            @else
                <div class="flex items-center justify-center h-full w-full">
                    {!! FD['brokenImageFront'] !!}
                </div>
            @endif
        </div>

        <div class="absolute top-0 right-0 w-full h-8 p-1 overflow-hidden">
            <div class="flex justify-between items-center">
                @if ($product->average_rating > 0)
                    {!! frontRatingHtml($product->average_rating) !!}
                @endif

                {{-- Old rating block kept for reference --}}
                {{-- 
                <div class="w-10 h-5 flex space-x-1 items-center bg-gray-50 px-1 border">
                    <p class="{{ FD['text-0'] }} text-gray-900 font-bold">3.9</p>
                    <div class="{{ FD['iconClass'] }} text-yellow-400 flex items-center">
                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"></path></svg>
                    </div>
                </div> 
                --}}

                <button class="p-2 rounded-full focus:outline-none wishlist-btn" data-prod-id="{{ $product->id }}">
                    <svg class="transition-all duration-300 ease-in-out w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path class="transition-all duration-300 ease-in-out" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                    </svg>
                </button>
            </div>
        </div>

        <p class="font-semibold text-gray-900 hover:underline dark:text-gray-400 {{ FD['text-0'] }} sm:text-xs block leading-4 sm:leading-5 truncate">
            {{ $product->title }}
        </p>

        @if (count($product->pricings) > 0)
            @php
                $singlePricing = $product->pricings[0];
            @endphp
            {{-- @foreach ($product->pricings as $singlePricing) --}}
            <div class="mt-2 flex items-center gap-2">
                <p class="{{ FD['text'] }} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                    <span class="currency-icon">{{ $singlePricing->currency_symbol }}</span> {{ formatIndianMoney($singlePricing->selling_price) }}
                </p>
                @if ($singlePricing->mrp != 0)
                    <p class="{{ FD['text'] }} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                        <span class="currency-icon">{{ $singlePricing->currency_symbol }}</span>{{ formatIndianMoney($singlePricing->mrp) }}
                    </p>
                    <p class="{{ FD['text-0'] }} font-black leading-tight {{ FD['activeClass'] }} mb-4 sm:mb-0">
                        {{ $singlePricing->discount }}% off
                    </p>
                @endif
            </div>
            {{-- @endforeach --}}
        @endif
    </a>

    @if($showAddToCart)
        <div class="mt-3 text-center">
            @if (count($product->variations) == 0)
                <button class="flex w-full items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 add-to-cart"
                    data-prod-id="{{$product->id}}" 
                    data-purchase-type="cart"
                    {{-- data-variation-data="{{ json_encode($variation['data']) }}" --}}
                >
                    Add to cart
                </button>
            @else
                <a href="{{route('front.product.detail', $product->slug)}}" class="flex w-full items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">View details</a>
            @endif
        </div>
    @endif
</div>
