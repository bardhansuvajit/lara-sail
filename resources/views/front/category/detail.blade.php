@php
// --- Mock/demo data (only when controller doesn't provide real data) ---
if(!isset($category)){
    $category = (object)[
        'name' => 'Electronics',
        'slug' => 'electronics',
        'short_description' => 'Top electronics — phones, laptops, accessories and more.',
        'banner_image_url' => 'https://dummyimage.com/1200x300/ede9fe/6d28d9&text=Electronics+Banner',
        'average_rating' => 4.3,
        'fastest_delivery_days' => 2,
    ];
}

if(!isset($subcategories)){
    $subcategories = collect([
        (object)['name'=>'Mobile Phones','slug'=>'mobile-phones','image_url'=>'https://dummyimage.com/320x200/fff/aaa&text=Phones','product_count'=>124],
        (object)['name'=>'Laptops','slug'=>'laptops','image_url'=>'https://dummyimage.com/320x200/fff/aaa&text=Laptops','product_count'=>86],
        (object)['name'=>'Headphones','slug'=>'headphones','image_url'=>'https://dummyimage.com/320x200/fff/aaa&text=Headphones','product_count'=>54],
        (object)['name'=>'Cameras','slug'=>'cameras','image_url'=>'https://dummyimage.com/320x200/fff/aaa&text=Cameras','product_count'=>33],
    ]);
}

if(!isset($brands)){
    $brands = collect([
        (object)['id'=>1,'name'=>'Apple'],
        (object)['id'=>2,'name'=>'Samsung'],
        (object)['id'=>3,'name'=>'Sony'],
        (object)['id'=>4,'name'=>'OnePlus'],
    ]);
}

if(!isset($attributes)){
    $attributes = collect([
        (object)['id'=>1,'name'=>'Color','values'=>collect([(object)['id'=>11,'value'=>'Black'],(object)['id'=>12,'value'=>'White'],(object)['id'=>13,'value'=>'Blue']])],
        (object)['id'=>2,'name'=>'Storage','values'=>collect([(object)['id'=>21,'value'=>'64GB'],(object)['id'=>22,'value'=>'128GB'],(object)['id'=>23,'value'=>'256GB']])],
    ]);
}

if(!isset($relatedCategories)){
    $relatedCategories = collect([
        (object)['name'=>'Wearables','slug'=>'wearables','image_url'=>'https://dummyimage.com/320x200/fff/aaa&text=Wearables'],
        (object)['name'=>'Smart Home','slug'=>'smart-home','image_url'=>'https://dummyimage.com/320x200/fff/aaa&text=Smart+Home'],
        (object)['name'=>'Gaming','slug'=>'gaming','image_url'=>'https://dummyimage.com/320x200/fff/aaa&text=Gaming'],
    ]);
}

if(!isset($products)){
    $allProducts = collect(range(1,24))->map(function($i){
        return (object)[
            'id' => $i,
            'title' => "Product $i",
            'slug' => 'product-'.$i,
            'desc' => 'High quality product — demo description.',
            'price' => rand(499,49999),
            'mrp' => rand(1000,59999),
            'rating' => round(3 + rand(0,20)/10,1),
            'image' => "https://dummyimage.com/640x480/fff/aaa&text=Product+{$i}",
            'badge' => $i % 5 == 0 ? 'Bestseller' : ($i % 3 == 0 ? 'Limited' : null),
            'brand' => ['Apple','Samsung','Sony','OnePlus'][array_rand(['Apple','Samsung','Sony','OnePlus'])],
        ];
    });

    $page = request('page', 1);
    $perPage = 12;
    $products = new \Illuminate\Pagination\LengthAwarePaginator(
        $allProducts->forPage($page, $perPage)->values(),
        $allProducts->count(),
        $perPage,
        $page,
        ['path' => url()->current(), 'query' => request()->query()]
    );
}
@endphp


