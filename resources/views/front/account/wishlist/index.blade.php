<x-app-layout
    screen="max-w-screen-xl"
    title="{{ __('Wishlist') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="pt-4 sm:pt-6 px-2 sm:px-2 md:px-3 lg:px-4 xl:px-4 2xl:px-0">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white sm:text-lg">Wishlist</h2>

            @include('layouts.front.global-alert')

            <div class="mt-4 sm:mt-6 md:gap-6 lg:flex lg:items-start xl:gap-8">
                {{-- left part --}}
                @include('front.account.includes.account-overview')

                {{-- right part - order summary --}}
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">

                    @include('front.account.includes.navbar')

                    <div class="bg-white dark:bg-gray-800 p-4 mb-5">
                        <div>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                                @forelse ($data as $wishlistData)
                                    <div class="{{FD['rounded']}} border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 relative overflow-hidden">
                                        <a href="{{ $saved_item->product_url_with_variation ? $saved_item->product_url_with_variation : $saved_item->product_url }}">
                                            <div class="h-40 w-full">
                                                @if (count($saved_item->product->activeImages) > 0)
                                                    <div class="flex items-center justify-center h-full">
                                                        <img src="{{ Storage::url($saved_item->product->activeImages[0]->image_m) }}" alt="" class="max-w-full max-h-full">
                                                    </div>
                                                @else
                                                    <div class="flex items-center justify-center h-full w-full">
                                                        {!!FD['brokenImageFront']!!}
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="absolute top-0 right-0 w-full h-8 p-1 overflow-hidden">
                                                <div class="flex justify-between items-center">
                                                    @if ($saved_item->product->average_rating > 0)
                                                        {!! frontRatingHtml($saved_item->product->average_rating) !!}
                                                    @endif

                                                    <button type="button" class="rounded-full w-6 h-6 p-1 hover:bg-gray-100 dark:hover:bg-gray-300">
                                                        <div class="{{FD['iconClass']}} text-gray-500">
                                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z" /></svg>
                                                        </div>
                                                    </button>
                                                </div>
                                            </div>

                                            <p class="font-semibold text-gray-900 hover:underline dark:text-gray-300 {{FD['text-0']}} sm:text-xs inline-block leading-4 sm:leading-5 truncate">
                                                {{ $saved_item->product_title }}
                                            </p>

                                            <p class="text-gray-500 dark:text-gray-400 {{FD['text-0']}} block -mt-2">
                                                {{ $saved_item->variation_attributes }}
                                            </p>

                                            <div class="mt-2 flex items-center gap-2">
                                                <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                                    <span class="currency-icon">{{COUNTRY['icon']}}</span> {{ formatIndianMoney($saved_item->selling_price) }}
                                                </p>
                                                @if ($saved_item->mrp != 0)
                                                    <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                                        <span class="currency-icon">{{COUNTRY['icon']}}</span>{{ formatIndianMoney($saved_item->mrp) }}
                                                    </p>
                                                    <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                                        {{discountPercentageCalc($saved_item->selling_price, $saved_item->mrp)}}% off
                                                    </p>
                                                @endif
                                            </div>

                                            {{-- @if (count($saved_item->product->pricings) > 0)
                                                @php
                                                    $singlePricing = $saved_item->product->pricings[0];
                                                @endphp

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
                                            @endif --}}
                                        </a>

                                        <div class="flex gap-2 mt-3">
                                            <button class="flex-1 basis-[70%] {{ FD['rounded'] }} {{ FD['text-0'] }} bg-primary-700 dark:bg-primary-600 hover:bg-primary-800 dark:hover:bg-primary-700 p-1 text-gray-100"
                                                wire:click="moveItemToCart({{ $saved_item->id }})">
                                                Move to cart
                                            </button>

                                            <button class="basis-[30%] {{ FD['rounded'] }} {{ FD['text-0'] }} bg-orange-700 dark:bg-orange-600 hover:bg-orange-800 dark:hover:bg-orange-700 p-1 text-gray-100"
                                                wire:click="deleteItem({{ $saved_item->id }})">
                                                Remove
                                            </button>
                                        </div>

                                    </div>
                                @empty
                                    <div class="col-span-4 {{FD['rounded']}} bg-white p-2 shadow-sm dark:bg-gray-800 md:p-4">
                                        <div class="w-full text-center">
                                            <img src="{{ Storage::url('public/default/cart/undraw_web-shopping_m3o2.svg') }}" alt="empty-cart" class="w-72 m-auto mb-6">

                                            <h5 class="block text-base leading-tight font-bold text-gray-900 dark:text-gray-300 mb-4">
                                                No items here!
                                            </h5>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @include('layouts.front.includes.confirm-address-delete')
</x-app-layout>
