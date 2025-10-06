<div>
    <div class="coupon-list max-w-7xl mx-auto">
        <!-- Loading State -->
        @if ($isLoading)
            <div class="flex flex-col items-center justify-center py-12">
                <div class="animate-spin {{ FD['rounded'] }} h-12 w-12 border-b-2 border-blue-500 mb-4"></div>
                <p class="text-gray-600 dark:text-gray-400">Loading coupons...</p>
            </div>
        @endif

        <!-- Error State -->
        @if ($hasError && !$isLoading)
            <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 {{ FD['rounded'] }} p-6 text-center">
                <div class="text-red-500 dark:text-red-400 text-2xl mb-2">⚠️</div>
                <p class="text-red-800 dark:text-red-300 mb-4">{{ $errorMessage }}</p>
                <button 
                    wire:click="refreshCoupons" 
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 {{ FD['rounded'] }} transition-colors duration-200"
                >
                    Try Again
                </button>
            </div>
        @endif

        <!-- Success State -->
        @if (!$isLoading && !$hasError)
            @if($this->hasActiveCoupons)
                <div class="grid grid-cols-1 gap-6">
                    @foreach($this->activeCoupons as $coupon)
                        <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700 p-2 md:p-4 flex flex-col h-full"
                            wire:key="coupon-{{ $coupon->id }}">
                            
                            <h4 class="{{ FD['text-2'] }} font-semibold text-gray-900 dark:text-white flex-1 pr-2">
                                {{ $coupon->name }}
                            </h4>

                            <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-300 mb-4 flex-1">
                                {{ $coupon->description }}
                            </p>

                            <div class="flex gap-3 mb-3">
                                <code class="bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-gray-100 px-3 py-2 {{ FD['rounded'] }} font-mono text-sm flex-1 border border-gray-300 dark:border-gray-600 text-center">
                                    {{ $coupon->code }}
                                </code>
                                <button 
                                    wire:click="copyCouponCode('{{ $coupon->code }}')"
                                    class="flex items-center justify-center whitespace-nowrap px-4 py-2 {{ FD['rounded'] }} transition-colors duration-200 font-medium min-w-[80px] {{ $copiedCode === $coupon->code ? 'bg-green-600 hover:bg-green-700 text-white' : 'bg-blue-600 hover:bg-blue-700 text-white' }}"
                                    title="{{ $copiedCode === $coupon->code ? 'Copied!' : 'Copy coupon code' }}"
                                >
                                    @if($copiedCode === $coupon->code)
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Copied!
                                    @else
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                        Copy
                                    @endif
                                </button>
                            </div>

                            @if(\Carbon\Carbon::parse($coupon->expires_at)->isFuture())
                                <div class="text-center pt-3 border-t border-gray-200 dark:border-gray-600">
                                    <span class="text-xs text-orange-600 dark:text-orange-400 font-medium">
                                        Expires {{ \Carbon\Carbon::parse($coupon->expires_at)->diffForHumans() }}
                                    </span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">🎁</div>
                    <h4 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">No Active Coupons</h4>
                    <p class="text-gray-600 dark:text-gray-400">Check back later for exciting offers!</p>
                </div>
            @endif
        @endif
    </div>

    {{-- <div class="space-y-4">
        <!-- component -->
        <div class="container mx-auto">
            <div class="bg-gradient-to-br from-purple-600 to-indigo-600 text-white text-center p-4 {{ FD['rounded'] }} shadow-md relative">
                <img src="https://i.postimg.cc/KvTqpZq9/uber.png" class="w-20 mx-auto mb-4 {{ FD['rounded'] }}">
                <h3 class="text-base font-semibold mb-4">20% flat off on all rides within the city<br>using HDFC Credit Card</h3>
                <div class="flex items-center space-x-2 mb-6">
                    <span id="cpnCode" class="border-dashed border text-white px-4 py-2 {{ FD['rounded'] }}">STEALDEAL20</span>
                    <span id="cpnBtn" class="border border-white bg-white text-purple-600 px-4 py-2 {{ FD['rounded'] }} cursor-pointer">Copy Code</span>
                </div>

                <p class="text-sm">Valid Till: 20Dec, 2021</p>

                <div class="w-8 h-8 bg-white {{ FD['rounded'] }} absolute top-1/2 transform -translate-y-1/2 left-0 -ml-6"></div>
                <div class="w-8 h-8 bg-white {{ FD['rounded'] }} absolute top-1/2 transform -translate-y-1/2 right-0 -mr-6"></div>
            </div>
        </div>

        <!-- Promo Code Card 1 -->
        <div class="border border-gray-200 {{ FD['rounded'] }} p-3 hover:border-blue-400 transition-colors">
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
        <div class="border border-gray-200 {{ FD['rounded'] }} p-3 hover:border-blue-400 transition-colors">
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
        <div class="border border-gray-200 {{ FD['rounded'] }} p-3 opacity-50">
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
        <div class="border border-gray-200 {{ FD['rounded'] }} p-3 hover:border-blue-400 transition-colors">
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

        <div class="space-y-4 {{ FD['rounded'] }} border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
            <form class="space-y-4">
                <div>
                    <label for="voucher" class="mb-2 block {{FD['text']}} font-medium text-gray-900 dark:text-white"> Do you have a Promo code or voucher? </label>
                    <input type="text" id="voucher" class="block w-full {{ FD['rounded'] }} border border-gray-300 bg-gray-50 p-2.5 {{FD['text']}} text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" placeholder="Enter here..." required />
                </div>
                <button type="submit" class="flex w-full items-center justify-center {{ FD['rounded'] }} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Apply Code</button>
            </form>
        </div>
    </div> --}}

    <!-- Footer -->
    {{-- <div class="absolute bottom-0 left-0 right-0 p-4 bg-gray-50 border-t border-gray-200">
        <button class="w-full bg-gray-900 text-white py-2 px-4 {{ FD['rounded'] }} text-sm font-medium hover:bg-gray-800 transition-colors">
        Close
        </button>
    </div> --}}
</div>