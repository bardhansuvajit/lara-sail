<div class="p-4">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
        <div class="grid grid-cols-1 gap-8 lg:gap-12 sm:grid-cols-4 lg:grid-cols-4">
            @foreach ($activeCategories as $category)
                <div>
                    <a href="{{ route('front.category.detail', $category['slug']) }}" class="text-gray-700 dark:text-gray-200 dark:hover:text-white">
                        <div class="flex items-center gap-2">
                            @if (!empty($category['image_s']))
                                <img src="{{ Storage::url($category['image_s']) }}"
                                    alt="{{ $category['slug'] }}"
                                    class="object-contain w-5 h-5 group-hover:scale-105 transition-transform" />
                            @endif
                            <p class="{{FD['text']}} font-semibold leading-tight">
                                {{ $category['title'] }}
                            </p>
                        </div>
                    </a>

                    <ul class="mt-4 space-y-2 overflow-y-auto max-h-72 lg:max-h-[420px]">
                        @forelse ($category['active_children_by_position'] as $subcategory)
                            <li>
                                <a href="{{ route('front.category.detail', $subcategory['slug']) }}"
                                    class="block {{FD['text']}} text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                                    <div class="flex space-x-2">
                                        @if (!empty($subcategory['image_s']))
                                            <img src="{{ Storage::url($subcategory['image_s']) }}"
                                                alt="{{ $subcategory['slug'] }}"
                                                class="object-contain w-5 h-5 group-hover:scale-105 transition-transform" />
                                        @endif

                                        <p>{{ $subcategory['title'] }}</p>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li></li>
                        @endforelse
                    </ul>
                </div>
            @endforeach
        </div>

        <div class="mt-6 lg:mt-8">
            <a href="{{ route('front.category.index') }}" class="inline-flex items-center justify-center w-full py-2.5 px-5 gap-2 {{FD['text']}} font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 border-opacity-100 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700/100" >
                See all categories
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"></path></svg>
            </a>
        </div>
    </div>
</div>