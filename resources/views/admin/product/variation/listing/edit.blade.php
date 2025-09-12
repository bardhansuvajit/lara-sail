<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Edit Product Variation') }}"
    :breadcrumb="[
        ['label' => 'Product listing', 'url' => route('admin.product.listing.index')],
        ['label' => 'Edit Product Listing', 'url' => route('admin.product.listing.edit', $data->product_id)],
        ['label' => 'Edit']
    ]"
>

    <div class="w-full mt-2">
        <form action="{{ route('admin.product.listing.variation.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <div class="flex flex-wrap gap-1 mb-2">
                        @foreach($data->combinations as $combo)
                            <span class="px-2 py-1 text-xs bg-gray-100 dark:bg-gray-600">
                                <span class="font-bold text-primary-500 dark:text-primary-400">{{ $combo->attribute->title }}</span>:
                                {{ $combo->attributeValue->title }}
                            </span>
                        @endforeach
                    </div>
                </div>
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
                        @if (!empty($data->images) && count($data->images) > 0)
                            @livewire('existing-product-variation-images', [
                                'images' => $data->images
                            ])
                        @endif
                    </div>
                </div>
            </div>

            <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                <div>
                    <x-admin.input-label for="variation_identifier" :value="__('Variation Identifier *')" />
                    <x-admin.text-input id="variation_identifier" class="block w-full" type="text" name="variation_identifier" :value="old('variation_identifier') ? old('variation_identifier') : $data->variation_identifier" placeholder="Enter Variation Identifier" autofocus required />
                    <x-admin.input-error :messages="$errors->get('variation_identifier')" class="mt-2" />
                </div>
                <div>
                    <x-admin.input-label for="sku" :value="__('SKU')" />
                    <x-admin.text-input id="sku" class="block w-full" type="text" name="sku" :value="old('sku') ? old('sku') : $data->sku" placeholder="Enter SKU" />
                    <x-admin.input-error :messages="$errors->get('sku')" class="mt-2" />
                </div>
                <div>
                    <x-admin.input-label for="barcode" :value="__('Barcode')" />
                    <x-admin.text-input id="barcode" class="block w-full" type="text" name="barcode" :value="old('barcode') ? old('barcode') : $data->barcode" placeholder="Enter Barcode" />
                    <x-admin.input-error :messages="$errors->get('barcode')" class="mt-2" />
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
                        :checked="old('track_quantity') ? (old('track_quantity') === 'yes') : ($data->track_quantity == 1)" />

                    <div id="qtyValueField" class="mb-4 {{ old('track_quantity') ? (old('track_quantity') !== 'yes' ? 'hidden' : '') : ($data->stock_quantity > 0 ? '' : 'hidden') }}">
                        <x-admin.input-label for="stock_quantity" :value="__('Quantity')" />
                        <x-admin.text-input id="stock_quantity" class="block" type="tel" name="stock_quantity" :value="old('stock_quantity') ? old('stock_quantity') : (($data->stock_quantity == 0) ? '' : $data->stock_quantity)" placeholder="Enter Quantity" />
                        <x-admin.input-error :messages="$errors->get('stock_quantity')" class="mt-2" />
                        <x-admin.input-error :messages="$errors->get('track_quantity')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                <div>
                    <x-admin.input-checkbox 
                        id="allow-backorders-checkbox"
                        name="allow_backorders" 
                        value="yes"
                        label="Continue selling when out of stock" 
                        :checked="old('allow_backorders') ? (old('allow_backorders') === 'yes') : ($data->allow_backorders == 1)" />
                </div>
            </div>

            <h4 class="mt-4 mb-3 font-bold text-sm text-black dark:text-primary-200">Pricing</h4>

            <x-admin.product-multi-currency-pricing 
                :activeCountries="$activeCountries" 
                :productPrices="$data->pricings" 
            />

            {{-- <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                <div>
                    <x-admin.input-label for="price_adjustment" :value="__('Price Adjustment')" />
                    <x-admin.text-input id="price_adjustment" class="block w-full" type="text" name="price_adjustment" :value="old('price_adjustment') ? old('price_adjustment') : $data->price_adjustment" placeholder="Enter Price Adjustment" />
                    <x-admin.input-error :messages="$errors->get('price_adjustment')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="adjustment_type" :value="__('Adjustment type')" />
                    <x-admin.input-select id="adjustment_type" name="adjustment_type" title="Select Adjustment type" class="w-full">
                        @slot('options')
                            <x-admin.input-select-option value="fixed" :selected="$data->adjustment_type == 'fixed'"> Fixed </x-admin.input-select-option>
                            <x-admin.input-select-option value="percentage" :selected="$data->adjustment_type == 'percentage'"> Percentage </x-admin.input-select-option>
                        @endslot
                    </x-admin.input-select>
                    <x-admin.input-error :messages="$errors->get('adjustment_type')" class="mt-2" />
                </div>
            </div> --}}

            <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                <div>
                    <x-admin.input-label for="weight_adjustment" :value="__('Weight Adjustment')" />
                    <x-admin.text-input id="weight_adjustment" class="block w-full" type="text" name="weight_adjustment" :value="old('weight_adjustment') ? old('weight_adjustment') : $data->weight_adjustment" placeholder="Enter Weight Adjustment" />
                    <x-admin.input-error :messages="$errors->get('weight_adjustment')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="weight_unit" :value="__('Adjustment type')" />
                    <x-admin.input-select id="weight_unit" name="weight_unit" title="Select Adjustment type" class="w-full">
                        @slot('options')
                            <x-admin.input-select-option value="g" :selected="$data->weight_unit == 'g'"> Grams (g) </x-admin.input-select-option>
                            <x-admin.input-select-option value="kg" :selected="$data->weight_unit == 'kg'"> Kilograms (kg) </x-admin.input-select-option>
                            <x-admin.input-select-option value="lb" :selected="$data->weight_unit == 'lb'"> Pounds (lb) </x-admin.input-select-option>
                            <x-admin.input-select-option value="oz" :selected="$data->weight_unit == 'oz'"> Ounces (oz) </x-admin.input-select-option>
                        @endslot
                    </x-admin.input-select>
                    <x-admin.input-error :messages="$errors->get('weight_unit')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                <div>
                    <x-admin.input-label for="height_adjustment" :value="__('Height Adjustment')" />
                    <x-admin.text-input id="height_adjustment" class="block w-full" type="text" name="height_adjustment" :value="old('height_adjustment') ? old('height_adjustment') : $data->height_adjustment" placeholder="Enter Height Adjustment" />
                    <x-admin.input-error :messages="$errors->get('height_adjustment')" class="mt-2" />
                </div>
                <div>
                    <x-admin.input-label for="width_adjustment" :value="__('Width Adjustment')" />
                    <x-admin.text-input id="width_adjustment" class="block w-full" type="text" name="width_adjustment" :value="old('width_adjustment') ? old('width_adjustment') : $data->width_adjustment" placeholder="Enter Width Adjustment" />
                    <x-admin.input-error :messages="$errors->get('width_adjustment')" class="mt-2" />
                </div>
                <div>
                    <x-admin.input-label for="length_adjustment" :value="__('Length Adjustment')" />
                    <x-admin.text-input id="length_adjustment" class="block w-full" type="text" name="length_adjustment" :value="old('length_adjustment') ? old('length_adjustment') : $data->length_adjustment" placeholder="Enter Length Adjustment" />
                    <x-admin.input-error :messages="$errors->get('length_adjustment')" class="mt-2" />
                </div>
                <div>
                    <x-admin.input-label for="weight_unit" :value="__('Adjustment type')" />
                    <x-admin.input-select id="weight_unit" name="weight_unit" title="Select Adjustment type" class="w-full">
                        @slot('options')
                            <x-admin.input-select-option value="g" :selected="$data->weight_unit == 'g'"> Grams (g) </x-admin.input-select-option>
                            <x-admin.input-select-option value="kg" :selected="$data->weight_unit == 'kg'"> Kilograms (kg) </x-admin.input-select-option>
                            <x-admin.input-select-option value="lb" :selected="$data->weight_unit == 'lb'"> Pounds (lb) </x-admin.input-select-option>
                            <x-admin.input-select-option value="oz" :selected="$data->weight_unit == 'oz'"> Ounces (oz) </x-admin.input-select-option>
                        @endslot
                    </x-admin.input-select>
                    <x-admin.input-error :messages="$errors->get('weight_unit')" class="mt-2" />
                </div>
            </div>

            <div class="items-center space-x-4 flex my-6">
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
</x-admin-app-layout>
