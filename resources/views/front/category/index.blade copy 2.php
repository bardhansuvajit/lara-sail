<x-guest-layout screen="max-w-screen-xl" title="{{ __('Categories') }}">

@php
// Mock data for demo only (replace with controller data in production)
// $categories = [
//     ['name' => 'Smartphones', 'slug' => 'smartphones', 'count' => 1240, 'img' => 'https://dummyimage.com/640x420/ede9fe/6d28d9&text=Smartphones'],
//     ['name' => 'Laptops', 'slug' => 'laptops', 'count' => 820, 'img' => 'https://dummyimage.com/640x420/edf2f7/0f172a&text=Laptops'],
//     ['name' => 'TV & Home Theatre', 'slug' => 'tv-home-theatre', 'count' => 465, 'img' => 'https://dummyimage.com/640x420/e6fffa/0e7490&text=TV+%26+Home'],
//     ['name' => 'Appliances', 'slug' => 'appliances', 'count' => 390, 'img' => 'https://dummyimage.com/640x420/fef3c7/92400e&text=Appliances'],
//     ['name' => 'Fashion', 'slug' => 'fashion', 'count' => 2150, 'img' => 'https://dummyimage.com/640x420/fce7f3/9f1239&text=Fashion'],
//     ['name' => 'Beauty', 'slug' => 'beauty', 'count' => 540, 'img' => 'https://dummyimage.com/640x420/fff0f6/9f1239&text=Beauty'],
//     ['name' => 'Sports & Outdoors', 'slug' => 'sports', 'count' => 300, 'img' => 'https://dummyimage.com/640x420/ede9fe/6d28d9&text=Sports'],
//     ['name' => 'Toys & Baby', 'slug' => 'toys-baby', 'count' => 120, 'img' => 'https://dummyimage.com/640x420/fff7ed/92400e&text=Toys'],
// ];

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

$ads = [
    ['img' => 'https://dummyimage.com/1200x200/ffedd5/92400e&text=Top+Banner+Ad+-+Seasonal+Sale', 'url' => '#'],
    ['img' => 'https://dummyimage.com/600x400/ede9fe/6d28d9&text=Side+Ad+1', 'url' => '#'],
    ['img' => 'https://dummyimage.com/600x400/f0f9ff/0f172a&text=Side+Ad+2', 'url' => '#']
];

$brands = ['Apple','Samsung','Nike','Adidas','Sony','Philips','BoAt'];
@endphp

