<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Home') }}">

    <div class="flex flex-col gap-2 sm:gap-4 px-2 sm:px-0">
        {{-- Banner --}}
        @if (count($banners) > 0)
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
        @endif

        {{-- Featured Products --}}
        @if (count($featuredProducts) > 0)
            <section class="bg-gray-100 antialiased dark:bg-gray-900">
                <div class="mx-auto max-w-screen-xl">
                    <div class="mb-2 sm:mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                        <p class="{{FD['text-0']}} sm:text-sm font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                    </div>

                    <div class="grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="featured-products">
                        {{-- Product Card Component --}}
                        @foreach ($featuredProducts as $featuredItem)
                            <x-front.product-card :product="$featuredItem" />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Homepage Ad 1 + Categories + Flash Sale + Top Picks --}}
        <section class="w-full mx-auto grid grid-cols-1 lg:grid-cols-12 gap-4 items-start @if (count($featuredProducts) == 0) mt-5 @endif">
            {{-- Left: Product Advertisement/ hero carousel / big promo --}}
            {{-- <div class="lg:col-span-8"> --}}
            <div class="col-span-12 @if(count($flashSaleProducts) > 0 || count($mostSoldFeatures) > 0) lg:col-span-8 @endif">
                {{-- Homepage Ad 1 --}}
                @if ($homepageAd1)
                    <div class="bg-gradient-to-r from-indigo-50 to-white dark:from-primary-900 dark:to-primary-500 {{FD['rounded']}} p-4">
                        <div class="flex flex-col md:flex-row gap-4">
                            <div class="flex-1 flex flex-col justify-center gap-3">
                                <h1 class="{{ FD['text-2'] }} md:{{ FD['text-2'] }} lg:{{ FD['text-2'] }} font-extrabold leading-tight">{!! $homepageAd1->title !!}</h1>
                                <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">{!! $homepageAd1->subtitle !!}</p>

                                <div class="flex gap-3 mt-3 justify-center sm:justify-start">
                                    @if ($homepageAd1->cta_primary_url)
                                        <a href="{{ $homepageAd1->cta_primary_url }}" class="text-sm bg-indigo-600 text-white px-4 py-2 rounded">{!! $homepageAd1->cta_primary_text !!}</a>
                                    @endif

                                    @if ($homepageAd1->cta_secondary_url)
                                        <a href="{{ $homepageAd1->cta_secondary_url }}" class="text-sm bg-white dark:bg-gray-800 border dark:border-gray-700 px-4 py-2 rounded">{!! $homepageAd1->cta_secondary_text !!}</a>
                                    @endif
                                </div>
                            </div>

                            <div class="md:w-80 flex-shrink-0">
                                <img src="{{ Storage::url($homepageAd1->image_l) }}" alt="hero" class="{{FD['rounded']}} shadow-lg w-full h-auto object-cover">
                            </div>
                        </div>

                        {{-- mini promo strip --}}
                        @if ($homepageAd1->meta)
                            @php
                                $meta = $homepageAd1->meta;
                            @endphp

                            <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
                                @foreach ($meta['highlights'] as $highlight)
                                    <div class="bg-white dark:bg-gray-800 p-3 {{FD['rounded']}} flex items-center gap-3">
                                        <div class="rounded w-6 h-6 object-cover text-gray-400 dark:text-gray-600">
                                            {!! $highlight['svg'] !!}
                                        </div>
                                        <div>
                                            <p class="{{ FD['text'] }} font-medium">{{ $highlight['title'] }}</p>
                                            <p class="{{ FD['text-0'] }} text-gray-500">{{ $highlight['description'] }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif


                {{-- Categories --}}
                @if (count($activeCategories) > 0)
                    <div class="max-w-7xl mx-auto pt-4">
                        <div class="grid gap-1 sm:gap-3" style="grid-template-columns: repeat({{ min(count($activeCategories), $categoryStyleCount) }}, minmax(0, 1fr));">
                            @foreach(array_slice($activeCategories, 0, $categoryStyleCount) as $cat)
                                <a href="{{ route('front.category.detail', $cat['slug']) }}">
                                    <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} p-0.5 sm:p-3 group transition h-full flex flex-col shadow-sm hover:shadow-lg border dark:border-gray-700 overflow-hidden">
                                        @if (!empty($cat['image_s']))
                                            <img src="{{ Storage::url($cat['image_s']) }}" alt=""
                                                class="w-full h-16 sm:h-20 object-contain mb-4 group-hover:scale-105 transition">
                                        @else
                                            <div class="flex-1 flex items-center justify-center bg-gradient-to-br from-blue-500 to-purple-500 text-white overflow-hidden">
                                                <span class="{{ FD['text'] }} sm:text-lg font-bold text-center">{{ $cat['title'] }}</span>
                                            </div>
                                            @php $cat['title'] = null; @endphp
                                        @endif

                                        @if (!empty($cat['title']))
                                            <p class="text-[10px] sm:text-xs font-bold text-center line-clamp-2 sm:line-clamp-1 text-gray-900 dark:text-white">
                                                {{ $cat['title'] }}
                                            </p>
                                        @endif

                                        @if (!empty($cat['short_description']))
                                            <p class="{{ FD['text-0'] }} mt-2 font-light text-center line-clamp-1 sm:line-clamp-2 text-gray-500 dark:text-gray-500 leading-none">
                                                {{ $cat['short_description'] }}
                                            </p>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>

            {{-- Right: Flash sale card + Top Picks --}}
            @if(count($flashSaleProducts) > 0 || count($mostSoldFeatures) > 0)
                <aside class="col-span-12 lg:col-span-4 space-y-2 sm:space-y-4">
                    {{-- Flash Sale Products --}}
                    @if(count($flashSaleProducts) > 0)
                        @include('layouts.front.includes.flash-sale')
                    @endif

                    {{-- Top Picks Products --}}
                    {{-- 1 Show 0 when there are 3/4 FLASH SALE --}}
                    {{-- 2 Show 3 when there are 1/2 FLASH SALE --}}
                    {{-- 3 Show 8 when there are NO FLASH SALE --}}
                    {{-- @if(count($flashSaleProducts) < 3) --}}
                    @if(count($mostSoldFeatures) > 0)
                        <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 {{FD['rounded']}} p-4">
                            <h3 class="text-xs font-medium mb-5 text-gray-400 dark:text-gray-500">TOP PICKS from us</h3>
                            <div class="space-y-3">
                                @foreach($mostSoldFeatures as $product)
                                    <a href="{{ route('front.product.detail', $product->slug) }}" class="flex items-center gap-3 group hover:bg-gray-700 pe-2">
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
                                            <p class="{{ FD['text'] }} font-medium">{{ $product['title'] }}</p>

                                            {{-- price row --}}
                                            @if (count($product->pricings) > 0)
                                                @php $p = $product->pricings[0]; @endphp

                                                <div class="mt-2 flex items-center justify-between gap-2">
                                                    <div class="flex gap-2">
                                                        <div class="{{ FD['text'] }} font-extrabold text-gray-900 dark:text-white leading-none">
                                                            <span class="currency-icon">{{ $p->currency_symbol }}</span>{{ formatIndianMoney($p->selling_price) }}
                                                        </div>

                                                        @if($p->mrp && $p->mrp > 0)
                                                            <span class="text-xs text-gray-400 dark:text-gray-400 line-through leading-none">
                                                                <span class="currency-icon">{{ $p->currency_symbol }}</span>{{ formatIndianMoney($p->mrp) }}
                                                            </span>
                                                            <span class="text-xs font-semibold text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-900/20 px-2 py-0.5 {{ FD['rounded'] }} leading-none">
                                                                {{ $p->discount }}% off
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endif

                                        </div>

                                        {{-- <button class="{{ FD['text'] }} bg-indigo-600 text-white px-2 py-1">Add</button> --}}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </aside>
            @endif
        </section>

        {{-- Proudly Indian --}}
        <x-front.proudly-indian />

        {{-- Homepage Ad 2 + Homepage Ad 3 --}}
        @if ($homepageAd2 || $homepageAd3)
            <section class="max-w-7xl grid grid-cols-1 md:grid-cols-2 gap-2 sm:gap-4 items-stretch">

                @if ($homepageAd2)
                    <div class="bg-indigo-600 text-white {{ FD['rounded'] }} p-4 sm:p-6 h-full flex flex-col justify-between shadow-md overflow-hidden">
                        @if ($homepageAd2->meta['tags'])
                            @php
                                $tags = $homepageAd2->meta['tags'];
                            @endphp

                            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 sm:gap-3">
                                @if ($tags['left'])
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-white/12 text-xs font-semibold tracking-tight">
                                        <div class="{{ FD['iconClass'] }}">
                                            {!! $tags['left']['tag1']['svg'] !!}
                                        </div>
                                        <span class="ml-1">{!! $tags['left']['tag1']['title'] !!}</span>
                                    </span>

                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-white/10 text-xs font-medium">
                                        <div class="{{ FD['iconClass'] }}">
                                            {!! $tags['left']['tag2']['svg'] !!}
                                        </div>
                                        <span class="ml-1">{!! $tags['left']['tag2']['title'] !!}</span>
                                    </span>
                                </div>
                                @endif

                                @if ($tags['right'])
                                    <div class="text-xs text-white/80 flex items-center gap-2 mt-2 sm:mt-0">
                                        <div class="{{ FD['iconClass'] }}">
                                            {!! $tags['right']['tag1']['svg'] !!}
                                        </div>
                                        <span>{!! $tags['right']['tag1']['title'] !!}</span>
                                    </div>
                                @endif
                            </div>
                        @endif

                        <div class="mt-3">
                            <h3 class="text-lg font-bold">{!! $homepageAd2->title !!}</h3>
                            <p class="text-xs mt-2 text-white/90 mb-3">{!! $homepageAd2->subtitle !!}</p>

                            @if ($homepageAd2->meta)
                                @php
                                    $meta = $homepageAd2->meta;
                                @endphp
                                <ul class="grid grid-cols-2 gap-2 text-xs">
                                    @foreach ($meta['highlights'] as $tIndex => $tag)
                                        <li class="flex items-start gap-2">
                                            <div class="{{ FD['iconClass'] }} text-white/95 shrink-0">
                                                {!! $tag['svg'] !!}
                                            </div>
                                            <span class="text-white/95">{{ $tag['title'] }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>

                        <div class="mt-8 sm:mt-4 flex flex-row sm:flex-row items-stretch gap-2">
                            @if ($homepageAd2->cta_primary_url)
                                <a href="{{ $homepageAd2->cta_primary_url }}"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-3 py-2 {{ FD['rounded'] }} bg-white text-indigo-600 font-semibold text-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-600 transition"
                                aria-label="{!! $homepageAd2->cta_primary_text !!}">
                                    {!! $homepageAd2->cta_primary_text !!}
                                </a>
                            @endif

                            @if ($homepageAd2->cta_secondary_url)
                                <a href="{{ $homepageAd2->cta_secondary_url }}"
                                class="w-full sm:w-auto inline-flex items-center justify-center px-3 py-2 {{ FD['rounded'] }} border border-white/25 text-white text-sm font-medium hover:bg-white/10 focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-600 transition"
                                aria-label="{!! $homepageAd2->cta_secondary_text !!}">
                                    {!! $homepageAd2->cta_secondary_text !!}
                                </a>
                            @endif
                        </div>
                    </div>
                @endif

                @if ($homepageAd3)
                    @php
                        /** Type 1, when small image is square
                         *  Type 2, when small image is vertical
                         */
                        $rightSideAdType = 1; // Type 1/2

                        if ($rightSideAdType == 2) {
                            $adClass1 = "p-4 sm:p-6";
                            $adClass11 = "gap-4";
                            $adClass2 = "rounded-md";
                            $adClass3 = "w-20 h-20";
                            $adClass4 = "";
                        } else {
                            $adClass1 = "p-0";
                            $adClass11 = "";
                            $adClass2 = FD['rounded'];
                            $adClass3 = "w-40 h-full";
                            $adClass4 = "p-4 sm:p-6";
                        }
                    @endphp

                    <div class="bg-white dark:bg-gray-800 {{ $adClass1 }} flex {{ $adClass11 }} shadow-sm h-full {{ FD['rounded'] }} relative overflow-hidden items-center">
                        <div class="absolute inset-0 opacity-30 dark:opacity-30 z-0">
                            <img src="{{ Storage::url($homepageAd3->meta['bgImage']) }}" alt="{{ $homepageAd3->title }}" class="w-full h-full object-cover object-center">
                        </div>

                        <div class="hidden sm:block h-full z-0">
                            <img src="{{ Storage::url($homepageAd3->image_m) }}" alt="" class="{{ $adClass3 }} object-cover flex-shrink-0 {{ $adClass2 }} z-0" aria-hidden="true" />
                        </div>

                        <div class="flex-1 flex flex-col justify-between h-full z-0 {{ $adClass4 }}">
                            @if ($homepageAd3->meta['tags'])
                                @php
                                    $tags = $homepageAd3->meta['tags'];
                                @endphp

                                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-2 sm:gap-3">
                                    @if ($tags['left'])
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-white/12 text-xs font-semibold tracking-tight bg-indigo-50 text-indigo-700">
                                            <div class="{{ FD['iconClass'] }}">
                                                {!! $tags['left']['tag1']['svg'] !!}
                                            </div>
                                            <span class="ml-1">{!! $tags['left']['tag1']['title'] !!}</span>
                                        </span>

                                        <span class="inline-flex items-center px-2 py-0.5 rounded-md bg-green-50 text-green-700 text-xs font-medium">
                                            <div class="{{ FD['iconClass'] }}">
                                                {!! $tags['left']['tag2']['svg'] !!}
                                            </div>
                                            <span class="ml-1">{!! $tags['left']['tag2']['title'] !!}</span>
                                        </span>
                                    </div>
                                    @endif

                                    @if ($tags['right'])
                                        <div class="text-xs text-white/80 flex items-center gap-2 mt-2 sm:mt-0">
                                            <div class="{{ FD['iconClass'] }}">
                                                {!! $tags['right']['tag1']['svg'] !!}
                                            </div>
                                            <span>{!! $tags['right']['tag1']['title'] !!}</span>
                                        </div>
                                    @endif
                                </div>
                            @endif

                            <div class="mt-3">
                                <h3 class="text-lg font-bold dark:text-gray-50">{!! $homepageAd3->title !!}</h3>
                                <p class="text-xs text-gray-600 dark:text-gray-300 mt-2 mb-3">{!! $homepageAd3->subtitle !!}</p>

                                @if ($homepageAd3->meta)
                                    @php
                                        $meta = $homepageAd3->meta;
                                    @endphp
                                    <ul class="grid grid-cols-2 gap-2 text-xs">
                                        @foreach ($meta['highlights'] as $tIndex => $tag)
                                            <li class="flex items-start gap-2">
                                                <div class="{{ FD['iconClass'] }} text-white/95 shrink-0">
                                                    {!! $tag['svg'] !!}
                                                </div>
                                                <span class="text-white/95">{{ $tag['title'] }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>

                            <div class="mt-6 sm:mt-4 flex gap-3">
                                @if ($homepageAd3->cta_primary_url)
                                    <a href="{{ $homepageAd3->cta_primary_url }}"
                                    class="inline-flex items-center justify-center px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold {{ FD['rounded'] }}
                                            focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-indigo-100 dark:focus-visible:ring-offset-gray-800 transition"
                                    aria-label="{!! $homepageAd3->cta_primary_text !!}">
                                        {!! $homepageAd3->cta_primary_text !!}
                                    </a>
                                @endif

                                @if ($homepageAd3->cta_primary_url)
                                    <a href="{{ $homepageAd3->cta_secondary_url }}"
                                    class="inline-flex items-center justify-center px-3 py-2 border border-gray-200 dark:border-gray-700 text-xs sm:text-sm text-gray-700 dark:text-gray-200 {{ FD['rounded'] }}
                                            hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 transition"
                                    aria-label="{!! $homepageAd3->cta_secondary_text !!}">
                                        {!! $homepageAd3->cta_secondary_text !!}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </section>
        @endif

        {{-- Trending Products Grid (conversion-focused) --}}
        @if (count($trendingProducts) > 0)
            <section class="max-w-7xl">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-sm font-bold">Trending Products for you</h2>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-4">
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

        {{-- Homepage Ad 4 --}}
        @if ($homepageAd4)
            {{-- <section class="bg-gray-50 py-4 antialiased dark:bg-gray-800 shdow border dark:border-gray-700"> --}}
            <section class="antialiased">
                <div class="mx-auto grid max-w-screen-xl {{FD['rounded']}} bg-gray-50 p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 xl:gap-16 border dark:border-gray-700">
                    <div class="lg:col-span-5 lg:mt-0 flex items-center justify-center">
                        <img
                            src="{{ Storage::url($homepageAd4->image_l) }}"
                            alt="{{ $homepageAd4->title }}"
                            class="w-full max-w-md {{ FD['rounded'] }} object-cover transition-transform duration-300 hover:scale-[1.02] dark:shadow-none shadow hover:shadow-lg"
                            loading="lazy"
                            role="img"
                            aria-hidden="false"
                        />
                    </div>

                    <div class="me-auto place-self-center lg:col-span-7 space-y-4 mt-4 sm:mt-0">
                        @if ($homepageAd4->meta)
                            @php
                                $meta = $homepageAd4->meta;
                            @endphp
                            <div class="flex items-center gap-3">
                                @foreach ($meta['tags'] as $tIndex => $tag)
                                    @php
                                        $randomTagColors = FD['randomTagColors'];
                                        $colorClass = $randomTagColors[array_rand($randomTagColors)];
                                    @endphp
                                    <span class="inline-flex items-center rounded-full px-3 py-1 {{ FD['text'] }} font-medium {{ $colorClass }}">
                                        <div class="h-4 w-4 mr-2">
                                            {!! $tag['svg'] !!}
                                        </div>
                                        <span class="text-[10px] sm:text-xs">{{ $tag['title'] }}</span>
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <h1 class="{{ FD['text-2'] }} md:text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                            {!! $homepageAd4->title !!}
                        </h1>

                        <p class="{{ FD['text'] }} text-gray-500 dark:text-gray-400">
                            {!! $homepageAd4->subtitle !!}
                        </p>

                        <div class="flex items-end gap-4">
                            @if ($homepageAd4->meta)
                                @php
                                    $meta = $homepageAd4->meta;
                                @endphp

                                <div class="flex items-center gap-3">
                                    <div class="text-2xl font-extrabold text-gray-900 dark:text-white leading-none">{!! $meta['pricing']['sell'] !!}</span></div>
                                    <div class="flex flex-col {{ FD['text'] }} text-gray-500 dark:text-gray-400">
                                        <span class="line-through">{!! $meta['pricing']['mrp'] !!}</span>
                                        <span class="text-green-600 dark:text-green-400 font-medium">{!! $meta['pricing']['sale_text'] !!}</span>
                                    </div>
                                </div>
                            @endif

                            <div class="ml-4 {{ FD['text'] }} text-gray-600 dark:text-gray-300" aria-live="polite">
                                <span class="block">Offer ends in</span>
                                <time id="promo-countdown" class="font-mono text-sm">48:00:00</time>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:items-center sm:gap-3 gap-2">
                            @if ($homepageAd4->cta_primary_url)
                                <a
                                    href="{{ $homepageAd4->cta_primary_url }}"
                                    class="{{FD['rounded']}} inline-flex items-center justify-center bg-primary-700 px-5 py-3 text-base font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900"
                                    role="button"
                                    aria-label="{{ $homepageAd4->cta_primary_text }} - {{ $homepageAd4->title }}"
                                >
                                    {!! $homepageAd4->cta_primary_text !!}
                                </a>
                            @endif

                            @if ($homepageAd4->cta_secondary_url)
                                <a
                                    href="{{ $homepageAd4->cta_secondary_url }}"
                                    class="inline-flex items-center justify-center {{FD['rounded']}} px-4 py-3 text-sm font-medium text-primary-700 bg-white border border-gray-200 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-700 dark:text-primary-300"
                                    role="button"
                                    aria-label="{{ $homepageAd4->cta_secondary_text }} about the {{ $homepageAd4->title }}"
                                >
                                    {!! $homepageAd4->cta_secondary_text !!}
                                </a>
                            @endif
                        </div>

                        @if ($homepageAd4->meta)
                            @php
                                $meta = $homepageAd4->meta;
                            @endphp

                            <ul class="mt-2 flex flex-wrap gap-3 {{ FD['text'] }} text-gray-600 dark:text-gray-300">
                                @foreach ($meta['highlights'] as $highlight)
                                    <li class="inline-flex items-center gap-2">
                                        <div class="{{ FD['iconClass'] }} text-gray-500 dark:text-gray-300">
                                            {!! $highlight['svg'] !!}
                                        </div>

                                        <span>{{ $highlight['title'] }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                    </div>
                </div>
            </section>
        @endif

    </div>

    {{-- Minimal JS for interactions: countdown (plain, dependency-free) --}}
    <script>
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