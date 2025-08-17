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

    {{-- <x-admin.sidebar name="quick-data-view" maxWidth="sm" direction="right" header="Quick View" focusable>
        <div 
            class="p-4"
            x-data="{image: '', title: '', slug: '', level: ''}"
            x-on:data-image.window="image = $event.detail"
            x-on:data-title.window="title = $event.detail"
            x-on:data-slug.window="slug = $event.detail"
            x-on:data-level.window="level = $event.detail"
        >
            <h5 class="text-xs font-bold mb-1">Image</h5>
            <div>
                <template x-if="image && image.trim() !== ''">
                    <div class="h-50 mb-3">
                        <img :src="'{{ Storage::url('') }}' + image" alt="Image" class="h-full w-auto" />
                    </div>
                </template>
                <template x-if="!image || image.trim() === ''">
                    <p class="text-sm mb-3 text-orange-500 font-bold">NA</p>
                </template>
            </div>

            <h5 class="text-xs font-bold mb-1">Title</h5>
            <p class="text-sm mb-3" x-text="title"></p>

            <h5 class="text-xs font-bold mb-1">Slug</h5>
            <p class="text-sm mb-3" x-text="slug"></p>

            <h5 class="text-xs font-bold mb-1">Level</h5>
            <p class="text-sm mb-3" x-text="level"></p>
        </div>
    </x-admin.sidebar> --}}

</x-admin-app-layout>
