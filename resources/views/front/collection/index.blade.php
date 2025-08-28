<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Collection') }}">

  <!-- Breadcrumb + Page Title -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
    <nav class="text-xs text-slate-500 dark:text-slate-400 mb-2" aria-label="Breadcrumb">
      <ol class="flex items-center gap-2">
        <li><a href="#" class="hover:underline">Home</a></li>
        <li>/</li>
        <li><a href="#" class="hover:underline">Collections</a></li>
      </ol>
    </nav>
    <div class="flex items-center justify-between gap-4">
      <div>
        <h1 class="text-lg font-semibold">Collections</h1>
        <p class="text-xs text-slate-500 dark:text-slate-400">Browse curated collections & featured product groups</p>
      </div>
      <div class="flex items-center gap-2">
        <label for="sort" class="sr-only">Sort</label>
        <select id="sort" name="sort" class="text-sm border border-slate-200 dark:border-slate-700 rounded-md px-3 py-2 bg-white dark:bg-slate-800">
          <option value="featured">Featured</option>
          <option value="popular">Most Popular</option>
          <option value="new">New Arrivals</option>
          <option value="low-to-high">Price: Low to High</option>
          <option value="high-to-low">Price: High to Low</option>
        </select>
      </div>
    </div>
  </div>

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
    <div class="grid grid-cols-1 gap-6">

      <!-- Featured collections horizontal -->
      <div class="mb-6">
        <h2 class="text-sm font-semibold mb-3">Featured collections</h2>
        <div class="flex gap-4 overflow-x-auto pb-2">
          @php
            $mockCollections = [
              (object)['id'=>1,'name'=>'Fresh Produce','count'=>28,'image'=>'https://dummyimage.com/600x400/10b981/ffffff&text=Produce'],
              (object)['id'=>2,'name'=>'Home & Kitchen','count'=>42,'image'=>'https://dummyimage.com/600x400/6366f1/ffffff&text=Home'],
              (object)['id'=>3,'name'=>'Electronics','count'=>18,'image'=>'https://dummyimage.com/600x400/f59e0b/ffffff&text=Electronics'],
              (object)['id'=>4,'name'=>'Fashion','count'=>55,'image'=>'https://dummyimage.com/600x400/ef4444/ffffff&text=Fashion'],
              (object)['id'=>5,'name'=>'Fitness','count'=>14,'image'=>'https://dummyimage.com/600x400/06b6d4/ffffff&text=Fitness']
            ];
          @endphp

          @foreach($mockCollections as $c)
            <div class="min-w-[220px] bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-md p-3">
              <img class="w-full h-36 object-cover rounded-md" src="{{ $c->image }}" alt="{{ $c->name }}" />
              <h3 class="text-sm font-medium mt-2">{{ $c->name }}</h3>
              <p class="text-xs mt-1 text-slate-500 dark:text-slate-400">{{ $c->count }} products</p>
            </div>
          @endforeach
        </div>
      </div>







