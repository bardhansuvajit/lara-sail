<div class="p-4">
        <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
            <div class="grid grid-cols-1 gap-8 lg:gap-12 sm:grid-cols-4 lg:grid-cols-4">
                @foreach ($activeCategories as $category)
                    <div>
                        <div class="flex items-center gap-2">
                            <svg class="w-6 h-6 text-gray-900 flex-shrink-0 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 16H5a1 1 0 0 1-1-1V5c0-.6.4-1 1-1h14c.6 0 1 .4 1 1v1M9 12H4m8 8V9h8v11h-8Zm0 0H9m8-4a1 1 0 1 0-2 0 1 1 0 0 0 2 0Z"></path></svg>
                            <p class="{{FD['text']}} font-semibold leading-tight dark:text-white">
                                {{ $category['title'] }}
                            </p>
                        </div>

                        <ul class="mt-4 space-y-2 overflow-y-auto max-h-72 lg:max-h-[420px]">
                            {{-- @forelse ($category['active_children_by_position'] as $subcategory)
                                <li>
                                    <a href="#" title=""
                                        class="block {{FD['text']}} text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                                        {{ $subcategory['title'] }}
                                    </a>
                                </li>
                            @empty
                                <li></li>
                            @endforelse --}}
                        </ul>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 lg:mt-12">
                <a href="{{ route('front.category.index') }}" class="inline-flex items-center justify-center w-full py-2.5 px-5 gap-2 {{FD['text']}} font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 border-opacity-100 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700/100" >
                    See all categories
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4"></path></svg>
                </a>
            </div>
        </div>
    </div>