<x-app-layout
    screen="max-w-screen-xl"
    title="{{ __('Product') }}">

    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-wrap -mx-4">
            <!-- Product Images Slider -->
            <div class="w-full lg:w-1/2 px-4 mb-8">
                <div class="swiper main-swiper rounded-lg shadow-lg">
                    <div class="swiper-wrapper">
                        <!-- Main Images -->
                        <div class="swiper-slide">
                            <img src="https://placehold.co/600x800" alt="Product Front" class="w-full h-auto">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://placehold.co/600x800" alt="Product Back" class="w-full h-auto">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://placehold.co/600x800" alt="Product Detail" class="w-full h-auto">
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

                <!-- Thumbnail Slider -->
                <div class="swiper thumbnail-swiper mt-4">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide w-1/4 cursor-pointer">
                            <img src="https://placehold.co/600x800" alt="Thumbnail 1" class="w-full h-auto">
                        </div>
                        <div class="swiper-slide w-1/4 cursor-pointer">
                            <img src="https://placehold.co/600x800" alt="Thumbnail 2" class="w-full h-auto">
                        </div>
                        <div class="swiper-slide w-1/4 cursor-pointer">
                            <img src="https://placehold.co/600x800" alt="Thumbnail 3" class="w-full h-auto">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="w-full lg:w-1/2 px-4">
                <h1 class="text-3xl font-bold mb-4">Blue Floral Bodycon Mini Dress</h1>
                <div class="text-2xl text-red-600 mb-4">$29.99</div>
                
                <!-- Color Variations -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-3">Colors</h3>
                    <div class="flex space-x-2">
                        <button class="w-8 h-8 rounded-full bg-blue-600 border-2 border-gray-300"></button>
                        <button class="w-8 h-8 rounded-full bg-red-600 border-2 border-gray-200"></button>
                        <button class="w-8 h-8 rounded-full bg-black border-2 border-gray-200"></button>
                    </div>
                </div>

                <!-- Size Variations -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-3">Size</h3>
                    <div class="grid grid-cols-4 gap-2">
                        <button class="py-2 border rounded hover:border-black">S</button>
                        <button class="py-2 border rounded hover:border-black">M</button>
                        <button class="py-2 border rounded hover:border-black">L</button>
                        <button class="py-2 border rounded hover:border-black">XL</button>
                    </div>
                </div>

                <!-- Quantity & Add to Cart -->
                <div class="mb-6">
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex items-center border rounded">
                            <button class="px-4 py-2 border-r">-</button>
                            <input type="number" value="1" class="w-16 text-center">
                            <button class="px-4 py-2 border-l">+</button>
                        </div>
                        <button class="bg-black text-white px-8 py-2 rounded hover:bg-gray-800">Add to Cart</button>
                    </div>
                    <div class="text-sm text-gray-600">In stock - Ready to ship</div>
                </div>

                <!-- Product Details Accordion -->
                <div class="border-t pt-4">
                    <div class="border-b py-2">
                        <details class="group">
                            <summary class="flex justify-between items-center cursor-pointer">
                                <span class="font-semibold">Description</span>
                                <svg class="w-5 h-5 transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </summary>
                            <p class="mt-2 text-gray-600">Bodycon mini dress with floral print. Features: Round neck, short sleeves, fitted silhouette, and stretchy fabric for comfort.</p>
                        </details>
                    </div>
                    <div class="border-b py-2">
                        <details class="group">
                            <summary class="flex justify-between items-center cursor-pointer">
                                <span class="font-semibold">Care Instructions</span>
                                <svg class="w-5 h-5 transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </summary>
                            <p class="mt-2 text-gray-600">Machine wash cold, gentle cycle. Do not bleach. Lay flat to dry. Iron low heat.</p>
                        </details>
                    </div>
                </div>

                <!-- Trust Badges -->
                <div class="mt-6 flex flex-wrap gap-4">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm">Secure Payment</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm">Fast Delivery</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>