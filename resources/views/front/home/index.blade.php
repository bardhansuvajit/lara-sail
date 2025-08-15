<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Home') }}">

    @php
        $products = collect(range(1,4))->map(function($i){
            return [
                'id'=> $i,
                'title'=> "Trending Product $i",
                'desc'=> 'High quality, top-rated item.',
                'price'=> rand(499,4999),
                'mrp'=> rand(5000,9999),
                'rating'=> round(3 + rand(0,20)/10,1),
                'image'=> "https://dummyimage.com/400x300/fff/aaa&text=Product+{$i}",
                'badge'=> $i%3==0 ? 'Limited' : ($i%4==0 ? 'Bestseller' : null),
            ];
        });

        $brands = ['Nike','Apple','Samsung','Sony','Adidas','Zara'];
    @endphp

    {{-- Banner --}}
    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">
                        <a href="{{$banner->web_redirect_url}}" target="_blank">
                            <img src="{{ Storage::url($banner->web_image_l_path) }}" alt="{{$banner->title}}">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    {{-- Featured Products --}}
    @if (count($featuredProducts) > 0)
        <section class="bg-gray-100 mb-4 pt-6 antialiased dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
                <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                    <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                </div>

                <div class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="featured-products">
                    {{-- Product Card Component --}}
                    @foreach ($featuredProducts as $featuredItem)
                        {{-- {{ dd($featuredItem) }} --}}
                        <x-front.product-card :product="$featuredItem" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Hero + Spotlight --}}
    <section class="max-w-7xl px-2 sm:px-0 mx-auto pb-4 grid grid-cols-1 lg:grid-cols-12 gap-4 items-start @if (count($featuredProducts) == 0) mt-5 @endif">
        {{-- Left: hero carousel / big promo --}}
        <div class="lg:col-span-8">
            <div class="bg-gradient-to-r from-indigo-50 to-white dark:from-primary-900 dark:to-primary-500 {{FD['rounded']}} p-4">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 flex flex-col justify-center gap-3">
                        <h1 class="{{ FD['text-2'] }} md:{{ FD['text-2'] }} lg:{{ FD['text-2'] }} font-extrabold leading-tight">Huge Savings. Everyday essentials. Top brands.</h1>
                        <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">Curated deals, fast delivery and reliable customer service — everything you expect from a marketplace leader.</p>

                        <div class="flex gap-3 mt-3">
                            <a href="#" class="text-sm bg-indigo-600 text-white px-4 py-2 rounded">Shop Bestsellers</a>
                            <a href="#" class="text-sm bg-white dark:bg-gray-800 border dark:border-gray-700 px-4 py-2 rounded">See Deals</a>
                        </div>
                    </div>

                    <div class="md:w-80 flex-shrink-0">
                        <img src="https://dummyimage.com/640x440/ede9fe/6d28d9&text=Big+Deal" alt="hero" class="{{FD['rounded']}} shadow-lg w-full h-auto object-cover">
                    </div>
                </div>

                {{-- mini promo strip --}}
                <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
                    <div class="bg-white dark:bg-gray-800 p-3 {{FD['rounded']}} flex items-center gap-3">
                        <img src="https://dummyimage.com/80x60/fff/888&text=1" alt="" class="rounded w-16 h-12 object-cover">
                        <div>
                            <p class="{{ FD['text'] }} font-medium">Up to 70% off</p>
                            <p class="{{ FD['text-0'] }} text-gray-500">On select electronics</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-3 {{FD['rounded']}} flex items-center gap-3">
                        <img src="https://dummyimage.com/80x60/fff/888&text=2" alt="" class="rounded w-16 h-12 object-cover">
                        <div>
                            <p class="{{ FD['text'] }} font-medium">Buy 1 Get 1</p>
                            <p class="{{ FD['text-0'] }} text-gray-500">On fashion picks</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-3 {{FD['rounded']}} flex items-center gap-3">
                        <img src="https://dummyimage.com/80x60/fff/888&text=3" alt="" class="rounded w-16 h-12 object-cover">
                        <div>
                            <p class="{{ FD['text'] }} font-medium">New arrivals</p>
                            <p class="{{ FD['text-0'] }} text-gray-500">Daily drops</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-3 {{FD['rounded']}} flex items-center gap-3">
                        <img src="https://dummyimage.com/80x60/fff/888&text=4" alt="" class="rounded w-16 h-12 object-cover">
                        <div>
                            <p class="{{ FD['text'] }} font-medium">Free Shipping</p>
                            <p class="{{ FD['text-0'] }} text-gray-500">Over ₹999</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Categories --}}
            <div class="max-w-7xl mx-auto pt-4">
                <div class="grid gap-3"
                    style="grid-template-columns: repeat({{ min(count($activeCategories), $categoryStyleCount) }}, minmax(0, 1fr));">
                    @foreach(array_slice($activeCategories, 0, $categoryStyleCount) as $cat)
                        <a href="{{ route('front.category.detail', $cat['slug']) }}">
                            <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} p-3 group transition h-full flex flex-col shadow-sm hover:shadow-lg border dark:border-gray-700">
                                {{-- Image --}}
                                @if (!empty($cat['image_s']))
                                    <img src="{{ Storage::url($cat['image_s']) }}" alt=""
                                        class="w-full h-20 rounded object-contain mb-4 group-hover:scale-105 transition">
                                @else
                                    <div class="flex-1 flex items-center justify-center rounded mb-4 bg-gradient-to-br from-blue-500 to-purple-500 text-white">
                                        <span class="{{ FD['text-2'] }} font-bold">{{ $cat['title'] }}</span>
                                    </div>
                                    @php $cat['title'] = null; @endphp
                                @endif

                                {{-- Title --}}
                                @if (!empty($cat['title']))
                                    <p class="{{ FD['text'] }} font-bold text-center line-clamp-1 text-gray-900 dark:text-white mb-1">
                                        {{ $cat['title'] }}
                                    </p>
                                @endif

                                {{-- Description --}}
                                @if (!empty($cat['short_description']))
                                    <p class="{{ FD['text-0'] }} font-light text-center line-clamp-2 text-gray-500 dark:text-gray-500 leading-none">
                                        {{ $cat['short_description'] }}
                                    </p>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>

        {{-- Right: Flash sale card + Top Picks --}}
        <aside class="lg:col-span-4 space-y-4">
            {{-- Flash Sale Products --}}
            @if(count($flashSaleProducts) > 0)
                <div class="bg-gradient-to-r from-amber-500 to-red-500 dark:from-red-900 dark:to-red-500 border border-red-100 dark:border-red-800 {{FD['rounded']}} px-4 pt-4 pb-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-bold dark:text-white">Flash Sale</h3>
                            <p class="{{ FD['text'] }} text-gray-200 dark:text-amber-200">Limited time - ends in</p>
                        </div>
                        <div id="countdown" class="{{ FD['text-2'] }} font-bold font-mono dark:text-white">00:10:00</div>
                    </div>

                    <div class="mt-3 grid grid-cols-2 gap-2">
                        @foreach($flashSaleProducts as $product)
                            <a href="{{ route('front.product.detail', $product->slug) }}">
                                <div class="bg-white dark:bg-gray-800 p-2 {{ FD['rounded'] }} shadow-sm hover:shadow-lg">
                                    {{-- Image --}}
                                    <div class="w-full h-28">
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

                                    {{-- Title --}}
                                    <p class="{{ FD['text'] }} font-medium mt-2 mb-1">{{ $product['title'] }}</p>

                                    {{-- Pricing --}}
                                    @if (count($product->pricings) > 0)
                                        @php $p = $product->pricings[0]; @endphp

                                        <div class="{{ FD['text-1'] }} font-extrabold text-gray-900 dark:text-white leading-none">
                                            <span class="currency-icon">{{ $p->currency_symbol }}</span>{{ formatIndianMoney($p->selling_price) }}
                                        </div>

                                        <div class="mt-1 flex items-center gap-2">
                                            @if($p->mrp && $p->mrp > 0)
                                                <span class="{{ FD['text'] }} text-gray-400 dark:text-gray-400 line-through">
                                                    <span class="currency-icon">{{ $p->currency_symbol }}</span>{{ formatIndianMoney($p->mrp) }}
                                                </span>
                                                <span class="{{ FD['text'] }} font-semibold text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-900/20 px-2 py-0.5 {{ FD['rounded'] }}">
                                                    {{ $p->discount }}% off
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Top Picks Products --}}
            {{-- 1 Show 0 when there are 3/4 FLASH SALE --}}
            {{-- 2 Show 3 when there are 1/2 FLASH SALE --}}
            {{-- 3 Show 8 when there are NO FLASH SALE --}}
            @if(count($flashSaleProducts) < 3)
                <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 {{FD['rounded']}} p-4">
                    <h3 class="text-xs font-medium mb-5 text-gray-400 dark:text-gray-500">TOP PICKS from us</h3>
                    <div class="space-y-3">
                        @foreach($mostSoldFeatures as $product)
                            <a href="{{ route('front.product.detail', $product->slug) }}" class="flex items-center gap-3 group">
                                @if (count($product->activeImages) > 0)
                                    <img
                                        src="{{ Storage::url($product->activeImages[0]->image_m) }}"
                                        alt="{{ $product->slug }}"
                                        loading="lazy"
                                        class="w-16 h-12 object-cover transition-transform duration-300"
                                    />
                                @else
                                    <div class="w-16 h-12 flex items-center justify-center text-gray-400 dark:text-gray-500">
                                        {!! FD['brokenImageFront'] !!}
                                    </div>
                                @endif

                                <div class="flex-1">
                                    <p class="{{ FD['text'] }} font-medium group-hover:underline">{{ $product['title'] }}</p>

                                    {{-- price row --}}
                                    @if (count($product->pricings) > 0)
                                        @php $p = $product->pricings[0]; @endphp

                                        <div class="mt-2 flex items-center justify-between gap-2">
                                            <div class="flex gap-2">
                                                <div class="{{ FD['text'] }} font-extrabold text-gray-900 dark:text-white leading-none">
                                                    <span class="currency-icon">{{ $p->currency_symbol }}</span>{{ formatIndianMoney($p->selling_price) }}
                                                </div>
                                                {{-- <div class="mt-1 flex items-center gap-2"> --}}
                                                    @if($p->mrp && $p->mrp > 0)
                                                        <span class="text-xs text-gray-400 dark:text-gray-400 line-through leading-none">
                                                            <span class="currency-icon">{{ $p->currency_symbol }}</span>{{ formatIndianMoney($p->mrp) }}
                                                        </span>
                                                        <span class="text-xs font-semibold text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-900/20 px-2 py-0.5 {{ FD['rounded'] }} leading-none">
                                                            {{ $p->discount }}% off
                                                        </span>
                                                    @endif
                                                {{-- </div> --}}
                                            </div>
                                        </div>
                                    @endif

                                    {{-- <p class="{{ FD['text'] }} text-gray-500">₹{{ $product['price'] }}</p> --}}
                                </div>
                                <button class="{{ FD['text'] }} bg-indigo-600 text-white px-2 py-1 rounded">Add</button>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </aside>
    </section>

    {{-- Brands strip --}}
    {{-- <section class="max-w-7xl mx-auto px-2 sm:px-0 py-4">
        <h2 class="text-sm font-bold mb-3">Top brands</h2>
        <div class="flex items-center gap-6 overflow-x-auto py-2">
            @foreach($brands as $b)
                <div class="flex-shrink-0 w-32 h-12 flex items-center justify-center bg-white dark:bg-gray-800 rounded shadow">
                    <span class="text-sm font-semibold">{{ $b }}</span>
                </div>
            @endforeach
        </div>
    </section> --}}

    {{-- Made by Indian --}}
    <section class="max-w-7xl mx-auto px-2 sm:px-0 py-4">
        <!-- Compact Premium Card -->
        <div class="bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 border border-gray-100 dark:border-gray-700 {{ FD['rounded'] }} shadow-sm overflow-hidden">
            <div class="grid md:grid-cols-12">
                <!-- Left Column - Visual Impact -->
                <div class="md:col-span-5 bg-gradient-to-b from-orange-100 to-green-100 dark:from-orange-800/20 dark:to-green-800/20 p-6 flex flex-col justify-center items-center text-center relative overflow-hidden">
                    <!-- Flag Background -->
                    <div class="absolute inset-0 opacity-40 dark:opacity-30 z-0">
                        <img src="{{ Storage::url('public/default/images/indian-flag.png') }}" 
                            alt="Indian Flag Background" 
                            class="w-full h-full object-cover object-center">
                    </div>

                    <!-- Foreground Content -->
                    <div class="relative z-1 w-full">
                        <!-- Flag Icon (optional) -->
                        <div class="mb-3 mx-auto w-12 h-12">
                            <svg id="flag-icons-india" viewBox="0 0 640 480"xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink><path d="M0 0h640v160H0z"fill=#f93 /><path d="M0 160h640v160H0z"fill=#fff /><path d="M0 320h640v160H0z"fill=#128807 /><g transform="matrix(3.2 0 0 3.2 320 240)"><circle r=20 fill=#008 /><circle r=17.5 fill=#fff /><circle r=3.5 fill=#008 /><g id=in-d><g id=in-c><g id=in-b><g id=in-a fill=#008><circle r=.9 transform="rotate(7.5 -8.8 133.5)"/><path d="M0 17.5.6 7 0 2l-.6 5z"/></g><use height=100% transform=rotate(15) width=100% xlink:href=#in-a /></g><use height=100% transform=rotate(30) width=100% xlink:href=#in-b /></g><use height=100% transform=rotate(60) width=100% xlink:href=#in-c /></g><use height=100% transform=rotate(120) width=100% xlink:href=#in-d /><use height=100% transform=rotate(-120) width=100% xlink:href=#in-d /></g></svg>
                        </div>

                        <!-- Text Content -->
                        <div class="text-center">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">Proudly Indian</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-300">Supporting 50k+ local sellers</p>
                        </div>

                        <!-- Trust Indicators -->
                        <div class="mt-4 flex items-center justify-center space-x-3">
                            <div class="flex items-center bg-white/80 dark:bg-gray-800/80 px-2 py-1 rounded-full">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-1 text-xs font-medium text-gray-700 dark:text-gray-300">Secure</span>
                            </div>
                            <div class="flex items-center bg-white/80 dark:bg-gray-800/80 px-2 py-1 rounded-full">
                                <svg class="w-3 h-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="ml-1 text-xs font-medium text-gray-700 dark:text-gray-300">Verified</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Features -->
                <div class="md:col-span-7 p-6">
                    <div class="flex items-center mb-4">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <h2 class="ml-2 text-lg font-bold text-gray-900 dark:text-white">Shop with Confidence</h2>
                    </div>

                    <!-- Compact Features Grid -->
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-start space-x-2">
                            <div class="flex-shrink-0 bg-indigo-50 dark:bg-indigo-900/30 rounded-md p-1.5">
                                <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-gray-900 dark:text-white">Free Delivery</h3>
                                <p class="mt-0.5 text-xs text-gray-600 dark:text-gray-400">Over ₹499 orders</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-2">
                            <div class="flex-shrink-0 bg-green-50 dark:bg-green-900/30 rounded-md p-1.5">
                                <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-gray-900 dark:text-white">100% Safe</h3>
                                <p class="mt-0.5 text-xs text-gray-600 dark:text-gray-400">Payment protection</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-2">
                            <div class="flex-shrink-0 bg-blue-50 dark:bg-blue-900/30 rounded-md p-1.5">
                                <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-gray-900 dark:text-white">Easy Returns</h3>
                                <p class="mt-0.5 text-xs text-gray-600 dark:text-gray-400">30-day policy</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-2">
                            <div class="flex-shrink-0 bg-purple-50 dark:bg-purple-900/30 rounded-md p-1.5">
                                <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xs font-semibold text-gray-900 dark:text-white">24/7 Support</h3>
                                <p class="mt-0.5 text-xs text-gray-600 dark:text-gray-400">Always available</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Compact CTA -->
                    <div class="mt-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span class="ml-1.5 text-xs text-gray-500 dark:text-gray-400">5M+ happy customers</span>
                        </div>
                        
                        @auth
                            <a href="{{ route('front.collection.index') }}" class="inline-flex items-center justify-center px-4 py-2 text-xs font-medium rounded shadow-sm text-white bg-gradient-to-r from-orange-500 to-green-600 hover:from-orange-600 hover:to-green-700 transition-all">
                                Shop Now
                                <svg class="ml-1.5 -mr-0.5 w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </a>
                        @else
                            <div class="flex space-x-2">
                                <a href="{{ route('front.login') }}" class="inline-flex items-center justify-center px-4 py-2 text-xs font-medium rounded shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 transition-all">
                                    Login
                                </a>
                                <a href="{{ route('front.register') }}" class="inline-flex items-center justify-center px-4 py-2 text-xs font-medium rounded shadow-sm text-gray-700 bg-white hover:bg-gray-50 dark:bg-gray-700 dark:text-white dark:hover:bg-gray-600 transition-all">
                                    Register
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Trust & Newsletter --}}
    <section class="max-w-7xl mx-auto px-2 sm:px-0 py-4 grid grid-cols-1 md:grid-cols-3 gap-4 items-center">
        <div class="md:col-span-2 bg-white dark:bg-gray-800 {{FD['rounded']}} p-6 flex items-center gap-4">
            <img src="https://dummyimage.com/120x120/fff/aaa&text=SAFE" alt="trust" class="w-20 h-20 object-cover rounded">
            <div>
                <h3 class="{{ FD['text-2'] }} font-bold">Trusted marketplace</h3>
                <p class="{{ FD['text'] }} text-gray-500">Secure payments, verified sellers and fast support.</p>
            </div>
        </div>

        @if(Auth::guard('web')->check())
            <div class="bg-indigo-600 text-white {{ FD['rounded'] }} p-6">
                <h3 class="text-sm font-bold">Welcome back</h3>
                <p class="{{ FD['text'] }} mb-3">Continue shopping and explore new deals.</p>
                <div class="flex gap-2">
                    <a href="{{ route('front.collection.index') }}" class="px-3 py-2 bg-white text-indigo-600 rounded {{ FD['text'] }}">
                        Shop Now
                    </a>
                </div>
            </div>
        @else
            <div class="bg-indigo-600 text-white {{ FD['rounded'] }} p-6">
                <h3 class="text-sm font-bold">Login now</h3>
                <p class="{{ FD['text'] }} mb-3">Sign in to get personalized offers and early access.</p>
                <div class="flex gap-2">
                    <a href="{{ route('front.login') }}" class="px-3 py-2 bg-white text-indigo-600 rounded {{ FD['text'] }}">
                        Login Now
                    </a>
                </div>
            </div>
        @endif
    </section>

    {{-- Trending Products Grid (conversion-focused) --}}
    @if (count($trendingProducts) > 0)
        <section class="max-w-7xl px-2 sm:px-0 mx-auto pb-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-sm font-bold">Trending Products for you</h2>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($trendingProducts as $product)
                    <article class="bg-white dark:bg-gray-800/70 {{FD['rounded']}} shadow hover:shadow-lg transition overflow-hidden border dark:border-gray-700 group">
                        <a href="{{ route('front.product.detail', $product->slug) }}">
                            <div class="relative">
                                @if (count($product->activeImages) > 0)
                                    <img
                                        src="{{ Storage::url($product->activeImages[0]->image_m) }}"
                                        alt="{{ $product->slug }}"
                                        loading="lazy"
                                        class="w-full h-40 object-cover transition-transform duration-300 group-hover:scale-105"
                                    />
                                @else
                                    <div class="w-full h-40 flex items-center justify-center text-gray-400 dark:text-gray-500">
                                        {!! FD['brokenImageFront'] !!}
                                    </div>
                                @endif

                                @if($product['badge'])
                                    <span class="absolute top-2 left-2 bg-yellow-400 {{ FD['text'] }} px-2 py-1 rounded">{{ $product['badge'] }}</span>
                                @endif

                                <div class="absolute top-2 right-2">
                                    <button
                                        type="button"
                                        class="wishlist-btn pointer-events-auto ml-auto inline-flex items-center justify-center p-1.5 rounded-full bg-white/90 dark:bg-gray-900/60 hover:bg-red-600/10 dark:hover:bg-red-600/40 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-red-500"
                                        aria-pressed="{{ !empty($product->wishlisted) ? 'true' : 'false' }}"
                                        aria-label="Toggle wishlist for {{ $product->title }}"
                                        data-prod-id="{{ $product->id }}"
                                    >
                                        <svg class="w-4 h-4 transition-colors text-red-500" viewBox="0 0 24 24" fill="{{ !empty($product->wishlisted) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="1.5" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div class="p-3">
                                <h3 class="text-sm font-semibold">{{ $product['title'] }}</h3>
                                <p class="{{ FD['text'] }} text-gray-500">{{ $product['short_description'] }}</p>
                                <div class="mt-2 flex items-center justify-between">
                                    @if (count($product->pricings) > 0)
                                        @php $p = $product->pricings[0]; @endphp

                                        <div class="mt-3 flex items-center justify-between gap-2">
                                            <div>
                                                <div class="{{ FD['text-2'] }} font-extrabold text-gray-900 dark:text-white leading-none">
                                                    <span class="currency-icon">{{ $p->currency_symbol }}</span>{{ formatIndianMoney($p->selling_price) }}
                                                </div>
                                                <div class="mt-1 flex items-center gap-2">
                                                    @if($p->mrp && $p->mrp > 0)
                                                        <span class="{{ FD['text'] }} text-gray-400 dark:text-gray-400 line-through">
                                                            <span class="currency-icon">{{ $p->currency_symbol }}</span>{{ formatIndianMoney($p->mrp) }}
                                                        </span>
                                                        <span class="{{ FD['text'] }} font-semibold text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-900/20 px-2 py-0.5 {{ FD['rounded'] }}">
                                                            {{ $p->discount }}% off
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </section>
    @endif

    <section class="bg-white px-2 sm:px-0 py-4 antialiased dark:bg-gray-900">
        <div class="mx-auto grid max-w-screen-xl {{FD['rounded']}} bg-gray-50 p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 xl:gap-16">
            <!-- IMAGE / ILLUSTRATION -->
            <div class="lg:col-span-5 lg:mt-0 flex items-center justify-center">
                <!-- Decorative/marketing image — replace with a Pexels or Undraw SVG as needed -->
                <img
                    {{-- src="https://dummyimage.com/640x480/edf2f7/6d28d9&text=iMac+27%22" --}}
                    src="https://images.pexels.com/photos/2661929/pexels-photo-2661929.jpeg"
                    alt="Apple iMac 27-inch product preview"
                    class="w-full max-w-md rounded-lg shadow-lg object-cover transition-transform duration-300 hover:scale-[1.02] dark:shadow-none"
                    loading="lazy"
                    role="img"
                    aria-hidden="false"
                />
            </div>

            <!-- CONTENT -->
            <div class="me-auto place-self-center lg:col-span-7 space-y-4">
            <!-- small badge + urgency -->
            <div class="flex items-center gap-3">
                <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 {{ FD['text'] }} font-medium text-yellow-800 dark:bg-yellow-900/40">
                <!-- lightning icon -->
                <svg class="h-4 w-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 2L3 14h7l-1 8 10-12h-7l1-8z"/>
                </svg>
                Limited time offer
                </span>

                <span class="{{ FD['text'] }} text-gray-500 dark:text-gray-400"> · Free delivery on orders ₹999+</span>
            </div>

            <!-- Main heading (big) -->
            <h1 class="{{ FD['text-2'] }} md:text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                Save <span class="text-indigo-600 dark:text-indigo-400">₹500</span> today — pre-order the new iMac 27”
            </h1>

            <!-- short description ({{ FD['text'] }} as requested) -->
            <p class="{{ FD['text'] }} text-gray-500 dark:text-gray-400">
                Reserve your iMac now to lock in exclusive launch pricing, priority shipping and a complimentary 1-year warranty extension.
            </p>

            <!-- price & savings block -->
            <div class="flex items-end gap-4">
                <div class="flex items-center gap-3">
                <div class="text-2xl font-extrabold text-gray-900 dark:text-white leading-none">₹<span class="ml-1">1,29,900</span></div>
                    <div class="flex flex-col {{ FD['text'] }} text-gray-500 dark:text-gray-400">
                        <span class="line-through">₹1,30,400</span>
                        <span class="text-green-600 dark:text-green-400 font-medium">You save ₹500</span>
                    </div>
                </div>

                <!-- expiry (aria-live to announce changes) -->
                <div class="ml-4 {{ FD['text'] }} text-gray-600 dark:text-gray-300" aria-live="polite">
                    <span class="block">Offer ends in</span>
                    <time id="promo-countdown" class="font-mono text-sm">02:13:45</time>
                </div>
            </div>

            <!-- CTA buttons -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:gap-3 gap-2">
                <a
                    href="#"
                    class="{{FD['rounded']}} inline-flex items-center justify-center bg-primary-700 px-5 py-3 text-base font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900"
                    role="button"
                    aria-label="Pre-order now - iMac 27 inch"
                >
                    Pre-order now
                </a>

                <a
                    href="#features"
                    class="inline-flex items-center justify-center {{FD['rounded']}} px-4 py-3 text-sm font-medium text-primary-700 bg-white border border-gray-200 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-700 dark:text-primary-300"
                    role="button"
                    aria-label="Learn more about the iMac 27 inch"
                >
                    Learn more
                </a>
            </div>

            <!-- micro-benefits -->
            <ul class="mt-2 flex flex-wrap gap-3 {{ FD['text'] }} text-gray-600 dark:text-gray-300">
                <li class="inline-flex items-center gap-2">
                    <svg class="h-4 w-4 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>
                    <span>Fast & insured delivery</span>
                </li>

                <li class="inline-flex items-center gap-2">
                    <!-- shield icon -->
                    <svg class="h-4 w-4 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Zm0-84q104-33 172-132t68-220v-189l-240-90-240 90v189q0 121 68 220t172 132Zm0-316Zm-80 160h160q17 0 28.5-11.5T600-360v-120q0-17-11.5-28.5T560-520v-40q0-33-23.5-56.5T480-640q-33 0-56.5 23.5T400-560v40q-17 0-28.5 11.5T360-480v120q0 17 11.5 28.5T400-320Zm40-200v-40q0-17 11.5-28.5T480-600q17 0 28.5 11.5T520-560v40h-80Z"/></svg>
                    <span>1-year warranty + free extended support</span>
                </li>

                <li class="inline-flex items-center gap-2">
                    <!-- refresh icon -->
                    <svg class="h-4 w-4 text-gray-500 dark:text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-3-6.7M21 3v6h-6"/>
                    </svg>
                    <span>30-day easy returns</span>
                </li>
            </ul>
            </div>
        </div>
    </section>

    {{-- Minimal JS for interactions: countdown (plain, dependency-free) --}}
    <script>
        // Countdown (demo fixed 10 minutes)
        (function(){
            const countdownEl = document.getElementById('countdown');
            if (countdownEl) {
                let remaining = 10*60; // 10 minutes
                setInterval(()=>{
                    if(remaining<=0){ countdownEl.textContent='00:00:00'; return }
                    remaining--;
                    const h = String(Math.floor(remaining/3600)).padStart(2,'0');
                    const m = String(Math.floor((remaining%3600)/60)).padStart(2,'0');
                    const s = String(remaining%60).padStart(2,'0');
                    countdownEl.textContent = `${h}:${m}:${s}`;
                },1000);
            }
        })();

        // small JS to make the countdown real (48 hours demo)
        (function(){
            // set expiry to 48 hours from page load (demo). Use server timestamp in production.
            const expiry = Date.now() + 48 * 3600 * 1000;
            const el = document.getElementById('promo-countdown');
            function tick(){
                const now = Date.now();
                const diff = Math.max(0, expiry - now);
                const h = String(Math.floor(diff / 3600000)).padStart(2,'0');
                const m = String(Math.floor((diff % 3600000) / 60000)).padStart(2,'0');
                const s = String(Math.floor((diff % 60000) / 1000)).padStart(2,'0');
                if(el) el.textContent = `${h}:${m}:${s}`;
                if(diff <= 0) clearInterval(tid);
            }
            tick();
                const tid = setInterval(tick, 1000);
            })();
    </script>

</x-guest-layout>