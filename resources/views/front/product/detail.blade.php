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
                                    {{-- <div class="h-full w-full flex items-center justify-center">
                                        <img src="{{ Storage::url($image->image_m) }}" class="h-full w-full object-down">
                                    </div> --}}
                                </div>
                            @endforeach
                            {{-- <div class="swiper-slide h-full">
                                <div class="h-full w-full flex items-center justify-center">
                                    <img src="https://placehold.co/300x400" class="h-full w-full object-down">
                                </div>
                            </div>
                            <div class="swiper-slide h-full">
                                <div class="h-full w-full flex items-center justify-center">
                                    <img src="https://placehold.co/800x700" class="h-full w-full object-down">
                                </div>
                            </div> --}}
                        </div>
                        <div class="swiper-pagination !flex justify-center gap-2"></div>
                        {{-- <button class="swiper-button-next"></button>
                        <button class="swiper-button-prev"></button> --}}
                    </div>
                </div>

                <div class="w-full mt-5">
                    <div class="fixed z-[1] bottom-16 w-full -m-2 pt-3 px-2 pb-3 sm:static sm:bottom-0 sm:m-0 sm:p-0 {{FD['rounded']}} border sm:border-0 dark:sm:border-0 border-gray-200 bg-white sm:bg-transparent dark:sm:bg-transparent shadow-sm sm:shadow-none dark:sm:shadow-none dark:border-0 lg:dark:border-0 dark:bg-gray-800">
                        <div class="flex space-x-2">
                            <button class="flex w-full items-center justify-center {{FD['rounded']}} bg-gray-300 focus:bg-gray-400 px-5 py-2.5 {{FD['text']}} font-medium text-gray=800 hover:bg-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800 add-to-cart" data-prod-id="{{$product->id}}" data-purchase-type="buy">
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
                                <button id="wishlist-btn" type="button" class="rounded-full w-6 h-6 p-1 hover:bg-gray-200 dark:hover:bg-gray-800">
                                    {{-- <div class="{{FD['iconClass']}} text-gray-500"> --}}
                                    <div class="{{FD['iconClass']}} text-red-500">
                                        {{-- <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z" /></svg> --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m480-120-58-52q-101-91-167-157T150-447.5Q111-500 95.5-544T80-634q0-94 63-157t157-63q52 0 99 22t81 62q34-40 81-62t99-22q94 0 157 63t63 157q0 46-15.5 90T810-447.5Q771-395 705-329T538-172l-58 52Z"/></svg>
                                    </div>
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
                                            onclick="sendUrlParam('{{ $attribute['slug'] }}', '{{ $value['slug'] }}')"
                                        >
                                            <div class="text-center">
                                                <div class="flex flex-col items-center gap-2">
                                                    <img src="https://placehold.co/40x40" class="rounded-full">
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
                        {{-- <div>
                            <h3 class="{{FD['text']}} sm:text-sm font-semibold mb-2 dark:text-gray-500">Color</h3>

                            <div class="w-full grid grid-cols-4 lg:grid-cols-6 gap-4">
                                <x-front.radio-input-button id="someId1" name="variation-color" value="Lime" onclick="sendUrlParam('color', 'Lime')">
                                    <div class="text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <img src="https://placehold.co/40x40" class="rounded-full">
                                            <div>
                                                <div class="{{FD['text']}} font-semibold">Lime</div>
                                                <div class="{{FD['text-0']}} text-gray-600 dark:text-gray-400">Extra 20% off</div>
                                            </div>
                                        </div>
                                    </div>
                                </x-front.radio-input-button>

                                <x-front.radio-input-button id="someId2" name="variation-color" value="Red" onclick="sendUrlParam('color', 'Red')">
                                    <div class="text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <img src="https://placehold.co/40x40" class="rounded-full">
                                            <div>
                                                <div class="{{FD['text']}} font-semibold">Red</div>
                                                <div class="{{FD['text-0']}} text-gray-600 dark:text-gray-400">Extra 20% off</div>
                                            </div>
                                        </div>
                                    </div>
                                </x-front.radio-input-button>

                                <x-front.radio-input-button id="someId3" name="variation-color" value="Blue" onclick="sendUrlParam('color', 'Blue')">
                                    <div class="text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <img src="https://placehold.co/40x40" class="rounded-full">
                                            <div>
                                                <div class="{{FD['text']}} font-semibold">Blue</div>
                                            </div>
                                        </div>
                                    </div>
                                </x-front.radio-input-button>
                            </div>
                        </div>

                        <div>
                            <h3 class="{{FD['text']}} sm:text-sm font-semibold mb-2 dark:text-gray-500">Size</h3>

                            <div class="w-full grid grid-cols-4 lg:grid-cols-6 gap-4">
                                <x-front.radio-input-button id="someId11" name="variation-size" value="M" onclick="sendUrlParam('size', 'M')">
                                    <div class="text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <div>
                                                <div class="{{FD['text']}} font-semibold">M</div>
                                                <div class="{{FD['text-0']}} text-gray-600 dark:text-gray-400">Extra 20% off</div>
                                            </div>
                                        </div>
                                    </div>
                                </x-front.radio-input-button>

                                <x-front.radio-input-button id="someId22" name="variation-size" value="L" onclick="sendUrlParam('size', 'L')">
                                    <div class="text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <div>
                                                <div class="{{FD['text']}} font-semibold">L</div>
                                                <div class="{{FD['text-0']}} text-gray-600 dark:text-gray-400">Extra 20% off</div>
                                            </div>
                                        </div>
                                    </div>
                                </x-front.radio-input-button>

                                <x-front.radio-input-button id="someId33" name="variation-size" value="XL" onclick="sendUrlParam('size', 'XL')">
                                    <div class="text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <div>
                                                <div class="{{FD['text']}} font-semibold">XL</div>
                                            </div>
                                        </div>
                                    </div>
                                </x-front.radio-input-button>

                                <x-front.radio-input-button id="someId44" name="variation-size" value="2XL" onclick="sendUrlParam('size', '2XL')">
                                    <div class="text-center">
                                        <div class="flex flex-col items-center gap-2">
                                            <div>
                                                <div class="{{FD['text']}} font-semibold">2XL</div>
                                            </div>
                                        </div>
                                    </div>
                                </x-front.radio-input-button>
                            </div>
                        </div> --}}
                    </div>


                    <div class="border-t dark:border-gray-700 my-4 sm:my-4"></div>
                    @endif


                    {{-- short description --}}
                    <p class="{{FD['text']}} text-gray-500">{{ $product->short_description }}</p>

                    {{-- long description --}}
                    <p class="{{FD['text']}} text-gray-500">{{ $product->long_description }}</p>


                    <!-- Seller Info -->
                    {{-- <div class="pt-4">
                        <div class="flex items-center gap-2">
                            <img src="https://placehold.co/40x40" class="rounded-full">
                            <div>
                                <div class="font-semibold">FashionHub Store</div>
                                <div class="text-sm text-gray-600">4.8 ★ (2.5k Ratings)</div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        {{-- <div class="mt-8">
            <div class="flex border-b" id="tabs">
                <button class="px-4 py-2 font-medium border-b-2 border-transparent hover:border-black" data-tab="description">Description</button>
                <button class="px-4 py-2 font-medium border-b-2 border-transparent hover:border-black" data-tab="reviews">Reviews (128)</button>
                <button class="px-4 py-2 font-medium border-b-2 border-transparent hover:border-black" data-tab="qa">Q&A (23)</button>
            </div>

            <!-- Tab Contents -->
            <div class="py-4" id="description">
                <h3 class="font-semibold mb-2">Product Details</h3>
                <p class="text-gray-600 text-sm">Floral print bodycon dress with stretchable fabric. Perfect for casual outings and parties. Available in multiple colors and sizes.</p>
            </div>

            <div class="py-4 hidden" id="reviews">
                <div class="space-y-4">
                    <!-- Review 1 -->
                    <div class="border-b pb-4">
                        <div class="flex items-center gap-2">
                            <div class="text-yellow-400">★★★★☆</div>
                            <div class="text-sm font-semibold">Rahul Sharma</div>
                            <div class="text-gray-500 text-sm">2 days ago</div>
                        </div>
                        <p class="mt-2 text-sm">Good quality fabric but runs slightly small. Size up recommended.</p>
                        <div class="flex gap-2 mt-2">
                            <img src="https://placehold.co/80x80" class="w-20 h-20 object-cover">
                            <img src="https://placehold.co/80x80" class="w-20 h-20 object-cover">
                        </div>
                    </div>
                    
                    <!-- Review Form -->
                    <div class="mt-4">
                        <h4 class="font-semibold mb-2">Write a Review</h4>
                        <textarea class="w-full border p-2 rounded" rows="3" placeholder="Share your experience..."></textarea>
                        <button class="mt-2 bg-black text-white px-4 py-2 text-sm rounded">Submit Review</button>
                    </div>
                </div>
            </div>

            <div class="py-4 hidden" id="qa">
                <div class="space-y-4">
                    <!-- Question 1 -->
                    <div class="border-b pb-4">
                        <div class="font-semibold">Q: Is this true to size?</div>
                        <div class="text-sm text-gray-600 mt-1">A: We recommend sizing up for a comfortable fit.</div>
                        <div class="text-sm text-gray-500 mt-2">Asked by Priya M • 5 days ago</div>
                    </div>
                    
                    <!-- Ask Question -->
                    <div class="mt-4">
                        <input type="text" class="w-full border p-2 rounded" placeholder="Ask a question...">
                        <button class="mt-2 bg-black text-white px-4 py-2 text-sm rounded">Ask Question</button>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>


    {{-- <div class="fixed bottom-8 left-0 right-0 flex justify-center z-50">
        <div class="text-center py-4 lg:px-4 w-full max-w-screen-md mx-4 mb-4 rounded-t-lg">
            <div class="p-2 bg-black items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex shadow" role="alert">
                <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">New</span>
                <span class="font-semibold mr-2 text-left flex-auto">Get the coolest t-shirts</span>

                <a href="" class="text-yellow-500 hover:text-yellow-600 font-bold me-1">Go to</a>

                <button type="button" class="ms-auto me-1 text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1 inline-flex items-center justify-center h-4 w-4 dark:text-gray-500 dark:hover:text-white" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        </div>
    </div> --}}

    @push('scripts')
        <script>
            // on select variation data, send into url parameter
            function sendUrlParam(variationType, value) {
                // Check if the URL already has a query string
                const url = new URL(window.location.href);
                const params = new URLSearchParams(url.search);

                // Set the parameter
                params.set('variation-'+variationType, value.toLowerCase());

                // Update the URL without reloading the page
                window.history.replaceState({}, '', `${url.pathname}?${params}`);
            }
        </script>
    @endpush
</x-guest-layout>
