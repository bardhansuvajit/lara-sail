<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Product') }}">

@php
    // Mock PHP data for Product Detail Page (PDP)
    $product = [
        'id' => 101,
        'title' => 'UltraComfort Ergonomic Office Chair - Model X1',
        'brand' => 'ErgoPro',
        'rating' => 4.6,
        'review_count' => 1245,
        'short_desc' => 'Breathable mesh, adjustable lumbar support, 4D armrests, 120kg capacity. Lorem ipsum dolor sit amet consectetur adipisicing elit. Id voluptas, dolorum consequuntur expedita perferendis sunt sed voluptatem fuga. Officia, hic.',
        'long_desc' => "Designed for professionals who sit for long hours. The UltraComfort X1 brings ergonomic engineering with breathable mesh, adjustable lumbar, and 4D armrests. Perfect for home and office use. Comes with easy assembly and a 2-year warranty.",
        'price' => 12999.00,
        'mrp' => 19999.00,
        'currency' => '₹',
        'stock' => 27,
        'cod_available' => true,
        'shipping' => [
            'estimate_days' => [2,5],
            'free_over' => 1499.00
        ],
        'images' => [
            'https://dummyimage.com/1200x900/eeeeee/888888&text=Chair+1',
            'https://dummyimage.com/1200x900/dddddd/777777&text=Chair+2',
            'https://dummyimage.com/1200x900/cccccc/666666&text=Chair+3',
            'https://dummyimage.com/1200x900/bbbbbb/444444&text=Chair+4',
            'https://dummyimage.com/1200x900/ffd700/333333&text=Chair+5',
            'https://dummyimage.com/1200x900/00aaff/ffffff&text=Chair+6',
            'https://dummyimage.com/1200x900/10b981/ffffff&text=Chair+7',
        ],
        'badges' => ['Best Seller','Limited Stock'],
        'highlights' => [
            'Ergonomic lumbar support',
            'Breathable mesh back',
            '4D adjustable armrests',
            '120 kg weight capacity'
        ],
        // variations
        'variations' => [
            'colors' => ['black' => 'Black', 'grey' => 'Grey', 'blue' => 'Navy Blue'],
            'materials' => ['mesh' => 'Mesh', 'leather' => 'PU Leather'],
            'combinations' => [
                'black|mesh' => ['price' => 12999.00, 'stock' => 12],
                'grey|mesh'  => ['price' => 13499.00, 'stock' => 7],
                'blue|mesh'  => ['price' => 13999.00, 'stock' => 5],
                'black|leather' => ['price' => 14999.00, 'stock' => 3],
                'grey|leather'  => ['price' => 14999.00, 'stock' => 0]
            ]
        ],
        'offers' => [
            ['title' => 'Bank Offer', 'desc' => '10% instant discount with SBI cards (up to ₹1,500)'],
            ['title' => 'No Cost EMI', 'desc' => '3 & 6 months options available']
        ],
        'specs' => [
            'Weight Capacity' => '120 kg',
            'Warranty' => '2 Years on Mechanism',
            'Assembly' => 'Minimal assembly required',
            'Dimensions' => '46 x 48 x 120 cm (LxWxH)'
        ]
    ];

    $upsells = [
        ['id'=>201,'title'=>'Lumbar Support Cushion','price'=>799.00,'img'=>'https://dummyimage.com/400x300/eeeeee/888888&text=Cushion'],
        ['id'=>202,'title'=>'Assembly + Warranty Pack','price'=>999.00,'img'=>'https://dummyimage.com/400x300/dddddd/777777&text=Warranty'],
        ['id'=>203,'title'=>'Premium Floor Mat','price'=>499.00,'img'=>'https://dummyimage.com/400x300/cccccc/666666&text=Mat']
    ];

    $reviews = [
        ['name'=>'Anita R.','rating'=>5,'title'=>'Super comfortable','body'=>'I use this chair for 8+ hours — back pain reduced significantly. Very sturdy.','date'=>'2025-08-10'],
        ['name'=>'Rahul S.','rating'=>4,'title'=>'Good value','body'=>'Build quality is solid. Armrests could be softer.','date'=>'2025-07-22'],
        ['name'=>'Mina P.','rating'=>5,'title'=>'Highly recommend','body'=>'Great for home office setup. Easy assembly.','date'=>'2025-06-15']
    ];

    $faqs = [
        ['q'=>'Is assembly required?','a'=>'Minimal assembly required. Tools and manual included.'],
        ['q'=>'What is the warranty?','a'=>'2 years on mechanism and 1 year on parts.'],
        ['q'=>'Does it support heavy users?','a'=>'Rated up to 120 kg. For heavier needs, check our XL range.']
    ];

    // swatch map for color visual rendering
    $swatch_map = [
        'black' => '#111827',
        'grey'  => '#6B7280',
        'blue'  => '#1E3A8A'
    ];

    // create variant groups and stable order (excludes 'combinations')
    $variations = $product['variations'];
    $variant_groups = $variations;
    if (isset($variant_groups['combinations'])) unset($variant_groups['combinations']);
    $variant_order = array_keys($variant_groups);

    // helper: is an option available (any combination with stock>0 that contains this option)
    function option_available($groupKey, $optKey, $variations){
        foreach($variations['combinations'] as $comboKey => $info){
            $parts = explode('|', $comboKey);
            if (in_array($optKey, $parts, true) && ($info['stock'] ?? 0) > 0) return true;
        }
        return false;
    }
@endphp

