<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Edit Coupon') }}"
    :breadcrumb="[
        ['label' => 'Coupon', 'url' => route('admin.product.coupon.index')],
        ['label' => 'Edit']
    ]"
>

    <div class="w-full mt-2">
        <form action="{{ route('admin.product.coupon.update') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="code" :value="__('Code *')" />
                    <x-admin.text-input id="code" class="block w-full" type="text" name="code" :value="old('code', $data->code)" placeholder="Enter code" autofocus />
                    <x-admin.input-error :messages="$errors->get('code')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="country_code" :value="__('Country *')" />
                    <x-admin.input-select id="country_code" name="country_code" title="Select Country" class="w-full">
                        @slot('options')
                            @foreach ($activeCountries as $country)
                                <x-admin.input-select-option value="{{$country->code}}" 
                                    :selected="old('country_code', $data->country_code) == $country->code"
                                > {{$country->name}} </x-admin.input-select-option>
                            @endforeach
                        @endslot
                    </x-admin.input-select>
                    <x-admin.input-error :messages="$errors->get('country_code')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="name" :value="__('Name *')" />
                    <x-admin.text-input id="name" class="block w-full" type="text" name="name" :value="old('name', $data->name)" placeholder="Enter name" />
                    <x-admin.input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div> 
                    <x-admin.input-label for="description" :value="__('Description')" />
                    <x-admin.textarea id="description" class="block" type="text" name="description" :value="old('description', $data->description)" placeholder="Enter Short Description" maxlength="1000" />
                    <x-admin.input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="discount_type" :value="__('Discount Type *')" />
                    <x-admin.input-select id="discount_type" name="discount_type" title="Select Discount Type" class="w-full">
                        @slot('options')
                            <x-admin.input-select-option value="percentage" :selected="old('discount_type', $data->discount_type) == 'percentage'"> Percentage </x-admin.input-select-option>
                            <x-admin.input-select-option value="fixed" :selected="old('discount_type', $data->discount_type) == 'fixed'"> Fixed </x-admin.input-select-option>
                            <x-admin.input-select-option value="free_shipping" :selected="old('discount_type', $data->discount_type) == 'free_shipping'"> Free Shipping </x-admin.input-select-option>
                        @endslot
                    </x-admin.input-select>
                    <x-admin.input-error :messages="$errors->get('discount_type')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="value" :value="__('Value *')" />
                    <x-admin.text-input id="value" class="block w-full" type="text" name="value" :value="old('value', $data->value)" placeholder="Enter value" />
                    <x-admin.input-error :messages="$errors->get('value')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="max_discount_amount" :value="__('Maximum Discount Amount *')" />
                    <x-admin.text-input id="max_discount_amount" class="block w-full" type="text" name="max_discount_amount" :value="old('max_discount_amount', $data->max_discount_amount)" placeholder="Enter maximum discount amount" />
                    <x-admin.input-error :messages="$errors->get('max_discount_amount')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="min_cart_value" :value="__('Minimum Cart Value *')" />
                    <x-admin.text-input id="min_cart_value" class="block w-full" type="text" name="min_cart_value" :value="old('min_cart_value', $data->min_cart_value)" placeholder="Enter minimum cart value" />
                    <x-admin.input-error :messages="$errors->get('min_cart_value')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="usage_limit" :value="__('Usage Limit *')" />
                    <x-admin.text-input id="usage_limit" class="block w-full" type="text" name="usage_limit" :value="old('usage_limit', $data->usage_limit)" placeholder="Enter usage limit" />
                    <x-admin.input-error :messages="$errors->get('usage_limit')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="usage_per_user" :value="__('Usage Per User *')" />
                    <x-admin.text-input id="usage_per_user" class="block w-full" type="text" name="usage_per_user" :value="old('usage_per_user', $data->usage_per_user)" placeholder="Enter usage per user" />
                    <x-admin.input-error :messages="$errors->get('usage_per_user')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="starts_at" :value="__('Starts at *')" />
                    <x-admin.text-input id="starts_at" class="block w-full" type="date" name="starts_at" :value="old('starts_at', $data->starts_at ? \Carbon\Carbon::parse($data->starts_at)->format('Y-m-d') : null)" placeholder="Enter start date" />
                    <x-admin.input-error :messages="$errors->get('starts_at')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="expires_at" :value="__('Ends at *')" />
                    <x-admin.text-input id="expires_at" class="block w-full" type="date" name="expires_at" :value="old('expires_at', $data->starts_at ? \Carbon\Carbon::parse($data->expires_at)->format('Y-m-d') : null)" placeholder="Enter end date" />
                    <x-admin.input-error :messages="$errors->get('expires_at')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="show_in_frontend" :value="__('Show in Frontend *')" />
                    <ul class="flex w-full gap-2">
                        <li>
                            <x-admin.radio-input-button class="w-auto px-2" id="show_in_frontend_yes" name="show_in_frontend" value="1" title="Yes" :checked="old('show_in_frontend', $data->show_in_frontend) == '1'"  />
                        </li>
                        <li>
                            <x-admin.radio-input-button class="w-auto px-2" id="show_in_frontend_no" name="show_in_frontend" value="0" title="No" :checked="old('show_in_frontend', $data->show_in_frontend) == '0'"  />
                        </li>
                    </ul>
                    <x-admin.input-error :messages="$errors->get('show_in_frontend')" class="mt-2" />
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

            </div>

            <input type="hidden" name="id" value="{{ $data->id }}" />
        </form>
    </div>
</x-admin-app-layout>