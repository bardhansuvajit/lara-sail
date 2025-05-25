<x-checkout-layout
    screen="max-w-screen-xl"
    title="{{ __('Checkout') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="pt-4 sm:pt-6 px-2 sm:px-2 md:px-3 lg:px-4 xl:px-4 2xl:px-0">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white sm:text-lg">Checkout</h2>

            <!-- ALERT -->
            @include('front.checkout.includes.alert')

            <div class="mt-4 sm:mt-6 md:gap-6 lg:flex lg:items-start xl:gap-8">
                {{-- left part --}}
                <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl mb-8">
                    <div class="space-y-2">

                        <!-- ACCOUNT -->
                        @include('front.checkout.includes.account')

                        @if (auth()->guard('web')->check())
                            <!-- ADDRESS -->
                            @include('front.checkout.includes.address')

                            <!-- PAYMENT -->
                            @livewire('payment-method', [
                                'shippingAddrExistCount' => count($shippingAddresses)
                            ])
                            {{-- @include('front.checkout.includes.payment') --}}
                        @endif

                    </div>
                </div>

                {{-- right part - cart items & order summary --}}
                <div class="mx-auto mt-6 mb-8 max-w-4xl flex-1 space-y-6 lg:mt-0 lg:w-full">

                    <!-- CART -->
                    @livewire('cart-checkout')

                </div>
            </div>
        </div>
    </section>

</x-checkout-layout>