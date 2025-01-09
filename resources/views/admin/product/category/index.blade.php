<x-admin-app-layout
    screen="md:w-full"
    title="{{ __('Product Category') }}"
    :breadcrumb="[
        ['label' => 'Product category']
    ]"
>

    <section class="sm:rounded-lg overflow-hidden px-1 py-2">
        {{-- add data --}}
        <div class="flex space-x-2 justify-end">
            <x-admin.button
                element="a"
                :href="route('admin.product.category.create')">
                @slot('icon')
                    <svg fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" /></svg>
                @endslot
                {{ __('Add data') }}
            </x-admin.button>

            <x-admin.button
                element="a"
                tag="secondary"
                href="javascript: void(0)"
                title="Import"
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'import');">
                @slot('icon')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-320v-326L336-542l-56-58 200-200 200 200-56 58-104-104v326h-80ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/></svg>
                @endslot
                {{ __('Import') }}
            </x-admin.button>

            <x-admin.button
                element="a"
                tag="secondary"
                href="javascript: void(0)"
                title="Import"
                x-data=""
                x-on:click.prevent="$dispatch('open-modal', 'export');">
                @slot('icon')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-320 280-520l56-58 104 104v-326h80v326l104-104 56 58-200 200ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/></svg>
                @endslot
                {{ __('Export') }}
            </x-admin.button>
        </div>
    </section>

    <section>
        {{-- filters --}}
        <form action="" method="get">
            <div class="grid grid-cols-10 gap-4 py-4">
                <div class="w-full col-span-2">
                    <div class="flex space-x-1 items-end">
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
                <div class="col-span-8 flex flex-row space-x-1 justify-end items-end">
                    <div class="basis-1/12">
                        <x-admin.input-label for="status" :value="__('Status')" />
                        <x-admin.input-select 
                            id="status" 
                            name="status" 
                            :title="request()->input('status') == '1' ? 'Active' : (request()->input('status') == '0' ? 'Disabled' : 'All')"
                        >
                            @slot('options')
                                <x-admin.input-select-option value=""> {{ __('All') }} </x-admin.input-select-option>
                                <x-admin.input-select-option value="1" :selected="request()->input('status') == '1'"> {{ __('Active') }} </x-admin.input-select-option>
                                <x-admin.input-select-option value="0" :selected="request()->input('status') == '0'"> {{ __('Disabled') }} </x-admin.input-select-option>
                            @endslot
                        </x-admin.input-select>
                    </div>

                    <div class="basis-1/5">
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
                        <th scope="col" class="p-2">
                            <div class="flex items-center">
                                <input id="checkbox-all" type="checkbox" class="w-4 h-4 text-primary-600 bg-gray-100 rounded border-gray-300 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="checkbox-all" class="sr-only">checkbox</label>
                            </div>
                        </th>
                        <th scope="col" class="px-2 py-1 text-start">ID</th>
                        <th scope="col" class="px-2 py-1">Title</th>
                        <th scope="col" class="px-2 py-1 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="border-b border-gray-100 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-2 w-2">
                                <div class="flex items-center">
                                    <input id="checkbox-table-search-{{ $item->id }}" type="checkbox" onclick="event.stopPropagation()" class="w-4 h-4 text-primary-600 bg-gray-100 rounded border-gray-300 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" form="bulActionForm" name="ids[]" value="{{ $item->id }}">
                                    <label for="checkbox-table-search-{{ $item->id }}" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <td scope="row" class="px-2 py-1 w-8 text-gray-900 dark:text-white">
                                <p class="text-xs">{{ $item->id }}</p>
                            </td>
                            <td scope="row" class="px-2 py-1 text-gray-900 dark:text-white">
                                <div class="flex space-x-4 items-center">
                                    <div class="text-xs">
                                        <p class="font-bold">{{ $item->title }}</p>
                                        <p class="">
                                            {{-- <span class="text-xs text-gray-400">Slug</span> --}}
                                            <span class="text-gray-500">{{ $item->slug }}</span>
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td scope="row" class="px-2 py-1 text-gray-500">
                                <div class="flex space-x-2 items-center justify-end">
                                    @livewire('toggle-status', [
                                        'model' => 'ProductCategory',
                                        'modelId' => $item->id,
                                    ])

                                    <x-admin.button-icon
                                        element="a"
                                        tag="secondary"
                                        href="javascript: void(0)"
                                        title="View"
                                        class="border"
                                        x-data=""
                                        x-on:click.prevent="
                                            $dispatch('open-sidebar', 'quick-data-view');
                                            $dispatch('data-title', '{{ $item->title }}');
                                            $dispatch('data-slug', '{{ $item->slug }}');
                                            $dispatch('data-level', '{{ $item->level }}');
                                        " >
                                        @slot('icon')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                                        @endslot
                                    </x-admin.button-icon>

                                    <x-admin.button-icon
                                        element="a"
                                        tag="secondary"
                                        :href="route('admin.product.category.edit', $item->id)"
                                        title="Edit"
                                        class="border" >
                                        @slot('icon')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                        @endslot
                                    </x-admin.button-icon>

                                    <x-admin.button-icon
                                        element="a"
                                        tag="danger"
                                        href="javascript: void(0)"
                                        x-data=""
                                        x-on:click.prevent="
                                            $dispatch('open-modal', 'confirm-data-deletion'); 
                                            $dispatch('data-title', '{{ $item->title }}');
                                            $dispatch('set-delete-route', '{{ route('admin.product.category.delete', $item->id) }}')" >
                                        @slot('icon')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                        @endslot
                                    </x-admin.button-icon>

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

        @if(count($data) > 0)
            {{ $data->onEachSide(3)->links() }}
        @endif
    </section>

    @include('admin.includes.delete-confirm-modal')
    @include('admin.includes.bulk-action-confirm-modal')
    @include('admin.includes.import-modal')
    @include('admin.includes.export-modal')

    <x-admin.sidebar name="quick-data-view" maxWidth="sm" direction="right" header="Quick View" focusable>
        <div 
            class="p-4"
            x-data="{title: '', slug: '', level: ''}"
            x-on:data-title.window="title = $event.detail"
            x-on:data-slug.window="slug = $event.detail"
            x-on:data-level.window="level = $event.detail"
        >
            <h5 class="text-xs font-bold mb-1">Title</h5>
            <p class="text-sm mb-3" x-text="title"></p>

            <h5 class="text-xs font-bold mb-1">Slug</h5>
            <p class="text-sm mb-3" x-text="slug"></p>

            <h5 class="text-xs font-bold mb-1">Level</h5>
            <p class="text-sm mb-3" x-text="level"></p>
        </div>
    </x-admin.sidebar>

</x-admin-app-layout>
