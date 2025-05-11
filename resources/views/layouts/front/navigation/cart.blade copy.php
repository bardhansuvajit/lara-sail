<x-front.dropdown width="96">
    <x-slot name="trigger">
        <button type="button" class="hidden sm:inline-flex items-center {{FD['rounded']}} justify-center p-2 hover:bg-gray-100 {{FD['text']}} font-medium leading-tight dark:text-white dark:hover:bg-gray-700/100" id="cart-btn">
            <svg class="w-4 h-4 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"></path></svg>

            <span class="hidden lg:block me-1.5">
                <span class="cart-count">
                    @if (isset($cartData))
                        {{$cartData->total_items.($cartData->total_items == 1 ? ' item' : ' items')}}
                    @endif
                </span>
            </span>
            {{-- (<span class="currency-symbol">₹</span>106.7) --}}

            {!! FD['dropdownCaret'] !!}
        </button>
    </x-slot>
    <x-slot name="content">
        <div class="z-50 mx-auto divide-y-2 overflow-hidden {{FD['rounded']}} bg-white antialiased dark:divide-gray-600/50 dark:bg-gray-700" @click.stop>
            <div class="p-4">
                <dl class="flex items-center gap-2">
                    <dt class="font-medium {{FD['text-1']}} leading-tight dark:text-white">Your shopping cart</dt>
                    {{-- <dd class="leading-tight {{FD['text-1']}} text-gray-500 dark:text-gray-400">
                        @if (isset($cartData))
                            <span class="cart-count">({{ $cartData->total_items }} {{ $cartData->total_items == 1 ? 'item' : 'items' }})</span>
                        @endif
                    </dd> --}}
                </dl>
            </div>

            <div class="cart-products">
                @if (isset($cartData))
                    @foreach ($cartData->items as $item)
                        <div class="grid grid-cols-3 items-center p-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                            <div class="col-span-2">
                                <div class="flex items-center gap-2">
                                    <a href="#" class="flex aspect-[1/1] h-9 flex-shrink-0 items-center">
                                        <img class="h-auto max-h-full w-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ipad-light.svg" alt="imac image">
                                    </a>
                                    <div class="w-full">
                                        <a href="#" class="block text-xs {{FD['text-0']}} text-gray-900 hover:underline dark:text-white">{{$item->product_title}}</a>
                                        <p class="{{FD['text-0']}} text-gray-400">{{$item->variation_attributes}}</p>
                                        <p class="mt-0.5 truncate {{FD['text']}} font-normal text-gray-500 dark:text-gray-300">
                                            <span class="currency-symbol">₹</span> {{formatIndianMoney($item->selling_price)}}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-span-1">
                                <div class="flex items-center justify-end gap-3">
                                    <div class="relative flex items-center">
                                        <button 
                                            type="button" 
                                            class="cart-qty-update inline-flex h-5 w-5 flex-shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700" 
                                            data-id="{{$item->id}}" 
                                            data-type="desc" 
                                            {{$item->quantity == 1 ? 'disabled' : ''}}
                                        >
                                            <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"></path></svg>
                                        </button>

                                        <input type="text" class="w-8 p-0 flex-shrink-0 border-0 bg-transparent text-center {{FD['text']}} font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white" placeholder="" value="{{$item->quantity}}" required="">

                                        <button 
                                            type="button" 
                                            class="cart-qty-update inline-flex h-5 w-5 flex-shrink-0 items-center justify-center {{FD['rounded']}} border border-gray-100 border-opacity-500 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 ring-gray-700" 
                                            data-id="{{$item->id}}" 
                                            data-type="asc" 
                                        >
                                            <svg class="h-2.5 w-2.5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"></path></svg>
                                        </button>
                                    </div>

                                    <button 
                                        type="button" 
                                        class="text-red-600 hover:text-red-700 dark:text-red-600 dark:hover:text-red-700" 
                                        title="Remove from Cart" 
                                        x-data="" 
                                        x-on:click.prevent="
                                            $dispatch('open-modal', 'confirm-cart-item-deletion'); 
                                            $dispatch('data-title', 'Some Title');
                                            $dispatch('set-delete-route', '/some-delet-route')
                                        "
                                    >
                                        <div class="h-4 w-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m256-168-88-88 224-224-224-224 88-88 224 224 224-224 88 88-224 224 224 224-88 88-224-224-224 224Z"/></svg>
                                        </div>
                                    </button>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="p-4">
                        <img src="{{ Storage::url('default/cart/undraw_successful-purchase_p2fz.svg') }}" alt="empty-cart" class="w-full h-24">

                        <P class="text-xs mt-4 text-center">Your cart is empty!</P>
                    </div>
                @endif
            </div>

            <div class="cart-redirect">
                @if (isset($cartData))
                    <div class="space-y-4 px-3 py-2 dark:border-gray-600">
                        <dl class="flex items-center justify-between">
                            <dt class="font-medium {{FD['text-1']}} leading-tight dark:text-white">Total</dt>
                            <dd class="font-semibold {{FD['text-1']}} leading-tight dark:text-white"><span class="currency-symbol">₹</span> {{formatIndianMoney($cartData->total)}}</dd>
                        </dl>

                        <div class="flex space-x-2">
                            <a href="{{route('front.cart.index')}}" title="" class="inline-flex w-full items-center justify-center {{FD['rounded']}} bg-primary-600 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"> See your cart </a>

                            <a href="{{route('front.checkout.index')}}" title="" class="inline-flex w-full items-center justify-center {{FD['rounded']}} bg-primary-600 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"> Checkout </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </x-slot>
</x-front.dropdown>

<x-front.modal name="confirm-cart-item-deletion" maxWidth="sm" focusable>
    <div 
        class="p-6" 
        x-data="{ deleteRoute: '', title: '' }" 
        x-on:set-delete-route.window="deleteRoute = $event.detail" 
        x-on:data-title.window="title = $event.detail"
    >
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Are you sure?') }}
        </h2>

        <h5 x-text="title" class="text-gray-500 mt-5"></h5>

        <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">
            {{ __('Once this data is deleted, it cannot be recovered') }}
        </p>

        <div class="mt-6 flex justify-end">
            <x-admin.button
                element="button"
                tag="secondary"
                href="javascript: void(0)"
                title="Cancel"
                class="border"
                x-on:click="$dispatch('close')"
            >
                {{ __('Cancel') }}
            </x-admin.button>

            <form :action="deleteRoute" method="POST" class="ms-3">
                @csrf
                @method('DELETE')
                <x-admin.button
                    element="button"
                    tag="danger"
                    href="javascript: void(0)"
                    title="Delete"
                >
                    {{ __('Yes, Delete') }}
                </x-admin.button>
            </form>
        </div>
    </div>
</x-front.modal>

<script>
    setTimeout(() => {
        document.querySelector('#cart-btn').click()
    }, 100);
</script>