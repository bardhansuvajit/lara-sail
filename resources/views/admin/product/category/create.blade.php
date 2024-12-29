<x-admin-app-layout
    screen="md:max-w-screen-lg"
    title="{{ __('Create product category') }}"
    :breadcrumb="[
        ['label' => 'Product category', 'url' => route('admin.product.category.index')],
        ['label' => 'Create']
    ]"
>

    <div class="w-full">
        <form action="{{ route('admin.product.category.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div>
                    <x-admin.input-label for="image" :value="__('Image')" />
                    <x-admin.file-input id="image" name="image" :value="old('image')" />
                    <x-admin.input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-3">
                <div> 
                    <x-admin.input-label for="title" :value="__('Title *')" />
                    <x-admin.text-input id="title" class="block w-full" type="text" name="title" :value="old('title')" placeholder="Enter title" autofocus required />
                    <x-admin.input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <div>
                    <x-admin.input-label for="level" :value="__('Level *')" />

                    <ul class="grid w-full gap-2 grid-cols-8">
                        <li>
                            <input type="radio" id="level_1" name="level" value="1" class="hidden peer" required checked />
                            <label for="level_1" class="h-[2rem] w-[2rem] inline-flex items-center justify-between p-1 text-gray-500 bg-white border border-gray-200 rounded cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-gray-50 dark:peer-checked:bg-gray-700 peer-checked:bg-gray-400 dark:peer-checked:border-gray-700 peer-checked:border-gray-400 peer-checked:text-gray-50 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block w-full text-center">
                                    <div class="w-full text-lg font-semibold">1</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="level_2" name="level" value="2" class="hidden peer">
                            <label for="level_2" class="h-[2rem] w-[2rem] inline-flex items-center justify-between p-1 text-gray-500 bg-white border border-gray-200 rounded cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-gray-50 dark:peer-checked:bg-gray-700 peer-checked:bg-gray-400 dark:peer-checked:border-gray-700 peer-checked:border-gray-400 peer-checked:text-gray-50 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block w-full text-center">
                                    <div class="w-full text-lg font-semibold">2</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="level_3" name="level" value="3" class="hidden peer">
                            <label for="level_3" class="h-[2rem] w-[2rem] inline-flex items-center justify-between p-1 text-gray-500 bg-white border border-gray-200 rounded cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-gray-50 dark:peer-checked:bg-gray-700 peer-checked:bg-gray-400 dark:peer-checked:border-gray-700 peer-checked:border-gray-400 peer-checked:text-gray-50 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block w-full text-center">
                                    <div class="w-full text-lg font-semibold">3</div>
                                </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="level_4" name="level" value="4" class="hidden peer">
                            <label for="level_4" class="h-[2rem] w-[2rem] inline-flex items-center justify-between p-1 text-gray-500 bg-white border border-gray-200 rounded cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-gray-50 dark:peer-checked:bg-gray-700 peer-checked:bg-gray-400 dark:peer-checked:border-gray-700 peer-checked:border-gray-400 peer-checked:text-gray-50 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                                <div class="block w-full text-center">
                                    <div class="w-full text-lg font-semibold">4</div>
                                </div>
                            </label>
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
        </form>
    </div>
</x-admin-app-layout>