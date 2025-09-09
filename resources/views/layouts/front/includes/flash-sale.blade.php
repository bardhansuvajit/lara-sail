<div class="bg-gradient-to-r from-amber-500 to-red-500 dark:from-red-900 dark:to-red-500 border border-red-100 dark:border-red-800 {{FD['rounded']}} px-4 pt-4 pb-4">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-sm font-bold dark:text-white">Flash Sale</h3>
            <p class="{{ FD['text'] }} text-gray-200 dark:text-amber-200">Limited time - ends in</p>
        </div>
        <div id="countdown" class="{{ FD['text-2'] }} font-bold font-mono dark:text-white">00:10:00</div>
    </div>

    <div class="mt-3 grid grid-cols-2 gap-2 md:gap-4">
        @foreach($flashSaleProducts as $product)
            <a href="{{ route('front.product.detail', $product->slug) }}" class="block h-full">
                <div class="bg-white dark:bg-gray-800 p-2 {{ FD['rounded'] }} shadow-sm hover:shadow-lg h-full flex flex-col">
                    {{-- Image --}}
                    <div class="w-full h-28 flex-shrink-0">
                        @if (count($product->activeImages) > 0)
                            <img
                                src="{{ Storage::url($product->activeImages[0]->image_m) }}"
                                alt="{{ $product->slug }}"
                                loading="lazy"
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                            />
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400 dark:text-gray-500">
                                {!! FD['brokenImageFront'] !!}
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 flex flex-col justify-between mt-2">
                        {{-- Title --}}
                        <p class="{{ FD['text'] }} font-medium mt-2 mb-1">{{ $product['title'] }}</p>

                        {{-- price row --}}
                        @if ( !empty($product->FDPricing) )
                            @php
                                $p = $product->FDPricing;
                                $currencySymbol = $p->country->currency_symbol;
                            @endphp

                            <div class="mt-3 flex items-center justify-between gap-2">
                                <div>
                                    <div class="{{ FD['text-2'] }} font-extrabold text-gray-900 dark:text-white leading-none">
                                        <span class="currency-icon">{{ $currencySymbol }}</span>{{ formatIndianMoney($p->selling_price) }}
                                    </div>
                                    <div class="mt-1 flex items-center gap-2">
                                        @if($p->mrp && $p->mrp > 0)
                                            <span class="text-xs text-gray-400 dark:text-gray-400 line-through">
                                                <span class="currency-icon">{{ $currencySymbol }}</span>{{ formatIndianMoney($p->mrp) }}
                                            </span>
                                            <span class="text-xs font-semibold text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-900/20 px-2 py-0.5 {{ FD['rounded'] }}">
                                                {{ $p->discount }}% off
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        {{-- @if (count($product->pricings) > 0)
                            @php $p = $product->pricings[0]; @endphp

                            <div class="{{ FD['text-1'] }} font-extrabold text-gray-900 dark:text-white leading-none">
                                <span class="currency-icon">{{ $p->currency_symbol }}</span>{{ formatIndianMoney($p->selling_price) }}
                            </div>

                            <div class="mt-1 flex items-center gap-2">
                                @if($p->mrp && $p->mrp > 0)
                                    <span class="{{ FD['text'] }} text-gray-400 dark:text-gray-400 line-through">
                                        <span class="currency-icon">{{ $p->currency_symbol }}</span>{{ formatIndianMoney($p->mrp) }}
                                    </span>
                                    <span class="{{ FD['text'] }} font-semibold text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-900/20 px-2 py-0.5 {{ FD['rounded'] }}">
                                        {{ $p->discount }}% off
                                    </span>
                                @endif
                            </div>
                        @endif --}}
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>