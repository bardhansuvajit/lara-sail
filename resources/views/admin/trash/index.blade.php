<x-admin-app-layout
    screen="md:w-full"
    title="{{ __('Trash') }}"
    :breadcrumb="[
        ['label' => 'Trash']
    ]"
>

    <section class="sm:rounded-lg overflow-hidden px-1 py-2">
        <div class="flex space-x-2 justify-end">
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
                                    <x-admin.input-select-option value="model" :selected="request()->input('sortBy') == 'model'"> {{ __('Model') }} </x-admin.input-select-option>
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
                    <tr class="h-8">
                        <th scope="col" class="px-2 py-1 text-start">ID</th>
                        <th scope="col" class="px-2 py-1">Data</th>
                        <th scope="col" class="px-2 py-1">Model</th>
                        <th scope="col" class="px-2 py-1">Time</th>
                        <th scope="col" class="px-2 py-1 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="border-b border-gray-100 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <th scope="row" class="px-2 py-1 text-gray-900 dark:text-white">
                                <p class="text-xs">{{ $item->id }}</p>
                            </th>
                            <td scope="row" class="px-2 py-1 text-gray-900 dark:text-white">
                                <div class="flex space-x-2 items-center">
                                    {{-- {{ dd($item->thumbnail) }} --}}
                                    @if($item->thumbnail) <div class="w-8 h-8 overflow-hidden flex"><img src="{{ Storage::url($item->thumbnail) }}" alt=""></div> @endif
                                    <div>
                                        <p class="text-xs font-bold">{{ $item->title }}</p>
                                        <p class="text-xs">
                                            <span class="text-gray-500">{{ $item->description }}</span>
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td scope="row" class="px-2 py-1 text-gray-900">
                                <p class="text-xs">
                                    <span class="text-gray-500">{{ $item->model }}</span>
                                </p>
                            </td>
                            <td scope="row" class="px-2 py-1 text-gray-900">
                                <p class="text-xs">
                                    <span class="text-gray-500">{{ $item->created_at }}</span>
                                </p>
                            </td>
                            <td scope="row" class="px-2 py-1 text-gray-500">
                                <div class="flex space-x-2 items-center justify-end">
                                    @if ($item->status == 'deleted')
                                        <x-admin.button
                                            element="a"
                                            tag="success"
                                            href="javascript: void(0)"
                                            x-data=""
                                            x-on:click.prevent="
                                                $dispatch('open-modal', 'confirm-restore'); 
                                                $dispatch('data-title', '{{ $item->title }}');
                                                $dispatch('set-restore-route', '{{ route('admin.developer.trash.restore', $item->id) }}')" >
                                            @slot('icon')
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M280-120q-33 0-56.5-23.5T200-200v-520q-17 0-28.5-11.5T160-760q0-17 11.5-28.5T200-800h160q0-17 11.5-28.5T400-840h160q17 0 28.5 11.5T600-800h160q17 0 28.5 11.5T800-760q0 17-11.5 28.5T760-720v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Zm160 234v126q0 17 11.5 28.5T480-320q17 0 28.5-11.5T520-360v-126l36 35q11 11 27.5 11t28.5-12q11-11 11-28t-11-28L508-612q-12-12-28-12t-28 12L348-508q-11 11-11.5 27.5T348-452q11 11 27.5 11.5T404-451l36-35Z"/></svg>
                                            @endslot
                                            {{ __('Restore') }}
                                        </x-admin.button>
                                    @else
                                        <p class="flex space-x-2 bg-gray-300 text-gray-800 dark:bg-gray-500 p-1 dark:text-white">
                                            <span class="w-4 h-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m382-354 339-339q12-12 28-12t28 12q12 12 12 28.5T777-636L410-268q-12 12-28 12t-28-12L182-440q-12-12-11.5-28.5T183-497q12-12 28.5-12t28.5 12l142 143Z"/></svg>
                                            </span>
                                            <span class="">Restored</span>
                                        </p>
                                    @endif
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
    </section>

    @include('admin.includes.restore-modal')
    @include('admin.includes.export-modal')

</x-admin-app-layout>
