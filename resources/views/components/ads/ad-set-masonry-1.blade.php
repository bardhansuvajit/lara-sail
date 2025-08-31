@props(['data'])

<div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-2 sm:gap-4">
    <!-- MEGA DEAL -->
    <a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800 group">
        <img src="https://dummyimage.com/800x400/0ea5a4/ffffff&text=Mega+Deal" alt="Mega Deal" class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-300" loading="lazy" />
        <div class="p-2 sm:p-4">
            <h3 class="text-base font-semibold">Mega Deal — Up to <span class="text-yellow-300">70% OFF</span></h3>
            <p class="text-xs text-slate-500 dark:text-slate-300 mt-1 line-clamp-2">Selected categories. Limited stock — hurry! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Natus voluptate iusto rerum voluptatem architecto nostrum cumque totam amet distinctio minus?</p>
            <div class="mt-3 flex items-center gap-3">
            <span class="inline-flex items-center text-xs bg-brand text-white px-3 py-2 {{ FD['rounded'] }} bg-teal-600">
                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-80q-33 0-56.5-23.5T120-160v-480q0-33 23.5-56.5T200-720h80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720h80q33 0 56.5 23.5T840-640v480q0 33-23.5 56.5T760-80H200Zm0-80h560v-480H200v480Zm280-240q83 0 141.5-58.5T680-600h-80q0 50-35 85t-85 35q-50 0-85-35t-35-85h-80q0 83 58.5 141.5T480-400ZM360-720h240q0-50-35-85t-85-35q-50 0-85 35t-35 85ZM200-160v-480 480Z"/></svg>
                Shop now
            </span>
            <span class="text-xs text-white/90 bg-slate-900/80 dark:bg-white/10 px-2 py-1 {{ FD['rounded'] }}">Use code: SUMMER70</span>
            </div>
        </div>
    </a>

    <!-- SPONSORED BRAND -->
    <a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800 group mt-2 sm:mt-4 mb-2 sm:mb-0">
        <img src="https://dummyimage.com/1200x400/94a3b8/ffffff&text=Sponsored+Brand" alt="Sponsored Brand" class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-300" loading="lazy" />
        <div class="p-2 sm:p-4">
            <h4 class="text-sm font-semibold">Sponsored brand — extra 20% off</h4>
            <p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Click to reveal limited coupons & offers.</p>
            <div class="mt-3">
                <span class="text-xs text-white bg-red-600 px-3 py-2 {{ FD['rounded'] }}">Reveal coupon</span>
            </div>
        </div>
    </a>

    <!-- BRAND STORY -->
    <a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800 group mb-2 sm:mb-0">
        <img src="https://dummyimage.com/600x800/6366f1/ffffff&text=Brand+Story" alt="Brand Story" class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-300" loading="lazy" />
        <div class="p-2 sm:p-4">
            {{-- <h3 class="text-base font-semibold">Brand Story — New Collection</h3> --}}
            <p class="text-xs sm:text-[10px] text-slate-500 dark:text-slate-300">Sustainably made — feel good shopping. Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, saepe?</p>
            <div class="mt-[0.6rem] flex items-center gap-2">
                <span class="text-xs px-3 py-2 border {{ FD['rounded'] }} text-slate-700 dark:text-slate-200">Explore</span>
            </div>
        </div>
    </a>

    <!-- COUPON -->
    {{-- <a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden p-3 bg-gradient-to-r from-amber-50 to-white dark:from-amber-900 dark:to-amber-700 border border-slate-200 dark:border-slate-700">
        <div class="flex items-center gap-3">
            <img src="https://dummyimage.com/200x120/94a3b8/ffffff&text=Coupon" alt="Coupon" class="w-24 h-16 object-cover{{ FD['rounded'] }}" loading="lazy" />
            <div>
            <h4 class="text-sm font-semibold">Extra 15% off — code: EXTRA15</h4>
            <p class="text-xs text-slate-600 dark:text-slate-300 mt-1">Applies on ₹1499+. Limited time.</p>
            </div>
            <div class="ml-auto">
            <span class="text-xs bg-slate-900/90 text-white px-3 py-2{{ FD['rounded'] }}">Use Code</span>
            </div>
        </div>
    </a> --}}

    <!-- FLASH -->
    <a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800 p-2 sm:p-4 shadow-sm hover:shadow-md">
        <div class="flex items-center gap-3">
            <img src="https://dummyimage.com/150x150/10b981/ffffff&text=Flash" alt="Flash" class="w-20 h-20 object-cover {{ FD['rounded'] }}" loading="lazy" />
            <div>
                <h5 class="text-sm font-semibold">Flash Deal — 4 hours left</h5>
                <p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Extra 25% off on essentials.</p>
                <div class="text-xs bg-red-600 text-white px-2 py-1 {{ FD['rounded'] }} w-fit mt-3">Buy Now</div>
            </div>
            {{-- <div class="ml-auto text-xs bg-red-600 text-white px-2 py-1{{ FD['rounded'] }}">Buy Now</div> --}}
        </div>
    </a>

    <!-- GRID COLLAGE -->
    <a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800 my-2 sm:my-4">
        <div class="grid grid-cols-2 gap-2 sm:gap-1">
            <img src="https://dummyimage.com/400x300/f59e0b/ffffff&text=1" alt="1" class="w-full h-28 object-cover" loading="lazy" />
            <img src="https://dummyimage.com/400x300/ef4444/ffffff&text=2" alt="2" class="w-full h-28 object-cover" loading="lazy" />
            <img src="https://dummyimage.com/400x300/06b6d4/ffffff&text=3" alt="3" class="w-full h-28 object-cover" loading="lazy" />
            <img src="https://dummyimage.com/400x300/6366f1/ffffff&text=4" alt="4" class="w-full h-28 object-cover" loading="lazy" />
        </div>
        <div class="p-2 sm:p-4">
            <h4 class="text-base font-semibold text-center">Bundle picks — curated sets</h4>
            {{-- <p class="{{ FD['text'] }} text-slate-500 dark:text-slate-300 mt-1">Mix & match and save more.</p> --}}
            {{-- <div class="mt-3">
                <span class="text-xs bg-brand text-white px-3 py-2 {{ FD['rounded'] }}">View bundles</span>
            </div> --}}
        </div>
    </a>

    <!-- APP DEALS -->
    <a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden p-2 sm:p-4 bg-white dark:bg-slate-800 mb-2 sm:mb-0">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 {{ FD['rounded'] }} bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-sm font-bold">
                App
            </div>
            <div class="flex-1">
                <h5 class="text-sm font-semibold">App-only deals</h5>
                <p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Download & save extra 10%.</p>
            </div>
            <div>
                <span class="text-xs bg-brand text-white px-3 py-2 {{ FD['rounded'] }} flex items-center gap-2">
                    <div class="{{ FD['iconClass'] }}">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M419-80q-28 0-52.5-12T325-126L107-403l19-20q20-21 48-25t52 11l74 45v-328q0-17 11.5-28.5T340-760q17 0 29 11.5t12 28.5v472l-97-60 104 133q6 7 14 11t17 4h221q33 0 56.5-23.5T720-240v-160q0-17-11.5-28.5T680-440H461v-80h219q50 0 85 35t35 85v160q0 66-47 113T640-80H419ZM167-620q-13-22-20-47.5t-7-52.5q0-83 58.5-141.5T340-920q83 0 141.5 58.5T540-720q0 27-7 52.5T513-620l-69-40q8-14 12-28.5t4-31.5q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 17 4 31.5t12 28.5l-69 40Zm335 280Z"/></svg>
                    </div>
                    Get App
                </span>
            </div>
        </div>
    </a>

    <!-- NEW ARRIVALS -->
    <a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800 transition-transform duration-300 group">
        <!-- Image -->
        <div class="relative">
            <img src="https://dummyimage.com/600x500/94a3b8/ffffff&text=New+Arrivals"
                alt="New Arrivals"
                class="w-full h-auto object-cover transform group-hover:scale-105 transition-transform duration-300"
                loading="lazy" />

            <!-- Floating badge -->
            <span class="absolute top-2 left-2 text-[10px] font-medium px-2 py-0.5 {{ FD['rounded'] }} bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow">
                New
            </span>
        </div>

        <!-- Content -->
        <div class="p-3 sm:p-4">
            <h3 class="text-sm font-semibold text-slate-800 dark:text-slate-100">
                New Arrivals
            </h3>
            <p class="text-xs mt-[0.3rem] text-slate-500 dark:text-slate-300 leading-snug line-clamp-3">
                Fresh styles added today. Free returns within 30 days. Lorem ipsum dolor sit amet.
            </p>
        </div>
    </a>

    {{-- <a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800">
        <img src="https://dummyimage.com/600x500/94a3b8/ffffff&text=New+Arrivals" alt="New Arrivals" class="w-full h-auto object-cover" loading="lazy" />
        <div class="p-2 sm:p-4">
            <div class="flex items-center gap-2">
                <span class="text-xs bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 px-2 py-1{{ FD['rounded'] }}">New</span>
            </div>
            <p class="text-[10px] text-slate-500 dark:text-slate-300 mt-[0.6rem] line-clamp-2">Fresh styles added today. Free returns within 30 days. Lorem ipsum dolor sit amet.</p>
        </div>
    </a> --}}

    <!-- SAVE 50 -->
    <a href="#" class="block break-inside-avoid {{ FD['rounded'] }} overflow-hidden bg-white dark:bg-slate-800 group mt-2 sm:mt-4">
        <img src="https://dummyimage.com/600x300/94a3b8/ffffff&text=Save+50" alt="Save 50" class="w-full h-auto object-contain transform group-hover:scale-105 transition-transform duration-300" loading="lazy" />
    </a>
</div>
