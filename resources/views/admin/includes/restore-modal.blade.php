<x-admin.modal name="confirm-restore" maxWidth="sm" focusable>
    <div 
        class="p-6" 
        x-data="{ restoreRoute: '', title: '' }" 
        x-on:set-restore-route.window="restoreRoute = $event.detail" 
        x-on:data-title.window="title = $event.detail"
    >
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure?') }}
        </h2>

        <h5 x-text="title" class="text-gray-500 mt-5"></h5>

        <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">
            {{ __('Once this data is restored, it can be found in the exact model') }}
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

            <form :action="restoreRoute" method="GET" class="ms-3">
                @csrf
                <x-admin.button
                    element="button"
                    tag="success"
                    href="javascript: void(0)"
                    title="Restore"
                >
                    {{ __('Yes, Restore') }}
                </x-admin.button>
            </form>
        </div>
    </div>
</x-admin.modal>