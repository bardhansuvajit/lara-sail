<nav class="bg-white dark:bg-gray-800 antialiased fixed top-0 right-0 shadow w-full z-10 transition-all" id="navbar">
    @include('layouts.front.navigation.alert')

    <!-- Highlights, Currency Dropdown, Support -->
    @include('layouts.front.navigation.quick')

    <!-- Logo, Search, Cart, Login, Account -->
    @include('layouts.front.navigation.menu')

    <!-- Categories, Collections -->
    @include('layouts.front.navigation.collections')

    @include('layouts.front.navigation.mobile-menu')
</nav>