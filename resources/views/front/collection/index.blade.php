<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Collection') }}">

    {{-- <div class="bg-gray-50 dark:bg-gray-900 min-h-screen"> --}}
    <div class="flex flex-col gap-2 sm:gap-4 px-2 sm:px-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-10">
            {{-- Hero / Top Advertisement --}}
            <div class="relative {{ FD['rounded'] }} overflow-hidden shadow-md">
                <img src="https://dummyimage.com/1200x300/ddd/000.png&text=Big+Sale+Banner" 
                    alt="Top Banner" 
                    class="w-full object-cover">
                <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                    <h1 class="text-3xl md:text-5xl font-bold text-white text-center">
                        Mega Deals of the Season!
                    </h1>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                {{-- Sidebar Ads --}}
                <aside class="hidden lg:block lg:col-span-3 space-y-6">
                    <div class="{{ FD['rounded'] }} shadow-md overflow-hidden">
                        <img src="https://dummyimage.com/300x600/ccc/000.png&text=Sidebar+Ad+1" alt="Ad 1">
                    </div>
                    <div class="{{ FD['rounded'] }} shadow-md overflow-hidden">
                        <img src="https://dummyimage.com/300x250/bbb/000.png&text=Sidebar+Ad+2" alt="Ad 2">
                    </div>
                </aside>

                {{-- Main Content --}}
                <main class="lg:col-span-9 space-y-10">

                    {{-- Collections --}}
                    <section>
                        <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-100">Top Collections</h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach(range(1,8) as $i)
                                <div class="group bg-white dark:bg-gray-800 {{ FD['rounded'] }} shadow-md hover:shadow-xl transition overflow-hidden">
                                    <img src="https://dummyimage.com/400x300/aaa/fff.png&text=Collection+{{ $i }}" 
                                        alt="Collection {{ $i }}" 
                                        class="w-full h-40 object-cover group-hover:scale-105 transition">
                                    <div class="p-3">
                                        <h3 class="font-semibold text-gray-700 dark:text-gray-200">Collection {{ $i }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">Explore now</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    {{-- Advertisement Wide --}}
                    <section class="{{ FD['rounded'] }} overflow-hidden shadow-md">
                        <img src="https://dummyimage.com/1200x200/f90/fff.png&text=Special+Offer+Ad" alt="Wide Ad">
                    </section>

                    {{-- Products --}}
                    <section>
                        <h2 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-100">Popular Products</h2>
                        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                            @foreach(range(1,12) as $i)
                                <div class="group bg-white dark:bg-gray-800 {{ FD['rounded'] }} shadow-md hover:shadow-xl transition flex flex-col">
                                    <img src="https://dummyimage.com/400x400/eee/000.png&text=Product+{{ $i }}" 
                                        alt="Product {{ $i }}" 
                                        class="w-full h-48 object-cover group-hover:scale-105 transition">
                                    <div class="p-3 flex flex-col flex-grow">
                                        <h3 class="font-semibold text-gray-700 dark:text-gray-200">Product {{ $i }}</h3>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Category</p>
                                        <div class="mt-auto flex justify-between items-center">
                                            <span class="text-lg font-bold text-indigo-600 dark:text-indigo-400">₹{{ rand(499,9999) }}</span>
                                            <button class="bg-indigo-600 text-white text-sm px-3 py-1 {{ FD['rounded'] }} hover:bg-indigo-700 transition">
                                                Buy
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </section>

                </main>
            </div>
        </div>
    </div>

</x-guest-layout>