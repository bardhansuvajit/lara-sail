<div>
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-200 {{FD['text-1']}} p-4 md:p-6">
        <!-- Header -->
        <header class="mb-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-xl font-bold">Order Invoice</h1>
                <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">Invoice #{{$order->order_number}}</p>
            </div>
            <div class="flex flex-col items-end">
                <div class="text-right">
                <p class="font-medium">Order Placed</p>
                <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">May 15, 2023 at 10:30 AM</p>
                </div>
            </div>
            </div>
        </header>

        <!-- Order Summary -->
        <div class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Shipping Address -->
            <div class="bg-white dark:bg-gray-800 p-4 {{FD['rounded']}} shadow-sm">
            <h2 class="font-medium mb-2">Shipping Address</h2>
            <p class="{{FD['text']}} mb-1">John Doe</p>
            <p class="{{FD['text']}} mb-1">123 Main Street</p>
            <p class="{{FD['text']}} mb-1">Apartment 4B</p>
            <p class="{{FD['text']}} mb-1">New York, NY 10001</p>
            <p class="{{FD['text']}} mb-1">United States</p>
            <p class="{{FD['text']}} text-gray-500 dark:text-gray-400 mt-2">Phone: +1 (555) 123-4567</p>
            </div>

            <!-- Payment Method -->
            <div class="bg-white dark:bg-gray-800 p-4 {{FD['rounded']}} shadow-sm">
            <h2 class="font-medium mb-2">Payment Method</h2>
            <div class="flex items-center gap-2 mb-2">
                <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                </div>
                <p class="{{FD['text']}}">Visa ending in 4242</p>
            </div>
            <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">Billing address same as shipping</p>
            </div>

            <!-- Order Summary -->
            <div class="bg-white dark:bg-gray-800 p-4 {{FD['rounded']}} shadow-sm">
            <h2 class="font-medium mb-2">Order Summary</h2>
            <div class="flex justify-between {{FD['text']}} mb-1">
                <span>Items (3):</span>
                <span>$127.96</span>
            </div>
            <div class="flex justify-between {{FD['text']}} mb-1">
                <span>Shipping:</span>
                <span>$5.99</span>
            </div>
            <div class="flex justify-between {{FD['text']}} mb-1">
                <span>Tax:</span>
                <span>$8.35</span>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-700 my-2"></div>
            <div class="flex justify-between font-medium">
                <span>Order Total:</span>
                <span>$142.30</span>
            </div>
            </div>
        </div>

        <!-- Order Items -->
        <div class="mb-8">
            <h2 class="font-medium mb-4">Order Items</h2>
            <div class="bg-white dark:bg-gray-800 {{FD['rounded']}} shadow-sm overflow-hidden">
            <!-- Item 1 -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex gap-4">
                <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded flex-shrink-0 overflow-hidden">
                    <img src="https://via.placeholder.com/80" alt="Product" class="w-full h-full object-cover">
                </div>
                <div class="flex-grow">
                    <h3 class="font-medium">Wireless Bluetooth Headphones</h3>
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400 mb-1">Color: Black</p>
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">Sold by: AudioTech</p>
                </div>
                <div class="flex flex-col items-end">
                    <p class="font-medium">$59.99</p>
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">Qty: 1</p>
                </div>
                </div>
            </div>

            <!-- Item 2 -->
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex gap-4">
                <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded flex-shrink-0 overflow-hidden">
                    <img src="https://via.placeholder.com/80" alt="Product" class="w-full h-full object-cover">
                </div>
                <div class="flex-grow">
                    <h3 class="font-medium">Smart Watch Series 5</h3>
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400 mb-1">Size: 42mm</p>
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">Sold by: TechGadgets</p>
                </div>
                <div class="flex flex-col items-end">
                    <p class="font-medium">$199.00</p>
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">Qty: 1</p>
                </div>
                </div>
            </div>

            <!-- Item 3 -->
            <div class="p-4">
                <div class="flex gap-4">
                <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded flex-shrink-0 overflow-hidden">
                    <img src="https://via.placeholder.com/80" alt="Product" class="w-full h-full object-cover">
                </div>
                <div class="flex-grow">
                    <h3 class="font-medium">USB-C Charging Cable</h3>
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400 mb-1">Length: 6ft</p>
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">Sold by: CableWorld</p>
                </div>
                <div class="flex flex-col items-end">
                    <p class="font-medium">$12.99</p>
                    <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">Qty: 2</p>
                </div>
                </div>
            </div>
            </div>
        </div>

        <!-- Order Status -->
        <div class="mb-8">
            <h2 class="font-medium mb-4">Order Status</h2>
            <div class="bg-white dark:bg-gray-800 p-4 {{FD['rounded']}} shadow-sm">
            <div class="flex items-center gap-4 mb-4">
                <div class="relative">
                <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="absolute left-4 top-8 h-8 w-0.5 bg-green-500"></div>
                </div>
                <div>
                <p class="font-medium">Order Confirmed</p>
                <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">May 15, 2023 at 10:30 AM</p>
                </div>
            </div>

            <div class="flex items-center gap-4 mb-4">
                <div class="relative">
                <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="absolute left-4 top-8 h-8 w-0.5 bg-green-500"></div>
                </div>
                <div>
                <p class="font-medium">Shipped</p>
                <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">May 16, 2023 at 2:15 PM</p>
                <p class="{{FD['text']}} mt-1">Tracking #: <span class="text-blue-600 dark:text-blue-400">1Z2345A6789123456</span></p>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <div class="relative">
                <div class="w-8 h-8 rounded-full bg-gray-300 dark:bg-gray-600 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-500 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                </div>
                <div>
                <p class="font-medium">Delivered</p>
                <p class="{{FD['text']}} text-gray-500 dark:text-gray-400">Estimated: May 18, 2023</p>
                </div>
            </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row gap-3 justify-end">
            <button class="px-4 py-2 border border-gray-300 dark:border-gray-600 {{FD['rounded']}} {{FD['text']}} font-medium hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
            Print Invoice
            </button>
            <button class="px-4 py-2 bg-blue-600 text-white {{FD['rounded']}} {{FD['text']}} font-medium hover:bg-blue-700 transition-colors">
            Track Package
            </button>
        </div>
    </div>
</div>