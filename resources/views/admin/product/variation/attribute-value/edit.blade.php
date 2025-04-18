<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Edit Product Variation Attribute Value') }}"
    :breadcrumb="[
        ['label' => 'Product variation attribute value', 'url' => route('admin.product.variation.attribute.value.index')],
        ['label' => 'Edit']
    ]"
>

    <div class="w-full mt-2">
        <form action="{{ route('admin.product.variation.attribute.value.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div> 
                    <x-admin.input-label for="title" :value="__('Title *')" />
                    <x-admin.text-input id="title" class="block w-full" type="text" name="title" :value="old('title') ? old('title') : $data->title" placeholder="Enter title" autofocus required />
                    <p class="text-xs mt-2 dark:text-gray-400">e.g. "Red", "8GB", "XL"</p>
                    <x-admin.input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="is_global" :value="__('Global attribute *')" />
                    <ul class="flex space-x-2">
                        <li>
                            <x-admin.radio-input-button 
                                id="level_1" 
                                name="is_global" 
                                value="1" 
                                title="Yes" 
                                class="w-auto px-2" 
                                required 
                                :checked="old('is_global') ? old('is_global') == 1 : ($data->is_global == 1 ? 'checked' : '')" />
                        </li>
                        <li>
                            <x-admin.radio-input-button 
                                id="level_2" 
                                name="is_global" 
                                value="0" 
                                title="No" 
                                class="w-auto px-2" 
                                required 
                                :checked="old('is_global') ? old('is_global') == 0 : ($data->is_global == 0 ? 'checked' : '')" />
                        </li>
                    </ul>
                    <x-admin.input-error :messages="$errors->get('is_global')" class="mt-2" />
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