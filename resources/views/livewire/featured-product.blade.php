<div>
    @if (count($featuredProducts) > 0)
        <section class="bg-gray-100 mb-4 py-4 antialiased dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
                <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                    <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                </div>

                <div class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="featured-products">
                    {{-- Product Card Component --}}
                    @foreach ($featuredProducts as $featuredItem)
                        <x-front.product-card :product="$featuredItem" show-add-to-cart="true" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif
</div>
