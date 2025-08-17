<x-guest-layout 
    screen="max-w-screen-xl" 
    title="{{ __('Categories') }}">

    @php
        $featured = collect(range(1,8))->map(function($i){
            return [
                'id'=>$i,
                'title'=>"Featured Product $i",
                'price'=> rand(999,49999),
                'mrp'=> rand(50000,79999),
                'rating'=> round(3 + rand(0,20)/10,1),
                'image'=> "https://dummyimage.com/400x300/fff/aaa&text=Featured+{$i}",
                'badge'=> $i%2==0 ? 'Bestseller' : ($i%3==0 ? 'Limited' : null),
            ];
        });

        // $ads = [
        //     ['img' => 'https://dummyimage.com/1200x200/ffedd5/92400e&text=Top+Banner+Ad+-+Seasonal+Sale', 'url' => '#'],
        //     ['img' => 'https://dummyimage.com/600x400/ede9fe/6d28d9&text=Side+Ad+1', 'url' => '#'],
        //     ['img' => 'https://dummyimage.com/600x400/f0f9ff/0f172a&text=Side+Ad+2', 'url' => '#']
        // ];

        // $brands = ['Apple','Samsung','Nike','Adidas','Sony','Philips','BoAt'];
    @endphp

    <div class="flex flex-col gap-4 py-4 px-2 sm:px-0">

        {{-- Header --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-center justify-between">
            <div class="col-span-1">
                <h1 class="text-sm sm:text-lg font-bold text-gray-900 dark:text-white">{{ __('Explore categories') }}</h1>
                <p class="text-[10px] sm:text-xs text-gray-500 dark:text-gray-400 mt-1">{{ __('Browse by category - discover curated picks, deals and top brands.') }}</p>
            </div>

            <div class="col-span-1 sm:col-start-3 justify-self-end">
                <form action="" method="GET">
                    <div class="grid grid-cols-8 items-center gap-3">
                        <div class="col-span-6">
                            <x-front.text-input id="search" class="block w-full" type="text" name="search" placeholder="Search categories..." value="{{ request('search') }}" maxlength="80" autocomplete="search" required />
                        </div>

                        <div class="col-span-2">
                            <div class="flex gap-1">
                                <x-front.button
                                    type="submit"
                                    class="w-40"
                                    element="button">
                                    @slot('icon')
                                        <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M80-140v-320h320v320H80Zm80-80h160v-160H160v160Zm60-340 220-360 220 360H220Zm142-80h156l-78-126-78 126ZM863-42 757-148q-21 14-45.5 21t-51.5 7q-75 0-127.5-52.5T480-300q0-75 52.5-127.5T660-480q75 0 127.5 52.5T840-300q0 26-7 50.5T813-204L919-98l-56 56ZM660-200q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29ZM320-380Zm120-260Z"/></svg>
                                    @endslot
                                    {{ __('Search') }}
                                </x-front.button>
                            </div>
                        </div>
                    </div>

                    @if (request('search'))
                        <div class="flex justify-end mt-2">
                            <a href="{{ route('front.category.index') }}" class="text-[10px] inline-flex gap-2 items-center text-end text-amber-800/80 hover:text-amber-800 dark:text-amber-600/80 dark:hover:text-amber-600">
                                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m592-481-57-57 143-182H353l-80-80h487q25 0 36 22t-4 42L592-481ZM791-56 560-287v87q0 17-11.5 28.5T520-160h-80q-17 0-28.5-11.5T400-200v-247L56-791l56-57 736 736-57 56ZM535-538Z"/></svg>

                                Clear Filter
                            </a>
                        </div>
                    @endif

                </form>
            </div>

        </div>

        {{-- Top banner ad --}}
        @if ($categoryPageAd1)
            <a href="{{ $categoryPageAd1->url }}" class="block {{ FD['rounded'] }} overflow-hidden shadow">
                <img src="{{ Storage::url($categoryPageAd1->image_l) }}" alt="Top ad" class="w-full h-auto object-cover">
            </a>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4">

            {{-- Filters + Small Ads --}}
            <div class="hidden sm:block">
                @include('layouts.front.includes.categories-filter')
            </div>

            {{-- Categories + Featured Products --}}
            <main class="lg:col-span-3 space-y-4">
                {{-- All categories --}}
                <div class="bg-white dark:bg-gray-800 p-2 sm:p-4 {{ FD['rounded'] }} shadow">
                    <div class="flex items-center justify-between mb-4">
                        {{-- <h2 class="text-lg font-bold">All categories</h2> --}}
                        <h3 class="font-bold text-base">All categories</h3>
                        <div class="text-xs text-gray-500">Showing {{ $catCount .' '. ( ($catCount == 1) ? 'category' : 'categories' ) }}</div>
                    </div>

                    <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 gap-2 sm:gap-3">
                        @foreach($categories as $cat)
                            <a href="{{ route('front.category.detail', $cat['slug']) }}" class="block">
                                <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} p-1 sm:p-2 group transition h-full flex flex-col shadow-sm hover:shadow-md border dark:border-gray-700 overflow-hidden">
                                    {{-- Image --}}
                                    @if (!empty($cat['image_s']))
                                        <img src="{{ Storage::url($cat['image_s']) }}" alt=""
                                            class="w-full h-12 sm:h-16 object-contain mb-2 group-hover:scale-105 transition">
                                    @else
                                        <div class="flex-1 flex items-center justify-center mb-2 bg-gradient-to-br from-blue-500 to-purple-500 text-white overflow-hidden">
                                            <span class="text-xs sm:text-sm font-bold">{{ $cat['title'] }}</span>
                                        </div>
                                        @php $cat['title'] = null; @endphp
                                    @endif

                                    {{-- Title --}}
                                    @if (!empty($cat['title']))
                                        <p class="text-[10px] sm:text-xs font-medium text-center line-clamp-2 text-gray-900 dark:text-white mb-0.5">
                                            {{ $cat['title'] }}
                                        </p>
                                    @endif

                                    {{-- Description --}}
                                    @if (!empty($cat['short_description']))
                                        <p class="{{ FD['text-0'] }} sm:text-[10px] font-light text-center line-clamp-2 text-gray-500 dark:text-gray-500 leading-tight">
                                            {{ $cat['short_description'] }}
                                        </p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Trending categories --}}
                <div class="bg-gradient-to-t from-sky-500 to-indigo-500 p-3 sm:p-4 {{ FD['rounded'] }} shadow">
                    <div class="flex items-center justify-between mb-2 sm:mb-3">
                        <h3 class="font-bold text-white text-sm sm:text-base">Trending categories</h3>
                        {{-- <a href="#" class="text-xs text-indigo-200 hover:text-white">View more</a> --}}
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-2 sm:gap-3">
                        @foreach($categories->take(4) as $ind => $trenCategory)
                            <a href="{{ route('front.category.detail', $trenCategory->slug) }}" class="block">
                                <div class="bg-white dark:bg-gray-800 p-2 sm:p-3 {{ FD['rounded'] }} flex items-center gap-2 sm:gap-3 group hover:shadow-md transition-shadow">
                                    @if ($trenCategory->image_s)
                                        <img src="{{ Storage::url($trenCategory->image_s) }}" 
                                            alt="{{ $trenCategory->slug }}" 
                                            class="w-auto h-10 sm:h-12 object-cover {{ FD['rounded'] }} group-hover:scale-105 transition-transform">
                                    @endif

                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs sm:text-sm font-semibold truncate">{{ $trenCategory['title'] }}</p>
                                        @if ($trenCategory->short_description)
                                            <p class="{{ FD['text-0'] }} sm:text-[10px] mt-0.5 text-gray-500 dark:text-gray-400 line-clamp-1 sm:line-clamp-2 leading-tight">
                                                {{ $trenCategory->short_description }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Featured products --}}
                @if (count($featuredProducts) > 0)
                    <section class="bg-gray-100 antialiased dark:bg-gray-900">
                        <div class="mx-auto max-w-screen-xl">
                            <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                                <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                            </div>

                            <div class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-4" id="featured-products">
                                {{-- Product Card Component --}}
                                @foreach ($featuredProducts as $featuredItem)
                                    <x-front.product-card :product="$featuredItem->product" />
                                @endforeach
                            </div>
                        </div>
                    </section>
                @endif

                {{-- <div class="bg-white dark:bg-gray-800 p-4 {{ FD['rounded'] }} shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold">Featured products</h3>
                        <div class="text-xs text-gray-500">Handpicked deals</div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($featured as $p)
                            <article class="border {{ FD['rounded'] }} overflow-hidden group">
                                <div class="relative">
                                    <img src="{{ $p['image'] }}" alt="{{ $p['title'] }}" class="w-full h-40 object-cover group-hover:scale-105 transition-transform">
                                    @if($p['badge'])
                                        <span class="absolute top-2 left-2 bg-yellow-400 text-xs px-2 py-1 {{ FD['rounded'] }}">{{ $p['badge'] }}</span>
                                    @endif
                                </div>
                                <div class="p-3">
                                    <h4 class="text-sm font-semibold">{{ $p['title'] }}</h4>
                                    <div class="mt-2 flex items-center justify-between">
                                        <div>
                                            <div class="text-sm font-bold">₹{{ number_format($p['price']) }}</div>
                                            <div class="text-xs line-through text-gray-400">₹{{ number_format($p['mrp']) }}</div>
                                        </div>
                                        <div class="flex flex-col items-end">
                                            <button class="text-xs bg-indigo-600 text-white px-3 py-1 {{ FD['rounded'] }}" onclick="openQuickView({{ $p['id'] }})">Quick view</button>
                                            <button class="mt-2 text-xs border px-3 py-1 {{ FD['rounded'] }}">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div> --}}

                <!-- Deals & limited time -->
                {{-- <div class="bg-red-50 dark:bg-red-900/30 p-4 {{ FD['rounded'] }} shadow overflow-hidden">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <h3 class="font-bold">Flash deals</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-300">Limited time offers — hurry!</p>
                        </div>
                        <div id="cat-countdown" class="font-mono text-sm">00:59:59</div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        @foreach($featured->take(2) as $p)
                            <div class="bg-white dark:bg-gray-900 p-3 {{ FD['rounded'] }} flex items-center gap-3">
                                <img src="{{ $p['image'] }}" alt="{{ $p['title'] }}" class="w-24 h-20 object-cover {{ FD['rounded'] }}">
                                <div class="flex-1">
                                    <div class="text-sm font-semibold">{{ $p['title'] }}</div>
                                    <div class="text-xs text-gray-500">₹{{ number_format($p['price']) }}</div>
                                </div>
                                <button class="text-xs bg-indigo-600 text-white px-3 py-1 {{ FD['rounded'] }}">Buy</button>
                            </div>
                        @endforeach
                    </div>
                </div> --}}

                <!-- Sponsored brands -->
                {{-- <div class="bg-white dark:bg-gray-800 p-4 {{ FD['rounded'] }} shadow">
                    <h3 class="font-bold mb-3">Top brands</h3>
                    <div class="flex items-center gap-4 overflow-x-auto py-2">
                        @foreach($brands as $b)
                            <div class="flex-shrink-0 w-40 h-20 bg-gray-100 dark:bg-gray-900 {{ FD['rounded'] }} flex items-center justify-center shadow">
                                <span class="font-semibold">{{ $b }}</span>
                            </div>
                        @endforeach
                    </div>
                </div> --}}

            </main>
        </div>

        <!-- Newsletter & trust -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="md:col-span-2 bg-gradient-to-r from-indigo-50 to-white dark:from-primary-900 rounded p-6 shadow flex items-center gap-4">
                <img src="https://dummyimage.com/120x120/fff/aaa&text=SAFE" alt="trust" class="w-20 h-20 rounded object-cover">
                <div>
                    <h4 class="font-bold">Trusted marketplace</h4>
                    <p class="text-xs text-gray-500">Secure payments, verified sellers and reliable support.</p>
                </div>
            </div>

            <div class="bg-indigo-600 rounded p-6 text-white">
                <h4 class="font-bold">Get deals in your inbox</h4>
                <p class="text-xs mb-3">Subscribe for personalized offers and early access.</p>
                <div class="flex gap-2">
                    <input type="email" placeholder="you@domain.com" class="flex-1 px-3 py-2 rounded text-sm text-gray-800" />
                    <button class="px-3 py-2 bg-white text-indigo-600 rounded text-sm">Subscribe</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick view modal (hidden) -->
    <div id="quickView" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
        <div class="bg-white dark:bg-gray-900 rounded max-w-2xl w-full overflow-hidden">
            <div class="flex justify-between items-center p-3 border-b dark:border-gray-800">
                <h3 class="text-sm font-bold">Quick view</h3>
                <button onclick="closeQuickView()" class="p-2">✕</button>
            </div>
            <div id="quickViewContent" class="p-4"></div>
        </div>
    </div>

    <script>
        // Simple countdown for flash deals (demo: 1 hour)
        (function(){
            const countdownEl = document.getElementById('cat-countdown');
            let remaining = 60*60; // seconds
            const tid = setInterval(()=>{
                if(remaining<=0){ countdownEl.textContent='00:00:00'; clearInterval(tid); return }
                remaining--;
                const h = String(Math.floor(remaining/3600)).padStart(2,'0');
                const m = String(Math.floor((remaining%3600)/60)).padStart(2,'0');
                const s = String(remaining%60).padStart(2,'0');
                countdownEl.textContent = `${h}:${m}:${s}`;
            },1000);
        })();

        // PRODUCTS map for quick view (server-rendered mock)
        const PRODUCTS = {
            @foreach($featured as $p)
                {{ $p['id'] }}: @json($p),
            @endforeach
        };

        function openQuickView(id){
            const modal = document.getElementById('quickView');
            const content = document.getElementById('quickViewContent');
            const p = PRODUCTS[id];
            if(!p) return;
            content.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <img src="${p.image}" class="w-full h-64 object-cover rounded" />
                    <div>
                        <h4 class="text-lg font-bold">${p.title}</h4>
                        <p class="text-xs text-gray-500 mt-1">Top rated product</p>
                        <div class="mt-3"><span class="text-xl font-bold">₹${p.price}</span> <span class="text-xs line-through text-gray-400">₹${p.mrp}</span></div>
                        <div class="mt-4"><button class="px-4 py-2 bg-indigo-600 text-white rounded text-sm">Add to cart</button></div>
                    </div>
                </div>
            `;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
        function closeQuickView(){
            const modal = document.getElementById('quickView');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }
    </script>

</x-guest-layout>
