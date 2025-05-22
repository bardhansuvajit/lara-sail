<nav class="">
    <div class="max-w-screen-xl mx-auto">
        <div class="flex items-center">
            <ul class="flex flex-row font-medium mt-0 space-x-2 rtl:space-x-reverse text-sm">
                <li>
                    <a href="{{ route('admin.application.settings.index', 'basic') }}" class="px-4 py-3 inline-block text-gray-900 dark:text-white hover:underline {{ request()->is('admin/application/settings/basic*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}" aria-current="page">Basic</a>
                </li>
                <li>
                    <a href="{{ route('admin.application.settings.index', 'cart') }}" class="px-4 py-3 inline-block text-gray-900 dark:text-white hover:underline {{ request()->is('admin/application/settings/cart*') ? 'bg-gray-100 dark:bg-gray-700' : '' }}">Cart</a>
                </li>
            </ul>
        </div>
    </div>
</nav>