<div wire:key="product-variant-{{ $product_id }}">
    @if(!empty($existingVariations['raw']) && count($existingVariations['raw']) > 0)
        <div id="existingVariationsPanelDetailed" class="grid gap-4 mb-3 grid-cols-1">
            <div>
                <button 
                    type="button" 
                    class="text-xs inline-block text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-500" 
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'add-variant');"
                >
                    <div class="flex items-center">
                        <div class="w-3 h-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                        </div>
                        Add more options like Colors and Size
                    </div>
                </button>
            </div>

            <div wire:key="existing-variations-{{ $product_id }}">
                {{-- heading --}}
                <div class="space-y-4">
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($existingVariations['raw'] as $variationIndex => $variation)
                                <div class="p-3 hover:bg-gray-50 {{ ($variationIndex % 2 == 0) ? 'dark:bg-gray-700/50' : 'dark:bg-gray-700/20' }} dark:hover:bg-gray-900/50 transition-colors">
                                    <div class="flex justify-between items-center text-xs text-gray-500 dark:text-gray-400">
                                        <div class="flex flex-wrap gap-1 mb-2">
                                            @foreach($variation['combinations'] as $combo)
                                                <span class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700">
                                                    {{ $combo['attribute_title'] }}: {{ $combo['value_title'] }}
                                                </span>
                                            @endforeach
                                        </div>

                                        <div class="flex space-x-2 items-center justify-end">
                                            <x-admin.button-icon
                                                element="a"
                                                :href="route('admin.product.listing.variation.edit', $variation['id'])"
                                                tag="secondary"
                                                class="!w-6 !h-6 !p-0 border"
                                                {{-- wire:click="editVariation({{ $variation['id'] }})" --}}
                                                title="Edit"
                                            >
                                                @slot('icon')
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                                @endslot
                                            </x-admin.button-icon>

                                            <x-admin.button-icon
                                                element="button"
                                                type="button"
                                                tag="danger"
                                                class="!w-6 !h-6 !p-0"
                                                x-on:click.prevent="
                                                    $dispatch('open-modal', 'confirm-variation-deletion');
                                                    $dispatch('set-variation-id', {{ $variation['id'] }})
                                                    $dispatch('data-title', '{{ $variation['variation_identifier'] }}');
                                                "
                                                title="Delete"
                                            >
                                                @slot('icon')
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                                                        <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/>
                                                    </svg>
                                                @endslot
                                            </x-admin.button-icon>
                                        </div>
                                    </div>

                                    <div class="grid gap-4 grid-cols-1 xl:grid-cols-3 2xl:grid-cols-4">
                                        <div>
                                            <p class="text-[10px] text-gray-500 dark:text-gray-400">
                                                Identifier
                                                <span class="text-[10px] text-gray-700 dark:text-gray-200 font-bold">
                                                    {{$variation['variation_identifier']}}
                                                </span>
                                            </p>
                                            <p class="text-[10px] text-gray-500 dark:text-gray-400">
                                                SKU
                                                @if (!empty($variation['sku']))
                                                    <span class="text-[10px] text-gray-700 dark:text-gray-200 font-bold">
                                                        {{$variation['sku']}}
                                                    </span>
                                                @else
                                                    <span class="text-[10px] text-red-300 dark:text-red-200 font-bold">
                                                        NA
                                                    </span>
                                                @endif
                                            </p>
                                            <p class="text-[10px] text-gray-500 dark:text-gray-400">
                                                Barcode
                                                @if (!empty($variation['barcode']))
                                                    <span class="text-[10px] text-gray-700 dark:text-gray-200 font-bold">
                                                        {{$variation['barcode']}}
                                                    </span>
                                                @else
                                                    <span class="text-[10px] text-red-300 dark:text-red-200 font-bold">
                                                        NA
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-[10px] text-gray-500 dark:text-gray-400">
                                                Track quantity
                                                @if ($variation['track_quantity'] == 1)
                                                    <span class="text-[10px] text-gray-700 dark:text-gray-200 font-bold">
                                                        YES
                                                    </span>
                                                @else
                                                    <span class="text-[10px] text-red-300 dark:text-red-200 font-bold">
                                                        NA
                                                    </span>
                                                @endif
                                            </p>
                                            <p class="text-[10px] text-gray-500 dark:text-gray-400">
                                                Stock quantity
                                                @if ($variation['stock_quantity'] > 0)
                                                    <span class="text-[10px] text-gray-700 dark:text-gray-200 font-bold">
                                                        {{$variation['stock_quantity']}}
                                                    </span>
                                                @else
                                                    <span class="text-[10px] text-red-300 dark:text-red-200 font-bold">
                                                        NA
                                                    </span>
                                                @endif
                                            </p>
                                            <p class="text-[10px] text-gray-500 dark:text-gray-400">
                                                Continue selling when out of stock
                                                @if ($variation['allow_backorders'] == 1)
                                                    <span class="text-[10px] text-gray-700 dark:text-gray-200 font-bold">
                                                        YES
                                                    </span>
                                                @else
                                                    <span class="text-[10px] text-red-300 dark:text-red-200 font-bold">
                                                        NA
                                                    </span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
            <div>
                <button 
                    type="button" 
                    class="text-xs inline-block text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-500" 
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'add-variant');"
                >
                    <div class="flex items-center">
                        <div class="w-3 h-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                        </div>
                        Add options like Colors and Size
                    </div>
                </button>
            </div>
        </div>
    @endif


    {{-- add variant modal --}}
    <x-modal name="add-variant" maxWidth="7xl" show focusable>
        <div class="p-4">
            @if (count($variations) > 0)
                <div class="grid space-x-2 grid-cols-3">
                    <div class="col-span-2">
                        {{-- heading --}}
                        <h5 class="text-xs font-bold text-gray-700 dark:text-gray-200"> {{ __('Available Variations to create from') }} </h5>
                        <p class="mb-3 text-xs text-gray-500 dark:text-gray-400"> {{ __('These available variations are shown based on Category.') }} {{ __('Select one by one from the Variation Attributes Value list below and tap on Create New') }} </p>

                        {{-- search --}}
                        <div class="grid gap-4 mb-3 grid-cols-1 md:grid-cols-4">
                            <div>
                                <x-admin.input-label for="search" :value="__('Search')" />
                                <x-admin.text-input 
                                    id="search" 
                                    class="block" 
                                    type="search" 
                                    name="search" 
                                    wire:model.live.debounce.300ms="search"
                                    placeholder="Search..." 
                                />
                            </div>
                        </div>

                        {{-- attribute values --}}
                        @foreach ($variations as $variationAttr)
                            <div class="mb-6">
                                {{-- attribute --}}
                                <h5 class="text-base font-medium text-primary-500 dark:text-primary-400 hover:text-primary-600 transition-colors inline-block mb-3">
                                    <a href="{{ route('admin.product.variation.attribute.edit', $variationAttr->id) }}" 
                                    target="_blank"
                                    class="flex items-center gap-1">
                                        {{ $variationAttr->title }}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                        </svg>
                                    </a>
                                </h5>

                                {{-- values --}}
                                <div class="flex flex-wrap gap-2">
                                    @forelse ($variationAttr->values as $attrValue)
                                        <div class="border dark:border-gray-700 text-center overflow-hidden min-w-[40px] bg-white dark:bg-gray-700">
                                            <p class="text-xs p-1 bg-gray-50 dark:bg-gray-600">{{ $attrValue->title }}</p>
                                            <x-admin.button-icon
                                                element="a" 
                                                tag="secondary" 
                                                class="w-full !h-6 !rounded-none cursor-pointer" 
                                                data-attr-id="{{ $attrValue->attribute_id }}" 
                                                data-attr-title="{{ $variationAttr->title }}" 
                                                data-value-id="{{ $attrValue->id }}" 
                                                data-value-title="{{ $attrValue->title }}" 
                                                onclick="createNewVariation(event)"
                                                >
                                                @slot('icon')
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-4 h-4" fill="currentColor"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>
                                                @endslot
                                            </x-admin.button-icon>
                                        </div>
                                    @empty
                                        <p class="text-xs text-gray-500 dark:text-gray-400 italic">{{ __('No values found for this Attribute') }}</p>
                                    @endforelse
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="col-span-1">
                        {{-- heading --}}
                        {{-- <h5 class="text-xs font-bold text-gray-700 dark:text-gray-200"> {{ __('Create New Variation') }} </h5>
                        <p class="mb-3 text-xs text-gray-500 dark:text-gray-400"> {{ __('New variation will be displayed here') }} </p> --}}

                        <div id="selectedVariationsPanel" class="" style="display: none;">
                            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-none">
                                <div id="selectedVariationsList" class="divide-y divide-gray-200 dark:divide-gray-700"></div>
                                <div class="px-4 py-3 bg-gray-200 dark:bg-gray-700/50 text-right">
                                    <x-admin.button
                                        element="button"
                                        type="button"
                                        id="saveVariantsBtn"
                                    >
                                        @slot('icon')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                                        @endslot
                                        {{ __('Save this Variant') }}
                                    </x-admin.button>
                                </div>
                            </div>

                            @if(!empty($existingVariations['grouped']) && count($existingVariations['grouped']) > 0)
                                <hr class="border-gray-200 dark:border-gray-600 my-4"></hr>
                            @endif
                        </div>

                        @if(!empty($existingVariations['grouped']) && count($existingVariations['grouped']) > 0)
                            <div id="existingVariationsPanel" class="">
                                {{-- heading --}}
                                <h5 class="text-xs font-bold text-gray-700 dark:text-gray-200"> {{ __('Existing Variations') }} </h5>
                                <p class="mb-3 text-xs text-gray-500 dark:text-gray-400"> {{ __('These existing variations are already added based on Category.') }} {{ __('You can also add more information to the variation groups like, SKU, Stock Quantity, Price adjustment, Images etc') }} </p>

                                <div class="space-y-4">
                                    @foreach($existingVariations['grouped'] as $attribute => $values)
                                        <div>
                                            <h4 class="text-xs font-bold text-primary-500 dark:text-primary-400">{{ $attribute }}</h4>
                                            <div class="flex flex-wrap gap-2 mt-2">
                                                @foreach($values as $value)
                                                    <span class="text-xs px-2 py-1 bg-gray-100 dark:bg-gray-600 rounded-full">
                                                        {{ $value }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <p class="text-sm italic">{{ __('No variations found for this Category') }}</p>
            @endif
        </div>
    </x-modal>


    {{-- delete confirm modal --}}
    <x-modal name="confirm-variation-deletion" maxWidth="sm" focusable>
        <div 
            class="p-6" 
            x-data="{ variationId: null, title: '' }" 
            x-on:set-variation-id.window="variationId = $event.detail"
            x-on:data-title.window="title = $event.detail"
        >
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure?') }}
            </h2>

            <h5 x-text="title" class="text-gray-500 mt-1 capitalize"></h5>

            <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                {{ __('Once this variation is deleted, it cannot be recovered') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-admin.button
                    element="button"
                    type="button"
                    tag="secondary"
                    class="border"
                    x-on:click="$dispatch('close')"
                >
                    {{ __('Cancel') }}
                </x-admin.button>
    
                <x-admin.button
                    element="button"
                    type="button"
                    tag="danger"
                    class="ms-3"
                    wire:click="deleteVariation(variationId)"
                    x-on:click="$dispatch('close')"
                >
                    {{ __('Delete') }}
                </x-admin.button>
            </div>
        </div>
    </x-modal>

</div>

<script>
    // Store the original attribute order from the server
    const originalAttributeOrder = @json($variations->pluck('id'));
    let selectedVariations = [];

    window.createNewVariation = function(event) {
        const button = event.currentTarget;
        
        const variation = {
            attributeId: button.dataset.attrId,
            attributeTitle: button.dataset.attrTitle,
            valueId: button.dataset.valueId,
            valueTitle: button.dataset.valueTitle,
            // Store the original position for sorting
            originalPosition: originalAttributeOrder.indexOf(parseInt(button.dataset.attrId))
        };

        // Check if this attribute is already selected
        const existingIndex = selectedVariations.findIndex(
            v => v.attributeId === variation.attributeId
        );

        if (existingIndex >= 0) {
            // If clicking the same value, remove it (toggle off)
            if (selectedVariations[existingIndex].valueId === variation.valueId) {
                selectedVariations.splice(existingIndex, 1);
                button.classList.remove('bg-primary-400', 'hover:bg-primary-500', 'dark:bg-primary-600', 'dark:hover:bg-primary-700');
            } 
            // If clicking different value of same attribute, replace it
            else {
                selectedVariations[existingIndex] = variation;
                // Remove highlight from previously selected button
                document.querySelectorAll(`[data-attr-id="${variation.attributeId}"]`).forEach(btn => {
                    btn.classList.remove('bg-primary-400', 'hover:bg-primary-500', 'dark:bg-primary-600', 'dark:hover:bg-primary-700');
                });
                button.classList.add('bg-primary-400', 'hover:bg-primary-500', 'dark:bg-primary-600', 'dark:hover:bg-primary-700');
            }
        } else {
            // Add new selection
            selectedVariations.push(variation);
            button.classList.add('bg-primary-400', 'hover:bg-primary-500', 'dark:bg-primary-600', 'dark:hover:bg-primary-700');
        }

        // Sort selected variations by their original position
        selectedVariations.sort((a, b) => a.originalPosition - b.originalPosition);

        updateSelectedVariationsUI();
    }

    function updateSelectedVariationsUI() {
        const panel = document.getElementById('selectedVariationsPanel');
        const list = document.getElementById('selectedVariationsList');

        list.innerHTML = '';

        if (selectedVariations.length === 0) {
            panel.style.display = 'none';
            return;
        }

        panel.style.display = 'block';

        selectedVariations.forEach(variation => {
            const item = document.createElement('div');
            item.className = 'flex items-center justify-between p-2 bg-gray-200/20 hover:bg-gray-100 dark:hover:bg-gray-700/50';
            item.innerHTML = `
                <div class="flex items-center">
                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-md bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-300 mr-3">
                        ${variation.attributeTitle.charAt(0)}
                    </span>
                    <div>
                        <p class="text-xs font-medium text-gray-800 dark:text-gray-200">${variation.attributeTitle}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">${variation.valueTitle}</p>
                    </div>
                </div>
                <button 
                    onclick="removeVariation('${variation.attributeId}')" 
                    class="p-1 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors"
                    aria-label="Remove"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            `;
            list.appendChild(item);
        });

        // Add input fields after the variations
        const inputsContainer = document.createElement('div');
        inputsContainer.className = 'flex flex-col';
        inputsContainer.innerHTML = `
            <div class="flex items-center justify-between p-2 bg-gray-200/20 hover:bg-gray-100 dark:hover:bg-gray-700/50">
                <label class="text-xs font-medium text-gray-800 dark:text-gray-200">Price Adjust</label>
                <div class="flex items-center gap-2">
                    <select name="adjustment_type" class="text-xs bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-2 py-1">
                        <option value="fixed" selected>Fixed</option>
                        <option value="percentage">Percentage</option>
                    </select>
                    <input type="number" name="price_adjustment" class="text-xs bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-2 py-1 w-32" placeholder="0.00">
                </div>
            </div>
            <div class="flex items-center justify-between p-2 bg-gray-200/20 hover:bg-gray-100 dark:hover:bg-gray-700/50">
                <label class="text-xs font-medium text-gray-800 dark:text-gray-200">SKU</label>
                <input type="text" name="sku_variant" class="text-xs bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-2 py-1 w-32" placeholder="SKU">
            </div>
            <div class="flex items-center justify-between p-2 bg-gray-200/20 hover:bg-gray-100 dark:hover:bg-gray-700/50">
                <label class="text-xs font-medium text-gray-800 dark:text-gray-200">Stock</label>
                <input type="number" name="stock_quantity_variant" class="text-xs bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-2 py-1 w-20" placeholder="0">
            </div>
            <div class="flex items-center justify-between p-2 bg-gray-200/20 hover:bg-gray-100 dark:hover:bg-gray-700/50">
                <label for="allow_backorders" class="text-xs font-medium text-gray-800 dark:text-gray-200">Continue selling when out of stock</label>
                <input type="checkbox" name="allow_backorders" id="allow_backorders" x-on:change="document.querySelector('input[name=allowBackordersFailsafe]').value = $event.target.checked" class="rounded border-gray-300 dark:border-gray-600 text-primary-600 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50 dark:bg-gray-700 dark:checked:bg-primary-500">
                <input type="hidden" name="allowBackordersFailsafe" value="false">
            </div>
        `;

        list.appendChild(inputsContainer);
    }

    function removeVariation(attributeId) {
        // Remove from selected variations
        selectedVariations = selectedVariations.filter(v => v.attributeId !== attributeId);

        // Update button highlights
        document.querySelectorAll(`[data-attr-id="${attributeId}"]`).forEach(btn => {
            btn.classList.remove('bg-primary-400', 'hover:bg-primary-500', 'dark:bg-primary-600', 'dark:hover:bg-primary-700');
        });

        updateSelectedVariationsUI();
    }

    // Save variants
    document.getElementById('saveVariantsBtn').addEventListener('click', async () => {
        // console.log(selectedVariations);

        try {
            const adjustmentType = document.querySelector('select[name=adjustment_type]').value;
            const priceAdjustment = document.querySelector('input[name=price_adjustment]').value;
            const sku = document.querySelector('input[name=sku_variant]').value;
            const stockQuantity = document.querySelector('input[name=stock_quantity_variant]').value;
            const allowBackorders = document.querySelector('input[name=allowBackordersFailsafe]').value == "true" ? 1 : 0;

            const response = await fetch('/api/variation/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: {{ $product_id }},
                    adjustment_type: adjustmentType,
                    price_adjustment: priceAdjustment,
                    sku: sku,
                    stock_quantity: stockQuantity,
                    allow_backorders: allowBackorders,
                    variations: selectedVariations.map(v => ({
                        attribute_id: v.attributeId,
                        attribute_value_id: v.valueId,
                        attribute_value_title: v.valueTitle
                    }))
                })
            });

            const result = await response.json();

            if (response.ok) {
                if (result.code == 200) {
                    window.showNotification('success', 'Success!', result.message);

                    // Refresh the Livewire component
                    Livewire.dispatch('variation-added');

                    // Clear selections
                    selectedVariations = [];
                    updateSelectedVariationsUI();

                    // Remove highlights from all buttons
                    document.querySelectorAll('[data-attr-id]').forEach(btn => {
                        btn.classList.remove('bg-primary-400', 'hover:bg-primary-500', 'dark:bg-primary-600', 'dark:hover:bg-primary-700');
                    });
                } else {
                    window.showNotification('warning', 'Oops!', result.message);
                }
            } else {
                throw new Error(result.message);
            }
        } catch (error) {
            console.error('Error saving variations:', error);
        }
    });
</script>