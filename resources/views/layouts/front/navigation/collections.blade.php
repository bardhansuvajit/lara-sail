<div class="py-3 hidden md:block">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
        <ul class="flex items-center gap-8">
            <li>
                <x-front.dropdown align="left" width="full" name="category-dropdown">
                    <x-slot name="trigger">
                        <button type="button" class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                            All categories
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"></path></svg>
                        </button>
                    </x-slot>
                    <x-slot name="content">

                        <!-- categories -->
                        @include('layouts.front.navigation.categories')

                    </x-slot>
                </x-front.dropdown>
            </li>

            @foreach ($activeCollections as $collection)
                <li class="hidden sm:flex">
                    <a href="{{ route('front.collection.detail', $collection->slug) }}">
                        <button type="button" class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                            {{ $collection->title }}
                        </button>
                    </a>
                </li>
            @endforeach

            {{-- <li class="hidden md:flex">
                <button type="button" class="items-center hidden gap-1 {{FD['text']}} font-medium text-gray-900 lg:inline-flex hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                    Open a Shop

                    <span class="relative px-1.5 font-mono text-[0.625rem]/[1.125rem] font-medium tracking-widest text-sky-800 uppercase dark:text-sky-300">
                        <span class="absolute inset-0 border border-dashed border-sky-300/60 bg-sky-400/10 group-hover:bg-sky-400/15 dark:border-sky-300/30"></span>
                        New
                        <svg width="5" height="5" viewBox="0 0 5 5" class="absolute top-[-2px] left-[-2px] fill-sky-300 dark:fill-sky-300/50"><path d="M2 0h1v2h2v1h-2v2h-1v-2h-2v-1h2z"></path></svg><svg width="5" height="5" viewBox="0 0 5 5" class="absolute top-[-2px] right-[-2px] fill-sky-300 dark:fill-sky-300/50"><path d="M2 0h1v2h2v1h-2v2h-1v-2h-2v-1h2z"></path></svg><svg width="5" height="5" viewBox="0 0 5 5" class="absolute bottom-[-2px] left-[-2px] fill-sky-300 dark:fill-sky-300/50"><path d="M2 0h1v2h2v1h-2v2h-1v-2h-2v-1h2z"></path></svg><svg width="5" height="5" viewBox="0 0 5 5" class="absolute right-[-2px] bottom-[-2px] fill-sky-300 dark:fill-sky-300/50"><path d="M2 0h1v2h2v1h-2v2h-1v-2h-2v-1h2z"></path></svg>
                    </span>
                </button>
            </li> --}}

        </ul>
    </div>
</div>