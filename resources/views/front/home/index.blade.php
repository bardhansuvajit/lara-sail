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
            <section class="bg-gray-100 antialiased dark:bg-gray-900 @if (count($banners) == 0) mt-2 sm:mt-4 @endif">
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
                    <x-ads.ad-set-1 :data="$homepageAd1" />
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
                                    <a href="{{ route('front.product.detail', $product->slug) }}" class="flex items-center gap-3 group hover:bg-gray-100 dark:hover:bg-gray-700 pe-2">
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
                    <x-ads.ad-set-2 :data="$homepageAd2" />
                @endif

                @if ($homepageAd3)
                    <x-ads.ad-set-3 :data="$homepageAd3" />
                @endif
            </section>
        @endif

        {{-- Trending Products Grid (conversion-focused) --}}
        @if (count($trendingProducts) > 0)
            <section class="bg-gray-100 antialiased dark:bg-gray-900 @if (count($banners) == 0) mt-2 sm:mt-4 @endif">
                <div class="mx-auto max-w-screen-xl">
                    <div class="mb-2 sm:mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                        <p class="{{FD['text-0']}} sm:text-sm font-semibold text-gray-600 dark:text-gray-500">Trending Products for you</h2>
                    </div>

                    <div class="grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="featured-products">
                        {{-- Product Card Component --}}
                        @foreach ($trendingProducts as $trendingItem)
                            <x-front.product-card :product="$trendingItem" />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Homepage Ad 4 --}}
        @if ($homepageAd4)
            {{-- <section class="bg-gray-50 py-4 antialiased dark:bg-gray-800 shdow border dark:border-gray-700"> --}}
            <x-ads.ad-set-4 :data="$homepageAd4" />
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