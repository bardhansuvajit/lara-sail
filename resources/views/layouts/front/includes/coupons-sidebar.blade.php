<x-admin.sidebar name="coupons" maxWidth="sm" direction="right" header="Coupons" focusable>
    <div class="p-4">
        <div class="space-y-4">
            <!-- component -->
            <div class="container mx-auto">
                <div class="bg-gradient-to-br from-purple-600 to-indigo-600 text-white text-center p-4 rounded-lg shadow-md relative">
                    <img src="https://i.postimg.cc/KvTqpZq9/uber.png" class="w-20 mx-auto mb-4 rounded-lg">
                    <h3 class="text-base font-semibold mb-4">20% flat off on all rides within the city<br>using HDFC Credit Card</h3>
                    <div class="flex items-center space-x-2 mb-6">
                        <span id="cpnCode" class="border-dashed border text-white px-4 py-2 rounded-l">STEALDEAL20</span>
                        <span id="cpnBtn" class="border border-white bg-white text-purple-600 px-4 py-2 rounded-r cursor-pointer">Copy Code</span>
                    </div>

                    <p class="text-sm">Valid Till: 20Dec, 2021</p>

                    {{-- <div class="w-8 h-8 bg-white rounded-full absolute top-1/2 transform -translate-y-1/2 left-0 -ml-6"></div>
                    <div class="w-8 h-8 bg-white rounded-full absolute top-1/2 transform -translate-y-1/2 right-0 -mr-6"></div> --}}
                </div>
            </div>

            <!-- Promo Code Card 1 -->
            <div class="border border-gray-200 rounded-lg p-3 hover:border-blue-400 transition-colors">
                <div class="flex justify-between items-start">
                    <div>
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">FLAT50</span>
                    <h4 class="text-sm font-medium mt-1">Get ₹50 off on all orders</h4>
                    <p class="text-xs text-gray-500 mt-1">Valid on orders above ₹299</p>
                    </div>
                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Apply</button>
                </div>
                <div class="mt-2 text-xs text-gray-500">Expires: 31 Dec 2023</div>
            </div>

            <!-- Promo Code Card 2 -->
            <div class="border border-gray-200 rounded-lg p-3 hover:border-blue-400 transition-colors">
                <div class="flex justify-between items-start">
                    <div>
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">WELCOME10</span>
                    <h4 class="text-sm font-medium mt-1">10% off on first order</h4>
                    <p class="text-xs text-gray-500 mt-1">Max discount ₹200</p>
                    </div>
                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Apply</button>
                </div>
                <div class="mt-2 text-xs text-gray-500">New customers only</div>
            </div>

            <!-- Promo Code Card 3 -->
            <div class="border border-gray-200 rounded-lg p-3 opacity-50">
                <div class="flex justify-between items-start">
                    <div>
                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">FREESHIP</span>
                    <h4 class="text-sm font-medium mt-1">Free shipping</h4>
                    <p class="text-xs text-gray-500 mt-1">On orders above ₹499</p>
                    </div>
                    <span class="text-xs text-gray-500">Applied</span>
                </div>
            </div>

            <!-- Promo Code Card 4 -->
            <div class="border border-gray-200 rounded-lg p-3 hover:border-blue-400 transition-colors">
                <div class="flex justify-between items-start">
                    <div>
                    <span class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded">FESTIVE20</span>
                    <h4 class="text-sm font-medium mt-1">20% off on fashion</h4>
                    <p class="text-xs text-gray-500 mt-1">Selected items only</p>
                    </div>
                    <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">Apply</button>
                </div>
                <div class="mt-2 text-xs text-gray-500">Limited period offer</div>
            </div>
        </div>

        <div class="space-y-4 {{FD['rounded']}} border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
            <form class="space-y-4">
                <div>
                    <label for="voucher" class="mb-2 block {{FD['text']}} font-medium text-gray-900 dark:text-white"> Do you have a Promo code or voucher? </label>
                    <input type="text" id="voucher" class="block w-full {{FD['rounded']}} border border-gray-300 bg-gray-50 p-2.5 {{FD['text']}} text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Enter here..." required />
                </div>
                <button type="submit" class="flex w-full items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Apply Code</button>
            </form>
        </div>

        <!-- Footer -->
        {{-- <div class="absolute bottom-0 left-0 right-0 p-4 bg-gray-50 border-t border-gray-200">
            <button class="w-full bg-gray-900 text-white py-2 px-4 rounded-md text-sm font-medium hover:bg-gray-800 transition-colors">
            Close
            </button>
        </div> --}}
    </div>
</x-admin.sidebar>