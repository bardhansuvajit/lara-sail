<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Product') }}">

<div class="px-2 md:px-0">
    <div class="flex flex-col gap-2 md:gap-4">
        <header class="bg-gray-100 dark:bg-gray-900 {{ FD['rounded'] }}">
            {{-- Breadcrumb --}}
            <nav class="{{ FD['text-0'] }} text-gray-500 mt-2 mb-1" aria-label="breadcrumb">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ route('front.home.index') }}" class="hover:underline text-gray-500 dark:text-gray-500">Home</a></li>
                    <li>/</li>
                    <li><a href="{{ route('front.product.detail', $product->slug) }}" class="hover:underline text-gray-500 dark:text-gray-500" title="{{ $product->title }}">{{ Str::limit($product->title, 25) }}</a></li>
                    <li>/</li>
                    <li><span class="text-gray-800 font-medium dark:text-gray-300">Customer reviews</span></li>
                </ol>
            </nav>

            {{-- Title & Subtitle --}}
            <div class="grid grid-cols-1 items-center mt-2">
                <div class="lg:col-span-3">
                    <h1 class="text-sm md:text-lg font-extrabold leading-tight">Customer Reviews</h1>
                </div>
            </div>
        </header>

        <section class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-2 md:p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="{{ route('front.product.detail', $product->slug) }}">
                        @if ($activeImagesCount > 0)
                            <div class="w-20 h-20 flex-shrink-0 {{ FD['rounded'] }} overflow-hidden border border-gray-100 dark:border-gray-800">
                            <img src="{{ Storage::url($images[0]->image_m) }}"
                                alt="Main product image"
                                class="w-full h-full object-cover transition-transform duration-300"
                                loading="lazy"
                                />
                            </div>
                        @else
                            <div class="w-16 h-16 flex-shrink-0 {{ FD['rounded'] }} overflow-hidden">
                                <div class="w-full h-full object-cover">
                                    {!! FD['brokenImageFront'] !!}
                                </div>
                            </div>
                        @endif
                    </a>

                    <div>
                        <a href="{{ route('front.product.detail', $product->slug) }}">
                            <h1 class="text-base font-semibold leading-tight">{{ $product->title }}</h1>
                        </a>

                        <!-- Price block -->
                        @if ( !empty($product->FDPricing) )
                            @php
                                $p = $product->FDPricing;
                                $currencySymbol = $p->country->currency_symbol;
                            @endphp

                            <div class="singleProdPricingBox">
                                <div class="flex items-baseline gap-2 my-2">
                                    <div class="mrpEl text-xl text-slate-500 dark:text-slate-400">
                                        <span class="line-through">
                                            <span class="currency-icon">{{ $currencySymbol }}</span><span class="mrpBox">{{ formatIndianMoney($p->mrp) }}</span>
                                        </span>
                                    </div>
                                    @if ($p->mrp > 0)
                                        <div class="sellingPriceEl text-sm font-bold">
                                            <span class="currency-icon">{{ $currencySymbol }}</span><span class="priceBox">{{ formatIndianMoney($p->selling_price) }}</span>
                                        </div>
                                    @endif
                                </div>
                                @if ($p->mrp > 0)
                                    <div class="savingsEl text-xs text-emerald-700 dark:text-emerald-300 font-bold mt-1">
                                        You save <span class="currency-icon">{{ $currencySymbol }}</span><span class="savingsBox">{{ formatIndianMoney($p->mrp - $p->selling_price) }}</span> 
                                        (<span class="discountBox">{{ $p->discount }}</span>% off)
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="mt-4">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400 dark:text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12A9 9 0 1112 3a9 9 0 019 9z" /></svg>
                                    <h2 class="{{ FD['text-1'] }} text-slate-800 dark:text-slate-200">Pricing not available</h2>
                                </div>
                            </div>
                        @endif

                        {{-- <div class="{{ FD['text-1'] }} font-medium">₹9,499</div> --}}
                        {{-- <div class="text-xs text-gray-500 dark:text-gray-400">Free delivery</div> --}}
                    </div>
                </div>
                {{-- <div class="flex items-center gap-2">
                    <button class="px-3 py-2 {{ FD['rounded'] }} border border-gray-200 dark:border-gray-700 {{ FD['text-1'] }}">Add</button>
                    <button class="px-4 py-2 {{ FD['rounded'] }} bg-blue-600 text-white {{ FD['text-1'] }}">Buy</button>
                </div> --}}
            </div>
        </section>

        <section class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-2 md:p-4 shadow-sm">
            @if ($reviews && count($reviews) > 0)
                <div id="reviews">
                    <x-front.product-detail-block-header
                        title="Customer reviews"
                        subtitle="{{ count($allReviews).' '.(count($allReviews) == 1 ? 'review' : 'reviews') }} found"
                    />

                    <hr class="my-4 border-gray-200/50 dark:border-gray-700/50"/>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-2 md:gap-4">
                        <div class="md:col-span-1 bg-primary-50 dark:bg-gray-900/50 p-4 {{ FD['rounded'] }} h-fit">
                            <x-front.product-review-highlight 
                                :product_slug="$product->slug"
                                :average_rating="$product->average_rating"
                                :review_count="$product->review_count"
                                :all_reviews="$allReviews"
                            />
                        </div>

                        <div class="md:col-span-3" id="reviewsList">
                            @foreach($reviews as $r)
                                <x-front.product-review-block 
                                    :data="$r"
                                />
                            @endforeach

                            {{ $reviews->links() }}
                        </div>
                    </div>

                </div>
            @else
                <div id="reviews">
                    <x-front.product-detail-block-header
                        title="Customer reviews"
                        subtitle="No reviews found"
                    />

                    <div class="text-center py-12 border dark:border-slate-700 {{ FD['rounded'] }} bg-slate-50 dark:bg-slate-800/50">
                        <svg class="mx-auto h-12 w-12 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>

                        <h3 class="mt-4 {{ FD['text-1'] }} font-semibold text-slate-900 dark:text-white">No reviews found</h3>
                        <p class="mt-2 {{ FD['text'] }} text-slate-600 dark:text-slate-400">Be the first to share your thoughts about this product</p>

                        <div class="flex justify-center mt-3">
                            <x-front.button
                                class="w-full md:w-40"
                                element="a">
                                @slot('icon')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-400h80v-120h120v-80H520v-120h-80v120H320v80h120v120ZM80-80v-720q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H240L80-80Z"/></svg>
                                @endslot
                                {{ __('Write the first review') }}
                            </x-front.button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Mobile sticky CTA -->
            {{-- <div id="mobileCta" class="fixed bottom-16 left-1/2 -translate-x-1/2 z-50 w-
                <div class="flex items-center justify-between bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 {{ FD['rounded'] }} p-3 shadow-lg">
                <div class="flex items-center gap-3">
                    <img src="https://dummyimage.com/64x64/cccccc/666666&text=P" alt="product" class="w-12 h-12 {{ FD['rounded'] }} object-cover">
                    <div>
                    <div class="{{ FD['text-1'] }} font-medium">₹9,499</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Free delivery</div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="px-3 py-2 {{ FD['rounded'] }} border border-gray-200 dark:border-gray-700 {{ FD['text-1'] }}">Add</button>
                    <button class="px-4 py-2 {{ FD['rounded'] }} bg-blue-600 text-white {{ FD['text-1'] }}">Buy</button>
                </div>
                </div>
            </div> --}}

        </section>
    </div>
</div>

</x-guest-layout>