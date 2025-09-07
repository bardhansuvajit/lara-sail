<x-admin-app-layout
    screen="md:w-full"
    title="{{ __('Create Product Listing') }}"
    :breadcrumb="[
        ['label' => 'Product listing', 'url' => route('admin.product.listing.index')],
        ['label' => 'Create']
    ]"
>

    <section class="grid grid-cols-6 lg:grid-cols-10 gap-4">
        {{-- <div class="col-span-2"></div> --}}

        <div class="col-span-6 lg:col-start-3">
            <div class="w-full mt-2">
                <form action="{{ route('admin.product.listing.store') }}" method="post" enctype="multipart/form-data" id="productForm" >
                    @csrf

                    <h4 class="mt-4 mb-3 font-bold text-sm text-black dark:text-primary-200">Basics</h4>

                    <div class="grid gap-4 mb-3 grid-cols-1">
                        <div>
                            <x-admin.input-label for="type" :value="__('Type *')" />
                            <ul class="flex flex-wrap gap-2">
                                @foreach ($productType->children as $indexOption => $option)
                                    <li>
                                        <x-admin.radio-input-button 
                                            id="level_{{$indexOption}}" 
                                            name="type" 
                                            value="{{ $option->key }}" 
                                            title="{{ $option->title }}" 
                                            class="w-auto px-2" 
                                            required 
                                            :checked="old('type') ? old('type') == $option->key : $indexOption == 0" />
                                    </li>
                                @endforeach
                            </ul>
                            <x-admin.input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 mb-3 grid-cols-1">
                        <div>
                            <x-admin.input-label for="title" :value="__('Title *')" />
                            <x-admin.text-input id="title" class="block" type="text" name="title" :value="old('title')" placeholder="Enter title" autofocus required />
                            <x-admin.input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 mb-3 grid-cols-1">
                        <div>
                            <x-admin.input-label for="description" :value="__('Description *')" />
                            <div id="editor" name="description"></div>
                            <input type="hidden" name="existingDescription" value="{{ old('description') }}">
                            <x-admin.input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 mb-3 grid-cols-1">
                        <div x-data="{ open: {{ old('short_description') ? 'true' : 'false' }} }">
                            <a href="javascript: void(0)" class="text-xs inline-block text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-500" @click="open = !open">
                                <div class="flex items-center">
                                    <div class="w-3 h-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                                    </div>
                                    Add Short description
                                </div>
                            </a>

                            <div x-show="open" class="mt-4">
                                <x-admin.input-label for="short_description" :value="__('Short Description')" />
                                <x-admin.textarea id="short_description" class="block" type="text" name="short_description" :value="old('short_description')" placeholder="Enter Short Description" maxlength="1000" />
                                <x-admin.input-error :messages="$errors->get('short_description')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-4 mb-3 grid-cols-1">
                        <a 
                            href="javascript: void(0)" 
                            class="text-xs inline-block text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-500" 
                            id="highlightButton" 
                            x-data="" 
                            x-on:click.prevent="
                                $dispatch('open-modal', 'highlight');
                            " 
                        >
                            <div class="flex items-center">
                                <div class="w-3 h-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                                </div>
                                Add Highlights
                            </div>
                        </a>
                    </div>

                    <div class="grid gap-2 mb-3 grid-cols-1">
                        <div class="image-uploader-container space-y-4">
                            <div>
                                <x-admin.input-label for="images" :value="__('Image *')" />
                                <x-admin.file-input-drag-drop id="images" class="h-12 images" name="images[]" accept="image/*" multiple />
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
                                                <x-admin.input-error :messages="$message" class="" />
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <div class="imagePreview"></div>
                        </div>
                    </div>

                    <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">

                        @livewire('product-page-category-generate', [
                            'category_id' => old('category_id', 0),
                            'category_name' => old('category_name', ''),
                        ])

                        @livewire('product-page-collection-generate', [
                            'collection_id' => old('collection_id', ''),
                            'collection_name' => old('collection_name', ''),
                        ])

                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700"></div>

                    <h4 class="mt-4 mb-3 font-bold text-sm text-black dark:text-primary-200">Pricing</h4>

                    {{-- <div id="currencyPricingWrapper2">
                        <div class="currency-block">
                            <h5 class="font-semibold mb-3 text-gray-700 dark:text-primary-300">Currency Block 1</h5>

                            <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                                <div>
                                    <x-admin.input-label for="selling_price" :value="__('Selling price *')" />
                                    <x-admin.text-input-with-dropdown 
                                        id="selling_price" 
                                        class="block w-auto" 
                                        type="tel" 
                                        name="selling_price" 
                                        :value="old('selling_price')" 
                                        placeholder="Enter Selling Price" 
                                        selectTitle="₹ (INR)" 
                                        selectId="currency" 
                                        selectName="country_code" 
                                    >
                                        @slot('options')
                                            @foreach ($activeCountries as $country)
                                                <x-admin.input-select-option 
                                                    value="{{$country->code}}" 
                                                    :selected="old('currency_code') ? old('currency_code') == $country->id : applicationSettings('country_code') == $country->code"
                                                >
                                                    {{ $country->currency_symbol }} ({{ $country->currency_code }})
                                                </x-admin.input-select-option>
                                            @endforeach
                                        @endslot
                                    </x-admin.text-input-with-dropdown>

                                    <x-admin.input-error :messages="$errors->get('selling_price')" class="mt-2" />
                                    <x-admin.input-error :messages="$errors->get('currency')" class="mt-2" />
                                </div>
                                <div>
                                    <x-admin.input-label for="mrp" :value="__('MRP')" />
                                    <x-admin.text-input id="mrp" class="block" type="tel" name="mrp" :value="old('mrp')" placeholder="Enter MRP" />
                                    <x-admin.input-error :messages="$errors->get('mrp')" class="mt-2" />
                                </div>
                                <div>
                                    <x-admin.input-label for="discount" :value="__('Discount')" />
                                    <x-admin.text-input id="discount" class="block" type="tel" name="discount" :value="old('discount') ?? 0" placeholder="Discount will be calculated automatically" />
                                    <x-admin.input-error :messages="$errors->get('discount')" class="mt-2" />
                                </div>
                            </div>

                            <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                                <div>
                                    <x-admin.input-label for="cost" :value="__('Cost per item')" />
                                    <x-admin.text-input id="cost" class="block" type="tel" name="cost" :value="old('cost')" placeholder="Enter Cost" />
                                    <x-admin.input-error :messages="$errors->get('cost')" class="mt-2" />
                                </div>
                                <div>
                                    <x-admin.input-label for="profit" :value="__('Profit')" />
                                    <x-admin.text-input id="profit" class="block" type="tel" name="profit" :value="old('profit') ?? 0" placeholder="Profit will be calculated automatically" />
                                    <x-admin.input-error :messages="$errors->get('profit')" class="mt-2" />
                                </div>
                                <div>
                                    <x-admin.input-label for="margin" :value="__('Margin')" />
                                    <x-admin.text-input id="margin" class="block" type="tel" name="margin" :value="old('margin') ?? 0" placeholder="Margin will be calculated automatically" />
                                    <x-admin.input-error :messages="$errors->get('margin')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div> --}}

                    <div id="currencyPricingWrapper">
                        <div class="currency-block" data-block-id="0">
                            <div class="flex justify-between items-start mb-2">
                                <h5 class="font-semibold text-gray-700 dark:text-primary-300 block-heading">Currency Block</h5>
                                <button type="button" class="remove-currency-btn text-xs text-red-600 hover:underline hidden">Remove</button>
                            </div>

                            <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                                <div>
                                    <x-admin.input-label for="selling_price_0" :value="__('Selling price *')" />
                                    <x-admin.text-input-with-dropdown 
                                        id="selling_price_0" 
                                        class="block w-auto" 
                                        type="tel" 
                                        name="selling_price[]" 
                                        :value="old('selling_price.0')" 
                                        placeholder="Enter Selling Price" 
                                        selectId="currency_0" 
                                        selectName="country_code[]" 
                                        maxlength="13"
                                    >
                                        @slot('options')
                                            @foreach ($activeCountries as $country)
                                                <x-admin.input-select-option 
                                                    value="{{ $country->code }}" 
                                                    :selected="old('currency_code.0') == $country->code || applicationSettings('country_code') == $country->code"
                                                >
                                                    {{ $country->currency_symbol }} ({{ $country->currency_code }})
                                                </x-admin.input-select-option>
                                            @endforeach
                                        @endslot
                                    </x-admin.text-input-with-dropdown>
                                    <x-admin.input-error :messages="$errors->get('selling_price.0')" class="mt-2" />
                                </div>

                                <div>
                                    <x-admin.input-label for="mrp_0" :value="__('MRP')" />
                                    <x-admin.text-input id="mrp_0" class="block" type="tel" name="mrp[]" :value="old('mrp.0')" placeholder="Enter MRP" maxlength="13" />
                                </div>

                                <div>
                                    <x-admin.input-label for="discount_0" :value="__('Discount')" />
                                    <x-admin.text-input id="discount_0" class="block" type="tel" name="discount[]" :value="old('discount.0') ?? 0" placeholder="Discount will be calculated automatically" readonly tabindex="-1" />
                                </div>
                            </div>

                            <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                                <div>
                                    <x-admin.input-label for="cost_0" :value="__('Cost per item')" />
                                    <x-admin.text-input id="cost_0" class="block" type="tel" name="cost[]" :value="old('cost.0')" placeholder="Enter Cost" maxlength="13" />
                                </div>

                                <div>
                                    <x-admin.input-label for="profit_0" :value="__('Profit')" />
                                    <x-admin.text-input id="profit_0" class="block" type="tel" name="profit[]" :value="old('profit.0') ?? 0" placeholder="Profit will be calculated automatically" readonly tabindex="-1" />
                                </div>

                                <div>
                                    <x-admin.input-label for="margin_0" :value="__('Margin')" />
                                    <x-admin.text-input id="margin_0" class="block" type="tel" name="margin[]" :value="old('margin.0') ?? 0" placeholder="Margin will be calculated automatically" readonly tabindex="-1" />
                                </div>
                            </div>
                        </div>
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

                    <div class="border-t border-gray-200 dark:border-gray-700"></div>

                    <h4 class="mt-4 mb-3 font-bold text-sm text-black dark:text-primary-200">Inventory</h4>

                    <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                        <div>
                            <x-admin.input-label for="sku" :value="__('SKU')" />
                            <x-admin.text-input id="sku" class="block" type="text" name="sku" :value="old('sku')" placeholder="Enter SKU" maxlength="50" />
                            <x-admin.input-error :messages="$errors->get('sku')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 items-center">
                        <div>
                            <x-admin.input-checkbox 
                                id="quantity-track-checkbox" 
                                name="track_quantity" 
                                value="yes" 
                                class="mb-3" 
                                label="Track quantity" 
                                :checked="old('track_quantity') === 'yes'" />

                            <div id="qtyValueField" class="mb-4 {{ old('track_quantity') !== 'yes' ? 'hidden' : '' }}">
                                <x-admin.input-label for="stock_quantity" :value="__('Quantity')" />
                                <x-admin.text-input id="stock_quantity" class="block" type="tel" name="stock_quantity" :value="old('stock_quantity')" placeholder="Enter Quantity" />
                                <x-admin.input-error :messages="$errors->get('stock_quantity')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                        <div>
                            <x-admin.input-checkbox 
                                id="allow-backorders-checkbox"
                                name="allow_backorders" 
                                value="yes"
                                label="Continue selling when out of stock" />
                        </div>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700"></div>

                    {{-- <h4 class="mt-4 mb-3 font-bold text-sm text-black dark:text-primary-200">Variants</h4>

                    <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                        <div>
                            <a href="" class="text-xs inline-block text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-500">
                                <div class="flex items-center">
                                    <div class="w-3 h-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                                    </div>
                                    Add options like Colors and Size
                                </div>
                            </a>
                        </div>
                    </div> --}}

                    <div class="border-t border-gray-200 dark:border-gray-700"></div>

                    <h4 class="mt-4 mb-3 font-bold text-sm text-black dark:text-primary-200">Search Engine Content</h4>

                    <div class="grid gap-4 mb-3 grid-cols-1 items-center">
                        <div>
                            <x-admin.input-label for="meta_title" :value="__('Meta Title')" />
                            <x-admin.text-input id="meta_title" class="block" type="text" name="meta_title" :value="old('meta_title')" placeholder="Enter Meta Title" />
                            <x-admin.input-error :messages="$errors->get('meta_title')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 mb-3 grid-cols-1 items-center">
                        <div>
                            <x-admin.input-label for="meta_description" :value="__('Meta Description')" />
                            <x-admin.textarea id="meta_description" class="block" type="text" name="meta_description" :value="old('meta_description')" placeholder="Enter Meta Description" />
                            <x-admin.input-error :messages="$errors->get('meta_description')" class="mt-2" />
                        </div>
                    </div>

                    <div class="items-center space-x-4 flex mt-4 mb-5 p-4 sticky bottom-5 rounded shadow border bg-white dark:border-gray-700 dark:bg-gray-800">
                        <x-admin.button
                            type="submit"
                            element="button">
                            @slot('icon')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M840-680v480q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160Zm-80 34L646-760H200v560h560v-446ZM480-240q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35ZM240-560h360v-160H240v160Zm-40-86v446-560 114Z"/></svg>
                            @endslot
                            {{ __('Save data') }}
                        </x-admin.button>
                    </div>
                </form>
            </div>
        </div>

        {{-- <div class="col-span-2"></div> --}}
    </section>

    {{-- HIGHTLIGHT MODAL --}}
    <x-admin.modal 
        name="highlight" 
        maxWidth="2xl" 
        {{-- show=true  --}}
    >
        <div class="p-4">
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Product Highlights') }}
            </h2>

            <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                {!! __('You can add <strong><em>Multiple</em></strong> highlights') !!}
            </p>

            <div id="highlight-container">
                <div class="grid gap-4 mt-4 grid-cols-1">
                    <div>
                        <x-admin.input-label for="icon" :value="__('Icon')" />
                        <ul class="flex space-x-2">
                            @forelse (developerSettings('product_highlight_icons')->icons as $keyIcon => $keyValue)
                                <li>
                                    <x-admin.radio-input-button 
                                        id="icon_{{$keyIcon}}" 
                                        value="{{ $keyValue }}" 
                                        title="{!! $keyValue !!}"
                                        name="icon" 
                                        :checked="$loop->first" />
                                </li>
                            @empty
                                
                            @endforelse
                        </ul>
                        <x-admin.input-error :messages="$errors->get('icon')" class="mt-2" />
                    </div>
                </div>

                <div class="grid gap-4 mt-3 grid-cols-1">
                    <div>
                        <x-admin.input-label for="highlight-title" :value="__('Title')" />
                        <x-admin.text-input id="highlight-title" class="block" type="text" name="highlight_title" :value="old('highlight_title')" placeholder="Enter title" autofocus required />
                        <x-admin.input-error :messages="$errors->get('highlight_title')" class="mt-2" />
                    </div>
                </div>

                <div class="grid gap-4 mt-3 grid-cols-1">
                    <div>
                        <x-admin.input-label for="highlight-description" :value="__('Description')" />
                        <x-admin.textarea id="highlight-description" class="block" type="text" name="highlight_description" :value="old('highlight_description')" placeholder="Enter Description" maxlength="1000" />
                        <x-admin.input-error :messages="$errors->get('highlight_description')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div id="moreHighlightsContainer"></div>

            <div class="grid gap-4 mt-4 grid-cols-1">
                <a 
                    href="javascript: void(0)" 
                    class="text-xs inline-block text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-500" 
                    id="addMoreHighlights" 
                >
                    <div class="flex items-center">
                        <div class="w-3 h-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                        </div>
                        Add More
                    </div>
                </a>
            </div>

            <div class="mt-4 flex space-x-2 justify-between">
                {{-- <x-admin.button
                    element="button"
                    tag="primary"
                    type="submit"
                    title="Import">
                    @slot('icon')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-320v-326L336-542l-56-58 200-200 200 200-56 58-104-104v326h-80ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/></svg>
                    @endslot
                    {{ __('Import') }}
                </x-admin.button> --}}

                <x-admin.button
                    element="a"
                    tag="secondary"
                    href="javascript: void(0)"
                    title="Cancel"
                    class="border"
                    x-on:click="$dispatch('close')"
                >
                    {{ __('Cancel') }}
                </x-admin.button>
            </div>
        </div>
    </x-admin.modal>
</x-admin-app-layout>

@vite([
    'resources/js/rte-script.js'
])

{{-- @push('scripts') --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const maxCurrencies = {{ count($activeCountries) }};
    const wrapper = document.getElementById("currencyPricingWrapper");
    const addBtn = document.getElementById("addCurrencyBtn");
    const limitMsg = document.getElementById("currencyLimitMsg");

    let nextId = 1; // for unique ids on clones

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

    /**
     * Better sanitizer:
     * - converts comma => dot (handles locale decimal)
     * - allows only digits + one dot
     * - ensures at most 10 digits before dot and 2 after
     * - converts leading '.' to '0.'
     */
    function sanitizeNumericInput(value) {
        if (!value) return "";

        // convert comma to dot (some keyboards use comma)
        value = value.replace(/,/g, '.');

        // remove any char except digits and dot
        value = value.replace(/[^\d.]/g, '');

        // keep only first dot
        const firstDotIndex = value.indexOf('.');
        if (firstDotIndex !== -1) {
            let before = value.slice(0, firstDotIndex);
            let after = value.slice(firstDotIndex + 1).replace(/\./g, '');
            // if user typed leading dot, make before = '0'
            if (before === '') before = '0';
            // limit digits before dot to 10 and after dot to 2
            before = before.slice(0, 10);
            after = after.slice(0, 2);
            return after.length ? (before + '.' + after) : before;
        } else {
            // no dot: limit to 10 digits
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
                el.value = sanitizeNumericInput(el.value);
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
            el.addEventListener('input', function () {
                if (el._isComposing) return; // don't sanitize mid-composition
                // convert any comma to dot, then sanitize
                el.value = sanitizeNumericInput(el.value);
                // trigger calcs
                calculateDiscount();
                calculateProfitMargin();
            });
            el.addEventListener('blur', function () {
                // ensure final sanitize on blur
                el.value = sanitizeNumericInput(el.value);
                calculateDiscount();
                calculateProfitMargin();
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

        if (removeBtn) {
            removeBtn.addEventListener('click', function () {
                const count = wrapper.querySelectorAll('.currency-block').length;
                if (count <= 1) return;
                block.remove();
                limitMsg.classList.add('hidden');
            });
        }
    }

    const firstBlock = wrapper.querySelector('.currency-block');
    if (firstBlock) initializeBlock(firstBlock);

    addBtn.addEventListener('click', function () {
        const currentCount = wrapper.querySelectorAll('.currency-block').length;
        if (currentCount >= maxCurrencies) {
            limitMsg.innerText = "⚠️ You can only add up to " + maxCurrencies + " currencies.";
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

        newBlock.querySelectorAll("input").forEach(i => i.value = "");
        newBlock.querySelectorAll("select").forEach(s => s.selectedIndex = 0);

        newBlock.querySelectorAll("input[name='discount[]'], input[name='profit[]'], input[name='margin[]']").forEach(i => {
            i.setAttribute('readonly','readonly');
            i.setAttribute('tabindex','-1');
        });

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
        initializeBlock(newBlock);
        nextId++;
        limitMsg.classList.add('hidden');
    });

});
</script>
{{-- @endpush --}}
