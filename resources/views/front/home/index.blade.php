<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Home') }}">

    <section class="bg-gray-100 dark:bg-gray-900 antialiased">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($banners as $banner)
                    <div class="swiper-slide w-full h-56 sm:h-96 bg-gray-500">
                        <a href="{{$banner->web_redirect_url}}" target="_blank">
                            <img src="{{ Storage::url($banner->web_image_l_path) }}" alt="{{$banner->title}}">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    @if (count($featuredProducts) > 0)
        <section class="bg-gray-100 mb-4 py-4 antialiased dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl px-2 sm:px-0">
                <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0">
                    <p class="{{FD['text-1']}} font-semibold text-gray-600 dark:text-gray-500">FEATURED</h2>
                </div>

                <div class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 lg:grid-cols-6" id="featured-products">
                    {{-- Product Card Component --}}
                    @foreach ($featuredProducts as $featuredItem)
                        <x-front.product-card :product="$featuredItem->product" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @php
    $categories = [
        ['name' => 'Electronics', 'img' => 'https://dummyimage.com/200x140/edf2f7/94a3b8&text=Electronics'],
        ['name' => 'Fashion', 'img' => 'https://dummyimage.com/200x140/fef3c7/d1a054&text=Fashion'],
        ['name' => 'Home', 'img' => 'https://dummyimage.com/200x140/e6fffa/0e7490&text=Home'],
        ['name' => 'Beauty', 'img' => 'https://dummyimage.com/200x140/fce7f3/9f1239&text=Beauty'],
        ['name' => 'Sports', 'img' => 'https://dummyimage.com/200x140/ede9fe/6d28d9&text=Sports']
    ];

    $products = collect(range(1,4))->map(function($i){
        return [
            'id'=> $i,
            'title'=> "Trending Product $i",
            'desc'=> 'High quality, top-rated item.',
            'price'=> rand(499,4999),
            'mrp'=> rand(5000,9999),
            'rating'=> round(3 + rand(0,20)/10,1),
            'image'=> "https://dummyimage.com/400x300/fff/aaa&text=Product+{$i}",
            'badge'=> $i%3==0 ? 'Limited' : ($i%4==0 ? 'Bestseller' : null),
        ];
    });

    $brands = ['Nike','Apple','Samsung','Sony','Adidas','Zara'];
    @endphp


    {{-- Hero + Spotlight --}}
    <section class="max-w-7xl px-2 sm:px-0 mx-auto pb-4 grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        {{-- Left: hero carousel / big promo --}}
        <div class="lg:col-span-8">
            <div class="bg-gradient-to-r from-indigo-50 to-white dark:from-primary-900 dark:to-primary-500 {{FD['rounded']}} p-4">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1 flex flex-col justify-center gap-3">
                        <h1 class="text-lg md:text-lg lg:text-lg font-extrabold leading-tight">Huge Savings. Everyday essentials. Top brands.</h1>
                        <p class="text-xs text-gray-600 dark:text-gray-400">Curated deals, fast delivery and reliable customer service — everything you expect from a marketplace leader.</p>

                        <div class="flex gap-3 mt-3">
                            <a href="#" class="text-sm bg-indigo-600 text-white px-4 py-2 rounded">Shop Bestsellers</a>
                            <a href="#" class="text-sm bg-white dark:bg-gray-800 border dark:border-gray-700 px-4 py-2 rounded">See Deals</a>
                        </div>
                    </div>

                    <div class="md:w-80 flex-shrink-0">
                        <img src="https://dummyimage.com/640x420/ede9fe/6d28d9&text=Big+Deal" alt="hero" class="{{FD['rounded']}} shadow-lg w-full h-auto object-cover">
                    </div>
                </div>

                {{-- mini promo strip --}}
                <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
                    <div class="bg-white dark:bg-gray-800 p-3 {{FD['rounded']}} flex items-center gap-3">
                        <img src="https://dummyimage.com/80x60/fff/888&text=1" alt="" class="rounded w-16 h-12 object-cover">
                        <div>
                            <p class="text-xs font-medium">Up to 70% off</p>
                            <p class="text-xs text-gray-500">On select electronics</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-3 {{FD['rounded']}} flex items-center gap-3">
                        <img src="https://dummyimage.com/80x60/fff/888&text=2" alt="" class="rounded w-16 h-12 object-cover">
                        <div>
                            <p class="text-xs font-medium">Buy 1 Get 1</p>
                            <p class="text-xs text-gray-500">On fashion picks</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-3 {{FD['rounded']}} flex items-center gap-3">
                        <img src="https://dummyimage.com/80x60/fff/888&text=3" alt="" class="rounded w-16 h-12 object-cover">
                        <div>
                            <p class="text-xs font-medium">New arrivals</p>
                            <p class="text-xs text-gray-500">Daily drops</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-3 {{FD['rounded']}} flex items-center gap-3">
                        <img src="https://dummyimage.com/80x60/fff/888&text=4" alt="" class="rounded w-16 h-12 object-cover">
                        <div>
                            <p class="text-xs font-medium">Free Shipping</p>
                            <p class="text-xs text-gray-500">Over ₹999</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="max-w-7xl mx-auto py-6">
                {{-- <h2 class="text-sm font-bold mb-3">Shop by Category</h2> --}}
                <div class="flex gap-3 overflow-x-auto pb-2">
                    @foreach($categories as $cat)
                        <div class="min-w-[160px] bg-white dark:bg-gray-800 {{FD['rounded']}} p-3 flex-shrink-0 shadow">
                            <img src="{{ $cat['img'] }}" alt="" class="w-full h-24 rounded object-cover mb-2">
                            <p class="text-xs font-medium text-center">{{ $cat['name'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Right: Flash sale card + recommended --}}
        <aside class="lg:col-span-4 space-y-4">
            <div class="bg-red-50 dark:bg-red-900/40 border border-red-100 dark:border-red-800 {{FD['rounded']}} p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold">Flash Sale</h3>
                        <p class="text-xs text-gray-500">Limited time - ends in</p>
                    </div>
                    <div id="countdown" class="text-sm font-mono">00:10:23</div>
                </div>

                <div class="mt-3 grid grid-cols-2 gap-2">
                    @foreach($products->take(2) as $p)
                        <div class="bg-white dark:bg-gray-800 p-2 rounded">
                            <img src="{{ $p['image'] }}" alt="" class="rounded w-full h-28 object-cover">
                            <p class="text-xs font-medium mt-2">{{ $p['title'] }}</p>
                            <p class="text-xs text-gray-500">₹{{ $p['price'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 {{FD['rounded']}} p-4">
                <h3 class="text-sm font-bold mb-2">Recommended for you</h3>
                <div class="space-y-3">
                    @foreach($products->shuffle()->take(3) as $p)
                        <div class="flex items-center gap-3">
                            <img src="{{ $p['image'] }}" alt="" class="w-16 h-12 rounded object-cover">
                            <div class="flex-1">
                                <p class="text-xs font-medium">{{ $p['title'] }}</p>
                                <p class="text-xs text-gray-500">₹{{ $p['price'] }}</p>
                            </div>
                            <button class="text-xs bg-indigo-600 text-white px-2 py-1 rounded">Add</button>
                        </div>
                    @endforeach
                </div>
            </div>
        </aside>
    </section>

    {{-- Product Grid (conversion-focused) --}}
    <section class="max-w-7xl px-2 sm:px-0 mx-auto pb-4">
        {{-- <div class="flex items-center justify-between mb-4">
            <h2 class="text-sm font-bold">Top picks for you</h2>
            <div class="text-xs text-gray-500">Showing 1-12 of 200 results</div>
        </div> --}}

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach($products as $p)
                <article class="bg-white dark:bg-gray-900 {{FD['rounded']}} shadow hover:shadow-lg transition overflow-hidden">
                    <div class="relative">
                        <img src="{{ $p['image'] }}" alt="{{ $p['title'] }}" class="w-full h-48 object-cover">
                        @if($p['badge'])
                            <span class="absolute top-2 left-2 bg-yellow-400 text-xs px-2 py-1 rounded">{{ $p['badge'] }}</span>
                        @endif
                        <button class="absolute top-2 right-2 bg-white/70 dark:bg-gray-800/70 p-1 rounded" aria-label="quick view" onclick="openQuickView({{ $p['id'] }})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </button>
                    </div>
                    <div class="p-3">
                        <h3 class="text-sm font-semibold">{{ $p['title'] }}</h3>
                        <p class="text-xs text-gray-500">{{ $p['desc'] }}</p>
                        <div class="mt-2 flex items-center justify-between">
                            <div>
                                <div class="text-sm font-bold">₹{{ $p['price'] }}</div>
                                <div class="text-xs line-through text-gray-400">₹{{ $p['mrp'] }}</div>
                            </div>
                            <button class="text-xs bg-indigo-600 text-white px-3 py-1 rounded">Add to cart</button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- Brands strip --}}
    <section class="max-w-7xl mx-auto px-2 sm:px-0 py-4">
        <h2 class="text-sm font-bold mb-3">Top brands</h2>
        <div class="flex items-center gap-6 overflow-x-auto py-2">
            @foreach($brands as $b)
                <div class="flex-shrink-0 w-32 h-12 flex items-center justify-center bg-white dark:bg-gray-800 rounded shadow">
                    <span class="text-sm font-semibold">{{ $b }}</span>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Trust & Newsletter --}}
    <section class="max-w-7xl mx-auto px-2 sm:px-0 py-4 grid grid-cols-1 md:grid-cols-3 gap-6 items-center">
        <div class="md:col-span-2 bg-white dark:bg-gray-800 {{FD['rounded']}} p-6 flex items-center gap-4">
            <img src="https://dummyimage.com/120x120/fff/aaa&text=SAFE" alt="trust" class="w-20 h-20 object-cover rounded">
            <div>
                <h3 class="text-lg font-bold">Trusted marketplace</h3>
                <p class="text-xs text-gray-500">Secure payments, verified sellers and fast support.</p>
            </div>
        </div>

        <div class="bg-indigo-600 text-white {{FD['rounded']}} p-6">
            <h3 class="text-sm font-bold">Get deals in your inbox</h3>
            <p class="text-xs mb-3">Subscribe for personalized offers and early access.</p>
            <div class="flex gap-2">
                <input type="email" placeholder="you@domain.com" class="flex-1 px-3 py-2 rounded text-xs text-gray-800" />
                <button class="px-3 py-2 bg-white text-indigo-600 rounded text-xs">Subscribe</button>
            </div>
        </div>
    </section>

    {{-- Quick view modal (hidden) --}}
    <div id="quickView" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 p-4">
        <div class="bg-white dark:bg-gray-900 {{FD['rounded']}} max-w-2xl w-full overflow-hidden">
            <div class="flex justify-between items-center p-3 border-b dark:border-gray-800">
                <h3 class="text-sm font-bold">Quick view</h3>
                <button onclick="closeQuickView()" class="p-2">✕</button>
            </div>
            <div id="quickViewContent" class="p-4">
                {{-- content filled by JS --}}
            </div>
        </div>
    </div>

    {{-- Minimal JS for interactions: countdown + quick view (plain, dependency-free) --}}
    <script>
        // Countdown (demo fixed 10 minutes)
        (function(){
            const countdownEl = document.getElementById('countdown');
            let remaining = 10*60; // 10 minutes
            setInterval(()=>{
                if(remaining<=0){ countdownEl.textContent='00:00:00'; return }
                remaining--;
                const h = String(Math.floor(remaining/3600)).padStart(2,'0');
                const m = String(Math.floor((remaining%3600)/60)).padStart(2,'0');
                const s = String(remaining%60).padStart(2,'0');
                countdownEl.textContent = `${h}:${m}:${s}`;
            },1000);
        })();

        // Quick view mock (renders product details from server-rendered JS map)
        const PRODUCTS = {
            @foreach($products as $p)
                {{ $p['id'] }}: @json($p),
            @endforeach
        };

        function openQuickView(id){
            const modal = document.getElementById('quickView');
            const content = document.getElementById('quickViewContent');
            const p = PRODUCTS[id];
            if(!p) return;
            content.innerHTML = `
                <div class=\"grid grid-cols-1 md:grid-cols-2 gap-4\"> 
                    <img src=\"${p.image}\" class=\"w-full h-64 object-cover rounded\" />
                    <div>
                        <h4 class=\"text-lg font-bold\">${p.title}</h4>
                        <p class=\"text-xs text-gray-500\">${p.desc}</p>
                        <div class=\"mt-3\"><span class=\"text-sm font-bold\">₹${p.price}</span> <span class=\"text-xs line-through text-gray-400\">₹${p.mrp}</span></div>
                        <div class=\"mt-4\"><button class=\"px-4 py-2 bg-indigo-600 text-white rounded text-xs\">Add to cart</button></div>
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

    <section class="bg-white px-2 sm:px-0 py-10 antialiased dark:bg-gray-900">
  <div class="mx-auto grid max-w-screen-xl {{FD['rounded']}} bg-gray-50 p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 xl:gap-16">
    <!-- IMAGE / ILLUSTRATION -->
    <div class="lg:col-span-5 lg:mt-0 flex items-center justify-center">
      <!-- Decorative/marketing image — replace with a Pexels or Undraw SVG as needed -->
      <img
        src="https://dummyimage.com/640x480/edf2f7/6d28d9&text=iMac+27%22"
        alt="Apple iMac 27-inch product preview"
        class="w-full max-w-md rounded-lg shadow-lg object-cover transition-transform duration-300 hover:scale-[1.02] dark:shadow-none"
        loading="lazy"
        role="img"
        aria-hidden="false"
      />
    </div>

    <!-- CONTENT -->
    <div class="me-auto place-self-center lg:col-span-7 space-y-4">
      <!-- small badge + urgency -->
      <div class="flex items-center gap-3">
        <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-800 dark:bg-yellow-900/40">
          <!-- lightning icon -->
          <svg class="h-4 w-4 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 2L3 14h7l-1 8 10-12h-7l1-8z"/>
          </svg>
          Limited time offer
        </span>

        <span class="text-xs text-gray-500 dark:text-gray-400"> · Free delivery on orders ₹999+</span>
      </div>

      <!-- Main heading (big) -->
      <h1 class="text-lg md:text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">
        Save <span class="text-indigo-600 dark:text-indigo-400">₹500</span> today — pre-order the new iMac 27”
      </h1>

      <!-- short description (text-xs as requested) -->
      <p class="text-xs text-gray-500 dark:text-gray-400">
        Reserve your iMac now to lock in exclusive launch pricing, priority shipping and a complimentary 1-year warranty extension.
      </p>

      <!-- price & savings block -->
      <div class="flex items-end gap-4">
        <div class="flex items-center gap-3">
          <div class="text-2xl font-extrabold text-gray-900 dark:text-white leading-none">₹<span class="ml-1">1,29,900</span></div>
          <div class="flex flex-col text-xs text-gray-500 dark:text-gray-400">
            <span class="line-through">₹1,30,400</span>
            <span class="text-green-600 dark:text-green-400 font-medium">You save ₹500</span>
          </div>
        </div>

        <!-- expiry (aria-live to announce changes) -->
        <div class="ml-4 text-xs text-gray-600 dark:text-gray-300" aria-live="polite">
          <span class="block">Offer ends in</span>
          <time id="promo-countdown" class="font-mono text-sm">02:13:45</time>
        </div>
      </div>

      <!-- CTA buttons -->
      <div class="flex flex-col sm:flex-row sm:items-center sm:gap-3 gap-2">
        <a
          href="#"
          class="{{FD['rounded']}} inline-flex items-center justify-center bg-primary-700 px-5 py-3 text-base font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900"
          role="button"
          aria-label="Pre-order now - iMac 27 inch"
        >
          Pre-order now
        </a>

        <a
          href="#features"
          class="inline-flex items-center justify-center {{FD['rounded']}} px-4 py-3 text-sm font-medium text-primary-700 bg-white border border-gray-200 hover:bg-gray-50 dark:bg-gray-700 dark:border-gray-700 dark:text-primary-300"
          role="button"
          aria-label="Learn more about the iMac 27 inch"
        >
          Learn more
        </a>
      </div>

      <!-- micro-benefits -->
      <ul class="mt-2 flex flex-wrap gap-3 text-xs text-gray-600 dark:text-gray-300">
        <li class="inline-flex items-center gap-2">
          <!-- truck icon -->
          <svg class="h-4 w-4 text-gray-500 dark:text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7h13l4 4v6H3V7zM16 3v4M5 17a1 1 0 100 2 1 1 0 000-2zm12 0a1 1 0 100 2 1 1 0 000-2z"/>
          </svg>
          <span>Fast & insured delivery</span>
        </li>

        <li class="inline-flex items-center gap-2">
          <!-- shield icon -->
          <svg class="h-4 w-4 text-gray-500 dark:text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 2l7 4v5c0 5-3 9-7 11-4-2-7-6-7-11V6l7-4z"/>
          </svg>
          <span>1-year warranty + free extended support</span>
        </li>

        <li class="inline-flex items-center gap-2">
          <!-- refresh icon -->
          <svg class="h-4 w-4 text-gray-500 dark:text-gray-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 12a9 9 0 11-3-6.7M21 3v6h-6"/>
          </svg>
          <span>30-day easy returns</span>
        </li>
      </ul>
    </div>
  </div>

  <!-- Optional: small JS to make the countdown real (48 hours demo). Replace time as needed. -->
  <script>
    (function(){
      // set expiry to 48 hours from page load (demo). Use server timestamp in production.
      const expiry = Date.now() + 48 * 3600 * 1000;
      const el = document.getElementById('promo-countdown');
      function tick(){
        const now = Date.now();
        const diff = Math.max(0, expiry - now);
        const h = String(Math.floor(diff / 3600000)).padStart(2,'0');
        const m = String(Math.floor((diff % 3600000) / 60000)).padStart(2,'0');
        const s = String(Math.floor((diff % 60000) / 1000)).padStart(2,'0');
        if(el) el.textContent = `${h}:${m}:${s}`;
        if(diff <= 0) clearInterval(tid);
      }
      tick();
      const tid = setInterval(tick, 1000);
    })();
  </script>
</section>



    <section class="bg-white px-2 sm:px-0 py-10 antialiased dark:bg-gray-900">
        <div class="mx-auto grid max-w-screen-xl {{FD['rounded']}} bg-gray-50 p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 xl:gap-16">
            <div class="lg:col-span-5 lg:mt-0">
                <a href="#">
                    <svg class="mb-4 h-56 w-56 dark:hidden sm:h-96 sm:w-96 md:h-full md:w-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M205.5-323.5H282q-.5-31.5-22.75-53.75T205.5-400v76.5Zm135.5 0h55q0-79.06-55.72-134.78T205.5-514v55q56.5.5 96 39.75T341-323.5Zm114 0h55q0-62.8-23.79-118.47t-65.18-97.06q-41.39-41.39-97.06-65.18Q268.3-628 205.5-628v55.11q103.8 0 176.65 72.7Q455-427.5 455-323.5ZM326-129v-79H165q-30.94 0-52.97-22.03Q90-252.06 90-283v-473q0-30.94 22.03-52.97Q134.06-831 165-831h630q30.94 0 52.97 22.03Q870-786.94 870-756v473q0 30.94-22.03 52.97Q825.94-208 795-208H634v79H326ZM165-283h630v-473H165v473Zm0 0v-473 473Z"/></svg>
                </a>
            </div>
            <div class="me-auto place-self-center lg:col-span-7">
                <h1 class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
                Save <span class="currency-symbol">₹</span>500 today on your purchase <br />
                of a new iMac computer.
                </h1>

                <p class="mb-6 text-gray-500 dark:text-gray-400">Reserve your new Apple iMac 27” today and enjoy exclusive savings with qualified activation. Pre-order now to secure your discount.</p>

                <a href="#" class="inline-flex items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-3 text-center text-base font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900"> Pre-order now </a>
            </div>
        </div>
    </section>

</x-guest-layout>