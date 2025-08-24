<aside class="hidden lg:block lg:col-span-3 space-y-4">
    <form id="filtersForm" method="GET" action="{{ route('front.category.detail', $category->slug) }}">
        <div class="bg-white dark:bg-gray-800 p-4 {{ FD['rounded'] }} shadow grid gap-4">
            <h3 class="text-sm font-semibold">Filters</h3>

            <div class="">
                <label class="text-xs font-light">Price</label>
                <div class="mt-8">
                    <div>
                        <div id="rangeWrapper" class="w-full max-w-sm mx-auto" data-min="<?= $minPriceValue ?>" data-max="<?= $maxPriceValue ?>" data-step="<?= $stepPrice ?>">

                            <div class="relative">
                                <div class="relative h-1.5 rounded-full overflow-visible" style="background:var(--track,#e5e7eb);">
                                    <div id="connect" class="absolute h-1.5 rounded-full" style="background:var(--connect,#3b82f6); left:0; width:0;"></div>
                                </div>

                                <input id="minRange" type="range" min="<?= $minPriceValue ?>" max="<?= $maxPriceValue ?>" step="<?= $stepPrice ?>" value="<?= $filters['min_price'] ?? max($minPriceValue, (int)($minPriceValue + ($maxPriceValue-$minPriceValue)*0.15)) ?>" aria-label="Minimum price" class="absolute inset-0 w-full h-6 appearance-none bg-transparent" />

                                <input id="maxRange" type="range" min="<?= $minPriceValue ?>" max="<?= $maxPriceValue ?>" step="<?= $stepPrice ?>" value="<?= $filters['max_price'] ?? min($maxPriceValue, (int)($maxPriceValue - ($maxPriceValue-$minPriceValue)*0.15)) ?>" aria-label="Maximum price" class="absolute inset-0 w-full h-6 appearance-none bg-transparent" />

                                <span id="minValue" class="absolute z-0 text-xs font-medium px-2 py-1 rounded-md shadow-md -mt-10 whitespace-nowrap" style="background:var(--tooltip-bg,#ffffff); color:var(--tooltip-text,#0f172a); border:1px solid rgba(0,0,0,0.06)">
                                    $0
                                </span>

                                <span id="maxValue" class="absolute z-0 text-xs font-medium px-2 py-1 rounded-md shadow-md -mt-10 whitespace-nowrap" style="background:var(--tooltip-bg,#ffffff); color:var(--tooltip-text,#0f172a); border:1px solid rgba(0,0,0,0.06)">
                                    $0
                                </span>

                                <input type="hidden" id="min_price" name="min_price" value="{{ request('min_price', 100) }}">
                                <input type="hidden" id="max_price" name="max_price" value="{{ request('max_price', 1000) }}">

                                <!-- Pips / ticks (server-rendered using PHP loop) -->
                                <div class="relative w-full h-6 mt-1">
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
                                const wrapper = document.getElementById('rangeWrapper');
                                const minRange = document.getElementById('minRange');
                                const maxRange = document.getElementById('maxRange');
                                const connect = document.getElementById('connect');
                                const minValue = document.getElementById('minValue');
                                const maxValue = document.getElementById('maxValue');

                                // Read values from data attributes (set via PHP)
                                const MIN = Number(wrapper.dataset.min || minRange.min || 0);
                                const MAX = Number(wrapper.dataset.max || minRange.max || 500);
                                const STEP = Number(wrapper.dataset.step || minRange.step || 1);
                                const RANGE = MAX - MIN;

                                function pct(v){ return ((v - MIN) / (RANGE)) * 100; }

                                function updatePositions() {
                                    let a = Number(minRange.value);
                                    let b = Number(maxRange.value);

                                    // Prevent crossing: clamp the actively moved thumb
                                    if (a > b) {
                                        if (document.activeElement === minRange) {
                                            a = b;
                                            minRange.value = a;
                                        } else {
                                            b = a;
                                            maxRange.value = b;
                                        }
                                    }

                                    const pA = pct(a);
                                    const pB = pct(b);

                                    connect.style.left = pA + '%';
                                    connect.style.width = (pB - pA) + '%';

                                    // Position tooltips and update text
                                    minValue.style.left = pA + '%';
                                    maxValue.style.left = pB + '%';
                                    minValue.textContent = '$' + a;
                                    maxValue.textContent = '$' + b;

                                    // Update hidden inputs
                                    document.getElementById('min_price').value = a;
                                    document.getElementById('max_price').value = b;
                                }

                                // Ensure keyboard interaction updates visuals
                                minRange.addEventListener('input', updatePositions);
                                maxRange.addEventListener('input', updatePositions);
                                minRange.addEventListener('change', updatePositions);
                                maxRange.addEventListener('change', updatePositions);

                                // Allow arrow keys to change step increment if step provided
                                minRange.addEventListener('keydown', (e) => {
                                if (e.key === 'ArrowLeft' || e.key === 'ArrowDown') { e.preventDefault(); minRange.value = Math.max(MIN, Number(minRange.value) - STEP); updatePositions(); }
                                if (e.key === 'ArrowRight' || e.key === 'ArrowUp')   { e.preventDefault(); minRange.value = Math.min(MAX, Number(minRange.value) + STEP); updatePositions(); }
                                });
                                maxRange.addEventListener('keydown', (e) => {
                                if (e.key === 'ArrowLeft' || e.key === 'ArrowDown') { e.preventDefault(); maxRange.value = Math.max(MIN, Number(maxRange.value) - STEP); updatePositions(); }
                                if (e.key === 'ArrowRight' || e.key === 'ArrowUp')   { e.preventDefault(); maxRange.value = Math.min(MAX, Number(maxRange.value) + STEP); updatePositions(); }
                                });

                                // Init sensible defaults if server values are out of bounds
                                if (Number(minRange.value) < MIN) minRange.value = MIN;
                                if (Number(maxRange.value) > MAX) maxRange.value = MAX;

                                // Initialize UI
                                updatePositions();

                                // Also add this to ensure form submission includes all filters
                                document.getElementById('filtersForm').addEventListener('submit', function(e) {
                                    // Update price inputs one more time before submission
                                    updatePositions();
                                });
                            })();
                        </script>
                    </div>
                </div>
            </div>

            {{-- Subcategories --}}
            {{-- {{ dd($filters['category']) }} --}}
            @if($subcategories->isNotEmpty())
                <div class="">
                    <label class="text-xs font-light">Subcategories</label>
                    <div class="mt-2 grid gap-2">
                        @foreach($subcategories as $subCat)
                            <label class="inline-flex items-center text-xs">
                                <x-front.input-checkbox 
                                    id="subcat_checkbox_{{$subCat->id}}" 
                                    name="category[]" 
                                    value="{{ $subCat->id }}" 
                                    label="{{ $subCat->title }}" 
                                    :checked="collect(request('category', []))->contains((string) $subCat->id)"
                                    {{-- :checked="in_array($subCat->id, (array)request('brands', []))" --}}
                                />
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Rating --}}
            {{-- <div class="">
                <label class="text-xs font-light">Customer rating</label>
                <div class="mt-2 flex flex-col gap-2 text-xs">
                    @foreach([4,3,2,1] as $r)
                        <label class="inline-flex items-center">
                            <input type="radio" name="rating" value="{{ $r }}" {{ request('rating') == $r ? 'checked' : '' }} class="mr-2"> 
                            <span>{{ $r }} stars & up</span>
                        </label>
                    @endforeach
                </div>
            </div> --}}

            {{-- Sort By --}}
            @if(count($sortByArr) > 0)
                <div class="">
                    <label class="text-xs font-light">Sort By</label>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach($sortByArr as $key => $value)
                            <x-front.radio-input-button id="someId{{$key}}" name="sortBy" value="{{$key}}" :checked="request('sortBy') ? request('sortBy') == $key : $loop->first">
                                <div class="text-center">
                                    <div class="{{FD['text']}} font-semibold">{{$value}}</div>
                                </div>
                            </x-front.radio-input-button>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Attributes (colors, size) --}}
            @foreach($attributes ?? [] as $attr)
                <div class="mb-4">
                    <label class="text-xs font-medium">{{ $attr->name }}</label>
                    <div class="mt-2 grid gap-2 max-h-32 overflow-auto text-xs">
                        @foreach($attr->values as $val)
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="attrs[{{ $attr->id }}][]" value="{{ $val->id }}" {{ collect(request('attrs.'. $attr->id, []))->contains($val->id) ? 'checked' : '' }} class="mr-2"> {{ $val->value }}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <div class="flex items-center gap-2 mt-2">
                <x-front.button
                    type="submit"
                    class="w-20"
                    element="button">
                    {{ __('Apply') }}
                </x-front.button>
                {{-- <button type="submit" class="px-3 py-2 bg-indigo-600 text-white text-xs rounded">Apply</button> --}}
                <a href="{{ route('front.category.detail', $category->slug) }}" class="text-xs text-gray-500">Reset</a>
            </div>
        </div>
    </form>

    {{-- Upgraded competitive trust section --}}
    <div class="bg-white dark:bg-gray-800 p-4 {{ FD['rounded'] }} shadow text-xs">
        <h4 class="font-semibold mb-2 sm:mb-4">Why shop here?</h4>
        <ul class="space-y-3 text-gray-600">
            <li class="flex items-start gap-2">
                <div class="{{ FD['iconClass'] }} text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M720-440v-80h160v80H720Zm48 280-128-96 48-64 128 96-48 64Zm-80-480-48-64 128-96 48 64-128 96ZM200-200v-160h-40q-33 0-56.5-23.5T80-440v-80q0-33 23.5-56.5T160-600h160l200-120v480L320-360h-40v160h-80Zm240-182v-196l-98 58H160v80h182l98 58Zm120 36v-268q27 24 43.5 58.5T620-480q0 41-16.5 75.5T560-346ZM300-480Z"/></svg>
                </div>
                <div>
                    <div class="{{ FD['text'] }} font-medium dark:text-gray-400">Lowest prices & price-match</div>
                    <div class="{{ FD['text-0'] }} text-gray-400 dark:text-gray-500">We match prices so you always get the best deal.</div>
                </div>
            </li>

            <li class="flex items-start gap-2">
                <div class="{{ FD['iconClass'] }} text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M280-160q-50 0-85-35t-35-85H60l18-80h113q17-19 40-29.5t49-10.5q26 0 49 10.5t40 29.5h167l84-360H262l17-80h441l-37 160h117l120 160-40 200h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85H400q0 50-35 85t-85 35Zm357-280h193l4-21-74-99h-95l-28 120Zm-17-280-84 360 2-7 82-353ZM140-440v-120H40l140-200v120h100L140-440Zm140 200q17 0 28.5-11.5T320-280q0-17-11.5-28.5T280-320q-17 0-28.5 11.5T240-280q0 17 11.5 28.5T280-240Zm400 0q17 0 28.5-11.5T720-280q0-17-11.5-28.5T680-320q-17 0-28.5 11.5T640-280q0 17 11.5 28.5T680-240Z"/></svg>
                </div>
                <div>
                    <div class="{{ FD['text'] }} font-medium dark:text-gray-400">Fast delivery</div>
                    <div class="{{ FD['text-0'] }} text-gray-400 dark:text-gray-500">Same/next-day delivery in select cities.</div>
                </div>
            </li>

            <li class="flex items-start gap-2">
                <div class="{{ FD['iconClass'] }} text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="m480-320 56-56-63-64h167v-80H473l63-64-56-56-160 160 160 160ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h168q13-36 43.5-58t68.5-22q38 0 68.5 22t43.5 58h168q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm280-590q13 0 21.5-8.5T510-820q0-13-8.5-21.5T480-850q-13 0-21.5 8.5T450-820q0 13 8.5 21.5T480-790ZM200-200v-560 560Z"/></svg>
                </div>
                <div>
                    <div class="{{ FD['text'] }} font-medium dark:text-gray-400">Hassle-free returns</div>
                    <div class="{{ FD['text-0'] }} text-gray-400 dark:text-gray-500">30-day returns with easy pickups.</div>
                </div>
            </li>

            <li class="flex items-start gap-2">
                <div class="{{ FD['iconClass'] }} text-zinc-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-33 23.5-56.5T840-480v-160q-33 0-56.5-23.5T760-720H360q0 33-23.5 56.5T280-640v160q33 0 56.5 23.5T360-400Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z"/></svg>
                </div>
                <div>
                    <div class="{{ FD['text'] }} font-medium dark:text-gray-400">Secure payments & BNPL</div>
                    <div class="{{ FD['text-0'] }} text-gray-400 dark:text-gray-500">Multiple payment methods including EMI and BNPL.</div>
                </div>
            </li>

            <li class="flex items-start gap-2">
                <div class="{{ FD['iconClass'] }} text-yellow-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M440-120v-80h320v-284q0-117-81.5-198.5T480-764q-117 0-198.5 81.5T200-484v244h-40q-33 0-56.5-23.5T80-320v-80q0-21 10.5-39.5T120-469l3-53q8-68 39.5-126t79-101q47.5-43 109-67T480-840q68 0 129 24t109 66.5Q766-707 797-649t40 126l3 52q19 9 29.5 27t10.5 38v92q0 20-10.5 38T840-249v49q0 33-23.5 56.5T760-120H440Zm-80-280q-17 0-28.5-11.5T320-440q0-17 11.5-28.5T360-480q17 0 28.5 11.5T400-440q0 17-11.5 28.5T360-400Zm240 0q-17 0-28.5-11.5T560-440q0-17 11.5-28.5T600-480q17 0 28.5 11.5T640-440q0 17-11.5 28.5T600-400Zm-359-62q-7-106 64-182t177-76q89 0 156.5 56.5T720-519q-91-1-167.5-49T435-698q-16 80-67.5 142.5T241-462Z"/></svg>
                </div>
                <div>
                    <div class="{{ FD['text'] }} font-medium dark:text-gray-400">24/7 customer support</div>
                    <div class="{{ FD['text-0'] }} text-gray-400 dark:text-gray-500">Chat, call or email anytime.</div>
                </div>
            </li>
        </ul>
    </div>

</aside>