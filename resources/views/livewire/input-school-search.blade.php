<div 
    wire:loading.class="opacity-50" 
    wire:target="search"
    wire:ignore.self
>
    <x-admin.input-label for="product_id" :value="__('School')" />

    <x-admin.dropdown align="bottom" width="full" wire:key="dropdown-{{ $mode }}-{{ md5(json_encode($selected)) }}">
        <x-slot name="trigger">
            <x-admin.text-input-with-icon 
                id="product_search_input" 
                class="block" 
                icon='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-120 300-300l58-58 122 122 122-122 58 58-180 180ZM358-598l-58-58 180-180 180 180-58 58-122-122-122 122Z"/></svg>' 
                iconPosition="end" 
                type="text" 
                name="product_title_search" 
                placeholder="Search school" 
                aria-autocomplete="off" 
                autocomplete="off" 
                wire:model.live.debounce.300ms="search" 
            />
        </x-slot>

        <x-slot name="content">
            <div class="divide-y divide-gray-100 dark:divide-gray-600" wire:key="product-list-{{ time() }}">
                <ul id="product-list" role="listbox" class="py-1 text-gray-700 dark:text-gray-300 min-h-auto max-h-40 overflow-y-auto" aria-labelledby="dropdown">
                    @forelse($data as $item)
                        <li wire:key="product-{{ $item->id }}">
                            <a class="block w-full px-2 py-1 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out" 
                               href="javascript:void(0)"
                               wire:click.prevent="selectProduct({{ $item->id }})"
                               >
                                <div class="px-3 py-1">
                                    <div class="flex space-x-2 items-center">
                                        @if ($item->logo_path)
                                            <div class="h-10">
                                                <img src="{{ Storage::url($item->logo_path) }}" alt="{{ $item->slug }}">
                                            </div>
                                        @endif
                                        <p class="text-xs font-semibold text-gray-800 dark:text-white">
                                            {{ $item->name }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-2 py-1 text-xs">No class found.</li>
                    @endforelse
                </ul>

                @if ($data->hasPages())
                    <div class="px-2 py-1" 
                        wire:key="product-pagination-{{ $data->currentPage() }}"
                        @click.stop 
                    >
                        {{ $data->links(data: ['scrollTo' => false]) }}
                    </div>
                @endif
            </div>
        </x-slot>
    </x-admin.dropdown>

    {{-- Selected items shown as chips --}}
    <div class="mt-2 flex flex-wrap gap-2" wire:key="selected-chips-{{ md5(json_encode($selected)) }}">
        @foreach($selected as $id)
            @php $class = $selectedBadges[$id] ?? null; @endphp
            <div class="p-1 inline-flex items-center gap-2 rounded shadow-sm bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200" wire:key="selected-{{ $id }}">
                @if ($class?->logo_path)
                    <div class="h-10">
                        <img src="{{ Storage::url($class?->logo_path) }}" alt="{{ $class?->slug }}">
                    </div>
                @endif

                <span class="px-1 py-0.5 h-5 text-xs line-clamp-1">{{ $class?->name ?? 'Class #' . $id }}</span>

                <button type="button" class="ml-2 text-xs h-5 w-5 hover:bg-gray-500 dark:hover:bg-gray-500 focus:outline-none rounded" wire:click.prevent="removeProduct({{ $id }})" aria-label="Remove">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                </button>
            </div>
        @endforeach
    </div>

    {{-- Hidden inputs for form submission --}}
    @if($mode === 'single')
        <input type="hidden" name="school_id" value="{{ $product_id ?? ($selected[0] ?? '') }}">
        <input type="hidden" name="school_title" value="{{ $product_title ?? '' }}">
    @else
        @foreach($selected as $id)
            @php $class = $selectedBadges[$id] ?? null; @endphp
            <input type="hidden" name="school_ids[]" value="{{ $id }}">
            <input type="hidden" name="school_titles[]" value="{{ $class?->name ?? '' }}">
            <input type="hidden" name="school_icons[]" value="{{ $class?->thumbnail_icon ?? '' }}">
        @endforeach
    @endif

    <x-admin.input-error :messages="$errors->get('school_ids')" class="mt-2" />
</div>