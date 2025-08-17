<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Home') }}">

    <div class="flex flex-col gap-4">
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
            <section class="bg-gray-100 antialiased dark:bg-gray-900">
                <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
                    <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                        <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
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
        <section class="max-w-7xl px-2 sm:px-0 mx-auto grid grid-cols-1 lg:grid-cols-12 gap-4 items-start @if (count($featuredProducts) == 0) mt-5 @endif">
            {{-- Left: Product Advertisement/ hero carousel / big promo --}}
            <div class="lg:col-span-8">
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
                <div class="max-w-7xl mx-auto pt-4">
                    <div class="grid gap-1 sm:gap-3"
                        style="grid-template-columns: repeat({{ min(count($activeCategories), $categoryStyleCount) }}, minmax(0, 1fr));">
                        @foreach(array_slice($activeCategories, 0, $categoryStyleCount) as $cat)
                            <a href="{{ route('front.category.detail', $cat['slug']) }}">
                                <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} p-0.5 sm:p-3 group transition h-full flex flex-col shadow-sm hover:shadow-lg border dark:border-gray-700 overflow-hidden">
                                    {{-- Image --}}
                                    @if (!empty($cat['image_s']))
                                        <img src="{{ Storage::url($cat['image_s']) }}" alt=""
                                            class="w-full h-16 sm:h-20 object-contain mb-4 group-hover:scale-105 transition">
                                    @else
                                        <div class="flex-1 flex items-center justify-center mb-4 bg-gradient-to-br from-blue-500 to-purple-500 text-white overflow-hidden">
                                            <span class="{{ FD['text'] }} sm:text-lg font-bold">{{ $cat['title'] }}</span>
                                        </div>
                                        @php $cat['title'] = null; @endphp
                                    @endif

                                    {{-- Title --}}
                                    @if (!empty($cat['title']))
                                        <p class="text-[10px] sm:text-xs font-bold text-center line-clamp-2 sm:line-clamp-1 text-gray-900 dark:text-white mb-1">
                                            {{ $cat['title'] }}
                                        </p>
                                    @endif

                                    {{-- Description --}}
                                    @if (!empty($cat['short_description']))
                                        <p class="{{ FD['text-0'] }} font-light text-center line-clamp-1 sm:line-clamp-2 text-gray-500 dark:text-gray-500 leading-none">
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
                {{-- @if(count($flashSaleProducts) < 3) --}}
                @if(count($mostSoldFeatures) > 0)
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
                                    {{-- <button class="{{ FD['text'] }} bg-indigo-600 text-white px-2 py-1 rounded">Add</button> --}}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </aside>
        </section>

        {{-- Proudly Indian --}}
        <x-front.proudly-indian />

        {{-- Homepage Ad 2 + Login Redirect --}}
        <section class="max-w-7xl px-2 sm:px-0 grid grid-cols-1 md:grid-cols-3 gap-4 items-stretch">
            @if ($homepageAd2)
                <div class="md:col-span-2 bg-white dark:bg-gray-800 {{ FD['rounded'] }} p-4 sm:p-6 flex items-center gap-6 shadow-sm h-full border border-gray-100 dark:border-gray-700">
                    {{-- Left Image --}}
                    <img src="{{ Storage::url($homepageAd2->image_l) }}" alt="trust" class="w-20 h-20 sm:w-24 sm:h-24 object-cover {{ FD['rounded'] }} flex-shrink-0">

                    {{-- Middle Text --}}
                    <div class="flex-1 flex flex-col justify-between h-full">
                        <div>
                            <h3 class="{{ FD['text'] }} sm:text-lg dark:text-gray-50 font-bold text-lg mb-1">{!! $homepageAd2->title !!}</h3>
                            <p class="{{ FD['text-0'] }} sm:text-xs text-gray-600 dark:text-gray-400">{!! $homepageAd2->subtitle !!}</p>
                        </div>

                        {{-- CTA Buttons --}}
                        <div class="flex gap-3 mt-4">
                            @if ($homepageAd2->cta_primary_url)
                                <a href="{{ $homepageAd2->cta_primary_url }}" 
                                class="text-xs sm:text-sm bg-indigo-600 hover:bg-indigo-700 text-white px-2 py-1 sm:px-4 sm:py-2 {{ FD['rounded'] }} shadow">
                                    {!! $homepageAd2->cta_primary_text !!}
                                </a>
                            @endif

                            @if ($homepageAd2->cta_secondary_url)
                                <a href="{{ $homepageAd2->cta_secondary_url }}" 
                                class="text-xs sm:text-sm bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-gray-200 px-2 py-1 sm:px-4 sm:py-2 {{ FD['rounded'] }} border border-gray-200 dark:border-gray-600">
                                    {!! $homepageAd2->cta_secondary_text !!}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            @php
                // unify the panel markup to ensure same classes for auth/guest
                $panelClasses = 'bg-indigo-600 text-white ' . FD['rounded'] . ' p-4 sm:p-6 h-full flex flex-col justify-between';
                $btnClasses = 'px-3 py-2 bg-white text-indigo-600 rounded ' . FD['text'];
            @endphp

            @if(Auth::guard('web')->check())
                <div class="{{ $panelClasses }}">
                    <div>
                        <h3 class="text-sm font-bold">Welcome back</h3>
                        <p class="{{ FD['text'] }} mb-3">Continue shopping and explore new deals.</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('front.collection.index') }}" class="{{ $btnClasses }}">
                            Shop Now
                        </a>
                    </div>
                </div>
            @else
                <div class="{{ $panelClasses }}">
                    <div>
                        <h3 class="text-sm font-bold">Login now</h3>
                        <p class="{{ FD['text'] }} mb-3">Sign in to get personalized offers and early access.</p>
                    </div>
                    <div class="flex gap-2">
                        <a href="{{ route('front.login') }}" class="{{ $btnClasses }}">
                            Login Now
                        </a>
                    </div>
                </div>
            @endif
        </section>

        {{-- Trending Products Grid (conversion-focused) --}}
        @if (count($trendingProducts) > 0)
            <section class="max-w-7xl px-2 sm:px-0">
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

        {{-- Homepage Ad 3 --}}
        @if ($homepageAd3)
            {{-- <section class="bg-gray-50 px-2 sm:px-0 py-4 antialiased dark:bg-gray-800 shdow border dark:border-gray-700"> --}}
            <section class="px-2 sm:px-0 antialiased">
                <div class="mx-auto grid max-w-screen-xl {{FD['rounded']}} bg-gray-50 p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 xl:gap-16 border dark:border-gray-700">
                    <div class="lg:col-span-5 lg:mt-0 flex items-center justify-center">
                        <img
                            src="{{ Storage::url($homepageAd3->image_l) }}"
                            alt="{{ $homepageAd3->title }}"
                            class="w-full max-w-md {{ FD['rounded'] }} object-cover transition-transform duration-300 hover:scale-[1.02] dark:shadow-none shadow hover:shadow-lg"
                            loading="lazy"
                            role="img"
                            aria-hidden="false"
                        />
                    </div>

                    <div class="me-auto place-self-center lg:col-span-7 space-y-4 mt-4 sm:mt-0">
                        @if ($homepageAd3->meta)
                            @php
                                $meta = $homepageAd3->meta;
                            @endphp
                            <div class="flex items-center gap-3">
                                @foreach ($meta['tags'] as $tag)
                                    <span class="inline-flex items-center rounded-full px-3 py-1 {{ FD['text'] }} font-medium text-yellow-800 bg-yellow-300 dark:text-yellow-100/60 dark:bg-amber-700/60">
                                        <div class="h-4 w-4 mr-2">
                                            {!! $tag['svg'] !!}
                                        </div>
                                        <span class="text-[10px] sm:text-xs">{{ $tag['title'] }}</span>
                                    </span>
                                @endforeach
                            </div>
                        @endif

                        <h1 class="{{ FD['text-2'] }} md:text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                            {!! $homepageAd3->title !!}
                        </h1>

                        <p class="{{ FD['text'] }} text-gray-500 dark:text-gray-400">
                            {!! $homepageAd3->subtitle !!}
                        </p>

                        <div class="flex items-end gap-4">
                            @if ($homepageAd3->meta)
                                @php
                                    $meta = $homepageAd3->meta;
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
                            @if ($homepageAd3->cta_primary_url)
                            <a
                                href="{{ $homepageAd3->cta_primary_url }}"
                                class="{{FD['rounded']}} inline-flex items-center justify-center bg-primary-700 px-5 py-3 text-base font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900"
                                role="button"
                                aria-label="{{ $homepageAd3->cta_primary_text }} - {{ $homepageAd3->title }}"
                            >
                                {!! $homepageAd3->cta_primary_text !!}
                            </a>
                            @endif

                            @if ($homepageAd3->cta_secondary_url)
                            <a
                                href="{{ $homepageAd3->cta_secondary_url }}"
                                class="inline-flex items-center justify-center {{FD['rounded']}} px-4 py-3 text-sm font-medium text-primary-700 bg-white border border-gray-200 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-700 dark:text-primary-300"
                                role="button"
                                aria-label="{{ $homepageAd3->cta_secondary_text }} about the {{ $homepageAd3->title }}"
                            >
                                {!! $homepageAd3->cta_secondary_text !!}
                            </a>
                            @endif
                        </div>

                        @if ($homepageAd3->meta)
                            @php
                                $meta = $homepageAd3->meta;
                            @endphp

                            <ul class="mt-2 flex flex-wrap gap-3 {{ FD['text'] }} text-gray-600 dark:text-gray-300">
                                @foreach ($meta['highlights'] as $highlight)
                                    <li class="inline-flex items-center gap-2">
                                        <div class="h-5 w-5 text-gray-500 dark:text-gray-300">
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