<!-- Masonry Ads: simple column-based masonry -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
  <header class="mb-4">
    <h2 class="text-lg font-semibold">Recommended for you</h2>
    <p class="text-xs text-slate-500 dark:text-slate-400">Handpicked offers & promos — one glance, many irresistible deals.</p>
  </header>

  <!-- Container: columns create masonry-like layout -->
  <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
    <!-- Card 1: Tall hero ad -->
    <a href="#" class="block mb-4 break-inside-avoid rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition-shadow bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
      <img src="https://dummyimage.com/800x500/0ea5a4/ffffff&text=Mega+Deal" alt="Mega Deal" class="w-full h-auto object-cover" loading="lazy" />
      <div class="p-4">
        <h3 class="text-sm font-semibold">Mega Deal — Up to <span class="text-yellow-300">70% OFF</span></h3>
        <p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Selected categories. Limited stock — hurry!</p>
        <div class="mt-3 flex items-center gap-3">
          <span class="inline-flex items-center text-xs bg-brand text-white px-3 py-2 rounded-md">
            <!-- Shopping cart icon -->
            <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 3h2l1 7h12l3-7H6" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Shop now
          </span>
          <span class="text-xs text-white/90 bg-slate-900/80 dark:bg-white/10 px-2 py-1 rounded">Use code: SUMMER70</span>
        </div>
      </div>
    </a>

    <!-- Card 2: Tall portrait (brand story / lifestyle) -->
    <a href="#" class="block mb-4 break-inside-avoid rounded-lg overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 hover:scale-[1.01] transition-transform">
      <img src="https://dummyimage.com/600x900/6366f1/ffffff&text=Brand+Story" alt="Brand Story" class="w-full h-auto object-cover" loading="lazy" />
      <div class="p-3">
        <h3 class="text-sm font-semibold">Brand Story — New Collection</h3>
        <p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Sustainably made — feel good shopping.</p>
        <div class="mt-3 flex items-center gap-2">
          <span class="text-xs px-3 py-2 border rounded-md text-slate-700 dark:text-slate-200">Explore</span>
        </div>
      </div>
    </a>

    <!-- Card 3: Coupon strip (short) -->
    <a href="#" class="block mb-4 break-inside-avoid rounded-lg overflow-hidden p-3 bg-gradient-to-r from-amber-50 to-white dark:from-amber-900 dark:to-amber-700 border border-slate-200 dark:border-slate-700">
      <div class="flex items-center gap-3">
        <img src="https://dummyimage.com/200x120/94a3b8/ffffff&text=Coupon" alt="Coupon" class="w-24 h-16 object-cover rounded" loading="lazy" />
        <div>
          <h4 class="text-sm font-semibold">Extra 15% off — code: EXTRA15</h4>
          <p class="text-xs text-slate-600 dark:text-slate-300 mt-1">Applies on ₹1499+. Limited time.</p>
        </div>
        <div class="ml-auto">
          <span class="text-xs bg-slate-900/90 text-white px-3 py-2 rounded">Use Code</span>
        </div>
      </div>
    </a>

    <!-- Card 4: Small flash tile -->
    <a href="#" class="block mb-4 break-inside-avoid rounded-lg overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-3 shadow-sm hover:shadow-md">
      <div class="flex items-center gap-3">
        <img src="https://dummyimage.com/160x160/10b981/ffffff&text=Flash" alt="Flash" class="w-20 h-20 object-cover rounded" loading="lazy" />
        <div>
          <h5 class="text-sm font-semibold">Flash Deal — 4 hours left</h5>
          <p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Extra 25% off on essentials.</p>
        </div>
        <div class="ml-auto text-xs bg-red-600 text-white px-2 py-1 rounded">Buy Now</div>
      </div>
    </a>

    <!-- Card 5: Grid collage (small images) -->
    <a href="#" class="block mb-4 break-inside-avoid rounded-lg overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
      <div class="grid grid-cols-2 gap-1">
        <img src="https://dummyimage.com/400x300/f59e0b/ffffff&text=1" alt="1" class="w-full h-28 object-cover" loading="lazy" />
        <img src="https://dummyimage.com/400x300/ef4444/ffffff&text=2" alt="2" class="w-full h-28 object-cover" loading="lazy" />
        <img src="https://dummyimage.com/400x300/06b6d4/ffffff&text=3" alt="3" class="w-full h-28 object-cover" loading="lazy" />
        <img src="https://dummyimage.com/400x300/6366f1/ffffff&text=4" alt="4" class="w-full h-28 object-cover" loading="lazy" />
      </div>
      <div class="p-3">
        <h4 class="text-sm font-semibold">Bundle picks — curated sets</h4>
        <p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Mix & match and save more.</p>
        <div class="mt-3">
          <span class="text-xs bg-brand text-white px-3 py-2 rounded-md">View bundles</span>
        </div>
      </div>
    </a>

    <!-- Card 6: Vertical promo with badge -->
    <a href="#" class="block mb-4 break-inside-avoid rounded-lg overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
      <img src="https://dummyimage.com/600x700/111827/ffffff&text=New+Arrivals" alt="New Arrivals" class="w-full h-auto object-cover" loading="lazy" />
      <div class="p-3">
        <div class="flex items-center gap-2">
          <span class="text-xs bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 px-2 py-1 rounded">New</span>
          <h4 class="text-sm font-semibold">Just dropped — trending now</h4>
        </div>
        <p class="text-xs text-slate-500 dark:text-slate-300 mt-2">Fresh styles added today. Free returns within 30 days.</p>
      </div>
    </a>

    <!-- Card 7: Small CTA tile (mobile-friendly) -->
    <a href="#" class="block mb-4 break-inside-avoid rounded-lg overflow-hidden p-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700">
      <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-sm font-bold">App</div>
        <div class="flex-1">
          <h5 class="text-sm font-semibold">App-only deals</h5>
          <p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Download & save extra 10%.</p>
        </div>
        <div>
          <span class="text-xs bg-brand text-white px-3 py-2 rounded-md flex items-center gap-2">
            <!-- Download icon -->
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Get App
          </span>
        </div>
      </div>
    </a>

    <!-- Card 8: Sponsored brand horizontal -->
    <a href="#" class="block mb-4 break-inside-avoid rounded-lg overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
      <img src="https://dummyimage.com/1200x400/94a3b8/ffffff&text=Sponsored+Brand" alt="Sponsored Brand" class="w-full h-auto object-cover" loading="lazy" />
      <div class="p-3">
        <h4 class="text-sm font-semibold">Sponsored brand — extra 20% off</h4>
        <p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Click to reveal limited coupons & offers.</p>
        <div class="mt-3">
          <span class="text-xs text-white bg-red-600 px-3 py-2 rounded-md">Reveal coupon</span>
        </div>
      </div>
    </a>

  </div>
