<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Search') }}">

    <div class="flex flex-col gap-2 sm:gap-4 px-2 sm:px-0">
        <!-- Featured Products -->
        @if (count($featuredProducts) > 0)
            <section class="bg-gray-100 antialiased dark:bg-gray-900 mt-2 md:mt-4">
                <div class="mx-auto max-w-screen-xl">
                    <div class="mb-2 sm:mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                        <p class="{{FD['text-0']}} sm:text-sm font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                    </div>

                    <div class="grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="featured-products">
                        {{-- Product Card Component --}}
                        @foreach ($featuredProducts as $featuredItem)
                            <x-front.product-card :product="$featuredItem->product" />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Search Products -->
        @if (count($searchProducts) > 0)
            <section class="bg-gray-100 antialiased dark:bg-gray-900">
                <div class="mx-auto max-w-screen-xl">
                    <div class="mb-2 sm:mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                        <p class="{{FD['text-0']}} sm:text-sm font-semibold text-gray-600 dark:text-gray-500">SEARCH PRODUCTS</h2>
                    </div>

                    <div class="grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="featured-products">
                        {{-- Product Card Component --}}
                        @foreach ($searchProducts as $product)
                            <x-front.product-card :product="$product" />
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
    </div>

</x-guest-layout>