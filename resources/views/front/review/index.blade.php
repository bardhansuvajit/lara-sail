<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Product') }}">

<div class="px-2 md:px-0">
    <div class="flex flex-col gap-4">
        <header class="bg-gray-100 dark:bg-gray-900 {{ FD['rounded'] }}">
            {{-- Breadcrumb --}}
            <nav class="{{ FD['text-0'] }} text-gray-500 mt-2 mb-1" aria-label="breadcrumb">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ route('front.home.index') }}" class="hover:underline text-gray-500 dark:text-gray-500">Home</a></li>
                    <li>/</li>
                    <li><a href="{{ route('front.product.detail', $product->slug) }}" class="hover:underline text-gray-500 dark:text-gray-500">{{ $product->title }}</a></li>
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

        <section class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-4 shadow-sm">

            @if ($reviews && count($reviews) > 0)
                <div id="reviews">
                    @php
                        $total = $product->review_count; 
                    @endphp

                    <x-front.product-detail-block-header
                        title="Customer reviews"
                        subtitle="{{ count($allReviews).' '.(count($allReviews) == 1 ? 'review' : 'reviews') }} found"
                    />

                    <hr class="my-4 border-gray-200/50 dark:border-gray-700/50"/>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-1 bg-primary-50 dark:bg-gray-900/50 p-4 {{ FD['rounded'] }} h-fit">
                            <div class="text-center">
                                <div class="flex justify-center">
                                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $product->average_rating }}</p>

                                    <div class="w-8 h-8 text-amber-500 dark:text-amber-400">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m305-704 112-145q12-16 28.5-23.5T480-880q18 0 34.5 7.5T543-849l112 145 170 57q26 8 41 29.5t15 47.5q0 12-3.5 24T866-523L756-367l4 164q1 35-23 59t-56 24q-2 0-22-3l-179-50-179 50q-5 2-11 2.5t-11 .5q-32 0-56-24t-23-59l4-165L95-523q-8-11-11.5-23T80-570q0-25 14.5-46.5T135-647l170-57Z"/></svg>
                                    </div>
                                </div>

                                <div class="text-xs text-gray-600 dark:text-gray-500 mt-1">Based on {{ $product->review_count }} reviews</div>
                            </div>

                            @php
                                $ratingBuckets = [5=>0,4=>0,3=>0,2=>0,1=>0];
                                foreach($allReviews as $r) $ratingBuckets[$r['rating']]++;
                            @endphp

                            <div class="mt-3 mb-5 space-y-2 {{ FD['text-1'] }}">
                                @foreach($ratingBuckets as $star => $count)
                                    <div class="flex items-center gap-2">
                                        <div class="w-10 flex gap-1 items-center">
                                            <p class="!w-2 text-xs text-gray-800 dark:text-white">{{ $star }}</p>
                                            <div class="w-3 h-3 text-amber-500 dark:text-amber-400">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m305-704 112-145q12-16 28.5-23.5T480-880q18 0 34.5 7.5T543-849l112 145 170 57q26 8 41 29.5t15 47.5q0 12-3.5 24T866-523L756-367l4 164q1 35-23 59t-56 24q-2 0-22-3l-179-50-179 50q-5 2-11 2.5t-11 .5q-32 0-56-24t-23-59l4-165L95-523q-8-11-11.5-23T80-570q0-25 14.5-46.5T135-647l170-57Z"/></svg>
                                            </div>
                                        </div>
                                        <div class="flex-1 bg-gray-300 dark:bg-gray-700 h-2 rounded overflow-hidden">
                                            <div style="width:@php echo $total? intval(($count/$total)*100):0 @endphp%" class="h-2 bg-amber-600 dark:bg-amber-500"></div>
                                        </div>
                                        <div class="w-8 text-xs text-right text-gray-800 dark:text-white">
                                            {{ $count }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <x-front.button
                                class="w-full"
                                element="a">
                                @slot('icon')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M80-80v-720q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H240L80-80Z"/></svg>
                                @endslot
                                {{ __('Write a review') }}
                            </x-front.button>
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
            <div id="mobileCta" class="fixed bottom-16 left-1/2 -translate-x-1/2 z-50 w-[92%] sm:hidden">
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
            </div>

        </section>
    </div>
</div>

</x-guest-layout>