<x-guest-layout
    screen="max-w-screen-xl"
    title="{{ __('Category') }}">

    <div class="max-w-7xl mx-auto px-4 py-8">
        {{-- Page Heading --}}
        <div class="mb-4 text-center">
            <h1 class="text-lg font-semibold text-gray-900 dark:text-white">Shop by Category</h1>
            <p class="text-xs text-gray-600 dark:text-gray-400">Explore our wide range of products across categories</p>
        </div>

        {{-- Search --}}
        <div class="max-w-sm mx-auto mb-8">
            <form action="" method="GET">
                <div class="grid grid-cols-4 gap-2 items-end">
                    <div class="col-span-3">
                        <x-front.text-input 
                            name="search"
                            type="text" 
                            placeholder="Search Category..." 
                            value="{{ request('search') }}"
                            maxlength="80" 
                        />
                    </div>

                    <div class="col-span-1">
                        <button 
                            type="submit" 
                            class="w-full h-8 flex items-center justify-center {{FD['rounded']}} bg-primary-700 px-5 py-2.5 {{FD['text']}} font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                        >
                            Search
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Categories --}}
        @if(count($categories) > 0)
            @if (request('search'))
                <div class="mb-6 text-center">
                    <p class="text-xs text-primary-600 dark:text-primary-400 font-medium">
                        {{ count($categories) }} categories found{{ request('search') ? ' for "' . e(request('search')) . '"' : '' }}.
                    </p>

                    <a href="{{ route('front.category.index') }}"
                        class="text-xs text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 underline">
                        Clear filter
                    </a>
                </div>
            @endif

            @foreach($categories as $parent)
                {{-- Parent Category Section --}}
                <div class="mb-6">
                    <a href="{{ route('front.category.detail', $parent['slug']) }}" class="block mb-6 dark:hover:bg-gray-800 p-2">
                        <div class="flex items-center gap-4">
                            @if (!empty($parent['image']))
                                <img src="{{ Storage::url($parent['image']) }}"
                                    alt="{{ $parent['slug'] }}"
                                    class="w-12 h-12 object-contain flex-shrink-0 group-hover:scale-105" />
                            @else
                                <div class="w-12 h-12">
                                    {!! FD['brokenImageFront'] !!}
                                </div>
                            @endif

                            <div>
                                <h2 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $parent['name'] }}</h2>
                                <p class="text-xs text-gray-600 dark:text-gray-400">{{ $parent['description'] }}</p>
                            </div>
                        </div>
                    </a>

                    {{-- Child Categories Grid --}}
                    <div class="grid grid-cols-3 sm:grid-cols-6 lg:grid-cols-10 gap-4 mb-4">
                        @foreach($parent['children'] as $child)
                            <div class="group bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:shadow-lg transition-all">
                                <a href="{{ route('front.category.detail', $child['slug']) }}" class="block">
                                    <div class="aspect-square bg-gray-100 dark:bg-gray-700 flex items-center justify-center overflow-hidden p-3">
                                        @if (!empty($parent['image']))
                                            <img src="{{ Storage::url($child['image']) }}"
                                                alt="{{ $child['slug'] }}"
                                                class="object-contain w-full h-full group-hover:scale-105 transition-transform" />
                                        @else
                                            <div class="w-12 h-12">
                                                {!! FD['brokenImageFront'] !!}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="p-3">
                                        <h3 class="text-xs font-medium text-gray-900 dark:text-white">{{ $child['name'] }}</h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $child['products_count'] }} Products</p>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    {{-- Sub-Child Categories Grid (next line, same design) --}}
                    @php
                        $subChildren = collect($parent['children'])->flatMap(function($child) {
                            return $child['children'] ?? [];
                        });
                    @endphp

                    @if($subChildren->isNotEmpty())
                        <div class="grid grid-cols-3 sm:grid-cols-6 lg:grid-cols-10 gap-4">
                            @foreach($subChildren as $sub)
                                <div class="group bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:shadow-lg transition-all">
                                    <a href="{{ route('front.category.detail', $sub['slug']) }}" class="block">
                                        <div class="aspect-square bg-gray-100 dark:bg-gray-700 flex items-center justify-center overflow-hidden p-3">
                                            @if (!empty($parent['image']))
                                                <img src="{{ Storage::url($sub['image']) }}"
                                                    alt="{{ $sub['slug'] }}"
                                                    class="object-contain w-full h-full group-hover:scale-105 transition-transform" />
                                            @else
                                                <div class="w-12 h-12">
                                                    {!! FD['brokenImageFront'] !!}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="p-3">
                                            <h3 class="text-xs font-medium text-gray-900 dark:text-white">{{ $sub['name'] }}</h3>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $sub['products_count'] ?? 0 }} Products</p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach

        @else
            <div class="text-center py-16 border border-dashed border-gray-300 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800">
                <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 9.75L14.25 14.25M14.25 9.75L9.75 14.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                <p class="mt-4 text-base font-medium text-gray-900 dark:text-white">
                    No categories found
                </p>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Try adjusting your search or browse all categories.
                </p>

                <a href="{{ route('front.category.index') }}"
                class="mt-6 inline-flex items-center px-4 py-2 text-sm font-medium text-white {{ FD['rounded'] }} bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-colors">
                    See All Categories
                </a>
            </div>

        @endif
    </div>

</x-guest-layout>
