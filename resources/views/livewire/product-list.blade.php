<div>
    {{-- filters --}}
    <form wire:submit.prevent="search">
        <div class="grid grid-cols-1 gap-4 py-4">
            <div class="flex space-x-1 items-end">
                <div class="w-max">
                    <x-admin.input-label for="perPage" :value="__('Show')" />
                    <x-admin.input-select id="perPage" wire:model="perPage">
                        @slot('options')
                            <x-admin.input-select-option value="15">15</x-admin.input-select-option>
                            <x-admin.input-select-option value="25">25</x-admin.input-select-option>
                            <x-admin.input-select-option value="50">50</x-admin.input-select-option>
                            <x-admin.input-select-option value="100">100</x-admin.input-select-option>
                            <x-admin.input-select-option value="all">All</x-admin.input-select-option>
                        @endslot
                    </x-admin.input-select>
                </div>

                <div class="w-max">
                    <x-admin.input-label for="sortBy" :value="__('Sort by')" />
                    <x-admin.input-select id="sortBy" wire:model="sortBy">
                        @slot('options')
                            <x-admin.input-select-option value="id">ID</x-admin.input-select-option>
                            <x-admin.input-select-option value="title">Title</x-admin.input-select-option>
                        @endslot
                    </x-admin.input-select>
                </div>

                <div class="w-max">
                    <x-admin.input-label for="sortOrder" :value="__('Order by')" />
                    <x-admin.input-select id="sortOrder" wire:model="sortOrder">
                        @slot('options')
                            <x-admin.input-select-option value="asc">ASC</x-admin.input-select-option>
                            <x-admin.input-select-option value="desc">DESC</x-admin.input-select-option>
                        @endslot
                    </x-admin.input-select>
                </div>
            </div>

            <div class="flex flex-row space-x-1 items-end">
                <div class="basis-1/12">
                    <x-admin.input-label for="status" :value="__('Status')" />
                    <x-admin.input-select id="status" wire:model="status">
                        @slot('options')
                            <x-admin.input-select-option value="">All</x-admin.input-select-option>
                            @foreach ($allStatus as $status)
                                <x-admin.input-select-option value="{{$status->id}}" :selected="request()->input('status') == $status->id"> {{ __($status->title) }} </x-admin.input-select-option>
                            @endforeach
                            {{-- <x-admin.input-select-option value="1">Active</x-admin.input-select-option>
                            <x-admin.input-select-option value="0">Disabled</x-admin.input-select-option> --}}
                        @endslot
                    </x-admin.input-select>
                </div>

                <div class="basis-1/2">
                    <x-admin.input-label for="keyword" :value="__('Search by')" />
                    <x-admin.text-input id="keyword" type="text" wire:model.debounce.500ms="keyword" placeholder="Keywords..." />
                </div>

                <x-admin.button element="button" type="submit">
                    {{ __('Search') }}
                </x-admin.button>

                <x-admin.button element="button" type="button" wire:click="resetFilters" tag="secondary">
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
                    <th scope="col" class="px-2 py-1">Title</th>
                    <th scope="col" class="px-2 py-1">Status</th>
                    <th scope="col" class="px-2 py-1 text-end">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $item)
                    <tr class="border-b border-gray-100 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <td scope="row" class="px-2 py-1 w-8 text-gray-900 dark:text-white">
                            <p class="text-xs">{{ $item->id }}</p>
                        </td>
                        <td scope="row" class="px-2 py-1 text-gray-900 dark:text-white">
                            <div class="flex space-x-2 items-center">
                                @if(count($item->activeImages) > 0) 
                                    <div class="h-8 overflow-hidden flex">
                                        <img src="{{ Storage::url($item->activeImages[0]->image_s) }}" alt="">
                                    </div>
                                @endif
                                <div>
                                    <a href="{{ route('admin.product.listing.edit', $item->id) }}" target="_blank" class="text-xs font-bold underline hover:no-underline">{{ $item->title }}</a>

                                    <p class="text-[10px] text-gray-400 dark:text-gray-500 line-clamp-2">{{ $item->short_description }}</p>
                                </div>
                            </div>
                        </td>
                        <td scope="row" class="px-2 py-1 text-gray-900 dark:text-white">
                            <div class="text-xs font-bold {{ $item->statusDetail->allow_order == 1 ? 'text-green-500' : 'text-red-500'}}">
                                {{ $item->statusDetail->title }}
                            </div>
                        </td>
                        <td scope="row" class="px-2 py-1 text-gray-500">
                            <div class="flex justify-end">
                                @foreach (['featured' => 'Featured', 'flash' => 'Flash', 'trending' => 'Trending', 'off' => 'Off'] as $value => $label)
                                    <label class="cursor-pointer border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition {{ $loop->first ? 'rounded-l-md' : '' }} {{ $loop->last ? 'rounded-r-md -ml-px' : '-ml-px' }}">
                                        <input 
                                            type="radio" 
                                            name="plan_{{ $item->id }}" 
                                            value="{{ $value }}" 
                                            wire:model="featureTypes.{{ $item->id }}"
                                            wire:click="updateFeatureType({{ $item->id }}, '{{ addslashes($item->title) }}', '{{ $value }}')" 
                                            class="hidden peer" />

                                        <span class="text-xs peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-600 px-2 py-1 inline-block {{ $loop->first ? 'rounded-l-md' : '' }} {{ $loop->last ? 'rounded-r-md -ml-px' : '-ml-px' }}">
                                            {{ $label }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </td>

                        {{-- <td scope="row" class="px-2 py-1 text-gray-500">
                            @livewire('toggle-featured-product', [
                                'productTitle' => $item->title,
                                'productId' => $item->id,
                                'featureId' => $item->featured ? $item->featured->id : null,
                                'featureType' => $item->featured ? $item->featured->type : null,
                                'key' => "feature-selector-$item->id"
                            ])
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
    </div>

    {{-- pagination --}}
    @if($products instanceof \Illuminate\Contracts\Pagination\Paginator && $products->hasPages())
        {{ $products->onEachSide(3)->links() }}
    @endif
</div>
