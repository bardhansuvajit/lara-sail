<div class="py-3 hidden md:block">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
        <ul class="flex items-center gap-8">
            <li>
                <x-front.dropdown width="w-max" align="left" width="sm:w-max">
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

            <li class="hidden sm:flex">
                <button type="button" title=""
                    class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                    Best Sellers
                </button>
            </li>
            <li class="hidden sm:flex">
                <button type="button" title=""
                    class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                    Today's Deals
                </button>
            </li>
            <li class="hidden sm:flex">
                <button type="button" title=""
                    class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                    Gift Ideas
                </button>
            </li>
            <li class="hidden md:flex">
                <button type="button" title=""
                    class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                    Membership
                </button>
            </li>
            <li class="hidden sm:flex lg:hidden">
                <button type="button" title=""
                    class="inline-flex items-center gap-1 {{FD['text']}} font-medium text-gray-900 lg:hidden hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                    More
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="m19 9-7 7-7-7"></path>
                    </svg>
                </button>
            </li>
            <li class="hidden md:flex">
                <button type="button" title="" class="items-center hidden gap-1 {{FD['text']}} font-medium text-gray-900 lg:inline-flex hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                    Gift Cards
                </button>
            </li>
            <li class="hidden lg:flex">
                <button type="button" title=""
                    class="items-center hidden gap-1 {{FD['text']}} font-medium text-gray-900 lg:inline-flex hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                    Customer Service
                </button>
            </li>
            <li class="hidden md:flex">
                <button type="button" title=""
                    class="items-center hidden gap-1 {{FD['text']}} font-medium text-gray-900 lg:inline-flex hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
                    Open a Shop
                </button>
            </li>
        </ul>
    </div>
</div>