<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Cart') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="pt-4 sm:pt-6 px-2 sm:px-2 md:px-3 lg:px-4 xl:px-4 2xl:px-0">
            <h2 class="text-base font-semibold text-gray-900 dark:text-white sm:text-lg">Shopping Cart</h2>

            @livewire('cart')

        </div>
    </section>
</x-guest-layout>