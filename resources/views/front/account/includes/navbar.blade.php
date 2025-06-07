<nav class="bg-white dark:bg-gray-800 shadow-sm">
    <div class="max-w-7xl mx-auto px-0 md:px-2">
        <div class="flex space-x-0 overflow-x-auto py-4 hide-scrollbar">
            @php
                $classes = 'text-gray-500 dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-400';
                $activeClasses = 'text-primary-700 dark:text-primary-500 font-bold hover:text-indigo-600 dark:hover:text-indigo-400';
            @endphp

            <!-- Home/Logo -->
            <a href="{{ route('front.account.index') }}" class="flex {{FD['text']}} items-center shrink-0 {{ (request()->is('account*')) ? $activeClasses : $classes }} border-r border-gray-200 dark:border-gray-700 px-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                </svg>
                Account
            </a>

            <!-- Orders -->
            <a href="{{ route('front.order.index') }}" class="flex {{FD['text']}} items-center shrink-0 {{ (request()->is('order*')) ? $activeClasses : $classes }} border-r border-gray-200 dark:border-gray-700 px-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                </svg>
                Orders
            </a>

            <!-- Wallet -->
            {{-- <a href="#" class="flex {{FD['text']}} items-center shrink-0 text-gray-500 dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-400 border-r border-gray-200 dark:border-gray-700 px-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                    <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                </svg>
                Wallet
            </a> --}}

            <!-- Wishlist -->
            <a href="{{ route('front.wishlist.index') }}" class="flex {{FD['text']}} items-center shrink-0 {{ (request()->is('wishlist*')) ? $activeClasses : $classes }} border-r border-gray-200 dark:border-gray-700 px-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                </svg>
                Wishlist
            </a>
            
            <!-- Returns -->
            {{-- <a href="#" class="flex {{FD['text']}} items-center shrink-0 text-gray-500 dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-400 border-r border-gray-200 dark:border-gray-700 px-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.707 3.293a1 1 0 010 1.414L5.414 7H11a7 7 0 017 7v2a1 1 0 11-2 0v-2a5 5 0 00-5-5H5.414l2.293 2.293a1 1 0 11-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Returns
            </a> --}}
            
            <!-- Gift Cards -->
            {{-- <a href="#" class="flex {{FD['text']}} items-center shrink-0 text-gray-500 dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-400 border-r border-gray-200 dark:border-gray-700 px-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd" />
                    <path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z" />
                </svg>
                Gift Cards
            </a> --}}
            
            <!-- Subscriptions -->
            {{-- <a href="#" class="flex {{FD['text']}} items-center shrink-0 text-gray-500 dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-400 border-r border-gray-200 dark:border-gray-700 px-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z" clip-rule="evenodd" />
                </svg>
                Subscriptions
            </a> --}}
            
            <!-- Addresses -->
            <a href="{{ route('front.address.index') }}" class="flex {{FD['text']}} items-center shrink-0 {{ (request()->is('address*')) ? $activeClasses : $classes }} px-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                </svg>
                Addresses
            </a>
        </div>
    </div>
</nav>

<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>