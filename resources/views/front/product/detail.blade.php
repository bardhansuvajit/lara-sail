<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Product') }}">

<div class="px-2 md:px-0 pt-2 md:pt-4 space-y-2 md:space-y-0">
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
        <div class="lg:col-span-5 bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-0 md:p-4 shadow-sm md:sticky md:top-[130px] md:mb-4">
            @if ($activeImagesCount > 0)
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
					{!! str_replace('w-32 h-32', 'w-72 h-72 md:w-96 md:h-96', FD['brokenImageFront']) !!}
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
                            <ol class="flex items-center gap-1 md:gap-2 flex-nowrap">
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
                                <li><span class="text-gray-800 font-medium dark:text-gray-300 line-clamp-1" title="{{ $product->title }}">{{ Str::limit($product->title, 25) }}</span></li>
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
                    <div class="pricing-block">
                        @php
                            $p = $product->FDPricing;
                            $currencySymbol = $p->country->currency_symbol;
                        @endphp

                        <div class="flex items-center">
                            <div class="singleProdPricingBox">
                                <div class="sellingPriceEl text-xl sm:text-2xl font-bold">
                                    <span class="currency-icon">{{ $currencySymbol }}</span><span class="priceBox">{{ formatIndianMoney($p->selling_price) }}</span>
                                </div>
                                @if ($p->mrp > 0)
                                    <div class="mrpEl text-xs text-slate-500 dark:text-slate-400">
                                        <span class="line-through">
                                            <span class="currency-icon">{{ $currencySymbol }}</span><span class="mrpBox">{{ formatIndianMoney($p->mrp) }}</span>
                                        </span>
                                    </div>
                                    <div class="savingsEl text-xs text-emerald-700 dark:text-emerald-300 font-bold mt-1">
                                        You save <span class="currency-icon">{{ $currencySymbol }}</span><span class="savingsBox">{{ formatIndianMoney($p->mrp - $p->selling_price) }}</span> 
                                        (<span class="discountBox">{{ $p->discount }}</span>% off)
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <section class="w-full flex items-center justify-center">
                        <div class="w-full text-center border border-slate-200 dark:border-slate-700 p-2 md:p-4 {{ FD['rounded'] }} bg-gray-100 dark:bg-slate-900 shadow-sm">
                            <div class="mb-2 md:mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-6 w-6 md:h-12 md:w-12 text-slate-400 dark:text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12A9 9 0 1112 3a9 9 0 019 9z" /></svg>
                            </div>
                            <h2 class="{{ FD['text-2'] }} font-semibold text-slate-800 dark:text-slate-200">Pricing not available</h2>
                            <p class="mt-2 {{ FD['text'] }} text-slate-600 dark:text-slate-400">
                                Product pricing is not available for your selected country.<br>
                                Please try changing your country to see updated prices.
                            </p>
                        </div>
                    </section>
                @endif

                <!-- Variations -->
                {{-- {{ dd($variation) }} --}}
                @if ($variation['code'] == 200)
                    <div class="space-y-2 md:space-y-4" id="variationTab">
                        @foreach ($variation['data']['attributes'] as $attrIndex => $attribute)
                        <div>
                            <fieldset>
                                <legend id="legend-{{ $attribute['slug'] }}" class="{{ FD['text-1'] }} font-semibold mb-2 text-gray-600 dark:text-gray-500">
                                    {{ $attribute['title'] }}
                                </legend>

                                <div class="flex flex-wrap space-x-0 md:space-x-2" role="radiogroup" aria-labelledby="legend-{{ $attribute['slug'] }}">
                                    @foreach ($attribute['values'] as $valueIndex => $value)
                                    <div class="group">
                                        <input
                                            type="radio"
                                            id="attr{{ $attrIndex }}{{ $valueIndex }}"
                                            name="variation-{{ $attribute['slug'] }}"
                                            value="{{ $value['slug'] }}"
                                            class="sr-only peer"
                                        />

                                        <label
                                            for="attr{{ $attrIndex }}{{ $valueIndex }}"
                                            role="radio"
                                            aria-checked="false"
                                            tabindex="0"
                                            class="inline-block rounded-full cursor-pointer text-gray-700 dark:text-gray-200 bg-gray-200 dark:bg-gray-600 border-2 border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 peer-checked:bg-gray-100 dark:peer-checked:bg-gray-800 peer-checked:border-primary-700 dark:peer-checked:border-primary-600 peer-checked:text-gray-900 dark:peer-checked:text-gray-100 px-2 py-1 mb-2 mr-2 transition duration-150 variation-label"
                                        >
                                            <p class="text-xs font-normal md:text-sm md:font-medium">{{ $value['title'] }}</p>
                                        </label>
                                    </div>
                                    @endforeach
                                </div>
                            </fieldset>
                        </div>
                        @endforeach
                    </div>
                @endif

                @if ($status->allow_order == 1)
                    <div class="flex justify-between items-center">
                        @if ($variation['code'] == 200)
                            <div class="selected-varaition" aria-live="polite" aria-atomic="true">
                                <div class="flex gap-2 text-xs text-slate-500 dark:text-slate-400">
                                    <p class="text-slate-500 dark:text-slate-300">Selected: </p>
                                    <div class="variationStatusSubtitle">
                                        <span class="italic">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <p class="{{ FD['text'] }} font-semibold {{ FD['rounded'] }} inline-block">
                            <span id="prodStatDetail" class="{{ $status->title_tailwind_classes }} {{ $status->bg_tailwind_classes }} px-3 py-1">
                                {{ $status->title_frontend }}
                            </span>
                        </p>
                    </div>
                @endif

                <!-- Quantity & Cart Actions -->
                @if ( !empty($product->FDPricing) && ($status->allow_order == 1) )
                    <div class="w-full orderPlaceButtons">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                            <!-- Qty block -->
                            {{-- <div class="flex items-start sm:items-center gap-3">
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
                            </div> --}}

                            <div class="flex gap-2 w-full md:w-auto md:justify-end items-center">
                                <button
                                    id="addToCartBtn"
                                    type="button"
                                    class="w-full md:w-max relative inline-flex items-center gap-3 {{ FD['rounded'] }} 
                                        px-2 py-1 md:px-4 md:py-2 
                                        text-sm md:text-xl font-bold
                                        bg-gradient-to-r from-amber-500 to-amber-400 hover:from-amber-600 hover:to-amber-500
                                        text-gray-900 shadow-lg shadow-amber-300/30 dark:shadow-amber-900/40
                                        transform transition-all duration-180
                                        focus:outline-none focus-visible:ring-4 focus-visible:ring-amber-300/40 focus-visible:ring-offset-1
                                        disabled:opacity-60 disabled:cursor-not-allowed add-to-cart"
                                        aria-label="Add to cart"
                                        data-prod-id="{{$product->id}}" 
                                        data-purchase-type="cart"
                                        data-variation-data="{{ json_encode($variation['data']['combinations'] ?? []) }}"
                                    >

                                    <span class="buttonIcon flex-none flex items-center justify-center">
                                        <div class="w-8 h-8">
                                            <svg viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff" stroke-width="0.00024000000000000003" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z" fill="#000000"></path> <path d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z" fill="#000000"></path> <path opacity="0.5" d="M2.08368 2.7512C2.22106 2.36044 2.64921 2.15503 3.03998 2.29242L3.34138 2.39838C3.95791 2.61511 4.48154 2.79919 4.89363 3.00139C5.33426 3.21759 5.71211 3.48393 5.99629 3.89979C6.27827 4.31243 6.39468 4.76515 6.44841 5.26153C6.47247 5.48373 6.48515 5.72967 6.49184 6H17.1301C18.815 6 20.3318 6 20.7757 6.57708C21.2197 7.15417 21.0461 8.02369 20.699 9.76275L20.1992 12.1875C19.8841 13.7164 19.7266 14.4808 19.1748 14.9304C18.6231 15.38 17.8426 15.38 16.2816 15.38H10.9787C8.18979 15.38 6.79534 15.38 5.92894 14.4662C5.06254 13.5523 4.9993 12.5816 4.9993 9.64L4.9993 7.03832C4.9993 6.29837 4.99828 5.80316 4.95712 5.42295C4.91779 5.0596 4.84809 4.87818 4.75783 4.74609C4.66977 4.61723 4.5361 4.4968 4.23288 4.34802C3.91003 4.18961 3.47128 4.03406 2.80367 3.79934L2.54246 3.7075C2.1517 3.57012 1.94629 3.14197 2.08368 2.7512Z" fill="#000000"></path> <path d="M13.75 9C13.75 8.58579 13.4142 8.25 13 8.25C12.5858 8.25 12.25 8.58579 12.25 9V10.25H11C10.5858 10.25 10.25 10.5858 10.25 11C10.25 11.4142 10.5858 11.75 11 11.75H12.25V13C12.25 13.4142 12.5858 13.75 13 13.75C13.4142 13.75 13.75 13.4142 13.75 13V11.75H15C15.4142 11.75 15.75 11.4142 15.75 11C15.75 10.5858 15.4142 10.25 15 10.25H13.75V9Z" fill="#000000"></path> </g></svg>
                                        </div>
                                    </span>

                                    <span class="buttonLoader hidden">
                                        <div class="flex-none flex items-center justify-center">
                                            <div class="w-8 h-8">
                                                <svg class="animate-spin" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path fill="none" d="M0 0h24v24H0z"></path> <path d="M18.364 5.636L16.95 7.05A7 7 0 1 0 19 12h2a9 9 0 1 1-2.636-6.364z"></path> </g> </g></svg>
                                            </div>
                                        </div>
                                    </span>

                                    <span class="buttonLabel">Add to Cart</span>
                                </button>

                                <button
                                    id="buyNowBtn"
                                    type="button"
                                    class="w-full md:w-max relative inline-flex items-center gap-3 {{ FD['rounded'] }} 
                                        px-2 py-1 md:px-4 md:py-2 
                                        text-sm md:text-xl font-bold
                                        bg-gradient-to-r from-sky-600 to-indigo-600 hover:from-sky-700 hover:to-indigo-700
                                        text-white shadow-lg shadow-sky-300/30 dark:shadow-indigo-900/40
                                        transform transition-all duration-180
                                        focus:outline-none focus-visible:ring-4 focus-visible:ring-sky-300/40 focus-visible:ring-offset-1
                                        disabled:opacity-60 disabled:cursor-not-allowed add-to-cart"
                                        aria-label="Buy now"
                                        data-prod-id="{{$product->id}}" 
                                        data-purchase-type="buy"
                                        data-variation-data="{{ json_encode($variation['data']['combinations'] ?? []) }}"
                                        >

                                    <span class="buttonIcon flex-none flex items-center justify-center">
                                        <div class="w-8 h-8">
                                            <svg viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff" stroke-width="0.00024000000000000003" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z" fill="#3cc039"></path> <path d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z" fill="#3cc039"></path> <path opacity="0.5" d="M2.08368 2.7512C2.22106 2.36044 2.64921 2.15503 3.03998 2.29242L3.34138 2.39838C3.95791 2.61511 4.48154 2.79919 4.89363 3.00139C5.33426 3.21759 5.71211 3.48393 5.99629 3.89979C6.27827 4.31243 6.39468 4.76515 6.44841 5.26153C6.47247 5.48373 6.48515 5.72967 6.49184 6H17.1301C18.815 6 20.3318 6 20.7757 6.57708C21.2197 7.15417 21.0461 8.02369 20.699 9.76275L20.1992 12.1875C19.8841 13.7164 19.7266 14.4808 19.1748 14.9304C18.6231 15.38 17.8426 15.38 16.2816 15.38H10.9787C8.18979 15.38 6.79534 15.38 5.92894 14.4662C5.06254 13.5523 4.9993 12.5816 4.9993 9.64L4.9993 7.03832C4.9993 6.29837 4.99828 5.80316 4.95712 5.42295C4.91779 5.0596 4.84809 4.87818 4.75783 4.74609C4.66977 4.61723 4.5361 4.4968 4.23288 4.34802C3.91003 4.18961 3.47128 4.03406 2.80367 3.79934L2.54246 3.7075C2.1517 3.57012 1.94629 3.14197 2.08368 2.7512Z" fill="#3cc039"></path> <path d="M13.75 9C13.75 8.58579 13.4142 8.25 13 8.25C12.5858 8.25 12.25 8.58579 12.25 9V10.25H11C10.5858 10.25 10.25 10.5858 10.25 11C10.25 11.4142 10.5858 11.75 11 11.75H12.25V13C12.25 13.4142 12.5858 13.75 13 13.75C13.4142 13.75 13.75 13.4142 13.75 13V11.75H15C15.4142 11.75 15.75 11.4142 15.75 11C15.75 10.5858 15.4142 10.25 15 10.25H13.75V9Z" fill="#3cc039"></path> </g></svg>
                                        </div>
                                    </span>

                                    <span class="buttonLoader hidden">
                                        <div class="flex-none flex items-center justify-center">
                                            <div class="w-8 h-8">
                                                <svg class="animate-spin" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path fill="none" d="M0 0h24v24H0z"></path> <path d="M18.364 5.636L16.95 7.05A7 7 0 1 0 19 12h2a9 9 0 1 1-2.636-6.364z"></path> </g> </g></svg>
                                            </div>
                                        </div>
                                    </span>

                                    <span class="buttonLabel">Buy Now</span>
                                </button>
                            </div>

                        </div>
                    </div>
                @else
                    @if (!empty($product->FDPricing))
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
                @endif

                <hr class="mt-5 mb-2 dark:border-gray-600">

                <!-- productBadges -->
                <div id="productBadges" class="">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 md:gap-4">
                        @foreach ($allBadges as $badge)
                            <div role="listitem" class="flex flex-col items-center text-center p-0 md:p-3 bg-white dark:bg-slate-800 {{ FD['rounded'] }} shadow-sm">
                                <div class="w-5 h-5 md:w-8 md:h-8 flex items-center justify-center mb-2 text-gray-600 dark:text-gray-300" aria-hidden="true">
                                    {!! $badge['icon'] !!}
                                </div>
                                <h5 class="text-[10px] md:text-xs font-medium text-gray-800 dark:text-gray-100">{{ $badge['title'] }}</h5>
                                <p class="text-[10px] md:text-xs text-gray-500 dark:text-gray-400">{{ $badge['desc'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col gap-4">
        <!-- UPSELL -->
        @if (count($upsells) > 0)
            <div class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-2 md:p-4 shadow-sm">
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
        <section id="pdp-description" class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-2 md:p-4 shadow-sm">
            <div class="mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-2 md:gap-4">
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

                                    <div class="text-xs leading-tight text-gray-600 dark:text-gray-400">
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

                                                <input type="search" id="default-search" value="{{ request()->input('q') }}" class="block w-full px-1 py-2 {{FD['text']}} text-gray-900 border border-gray-100 {{ FD['rounded'] }} ps-8 bg-gray-100 focus:ring-primary-500 focus:border-primary-500  dark:bg-gray-700 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search FAQs..." autocomplete="off">
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
                                    <div class="" id="faq-list">
                                        @foreach($faqs as $index => $faq)
                                            <article class="md:p-4 md:border dark:border-slate-700 {{ FD['rounded'] }} mb-6 md:mb-4">
                                                <p class="font-semibold {{ FD['text'] }} text-slate-700 dark:text-slate-300">
                                                    <span class="font-bold text-slate-900 dark:text-white">Q.</span>
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
                                                            <span class="font-bold text-slate-800 dark:text-white">A.</span>
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

                                    @php
                                        $total = $product->review_count; 
                                    @endphp

                                    <x-front.product-detail-block-header
                                        title="Customer reviews"
                                        subtitle="{{ formatIndianMoney($total).' '.($total == 1 ? 'review' : 'reviews') }} found"
                                    />

                                    {{-- <hr class="my-3 border-gray-200/50 dark:border-gray-700/50"/> --}}

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 md:gap-4">
                                        {{-- Review highlight section with fixed height --}}
                                        <div class="md:col-span-1 bg-primary-50 dark:bg-gray-900/50 p-4 {{ FD['rounded'] }} h-fit">
                                            <x-front.product-review-highlight 
                                                :product_slug="$product->slug"
                                                :average_rating="$product->average_rating"
                                                :review_count="$product->review_count"
                                                :all_reviews="$allReviews"
                                            />
                                        </div>

                                        <div class="md:col-span-2" id="reviewsList">
                                            @foreach($reviews as $r)
                                                <x-front.product-review-block 
                                                    :data="$r"
                                                />
                                            @endforeach

                                            @if ($total > 3)
                                                <div class="flex justify-center mt-2 md:mt-4">
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
                                            @endif
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

                    <aside class="lg:col-span-4 sticky md:top-[8.1rem] self-start space-y-2 md:space-y-4" id="pdpAsideQuickBar">
                        <div class="{{ FD['rounded'] }} border border-gray-100 dark:border-gray-800 p-4 bg-slate-100 dark:bg-gray-900 shadow-sm">
                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <p class="{{ FD['text-1'] }} text-gray-500 dark:text-gray-300">{{ $product->title }}</p>

                                    @if ($status->allow_order == 1)
                                        <div class="flex justify-between items-center mb-2">
                                            @if ($variation['code'] == 200)
                                                <div class="selected-varaition max-w-xs w-full" aria-live="polite" aria-atomic="true">
                                                    <div class="flex gap-2 text-xs text-slate-500 dark:text-slate-600">
                                                        <div class="variationStatusSubtitle">
                                                            <span class="italic">Loading...</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    <!-- Price block -->
                                    @if ( !empty($product->FDPricing) )
                                        <div class="singleProdPricingBox">
                                            <div class="sellingPriceEl text-xl sm:text-2xl font-bold">
                                                <span class="currency-icon">{{ $currencySymbol }}</span><span class="priceBox">{{ formatIndianMoney($p->selling_price) }}</span>
                                            </div>
                                            @if ($p->mrp > 0)
                                                <div class="mrpEl text-xs text-slate-500 dark:text-slate-400">
                                                    <span class="line-through">
                                                        <span class="currency-icon">{{ $currencySymbol }}</span><span class="mrpBox">{{ formatIndianMoney($p->mrp) }}</span>
                                                    </span>
                                                </div>
                                                <div class="savingsEl text-xs text-emerald-700 dark:text-emerald-300 font-bold mt-1">
                                                    You save <span class="currency-icon">{{ $currencySymbol }}</span><span class="savingsBox">{{ formatIndianMoney($p->mrp - $p->selling_price) }}</span> 
                                                    (<span class="discountBox">{{ $p->discount }}</span>% off)
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="mt-4">
                                            <div class="flex items-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-6 w-6 text-slate-400 dark:text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12A9 9 0 1112 3a9 9 0 019 9z" /></svg>
                                                <h2 class="{{ FD['text-1'] }} text-slate-800 dark:text-slate-200">Pricing not available</h2>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                @if ($activeImagesCount > 0)
                                    <div class="w-24 h-24 flex-shrink-0 {{ FD['rounded'] }} overflow-hidden border border-gray-100 dark:border-gray-800">
                                    <img src="{{ Storage::url($images[0]->image_m) }}"
                                        alt="Main product image"
                                        class="w-full h-full object-cover transition-transform duration-300"
                                        loading="lazy"
                                        />
                                    </div>
                                @else
                                    <div class="w-24 h-24 flex-shrink-0 {{ FD['rounded'] }} overflow-hidden">
                                        <div class="w-full h-full object-cover">
                                            {!! FD['brokenImageFront'] !!}
                                        </div>
                                    </div>
                                @endif
                            </div>

                            {{-- <div class="mt-3 flex items-center gap-2">
                                <div class="{{ FD['iconClass'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                </div>
                                <div class="{{ FD['text-1'] }} text-gray-600 dark:text-gray-400">Offer ends in <span id="dealCountdown" class="font-medium">02:13:45</span></div>
                            </div> --}}

                            @if ( !empty($product->FDPricing) )
                                <div class="mt-4 orderPlaceButtons">
                                    <div class="flex space-x-2">
                                        <button class="flex w-full items-center justify-center {{ FD['rounded'] }} bg-gradient-to-r from-amber-400 via-amber-500 to-amber-600 px-4 py-2 text-sm font-bold text-gray-800 shadow-lg hover:from-amber-500 hover:via-amber-600 hover:to-amber-700 focus:outline-none focus:ring-4 focus:ring-amber-300/40 focus:ring-offset-2 transition-all duration-200 add-to-cart"
                                            aria-label="Add to cart"
                                            data-prod-id="{{$product->id}}" 
                                            data-purchase-type="cart"
                                            data-variation-data="{{ json_encode($variation['data']['combinations'] ?? []) }}"
                                            >
                                            <span class="buttonLabel">Add to Cart</span>
                                        </button>

                                        <button class="flex w-full items-center justify-center {{ FD['rounded'] }} bg-gradient-to-r from-indigo-500 via-indigo-600 to-indigo-700 px-4 py-2 text-sm font-bold text-white shadow-md hover:scale-101 hover:from-indigo-600 hover:via-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300/40 focus:ring-offset-2 transition-all duration-200 add-to-cart"
                                            aria-label="Buy now"
                                            data-prod-id="{{$product->id}}" 
                                            data-purchase-type="buy"
                                            data-variation-data="{{ json_encode($variation['data']['combinations'] ?? []) }}"
                                            >
                                            <span class="buttonLabel">Buy Now</span>
                                        </button>

                                    </div>
                                </div>
                            @endif

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

                        <div class="bg-slate-100 dark:bg-slate-900 {{ FD['rounded'] }} p-4 shadow-sm sticky top-28">
                            <div class="{{ FD['text-1'] }} font-semibold">Need help deciding?</div>
                            <div class="mt-2 text-xs text-slate-500">Chat with our product experts for advice, bulk orders, or assembly help.</div>
                            <div class="mt-3 flex gap-2">
                                <button class="px-3 py-2 {{ FD['rounded'] }} bg-sky-600 hover:bg-sky-700 active:ring-2 active:ring-sky-300 text-white {{ FD['text-1'] }} flex gap-2 items-center">
                                    <div class="w-6 h-6">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M12 23C18.0751 23 23 18.0751 23 12C23 5.92487 18.0751 1 12 1C5.92487 1 1 5.92487 1 12C1 13.7596 1.41318 15.4228 2.14781 16.8977C2.34303 17.2897 2.40801 17.7377 2.29483 18.1607L1.63966 20.6093C1.35525 21.6723 2.32772 22.6447 3.39068 22.3603L5.83932 21.7052C6.26233 21.592 6.71033 21.657 7.10228 21.8522C8.5772 22.5868 10.2404 23 12 23Z" fill="#c9c9c9"></path> <path d="M10.9 12.0004C10.9 12.6079 11.3925 13.1004 12 13.1004C12.6075 13.1004 13.1 12.6079 13.1 12.0004C13.1 11.3929 12.6075 10.9004 12 10.9004C11.3925 10.9004 10.9 11.3929 10.9 12.0004Z" fill="#c9c9c9"></path> <path d="M6.5 12.0004C6.5 12.6079 6.99249 13.1004 7.6 13.1004C8.20751 13.1004 8.7 12.6079 8.7 12.0004C8.7 11.3929 8.20751 10.9004 7.6 10.9004C6.99249 10.9004 6.5 11.3929 6.5 12.0004Z" fill="#c9c9c9"></path> <path d="M15.3 12.0004C15.3 12.6079 15.7925 13.1004 16.4 13.1004C17.0075 13.1004 17.5 12.6079 17.5 12.0004C17.5 11.3929 17.0075 10.9004 16.4 10.9004C15.7925 10.9004 15.3 11.3929 15.3 12.0004Z" fill="#c9c9c9"></path> </g></svg>
                                    </div>
                                    Chat now
                                </button>

                                <button class="px-3 py-2 {{ FD['rounded'] }} bg-lime-600 hover:bg-lime-700 active:ring-2 active:ring-lime-300 text-white {{ FD['text-1'] }} flex gap-2 items-center">
                                    <div class="w-6 h-6">
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path opacity="0.5" d="M14.5562 15.5477L14.1007 16.0272C14.1007 16.0272 13.0181 17.167 10.0631 14.0559C7.10812 10.9448 8.1907 9.80507 8.1907 9.80507L8.47752 9.50311C9.18407 8.75924 9.25068 7.56497 8.63424 6.6931L7.37326 4.90961C6.61028 3.8305 5.13596 3.68795 4.26145 4.60864L2.69185 6.26114C2.25823 6.71766 1.96765 7.30945 2.00289 7.96594C2.09304 9.64546 2.81071 13.259 6.81536 17.4752C11.0621 21.9462 15.0468 22.1239 16.6763 21.9631C17.1917 21.9122 17.6399 21.6343 18.0011 21.254L19.4217 19.7584C20.3806 18.7489 20.1102 17.0182 18.8833 16.312L16.9728 15.2123C16.1672 14.7486 15.1858 14.8848 14.5562 15.5477Z" fill="#a0e59f"></path> <path d="M17 12C19.7614 12 22 9.76142 22 7C22 4.23858 19.7614 2 17 2C14.2386 2 12 4.23858 12 7C12 7.79984 12.1878 8.55582 12.5217 9.22624C12.6105 9.4044 12.64 9.60803 12.5886 9.80031L12.2908 10.9133C12.1615 11.3965 12.6035 11.8385 13.0867 11.7092L14.1997 11.4114C14.392 11.36 14.5956 11.3895 14.7738 11.4783C15.4442 11.8122 16.2002 12 17 12Z" fill="#a0e59f"></path> </g></svg>
                                    </div>
                                    Call
                                </button>
                            </div>

                            <div class="mt-4 border-t border-slate-300 dark:border-slate-600 pt-3 text-xs text-slate-500 dark:text-slate-600 space-y-2">
                                <div>
                                    <strong>Delivery:</strong>
                                    <p class="inline text-slate-800 dark:text-slate-400">2-5 days</p>
                                </div>
                                <div>
                                    <strong>Return:</strong>
                                    <p class="inline text-slate-800 dark:text-slate-400">7 days (eligible)</p>
                                </div>
                            </div>
                            {{-- <div class="mt-4 border-t pt-3 text-xs text-slate-600">
                                <div><strong>Delivery:</strong> @php echo ($product['shipping']['estimate_days'][0] ?? '—') . ' - ' . ($product['shipping']['estimate_days'][1] ?? '—') @endphp days</div>
                                <div class="mt-1"><strong>Return:</strong> 7 days (eligible)</div>
                                <div class="mt-1"><strong>Warranty:</strong> @php echo $product['specs']['Warranty'] ?? '—' @endphp</div>
                            </div> --}}
                        </div>

                    </aside>
                </div>
            </div>

            <!-- Mobile sticky CTA -->
            @if ( !empty($product->FDPricing) )
                <div id="mobileCta" class="fixed bottom-16 left-1/2 -translate-x-1/2 z-50 w-[96%] sm:hidden">
                    <div class="flex items-center justify-between bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 {{ FD['rounded'] }} p-2 md:p-4 shadow-lg">
                        <div class="flex items-center gap-2">
                            @if ($activeImagesCount > 0)
                                <div class="w-12 h-12 flex-shrink-0 {{ FD['rounded'] }} overflow-hidden border border-gray-100 dark:border-gray-800">
                                <img src="{{ Storage::url($images[0]->image_m) }}"
                                    alt="Main product image"
                                    class="w-full h-full object-cover transition-transform duration-300"
                                    loading="lazy"
                                    />
                                </div>
                            @else
                                <div class="w-12 h-12 flex-shrink-0 {{ FD['rounded'] }} overflow-hidden">
                                    <div class="w-full h-full object-cover">
                                        {!! FD['brokenImageFront'] !!}
                                    </div>
                                </div>
                            @endif

                            <!-- Price block -->
                            @if ( !empty($product->FDPricing) )
                                <div class="singleProdPricingBox">
                                    <div class="sellingPriceEl text-xl sm:text-2xl font-bold">
                                        <span class="currency-icon">{{ $currencySymbol }}</span><span class="priceBox">{{ formatIndianMoney($p->selling_price) }}</span>
                                    </div>
                                    @if ($p->mrp > 0)
                                        <div class="mrpEl text-xs text-slate-500 dark:text-slate-400">
                                            <span class="line-through">
                                                <span class="currency-icon">{{ $currencySymbol }}</span><span class="mrpBox">{{ formatIndianMoney($p->mrp) }}</span>
                                            </span>
                                        </div>
                                        {{-- <div class="savingsEl text-xs text-emerald-700 dark:text-emerald-300 font-bold mt-1">
                                            You save <span class="currency-icon">{{ $currencySymbol }}</span><span class="savingsBox">{{ formatIndianMoney($p->mrp - $p->selling_price) }}</span> 
                                            (<span class="discountBox">{{ $p->discount }}</span>% off)
                                        </div> --}}
                                    @endif
                                </div>
                            @endif
                        </div>
                        <div class="flex items-center gap-2">
                            <button
                                type="button"
                                class="w-full md:w-max relative inline-flex items-center gap-3 {{ FD['rounded'] }} 
                                    px-2 py-1 md:px-4 md:py-2 
                                    text-sm md:text-xl font-bold
                                    bg-gradient-to-r from-sky-600 to-indigo-600 hover:from-sky-700 hover:to-indigo-700
                                    text-white shadow-lg shadow-sky-300/30 dark:shadow-indigo-900/40
                                    transform transition-all duration-180
                                    focus:outline-none focus-visible:ring-4 focus-visible:ring-sky-300/40 focus-visible:ring-offset-1
                                    disabled:opacity-60 disabled:cursor-not-allowed add-to-cart"
                                    aria-label="Buy now"
                                    data-prod-id="{{$product->id}}" 
                                    data-purchase-type="buy"
                                    data-variation-data="{{ json_encode($variation['data']['combinations'] ?? []) }}"
                                    >

                                <span class="buttonIcon flex-none flex items-center justify-center">
                                    <div class="w-8 h-8">
                                        <svg viewBox="-2.4 -2.4 28.80 28.80" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff" stroke-width="0.00024000000000000003" transform="rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0" transform="translate(0,0), scale(1)"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.5 18C8.32843 18 9 18.6716 9 19.5C9 20.3284 8.32843 21 7.5 21C6.67157 21 6 20.3284 6 19.5C6 18.6716 6.67157 18 7.5 18Z" fill="#3cc039"></path> <path d="M16.5 18.0001C17.3284 18.0001 18 18.6716 18 19.5001C18 20.3285 17.3284 21.0001 16.5 21.0001C15.6716 21.0001 15 20.3285 15 19.5001C15 18.6716 15.6716 18.0001 16.5 18.0001Z" fill="#3cc039"></path> <path opacity="0.5" d="M2.08368 2.7512C2.22106 2.36044 2.64921 2.15503 3.03998 2.29242L3.34138 2.39838C3.95791 2.61511 4.48154 2.79919 4.89363 3.00139C5.33426 3.21759 5.71211 3.48393 5.99629 3.89979C6.27827 4.31243 6.39468 4.76515 6.44841 5.26153C6.47247 5.48373 6.48515 5.72967 6.49184 6H17.1301C18.815 6 20.3318 6 20.7757 6.57708C21.2197 7.15417 21.0461 8.02369 20.699 9.76275L20.1992 12.1875C19.8841 13.7164 19.7266 14.4808 19.1748 14.9304C18.6231 15.38 17.8426 15.38 16.2816 15.38H10.9787C8.18979 15.38 6.79534 15.38 5.92894 14.4662C5.06254 13.5523 4.9993 12.5816 4.9993 9.64L4.9993 7.03832C4.9993 6.29837 4.99828 5.80316 4.95712 5.42295C4.91779 5.0596 4.84809 4.87818 4.75783 4.74609C4.66977 4.61723 4.5361 4.4968 4.23288 4.34802C3.91003 4.18961 3.47128 4.03406 2.80367 3.79934L2.54246 3.7075C2.1517 3.57012 1.94629 3.14197 2.08368 2.7512Z" fill="#3cc039"></path> <path d="M13.75 9C13.75 8.58579 13.4142 8.25 13 8.25C12.5858 8.25 12.25 8.58579 12.25 9V10.25H11C10.5858 10.25 10.25 10.5858 10.25 11C10.25 11.4142 10.5858 11.75 11 11.75H12.25V13C12.25 13.4142 12.5858 13.75 13 13.75C13.4142 13.75 13.75 13.4142 13.75 13V11.75H15C15.4142 11.75 15.75 11.4142 15.75 11C15.75 10.5858 15.4142 10.25 15 10.25H13.75V9Z" fill="#3cc039"></path> </g></svg>
                                    </div>
                                </span>

                                <span class="buttonLoader hidden">
                                    <div class="flex-none flex items-center justify-center">
                                        <div class="w-8 h-8">
                                            <svg class="animate-spin" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path fill="none" d="M0 0h24v24H0z"></path> <path d="M18.364 5.636L16.95 7.05A7 7 0 1 0 19 12h2a9 9 0 1 1-2.636-6.364z"></path> </g> </g></svg>
                                        </div>
                                    </div>
                                </span>

                                <span class="buttonLabel">Buy Now</span>
                            </button>

                        </div>
                    </div>
                </div>
            @endif

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

    if (mainImage) {
        let zoomPane = null;          // the zoom pane element appended to body
        let currentSrc = mainImage.src;
        let boundHandlers = {};


        const qtyGroup = document.getElementById('qtyGroup');
        const qtyInput = document.getElementById('qtyInput');
        const decBtn = document.getElementById('qtyDec');
        const incBtn = document.getElementById('qtyInc');
        const stockHelper = document.getElementById('stockHelper');

        // Settings
        // const minQty = parseInt(qtyGroup.dataset.minQty || '1', 10);
        // const serverMax = parseInt(qtyGroup.dataset.maxStock || '99', 10);
        // const step = parseInt(qtyGroup.dataset.step || '1', 10);

        // Hard cap for business rule
        const HARD_MAX = 99;

        // acceleration settings for long-press buttons
        const accelerateIntervalStart = 400; // ms
        const accelerateIntervalMin = 60; // ms

        // compute effective max stock (clamped to HARD_MAX)
        // let maxStock = Math.min(Math.max(0, serverMax), HARD_MAX);
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
    }
})();
</script>

<script>
(function () {
    const currencyIcon = '{{ $currencyIcon }}';
    const prodStatDetail = document.getElementById('prodStatDetail');
    const variationDisplay = document.querySelectorAll('.variationStatusSubtitle');

    const isMobile = () => {
        if (window.matchMedia("(max-width: 767px)").matches) {
            return true;
        } else {
            return false;
        }
    }

    // productData injected from Blade
    const productData = @json($variation['data']);
    // console.log('productData>>', JSON.stringify(productData));

    // helpers
    const combosByIdentifier = {};
    (productData.combinations || []).forEach(c => {
        combosByIdentifier[c.variation_identifier] = c;
    });

    function parseIdentifierToMap(identifier) {
        const map = {};
        if (!identifier) return map;
        const tokens = identifier.split('-');
        let i = 0;

        for (const attr of productData.attributes) {
            let matched = null;
            // try longest-first to allow multi-token values (e.g. '256-gb')
            for (let take = Math.min(tokens.length - i, tokens.length); take >= 1; take--) {
                const candidate = tokens.slice(i, i + take).join('-');
                if (attr.values.some(v => v.slug === candidate)) {
                    matched = candidate;
                    i += take;
                    break;
                }
            }
            // IMPORTANT: do NOT default to attr.values[0].slug when nothing matches.
            if (matched) map[attr.slug] = matched;
            // otherwise leave this attribute absent (partial selection)
        }
        return map;
    }

    function combinationToMap(c) { return parseIdentifierToMap(c.variation_identifier); }

    function findCombinationForSelection(selection) {
        // quick exact identifier match when selection has all attributes
        const slugs = productData.attributes.map(a => selection[a.slug]).filter(Boolean);
        const identifier = slugs.length ? slugs.join('-') : '';

        if (identifier && combosByIdentifier[identifier]) {
            return combosByIdentifier[identifier];
        }

        // fallback: find any combo that matches all keys present in selection
        const providedKeys = Object.keys(selection).filter(k => selection[k]);
        return (productData.combinations || []).find(c => {
            const map = combinationToMap(c);
            return providedKeys.every(k => map[k] === selection[k]);
        }) || null;
    }

    function isValueValid(attrSlug, valueSlug, partialSelection) {
        return (productData.combinations || []).some(c => {
        const map = combinationToMap(c);
        for (const [k, v] of Object.entries(partialSelection)) {
            if (map[k] !== v) return false;
        }
        return map[attrSlug] === valueSlug;
        });
    }

    function chooseBestComboForAttributeValue(attrSlug, valueSlug, currentPartial) {
        const candidates = (productData.combinations || [])
        .map(c => ({ combo: c, map: combinationToMap(c) }))
        .filter(x => x.map[attrSlug] === valueSlug);

        if (candidates.length === 0) return null;

        let best = candidates[0];
        let bestScore = -1;
        for (const c of candidates) {
        let score = 0;
        for (const [k, v] of Object.entries(currentPartial)) {
            if (c.map[k] && c.map[k] === v) score++;
        }
        if (score > bestScore) { bestScore = score; best = c; }
        }
        return best.map;
    }

    // URL helpers
    function getVariantFromURL() {
        try { return new URLSearchParams(window.location.search).get('variation'); }
        catch (e) { return null; }
    }

    function updateURL(selectionOrCombo) {
        try {
            const url = new URL(window.location.href);
            let identifier = '';

            if (!selectionOrCombo) {
                // nothing -> remove param
                url.searchParams.delete('variation');
                history.replaceState(null, '', url.toString());
                return;
            }

            // if a combo object is passed, prefer its canonical identifier
            if (selectionOrCombo.variation_identifier) {
                identifier = selectionOrCombo.variation_identifier;
            } else {
                // otherwise build from selection slugs (may be partial)
                const slugs = productData.attributes
                    .map(a => selectionOrCombo[a.slug])
                    .filter(Boolean);
                if (slugs.length) identifier = slugs.join('-');
            }

            if (identifier) url.searchParams.set('variation', identifier);
            else url.searchParams.delete('variation');

            history.replaceState(null, '', url.toString());
        } catch (e) {
            // ignore URL failures (e.g. non-browser env)
        }
    }


    // initial selection: try URL, else fallback to first available combo
    function initialSelection() {
        if (!productData.combinations || productData.combinations.length === 0) return {};
        const urlVariant = getVariantFromURL();
        if (urlVariant && combosByIdentifier[urlVariant]) return parseIdentifierToMap(urlVariant);
        // prefer the first combination that has allow_order === true (if any), else first combo
        const firstAllowed = productData.combinations.find(c => c.allow_order);
        return parseIdentifierToMap((firstAllowed || productData.combinations[0]).variation_identifier);
    }

    // DOM helpers (IDs are rendered by Blade as attr{attrIndex}{valueIndex})
    function buildRadioId(attrIndex, valueIndex) { return `attr${attrIndex}${valueIndex}`; }

    // find label for a given input id
    function labelFor(inputId) { 
        const input = document.getElementById(inputId);
        if (!input) return null;
        // label is immediate sibling in your Blade markup
        return input.nextElementSibling && input.nextElementSibling.tagName === 'LABEL' ? input.nextElementSibling : document.querySelector(`label[for="${inputId}"]`);
    }

    let currentSelection = initialSelection();

    // attach listeners to existing inputs/labels rendered by Blade
    function attachHandlers() {
        productData.attributes.forEach((attribute, attrIndex) => {
            attribute.values.forEach((value, valueIndex) => {
                const id = buildRadioId(attrIndex, valueIndex);
                const input = document.getElementById(id);
                const label = labelFor(id);
                if (!input || !label) return;

                // make sure label has role=radio and is focusable (Blade sets this but safeguard)
                label.setAttribute('role', 'radio');
                label.tabIndex = label.tabIndex >= 0 ? label.tabIndex : 0;

                // input change (screen reader / native interaction)
                input.addEventListener('change', (ev) => {
                    if (ev.target.checked) {
                        const best = chooseBestComboForAttributeValue(attribute.slug, value.slug, currentSelection) || {};
                        if (Object.keys(best).length) {
                            currentSelection = { ...best };
                        } else {
                            currentSelection[attribute.slug] = value.slug;
                        }
                        updateUI();
                    }
                });

                // label click (intent) - allow clicking unavailable options
                label.addEventListener('click', (ev) => {
                    ev.preventDefault();
                    const bestMap = chooseBestComboForAttributeValue(attribute.slug, value.slug, currentSelection);
                    if (bestMap) currentSelection = { ...bestMap };
                    else currentSelection[attribute.slug] = value.slug;

                    // mark input checked
                    input.checked = true;
                    updateUI();
                });

                // keyboard interactions for label
                label.addEventListener('keydown', (ev) => {
                if (ev.key === 'Enter' || ev.key === ' ') {
                    ev.preventDefault();
                    label.click();
                    return;
                }
                if (ev.key === 'ArrowRight' || ev.key === 'ArrowDown') {
                    ev.preventDefault();
                    focusSiblingWithinGroup(attribute.slug, label, +1);
                    return;
                }
                if (ev.key === 'ArrowLeft' || ev.key === 'ArrowUp') {
                    ev.preventDefault();
                    focusSiblingWithinGroup(attribute.slug, label, -1);
                    return;
                }
                });
            });
        });
    }

    function focusSiblingWithinGroup(attrSlug, currentLabel, direction) {
        const fieldset = currentLabel.closest('fieldset');
        if (!fieldset) return;
        const labels = Array.from(fieldset.querySelectorAll('label[role="radio"]'));
        const idx = labels.indexOf(currentLabel);
        if (idx === -1) return;
        let next = idx + direction;
        if (next < 0) next = labels.length - 1;
        if (next >= labels.length) next = 0;
        labels[next].focus();
    }

    function humanizeIdentifier(identifier) {
        if (!identifier) return '';
        const map = parseIdentifierToMap(identifier);
        const parts = [];

        for (const attr of productData.attributes) {
            const slug = map[attr.slug];
            if (!slug) continue;
            const val = attr.values.find(v => v.slug === slug);
            if (val) parts.push(val.title);
            else {
                // fallback: convert slug → Title Case
                parts.push(slug.replace(/-/g, ' ')
                            .replace(/\b\w/g, c => c.toUpperCase()));
            }
        }
        return parts.join(', ');
    }

    // update UI: toggle classes, aria attributes, price text (if present), and URL
    function updateUI() {
        productData.attributes.forEach((attribute, attrIndex) => {
            attribute.values.forEach((value, valueIndex) => {
                const inputId = buildRadioId(attrIndex, valueIndex);
                const input = document.getElementById(inputId);
                const label = labelFor(inputId);
                if (!input || !label) return;

                // partial selection excluding this attribute
                const partial = {};
                for (const [k, v] of Object.entries(currentSelection)) {
                    if (k !== attribute.slug && v) partial[k] = v;
                }

                const valid = isValueValid(attribute.slug, value.slug, partial);

                if (!valid) {
                    label.classList.add('opacity-40');
                    label.setAttribute('title', 'Not available with current selection (click to switch)');
                } else {
                    label.classList.remove('opacity-40');
                    label.removeAttribute('title');
                }

                // reflect checked state & aria
                const checked = currentSelection[attribute.slug] === value.slug;
                input.checked = checked;
                input.setAttribute('aria-checked', String(checked));
                label.setAttribute('aria-checked', String(checked));
            });
        });

        // update selected combo & price (if you have elements with these IDs in the blade)
        const combo = findCombinationForSelection(currentSelection);

        console.log(combo.variation_identifier);

        // Show selected Variation
        variationDisplay.forEach(el => {
            el.innerText = humanizeIdentifier(combo.variation_identifier);
        });

        // Safely remove previous status classes and add new ones
        if (prodStatDetail) {
            // compute new status classes array (split by whitespace)
            const newClasses = combo && combo.status_classes
                ? combo.status_classes.trim().split(/\s+/).filter(Boolean)
                : [];

            // remove previously-applied status classes (if any)
            const prev = prodStatDetail.dataset.prevStatusClasses;
            if (prev) {
                const prevTokens = prev.split(/\s+/).filter(Boolean);
                if (prevTokens.length) prodStatDetail.classList.remove(...prevTokens);
            }

            // add the new status classes (if any)
            if (newClasses.length) {
                prodStatDetail.classList.add(...newClasses);
                // remember them so we can remove later
                prodStatDetail.dataset.prevStatusClasses = newClasses.join(' ');
            } else {
                // no new classes: clear stored prev
                delete prodStatDetail.dataset.prevStatusClasses;
            }

            // update text
            prodStatDetail.textContent = combo ? (combo.status_title || '') : '';
        }

        // ---- Price Update ----
        // console.log('combo>>', combo);
        const priceBoxEls = document.querySelectorAll('.singleProdPricingBox');
        const orderEls = document.querySelectorAll('.orderPlaceButtons');
        const orderElMobileCta = document.querySelector('#mobileCta');

        if (combo.allow_order) {
            const p = combo.pricing && combo.pricing[0] ? combo.pricing[0] : null;
            const sellingText = p ? (p.selling_price_formatted || p.selling_price || '—') : '—';
            const mrpText = p ? (p.mrp_formatted || p.mrp || '') : '';
            const savingsText = p ? (p.savings_formatted || '') : '';
            const discountText = p ? (p.discount ? p.discount : '') : '';

            // load HTML content
            let discountContent = '';
            let boxContent = `
            <div class="sellingPriceEl text-xl sm:text-2xl font-bold">
                <span class="currency-icon">${currencyIcon}</span><span class="priceBox">${sellingText}</span>
            </div>
            `;

            if (p && p.mrp > 0) {
                boxContent += `
                <div class="mrpEl text-xs text-slate-500 dark:text-slate-400">
                    <span class="line-through">
                        <span class="currency-icon">${currencyIcon}</span><span class="mrpBox">${mrpText}</span>
                    </span>
                </div>
                `;

                discountContent +=
                `<div class="savingsEl text-xs text-emerald-700 dark:text-emerald-300 font-bold mt-1">
                    You save <span class="currency-icon">${currencyIcon}</span><span class="savingsBox">${savingsText}</span> 
                    (<span class="discountBox">${discountText}</span>% off)
                </div>
                `;
            }

            priceBoxEls.forEach( (el, index) => {
                if (index === 2) {
                    el.innerHTML = boxContent;
                } else {
                    el.innerHTML = boxContent+discountContent;
                }
                el.style.display = 'block';
            });

            orderEls.forEach(el => {
                el.style.display = 'block';
            });

            if (isMobile()) {
                orderElMobileCta.style.display = 'block';
            }
        } else {
            priceBoxEls.forEach(el => {
                el.style.display = 'none';
            });
            orderEls.forEach(el => {
                el.style.display = 'none';
            });
            if (isMobile()) {
                orderElMobileCta.style.display = 'none';
            }
        }

        // ensure we prefer the canonical combo identifier in the URL,
        // and also fill missing attributes from the combo into currentSelection
        if (combo) {
            // merge combo map so inputs + price match perfectly
            currentSelection = { ...currentSelection, ...combinationToMap(combo) };
        }

        // write a meaningful variant param: prefer combo if present, otherwise use partial selection
        updateURL(combo || currentSelection);

    }

    @if ($variation['code'] == 200)
        // start
        attachHandlers();

        // ensure selection is valid on load
        if (!findCombinationForSelection(currentSelection)) {
            currentSelection = combinationToMap(productData.combinations[0]);
        }

        // push default/initial variant to URL so it is shareable
        const initialCombo = findCombinationForSelection(currentSelection);
        updateURL(initialCombo || currentSelection);
        updateUI();
    @endif
})();
</script>

</x-guest-layout>