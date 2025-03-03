<div 
    x-data="{ 
        selectedCollectionIds: {{ json_encode(Arr::wrap(old('collection_id', []))) }},
        selectedCollectionTitles: ({{ json_encode(old('collection_name', '')) }}).split(',').map(item => item.trim()).filter(item => item),
        setCollection(id, title) { 
            id = String(id);
            let index = this.selectedCollectionIds.indexOf(id);
            if (index === -1) { 
                this.selectedCollectionIds.push(id); 
                this.selectedCollectionTitles.push(title);
            } else {
                this.selectedCollectionIds.splice(index, 1); 
                this.selectedCollectionTitles.splice(index, 1);
            }
        }
    }">
    <x-admin.input-label for="collection_id" :value="__('Collection *')" />
    <x-dropdown align="top" width="full">
        <x-slot name="trigger">
            <x-admin.text-input-with-icon 
                id="collection_id" 
                class="block" 
                icon='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-120 300-300l58-58 122 122 122-122 58 58-180 180ZM358-598l-58-58 180-180 180 180-58 58-122-122-122 122Z"/></svg>' 
                iconPosition="end" 
                type="text" 
                name="collection_name" 
                :value="old('title')" 
                placeholder="Search collection" 
                aria-autocomplete="off" 
                autocomplete="off" 
                wire:model.live="collection" 
            />

            {{-- only to display selected collections --}}
            <div class="flex flex-wrap gap-2 my-2">
                <template x-for="(title, index) in selectedCollectionTitles" :key="index">
                    <div class="flex items-center bg-gray-400 text-white dark:bg-gray-600 p-1 text-xs rounded shadow-sm">
                        <span x-text="title"></span>
                        <button 
                            type="button"
                            class="h-5 w-5 ml-2 bg-gray-400 text-white dark:bg-gray-600 hover:bg-gray-500 dark:hover:bg-gray-500 focus:outline-none" 
                            @click="selectedCollectionIds.splice(index, 1); selectedCollectionTitles.splice(index, 1);"
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
                    @forelse($collectionsArrSend as $collection)
                        <li>
                            <a 
                                class="block w-full px-2 py-1 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out" 
                                @click="setCollection('{{ $collection['id'] }}', @js($collection['title']))" 
                                @click.stop
                                href="javascript: void(0)">
                                <div class="w-full flex items-center justify-between">
                                    <div class="flex items-center justify-between w-full">
                                        <span class="text-sm">{{ $collection['title'] }}</span>
                                        <span x-show="selectedCollectionIds.includes(String('{{ $collection['id'] }}'))" class="w-4 h-4 text-green-500 dark:text-green-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M382-240 154-468l57-57 171 171 367-367 57 57-424 424Z"/></svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-2 py-1 text-sm">No collection found.</li>
                    @endforelse
                </ul>
            </div>
        </x-slot>
    </x-dropdown>

    <input type="hidden" name="collection_name" :value="selectedCollectionTitles.join(',')" required>
    {{-- <input type="hidden" name="collection_id" :value="selectedCollectionIds.join(',')" required> --}}
    {{-- <input type="hidden" name="collection_id" :value="selectedCollectionIds.length > 0 ? selectedCollectionIds.join(',') : ''" required> --}}
    <input type="hidden" name="collection_id" :value="selectedCollectionIds.length ? selectedCollectionIds.join(',') : null" required>
    <x-admin.input-error :messages="$errors->get('collection_id')" class="mt-2" />
</div>