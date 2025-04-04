<x-admin-app-layout
    screen="md:w-full"
    title="{{ __('Product Feature') }}"
    :breadcrumb="[
        ['label' => 'Product feature']
    ]"
>

    <section class="sm:rounded-lg overflow-hidden px-1 py-2">
        <div class="grid grid-cols-3 gap-4">
            <div class="col-span-2">
                <h5 class="text-xs font-medium">Featured List will be displayed in Homepage, Cart page, Checkout page, Account page as Featured products</h5>
                {{-- <div class="mt-3 border-t border-gray-200 dark:border-gray-700"></div> --}}

                @livewire('feature-product-setup')
            </div>

            <div class="col-span-1">
                {{-- <h5 class="text-base font-medium">Product List</h5>
                <div class="mt-3 border-t border-gray-200 dark:border-gray-700"></div> --}}
                {{-- filters --}}
                <form action="" method="get">
                    <div class="grid grid-cols-1 gap-4 py-4">
                        <div class="w-full">
                            <div class="flex space-x-1 items-end">
                                <div class="w-max">
                                    <x-admin.input-label for="perPage" :value="__('Show')" />
                                    <x-admin.input-select 
                                        id="perPage" 
                                        name="perPage" 
                                        :title="request()->input('perPage')"
                                    >
                                        @slot('options')
                                            <x-admin.input-select-option value="15" :selected="request()->input('perPage') == 15"> 15 </x-admin.input-select-option>
                                            <x-admin.input-select-option value="25" :selected="request()->input('perPage') == 25"> 25 </x-admin.input-select-option>
                                            <x-admin.input-select-option value="50" :selected="request()->input('perPage') == 50"> 50 </x-admin.input-select-option>
                                            <x-admin.input-select-option value="100" :selected="request()->input('perPage') == 100"> 100 </x-admin.input-select-option>
                                            <x-admin.input-select-option value="all" :selected="request()->input('perPage') == 'all'"> All </x-admin.input-select-option>
                                        @endslot
                                    </x-admin.input-select>
                                </div>

                                <div class="w-max">
                                    <x-admin.input-label for="sortBy" :value="__('Sort by')" />
                                    <x-admin.input-select 
                                        id="sortBy" 
                                        name="sortBy"
                                        :title="request()->input('sortBy') == 'id' ? 'ID' : (request()->input('sortBy') == 'title' ? 'Title' : 'ID')"
                                    >
                                        @slot('options')
                                            <x-admin.input-select-option value="id" :selected="request()->input('sortBy') == 'id'"> {{ __('ID') }} </x-admin.input-select-option>
                                            <x-admin.input-select-option value="title" :selected="request()->input('sortBy') == 'title'"> {{ __('Title') }} </x-admin.input-select-option>
                                        @endslot
                                    </x-admin.input-select>
                                </div>

                                <div class="w-max">
                                    <x-admin.input-label for="sortOrder" :value="__('Order by')" />
                                    <x-admin.input-select 
                                        id="sortOrder" 
                                        name="sortOrder"
                                        :title="request()->input('sortOrder') == 'asc' ? 'ASC' : (request()->input('sortOrder') == 'desc' ? 'DESC' : 'DESC')"
                                    >
                                        @slot('options')
                                            <x-admin.input-select-option value="asc" :selected="request()->input('sortOrder') == 'asc'"> {{ __('ASC') }} </x-admin.input-select-option>
                                            <x-admin.input-select-option value="desc" :selected="request()->input('sortOrder') == 'desc'"> {{ __('DESC') }} </x-admin.input-select-option>
                                        @endslot
                                    </x-admin.input-select>
                                </div>

                                <div class="w-max hidden" id="bulkAction">
                                    <div class="flex space-x-1">
                                        <x-admin.button-icon
                                            element="button"
                                            type="submit"
                                            tag="secondary"
                                            href="javascript: void(0)"
                                            title="Archive"
                                            class="border"
                                            form="bulActionForm"
                                            x-data=""
                                            x-on:click.prevent="
                                                $dispatch('open-modal', 'confirm-bulk-action');
                                                $dispatch('data-desc', 'Are you sure you want to Archive selected data?');
                                                $dispatch('data-button-text', 'Yes, Archive');
                                                document.getElementById('bulkActionInput').value = 'archive';
                                            ">
                                            @slot('icon')
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m480-240 160-160-56-56-64 64v-168h-80v168l-64-64-56 56 160 160ZM200-640v440h560v-440H200Zm0 520q-33 0-56.5-23.5T120-200v-499q0-14 4.5-27t13.5-24l50-61q11-14 27.5-21.5T250-840h460q18 0 34.5 7.5T772-811l50 61q9 11 13.5 24t4.5 27v499q0 33-23.5 56.5T760-120H200Zm16-600h528l-34-40H250l-34 40Zm264 300Z"/></svg>
                                            @endslot
                                        </x-admin.button-icon>

                                        <x-admin.button-icon
                                            element="button"
                                            type="submit"
                                            tag="secondary"
                                            href="javascript: void(0)"
                                            title="Delete"
                                            class="border"
                                            form="bulActionForm"
                                            x-data=""
                                            x-on:click.prevent="
                                                $dispatch('open-modal', 'confirm-bulk-action');
                                                $dispatch('data-desc', 'Are you sure you want to Delete selected data?');
                                                $dispatch('data-button-text', 'Yes, Delete');
                                                $dispatch('set-route', '{{ route('admin.product.listing.bulk') }}');
                                                document.getElementById('bulkActionInput').value = 'delete';
                                            ">
                                            @slot('icon')
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                            @endslot
                                        </x-admin.button-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-row space-x-1 items-end">
                            <div class="basis-1/12">
                                <x-admin.input-label for="status" :value="__('Status')" />
                                <x-admin.input-select 
                                    id="status" 
                                    name="status" 
                                    :title="request()->input('status') == '1' ? 'Active' : (request()->input('status') == '0' ? 'Disabled' : 'All')"
                                >
                                    @slot('options')
                                        <x-admin.input-select-option value=""> {{ __('All') }} </x-admin.input-select-option>
                                        <x-admin.input-select-option value="1" :selected="request()->input('status', '1') == '1'"> {{ __('Active') }} </x-admin.input-select-option>
                                        <x-admin.input-select-option value="0" :selected="request()->input('status') == '0'"> {{ __('Disabled') }} </x-admin.input-select-option>
                                    @endslot
                                </x-admin.input-select>
                            </div>

                            <div class="basis-1/2">
                                <x-admin.input-label for="keyword" :value="__('Search by')" />
                                <x-admin.text-input id="keyword" class="" type="text" name="keyword" :value="request()->input('keyword')" placeholder="Keywords..." />
                            </div>

                            <x-admin.button
                                element="button"
                                type="submit">
                                @slot('icon')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                                @endslot
                                {{ __('Search') }}
                            </x-admin.button>

                            <x-admin.button
                                element="a"
                                tag="secondary"
                                :href="url()->current()">
                                @slot('icon')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m336-280 144-144 144 144 56-56-144-144 144-144-56-56-144 144-144-144-56 56 144 144-144 144 56 56ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/></svg>
                                @endslot
                                {{ __('Clear') }}
                            </x-admin.button>
                        </div>
                    </div>
                </form>

                {{-- table --}}
                <div class="overflow-x-auto mb-3">
                    <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-2 py-1 text-start">ID</th>
                                <th scope="col" class="px-2 py-1">Title</th>
                                <th scope="col" class="px-2 py-1 text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr class="border-b border-gray-100 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td scope="row" class="px-2 py-1 w-8 text-gray-900 dark:text-white">
                                        <p class="text-xs">{{ $item->id }}</p>
                                    </td>
                                    <td scope="row" class="px-2 py-1 text-gray-900 dark:text-white">
                                        <div class="flex space-x-2 items-center">
                                            @if($item->image_s) <div class="h-10 overflow-hidden flex"><img src="{{ Storage::url($item->image_s) }}" alt=""></div> @endif
                                            <div>
                                                <a href="{{ route('admin.product.listing.edit', $item->id) }}" target="_blank" class="text-xs font-bold underline hover:no-underline">{{ $item->title }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td scope="row" class="px-2 py-1 text-gray-500">
                                        <div class="flex space-x-2 items-center justify-end">
                                            {{-- {{ $item->featured->id }} --}}
                                            @livewire('toggle-featured-product', [
                                                // 'model' => 'Product',
                                                'featureId' => $item->featured,
                                            ])

                                            <div class="text-xs font-bold {{$item->status == 1 ? 'text-green-500' : 'text-gray-500'}}">
                                                {{$item->status == 1 ? 'Active' : 'Disabled'}}
                                            </div>

                                            {{-- <x-admin.button-icon
                                                element="a"
                                                target="_blank"
                                                tag="secondary"
                                                :href="route('admin.product.listing.edit', $item->id)"
                                                title="Edit"
                                                class="border" >
                                                @slot('icon')
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                                @endslot
                                            </x-admin.button-icon> --}}

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="border-b dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td colspan="100%" class="w-full text-center text-gray-400 font-medium py-3">
                                        <em>No records found</em>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($data instanceof \Illuminate\Contracts\Pagination\Paginator && $data->hasPages())
                    {{ $data->onEachSide(3)->links() }}
                @endif
            </div>
        </div>
    </section>

    <x-admin.sidebar name="quick-data-view" maxWidth="sm" direction="right" header="Quick View" focusable>
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
    </x-admin.sidebar>

</x-admin-app-layout>
