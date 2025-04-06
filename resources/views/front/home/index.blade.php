<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Home') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 1</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 2</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 3</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 4</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 5</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 6</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 7</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 8</div>
              <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">Slide 9</div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <section class="bg-gray-50 mb-4 py-4 antialiased dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-2 sm:px-4">
            <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
            </div>

            <div class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="featured-products">

                @foreach ($featuredProducts as $featuredItem)
                <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 relative overflow-hidden">
                    <a href="#">
                        <div class="h-40 w-full">
                            @if (count($featuredItem->product->activeImages) > 0)
                                <div class="flex items-center justify-center h-full">
                                    <img src="{{ Storage::url($featuredItem->product->activeImages[0]->image_m) }}" alt="" class="max-w-full max-h-full">
                                </div>
                            @else
                                <div class="flex items-center justify-center h-full w-full">
                                    {!!FD['brokenImageFront']!!}
                                </div>
                            @endif
                        </div>

                        <div class="absolute top-0 right-0 w-full h-8 p-1 overflow-hidden">
                            <div class="flex justify-between items-center">
                                <div class="w-10 h-5 flex space-x-1 items-center bg-gray-50 px-1 border">
                                    <p class="{{FD['text-0']}} text-gray-900 font-bold">3.9</p>
                                    <div class="{{FD['iconClass']}} text-yellow-400 flex items-center">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"></path></svg>
                                    </div>
                                </div>

                                <button type="button" class="rounded-full w-6 h-6 p-1 hover:bg-gray-100 dark:hover:bg-gray-300">
                                    <div class="{{FD['iconClass']}} text-gray-500">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z" /></svg>
                                    </div>
                                </button>
                            </div>
                        </div>

                        <p class="font-semibold text-gray-900 hover:underline dark:text-gray-400 {{FD['text-0']}} sm:text-xs block leading-4 sm:leading-5 truncate">
                            {{ $featuredItem->product->title }}
                        </p>

                        @if (count($featuredItem->product->pricings) > 0)
                            @php
                                $singlePricing = $featuredItem->product->pricings[0];
                            @endphp
                            {{-- @foreach ($featuredItem->product->pricings as $singlePricing) --}}
                                <div class="mt-2 flex items-center gap-2">
                                    <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                        <span class="currency-icon">{{$singlePricing->currency_symbol}}</span>{{$singlePricing->selling_price}}
                                    </p>
                                    @if ($singlePricing->mrp != 0)
                                        <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                            <span class="currency-icon">{{$singlePricing->currency_symbol}}</span>{{$singlePricing->mrp}}
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

    <section class="bg-white px-4 py-10 antialiased dark:bg-gray-900">
        <div class="mx-auto grid max-w-screen-xl rounded-lg bg-gray-50 p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 lg:p-16 xl:gap-16">
            <div class="lg:col-span-5 lg:mt-0">
                <a href="#">
                    <img class="mb-4 h-56 w-56 dark:hidden sm:h-96 sm:w-96 md:h-full md:w-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-components.svg" alt="peripherals" />
                    <img class="mb-4 hidden dark:block md:h-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-components-dark.svg" alt="peripherals" />
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
    
</x-app-layout>