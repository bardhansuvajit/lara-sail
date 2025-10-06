<x-guest-layout 
    screen="max-w-screen-xl" 
    title="{{ $category->title }}">

    <div class="flex flex-col gap-2 sm:gap-4 px-2 sm:px-0">

        <header class="bg-gray-100 dark:bg-gray-900 {{ FD['rounded'] }}">
            {{-- Optimized Breadcrumb --}}
            <nav class="{{ FD['text-0'] }} text-gray-500 mt-2 mb-1" aria-label="breadcrumb">
                <ol class="flex items-center gap-2 flex-wrap">
                    <li><a href="{{ route('front.home.index') }}" class="hover:underline text-gray-500 dark:text-gray-500">Home</a></li>
                    <li>/</li>
                    <li><a href="{{ route('front.category.index') }}" class="hover:underline text-gray-500 dark:text-gray-500">Category</a></li>

                    @php
                        // Precompute ancestors to avoid multiple queries
                        $ancestors = collect([]);
                        $current = $category->parentDetails;
                        while ($current) {
                            $ancestors->prepend($current);
                            $current = $current->parentDetails;
                        }
                    @endphp

                    @foreach ($ancestors as $parent)
                        <li>/</li>
                        <li>
                            <a href="{{ route('front.category.detail', $parent->slug) }}" class="hover:underline text-gray-500 dark:text-gray-500">
                                {{ Str::limit($parent->title, 20) }}
                            </a>
                        </li>
                    @endforeach
                    
                    <li>/</li>
                    <li><span class="text-gray-800 font-medium dark:text-gray-300">{{ Str::limit($category->title, 25) }}</span></li>
                </ol>
            </nav>

            {{-- Title & Subtitle --}}
            <div class="grid grid-cols-1 items-center mt-2">
                <div class="lg:col-span-3">
                    <h1 class="text-sm md:text-lg font-extrabold leading-tight">{{ $category->title }}</h1>

                    @if($category->short_description)
                        <p class="{{ FD['text-0'] }} sm:text-xs text-gray-600 dark:text-gray-400 line-clamp-2">{{ $category->short_description }}</p>
                    @endif
                </div>
            </div>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
            {{-- Filters template --}}
            <div id="category-filter-template" class="hidden" aria-hidden="true">
                <div id="category-filter-root">
                    @include('layouts.front.includes.category-detail-filter')
                </div>
            </div>

            {{-- Filters --}}
            <div id="desktop-filter-target" class="hidden lg:block lg:col-span-3"></div>

            {{-- Products --}}
            <main class="lg:col-span-9 space-y-4">
                @if ($products->count() > 0)
                    {{-- Result count --}}
                    <div class="flex items-center justify-between">
                        <div class="{{ FD['text-0'] }} sm:text-xs text-gray-600">
                            Showing <strong>{{ number_format($products->firstItem()) }}</strong>-<strong>{{ number_format($products->lastItem()) }}</strong> of <strong>{{ number_format($products->total()) }}</strong>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="relative md:hidden" x-data="" x-on:click.prevent="$dispatch('open-sidebar', 'mob-filter-sidebar');">
                                <x-front.button type="button" class="w-full sm:w-40" tag="secondary" element="button">
                                    @slot('icon')
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor" class="w-4 h-4"><path d="M400-240v-80h160v80H400ZM240-440v-80h480v80H240ZM120-640v-80h720v80H120Z"/></svg>
                                    @endslot
                                    {{ __('Filter') }}
                                </x-front.button>
                            </div>
                        </div>

                        {{-- Mobile sidebar --}}
                        {{-- <x-front.sidebar name="mob-filter-sidebar" maxWidth="sm" direction="right" focusable> --}}
                        <x-front.sidebar name="mob-filter-sidebar" width="md" mobileWidth="screen" direction="right" focusable>
                            {{-- <div class="w-60"> --}}
                                <div id="mobile-filter-target"></div>
                            {{-- </div> --}}
                        </x-front.sidebar>
                    </div>
                @endif

                {{-- Subcategories --}}
                @if($subcategories->isNotEmpty())
                    <div class="mb-4 flex gap-2 flex-wrap">
                        @foreach($subcategories->take(8) as $sc)
                            <a href="{{ route('front.category.detail', $sc->slug) }}?{{ http_build_query(request()->except('page')) }}" 
                               class="text-xs px-3 py-1 bg-gray-200 dark:bg-gray-800 {{ FD['rounded'] }} hover:bg-gray-300 dark:hover:bg-gray-700 transition-colors">
                                {{ Str::limit($sc->title, 15) }}
                            </a>
                        @endforeach
                    </div>
                @endif

                {{-- Products Grid --}}
                @if ($products->count() > 0)
                    <section class="bg-gray-100 antialiased dark:bg-gray-900">
                        <div class="mx-auto max-w-screen-xl">
                            <div class="grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-4" id="products-grid">
                                @foreach ($products as $product)
                                    <x-front.product-card :product="$product" />
                                @endforeach
                            </div>
                        </div>
                    </section>

                    {{-- Pagination --}}
                    <div class="mt-6 flex items-center justify-between">
                        <div>
                            {{ $products->withQueryString()->onEachSide(1)->links() }}
                        </div>

                        <div class="text-xs text-gray-500">
                            <span>Page {{ $products->currentPage() }} of {{ $products->lastPage() }}</span>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12">
                        <p class="text-gray-500 dark:text-gray-400">No products found matching your criteria.</p>
                    </div>
                @endif

                {{-- Featured Products --}}
                @if (count($featuredProducts) > 0)
                    <section class="bg-gray-100 antialiased dark:bg-gray-900 mt-2 sm:mt-4">
                        <div class="mx-auto max-w-screen-xl">
                            <div class="mb-2 sm:mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                                <p class="{{FD['text-0']}} sm:text-sm font-semibold text-gray-600 dark:text-gray-500">FEATURED</p>
                            </div>

                            <div class="grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-4" id="featured-products">
                                {{-- @foreach (array_slice($featuredProducts, 0, 4) as $featuredItem) --}}
                                @foreach ($featuredProducts as $featuredItem)
                                    <x-front.product-card :product="$featuredItem" />
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif

            </main>
        </div>

        {{-- Structured data for SEO --}}
        @push('head')
            <script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@type": "CollectionPage",
                    "name": "{{ addslashes($category->title) }}",
                    "description": "{{ addslashes($category->short_description ?? Str::limit(strip_tags($category->description ?? ''), 160)) }}",
                    "url": "{{ url()->current() }}"
                }
            </script>
        @endpush
    </div>
</x-guest-layout>