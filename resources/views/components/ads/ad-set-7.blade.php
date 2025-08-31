@props(['data'])

<a href="#" class="block {{ FD['rounded'] }} overflow-hidden border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-4 w-full">
    <div class="flex gap-4 items-center">
        <div class="grid grid-cols-3 gap-2 w-36">
            <img src="https://dummyimage.com/120x120/6366f1/ffffff&text=A" alt="item A" class="w-full h-20 object-cover{{ FD['rounded'] }}" />
            <img src="https://dummyimage.com/120x120/f59e0b/ffffff&text=B" alt="item B" class="w-full h-20 object-cover{{ FD['rounded'] }}" />
            <img src="https://dummyimage.com/120x120/06b6d4/ffffff&text=C" alt="item C" class="w-full h-20 object-cover{{ FD['rounded'] }}" />
        </div>
        <div class="flex-1">
            <h4 class="text-sm font-semibold">Family Bundle — Breakfast + Snacks</h4>
            <p class="text-xs text-slate-500 dark:text-slate-300 mt-1">3 bestselling items bundled with free priority shipping.</p>

            <div class="mt-3 flex items-center gap-3">
                <div class="text-sm font-semibold">₹ 899</div>
                <div class="text-xs text-slate-400 line-through">₹ 1,499</div>
                <div class="ml-auto text-xs text-white bg-red-500 px-2 py-1{{ FD['rounded'] }}">Limited — 24 left</div>
            </div>

            <div class="mt-3 flex items-center gap-2">
                <span class="text-xs bg-brand text-white px-3 py-2 {{ FD['rounded'] }}">Buy Bundle</span>
                <span class="text-xs text-slate-500 dark:text-slate-300">Or add items separately</span>
            </div>
        </div>
    </div>
</a>
