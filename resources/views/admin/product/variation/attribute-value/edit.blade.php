<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Edit Product Variation Attribute Value') }}"
    :breadcrumb="[
        ['label' => 'Product variation attribute value', 'url' => route('admin.product.variation.attribute.value.index', request()->query())],
        ['label' => 'Edit']
    ]"
>

    {{-- @if ($errors->any())
        @foreach ($errors->all() as $error)
            <p>{{$error}}</p>
        @endforeach
    @endif --}}

    <div class="w-full mt-2">
        <form action="{{ route('admin.product.variation.attribute.value.update') . (request()->getQueryString() ? '?'.request()->getQueryString() : '') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
                @livewire('input-product-variation-attribute-value', [
                    'attribute_id' => old('attribute_id', $data->attribute_id),
                    'attribute_title' => old('attribute_title', $data->attribute->title),
                ])

                @php
                    $categories = $data?->categoryAttributes?->loadMissing('category') ?? collect();
                @endphp

                @livewire('product-category-multi-select', [
                    'category_id' => old(
                        'category_id', 
                        $categories->isNotEmpty() ? $categories->pluck('category_id')->implode(',') : ''
                    ),
                    'category_name' => old(
                        'category_name', 
                        $categories->isNotEmpty() ? $categories->pluck('category.title')->filter()->implode(', ') : ''
                    ),
                ])
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="title" :value="__('Title *')" />
                    <x-admin.text-input id="title" class="block w-full" type="text" name="title" :value="old('title') ? old('title') : $data->title" placeholder="Enter title" autofocus required />
                    <p class="text-xs mt-2 dark:text-gray-400">e.g. "Red", "8GB", "XL"</p>
                    <x-admin.input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="type" :value="__('Type')" />
                    <x-admin.text-input id="type" class="block w-full" type="text" name="type" :value="old('type') ? old('type') : $data->type" placeholder="Enter type" />
                    <p class="text-xs mt-2 dark:text-gray-400">e.g. "1", "2" | Types are used to easily identify amongst category based values</p>
                    <x-admin.input-error :messages="$errors->get('type')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 grid-cols-1">
                <div>
                    <x-admin.input-label for="short_description" :value="__('Short Description')" />
                    <x-admin.textarea id="short_description" class="block" type="text" name="short_description" :value="old('short_description') ? old('short_description') : $data->short_description" placeholder="Enter Short Description" maxlength="1000" />
                    <x-admin.input-error :messages="$errors->get('short_description')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 grid-cols-1">
                <div>
                    <x-admin.input-label for="long_description" :value="__('Long Description')" />
                    <x-admin.textarea id="long_description" class="block" type="text" name="long_description" :value="old('long_description') ? old('long_description') : $data->long_description" placeholder="Enter Long Description" maxlength="1000" />
                    <x-admin.input-error :messages="$errors->get('long_description')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 grid-cols-1">
                <div>
                    <x-admin.input-label for="tags" :value="__('Tags (comma separated)')" />
                    <x-admin.textarea id="tags" class="block" type="text" name="tags" :value="old('tags') ? old('tags') : $data->tags" placeholder="Enter Tags" maxlength="1000" />
                    <p class="text-xs mt-2 dark:text-gray-400">e.g. "tag 1, tag 2, tag 3"</p>
                    <x-admin.input-error :messages="$errors->get('tags')" class="mt-2" />
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