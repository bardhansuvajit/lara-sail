<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Home') }}">

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

    @if (count($featuredProducts) > 0)
        <section class="bg-gray-100 mb-4 py-4 antialiased dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
                <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                    <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                </div>

                <div class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="featured-products">
                    @foreach ($featuredProducts as $featuredItem)
                        @php
                            $product = $featuredItem->product;
                        @endphp

                        <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 relative overflow-hidden">
                            <a href="{{ route('front.product.detail', $product->slug) }}">
                                <div class="h-40 w-full">
                                    @if (count($product->activeImages) > 0)
                                        <div class="flex items-center justify-center h-full">
                                            <img src="{{ Storage::url($product->activeImages[0]->image_m) }}" alt="" class="max-w-full max-h-full">
                                        </div>
                                    @else
                                        <div class="flex items-center justify-center h-full w-full">
                                            {!!FD['brokenImageFront']!!}
                                        </div>
                                    @endif
                                </div>

                                <div class="absolute top-0 right-0 w-full h-8 p-1 overflow-hidden">
                                    <div class="flex justify-between items-center">
                                        @if ($product->average_rating > 0)
                                            {!! frontRatingHtml($product->average_rating) !!}
                                        @endif
                                        {{-- <div class="w-10 h-5 flex space-x-1 items-center bg-gray-50 px-1 border">
                                            <p class="{{FD['text-0']}} text-gray-900 font-bold">3.9</p>
                                            <div class="{{FD['iconClass']}} text-yellow-400 flex items-center">
                                                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"></path></svg>
                                            </div>
                                        </div> --}}

                                        <button class="p-2 rounded-full focus:outline-none wishlist-btn" data-prod-id="{{$product->id}}">
                                            <svg class="transition-all duration-300 ease-in-out w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path class="transition-all duration-300 ease-in-out" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                                        </button>
                                    </div>
                                </div>

                                <p class="font-semibold text-gray-900 hover:underline dark:text-gray-400 {{FD['text-0']}} sm:text-xs block leading-4 sm:leading-5 truncate">
                                    {{ $product->title }}
                                </p>

                                @if (count($product->pricings) > 0)
                                    @php
                                        $singlePricing = $product->pricings[0];
                                    @endphp
                                    {{-- @foreach ($product->pricings as $singlePricing) --}}
                                        <div class="mt-2 flex items-center gap-2">
                                            <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                                <span class="currency-icon">{{$singlePricing->currency_symbol}}</span> {{ formatIndianMoney($singlePricing->selling_price) }}
                                            </p>
                                            @if ($singlePricing->mrp != 0)
                                                <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                                    <span class="currency-icon">{{$singlePricing->currency_symbol}}</span>{{ formatIndianMoney($singlePricing->mrp) }}
                                                </p>
                                                <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                                    {{$singlePricing->discount}}% off
                                                </p>
                                            @endif
                                        </div>
                                    {{-- @endforeach --}}
                                @endif
                                {{-- <div class="mt-2 flex items-center gap-2">
                                    <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                        <span class="currency-symbol">₹</span>1,09,699
                                    </p>
                                    <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                        <span class="currency-symbol">₹</span>17,699
                                    </p>
                                    <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                        40% off
                                    </p>
                                </div> --}}
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="bg-white px-4 py-10 antialiased dark:bg-gray-900">
        <div class="mx-auto grid max-w-screen-xl rounded-lg bg-gray-50 p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 xl:gap-16">
            <div class="lg:col-span-5 lg:mt-0">
                <a href="#">
                    <svg class="mb-4 h-56 w-56 dark:hidden sm:h-96 sm:w-96 md:h-full md:w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M205.5-323.5H282q-.5-31.5-22.75-53.75T205.5-400v76.5Zm135.5 0h55q0-79.06-55.72-134.78T205.5-514v55q56.5.5 96 39.75T341-323.5Zm114 0h55q0-62.8-23.79-118.47t-65.18-97.06q-41.39-41.39-97.06-65.18Q268.3-628 205.5-628v55.11q103.8 0 176.65 72.7Q455-427.5 455-323.5ZM326-129v-79H165q-30.94 0-52.97-22.03Q90-252.06 90-283v-473q0-30.94 22.03-52.97Q134.06-831 165-831h630q30.94 0 52.97 22.03Q870-786.94 870-756v473q0 30.94-22.03 52.97Q825.94-208 795-208H634v79H326ZM165-283h630v-473H165v473Zm0 0v-473 473Z"/></svg>
                </a>
            </div>
            <div class="me-auto place-self-center lg:col-span-7">
                <h1 class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
                Save <span class="currency-symbol">₹</span>500 today on your purchase <br />
                of a new iMac computer.
                </h1>

                <p class="mb-6 text-gray-500 dark:text-gray-400">Reserve your new Apple iMac 27” today and enjoy exclusive savings with qualified activation. Pre-order now to secure your discount.</p>

                <a href="#" class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-5 py-3 text-center text-base font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900"> Pre-order now </a>
            </div>
        </div>
    </section>
    
</x-guest-layout>