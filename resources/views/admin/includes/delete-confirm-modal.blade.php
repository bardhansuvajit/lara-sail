<x-modal name="confirm-data-deletion" maxWidth="sm" focusable>
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
</x-modal>