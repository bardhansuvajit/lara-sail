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
                                <h3 class="{{FD['text']}} sm:text-sm font-semibold mb-2 dark:text-gray-500">
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


                {{-- @if ($variation['code'] == 200)
                    <div class="space-y-2" id="variationTab">
                        @foreach ($variation['data'] as $attrIndex => $attribute)
                            <div>
                                <h3 class="{{FD['text']}} sm:text-sm font-semibold mb-2 dark:text-gray-500">{{ $attribute['title'] }}</h3>

                                <div class="w-full grid grid-cols-4 lg:grid-cols-6 gap-4">
                                    @foreach ($attribute['values'] as $valueIndex => $value)

                                        <x-front.radio-input-button 
                                            id="someId{{$attrIndex}}{{$valueIndex}}" 
                                            name="variation-{{ $attribute['slug'] }}" 
                                            value="{{ $value['slug'] }}" 
                                            class="attr-val-generate" 
                                            data-prod-id="{{ $product->id }}" 
                                            data-attr-id="{{ $attribute['id'] }}" 
                                            data-value-id="{{ $value['id'] }}" 
                                            onclick="sendUrlParam('{{ $attribute['slug'] }}', '{{ $value['slug'] }}')"
                                        >
                                            <div class="text-center">
                                                <div class="flex flex-col items-center gap-2">
                                                    <img src="https://placehold.co/40x40" class="rounded-full">
                                                    <div>
                                                        <div class="{{FD['text']}} font-semibold">{{ $value['title'] }}</div>
                                                        <div class="{{FD['text-0']}} text-gray-600 dark:text-gray-400">Extra 20% off</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </x-front.radio-input-button>

                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-t dark:border-gray-700 my-4 sm:my-4"></div>
                @endif --}}


                {{-- <div class="mt-4">
                    @php foreach($variant_groups as $groupKey => $options): @endphp
                    <div class="mb-3">
                        <label class="text-xs font-semibold block mb-2">@php echo htmlspecialchars(ucfirst(str_replace('_',' ',$groupKey))) @endphp</label>

                        <div data-variant-group="@php echo htmlspecialchars($groupKey) @endphp" class="flex items-center gap-3" role="radiogroup" aria-label="Choose @php echo htmlspecialchars($groupKey) @endphp">
                        @php foreach($options as $optKey => $optLabel):
                                $disabled = option_available($groupKey, $optKey, $variations) ? '' : 'disabled';
                                $isColor = $groupKey === 'colors';
                        @endphp
                            <button
                                type="button"
                                role="radio"
                                aria-checked="false"
                                @php echo $disabled ? 'aria-disabled="true"' : '' @endphp
                                class="variant-option p-1 {{ FD['rounded'] }} border dark:border-slate-700 flex items-center justify-center text-xs focus:outline-none"
                                data-variant-value="@php echo htmlspecialchars($optKey) @endphp"
                                title="@php echo htmlspecialchars($optLabel) @endphp"
                                @php echo $disabled ? 'tabindex="-1" disabled' : 'tabindex="0"' @endphp
                                @php if($isColor): @endphp style="background: @php echo $swatch_map[$optKey] ?? '#ccc' @endphp; width:2.4rem; height:2.4rem; border-radius:9999px;" @php endif; @endphp
                            >
                            @php if(!$isColor): @endphp<span class="text-xs">@php echo htmlspecialchars($optLabel) @endphp</span>@php endif; @endphp
                            @php if(!$disabled): /* nothing */ else: @endphp
                                <span class="sr-only">Unavailable</span>
                            @php endif; @endphp
                            </button>
                        @php endforeach; @endphp
                        </div>
                    </div>
                    @php endforeach; @endphp

                    <!-- Selected summary (full-width) -->
                    <div class="col-span-1 sm:col-span-2 mt-2">
                        <label class="text-xs font-semibold block mb-1">Selected</label>
                        <div class="flex justify-between">
                            <div id="selectedSummary" class="mt-1 font-semibold text-sm text-slate-900 dark:text-slate-100">— / —</div>
                        </div>
                    </div>
                </div> --}}

                <!-- Quantity & Cart Actions -->
                @if ( !empty($product->FDPricing) && ($product->statusDetail->allow_order == 1) )
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 w-full">
                        <!-- Qty block -->
                        <div class="flex items-start sm:items-center gap-3">
                            <div>
                            {{-- <label for="qtyInput" class="text-xs font-semibold block mb-1">Qty</label> --}}

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
                                        class="w-9 h-9 flex items-center justify-center text-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 disabled:opacity-50"
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
                                        class="w-20 sm:w-16 text-center text-sm bg-white dark:bg-slate-800 outline-none border-l border-r border-transparent focus:outline-none focus:ring-0 px-2 cursor-default"
                                        style="min-width:3.5rem;"
                                        tabindex="0"
                                    />

                                    <button
                                        id="qtyInc"
                                        type="button"
                                        class="w-9 h-9 flex items-center justify-center text-sm focus:outline-none focus-visible:ring-2 focus-visible:ring-amber-500 disabled:opacity-50"
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
                                class="flex-1 sm:flex-none px-4 py-2 {{ FD['rounded'] }} bg-amber-600 hover:bg-amber-700 text-white font-semibold text-sm inline-flex items-center justify-center disabled:opacity-50 transition-shadow add-to-cart"
                                aria-label="Add to cart"
                                {{-- data-action="add-to-cart" --}}
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
                                class="px-4 py-2 {{ FD['rounded'] }} border border-amber-600 text-amber-600 dark:text-amber-300 text-sm font-semibold  add-to-cart"
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
                    <h3 class="text-sm font-semibold">Frequently bought together</h3>

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

                                <div class="text-sm font-semibold">@php echo $product['currency'] . number_format($base_price,2) @endphp</div>
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

                                    <div class="text-sm font-semibold">@php echo $product['currency'] . number_format($price,2) @endphp</div>
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
                            <div id="long-description">
                                <header class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                    <div>
                                        <h2 class="text-sm font-semibold mb-3">Product description</h2>
                                    </div>
                                </header>

                                <div class="text-sm space-y-4">
                                    <p class="text-sm text-gray-700 dark:text-gray-300">Short compelling product pitch. Use benefit-first language focusing on the customer's pain points and how the product solves them. Keep it scannable; expand below.</p>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-start">
                                        <figure class="{{ FD['rounded'] }} overflow-hidden border border-gray-100 dark:border-gray-800">
                                        <img src="https://dummyimage.com/800x600/eeeeee/888888&text=Feature+image+1" alt="Feature 1" class="w-full h-56 object-cover">
                                        </figure>

                                        <div>
                                        <h4 class="text-lg font-semibold">What makes it different</h4>
                                        <ul class="mt-3 space-y-2 text-sm text-gray-700 dark:text-gray-300">
                                            <li class="flex items-start gap-2"><svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg><span><strong>Precision-built</strong> components for long-lasting performance.</span></li>
                                            <li class="flex items-start gap-2"><svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none"><path d="M12 8v8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 12h8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg><span><strong>Fast setup</strong> — ready to use out of the box with guided instructions.</span></li>
                                            <li class="flex items-start gap-2"><svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="none"><path d="M3 12h18" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg><span><strong>Eco-friendly</strong> materials and low power consumption.</span></li>
                                        </ul>

                                        <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">Tip: Use bullet highlights like these to improve scan-ability. Convert each bullet into a short microcopy for mobile.</p>
                                        </div>
                                    </div>

                                    <!-- Long-form folded description with 'Read more' -->
                                    <div class="prose prose-sm dark:prose-invert bg-gray-50 dark:bg-gray-800 p-4 {{ FD['rounded'] }} border border-gray-100 dark:border-gray-800">
                                        <p class="text-sm text-gray-700 dark:text-gray-300">Longer, SEO-friendly product description that expands on technical details, benefits, and use cases. This should be crafted with keywords and structured headings. Use short paragraphs and subheads for readability.</p>

                                        <div id="longDescription" class="mt-3 text-sm text-gray-700 dark:text-gray-300 max-h-24 overflow-hidden transition-all">
                                            <p>Detailed paragraph 1 — describe how this product solves a user's top problem. Include measurable outcomes (e.g., "reduces setup time by 40%"), and concrete examples.</p>
                                            <p>Detailed paragraph 2 — talk about materials, construction, certifications, and compatibility with accessories.</p>
                                            <p>Detailed paragraph 3 — include warranty and service details, support channels, and any exclusives.</p>
                                        </div>

                                        <button id="toggleLongDesc" class="mt-3 text-sm font-medium underline text-blue-600 dark:text-blue-400" aria-expanded="false">Read more</button>
                                    </div>
                                </div>
                            </div>

                            <hr class="dark:border-gray-600">

                            <div id="faq">
                                <header class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                                    <div>
                                        <h2 class="text-sm font-semibold mb-3">Frequently asked questions</h2>
                                    </div>
                                </header>
                                <div class="space-y-4">
                                    <div class="flex items-center gap-2">
                                        <input id="faqSearch" type="search" placeholder="Search FAQs" class="w-full px-3 py-2 border rounded text-sm" aria-label="Search FAQs" />
                                    </div>

                                    <div id="faqsWrapper" class="mt-2 space-y-2">
                                    {{-- @foreach($faqs as $f)
                                        <div class="faq-item border dark:border-slate-700 p-3 {{ FD['rounded'] }}">
                                            <button class="faq-q w-full text-left flex items-center justify-between" aria-expanded="false">
                                                <span class="font-medium text-sm">{{ $f['q'] }}</span>
                                                <svg class="w-4 h-4 transform transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M6 9l6 6 6-6"/></svg>
                                            </button>
                                            <div class="faq-a mt-2 hidden text-sm text-slate-600 dark:text-slate-400">{{ $f['a'] }}</div>
                                        </div>
                                    @endforeach --}}
                                    </div>
                                </div>
                            </div>

                            <hr class="dark:border-gray-600">

                            {{-- <div id="reviews">
                                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                                    <div>
                                    <h2 class="text-lg font-semibold">Customer reviews</h2>
                                    <div class="text-xs text-slate-500 mt-1">Verified buyers • Most recent first</div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                    <label for="sortReviews" class="text-xs">Sort</label>
                                    <select id="sortReviews" class="px-2 py-1 border rounded text-sm">
                                        <option value="recent">Most recent</option>
                                        <option value="rating_desc">Top rated</option>
                                        <option value="rating_asc">Lowest rated</option>
                                    </select>
                                    </div>
                                </div>

                                <hr class="my-3 dark:border-slate-700"/>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="md:col-span-1 bg-amber-50 dark:bg-amber-900 p-4 {{ FD['rounded'] }}">
                                    <div class="text-center">
                                        <div class="text-3xl font-bold">@php
                                        $avg = 0; $total = count($reviews); if($total){ foreach($reviews as $r) $avg += $r['rating']; $avg = round($avg/$total,1); }
                                        echo $total ? $avg : '0.0';
                                        @endphp</div>
                                        <div class="text-xs text-slate-600 mt-1">based on @php echo $total @endphp reviews</div>
                                    </div>

                                    @php
                                        $ratingBuckets = [5=>0,4=>0,3=>0,2=>0,1=>0];
                                        foreach($reviews as $r) $ratingBuckets[$r['rating']]++;
                                    @endphp

                                    <div class="mt-3 space-y-2 text-sm">
                                        @foreach($ratingBuckets as $star => $count)
                                        <div class="flex items-center gap-2">
                                            <div class="w-10 text-xs">@php echo $star @endphp★</div>
                                            <div class="flex-1 bg-slate-200 dark:bg-slate-700 h-2 rounded overflow-hidden">
                                            <div style="width:@php echo $total? intval(($count/$total)*100):0 @endphp%" class="h-2 bg-amber-600"></div>
                                            </div>
                                            <div class="w-8 text-xs text-right">@php echo $count @endphp</div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <button id="openReviewModal2" class="mt-4 w-full px-3 py-2 {{ FD['rounded'] }} bg-amber-600 text-white text-sm">Write a review</button>
                                    </div>

                                    <div class="md:col-span-2" id="reviewsList">
                                    @foreach($reviews as $r)
                                        <article class="p-3 border dark:border-slate-700 {{ FD['rounded'] }} mb-3">
                                        <header class="flex items-start justify-between gap-3">
                                            <div>
                                            <div class="font-semibold">{{ $r['name'] }} <span class="text-xs text-slate-400">· {{ $r['date'] }}</span></div>
                                            <div class="flex items-center gap-1 mt-1">@for($i=0;$i<5;$i++) {!! $i < $r['rating'] ? '<svg class="w-3 h-3 text-amber-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>' : '<svg class="w-3 h-3 text-slate-300" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>' !!} @endfor</div>
                                            </div>
                                            <div class="text-xs text-slate-500">Verified purchase</div>
                                        </header>
                                        <div class="mt-2">
                                            <div class="font-semibold text-sm">{{ $r['title'] }}</div>
                                            <p class="mt-1 text-sm text-slate-700 dark:text-slate-300">{{ $r['body'] }}</p>
                                        </div>
                                        </article>
                                    @endforeach

                                    <!-- Load more (demo) -->
                                    <div class="text-center mt-4">
                                        <button id="loadMoreReviews" class="px-4 py-2 {{ FD['rounded'] }} border text-sm">Load more reviews</button>
                                    </div>
                                    </div>
                                </div>

                            </div> --}}
                        </div>
                    </div>

                    <aside class="lg:col-span-4 sticky md:top-[8.1rem] self-start space-y-4" id="pdpAsideQuickBar">
                        <div class="{{ FD['rounded'] }} border border-gray-100 dark:border-gray-800 p-4 bg-gray-50 dark:bg-gray-900 shadow-sm">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Limited time deal</p>
                                    <div class="flex items-baseline gap-3">
                                        <div class="text-2xl font-extrabold">₹9,499</div>
                                        <div class="text-sm line-through text-gray-500">₹12,999</div>
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
                                <div class="text-sm text-gray-600 dark:text-gray-400">Offer ends in <span id="dealCountdown" class="font-medium">02:13:45</span></div>
                            </div>

                            <div class="mt-4 grid grid-cols-2 gap-2">
                                <button class="py-2 px-3 {{ FD['rounded'] }} border border-gray-200 dark:border-gray-800 text-sm font-medium">Add to cart</button>
                                <button class="py-2 px-3 {{ FD['rounded'] }} bg-blue-600 text-white text-sm font-medium hover:bg-blue-700">Buy now</button>
                            </div>

                            <div class="mt-3 text-xs text-gray-500 dark:text-gray-400">Free delivery & easy returns. EMI options available.</div>
                        </div>

                        <!-- Small ad / cross-sell card -->
                        <div class="{{ FD['rounded'] }} border border-dashed border-gray-100 dark:border-gray-800 p-3 text-sm bg-gradient-to-br from-yellow-50 to-white dark:from-yellow-900 dark:to-gray-900">
                            <div class="flex items-start gap-3">
                                <div class="flex-shrink-0 w-12 h-12 {{ FD['rounded'] }} overflow-hidden">
                                <img src="https://dummyimage.com/120x120/eeeeee/888888&text=Bundle" alt="Bundle" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-semibold">Bundle & Save</h4>
                                    <span class="text-xs text-green-600 dark:text-green-400">-15%</span>
                                </div>
                                <p class="mt-1 text-xs text-gray-600 dark:text-gray-300">Add a matching accessory and get 15% off. Limited stock.</p>
                                <a href="#" class="mt-2 inline-block text-xs text-blue-600 dark:text-blue-400">View bundle</a>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 dark:bg-slate-900 {{ FD['rounded'] }} p-4 shadow-sm sticky top-28">
                            <div class="text-sm font-semibold">Need help deciding?</div>
                            <div class="mt-2 text-xs text-slate-600">Chat with our product experts for advice, bulk orders, or assembly help.</div>
                            <div class="mt-3 flex gap-2">
                                <button class="px-3 py-2 {{ FD['rounded'] }} bg-amber-600 text-white text-sm">Chat now</button>
                                <button class="px-3 py-2 {{ FD['rounded'] }} border text-sm">Call</button>
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
                    <div class="text-sm font-medium">₹9,499</div>
                    <div class="text-xs text-gray-500 dark:text-gray-400">Free delivery</div>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <button class="px-3 py-2 {{ FD['rounded'] }} border border-gray-200 dark:border-gray-700 text-sm">Add</button>
                    <button class="px-4 py-2 {{ FD['rounded'] }} bg-blue-600 text-white text-sm">Buy</button>
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


    // Variation
    @if ($variation['code'] == 200)
        const productCombinations = @json($variation['data']['combinations']);
        const attributeSlugs = @json(array_map(function($a){ return $a['slug']; }, $variation['data']['attributes']));
        const selectedOptions = {};

        // Helpers (same as before)
        function tokensOf(identifier) { return identifier.split('-').map(t => t.trim()).filter(Boolean); }
        function combinationMatchesSelectionTokens(tokens, selectionObj) {
            return Object.entries(selectionObj).every(([k, v]) => { if (!v) return true; return tokens.includes(v); });
        }
        function findExactMatch(selectedObj) {
            const values = attributeSlugs.map(s => selectedObj[s]).filter(Boolean);
            if (values.length !== attributeSlugs.length) return null;
            const normalized = values.slice().sort().join('|');
            return productCombinations.find(c => {
                const tokens = tokensOf(c.variation_identifier);
                return tokens.length === attributeSlugs.length && tokens.slice().sort().join('|') === normalized;
            }) || null;
        }

        function getLabelFor(input) {
            if (!input) return null;
            if (input.id) {
                const lab = document.querySelector(`label[for="${input.id}"]`);
                if (lab) return lab;
            }
            const ancestorLabel = input.closest && input.closest('label');
            if (ancestorLabel) return ancestorLabel;
            if (input.nextElementSibling && input.nextElementSibling.tagName === 'LABEL') return input.nextElementSibling;
            if (input.parentElement) {
                const found = input.parentElement.querySelector('label');
                if (found) return found;
            }
            return input.parentElement || null;
        }

        function enableLabel(label) { if (!label) return; label.classList.remove('opacity-50'); label.setAttribute('aria-disabled', 'false'); }
        function disableLabel(label) { if (!label) return; label.classList.add('opacity-50'); label.setAttribute('aria-disabled', 'true'); }

        const optionInputs = Array.from(document.querySelectorAll('.attr-val-generate'));

        // ======= FIXED: attach handlers to BOTH label and input, do NOT preventDefault =======
        optionInputs.forEach(input => {
            const label = getLabelFor(input);

            const handler = (ev) => {
                // don't preventDefault here — allow native checked toggling for robustness
                const attrSlug = input.dataset.attrSlug;
                const valueSlug = input.dataset.valueSlug ?? input.value;

                // ensure input is checked (useful when label click doesn't toggle underlying input)
                if ('checked' in input) input.checked = true;

                // update selected options and UI
                selectedOptions[attrSlug] = valueSlug;
                updateCombinationsUI();
            };

            // Listen to clicks on the visible label (if any)
            if (label) label.addEventListener('click', handler);

            // ALSO listen to the underlying input's change/click so we catch direct input interactions
            input.addEventListener('change', handler);
            input.addEventListener('click', handler);
        });
        // ======= End FIX =======

        // Initialize selectedOptions from checked inputs, otherwise pick first available per attribute
        (function initDefaults() {
            attributeSlugs.forEach(slug => {
                const checkedInput = optionInputs.find(i => i.dataset.attrSlug === slug && (i.checked || i.getAttribute('checked') !== null));
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

        function updateCombinationsUI() {
            // price update (same as your code)
            const exact = findExactMatch(selectedOptions);
            if (exact && exact.pricing && exact.pricing.length) {
                const p = exact.pricing[0];
                if (document.getElementById('priceBox')) document.getElementById('priceBox').innerText = p.selling_price_formatted ?? p.selling_price ?? '';
                if (document.getElementById('mrpBox')) document.getElementById('mrpBox').innerText = p.mrp_formatted ?? p.mrp ?? '';
                if (document.getElementById('savingsBox')) document.getElementById('savingsBox').innerText = p.savings_formatted ?? ((+p.mrp || 0) - (+p.selling_price || 0)) ?? '';
                if (document.getElementById('discountBox')) document.getElementById('discountBox').innerText = p.discount ?? '';
            }

            // enable/disable per-label (same logic)
            optionInputs.forEach(input => {
                const attr = input.dataset.attrSlug;
                const val = input.dataset.valueSlug ?? input.value;
                const testSelection = {...selectedOptions, [attr]: val};
                const isValid = productCombinations.some(c => {
                    const tokens = tokensOf(c.variation_identifier);
                    return combinationMatchesSelectionTokens(tokens, testSelection);
                });
                const label = getLabelFor(input);
                if (isValid) enableLabel(label); else disableLabel(label);

                // keep `aria-checked` for selected
                const isSelected = selectedOptions[attr] === val;
                if (label) label.setAttribute('aria-checked', isSelected ? 'true' : 'false');
            });

            // auto-fix invalid selected options (same logic)
            let changed = false;
            attributeSlugs.forEach(attr => {
                const cur = selectedOptions[attr];
                if (!cur) return;
                const stillValid = productCombinations.some(c => {
                    const tokens = tokensOf(c.variation_identifier);
                    return combinationMatchesSelectionTokens(tokens, selectedOptions);
                });
                if (!stillValid) {
                    const candidateInput = optionInputs.filter(i => i.dataset.attrSlug === attr).find(opt => {
                        const val = opt.dataset.valueSlug ?? opt.value;
                        const testSel = {...selectedOptions, [attr]: val};
                        return productCombinations.some(c => combinationMatchesSelectionTokens(tokensOf(c.variation_identifier), testSel));
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
                const exactAfter = findExactMatch(selectedOptions);
                if (exactAfter && exactAfter.pricing && exactAfter.pricing.length) {
                    const p = exactAfter.pricing[0];
                    if (document.getElementById('priceBox')) document.getElementById('priceBox').innerText = p.selling_price_formatted ?? p.selling_price ?? '';
                    if (document.getElementById('mrpBox')) document.getElementById('mrpBox').innerText = p.mrp_formatted ?? p.mrp ?? '';
                    if (document.getElementById('savingsBox')) document.getElementById('savingsBox').innerText = p.savings_formatted ?? ((+p.mrp || 0) - (+p.selling_price || 0)) ?? '';
                    if (document.getElementById('discountBox')) document.getElementById('discountBox').innerText = p.discount ?? '';
                }
                // re-run enable/disable
                optionInputs.forEach(input => {
                    const attr = input.dataset.attrSlug;
                    const val = input.dataset.valueSlug ?? input.value;
                    const testSelection = {...selectedOptions, [attr]: val};
                    const isValid = productCombinations.some(c => combinationMatchesSelectionTokens(tokensOf(c.variation_identifier), testSelection));
                    const label = getLabelFor(input);
                    if (isValid) enableLabel(label); else disableLabel(label);
                });
            }
        }
    @endif


})();
</script>

</x-guest-layout>