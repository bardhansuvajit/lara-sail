<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Product') }}">


<?php
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
                'grey|mesh'  => ['price' => 12999.00, 'stock' => 7],
                'blue|mesh'  => ['price' => 12999.00, 'stock' => 5],
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

    function safe_json($data){
        // return htmlspecialchars(json_encode($data, JSON_HEX_APOS|JSON_HEX_QUOT), ENT_QUOTES, 'UTF-8');
        return htmlspecialchars(json_encode($data, true), ENT_QUOTES, 'UTF-8');
    }

    $variations = $product['variations'];

    // helper: compute availability per color/material (true if any combination with stock>0)
    $avail_color = [];
    $avail_material = [];
    foreach($variations['colors'] as $c_key => $c_label) {
        $ok = false;
        foreach($variations['materials'] as $m_key => $m_label) {
            $k = $c_key . '|' . $m_key;
            if(isset($variations['combinations'][$k]) && ($variations['combinations'][$k]['stock'] ?? 0) > 0) $ok = true;
        }
        $avail_color[$c_key] = $ok;
    }
    foreach($variations['materials'] as $m_key => $m_label) {
        $ok = false;
        foreach($variations['colors'] as $c_key => $c_label) {
            $k = $c_key . '|' . $m_key;
            if(isset($variations['combinations'][$k]) && ($variations['combinations'][$k]['stock'] ?? 0) > 0) $ok = true;
        }
        $avail_material[$m_key] = $ok;
    }

    // simple swatch color map (use your brand palette or images instead)
    $swatch_map = [
        'black' => '#111827',
        'grey'  => '#6B7280',
        'blue'  => '#1E3A8A'
    ];
?>

