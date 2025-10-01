<x-admin-app-layout
    screen="w-full"
    title="{{ __('Create Offline Order') }}"
    :breadcrumb="[
        ['label' => 'Order', 'url' => route('admin.order.index')],
        ['label' => 'Create']
    ]"
>

    <div class="w-full mt-2">
        {{-- When USER NOT SELECTED yet --}}
        @if (!isset($userId))
            <form action="{{ route('admin.order.offline.search.user') }}" method="get" enctype="multipart/form-data">
                <div class="grid gap-4 mb-4 sm:grid-cols-4">
                    <div>
                        <x-admin.input-label for="primary_phone_no" :value="__('Phone number *')" />
                        <x-admin.text-input-with-dropdown 
                            id="primary_phone_no" 
                            class="block w-auto" 
                            type="tel" 
                            name="primary_phone_no" 
                            :value="old('primary_phone_no', request()->input('phone-no'))" 
                            placeholder="Enter Primary Phone Number" 
                            selectId="country_code" 
                            selectName="country_code" 
                            autofocusText="true"
                        >
                            @slot('options')
                                @foreach ($activeCountries as $country)
                                    <x-admin.input-select-option value="{{$country->code}}" :selected="old('country', request()->input('country', COUNTRY['country'])) == $country->code"> {{$country->name}} </x-admin.input-select-option>
                                @endforeach
                            @endslot
                        </x-admin.text-input-with-dropdown>
                        <x-admin.input-error :messages="$errors->get('country_code')" class="mt-2" />
                        <x-admin.input-error :messages="$errors->get('primary_phone_no')" class="mt-2" />
                    </div>
                </div>

                <div class="items-center space-x-4 flex my-6">
                    <x-admin.button
                        type="submit"
                        element="button">
                        @slot('icon')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M440-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm0-80q33 0 56.5-23.5T520-640q0-33-23.5-56.5T440-720q-33 0-56.5 23.5T360-640q0 33 23.5 56.5T440-560ZM884-20 756-148q-21 12-45 20t-51 8q-75 0-127.5-52.5T480-300q0-75 52.5-127.5T660-480q75 0 127.5 52.5T840-300q0 27-8 51t-20 45L940-76l-56 56ZM660-200q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29Zm-540 40v-111q0-34 17-63t47-44q51-26 115-44t142-18q-12 18-20.5 38.5T407-359q-60 5-107 20.5T221-306q-10 5-15.5 14.5T200-271v31h207q5 22 13.5 42t20.5 38H120Zm320-480Zm-33 400Z"/></svg>
                        @endslot
                        {{ __('Search Using Primary Phone Number') }}
                    </x-admin.button>
                </div>
            </form>
        @else
            <div class="grid gap-4 md:grid-cols-8">
                {{-- LEFT part --}}
                <div class="col-span-6 px-3 mt-3">
                    <h5 class="text-sm mb-3 text-center">PRODUCTS</h5>

                    {{-- filters --}}
                    <div class="w-full">
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
                                                    title="Edit"
                                                    class="border"
                                                    form="bulActionForm"
                                                    x-data=""
                                                    x-on:click.prevent="
                                                        $dispatch('open-modal', 'confirm-bulk-action');
                                                        $dispatch('data-desc', 'Are you sure you want to Edit selected data?');
                                                        $dispatch('data-button-text', 'Yes, Edit');
                                                        $dispatch('set-route', '{{ route('admin.product.listing.bulk') }}');
                                                        document.getElementById('bulkActionInput').value = 'edit';
                                                    ">
                                                    @slot('icon')
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                                                    @endslot
                                                </x-admin.button-icon>

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
                    </div>

                    <hr class="border-t border-gray-300 dark:border-gray-600 my-2">

                    <div class="grid grid-cols-2 md:grid-cols-6 gap-2">
                        @forelse ($products as $product)
                            <div class="{{ FD['rounded'] }} border border-gray-200 bg-white p-2 shadow-lg dark:border-gray-700 dark:bg-gray-800 relative overflow-hidden">
                                <a href="{{ route('front.product.detail', $product->slug) }}">
                                    <div class="h-40 w-full">
                                        @if (count($product->activeImages) > 0)
                                            <div class="flex items-center justify-center h-full">
                                                <img src="{{ Storage::url($product->activeImages[0]->image_m) }}" alt="" class="max-w-full max-h-full">
                                            </div>
                                        @else
                                            <div class="flex items-center justify-center h-full w-full">
                                                {!!FD['brokenImageFront']!!}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="absolute top-0 right-0 w-full h-8 p-1 overflow-hidden">
                                        <div class="flex justify-between items-center">
                                            @if ($product->average_rating > 0)
                                                {!! frontRatingHtml($product->average_rating) !!}
                                            @endif
                                        </div>
                                    </div>

                                    <p class="font-semibold text-gray-900 hover:underline dark:text-gray-300 {{FD['text-0']}} sm:text-xs inline-block leading-4 sm:leading-5 truncate">
                                        {{ $product->title }}
                                    </p>

                                    {{-- <p class="text-gray-500 dark:text-gray-400 {{FD['text-0']}} block -mt-2">
                                        {{ $product->variation_attributes }}
                                    </p> --}}

                                    @if (count($product->pricings) > 0)
                                        @php
                                            $singlePricing = $product->pricings[0];
                                        @endphp

                                        <div class="mt-2 flex items-center gap-2">
                                            <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                                <span class="currency-icon">{{$singlePricing->currency_symbol}}</span> {{ formatIndianMoney($singlePricing->selling_price) }}
                                            </p>
                                            @if ($singlePricing->mrp != 0)
                                                <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                                    <span class="currency-icon">{{$singlePricing->currency_symbol}}</span>{{ formatIndianMoney($singlePricing->mrp) }}
                                                </p>
                                                <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                                    {{$singlePricing->discount}}% off
                                                </p>
                                            @endif
                                        </div>
                                    @endif
                                </a>

                                <div class="mt-3 text-center">
                                    @if (count($product->activeVariations) == 0)
                                        <button class="w-full {{ FD['rounded'] }} {{ FD['text-0'] }} bg-primary-700 dark:bg-primary-600 hover:bg-primary-800 dark:hover:bg-primary-700 p-1 text-gray-100 add-to-cart"
                                            data-prod-id="{{$product->id}}" 
                                            data-purchase-type="cart" 
                                            {{-- data-variation-data="{{ json_encode($variation['data']) }}" --}}
                                        >
                                            Add to cart
                                        </button>
                                    @else
                                        <x-admin.input-select 
                                            id="variation" 
                                            class="w-full"
                                            name="variation" 
                                        >
                                            @slot('options')
                                                @foreach ($product->activeVariations as $variation)
                                                    <x-admin.input-select-option 
                                                        value="{{$variation->id}}" 
                                                    >
                                                        {{ $variation->variation_identifier }} - 
                                                        {{ formatIndianMoney($singlePricing->selling_price + $variation->price_adjustment) }}
                                                    </x-admin.input-select-option>
                                                @endforeach
                                            @endslot
                                        </x-admin.input-select>

                                        <button class="w-full {{ FD['rounded'] }} {{ FD['text-0'] }} bg-primary-700 dark:bg-primary-600 hover:bg-primary-800 dark:hover:bg-primary-700 p-1 text-gray-100 add-to-cart"
                                            data-prod-id="{{$product->id}}" 
                                            data-purchase-type="cart" 
                                            data-variation-data="{{ json_encode($variation['data']) }}"
                                        >
                                            Add to cart
                                        </button>
                                    @endif
                                </div>

                            </div>
                        @empty
                            <div class="col-span-4 {{ FD['rounded'] }} bg-white p-2 shadow-sm dark:bg-gray-800 md:p-4">
                                <div class="w-full text-center">
                                    <img src="{{ Storage::url('public/default/cart/undraw_web-shopping_m3o2.svg') }}" alt="empty-cart" class="w-72 m-auto mb-6">

                                    <h5 class="block text-base leading-tight font-bold text-gray-900 dark:text-gray-300 mb-4">
                                        No items here!
                                    </h5>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- RIGHT part --}}
                <div class="col-span-2 px-3 mt-3 border-l border-gray-200 dark:border-gray-600">
                    <h5 class="text-sm mb-3 text-center">SUMMARY</h5>

                    <div class="border border-gray-200 dark:border-gray-600 p-2 mb-3 shadow">
                        <div class="flex space-x-2 items-center">
                            @if($userFlag) <div class="w-8 h-8 overflow-hidden flex">{!! $userFlag !!}</div> @endif
                            <div>
                                <p class="text-xs">{{ $userCountry }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border border-gray-200 dark:border-gray-600 p-2 mb-3 shadow">
                        <h5 class="text-xs text-gray-500 dark:text-gray-500">User details</h5>

                        <div class="flex justify-between items-center">
                            <div>
                                <a href="{{ route('admin.user.edit', $userId) }}" target="_blank" class="inline-block">
                                    <p class="text-sm text-gray-800 dark:text-gray-200 underline hover:no-underline">{{$userFirstName}} {{$userLastName}}</p>
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('admin.order.offline.create') }}" class="text-xs text-gray-500 dark:text-gray-500 italic">Change User</a>
                            </div>
                        </div>

                        @if ($userEmail)
                            <p class="mt-3 text-sm text-gray-800 dark:text-gray-200">{{$userEmail}}</p>
                        @else
                            <p class="mt-3 text-xs text-amber-600 dark:text-amber-700">No Email Address</p>
                        @endif
                        <p class="text-sm text-gray-800 dark:text-gray-200">{{$userPhoneNo}}</p>
                    </div>

                    @livewire('offline-order-cart', [
                        'userId' => $userId
                    ])

                </div>
            </div>
        @endif
    </div>
</x-admin-app-layout>