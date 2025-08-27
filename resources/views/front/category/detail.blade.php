<x-guest-layout 
    screen="max-w-screen-xl" 
    title="{{ $category->title }}">

    <div class="flex flex-col gap-4 px-2 sm:px-0">
        <header class="bg-gray-100 dark:bg-gray-900 {{ FD['rounded'] }}">
            {{-- Breadcrumb --}}
            <nav class="{{ FD['text-0'] }} text-gray-500 mt-2 mb-1" aria-label="breadcrumb">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ route('front.home.index') }}" class="hover:underline text-gray-500 dark:text-gray-500">Home</a></li>
                    <li>/ <a href="{{ route('front.category.index') }}" class="hover:underline text-gray-500 dark:text-gray-500">Category</a></li>

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
                            <li>
                                / <a href="{{ route('front.category.detail', $parent->slug) }}" class="hover:underline text-gray-500 dark:text-gray-500">
                                    {{ $parent->title }}
                                </a>
                            </li>
                        @endforeach
                    @endif

                    <li> / <span class="text-gray-800 font-medium dark:text-gray-300">{{ $category->title }}</span></li>
                </ol>
            </nav>

            {{-- Title & Subtitle --}}
            <div class="grid grid-cols-1 items-center">
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
                            {{-- <button type="button" class="lg:hidden px-3 py-2 {{ FD['rounded'] }} text-xs bg-gray-300 dark:bg-gray-700" onclick="openFilters()">Filters</button> --}}
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

                {{-- Featured Products --}}
                @if (count($featuredProducts) > 0)
                    <section class="bg-gray-100 antialiased dark:bg-gray-900 mt-2 sm:mt-4">
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

        {{-- Minimal JS for view toggle, subcategory expand, and mobile filters --}}
        <script>
            // function setView(v){
            //     const grid = document.getElementById('productsGrid');
            //     const gridBtn = document.getElementById('gridViewBtn');
            //     const listBtn = document.getElementById('listViewBtn');

            //     if(v === 'list'){
            //         grid.className = 'grid grid-cols-1 gap-4';
            //         localStorage.setItem('catalogView','list');
            //         listBtn.setAttribute('aria-pressed','true');
            //         gridBtn.setAttribute('aria-pressed','false');
            //         listBtn.classList.add('bg-indigo-600','text-white');
            //         gridBtn.classList.remove('bg-indigo-600','text-white');
            //     } else {
            //         grid.className = 'grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4';
            //         localStorage.setItem('catalogView','grid');
            //         listBtn.setAttribute('aria-pressed','false');
            //         gridBtn.setAttribute('aria-pressed','true');
            //         gridBtn.classList.add('bg-indigo-600','text-white');
            //         listBtn.classList.remove('bg-indigo-600','text-white');
            //     }
            // }

            // restore view on load
            // (function(){
            //     const pref = localStorage.getItem('catalogView') || 'grid';
            //     setView(pref);
            // })();

            // Subcategories show more/less
            function toggleSubcats(){
                const extra = document.getElementById('subcatsExtra');
                const btn = document.getElementById('showMoreSubcats');
                if(!extra) return;
                if(extra.classList.contains('hidden')){
                    extra.classList.remove('hidden');
                    btn.textContent = 'Show less';
                } else {
                    extra.classList.add('hidden');
                    btn.textContent = 'Show more';
                }
            }

            // Mobile filters (off-canvas simple)
            function openFilters(){
                let panel = document.getElementById('mobileFiltersPanel');
                if(!panel){
                    // create panel dynamically
                    panel = document.createElement('div');
                    panel.id = 'mobileFiltersPanel';
                    panel.className = 'fixed inset-0 z-50 flex items-stretch lg:hidden';
                    panel.innerHTML = `
                        <div class="bg-black/50 w-full" onclick="closeFilters()"></div>
                        <div class="w-80 bg-white dark:bg-gray-900 p-4 overflow-auto">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-sm font-semibold">Filters</h3>
                                <button onclick="closeFilters()" class="text-sm">Close</button>
                            </div>
                            <div class="space-y-4">
                                <!-- replicate small filter form (price, brands, rating, attrs) -->
                                <form method="GET" action="{{ route('front.category.detail', $category->slug) }}">
                                    <input type="hidden" name="q" value="{{ request('q') }}">
                                    <div>
                                        <label class="text-xs font-medium">Price</label>
                                        <div class="flex gap-2 mt-2">
                                            <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min" class="w-1/2 px-2 py-1 text-sm rounded border" />
                                            <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max" class="w-1/2 px-2 py-1 text-sm rounded border" />
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <label class="text-xs font-medium">Customer rating</label>
                                        <div class="mt-2 flex flex-col gap-2 text-xs">
                                            @foreach([4,3,2,1] as $r)
                                                <label class="inline-flex items-center">
                                                    <input type="radio" name="rating" value="{{ $r }}" {{ request('rating') == $r ? 'checked' : '' }} class="mr-2"> 
                                                    <span>{{ $r }} stars & up</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>

                                    @foreach($attributes ?? [] as $attr)
                                        <div class="mt-4">
                                            <label class="text-xs font-medium">{{ $attr->name }}</label>
                                            <div class="mt-2 grid gap-2 max-h-32 overflow-auto text-xs">
                                                @foreach($attr->values as $val)
                                                    <label class="inline-flex items-center">
                                                        <input type="checkbox" name="attrs[{{ $attr->id }}][]" value="{{ $val->id }}" {{ collect(request('attrs.'. $attr->id, []))->contains($val->id) ? 'checked' : '' }} class="mr-2"> {{ $val->value }}
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="flex items-center gap-2 mt-4">
                                        <button type="submit" class="px-3 py-2 bg-indigo-600 text-white text-xs rounded">Apply</button>
                                        <button type="button" onclick="closeFilters()" class="text-xs text-gray-500">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    `;
                    document.body.appendChild(panel);
                } else {
                    panel.classList.remove('hidden');
                }
            }

            function closeFilters(){
                const panel = document.getElementById('mobileFiltersPanel');
                if(panel) panel.classList.add('hidden');
            }
        </script>
    </div>
</x-guest-layout>
