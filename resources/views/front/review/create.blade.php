<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Product') }}">

<div class="px-2 md:px-0">
    <div class="flex flex-col gap-2 md:gap-4">
        <header class="bg-gray-100 dark:bg-gray-900 {{ FD['rounded'] }}">
            {{-- Breadcrumb --}}
            <nav class="{{ FD['text-0'] }} text-gray-500 mt-2 mb-1" aria-label="breadcrumb">
                <ol class="flex items-center gap-2">
                    <li><a href="{{ route('front.home.index') }}" class="hover:underline text-gray-500 dark:text-gray-500">Home</a></li>
                    <li>/</li>
                    <li><a href="{{ route('front.product.detail', $product->slug) }}" class="hover:underline text-gray-500 dark:text-gray-500" title="{{ $product->title }}">{{ Str::limit($product->title, 25) }}</a></li>
                    <li>/</li>
                    <li><span class="text-gray-800 font-medium dark:text-gray-300">Create review</span></li>
                </ol>
            </nav>

            {{-- Title & Subtitle --}}
            <div class="grid grid-cols-1 items-center mt-2">
                <div class="lg:col-span-3">
                    <h1 class="text-sm md:text-lg font-extrabold leading-tight">Create review</h1>
                </div>
            </div>
        </header>

        <section class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-2 md:p-4 shadow-sm">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <a href="{{ route('front.product.detail', $product->slug) }}">
                        @if ($activeImagesCount > 0)
                            <div class="w-20 h-20 flex-shrink-0 {{ FD['rounded'] }} overflow-hidden border border-gray-100 dark:border-gray-800">
                            <img src="{{ Storage::url($images[0]->image_m) }}"
                                alt="Main product image"
                                class="w-full h-full object-cover transition-transform duration-300"
                                loading="lazy"
                                />
                            </div>
                        @else
                            <div class="w-16 h-16 flex-shrink-0 {{ FD['rounded'] }} overflow-hidden">
                                <div class="w-full h-full object-cover">
                                    {!! FD['brokenImageFront'] !!}
                                </div>
                            </div>
                        @endif
                    </a>

                    <div>
                        <a href="{{ route('front.product.detail', $product->slug) }}">
                            <h1 class="text-base font-semibold leading-tight">{{ $product->title }}</h1>
                        </a>

                        <!-- Price block -->
                        @if ( !empty($product->FDPricing) )
                            @php
                                $p = $product->FDPricing;
                                $currencySymbol = $p->country->currency_symbol;
                            @endphp

                            <div class="singleProdPricingBox">
                                <div class="flex items-baseline gap-2 my-2">
                                    <div class="mrpEl text-xl text-slate-500 dark:text-slate-400">
                                        <span class="line-through">
                                            <span class="currency-icon">{{ $currencySymbol }}</span><span class="mrpBox">{{ formatIndianMoney($p->mrp) }}</span>
                                        </span>
                                    </div>
                                    @if ($p->mrp > 0)
                                        <div class="sellingPriceEl text-sm font-bold">
                                            <span class="currency-icon">{{ $currencySymbol }}</span><span class="priceBox">{{ formatIndianMoney($p->selling_price) }}</span>
                                        </div>
                                    @endif
                                </div>
                                @if ($p->mrp > 0)
                                    <div class="savingsEl text-xs text-emerald-700 dark:text-emerald-300 font-bold mt-1">
                                        You save <span class="currency-icon">{{ $currencySymbol }}</span><span class="savingsBox">{{ formatIndianMoney($p->mrp - $p->selling_price) }}</span> 
                                        (<span class="discountBox">{{ $p->discount }}</span>% off)
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="mt-4">
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400 dark:text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12A9 9 0 1112 3a9 9 0 019 9z" /></svg>
                                    <h2 class="{{ FD['text-1'] }} text-slate-800 dark:text-slate-200">Pricing not available</h2>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-2 md:p-4 shadow-sm">
            <div class="w-full mt-2">
                <form action="{{ route('front.review.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="grid gap-4 mb-3 grid-cols-1 lg:grid-cols-2">
                        <div>
                            <x-front.input-label for="rating" :value="__('Rating *')" />
                            @include('layouts/front/includes/product-rating')
                            <x-front.input-error :messages="$errors->get('rating')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 mb-3 grid-cols-1 items-center">
                        <div>
                            <x-front.input-label for="title" :value="__('Title')" />
                            <x-front.text-input id="title" class="block" type="text" name="title" :value="old('title')" placeholder="Enter Title" />
                            <x-front.input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 mb-3 grid-cols-1 items-center">
                        <div>
                            <x-front.input-label for="review" :value="__('Review *')" />
                            <x-front.textarea id="review" class="block" type="text" name="review" :value="old('review')" placeholder="Enter Review" />
                            <x-front.input-error :messages="$errors->get('review')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-2 mb-3 grid-cols-1">
                        <div class="image-uploader-container space-y-4">
                            <div>
                                <x-front.input-label for="images" :value="__('Image')" />
                                <x-front.file-input-drag-drop id="images" class="h-12 images" name="images[]" accept="image/*" multiple />
                            </div>

                            @if ($errors->get('images.*'))
                                <div x-data="{open: false}">
                                    <p class="text-xs text-red-600 dark:text-orange-700 space-y-1">
                                        Some error occured. 
                                        <a href="javascript: void(0)" @click="open = !open">
                                            <strong><em>See details</em></strong>
                                        </a>
                                    </p>

                                    <div x-show="open" class="mt-2">
                                        @foreach ($errors->get('images.*') as $field => $messages)
                                            @foreach ($messages as $message)
                                                <x-front.input-error :messages="$message" class="" />
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="imagePreview"></div>
                        </div>
                    </div>

                    @if (auth()->guard('web')->check())
                        <div>
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="user_id" value="{{ auth()->guard('web')->user()->id }}">
                            <x-front.button
                                type="submit"
                                class="w-full md:w-32"
                                element="button">
                                @slot('icon')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M840-680v480q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160Zm-80 34L646-760H200v560h560v-446ZM480-240q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35ZM240-560h360v-160H240v160Zm-40-86v446-560 114Z"/></svg>
                                @endslot
                                {{ __('Submit') }}
                            </x-front.button>
                        </div>
                    @else
                        <section class="w-full flex items-center justify-center">
                            <div class="w-full text-center border border-slate-200 dark:border-slate-700 p-2 md:p-4 {{ FD['rounded'] }} bg-gray-100 dark:bg-slate-900 shadow-sm">
                                <div class="mb-2 md:mb-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-6 w-6 md:h-12 md:w-12 text-slate-400 dark:text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12A9 9 0 1112 3a9 9 0 019 9z" /></svg>
                                </div>

                                <h2 class="{{ FD['text-2'] }} font-semibold text-slate-800 dark:text-slate-200">You cannot post your feedback yet</h2>

                                <p class="mt-2 {{ FD['text'] }} text-slate-600 dark:text-slate-400">
                                    You must be logged in to post a review.<br> Please log in to share your feedback.
                                </p>

                                <div class="mt-4">
                                    <a 
                                        href="{{ route('front.login', ['redirect' => url()->current()]) }}" 
                                        class="inline-flex items-center justify-center {{ FD['rounded'] }} bg-amber-500 px-4 py-2 text-sm md:text-base font-medium text-white shadow hover:bg-amber-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-400 transition"
                                        >
                                        Login to Continue
                                    </a>
                                </div>
                            </div>
                        </section>
                    @endif
                </form>
            </div>
        </section>
    </div>
</div>

</x-guest-layout>