</section>





      <!-- Ads container -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

  <!-- 1) Full-width hero / feature ad (high visual impact) -->
  <a href="#" class="block rounded-lg overflow-hidden relative group">
    <img src="https://dummyimage.com/1200x420/0ea5a4/ffffff&text=Mega+Summer+Sale" alt="Mega Summer Sale" class="w-full h-56 object-cover transform group-hover:scale-105 transition-transform duration-300" />
    <div class="absolute inset-0 bg-gradient-to-r from-black/30 to-black/10 dark:from-black/40 dark:to-black/10 flex items-center">
      <div class="p-6 md:p-10 max-w-2xl">
        <h3 class="text-lg font-bold text-white">Mega Summer Sale — Up to <span class="text-yellow-300">70% OFF</span></h3>
        <p class="text-xs text-white/90 mt-2">Top brands, limited stock. Free express delivery on orders above ₹999.</p>
        <div class="mt-4 flex items-center gap-3">
          <span class="inline-flex items-center px-3 py-2 rounded-md bg-yellow-400 text-black text-sm font-semibold">Grab the Deal</span>
          <span class="text-xs text-white/80">Use code: <strong>SUMMER70</strong></span>
        </div>
      </div>
    </div>
  </a>

  <!-- 2) Product spotlight card (image + coupon) -->
  <a href="#" class="block md:flex items-stretch gap-4 rounded-lg overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
    <img src="https://dummyimage.com/600x400/ef4444/ffffff&text=Top+Pick" alt="Top Pick" class="w-full md:w-1/3 h-44 object-cover" />
    <div class="p-4 flex-1">
      <h4 class="text-sm font-semibold">Editor's Pick — Smart Wireless Earbuds</h4>
      <p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Clear bass, 30hr battery, now at an unbeatable price.</p>

      <div class="mt-3 flex items-center gap-3">
        <div>
          <div class="text-sm font-semibold">₹ 1,499</div>
          <div class="text-xs text-slate-400 line-through">₹ 4,299</div>
        </div>
        <div class="ml-auto text-xs bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 px-2 py-1 rounded">65% OFF</div>
      </div>

      <div class="mt-4 flex items-center gap-2">
        <span class="text-xs bg-brand text-white px-3 py-2 rounded-md">Add to Cart</span>
        <span class="text-xs px-3 py-2 border rounded-md text-slate-600 dark:text-slate-200">Quick view</span>
      </div>
    </div>
  </a>

  <!-- 3) Bundle deal card (multi-product + urgency) -->
  <a href="#" class="block rounded-lg overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-4">
    <div class="flex items-start gap-4">
      <div class="grid grid-cols-3 gap-2 w-28">
        <img src="https://dummyimage.com/120x120/6366f1/ffffff&text=A" alt="item A" class="w-full h-20 object-cover rounded" />
        <img src="https://dummyimage.com/120x120/f59e0b/ffffff&text=B" alt="item B" class="w-full h-20 object-cover rounded" />
        <img src="https://dummyimage.com/120x120/06b6d4/ffffff&text=C" alt="item C" class="w-full h-20 object-cover rounded" />
      </div>
      <div class="flex-1">
        <h4 class="text-sm font-semibold">Family Bundle — Breakfast + Snacks</h4>
        <p class="text-xs text-slate-500 dark:text-slate-300 mt-1">3 bestselling items bundled with free priority shipping.</p>

        <div class="mt-3 flex items-center gap-3">
          <div class="text-sm font-semibold">₹ 899</div>
          <div class="text-xs text-slate-400 line-through">₹ 1,499</div>
          <div class="ml-auto text-xs text-white bg-red-500 px-2 py-1 rounded">Limited — 24 left</div>
        </div>

        <div class="mt-3 flex items-center gap-2">
          <span class="text-xs bg-brand text-white px-3 py-2 rounded-md">Buy Bundle</span>
          <span class="text-xs text-slate-500 dark:text-slate-300">Or add items separately</span>
        </div>
      </div>
    </div>
  </a>

  <!-- 4) Flash deal small card (great for sidebars or grid interleaving) -->
  <a href="#" class="block rounded-lg overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-3 shadow-sm hover:shadow-md">
    <div class="flex items-center gap-3">
      <img src="https://dummyimage.com/120x120/10b981/ffffff&text=Flash" alt="Flash deal" class="w-20 h-20 object-cover rounded" />
      <div class="flex-1">
        <h5 class="text-sm font-semibold">Flash Deal — 4 hours left</h5>
        <p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Extra 25% off on daily essentials.</p>
        <div class="mt-2 flex items-center gap-2">
          <div class="text-sm font-semibold">₹ 249</div>
          <div class="text-xs text-slate-400 line-through">₹ 399</div>
        </div>
      </div>
      <div class="text-xs text-white bg-red-600 px-2 py-1 rounded">Buy Now</div>
    </div>
  </a>

  <!-- 5) Coupon strip (great for high CTR and mobile) -->
  <a href="#" class="block rounded-md overflow-hidden p-3 bg-gradient-to-r from-amber-50 to-white dark:from-amber-900 dark:to-amber-700 border border-slate-200 dark:border-slate-700">
    <div class="flex items-center gap-4">
      <img src="https://dummyimage.com/200x120/94a3b8/ffffff&text=Coupon" alt="Coupon offer" class="w-24 h-16 object-cover rounded" />
      <div>
        <h5 class="text-sm font-semibold">Exclusive Coupon — EXTRA15</h5>
        <p class="text-xs mt-1 text-slate-600 dark:text-slate-300">Use EXTRA15 to get an extra 15% off on cart value above ₹1499. Limited time.</p>
      </div>
      <div class="ml-auto text-sm font-semibold bg-slate-900/90 text-white px-3 py-2 rounded">Use Code</div>
    </div>
  </a>

  <!-- 6) Attractive brand tile (image-first, with brand logo and CTA) -->
  <a href="#" class="block rounded-lg overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
    <div class="relative">
      <img src="https://dummyimage.com/1200x600/111827/ffffff&text=Brand+Week" alt="Brand Week" class="w-full h-44 object-cover" />
      <div class="absolute inset-0 flex items-end p-4">
        <div class="bg-white/90 dark:bg-slate-900/80 rounded-md p-3 w-full md:w-1/2">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-sm font-bold">B</div>
            <div>
              <h5 class="text-sm font-semibold">Brand Week — Selected Styles</h5>
              <p class="text-xs text-slate-600 dark:text-slate-300 mt-1">Extra 10% off for members. Free returns.</p>
            </div>
          </div>
          <div class="mt-3 flex items-center gap-2">
            <span class="text-xs bg-brand text-white px-3 py-2 rounded-md">Shop Brand</span>
            <span class="text-xs text-slate-500 dark:text-slate-300">Earn 2x points</span>
          </div>
        </div>
      </div>
    </div>
  </a>

