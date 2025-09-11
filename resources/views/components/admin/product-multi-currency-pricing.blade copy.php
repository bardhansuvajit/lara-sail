@props([
    'activeCountries', 
    'productPrices' => null
])

<div id="currencyPricingWrapper">
    @php
        // Determine if we're in edit mode with existing prices
        $isEditMode = !empty($productPrices);
        
        // Set the initial count based on edit mode or old input
        if ($isEditMode) {
            $initialCount = count($productPrices);
        } else {
            $initialCount = old('country_code') ? count(old('country_code')) : 1;
        }
    @endphp

    <!-- Add a hidden field to track removed price IDs -->
    <input type="hidden" name="removed_price_ids" id="removedPriceIds" value="">

    @for($i = 0; $i < $initialCount; $i++)
        <div class="currency-block" data-block-id="{{ $i }}">
            <div class="flex justify-between items-start mb-2">
                <h5 class="font-semibold text-gray-700 dark:text-primary-300 block-heading">Currency Block</h5>
                @if($i > 0)
                    <button type="button" class="remove-currency-btn text-xs text-red-600 hover:underline">Remove</button>
                @else
                    <button type="button" class="remove-currency-btn text-xs text-red-600 hover:underline hidden">Remove</button>
                @endif
            </div>

            <div class="grid gap-4 mb-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                <div>
                    <x-admin.input-label for="selling_price_{{ $i }}" :value="__('Selling price *')" />
                    <x-admin.text-input-with-dropdown 
                        id="selling_price_{{ $i }}" 
                        class="block w-auto" 
                        type="tel" 
                        name="selling_price[]" 
                        :value="$isEditMode ? $productPrices[$i]->selling_price : old('selling_price.'.$i)" 
                        placeholder="Enter Selling Price" 
                        selectId="currency_{{ $i }}" 
                        selectName="country_code[]" 
                        maxlength="13"
                    >
                        @slot('options')
                            @foreach ($activeCountries as $country)
                                @php
                                    $isSelected = false;
                                    
                                    // Check for selected option in different scenarios
                                    if ($isEditMode) {
                                        $isSelected = $productPrices[$i]->country_code == $country->code;
                                    } else if (old('country_code.'.$i)) {
                                        $isSelected = old('country_code.'.$i) == $country->code;
                                    } else if (!$i && !old('country_code')) {
                                        $isSelected = applicationSettings('country_code') == $country->code;
                                    }
                                @endphp
                                
                                <x-admin.input-select-option 
                                    value="{{ $country->code }}" 
                                    :selected="$isSelected"
                                >
                                    {{ $country->currency_symbol }} ({{ $country->currency_code }})
                                </x-admin.input-select-option>
                            @endforeach
                        @endslot
                    </x-admin.text-input-with-dropdown>
                    <x-admin.input-error :messages="$errors->get('selling_price.'.$i)" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="mrp_{{ $i }}" :value="__('MRP')" />
                    <x-admin.text-input 
                        id="mrp_{{ $i }}" 
                        class="block" 
                        type="tel" 
                        name="mrp[]" 
                        :value="$isEditMode ? $productPrices[$i]->mrp : old('mrp.'.$i)" 
                        placeholder="Enter MRP" 
                        maxlength="13" 
                    />
                    <x-admin.input-error :messages="$errors->get('mrp.'.$i)" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="discount_{{ $i }}" :value="__('Discount')" />
                    <x-admin.text-input 
                        id="discount_{{ $i }}" 
                        class="block" 
                        type="tel" 
                        name="discount[]" 
                        :value="$isEditMode ? $productPrices[$i]->discount : old('discount.'.$i, 0)" 
                        placeholder="Discount will be calculated automatically" 
                        readonly 
                        tabindex="-1" 
                    />
                    <x-admin.input-error :messages="$errors->get('discount.'.$i)" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                <div>
                    <x-admin.input-label for="cost_{{ $i }}" :value="__('Cost per item')" />
                    <x-admin.text-input 
                        id="cost_{{ $i }}" 
                        class="block" 
                        type="tel" 
                        name="cost[]" 
                        :value="$isEditMode ? $productPrices[$i]->cost : old('cost.'.$i)" 
                        placeholder="Enter Cost" 
                        maxlength="13" 
                    />
                    <x-admin.input-error :messages="$errors->get('cost.'.$i)" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="profit_{{ $i }}" :value="__('Profit')" />
                    <x-admin.text-input 
                        id="profit_{{ $i }}" 
                        class="block" 
                        type="tel" 
                        name="profit[]" 
                        :value="$isEditMode ? $productPrices[$i]->profit : old('profit.'.$i, 0)" 
                        placeholder="Profit will be calculated automatically" 
                        readonly 
                        tabindex="-1" 
                    />
                    <x-admin.input-error :messages="$errors->get('profit.'.$i)" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="margin_{{ $i }}" :value="__('Margin')" />
                    <x-admin.text-input 
                        id="margin_{{ $i }}" 
                        class="block" 
                        type="tel" 
                        name="margin[]" 
                        :value="$isEditMode ? $productPrices[$i]->margin : old('margin.'.$i, 0)" 
                        placeholder="Margin will be calculated automatically" 
                        readonly 
                        tabindex="-1" 
                    />
                    <x-admin.input-error :messages="$errors->get('margin.'.$i)" class="mt-2" />
                </div>
            </div>
            
            <!-- Hidden field to store price ID for updates in edit mode -->
            @if($isEditMode && isset($productPrices[$i]->id))
                <input type="hidden" name="price_ids[]" value="{{ $productPrices[$i]->id }}" />
            @endif
        </div>
    @endfor
