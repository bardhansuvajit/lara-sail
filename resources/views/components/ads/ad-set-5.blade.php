@props(['data'])

<a href="#" class="block h-44 md:h-56 {{ FD['rounded'] }} overflow-hidden relative group">
    <img src="https://dummyimage.com/1200x420/0ea5a4/ffffff&text=Mega+Summer+Sale" alt="Mega Summer Sale" class="w-full h-56 object-cover transform group-hover:scale-105 transition-transform duration-300" />
    <div class="absolute inset-0 bg-gradient-to-r from-black/30 to-black/10 dark:from-black/40 dark:to-black/10 flex items-center">
        <div class="p-6 md:p-10 max-w-2xl">
            <h3 class="text-lg font-bold text-white">Mega Summer Sale — Up to <span class="text-yellow-300">70% OFF</span></h3>
            <p class="text-xs text-white/90 mt-2">Top brands, limited stock. Free express delivery on orders above ₹999.</p>
            <div class="mt-4 flex items-center gap-3">
                <span class="inline-flex items-center px-3 py-2 {{ FD['rounded'] }} bg-yellow-400 text-black text-sm font-semibold">Grab the Deal</span>
                <span class="text-xs text-white/80">Use code: <strong>SUMMER70</strong></span>
            </div>
        </div>
    </div>
</a>