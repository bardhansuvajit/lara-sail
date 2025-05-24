<x-front.modal name="confirm-livewire-cart-item-deletion" maxWidth="sm" vertical="middle" focusable>
    <div 
        class="p-6" 
        x-data="{ id: '', title: '', url: '', attributes: '', sellingPrice: '', mrp: '', discount: '', imagePath: '' }" 
        x-on:data-id.window="id = $event.detail"
        x-on:data-title.window="title = $event.detail"
        x-on:data-url.window="url = $event.detail" 
        x-on:data-attributes.window="attributes = $event.detail" 
        x-on:data-selling-price.window="sellingPrice = $event.detail" 
        x-on:data-mrp.window="mrp = $event.detail" 
        x-on:data-discount.window="discount = $event.detail" 
        x-on:data-image-path.window="imagePath = $event.detail" 
    >
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure you want to remove this item?') }}
        </h2>

        <div class="delete-product-data my-4">
            <div class="items-center dark:border-gray-600">
                <div class="flex items-center gap-4">
                    <a :href="url" class="flex aspect-[1/1] h-9 flex-shrink-0 items-center">
                        <template x-if="imagePath">
                            <img :src="imagePath" :alt="title" class="h-full w-full object-cover" />
                        </template>

                        <template x-if="!imagePath">
                            <div class="h-full w-full flex items-center justify-center">
                                {!! FD['brokenImageFront'] !!}
                            </div>
                        </template>
                    </a>
                    <div class="w-full">
                        <a :href="url" class="inline-block text-xs {{FD['text-0']}} text-gray-900 hover:underline dark:text-white" x-text="title"></a>

                        <p class="{{FD['text-0']}} text-gray-400" x-text="attributes"></p>

                        <div class="flex space-x-2 mt-0.5">
                            <p class="{{FD['text']}} font-normal text-gray-500 dark:text-gray-300">
                                <span class="currency-symbol">{{COUNTRY['icon']}}</span> <span x-text="sellingPrice"></span>
                            </p>

                            <template x-if="mrp">
                                <p class="{{FD['text']}} font-normal text-gray-400 dark:text-gray-400 line-through">
                                    <span class="currency-symbol">{{COUNTRY['icon']}}</span> <span x-text="mrp"></span>
                                </p>
                            </template>
                            <template x-if="mrp">
                                <p class="{{FD['text']}} font-bold {{FD['activeClass']}}">
                                    <span x-text="discount"></span>% off
                                </p>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex gap-2 justify-end">
            <x-admin.button
                element="button"
                type="button"
                tag="secondary"
                title="Cancel"
                class="border"
                x-on:click="$dispatch('close')"
            >
                {{ __('Cancel') }}
            </x-admin.button>

            <x-admin.button
                element="button"
                type="button"
                tag="danger"
                title="Delete"
                x-on:click="$wire.deleteItem(id)"
            >
                {{ __('Yes, Remove') }}
            </x-admin.button>
        </div>
    </div>
</x-front.modal>