<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Product') }}">

    <div class="mx-auto px-2 sm:px-4 py-6">
        <div class="grid grid-cols-1 sm:grid-cols-5 gap-0 sm:gap-10">
            <!-- Product Images -->
            <div class="col-span-2 mb-0 sm:mb-5">
                <div class="w-full h-80 overflow-hidden mx-auto">
                    <div class="swiper main-swiper {{FD['rounded']}} h-full">
                        <div class="swiper-wrapper">
                            @foreach ($product->activeImages as $image)
                                <div class="swiper-slide h-full">
                                    <div class="flex items-center justify-center h-full">
                                        <img src="{{ Storage::url($image->image_m) }}" alt="" class="max-w-full max-h-full">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-pagination !flex justify-center gap-2"></div>
                        {{-- <button class="swiper-button-next"></button>
                        <button class="swiper-button-prev"></button> --}}
                    </div>
                </div>

                <div class="w-full mt-5">
                    <div class="fixed z-[1] bottom-16 w-full -m-2 pt-3 px-2 pb-3 sm:static sm:bottom-0 sm:m-0 sm:p-0 {{FD['rounded']}} border sm:border-0 dark:sm:border-0 border-gray-200 bg-white sm:bg-transparent dark:sm:bg-transparent shadow-sm sm:shadow-none dark:sm:shadow-none dark:border-0 lg:dark:border-0 dark:bg-gray-800">
                        @if($product->statusDetail->allow_order)
                            <div class="flex space-x-2">
                                <button class="flex w-full items-center justify-center {{FD['rounded']}} bg-gray-300 focus:bg-gray-400 px-5 py-2.5 {{FD['text']}} font-medium text-gray-800 hover:bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 add-to-cart" 
                                    data-prod-id="{{$product->id}}" 
                                    data-purchase-type="buy"
                                    data-variation-data="{{ json_encode($variation['data']) }}"
                                >
                                    Buy Now
                                </button>

                                <button class="flex w-full items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 add-to-cart" 
                                    data-prod-id="{{$product->id}}" 
                                    data-purchase-type="cart"
                                    data-variation-data="{{ json_encode($variation['data']) }}"
                                >
                                    Add to Cart
                                </button>
                            </div>
                        @else
                            <div class="flex flex-col items-center justify-center p-3 bg-gray-100 dark:bg-gray-700 {{FD['rounded']}}">
                                <p class="{{FD['text']}} font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ $product->statusDetail->title_frontend }}
                                </p>
                                <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400 text-center">
                                    {{ $product->statusDetail->description_frontend }}
                                </p>
                                {{-- @if($product->statusDetail->allow_preorder)
                                    <button class="mt-3 w-full flex items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 preorder-btn"
                                        data-prod-id="{{$product->id}}"
                                    >
                                        Pre-order Now
                                    </button>
                                @endif --}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-span-3">
                <div class="space-y-2 sm:space-y-4">
                    {{-- primary info --}}
                    <div class="">
                        <div class="w-full flex justify-between items-center">
                            <div>
                                {{-- title --}}
                                <h4 class="{{FD['text']}} sm:text-base text-gray-500 dark:text-gray-300 font-medium">{{ $product->title }}</h4>

                                {{-- short rating --}}
                                <div class="flex items-center space-x-2 mt-2">
                                    @if ($product->average_rating > 0)
                                    <div class="flex items-center text-yellow-400 text-sm">
                                        {!! frontRatingHtml($product->average_rating) !!}
                                        <span class="text-gray-600 dark:text-gray-400 ml-2 {{FD['text']}}">({{ $product->review_count }} {{ ($product->review_count == 1) ? 'review' : 'reviews' }})</span>
                                    </div>
                                    @endif

                                    <span class="text-green-600 {{FD['text']}}">In Stock</span>
                                </div>
                            </div>

                            <div>
                                <button class="p-2 rounded-full focus:outline-none wishlist-btn" data-prod-id="{{$product->id}}">
                                    <svg class="transition-all duration-300 ease-in-out w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path class="transition-all duration-300 ease-in-out" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                </button>
                            </div>
                        </div>

                        <div class="border-t dark:border-gray-700 my-4 sm:my-4"></div>

                        {{-- pricing --}}
                        @if (count($product->pricings) > 0)
                            @php
                                $singlePricing = $product->pricings[0];
                            @endphp
                            <div class="mt-2 flex items-center gap-4 mb-1 sm:mb-2">
                                <p class="{{FD['text-1']}} sm:text-lg font-bold leading-tight text-gray-900 dark:text-white">
                                    <span class="currency-symbol">{{$singlePricing->currency_symbol}}</span> {{ formatIndianMoney($singlePricing->selling_price) }}
                                </p>
                                @if ($singlePricing->mrp != 0)
                                    <p class="{{FD['text-1']}} sm:text-lg font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400">
                                        <span class="currency-symbol">{{$singlePricing->currency_symbol}}</span>{{ formatIndianMoney($singlePricing->mrp) }}
                                    </p>
                                    <p class="{{FD['text-1']}} font-black leading-tight {{FD['activeClass']}}">
                                        {{$singlePricing->discount}}% off
                                    </p>
                                @endif
                            </div>
                        @endif

                        <p class="{{FD['text-0']}} text-gray-500">Inclusive of all taxes</p>

                        <div class="flex space-x-2 items-center bg-green-200 dark:bg-green-900 text-gray-900 dark:text-gray-300 mt-3 p-2">
                            <div class="{{FD['iconClass']}}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M640-240v-80h104L536-526 376-366 80-664l56-56 240 240 160-160 264 264v-104h80v240H640Z"/></svg>
                            </div>

                            <p class="{{FD['text']}} font-bold">Lowest price in last 30 days</p>
                        </div>
                    </div>


                    <div class="border-t dark:border-gray-700 my-4 sm:my-4"></div>


                    {{-- variation --}}
                    @if ($variation['code'] == 200)
                        <div class="space-y-2" id="variationTab">
                            @foreach ($variation['data'] as $attrIndex => $attribute)
                                <div>
                                    <h3 class="{{FD['text']}} sm:text-sm font-semibold mb-2 dark:text-gray-500">{{ $attribute['title'] }}</h3>

                                    <div class="w-full grid grid-cols-4 lg:grid-cols-6 gap-4">
                                        @foreach ($attribute['values'] as $valueIndex => $value)

                                            <x-front.radio-input-button 
                                                id="someId{{$attrIndex}}{{$valueIndex}}" 
                                                name="variation-{{ $attribute['slug'] }}" 
                                                value="{{ $value['slug'] }}" 
                                                class="attr-val-generate" 
                                                data-prod-id="{{ $product->id }}" 
                                                data-attr-id="{{ $attribute['id'] }}" 
                                                data-value-id="{{ $value['id'] }}" 
                                                {{-- onclick="sendUrlParam('{{ $attribute['slug'] }}', '{{ $value['slug'] }}')" --}}
                                            >
                                                <div class="text-center">
                                                    <div class="flex flex-col items-center gap-2">
                                                        {{-- <img src="https://placehold.co/40x40" class="rounded-full"> --}}
                                                        <div>
                                                            <div class="{{FD['text']}} font-semibold">{{ $value['title'] }}</div>
                                                            <div class="{{FD['text-0']}} text-gray-600 dark:text-gray-400">Extra 20% off</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </x-front.radio-input-button>

                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="border-t dark:border-gray-700 my-4 sm:my-4"></div>
                    @endif


                    {{-- short description --}}
                    <p class="{{FD['text']}} text-gray-500">{!! nl2br($product->short_description) !!}</p>

                    {{-- long description --}}
                    <p class="{{FD['text']}} text-gray-500">{!! nl2br($product->long_description) !!}</p>
                </div>
            </div>
        </div>

    </div>
</x-guest-layout>
