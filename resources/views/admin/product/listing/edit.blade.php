<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Edit Product Category') }}"
    :breadcrumb="[
        ['label' => 'Product category', 'url' => route('admin.product.category.index')],
        ['label' => 'Edit']
    ]"
>

    <div class="w-full mt-2">
        <form action="{{ route('admin.product.category.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div class="grid grid-cols-4 gap-1">
                    @if (!empty($data->image_m))
                        <div class="m-auto">
                            <img src="{{ Storage::url($data->image_m) }}" alt="" class="w-full">
                        </div>
                    @else
                        <div class="w-16 h-16 m-auto">
                            <svg class="text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm40-337 132-132q12-12 28-12t28 12l132 132 132-132q12-12 28-12t28 12l12 12v-183H200v263l40 40Zm-40 257h560v-264l-40-40-132 132q-12 12-28 12t-28-12L400-504 268-372q-12 12-28 12t-28-12l-12-12v184Zm0 0v-264 80-376 560Z"/></svg>
                        </div>
                    @endif
                    <div class="col-span-3">
                        <x-admin.input-label for="image" :value="__('Image')" />
                        <x-admin.file-input id="image" name="image" />
                        <x-admin.input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div> 
                    <x-admin.input-label for="title" :value="__('Title *')" />
                    <x-admin.text-input id="title" class="block w-full" type="text" name="title" :value="old('title') ? old('title') : $data->title" placeholder="Enter title" autofocus required />
                    <x-admin.input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="level" :value="__('Level *')" />
                    <ul class="grid w-full gap-2 grid-cols-8">
                        <li>
                            <x-admin.radio-input-button id="level_1" name="level" value="1" required :checked="$data->level == 1" />
                        </li>
                        <li>
                            <x-admin.radio-input-button id="level_2" name="level" value="2" :checked="$data->level == 2" />
                        </li>
                        <li>
                            <x-admin.radio-input-button id="level_3" name="level" value="3" :checked="$data->level == 3" />
                        </li>
                        <li>
                            <x-admin.radio-input-button id="level_4" name="level" value="4" :checked="$data->level == 4" />
                        </li>
                    </ul>

                    <x-admin.input-error :messages="$errors->get('level')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="parent_id" :value="__('Parent')" />
                    <x-admin.input-select id="parent_id" name="parent_id" title="Select Parent" class="w-full">
                        @slot('options')
                            <x-admin.input-select-option value="" selected="selected"> None </x-admin.input-select-option>
                        @endslot
                    </x-admin.input-select>
                    <x-admin.input-error :messages="$errors->get('parent_id')" class="mt-2" />
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