<x-guest-layout 
    screen="max-w-screen-xl" 
    title="{{ $category->title }}">

    <div class="flex flex-col gap-2 sm:gap-4 px-2 sm:px-0">

        <header class="bg-gray-100 dark:bg-gray-900 {{ FD['rounded'] }}">
            {{-- Breadcrumb --}}
            <nav class="{{ FD['text-0'] }} text-gray-500 mt-2 mb-1" aria-label="breadcrumb">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ route('front.home.index') }}" class="hover:underline text-gray-500 dark:text-gray-500">Home</a></li>
                    <li>/</li>
                    <li><a href="{{ route('front.category.index') }}" class="hover:underline text-gray-500 dark:text-gray-500">Category</a></li>

                    @if ($category->ancestors)
                        @php
                            $parents = collect([]);
                            $current = $category->parentDetails;
                            while ($current) {
                                $parents->prepend($current);
                                $current = $current->parentDetails;
                            }
                        @endphp

                        @foreach ($parents as $parent)
                            <li>/</li>
                            <li>
                                <a href="{{ route('front.category.detail', $parent->slug) }}" class="hover:underline text-gray-500 dark:text-gray-500">
                                    {{ $parent->title }}
                                </a>
                            </li>
                        @endforeach
                    @endif
                    <li>/</li>
                    <li><span class="text-gray-800 font-medium dark:text-gray-300">{{ $category->title }}</span></li>
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
            {{-- render once into a hidden template --}}
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
                        <div class="{{ FD['text-0'] }} sm:text-xs text-gray-600">Showing <strong>{{ $products->firstItem() }}</strong>-<strong>{{ $products->lastItem() }}</strong> of <strong>{{ $products->total() }}</strong></div>

                        <div class="flex items-center gap-3">
                            <div 
                                class="relative md:hidden" 
                                x-data=""
                                x-on:click.prevent="
                                    $dispatch('open-sidebar', 'mob-filter-sidebar');
                                ">
                                    <x-front.button
                                        type="submit"
                                        class="w-full sm:w-40"
                                        tag="secondary"
                                        element="button">
                                        @slot('icon')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M400-240v-80h160v80H400ZM240-440v-80h480v80H240ZM120-640v-80h720v80H120Z"/></svg>
                                        @endslot
                                        {{ __('Filter') }}
                                    </x-front.button>
                                    {{-- <button type="button" class="lg:hidden px-3 py-2 {{ FD['rounded'] }} text-xs bg-gray-300 dark:bg-gray-700">Filters</button> --}}
                            </div>
                        </div>

                        {{-- mobile device only --}}
                        <x-front.sidebar name="mob-filter-sidebar" maxWidth="2xl" direction="right" focusable>
                            <div class="w-60 ">
                                {{-- Filters --}}
                                <div id="mobile-filter-target"></div>
                            </div>
                        </x-front.sidebar>
                    </div>
                @endif

                {{-- Subcategories --}}
                @if($subcategories->isNotEmpty())
                    <div class="mb-4 flex gap-2 flex-wrap">
                        @foreach($subcategories->take(8) as $sc)
                            <a href="{{ route('front.category.detail', $sc->slug) }}?{{ http_build_query(request()->except('page')) }}" class="text-xs px-3 py-1 bg-gray-200 dark:bg-gray-800 {{ FD['rounded'] }}">{{ $sc->title }}</a>
                        @endforeach
                    </div>
                @endif

                {{-- Products --}}
                @if ($products->count() > 0)
                    <section class="bg-gray-100 antialiased dark:bg-gray-900">
                        <div class="mx-auto max-w-screen-xl">
                            <div class="grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-4" id="featured-products">
                                @foreach ($products as $featuredItem)
                                    <x-front.product-card :product="$featuredItem" />
                                @endforeach
                            </div>
                        </div>
                    </section>

                    {{-- Pagination --}}
                    <div class="mt-6 flex items-center justify-between">
                        <div>
                            {{ $products->withQueryString()->links() }}
                        </div>

                        <div class="text-xs text-gray-500">
                            <span>Page {{ $products->currentPage() }} of {{ $products->lastPage() }}</span>
                        </div>
                    </div>
                @endif

                {{-- Featured Products --}}
                @if (count($featuredProducts) > 0)
                    <section class="bg-gray-100 antialiased dark:bg-gray-900 @if ($products->count() > 0) mt-2 sm:mt-4 @endif">
                        <div class="mx-auto max-w-screen-xl">
                            <div class="mb-2 sm:mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                                <p class="{{FD['text-0']}} sm:text-sm font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                            </div>

                            <div class="grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-4" id="featured-products">
                                {{-- Product Card Component --}}
                                @foreach ($featuredProducts as $featuredItem)
                                    <x-front.product-card :product="$featuredItem" />
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif

            </main>
        </div>

        {{-- Structured data for SEO (JSON-LD) --}}
        @push('head')
            <script type="application/ld+json">
                {!! json_encode([
                    "@context" => "https://schema.org",
                    "@type" => "CollectionPage",
                    "name" => $category->name,
                    "description" => $category->short_description ?? Str::limit(strip_tags($category->description ?? ''), 160),
                ]) !!}
            </script>
        @endpush
    </div>
</x-guest-layout>