<div class="pt-4">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-2 md:gap-4 items-start">
        <!-- Left: Images (thumbnails at bottom) -->
        <div class="lg:col-span-5 bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-4 shadow-sm md:sticky md:top-[130px] md:mb-4">
            <div class="flex flex-col gap-4">

                <!-- Main image area -->
                <div class="relative {{ FD['rounded'] }} overflow-hidden border dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                    <div class="aspect-w-4 aspect-h-3 {{ FD['rounded'] }} overflow-hidden">
                        <img id="mainImage" src="@php echo $product['images'][0] @endphp" alt="Main product image" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" />
                    </div>

                    <!-- zoom / gallery -->
                    <button id="openGallery" class="absolute right-3 top-3 p-2 {{ FD['rounded'] }} bg-white/80 dark:bg-slate-800/80 hover:shadow text-xs" aria-label="Open gallery">🔍 View</button>
                </div>

                <!-- Thumbnails (bottom) -->
                <div class="flex items-center gap-2">
                    <div id="thumbs" class="flex gap-2 overflow-x-auto no-scrollbar py-1">
                        @php foreach($product['images'] as $i => $img): @endphp
                            <button type="button" class="thumb-item flex-none w-20 h-16 sm:w-24 sm:h-20 {{ FD['rounded'] }} overflow-hidden border dark:border-slate-700" data-img="@php echo $img @endphp" aria-label="View image @php echo $i+1 @endphp">
                                <img src="@php echo $img @endphp" alt="Thumb @php echo $i+1 @endphp" class="w-full h-full object-cover" loading="lazy" />
                            </button>
                        @php endforeach; @endphp
                    </div>
                </div>

            </div>
        </div>

        <!-- Right: Product Info & Actions -->
        <div class="lg:col-span-7 flex flex-col gap-4 md:mb-4">
            <div class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-4 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <nav class="text-xs text-slate-400 mb-2" aria-label="breadcrumb">
                            <ol class="flex items-center gap-2">
                                <li>Home</li><li>/</li>
                                <li>Office</li><li>/</li>
                                <li class="truncate font-medium">@php echo htmlspecialchars($product['title']) @endphp</li>
                            </ol>
                        </nav>

                        <h1 class="text-lg sm:text-xl font-semibold leading-tight">@php echo htmlspecialchars($product['title']) @endphp</h1>

                        <div class="flex items-center gap-2 mt-2 text-xs text-slate-500 dark:text-slate-300">
                            <span class="flex items-center gap-1">
                                <div class="{{ FD['iconClass'] }} inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="m305-704 112-145q12-16 28.5-23.5T480-880q18 0 34.5 7.5T543-849l112 145 170 57q26 8 41 29.5t15 47.5q0 12-3.5 24T866-523L756-367l4 164q1 35-23 59t-56 24q-2 0-22-3l-179-50-179 50q-5 2-11 2.5t-11 .5q-32 0-56-24t-23-59l4-165L95-523q-8-11-11.5-23T80-570q0-25 14.5-46.5T135-647l170-57Zm49 69-194 64 124 179-4 191 200-55 200 56-4-192 124-177-194-66-126-165-126 165Zm126 135Z"/></svg>
                                </div>
                                <span class="font-medium">@php echo number_format($product['rating'], 1) @endphp</span>
                            </span>
                            <span>·</span>
                            <span>@php echo number_format($product['review_count']) @endphp reviews</span>
                            <span>·</span>
                            <span class="text-slate-400 dark:text-slate-400">By <strong>@php echo htmlspecialchars($product['brand']) @endphp</strong></span>
                        </div>

                        <div class="flex items-center gap-2 my-4">
                            @php foreach($product['badges'] as $badge): @endphp
                                <span class="px-3 py-1 {{ FD['rounded'] }} text-xs font-semibold bg-amber-200 text-amber-800 dark:bg-amber-900 dark:text-amber-200 shadow-sm">@php echo $badge @endphp</span>
                            @php endforeach; @endphp
                        </div>

                        <p class="mt-3 text-xs text-slate-600 dark:text-slate-300">@php echo htmlspecialchars($product['short_desc']) @endphp</p>

                    </div>

                    <!-- Wishlist / share icons -->
                    <div class="flex flex-col items-end gap-2">
                        <button class="p-2 {{ FD['rounded'] }} hover:bg-slate-100 dark:hover:bg-slate-700" aria-label="Add to wishlist">
                            <!-- heart svg -->
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 21l8.8-8.6 1-1a5.5 5.5 0 0 0 0-7.8z"/></svg>
                        </button>
                        <button class="p-2 {{ FD['rounded'] }} hover:bg-slate-100 dark:hover:bg-slate-700" aria-label="Share product">
                            <!-- share svg -->
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 12v7a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-7"/><path d="M16 6l-4-4-4 4"/><path d="M12 2v14"/></svg>
                        </button>
                    </div>
                </div>

                <!-- Price block -->
                <div class="mt-4 flex items-center gap-4">
                    <div>
                        <div id="sellingPriceEl" class="text-xl sm:text-2xl font-bold">@php echo $product['currency'] . number_format($product['price'], 2) @endphp</div>
                        <div id="mrpEl" class="text-xs text-slate-500 dark:text-slate-400 line-through">@php echo $product['currency'] . number_format($product['mrp'], 2) @endphp</div>
                        <div id="savingsEl" class="text-xs text-emerald-700 dark:text-emerald-300 font-medium mt-1">You save @php echo $product['currency'] . number_format($product['mrp'] - $product['price'], 2) @endphp (@php echo round((($product['mrp'] - $product['price'])/$product['mrp'])*100) @endphp% off)</div>
                    </div>
                </div>

                <!-- Variations -->
                <div class="mt-4">
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
                            {{-- <div id="variantNote" class="mt-1 text-xs text-amber-700 hidden" aria-live="polite">Low stock for this combination</div> --}}
                        </div>
                    </div>
                </div>

                <!-- Quantity & Actions -->
                <div class="mt-4 flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    <!-- Qty block -->
                    <div class="flex items-start sm:items-center gap-3">
                        <div>
                        <label for="qtyInput" class="text-xs font-semibold block mb-1">Qty</label>

                        <div
                            id="qtyGroup"
                            class="inline-flex items-stretch {{ FD['rounded'] }} overflow-hidden border border-gray-300 dark:border-gray-600"
                            role="group"
                            aria-label="Quantity selector"
                            data-max-stock="12"
                        >
                            <button
                            id="qtyDec"
                            type="button"
                            class="w-9 h-9 flex items-center justify-center text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 disabled:opacity-50"
                            aria-label="Decrease quantity"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor" class="w-4 h-4">
                                <path d="M200-440v-80h560v80H200Z"/>
                            </svg>
                            </button>

                            <input
                            id="qtyInput"
                            type="number"
                            inputmode="numeric"
                            pattern="\d*"
                            min="1"
                            value="1"
                            aria-live="polite"
                            aria-label="Quantity"
                            class="w-16 text-center text-sm bg-white dark:bg-slate-800 outline-none border-l border-r border-transparent focus:outline-none focus:ring-0"
                            style="min-width:3.5rem;"
                            />

                            <button
                            id="qtyInc"
                            type="button"
                            class="w-9 h-9 flex items-center justify-center text-sm focus:outline-none focus:ring-2 focus:ring-amber-500 disabled:opacity-50"
                            aria-label="Increase quantity"
                            >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor" class="w-4 h-4">
                                <path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/>
                            </svg>
                            </button>
                        </div>

                        <div id="stockHelper" class="mt-2 ml-1 text-xs text-slate-500 dark:text-slate-400" aria-live="polite"></div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="flex-1 flex gap-2 w-full sm:w-auto justify-end">
                        <button
                        id="addToCart"
                        type="button"
                        class="flex-1 sm:flex-none px-4 py-2 {{ FD['rounded'] }} bg-amber-600 hover:bg-amber-700 text-white font-semibold text-sm inline-flex items-center justify-center disabled:opacity-50"
                        aria-label="Add to cart"
                        >
                        <span class="mr-2 inline-flex items-center" aria-hidden="true">
                            <!-- cart svg -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor" class="w-4 h-4">
                            <path d="M289.42-105.77q-28.14 0-47.88-19.7-19.73-19.7-19.73-47.84 0-28.15 19.7-47.88 19.7-19.73 47.84-19.73 28.14 0 47.88 19.7 19.73 19.7 19.73 47.84 0 28.14-19.7 47.88-19.7 19.73-47.84 19.73Zm380.42 0q-28.14 0-47.88-19.7-19.73-19.7-19.73-47.84 0-28.15 19.7-47.88 19.7-19.73 47.84-19.73 28.15 0 47.88 19.7 19.73 19.7 19.73 47.84 0 28.14-19.7 47.88-19.7 19.73-47.84 19.73ZM242.23-729.19l101.39 212.31h268.65q3.46 0 6.15-1.74 2.7-1.73 4.62-4.8l107.31-195q2.3-4.23.38-7.5-1.92-3.27-6.54-3.27H242.23Zm-27.15-55.96h544.57q24.35 0 36.52 20.41 12.17 20.42.98 41.51l-124.92 226.5q-9.04 16.81-25.1 26.31-16.06 9.5-34.52 9.5H325.62l-47.12 86.23q-3.08 4.61-.19 10 2.88 5.38 8.65 5.38H709.5q11.43 0 19.66 8.23 8.22 8.22 8.22 19.66 0 11.65-8.22 19.86-8.23 8.21-19.66 8.21H289.32q-38.71 0-58.38-33.07t-1.48-66.27l57.08-101.63-143.92-303.26H96.15q-11.65 0-19.86-8.21-8.21-8.21-8.21-19.77 0-11.56 8.21-19.77 8.21-8.21 19.86-8.21h60.5q9.89 0 17.87 5.27t12.4 14.12l28.16 59Zm128.54 268.27h275.96-275.96Z"/>
                            </svg>
                        </span>
                        Add to Cart
                        </button>

                        <button
                        id="buyNow"
                        type="button"
                        class="px-4 py-2 {{ FD['rounded'] }} border border-amber-600 text-amber-600 dark:text-amber-300 text-sm font-semibold"
                        aria-label="Buy now"
                        >
                        Buy Now
                        </button>
                    </div>
                </div>

                <hr class="mt-5 mb-2 dark:border-gray-600">

                <!-- productBadges (fixed & matched to page styles) -->
                <div id="productBadges" class="">
                    @php
                        $fastDelivery = isset($product['shipping']['estimate_days']) && $product['shipping']['estimate_days'][0] <= 2;
                        $warrantyText = $product['specs']['Warranty'] ?? null;
                        $cod = $product['cod_available'] ?? false;
                        $freeShipping = (isset($product['shipping']['free_over']) && ($product['price'] >= $product['shipping']['free_over']));
                        $minDays = $product['shipping']['estimate_days'][0] ?? null;
                        $maxDays = $product['shipping']['estimate_days'][1] ?? null;
                    @endphp

                    <div class="grid grid-cols-4 gap-2 md:gap-4">
                        <!-- Badge: Delivery -->
                        <div role="listitem" class="flex flex-col items-center text-center p-3 bg-white dark:bg-slate-800 {{ FD['rounded'] }} shadow-sm">
                            <div class="w-8 h-8 flex items-center justify-center mb-2 text-gray-600 dark:text-gray-300" aria-hidden="true">
                                <!-- truck icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M280-160q-50 0-85-35t-35-85H60l18-80h113q17-19 40-29.5t49-10.5q26 0 49 10.5t40 29.5h167l84-360H182l4-17q6-28 27.5-45.5T264-800h456l-37 160h117l120 160-40 200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H400q0 50-35 85t-85 35Zm357-280h193l4-21-74-99h-95l-28 120Zm-19-273 2-7-84 360 2-7 34-146 46-200ZM20-427l20-80h220l-20 80H20Zm80-146 20-80h260l-20 80H100Zm180 333q17 0 28.5-11.5T320-280q0-17-11.5-28.5T280-320q-17 0-28.5 11.5T240-280q0 17 11.5 28.5T280-240Zm400 0q17 0 28.5-11.5T720-280q0-17-11.5-28.5T680-320q-17 0-28.5 11.5T640-280q0 17 11.5 28.5T680-240Z"/></svg>
                            </div>
                            <h5 class="text-xs font-medium text-gray-800 dark:text-gray-100">Delivery</h5>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                @if($minDays && $maxDays)
                                    {{ $minDays }}-{{ $maxDays }} business days
                                @else
                                    Standard delivery
                                @endif
                                @if($freeShipping)
                                    <span class="block text-xxs text-slate-400">Free over {{ $product['currency'] . number_format($product['shipping']['free_over'], 2) }}</span>
                                @endif
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
                                @if($cod)
                                    Available in many pin codes — select at checkout
                                @else
                                    Not available at checkout
                                @endif
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
        {{-- UPSELL --}}
        <div class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-4 shadow-sm">
            <div class="flex items-start justify-between mb-3">
                <h3 class="text-sm font-semibold">Frequently bought together</h3>

                {{-- Top-level CTAs --}}
                <div class="flex gap-2 items-center">
                    <button
                        type="button"
                        id="buy-together"
                        class="inline-flex items-center text-xs font-medium px-3 py-1.5 rounded-2xl shadow-sm bg-sky-600 text-white hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-400"
                        aria-label="Buy these items together"
                        data-action="buy-together"
                    >
                        Buy together
                    </button>

                    <button
                        type="button"
                        id="add-selected"
                        class="inline-flex items-center text-xs font-medium px-3 py-1.5 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-300"
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
                            class="flex-1 text-xs font-medium px-2 py-1 rounded {{ FD['rounded'] }} bg-emerald-600 text-white hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-400"
                            aria-label="Add base product to cart"
                            data-product-id="{{ $product['id'] ?? '' }}"
                            data-action="add-to-cart"
                        >
                            Add
                        </button>

                        <button
                            type="button"
                            class="text-xs px-2 py-1 rounded {{ FD['rounded'] }} border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 focus:outline-none"
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

                            {{-- Discount badge --}}
                            @if($discount > 0)
                                <div class="absolute top-2 left-2 text-xs font-semibold px-2 py-0.5 rounded-full bg-rose-600 text-white">
                                    {{ $discount }}% OFF
                                </div>
                            @endif

                            {{-- Select checkbox (top-right) --}}
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

        <section id="pdp-description" class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-4 shadow-sm">
            <div class="mx-auto">
                <header class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div>
                        <h2 class="text-sm font-semibold mb-3">Product description</h2>
                    </div>
                </header>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <div class="lg:col-span-8 space-y-6">
                        {{-- <article class="prose prose-lg dark:prose-invert">
                            <h3 class="text-xl font-semibold">Amazing Product Name</h3>
                            <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 dark:text-gray-400">
                                <div class="flex items-center gap-1" aria-label="Customer rating: 4.6 out of 5">
                                <svg class="w-4 h-4 text-yellow-500" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.957a1 1 0 00.95.69h4.162c.969 0 1.371 1.24.588 1.81l-3.37 2.45a1 1 0 00-.364 1.118l1.287 3.957c.3.921-.755 1.688-1.54 1.118l-3.371-2.45a1 1 0 00-1.175 0l-3.37 2.45c-.784.57-1.839-.197-1.54-1.118l1.287-3.957a1 1 0 00-.364-1.118L2.064 9.384c-.783-.57-.38-1.81.588-1.81h4.162a1 1 0 00.95-.69l1.286-3.957z"/></svg>
                                <span class="ml-1 font-medium">4.6</span>
                                <span class="text-gray-500 dark:text-gray-400">(1,248 reviews)</span>
                                </div>

                                <div class="hidden sm:inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 dark:bg-gray-800 text-xs">
                                <svg class="w-4 h-4 text-blue-500" viewBox="0 0 24 24" fill="none"><path d="M5 13l4 4L19 7" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                <span class="font-medium">Free premium support</span>
                                </div>

                            </div>

                            <p class="mt-4 text-base text-gray-700 dark:text-gray-300">Short compelling product pitch. Use benefit-first language focusing on the customer's pain points and how the product solves them. Keep it scannable; expand below.</p>
                        </article> --}}

                        <!-- Rich content blocks (images + formatted description) -->
                        <div class="space-y-4">
                            <p class="mt-4 text-sm text-gray-700 dark:text-gray-300">Short compelling product pitch. Use benefit-first language focusing on the customer's pain points and how the product solves them. Keep it scannable; expand below.</p>
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

                        <div class="mt-4">
                            <div class="border-b border-gray-200 dark:border-gray-800">
                                <nav class="-mb-px flex gap-4" aria-label="Product description tabs">
                                <button class="tab-button pb-3 px-1 text-sm font-medium text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400" data-tab="highlights">Highlights</button>
                                <button class="tab-button pb-3 px-1 text-sm font-medium text-gray-600 dark:text-gray-300" data-tab="specs">Specifications</button>
                                <button class="tab-button pb-3 px-1 text-sm font-medium text-gray-600 dark:text-gray-300" data-tab="reviews">Reviews</button>
                                <button class="tab-button pb-3 px-1 text-sm font-medium text-gray-600 dark:text-gray-300" data-tab="qa">Q&amp;A</button>
                                </nav>
                            </div>

                            <div class="mt-6 space-y-6">
                                <div id="highlights" class="tab-panel">
                                <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700 dark:text-gray-300">
                                    <li class="space-y-1">
                                    <h5 class="font-semibold">Speed & Efficiency</h5>
                                    <p>Optimized design that delivers results quickly with low resource usage.</p>
                                    </li>
                                    <li class="space-y-1">
                                    <h5 class="font-semibold">Reliability</h5>
                                    <p>Tested under extreme conditions to ensure consistent performance.</p>
                                    </li>
                                    <li class="space-y-1">
                                    <h5 class="font-semibold">Connectivity</h5>
                                    <p>Supports the latest protocols and seamless pairing with popular devices.</p>
                                    </li>
                                    <li class="space-y-1">
                                    <h5 class="font-semibold">Customer Support</h5>
                                    <p>24/7 premium support included for the first year.</p>
                                    </li>
                                </ul>
                                </div>

                                <div id="specs" class="tab-panel hidden">
                                <table class="w-full text-sm text-left">
                                    <tbody>
                                    <tr class="border-t border-gray-100 dark:border-gray-800">
                                        <th class="py-3 pr-6 font-medium w-1/3">Model</th>
                                        <td class="py-3">Model X-200</td>
                                    </tr>
                                    <tr class="border-t border-gray-100 dark:border-gray-800">
                                        <th class="py-3 pr-6 font-medium">Dimensions</th>
                                        <td class="py-3">220 x 150 x 90 mm</td>
                                    </tr>
                                    <tr class="border-t border-gray-100 dark:border-gray-800">
                                        <th class="py-3 pr-6 font-medium">Weight</th>
                                        <td class="py-3">1.2 kg</td>
                                    </tr>
                                    <tr class="border-t border-gray-100 dark:border-gray-800">
                                        <th class="py-3 pr-6 font-medium">Battery</th>
                                        <td class="py-3">Up to 12 hours (typical)</td>
                                    </tr>
                                    </tbody>
                                </table>
                                </div>

                                <div id="reviews" class="tab-panel hidden">
                                <div class="space-y-4">
                                    <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">A</div>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                        <strong>Alex</strong>
                                        <span class="text-sm text-gray-500">— 5 stars</span>
                                        </div>
                                        <p class="text-sm text-gray-700 dark:text-gray-300">"Fantastic build quality and excellent battery life. Highly recommended."</p>
                                    </div>
                                    </div>

                                    <a href="#" class="inline-block text-sm text-blue-600 dark:text-blue-400">View all reviews</a>
                                </div>
                                </div>

                                <div id="qa" class="tab-panel hidden">
                                <div class="space-y-3">
                                    <details class="p-3 bg-gray-50 dark:bg-gray-800 {{ FD['rounded'] }} border border-gray-100 dark:border-gray-800">
                                    <summary class="font-medium">Is this compatible with Model Y?</summary>
                                    <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">Yes — Model X supports Model Y via the included adapter (sold separately).</p>
                                    </details>

                                    <a href="#" class="text-sm text-blue-600 dark:text-blue-400">Ask a question</a>
                                </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <aside class="lg:col-span-4 sticky md:top-[8.3rem] self-start space-y-4">
                        <div class="{{ FD['rounded'] }} border border-gray-100 dark:border-gray-800 p-4 bg-white dark:bg-gray-900 shadow-sm">
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

                    </aside>
                </div>
            </div>

            <!-- Mobile sticky CTA -->
            <div id="mobileCta" class="fixed bottom-4 left-1/2 -translate-x-1/2 z-50 w-[92%] sm:hidden">
                <div class="flex items-center justify-between bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-xl p-3 shadow-lg">
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

            <!-- Minimal JS for interactions (tabs, read more, countdown) -->
            <script>
                (function(){
                // Tabs
                const tabButtons = document.querySelectorAll('.tab-button');
                const panels = document.querySelectorAll('.tab-panel');
                tabButtons.forEach(btn => btn.addEventListener('click', () => {
                    tabButtons.forEach(b => b.classList.remove('text-blue-600','dark:text-blue-400','border-blue-600','dark:border-blue-400'));
                    tabButtons.forEach(b => b.classList.add('text-gray-600','dark:text-gray-300'));
                    btn.classList.add('text-blue-600','dark:text-blue-400','border-blue-600','dark:border-blue-400');
                    panels.forEach(p => p.classList.add('hidden'));
                    const target = document.getElementById(btn.dataset.tab);
                    if (target) target.classList.remove('hidden');
                }));

                // Read more toggle
                const toggleBtn = document.getElementById('toggleLongDesc');
                const longDesc = document.getElementById('longDescription');
                if(toggleBtn && longDesc){
                    toggleBtn.addEventListener('click', () => {
                    const expanded = toggleBtn.getAttribute('aria-expanded') === 'true';
                    toggleBtn.setAttribute('aria-expanded', String(!expanded));
                    if(!expanded){
                        longDesc.style.maxHeight = longDesc.scrollHeight + 'px';
                        toggleBtn.textContent = 'Show less';
                    } else {
                        longDesc.style.maxHeight = '6rem';
                        toggleBtn.textContent = 'Read more';
                    }
                    });
                }

                // Simple countdown (example: offer ends in X seconds from page load)
                const countdownEl = document.getElementById('dealCountdown');
                if(countdownEl){
                    // set example expiry 2 hours from now
                    const expiry = Date.now() + (2 * 60 * 60 * 1000) + (13 * 60 * 1000) + (45 * 1000);
                    function updateCountdown(){
                    const diff = Math.max(0, expiry - Date.now());
                    const hrs = Math.floor(diff / (1000*60*60));
                    const mins = Math.floor((diff % (1000*60*60)) / (1000*60));
                    const secs = Math.floor((diff % (1000*60)) / 1000);
                    countdownEl.textContent = String(hrs).padStart(2,'0')+":"+String(mins).padStart(2,'0')+":"+String(secs).padStart(2,'0');
                    if(diff<=0) clearInterval(timer);
                    }
                    updateCountdown();
                    const timer = setInterval(updateCountdown,1000);
                }

                // Accessibility: make detail summaries keyboard friendly
                document.querySelectorAll('details').forEach(d=>{
                    d.addEventListener('keydown', e=>{
                    if(e.key === 'Enter' || e.key === ' '){
                        e.preventDefault(); d.open = !d.open;
                    }
                    });
                });

                })();
            </script>

        </section>

        <div class="lg:col-span-2 bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-5 shadow-sm" id="detailsMain">
            <!-- Tabs -->
            <div class="flex items-center justify-between gap-3">
                <nav class="tabs flex gap-2" role="tablist" aria-label="Product details tabs">
                    <button class="tab-btn px-3 py-2 text-sm font-medium rounded focus:outline-none" data-tab="desc" role="tab" aria-selected="true">Description</button>
                    <button class="tab-btn px-3 py-2 text-sm font-medium rounded focus:outline-none" data-tab="specs" role="tab">Specifications</button>
                    <button class="tab-btn px-3 py-2 text-sm font-medium rounded focus:outline-none" data-tab="faq" role="tab">FAQ</button>
                    <button class="tab-btn px-3 py-2 text-sm font-medium rounded focus:outline-none" data-tab="reviews" role="tab">Reviews (@php echo count($reviews) @endphp)</button>
                </nav>

                <div class="text-xs text-slate-500">Last updated: <time datetime="@php echo date('Y-m-d') @endphp">@php echo date('M j, Y') @endphp</time></div>
            </div>

            <hr class="my-4 dark:border-gray-700"/>

            <!-- Panels -->
            <div id="panel-desc" data-panel="desc">
            <h2 class="text-lg font-semibold">Product description</h2>
            <div class="mt-3 text-sm text-slate-700 dark:text-slate-300 leading-relaxed">
                <p>@php echo nl2br(e($product['long_desc'])) @endphp</p>

                <ul class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-2 list-inside list-disc text-sm">
                @foreach($product['highlights'] as $h)
                    <li class="pl-2">{{ $h }}</li>
                @endforeach
                </ul>

                <!-- Expandable "More details" -->
                <details class="mt-4 text-sm text-slate-600 dark:text-slate-400 p-3 border rounded">
                <summary class="font-semibold cursor-pointer">More details</summary>
                <div class="mt-2">Full product specifications, care instructions, assembly tips and a short troubleshooting guide go here. Keep this section factual and helpful — include measurements, recommended use-cases, and materials.</div>
                </details>
            </div>
            </div>

            <div id="panel-specs" data-panel="specs" class="hidden">
            <h2 class="text-lg font-semibold">Technical specifications</h2>
            <div class="mt-3 overflow-x-auto">
                <table class="w-full text-sm text-left border-collapse">
                <tbody class="align-top">
                    @foreach($product['specs'] as $k => $v)
                    <tr class="border-t dark:border-slate-700">
                        <th class="px-3 py-2 w-1/3 text-xs text-slate-500">{{ $k }}</th>
                        <td class="px-3 py-2 text-sm text-slate-700 dark:text-slate-300">{{ $v }}</td>
                    </tr>
                    @endforeach
                </tbody>
                </table>
            </div>

            <!-- Comparison CTA -->
            <div class="mt-4 flex items-center gap-3">
                <button class="px-4 py-2 {{ FD['rounded'] }} border text-sm">Compare models</button>
                <a href="#upsells" class="text-sm text-amber-600">See accessories</a>
            </div>
            </div>

            <div id="panel-faq" data-panel="faq" class="hidden">
            <h2 class="text-lg font-semibold">Frequently asked questions</h2>
            <div class="mt-3 space-y-2">
                <div class="flex items-center gap-2">
                <input id="faqSearch" type="search" placeholder="Search FAQs" class="w-full px-3 py-2 border rounded text-sm" aria-label="Search FAQs" />
                </div>

                <div id="faqsWrapper" class="mt-2 space-y-2">
                @foreach($faqs as $f)
                    <div class="faq-item border dark:border-slate-700 p-3 {{ FD['rounded'] }}">
                    <button class="faq-q w-full text-left flex items-center justify-between" aria-expanded="false">
                        <span class="font-medium text-sm">{{ $f['q'] }}</span>
                        <svg class="w-4 h-4 transform transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M6 9l6 6 6-6"/></svg>
                    </button>
                    <div class="faq-a mt-2 hidden text-sm text-slate-600 dark:text-slate-400">{{ $f['a'] }}</div>
                    </div>
                @endforeach
                </div>
            </div>
            </div>

            <div id="panel-reviews" data-panel="reviews" class="hidden">
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

            </div>

        </div>

        <aside class="lg:col-span-1">
            <div class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-4 shadow-sm sticky top-28">
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


    <!-- Review modal (reusable) -->
    <div id="reviewModal2" class="fixed inset-0 z-60 items-center justify-center hidden p-4" aria-hidden="true">
    <div class="max-w-xl w-full {{ FD['rounded'] }} bg-white dark:bg-slate-800 p-4 shadow-lg">
        <div class="flex items-start justify-between">
        <h3 class="text-lg font-semibold">Write a review</h3>
        <button id="closeReviewModal2" class="text-slate-500">✕</button>
        </div>

        <form id="reviewForm2" class="mt-3 space-y-3">
        <div>
            <label class="text-xs">Name</label>
            <input id="revName2" class="w-full px-3 py-2 border rounded text-sm" />
        </div>
        <div>
            <label class="text-xs">Rating</label>
            <select id="revRating2" class="w-full px-3 py-2 border rounded text-sm">
            <option>5</option><option>4</option><option>3</option><option>2</option><option>1</option>
            </select>
        </div>
        <div>
            <label class="text-xs">Title</label>
            <input id="revTitle2" class="w-full px-3 py-2 border rounded text-sm" />
        </div>
        <div>
            <label class="text-xs">Review</label>
            <textarea id="revBody2" class="w-full px-3 py-2 border rounded text-sm" rows="4"></textarea>
        </div>

        <div class="flex items-center gap-2">
            <button type="submit" class="px-4 py-2 {{ FD['rounded'] }} bg-amber-600 text-white">Submit review</button>
            <button type="button" id="cancelReview2" class="px-4 py-2 {{ FD['rounded'] }} border">Cancel</button>
        </div>
        </form>
    </div>
    </div>

    <script>
    (function(){
    // Tabs
    document.querySelectorAll('.tab-btn').forEach(btn=>{
        btn.addEventListener('click', ()=>{
        document.querySelectorAll('[data-panel]').forEach(p=>p.classList.add('hidden'));
        document.querySelector('[data-panel="'+btn.dataset.tab+'"]')?.classList.remove('hidden');
        document.querySelectorAll('.tab-btn').forEach(b=>b.setAttribute('aria-selected','false'));
        btn.setAttribute('aria-selected','true');
        window.scrollTo({behavior:'smooth', top: document.getElementById('detailsMain').offsetTop - 20});
        });
    });

    // FAQ accordion + search
    document.querySelectorAll('.faq-q').forEach(q=>{
        q.addEventListener('click', ()=>{
        const a = q.nextElementSibling;
        const expanded = q.getAttribute('aria-expanded') === 'true';
        q.setAttribute('aria-expanded', String(!expanded));
        a.classList.toggle('hidden');
        q.querySelector('svg')?.classList.toggle('rotate-180');
        });
    });
    const faqSearch = document.getElementById('faqSearch');
    if (faqSearch) faqSearch.addEventListener('input', (e)=>{
        const q = e.target.value.trim().toLowerCase();
        document.querySelectorAll('#faqsWrapper .faq-item').forEach(item=>{
        const text = item.textContent.toLowerCase();
        item.style.display = q && !text.includes(q) ? 'none' : '';
        });
    });

    // Reviews modal
    const rm = document.getElementById('reviewModal2');
    document.getElementById('openReviewModal2')?.addEventListener('click', ()=>{ rm.classList.remove('hidden'); rm.setAttribute('aria-hidden','false'); rm.querySelector('input,textarea')?.focus(); });
    document.getElementById('closeReviewModal2')?.addEventListener('click', ()=>{ rm.classList.add('hidden'); rm.setAttribute('aria-hidden','true'); });
    document.getElementById('cancelReview2')?.addEventListener('click', ()=>{ rm.classList.add('hidden'); rm.setAttribute('aria-hidden','true'); });

    document.getElementById('reviewForm2')?.addEventListener('submit', (e)=>{
        e.preventDefault();
        const newRev = {
        name: document.getElementById('revName2').value || 'Anonymous',
        rating: parseInt(document.getElementById('revRating2').value||5,10),
        title: document.getElementById('revTitle2').value || '',
        body: document.getElementById('revBody2').value || '',
        date: new Date().toISOString().slice(0,10)
        };
        const container = document.getElementById('reviewsList');
        const node = document.createElement('article');
        node.className = 'p-3 border dark:border-slate-700 {{ FD['rounded'] }} mb-3';
        node.innerHTML = `<header class="flex items-start justify-between gap-3"><div><div class="font-semibold">${newRev.name} <span class="text-xs text-slate-400">· ${newRev.date}</span></div><div class="flex items-center gap-1 mt-1">${Array.from({length:5}).map((_,i)=> i < newRev.rating ? '<svg class="w-3 h-3 text-amber-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>' : '<svg class="w-3 h-3 text-slate-300" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>').join('')}</div></div><div class="text-xs text-slate-500">Verified purchase</div></header><div class="mt-2"><div class="font-semibold text-sm">${newRev.title}</div><p class="mt-1 text-sm text-slate-700 dark:text-slate-300">${newRev.body}</p></div>`;
        container.prepend(node);
        document.getElementById('reviewForm2').reset();
        rm.classList.add('hidden'); rm.setAttribute('aria-hidden','true');
    });

    // Load more reviews (demo)
    document.getElementById('loadMoreReviews')?.addEventListener('click', ()=>{
        alert('Load more reviews — wire to your reviews API (pagination)');
    });

    })();
    </script>


