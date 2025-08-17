<aside class="lg:col-span-1 space-y-4">
    <div class="bg-white dark:bg-gray-800 p-4 {{ FD['rounded'] }} shadow">
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

    <div class="bg-white dark:bg-gray-800 p-3 {{ FD['rounded'] }} shadow">
        <h4 class="text-xs font-semibold mb-2">Sponsored</h4>
        <a href="#" class="block {{ FD['rounded'] }} overflow-hidden mb-3">
            <img src="{{ $ads[1]['img'] }}" alt="Sponsored ad" class="w-full h-40 object-cover {{ FD['rounded'] }}">
        </a>
        <a href="#" class="block {{ FD['rounded'] }} overflow-hidden">
            <img src="{{ $ads[2]['img'] }}" alt="Sponsored ad 2" class="w-full h-40 object-cover {{ FD['rounded'] }}">
        </a>
    </div>

    {{-- <div class="bg-white dark:bg-gray-800 p-4 {{ FD['rounded'] }} shadow text-xs">
        <h4 class="font-semibold mb-2">Categories quick links</h4>
        <ul class="space-y-1">
            @foreach($categories as $c)
                <li>
                    <a href="#" class="text-sm text-gray-700 dark:text-gray-200">
                        {{ $c['title'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div> --}}
</aside>