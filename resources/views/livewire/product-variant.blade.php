<div wire:key="product-variant-{{ $product_id }}">
    @if(!empty($existingVariations['raw']) && count($existingVariations['raw']) > 0)
        <div id="existingVariationsPanelDetailed" class="grid gap-4 mb-3 grid-cols-1">
            <div class="flex justify-between">
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

                <div>
                    <button 
                        type="button"
                        class="text-xs inline-block text-gray-600 dark:text-gray-300 hover:text-gray-700 dark:hover:text-gray-500" 
                        id="variantsPositionToggleButton" 
                    >
                        <div class="flex items-center">
                            <div class="w-3 h-3 mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M320-440v-287L217-624l-57-56 200-200 200 200-57 56-103-103v287h-80ZM600-80 400-280l57-56 103 103v-287h80v287l103-103 57 56L600-80Z"/></svg>
                            </div>
                            Change position
                        </div>
                    </button>
                </div>
            </div>

            <div wire:key="existing-variations-{{ $product_id }}">
                {{-- heading --}}
                <div class="space-y-4">
                    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg">
                        <div class="divide-y divide-gray-200 dark:divide-gray-700" id="variant-sort-container">
                            @foreach($existingVariations['raw'] as $variationIndex => $variation)
                                <div class="p-3 hover:bg-gray-50 {{ ($variationIndex % 2 == 0) ? 'dark:bg-gray-700/50' : 'dark:bg-gray-700/20' }} dark:hover:bg-gray-900/50 transition-colors" 
                                    wire:key="variation-{{ $variation['id'] }}" 
                                    data-id="{{$variation['id']}}">

                                    <div class="flex overflow-hidden gap-4">
                                        <div class="w-10 transition-all duration-300 ease-in-out hidden position-selector">
                                            <div class="handle cursor-grab h-full flex items-center justify-center">
                                                <svg class="w-8 h-8 text-primary-500 dark:text-primary-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M360-160q-33 0-56.5-23.5T280-240q0-33 23.5-56.5T360-320q33 0 56.5 23.5T440-240q0 33-23.5 56.5T360-160Zm240 0q-33 0-56.5-23.5T520-240q0-33 23.5-56.5T600-320q33 0 56.5 23.5T680-240q0 33-23.5 56.5T600-160ZM360-400q-33 0-56.5-23.5T280-480q0-33 23.5-56.5T360-560q33 0 56.5 23.5T440-480q0 33-23.5 56.5T360-400Zm240 0q-33 0-56.5-23.5T520-480q0-33 23.5-56.5T600-560q33 0 56.5 23.5T680-480q0 33-23.5 56.5T600-400ZM360-640q-33 0-56.5-23.5T280-720q0-33 23.5-56.5T360-800q33 0 56.5 23.5T440-720q0 33-23.5 56.5T360-640Zm240 0q-33 0-56.5-23.5T520-720q0-33 23.5-56.5T600-800q33 0 56.5 23.5T680-720q0 33-23.5 56.5T600-640Z"/></svg>
                                            </div>
                                        </div>

                                        <div class="flex-1 transition-all duration-300 ease-in-out">
                                            <div class="flex justify-between items-center text-xs text-gray-500 dark:text-gray-400">
                                                <div class="flex gap-4">
                                                    <div class="h-6">
                                                        @if (!empty($variation['images']) && count($variation['images']) > 0)
                                                            <div class="flex items-center justify-center h-full">
                                                                <img src="{{ Storage::url($variation['images'][0]->image_m) }}" alt="" class="max-w-full max-h-full">
                                                            </div>
                                                        @else
                                                            <div class="flex items-center justify-center h-8 w-8">
                                                                {!!FD['brokenImage']!!}
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <div class="flex flex-wrap gap-1 mb-2">
                                                        @foreach($variation['combinations'] as $combo)
                                                            <span class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-700">
                                                                {{ $combo['attribute_title'] }}: {{ $combo['value_title'] }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                </div>

                                                <div class="flex space-x-2 items-center justify-end">
                                                    <div wire:key="toggle-wrapper-{{ $variation['id'] }}">
                                                        {{-- @livewire('toggle-status', [
                                                            'model' => 'ProductVariation',
                                                            'modelId' => $variation['id'],
                                                        ], key('toggle-'.$variation['id'])) --}}

                                                        {{-- <x-admin.input-select 
                                                            id="status" 
                                                            class="w-full"
                                                            name="status" 
                                                            wire:model="selectedStatusId"
                                                            wire:change="updateStatus"
                                                        >
                                                            @slot('options')
                                                                @foreach ($allStatus as $status)
                                                                    <x-admin.input-select-option 
                                                                        value="{{$status->id}}" 
                                                                        :selected="$variation['status'] == $status->id"
                                                                    >
                                                                        {{ $status->title }}
                                                                    </x-admin.input-select-option>
                                                                @endforeach
                                                            @endslot
                                                        </x-admin.input-select> --}}

                                                        {{-- <x-admin.input-select 
                                                            id="status-{{ $variation['id'] }}" 
                                                            class="w-full"
                                                            name="status" 
                                                            wire:model="selectedStatusId"
                                                            wire:change="updateVariationStatus"
                                                            x-data=""
                                                            x-on:change="$wire.set('selectedVariationId', {{ $variation['id'] }})"
                                                        >
                                                            @slot('options')
                                                                @foreach ($allStatus as $status)
                                                                    <x-admin.input-select-option 
                                                                        value="{{$status->id}}" 
                                                                        :selected="$variation['status'] == $status->id"
                                                                    >
                                                                        {{ $status->title }}
                                                                    </x-admin.input-select-option>
                                                                @endforeach
                                                            @endslot
                                                        </x-admin.input-select> --}}

                                                        <x-admin.input-select 
                                                            id="status-{{ $variation['id'] }}"
                                                            class="w-full"
                                                            name="status"
                                                            wire:change="updateVariationStatus({{ $variation['id'] }}, $event.target.value)"
                                                            wire:key="variation-{{ $variation['id'] }}"
                                                        >
                                                            @slot('options')
                                                                @foreach ($allStatus as $status)
                                                                    <x-admin.input-select-option 
                                                                        value="{{ $status->id }}"
                                                                        :selected="$variation['status'] == $status->id"
                                                                    >
                                                                        {{ $status->title }}
                                                                    </x-admin.input-select-option>
                                                                @endforeach
                                                            @endslot
                                                        </x-admin.input-select>

                                                    </div>

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

                                                <div>
                                                    @if (count($variation['pricings']) > 0)
                                                        <div class="grid grid-cols-6">
                                                            <div class="col-span-1">
                                                                <p class="text-[10px] text-gray-500 dark:text-gray-400">Price</p>
                                                            </div>
                                                            <div class="col-span-5">
                                                                @foreach ($variation['pricings'] as $pricing)
                                                                    @php
                                                                        $currencySymbol = $pricing->country->currency_symbol;
                                                                    @endphp
                                                                    <p class="text-[10px] text-green-700 dark:text-green-200 font-bold">
                                                                        <span class="currency-icon">{{ $currencySymbol }}</span>
                                                                        {{ formatIndianMoney($pricing['selling_price']) }}
                                                                        ({{ $pricing['discount'] }}%)
                                                                    </p>
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                        <div class="grid grid-cols-6">
                                                            <div class="col-span-1">
                                                                <p class="text-[10px] text-gray-500 dark:text-gray-400">MRP</p>
                                                            </div>
                                                            <div class="col-span-5">
                                                                @foreach ($variation['pricings'] as $pricing)
                                                                    @php
                                                                        $currencySymbol = $pricing->country->currency_symbol;
                                                                    @endphp

                                                                    @if ($pricing['mrp'] > $pricing['selling_price'])
                                                                        <p class="text-[10px] text-green-700 dark:text-green-200 font-bold">
                                                                            <span class="currency-icon">{{ $currencySymbol }}</span>
                                                                            {{ formatIndianMoney($pricing['mrp']) }}
                                                                        </p>
                                                                    @else
                                                                        <p class="text-[10px] text-red-700 dark:text-red-400 font-bold flex items-center">
                                                                            <span class="currency-icon">{{ $currencySymbol }}</span>
                                                                            {{ formatIndianMoney($pricing['mrp']) }}

                                                                            <span class="inline-flex pl-1 w-4 h-4 text-red-700 dark:text-red-400" title="MRP is lower than Selling Price. EDIT Now !">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-280h80v-240h-80v240Zm40-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg>
                                                                            </span>
                                                                        </p>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                    {{-- @if ((float) $variation['pricings'] !== 0.0)
                                                    <p class="text-[10px] text-gray-500 dark:text-gray-400">
                                                        Price Adjustment
                                                        <span class="text-[10px] text-green-700 dark:text-green-200 font-bold">
                                                            + {{ formatIndianMoney($variation['price_adjustment']) }}
                                                        </span>
                                                    </p>
                                                    @endif --}}
                                                </div>
                                            </div>
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
    <x-admin.modal name="add-variant" maxWidth="7xl" focusable>
        <div class="p-4">
            @if (count($variations) > 0)
                <div class="grid space-x-6 grid-cols-3">
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

                            <div class="col-span-3 flex flex-row space-x-1 justify-end items-end">
                                <div class="w-max">
                                    <x-admin.input-label for="sortBy" :value="__('Sort by')" />
                                    <x-admin.input-select 
                                        id="sortBy" 
                                        name="sortBy" 
                                        wire:model.live.debounce.300ms="sortBy"
                                        :title="$sortBy"  
                                    >
                                        @slot('options')
                                            <x-admin.input-select-option 
                                                value="id" 
                                                :selected="request()->input('sortBy') == 'id'"
                                            >
                                                {{ __('ID') }}
                                            </x-admin.input-select-option>

                                            <x-admin.input-select-option 
                                                value="title" 
                                                :selected="request()->input('sortBy') == 'title'"
                                            >
                                                {{ __('Title') }}
                                            </x-admin.input-select-option>

                                            <x-admin.input-select-option 
                                                value="position" 
                                                :selected="request()->input('sortBy') == 'position'"
                                            >
                                                {{ __('Position') }}
                                            </x-admin.input-select-option>
                                        @endslot
                                    </x-admin.input-select>
                                </div>
        
                                <div class="w-max">
                                    <x-admin.input-label for="sortOrder" :value="__('Order by')" />
                                    <x-admin.input-select 
                                        id="sortOrder" 
                                        name="sortOrder" 
                                        wire:model.live.debounce.300ms="sortOrder"
                                        :title="$sortOrder" 
                                    >
                                        @slot('options')
                                            <x-admin.input-select-option 
                                                value="asc" 
                                                :selected="request()->input('sortOrder') == 'asc'"
                                            >
                                                {{ __('ASC') }}
                                            </x-admin.input-select-option>

                                            <x-admin.input-select-option 
                                                value="desc"
                                                :selected="request()->input('sortOrder') == 'desc'"
                                            >
                                                {{ __('DESC') }}
                                            </x-admin.input-select-option>
                                        @endslot
                                    </x-admin.input-select>
                                </div>
                            </div>
                        </div>

                        {{-- attribute values --}}
                        @foreach ($variations as $variationAttr)
                            <div class="mb-6">
                                {{-- attribute --}}
                                <div class="flex justify-between">
                                    <div>
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
                                    </div>

                                    @if (strtolower($variationAttr->title) == "color")
                                        <div>
                                            <x-admin.input-checkbox 
                                                id="toggle-colors-checkbox" 
                                                name="track_quantity" 
                                                value="yes" 
                                                class="mb-3" 
                                                label="Show colors" 
                                            />
                                        </div>
                                    @endif
                                </div>

                                {{-- values --}}
                                <div class="flex flex-wrap gap-2">
                                    @forelse ($variationAttr->valuesUnsorted as $attrValue)
                                        <div class="border dark:border-gray-700 text-center overflow-hidden min-w-[40px] bg-white dark:bg-gray-700">
                                            {{-- OPTIONAL - Show colors with Attr Values --}}
                                            @if (strtolower($variationAttr->title) == "color")
                                                @php
                                                    $meta = json_decode($attrValue->meta, true);
                                                    $hexColor = $meta['hex'] ?? '#ffffff';
                                                @endphp
                                                <div class="w-full h-4 show-colors hidden" style="background-color: {{ $hexColor }}"></div>
                                            @endif

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
    </x-admin.modal>


    {{-- delete confirm modal --}}
    <x-admin.modal name="confirm-variation-deletion" maxWidth="sm" focusable>
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
    </x-admin.modal>

</div>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.6/Sortable.min.js"></script> --}}

<script>
    // Store the original attribute order from the server
    const originalAttributeOrder = @json($variations->pluck('id'));
    const activeCountries = @json($activeCountries);
    const applicationCountry = '{{ applicationSettings("country_code") }}';
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
                        <p class="text-2xl font-bold text-gray-500 dark:text-gray-400">${variation.valueTitle}</p>
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

        let countryOptions = '';
        activeCountries.forEach(cn => {
            countryOptions += `
            <option value="${cn.code}" ${ (applicationCountry == cn.code) ? 'selected' : '' }>${cn.currency_symbol} (${cn.currency_code})</option>
            `;
        });

        let addCurrency = '';
        // Show Add 'Another Currency button'
        if (activeCountries.length > 1) {
            addCurrency = `
            <div class="my-3">
                <a href="javascript:void(0);" id="addVariationCurrencyBtn" class="text-xs inline-block text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-500">
                    <div class="flex items-center underline hover:no-underline text-primary-600 dark:text-primary-300">
                        <div class="w-3 h-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                        </div>
                        Add different currency
                    </div>
                </a>
                <p id="variationCurrencyLimitMsg" class="text-xs text-red-500 mt-1 hidden"></p>
            </div>
            `;
        }

        // Add input fields after the variations
        const inputsContainer = document.createElement('div');
        inputsContainer.className = 'flex flex-col';
        inputsContainer.innerHTML = `
            <div id="variationCurrencyPricingWrapper" class="p-2 bg-gray-200/20 hover:bg-gray-100 dark:hover:bg-gray-700/50">
                <div class="">
                    <p class="text-xs font-medium text-gray-800 dark:text-gray-200 mb-2">New Selling Price</p>

                    <div class="flex items-center gap-2 variation-currency-block">
                        <select name="var_country_code[]" class="text-xs bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-2 py-1 w-20">
                            ${countryOptions}
                        </select>
                        <input type="tel" name="var_price_adjustment[]" class="text-xs bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-2 py-1 w-32 format-input-decimal" placeholder="0.00">
                    </div>
                </div>
                ${addCurrency}
                <div>
                    <ul>
                        <li class="leading-none"><p class="text-[10px] text-gray-600 dark:text-amber-400">Keep this field empty if NO Price Update</p></li>
                    </ul>
                </div>
            </div>
            <div class="flex items-center justify-between p-2 bg-gray-200/20 hover:bg-gray-100 dark:hover:bg-gray-700/50">
                <p class="text-xs font-medium text-gray-800 dark:text-gray-200">SKU</p>
                <input type="text" name="var_sku_variant" class="text-xs bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-2 py-1 w-32" placeholder="SKU">
            </div>
            <div class="flex items-center justify-between p-2 bg-gray-200/20 hover:bg-gray-100 dark:hover:bg-gray-700/50">
                <p class="text-xs font-medium text-gray-800 dark:text-gray-200">Stock</p>
                <input type="number" name="var_stock_quantity_variant" class="text-xs bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-2 py-1 w-20" placeholder="0">
            </div>
            <div class="flex items-center justify-between p-2 bg-gray-200/20 hover:bg-gray-100 dark:hover:bg-gray-700/50">
                <p for="allow_backorders" class="text-xs font-medium text-gray-800 dark:text-gray-200">Continue selling when out of stock</p>
                <input type="checkbox" name="var_allow_backorders" id="allow_backorders" x-on:change="document.querySelector('input[name=allowBackordersFailsafe]').value = $event.target.checked" class="rounded border-gray-300 dark:border-gray-600 text-primary-600 shadow-sm focus:border-primary-500 focus:ring focus:ring-primary-500 focus:ring-opacity-50 dark:bg-gray-700 dark:checked:bg-primary-500">
                <input type="hidden" name="var_allowBackordersFailsafe" value="false">
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
            const currencyAdjustments = [];
            const blocks2 = document.querySelectorAll('.variation-currency-block');
            const count2 = blocks2.length;
            console.log(count2);
            
            document.querySelectorAll('.variation-currency-block').forEach(block => {
                const countrySelect = block.querySelector('select[name="var_country_code[]"]');
                const priceInput = block.querySelector('input[name="var_price_adjustment[]"]');

                if (countrySelect && priceInput) {
                    currencyAdjustments.push({
                        country_code: countrySelect.value,
                        price_adjustment: parseFloat(priceInput.value) || 0
                    });
                }
            });

            const sku = document.querySelector('input[name=var_sku_variant]').value;
            const stockQuantity = document.querySelector('input[name=var_stock_quantity_variant]').value;
            const allowBackorders = document.querySelector('input[name=var_allowBackordersFailsafe]').value == "true" ? 1 : 0;

            const response = await fetch('/api/variation/store', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    product_id: {{ $product_id }},
                    sku: sku,
                    stock_quantity: stockQuantity,
                    allow_backorders: allowBackorders,
                    currency_adjustments: currencyAdjustments,
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

    document.getElementById('toggle-colors-checkbox').addEventListener('click', function() {
        if (this.checked) {
            document.querySelectorAll('.show-colors').forEach(element => {
                element.classList.remove('hidden');
            });
        } else {
            document.querySelectorAll('.show-colors').forEach(element => {
                element.classList.add('hidden');
            });
        }
    });

    @if(!empty($existingVariations['raw']) && count($existingVariations['raw']) > 0)
    // variants drag & drop to set position
    window.addEventListener('load', () => {
        (function () {
            const sortable = document.querySelector("#variant-sort-container");

            new Sortable(sortable, {
                handle: '.handle',
                animation: 150,
                dragClass: 'rounded-none!',
                onEnd: function (evt) {
                    const orderedIds = Array.from(sortable.children).map(el => el.dataset.id);
                    // console.log(orderedIds);
                    Livewire.dispatch('updateProductVariantsOrder', { ids: orderedIds });
                }
            });
        })();
    });
    @endif

    // Use event delegation for the dynamically created "Add different currency" button
    document.addEventListener('click', function(e) {
        // Check if the clicked element or its parent is the add currency button
        const addCurrencyBtn = e.target.closest('#addVariationCurrencyBtn');
        if (addCurrencyBtn) {
            e.preventDefault();
            addCurrencyBlock();
        }
        
        // Check if the clicked element is a remove currency button
        if (e.target.classList.contains('remove-currency-block')) {
            e.target.closest('.variation-currency-block').remove();
            document.getElementById('variationCurrencyLimitMsg').classList.add('hidden');
        }
    });

    function addCurrencyBlock() {
        const wrapper = document.getElementById('variationCurrencyPricingWrapper');
        const existingBlocks = wrapper.querySelectorAll('.variation-currency-block');

        // Check if we've reached the maximum allowed blocks
        if (existingBlocks.length >= activeCountries.length) {
            document.getElementById('variationCurrencyLimitMsg').textContent =
                'You can only add currency adjustments for ' + activeCountries.length + ' countries';
            document.getElementById('variationCurrencyLimitMsg').classList.remove('hidden');
            return;
        }

        // Get already selected country codes
        const selectedCountryCodes = Array.from(existingBlocks).map(block => {
            return block.querySelector('select[name="var_country_code[]"]').value;
        });

        // Find available countries that haven't been selected yet
        const availableCountries = activeCountries.filter(
            country => !selectedCountryCodes.includes(country.code)
        );

        if (availableCountries.length === 0) {
            document.getElementById('variationCurrencyLimitMsg').textContent =
                'All available currencies have been added';
            document.getElementById('variationCurrencyLimitMsg').classList.remove('hidden');
            return;
        }

        // Create options for the select dropdown
        let countryOptions = '';
        availableCountries.forEach(country => {
            countryOptions += `<option value="${country.code}">${country.currency_symbol} (${country.currency_code})</option>`;
        });

        // Create new currency block (added delete button here)
        const newBlock = document.createElement('div');
        newBlock.className = 'flex items-center gap-2 variation-currency-block mt-2';
        newBlock.innerHTML = `
            <select name="var_country_code[]" class="text-xs bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-2 py-1 w-20">
                ${countryOptions}
            </select>
            <input type="tel" name="var_price_adjustment[]" class="text-xs bg-gray-100 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded px-2 py-1 w-32 format-input-decimal" placeholder="0.00">
            <button type="button" class="remove-currency-block text-red-500 hover:text-red-700 ml-2" title="Remove">
                ✕
            </button>
        `;

        // Insert the new block before the "Add different currency" button
        const addCurrencyBtnContainer = document.getElementById('addVariationCurrencyBtn')?.parentElement;
        wrapper.insertBefore(newBlock, addCurrencyBtnContainer);

        // Hide any previous error message
        document.getElementById('variationCurrencyLimitMsg').classList.add('hidden');
    }
</script>