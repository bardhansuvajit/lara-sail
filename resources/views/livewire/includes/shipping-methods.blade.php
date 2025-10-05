<div>
    <div class="grid grid-cols-3 gap-2">
        @foreach ($shippingMethods as $shipMethod)
            <x-front.radio-input-button 
                id="shipMethod{{$shipMethod->id}}" 
                name="shipping_address_id" 
                value="{{$shipMethod->id}}" 
                wire:model.lazy="selectedShippingMethod" 
            >
                <div class="">
                    <div class="w-10 h-10">{!! $shipMethod->icon !!}</div>

                    <div class="">
                        <h5 class="{{FD['text']}} font-medium text-slate-700 dark:text-white">{{$shipMethod->title}}</h5>

                        <p class="{{FD['text-0']}} text-slate-500 dark:text-gray-400 line-clamp-2">{{$shipMethod->subtitle}}</p>

                        <div class="mt-2 flex items-center gap-2">
                            <p class="text-lg md:text-sm font-medium text-slate-700 dark:text-white">
                                {{-- When shipping cost is 0 --}}
                                @if ($shipMethod->cost == 0)
                                    FREE
                                    {{-- @if ($cartSetting['min_order_value'] < $cart['total'])
                                            FREE
                                    @else
                                        FREE
                                    @endif --}}
                                {{-- When shipping costs MORE THAN 0 --}}
                                @else
                                    @if ($cartSetting['min_order_value'] < $cart['total'])
                                        + <span class="currency-symbol">{{COUNTRY['icon']}}</span>{{formatIndianMoney($shipMethod->cost)}}
                                    @else
                                        <span class="currency-symbol">{{COUNTRY['icon']}}</span>{{formatIndianMoney($shipMethod->cost)}}
                                    @endif
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </x-front.radio-input-button>
        @endforeach
    </div>
</div>