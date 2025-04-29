<div>
    <div class="grid gap-4 mb-3 grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3">
        <div>
            <button 
                type="button" 
                class="text-xs inline-block text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-500" 
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'add-variant');"
            >
                <div class="flex items-center">
                    <div class="w-3 h-3">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
                    </div>
                    Add options like Colors and Size
                </div>
            </button>
        </div>
    </div>

    <x-modal name="add-variant" maxWidth="7xl" show focusable>
        <div class="p-4">
            @if (count($variations) > 0)
                <form action="" method="post">@csrf
                    {{-- heading --}}
                    <h5 class="text-xs font-bold text-gray-700 dark:text-gray-200"> {{ __('Available Variations') }} </h5>
                    <p class="mb-3 text-xs text-gray-500 dark:text-gray-400"> {{ __('Select one by one from the Variation Attributes Value list below and tap on Create New') }} </p>

                    {{-- search --}}
                    <div class="grid gap-4 mb-3 grid-cols-1 md:grid-cols-4">
                        <div>
                            <x-admin.input-label for="search" :value="__('Search')" />
                            <x-admin.text-input 
                                id="search" 
                                class="block" 
                                type="text" 
                                name="search" 
                                wire:model.live.debounce.300ms="search"
                                placeholder="Search..." 
                            />
                        </div>
                    </div>

                    {{-- attribute values --}}
                    @foreach ($variations as $variationAttr)
                        <div class="mb-6">
                            <h5 class="text-base font-medium text-primary-300 dark:text-primary-400 hover:text-primary-600 transition-colors inline-block mb-3">
                                <a href="{{ route('admin.product.variation.attribute.edit', $variationAttr->id) }}" 
                                target="_blank"
                                class="flex items-center gap-1">
                                    {{ $variationAttr->title }}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                    </svg>
                                </a>
                            </h5>

                            <div class="flex flex-wrap gap-2">
                                @forelse ($variationAttr->values as $attrValue)
                                    <div class="border dark:border-gray-700 text-center overflow-hidden min-w-[40px] bg-white dark:bg-gray-700">
                                        <p class="text-sm p-2 bg-gray-50 dark:bg-gray-600">{{ $attrValue->title }}</p>
                                        <x-admin.button-icon
                                            element="a"
                                            tag="secondary"
                                            class="w-full !rounded-none cursor-pointer"
                                            x-data=""
                                            x-on:click.prevent="
                                                $dispatch('open-modal', 'confirm-data-toggle');
                                            " >
                                            @slot('icon')
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="w-4 h-4" fill="currentColor"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>
                                            @endslot
                                        </x-admin.button-icon>
                                    </div>
                                @empty
                                    <p class="text-sm italic">{{ __('No values found for this Attribute') }}</p>
                                @endforelse
                            </div>
                        </div>
                    @endforeach

                    {{-- submit button --}}
                    <div class="w-full">
                        <div class="items-center space-x-4 flex mt-4 mb-5 p-4 sticky bottom-5 rounded shadow border bg-white dark:border-gray-700 dark:bg-gray-800">
                            <x-admin.button
                                type="submit"
                                element="button">
                                @slot('icon')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M840-680v480q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160Zm-80 34L646-760H200v560h560v-446ZM480-240q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35ZM240-560h360v-160H240v160Zm-40-86v446-560 114Z"/></svg>
                                @endslot
                                {{ __('Save data') }}
                            </x-admin.button>
                        </div>
                    </div>
                </form>
            @else
                <p class="text-sm italic">{{ __('No variations found for this Category') }}</p>
            @endif
        </div>
    </x-modal>    
</div>
