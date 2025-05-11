<x-front.dropdown width="96">
    <x-slot name="trigger">
        <button type="button" class="hidden sm:inline-flex items-center {{FD['rounded']}} justify-center p-2 hover:bg-gray-100 {{FD['text']}} font-medium leading-tight dark:text-white dark:hover:bg-gray-700/100" id="cart-btn">
            <svg class="w-4 h-4 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"></path></svg>

            <span class="hidden lg:block me-1.5">
                <span class="cart-count"></span>
            </span>
            {{-- (<span class="currency-symbol">₹</span>106.7) --}}

            {!! FD['dropdownCaret'] !!}
        </button>
    </x-slot>
    <x-slot name="content">
        <div class="z-50 mx-auto divide-y-2 overflow-hidden {{FD['rounded']}} bg-white antialiased dark:divide-gray-600/50 dark:bg-gray-700" @click.stop>
            <div class="p-4">
                <dl class="flex items-center gap-2">
                    <dt class="font-medium {{FD['text-1']}} leading-tight dark:text-white">Your shopping cart</dt>
                </dl>
            </div>

            <div class="cart-products"></div>

            <div class="cart-redirect"></div>
        </div>
    </x-slot>
</x-front.dropdown>

<x-front.modal name="confirm-cart-item-deletion" maxWidth="sm" focusable>
    <div 
        class="p-6" 
        x-data="{ deleteRoute: '', title: '' }" 
        x-on:set-delete-route.window="deleteRoute = $event.detail" 
        x-on:data-title.window="title = $event.detail"
    >
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure?') }}
        </h2>

        <h5 x-text="title" class="text-gray-500 mt-5"></h5>

        <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">
            {{ __('Once this data is deleted, it cannot be recovered') }}
        </p>

        <div class="mt-6 flex justify-end">
            <x-admin.button
                element="button"
                tag="secondary"
                href="javascript: void(0)"
                title="Cancel"
                class="border"
                x-on:click="$dispatch('close')"
            >
                {{ __('Cancel') }}
            </x-admin.button>

            <form :action="deleteRoute" method="POST" class="ms-3">
                @csrf
                @method('DELETE')
                <x-admin.button
                    element="button"
                    tag="danger"
                    href="javascript: void(0)"
                    title="Delete"
                >
                    {{ __('Yes, Delete') }}
                </x-admin.button>
            </form>
        </div>
    </div>
</x-front.modal>

@push('scripts')
<script>
    setTimeout(() => {
        document.querySelector('#cart-btn').click()
    }, 100);
</script>
@endpush