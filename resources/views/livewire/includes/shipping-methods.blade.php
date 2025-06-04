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
                        <h5 class="{{FD['text']}} font-medium text-gray-900 dark:text-white">{{$shipMethod->title}}</h5>

                        <p class="{{FD['text-0']}} dark:text-gray-400 line-clamp-2">{{$shipMethod->subtitle}}</p>

                        <div class="mt-2 flex items-center gap-2">
                            <p class="{{FD['text']}} font-medium leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                                {{-- When shipping cost is 0 --}}
                                @if ($shipMethod->cost == 0)
                                    @if ($cartSetting['min_order_value'] < $cart['total'])
                                        {{-- @if ($cart['shipping_cost'] == 0) --}}
                                            FREE
                                        {{-- @else
                                            <span class="currency-symbol">{{COUNTRY['icon']}}</span>{{formatIndianMoney($cartSetting['shipping_charge'])}}
                                        @endif --}}
                                    @else
                                        FREE
                                    @endif
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