</div>

@if (count($activeCountries) > 0)
    <div class="grid gap-2 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
        <div>
            <a href="javascript:void(0);" id="addCurrencyBtn" class="text-xs inline-block text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-500">
                <div class="flex items-center">
                    <div class="w-3 h-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                    </div>
                    Add different currency
                </div>
            </a>
            <p id="currencyLimitMsg" class="text-xs text-red-500 mt-1 hidden"></p>
        </div>
    </div>
@endif

<script>
document.addEventListener("DOMContentLoaded", function () {
    const maxCurrencies = {{ count($activeCountries) }};
    const wrapper = document.getElementById("currencyPricingWrapper");
    const addBtn = document.getElementById("addCurrencyBtn");
    const limitMsg = document.getElementById("currencyLimitMsg");

    // Start nextId from the count of existing blocks
    let nextId = wrapper.querySelectorAll('.currency-block').length;

    // Initialize all existing blocks
    wrapper.querySelectorAll('.currency-block').forEach(block => {
        initializeBlock(block);
    });

    function markDuplicateCurrencyBlocks() {
        const headings = Array.from(wrapper.querySelectorAll('.block-heading'));
        const counts = headings.reduce((map, h) => {
            const t = (h.textContent || '').trim();
            if (!t) return map;
            map[t] = (map[t] || 0) + 1;
            return map;
        }, {});
        headings.forEach(h => {
            const t = (h.textContent || '').trim();
            if (t && counts[t] > 1) h.classList.add('text-red-600');
            else h.classList.remove('text-red-600');
        });
    }

    function getUsedCountries(excludeBlock = null) {
        const used = new Set();
        wrapper.querySelectorAll("select[name='country_code[]']").forEach(sel => {
            if (sel === excludeBlock) return;
            const v = (sel.value || "").trim();
            if (v) used.add(v);
        });
        return used;
    }

    function findNextAvailableCountry(templateSelect) {
        const used = getUsedCountries();
        for (let i = 0; i < templateSelect.options.length; i++) {
            const opt = templateSelect.options[i];
            if (!used.has(opt.value)) return opt.value;
        }
        return null;
    }

    function sanitizeNumericInput(value) {
        if (!value && value !== 0) return "";

        value = String(value).replace(/,/g, '.');        // accept comma as decimal
        value = value.replace(/[^0-9.]/g, '');           // keep digits and dot only

        if (value.startsWith('.')) value = '0' + value;  // ".09" -> "0.09"

        // keep only first dot
        const firstDot = value.indexOf('.');
        if (firstDot !== -1) {
            let before = value.slice(0, firstDot) || '0';
            let after = value.slice(firstDot + 1).replace(/\./g, ''); // drop other dots
            before = before.slice(0, 10);
            after = after.slice(0, 2);
            return after.length ? (before + '.' + after) : before;
        } else {
            return value.slice(0, 10);
        }
    }

    function initializeBlock(block) {
        const sellingEl = block.querySelector("input[name='selling_price[]']");
        const mrpEl = block.querySelector("input[name='mrp[]']");
        const discountEl = block.querySelector("input[name='discount[]']");
        const costEl = block.querySelector("input[name='cost[]']");
        const profitEl = block.querySelector("input[name='profit[]']");
        const marginEl = block.querySelector("input[name='margin[]']");
        const countrySelect = block.querySelector("select[name='country_code[]']");
        const heading = block.querySelector(".block-heading");
        const removeBtn = block.querySelector(".remove-currency-btn");

        // add a composing flag to avoid interfering with IME
        [sellingEl, mrpEl, costEl].forEach(el => {
            if (!el) return;
            el._isComposing = false;
            el.addEventListener('compositionstart', () => { el._isComposing = true; });
            el.addEventListener('compositionend', () => {
                el._isComposing = false;
                // sanitize after composition ends
                el.addEventListener("input", formatPriceInput);
                // el.value = sanitizeNumericInput(el.value);
                // trigger related calculations if any
                el.dispatchEvent(new Event('input', { bubbles: true }));
                el.dispatchEvent(new Event('blur', { bubbles: true }));
            });
            // set helpful attributes
            el.setAttribute('maxlength','13');
            el.setAttribute('inputmode','decimal');
            el.setAttribute('pattern','\\d{0,10}(\\.\\d{0,2})?');
        });

        if (countrySelect && typeof countrySelect.dataset.prev === "undefined") {
            countrySelect.dataset.prev = countrySelect.value || "";
        }

        function updateHeading() {
            if (!heading || !countrySelect) return;
            const code = (countrySelect.value || "").toUpperCase();
            const text = code ? `${code} Currency Block` : (countrySelect.options[countrySelect.selectedIndex]?.text || "Currency Block");
            heading.innerText = text;
            markDuplicateCurrencyBlocks();
        }

        function calculateDiscount() {
            if (!sellingEl || !mrpEl || !discountEl) return;
            const sellingPrice = parseFloat(sanitizeNumericInput(sellingEl.value));
            const mrp = parseFloat(sanitizeNumericInput(mrpEl.value));

            if (isNaN(mrp) || isNaN(sellingPrice) || mrp <= 0) {
                discountEl.value = 0;
                discountEl.classList.remove('ring-1','ring-red-500','border-red-500');
                return;
            }
            if (sellingPrice < mrp) {
                const discount = ((mrp - sellingPrice) / mrp) * 100;
                discountEl.value = Math.round(discount);
                discountEl.classList.remove('ring-1','ring-red-500','border-red-500');
            } else {
                discountEl.value = 0;
                discountEl.classList.add('ring-1','ring-red-500','border-red-500');
            }
        }

        function calculateProfitMargin() {
            if (!sellingEl || !costEl || !profitEl || !marginEl) return;
            const sellingPrice = parseFloat(sanitizeNumericInput(sellingEl.value));
            const cost = parseFloat(sanitizeNumericInput(costEl.value));

            if (isNaN(sellingPrice) || isNaN(cost) || sellingPrice <= 0 || cost <= 0) {
                profitEl.value = 0; marginEl.value = 0;
                profitEl.classList.remove('ring-1','ring-red-500','border-red-500');
                marginEl.classList.remove('ring-1','ring-red-500','border-red-500');
                return;
            }

            if (cost < sellingPrice) {
                const profit = sellingPrice - cost;
                const roundedProfit = Math.round(profit * 100) / 100;
                const marginPercentage = (profit / sellingPrice) * 100;
                const roundedMarginPercentage = Math.round(marginPercentage * 100) / 100;
                profitEl.value = roundedProfit;
                marginEl.value = roundedMarginPercentage;
                profitEl.classList.remove('ring-1','ring-red-500','border-red-500');
                marginEl.classList.remove('ring-1','ring-red-500','border-red-500');
            } else {
                profitEl.value = 0; marginEl.value = 0;
                profitEl.classList.add('ring-1','ring-red-500','border-red-500');
                marginEl.classList.add('ring-1','ring-red-500','border-red-500');
            }
        }

        // input handling (skip sanitize while composing)
        [sellingEl, mrpEl, costEl].forEach(el => {
            if (!el) return;
            el.addEventListener('input', function (ev) {
                if (el._isComposing) return;
                el.value = sanitizeNumericInput(el.value);
                calculateDiscount();
                calculateProfitMargin();
            });
            el.addEventListener('blur', function (ev) {
                el.value = sanitizeNumericInput(el.value);
                calculateDiscount();
                calculateProfitMargin();
            });
            // el.addEventListener('compositionend', () => {
            //     el._isComposing = false;
            //     el.value = sanitizeNumericInput(el.value);
            //     el.dispatchEvent(new Event('input', { bubbles: true }));
            // });
            el.addEventListener('compositionend', () => {
                el._isComposing = false;
                // sanitize final composed value immediately
                el.value = sanitizeNumericInput(el.value);
                // trigger existing input/blur handlers so calculations run
                el.dispatchEvent(new Event('input', { bubbles: true }));
                el.dispatchEvent(new Event('blur', { bubbles: true }));
            });


            // allow '.' and ',' keys (no blocking) — sanitization will normalize
        });

        if (sellingEl) {
            sellingEl.addEventListener('input', function () {
                calculateDiscount();
                calculateProfitMargin();
            });
        }
        if (mrpEl) mrpEl.addEventListener('input', calculateDiscount);
        if (costEl) costEl.addEventListener('input', calculateProfitMargin);

        if (countrySelect) {
            countrySelect.addEventListener('change', function () {
                const previous = countrySelect.dataset.prev || "";
                const newVal = countrySelect.value || "";
                if (!newVal) {
                    countrySelect.dataset.prev = "";
                    updateHeading();
                    return;
                }
                const used = getUsedCountries(countrySelect);
                if (used.has(newVal)) {
                    limitMsg.innerText = "⚠️ This currency is already used in another block.";
                    limitMsg.classList.remove('hidden');
                    countrySelect.value = previous;
                    setTimeout(() => limitMsg.classList.add('hidden'), 3000);
                    return;
                }
                countrySelect.dataset.prev = newVal;
                updateHeading();
                limitMsg.classList.add('hidden');
            });
            updateHeading();
        }

        /*
        if (removeBtn) {
            removeBtn.addEventListener('click', function () {
                const count = wrapper.querySelectorAll('.currency-block').length;
                if (count <= 1) return;
                block.remove();
                limitMsg.classList.add('hidden');
            });
        }
        */

        if (removeBtn) {
            removeBtn.addEventListener('click', function () {
                const count = wrapper.querySelectorAll('.currency-block').length;
                if (count <= 1) return;

                // Check if this block has a price ID (edit mode)
                const priceIdInput = block.querySelector("input[name='price_ids[]']");
                if (priceIdInput && priceIdInput.value) {
                    // Add to removed price IDs
                    const removedIdsInput = document.getElementById('removedPriceIds');
                    const currentRemovedIds = removedIdsInput.value ? removedIdsInput.value.split(',') : [];
                    
                    if (!currentRemovedIds.includes(priceIdInput.value)) {
                        currentRemovedIds.push(priceIdInput.value);
                        removedIdsInput.value = currentRemovedIds.join(',');
                    }
                }

                block.remove();
                markDuplicateCurrencyBlocks();
                limitMsg.classList.add('hidden');
            });
        }

        // Trigger initial calculations for edit mode with existing values
        if (sellingEl && sellingEl.value) {
            calculateDiscount();
            calculateProfitMargin();
        }
    }

    const firstBlock = wrapper.querySelector('.currency-block');
    if (firstBlock) initializeBlock(firstBlock);

    addBtn.addEventListener('click', function () {
        const currentCount = wrapper.querySelectorAll('.currency-block').length;
        if (currentCount >= maxCurrencies) {
            limitMsg.innerText = "⚠️ You can not add any more currencies.";
            limitMsg.classList.remove('hidden');
            return;
        }

        const template = wrapper.querySelector('.currency-block');
        if (!template) return;

        const templateSelect = template.querySelector("select[name='country_code[]']");
        const nextCountry = findNextAvailableCountry(templateSelect);
        if (!nextCountry) {
            limitMsg.innerText = "⚠️ No unused currency remains to add.";
            limitMsg.classList.remove('hidden');
            return;
        }

        const newBlock = template.cloneNode(true);
        newBlock.setAttribute('data-block-id', String(nextId));

        newBlock.querySelectorAll('[id]').forEach(el => {
            const base = el.id.replace(/_\d+$/, '');
            el.id = base + '_' + nextId;
        });
        newBlock.querySelectorAll('label[for]').forEach(lbl => {
            const base = lbl.getAttribute('for').replace(/_\d+$/, '');
            lbl.setAttribute('for', base + '_' + nextId);
        });

        newBlock.querySelectorAll("input").forEach(i => {
            // Clear all input values except for hidden price_ids
            if (i.type !== 'hidden') i.value = "";
        });
        newBlock.querySelectorAll("select").forEach(s => s.selectedIndex = 0);

        newBlock.querySelectorAll("input[name='discount[]'], input[name='profit[]'], input[name='margin[]']").forEach(i => {
            i.setAttribute('readonly','readonly');
            i.setAttribute('tabindex','-1');
        });

        // Remove any hidden price_id field from the new block (it's for new entries)
        const priceIdInput = newBlock.querySelector("input[name='price_ids[]']");
        if (priceIdInput) priceIdInput.remove();

        const removeBtn = newBlock.querySelector('.remove-currency-btn');
        if (removeBtn) removeBtn.classList.remove('hidden');

        const newSelect = newBlock.querySelector("select[name='country_code[]']");
        if (newSelect) {
            for (let i = 0; i < newSelect.options.length; i++) {
                if (newSelect.options[i].value === nextCountry) {
                    newSelect.selectedIndex = i;
                    newSelect.dataset.prev = nextCountry;
                    break;
                }
            }
        }

        wrapper.appendChild(newBlock);
        markDuplicateCurrencyBlocks();
        initializeBlock(newBlock);
        nextId++;
        limitMsg.classList.add('hidden');
    });

    markDuplicateCurrencyBlocks();

});
</script>