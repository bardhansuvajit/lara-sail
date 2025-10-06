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
                <div class="container mx-auto">
                    <div class="bg-gradient-to-br from-purple-600 to-indigo-600 text-white text-center p-4 {{ FD['rounded'] }} shadow-md relative">
                        <img src="https://i.postimg.cc/KvTqpZq9/uber.png" class="w-20 mx-auto mb-4 {{ FD['rounded'] }}">
                        <h3 class="text-base font-semibold mb-4">20% flat off on all rides within the city<br>using HDFC Credit Card</h3>
                        <div class="flex items-center space-x-2 mb-6">
                            <span id="cpnCode" class="border-dashed border text-white px-4 py-2 {{ FD['rounded'] }}">STEALDEAL20</span>
                            <span id="cpnBtn" class="border border-white bg-white text-purple-600 px-4 py-2 {{ FD['rounded'] }} cursor-pointer">Copy Code</span>
                        </div>

                        <p class="text-sm">Valid Till: 20Dec, 2021</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-6">
                    @foreach($this->activeCoupons as $coupon)
                        @php
                            $isFuture = Carbon\Carbon::parse($coupon->starts_at)->isPast() === false ? false : true; // keep simple
                            $expires = Carbon\Carbon::parse($coupon->expires_at);
                            $now = Carbon\Carbon::now();
                            $daysLeft = $expires->diffInDays($now, false);
                            $remainingUses = is_null($coupon->usage_limit) ? null : max($coupon->usage_limit - $coupon->used_count, 0);
                            $symbol = $coupon->country_code === 'US' ? '$' : '₹';
                            // discount label
                            if ($coupon->discount_type === 'percentage') {
                                $discountLabel = (int)$coupon->value . '% OFF';
                            } elseif ($coupon->discount_type === 'fixed') {
                                $discountLabel = $symbol . number_format($coupon->value, 2) . ' OFF';
                            } else {
                                $discountLabel = 'FREE SHIPPING';
                            }
                        @endphp

                        <div wire:key="coupon-{{ $coupon->id }}" class="coupon-ticket bg-white dark:bg-gray-800 {{ FD['rounded'] }} overflow-hidden flex flex-col md:flex-row transition-transform duration-200">

                            {{-- LEFT STUB: discount hero --}}
                            <div class="left-stub flex-shrink-0 p-4 md:p-6 flex items-center justify-center md:justify-start">
                                <div class="text-center md:text-left">
                                    <div class="inline-flex items-center gap-2">
                                        <span class="inline-block bg-gray-300 dark:bg-white/20 text-gray-700 dark:text-white text-xs font-semibold px-2 py-1 rounded-full uppercase tracking-wide">Offer</span>
                                        @if($coupon->discount_type === 'free_shipping')
                                            <svg class="w-5 h-5 text-gray-700 dark:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7h13l3 4v6a1 1 0 0 1-1 1h-1M16 19a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/></svg>
                                        @endif
                                    </div>

                                    <div class="mt-3 text-gray-700 dark:text-white font-extrabold text-2xl md:text-3xl leading-tight">
                                        {{ $discountLabel }}
                                    </div>

                                    @if($coupon->discount_type === 'percentage' && $coupon->max_discount_amount)
                                        <div class="text-gray-700 dark:text-white/90 text-xs mt-1">Up to {{ $symbol }}{{ number_format($coupon->max_discount_amount,0) }}</div>
                                    @endif
                                </div>
                            </div>

                            {{-- PERFORATED DIVIDER --}}
                            {{-- <div class="perforation hidden md:block w-px bg-gradient-to-b from-transparent via-gray-300 to-transparent relative"></div> --}}

                            <div class="border border-dashed border-gray-200 dark:border-gray-600"></div>

                            {{-- RIGHT DETAILS --}}
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

                                            {{-- <span class="text-xs text-gray-500 dark:text-gray-400">Code</span> --}}
                                            <div class="mt-1 font-mono bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-800 px-3 py-1 {{ FD['rounded'] }} text-sm select-all">
                                                {{ strtoupper($coupon->code) }}
                                            </div>
                                        </div>
                                    </div>

                                    {{-- meta row --}}
                                    {{-- <div class="mt-4 grid grid-cols-2 gap-3 text-sm">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3"/></svg>
                                            <div class="text-gray-700 dark:text-gray-300">
                                                Expires <span class="font-medium">{{ $expires->format('d M, Y') }}</span>
                                                @if($expires->isFuture())
                                                    <span class="text-xs text-orange-600 dark:text-orange-400 ml-2">({{ $expires->diffForHumans() }})</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7h13l3 4v6a1 1 0 0 1-1 1h-1"/></svg>
                                            <div class="text-gray-700 dark:text-gray-300">
                                                Min cart <span class="font-medium">{{ is_null($coupon->min_cart_value) ? '—' : ($symbol . number_format($coupon->min_cart_value, 2)) }}</span>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/></svg>
                                            <div class="text-gray-700 dark:text-gray-300">
                                                Usage per user <span class="font-medium">{{ $coupon->usage_per_user ?? '1' }}</span>
                                            </div>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2L2 7l10 5 10-5-10-5z"/></svg>
                                            <div class="text-gray-700 dark:text-gray-300">
                                                Country <span class="font-medium">{{ $coupon->country_code }}</span>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>

                                {{-- footer: small terms + action --}}
                                <div class="mt-4 pt-3 border-t border-gray-100 dark:border-gray-700 flex flex-col items-center justify-between gap-3">
                                    <div class="{{ FD['text-0'] }} text-gray-500 dark:text-gray-400">
                                        <span class="hidden sm:inline">*T&Cs apply. Valid once per user unless specified.</span>
                                        <span class="sm:hidden">*T&Cs apply</span>
                                    </div>

                                    <div class="flex items-center gap-3">
                                        <button
                                            wire:click="copyCouponCode('{{ $coupon->code }}')"
                                            class="flex items-center gap-2 p-2 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800 {{ FD['rounded'] }} {{ FD['text'] }} font-semibold transition-all duration-200 min-w-[100px] justify-center"
                                            aria-pressed="{{ $copiedCode === $coupon->code ? 'true' : 'false' }}"
                                            title="{{ $copiedCode === $coupon->code ? 'Copied!' : 'Copy coupon code' }}"
                                            {{-- :class="{{ $copiedCode === $coupon->code }} ? 'bg-green-600 text-green-900 focus:bg-green-300 border-green-200' : ''" --}}
                                            >
                                            @if($copiedCode === $coupon->code)
                                                <svg class="w-4 h-4 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                                <span class="text-green-600 font-medium">Copied</span>
                                            @else
                                                <svg class="w-4 h-4 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                                <span>Copy</span>
                                            @endif
                                        </button>

                                        <button
                                            onclick="applyCoupon('{{ $coupon->code }}')"
                                            class="flex items-center gap-2 p-2 bg-green-600 hover:bg-green-700 text-white {{ FD['rounded'] }} {{ FD['text'] }} font-semibold focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-400 transition-all duration-200 shadow-sm hover:shadow-md transform hover:scale-105"
                                            title="Apply coupon to cart"
                                            >
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>Apply Code</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <style>
                        /* The notch circles on the left & right (visible on md+) */
                        .coupon-ticket { position: relative; }
                        .coupon-ticket .left-stub { position: relative; min-width: 180px; }
                        .coupon-ticket::before,
                        .coupon-ticket::after {
                        content: "";
                        position: absolute;
                        width: 36px;
                        height: 36px;
                        border-radius: 50%;
                        left: -18px;
                        top: calc(50% - 18px);
                        pointer-events: none;
                        background: white; /* light-mode page bg */
                        }

                        /* dark-mode page bg override (for both system & class-based dark) */
                        @media (prefers-color-scheme: dark) {
                        .coupon-ticket::before,
                        .coupon-ticket::after { background: #f3f4f6; } /* Tailwind slate-900 / page dark bg */
                        }

                        /* If you use Tailwind's class-based dark mode (dark on <html>), ensure both states covered */
                        .dark .coupon-ticket::before,
                        .dark .coupon-ticket::after { background: #374151; }
                        /* right notch */
                        .coupon-ticket::after {
                            left: auto;
                            right: -18px;
                            transform: scale(1);
                        }

                        /* Perforation line (vertical) */
                        .perforation::before {
                            content: "";
                            position: absolute;
                            left: 50%;
                            transform: translateX(-50%);
                            top: 8%;
                            bottom: 8%;
                            width: 1px;
                            background-image: repeating-linear-gradient(to bottom, rgba(156,163,175,0.9) 0 6px, transparent 6px 12px);
                            opacity: 0.7;
                        }

                        /* Mobile stacked: hide notches/perforation on small screens */
                        @media (max-width: 767px) {
                            .coupon-ticket::before, .coupon-ticket::after, .perforation { display: none; }
                            .left-stub { min-width: auto; }
                        }
                    </style>

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