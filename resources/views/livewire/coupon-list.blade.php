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
                <div class="flex flex-col gap-2 md:gap-4">
                    <div class="">
                        <div class="bg-gradient-to-br from-purple-600 to-indigo-600 text-white text-center p-4 {{ FD['rounded'] }} shadow-md relative">
                            <img src="https://i.postimg.cc/KvTqpZq9/uber.png" class="w-20 mx-auto mb-4 {{ FD['rounded'] }}">
                            <h3 class="text-base font-semibold mb-4">20% flat off on all rides within the city<br>using HDFC Credit Card</h3>
                            <div class="flex justify-center items-center space-x-2 mb-6">
                                <span id="cpnCode" class="border-dashed border text-white px-4 py-2 {{ FD['rounded'] }}">STEALDEAL20</span>
                                <span id="cpnBtn" class="border border-white bg-white text-purple-600 px-4 py-2 {{ FD['rounded'] }} cursor-pointer">Copy Code</span>
                            </div>

                            <p class="text-sm">Valid Till: 20Dec, 2021</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 mb-4">
                        @foreach($this->activeCoupons as $coupon)
                            @php
                                // $isFuture = Carbon\Carbon::parse($coupon->starts_at)->isPast() === false ? false : true; // keep simple
                                $isFuture = Carbon\Carbon::parse($coupon->starts_at)->isFuture();
                                $expires = Carbon\Carbon::parse($coupon->expires_at);
                                $now = Carbon\Carbon::now();
                                $daysLeft = $expires->diffInDays($now, false);
                                $remainingUses = is_null($coupon->usage_limit) ? null : max($coupon->usage_limit - $coupon->used_count, 0);
                                $symbol = $coupon->country_code === 'US' ? '$' : '₹';
                                // discount label
                                if ($coupon->discount_type === 'percentage') {
                                    $discountLabel = (int)$coupon->value . '% OFF';
                                } elseif ($coupon->discount_type === 'fixed') {
                                    $discountLabel = $symbol . formatIndianMoney($coupon->value, 2) . ' OFF';
                                } else {
                                    $discountLabel = 'FREE SHIPPING';
                                }
                            @endphp

                            <div wire:key="coupon-{{ $coupon->id }}" class="coupon-ticket bg-white dark:bg-gray-800 {{ FD['rounded'] }} overflow-hidden flex flex-col md:flex-row transition-transform duration-200">
                                <!-- LEFT STUB: discount hero -->
                                <div class="left-stub w-48 flex-shrink-0 p-4 md:p-6 flex items-center justify-center md:justify-start">
                                    <div class="text-center md:text-left">
                                        <div class="inline-flex items-center gap-2">
                                            <span class="inline-flex items-center gap-1 bg-gray-300 dark:bg-white/20 text-gray-700 dark:text-white text-xs font-semibold px-2 py-1 rounded-full uppercase tracking-wide">
                                                @if($coupon->discount_type === 'free_shipping')
                                                    <svg class="w-3.5 h-3.5 text-gray-700 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                                                        <path d="M240-160q-50 0-85-35t-35-85H40v-440q0-33 23.5-56.5T120-800h560v160h120l120 160v200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H360q0 50-35 85t-85 35Zm0-80q17 0 28.5-11.5T280-280q0-17-11.5-28.5T240-320q-17 0-28.5 11.5T200-280q0 17 11.5 28.5T240-240ZM120-360h32q17-18 39-29t49-11q27 0 49 11t39 29h272v-360H120v360Zm600 120q17 0 28.5-11.5T760-280q0-17-11.5-28.5T720-320q-17 0-28.5 11.5T680-280q0 17 11.5 28.5T720-240Zm-40-200h170l-90-120h-80v120ZM360-540Z"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-3.5 h-3.5 text-gray-700 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor">
                                                        <path d="M160-280v80h640v-80H160Zm0-440h88q-5-9-6.5-19t-1.5-21q0-50 35-85t85-35q30 0 55.5 15.5T460-826l20 26 20-26q18-24 44-39t56-15q50 0 85 35t35 85q0 11-1.5 21t-6.5 19h88q33 0 56.5 23.5T880-640v440q0 33-23.5 56.5T800-120H160q-33 0-56.5-23.5T80-200v-440q0-33 23.5-56.5T160-720Zm0 320h640v-240H596l84 114-64 46-136-184-136 184-64-46 82-114H160v240Zm200-320q17 0 28.5-11.5T400-760q0-17-11.5-28.5T360-800q-17 0-28.5 11.5T320-760q0 17 11.5 28.5T360-720Zm240 0q17 0 28.5-11.5T640-760q0-17-11.5-28.5T600-800q-17 0-28.5 11.5T560-760q0 17 11.5 28.5T600-720Z"/>
                                                    </svg>
                                                @endif
                                                Offer
                                            </span>
                                        </div>

                                        <div class="mt-3 text-gray-700 dark:text-white font-extrabold text-2xl md:text-3xl leading-tight">
                                            {{ $discountLabel }}
                                        </div>

                                        @if($coupon->discount_type === 'percentage' && $coupon->max_discount_amount)
                                            <div class="text-gray-700 dark:text-white/90 text-xs mt-1">Up to {{ $symbol }}{{ formatIndianMoney($coupon->max_discount_amount,0) }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="border-l border-dashed border-gray-200 dark:border-gray-600 w-px"></div>

                                <!-- RIGHT DETAILS -->
                                <div class="p-4 md:p-5 flex-1 flex flex-col justify-between">
                                    <div>
                                        <div class="flex items-start justify-between gap-3">
                                            <div>
                                                <h4 class="{{ FD['text-1'] }} text-gray-900 dark:text-white font-semibold leading-snug">
                                                    {{ $coupon->name }}
                                                </h4>
                                                <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-300 mt-1 line-clamp-2">
                                                    {{ $coupon->description }}
                                                </p>
                                            </div>

                                            <div class="text-right flex flex-col items-end gap-2">
                                                @if(!is_null($remainingUses) && $remainingUses < 5)
                                                    <span class="text-xs px-2 py-1 bg-red-100 dark:bg-red-700 text-gray-700 dark:text-gray-200 rounded-full font-medium">
                                                        Only {{ $remainingUses === 0 ? 'Last few' : $remainingUses . ' left' }}
                                                    </span>
                                                @endif

                                                <div class="mt-1 font-mono bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 px-3 py-1 {{ FD['rounded'] }} text-sm select-all">
                                                    {{ strtoupper($coupon->code) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700 flex flex-col justify-between gap-3">
                                        <div class="{{ FD['text-0'] }} text-gray-500 dark:text-gray-400">
                                            <span class="hidden sm:inline">*T&Cs apply. Valid once per user unless specified.</span>
                                            <span class="sm:hidden">*T&Cs apply</span>
                                        </div>

                                        <div class="flex ms-auto gap-3">
                                            <button
                                                wire:click="copyCouponCode('{{ $coupon->code }}')"
                                                class="flex items-center gap-2 p-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 {{ FD['rounded'] }} {{ FD['text'] }} font-semibold transition-all duration-200 min-w-[100px] justify-center"
                                                aria-pressed="{{ $copiedCode === $coupon->code ? 'true' : 'false' }}"
                                                title="{{ $copiedCode === $coupon->code ? 'Copied!' : 'Copy coupon code' }}"
                                                >
                                                @if($copiedCode === $coupon->code)
                                                    <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                    <span class="text-green-600 font-medium">Copied</span>
                                                @else
                                                    <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                                    <span>Copy</span>
                                                @endif
                                            </button>

                                            @if($appliedCouponCode && strcasecmp($appliedCouponCode, $coupon->code) === 0)
                                                <button
                                                    class="flex items-center gap-2 p-2 bg-gray-300 text-gray-700 {{ FD['rounded'] }} {{ FD['text'] }} border border-gray-200"
                                                    disabled
                                                    aria-disabled="true"
                                                    title="Coupon already applied"
                                                >
                                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M5 13l4 4L19 7"/></svg>
                                                    <span>Applied</span>
                                                </button>
                                            @else
                                                <button
                                                    wire:click="applyCoupon('{{ $coupon->code }}')"
                                                    class="flex items-center gap-2 p-2 bg-green-600 hover:bg-green-700 text-white {{ FD['rounded'] }} {{ FD['text'] }} border border-green-700 dark:border-green-600"
                                                    title="Apply coupon to cart"
                                                >
                                                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M5 13l4 4L19 7"/></svg>
                                                    <span>Apply Code</span>
                                                </button>
                                            @endif


                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="sticky bottom-0 -m-4">
                        <div class="space-y-4 {{ FD['rounded'] }} border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-4">
                            <div>
                                <label for="voucher" class="mb-2 block {{FD['text']}} font-medium text-gray-900 dark:text-white"> 
                                    Do you have a Promo code or voucher? 
                                </label>
                                <div class="flex gap-3">
                                    <input 
                                        type="text" 
                                        id="voucher" 
                                        wire:model="voucherInput"
                                        class="flex-1 block {{ FD['rounded'] }} border border-gray-300 bg-gray-50 p-2.5 {{FD['text']}} text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" 
                                        placeholder="Enter here..." 
                                        wire:keydown.enter="applyCoupon"
                                    />
                                    <button 
                                        type="button" 
                                        wire:click="applyCoupon"
                                        class="flex-shrink-0 {{ FD['rounded'] }} bg-primary-700 px-6 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 whitespace-nowrap"
                                    >
                                        Apply Code
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
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
</div>
