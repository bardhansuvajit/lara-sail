<x-modal name="confirm-bulk-action" maxWidth="sm" focusable>
    <div 
        class="p-6" 
        x-data="{desc: '', buttonText: '', buttonType: ''}"
        x-on:data-desc.window="desc = $event.detail" 
        x-on:data-button-text.window="buttonText = $event.detail" 
        x-on:data-button-type.window="buttonType = $event.detail" 
    >
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure?') }}
        </h2>

        {{-- <h5 x-text="title" class="text-gray-500 mt-5"></h5> --}}

        <p class="mt-1 text-xs text-gray-600 dark:text-gray-400" x-text="desc">
            {{-- {{ __('Once this data is deleted, it cannot be recovered') }} --}}
        </p>

        <div class="mt-6 flex justify-end">
            <x-admin.button 
                element="button" 
                tag="secondary" 
                href="javascript: void(0)" 
                title="Delete" 
                class="border" 
                x-on:click="$dispatch('close')" 
            >
                {{ __('Cancel') }}
            </x-admin.button>

            <form action="{{ route('admin.product.category.bulk') }}" method="post" id="bulActionForm" class="ms-3">
                @csrf
                <input type="hidden" name="action" id="bulkActionInput" />
                <x-admin.button 
                    element="button" 
                    x-bind:tag="buttonType" 
                    href="javascript: void(0)" 
                    title="Delete" 
                    x-text="buttonText"
                >
                    {{ __('Yes, Delete') }}
                </x-admin.button>
            </form>

        </div>
    </div>
</x-modal>