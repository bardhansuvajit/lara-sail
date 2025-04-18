<div 
    x-data="{ 
        selectedCategoryIds: {{ json_encode(
            old('category_id') !== null 
                ? (old('category_id') !== '' ? explode(',', old('category_id')) : [])
                : (isset($category_id) && $category_id !== '' ? explode(',', $category_id) : [])
        ) }},
        selectedCategoryTitles: ({{ json_encode(
            old('category_name') !== null 
                ? old('category_name') 
                : (isset($category_name) ? $category_name : '')
        ) }} || '').split(',').map(item => item.trim()).filter(item => item),
        setCategory(id, title) { 
            id = String(id); 
            let index = this.selectedCategoryIds.indexOf(id);
            if (index === -1) { 
                this.selectedCategoryIds.push(id); 
                this.selectedCategoryTitles.push(title);
            } else {
                this.selectedCategoryIds.splice(index, 1); 
                this.selectedCategoryTitles.splice(index, 1);
            }
        },
        removeCategory(index) {
            this.selectedCategoryIds.splice(index, 1);
            this.selectedCategoryTitles.splice(index, 1);
        }
    }" 
>
    <x-admin.input-label for="category_id" :value="__('Category *')" />
    <x-dropdown align="top" width="full">
        <x-slot name="trigger">
            <x-admin.text-input-with-icon 
                id="category_id" 
                class="block" 
                icon='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-120 300-300l58-58 122 122 122-122 58 58-180 180ZM358-598l-58-58 180-180 180 180-58 58-122-122-122 122Z"/></svg>' 
                iconPosition="end" 
                type="text" 
                name="category_name" 
                :value="old('title')" 
                placeholder="Search category" 
                aria-autocomplete="off" 
                autocomplete="off" 
                wire:model.live="category" 
            />

            <div class="flex flex-wrap gap-2 my-2">
                <template x-for="(title, index) in selectedCategoryTitles" :key="index">
                    <div class="flex items-center shadow-sm bg-gray-400 text-white dark:bg-gray-600 rounded">
                        <span x-text="title" class="px-1 py-0.5 h-5 text-xs"></span>
                        <button 
                            type="button" 
                            class="h-5 w-5 hover:bg-gray-500 dark:hover:bg-gray-500 focus:outline-none rounded" 
                            @click="removeCategory(index)"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                        </button>
                    </div>
                </template>
            </div>

        </x-slot>
        <x-slot name="content">
            <div class="divide-y divide-gray-100 dark:divide-gray-600">
                <ul class="py-1 text-gray-700 dark:text-gray-300 min-h-auto max-h-40 overflow-y-auto" aria-labelledby="dropdown">
                    @forelse($categoriesArrSend as $category)
                        <li>
                            <a 
                                class="block w-full px-2 py-1 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out" 
                                @click="setCategory('{{ $category['id'] }}', @js($category['title']))" 
                                @click.stop
                                href="javascript: void(0)">
                                <div class="w-full flex items-center justify-between">
                                    <div class="flex items-center justify-between w-full">
                                        <div class="flex space-x-2 items-center">
                                            @if($category['image_s']) <div class="h-8 overflow-hidden flex"><img src="{{ Storage::url($category['image_s']) }}" alt=""></div> @endif
                                            <p class="text-xs">{{ $category['title'] }}</p>
                                        </div>
                                        <span x-show="selectedCategoryIds.includes(String('{{ $category['id'] }}'))" class="w-4 h-4 text-green-500 dark:text-green-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-2 py-1 text-xs">No category found.</li>
                    @endforelse
                </ul>
            </div>
        </x-slot>
    </x-dropdown>

    <input type="hidden" name="category_name" :value="selectedCategoryTitles.join(',')" required>
    <input type="hidden" name="category_id" :value="selectedCategoryIds.length ? selectedCategoryIds.join(',') : null" required>
    <x-admin.input-error :messages="$errors->get('category_id')" class="mt-2" />
</div>