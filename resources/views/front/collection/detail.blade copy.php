<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Collection') }}">

    <main class="container mx-auto px-0 sm:px-4 pt-5 sm:pt-8 pb-8">
        <div class="mb-0 sm:mb-8 px-2 sm:px-0">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{$collection->title}}</h1>
                    <p class="text-gray-600 dark:text-gray-400 max-w-2xl text-xs">{{$collection->short_description}}</p>
                    <p class="text-gray-600 dark:text-gray-400 max-w-2xl text-xs">{{$collection->long_description}}</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="text-sm text-gray-500 dark:text-gray-400">{{ count($products) .' '. (count($products) == 1 ? 'product' : 'products') }}</span>
                </div>
            </div>
        </div>

        @if (count($products) > 0)
            <section class="bg-gray-100 mb-4 py-4 antialiased dark:bg-gray-900">
                <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
                    {{-- <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                        <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                    </div> --}}

                    <div class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="featured-products">
                        {{-- Product Card Component --}}
                        @foreach ($products as $product)
                            <x-front.product-card :product="$product" />
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </main>

</x-guest-layout>