<section class="bg-gray-50 dark:bg-gray-900 py-2">
    <div class="max-w-screen-xl mx-auto px-2 sm:px-6 lg:px-8">
        <!-- Page header -->
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-sm sm:text-2xl font-bold text-gray-900 dark:text-white">{{ __('Explore categories') }}</h1>
                <p class="text-[10px] sm:text-sm text-gray-500 dark:text-gray-400 mt-1">{{ __('Browse by category - discover curated picks, deals and top brands.') }}</p>
            </div>

            <div class="hidden sm:flex items-center gap-3">
                <x-front.text-input id="search" class="block w-full" type="text" name="search" placeholder="Search categories..." :value="old('search')" maxlength="100" autocomplete="given-name" required />
                <button class="px-4 py-1 h-[2rem] bg-primary-600 hover:bg-primary-700 focus:bg-primary-800 text-white {{ FD['rounded'] }} text-sm">Search</button>
            </div>
        </div>

        <!-- Top banner ad -->
        <div class="mb-6">
            <a href="{{ $ads[0]['url'] }}" class="block rounded overflow-hidden shadow-lg">
                <img src="{{ $ads[0]['img'] }}" alt="Top ad" class="w-full h-auto object-cover">
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
            <!-- Sidebar: filters + small ads -->
            <aside class="lg:col-span-1 space-y-4">
                <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
                    <h3 class="text-sm font-semibold mb-3">Filters</h3>
                    <div class="space-y-2 text-xs text-gray-600 dark:text-gray-300">
                        <div>
                            <label class="block text-xs">Price</label>
                            <div class="flex gap-2 mt-2">
                                <input type="number" placeholder="Min" class="w-1/2 px-2 py-1 rounded border text-xs" />
                                <input type="number" placeholder="Max" class="w-1/2 px-2 py-1 rounded border text-xs" />
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs">Brands</label>
                            <div class="mt-2 flex flex-wrap gap-2">
                                @foreach($brands as $b)
                                    <button class="px-2 py-1 text-xs border rounded">{{ $b }}</button>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs">Rating</label>
                            <div class="mt-2 flex gap-2">
                                <button class="px-2 py-1 text-xs border rounded">4+</button>
                                <button class="px-2 py-1 text-xs border rounded">3+</button>
                                <button class="px-2 py-1 text-xs border rounded">All</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 p-3 rounded shadow">
                    <h4 class="text-xs font-semibold mb-2">Sponsored</h4>
                    <a href="#" class="block rounded overflow-hidden mb-3">
                        <img src="{{ $ads[1]['img'] }}" alt="Sponsored ad" class="w-full h-40 object-cover rounded">
                    </a>
                    <a href="#" class="block rounded overflow-hidden">
                        <img src="{{ $ads[2]['img'] }}" alt="Sponsored ad 2" class="w-full h-40 object-cover rounded">
                    </a>
                </div>

                <div class="bg-white dark:bg-gray-800 p-4 rounded shadow text-xs">
                    <h4 class="font-semibold mb-2">Categories quick links</h4>
                    <ul class="space-y-1">
                        @foreach($categories as $c)
                            <li>
                                <a href="#" class="text-sm text-gray-700 dark:text-gray-200">
                                    {{ $c['title'] }}
                                    {{-- <span class="text-gray-400">({{ $c['count'] }})</span> --}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Main content: categories + featured products -->
            <main class="lg:col-span-3 space-y-6">
                <!-- Category grid -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-bold">All categories</h2>
                        <div class="text-xs text-gray-500">Showing {{ count($categories) }} categories</div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-2 sm:gap-4">
                        @foreach($categories as $cat)
                            <a href="{{ route('front.category.detail', $cat['slug']) }}">
                                <div class="bg-white dark:bg-gray-800 {{ FD['rounded'] }} p-1 sm:p-3 group transition h-full flex flex-col shadow-sm hover:shadow-lg border dark:border-gray-700 overflow-hidden">
                                    
                                    {{-- Image --}}
                                    @if (!empty($cat['image_s']))
                                        <img src="{{ Storage::url($cat['image_s']) }}" alt="{{ $cat['title'] ?? 'Category' }}"
                                            class="w-full h-20 object-contain mb-2 sm:mb-4 group-hover:scale-105 transition">
                                    @else
                                        <div class="flex-1 flex items-center justify-center mb-2 sm:mb-4 bg-gradient-to-br from-blue-500 to-purple-500 text-white">
                                            <span class="{{ FD['text-2'] }} font-bold">{{ $cat['title'] }}</span>
                                        </div>
                                        @php $cat['title'] = null; @endphp
                                    @endif

                                    {{-- Title --}}
                                    @if (!empty($cat['title']))
                                        <p class="text-[11px] sm:text-xs font-bold text-center line-clamp-2 sm:line-clamp-1 text-gray-900 dark:text-white mb-1">
                                            {{ $cat['title'] }}
                                        </p>
                                    @endif

                                    {{-- Description --}}
                                    @if (!empty($cat['short_description']))
                                        <p class="{{ FD['text-0'] }} font-light text-center line-clamp-1 sm:line-clamp-2 text-gray-500 dark:text-gray-400 leading-none">
                                            {{ $cat['short_description'] }}
                                        </p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>


                    {{-- <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
                        @foreach($categories as $cat)
                            <a href="" class="group block bg-white dark:bg-gray-900 border dark:border-gray-700 hover:shadow-lg transition rounded overflow-hidden">
                                <div class="w-full h-30 overflow-hidden justify-items-center">
                                    <img src="{{ Storage::url($cat['image_l']) }}" alt="{{ $cat['slug'] }}" class="h-28 object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="p-3">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white text-center">{{ $cat['title'] }}</h3>
                                </div>
                            </a>
                        @endforeach
                    </div> --}}
                </div>

                <!-- Category highlight strip (carousel-ish rows) -->
                <div class="bg-gradient-to-r from-indigo-50 to-white dark:from-primary-900 p-4 rounded shadow">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold">Trending categories</h3>
                        {{-- <a href="#" class="text-xs text-indigo-600">View more</a> --}}
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                        @foreach($categories as $c)
                            <a href="">
                                <div class="bg-white dark:bg-gray-800 p-3 rounded flex items-center gap-3">
                                    <img src="{{ Storage::url($c['image_s']) }}" alt="{{ $c['slug'] }}" class="w-auto h-14 object-cover rounded">
                                    <div>
                                        <div class="text-sm font-semibold">{{ $c['title'] }}</div>
                                        <div class="text-xs text-gray-500 line-clamp-2">{{ $c['short_description'] }}</div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Featured products / highlight -->
                @if (count($featuredProducts) > 0)
                    <section class="bg-gray-100 mb-4 py-4 antialiased dark:bg-gray-900 px-0 sm:px-4">
                        <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
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
                {{-- <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold">Featured products</h3>
                        <div class="text-xs text-gray-500">Handpicked deals</div>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach($featured as $p)
                            <article class="border rounded overflow-hidden group">
                                <div class="relative">
                                    <img src="{{ $p['image'] }}" alt="{{ $p['title'] }}" class="w-full h-40 object-cover group-hover:scale-105 transition-transform">
                                    @if($p['badge'])
                                        <span class="absolute top-2 left-2 bg-yellow-400 text-xs px-2 py-1 rounded">{{ $p['badge'] }}</span>
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
                                            <button class="text-xs bg-indigo-600 text-white px-3 py-1 rounded" onclick="openQuickView({{ $p['id'] }})">Quick view</button>
                                            <button class="mt-2 text-xs border px-3 py-1 rounded">Add</button>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div> --}}

                <!-- Deals & limited time -->
                <div class="bg-red-50 dark:bg-red-900/30 p-4 rounded shadow">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <h3 class="font-bold">Flash deals</h3>
                            <p class="text-xs text-gray-600 dark:text-gray-300">Limited time offers — hurry!</p>
                        </div>
                        <div id="cat-countdown" class="font-mono text-sm">00:59:59</div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        @foreach($featured->take(2) as $p)
                            <div class="bg-white dark:bg-gray-900 p-3 rounded flex items-center gap-3">
                                <img src="{{ $p['image'] }}" alt="{{ $p['title'] }}" class="w-24 h-20 object-cover rounded">
                                <div class="flex-1">
                                    <div class="text-sm font-semibold">{{ $p['title'] }}</div>
                                    <div class="text-xs text-gray-500">₹{{ number_format($p['price']) }}</div>
                                </div>
                                <button class="text-xs bg-indigo-600 text-white px-3 py-1 rounded">Buy</button>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Sponsored brands -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded shadow">
                    <h3 class="font-bold mb-3">Top brands</h3>
                    <div class="flex items-center gap-4 overflow-x-auto py-2">
                        @foreach($brands as $b)
                            <div class="flex-shrink-0 w-40 h-20 bg-gray-100 dark:bg-gray-900 rounded flex items-center justify-center shadow">
                                <span class="font-semibold">{{ $b }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

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
</section>

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
