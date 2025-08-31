@props(['data'])

<a href="#" class="w-full h-full md:h-56 grid grid-cols-1 md:grid-cols-[200px_1fr] items-stretch overflow-hidden bg-white {{ FD['rounded'] }} dark:bg-slate-800 hover:shadow-lg transition">
    <img src="https://dummyimage.com/500x500/ef4444/ffffff&text=Top+Pick" alt="Top Pick" class="w-full h-48 md:h-full object-cover" />

    <div class="p-4 flex-1 flex flex-col">
        <h4 class="text-sm font-semibold">Editor's Pick — Smart Wireless Earbuds</h4>
        <p class="text-xs text-slate-500 dark:text-slate-300 mt-1">Clear bass, 30hr battery, now at an unbeatable price.</p>

        <div class="flex items-center gap-1 mt-2">
            <span class="text-yellow-400">★ ★ ★ ★ ☆</span>
            <span class="text-xs text-slate-400">(4.2k reviews)</span>
        </div>

        <div class="mt-3 flex items-center gap-3">
            <div class="flex gap-4">
                <div class="text-sm font-semibold">₹ 1,499</div>
                <div class="text-xs text-slate-400 line-through">₹ 4,299</div>
            </div>
            <div class="ml-auto text-xs bg-emerald-100 dark:bg-emerald-900 text-emerald-800 dark:text-emerald-200 px-2 py-1 rounded">65% OFF</div>
        </div>

        <div class="mt-3 flex flex-wrap items-center gap-2 text-[11px] text-slate-500 dark:text-slate-300">
            <span class="px-2 py-1 bg-slate-100 dark:bg-slate-700 rounded">🚚 Free Delivery</span>
            <span class="px-2 py-1 bg-slate-100 dark:bg-slate-700 rounded">⏰ Only 12 left</span>
            <span class="px-2 py-1 bg-slate-100 dark:bg-slate-700 rounded">🛡 1-Year Warranty</span>
        </div>

        <div class="mt-4 flex items-center gap-2">
            <span class="cursor-pointer text-xs bg-brand text-white px-3 py-2 {{ FD['rounded'] }} hover:opacity-90">Add to Cart</span>
            <span class="cursor-pointer text-xs px-3 py-2 border {{ FD['rounded'] }} text-slate-600 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-700">Quick View</span>
        </div>
    </div>
</a>
