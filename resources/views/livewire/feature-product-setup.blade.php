<div>
    <div id="sortable-container" class="grid grid-cols-2 md:grid-cols-6 gap-2 mt-4 border-4 border-red-500 p-4 relative overflow-hidden">
        @forelse ($features as $singleFeature)
            <div class="rounded border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 relative overflow-hidden"  data-id="{{ $singleFeature->id }}">
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
                            <div class="mt-2 flex items-center gap-2">
                                <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                    <span class="currency-icon">{{$singlePricing->currency_symbol}}</span>{{$singlePricing->selling_price}}
                                </p>
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

                    <div class="w-full mt-2 text-center">
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
                                    $dispatch('data-title', '{{ $singleFeature->product->title }}');
                                    $dispatch('set-delete-route', '{{ route('admin.product.feature.delete', $singleFeature->id) }}')" >
                                    Remove
                                {{-- @slot('icon')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>
                                @endslot --}}
                            </x-admin.button>
                        </div>
                    </div>
                </a>
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