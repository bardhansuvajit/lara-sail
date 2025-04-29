<div>
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

    <x-modal name="add-variant" maxWidth="7xl" show focusable>
        <div class="p-4">
            @if (count($variations) > 0)
                <div class="grid space-x-2 grid-cols-3">
                    <div class="col-span-2">
                        {{-- heading --}}
                        <h5 class="text-xs font-bold text-gray-700 dark:text-gray-200"> {{ __('Available Variations') }} </h5>
                        <p class="mb-3 text-xs text-gray-500 dark:text-gray-400"> {{ __('These available variations are shown based on Category.') }} {{ __('Select one by one from the Variation Attributes Value list below and tap on Create New') }} </p>

                        {{-- search --}}
                        <div class="grid gap-4 mb-3 grid-cols-1 md:grid-cols-4">
                            <div>
                                <x-admin.input-label for="search" :value="__('Search')" />
                                <x-admin.text-input 
                                    id="search" 
                                    class="block" 
                                    type="text" 
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
                        <h5 class="text-xs font-bold text-gray-700 dark:text-gray-200"> {{ __('Create New Variation') }} </h5>
                        <p class="mb-3 text-xs text-gray-500 dark:text-gray-400"> {{ __('New variation will be displayed here') }} </p>

                        <div id="selectedVariationsPanel" class="mb-6 p-4 border rounded-lg dark:border-gray-700" style="display: none;">
                            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                                <div class="px-4 py-3 border-b dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                                    <h5 class="text-sm font-medium text-gray-700 dark:text-gray-200">Selected Variations</h5>
                                </div>
                                <div id="selectedVariationsList" class="divide-y divide-gray-200 dark:divide-gray-700"></div>
                                <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700/50 text-right">
                                    <button 
                                        id="saveVariantsBtn"
                                        type="button" 
                                        class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white text-sm font-medium rounded-md shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        Save Variants
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p class="text-sm italic">{{ __('No variations found for this Category') }}</p>
            @endif
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
            item.className = 'flex items-center justify-between px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors';
            item.innerHTML = `
                <div class="flex items-center">
                    <span class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-300 mr-3">
                        ${variation.attributeTitle.charAt(0)}
                    </span>
                    <div>
                        <p class="text-sm font-medium text-gray-800 dark:text-gray-200">${variation.attributeTitle}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">${variation.valueTitle}</p>
                    </div>
                </div>
                <button 
                    onclick="removeVariation('${variation.attributeId}')" 
                    class="p-1 text-gray-400 hover:text-gray-500 dark:hover:text-gray-300 rounded-full hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors"
                    aria-label="Remove"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            `;
            list.appendChild(item);
        });
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
        try {
            const response = await fetch('{{ route("admin.product.listing.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: {{ $product_id }},
                    variations: selectedVariations.map(v => ({
                        attribute_id: v.attributeId,
                        value_id: v.valueId
                    }))
                })
            });
            
            const result = await response.json();
            
            if (response.ok) {
                alert('Variations saved successfully!');
                // Close modal or refresh data as needed
                $dispatch('close-modal', 'add-variant');
            } else {
                throw new Error(result.message || 'Failed to save variations');
            }
        } catch (error) {
            console.error('Error saving variations:', error);
            alert('Error saving variations: ' + error.message);
        }
    });
</script>