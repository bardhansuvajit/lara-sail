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

                    <div class="border border-gray-200 dark:border-gray-600 p-2 mb-3 shadow">
                        <p class="text-xs">CART</p>

                        <div id="cart-products" class="">
                            @foreach ($cart['items'] as $item)
                                <div class="grid grid-cols-3 items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                                    <div class="col-span-2">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ $item['product_url_with_variation'] ? $item['product_url_with_variation'] : $item['product_url'] }}" class="flex aspect-[1/1] h-9 flex-shrink-0 items-center" target="_blank">
                                                @if (!empty($item['image_s']))
                                                    <img class="h-auto max-h-full w-full" src="{{Storage::url($item['image_s'])}}" alt="{{$item['product_title']}}" />
                                                @else
                                                    {!! FD['brokenImageFront'] !!}
                                                @endif
                                            </a>
                                            <div class="w-full">
                                                <a href="{{ $item['product_url_with_variation'] ? $item['product_url_with_variation'] : $item['product_url'] }}" class="inline-block text-xs ${{FD['text-0']}} text-gray-900 hover:underline dark:text-white" target="_blank">{{$item['product_title']}}</a>

                                                @if (!empty($item['variation_attributes']))
                                                    <p class="{{FD['text-0']}} text-gray-500 dark:text-gray-400">{{$item['variation_attributes']}}</p>
                                                @endif

                                                <p class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-300">
                                                    <span class="currency-symbol">{{COUNTRY['icon']}}</span> {{formatIndianMoney($item['selling_price'])}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-span-1">
                                        <div class="flex items-center justify-end gap-3">
                                            <div class="relative flex items-center">
                                                <button 
                                                    type="button" 
                                                    class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center ${FDrounded} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-gray-300 dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700" 
                                                    wire:click.prevent="updateQty({{$item['id']}}, 'desc', {{$item['quantity']}})"
                                                >
                                                    <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"></path></svg>
                                                </button>

                                                <input type="text" class="w-8 p-0 flex-shrink-0 border-0 bg-transparent text-center {{FD['text']}} font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="{{$item['quantity']}}" required="">

                                                <button 
                                                    type="button" 
                                                    class="inline-flex h-5 w-5 flex-shrink-0 items-center justify-center ${FDrounded} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-offset-1 focus:ring-gray-300 dark:focus:ring-gray-500 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700" 
                                                    wire:click.prevent="updateQty({{$item['id']}}, 'asc', {{$item['quantity']}})"
                                                >
                                                    <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"></path></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
        @endif
    </div>
</x-admin-app-layout>