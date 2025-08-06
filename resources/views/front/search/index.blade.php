<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Search') }}">

    {{-- <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 1</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 2</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 3</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 4</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 5</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 6</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 7</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 8</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 9</div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section> --}}

    @if (count($featuredProducts) > 0)
        <section class="bg-gray-100 mb-4 py-4 antialiased dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
                <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                    <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                </div>

                <div class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="featured-products">
                    @foreach ($featuredProducts as $featuredItem)
                        @php
                            $product = $featuredItem->product;
                        @endphp

                        <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 relative overflow-hidden">
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

                                <p class="font-semibold text-gray-900 hover:underline dark:text-gray-400 {{FD['text-0']}} sm:text-xs block leading-4 sm:leading-5 truncate">
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
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if (count($searchProducts) > 0)
        <section class="bg-gray-100 mb-4 py-4 antialiased dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
                <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                    <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">SEARCHED PRODUCTS</h2>
                </div>

                <div class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="searched-products">
                    @foreach ($searchProducts as $product)
                        @php
                            // $product = $searchItem->product;
                        @endphp

                        <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 relative overflow-hidden">
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

                                <p class="font-semibold text-gray-900 hover:underline dark:text-gray-400 {{FD['text-0']}} sm:text-xs block leading-4 sm:leading-5 truncate">
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
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @else
        <section class="bg-gray-100 mb-4 py-4 antialiased dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
                <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                    <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">SEARCHED PRODUCTS</h2>
                </div>

                <div class="mb-4" id="searched-products">
                    <div class="flex space-x-1 text-xs mb-5">
                        <p class="">We could not find anything with</p>
                        <p class="italic">{{ request()->input('q') }}.</p>
                        <p class="">Try searching again.</p>
                    </div>
                </div>
            </div>
        </section>
    @endif

</x-guest-layout>