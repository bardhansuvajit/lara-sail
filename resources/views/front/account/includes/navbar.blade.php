<nav class="bg-white dark:bg-gray-800 shadow-sm">
    <div class="max-w-7xl mx-auto px-2 md:px-4">
        <div class="flex space-x-0 overflow-x-auto py-2 md:py-4 hide-scrollbar">
            @php
                // Base: spacing, layout, and accessible focus ring + transition
                $base = 'text-xs md:text-base flex items-center shrink-0 px-3 py-2 {{ FD["rounded"] }} font-semibold transition-colors duration-150 ease-in-out focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-500';

                // Normal link: good contrast in light & dark, subtle hover
                $classes = $base . ' text-gray-500 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-300';

                // Active link: stronger visual weight + subtle background to indicate active state
                // kept boldness moderate for better readability; background uses slight tint for both modes
                $activeClasses = $base . ' text-indigo-700 dark:text-indigo-200 bg-indigo-50 dark:bg-indigo-700/40';
            @endphp

            <!-- Account -->
            @php $is = request()->is('account*'); @endphp
            <a href="{{ route('front.account.index') }}"
               class="{{ $is ? $activeClasses : $classes }} border-transparent"
               @if($is) aria-current="page" @endif>
                <svg xmlns="http://www.w3.org/2000/svg" class="{{ FD['iconClass'] }} mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg>
                Account
            </a>

            <!-- Orders -->
            @php $is = request()->is('order*'); @endphp
            <a href="{{ route('front.order.index') }}"
               class="{{ $is ? $activeClasses : $classes }} border-transparent"
               @if($is) aria-current="page" @endif>
                <svg xmlns="http://www.w3.org/2000/svg" class="{{ FD['iconClass'] }} mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd" />
                </svg>
                Orders
            </a>

            <!-- Wishlist -->
            @php $is = request()->is('wishlist*'); @endphp
            <a href="{{ route('front.wishlist.index') }}"
               class="{{ $is ? $activeClasses : $classes }} border-transparent"
               @if($is) aria-current="page" @endif>
                <svg xmlns="http://www.w3.org/2000/svg" class="{{ FD['iconClass'] }} mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                </svg>
                Wishlist
            </a>

            <!-- Address -->
            @php $is = request()->is('address*'); @endphp
            <a href="{{ route('front.address.index') }}"
               class="{{ $is ? $activeClasses : $classes }} border-transparent"
               @if($is) aria-current="page" @endif>
                <svg xmlns="http://www.w3.org/2000/svg" class="{{ FD['iconClass'] }} mr-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                </svg>
                Address
            </a>
        </div>
    </div>
</nav>

<style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
