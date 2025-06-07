<x-front.modal name="confirm-cart-item-deletion" maxWidth="sm" vertical="middle" focusable>
    <div class="p-6">
        <h2 class="text-center text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure?') }}
        </h2>

        <div class="delete-product-data my-4"></div>

        <form action="" method="POST" class="mt-6 flex gap-2 justify-center" id="delete-cart-item-form">
            <input type="hidden" name="type" id="cart-item-type" value="delete">

            <x-admin.button
                element="button"
                type="button"
                tag="secondary"
                href="javascript: void(0)"
                title="Cancel"
                class="border"
                x-on:click="$dispatch('close')"
            >
                {{ __('Cancel') }}
            </x-admin.button>

            <x-admin.button
                element="button"
                type="button"
                tag="secondary"
                title="Save for later"
                onclick="document.getElementById('cart-item-type').value = 'save';document.getElementById('delete-cart-item-form').requestSubmit();"
            >
                @slot('icon')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120q-33 0-56.5-23.5T120-200v-499q0-14 4.5-27t13.5-24l50-61q11-14 27.5-21.5T250-840h460q18 0 34.5 7.5T772-811l50 61q9 11 13.5 24t4.5 27v499q0 33-23.5 56.5T760-120H200Zm16-600h528l-34-40H250l-34 40Zm264 160q-17 0-28.5 11.5T440-520v128l-36-36q-11-11-28-11t-28 11q-11 11-11 28t11 28l104 104q12 12 28 12t28-12l104-104q11-11 11-28t-11-28q-11-11-28-11t-28 11l-36 36v-128q0-17-11.5-28.5T480-560Z"/></svg>
                @endslot
                {{ __('Save for later') }}
            </x-admin.button>

            <x-admin.button
                element="button"
                type="submit"
                tag="danger"
                title="Delete"
                onclick="document.getElementById('cart-item-type').value = 'delete'"
            >
                {{ __('Yes, Remove') }}
            </x-admin.button>
        </form>
    </div>
</x-front.modal>