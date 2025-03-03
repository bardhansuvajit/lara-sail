<div 
    x-data="{ 
        {{-- selectedCategoryId: '', 
        selectedCategoryTitle: '',  --}}
        {{-- selectedCategoryId: @json(old('category_id', '')),
        selectedCategoryTitle: @json(old('category_name', '')), --}}
        selectedCategoryId: {{ json_encode(old('category_id', '')) }}, 
        selectedCategoryTitle: {{ json_encode(old('category_name', '')) }},
        setCategory(id, title) { 
            this.selectedCategoryId = id;
            this.selectedCategoryTitle = title; 
        } 
    }">
    <x-admin.input-label for="category_id" :value="__('Category *')" />
    <x-dropdown align="top" width="full">
        <x-slot name="trigger">
            <x-admin.text-input-with-icon 
                id="category_id" 
                class="block" 
                icon='<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="currentColor"><path d="M480-120 300-300l58-58 122 122 122-122 58 58-180 180ZM358-598l-58-58 180-180 180 180-58 58-122-122-122 122Z"/></svg>' 
                iconPosition="end" 
                type="text" 
                name="category_name" 
                :value="old('category_name')" 
                placeholder="Search category" 
                aria-autocomplete="off" 
                autocomplete="off" 
                wire:model.live="category" 
                x-model="selectedCategoryTitle"
            />
        </x-slot>
        <x-slot name="content">
            <div class="divide-y divide-gray-100 dark:divide-gray-600">
                <ul class="py-1 text-gray-700 dark:text-gray-300 min-h-auto max-h-40 overflow-y-auto" aria-labelledby="dropdown">
                    @forelse($categories as $category)
                        <li>
                            @if (isset($category['child_details']) && count($category['child_details']) > 0)
                                <a 
                                    class="block w-full px-2 py-1 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out" 
                                    wire:click="getCategoryOptionsByParentId('{{ $category['id'] }}')"
                                    href="javascript: void(0)"
                                    @click.stop
                                >
                                    <div class="w-full flex items-center justify-between">
                                        <div class="text-sm">
                                            {{ $category['title'] }}
                                        </div>

                                        @if ($category['child_details'])
                                            <div class="w-4 h-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M504-480 320-664l56-56 240 240-240 240-56-56 184-184Z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                            @else
                                <a 
                                    class="block w-full px-2 py-1 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out" 
                                    @click="setCategory('{{ $category['id'] }}', @js($category['title']))" 
                                    href="javascript: void(0)">
                                    <div class="w-full flex items-center justify-between">
                                        <div class="text-sm">
                                            {{ $category['title'] }}
                                        </div>

                                        <div class="text-xs bg-teal-500 text-white py-0 px-1">
                                            Level {{ $category['level'] }}
                                        </div>
                                    </div>
                                </a>
                            @endif
                        </li>
                    @empty
                        <li class="px-2 py-1 text-sm">No category found.</li>
                    @endforelse
                </ul>
            </div>
        </x-slot>
    </x-dropdown>

    <input type="hidden" name="category_id" x-model="selectedCategoryId" value="{{ old('category_id') }}" required>
    <x-admin.input-error :messages="$errors->get('category_id')" class="mt-2" />
</div>