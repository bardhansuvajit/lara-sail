<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Edit Application Settings') }}"
    :breadcrumb="[
        ['label' => 'Edit Application settings']
    ]"
>

    <section class="mt-2">
        @include('admin.application.includes.navbar')

        <div class="py-5 px-5 bg-gray-100 dark:bg-gray-700">
            <div class="mb-3">
                <x-admin.developer-expertise-alert />
            </div>

            <form action="{{ route('admin.application.settings.update', 'cart') }}" method="POST" class="space-y-4">@csrf
                @foreach ($data as $item)
                    <input type="hidden" name="id[]" value="{{ $item->id }}">

                    {{-- {{ $item }} --}}

                    <div class="flex items-center gap-3">
                        <div class="w-8">
                            {!! $item->countryDetails->flag !!}
                        </div>
                        <p class="text-xl font-semibold text-gray-900 dark:text-white">{{ $item->countryDetails->name }}</p>
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-1">
                            <div>
                                <x-admin.input-label for="min_order_value" :value="__('Minimum Order value *')" />
                                <x-admin.text-input id="min_order_value" class="block w-full" type="text" name="min_order_value[]" :value="old('min_order_value') ? old('min_order_value') : $item->min_order_value" placeholder="Enter Minimum Order value" autofocus required />
                                <x-admin.input-error :messages="$errors->get('min_order_value')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-span-1">
                            <div>
                                <x-admin.input-label for="shipping_charge" :value="__('Shipping Charge *')" />
                                <x-admin.text-input id="shipping_charge" class="block w-full" type="text" name="shipping_charge[]" :value="old('shipping_charge') ? old('shipping_charge') : $item->shipping_charge" placeholder="Enter Shipping Charge" required />
                                <x-admin.input-error :messages="$errors->get('shipping_charge')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-span-1">
                            <div>
                                <x-admin.input-label for="free_shipping_threshold" :value="__('Free Shipping Threshold *')" />
                                <x-admin.text-input id="free_shipping_threshold" class="block w-full" type="text" name="free_shipping_threshold[]" :value="old('free_shipping_threshold') ? old('free_shipping_threshold') : $item->free_shipping_threshold" placeholder="Enter Free Shipping Threshold" required />
                                <x-admin.input-error :messages="$errors->get('free_shipping_threshold')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-4 gap-4">
                        <div class="col-span-1">
                            <div>
                                <x-admin.input-label for="tax_name" :value="__('TAX Name *')" />
                                <x-admin.text-input id="tax_name" class="block w-full" type="text" name="tax_name[]" :value="old('tax_name') ? old('tax_name') : $item->tax_name" placeholder="Enter TAX Name" required />
                                <x-admin.input-error :messages="$errors->get('tax_name')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-span-1">
                            <div>
                                <x-admin.input-label for="tax_rate" :value="__('TAX Rate *')" />
                                <x-admin.text-input id="tax_rate" class="block w-full" type="text" name="tax_rate[]" :value="old('tax_rate') ? old('tax_rate') : $item->tax_rate" placeholder="Enter TAX Rate" required />
                                <x-admin.input-error :messages="$errors->get('tax_rate')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-span-1">
                            <div>
                                <x-admin.input-label for="tax_type" :value="__('TAX Type *')" />
                                <x-admin.input-select 
                                    id="tax_type" 
                                    class="w-full"
                                    name="tax_type[]" 
                                >
                                    @slot('options')
                                        <x-admin.input-select-option value="fixed" :selected="$item->tax_type == 'fixed'"> Fixed </x-admin.input-select-option>
                                        <x-admin.input-select-option value="percentage" :selected="$item->tax_type == 'percentage'"> Percentage </x-admin.input-select-option>
                                    @endslot
                                </x-admin.input-select>
                                <x-admin.input-error :messages="$errors->get('tax_type')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-span-1"><div> 
                                <x-admin.input-label for="tax_exclusive" :value="__('TAX Exclusive *')" />
                                <x-admin.input-select 
                                    id="tax_exclusive" 
                                    class="w-full"
                                    name="tax_exclusive[]" 
                                    :title="$item->tax_exclusive"
                                >
                                    @slot('options')
                                        <x-admin.input-select-option value="0" :selected="$item->tax_exclusive == 0"> NO </x-admin.input-select-option>
                                        <x-admin.input-select-option value="1" :selected="$item->tax_exclusive == 1"> YES </x-admin.input-select-option>
                                    @endslot
                                </x-admin.input-select>
                                <x-admin.input-error :messages="$errors->get('tax_exclusive')" class="mt-2" />
                            </div>
                            {{-- <p class="text-xs  text-gray-500 dark:text-gray-400">TAX Exclusive ?</p>
                            <p class="text-xs font-semibold text-gray-900 dark:text-white">{{ ($item->tax_exclusive == 0) ? 'NO' : 'YES' }}</p> --}}
                        </div>
                    </div>

                    @if (!$loop->last)
                        <div class="col-span-4">
                            <hr class="dark:border-gray-600">
                        </div>
                    @endif
                @endforeach

                <div class="col-span-4">
                    <div class="flex space-x-2 mt-2">
                        <input type="hidden" name="type" value="cart">

                        <x-admin.button
                            type="submit"
                            class="w-40"
                            element="button">
                            @slot('icon')
                                <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"></path></svg>
                            @endslot
                            {{ __('Save Changes') }}
                        </x-admin.button>

                        <x-admin.button
                            element="a"
                            tag="secondary"
                            class="w-24"
                            :href="route('admin.application.settings.index', 'cart')">
                        {{ __('Back') }}
                        </x-admin.button>
                    </div>
                </div>
            </form>
        </div>
    </section>

</x-admin-app-layout>
