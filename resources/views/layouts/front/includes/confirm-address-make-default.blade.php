<x-front.modal name="confirm-address-make-default" maxWidth="sm" vertical="middle" focusable>
    <div 
        class="p-4 md:p-6" 
        x-data="{ id: '', name: '', addressline1: '', addressline2: '', landmark: '', city: '', state: '', postalcode: '', country: '', makedefaultroute: '' }" 
        x-on:data-id.window="id = $event.detail"
        x-on:data-name.window="name = $event.detail"
        x-on:data-addressline1.window="addressline1 = $event.detail" 
        x-on:data-addressline2.window="addressline2 = $event.detail" 
        x-on:data-landmark.window="landmark = $event.detail" 
        x-on:data-city.window="city = $event.detail" 
        x-on:data-state.window="state = $event.detail" 
        x-on:data-postalcode.window="postalcode = $event.detail" 
        x-on:data-country.window="country = $event.detail" 
        x-on:data-makedefaultroute.window="makedefaultroute = $event.detail" 
    >
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure?') }}
        </h2>

        <p class="{{FD['text']}} text-gray-400 dark:text-gray-400">{{ __('You want to Set this as Default Delivery Address?') }}</p>

        <div class="delete-product-data my-4">
            <div class="items-center dark:border-gray-600">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 text-slate-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M600-800H360v280h240v-280Zm200 0H680v280h120v-280ZM575-440H320v240h222q21 0 40.5-7t35.5-21l166-137q-8-8-18-12t-21-6q-17-3-33 1t-30 15l-108 87H400v-80h146l44-36q5-3 7.5-8t2.5-11q0-10-7.5-17.5T575-440Zm-335 0h-80v280h80v-280Zm40 0v-360q0-33 23.5-56.5T360-880h440q33 0 56.5 23.5T880-800v280q0 33-23.5 56.5T800-440H280ZM240-80h-80q-33 0-56.5-23.5T80-160v-280q0-33 23.5-56.5T160-520h415q85 0 164 29t127 98l27 41-223 186q-27 23-60 34.5T542-120H309q-11 18-29 29t-40 11Z"/></svg>
                    </div>
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
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex gap-2 justify-end">
            <x-front.button
                element="button"
                type="button"
                tag="secondary"
                title="Cancel"
                class="border"
                x-on:click="$dispatch('close')"
            >
                {{ __('Cancel') }}
            </x-front.button>

            <form :action="makedefaultroute">
                @csrf
                <x-front.button
                    element="button"
                    type="submit"
                    tag="success"
                    title="Make Default Address"
                    x-on:click="$wire.deleteItem(id)"
                >
                    {{ __('Yes, Make this Default Address') }}
                </x-front.button>
            </form>

        </div>
    </div>
</x-front.modal>