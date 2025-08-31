@props([
    'minPriceValue' => $minPriceValue,
    'filteredMinPriceValue' => $filteredMinPriceValue,

    'maxPriceValue' => $maxPriceValue,
    'filteredMaxPriceValue' => $filteredMaxPriceValue,

    'stepPrice' => $stepPrice,
    'minPriceName' => $minPriceName,
    'maxPriceName' => $maxPriceName,
])

<div class="">
    <label class="text-xs font-light">Price</label>
    <div class="mt-8">
        <div>
            <div id="rangeWrapper" class="w-full max-w-sm mx-auto" data-min="{{ $minPriceValue }}" data-max="{{ $maxPriceValue }}" data-step="{{ $stepPrice }}">
                <div class="relative">
                    <div class="relative h-1.5 rounded-full overflow-visible" style="background:var(--track,#e5e7eb);">
                        <div id="connect" class="absolute h-1.5 rounded-full" style="background:var(--connect,#3b82f6); left:0; width:0;"></div>
                    </div>

                    <input 
                        type="range" 
                        id="minRange" 
                        min="{{ $minPriceValue }}" 
                        max="{{ $maxPriceValue }}" 
                        step="{{ $stepPrice }}" 
                        value="{{ $filteredMinPriceValue ?? $minPriceValue }}" 
                        {{-- value="{{ $filters['min_price'] ?? max($minPriceValue, (int)($minPriceValue + ($maxPriceValue-$minPriceValue)*0.15)) }}"  --}}
                        aria-label="Minimum price" 
                        class="absolute inset-0 w-full h-6 appearance-none bg-transparent" 
                    />

                    <input 
                        type="range" 
                        id="maxRange" 
                        min="{{ $minPriceValue }}" 
                        max="{{ $maxPriceValue }}" 
                        step="{{ $stepPrice }}" 
                        value="{{ $filteredMaxPriceValue ?? $maxPriceValue }}" 
                        {{-- value="{{ $filters['max_price'] ?? min($maxPriceValue, (int)($maxPriceValue - ($maxPriceValue-$minPriceValue)*0.15)) }}"  --}}
                        aria-label="Maximum price" 
                        class="absolute inset-0 w-full h-6 appearance-none bg-transparent" 
                    />

                    <span id="minValue" class="absolute z-0 text-xs font-medium px-2 py-1 {{ FD['rounded'] }} shadow-md -mt-10 whitespace-nowrap" style="background:var(--tooltip-bg,#ffffff); color:var(--tooltip-text,#0f172a); border:1px solid rgba(0,0,0,0.06)">
                        <span class="currency-symbol">₹</span>{{ $minPriceValue }}
                    </span>

                    <span id="maxValue" class="absolute z-0 text-xs font-medium px-2 py-1 {{ FD['rounded'] }} shadow-md -mt-10 whitespace-nowrap" style="background:var(--tooltip-bg,#ffffff); color:var(--tooltip-text,#0f172a); border:1px solid rgba(0,0,0,0.06)">
                        <span class="currency-symbol">₹</span>{{ $maxPriceValue }}
                    </span>

                    <input type="hidden" id="min_price" name="{{ $minPriceName }}" value="{{ request('min_price', $minPriceValue) }}">
                    <input type="hidden" id="max_price" name="{{ $maxPriceName }}" value="{{ request('max_price', $maxPriceValue) }}">

                    <!-- Pips / ticks (server-rendered using PHP loop) -->
                    <div class="relative w-full h-6 mt-1">
                        <div class="absolute inset-x-2 inset-y-0">
                            @php
                                $range = $maxPriceValue - $minPriceValue;
                                if ($stepPrice <= 0) $stepPrice = 1;
                                for ($v = $minPriceValue; $v <= $maxPriceValue; $v += $stepPrice) {
                                    $pct = ($range === 0) ? 0 : (($v - $minPriceValue) / $range) * 100;
                                    $isMajor = ((($v - $minPriceValue) / $stepPrice) % 4 === 0);
                                    $height = $isMajor ? 10 : 6;
                                    $color = 'var(--pip,#cbd5e1)';
                                    echo "<span aria-hidden='true' style='position:absolute; left:{$pct}%; top:0; transform:translateX(-50%); height:{$height}px; width:1px; background:{$color};'></span>";
                                }
                            @endphp
                        </div>
                    </div>
                </div>
            </div>

            <style>
                :root{
                    --track: #e5e7eb;
                    --connect: #3b82f6;
                    --thumb: #3b82f6;
                    --tooltip-bg: #ffffff;
                    --tooltip-text: #0f172a;
                    --pip: #cbd5e1;
                }
                .dark, .dark :root {
                    --track: #374151;
                    --connect: #60a5fa;
                    --thumb: #60a5fa;
                    --tooltip-bg: #0f172a;
                    --tooltip-text: #f8fafc;
                    --pip: #4b5563;
                }

                /* Hide native track visuals but keep the input functional.
                    Thumb must accept pointer-events so it is draggable. */
                input[type=range] {
                    -webkit-appearance: none;
                    appearance: none;
                    background: transparent;
                    pointer-events: none; /* disable track pointer-capture; thumb will re-enable */
                }

                /* WebKit thumb: visible, centered on track, accepts pointer */
                input[type=range]::-webkit-slider-thumb {
                    -webkit-appearance: none;
                    appearance: none;
                    pointer-events: auto;
                    height: 14px;
                    width: 14px;
                    border-radius: 9999px;
                    background: var(--thumb);
                    border: 3px solid var(--tooltip-bg);
                    box-shadow: 0 2px 6px rgba(2,6,23,0.12);
                    margin-top: -18px; /* center on 1.5rem track */
                    cursor: grab;
                    position: relative;
                    z-index: 3; /* above connect */
                }
                input[type=range]:active::-webkit-slider-thumb { cursor: grabbing; }

                /* Firefox thumb */
                input[type=range]::-moz-range-thumb {
                    pointer-events: auto;
                    height: 14px;
                    width: 14px;
                    border-radius: 9999px;
                    background: var(--thumb);
                    border: 3px solid var(--tooltip-bg);
                    box-shadow: 0 2px 6px rgba(2,6,23,0.12);
                    cursor: grab;
                    position: relative;
                    z-index: 3;
                }

                /* Make sure connect is below the thumbs */
                #connect { z-index: 1; }

                /* Tooltips above everything */
                #minValue, #maxValue { transform: translateX(-50%); pointer-events: none; }

                /* Slightly bigger touch area while keeping small visual thumb */
                input[type=range] { height: 28px; }

                /* Ensure the thumbs stay clickable when overlapping */
                /* The following keeps thumb pointer events even if inputs overlap */
                input[type=range] { touch-action: none; -ms-touch-action: none; }
            </style>

            <script>
                (function(){
                    
                })();
            </script>
        </div>
    </div>
</div>