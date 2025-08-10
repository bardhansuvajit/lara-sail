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

                <div class="col-span-2">
                    @livewire('product-category-selector', [
                        'level' => $data->level,
                        'parentId' => $data->parent_id
                    ])
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div> 
                    <x-admin.input-label for="short_description" :value="__('Short Description')" />
                    <x-admin.textarea id="short_description" class="block" type="text" name="short_description" :value="old('short_description', $data->short_description)" placeholder="Enter Short Description" maxlength="1000" />
                    <x-admin.input-error :messages="$errors->get('short_description')" class="mt-2" />
                </div>
            </div>

            <div class="grid gap-4 mb-4 sm:grid-cols-1">
                <div> 
                    <x-admin.input-label for="long_description" :value="__('Long Description')" />
                    <x-admin.textarea id="long_description" class="block min-h-[6rem] max-h-[10rem]" type="text" name="long_description" :value="old('long_description', $data->long_description)" placeholder="Enter Long Description" />
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

            @if (count($variations) > 0)
                <hr class="dark:border-gray-700 mb-4">

                <h3 class="text-xs sm:text-sm font-semibold text-gray-900 dark:text-white mb-3">Variations</h3>

                @foreach ($variations as $singleVariation)
                    @if ($singleVariation->values->count() > 0)
                        <div class="py-3 bg-white dark:bg-gray-800 border-t border-gray-500 dark:border-gray-700">
                            <div class="flex items-center justify-between mb-3">
                                <h5 class="text-sm font-medium hover:text-primary-600 transition-colors">
                                    <a href="{{ route('admin.product.variation.attribute.edit', $singleVariation->id) }}" 
                                    target="_blank"
                                    class="flex items-center gap-1 underline hover:no-underline">
                                        {{ $singleVariation->title }}
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                        </svg>
                                    </a>
                                </h5>
                            </div>

                            @if ($singleVariation->is_global)
                                <p class="mt-2 text-sm text-green-500 dark:text-green-600">
                                    <span class="italic font-black">{{ __('Global variation') }}</span> {{ __('Values are automatically available to all categories') }}
                                </p>

                                @foreach ($singleVariation->values->groupBy('type') as $type => $values)
                                    <div class="mb-4 last:mb-0">
                                        <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1 inline-block">Type {{ $type }}</span>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($values as $value)
                                                <div class="border dark:border-gray-700 text-center overflow-hidden min-w-[40px] bg-white dark:bg-gray-700">
                                                    <p class="text-sm p-2 bg-gray-50 dark:bg-gray-600">{{ $value->title }}</p>
                                                    <x-admin.button-icon
                                                        element="a"
                                                        tag="success"
                                                        class="w-full !rounded-none cursor-pointer" >
                                                        @slot('icon')
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-4 h-4" fill="currentColor"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>
                                                        @endslot
                                                    </x-admin.button-icon>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @foreach ($singleVariation->values->groupBy('type') as $type => $values)
                                    <div class="mb-4 last:mb-0">
                                        <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 mb-1 inline-block">Type {{ $type }}</span>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($values as $value)
                                                <div class="border dark:border-gray-700 text-center overflow-hidden min-w-[40px] bg-white dark:bg-gray-700">
                                                    <p class="text-sm p-2 bg-gray-50 dark:bg-gray-600">{{ $value->title }}</p>
                                                    <x-admin.button-icon
                                                        element="a"
                                                        tag="{{ $value->categories->contains($data->id) ? 'success' : 'secondary' }}"
                                                        class="w-full !rounded-none cursor-pointer"
                                                        x-data=""
                                                        x-on:click.prevent="
                                                            $dispatch('open-modal', 'confirm-data-toggle');
                                                            $dispatch('set-desc', '{{ $value->categories->contains($data->id) ? 'remove' : 'add' }}');
                                                            $dispatch('set-toggle-route', '{{ route('admin.product.category.variation.toggle', [$data->id, $value->id]) }}');
                                                        " >
                                                        @slot('icon')
                                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-4 h-4" fill="currentColor"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>
                                                        @endslot
                                                    </x-admin.button-icon>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    @endif
                @endforeach
            @endif

            <input type="hidden" name="id" value="{{ $data->id }}" />
        </form>
    </div>

    <x-modal name="confirm-data-toggle" maxWidth="sm" focusable>
        <div 
            class="p-6" 
            x-data="{ toggleRoute: '', desc: '' }" 
            x-on:set-toggle-route.window="toggleRoute = $event.detail" 
            x-on:set-desc.window="desc = $event.detail"
        >
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Are you sure?') }}
            </h2>

            <p x-show="desc === 'add'" class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                {{ __('Once this data is added, you can remove it later') }}
            </p>

            <p x-show="desc === 'remove'" class="mt-1 text-xs text-gray-600 dark:text-gray-400">
                {{ __('Once this data is removed, you can add it later') }}
            </p>

            <div class="mt-6 flex justify-end">
                <x-admin.button
                    element="button"
                    tag="secondary"
                    href="javascript: void(0)"
                    title="Cancel"
                    class="border me-3"
                    x-on:click="$dispatch('close')"
                >
                    {{ __('Cancel') }}
                </x-admin.button>

                <form :action="toggleRoute" method="POST" class="">
                    @csrf
                    @method('GET')
                    <x-admin.button
                        x-show="desc === 'add'"
                        element="button"
                        type="submit"
                        tag="success"
                        href="javascript: void(0)"
                        title="Delete"
                    >
                        Yes, <div x-text="desc" class="ms-1 capitalize"></div>
                    </x-admin.button>
                </form>

                <form :action="toggleRoute" method="POST" class="">
                    @csrf
                    @method('GET')
                    <x-admin.button
                        x-show="desc === 'remove'"
                        element="button"
                        type="submit"
                        tag="danger"
                        href="javascript: void(0)"
                        title="Delete"
                    >
                        Yes, <div x-text="desc" class="ms-1 capitalize"></div>
                    </x-admin.button>
                </form>
            </div>
        </div>
    </x-modal>
</x-admin-app-layout>
