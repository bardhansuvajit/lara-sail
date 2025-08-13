<div>
    <div id="sortable-container" class="grid grid-cols-2 md:grid-cols-5 lg:grid-cols-6 gap-2 mt-4 border-4 border-red-500 p-4 relative overflow-hidden">
        @forelse ($featuredProducts as $singleFeature)
            <div class="rounded h-80 border border-gray-200 bg-white p-2 pb-14 shadow-sm dark:border-gray-700 dark:bg-gray-800 relative overflow-hidden" data-id="{{ $singleFeature->id }}">
                <a href="{{ route('admin.product.listing.edit', $singleFeature->product_id) }}" target="_blank">
                    <div class="h-40 w-full">
                        @if (count($singleFeature->product->activeImages) > 0)
                            <div class="flex items-center justify-center h-full">
                                <img src="{{ Storage::url($singleFeature->product->activeImages[0]->image_m) }}" alt="" class="max-w-full max-h-full">
                            </div>
                        @else
                            <div class="flex items-center justify-center h-full w-full">
                                {!!FD['brokenImage']!!}
                            </div>
                        @endif
                    </div>

                    <div class="absolute top-0 right-0 w-full h-8 p-1 overflow-hidden">
                        <div class="flex justify-between items-center">
                            <div class="w-10 h-5 flex space-x-1 items-center bg-gray-50 px-1 border">
                                <p class="{{FD['text-0']}} text-gray-900 font-bold">3.9</p>
                                <div class="{{FD['iconClass']}} text-yellow-400 flex items-center">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="font-semibold text-gray-900 hover:underline dark:text-gray-400 {{FD['text-0']}} sm:text-xs block leading-4 sm:leading-5 truncate">
                        {{$singleFeature->product->title}}
                    </p>

                    @if (count($singleFeature->product->pricings) > 0)
                        @foreach ($singleFeature->product->pricings as $singlePricing)
                            <div class="mt-2 flex items-center gap-2 mb-1">
                                <p class="{{FD['text-1']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                    <span class="currency-icon">{{$singlePricing->currency_symbol}}</span>{{ formatIndianMoney($singlePricing->selling_price) }}
                                </p>
                            </div>

                            <div class="flex space-x-3">
                                @if ($singlePricing->mrp != 0)
                                    <p class="{{FD['text']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                                        <span class="currency-icon">{{$singlePricing->currency_symbol}}</span>{{$singlePricing->mrp}}
                                    </p>
                                    <p class="{{FD['text-0']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                                        {{$singlePricing->discount}}% off
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="mt-2 flex items-center gap-2">
                            <p class="{{FD['text']}} font-medium leading-tight text-red-600 dark:text-white mb-4 sm:mb-0">
                                NO PRICING
                            </p>
                        </div>
                    @endif

                    {{-- <div class="w-full mt-2 text-center">
                        <div class="handle cursor-grab flex justify between">
                            <svg class="size-4 text-gray-400 dark:text-neutral-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="12" r="1"></circle><circle cx="9" cy="5" r="1"></circle><circle cx="9" cy="19" r="1"></circle><circle cx="15" cy="12" r="1"></circle><circle cx="15" cy="5" r="1"></circle><circle cx="15" cy="19" r="1"></circle></svg>
                            <p class="text-xs text-gray-400 dark:text-neutral-500">Drag me</p>
                        </div>
                    </div>

                    <div class="w-full mt-2 text-center">
                        <div class="">
                            <x-admin.button
                                element="a"
                                tag="danger"
                                href="javascript: void(0)"
                                x-data=""
                                x-on:click.prevent="
                                    $dispatch('open-modal', 'confirm-data-deletion');
                                    $dispatch('data-title', '{{ htmlspecialchars($singleFeature->product->title, ENT_QUOTES) }}');
                                    $dispatch('set-delete-route', '{{ route('admin.product.feature.delete', $singleFeature->id) }}')" >
                                    Remove
                            </x-admin.button>
                        </div>
                    </div> --}}
                </a>

                {{-- Footer Part --}}
                <div class="absolute bottom-0 left-0 right-0 z-10 border-t border-gray-200 dark:border-gray-700 p-2 bg-gray-50 dark:bg-gray-900/90 backdrop-blur-sm">
                    <div class="flex space-x-2 justify-between">
                        <!-- Drag Handle -->
                        <div class="handle cursor-grab flex items-center space-x-1 text-gray-600 hover:text-gray-600 dark:hover:text-gray-300 transition">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="9" cy="12" r="1"></circle>
                                <circle cx="9" cy="5" r="1"></circle>
                                <circle cx="9" cy="19" r="1"></circle>
                                <circle cx="15" cy="12" r="1"></circle>
                                <circle cx="15" cy="5" r="1"></circle>
                                <circle cx="15" cy="19" r="1"></circle>
                            </svg>
                            <span class="text-xs">Drag</span>
                        </div>

                        <!-- Remove Button -->
                        <x-admin.button
                            element="a"
                            tag="danger"
                            href="javascript:void(0)"
                            x-data=""
                            x-on:click.prevent="
                                $dispatch('open-modal', 'confirm-data-deletion'); 
                                $dispatch('data-title', '{{ addslashes($singleFeature->product->title) }}');
                                $dispatch('set-delete-route', '{{ route('admin.product.feature.delete', $singleFeature->id) }}')"
                            class="text-xs px-2 py-1">
                            Remove
                        </x-admin.button>
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-6 h-40">
                <p class="italic text-sm text-center text-gray-500">No Products found</p>
            </div>
        @endforelse

        <div class="absolute bg-red-500 text-white text-sm font-semibold px-2 py-1 top-2 right-2">
            Live
        </div>
    </div>

    @include('admin.includes.delete-confirm-modal')
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.6/Sortable.min.js"></script>

<script>
window.addEventListener('load', () => {
    (function () {
        const sortable = document.querySelector("#sortable-container");

        new Sortable(sortable, {
            handle: '.handle',
            animation: 150,
            dragClass: 'rounded-none!',
            onEnd: function (evt) {
                const orderedIds = Array.from(sortable.children).map(el => el.dataset.id);
                Livewire.dispatch('updateProductFeatureOrder', { ids: orderedIds });
            }
        });
    })();
});
</script>