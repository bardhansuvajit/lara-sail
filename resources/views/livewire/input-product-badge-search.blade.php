<div 
    wire:loading.class="opacity-50" 
    wire:target="product"
    wire:ignore.self
>
    <x-admin.input-label for="product_id" :value="__('Badge *')" />

    <x-admin.dropdown align="bottom" width="full" wire:key="dropdown-{{ $mode }}-{{ md5(json_encode($selected)) }}">
        <x-slot name="trigger">
            <x-admin.text-input-with-icon 
                id="product_search_input" 
                class="block" 
                icon='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-120 300-300l58-58 122 122 122-122 58 58-180 180ZM358-598l-58-58 180-180 180 180-58 58-122-122-122 122Z"/></svg>' 
                iconPosition="end" 
                type="text" 
                name="product_title_search" 
                placeholder="Search badge" 
                aria-autocomplete="off" 
                autocomplete="off" 
                wire:model.debounce.300ms="product" 
            />
        </x-slot>

        <x-slot name="content">
            <div class="divide-y divide-gray-100 dark:divide-gray-600" wire:key="product-list-{{ time() }}">
                <ul id="product-list" role="listbox" class="py-1 text-gray-700 dark:text-gray-300 min-h-auto max-h-40 overflow-y-auto" aria-labelledby="dropdown">
                    @forelse($products as $product)
                        <li wire:key="product-{{ $product->id }}">
                            <a class="block w-full px-2 py-1 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out" 
                               href="javascript:void(0)"
                               wire:click.prevent="selectProduct({{ $product->id }})"
                               >
                                <div class="px-3 py-1 text-xs font-semibold shadow-sm {{ $product->tailwind_classes }}">
                                    {!! $product->icon !!} {{ $product->title }}
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-2 py-1 text-xs">No product found.</li>
                    @endforelse
                </ul>

                @if ($products->hasPages())
                    <div class="px-2 py-1" 
                        wire:key="product-pagination-{{ $products->currentPage() }}"
                        @click.stop 
                    >
                        {{ $products->links(data: ['scrollTo' => false]) }}
                    </div>
                @endif
            </div>
        </x-slot>
    </x-admin.dropdown>

    {{-- Selected items shown as chips --}}
    <div class="mt-2 flex flex-wrap gap-2" wire:key="selected-chips-{{ md5(json_encode($selected)) }}">
        {{-- @if(count($selected) === 0)
            <div class="text-xs text-gray-500">No badge selected.</div>
        @endif --}}

        @foreach($selected as $id)
            @php $badge = $selectedBadges[$id] ?? null; @endphp
            <div class="inline-flex items-center gap-2 rounded shadow-sm {{ $badge?->tailwind_classes ?? 'bg-gray-100 text-gray-800' }}" wire:key="selected-{{ $id }}">
                {!! $badge?->icon ?? '' !!}

                <span class="px-1 py-0.5 h-5 text-xs">{{ $badge?->title ?? 'Badge #' . $id }}</span>

                <button type="button" class="ml-2 text-xs h-5 w-5 hover:bg-gray-500 dark:hover:bg-gray-500 focus:outline-none rounded" wire:click.prevent="removeProduct({{ $id }})" aria-label="Remove">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                </button>
            </div>
            {{-- <div class="inline-flex items-center gap-2 px-3 py-1 rounded-2xl text-xs font-semibold shadow-sm {{ $badge?->tailwind_classes ?? 'bg-gray-100 text-gray-800' }}" wire:key="selected-{{ $id }}">
                {!! $badge?->icon ?? '' !!}
                <span class="truncate max-w-[160px]">{{ $badge?->title ?? 'Badge #' . $id }}</span>
                <button type="button" class="ml-2 text-xs h-5 w-5 hover:bg-gray-500 dark:hover:bg-gray-500 focus:outline-none rounded" wire:click.prevent="removeProduct({{ $id }})" aria-label="Remove">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                </button>
            </div> --}}
        @endforeach
    </div>

    {{-- Hidden inputs for form submission --}}
    @if($mode === 'single')
        <input type="hidden" name="badge_id" value="{{ $product_id ?? ($selected[0] ?? '') }}">
        <input type="hidden" name="badge_title" value="{{ $product_title ?? '' }}">
    @else
        @foreach($selected as $id)
            @php $badge = $selectedBadges[$id] ?? null; @endphp
            <input type="hidden" name="badge_ids[]" value="{{ $id }}">
            <input type="hidden" name="badge_titles[]" value="{{ $badge?->title ?? '' }}">
            <input type="hidden" name="badge_icons[]" value="{{ $badge?->icon ?? '' }}">
        @endforeach
    @endif

    <x-admin.input-error :messages="$errors->get('badge_ids')" class="mt-2" />
</div>
