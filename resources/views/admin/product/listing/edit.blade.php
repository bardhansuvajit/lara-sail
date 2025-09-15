<x-admin-app-layout
    screen="md:w-full"
    title="{{ __('Edit Product Listing') }}"
    :breadcrumb="[
        ['label' => 'Product listing', 'url' => route('admin.product.listing.index')],
        ['label' => 'Edit']
    ]"
>

    <section class="grid grid-cols-6 lg:grid-cols-10 gap-4">
        {{-- <div class="col-span-2"></div> --}}

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                @if (is_array($error))
                    @foreach ($error as $error)
                        <p class="text-red-600">{{ $error }}</p>
                    @endforeach
                @else   
                    <p class="text-red-600">{{ $error }}</p>
                @endif
            @endforeach
        @endif

        <div class="col-span-6 lg:col-start-3">
            <div class="w-full mt-2">
                <form action="{{ route('admin.product.listing.update') }}" method="post" enctype="multipart/form-data" id="productForm" >
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
                                            :checked="old('type') ? old('type') == $option->key : $data->type == $option->key" />
                                    </li>
                                @endforeach
                            </ul>
                            <x-admin.input-error :messages="$errors->get('type')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 mb-3 grid-cols-1">
                        <div>
                            <x-admin.input-label for="title" :value="__('Title *')" />
                            <x-admin.text-input id="title" class="block" type="text" name="title" :value="old('title') ? old('title') : $data->title" placeholder="Enter title" autofocus required />
                            <x-admin.input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 mb-3 grid-cols-1">
                        <div>
                            <x-admin.input-label for="description" :value="__('Description *')" />
                            <div id="editor" name="description"></div>
                            <input type="hidden" name="existingDescription" value="{{ old('description') ? old('description') : $data->long_description }}">
                            <x-admin.input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 mb-3 grid-cols-1">
                        <div x-data="{ open: {{ (old('short_description') || !empty($data->short_description)) ? 'true' : 'false' }} }">
                            <a href="javascript: void(0)" class="text-xs inline-block text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-500 {{ !empty($data->short_description) ? 'hidden' : '' }}" @click="open = !open">
                                <div class="flex items-center">
                                    <div class="w-3 h-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                                    </div>
                                    Add Short description
                                </div>
                            </a>

                            <div x-show="open" class="{{ !empty($data->short_description) ? '' : 'mt-4' }}">
                                <x-admin.input-label for="short_description" :value="__('Short Description')" />
                                <x-admin.textarea id="short_description" class="block" type="text" name="short_description" :value="old('short_description') ? old('short_description') : $data->short_description" placeholder="Enter Short Description" maxlength="1000" />
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

                            <div class="existing-images">
                                @if ($data->images && count($data->images) > 0)
                                    @livewire('existing-product-images', [
                                        'images' => $data->images,
                                        'type' => $data->type,
                                    ])
                                @else
                                    {{-- if image error message are there, hide this alert --}}
                                    @if (!$errors->get('images.*'))
                                        <p class="text-base font-medium text-red-600 dark:text-orange-600 space-y-1">No Images found !</p>
                                        <p class="text-xs text-red-400 dark:text-orange-700 space-y-1">A {{ $data->type }} must have some images to give an idea to the customers what they are paying for.</p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-4 mb-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">

                        @livewire('product-page-category-generate', [
                            'category_id' => old('category_id', $data->category_id),
                            'category_name' => old('category_name', $data->category->title ?? ''),
                        ])

                        @livewire('product-page-collection-generate', [
                            'collection_id' => old('collection_id', implode(',', json_decode($data->collection_ids))),
                            'collection_name' => old('collection_name', collectionTitles($data->collection_ids)),
                        ])

                        {{-- {{ dd($data->badges->pluck('product_badge_id')->toArray()) }} --}}

                        @livewire('input-product-badge-search', [
                            'mode' => 'multiple',
                            'selected_ids' => old('badge_ids', optional($data->badges)->pluck('product_badge_id')->toArray() ?? []),
                        ])

                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700"></div>

                    <h4 class="mt-4 mb-3 font-bold text-sm text-black dark:text-primary-200">Pricing</h4>

                    <x-admin.product-multi-currency-pricing 
                        :activeCountries="$activeCountries" 
                        :productPrices="$data->pricings" 
                    />

                    <div class="border-t border-gray-200 dark:border-gray-700"></div>

                    <h4 class="mt-4 mb-3 font-bold text-sm text-black dark:text-primary-200">Inventory</h4>

                    <div class="grid gap-4 mb-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                        <div>
                            <x-admin.input-label for="sku" :value="__('SKU')" />
                            <x-admin.text-input id="sku" class="block" type="text" name="sku" :value="old('sku') ? old('sku') : $data->sku" placeholder="Enter SKU" maxlength="50" />
                            <x-admin.input-error :messages="$errors->get('sku')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 grid-cols-1 md:grid-cols-2 xl:grid-cols-3 items-center">
                        <div>
                            <x-admin.input-checkbox 
                                id="quantity-track-checkbox" 
                                name="track_quantity" 
                                value="yes" 
                                class="mb-3" 
                                label="Track quantity" 
                                :checked="old('track_quantity') ? (old('track_quantity') === 'yes') : ($data->stock_quantity > 0)" />

                            <div id="qtyValueField" class="mb-4 {{ old('track_quantity') ? (old('track_quantity') !== 'yes' ? 'hidden' : '') : ($data->stock_quantity > 0 ? '' : 'hidden') }}">
                                <x-admin.input-label for="stock_quantity" :value="__('Quantity')" />
                                <x-admin.text-input id="stock_quantity" class="block" type="tel" name="stock_quantity" :value="old('stock_quantity') ? old('stock_quantity') : (($data->stock_quantity == 0) ? '' : $data->stock_quantity)" placeholder="Enter Quantity" />
                                <x-admin.input-error :messages="$errors->get('stock_quantity')" class="mt-2" />
                                <x-admin.input-error :messages="$errors->get('track_quantity')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="grid gap-4 mb-3 grid-cols-1 md:grid-cols-2 xl:grid-cols-3">
                        <div>
                            <x-admin.input-checkbox 
                                id="allow-backorders-checkbox"
                                name="allow_backorders" 
                                value="yes"
                                label="Continue selling when out of stock" 
                                :checked="old('allow_backorders') ? (old('allow_backorders') === 'yes') : ($data->allow_backorders == 1)" />
                        </div>
                    </div>

                    <div class="border-t border-gray-200 dark:border-gray-700"></div>

                    <h4 class="mt-4 mb-3 font-bold text-sm text-black dark:text-primary-200">Variants</h4>

                    @livewire('product-variant', [
                        'product_id' => $data->id,
                        // 'product_pricings' => $data->pricings->pluck('selling_price', 'country')->toArray(),
                        'category_id' => $data->category_id,
                    ])

                    <div class="border-t border-gray-200 dark:border-gray-700"></div>

                    <h4 class="mt-4 mb-3 font-bold text-sm text-black dark:text-primary-200">Search Engine Content</h4>

                    <div class="grid gap-4 mb-3 grid-cols-1 items-center">
                        <div>
                            <x-admin.input-label for="meta_title" :value="__('Meta Title')" />
                            <x-admin.text-input id="meta_title" class="block" type="text" name="meta_title" :value="old('meta_title') ? old('meta_title') : $data->meta_title" placeholder="Enter Meta Title" />
                            <x-admin.input-error :messages="$errors->get('meta_title')" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid gap-4 mb-3 grid-cols-1 items-center">
                        <div>
                            <x-admin.input-label for="meta_description" :value="__('Meta Description')" />
                            <x-admin.textarea id="meta_description" class="block" type="text" name="meta_description" :value="old('meta_description') ? old('meta_description') : $data->meta_desc" placeholder="Enter Meta Description" />
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
                        <input type="hidden" name="id" value="{{ $data->id }}" />
                    </div>
                </form>
            </div>
        </div>

        <div class="col-span-2">
            <div class="w-full mt-2">
                <h4 class="mt-4 mb-3 font-bold text-sm text-black dark:text-primary-200">Status</h4>

                <div>
                    {{-- <x-admin.input-label for="status" :value="__('Status')" /> --}}
                    <x-admin.input-select id="status" name="status" title="Select Status..." class="w-full" form="productForm">
                        @slot('options')
                            @foreach ($allStatus as $statusVal)
                                <x-admin.input-select-option 
                                    value="{{ $statusVal->id }}" 
                                    :selected="$statusVal->id == $data->status"
                                > 
                                    {{ $statusVal->title }} 
                                </x-admin.input-select-option>
                            @endforeach
                        @endslot
                    </x-admin.input-select>
                    <x-admin.input-error :messages="$errors->get('status')" class="mt-2" />
                </div>
            </div>
        </div>
    </section>

    @include('admin.includes.delete-confirm-modal')

</x-admin-app-layout>

@vite([
    'resources/js/rte-script.js'
])