<!-- Product Detail Page (no header/footer) -->
<div class="pt-4">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-2 md:gap-4 items-start">

        <!-- Left: Images (thumbnails at bottom) -->
        <div class="lg:col-span-5 bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-4 shadow-sm">
            <div class="flex flex-col gap-4">

                <!-- Main image area -->
                <div class="relative {{ FD['rounded'] }} overflow-hidden border dark:border-slate-700 bg-slate-50 dark:bg-slate-900">
                    <div class="aspect-w-4 aspect-h-3 {{ FD['rounded'] }} overflow-hidden">
                        <img id="mainImage" src="<?= $product['images'][0] ?>" alt="Main product image" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105" />
                    </div>

                    <!-- badges -->
                    {{-- <div class="absolute left-3 top-3 flex items-center gap-2">
                        <?php foreach($product['badges'] as $badge): ?>
                            <span class="px-3 py-1 {{ FD['rounded'] }} text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-200 shadow-sm"><?= $badge ?></span>
                        <?php endforeach; ?>
                    </div> --}}

                    <!-- zoom / gallery -->
                    <button id="openGallery" class="absolute right-3 top-3 p-2 {{ FD['rounded'] }} bg-white/80 dark:bg-slate-800/80 hover:shadow text-xs" aria-label="Open gallery">🔍 View</button>
                </div>

                <!-- Thumbnails (bottom) -->
                <div class="flex items-center gap-2">
                    <div id="thumbs" class="flex gap-2 overflow-x-auto no-scrollbar py-1">
                        <?php foreach($product['images'] as $i => $img): ?>
                            <button type="button" class="thumb-item flex-none w-20 h-16 sm:w-24 sm:h-20 {{ FD['rounded'] }} overflow-hidden border dark:border-slate-700" data-img="<?= $img ?>" aria-label="View image <?= $i+1 ?>">
                                <img src="<?= $img ?>" alt="Thumb <?= $i+1 ?>" class="w-full h-full object-cover" />
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

            </div>

            <!-- Upsells / Deals -->
            {{-- <div class="mt-4 grid grid-cols-1 sm:grid-cols-3 gap-3">
                <?php foreach($upsells as $up): ?>
                    <div class="flex items-center gap-3 p-3 {{ FD['rounded'] }} border dark:border-slate-700 bg-white dark:bg-slate-800">
                        <img src="<?= $up['img'] ?>" alt="<?= htmlspecialchars($up['title']) ?>" class="w-20 h-16 object-cover {{ FD['rounded'] }} flex-none" />
                        <div class="flex-1 text-xs">
                            <div class="font-semibold text-sm"><?= htmlspecialchars($up['title']) ?></div>
                            <div class="text-xs text-slate-500 dark:text-slate-400"><?= $product['currency'] . number_format($up['price'],2) ?></div>
                            <div class="mt-2">
                                <button class="upsell-add px-2 py-1 text-xs {{ FD['rounded'] }} bg-amber-600 text-white" data-id="<?= $up['id'] ?>">Add</button>
                                <button class="ml-2 px-2 py-1 text-xs {{ FD['rounded'] }} border dark:border-slate-700 upsell-view" data-id="<?= $up['id'] ?>">View</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div> --}}

        </div>

        <!-- Right: Product Info & Actions -->
        <div class="lg:col-span-7 flex flex-col gap-4">
            <div class="bg-white dark:bg-slate-800 {{ FD['rounded'] }} p-4 shadow-sm">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex-1">
                        <h1 class="text-lg sm:text-xl font-semibold leading-tight"><?= htmlspecialchars($product['title']) ?></h1>

                        <div class="flex items-center gap-2 mt-2 text-xs text-slate-500 dark:text-slate-300">
                            <span class="flex items-center gap-1">
                                <div class="{{ FD['iconClass'] }} inline-block">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="m305-704 112-145q12-16 28.5-23.5T480-880q18 0 34.5 7.5T543-849l112 145 170 57q26 8 41 29.5t15 47.5q0 12-3.5 24T866-523L756-367l4 164q1 35-23 59t-56 24q-2 0-22-3l-179-50-179 50q-5 2-11 2.5t-11 .5q-32 0-56-24t-23-59l4-165L95-523q-8-11-11.5-23T80-570q0-25 14.5-46.5T135-647l170-57Zm49 69-194 64 124 179-4 191 200-55 200 56-4-192 124-177-194-66-126-165-126 165Zm126 135Z"/></svg>
                                </div>
                                <span class="font-medium"><?= number_format($product['rating'], 1) ?></span>
                            </span>
                            <span>·</span>
                            <span><?= number_format($product['review_count']) ?> reviews</span>
                            <span>·</span>
                            <span class="text-slate-400 dark:text-slate-400">By <strong><?= htmlspecialchars($product['brand']) ?></strong></span>
                        </div>

                        <div class="flex items-center gap-2 my-4">
                            <?php foreach($product['badges'] as $badge): ?>
                                <span class="px-3 py-1 {{ FD['rounded'] }} text-xs font-semibold bg-amber-200 text-amber-800 dark:bg-amber-900 dark:text-amber-200 shadow-sm"><?= $badge ?></span>
                            <?php endforeach; ?>
                        </div>

                        <p class="mt-3 text-xs text-slate-600 dark:text-slate-300"><?= htmlspecialchars($product['short_desc']) ?></p>

                        {{-- <ul class="mt-3 text-xs space-y-1 text-slate-600 dark:text-slate-300">
                            <?php foreach($product['highlights'] as $h): ?>
                                <li>• <?= htmlspecialchars($h) ?></li>
                            <?php endforeach; ?>
                        </ul> --}}

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
                        <div class="text-xl sm:text-2xl font-bold"><?= $product['currency'] . number_format($product['price'], 2) ?></div>
                        <div class="text-xs text-slate-500 dark:text-slate-400 line-through"><?= $product['currency'] . number_format($product['mrp'], 2) ?></div>
                        <div class="text-xs text-emerald-700 dark:text-emerald-300 font-medium mt-1">You save <?= $product['currency'] . number_format($product['mrp'] - $product['price'], 2) ?> (<?= round((($product['mrp'] - $product['price'])/$product['mrp'])*100) ?>% off)</div>
                    </div>

                    <!-- Quick bullet features -->
                    <div class="ml-auto text-xs text-slate-600 dark:text-slate-300 flex flex-col items-end gap-2">
                        <div class="flex items-center gap-2">
                            <div class="{{ FD['iconClass'] }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M620-163 450-333l56-56 114 114 226-226 56 56-282 282Zm220-397h-80v-200h-80v120H280v-120h-80v560h240v80H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h167q11-35 43-57.5t70-22.5q40 0 71.5 22.5T594-840h166q33 0 56.5 23.5T840-760v200ZM480-760q17 0 28.5-11.5T520-800q0-17-11.5-28.5T480-840q-17 0-28.5 11.5T440-800q0 17 11.5 28.5T480-760Z"/></svg>
                            </div>
                            In Stock
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="{{ FD['iconClass'] }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M200-120q-33 0-56.5-23.5T120-200v-500q0-14 4.5-26.5T138-750l56-68q9-11 20.5-16.5T240-840h480q14 0 25.5 5.5T766-818l56 68q9 11 13.5 23.5T840-700v500q0 33-23.5 56.5T760-120H200Zm16-600h528l-34-40H250l-34 40Zm-16 520h560v-440H200v440Zm382-78 142-142-142-142-58 58 84 84-84 84 58 58Zm-202 0 58-58-84-84 84-84-58-58-142 142 142 142Zm-180 78v-440 440Z"/></svg>
                            </div>
                            Free assembly kit
                        </div>
                    </div>
                </div>

                <!-- Variations -->
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-3 text-sm">
                    <!-- Colors -->
                    <div>
                        <label class="text-xs font-semibold block mb-1">Color</label>

                        <div role="radiogroup" aria-label="Choose color" class="flex items-center gap-3">
                        <?php foreach($variations['colors'] as $val => $label): 
                            $disabled = $avail_color[$val] ? '' : 'disabled';
                        ?>
                            <button
                            type="button"
                            role="radio"
                            aria-checked="false"
                            <?= $disabled ? 'aria-disabled="true"' : '' ?>
                            class="color-swatch relative w-10 h-10 rounded-full border dark:border-slate-700 flex items-center justify-center focus:outline-none transform transition-shadow text-xs"
                            data-key="color"
                            data-value="<?= $val ?>"
                            style="background: <?= $swatch_map[$val] ?? '#ccc' ?>;"
                            title="<?= htmlspecialchars($label) ?>"
                            <?= $disabled ? 'tabindex="-1" disabled' : 'tabindex="0"' ?>
                            >
                            <!-- low-contrast label for screenreaders -->
                            <span class="sr-only"><?= htmlspecialchars($label) ?></span>

                            <?php if(!$avail_color[$val]): ?>
                                <span class="absolute -right-1 -top-1 bg-red-600 text-white text-[10px] px-1 rounded">Out</span>
                            <?php endif; ?>
                            </button>
                        <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Materials -->
                    <div>
                        <label class="text-xs font-semibold block mb-1">Material</label>

                        <div role="radiogroup" aria-label="Choose material" class="flex items-center gap-3">
                        <?php foreach($variations['materials'] as $val => $label):
                            $disabled = $avail_material[$val] ? '' : 'disabled';
                            // small placeholder image per material (replace with your icons)
                            $img = $val === 'leather' ? 'https://dummyimage.com/64x64/8b5cf6/fff&text=L' : 'https://dummyimage.com/64x64/94a3b8/fff&text=M';
                        ?>
                            <button
                            type="button"
                            role="radio"
                            aria-checked="false"
                            <?= $disabled ? 'aria-disabled="true"' : '' ?>
                            class="material-tile flex flex-col items-center gap-1 p-1 {{ FD['rounded'] }} border dark:border-slate-700 bg-white dark:bg-slate-900 focus:outline-none text-xs"
                            data-key="material"
                            data-value="<?= $val ?>"
                            <?= $disabled ? 'tabindex="-1" disabled' : 'tabindex="0"' ?>
                            >
                            <img src="<?= $img ?>" alt="" class="w-10 h-10 object-cover {{ FD['rounded'] }}" />
                            <span class="text-xs"><?= htmlspecialchars($label) ?></span>
                            <?php if(!$avail_material[$val]): ?>
                                <span class="text-[10px] text-red-600">Unavailable</span>
                            <?php endif; ?>
                            </button>
                        <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Selected summary (full-width) -->
                    <div class="col-span-1 sm:col-span-2 mt-2">
                        <label class="text-xs font-semibold block mb-1">Selected</label>
                        {{-- <div class="text-xs text-slate-600 dark:text-slate-300">Selected:</div> --}}
                        <div id="selectedSummary" class="mt-1 font-semibold text-sm text-slate-900 dark:text-slate-100">— / —</div>
                        <div id="variantNote" class="mt-1 text-xs text-amber-700 hidden">Low stock for this combination</div>
                    </div>
                </div>

                <!-- Quantity & Actions -->
                <div class="mt-4 flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    <div class="items-center gap-2">
                        <label class="text-xs font-semibold block mb-1">Qty</label>
                        {{-- <label class="text-xs mr-2">Qty</label> --}}
                        <div class="flex items-center border {{ FD['rounded'] }} overflow-hidden">
                            <button id="qtyDec" class="w-9 h-9 px-3 py-2 text-sm" aria-label="Decrease">
                                <div class="{{ FD['iconClass'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M200-440v-80h560v80H200Z"/></svg>
                                </div>
                            </button>

                            <input id="qtyInput" type="text" min="1" value="1" class="w-9 text-center text-sm bg-white dark:bg-slate-800 outline-none" />

                            <button id="qtyInc" class="w-9 h-9 px-3 py-2 text-sm" aria-label="Increase">
                                <div class="{{ FD['iconClass'] }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                                </div>
                            </button>
                        </div>
                        <div class="ml-3 text-xs text-slate-500 dark:text-slate-400" id="stockInfo">Available: <?= $product['stock'] ?></div>
                    </div>

                    <div class="flex-1 flex gap-2 w-full sm:w-auto justify-end">
                        <button id="addToCart" class="flex-1 sm:flex-none px-4 py-2 {{ FD['rounded'] }} bg-amber-600 hover:bg-amber-700 text-white font-semibold text-sm inline-flex items-center justify-center" aria-label="Add to cart">
                            <!-- cart svg -->
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M6 6h15l-1.5 9h-13z"/><circle cx="9" cy="20" r="1"/><circle cx="18" cy="20" r="1"/></svg>
                            Add to Cart
                        </button>
                        <button id="buyNow" class="px-4 py-2 {{ FD['rounded'] }} border border-amber-600 text-amber-600 dark:text-amber-300 text-sm font-semibold">Buy Now</button>
                    </div>
                </div>

                <!-- Shipping & Offers -->
                <div class="mt-4 text-xs text-slate-600 dark:text-slate-300 grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div class="flex items-center gap-2"><svg class="{{ FD['iconClass'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 3h18v13H3z"/></svg> Delivery in <?= $product['shipping']['estimate_days'][0] ?>-<?= $product['shipping']['estimate_days'][1] ?> days</div>
                    <div class="flex items-center gap-2"><svg class="{{ FD['iconClass'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M12 2v6"/></svg> Cash on Delivery: <?= $product['cod_available'] ? 'Available' : 'Not available' ?></div>
                </div>

                <!-- Offers -->
                <div class="mt-4">
                    <?php foreach($product['offers'] as $offer): ?>
                        <div class="p-2 {{ FD['rounded'] }} bg-slate-50 dark:bg-slate-800 text-xs mb-2">
                            <strong class="text-sm"><?= htmlspecialchars($offer['title']) ?>:</strong>
                            <span class="ml-2"><?= htmlspecialchars($offer['desc']) ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>

            <!-- Right side small cards: Ads / Quick specs -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="{{ FD['rounded'] }} p-3 bg-gradient-to-tr from-amber-50 to-white dark:from-amber-900 dark:to-slate-800 shadow-sm">
                    <div class="text-xs font-semibold mb-2">Deal of the Day</div>
                    <div class="text-sm font-bold text-amber-700 dark:text-amber-300">Flat <?= $product['currency'] ?>2,000 off</div>
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
                                <?php foreach($product['specs'] as $k => $v): ?>
                                    <li><strong class="text-xs"><?= htmlspecialchars($k) ?>:</strong> <?= htmlspecialchars($v) ?></li>
                                <?php endforeach; ?>
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
                        <div class="text-sm font-bold"><?= number_format($product['rating'],1) ?> <span class="text-xs text-slate-500">/5</span></div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="text-xs text-slate-500"><?= number_format($product['review_count']) ?> ratings</div>
                        <button id="openReviewModal" class="px-3 py-1 text-xs {{ FD['rounded'] }} bg-amber-600 text-white">Add Review</button>
                    </div>
                </div>

                <div id="reviewsList" class="mt-3 space-y-3 text-xs text-slate-600 dark:text-slate-300">
                    <?php foreach($reviews as $r): ?>
                        <div class="p-3 {{ FD['rounded'] }} border dark:border-slate-700">
                            <div class="flex items-center justify-between">
                                <div class="font-semibold"><?= htmlspecialchars($r['name']) ?> <span class="text-xs text-slate-400">· <?= htmlspecialchars($r['date']) ?></span></div>
                                <div class="flex items-center gap-1">
                                    <?php for($i=0;$i<5;$i++): ?>
                                        <?php if($i < $r['rating']): ?>
                                            <svg class="w-3 h-3 text-amber-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>
                                        <?php else: ?>
                                            <svg class="w-3 h-3 text-slate-300" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="font-semibold text-sm"><?= htmlspecialchars($r['title']) ?></div>
                                <div class="mt-1 text-xs"><?= htmlspecialchars($r['body']) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
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
                        <p class="text-sm"><?= htmlspecialchars($product['long_desc']) ?></p>
                    </div>
                    <div data-panel="specs" class="hidden">
                        <ul class="text-xs space-y-1">
                            <?php foreach($product['specs'] as $k => $v): ?>
                                <li><strong><?= htmlspecialchars($k) ?>:</strong> <?= htmlspecialchars($v) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div data-panel="faqs" class="hidden">
                        <?php foreach($faqs as $f): ?>
                            <div class="border-b dark:border-slate-700 py-3">
                                <button class="faq-q w-full text-left text-xs font-semibold" type="button"><?= htmlspecialchars($f['q']) ?></button>
                                <div class="faq-a mt-2 text-xs hidden"><?= htmlspecialchars($f['a']) ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<!-- Review modal -->
<div id="reviewModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
    <div class="max-w-xl w-full {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-900 p-4">
        <div class="flex items-center justify-between mb-3">
            <div class="text-sm font-semibold">Write a Review</div>
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


<!-- Lightweight JS for interactions (no external libs) -->
<script>
    (function(){
        // const variations = JSON.parse('<?= safe_json($product['variations']) ?>');
        // const variations = <?= json_encode($product['variations'], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
        // const combinations = variations.combinations;
        const variations = <?= json_encode($variations, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?>;
        const combos = variations.combinations || {};

        // thumbnails -> change main image
        document.querySelectorAll('.thumb-item').forEach(btn => {
            btn.addEventListener('click', ()=>{
            document.getElementById('mainImage').src = btn.dataset.img;
            });
        });

        // open gallery (lightbox)
        document.getElementById('openGallery').addEventListener('click', ()=>{
            const light = document.createElement('div');
            light.className = 'fixed inset-0 z-60 bg-black/80 flex items-center justify-center p-4';
            light.innerHTML = `<div class="max-w-4xl w-full"><img src="${document.getElementById('mainImage').src}" class="w-full h-auto rounded" alt="preview"/></div>`;
            light.addEventListener('click', ()=> document.body.removeChild(light));
            document.body.appendChild(light);
        });

        // upsell add buttons
        document.querySelectorAll('.upsell-add').forEach(b=>{
            b.addEventListener('click', ()=>{
            const id = b.dataset.id;
            alert('Added upsell to cart (demo): '+id);
            });
        });

        // variant selection
        let selected = {
            color: Object.keys(variations.colors)[0],
            material: Object.keys(variations.materials)[0]
        };

        // utility to get combination info
        function comboKey(c,m){ return c + '|' + m; }
        function comboInfo(c,m){ return combos[comboKey(c,m)] || null; }

        // UI elements
        const colorBtns = Array.from(document.querySelectorAll('[data-key="color"]'));
        const materialBtns = Array.from(document.querySelectorAll('[data-key="material"]'));
        const summaryEl = document.getElementById('selectedSummary');
        const noteEl = document.getElementById('variantNote');

        // set ARIA/active state for a group
        function markActive(groupBtns, value){
            groupBtns.forEach(b=>{
            const v = b.dataset.value;
            const active = v === value;
            b.setAttribute('aria-checked', active ? 'true' : 'false');
            if(active){
                b.classList.add('ring-2','ring-amber-500');
                b.classList.remove('opacity-60');
            } else {
                b.classList.remove('ring-2','ring-amber-500');
            }
            });
        }

        // update summary and stock note, and call external hook if exists
        function updateVariantUI(){
            summaryEl.textContent = (variations.colors[selected.color] || selected.color) + ' / ' + (variations.materials[selected.material] || selected.material);
            const info = comboInfo(selected.color, selected.material);
            if(info){
            if(info.stock <= 2){
                noteEl.textContent = 'Low stock for this combination';
                noteEl.classList.remove('hidden');
            } else {
                noteEl.classList.add('hidden');
            }
            } else {
            noteEl.textContent = 'This combination is unavailable';
            noteEl.classList.remove('hidden');
            }

            // call external price/stock updater if present (keeps integration easy)
            if(typeof updatePriceAndStock === 'function') {
            // `updatePriceAndStock` in your page expects selected to be set globally; we set window.__selectedVariant
            window.__selectedVariant = selected;
            updatePriceAndStock();
            } else {
            // fallback: update .text-xl price element if present
            const priceEl = document.querySelector('.text-xl');
            if(priceEl && info && info.price) priceEl.textContent = '<?= $product['currency'] ?>' + Number(info.price).toFixed(2);
            }
        }

        // click & keyboard handlers for groups
        function attachGroupHandlers(groupBtns, keyName){
            groupBtns.forEach((btn, idx) => {
            // skip disabled
            if(btn.disabled) return;

            btn.addEventListener('click', ()=>{
                selected[keyName] = btn.dataset.value;
                markActive(groupBtns, selected[keyName]);
                updateVariantUI();
            });

            // keyboard: left/right/up/down + Enter/Space
            btn.addEventListener('keydown', (e)=>{
                const code = e.key;
                let nextIdx = null;
                if(code === 'ArrowRight' || code === 'ArrowDown') nextIdx = (idx + 1) % groupBtns.length;
                if(code === 'ArrowLeft'  || code === 'ArrowUp')   nextIdx = (idx - 1 + groupBtns.length) % groupBtns.length;
                if(nextIdx !== null){
                e.preventDefault();
                const next = groupBtns[nextIdx];
                if(!next.disabled) next.focus();
                }
                if(code === 'Enter' || code === ' '){
                e.preventDefault();
                btn.click();
                }
            });
            });
        }

        // init: mark available defaults (first enabled)
        (function init(){
            // find first available color/material (in case first has no combos)
            const firstColor = colorBtns.find(b => !b.disabled);
            const firstMaterial = materialBtns.find(b => !b.disabled);
            if(firstColor) selected.color = firstColor.dataset.value;
            if(firstMaterial) selected.material = firstMaterial.dataset.value;

            markActive(colorBtns, selected.color);
            markActive(materialBtns, selected.material);

            attachGroupHandlers(colorBtns, 'color');
            attachGroupHandlers(materialBtns, 'material');

            updateVariantUI();
        })();

        // qty controls
        const qtyInput = document.getElementById('qtyInput');
        document.getElementById('qtyInc').addEventListener('click', ()=>{ qtyInput.value = Math.max(1, parseInt(qtyInput.value||1)+1); updatePriceAndStock(); });
        document.getElementById('qtyDec').addEventListener('click', ()=>{ qtyInput.value = Math.max(1, parseInt(qtyInput.value||1)-1); updatePriceAndStock(); });

        function updatePriceAndStock(){
            const key = comboKey();
            const info = combos[key];
            const stockInfo = document.getElementById('stockInfo');
            const addToCart = document.getElementById('addToCart');
            if(!info && stockInfo){
                stockInfo.textContent = 'Combination unavailable';
                addToCart.disabled = true; addToCart.classList.add('opacity-60');
                return;
            }

            stockInfo.textContent = 'Available: ' + info.stock;
            addToCart.disabled = info.stock <= 0;
            addToCart.classList.toggle('opacity-60', info.stock <= 0);

            const priceEl = document.querySelector('.text-xl');
            if(priceEl){ priceEl.textContent = '<?= $product['currency'] ?>' + Number(info.price).toFixed(2); }
        }
        updatePriceAndStock();

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

        // Reviews modal
        const reviewModal = document.getElementById('reviewModal');
        document.getElementById('openReviewModal').addEventListener('click', ()=> reviewModal.classList.remove('hidden'));
        document.getElementById('closeReviewModal').addEventListener('click', ()=> reviewModal.classList.add('hidden'));

        // submit review (client demo)
        document.getElementById('reviewForm').addEventListener('submit', (e)=>{
            e.preventDefault();
            const newRev = { name: document.getElementById('revName').value || 'Anonymous', rating: parseInt(document.getElementById('revRating').value||5), title: document.getElementById('revTitle').value || '', body: document.getElementById('revBody').value || '', date: new Date().toISOString().slice(0,10) };
            const container = document.getElementById('reviewsList');
            const node = document.createElement('div');
            node.className = 'p-3 {{ FD['rounded'] }} border dark:border-slate-700';
            node.innerHTML = `<div class="flex items-center justify-between"><div class="font-semibold">${newRev.name} <span class="text-xs text-slate-400">· ${newRev.date}</span></div><div class="flex items-center gap-1">${Array.from({length:5}).map((_,i)=> i < newRev.rating ? '<svg class="w-3 h-3 text-amber-500" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>' : '<svg class="w-3 h-3 text-slate-300" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .587l3.668 7.431L24 9.748l-6 5.847L19.335 24 12 20.201 4.665 24 6 15.595 0 9.748l8.332-1.73L12 .587z"/></svg>').join('')}</div></div><div class="mt-2"><div class="font-semibold text-sm">${newRev.title}</div><div class="mt-1 text-xs">${newRev.body}</div></div>`;
            container.prepend(node);
            reviewModal.classList.add('hidden');
            document.getElementById('reviewForm').reset();
        });

        // Add to cart demo
        document.getElementById('addToCart').addEventListener('click', ()=>{
            const payload = { productId: <?= $product['id'] ?>, qty: parseInt(qtyInput.value||1), variant: comboKey() };
            alert('Added to cart:' + JSON.stringify(payload));
        });

    })();




    (function(){
        // // variations object (safe JS literal)
        // const variations = <?= json_encode($variations, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE) ?>;
        // const combos = variations.combinations || {};

        // // initial selected (first available)
        // let selected = {
        //     color: Object.keys(variations.colors)[0],
        //     material: Object.keys(variations.materials)[0]
        // };

        // // utility to get combination info
        // function comboKey(c,m){ return c + '|' + m; }
        // function comboInfo(c,m){ return combos[comboKey(c,m)] || null; }

        // // UI elements
        // const colorBtns = Array.from(document.querySelectorAll('[data-key="color"]'));
        // const materialBtns = Array.from(document.querySelectorAll('[data-key="material"]'));
        // const summaryEl = document.getElementById('selectedSummary');
        // const noteEl = document.getElementById('variantNote');

        // // set ARIA/active state for a group
        // function markActive(groupBtns, value){
        //     groupBtns.forEach(b=>{
        //     const v = b.dataset.value;
        //     const active = v === value;
        //     b.setAttribute('aria-checked', active ? 'true' : 'false');
        //     if(active){
        //         b.classList.add('ring-2','ring-amber-500');
        //         b.classList.remove('opacity-60');
        //     } else {
        //         b.classList.remove('ring-2','ring-amber-500');
        //     }
        //     });
        // }

        // // update summary and stock note, and call external hook if exists
        // function updateVariantUI(){
        //     summaryEl.textContent = (variations.colors[selected.color] || selected.color) + ' / ' + (variations.materials[selected.material] || selected.material);
        //     const info = comboInfo(selected.color, selected.material);
        //     if(info){
        //     if(info.stock <= 2){
        //         noteEl.textContent = 'Low stock for this combination';
        //         noteEl.classList.remove('hidden');
        //     } else {
        //         noteEl.classList.add('hidden');
        //     }
        //     } else {
        //     noteEl.textContent = 'This combination is unavailable';
        //     noteEl.classList.remove('hidden');
        //     }

        //     // call external price/stock updater if present (keeps integration easy)
        //     if(typeof updatePriceAndStock === 'function') {
        //     // `updatePriceAndStock` in your page expects selected to be set globally; we set window.__selectedVariant
        //     window.__selectedVariant = selected;
        //     updatePriceAndStock();
        //     } else {
        //     // fallback: update .text-xl price element if present
        //     const priceEl = document.querySelector('.text-xl');
        //     if(priceEl && info && info.price) priceEl.textContent = '<?= $product['currency'] ?>' + Number(info.price).toFixed(2);
        //     }
        // }

        // // click & keyboard handlers for groups
        // function attachGroupHandlers(groupBtns, keyName){
        //     groupBtns.forEach((btn, idx) => {
        //     // skip disabled
        //     if(btn.disabled) return;

        //     btn.addEventListener('click', ()=>{
        //         selected[keyName] = btn.dataset.value;
        //         markActive(groupBtns, selected[keyName]);
        //         updateVariantUI();
        //     });

        //     // keyboard: left/right/up/down + Enter/Space
        //     btn.addEventListener('keydown', (e)=>{
        //         const code = e.key;
        //         let nextIdx = null;
        //         if(code === 'ArrowRight' || code === 'ArrowDown') nextIdx = (idx + 1) % groupBtns.length;
        //         if(code === 'ArrowLeft'  || code === 'ArrowUp')   nextIdx = (idx - 1 + groupBtns.length) % groupBtns.length;
        //         if(nextIdx !== null){
        //         e.preventDefault();
        //         const next = groupBtns[nextIdx];
        //         if(!next.disabled) next.focus();
        //         }
        //         if(code === 'Enter' || code === ' '){
        //         e.preventDefault();
        //         btn.click();
        //         }
        //     });
        //     });
        // }

        // // init: mark available defaults (first enabled)
        // (function init(){
        //     // find first available color/material (in case first has no combos)
        //     const firstColor = colorBtns.find(b => !b.disabled);
        //     const firstMaterial = materialBtns.find(b => !b.disabled);
        //     if(firstColor) selected.color = firstColor.dataset.value;
        //     if(firstMaterial) selected.material = firstMaterial.dataset.value;

        //     markActive(colorBtns, selected.color);
        //     markActive(materialBtns, selected.material);

        //     attachGroupHandlers(colorBtns, 'color');
        //     attachGroupHandlers(materialBtns, 'material');

        //     updateVariantUI();
        // })();

    })();
</script>

</x-guest-layout>