<x-guest-layout screen="max-w-screen-xl" title="{{ $category->name }}">
    <section class="mx-2 sm:mx-0 pt-5">
    {{-- Breadcrumb / SEO header --}}
    <nav class="text-xs text-gray-500 mb-3" aria-label="breadcrumb">
        <ol class="flex items-center gap-2">
            <li><a href="{{ route('front.home.index') }}" class="hover:underline">Home</a></li>
            @foreach($category->ancestors ?? [] as $ancestor)
                <li> / <a href="{{ route('front.category.detail', $ancestor->slug) }}" class="hover:underline">{{ $ancestor->name }}</a></li>
            @endforeach
            <li> / <span class="text-gray-700 dark:text-gray-300">{{ $category->name }}</span></li>
        </ol>
    </nav>

    {{-- Hero: Category banner + quick stats --}}
    <header class="bg-gray-100 dark:bg-gray-900 {{ FD['rounded'] }} shadow-sm py-4 mb-6">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 items-center">
            <div class="lg:col-span-3">
                <h1 class="text-2xl md:text-3xl font-extrabold leading-tight mb-2">{{ $category->name }}</h1>
                @if($category->short_description)
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ $category->short_description }}</p>
                @endif

                <div class="flex items-center gap-4 text-xs text-gray-500">
                    <span>{{ number_format($products->total()) }} products</span>
                    <span>·</span>
                    @if(isset($category->average_rating))
                        <span>Avg. rating {{ number_format($category->average_rating,1) }} ★</span>
                    @endif
                    @if(isset($category->fastest_delivery_days))
                        <span>· Delivery from {{ $category->fastest_delivery_days }} days</span>
                    @endif
                </div>
            </div>

            {{-- hero image removed for compactness on mobile --}}
        </div>
    </header>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        {{-- LEFT: Filters / Subcategories (hidden on mobile; opened via mobile button) --}}
        <aside class="hidden lg:block lg:col-span-3 space-y-4">

            {{-- Subcategories block (limits visible rows, has show more) --}}
            @if($subcategories->isNotEmpty())
                <div class="bg-white dark:bg-gray-800 p-4 {{ FD['rounded'] }} shadow">
                    <h3 class="text-sm font-semibold mb-3">Subcategories</h3>

                    <div id="subcatsList" class="grid grid-cols-2 sm:grid-cols-1 gap-3">
                        @foreach($subcategories->take(6) as $sub)
                            <a href="{{ route('front.category.detail', $sub->slug) }}" class="flex items-center gap-3 p-2 hover:bg-gray-50 dark:hover:bg-gray-700 rounded">
                                <img src="{{ $sub->image_url ?? asset('images/subcat-default.png') }}" alt="{{ $sub->name }}" class="w-12 h-10 object-cover rounded">
                                <div>
                                    <div class="text-xs font-medium">{{ $sub->name }}</div>
                                    @if($sub->product_count)
                                        <div class="text-xs text-gray-400">{{ $sub->product_count }} products</div>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>

                    @if($subcategories->count() > 6)
                        <div class="text-center mt-2">
                            <button id="showMoreSubcats" onclick="toggleSubcats()" class="text-xs text-indigo-600">Show more</button>
                        </div>

                        <div id="subcatsExtra" class="mt-2 grid grid-cols-2 sm:grid-cols-1 gap-3">
                            @foreach($subcategories->slice(6) as $sub)
                                <a href="{{ route('front.category.detail', $sub->slug) }}" class="flex items-center gap-3 p-2 hover:bg-gray-50 dark:hover:bg-gray-700 rounded">
                                    <img src="{{ $sub->image_url ?? asset('images/subcat-default.png') }}" alt="{{ $sub->name }}" class="w-12 h-10 object-cover rounded">
                                    <div>
                                        <div class="text-xs font-medium">{{ $sub->name }}</div>
                                        @if($sub->product_count)
                                            <div class="text-xs text-gray-400">{{ $sub->product_count }} products</div>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endif

            {{-- Filters (desktop) --}}
            <form id="filtersForm" method="GET" action="{{ route('front.category.detail', $category->slug) }}">
                <input type="hidden" name="q" value="{{ request('q') }}">

                <div class="bg-white dark:bg-gray-800 p-4 {{ FD['rounded'] }} shadow">
                    <h3 class="text-sm font-semibold mb-3">Filters</h3>

                    {{-- Price range --}}
                    <div class="mb-4">
                        <label class="text-xs font-medium">Price</label>
                        <div class="flex items-center gap-2 mt-2">
                            <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min" class="w-1/2 px-2 py-1 text-sm rounded border" />
                            <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max" class="w-1/2 px-2 py-1 text-sm rounded border" />
                        </div>
                    </div>

                    {{-- Brands --}}
                    @if($brands->isNotEmpty())
                        <div class="mb-4">
                            <label class="text-xs font-medium">Brands</label>
                            <div class="mt-2 grid gap-2 max-h-40 overflow-auto">
                                @foreach($brands as $brand)
                                    <label class="inline-flex items-center text-xs">
                                        <input type="checkbox" name="brands[]" value="{{ $brand->id }}" {{ in_array($brand->id, (array)request('brands', [])) ? 'checked' : '' }} class="mr-2">
                                        {{ $brand->name }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Rating --}}
                    <div class="mb-4">
                        <label class="text-xs font-medium">Customer rating</label>
                        <div class="mt-2 flex flex-col gap-2 text-xs">
                            @foreach([4,3,2,1] as $r)
                                <label class="inline-flex items-center">
                                    <input type="radio" name="rating" value="{{ $r }}" {{ request('rating') == $r ? 'checked' : '' }} class="mr-2"> 
                                    <span>{{ $r }} stars & up</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

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
                        <button type="submit" class="px-3 py-2 bg-indigo-600 text-white text-xs rounded">Apply</button>
                        <a href="{{ route('front.category.detail', $category->slug) }}" class="text-xs text-gray-500">Reset</a>
                    </div>
                </div>
            </form>

            {{-- Upgraded competitive trust section --}}
            <div class="bg-white dark:bg-gray-800 p-4 {{ FD['rounded'] }} shadow text-xs">
                <h4 class="font-semibold mb-2">Why shop here?</h4>
                <ul class="space-y-3 text-gray-600">
                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-green-600 mt-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/></svg>
                        <div>
                            <div class="text-xs font-medium">Lowest prices & price-match</div>
                            <div class="text-xs text-gray-400">We match prices so you always get the best deal.</div>
                        </div>
                    </li>

                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-blue-600 mt-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7h13l4 4v6H3V7zM16 3v4"/></svg>
                        <div>
                            <div class="text-xs font-medium">Fast delivery</div>
                            <div class="text-xs text-gray-400">Same/next-day delivery in select cities.</div>
                        </div>
                    </li>

                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-indigo-600 mt-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2l7 4v5c0 5-3 9-7 11-4-2-7-6-7-11V6l7-4z"/></svg>
                        <div>
                            <div class="text-xs font-medium">Hassle-free returns</div>
                            <div class="text-xs text-gray-400">30-day returns with easy pickups.</div>
                        </div>
                    </li>

                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-gray-600 mt-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 12h14"/></svg>
                        <div>
                            <div class="text-xs font-medium">Secure payments & BNPL</div>
                            <div class="text-xs text-gray-400">Multiple payment methods including EMI and BNPL.</div>
                        </div>
                    </li>

                    <li class="flex items-start gap-2">
                        <svg class="w-5 h-5 text-yellow-600 mt-1" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3"/></svg>
                        <div>
                            <div class="text-xs font-medium">24/7 customer support</div>
                            <div class="text-xs text-gray-400">Chat, call or email anytime.</div>
                        </div>
                    </li>
                </ul>
            </div>

        </aside>

        {{-- RIGHT: Products list + sorting + controls --}}
        <main class="lg:col-span-9">
            {{-- Top controls: sort, view toggle, result count --}}
            <div class="flex items-center justify-between mb-4">
                <div class="text-xs text-gray-600">Showing <strong>{{ $products->firstItem() }}</strong>–<strong>{{ $products->lastItem() }}</strong> of <strong>{{ $products->total() }}</strong></div>

                <div class="flex items-center gap-3">
                    <!-- Mobile filters button -->
                    <button type="button" class="lg:hidden px-3 py-2 bg-gray-100 rounded text-xs" onclick="openFilters()">Filters</button>

                    <form method="GET" id="sortForm" class="flex items-center gap-2">
                        {{-- preserve other query params --}}
                        @foreach(request()->except(['sort','page']) as $k=>$v)
                            @if(is_array($v))
                                @foreach($v as $vv)
                                    <input type="hidden" name="{{ $k }}[]" value="{{ $vv }}">
                                @endforeach
                            @else
                                <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                            @endif
                        @endforeach

                        <label for="sort" class="text-xs">Sort</label>
                        <select id="sort" name="sort" onchange="document.getElementById('sortForm').submit()" class="text-xs px-2 py-1 rounded border">
                            <option value="relevance" {{ request('sort')=='relevance' ? 'selected' : '' }}>Relevance</option>
                            <option value="price_asc" {{ request('sort')=='price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="newest" {{ request('sort')=='newest' ? 'selected' : '' }}>Newest</option>
                            <option value="rating" {{ request('sort')=='rating' ? 'selected' : '' }}>Top rated</option>
                        </select>
                    </form>

                    <div class="inline-flex items-center gap-2 border rounded px-2 py-1">
                        <button type="button" onclick="setView('grid')" id="gridViewBtn" class="text-xs" aria-pressed="true">Grid</button>
                        <button type="button" onclick="setView('list')" id="listViewBtn" class="text-xs" aria-pressed="false">List</button>
                    </div>
                </div>
            </div>

            {{-- Subcategory chips (quick filters) --}}
            @if($subcategories->isNotEmpty())
                <div class="mb-4 flex gap-2 flex-wrap">
                    @foreach($subcategories->take(8) as $sc)
                        <a href="{{ route('front.category.detail', $sc->slug) }}?{{ http_build_query(request()->except('page')) }}" class="text-xs px-3 py-1 bg-gray-100 dark:bg-gray-800 rounded">{{ $sc->name }}</a>
                    @endforeach
                </div>
            @endif

            {{-- Product grid / list --}}
            <div id="productsGrid" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($products as $product)
                    <article class="bg-white dark:bg-gray-900 {{ FD['rounded'] }} shadow hover:shadow-lg transition overflow-hidden">
                        @php
                            $img = $product->image ?? data_get($product, 'activeImages.0.url') ?? data_get($product, 'images.0.url') ?? ('https://dummyimage.com/640x480/fff/aaa&text=Product+' . ($product->id ?? ''));
                        @endphp

                        <div class="relative">
                            <img src="{{ $img }}" alt="{{ $product->title ?? 'Product' }}" class="w-full h-48 object-cover">
                            @if(!empty($product->badge))
                                <span class="absolute top-2 left-2 bg-yellow-400 text-xs px-2 py-1 rounded">{{ $product->badge }}</span>
                            @endif
                            <button class="absolute top-2 right-2 bg-white/70 dark:bg-gray-800/70 p-1 rounded" aria-label="quick view" onclick="openQuickView({{ $product->id ?? 'null' }})">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </button>
                        </div>
                        <div class="p-3">
                            <h3 class="text-sm font-semibold">{{ $product->title ?? 'Product' }}</h3>
                            <p class="text-xs text-gray-500">{{ Str::limit($product->desc ?? '', 60) }}</p>
                            <div class="mt-2 flex items-center justify-between">
                                <div>
                                    <div class="text-sm font-bold">₹{{ number_format($product->price ?? 0) }}</div>
                                    <div class="text-xs line-through text-gray-400">₹{{ number_format($product->mrp ?? 0) }}</div>
                                </div>
                                <button class="text-xs bg-indigo-600 text-white px-3 py-1 rounded">Add to cart</button>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-6 flex items-center justify-between">
                <div>
                    {{ $products->withQueryString()->links() }}
                </div>

                <div class="text-xs text-gray-500">
                    <span>Page {{ $products->currentPage() }} of {{ $products->lastPage() }}</span>
                </div>
            </div>

            {{-- Related categories / recommended products strip --}}
            <section class="mt-8">
                <h3 class="text-sm font-semibold mb-3">Customers also shop</h3>
                <div class="flex gap-4 overflow-x-auto py-2">
                    @foreach($relatedCategories as $rc)
                        <a href="{{ route('front.category.detail', $rc->slug) }}" class="flex-shrink-0 w-44 bg-white dark:bg-gray-800 p-3 rounded shadow">
                            <img src="{{ $rc->image_url ?? asset('images/subcat-default.png') }}" alt="{{ $rc->name }}" class="w-full h-28 object-cover rounded mb-2">
                            <div class="text-xs font-medium">{{ $rc->name }}</div>
                        </a>
                    @endforeach
                </div>
            </section>

        </main>
    </div>

    {{-- Mobile filters panel will be created dynamically by JS when needed --}}

    {{-- Structured data for SEO (JSON-LD) --}}
    @push('head')
        <script type="application/ld+json">
            {!! json_encode([
                "@context" => "https://schema.org",
                "@type" => "CollectionPage",
                "name" => $category->name,
                "description" => $category->short_description ?? Str::limit(strip_tags($category->description ?? ''), 160),
            ]) !!}
        </script>
    @endpush

    {{-- Minimal JS for view toggle, subcategory expand, and mobile filters --}}
    <script>
        function setView(v){
            const grid = document.getElementById('productsGrid');
            const gridBtn = document.getElementById('gridViewBtn');
            const listBtn = document.getElementById('listViewBtn');

            if(v === 'list'){
                grid.className = 'grid grid-cols-1 gap-4';
                localStorage.setItem('catalogView','list');
                listBtn.setAttribute('aria-pressed','true');
                gridBtn.setAttribute('aria-pressed','false');
                listBtn.classList.add('bg-indigo-600','text-white');
                gridBtn.classList.remove('bg-indigo-600','text-white');
            } else {
                grid.className = 'grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4';
                localStorage.setItem('catalogView','grid');
                listBtn.setAttribute('aria-pressed','false');
                gridBtn.setAttribute('aria-pressed','true');
                gridBtn.classList.add('bg-indigo-600','text-white');
                listBtn.classList.remove('bg-indigo-600','text-white');
            }
        }

        // restore view on load
        (function(){
            const pref = localStorage.getItem('catalogView') || 'grid';
            setView(pref);
        })();

        // Subcategories show more/less
        function toggleSubcats(){
            const extra = document.getElementById('subcatsExtra');
            const btn = document.getElementById('showMoreSubcats');
            if(!extra) return;
            if(extra.classList.contains('hidden')){
                extra.classList.remove('hidden');
                btn.textContent = 'Show less';
            } else {
                extra.classList.add('hidden');
                btn.textContent = 'Show more';
            }
        }

        // Mobile filters (off-canvas simple)
        function openFilters(){
            let panel = document.getElementById('mobileFiltersPanel');
            if(!panel){
                // create panel dynamically
                panel = document.createElement('div');
                panel.id = 'mobileFiltersPanel';
                panel.className = 'fixed inset-0 z-50 flex items-stretch lg:hidden';
                panel.innerHTML = `
                    <div class="bg-black/50 w-full" onclick="closeFilters()"></div>
                    <div class="w-80 bg-white dark:bg-gray-900 p-4 overflow-auto">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-sm font-semibold">Filters</h3>
                            <button onclick="closeFilters()" class="text-sm">Close</button>
                        </div>
                        <div class="space-y-4">
                            <!-- replicate small filter form (price, brands, rating, attrs) -->
                            <form method="GET" action="{{ route('front.category.detail', $category->slug) }}">
                                <input type="hidden" name="q" value="{{ request('q') }}">
                                <div>
                                    <label class="text-xs font-medium">Price</label>
                                    <div class="flex gap-2 mt-2">
                                        <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="Min" class="w-1/2 px-2 py-1 text-sm rounded border" />
                                        <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="Max" class="w-1/2 px-2 py-1 text-sm rounded border" />
                                    </div>
                                </div>

                                @if($brands->isNotEmpty())
                                    <div class="mt-4">
                                        <label class="text-xs font-medium">Brands</label>
                                        <div class="mt-2 grid gap-2 max-h-40 overflow-auto">
                                            @foreach($brands as $brand)
                                                <label class="inline-flex items-center text-xs">
                                                    <input type="checkbox" name="brands[]" value="{{ $brand->id }}" {{ in_array($brand->id, (array)request('brands', [])) ? 'checked' : '' }} class="mr-2">
                                                    {{ $brand->name }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-4">
                                    <label class="text-xs font-medium">Customer rating</label>
                                    <div class="mt-2 flex flex-col gap-2 text-xs">
                                        @foreach([4,3,2,1] as $r)
                                            <label class="inline-flex items-center">
                                                <input type="radio" name="rating" value="{{ $r }}" {{ request('rating') == $r ? 'checked' : '' }} class="mr-2"> 
                                                <span>{{ $r }} stars & up</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                @foreach($attributes ?? [] as $attr)
                                    <div class="mt-4">
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

                                <div class="flex items-center gap-2 mt-4">
                                    <button type="submit" class="px-3 py-2 bg-indigo-600 text-white text-xs rounded">Apply</button>
                                    <button type="button" onclick="closeFilters()" class="text-xs text-gray-500">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                `;
                document.body.appendChild(panel);
            } else {
                panel.classList.remove('hidden');
            }
        }

        function closeFilters(){
            const panel = document.getElementById('mobileFiltersPanel');
            if(panel) panel.classList.add('hidden');
        }
    </script>
</section>

</x-guest-layout>
