<div 
    x-data='{
        "selectedProductId": @json($product_id ?? 0),
        "selectedProductTitle": @json($product_title ?? ""),
        "keepOpen": false
    }' 
    wire:ignore.self 
    x-on:click.away="if (!keepOpen) { $dispatch('close-dropdown') }"
> <!-- Add wire:ignore.self to prevent full reload -->
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
            <div class="divide-y divide-gray-100 dark:divide-gray-600" wire:key="product-list">
                <ul class="py-1 text-gray-700 dark:text-gray-300 min-h-auto max-h-40 overflow-y-auto" aria-labelledby="dropdown">
                    @forelse($products as $product)
                        <li wire:key="product-{{ $product->id }}">
                            <a 
                                class="block w-full px-2 py-1 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out" 
                                onclick="setProduct({{ $product->id }}, '{{ $product->title }}')"
                                href="javascript: void(0)">
                                <div class="w-full flex items-center justify-between">
                                    <div class="flex space-x-2 items-center">
                                        {{-- @if($product['image_s']) <div class="h-8 overflow-hidden flex"><img src="{{ Storage::url($product['image_s']) }}" alt=""></div> @endif --}}
                                        <p class="text-xs">{{ $product['title'] }}</p>
                                    </div>

                                    <div class="text-xs bg-teal-500 text-white py-0 px-1">
                                        Level 
                                    </div>
                                </div>
                            </a>
                        </li>
                    @empty
                        <li class="px-2 py-1 text-xs">No product found.</li>
                    @endforelse
                </ul>

                {{-- {{$products->links()}} --}}
                <div class="px-2 py-1" wire:key="product-pagination" x-on:click="keepOpen = true; $nextTick(() => keepOpen = false)">
                    {{ $products->links(data: ['scrollTo' => false]) }} {{-- Added scrollTo: false to prevent jumping to top --}}
                </div>
            </div>
        </x-slot>
    </x-dropdown>

    <input type="hidden" name="product_id" x-model="selectedProductId" value="" required>
    <x-admin.input-error :messages="$errors->get('product_id')" class="mt-2" />
</div>

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Prevent dropdown close on pagination clicks
        document.addEventListener('click', function(e) {
            const paginationLinks = e.target.closest('[wire\\:click="previousPage"], [wire\\:click="nextPage"], [wire\\:click="gotoPage"]');
            if (paginationLinks) {
                e.stopPropagation();
            }
        });

        window.setProduct = function(id, title) {
            // Update hidden inputs
            document.querySelector('input[name="product_id"]').value = id;
            document.querySelector('input[name="product_title"]').value = title;
            
            // Update Livewire component
            Livewire.dispatch('setProduct', {id: id, title: title});
            
            // Close dropdown
            document.dispatchEvent(new CustomEvent('close-dropdown'));
        };
    });
</script>
@endsection
