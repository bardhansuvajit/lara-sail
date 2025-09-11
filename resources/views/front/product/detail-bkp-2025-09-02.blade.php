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

<!-- Product Detail Page (no header/footer) -->
<div class="pt-4">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-2 md:gap-4 items-start">

        <!-- Left: Images (thumbnails at bottom) -->
        <div class="lg:col-span-5 bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-4 shadow-sm">
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
        <div class="lg:col-span-7 flex flex-col gap-4">
            <div class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-4 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
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
                            <div id="variantNote" class="mt-1 text-xs text-amber-700 hidden" aria-live="polite">Low stock for this combination</div>
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
                            class="inline-flex items-stretch rounded-md overflow-hidden border border-gray-300 dark:border-gray-600"
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
                        class="flex-1 sm:flex-none px-4 py-2 rounded-md bg-amber-600 hover:bg-amber-700 text-white font-semibold text-sm inline-flex items-center justify-center disabled:opacity-50"
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
                        class="px-4 py-2 rounded-md border border-amber-600 text-amber-600 dark:text-amber-300 text-sm font-semibold"
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


            <!-- Right side small cards: Ads / Quick specs -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="{{ FD['rounded'] }} p-3 bg-gradient-to-tr from-amber-50 to-white dark:from-amber-900 dark:to-slate-800 shadow-sm">
                    <div class="text-xs font-semibold mb-2">Deal of the Day</div>
                    <div class="text-sm font-bold text-amber-700 dark:text-amber-300">Flat @php echo $product['currency'] @endphp 2,000 off</div>
                    <div class="mt-2 text-xs">Limited time — makes this chair irresistible. Free priority shipping.</div>
                    <div class="mt-3">
                        <button class="px-3 py-1 {{ FD['rounded'] }} bg-amber-600 text-white text-sm">Claim Deal</button>
                    </div>
                </div>

                <div class="{{ FD['rounded'] }} p-3 bg-white dark:bg-slate-800 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-xs font-semibold">Quick Specs</div>
                            <ul class="mt-2 text-xs text-slate-600 dark:text-slate-300 space-y-1">
                                @php foreach($product['specs'] as $k => $v): @endphp
                                    <li><strong class="text-xs">@php echo htmlspecialchars($k) @endphp:</strong> @php echo htmlspecialchars($v) @endphp</li>
                                @php endforeach; @endphp
                            </ul>
                        </div>
                        <div class="text-xs text-slate-500">Free 2-day assembly</div>
                    </div>
                </div>
            </div>

            <!-- Reviews preview + add review button -->
            <div class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-4 shadow-sm text-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs font-semibold">Customer Reviews</div>
                        <div class="text-sm font-bold">@php echo number_format($product['rating'],1) @endphp <span class="text-xs text-slate-500">/5</span></div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="text-xs text-slate-500">@php echo number_format($product['review_count']) @endphp ratings</div>
                        <button id="openReviewModal" class="px-3 py-1 text-xs {{ FD['rounded'] }} bg-amber-600 text-white">Add Review</button>
                    </div>
                </div>

                <div id="reviewsList" class="mt-3 space-y-3 text-xs text-slate-600 dark:text-slate-300">
                    @php foreach($reviews as $r): @endphp
                        <div class="p-3 {{ FD['rounded'] }} border dark:border-slate-700">
                            <div class="flex items-center justify-between">
                                <div class="font-semibold">@php echo htmlspecialchars($r['name']) @endphp <span class="text-xs text-slate-400">· @php echo htmlspecialchars($r['date']) @endphp</span></div>
                                <div class="flex items-center gap-1">
                                    @php for($i=0;$i<5;$i++): @endphp
                                        @php if($i < $r['rating']): @endphp
                                            <svg class="w-3 h-3 text-amber-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>
                                        @php else: @endphp
                                            <svg class="w-3 h-3 text-slate-300" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>
                                        @php endif; @endphp
                                    @php endfor; @endphp
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="font-semibold text-sm">@php echo htmlspecialchars($r['title']) @endphp</div>
                                <div class="mt-1 text-xs">@php echo htmlspecialchars($r['body']) @endphp</div>
                            </div>
                        </div>
                    @php endforeach; @endphp
                </div>

            </div>

            <!-- Tabbed area: Description / Specs / FAQs -->
            <div class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-4 shadow-sm">
                <div class="flex gap-4 border-b dark:border-slate-700 pb-3">
                    <button class="tab-btn text-xs font-semibold" data-tab="desc">Description</button>
                    <button class="tab-btn text-xs font-semibold" data-tab="specs">Specifications</button>
                    <button class="tab-btn text-xs font-semibold" data-tab="faqs">FAQs</button>
                </div>

                <div id="tabContent" class="mt-4 text-sm text-slate-700 dark:text-slate-300">
                    <div data-panel="desc">
                        <p class="text-sm">@php echo htmlspecialchars($product['long_desc']) @endphp</p>
                    </div>
                    <div data-panel="specs" class="hidden">
                        <ul class="text-xs space-y-1">
                            @php foreach($product['specs'] as $k => $v): @endphp
                                <li><strong>@php echo htmlspecialchars($k) @endphp:</strong> @php echo htmlspecialchars($v) @endphp</li>
                            @php endforeach; @endphp
                        </ul>
                    </div>
                    <div data-panel="faqs" class="hidden">
                        @php foreach($faqs as $f): @endphp
                            <div class="border-b dark:border-slate-700 py-3">
                                <button class="faq-q w-full text-left text-xs font-semibold" type="button">@php echo htmlspecialchars($f['q']) @endphp</button>
                                <div class="faq-a mt-2 text-xs hidden">@php echo htmlspecialchars($f['a']) @endphp</div>
                            </div>
                        @php endforeach; @endphp
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Review modal -->
<div id="reviewModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
    <div class="max-w-xl w-full {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-900 p-4" role="dialog" aria-modal="true" aria-labelledby="reviewModalTitle">
        <div class="flex items-center justify-between mb-3">
            <div id="reviewModalTitle" class="text-sm font-semibold">Write a Review</div>
            <button id="closeReviewModal" class="p-2 {{ FD['rounded'] }} hover:bg-slate-100 dark:hover:bg-slate-800">Close</button>
        </div>
        <form id="reviewForm" class="space-y-3 text-xs">
            <div>
                <label class="block text-xs mb-1">Your name</label>
                <input type="text" id="revName" class="w-full p-2 {{ FD['rounded'] }} border dark:border-slate-700 bg-white dark:bg-slate-800 text-sm" required />
            </div>
            <div>
                <label class="block text-xs mb-1">Rating</label>
                <select id="revRating" class="w-32 p-2 {{ FD['rounded'] }} border dark:border-slate-700 bg-white dark:bg-slate-800 text-sm">
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Good</option>
                    <option value="3">3 - Average</option>
                    <option value="2">2 - Poor</option>
                    <option value="1">1 - Terrible</option>
                </select>
            </div>
            <div>
                <label class="block text-xs mb-1">Title</label>
                <input id="revTitle" type="text" class="w-full p-2 {{ FD['rounded'] }} border dark:border-slate-700 bg-white dark:bg-slate-800 text-sm" />
            </div>
            <div>
                <label class="block text-xs mb-1">Review</label>
                <textarea id="revBody" class="w-full p-2 {{ FD['rounded'] }} border dark:border-slate-700 bg-white dark:bg-slate-800 text-sm" rows="4"></textarea>
            </div>
            <div class="flex items-center justify-end">
                <button type="submit" class="px-3 py-1 {{ FD['rounded'] }} bg-amber-600 text-white text-sm">Submit</button>
            </div>
        </form>
    </div>
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
    const noteEl = document.getElementById('variantNote');
    const stockHelper = document.getElementById('stockHelper');
    const priceEl = document.getElementById('sellingPriceEl');
    const mrpEl = document.getElementById('mrpEl');
    const savingsEl = document.getElementById('savingsEl');
    const addToCart = document.getElementById('addToCart');
    const buyNow = document.getElementById('buyNow');

    if (!info) {
      if (noteEl) { noteEl.textContent = 'This combination is unavailable'; noteEl.classList.remove('hidden'); }
      if (stockHelper) stockHelper.textContent = '';
      if (priceEl) priceEl.innerHTML = '<span class="text-amber-700">Unavailable</span>';
      if (addToCart) { addToCart.disabled = true; addToCart.classList.add('opacity-60'); }
      if (buyNow) { buyNow.disabled = true; buyNow.classList.add('opacity-60'); }
      return;
    }

    // set price & stock-based states
    if (priceEl) priceEl.textContent = '@php echo $product["currency"] @endphp' + Number(info.price).toFixed(2);
    if (mrpEl) mrpEl.textContent = '@php echo $product["currency"] . number_format($product["mrp"], 2) @endphp';
    if (savingsEl) savingsEl.textContent = 'You save @php echo $product["currency"] . number_format($product["mrp"] - $product["price"], 2) @endphp (@php echo round((($product["mrp"] - $product["price"])/$product["mrp"])*100) @endphp% off)';

    if (info.stock <= 2) {
      if (noteEl){ noteEl.textContent = 'Low stock for this combination'; noteEl.classList.remove('hidden'); }
    } else {
      if (noteEl) noteEl.classList.add('hidden');
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
