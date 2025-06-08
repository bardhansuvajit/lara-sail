<x-front.modal name="confirm-address-delete" maxWidth="sm" vertical="middle" focusable>
    <div 
        class="p-6" 
        x-data="{ id: '', name: '', addressline1: '', addressline2: '', landmark: '', city: '', state: '', postalcode: '', country: '', deleteroute: '' }" 
        x-on:data-id.window="id = $event.detail"
        x-on:data-name.window="name = $event.detail"
        x-on:data-addressline1.window="addressline1 = $event.detail" 
        x-on:data-addressline2.window="addressline2 = $event.detail" 
        x-on:data-landmark.window="landmark = $event.detail" 
        x-on:data-city.window="city = $event.detail" 
        x-on:data-state.window="state = $event.detail" 
        x-on:data-postalcode.window="postalcode = $event.detail" 
        x-on:data-country.window="country = $event.detail" 
        x-on:data-deleteroute.window="deleteroute = $event.detail" 
    >
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure?') }}
        </h2>

        <p class="{{FD['text']}} text-gray-400 dark:text-gray-400">{{ __('You want to Remove this address?') }}</p>

        <div class="delete-product-data my-4">
            <div class="items-center dark:border-gray-600">
                <div class="flex items-center gap-4">
                    <div class="w-full">
                        <p class="inline-block text-xs {{FD['text-0']}} text-gray-900 hover:underline dark:text-white" x-text="name"></p>

                        <p class="{{FD['text']}} text-gray-400">
                            <span x-text="addressline1"></span>
                            <span x-text="addressline2"></span>
                            <template x-if="landmark">
                                ,<span x-text="landmark"></span>
                            </template>
                        </p>

                        <p class="{{FD['text']}} text-gray-400">
                            <span x-text="city"></span>
                            <span x-text="state"></span>
                            <span x-text="postalcode"></span>
                        </p>

                        <p class="{{FD['text']}} text-gray-400" x-text="country"></p>

                        {{-- <div class="flex space-x-2 mt-0.5">
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
                        </div> --}}
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

            <form :action="deleteroute" method="post">
                @csrf
                @method('DELETE')
                <x-admin.button
                    element="button"
                    type="submit"
                    tag="danger"
                    title="Delete"
                    x-on:click="$wire.deleteItem(id)"
                >
                    {{ __('Yes, Remove') }}
                </x-admin.button>
            </form>

        </div>
    </div>
</x-front.modal>