<div 
    wire:loading.class="opacity-50" 
    wire:target="product"
    x-data='{
        "selectedProductId": @json($product_id ?? 0),
        "selectedProductTitle": @json($product_title ?? ""),
    }' 
    wire:ignore.self
>
    <x-admin.input-label for="product_id" :value="__('Product *')" />
    <x-dropdown align="top" width="full" wire:key="dropdown-{{ $product_id }}">
        <x-slot name="trigger">
            <x-admin.text-input-with-icon 
                id="product_id" 
                class="block" 
                icon='<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-120 300-300l58-58 122 122 122-122 58 58-180 180ZM358-598l-58-58 180-180 180 180-58 58-122-122-122 122Z"/></svg>' 
                iconPosition="end" 
                type="text" 
                name="product_title" 
                x-model="selectedProductTitle"
                placeholder="Search product" 
                aria-autocomplete="off" 
                autocomplete="off" 
                wire:model.live.debounce.300ms="product" 
            />
        </x-slot>
        <x-slot name="content">
            <div class="divide-y divide-gray-100 dark:divide-gray-600" wire:key="product-list-{{ time() }}">
                <ul id="product-list" role="listbox" class="py-1 text-gray-700 dark:text-gray-300 min-h-auto max-h-40 overflow-y-auto" aria-labelledby="dropdown">
                    @forelse($products as $product)
                        <li wire:key="product-{{ $product->id }}">
                            <a class="block w-full px-2 py-1 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out" 
                               onclick="setProduct({{ $product->id }}, '{{ addslashes($product->title) }}')"
                               href="javascript:void(0)">
                                <div class="w-full flex items-center justify-between">
                                    <div class="flex space-x-2 items-center">
                                        {{-- @if($product->image_s)
                                        <div class="h-8 overflow-hidden flex">
                                            <img src="{{ Storage::url($product->image_s) }}" alt="">
                                        </div>
                                        @endif --}}
                                        <p class="text-xs">{{ $product->title }}</p>
                                    </div>
                                    {{-- <div class="text-xs bg-teal-500 text-white py-0 px-1">
                                        Level {{ $product->level ?? '' }}
                                    </div> --}}
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-2 py-1 text-xs">No product found.</li>
                    @endforelse
                </ul>

                @if (count($products) > 0)
                    <div class="px-2 py-1" 
                        wire:key="product-pagination-{{ $products->currentPage() }}"
                        @click.stop 
                    >
                        {{ $products->links(data: ['scrollTo' => false]) }}
                    </div>
                @endif
            </div>
        </x-slot>
    </x-dropdown>

    <input type="hidden" name="product_id" x-model="selectedProductId" value="{{ $product_id }}" required>
    <x-admin.input-error :messages="$errors->get('product_id')" class="mt-2" />
</div>

<script>
    // alert('ips');
    document.addEventListener("DOMContentLoaded", function () {
        if (window.Livewire) {
            window.setProduct = function (id, title) {
                let categoryIdInput = document.querySelector('input[name="product_id"]');
                let categoryNameInput = document.querySelector('input[name="product_title"]');

                if (categoryIdInput) {
                    categoryIdInput.value = id;
                }
                if (categoryNameInput) {
                    categoryNameInput.value = title;
                }

                // Ensure Livewire is ready before emitting
                window.Livewire.hook('message.sent', () => {
                    Livewire.emit('setProduct', id, title);
                });
            };
        }
    });
</script>