<div>
    <div class="relative bg-white {{ FD['rounded'] }} shadow dark:bg-gray-800 p-3 pb-20 md:p-5 md:pb-16">
        <form class="w-full mx-auto pb-4 mb-4 border-b border-gray-200 dark:border-gray-700" action="{{ route('front.search.index') }}" method="GET">
            <div class="relative">
                <div class="absolute inset-y-0 start-0 hidden md:flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path></svg>
                </div>

                <input type="search" name="q" value="{{ request()->input('q') }}" class="block w-full pe-10 md:p-3 md:ps-10 md:pe-28 {{ FD['text-2'] }} text-gray-900 border border-gray-300 {{ FD['rounded'] }} bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search in all categories..." required=""
                aria-label="Search products" aria-describedby="search-help" autofocus>

                {{-- <div class="absolute z-10 -right-8 bottom-[0.45rem] block md:hidden border-l bg-gray-400"></div> --}}
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
                    focus:ring-4 focus:outline-none focus:ring-primary-300 
                    ">
                    <span class="hidden md:inline-block">Search</span>
                    <span class="inline-block md:hidden">
                        <svg class="{{ FD['iconClass'] }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path></svg>
                    </span>
                </button>

            </div>
        </form>

        <!-- Suggested results -->
        <div class="mb-4">
            <h3 class="{{FD['text']}} font-semibold text-gray-900 dark:text-white mb-2">Suggested results</h3>
            <ul class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400 space-y-2">
                <li class="flex items-center">
                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 me-1 sm:me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"></path></svg>
                    <a href="#" class="hover:underline">Apple iMac 2024 (All-in-One PC)</a>
                </li>
                <li class="flex items-center">
                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 me-1 sm:me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"></path></svg>
                    <a href="#" class="hover:underline">Samsung Galaxy S24 Ultra (1Tb, Titanium Violet)</a>
                </li>
                <li class="flex items-center">
                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 me-1 sm:me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"></path></svg>
                    <a href="#" class="hover:underline">MacBook Pro 14-inch M3 - Space Gray - Apple</a>
                </li>
            </ul>
        </div>

        <!-- History -->
        {{-- <div class="mb-4">
            <h3 class="{{FD['text']}} font-semibold text-gray-900 dark:text-white mb-2">History</h3>
            <ul class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-400 space-y-2">
                <li class="flex items-center">
                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 me-1 sm:me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path></svg>
                    <a href="#" class="hover:underline">Microsoft - Surface Laptop, Platinum, 256 GB SSD</a>
                </li>
                <li class="flex items-center">
                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 me-1 sm:me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path></svg>
                    <a href="#" class="hover:underline">Huawei - P40 Lite - Smartphone 128GB, Black</a>
                </li>
            </ul>
        </div> --}}

        <!-- Sponsored products -->
        <div class="mb-4">
            <!-- <h3 class="{{FD['text']}} font-semibold text-gray-900 dark:text-white mb-2">Featured products</h3> -->
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

                        {{-- price row --}}
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