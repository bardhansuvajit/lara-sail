<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Collection') }}">

    <main class="container mx-auto px-0 sm:px-4 pt-5 sm:pt-8 pb-8">
        <div class="mb-0 sm:mb-8 px-2 sm:px-0">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{$collection->title}}</h1>
                    <p class="text-gray-600 dark:text-gray-400 max-w-2xl text-xs">{{$collection->short_description}}</p>
                    <p class="text-gray-600 dark:text-gray-400 max-w-2xl text-xs">{{$collection->long_description}}</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ count($products) .' '. (count($products) == 1 ? 'product' : 'products') }}</span>
                </div>
            </div>
        </div>

        @if (count($products) > 0)
            <section class="bg-gray-100 mb-4 py-4 antialiased dark:bg-gray-900">
                <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
                    {{-- <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                        <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                    </div> --}}

                    <div class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="featured-products">
                        @foreach ($products as $product)
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
                                            {{-- <div class="w-10 h-5 flex space-x-1 items-center bg-gray-50 px-1 border">
                                                <p class="{{FD['text-0']}} text-gray-900 font-bold">3.9</p>
                                                <div class="{{FD['iconClass']}} text-yellow-400 flex items-center">
                                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"></path></svg>
                                                </div>
                                            </div> --}}

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
                                        {{-- @foreach ($product->pricings as $singlePricing) --}}
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
                                        {{-- @endforeach --}}
                                    @endif
                                    {{-- <div class="mt-2 flex items-center gap-2">
                                        <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                            <span class="currency-symbol">₹</span>1,09,699
                                        </p>
                                        <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                            <span class="currency-symbol">₹</span>17,699
                                        </p>
                                        <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                            40% off
                                        </p>
                                    </div> --}}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </main>

</x-guest-layout>