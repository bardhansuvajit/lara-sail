<x-admin-app-layout
    screen="md:w-full"
    title="{{ __('User') }}"
    :breadcrumb="[
        ['label' => 'User']
    ]"
>

    <section class="sm:rounded-lg overflow-hidden px-1 py-2">
        {{-- add data --}}
        <div class="flex space-x-2 justify-end">
            <x-admin.button
                element="a"
                :href="route('admin.user.create')">
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
                id="importButton" 
                x-on:click.prevent="
                    $dispatch('open-modal', 'import');
                    $dispatch('set-model', 'User');
                    $dispatch('set-route', '{{ route('admin.user.import') }}');
                ">
                @slot('icon')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-320v-326L336-542l-56-58 200-200 200 200-56 58-104-104v326h-80ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/></svg>
                @endslot
                {{ __('Import') }}
            </x-admin.button>

            <x-admin.button 
                element="a" 
                tag="secondary" 
                href="javascript: void(0)" 
                title="Export" 
                x-data="" 
                id="exportButton" 
                x-on:click.prevent="
                    $dispatch('open-modal', 'export');
                    $dispatch('set-route', '{{ route('admin.user.export', 'csv') }}');
                ">
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
                                    <x-admin.input-select-option value="first_name" :selected="request()->input('sortBy') == 'first_name'"> {{ __('First Name') }} </x-admin.input-select-option>
                                    <x-admin.input-select-option value="last_name" :selected="request()->input('sortBy') == 'last_name'"> {{ __('Last Name') }} </x-admin.input-select-option>
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
                                        $dispatch('set-route', '{{ route('admin.user.bulk') }}');
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
                    <div class="basis-1/8">
                        <x-admin.input-label for="country_code" :value="__('Country')" />
                        <x-admin.input-select 
                            id="country_code" 
                            name="countryCode" 
                            :title="request()->input('countryCode')"
                            {{-- :title="request()->input('countryCode') == '1' ? 'Active' : (request()->input('status') == '0' ? 'Disabled' : 'All')" --}}
                        >
                            @slot('options')
                                <x-admin.input-select-option value=""> {{ __('All') }} </x-admin.input-select-option>
                                @foreach ($activeCountries as $country)
                                    <x-admin.input-select-option value="{{$country->short_name}}" :selected="request()->input('countryCode') == $country->short_name"> {{$country->short_name}} </x-admin.input-select-option>
                                @endforeach
                                {{-- <x-admin.input-select-option value=""> {{ __('All') }} </x-admin.input-select-option>
                                <x-admin.input-select-option value="1" :selected="request()->input('status') == '1'"> {{ __('Active') }} </x-admin.input-select-option>
                                <x-admin.input-select-option value="0" :selected="request()->input('status') == '0'"> {{ __('Disabled') }} </x-admin.input-select-option> --}}
                            @endslot
                        </x-admin.input-select>
                    </div>

                    <div class="basis-1/8">
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
                        <th scope="col" class="p-2">
                            <x-admin.input-checkbox id="checkbox-all" />
                        </th>
                        <th scope="col" class="px-2 py-1 text-start">ID</th>
                        <th scope="col" class="px-2 py-1">Name</th>
                        <th scope="col" class="px-2 py-1">Country</th>
                        <th scope="col" class="px-2 py-1">Contact</th>
                        <th scope="col" class="px-2 py-1 text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr class="border-b border-gray-100 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="p-2 w-2">
                                <x-admin.input-checkbox 
                                    class="w-[1.2rem]"
                                    id="checkbox-table-search-{{ $item->id }}"
                                    onclick="event.stopPropagation()"
                                    form="bulActionForm" 
                                    name="ids[]" 
                                    value="{{ $item->id }}" />
                            </td>
                            <th scope="row" class="px-2 py-1 text-gray-900 dark:text-white">
                                <p class="text-xs">{{ $item->id }}</p>
                            </th>
                            <td scope="row" class="px-2 py-1 text-gray-900 dark:text-white">
                                <p class="text-xs font-bold">{{ $item->first_name }} {{ $item->last_name }}</p>
                            </td>
                            <td scope="row" class="px-2 py-1 text-gray-500">
                                <div class="flex space-x-2 items-center">
                                    @if($item->country->flag) <div class="w-8 h-8 overflow-hidden flex">{!! $item->country->flag !!}</div> @endif
                                    <div>
                                        <p class="text-xs">{{ $item->country->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td scope="row" class="px-2 py-1 text-gray-500 dark:text-gray-300">
                                <p class="text-xs">{{ $item->primary_phone_no }}</p>
                                <p class="text-xs">{{ $item->email }}</p>
                            </td>
                            <td scope="row" class="px-2 py-1 text-gray-500">
                                <div class="flex space-x-2 items-center justify-end">
                                    @livewire('toggle-status', [
                                        'model' => 'User',
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
                                            $dispatch('data-flag', '{{ $item->country->flag }}');
                                            $dispatch('data-profile_picture', '{{ $item->profile_picture }}');
                                            $dispatch('data-country', '{{ $item->country->name }}');
                                            $dispatch('data-name', '{{ $item->first_name.' '.$item->last_name }}');
                                            $dispatch('data-primary_phone_no', '{{ $item->primary_phone_no }}');
                                            $dispatch('data-email', '{{ $item->email }}');
                                            $dispatch('data-gender', '{{ genderString($item->gender_id) }}');
                                            $dispatch('data-alt_phone_no', '{{ $item->alt_phone_no }}');
                                            $dispatch('data-date_of_birth', '{{ $item->date_of_birth }}');
                                            $dispatch('data-is_blacklisted', '{{ $item->is_blacklisted }}');
                                            $dispatch('data-status', '{{ $item->status }}');
                                        " >
                                        @slot('icon')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                                        @endslot
                                    </x-admin.button-icon>

                                    <x-admin.button-icon
                                        element="a"
                                        tag="secondary"
                                        :href="route('admin.user.edit', $item->id)"
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
                                            $dispatch('set-delete-route', '{{ route('admin.user.delete', $item->id) }}')" >
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

        @if($data instanceof \Illuminate\Contracts\Pagination\Paginator && $data->hasPages())
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
            x-data="{flag: '', profile_picture: '', name: '', country: '', primary_phone_no: '', email: '', gender: '', alt_phone_no: '', date_of_birth: '', is_blacklisted: '', status: ''}"
            x-on:data-flag.window="flag = $event.detail"
            x-on:data-profile_picture.window="profile_picture = $event.detail"
            x-on:data-name.window="name = $event.detail"
            x-on:data-country.window="country = $event.detail"
            x-on:data-primary_phone_no.window="primary_phone_no = $event.detail"
            x-on:data-email.window="email = $event.detail"
            x-on:data-gender.window="gender = $event.detail"
            x-on:data-alt_phone_no.window="alt_phone_no = $event.detail"
            x-on:data-date_of_birth.window="date_of_birth = $event.detail"
            x-on:data-is_blacklisted.window="is_blacklisted = $event.detail"
            x-on:data-status.window="status = $event.detail"
        >
            <h5 class="text-xs font-bold mb-1 text-gray-500 dark:text-gray-400">Country</h5>
            {{-- <div x-data="{ flag: $store.item.flag }"> --}}
                <template x-if="flag">
                    <div class="w-8 h-8" x-html="flag"></div>
                </template>
                <template x-if="!flag">
                    <p class="text-sm text-orange-500 font-bold">NA</p>
                </template>
                <p class="text-sm mb-3 text-gray-900 dark:text-gray-100" x-text="country"></p>
            {{-- </div> --}}

            <h5 class="text-xs font-bold mb-1 text-gray-500 dark:text-gray-400">Name</h5>
            {{-- <div x-data="{ profile_picture: $store.item.profile_picture }"> --}}
                <template x-if="profile_picture">
                    <img :src="profile_picture" alt="picture" class="w-8 h-8 rounded-full object-cover" />
                </template>
                <template x-if="!profile_picture">
                    <p class="text-sm text-orange-500 font-bold">No Profile Picture</p>
                </template>
            {{-- </div> --}}
            <p class="text-sm mb-3 text-gray-900 dark:text-gray-100" x-text="name"></p>

            <h5 class="text-xs font-bold mb-1 text-gray-500 dark:text-gray-400">Phone number</h5>
            <p class="text-sm mb-3 text-gray-900 dark:text-gray-100" x-text="primary_phone_no"></p>

            <h5 class="text-xs font-bold mb-1 text-gray-500 dark:text-gray-400">Email</h5>
            <p class="text-sm mb-3 text-gray-900 dark:text-gray-100" x-text="email"></p>

            <h5 class="text-xs font-bold mb-1 text-gray-500 dark:text-gray-400">Gender</h5>
            <p class="text-sm mb-3 text-gray-900 dark:text-gray-100" x-text="gender"></p>

            <h5 class="text-xs font-bold mb-1 text-gray-500 dark:text-gray-400">Alt. Phone number</h5>
            <p class="text-sm mb-3 text-gray-900 dark:text-gray-100" x-text="alt_phone_no"></p>

            <h5 class="text-xs font-bold mb-1 text-gray-500 dark:text-gray-400">Date of Birth</h5>
            <p class="text-sm mb-3 text-gray-900 dark:text-gray-100" x-text="date_of_birth"></p>

            <h5 class="text-xs font-bold mb-1 text-gray-500 dark:text-gray-400">Blacklist</h5>
            <p 
                class="text-sm mb-3 font-bold"
                :class="is_blacklisted == 1 ? 'text-red-600' : 'text-green-500'"
                x-text="is_blacklisted == 1 ? 'BLACKLISTED' : 'NA'">
            </p>

            <h5 class="text-xs font-bold mb-1 text-gray-500 dark:text-gray-400">Status</h5>
            <p 
                class="text-sm mb-3 font-bold"
                :class="status == 0 ? 'text-red-600' : 'text-green-500'"
                x-text="status == 0 ? 'Disabled' : 'Active'">
            </p>
        </div>
    </x-admin.sidebar>

</x-admin-app-layout>
