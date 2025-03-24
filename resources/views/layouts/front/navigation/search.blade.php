<form class="w-full md:w-auto md:flex-1 md:order-2">
    {{-- <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 custom-1 dark:text-white">Search</label> --}}
    <div class="relative">
        <div class="absolute z-1 inset-y-0 flex items-center pointer-events-none start-0 ps-3">
            <svg class="w-3 h-3 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"></path></svg>
        </div>

        <input type="search" id="default-search" class="block w-full px-1 py-2 text-xs text-gray-900 border border-gray-100 {{FD['rounded']}} ps-8 bg-gray-100 focus:ring-primary-500 focus:border-primary-500  dark:bg-gray-700 dark:border-gray-700 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 lg:pr-24" placeholder="Search in all categories" required="">
    </div>
</form>