</div>


      <!-- High-converting ad strip (above products) - using Pexels imagery for visual appeal -->
      <div class="mb-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <a href="#" class="group block rounded-lg overflow-hidden shadow-sm hover:shadow-md bg-gradient-to-r from-indigo-600 to-emerald-500">
            <img src="https://images.pexels.com/photos/1866149/pexels-photo-1866149.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=1200" alt="Home essentials" class="w-full h-28 object-cover opacity-90 group-hover:opacity-100" />
            <div class="p-4 bg-white/5 text-white">
              <h3 class="text-sm font-semibold">Home Essentials — Up to 50% off</h3>
              <p class="text-xs mt-1">Limited stock. Fast delivery.</p>
            </div>
          </a>

          <a href="#" class="group block rounded-lg overflow-hidden shadow-sm hover:shadow-md border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
            <img src="https://images.pexels.com/photos/3952046/pexels-photo-3952046.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=1200" alt="Subscribe & save" class="w-full h-28 object-cover" />
            <div class="p-4">
              <h3 class="text-sm font-semibold">Subscribe & Save</h3>
              <p class="text-xs mt-1">Auto-reorders with extra 10% off.</p>
            </div>
          </a>

          <a href="#" class="group block rounded-lg overflow-hidden shadow-sm hover:shadow-md border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
            <img src="https://images.pexels.com/photos/6078123/pexels-photo-6078123.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=1200" alt="Trending gadgets" class="w-full h-28 object-cover" />
            <div class="p-4">
              <h3 class="text-sm font-semibold">Trending Gadgets</h3>
              <p class="text-xs mt-1">New arrivals daily.</p>
            </div>
          </a>
        </div>
      </div>

      <!-- Main product area with in-grid ad tiles -->
      <section>
        <div class="flex items-center justify-between mb-3">
          <h2 class="text-sm font-semibold">Products</h2>

          @php
            // Mock products as PHP array (server-side rendering - no JS needed)
            $mockProducts = [];
            for ($i = 1; $i <= 28; $i++) {
              $mockProducts[] = (object)[
                'id' => $i,
                'title' => "Product $i",
                'collection' => $mockCollections[$i % count($mockCollections)]->name,
                'price' => number_format(rand(500,25000)/100, 2),
                'oldPrice' => rand(0,10) > 6 ? number_format(rand(700,30000)/100, 2) : null,
                'rating' => number_format(rand(30,50)/10, 1),
                'reviews' => rand(0,500),
                'image' => "https://dummyimage.com/600x400/" . sprintf('%06d', rand(100000,999999)) . "/ffffff&text=P$i",
                'sponsored' => rand(0,100) > 85
              ];
            }

            $perPage = (int) request()->get('perpage', 12);
            $page = max(1, (int) request()->get('page', 1));
            $total = count($mockProducts);
            $start = ($page -1) * $perPage;
            $pageItems = array_slice($mockProducts, $start, $perPage);
            $maxPage = (int) ceil($total / $perPage);
          @endphp

          <div class="text-xs text-slate-500">Showing <strong>{{ $start + 1 }}</strong> - <strong>{{ $start + count($pageItems) }}</strong> of <strong>{{ $total }}</strong></div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
          @foreach($pageItems as $idx => $p)
            <!-- Product Card -->
            <article class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-md overflow-hidden flex flex-col transition-shadow hover:shadow-lg">
              <div class="relative group">
                <a href="#" class="block">
                  <img class="w-full h-48 md:h-44 object-cover transform transition-transform duration-300 group-hover:scale-105" src="{{ $p->image }}" alt="{{ $p->title }}" />
                </a>

                @if($p->sponsored)
                  <span class="absolute top-3 left-3 bg-yellow-400 text-black text-[10px] font-semibold px-2 py-1 rounded">Sponsored</span>
                @endif

                <a href="#" class="absolute top-3 right-3 p-1 rounded bg-white/90 dark:bg-slate-900/70 hover:scale-110">
                  <!-- Heart icon -->
                  <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20.8 8.6a5 5 0 0 0-7.07 0L12 10.34l-1.73-1.73a5 5 0 0 0-7.07 7.07L12 21.2l8.8-5.53a5 5 0 0 0 0-7.07z" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
                </a>
              </div>

              <div class="p-3 flex-1 flex flex-col">
                <h3 class="text-sm font-medium line-clamp-2"><a href="#" class="hover:underline">{{ $p->title }}</a></h3>
                <p class="text-xs text-slate-500 dark:text-slate-300 mt-1">{{ $p->collection }}</p>

                <div class="mt-3 flex items-center justify-between">
                  <div>
                    <div class="text-sm font-semibold">₹ {{ $p->price }}</div>
                    @if($p->oldPrice)
                      <div class="text-xs text-slate-400 line-through">₹ {{ $p->oldPrice }}</div>
                    @endif
                  </div>
                  <div class="text-xs text-slate-500 dark:text-slate-300 flex items-center gap-1">
                    {{-- star icon --}}
                    <svg class="w-3 h-3" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 17.3l6.18 3.7-1.64-7.03L21 9.24l-7.19-.62L12 2 10.19 8.62 3 9.24l4.46 4.73L5.82 21z" stroke="currentColor" stroke-width="0.8" stroke-linejoin="round" /></svg>
                    {{ $p->rating }} ({{ $p->reviews }})
                  </div>
                </div>

                <div class="mt-3 flex items-center gap-2">
                  <a href="#" class="flex-1 text-sm py-2 rounded-md bg-brand text-white text-center">Add to cart</a>
                  <a href="#" class="p-2 rounded-md border border-slate-200 dark:border-slate-700 text-center">🔍</a>
                </div>
              </div>
            </article>

            {{-- Insert an ad tile after the 4th product for high visibility --}}
            @if(($idx + 1) % 4 === 0)
              <a href="#" class="block rounded-md overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm hover:shadow-md col-span-full">
                <img src="https://images.pexels.com/photos/3184418/pexels-photo-3184418.jpeg?auto=compress&cs=tinysrgb&dpr=2&w=1200" class="w-full h-44 object-cover" alt="Sponsored Brand Offer" />
                <div class="p-3">
                  <h4 class="text-sm font-semibold">Sponsored brand — extra 20% off</h4>
                  <p class="text-xs text-slate-500 mt-1">Click to reveal limited coupons</p>
                </div>
              </a>
            @endif

          @endforeach
        </div>

        <!-- Pagination (server-side query param links) -->
        <div class="mt-6 flex items-center justify-between">
          <div class="flex items-center gap-2">
            @php
              $prevPage = $page > 1 ? $page - 1 : null;
              $nextPage = $page < $maxPage ? $page + 1 : null;
              $query = request()->query();
            @endphp

            @if($prevPage)
              @php $query['page'] = $prevPage; @endphp
              <a href="?{{ http_build_query($query) }}" class="px-3 py-1 text-sm border rounded-md bg-white dark:bg-slate-800">Prev</a>
            @else
              <span class="px-3 py-1 text-sm border rounded-md text-slate-400">Prev</span>
            @endif

            @if($nextPage)
              @php $query['page'] = $nextPage; @endphp
              <a href="?{{ http_build_query($query) }}" class="px-3 py-1 text-sm border rounded-md bg-white dark:bg-slate-800">Next</a>
            @else
              <span class="px-3 py-1 text-sm border rounded-md text-slate-400">Next</span>
            @endif
          </div>

          <div>
            <label class="text-xs mr-2">Per page</label>
            <form method="get" class="inline-block">
              @foreach(request()->except('perpage') as $k => $v)
                <input type="hidden" name="{{ $k }}" value="{{ $v }}" />
              @endforeach
              <select name="perpage" onchange="this.form.submit()" class="text-sm border border-slate-200 dark:border-slate-700 rounded-md px-2 py-1 bg-white dark:bg-slate-800">
                <option {{ $perPage == 12 ? 'selected' : '' }}>12</option>
                <option {{ $perPage == 24 ? 'selected' : '' }}>24</option>
                <option {{ $perPage == 48 ? 'selected' : '' }}>48</option>
              </select>
            </form>
          </div>
        </div>

      </section>

      <!-- Bottom ad — sticky CTA for mobile users -->
      <div class="mt-8 lg:hidden">
        <a href="#" class="flex items-center justify-between bg-brand text-white px-4 py-3 rounded-md shadow-lg">
          <div>
            <div class="text-sm font-semibold">App-only deal: Extra 15% off</div>
            <p class="text-xs">Download our app & unlock coupons</p>
          </div>
          <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
          </svg>
        </a>
      </div>

    </div>
  </main>



</x-guest-layout>