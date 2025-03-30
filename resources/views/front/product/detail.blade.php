<x-app-layout
    screen="max-w-screen-xl"
    title="{{ __('Product') }}">

    <div class="container mx-auto px-4 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Product Images -->
            {{-- <div class="swiper main-swiper aspect-square rounded-lg shadow-lg"> --}}
            <div class="swiper main-swiper rounded-lg shadow-lg">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"><img src="https://placehold.co/800x800" class="w-full h-full object-cover"></div>
                    <div class="swiper-slide"><img src="https://placehold.co/800x800" class="w-full h-full object-cover"></div>
                </div>
                <div class="swiper-pagination"></div>
                <button class="swiper-button-next"></button>
                <button class="swiper-button-prev"></button>
            </div>

            <!-- Product Info -->
            <div class="space-y-4">
                {{-- primary info --}}
                <div class="">
                    {{-- title --}}
                    <h4 class="{{FD['text']}} sm:text-base text-gray-500 dark:text-gray-300 font-medium">Blue Floral Bodycon Mini Dress</h4>

                    {{-- short rating --}}
                    <div class="flex items-center space-x-2 mt-2">
                        <div class="flex items-center text-yellow-400 text-sm">
                            <div class="w-10 h-5 flex space-x-1 items-center bg-gray-50 px-1 border">
                                <p class="{{FD['text-0']}} text-gray-900 font-bold">3.9</p>
                                <div class="{{FD['iconClass']}} text-yellow-400 flex items-center">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"></path></svg>
                                </div>
                            </div>
                            <span class="text-gray-600 dark:text-gray-400 ml-2 {{FD['text']}}">(128 reviews)</span>
                        </div>

                        <span class="text-green-600 {{FD['text']}}">In Stock</span>
                    </div>

                    <div class="border-t dark:border-gray-700 my-4"></div>

                    {{-- pricing --}}
                    <div class="mt-2 flex items-center gap-4">
                        <p class="{{FD['text-2']}} font-bold leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                            <span class="currency-icon">$</span>1,09,699
                        </p>
                        <p class="{{FD['text-2']}} font-light line-through decoration-1 dark:decoration-gray-400 leading-tight text-gray-400 dark:text-gray-400 mb-4 sm:mb-0">
                            <span class="currency-icon">$</span>17,699
                        </p>
                        <p class="{{FD['text-1']}} font-black leading-tight {{FD['activeClass']}} mb-4 sm:mb-0">
                            40% off
                        </p>
                    </div>

                    <p class="{{FD['text-0']}} text-gray-500">Inclusive of all taxes</p>

                    <div class="flex space-x-2 items-center bg-green-200 dark:bg-green-900 text-gray-900 dark:text-gray-300 mt-3 p-2">
                        <div class="{{FD['iconClass']}}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M640-240v-80h104L536-526 376-366 80-664l56-56 240 240 160-160 264 264v-104h80v240H640Z"/></svg>
                        </div>

                        <p class="{{FD['text']}} font-bold">Lowest price in last 30 days</p>
                    </div>

                    <div class="border-t dark:border-gray-700 my-4"></div>
                </div>


                {{-- variation --}}
                <div>
                    <h3 class="{{FD['text-1']}} font-semibold mb-2 dark:text-gray-500">Color</h3>

                    <div class="w-full grid grid-cols-6 gap-4">
                        <div class="text-center">
                            <div class="flex flex-col items-center gap-2">
                                <img src="https://placehold.co/40x40" class="rounded-full">
                                <div>
                                    <div class="font-semibold">Lime</div>
                                    <div class="text-sm text-gray-600">4.8 ★ (2.5k Ratings)</div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <div class="flex flex-col items-center gap-2">
                                <img src="https://placehold.co/40x40" class="rounded-full">
                                <div>
                                    <div class="font-semibold">Lime</div>
                                    <div class="text-sm text-gray-600">4.8 ★ (2.5k Ratings)</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="flex gap-2">
                        <button class="w-8 h-8 rounded-full bg-blue-600 border-2 border-gray-300"></button>
                        <button class="w-8 h-8 rounded-full bg-red-600 border-2"></button>
                    </div> --}}
                </div>
                {{-- <div>
                    <h3 class="{{FD['text']}} font-semibold mb-2">Size</h3>
                    <div class="grid grid-cols-3 gap-2">
                        <button class="py-1 border text-sm hover:border-black">S</button>
                        <button class="py-1 border text-sm hover:border-black bg-black text-white">M</button>
                        <button class="py-1 border text-sm hover:border-black">L</button>
                    </div>
                </div> --}}

                <div class="border-t dark:border-gray-700 my-4"></div>


                {{-- short description --}}
                <p class="{{FD['text']}} text-gray-500">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quibusdam beatae, consequuntur, eius illo pariatur odit et eveniet corrupti, omnis accusamus suscipit sunt! Optio, repellat laboriosam aliquid labore impedit quos sunt! Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi incidunt blanditiis excepturi et minus sint officiis quibusdam a neque, velit asperiores iure repellat? Ipsam laudantium explicabo dolorem reiciendis doloribus eos?</p>


                <!-- Action Buttons -->
                {{-- <div class="space-y-2">
                    <div class="flex gap-2">
                        <button class="flex-1 bg-yellow-400 py-3 text-sm font-bold hover:bg-yellow-500">BUY NOW</button>
                        <button class="flex-1 bg-gray-900 text-white py-3 text-sm font-bold hover:bg-gray-800">ADD TO CART</button>
                        <button class="w-12 border hover:bg-gray-100" id="wishlistBtn">
                            <i class="far fa-heart"></i>
                        </button>
                    </div>
                    <div class="text-sm text-gray-600">Delivery by Tomorrow, Free Shipping</div>
                </div> --}}

                <!-- Highlights -->
                {{-- <div class="bg-gray-100 p-4 rounded">
                    <h3 class="font-semibold mb-2">Product Highlights</h3>
                    <ul class="text-sm space-y-1 list-disc pl-4">
                        <li>100% Cotton</li>
                        <li>Machine Wash</li>
                        <li>Imported Fabric</li>
                        <li>30 Days Return Policy</li>
                    </ul>
                </div> --}}

                <!-- Seller Info -->
                <div class="pt-4">
                    <div class="flex items-center gap-2">
                        <img src="https://placehold.co/40x40" class="rounded-full">
                        <div>
                            <div class="font-semibold">FashionHub Store</div>
                            <div class="text-sm text-gray-600">4.8 ★ (2.5k Ratings)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <div class="flex border-b" id="tabs">
                <button class="px-4 py-2 font-medium border-b-2 border-transparent hover:border-black" data-tab="description">Description</button>
                <button class="px-4 py-2 font-medium border-b-2 border-transparent hover:border-black" data-tab="reviews">Reviews (128)</button>
                <button class="px-4 py-2 font-medium border-b-2 border-transparent hover:border-black" data-tab="qa">Q&A (23)</button>
            </div>

            <!-- Tab Contents -->
            <div class="py-4" id="description">
                <h3 class="font-semibold mb-2">Product Details</h3>
                <p class="text-gray-600 text-sm">Floral print bodycon dress with stretchable fabric. Perfect for casual outings and parties. Available in multiple colors and sizes.</p>
            </div>

            <div class="py-4 hidden" id="reviews">
                <div class="space-y-4">
                    <!-- Review 1 -->
                    <div class="border-b pb-4">
                        <div class="flex items-center gap-2">
                            <div class="text-yellow-400">★★★★☆</div>
                            <div class="text-sm font-semibold">Rahul Sharma</div>
                            <div class="text-gray-500 text-sm">2 days ago</div>
                        </div>
                        <p class="mt-2 text-sm">Good quality fabric but runs slightly small. Size up recommended.</p>
                        <div class="flex gap-2 mt-2">
                            <img src="https://placehold.co/80x80" class="w-20 h-20 object-cover">
                            <img src="https://placehold.co/80x80" class="w-20 h-20 object-cover">
                        </div>
                    </div>
                    
                    <!-- Review Form -->
                    <div class="mt-4">
                        <h4 class="font-semibold mb-2">Write a Review</h4>
                        <textarea class="w-full border p-2 rounded" rows="3" placeholder="Share your experience..."></textarea>
                        <button class="mt-2 bg-black text-white px-4 py-2 text-sm rounded">Submit Review</button>
                    </div>
                </div>
            </div>

            <div class="py-4 hidden" id="qa">
                <div class="space-y-4">
                    <!-- Question 1 -->
                    <div class="border-b pb-4">
                        <div class="font-semibold">Q: Is this true to size?</div>
                        <div class="text-sm text-gray-600 mt-1">A: We recommend sizing up for a comfortable fit.</div>
                        <div class="text-sm text-gray-500 mt-2">Asked by Priya M • 5 days ago</div>
                    </div>
                    
                    <!-- Ask Question -->
                    <div class="mt-4">
                        <input type="text" class="w-full border p-2 rounded" placeholder="Ask a question...">
                        <button class="mt-2 bg-black text-white px-4 py-2 text-sm rounded">Ask Question</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Swiper Init
            // new Swiper('.main-swiper', {
            //     pagination: { el: '.swiper-pagination', clickable: true },
            //     navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            // });

            // Tab Switching
            document.querySelectorAll('[data-tab]').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('[data-tab]').forEach(b => b.classList.remove('border-black'));
                    document.querySelectorAll('.tab-content').forEach(c => c.classList.add('hidden'));
                    btn.classList.add('border-black');
                    document.getElementById(btn.dataset.tab).classList.remove('hidden');
                });
            });

            // Wishlist Toggle
            const wishlistBtn = document.getElementById('wishlistBtn');
            if (wishlistBtn) {
                wishlistBtn.addEventListener('click', () => {
                    wishlistBtn.querySelector('i').classList.toggle('far');
                    wishlistBtn.querySelector('i').classList.toggle('fas');
                    wishlistBtn.querySelector('i').classList.toggle('text-red-500');
                });
            }
        </script>
    @endpush
</x-app-layout>
