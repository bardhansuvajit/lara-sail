<x-front.modal name="search-modal" maxWidth="6xl" focusable :show="request('show-search-tab') === 'true'">
    <div class="w-full max-h-full">
        @livewire('search-modal')
    </div>
</x-front.modal>