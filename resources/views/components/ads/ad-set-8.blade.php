@props(['data'])

<a href="#" class="block {{ FD['rounded'] }} overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 group w-full">
    <div class="relative">
        <img src="https://dummyimage.com/1200x600/111827/ffffff&text=Brand+Week" alt="Brand Week" class="w-full h-44 object-cover transition group-hover:scale-105" />
        <div class="absolute inset-0 flex items-end p-4">
            <div class="bg-white/90 dark:bg-slate-900/80 {{ FD['rounded'] }} p-3 w-full md:w-1/2">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 {{ FD['rounded'] }} bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-sm font-bold">B</div>
                    <div>
                        <h5 class="text-sm font-semibold">Brand Week — Selected Styles</h5>
                        <p class="text-xs text-slate-600 dark:text-slate-300 mt-1">Extra 10% off for members. Free returns.</p>
                    </div>
                </div>
                <div class="mt-3 flex items-center gap-2">
                    <span class="text-xs bg-brand text-white px-3 py-2 {{ FD['rounded'] }}">Shop Brand</span>
                    <span class="text-xs text-slate-500 dark:text-slate-300">Earn 2x points</span>
                </div>
            </div>
        </div>
    </div>
</a>
