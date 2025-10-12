<div>
    <div class="relative bg-white {{ FD['rounded'] }} shadow dark:bg-gray-800 p-3 pb-20 md:p-5 md:pb-16">
        <!-- Search Form -->
        <form class="w-full mx-auto mb-2 @if ($showSuggestions && !empty($query)) md:mb-2 @else md:mb-4 @endif" action="{{ route('front.search.index') }}" method="GET">
            <div class="relative">
                <div class="absolute inset-y-0 start-0 hidden md:flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                    </svg>
                </div>

                <!-- Livewire bound input with keyboard navigation -->
                <input 
                    type="search" 
                    name="q" 
                    value="{{ request()->input('q') }}"
                    wire:model.live="query"
                    wire:keydown.arrow-up.prevent="moveSelection('up')"
                    wire:keydown.arrow-down.prevent="moveSelection('down')"
                    wire:keydown.enter="selectCurrentSuggestion"
                    class="block w-full pe-10 md:p-3 md:ps-10 md:pe-28 {{ FD['text-2'] }} text-gray-900 border border-gray-300 {{ FD['rounded'] }} bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                    placeholder="Search in all categories..." 
                    required=""
                    aria-label="Search products" 
                    aria-describedby="search-help" 
                    autofocus
                    >

                <div class="h-8 absolute z-10 right-[2.6rem] bottom-[0.30rem] block md:hidden border-l border-gray-300"></div>

                <button type="submit"
                    class="absolute z-10 -right-5 bottom-0 md:-right-9 md:bottom-2.5 
                    h-[2.625rem] w-[2.625rem] md:w-auto md:h-auto
                    px-2 md:px-6 py-1 md:py-2 
                    {{ FD['rounded'] }} {{ FD['text-1'] }} 
                    transform -translate-x-1/2 
                    text-gray-700 md:text-white font-medium 
                    md:bg-primary-700 md:hover:bg-primary-800 
                    dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 
                    focus:ring-4 focus:outline-none focus:ring-primary-300">
                    <span class="hidden md:inline-block">Search</span>
                    <span class="inline-block md:hidden">
                        <svg class="{{ FD['iconClass'] }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path>
                        </svg>
                    </span>
                </button>
            </div>
        </form>

        <!-- Dynamic Search Suggestions -->
        @if($showSuggestions && !empty($query))
            <div class="mb-4">
                @php
                    $currentIndex = 0;
                @endphp
                
                <!-- Products -->
                @if(count($suggestions['products']) > 0)
                    <div class="mb-4">
                        <ul class="space-y-0">
                            @foreach($suggestions['products'] as $product)
                                <li class="flex items-center p-2 {{ FD['rounded'] }} cursor-pointer transition-colors duration-150 
                                    {{ $selectedIndex === $currentIndex ? 'bg-primary-100 dark:bg-primary-900 border border-primary-300 dark:border-primary-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}" 
                                    wire:click="selectSuggestion('product', {{ $product->id }}, '{{ $product->slug }}')"
                                    wire:key="product-{{ $product->id }}">
                                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 me-2 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                    </svg>
                                    <span class="{{FD['text']}} {{ $selectedIndex === $currentIndex ? 'text-primary-800 dark:text-primary-200 font-medium' : 'text-gray-600 dark:text-gray-400' }} truncate">
                                        {{ $product->title }}
                                    </span>
                                </li>
                                @php $currentIndex++; @endphp
                            @endforeach

                            @foreach($suggestions['categories'] as $category)
                                <li class="flex items-center p-2 {{ FD['rounded'] }} cursor-pointer transition-colors duration-150
                                    {{ $selectedIndex === $currentIndex ? 'bg-primary-100 dark:bg-primary-900 border border-primary-300 dark:border-primary-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                                    wire:click="selectSuggestion('category', {{ $category->id }}, '{{ $category->slug }}')"
                                    wire:key="category-{{ $category->id }}">
                                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 me-2 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                    </svg>
                                    <span class="{{FD['text']}} {{ $selectedIndex === $currentIndex ? 'text-primary-800 dark:text-primary-200 font-medium' : 'text-gray-600 dark:text-gray-400' }} truncate">
                                        {{ $category->title ?? $category->name }}
                                        <span class="italic text-gray-400 dark:text-gray-600">in Categories</span>
                                    </span>
                                </li>
                                @php $currentIndex++; @endphp
                            @endforeach

                            @foreach($suggestions['collections'] as $collection)
                                <li class="flex items-center p-2 {{ FD['rounded'] }} cursor-pointer transition-colors duration-150
                                    {{ $selectedIndex === $currentIndex ? 'bg-primary-100 dark:bg-primary-900 border border-primary-300 dark:border-primary-700' : 'hover:bg-gray-100 dark:hover:bg-gray-700' }}"
                                    wire:click="selectSuggestion('collection', {{ $collection->id }}, '{{ $collection->slug }}')"
                                    wire:key="collection-{{ $collection->id }}">
                                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 me-2 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                    </svg>
                                    <span class="{{FD['text']}} {{ $selectedIndex === $currentIndex ? 'text-primary-800 dark:text-primary-200 font-medium' : 'text-gray-600 dark:text-gray-400' }} truncate">
                                        {{ $collection->title }}
                                    </span>
                                </li>
                                @php $currentIndex++; @endphp
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- No Results Message -->
                @if(empty(array_filter($suggestions)))
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400 italic">
                        No results found for "{{ $query }}"
                    </p>
                @endif

                <!-- Keyboard help text -->
                {{-- @if(!empty(array_filter($suggestions)))
                    <div class="mt-2 pt-2 border-t border-gray-200 dark:border-gray-700">
                        <p class="{{FD['text-0']}} text-gray-400 dark:text-gray-500 text-center">
                            ↑↓ to navigate • Enter to select
                        </p>
                    </div>
                @endif --}}
            </div>
        @endif

        <!-- Sponsored products -->
        <div class="mb-4">
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
                @foreach ($sponsoredProducts as $singleItem)
                    @php
                        $product = $singleItem->product;
                    @endphp
                    <a href="{{ route('front.product.detail', $product->slug) }}" class="block {{ FD['rounded'] }} p-2 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600">
                        <div class="h-20">
                            @if (count($product->activeImages) > 0)
                                <img
                                    src="{{ Storage::url($product->activeImages[0]->image_m) }}"
                                    alt="{{ $product->slug }}"
                                    loading="lazy"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                />
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-500">
                                    {!! FD['brokenImageFront'] !!}
                                </div>
                            @endif
                        </div>

                        <h4 class="{{FD['text-0']}} font-medium dark:text-white text-gray-900">{{ $product->title }}</h4>

                        <p class="{{FD['text-0']}} text-slate-400">Sponsored</p>

                        @if ($product->average_rating > 0)
                            {!! frontRatingHtml($product->average_rating) !!}
                        @endif

                        @if ( !empty($product->FDPricing) )
                            @php
                                $p = $product->FDPricing;
                                $currencySymbol = $p->country->currency_symbol;
                            @endphp
                            <div class="mt-1 flex items-center justify-between gap-1">
                                <div>
                                    <div class="{{ FD['text-1'] }} font-extrabold text-gray-900 dark:text-white leading-none">
                                        <span class="currency-icon">{{ $currencySymbol }}</span>{{ formatIndianMoney($p->selling_price) }}
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @if($p->mrp && $p->mrp > 0)
                                            <span class="{{ FD['text'] }} text-gray-400 dark:text-gray-400 line-through">
                                                <span class="currency-icon">{{ $currencySymbol }}</span>{{ formatIndianMoney($p->mrp) }}
                                            </span>
                                            <span class="{{ FD['text'] }} font-semibold text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-900/20 px-2 py-0.5 {{ FD['rounded'] }}">
                                                {{ $p->discount }}% off
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>

        <!-- All categories -->
        <div>
            <h3 class="{{FD['text']}} font-semibold text-gray-900 dark:text-white mb-2">All categories</h3>
            <div class="grid sm:grid-cols-2 md:grid-cols-5 gap-2">
                @foreach ($activeCategories as $category)
                    <a href="{{ route('front.category.detail', $category['slug']) }}"
                        class="{{ FD['rounded'] }} py-2 px-4 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 DpMPWwlSESiYA8EE1xKM dark:hover:bg-gray-600 flex items-center">
                        @if (!empty($category['image_s']))
                            <img src="{{ Storage::url($category['image_s']) }}"
                                alt="{{ $category['slug'] }}"
                                class="object-contain {{ FD['iconClass'] }}" />
                        @endif
                        <span class="{{FD['text']}} font-medium text-gray-900 dark:text-white">{{ $category['title'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>