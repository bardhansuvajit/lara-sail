<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Create Product Collection') }}"
    :breadcrumb="[
        ['label' => 'Product collection', 'url' => route('admin.product.collection.index')],
        ['label' => 'Create']
    ]"
>

    <div class="w-full mt-2">
        <form action="{{ route('admin.product.collection.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="image" :value="__('Image')" />
                    <x-admin.file-input id="image" name="image" />
                    <x-admin.input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="title" :value="__('Title *')" />
                    <x-admin.text-input id="title" class="block w-full" type="text" name="title" :value="old('title')" placeholder="Enter title" autofocus required />
                    <x-admin.input-error :messages="$errors->get('title')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div> 
                    <x-admin.input-label for="short_description" :value="__('Short Description')" />
                    <x-admin.textarea id="short_description" class="block" type="text" name="short_description" :value="old('short_description')" placeholder="Enter Short Description" maxlength="1000" />
                    <x-admin.input-error :messages="$errors->get('short_description')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div> 
                    <x-admin.input-label for="long_description" :value="__('Long Description')" />
                    <x-admin.textarea id="long_description" class="block min-h-[6rem] max-h-[10rem]" type="text" name="long_description" :value="old('long_description')" placeholder="Enter Long Description" />
                    <x-admin.input-error :messages="$errors->get('long_description')" class="mt-2" />
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
        </form>
    </div>
</x-admin-app-layout>