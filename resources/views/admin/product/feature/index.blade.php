<x-admin-app-layout
    screen="md:w-full"
    title="{{ __('Feature') }}"
    :breadcrumb="[
        ['label' => 'Feature']
    ]"
>

    <section class="sm:rounded-lg overflow-hidden px-1 py-2">
        <div class="grid grid-cols-3 gap-4">

            <div class="col-span-2">
                {{-- Featured Products --}}
                @livewire('feature-product-setup')
            </div>

            <div class="col-span-1">
                {{-- All Products List --}}
                @livewire('product-list')
            </div>
        </div>
    </section>
</x-admin-app-layout>
