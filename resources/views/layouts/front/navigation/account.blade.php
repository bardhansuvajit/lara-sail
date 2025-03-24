<x-front.dropdown width="60">
    <x-slot name="trigger">
        <button type="button" class="inline-flex items-center {{FD['rounded']}} justify-center p-2 hover:bg-gray-100 dark:hover:bg-gray-700/100 {{FD['text']}} font-medium leading-tight dark:text-white">
            <svg class="w-4 h-4 lg:me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path></svg>
            <span class="hidden lg:block">Account</span>
            {!! FD['dropdownCaret'] !!}
        </button>
    </x-slot>
    <x-slot name="content">
        <div class="z-50 w-60 divide-y-2 overflow-hidden overflow-y-auto {{FD['rounded']}} bg-white antialiased dark:divide-gray-600 dark:bg-gray-700">
            <ul class="p-2 text-start {{FD['text']}} font-medium dark:text-white dark:border-gray-600">
                <li>
                    <a href="#" title="" class="flex items-center gap-2 rounded px-3 py-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400 dark:hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z">
                            </path>
                        </svg>
                        My Orders
                    </a>
                </li>
                <li>
                    <a href="#" title=""
                        class="flex items-center gap-2 rounded px-3 py-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M17 8H5m12 0c.6 0 1 .4 1 1v2.6M17 8l-4-4M5 8a1 1 0 0 0-1 1v10c0 .6.4 1 1 1h12c.6 0 1-.4 1-1v-2.6M5 8l4-4 4 4m6 4h-4a2 2 0 1 0 0 4h4c.6 0 1-.4 1-1v-2c0-.6-.4-1-1-1Z">
                            </path>
                        </svg>
                        My Wallet
                    </a>
                </li>
                <li>
                    <a href="#" title=""
                        class="flex items-center gap-2 rounded px-3 py-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z"></path>
                        </svg>
                        Favourites Items
                    </a>
                </li>
                <li>
                    <a href="#" title=""
                        class="flex items-center gap-2 rounded px-3 py-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M21 9H8a5 5 0 0 0 0 10h9m4-10-4-4m4 4-4 4"></path>
                        </svg>
                        My Returns
                    </a>
                </li>
                <li>
                    <a href="#" title=""
                        class="flex items-center gap-2 rounded px-3 py-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M10 21v-9m3-4H7.5a2.5 2.5 0 1 1 0-5c1.5 0 2.9 1.3 3.9 2.5M14 21v-9m-9 0h14v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-8ZM4 8h16a1 1 0 0 1 1 1v3H3V9a1 1 0 0 1 1-1Zm12.2-5c-3 0-5.5 5-5.5 5h5.5a2.5 2.5 0 0 0 0-5Z">
                            </path>
                        </svg>
                        Gift Cards
                    </a>
                </li>
                <li>
                    <a href="#" title=""
                        class="flex items-center gap-2 rounded px-3 py-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M11 16v-5.5C11 8.5 9.4 7 7.5 7m3.5 9H4v-5.5C4 8.5 5.6 7 7.5 7m3.5 9v4M7.5 7H14m0 0V4h2.5M14 7v3m-3.5 6H20v-6a3 3 0 0 0-3-3m-2 9v4m-8-6.5h1">
                            </path>
                        </svg>
                        Subscriptions
                    </a>
                </li>
            </ul>

            <ul class="p-2 text-start {{FD['text']}} font-medium dark:text-white dark:border-gray-600">
                <li>
                    <a href="#" title=""
                        class="flex items-center gap-2 rounded px-3 py-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-width="2"
                                d="M7 17v1c0 .6.4 1 1 1h8c.6 0 1-.4 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z">
                            </path>
                        </svg>
                        Account
                    </a>
                </li>
                <li>
                    <a href="#" title=""
                        class="flex items-center gap-2 rounded px-3 py-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M21 13v-2a1 1 0 0 0-1-1h-.8l-.7-1.7.6-.5a1 1 0 0 0 0-1.5L17.7 5a1 1 0 0 0-1.5 0l-.5.6-1.7-.7V4a1 1 0 0 0-1-1h-2a1 1 0 0 0-1 1v.8l-1.7.7-.5-.6a1 1 0 0 0-1.5 0L5 6.3a1 1 0 0 0 0 1.5l.6.5-.7 1.7H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.8l.7 1.7-.6.5a1 1 0 0 0 0 1.5L6.3 19a1 1 0 0 0 1.5 0l.5-.6 1.7.7v.8a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.8l1.7-.7.5.6a1 1 0 0 0 1.5 0l1.4-1.4a1 1 0 0 0 0-1.5l-.6-.5.7-1.7h.8a1 1 0 0 0 1-1Z">
                            </path>
                            <path stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
                        </svg>
                        Settings
                    </a>
                </li>
                <li>
                    <a href="#" title=""
                        class="flex items-center gap-2 rounded px-3 py-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M12 14v3m-3-6V7a3 3 0 1 1 6 0v4m-8 0h10c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1H7a1 1 0 0 1-1-1v-7c0-.6.4-1 1-1Z">
                            </path>
                        </svg>
                        Privacy
                    </a>
                </li>
                <li>
                    <a href="#" title=""
                        class="flex items-center gap-2 rounded px-3 py-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M12 5.4V3m0 2.4a5.3 5.3 0 0 1 5.1 5.3v1.8c0 2.4 1.9 3 1.9 4.2 0 .6 0 1.3-.5 1.3h-13c-.5 0-.5-.7-.5-1.3 0-1.2 1.9-1.8 1.9-4.2v-1.8A5.3 5.3 0 0 1 12 5.4ZM8.7 18c.1.9.3 1.5 1 2.1a3.5 3.5 0 0 0 4.6 0c.7-.6 1.3-1.2 1.4-2.1h-7Z">
                            </path>
                        </svg>
                        Notifications
                    </a>
                </li>
            </ul>

            <ul class="p-2 text-start {{FD['text']}} font-medium dark:text-white dark:border-gray-600">
                <li>
                    <a href="#" title=""
                        class="flex items-center gap-2 rounded px-3 py-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M12 6v13m0-13c-2.8-.8-4.7-1-8-1a1 1 0 0 0-1 1v11c0 .6.5 1 1 1 3.2 0 5 .2 8 1m0-13c2.8-.8 4.7-1 8-1 .6 0 1 .5 1 1v11c0 .6-.5 1-1 1-3.2 0-5 .2-8 1">
                            </path>
                        </svg>
                        Help Guide
                    </a>
                </li>
                <li>
                    <a href="#" title=""
                        class="flex items-center gap-2 rounded px-3 py-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round" stroke-width="2"
                                d="M9.5 10a2.5 2.5 0 1 1 5 .2 2.4 2.4 0 0 1-2.5 2.4V14m0 3h0m9-5a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z">
                            </path>
                        </svg>
                        Help Center
                    </a>
                </li>
            </ul>

            <ul class="p-2 text-start {{FD['text']}} font-medium dark:text-white dark:border-gray-600">
                <li>
                    <span class="flex items-center justify-between gap-2 rounded px-3 py-2 text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-600">
                        <label class="inline-flex cursor-pointer items-center" @click.stop="open = true">
                            <input type="checkbox" value="" class="sr-only peer" name="dark-mode" id="dark-mode" />

                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>

                            <span class="ms-3 {{FD['text']}} font-medium text-gray-900 dark:text-gray-300">Dark mode</span>
                        </label>
                    </span>
                </li>
            </ul>

            <ul class="p-2 text-start {{FD['text']}} font-medium dark:text-white dark:border-gray-600">
                <li>
                    <a href="#" title=""
                        class="flex items-center gap-2 rounded px-3 py-2 {{FD['text']}} text-red-600 VhtI3z1ny8F7lVdACbUQ dark:text-red-400 dark:hover:bg-gray-600">
                        <svg class="h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"></path></svg>
                        Sign Out
                    </a>
                </li>
            </ul>
        </div>
    </x-slot>
</x-front.dropdown>