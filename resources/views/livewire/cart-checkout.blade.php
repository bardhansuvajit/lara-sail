<div>
    <div id="order-items" class="mb-2">
        <div class="{{ FD['rounded'] }} border border-gray-200 bg-white shadow-sm dark:border-0 dark:drop-shadow-md lg:dark:border lg:dark:border-gray-700 dark:bg-gray-800">
            <div class="mx-auto divide-y-2 overflow-hidden {{ FD['rounded'] }} antialiased dark:divide-gray-600 dark:drop-shadow-md shadow-sm">
                <div class="p-4">
                    <dl class="flex items-center gap-2">
                        <dt class="font-medium {{FD['text-1']}} leading-tight dark:text-white">Your shopping cart</dt>
                        <dd class="leading-tight {{FD['text-1']}} text-gray-500 dark:text-gray-400">
                            <span class="cart-count">{{count($cart['items'])}} <span class="hidden md:inline-block">items</span></span>
                        </dd>
                    </dl>
                </div>
            </div>

            <div id="cart-products" class="">
                @foreach ($cart['items'] as $item)
                    <div class="grid grid-cols-3 items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                        <div class="col-span-2">
                            <div class="flex items-center gap-3">
                                <a href="{{ $item['product_url_with_variation'] ? $item['product_url_with_variation'] : $item['product_url'] }}" class="flex aspect-[1/1] h-9 flex-shrink-0 items-center" target="_blank">
                                    @if (!empty($item['image_s']))
                                        <img class="h-auto max-h-full w-full" src="{{$item['image_s']}}" alt="{{$item['product_title']}}" />
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

    {{-- {{dd($cartSetting)}} --}}

    <div id="order-summary-container" class="">
        @include('livewire.includes.order-summary')
    </div>


    {{-- MODALS --}}
    <!-- COUPONS -->
    @include('layouts.front.includes.coupons-sidebar')

</div>