</div>


<script>
(function(){
    // server-provided data (raw json, NOT escaped)
    const variants = @php echo json_encode($variations, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) @endphp;
    const variantOrder = @php echo json_encode($variant_order, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) @endphp;
    const combos = variants.combinations || {};

    // thumbnails -> change main image
    document.querySelectorAll('.thumb-item').forEach(btn => {
        btn.addEventListener('click', () => {
        document.getElementById('mainImage').src = btn.dataset.img;
        });
    });

    // open gallery (lightbox) - simple
    document.getElementById('openGallery').addEventListener('click', () => {
        const light = document.createElement('div');
        light.className = 'fixed inset-0 z-60 bg-black/80 flex items-center justify-center p-4';
        light.innerHTML = `<div class="max-w-4xl w-full"><img src="${document.getElementById('mainImage').src}" class="w-full h-auto rounded" alt="preview"/></div>`;
        light.addEventListener('click', ()=> document.body.removeChild(light));
        document.body.appendChild(light);
        const escHandler = e => { if (e.key === 'Escape') { if (document.body.contains(light)) document.body.removeChild(light); document.removeEventListener('keydown', escHandler); } };
        document.addEventListener('keydown', escHandler);
    });

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
        btn.classList.toggle('ring-2', active);
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
            if (priceEl) priceEl.innerHTML = '<span class="text-amber-700">Unavailable</span>';
            if (addToCart) { addToCart.disabled = true; addToCart.classList.add('opacity-60'); }
            if (buyNow) { buyNow.disabled = true; buyNow.classList.add('opacity-60'); }
            if (mrpEl) mrpEl.textContent = '';
            if (savingsEl) savingsEl.textContent = '';
            return;
        }

        // set price & stock-based states
        if (priceEl) priceEl.textContent = '@php echo $product["currency"] @endphp' + Number(info.price).toFixed(2);
        if (mrpEl) mrpEl.textContent = '@php echo $product["currency"] . number_format($product["mrp"], 2) @endphp';
        if (savingsEl) savingsEl.textContent = 'You save @php echo $product["currency"] . number_format($product["mrp"] - $product["price"], 2) @endphp (@php echo round((($product["mrp"] - $product["price"])/$product["mrp"])*100) @endphp% off)';

        if (info.stock <= 2) {
            // if (noteEl){ noteEl.textContent = 'Low stock for this combination'; noteEl.classList.remove('hidden'); }
            if (stockHelper) stockHelper.textContent = '';
            if (priceEl) priceEl.innerHTML = '<span class="text-amber-700">Out of Stock</span>';
            if (addToCart) { addToCart.disabled = true; addToCart.classList.add('opacity-60'); }
            if (buyNow) { buyNow.disabled = true; buyNow.classList.add('opacity-60'); }
            if (mrpEl) mrpEl.innerHTML = '<span class="text-amber-700">We&apos;re sorry - this combination is currently out of stock. Enter your PIN to see alternatives or tap <strong>Notify me</strong> and we&apos;ll email you when stock returns.</span>';
            if (savingsEl) savingsEl.textContent = '';
            return;
        } else {
            // if (noteEl) noteEl.classList.add('hidden');
        }

        if (stockHelper) {
            stockHelper.textContent = (info.stock > 0) ? (`${info.stock} left`) : ('Out of stock');
            stockHelper.setAttribute('aria-hidden', info.stock > 0 ? 'false' : 'true');
        }

        if (addToCart) { addToCart.disabled = info.stock <= 0; addToCart.classList.toggle('opacity-60', info.stock <= 0); }
        if (buyNow) { buyNow.disabled = info.stock <= 0; buyNow.classList.toggle('opacity-60', info.stock <= 0); }
    }

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

    // Tabs
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.addEventListener('click', ()=>{
        document.querySelectorAll('[data-panel]').forEach(p=>p.classList.add('hidden'));
        const panel = document.querySelector('[data-panel="'+btn.dataset.tab+'"]');
        if(panel) panel.classList.remove('hidden');
        });
    });

    // FAQ accordion
    document.querySelectorAll('.faq-q').forEach(q=>{
        q.addEventListener('click', ()=>{
        const a = q.nextElementSibling;
        a.classList.toggle('hidden');
        });
    });

    // Reviews modal (focus management)
    const reviewModal = document.getElementById('reviewModal');
    const openReviewBtn = document.getElementById('openReviewModal');
    const closeReviewBtn = document.getElementById('closeReviewModal');
    openReviewBtn.addEventListener('click', ()=>{
        reviewModal.classList.remove('hidden');
        reviewModal.querySelector('input, textarea, select')?.focus();
        reviewModal.setAttribute('aria-hidden','false');
    });
    closeReviewBtn.addEventListener('click', ()=>{
        reviewModal.classList.add('hidden');
        reviewModal.setAttribute('aria-hidden','true');
        openReviewBtn.focus();
    });

    // submit review (client demo)
    document.getElementById('reviewForm').addEventListener('submit', (e)=>{
        e.preventDefault();
        const newRev = {
        name: document.getElementById('revName').value || 'Anonymous',
        rating: parseInt(document.getElementById('revRating').value||5, 10),
        title: document.getElementById('revTitle').value || '',
        body: document.getElementById('revBody').value || '',
        date: new Date().toISOString().slice(0,10)
        };
        const container = document.getElementById('reviewsList');
        const node = document.createElement('div');
        node.className = 'p-3 border dark:border-slate-700';
        node.innerHTML = `<div class="flex items-center justify-between"><div class="font-semibold">${newRev.name} <span class="text-xs text-slate-400">· ${newRev.date}</span></div><div class="flex items-center gap-1">${Array.from({length:5}).map((_,i)=> i < newRev.rating ? '<svg class="w-3 h-3 text-amber-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>' : '<svg class="w-3 h-3 text-slate-300" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>').join('')}</div></div><div class="mt-2"><div class="font-semibold text-sm">${newRev.title}</div><div class="mt-1 text-xs">${newRev.body}</div></div>`;
        container.prepend(node);
        reviewModal.classList.add('hidden');
        document.getElementById('reviewForm').reset();
        openReviewBtn.focus();
    });

    // Add to cart: include variant key and qty with validations
    document.getElementById('addToCart').addEventListener('click', ()=>{
        clampQty();
        const key = getCurrentComboKey();
        const info = combos[key];
        const qty = parseInt(qtyInput.value||1, 10);
        if (!info) { alert('Selected combination is unavailable. Please choose another option.'); return; }
        if (info.stock <= 0) { alert('Selected variant is out of stock.'); return; }
        if (qty > info.stock) { alert(`Only ${info.stock} unit(s) available for this variant.`); qtyInput.value = info.stock; return; }
        const payload = { productId: @php echo $product['id'] @endphp, qty, variant: key };
        // Replace alert with real cart API call
        alert('Added to cart: ' + JSON.stringify(payload));
    });

    // Buy Now: similar validation, then redirect (demo = alert)
    document.getElementById('buyNow').addEventListener('click', ()=>{
        clampQty();
        const key = getCurrentComboKey();
        const info = combos[key];
        const qty = parseInt(qtyInput.value||1, 10);
        if (!info) { alert('Selected combination is unavailable. Please choose another option.'); return; }
        if (info.stock <= 0) { alert('Selected variant is out of stock.'); return; }
        if (qty > info.stock) { alert(`Only ${info.stock} unit(s) available for this variant.`); qtyInput.value = info.stock; return; }
        const payload = { productId: @php echo $product['id'] @endphp, qty, variant: key, buyNow: true };
        // demo behavior: in production you would redirect to checkout with payload
        alert('Proceeding to checkout (demo): ' + JSON.stringify(payload));
    });

})();
</script>

</x-guest-layout>
