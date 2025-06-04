<x-front.modal 
    name="shipping-value" 
    maxWidth="sm" 
    vertical="middle" 
    :show="($cartSetting['free_shipping_threshold'] > $cart['sub_total']) && (request()->query('free-shipping-alert') == true)"
>
    <div class="p-6">
        <div class="max-w-sm border-gray-200 rounded-lg shadow-sm text-center">
            <div class="w-32 m-auto">
                <img src="{{Storage::url('public/default/cart/undraw_on-the-way_ahi2.svg')}}" alt="almost-there" class="w-full mb-4">
            </div>

            <h5 class="mb-2 text-lg font-semibold tracking-tight text-gray-900 dark:text-white">{{ __('Want Free Shipping?') }}</h5>
            <p class="mb-3 font-normal {{FD['text-1']}} text-gray-500 dark:text-gray-400">
                {!! __('Add <span class="italic font-bold dark:text-gray-300"><span class="currency-symbol">:icon</span>:amount</span> more  to your cart to qualify for free shipping on your order.', [
                    'icon' => COUNTRY['icon'],
                    'amount' => formatIndianMoney($cartSetting['free_shipping_threshold'] - $cart['sub_total'])
                ]) !!}
            </p>

            <a href="{{ route('front.collection.index') }}" class="flex w-full items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                Continue Shopping
            </a>

            <a href="javascript: void(0)" class="{{FD['text-0']}} underline hover:no-underline" x-on:click="$dispatch('close')">Close</a>
        </div>
    </div>
</x-front.modal>