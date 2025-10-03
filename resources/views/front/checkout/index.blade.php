<x-checkout-layout
    screen="max-w-screen-xl"
    title="{{ __('Checkout') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="pt-4 px-2 md:px-0">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white sm:text-lg">Checkout</h2>

            <!-- ALERT -->
            @include('front.checkout.includes.alert')

            {{-- @if ($errors->any())
                <div class="text-red-600 mb-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif --}}

            <div class="mt-4 md:gap-4 lg:flex lg:items-start">
                {{-- left part --}}
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl mb-2 md:mb-8">
                    <div class="space-y-2 md:space-y-4">

                        <!-- ACCOUNT -->
                        @include('front.checkout.includes.account')

                        @if (auth()->guard('web')->check())
                            <!-- ADDRESS -->
                            @include('front.checkout.includes.address')

                            <!-- PAYMENT -->
                            @livewire('payment-method', [
                                'shippingAddrExistCount' => count($shippingAddresses)
                            ])
                        @endif

                    </div>
                </div>

                {{-- right part - cart items & order summary --}}
                <div class="mx-auto mt-2 md:mt-6 mb-2 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">

                    <!-- CART -->
                    @livewire('cart-checkout')

                </div>
            </div>
        </div>
    </section>

</x-checkout-layout>