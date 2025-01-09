<x-modal name="import" maxWidth="sm" :show="$errors->userDeletion->isNotEmpty()" show="true">
    <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
        @csrf

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Import data?') }}
        </h2>

        <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">
            {!! __('Select &amp; Upload file to Import data. Download the <strong><em>Sample CSV file</em></strong> &amp; import') !!}
        </p>

        <div class="mt-6">
            <x-admin.input-label for="file" :value="__('Select file')" />
            <x-admin.file-input id="file" name="file" accept=".csv, .xls" />
            <x-admin.input-error :messages="$errors->get('file')" class="mt-2" />
        </div>

        <div class="mt-4">
            <a href="{{ route('admin.csv-template.download', 'ProductCategory') }}" class="font-extralight text-primary-700 hover:text-primary-900 dark:text-primary-100 dark:hover:text-primary-200 text-xs inline-flex" target="_blank">
                <svg class="w-4 h-4 me-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-337q-8 0-15-2.5t-13-8.5L308-492q-12-12-11.5-28t11.5-28q12-12 28.5-12.5T365-549l75 75v-286q0-17 11.5-28.5T480-800q17 0 28.5 11.5T520-760v286l75-75q12-12 28.5-11.5T652-548q11 12 11.5 28T652-492L508-348q-6 6-13 8.5t-15 2.5ZM240-160q-33 0-56.5-23.5T160-240v-80q0-17 11.5-28.5T200-360q17 0 28.5 11.5T240-320v80h480v-80q0-17 11.5-28.5T760-360q17 0 28.5 11.5T800-320v80q0 33-23.5 56.5T720-160H240Z"/></svg>

                {{ __('Download Sample CSV') }}
            </a>
        </div>

        <div class="mt-4 flex justify-end">
            <x-admin.button
                element="a"
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
                tag="primary"
                type="submit"
                title="Import"
                class="ms-3">
                @slot('icon')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-320v-326L336-542l-56-58 200-200 200 200-56 58-104-104v326h-80ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/></svg>
                @endslot
                {{ __('Import') }}
            </x-admin.button>
        </div>
    </form>
</x-modal>