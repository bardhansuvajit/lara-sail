<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Product') }}">

<div class="px-2 md:px-0 pt-2 md:pt-4">
    @php
        // If there are no product images stretch the height of Left & Right section
        if ($activeImagesCount > 0) {
            $itemsClass = "items-start";
        } else {
            $itemsClass = "items-stretch";
        }
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-2 md:gap-4 {{ $itemsClass }}">
        <!-- Left: Images + thumbnails -->
        <div class="lg:col-span-5 bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-2 md:p-4 shadow-sm md:sticky md:top-[130px] md:mb-4">
            @if ($activeImagesCount > 0)
                @php
                    $images = $product->activeImages;
                @endphp

                <div class="flex flex-col gap-2 md:gap-4">
                    <!-- Main image area (wrapper is relative for lens) -->
                    <div id="mainImageWrapper" class="relative {{ FD['rounded'] }} overflow-hidden border dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                        <div class="aspect-w-4 aspect-h-3 {{ FD['rounded'] }} overflow-hidden">
                            <img id="mainImage" src="{{ Storage::url($images[0]->image_l) }}"
                                alt="Main product image"
                                class="w-full h-72 object-scale-down transition-transform duration-300"
                                draggable="false" />
                        </div>

                        <!-- zoom / gallery -->
                        <button id="openGallery" class="absolute right-3 top-3 p-2 {{ FD['rounded'] }} bg-white/80 dark:bg-slate-800/80 hover:shadow text-xs" aria-label="Open gallery">🔍 View</button>

                        <!-- lens (created hidden; shown on hover) -->
                        <div id="imgLens" class="hidden pointer-events-none absolute {{ FD['rounded'] }} border border-slate-200 dark:border-slate-700 bg-white/10 mix-blend-normal" aria-hidden="true"></div>
                    </div>

                    @if ($activeImagesCount > 1)
                        <!-- Thumbnails (bottom) -->
                        <div class="flex items-center gap-2">
                            <div id="thumbs" class="flex gap-2 overflow-x-auto no-scrollbar md:py-1">
                                @foreach ($images as $i => $img)
                                    <button
                                        type="button"
                                        class="thumb-item flex-none w-20 h-16 sm:w-24 sm:h-20 {{ FD['rounded'] }} overflow-hidden border dark:border-slate-700 focus:outline-none transition-all"
                                        data-img="{{ Storage::url($img->image_l) }}"
                                        aria-label="View image {{ $i+1 }}">
                                            <img src="{{ Storage::url($img->image_s) }}" alt="Thumb {{ $i+1 }}" class="w-full h-full object-scale-down transition-all" loading="lazy" />
                                    </button>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Image Zoom Pane -->
                {{-- <div id="zoomPane" class="hidden lg:block {{ FD['rounded'] }} overflow-hidden shadow-lg" style="position:fixed; z-index:10; display:none; background-repeat:no-repeat; background-position:center; background-color:#fff;" aria-hidden="true"></div> --}}
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-500">
					{!! str_replace('w-32 h-32', 'w-96 h-96', FD['brokenImageFront']) !!}
				</div>
            @endif
        </div>

        <!-- Right: Product Info & Actions -->
        <div class="lg:col-span-7 flex flex-col gap-4 md:mb-4">
            <div class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-2 md:p-4 shadow-sm space-y-2 md:space-y-4">
                <div class="flex items-start justify-between gap-2 md:gap-4">
                    <div class="flex-1 space-y-2">
                        <!-- Breadcrumb -->
                        <nav class="{{ FD['text-0'] }} text-gray-500" aria-label="breadcrumb">
                            <ol class="flex items-center gap-2 flex-wrap">
                                <li><a href="{{ route('front.home.index') }}" class="hover:underline text-gray-500 dark:text-gray-500">Home</a></li>

                                <!-- Category parents -->
                                @php
                                    $category = $product->category;
                                    $ancestors = collect([]);
                                    $current = $category->parentDetails;
                                    while ($current) {
                                        $ancestors->prepend($current);
                                        $current = $current->parentDetails;
                                    }
                                @endphp

                                @foreach ($ancestors as $parent)
                                    <li>/</li>
                                    <li>
                                        <a href="{{ route('front.category.detail', $parent->slug) }}" class="hover:underline text-gray-500 dark:text-gray-500" title="{{ $parent->title }}">
                                            {{ Str::limit($parent->title, 20) }}
                                        </a>
                                    </li>
                                @endforeach

                                <!-- Current category -->
                                <li>/</li>
                                <li>
                                    <a href="{{ route('front.category.detail', $category->slug) }}" class="hover:underline text-gray-500 dark:text-gray-500" title="{{ $category->title }}">
                                        {{ Str::limit($category->title, 20) }}
                                    </a>
                                </li>

                                <li>/</li>
                                <li><span class="text-gray-800 font-medium dark:text-gray-300" title="{{ $product->title }}">{{ Str::limit($product->title, 25) }}</span></li>
                            </ol>
                        </nav>

                        <!-- Title -->
                        <h1 class="text-base sm:text-xl font-semibold leading-tight">{{ $product->title }}</h1>

                        <!-- Rating -->
                        @if ($product->average_rating > 0 || $product->review_count > 0)
                            <div class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-300">
                                @if ($product->average_rating > 0)
                                    <span class="flex items-center gap-1">
                                        {!! frontRatingHtml($product->average_rating) !!}
                                    </span>
                                @endif

                                @if ($product->review_count > 0)
                                    <span>{{ $product->review_count.' '.( number_format($product->review_count) > 1 ? 'reviews' : 'review' ) }}</span>
                                @endif

                                {{-- <span>·</span>
                                <span class="text-slate-400 dark:text-slate-400">By <strong>@php echo htmlspecialchars($product['brand']) @endphp</strong></span> --}}
                            </div>
                        @endif

                        <!-- Badge -->
                        @if (count($product->badges) > 0)
                            <div class="flex items-center gap-2 my-4">
                                @foreach ($product->badges as $badge)
                                    @php
                                        $badge = $badge->badgeDetail;
                                    @endphp
                                    <span class="px-3 py-1 {{ FD['rounded'] }} text-xs font-semibold shadow-sm {{ $badge->tailwind_classes }}">{{ $badge->icon.' '.$badge->title }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Wishlist / share -->
                    <div class="flex flex-col items-end gap-2">
                        <div>
                            <button class="p-2 rounded-full focus:outline-none wishlist-btn" data-prod-id="{{$product->id}}">
                                <svg class="transition-all duration-300 ease-in-out w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path class="transition-all duration-300 ease-in-out" d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Short Description -->
                @if ($product->short_description)
                    <p class="text-xs text-gray-500 dark:text-gray-400/70 description-wrapper">{!! nl2br($product->short_description) !!}</p>
                @endif

                <!-- Price block -->
		        @if ( !empty($product->FDPricing) )
                    @php
                        $p = $product->FDPricing;
                        $currencySymbol = $p->country->currency_symbol;
                    @endphp

                    <div class="flex items-center">
                        <div>
                            <div id="sellingPriceEl" class="text-xl sm:text-2xl font-bold">
                                <span class="currency-icon">{{ $currencySymbol }}</span><span id="priceBox">{{ formatIndianMoney($p->selling_price) }}</span>
                            </div>
                            <div id="mrpEl" class="text-xs text-slate-500 dark:text-slate-400">
                                <span class="line-through">
                                    <span class="currency-icon">{{ $currencySymbol }}</span><span id="mrpBox">{{ formatIndianMoney($p->mrp) }}</span>
                                </span>
                            </div>
                            <div id="savingsEl" class="text-xs text-emerald-700 dark:text-emerald-300 font-bold mt-1">
                                You save <span class="currency-icon">{{ $currencySymbol }}</span><span id="savingsBox">{{ formatIndianMoney($p->mrp - $p->selling_price) }}</span> 
                                (<span id="discountBox">{{ $p->discount }}</span>% off)
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Variations -->
                {{-- {{ dd($variation['data']) }} --}}
                @if ($variation['code'] == 200)
                    <div class="space-y-4" id="variationTab">
                        @foreach ($variation['data']['attributes'] as $attrIndex => $attribute)
                            <div>
                                <h3 class="{{FD['text-1']}} font-semibold mb-2 dark:text-gray-500">
                                    {{ $attribute['title'] }}
                                </h3>

                                <div class="w-full grid grid-cols-4 lg:grid-cols-6 gap-4">
                                    @foreach ($attribute['values'] as $valueIndex => $value)
                                        <x-front.radio-input-button 
                                            id="attr{{$attrIndex}}{{$valueIndex}}" 
                                            name="variation-{{ $attribute['slug'] }}" 
                                            value="{{ $value['slug'] }}" 
                                            class="attr-val-generate" 
                                            data-attr-slug="{{ $attribute['slug'] }}"
                                            data-value-slug="{{ $value['slug'] }}"
                                            data-attr-id="{{ $attribute['id'] }}"
                                            data-value-id="{{ $value['id'] }}"
                                            :checked="$valueIndex == 0"
                                        >
                                            <div class="text-center">
                                                <div class="flex flex-col items-center gap-2">
                                                    <div>
                                                        <div class="{{FD['text']}} font-semibold">{{ $value['title'] }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </x-front.radio-input-button>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($status->slug == "limited")
                    <div class="text-end">
                        <p class="{{ FD['text-1'] }} font-semibold text-red-600 bg-red-100 px-3 py-1 rounded-md inline-block dark:text-red-400 dark:bg-red-900/30">
                            Hurry! Only a few items left
                        </p>
                    </div>
                @endif

                <!-- Quantity & Cart Actions -->
                @if ( !empty($product->FDPricing) && ($status->allow_order == 1) )
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 w-full">
                        <!-- Qty block -->
                        <div class="flex items-start sm:items-center gap-3">
                            <div>
                                <div
                                    id="qtyGroup"
                                    class="inline-flex items-stretch {{ FD['rounded'] }} overflow-hidden border border-gray-300 dark:border-gray-600"
                                    role="group"
                                    aria-label="Quantity selector"
                                    data-max-stock="12"
                                    data-min-qty="1"
                                    data-step="1"
                                    data-product-id="{{ $product->id ?? '' }}"
                                >
                                    <button
                                        id="qtyDec"
                                        type="button"
                                        class="w-9 h-9 flex items-center justify-center {{ FD['text-1'] }} focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 disabled:opacity-50"
                                        aria-label="Decrease quantity"
                                        title="Decrease quantity"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor" class="w-4 h-4" aria-hidden="true"><path d="M200-440v-80h560v80H200Z"/></svg>
                                    </button>

                                    <!-- readonly input: user cannot type; only buttons change value -->
                                    <input
                                        id="qtyInput"
                                        type="text"
                                        inputmode="numeric"
                                        pattern="\d*"
                                        aria-live="polite"
                                        aria-label="Quantity"
                                        role="spinbutton"
                                        aria-valuemin="1"
                                        aria-valuemax="99"
                                        aria-valuenow="1"
                                        value="1"
                                        readonly
                                        aria-readonly="true"
                                        class="w-20 sm:w-16 text-center {{ FD['text-1'] }} bg-white dark:bg-slate-800 outline-none border-l border-r border-transparent focus:outline-none focus:ring-0 px-2 cursor-default"
                                        style="min-width:3.5rem;"
                                        tabindex="0"
                                    />

                                    <button
                                        id="qtyInc"
                                        type="button"
                                        class="w-9 h-9 flex items-center justify-center {{ FD['text-1'] }} focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 disabled:opacity-50"
                                        aria-label="Increase quantity"
                                        title="Increase quantity"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor" class="w-4 h-4" aria-hidden="true"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                                    </button>
                                </div>

                                <div id="stockHelper" class="mt-2 ml-1 text-xs text-slate-500 dark:text-slate-400" aria-live="polite"></div>
                            </div>
                        </div>

                        <div class="flex-1 flex gap-2 w-full sm:w-auto justify-end items-center">
                            <button
                                id="addToCart"
                                type="button"
                                class="flex-1 sm:flex-none px-4 py-2 {{ FD['rounded'] }} bg-amber-600 hover:bg-amber-700 text-white font-semibold {{ FD['text-1'] }} inline-flex items-center justify-center disabled:opacity-50 transition-shadow add-to-cart"
                                aria-label="Add to cart"
                                data-prod-id="{{$product->id}}" 
                                data-purchase-type="cart"
                                data-variation-data="{{ json_encode($variation['data']) }}"
                            >
                            <span class="mr-2 inline-flex items-center" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor" class="w-4 h-4"><path d="M289.42-105.77q-28.14 0-47.88-19.7-19.73-19.7-19.73-47.84 0-28.15 19.7-47.88 19.7-19.73 47.84-19.73 28.14 0 47.88 19.7 19.73 19.7 19.73 47.84 0 28.14-19.7 47.88-19.7 19.73-47.84 19.73Zm380.42 0q-28.14 0-47.88-19.7-19.73-19.7-19.73-47.84 0-28.15 19.7-47.88 19.7-19.73 47.84-19.73 28.15 0 47.88 19.7 19.73 19.7 19.73 47.84 0 28.14-19.7 47.88-19.7 19.73-47.84 19.73ZM242.23-729.19l101.39 212.31h268.65q3.46 0 6.15-1.74 2.7-1.73 4.62-4.8l107.31-195q2.3-4.23.38-7.5-1.92-3.27-6.54-3.27H242.23Zm-27.15-55.96h544.57q24.35 0 36.52 20.41 12.17 20.42.98 41.51l-124.92 226.5q-9.04 16.81-25.1 26.31-16.06 9.5-34.52 9.5H325.62l-47.12 86.23q-3.08 4.61-.19 10 2.88 5.38 8.65 5.38H709.5q11.43 0 19.66 8.23 8.22 8.22 8.22 19.66 0 11.65-8.22 19.86-8.23 8.21-19.66 8.21H289.32q-38.71 0-58.38-33.07t-1.48-66.27l57.08-101.63-143.92-303.26H96.15q-11.65 0-19.86-8.21-8.21-8.21-8.21-19.77 0-11.56 8.21-19.77 8.21-8.21 19.86-8.21h60.5q9.89 0 17.87 5.27t12.4 14.12l28.16 59Zm128.54 268.27h275.96-275.96Z"/></svg>
                            </span>
                            Add to Cart
                            </button>

                            <button
                                id="buyNow"
                                type="button"
                                class="px-4 py-2 {{ FD['rounded'] }} border border-amber-600 text-amber-600 dark:text-amber-300 {{ FD['text-1'] }} font-semibold  add-to-cart"
                                aria-label="Buy now"
                                {{-- data-action="buy-now" --}}
                                data-prod-id="{{$product->id}}" 
                                data-purchase-type="cart"
                                data-variation-data="{{ json_encode($variation['data']) }}"
                            >
                            Buy Now
                            </button>
                        </div>
                    </div>
                @else
                    @php
                        $bgColor = $status->bg_tailwind_classes;
                        $mainColor = $status->title_tailwind_classes;
                        $descColor = $status->description_tailwind_classes;
                        $emailNotify = $status->notify_by_email;
                        if ($emailNotify) {
                            $sectionClasses = "items-center p-2 $bgColor";
                        } else {
                            $sectionClasses = "items-start";
                        }
                    @endphp

                    <div class="flex flex-col gap-1 {{ $sectionClasses }}">
                        <h5 class="text-2xl font-semibold flex items-center gap-2 {{ $mainColor }}">
                            <div class="w-6 h-6 {{ $mainColor }}">{!! $status->icon !!}</div>
                            {{ $status->title_frontend }}
                        </h5>

                        <p class="{{ FD['text-1'] }} {{ $descColor }}">
                            {{ $status->description_frontend }}
                        </p>

                        @if ($emailNotify)
                            <div class="my-4">
                                @livewire('product-interest-form', [
                                    'product_id' => $product->id,
                                    'product_variation_id' => null,
                                ])
                            </div>
                        @endif
                    </div>
                @endif

                <hr class="mt-5 mb-2 dark:border-gray-600">

                <!-- productBadges -->
                <div id="productBadges" class="">
                    <div class="grid grid-cols-4 gap-2 md:gap-4">
                        <!-- Badge: Delivery -->
                        <div role="listitem" class="flex flex-col items-center text-center p-3 bg-white dark:bg-slate-800 {{ FD['rounded'] }} shadow-sm">
                            <div class="w-8 h-8 flex items-center justify-center mb-2 text-gray-600 dark:text-gray-300" aria-hidden="true">
                                <!-- truck icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M280-160q-50 0-85-35t-35-85H60l18-80h113q17-19 40-29.5t49-10.5q26 0 49 10.5t40 29.5h167l84-360H182l4-17q6-28 27.5-45.5T264-800h456l-37 160h117l120 160-40 200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H400q0 50-35 85t-85 35Zm357-280h193l4-21-74-99h-95l-28 120Zm-19-273 2-7-84 360 2-7 34-146 46-200ZM20-427l20-80h220l-20 80H20Zm80-146 20-80h260l-20 80H100Zm180 333q17 0 28.5-11.5T320-280q0-17-11.5-28.5T280-320q-17 0-28.5 11.5T240-280q0 17 11.5 28.5T280-240Zm400 0q17 0 28.5-11.5T720-280q0-17-11.5-28.5T680-320q-17 0-28.5 11.5T640-280q0 17 11.5 28.5T680-240Z"/></svg>
                            </div>
                            <h5 class="text-xs font-medium text-gray-800 dark:text-gray-100">Delivery</h5>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Standard delivery
                            </p>
                        </div>

                        <!-- Badge: Cash on Delivery -->
                        <div role="listitem" class="flex flex-col items-center text-center p-3 bg-white dark:bg-slate-800 {{ FD['rounded'] }} shadow-sm">
                            <div class="w-8 h-8 flex items-center justify-center mb-2 text-gray-600 dark:text-gray-300" aria-hidden="true">
                                @if (COUNTRY['currency'] == 'INR')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M549-120 280-400v-80h140q53 0 91.5-34.5T558-600H240v-80h306q-17-35-50.5-57.5T420-760H240v-80h480v80H590q14 17 25 37t17 43h88v80h-81q-8 85-70 142.5T420-400h-29l269 280H549Z"/></svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M441-120v-86q-53-12-91.5-46T293-348l74-30q15 48 44.5 73t77.5 25q41 0 69.5-18.5T587-356q0-35-22-55.5T463-458q-86-27-118-64.5T313-614q0-65 42-101t86-41v-84h80v84q50 8 82.5 36.5T651-650l-74 32q-12-32-34-48t-60-16q-44 0-67 19.5T393-614q0 33 30 52t104 40q69 20 104.5 63.5T667-358q0 71-42 108t-104 46v84h-80Z"/></svg>
                                @endif
                            </div>
                            <h5 class="text-xs font-medium text-gray-800 dark:text-gray-100">Cash on Delivery</h5>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                Available in many pin codes — select at checkout
                            </p>
                        </div>

                        <!-- Badge: Easy Returns -->
                        <div role="listitem" class="flex flex-col items-center text-center p-3 bg-white dark:bg-slate-800 {{ FD['rounded'] }} shadow-sm">
                            <div class="w-8 h-8 flex items-center justify-center mb-2 text-gray-600 dark:text-gray-300" aria-hidden="true">
                                <!-- return icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M440-122q-121-15-200.5-105.5T160-440q0-66 26-126.5T260-672l57 57q-38 34-57.5 79T240-440q0 88 56 155.5T440-202v80Zm80 0v-80q87-16 143.5-83T720-440q0-100-70-170t-170-70h-3l44 44-56 56-140-140 140-140 56 56-44 44h3q134 0 227 93t93 227q0 121-79.5 211.5T520-122Z"/></svg>
                            </div>
                            <h5 class="text-xs font-medium text-gray-800 dark:text-gray-100">Easy Returns</h5>
                            <p class="text-xs text-gray-500 dark:text-gray-400">7-day hassle-free returns on eligible items</p>
                        </div>

                        <!-- Badge: Secure Payments -->
                        <div role="listitem" class="flex flex-col items-center text-center p-3 bg-white dark:bg-slate-800 {{ FD['rounded'] }} shadow-sm">
                            <div class="w-8 h-8 flex items-center justify-center mb-2 text-gray-600 dark:text-gray-300" aria-hidden="true">
                                <!-- shield icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-113.23q-6 0-11.64-1-5.64-1-10.9-3-124.31-44.5-197.25-156.5t-72.94-242.5v-177.19q0-21.37 12.37-38.71t31.9-25.02L456-841.34q12.1-4.43 24-4.43t24.19 4.43l224.46 84.19q19.34 7.68 31.71 25.02 12.37 17.34 12.37 38.71v177.19q0 130.5-72.94 242.5t-197.06 156.5q-5.45 2-11.09 3t-11.64 1Z"/></svg>
                            </div>
                            <h5 class="text-xs font-medium text-gray-800 dark:text-gray-100">Secure Payments</h5>
                            <p class="text-xs text-gray-500 dark:text-gray-400">SSL encrypted • Trusted payment gateways</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-4">
        <!-- UPSELL -->
        @if (count($upsells) > 0)
            <div class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-4 shadow-sm">
                <div class="flex items-start justify-between mb-3">
                    <h3 class="{{ FD['text-1'] }} font-semibold">Frequently bought together</h3>

                    {{-- Top-level CTAs --}}
                    <div class="flex gap-2 items-center">
                        <button
                            type="button"
                            id="buy-together"
                            class="inline-flex items-center text-xs font-medium px-3 py-1.5 {{ FD['rounded'] }} shadow-sm bg-sky-600 text-white hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-400"
                            aria-label="Buy these items together"
                            data-action="buy-together"
                        >
                            Buy together
                        </button>

                        <button
                            type="button"
                            id="add-selected"
                            class="inline-flex items-center text-xs font-medium px-3 py-1.5 {{ FD['rounded'] }} border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-300"
                            aria-label="Add selected upsells to cart"
                            data-action="add-selected"
                        >
                            Add selected
                        </button>
                    </div>
                </div>

                <div class="flex gap-3 overflow-x-auto no-scrollbar py-1 items-start">
                    {{-- Base product card (same height as upsells) --}}
                    <div class="flex-shrink-0 w-40 p-2 border dark:border-slate-700 {{ FD['rounded'] }} bg-white dark:bg-slate-900 h-64 flex flex-col justify-between">
                        <div class="relative">
                            <img src="https://dummyimage.com/800x600/eeeeee/888888&text=First+image"
                                alt="Base product title and some other texts"
                                class="w-full h-32 object-cover {{ FD['rounded'] }}"/>

                            {{-- Optional discount badge for base product (if you want) --}}
                            @php
                                $base_mrp = $product['mrp'] ?? null;
                                $base_price = $product['price'] ?? 2000;
                                $base_discount = ($base_mrp && $base_mrp > $base_price) ? round((($base_mrp - $base_price) / $base_mrp) * 100) : 0;
                            @endphp

                            @if($base_discount > 0)
                                <div class="absolute top-2 left-2 text-xs font-semibold px-2 py-0.5 rounded-full bg-rose-600 text-white">
                                    {{ $base_discount }}% OFF
                                </div>
                            @endif
                        </div>

                        <div class="mt-2">
                            <div class="text-xs font-medium line-clamp-2">Base product title and some other texts</div>

                            <div class="mt-1 flex items-end gap-2">
                                @if(isset($base_mrp) && $base_mrp > 0)
                                    <div class="text-xs text-slate-400 line-through">@php echo $product['currency'] . number_format($base_mrp,2) @endphp</div>
                                @endif

                                <div class="{{ FD['text-1'] }} font-semibold">@php echo $product['currency'] . number_format($base_price,2) @endphp</div>
                            </div>
                        </div>

                        <div class="mt-2 flex gap-2">
                            <button
                                type="button"
                                class="flex-1 text-xs font-medium px-2 py-1 {{ FD['rounded'] }} bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400"
                                aria-label="Add base product to cart"
                                data-product-id="{{ $product['id'] ?? '' }}"
                                data-action="add-to-cart"
                            >
                                Add
                            </button>

                            <button
                                type="button"
                                class="text-xs px-2 py-1 {{ FD['rounded'] }} border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 focus:outline-none"
                                aria-label="View base product"
                                data-action="view-product"
                                data-product-id="{{ $product['id'] ?? '' }}"
                            >
                                View
                            </button>
                        </div>
                    </div>

                    {{-- Plus icon --}}
                    <div class="flex items-center self-center">
                        <div class="w-8 h-8 flex items-center justify-center text-slate-600 dark:text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor" class="w-6 h-6">
                                <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Upsell cards (equal height) --}}
                    @foreach($upsells as $u)
                        @php
                            $mrp = $u['mrp'] ?? ($u['price'] > 0 ? round($u['price'] * 1.15) : 0);
                            $price = $u['price'] ?? 0;
                            $discount = ($mrp && $mrp > $price) ? round((($mrp - $price) / $mrp) * 100) : 0;
                            $upsell_id = $u['id'] ?? $u['sku'] ?? $u['title'];
                        @endphp

                        <div class="flex-shrink-0 w-40 p-2 border dark:border-slate-700 {{ FD['rounded'] }} bg-white dark:bg-slate-900 h-64 flex flex-col justify-between">
                            <div class="relative">
                                <img src="{{ $u['img'] }}" alt="{{ $u['title'] }}" class="w-full h-32 object-cover {{ FD['rounded'] }}"/>

                                @if($discount > 0)
                                    <div class="absolute top-2 left-2 text-xs font-semibold px-2 py-0.5 rounded-full bg-rose-600 text-white">
                                        {{ $discount }}% OFF
                                    </div>
                                @endif

                                <label class="absolute top-2 right-2 inline-flex items-center">
                                    <input
                                        type="checkbox"
                                        name="upsell_selected[]"
                                        value="{{ $upsell_id }}"
                                        class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 focus:ring-2 focus:ring-sky-300"
                                        aria-label="Select {{ $u['title'] }} to add"
                                        data-upsell-id="{{ $upsell_id }}"
                                    />
                                </label>
                            </div>

                            <div class="mt-2">
                                <div class="text-xs font-medium line-clamp-2">{{ $u['title'] }}</div>

                                <div class="mt-1 flex items-baseline gap-2">
                                    @if($mrp && $mrp > 0)
                                        <div class="text-xs text-slate-400 line-through">@php echo $product['currency'] . number_format($mrp,2) @endphp</div>
                                    @endif

                                    <div class="{{ FD['text-1'] }} font-semibold">@php echo $product['currency'] . number_format($price,2) @endphp</div>
                                </div>
                            </div>

                            <div class="mt-2 flex gap-2">
                                <button
                                    type="button"
                                    class="flex-1 text-xs font-medium px-2 py-1 rounded {{ FD['rounded'] }} bg-sky-600 text-white hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-400"
                                    aria-label="Add {{ $u['title'] }} to cart"
                                    data-upsell-id="{{ $upsell_id }}"
                                    data-action="add-to-cart"
                                >
                                    Add
                                </button>

                                <button
                                    type="button"
                                    class="text-xs px-2 py-1 rounded {{ FD['rounded'] }} border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 focus:outline-none"
                                    aria-label="View {{ $u['title'] }}"
                                    data-upsell-id="{{ $upsell_id }}"
                                    data-action="view-product"
                                >
                                    View
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Description, Reviews, FAQs, CTA -->
        <section id="pdp-description" class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-4 shadow-sm">
            <div class="mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <div class="lg:col-span-8 space-y-6">
                        <div class="space-y-4">
                            <!-- Highlight -->
                            @if ($highlights && count($highlights) > 0)
                                <div id="highlights">
                                    <x-front.product-detail-block-header
                                        title="Highlights"
                                    />

                                    <div>
                                        @foreach($highlights as $highlight)
                                            <div class="flex items-center justify-between py-1 dark:hover:bg-gray-800/40">
                                                <div class="flex items-center gap-2">
                                                    <span class="{{ FD['iconClass'] }}">{!! $highlight->icon !!}</span>
                                                    <div>
                                                        <p class="font-medium text-gray-800 dark:text-gray-300 text-xs">{{ $highlight->title }}</p>
                                                        <p class="text-xs text-gray-600 dark:text-gray-400">{{ $highlight->description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <hr class="dark:border-gray-600">
                            @endif

                            <!-- Long Description -->
                            @if ($product->long_description)
                                <div id="long-description">
                                    <x-front.product-detail-block-header
                                        title="Description"
                                    />

                                    <div class="text-xs leading-tight">
                                        {!! nl2br($product->long_description) !!}
                                    </div>
                                </div>

                                <hr class="dark:border-gray-600">
                            @endif

                            <!-- Faq -->
                            @if ($faqs && count($faqs) > 0)
                                <div id="faqs" class="scroll-mt-20">
                                    {{-- <header class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-4">
                                        <div>
                                            <h2 class="{{ FD['text-1'] }} font-semibold">Frequently asked questions</h2>
                                            <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">{{ count($faqs) }} questions answered</p>
                                        </div>

                                        <div class="flex items-center gap-3">
                                            <div class="relative">
                                                <div class="absolute z-1 inset-y-0 flex items-center pointer-events-none start-0 ps-3">
                                                    <svg class="w-3 h-3 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path></svg>
                                                </div>

                                                <input type="search" id="default-search" value="{{ request()->input('q') }}" class="block w-full px-1 py-2 {{FD['text']}} text-gray-900 border border-gray-100 {{FD['rounded']}} ps-8 bg-gray-100 focus:ring-primary-500 focus:border-primary-500  dark:bg-gray-700 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search FAQs..." autocomplete="off">
                                            </div>

                                            <!-- Sort Dropdown -->
                                            <div class="relative">
                                                <select id="faq-sort" class="appearance-none pl-3 pr-8 py-2 {{ FD['text-1'] }} border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 cursor-pointer">
                                                    <option value="most-helpful">Most Helpful</option>
                                                    <option value="newest">Newest First</option>
                                                    <option value="oldest">Oldest First</option>
                                                    <option value="most-viewed">Most Viewed</option>
                                                </select>
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                                    <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </header> --}}

                                    <x-front.product-detail-block-header
                                        title="Frequently asked questions"
                                        subtitle="{{ count($faqs) }} questions answered"
                                    />

                                    <!-- FAQ List -->
                                    <div class="space-y-3" id="faq-list">
                                        @foreach($faqs as $index => $faq)
                                            <article class="p-3 border dark:border-slate-700 {{ FD['rounded'] }} mb-3">
                                            {{-- <article class="@if (!$loop->last) border-b border-gray-200/50 dark:border-gray-700/50 @endif"> --}}
                                                <p class="font-semibold {{ FD['text'] }} text-slate-800 dark:text-white">
                                                    {{ $faq->question }}
                                                </p>

                                                <!-- Helpfulness Badge -->
                                                {{-- <div class="flex items-center gap-3">
                                                    @if($faq->helpful_yes + $faq->helpful_no > 0)
                                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                                            {{ $faq->helpful_score >= 70 ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 
                                                            ($faq->helpful_score >= 40 ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 
                                                            'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200') }}">
                                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                            </svg>
                                                            {{ $faq->helpful_score }}%
                                                        </span>
                                                    @endif
                                                </div> --}}

                                                <div id="faq-answer-{{ $index }}" class="faq-answer overflow-hidden transition-all duration-300">
                                                    <div class="">
                                                        <p class="mt-1 {{ FD['text'] }} text-slate-500 dark:text-slate-400/80 description-wrapper">
                                                            {!! nl2br($faq->answer) !!}
                                                        </p>

                                                        <!-- FAQ Meta & Actions -->
                                                        {{-- <div class="flex items-center justify-between pt-3 border-t border-gray-100 dark:border-gray-700">
                                                            <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400">
                                                                <span class="flex items-center gap-1">
                                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                                    </svg>
                                                                    {{ $faq->view_count }} views
                                                                </span>
                                                                <span>{{ $faq->created_at->diffForHumans() }}</span>
                                                            </div>
                                                            
                                                            <div class="flex items-center gap-2">
                                                                <span class="text-xs text-gray-500 dark:text-gray-400 mr-2">
                                                                    Was this helpful?
                                                                </span>
                                                                <button 
                                                                    class="helpful-btn helpful-yes inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md transition-colors duration-200"
                                                                    data-faq-id="{{ $faq->id }}"
                                                                    data-vote="yes"
                                                                >
                                                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905a3.61 3.61 0 01-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                                                    </svg>
                                                                    Yes ({{ $faq->helpful_yes }})
                                                                </button>
                                                                <button 
                                                                    class="helpful-btn helpful-no inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md transition-colors duration-200"
                                                                    data-faq-id="{{ $faq->id }}"
                                                                    data-vote="no"
                                                                >
                                                                    <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14H5.236a2 2 0 01-1.789-2.894l3.5-7A2 2 0 018.736 3h4.018c.163 0 .326.02.485.06L17 4m-7 10v5a2 2 0 002 2h.095c.5 0 .905-.405.905-.905a3.61 3.61 0 01.608-2.006L17 13V4m-7 10h2m-7 0H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path>
                                                                    </svg>
                                                                    No ({{ $faq->helpful_no }})
                                                                </button>
                                                            </div>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                            </article>
                                        @endforeach
                                    </div>
                                </div>

                                <hr class="dark:border-gray-600">
                            @endif

                            <!-- Reviews -->
                            @if ($reviews && count($reviews) > 0)
                                <div id="reviews">
                                    {{-- <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-4">
                                        <header class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                            <div>
                                                <h2 class="{{ FD['text-1'] }} font-semibold">Customer reviews</h2>
                                                <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">
                                                    {{ count($reviews).' '.(count($reviews) == 1 ? 'review' : 'reviews') }} found
                                                </p>
                                            </div>
                                        </header>

                                        <div class="flex items-center gap-2">
                                            <label for="sortReviews" class="text-xs">Sort</label>
                                            <select id="sortReviews" class="px-2 py-1 border rounded {{ FD['text-1'] }}">
                                                <option value="recent">Most recent</option>
                                                <option value="rating_desc">Top rated</option>
                                                <option value="rating_asc">Lowest rated</option>
                                            </select>
                                        </div>
                                    </div> --}}

                                    <x-front.product-detail-block-header
                                        title="Customer reviews"
                                        subtitle="{{ count($reviews).' '.(count($reviews) == 1 ? 'review' : 'reviews') }} found"
                                    />

                                    {{-- <hr class="my-3 border-gray-200/50 dark:border-gray-700/50"/> --}}

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        {{-- Review highlight section with fixed height --}}
                                        <div class="md:col-span-1 bg-primary-50 dark:bg-gray-900/50 p-4 {{ FD['rounded'] }} h-fit sticky top-4">
                                            <div class="text-center">
                                                <div class="flex justify-center">
                                                    @php
                                                        $avg = 0; $total = count($reviews); if($total){ foreach($reviews as $r) $avg += $r['rating']; $avg = round($avg/$total,1); }
                                                    @endphp

                                                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $total ? $avg : '0.0' }}</p>

                                                    <div class="w-8 h-8 text-amber-500 dark:text-amber-400">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m305-704 112-145q12-16 28.5-23.5T480-880q18 0 34.5 7.5T543-849l112 145 170 57q26 8 41 29.5t15 47.5q0 12-3.5 24T866-523L756-367l4 164q1 35-23 59t-56 24q-2 0-22-3l-179-50-179 50q-5 2-11 2.5t-11 .5q-32 0-56-24t-23-59l4-165L95-523q-8-11-11.5-23T80-570q0-25 14.5-46.5T135-647l170-57Z"/></svg>
                                                    </div>
                                                </div>
                                                <div class="text-xs text-gray-600 dark:text-gray-300 mt-1">based on {{ $total }} reviews</div>
                                            </div>

                                            @php
                                                $ratingBuckets = [5=>0,4=>0,3=>0,2=>0,1=>0];
                                                foreach($reviews as $r) $ratingBuckets[$r['rating']]++;
                                            @endphp

                                            <div class="mt-3 mb-5 space-y-2 {{ FD['text-1'] }}">
                                                @foreach($ratingBuckets as $star => $count)
                                                    <div class="flex items-center gap-2">
                                                        <div class="w-10 flex gap-1 items-center">
                                                            <p class="!w-2 text-xs text-gray-800 dark:text-white">{{ $star }}</p>
                                                            <div class="w-3 h-3 text-amber-500 dark:text-amber-400">
                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m305-704 112-145q12-16 28.5-23.5T480-880q18 0 34.5 7.5T543-849l112 145 170 57q26 8 41 29.5t15 47.5q0 12-3.5 24T866-523L756-367l4 164q1 35-23 59t-56 24q-2 0-22-3l-179-50-179 50q-5 2-11 2.5t-11 .5q-32 0-56-24t-23-59l4-165L95-523q-8-11-11.5-23T80-570q0-25 14.5-46.5T135-647l170-57Z"/></svg>
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 bg-gray-300 dark:bg-gray-700 h-2 rounded overflow-hidden">
                                                            <div style="width:@php echo $total? intval(($count/$total)*100):0 @endphp%" class="h-2 bg-amber-600 dark:bg-amber-500"></div>
                                                        </div>
                                                        <div class="w-8 text-xs text-right text-gray-800 dark:text-white">@php echo $count @endphp</div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            <x-front.button
                                                class="w-full"
                                                element="a">
                                                @slot('icon')
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M80-80v-720q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H240L80-80Z"/></svg>
                                                @endslot
                                                {{ __('Write a review') }}
                                            </x-front.button>
                                        </div>

                                        <div class="md:col-span-2" id="reviewsList">
                                            @foreach($reviews as $r)
                                                <article class="p-3 border dark:border-slate-700 {{ FD['rounded'] }} mb-3">
                                                    <header class="flex items-start justify-between gap-3 mb-3">
                                                        <div>
                                                            <div class="flex gap-2">
                                                                <div class="relative inline-flex items-center justify-center w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                                                    <span class="font-medium text-gray-600 dark:text-gray-300">
                                                                        {{ substr($r->user->first_name, 0, 1) }}{{ substr($r->user->last_name, 0, 1) }}
                                                                    </span>
                                                                </div>

                                                                <div>
                                                                    <p class="{{ FD['text-1'] }}">{{ $r->user->first_name }} {{ $r->user->last_name }}</p>
                                                                    <div class="flex items-center gap-1 mt-1">@for($i=0;$i<5;$i++) {!! $i < $r->rating ? '<svg class="w-3 h-3 text-amber-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>' : '<svg class="w-3 h-3 text-slate-300" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>' !!} @endfor</div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="text-end">
                                                            <p class="{{ FD['text-0'] }} text-slate-500">Verified purchase</p>
                                                            <p class="{{ FD['text-0'] }} text-slate-500">{{ $r->created_at }}</p>
                                                        </div>
                                                    </header>
                                                    <div class="mt-2">
                                                        <p class="font-semibold {{ FD['text'] }} text-slate-800 dark:text-white">{{ $r->title }}</p>

                                                        <p class="mt-1 {{ FD['text'] }} text-slate-500 dark:text-slate-400/80 description-wrapper">{!! nl2br($r->review) !!}</p>
                                                    </div>
                                                </article>
                                            @endforeach

                                            <!-- Load more (demo) -->
                                            <div class="flex justify-center mt-4">
                                                {{-- <button id="loadMoreReviews" class="px-4 py-2 {{ FD['rounded'] }} border {{ FD['text-1'] }}">Load more reviews</button> --}}
                                                <x-front.button
                                                    element="a"
                                                    tag="secondary"
                                                    class="w-full sm:w-40"
                                                    :href="route('front.review.list', $product->slug)"
                                                >
                                                    @slot('icon')
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M80-80v-720q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H240L80-80Zm160-320h320v-80H240v80Zm0-120h480v-80H240v80Zm0-120h480v-80H240v80Z"/></svg>
                                                    @endslot
                                                    {{ __('See all Reviews') }}
                                                </x-front.button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @else
                                <div id="reviews">
                                    <x-front.product-detail-block-header
                                        title="Customer reviews"
                                        subtitle="No reviews yet"
                                    />

                                    <div class="text-center py-12 border dark:border-slate-700 {{ FD['rounded'] }} bg-slate-50 dark:bg-slate-800/50">
                                        <svg class="mx-auto h-12 w-12 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                        </svg>

                                        <h3 class="mt-4 {{ FD['text-1'] }} font-semibold text-slate-900 dark:text-white">No reviews yet</h3>
                                        <p class="mt-2 {{ FD['text'] }} text-slate-600 dark:text-slate-400">Be the first to share your thoughts about this product</p>

                                        <div class="flex justify-center mt-3">
                                            <x-front.button
                                                class="w-full md:w-40"
                                                element="a">
                                                @slot('icon')
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-400h80v-120h120v-80H520v-120h-80v120H320v80h120v120ZM80-80v-720q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H240L80-80Z"/></svg>
                                                @endslot
                                                {{ __('Write the first review') }}
                                            </x-front.button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <aside class="lg:col-span-4 sticky md:top-[8.1rem] self-start space-y-4" id="pdpAsideQuickBar">
                        <div class="{{ FD['rounded'] }} border border-gray-100 dark:border-gray-800 p-4 bg-gray-50 dark:bg-gray-900 shadow-sm">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="{{ FD['text-1'] }} text-gray-500 dark:text-gray-400">Limited time deal</p>
                                    <div class="flex items-baseline gap-3">
                                        <div class="text-2xl font-extrabold">₹9,499</div>
                                        <div class="{{ FD['text-1'] }} line-through text-gray-500">₹12,999</div>
                                    </div>
                                    <p class="text-xs text-green-600 dark:text-green-400 mt-1">Save ₹3,500 (27%)</p>
                                </div>

                                <div class="w-24 h-24 flex-shrink-0 {{ FD['rounded'] }} overflow-hidden border border-gray-100 dark:border-gray-800">
                                    <img src="https://dummyimage.com/200x200/cccccc/666666&text=Deal" alt="Deal image" class="w-full h-full object-cover">
                                </div>
                            </div>

                            <div class="mt-3 flex items-center gap-2">
                                <!-- Countdown icon -->
                                {{-- <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"><path d="M12 8v5l3 3" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg> --}}
                                
                                <div class="{{ FD['iconClass'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                </div>
                                <div class="{{ FD['text-1'] }} text-gray-600 dark:text-gray-400">Offer ends in <span id="dealCountdown" class="font-medium">02:13:45</span></div>
                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-2">
                                <button class="py-2 px-3 {{ FD['rounded'] }} border border-gray-200 dark:border-gray-800 {{ FD['text-1'] }} font-medium">Add to cart</button>
                                <button class="py-2 px-3 {{ FD['rounded'] }} bg-blue-600 text-white {{ FD['text-1'] }} font-medium hover:bg-blue-700">Buy now</button>
                            </div>

                            <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">Free delivery & easy returns. EMI options available.</div>
                        </div>

                        <!-- Small ad / cross-sell card -->
                        <div class="{{ FD['rounded'] }} border border-dashed border-gray-100 dark:border-gray-800 p-3 {{ FD['text-1'] }} bg-gradient-to-br from-yellow-50 to-white dark:from-yellow-900 dark:to-gray-900">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-12 h-12 {{ FD['rounded'] }} overflow-hidden">
                                <img src="https://dummyimage.com/120x120/eeeeee/888888&text=Bundle" alt="Bundle" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="{{ FD['text-1'] }} font-semibold">Bundle & Save</h4>
                                    <span class="text-xs text-green-600 dark:text-green-400">-15%</span>
                                </div>
                                <p class="mt-1 text-xs text-gray-600 dark:text-gray-300">Add a matching accessory and get 15% off. Limited stock.</p>
                                <a href="#" class="mt-2 inline-block text-xs text-blue-600 dark:text-blue-400">View bundle</a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 dark:bg-slate-900 {{ FD['rounded'] }} p-4 shadow-sm sticky top-28">
                            <div class="{{ FD['text-1'] }} font-semibold">Need help deciding?</div>
                            <div class="mt-2 text-xs text-slate-600">Chat with our product experts for advice, bulk orders, or assembly help.</div>
                            <div class="mt-3 flex gap-2">
                                <button class="px-3 py-2 {{ FD['rounded'] }} bg-amber-600 text-white {{ FD['text-1'] }}">Chat now</button>
                                <button class="px-3 py-2 {{ FD['rounded'] }} border {{ FD['text-1'] }}">Call</button>
                            </div>

                            <div class="mt-4 border-t pt-3 text-xs text-slate-600">
                                <div><strong>Delivery:</strong> @php echo ($product['shipping']['estimate_days'][0] ?? '—') . ' - ' . ($product['shipping']['estimate_days'][1] ?? '—') @endphp days</div>
                                <div class="mt-1"><strong>Return:</strong> 7 days (eligible)</div>
                                <div class="mt-1"><strong>Warranty:</strong> @php echo $product['specs']['Warranty'] ?? '—' @endphp</div>
                            </div>
                        </div>

                    </aside>
                </div>
            </div>

            <!-- Mobile sticky CTA -->
            <div id="mobileCta" class="fixed bottom-16 left-1/2 -translate-x-1/2 z-50 w-[92%] sm:hidden">
                <div class="flex items-center justify-between bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 {{ FD['rounded'] }} p-3 shadow-lg">
                <div class="flex items-center gap-3">
                    <img src="https://dummyimage.com/64x64/cccccc/666666&text=P" alt="product" class="w-12 h-12 {{ FD['rounded'] }} object-cover">
                    <div>
                    <div class="{{ FD['text-1'] }} font-medium">₹9,499</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Free delivery</div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="px-3 py-2 {{ FD['rounded'] }} border border-gray-200 dark:border-gray-700 {{ FD['text-1'] }}">Add</button>
                    <button class="px-4 py-2 {{ FD['rounded'] }} bg-blue-600 text-white {{ FD['text-1'] }}">Buy</button>
                </div>
                </div>
            </div>

        </section>
    </div>

</div>


<script>
(function(){
    // server-provided data (raw json, NOT escaped)
    // const variants = @php // echo json_encode($variations, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) @endphp;
    // const variantOrder = @php // echo json_encode($variant_order, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) @endphp;
    // const combos = variants.combinations || {};
    // ---- CONFIG ----
    const ZOOM_FACTOR = 3;      // how much larger the background will appear in the zoom pane
    const SHOW_ON_WIDTH = 768;    // min viewport width to show zoom pane (hide on small screens)
    const mainImage = document.getElementById('mainImage');
    const mainWrap  = document.getElementById('mainImageWrapper');
    const thumbs    = document.querySelectorAll('.thumb-item');
    const lens      = document.getElementById('imgLens');
    let zoomPane = null;          // the zoom pane element appended to body
    let currentSrc = mainImage.src;
    let boundHandlers = {};


    const qtyGroup = document.getElementById('qtyGroup');
    const qtyInput = document.getElementById('qtyInput');
    const decBtn = document.getElementById('qtyDec');
    const incBtn = document.getElementById('qtyInc');
    const stockHelper = document.getElementById('stockHelper');
    const addToCart = document.getElementById('addToCart');

    // Settings
    const minQty = parseInt(qtyGroup.dataset.minQty || '1', 10);
    const serverMax = parseInt(qtyGroup.dataset.maxStock || '99', 10);
    const step = parseInt(qtyGroup.dataset.step || '1', 10);

    // Hard cap for business rule
    const HARD_MAX = 99;

    // acceleration settings for long-press buttons
    const accelerateIntervalStart = 400; // ms
    const accelerateIntervalMin = 60; // ms

    // compute effective max stock (clamped to HARD_MAX)
    let maxStock = Math.min(Math.max(0, serverMax), HARD_MAX);
    // -----------------



    // --- THUMBNAIL HOVER: change main image on pointerenter / focus ---
    // Add border to first thumbnail on page load
    const firstThumb = document.querySelector('.thumb-item');
    if (firstThumb) {
        firstThumb.classList.add('border-2', 'border-amber-300', 'dark:border-amber-300');
    }
    thumbs.forEach(btn => {
        // pointerenter covers mouse & pen; also handle keyboard focus
        btn.addEventListener('pointerenter', () => {
            btn.classList.add('border-2', 'border-amber-300', 'dark:border-amber-300');
            const src = btn.dataset.img;
            if (src && src !== currentSrc) {
                currentSrc = src;
                mainImage.src = src;
            }
            // visual focus state
            // thumbs.forEach(t => t.classList.remove('ring-2','ring-slate-300'));
            // btn.classList.add('ring-2','ring-slate-300','ring-inset');
            thumbs.forEach(t => t.classList.remove('border-2', 'border-amber-300', 'dark:border-amber-300'));
            btn.classList.add('border-2', 'border-amber-300', 'dark:border-amber-300');
        });

        btn.addEventListener('focus', () => {
            btn.dispatchEvent(new Event('pointerenter'));
        });

        // optional: on pointerleave remove ring (keeps last selected)
        btn.addEventListener('pointerleave', () => {
            // keep ring on the last hovered; comment out to remove ring on leave
            // btn.classList.remove('ring-2','ring-slate-300');
        });
    });

    // --- LIGHTBOX / GALLERY (unchanged) ---
    document.getElementById('openGallery').addEventListener('click', () => {
        const src = mainImage.src;
        const light = document.createElement('div');
        light.className = 'fixed inset-0 z-60 bg-black/80 flex items-center justify-center p-4';
        light.innerHTML = `<div class="max-w-4xl w-full"><img src="${src}" class="w-full h-auto {{ FD['rounded'] }}" alt="preview" /></div>`;
        light.addEventListener('click', (e) => {
        if (e.target === light) document.body.removeChild(light);
        });
        document.body.appendChild(light);
        const escHandler = e => { if (e.key === 'Escape') { if (document.body.contains(light)) document.body.removeChild(light); document.removeEventListener('keydown', escHandler); } };
        document.addEventListener('keydown', escHandler);
    });

    // --- ZOOM PANE CREATION ---
    function getZoomPane() {
        // reuse existing element if present
        let pane = document.getElementById('zoomPane');
        if (pane) {
            zoomPane = pane;
            return zoomPane;
        }

        // create it lazily
        pane = document.createElement('div');
        pane.id = 'zoomPane';

        // base classes (matches previous HTML)
        pane.classList.add('hidden', 'lg:block', 'overflow-hidden', 'shadow-lg');

        // copy a "rounded*" class from mainWrap if present so visual style matches FD['rounded']
        try {
            if (mainWrap && mainWrap.classList && mainWrap.classList.length) {
                for (const c of mainWrap.classList) {
                    if (c.startsWith('rounded')) { pane.classList.add(c); break; }
                }
            }
        } catch (err) {
            // ignore if mainWrap not available yet
        }

        // inline styles (same intent as your removed HTML)
        pane.style.position = 'fixed';
        pane.style.zIndex = '70';                 // safe high z-index
        pane.style.display = 'none';
        pane.style.backgroundRepeat = 'no-repeat';
        pane.style.backgroundPosition = 'center';
        pane.style.backgroundColor = '#fff';
        pane.setAttribute('aria-hidden', 'true');

        // make pane non-interactive so it doesn't steal pointer events
        pane.style.pointerEvents = 'none';

        document.body.appendChild(pane);
        zoomPane = pane;
        return zoomPane;
    }

    function showZoomPane() {
        if (window.innerWidth < SHOW_ON_WIDTH) return;
        const pane = getZoomPane();
        pane.style.display = 'block';
        pane.classList.remove('hidden'); // keep Tailwind happy if used
        // NOTE: pointermove handler will update pane size/position/background-image
    }

    function hideZoomPane() {
        const pane = document.getElementById('zoomPane');
        if (!pane) return;
        pane.style.display = 'none';
        pane.classList.add('hidden');
    }

    // --- MOUSE MOVE handler to update zoom area ---
    function onPointerMove(e) {
        const pane = getZoomPane();
        if (!pane) return;

        // bounding boxes
        const imgRect = mainImage.getBoundingClientRect();
        const wrapRect = mainWrap.getBoundingClientRect();

        // natural image size (guard)
        const nw = mainImage.naturalWidth || imgRect.width;
        const nh = mainImage.naturalHeight || imgRect.height;
        if (!nw || !nh) return;

        const boxW = imgRect.width;
        const boxH = imgRect.height;
        const imgRatio = nw / nh;
        const boxRatio = boxW / boxH;

        // compute actual displayed image size (object-fit: contain / scale-down behavior)
        let dispW, dispH;
        if (imgRatio > boxRatio) {
            // image is relatively wider -> fit to box width
            dispW = boxW;
            dispH = boxW / imgRatio;
        } else {
            // image is relatively taller -> fit to box height
            dispH = boxH;
            dispW = boxH * imgRatio;
        }

        // offset of the drawn image inside the img element (centered)
        const offsetX = (boxW - dispW) / 2;
        const offsetY = (boxH - dispH) / 2;

        // compute pointer position relative to the drawn image (not the outer box)
        const imageLeft = imgRect.left + offsetX + window.scrollX;
        const imageTop  = imgRect.top + offsetY + window.scrollY;
        const x = (e.clientX + window.scrollX) - imageLeft;
        const y = (e.clientY + window.scrollY) - imageTop;

        // clamp to image content
        const clampedX = Math.max(0, Math.min(dispW, x));
        const clampedY = Math.max(0, Math.min(dispH, y));

        // background (use natural size so aspect is preserved)
        const bgW = Math.round(nw * ZOOM_FACTOR);
        const bgH = Math.round(nh * ZOOM_FACTOR);

        // relative position inside drawn image
        const relX = clampedX / dispW;
        const relY = clampedY / dispH;

        // pane size (unchanged logic)
        const paneWidth = Math.min(420, Math.round(imgRect.width * 0.9));
        const paneHeight = Math.round(imgRect.height);
        pane.style.width = paneWidth + 'px';
        pane.style.height = paneHeight + 'px';

        // place pane (try right, then left, same as before)
        const spaceRight = window.innerWidth - (imgRect.right + 16);
        const spaceLeft  = imgRect.left - 16;
        let left;
        if (spaceRight >= paneWidth) {
            left = imgRect.right + 12 + window.scrollX;
        } else if (spaceLeft >= paneWidth) {
            left = imgRect.left - paneWidth - 12 + window.scrollX;
        } else {
            left = Math.max(12 + window.scrollX, window.innerWidth - paneWidth - 12 + window.scrollX);
        }
        const top = imageTop; // align the pane with the actual image content top
        pane.style.left = left + 'px';
        pane.style.top  = top + 'px';

        // compute background offsets (center the focused pixel)
        const bgCenterX = Math.round(relX * bgW);
        const bgCenterY = Math.round(relY * bgH);
        const bgPosX = Math.max(0, Math.min(bgW - paneWidth, bgCenterX - Math.round(paneWidth / 2)));
        const bgPosY = Math.max(0, Math.min(bgH - paneHeight, bgCenterY - Math.round(paneHeight / 2)));

        pane.style.backgroundImage = `url("${mainImage.src}")`;
        pane.style.backgroundSize  = `${bgW}px ${bgH}px`;
        pane.style.backgroundPosition = `-${bgPosX}px -${bgPosY}px`;

        // lens: size based on paneWidth (same approach you had) and positioned relative to wrapper
        const lensSize = Math.max(40, Math.round(paneWidth / ZOOM_FACTOR));
        lens.style.width = lensSize + 'px';
        lens.style.height = lensSize + 'px';

        // compute lens left/top relative to wrapper (mainWrap)
        const lensLeft = Math.round((imageLeft - wrapRect.left) + clampedX - lensSize / 2);
        const lensTop  = Math.round((imageTop - wrapRect.top)  + clampedY - lensSize / 2);
        lens.style.left = lensLeft + 'px';
        lens.style.top  = lensTop + 'px';
    }


    function attachZoomHandlers() {
        // pointerenter -> create and show pane
        boundHandlers.enter = (e) => {
        showZoomPane();
        lens.classList.remove('hidden');
        // update immediately so pane appears under current cursor
        onPointerMove(e);
        };
        boundHandlers.move = onPointerMove;
        boundHandlers.leave = () => {
        hideZoomPane();
        lens.classList.add('hidden');
        };

        // Use pointer events for broad device coverage
        mainImage.addEventListener('pointerenter', boundHandlers.enter);
        mainImage.addEventListener('pointermove', boundHandlers.move);
        mainImage.addEventListener('pointerleave', boundHandlers.leave);
        // also hide on scroll or resize to avoid mispositioned pane
        boundHandlers.onScroll = () => { hideZoomPane(); lens.classList.add('hidden'); };
        window.addEventListener('scroll', boundHandlers.onScroll, { passive: true });
        window.addEventListener('resize', boundHandlers.onScroll);
    }

    function detachZoomHandlers() {
        if (!boundHandlers.enter) return;
        mainImage.removeEventListener('pointerenter', boundHandlers.enter);
        mainImage.removeEventListener('pointermove', boundHandlers.move);
        mainImage.removeEventListener('pointerleave', boundHandlers.leave);
        window.removeEventListener('scroll', boundHandlers.onScroll);
        window.removeEventListener('resize', boundHandlers.onScroll);
    }

    // initialize
    attachZoomHandlers();

    // When the main image src changes (thumbnail hover), we should update currentSrc & make sure zoom uses the new image.
    // We already set src on pointerenter thumbs; listen for src changes to ensure lens/zoom pane reflect new image (no extra action needed).
    // But to be safe, re-create zoom pane image on load so background size will be correct.
    mainImage.addEventListener('load', () => {
        // no-op for now; the zoom pane uses the up-to-date mainImage.src when pointer moves
    });

    // Cleanup on page unload (optional)
    window.addEventListener('unload', () => {
        detachZoomHandlers();
        if (zoomPane && document.body.contains(zoomPane)) document.body.removeChild(zoomPane);
    });

    /*
    // helper: build combo key based on variantOrder
    function comboKeyFromSelected(selected){ return variantOrder.map(g => selected[g] ?? '').join('|'); }

    // selected state
    const selected = {};

    // mark active in a group element
    function markActiveForGroup(groupEl, value){
        groupEl.querySelectorAll('[data-variant-value]').forEach(btn=>{
        const v = btn.dataset.variantValue;
        const active = v === value;
        btn.setAttribute('aria-checked', active ? 'true' : 'false');
        // btn.classList.toggle('ring-2', active);
        btn.classList.toggle('border-2', active);
        btn.classList.toggle('ring-amber-500', active);
        btn.classList.toggle('opacity-60', btn.disabled && !active);
        });
    }

    // update UI: summary, note, price and enable/disable actions
    function updateVariantUI(){
        // summary
        const summaryEl = document.getElementById('selectedSummary');
        if (summaryEl) {
        const parts = variantOrder.map(g => (variants[g] && variants[g][selected[g]]) ? variants[g][selected[g]] : (selected[g] || '—'));
        summaryEl.textContent = parts.join(' / ');
        }

        // find combo info
        const key = comboKeyFromSelected(selected);
        const info = combos[key] || null;
        // const noteEl = document.getElementById('variantNote');
        const stockHelper = document.getElementById('stockHelper');
        const priceEl = document.getElementById('sellingPriceEl');
        const mrpEl = document.getElementById('mrpEl');
        const savingsEl = document.getElementById('savingsEl');
        const addToCart = document.getElementById('addToCart');
        const buyNow = document.getElementById('buyNow');

        if (!info) {
            // if (noteEl) { noteEl.textContent = 'This combination is unavailable'; noteEl.classList.remove('hidden'); }
            if (stockHelper) stockHelper.textContent = '';
            if (priceEl) priceEl.innerHTML = '<span class="text-red-500 dark:text-amber-700">Unavailable</span>';
            if (addToCart) { addToCart.disabled = true; addToCart.classList.add('opacity-60'); }
            if (buyNow) { buyNow.disabled = true; buyNow.classList.add('opacity-60'); }
            if (mrpEl) mrpEl.textContent = '';
            if (savingsEl) savingsEl.textContent = '';
            return;
        }

    }
    */

    /*
    // wire variant groups: set initial selected and attach handlers
    document.querySelectorAll('[data-variant-group]').forEach(groupEl => {
        const groupKey = groupEl.getAttribute('data-variant-group');

        // initial: pick first enabled option
        const first = groupEl.querySelector('[data-variant-value]:not([disabled])');
        selected[groupKey] = first ? first.dataset.variantValue : null;
        markActiveForGroup(groupEl, selected[groupKey]);

        // click delegation
        groupEl.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-variant-value]');
        if (!btn || btn.disabled) return;
        selected[groupKey] = btn.dataset.variantValue;
        markActiveForGroup(groupEl, selected[groupKey]);
        updateVariantUI();
        });

        // keyboard navigation
        const buttons = Array.from(groupEl.querySelectorAll('[data-variant-value]'));
        buttons.forEach((btn, idx) => {
        btn.addEventListener('keydown', ev => {
            if (ev.key === 'ArrowRight' || ev.key === 'ArrowDown') {
            ev.preventDefault();
            const next = buttons[(idx + 1) % buttons.length];
            if (!next.disabled) next.focus();
            } else if (ev.key === 'ArrowLeft' || ev.key === 'ArrowUp') {
            ev.preventDefault();
            const prev = buttons[(idx - 1 + buttons.length) % buttons.length];
            if (!prev.disabled) prev.focus();
            } else if (ev.key === 'Enter' || ev.key === ' ') {
            ev.preventDefault();
            btn.click();
            }
        });
        });
    });

    // get current combo key
    function getCurrentComboKey(){ return comboKeyFromSelected(selected); }

    // qty handlers (clamp by stock)
    const qtyInput = document.getElementById('qtyInput');
    function clampQty(){
        let v = parseInt(qtyInput.value || 1, 10);
        if (isNaN(v) || v < 1) v = 1;
        const key = getCurrentComboKey();
        const info = combos[key];
        if (info && info.stock) v = Math.min(v, info.stock);
        qtyInput.value = v;
    }
    document.getElementById('qtyInc').addEventListener('click', ()=>{
        qtyInput.value = Math.max(1, parseInt(qtyInput.value||1,10)+1);
        clampQty();
        updateVariantUI();
    });
    document.getElementById('qtyDec').addEventListener('click', ()=>{
        qtyInput.value = Math.max(1, parseInt(qtyInput.value||1,10)-1);
        clampQty();
        updateVariantUI();
    });
    qtyInput.addEventListener('input', ()=>{ clampQty(); updateVariantUI(); });

    // init UI
    updateVariantUI();
    */






    /*
    function clamp(v) {
        if (isNaN(v)) return minQty;
        v = Math.round(v);
        if (v < minQty) return minQty;
        if (v > maxStock) return maxStock;
        return v;
    }

    function updateUI(qty) {
        qty = clamp(qty);
        qtyInput.value = qty;
        qtyInput.setAttribute('aria-valuenow', qty);
        qtyInput.setAttribute('aria-valuemax', Math.min(maxStock, HARD_MAX));
        decBtn.disabled = qty <= minQty;
        incBtn.disabled = qty >= maxStock;
        // Add to cart is managed server-side; we only reflect disable state here
        if (addToCart) addToCart.disabled = qty < minQty || maxStock === 0;

        // Stock helper messages
        if (maxStock === 0) {
        stockHelper.textContent = 'Out of stock';
        stockHelper.classList.remove('text-slate-500');
        stockHelper.classList.add('text-red-600');
        } else if (maxStock <= 5) {
        stockHelper.textContent = 'Only ' + maxStock + ' left — order soon';
        stockHelper.classList.remove('text-slate-500', 'text-green-600');
        stockHelper.classList.add('text-amber-600');
        } else {
        stockHelper.textContent = '';
        stockHelper.classList.remove('text-amber-600', 'text-red-600');
        stockHelper.classList.add('text-slate-500');
        }
    }

    // Initialize
    updateUI(parseInt(qtyInput.value || minQty, 10));

    // change by delta (only via buttons)
    function changeBy(delta) {
        const current = clamp(parseInt(qtyInput.value || minQty, 10));
        updateUI(current + delta);
    }

    // Button click handlers (only way to update qty)
    decBtn.addEventListener('click', () => changeBy(-step));
    incBtn.addEventListener('click', () => changeBy(step));

    // Long-press accelerate for inc/dec (mobile friendly)
    let accelTimer = null;
    let accelInterval = accelerateIntervalStart;
    let accelDirection = 0;

    function startAccel(dir) {
        accelDirection = dir;
        accelInterval = accelerateIntervalStart;
        accelTimer = setTimeout(accelerateStep, accelInterval);
    }
    function accelerateStep() {
        if (!accelDirection) return stopAccel();
        changeBy(accelDirection * step);
        accelInterval = Math.max(accelerateIntervalMin, Math.round(accelInterval * 0.85));
        accelTimer = setTimeout(accelerateStep, accelInterval);
    }
    function stopAccel() {
        clearTimeout(accelTimer);
        accelTimer = null;
        accelDirection = 0;
    }

    ['mousedown','touchstart'].forEach(evt => {
        incBtn.addEventListener(evt, (e) => {
        e.preventDefault();
        startAccel(1);
        }, {passive:false});
        decBtn.addEventListener(evt, (e) => {
        e.preventDefault();
        startAccel(-1);
        }, {passive:false});
    });
    ['mouseup','mouseleave','touchend','touchcancel'].forEach(evt => {
        incBtn.addEventListener(evt, stopAccel);
        decBtn.addEventListener(evt, stopAccel);
    });

    // Prevent typing/editing in input (explicitly required)
    // readonly attribute is present, but also block key events to be extra-safe.
    qtyInput.addEventListener('keydown', function (e) {
        // allow Tab (9) and Shift+Tab navigation; block other keys that could mutate input
        if (e.key === 'Tab' || (e.key === 'Tab' && e.shiftKey)) return;
        e.preventDefault();
    });

    // Prevent paste / drop into input
    qtyInput.addEventListener('paste', (e) => e.preventDefault());
    qtyInput.addEventListener('drop', (e) => e.preventDefault());

    // Expose API for other scripts: set max stock (server push) and get qty
    window.__qtyWidget = {
        getQty: () => clamp(parseInt(qtyInput.value || minQty, 10)),
        setMaxStock: (n) => {
        const parsed = Math.min(HARD_MAX, Math.max(0, parseInt(n || 0, 10)));
        maxStock = parsed;
        qtyInput.setAttribute('aria-valuemax', Math.min(maxStock, HARD_MAX));
        updateUI(window.__qtyWidget.getQty());
        },
        setQty: (n) => updateUI(clamp(parseInt(n || minQty, 10)))
    };
    */











    @if ($variation['code'] == 200)
        document.addEventListener("DOMContentLoaded", () => {
            const productCombinations = @json($variation['data']['combinations']);
            const variationAttributes = @json($variation['data']['attributes']);
            const selectedOptions = {};

            // Helpers
            function tokensOf(identifier) {
                return identifier.split('-').map(t => t.trim()).filter(Boolean);
            }

            function findCombination(options) {
                console.log('options>>', options);

                return productCombinations.find(c => {
                    const tokens = tokensOf(c.variation_identifier);
                    return Object.values(options).every(v => tokens.includes(v));
                });
            }

            function autoSelectNext(attrSlug) {
                console.log('attrSlug>>', attrSlug);
                
                const combo = findCombination(selectedOptions);
                if (!combo) return;

                const tokens = tokensOf(combo.variation_identifier);
                variationAttributes.forEach(attr => {
                    if (!selectedOptions[attr.slug]) {
                        const token = tokens.find(t =>
                            attr.values.some(v => v.slug === t)
                        );
                        if (token) {
                            const el = document.querySelector(
                                `.attr-val-generate[data-attr-slug="${attr.slug}"][data-value-slug="${token}"]`
                            );
                            if (el) {
                                el.checked = true;
                                selectedOptions[attr.slug] = token;
                            }
                        }
                    }
                });
            }

            function updateUI(combo) {
                console.log(combo);
                if (combo && combo.pricing?.length > 0) {
                    const price = combo.pricing[0].selling_price_formatted;
                    const priceBox = document.getElementById('priceBox');
                    if (priceBox) {
                        priceBox.innerText = price;
                    }
                }
                disableInvalidOptions();
            }

            function disableInvalidOptions() {
                variationAttributes.forEach(attr => {
                    attr.values.forEach(val => {
                        const el = document.querySelector(
                            `.attr-val-generate[data-attr-slug="${attr.slug}"][data-value-slug="${val.slug}"]`
                        );
                        if (!el) return;

                        // Check if this value can exist with currently selected options
                        const testOptions = { ...selectedOptions, [attr.slug]: val.slug };
                        const valid = productCombinations.some(c => {
                            const tokens = tokensOf(c.variation_identifier);
                            return Object.values(testOptions).every(v => tokens.includes(v));
                        });

                        if (valid) {
                            el.parentElement.classList.remove("opacity-50");
                        } else {
                            el.parentElement.classList.add("opacity-50");
                        }
                    });
                });
            }

            // Attach events
            document.querySelectorAll('.attr-val-generate').forEach(el => {
                el.addEventListener('change', function () {
                    const attrSlug = this.dataset.attrSlug;
                    const valueSlug = this.dataset.valueSlug;

                    // console.log('attrSlug>>', attrSlug); // Color/ Size
                    // console.log('valueSlug>>', valueSlug);// Red/ XL

                    selectedOptions[attrSlug] = valueSlug;

                    autoSelectNext(attrSlug);

                    const combo = findCombination(selectedOptions);
                    updateUI(combo);
                });
            });

            // Auto-select first valid combination
            const firstCombo = productCombinations[0];
            if (firstCombo) {
                const tokens = tokensOf(firstCombo.variation_identifier);
                variationAttributes.forEach(attr => {
                    const token = tokens.find(t =>
                        attr.values.some(v => v.slug === t)
                    );
                    if (token) {
                        const el = document.querySelector(
                            `.attr-val-generate[data-attr-slug="${attr.slug}"][data-value-slug="${token}"]`
                        );
                        if (el) {
                            el.checked = true;
                            selectedOptions[attr.slug] = token;
                        }
                    }
                });
                updateUI(firstCombo);
            }
        });
    @endif






    // Variation
    @if ($variation['code'] == 200)
        /*
        const productCombinations = @json($variation['data']['combinations']);
        const attributes = @json($variation['data']['attributes']);
        const selectedOptions = {};

        // Helpers
        function tokensOf(identifier) {
            return identifier.split('-').map(t => t.trim()).filter(Boolean);
        }

        function findCombination(options) {
            return productCombinations.find(c => {
                const tokens = tokensOf(c.variation_identifier);
                return Object.values(options).every(v => tokens.includes(v));
            });
        }

        function autoSelectNext(attrSlug) {
            const combo = findCombination(selectedOptions);
            if (!combo) return;

            const tokens = tokensOf(combo.variation_identifier);
            attributes.forEach(attr => {
                if (!selectedOptions[attr.slug]) {
                    const token = tokens.find(t =>
                        attr.values.some(v => v.slug === t)
                    );
                    if (token) {
                        const el = document.querySelector(
                            `.attr-val-generate[data-attr-slug="${attr.slug}"][data-value-slug="${token}"]`
                        );
                        if (el) {
                            el.checked = true;
                            selectedOptions[attr.slug] = token;
                        }
                    }
                }
            });
        }

        function updateUI(combo) {
            if (combo && combo.pricing?.length > 0) {
                const price = combo.pricing[0].selling_price_formatted;
                document.getElementById('priceBox').innerText = price;
            }
        }

        // Attach events
        document.querySelectorAll('.attr-val-generate').forEach(el => {
            el.addEventListener('change', function () {
                const attrSlug = this.dataset.attrSlug;
                const valueSlug = this.dataset.valueSlug;

                selectedOptions[attrSlug] = valueSlug;

                autoSelectNext(attrSlug);

                const combo = findCombination(selectedOptions);
                updateUI(combo);
            });
        });

        // Auto-select first valid combination
        const firstCombo = productCombinations[0];
        if (firstCombo) {
            const tokens = tokensOf(firstCombo.variation_identifier);
            attributes.forEach(attr => {
                const token = tokens.find(t =>
                    attr.values.some(v => v.slug === t)
                );
                if (token) {
                    const el = document.querySelector(
                        `.attr-val-generate[data-attr-slug="${attr.slug}"][data-value-slug="${token}"]`
                    );
                    if (el) {
                        el.checked = true;
                        selectedOptions[attr.slug] = token;
                    }
                }
            });
            updateUI(firstCombo);
        }
        */








        /*
        const productCombinations = @json($variation['data']['combinations']);
        const attributeSlugs = @json(array_map(function($a){ return $a['slug']; }, $variation['data']['attributes']));
        const selectedOptions = {};

        // Cache DOM elements
        const priceBoxEl = document.getElementById('priceBox');
        const mrpBoxEl = document.getElementById('mrpBox');
        const savingsBoxEl = document.getElementById('savingsBox');
        const discountBoxEl = document.getElementById('discountBox');
        const optionInputs = Array.from(document.querySelectorAll('.attr-val-generate'));

        // Helpers
        const tokensOf = identifier => identifier.split('-').map(t => t.trim()).filter(Boolean);
        const combinationMatchesSelectionTokens = (tokens, selectionObj) => 
            Object.entries(selectionObj).every(([k, v]) => !v || tokens.includes(v));
        
        const findExactMatch = selectedObj => {
            const values = attributeSlugs.map(s => selectedObj[s]).filter(Boolean);
            if (values.length !== attributeSlugs.length) return null;
            
            const normalized = values.slice().sort().join('|');
            return productCombinations.find(c => {
                const tokens = tokensOf(c.variation_identifier);
                return tokens.length === attributeSlugs.length && 
                    tokens.slice().sort().join('|') === normalized;
            }) || null;
        };

        const getLabelFor = input => {
            if (!input) return null;
            if (input.id) {
                const lab = document.querySelector(`label[for="${input.id}"]`);
                if (lab) return lab;
            }
            return input.closest('label') || 
                input.nextElementSibling?.tagName === 'LABEL' && input.nextElementSibling ||
                input.parentElement?.querySelector('label') ||
                input.parentElement;
        };

        const enableLabel = label => {
            if (!label) return;
            label.classList.remove('opacity-50');
            label.setAttribute('aria-disabled', 'false');
        };
        
        const disableLabel = label => {
            if (!label) return;
            label.classList.add('opacity-50');
            label.setAttribute('aria-disabled', 'true');
        };

        const updatePrice = combination => {
            if (combination?.pricing?.length) {
                const p = combination.pricing[0];
                if (priceBoxEl) priceBoxEl.innerText = p.selling_price_formatted ?? p.selling_price ?? '';
                if (mrpBoxEl) mrpBoxEl.innerText = p.mrp_formatted ?? p.mrp ?? '';
                if (savingsBoxEl) savingsBoxEl.innerText = p.savings_formatted ?? ((+p.mrp || 0) - (+p.selling_price || 0)) ?? '';
                if (discountBoxEl) discountBoxEl.innerText = p.discount ?? '';
            }
        };

        const updateOptionsAvailability = () => {
            optionInputs.forEach(input => {
                const attr = input.dataset.attrSlug;
                const val = input.dataset.valueSlug ?? input.value;
                const testSelection = {...selectedOptions, [attr]: val};
                
                const isValid = productCombinations.some(c => 
                    combinationMatchesSelectionTokens(tokensOf(c.variation_identifier), testSelection)
                );
                
                const label = getLabelFor(input);
                isValid ? enableLabel(label) : disableLabel(label);
                
                // Update aria-checked for selected state
                const isSelected = selectedOptions[attr] === val;
                if (label) label.setAttribute('aria-checked', isSelected.toString());
            });
        };

        // Event handler for option selection
        const handleOptionSelection = ev => {
            const input = ev.target.matches('input') ? ev.target : 
                        (ev.target.tagName === 'LABEL' ? document.getElementById(ev.target.htmlFor) : null);
            
            if (!input) return;
            
            const attrSlug = input.dataset.attrSlug;
            const valueSlug = input.dataset.valueSlug ?? input.value;
            
            // Update selected options
            selectedOptions[attrSlug] = valueSlug;
            
            // Ensure input is checked
            if ('checked' in input) input.checked = true;
            
            updateCombinationsUI();
        };

        // Initialize selectedOptions from checked inputs or first available
        (function initDefaults() {
            attributeSlugs.forEach(slug => {
                const checkedInput = optionInputs.find(i => 
                    i.dataset.attrSlug === slug && (i.checked || i.hasAttribute('checked'))
                );
                
                if (checkedInput) {
                    selectedOptions[slug] = checkedInput.dataset.valueSlug ?? checkedInput.value;
                } else {
                    const first = optionInputs.find(i => i.dataset.attrSlug === slug);
                    if (first) {
                        selectedOptions[slug] = first.dataset.valueSlug ?? first.value;
                        if ('checked' in first) first.checked = true;
                    }
                }
            });

            updateCombinationsUI();
        })();

        // Attach event listeners using event delegation
        document.addEventListener('click', ev => {
            if (ev.target.matches('.attr-val-generate, label[for]')) {
                handleOptionSelection(ev);
            }
        });

        function updateCombinationsUI() {
            // Update price
            updatePrice(findExactMatch(selectedOptions));
            
            // Update options availability
            updateOptionsAvailability();
            
            // Auto-fix invalid selected options
            let changed = false;
            
            attributeSlugs.forEach(attr => {
                const cur = selectedOptions[attr];
                if (!cur) return;
                
                const stillValid = productCombinations.some(c => 
                    combinationMatchesSelectionTokens(tokensOf(c.variation_identifier), selectedOptions)
                );
                
                if (!stillValid) {
                    const candidateInput = optionInputs
                        .filter(i => i.dataset.attrSlug === attr)
                        .find(opt => {
                            const val = opt.dataset.valueSlug ?? opt.value;
                            const testSel = {...selectedOptions, [attr]: val};
                            return productCombinations.some(c => 
                                combinationMatchesSelectionTokens(tokensOf(c.variation_identifier), testSel)
                            );
                        });
                        
                    if (candidateInput) {
                        const val = candidateInput.dataset.valueSlug ?? candidateInput.value;
                        selectedOptions[attr] = val;
                        if ('checked' in candidateInput) candidateInput.checked = true;
                        changed = true;
                    } else {
                        delete selectedOptions[attr];
                        changed = true;
                    }
                }
            });

            if (changed) {
                updatePrice(findExactMatch(selectedOptions));
                updateOptionsAvailability();
            }
        }
        */
    @endif


})();
</script>

</x-guest-layout>