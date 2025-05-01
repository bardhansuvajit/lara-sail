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
                        <div>
                            <x-admin.input-label for="images" :value="__('Image *')" />
                            <x-admin.file-input-drag-drop id="images" class="h-12" name="images[]" accept="image/*" multiple />
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

                        <div id="imagePreview"></div>
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
                                selectName="currency" 
                            >
                                @slot('options')
                                    @foreach ($activeCountries as $country)
                                        <x-admin.input-select-option 
                                            value="{{$country->id}}" 
                                            :selected="old('currency_code') ? old('currency_code') == $country->id : applicationSettings('country_id') == $country->id"
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

                    @if (count($activeCountries) > 0)
                        <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                            <div>
                                <a href="" class="text-xs inline-block text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-500">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                                        </div>
                                        Add different currency
                                    </div>
                                </a>
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

                    <h4 class="mt-4 mb-3 font-bold text-sm text-black dark:text-primary-200">Variants</h4>

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
                    </div>

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
    <x-modal 
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
    </x-modal>
</x-admin-app-layout>

@vite([
    'resources/js/rte-script.js'
])
