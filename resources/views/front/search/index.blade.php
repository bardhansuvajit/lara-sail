<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Search') }}">

    <div class="flex flex-col gap-2 sm:gap-4 px-2 sm:px-0">
        <!-- Featured Products -->
        @if (!empty($featuredProducts) && count($featuredProducts) > 0)
            <section class="bg-gray-100 antialiased dark:bg-gray-900 mt-2 md:mt-4">
                <div class="mx-auto max-w-screen-xl">
                    <div class="mb-2 sm:mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                        <p class="{{ FD['text-0'] }} sm:text-sm font-semibold text-gray-600 dark:text-gray-500">FEATURED</p>
                    </div>

                    <div class="grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="featured-products">
                        @foreach ($featuredProducts as $featuredItem)
                            <x-front.product-card :product="$featuredItem->product" />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <!-- Search Products -->
        @if (!empty($searchProducts) && count($searchProducts) > 0)
            <!-- Also show matching categories (if any) -->
            @if (!empty($searchCategories) && $searchCategories->count() > 0)
                <section class="bg-gray-100 antialiased dark:bg-gray-900">
                    <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
                        <div class="mb-2 sm:mb-4 flex items-center justify-between">
                            <p class="{{ FD['text-0'] }} sm:text-sm font-semibold text-gray-600 dark:text-gray-500">MATCHING CATEGORIES</p>
                        </div>

                        <div class="grid gap-3 grid-cols-2 sm:grid-cols-3 md:grid-cols-6">
                            @foreach ($searchCategories as $category)
                                <a href="{{ route('front.category.detail', $category->slug) }}" class="block p-3 border border-gray-200 dark:border-gray-700 hover:border-slate-300 hover:dark:border-slate-600 {{ FD['rounded'] }} hover:shadow-sm bg-white dark:bg-gray-800">
                                    <div class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">{{ $category->title }}</div>
                                    @if (!empty($category->image_m))
                                        <img src="{{ $category->image_m }}" alt="{{ $category->title }}" class="mt-2 w-full h-20 object-cover rounded">
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            <!-- Also show matching collections (if any) -->
            @if (!empty($searchCollections) && $searchCollections->count() > 0)
                <section class="bg-gray-100 antialiased dark:bg-gray-900">
                    <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
                        <div class="mb-2 sm:mb-4 flex items-center justify-between">
                            <p class="{{ FD['text-0'] }} sm:text-sm font-semibold text-gray-600 dark:text-gray-500">MATCHING COLLECTIONS</p>
                        </div>

                        <div class="grid gap-3 grid-cols-2 sm:grid-cols-3 md:grid-cols-6">
                            @foreach ($searchCollections as $collection)
                                <a href="{{ route('front.collection.detail', $collection->slug) }}" class="block p-3 border border-gray-200 dark:border-gray-700 hover:border-slate-300 hover:dark:border-slate-600 {{ FD['rounded'] }} hover:shadow-sm bg-white dark:bg-gray-800">
                                    <div class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">{{ $collection->title }}</div>
                                    @if (!empty($collection->image_m))
                                        <img src="{{ $collection->image_m }}" alt="{{ $collection->title }}" class="mt-2 w-full h-20 object-cover rounded">
                                    @endif
                                </a>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            <section class="bg-gray-100 antialiased dark:bg-gray-900">
                <div class="mx-auto max-w-screen-xl">
                    <div class="mb-2 sm:mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                        <p class="{{ FD['text-0'] }} sm:text-sm font-semibold text-gray-600 dark:text-gray-500">SEARCH PRODUCTS</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Results for "<span class="italic">{{ $query }}</span>"</p>
                    </div>

                    <div class="grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="search-products">
                        @foreach ($searchProducts as $product)
                            <x-front.product-card :product="$product" />
                        @endforeach
                    </div>
                </div>
            </section>

            {{ $searchProducts->withQueryString()->links() }}

        @else
            @if ( (empty($searchProducts) && count($searchProducts) == 0) &&
                (empty($searchCategories) && count($searchCategories) == 0) &&
                (empty($searchCollections) && count($searchCollections) == 0)
                )
                <section class="bg-gray-100 antialiased dark:bg-gray-900">
                    <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
                        <div class="mb-4" id="searched-products">
                            <div class="flex space-x-1 text-xs mb-5">
                                <p>We could not find anything with</p>
                                <p class="italic">{{ $query }}.</p>
                                <p>Try searching again.</p>
                            </div>
                        </div>
                    </div>
                </section>
            @else
                <!-- No products found -->
                <section class="bg-gray-100 antialiased dark:bg-gray-900 mb-4">
                    <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
                        {{-- <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                            <p class="{{ FD['text-1'] }} font-semibold text-gray-600 dark:text-gray-500">SEARCHED PRODUCTS</p>
                        </div> --}}

                        <div class="mb-4" id="searched-products">
                            {{-- <div class="flex space-x-1 text-xs mb-5">
                                <p>We could not find anything with</p>
                                <p class="italic">{{ $query }}.</p>
                                <p>Try searching again.</p>
                            </div> --}}

                            <!-- Even if no products, show matching categories/collections (helpful UX) -->
                            @if ((!empty($searchCategories) && $searchCategories->count() > 0) || (!empty($searchCollections) && $searchCollections->count() > 0))
                                <div class="space-y-4">
                                    @if (!empty($searchCategories) && $searchCategories->count() > 0)
                                        <div>
                                            <h3 class="font-semibold mb-2">Matching categories</h3>
                                            <div class="grid gap-3 grid-cols-2 sm:grid-cols-3 md:grid-cols-6">
                                                @foreach ($searchCategories as $category)
                                                    <a href="{{ route('front.category.detail', $category->slug) }}" class="block p-3 border border-gray-200 dark:border-gray-700 hover:border-slate-300 hover:dark:border-slate-600 {{ FD['rounded'] }} hover:shadow-sm bg-white dark:bg-gray-800">
                                                        <div class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">{{ $category->title }}</div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif

                                    @if (!empty($searchCollections) && $searchCollections->count() > 0)
                                        <div>
                                            <h3 class="font-semibold mb-2">Matching collections</h3>
                                            <div class="grid gap-3 grid-cols-2 sm:grid-cols-3 md:grid-cols-6">
                                                @foreach ($searchCollections as $collection)
                                                    <a href="{{ route('front.collection.detail', $collection->slug) }}" class="block p-3 border border-gray-200 dark:border-gray-700 hover:border-slate-300 hover:dark:border-slate-600 {{ FD['rounded'] }} hover:shadow-sm bg-white dark:bg-gray-800">
                                                        <div class="text-sm font-medium text-gray-700 dark:text-gray-200 truncate">{{ $collection->title }}</div>
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endif

                        </div>
                    </div>
                </section>
            @endif
        @endif

    </div>

</x-guest-layout>
