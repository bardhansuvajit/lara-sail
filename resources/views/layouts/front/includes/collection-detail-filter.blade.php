<aside class="space-y-2 sm:space-y-4">
    <form id="filtersForm" method="GET" action="{{ route('front.collection.detail', $collection->slug) }}">
        <div class="bg-white dark:bg-gray-800 p-4 {{ FD['rounded'] }} shadow grid gap-4">
            <h3 class="text-sm font-semibold">Filters</h3>

            @php
                $filteredMinPriceValue = $filters['min_price'] ?? $minPriceValue;
                $filteredMaxPriceValue = $filters['max_price'] ?? $maxPriceValue;
            @endphp

            <x-front.price-range-filter 
                :minPriceValue=$minPriceValue
                :filteredMinPriceValue=$filteredMinPriceValue
                :maxPriceValue=$maxPriceValue
                :filteredMaxPriceValue=$filteredMaxPriceValue
                :stepPrice=$stepPrice
                minPriceName="min_price"
                maxPriceName="max_price"
            />

            {{-- Subcategories --}}
            {{-- {{ dd($filters['category']) }} --}}
            {{-- @if($subcategories->isNotEmpty())
                <div class="">
                    <label class="text-xs font-light">Subcategories</label>
                    <div class="mt-2 grid gap-2">
                        @foreach($subcategories as $subCat)
                            <label class="inline-flex items-center text-xs">
                                <x-front.input-checkbox 
                                    id="subcat_checkbox_{{$subCat->id}}" 
                                    name="category[]" 
                                    value="{{ $subCat->id }}" 
                                    label="{{ $subCat->title }}" 
                                    :checked="collect(request('category', []))->contains((string) $subCat->id)"
                                />
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif --}}

            {{-- Rating --}}
            <div class="">
                <label class="text-xs font-light">Customer rating</label>
                <div class="mt-2 flex flex-col gap-2 text-xs">
                    @foreach([4,3,2,1] as $r)
                        <label class="inline-flex items-center">
                            <input type="radio" name="rating" value="{{ $r }}" {{ request('rating') == $r ? 'checked' : '' }} class="mr-2"> 
                            <span>{{ $r }} stars & up</span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Sort By --}}
            @if(count($sortByArr) > 0)
                <div class="">
                    <label class="text-xs font-light">Sort By</label>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach($sortByArr as $key => $value)
                            <x-front.radio-input-button id="someId{{$key}}" name="sortBy" value="{{$key}}" :checked="request('sortBy') ? request('sortBy') == $key : $loop->first">
                                <div class="text-center">
                                    <div class="{{FD['text']}} font-medium text-gray-700 dark:text-gray-300">{{$value}}</div>
                                </div>
                            </x-front.radio-input-button>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Attributes (colors, size) --}}
            @foreach($attributes ?? [] as $attr)
                <div class="mb-4">
                    <label class="text-xs font-light">{{ $attr->name }}</label>
                    <div class="mt-2 grid gap-2 max-h-32 overflow-auto text-xs">
                        @foreach($attr->values as $val)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="attrs[{{ $attr->id }}][]" value="{{ $val->id }}" {{ collect(request('attrs.'. $attr->id, []))->contains($val->id) ? 'checked' : '' }} class="mr-2"> {{ $val->value }}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="flex justify-between items-center gap-2 mt-2">
                <x-front.button
                    type="submit"
                    class="w-20"
                    element="button">
                    {{ __('Apply') }}
                </x-front.button>

                <div class="flex">
                    <a href="{{ route('front.collection.detail', $collection->slug) }}" class="text-[10px] inline-flex gap-2 items-center text-end text-amber-800/80 hover:text-amber-800 dark:text-amber-600/80 dark:hover:text-amber-600">
                        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m592-481-57-57 143-182H353l-80-80h487q25 0 36 22t-4 42L592-481ZM791-56 560-287v87q0 17-11.5 28.5T520-160h-80q-17 0-28.5-11.5T400-200v-247L56-791l56-57 736 736-57 56ZM535-538Z"/></svg>
                        Clear Filter
                    </a>
                </div>

                {{-- <a href="{{ route('front.collection.detail', $collection->slug) }}" class="text-xs text-gray-500">Reset</a> --}}
            </div>
        </div>
    </form>

    @include('layouts/front/includes/why-shop-here')

</aside>