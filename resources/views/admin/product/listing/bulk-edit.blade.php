<x-admin-app-layout
    screen="md:w-full"
    title="{{ __('Edit Product Listing Bulk Edit') }}"
    :breadcrumb="[
        ['label' => 'Product listing', 'url' => route('admin.product.listing.index')],
        ['label' => 'Bulk Edit']
    ]"
>

    <section class="grid grid-cols-1 py-4">
        <div>
            <div class="overflow-x-auto mb-3">
                <form action="{{ route('admin.product.listing.bulk.update') }}" method="post">@csrf
                    <table class="w-full text-xs text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                            <tr class="h-8">
                                <th scope="col" class="px-2 py-1 text-start">ID</th>
                                <th scope="col" class="px-2 py-1">Title</th>
                                <th scope="col" class="px-2 py-1">Slug</th>
                                {{-- <th scope="col" class="px-2 py-1 text-end">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $item)
                                <tr class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                                    <td scope="row" class="px-2 py-1 w-8 text-gray-900 dark:text-white">
                                        <p class="text-xs">{{ $item->id }}</p>
                                        <input type="hidden" name="id[]" value="{{ $item->id }}">
                                    </td>
                                    <td scope="row" class="px-2 py-1">
                                        <div>
                                            <x-admin.text-input id="title" class="block !text-[12px] !h-[1.8rem]" type="text" name="title[]" :value="$item->title" placeholder="Enter title" />
                                            <x-admin.input-error :messages="$errors->get('title')" class="mt-2" />
                                        </div>
                                    </td>
                                    <td scope="row" class="px-2 py-1">
                                        <div>
                                            <x-admin.text-input id="slug" class="block !text-[12px] !h-[1.8rem]" type="text" name="slug[]" :value="$item->slug" placeholder="Enter slug" />
                                            <x-admin.input-error :messages="$errors->get('slug')" class="mt-2" />
                                        </div>
                                    </td>
                                    {{-- <td scope="row" class="px-2 py-1 text-gray-500">
                                        <div class="flex space-x-2 items-center justify-end">
                                            @livewire('toggle-status', [
                                                'model' => 'Product',
                                                'modelId' => $item->id,
                                            ])
        
                                            <x-admin.button-icon
                                                element="a"
                                                tag="secondary"
                                                :href="route('admin.product.listing.edit', $item->id)"
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
                                                    $dispatch('set-delete-route', '{{ route('admin.product.listing.delete', $item->id) }}')" >
                                                @slot('icon')
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                                @endslot
                                            </x-admin.button-icon>
        
                                        </div>
                                    </td> --}}
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

                    <div class="items-center space-x-4 flex mt-4 mb-5 p-4 sticky bottom-5 rounded shadow border bg-white dark:border-gray-700 dark:bg-gray-800">
                        <x-admin.button
                            type="submit"
                            element="button">
                            @slot('icon')
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M840-680v480q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160Zm-80 34L646-760H200v560h560v-446ZM480-240q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35ZM240-560h360v-160H240v160Zm-40-86v446-560 114Z"/></svg>
                            @endslot
                            {{ __('Save data') }}
                        </x-admin.button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    @include('admin.includes.delete-confirm-modal')
</x-admin-app-layout>

{{-- @vite([
    'resources/js/rte-script.js'
]) --}}
