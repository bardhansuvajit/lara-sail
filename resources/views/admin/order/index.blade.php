<x-admin-app-layout
    screen="md:w-full"
    title="{{ __('Order') }}"
    :breadcrumb="[
        ['label' => 'Order']
    ]"
>

    <section class="sm:rounded-lg overflow-hidden px-1 py-2">
        {{-- add data --}}
        <div class="flex space-x-2 justify-end">
            <x-admin.button
                element="a"
                :href="route('admin.order.offline.create')">
                @slot('icon')
                    <svg fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" /></svg>
                @endslot
                {{ __('Create Offline Order') }}
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
                    $dispatch('set-model', 'Order');
                    $dispatch('set-route', '{{ route('admin.order.import') }}');
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
                    $dispatch('set-route', '{{ route('admin.order.export', 'csv') }}');
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
                <div class="w-full col-span-3">
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
                                    title="Archive"
                                    class="border"
                                    form="bulActionForm"
                                    x-data=""
                                    x-on:click.prevent="
                                        $dispatch('open-modal', 'confirm-bulk-action');
                                        $dispatch('data-desc', 'Are you sure you want to Archive selected data?');
                                        $dispatch('data-button-text', 'Yes, Archive');
                                        $dispatch('set-route', '{{ route('admin.order.bulk') }}');
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
                                    title="Delete"
                                    class="border"
                                    form="bulActionForm"
                                    x-data=""
                                    x-on:click.prevent="
                                        $dispatch('open-modal', 'confirm-bulk-action');
                                        $dispatch('data-desc', 'Are you sure you want to Delete selected data?');
                                        $dispatch('data-button-text', 'Yes, Delete');
                                        $dispatch('set-route', '{{ route('admin.order.bulk') }}');
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
                <div class="col-span-7 flex flex-row space-x-1 justify-end items-end">
                    <div class="basis-1/1">
                        <x-admin.input-label for="countryCode" :value="__('Country')" />
                        <x-admin.input-select 
                            id="countryCode" 
                            name="countryCode" 
                            :title="request()->input('countryCode')"
                        >
                            @slot('options')
                                <x-admin.input-select-option value=""> {{ __('All') }} </x-admin.input-select-option>
                                @foreach ($activeCountries as $country)
                                    <x-admin.input-select-option value="{{$country->code}}" :selected="request()->input('countryCode') == $country->code"> {{$country->name}} </x-admin.input-select-option>
                                @endforeach
                            @endslot
                        </x-admin.input-select>
                    </div>

                    <div class="basis-1/1">
                        <x-admin.input-label for="shippingMethodId" :value="__('Shipping Method')" />
                        <x-admin.input-select 
                            id="shippingMethodId" 
                            name="shippingMethodId" 
                            :title="request()->input('shippingMethodId')"
                        >
                            @slot('options')
                                <x-admin.input-select-option value=""> {{ __('All') }} </x-admin.input-select-option>
                                @foreach ($shippingMethods as $method)
                                    <x-admin.input-select-option value="{{$method->id}}" :selected="request()->input('shippingMethodId') == $method->id"> {{strtoupper($method->method).' '.$method->country_code}} </x-admin.input-select-option>
                                @endforeach
                            @endslot
                        </x-admin.input-select>
                    </div>

                    <div class="basis-1/8">
                        <x-admin.input-label for="status" :value="__('Status')" />
                        <x-admin.input-select 
                            id="status" 
                            name="status" 
                            :title="request()->input('status')"
                        >
                            @slot('options')
                                <x-admin.input-select-option value=""> {{ __('All') }} </x-admin.input-select-option>
                                @foreach ($orderStatus as $status)
                                    <x-admin.input-select-option value="{{ $status->slug }}" :selected="request()->input('status') == $status->slug"> {{ $status->title }} </x-admin.input-select-option>
                                @endforeach
                                {{-- <x-admin.input-select-option value="1" :selected="request()->input('status') == '1'"> {{ __('Active') }} </x-admin.input-select-option>
                                <x-admin.input-select-option value="0" :selected="request()->input('status') == '0'"> {{ __('Disabled') }} </x-admin.input-select-option> --}}
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
                        <th scope="col" class="px-2 py-1">Order number</th>
                        <th scope="col" class="px-2 py-1">User</th>
                        <th scope="col" class="px-2 py-1">Total amount</th>
                        <th scope="col" class="px-2 py-1">Items</th>
                        <th scope="col" class="px-2 py-1">Shipping</th>
                        <th scope="col" class="px-2 py-1">Datetime</th>
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
                                <p class="text-[10px] font-bold">{{ $item->order_number }}</p>
                            </td>

                            {{-- User --}}
                            <td scope="row" class="px-2 py-1 text-gray-500">
                                @if ($item->user)
                                    <a href="{{ route('admin.user.edit', $item->user_id) }}" class="text-[10px] text-primary-400 underline hover:no-underline">
                                        {{ $item->user?->first_name ?? 'NA' }} {{ $item->user?->last_name ?? 'NA' }}
                                    </a>
                                @else
                                    <p class="text-red-500">ERROR</p>
                                @endif
                            </td>

                            {{-- Payment Details --}}
                            <th scope="row" class="px-2 py-1 text-gray-900 dark:text-white">
                                @if ($item->payment_status == "captured")
                                    <p class="text-[10px] text-green-500">{{ $item->currency_symbol }} {{ formatIndianMoney($item->total) }}</p>
                                    <a href="https://dashboard.razorpay.com/app/payments/{{$item->transaction_id}}?init_page=Payments" target="_blank" class="text-[10px] text-green-500 underline hover:no-underline">{{ strtoupper($item->paymentMethod->method).' '.$item->payment_status }}</a>
                                @else
                                    <p class="text-[10px] text-red-500">{{ $item->currency_symbol }} {{ formatIndianMoney($item->total) }}</p>
                                    <p class="text-[10px] text-red-500">{{ strtoupper($item->paymentMethod->method).' '.$item->payment_status }}</p>
                                @endif
                            </td>

                            {{-- Order items --}}
                            <td scope="row" class="px-2 py-1 text-gray-500">
                                <div class="flex flex-col space-y-1">
                                    @foreach ($item->items as $orderItem)
                                        <div class="flex space-x-1">
                                            @if ($orderItem->image_s)
                                                <img src="{{ Storage::url($orderItem->image_s) }}" alt="product" class="h-4">
                                            @endif
                                            <a href="{{ route('admin.product.listing.edit', $orderItem->product_id) }}" class="text-[10px] text-primary-400 underline hover:no-underline">
                                                {{$orderItem->product_title}}
                                            </a>
                                            @if ($orderItem->variation_attributes)
                                                <p class="text-[10px] text-gray-900 dark:text-white">{{$orderItem->variation_attributes}}</p>
                                            @endif
                                            <p class="text-[10px] text-gray-600 dark:text-gray-400"> x {{$orderItem->quantity}}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            {{-- Shipping --}}
                            @php
                                $shippingAddress = json_decode($item->shipping_address);
                            @endphp
                            <td scope="row" class="px-2 py-1 text-gray-900 dark:text-white">
                                <div class="flex space-x-2 items-center">
                                    @if($item->country->flag) <div class="w-8 h-8 overflow-hidden flex">{!! $item->country->flag !!}</div> @endif
                                    <div>
                                        <p class="text-[10px]">
                                            {{ $shippingAddress->postal_code }}, {{ $shippingAddress->state }}
                                        </p>
                                        <p class="text-[10px]">
                                            {{ strtoupper($item->shippingMethod->method) }} Delivery 
                                            @if ($item->shipping_cost > 0)
                                                <span class="text-[10px] text-green-500">({{ $item->currency_symbol }} {{ formatIndianMoney($item->shipping_cost) }})</span>
                                            @endif
                                            by {{ $item->created_at->addDays($item->shippingMethod->max_delivery_day)->format('l, F d, Y') }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Order Datetime --}}
                            <td scope="row" class="px-2 py-1 text-gray-500">
                                <p class="text-[10px]">{{ $item->created_at->diffForHumans() }}</p>
                                <p class="text-[10px]">{{ $item->created_at->format('F j, Y h:i a') }}</p>
                            </td>

                            {{-- Action --}}
                            <td scope="row" class="px-2 py-1 text-gray-600 dark:text-gray-400">
                                <div class="flex space-x-2 items-center justify-end">
                                    <p class="text-[10px]">{{ ucwords($item->status) }}</p>
                                    {{-- @livewire('toggle-status', [
                                        'model' => 'Order',
                                        'modelId' => $item->id,
                                    ]) --}}

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
                                            $dispatch('data-country', '{{ $item->country->name }}');
                                            $dispatch('data-order_number', '{{ $item->order_number }}');
                                            $dispatch('data-status', '{{ $item->status }}');
                                            $dispatch('data-email', '{{ $item->email }}');
                                            $dispatch('data-phone_no', '{{ $item->phone_no }}');
                                            $dispatch('data-total_items', '{{ $item->total_items }}');
                                            $dispatch('data-currency_symbol', '{{ $item->currency_symbol }}');
                                            $dispatch('data-mrp', '{{ formatIndianMoney($item->mrp) }}');
                                            $dispatch('data-sub_total', '{{ formatIndianMoney($item->sub_total) }}');
                                            $dispatch('data-total', '{{ formatIndianMoney($item->total) }}');
                                            $dispatch('data-coupon_code', '{{ $item->coupon_code }}');
                                            $dispatch('data-coupon_discount_amount', '{{ $item->coupon_discount_amount }}');
                                            $dispatch('data-coupon_meta', '{{ $item->coupon_meta }}');
                                            $dispatch('data-shipping_method', '{{ $item->shipping_method_name }}');
                                            $dispatch('data-shipping_cost', '{{ $item->shipping_cost }}');
                                            $dispatch('data-shipping_address', `{!! nl2br(e($item->shipping_address)) !!}`);
                                            $dispatch('data-billing_address', `{!! nl2br(e($item->billing_address)) !!}`);
                                            {{-- $dispatch('data-same_as_shipping', '{{ $item->same_as_shipping ? "Yes" : "No" }}'); --}}
                                            $dispatch('data-tax_amount', '{{ $item->tax_amount }}');
                                            $dispatch('data-tax_type', '{{ $item->tax_type }}');
                                            $dispatch('data-tax_details', `{!! nl2br(e($item->tax_details)) !!}`);
                                            $dispatch('data-payment_method', '{{ $item->payment_method_title }}');
                                            $dispatch('data-payment_charge', '{{ $item->payment_method_charge }}');
                                            $dispatch('data-payment_discount', '{{ $item->payment_method_discount }}');
                                            $dispatch('data-payment_status', '{{ $item->payment_status }}');
                                            $dispatch('data-transaction_id', '{{ $item->transaction_id }}');
                                            $dispatch('data-payment_details', `{!! nl2br(e($item->payment_details)) !!}`);
                                            {{-- $dispatch('data-paid_at', '{{ optional($item->paid_at)->format("d M Y, h:i A") ?? "NA" }}');
                                            $dispatch('data-processed_at', '{{ optional($item->processed_at)->format("d M Y, h:i A") ?? "NA" }}');
                                            $dispatch('data-shipped_at', '{{ optional($item->shipped_at)->format("d M Y, h:i A") ?? "NA" }}');
                                            $dispatch('data-delivered_at', '{{ optional($item->delivered_at)->format("d M Y, h:i A") ?? "NA" }}');
                                            $dispatch('data-cancelled_at', '{{ optional($item->cancelled_at)->format("d M Y, h:i A") ?? "NA" }}'); --}}
                                            {{-- $dispatch('data-cancellation_reason', `{!! nl2br(e($item->cancellation_reason)) !!}`); --}}
                                            {{-- $dispatch('data-notes', `{!! nl2br(e($item->notes)) !!}`); --}}
                                            {{-- $dispatch('data-custom_fields', `{!! nl2br(e($item->custom_fields)) !!}`); --}}
                                        " >
                                        @slot('icon')
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                                        @endslot
                                    </x-admin.button-icon>

                                    <x-admin.button-icon
                                        element="a"
                                        tag="secondary"
                                        :href="route('admin.order.edit', $item->id)"
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
                                            $dispatch('set-delete-route', '{{ route('admin.order.delete', $item->id) }}')" >
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
            x-data="{
                flag: '', country: '', order_number: '', status: '',
                email: '', phone_no: '', total_items: '', currency_symbol: '', mrp: '', sub_total: '', total: '',
                coupon_code: '', coupon_discount_amount: '', coupon_meta: '',
                shipping_method: '', shipping_cost: '', shipping_address: '',
                billing_address: '', same_as_shipping: '',
                tax_amount: '', tax_type: '', tax_details: '',
                payment_method: '', payment_charge: '', payment_discount: '', payment_status: '',
                transaction_id: '', payment_details: '',
                paid_at: '', processed_at: '', shipped_at: '', delivered_at: '', cancelled_at: '', cancellation_reason: '',
                notes: '', custom_fields: ''
            }"
            @data-flag.window="flag = $event.detail"
            @data-country.window="country = $event.detail"
            @data-order_number.window="order_number = $event.detail"
            @data-status.window="status = $event.detail"
            @data-email.window="email = $event.detail"
            @data-phone_no.window="phone_no = $event.detail"
            @data-total_items.window="total_items = $event.detail"
            @data-currency_symbol.window="currency_symbol = $event.detail"
            @data-mrp.window="mrp = $event.detail"
            @data-sub_total.window="sub_total = $event.detail"
            @data-total.window="total = $event.detail"
            @data-coupon_code.window="coupon_code = $event.detail"
            @data-coupon_discount_amount.window="coupon_discount_amount = $event.detail"
            @data-coupon_meta.window="coupon_meta = $event.detail"
            @data-shipping_method.window="shipping_method = $event.detail"
            @data-shipping_cost.window="shipping_cost = $event.detail"
            @data-shipping_address.window="shipping_address = $event.detail"
            @data-billing_address.window="billing_address = $event.detail"
            @data-same_as_shipping.window="same_as_shipping = $event.detail"
            @data-tax_amount.window="tax_amount = $event.detail"
            @data-tax_type.window="tax_type = $event.detail"
            @data-tax_details.window="tax_details = $event.detail"
            @data-payment_method.window="payment_method = $event.detail"
            @data-payment_charge.window="payment_charge = $event.detail"
            @data-payment_discount.window="payment_discount = $event.detail"
            @data-payment_status.window="payment_status = $event.detail"
            @data-transaction_id.window="transaction_id = $event.detail"
            @data-payment_details.window="payment_details = $event.detail"
            @data-paid_at.window="paid_at = $event.detail"
            @data-processed_at.window="processed_at = $event.detail"
            @data-shipped_at.window="shipped_at = $event.detail"
            @data-delivered_at.window="delivered_at = $event.detail"
            @data-cancelled_at.window="cancelled_at = $event.detail"
            @data-cancellation_reason.window="cancellation_reason = $event.detail"
            @data-notes.window="notes = $event.detail"
            @data-custom_fields.window="custom_fields = $event.detail"
        >
            <template x-for="(value, label) in {
                'Country': country,
                'Order #': order_number,
                'Status': status,
                'Email': email,
                'Phone': phone_no,
                'Total Items': total_items,
                'MRP': mrp,
                'Subtotal': sub_total,
                'Total': total,
                'Coupon Code': coupon_code,
                'Discount': coupon_discount_amount,
                'Coupon Meta': coupon_meta,
                'Shipping Method': shipping_method,
                'Shipping Cost': shipping_cost,
                'Shipping Address': shipping_address,
                'Billing Address': billing_address,
                'Same as Shipping': same_as_shipping,
                'Tax Amount': tax_amount,
                'Tax Type': tax_type,
                'Tax Details': tax_details,
                'Payment Method': payment_method,
                'Payment Charge': payment_charge,
                'Payment Discount': payment_discount,
                'Payment Status': payment_status,
                'Transaction ID': transaction_id,
                'Payment Details': payment_details,
                'Paid At': paid_at,
                'Processed At': processed_at,
                'Shipped At': shipped_at,
                'Delivered At': delivered_at,
                'Cancelled At': cancelled_at,
                'Cancellation Reason': cancellation_reason,
                'Notes': notes,
                'Custom Fields': custom_fields,
            }" :key="label">
                <div class="mb-3">
                    <h5 class="text-xs font-bold text-gray-500 dark:text-gray-400" x-text="label"></h5>
                    <p
                        class="text-sm whitespace-pre-wrap"
                        :class="!value ? 'text-red-500' : 'text-gray-900 dark:text-gray-100'"
                        x-text="!value 
                            ? 'NA' 
                            : (['MRP', 'Subtotal', 'Total'].includes(label) 
                                ? (currency_symbol + ' ' + value) 
                                : value)"
                    ></p>
                </div>
            </template>

            <div x-show="flag" class="mt-4">
                <h5 class="text-xs font-bold text-gray-500 dark:text-gray-400">Flag</h5>
                <div class="w-8 h-8" x-html="flag"></div>
            </div>
        </div>
    </x-admin.sidebar>

</x-admin-app-layout>
