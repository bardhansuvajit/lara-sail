<x-app-layout
    screen="md:w-full"
    title="{{ __('Dashboard') }}">

    <section class="bg-white dark:bg-gray-900 antialiased !mt-64 mb-8 px-4">
        <div class="mx-auto max-w-screen-xl grid grid-cols-4 lg:grid-cols-8 md:grid-cols-6 gap-4 lg:gap-4">
            <div class="overflow-hidden hover:shadow-sm">
                <a href="#">
                    <div class="m-2 h-auto text-center mx-auto">
                        <img class="mb-4 h-8 sm:h-20 inline-block dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="imac">
                        <img class="mb-4 hidden h-8 sm:h-20 dark:inline-block dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="imac">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-0 dark:text-gray-400 break-all">Laptop/Computers</p>
                    </div>
                </a>
            </div>
            <div class="overflow-hidden hover:shadow-sm">
                <a href="#">
                    <div class="m-2 h-auto text-center mx-auto">
                        <img class="mb-4 h-8 sm:h-20 inline-block dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ps5-controller.svg" alt="controller">
                        <img class="mb-4 hidden h-8 sm:h-20 dark:inline-block dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/ps5-controller-dark.svg" alt="controller-dark">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-0 dark:text-gray-400 break-all">Gaming</p>
                    </div>
                </a>
            </div>
            <div class="overflow-hidden hover:shadow-sm">
                <a href="#">
                    <div class="m-2 h-auto text-center mx-auto">
                        <img class="mb-4 h-8 sm:h-20 inline-block dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/bag.svg" alt="shopping-bag">
                        <img class="mb-4 hidden h-8 sm:h-20 dark:inline-block dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/bag-dark.svg" alt="shopping-bag">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-0 dark:text-gray-400 break-all">Fashion/Clothes</p>
                    </div>
                </a>
            </div>
            <div class="overflow-hidden hover:shadow-sm">
                <a href="#">
                    <div class="m-2 h-auto text-center mx-auto">
                        <img class="mb-4 h-8 sm:h-20 inline-block dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/football.svg" alt="ball">
                        <img class="mb-4 hidden h-8 sm:h-20 dark:inline-block dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/football-dark.svg" alt="ball">
                        <p class="text-xs text-gray-500 dark:text-gray-400 mb-0 dark:text-gray-400 break-all">Sports/Outdoors</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section class="bg-gray-50 py-8 antialiased dark:bg-gray-900 md:py-8">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <!-- Heading & Filters -->
            <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
                <p class="text-sm font-semibold text-gray-900 dark:text-white sm:text-sm">Featured products</h2>
            </div>

            <div class="mb-4 grid gap-2 sm:gap-4 grid-cols-2 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
                <div
                class="rounded-lg border border-gray-200 bg-white p-2 sm:p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800 relative sm:static">
                <div class="h-40 w-full">
                    <a href="#">
                    <img class="mx-auto h-full dark:hidden"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="" />
                    <img class="mx-auto hidden h-full dark:block"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front-dark.svg" alt="" />
                    </a>
                </div>
                <div class="pt-6">
                    <div class="mb-4 flex items-center justify-between gap-4">
                    <span
                        class="me-0 sm:me-2 rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                        Up to 35% off </span>

                    <div class="flex items-center justify-end gap-1">
                        <button type="button" data-tooltip-target="tooltip-add-to-favorites"
                        class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white absolute top-0 right-0 sm:static">
                        <span class="sr-only"> Add to Favorites </span>
                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z" />
                        </svg>
                        </button>

                        <div id="tooltip-add-to-favorites" role="tooltip"
                        class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                        data-popper-placement="top">
                        Add to favorites
                        <div class="tooltip-arrow" data-popper-arrow=""></div>
                        </div>
                    </div>
                    </div>

                    <a href="#"
                    class="font-semibold text-gray-900 hover:underline dark:text-white text-xs sm:text-base sm:text-lg block leading-4 sm:leading-5">Apple
                    iMac 27", 1TB HDD, Retina 5K Display, M3 Max</a>

                    <div class="mt-2 flex items-center gap-1 sm:gap-2">
                    <div class="flex items-center">
                        <svg class="h-3 w-3 sm:h-4 sm:w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>

                        <svg class="h-3 w-3 sm:h-4 sm:w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>

                        <svg class="h-3 w-3 sm:h-4 sm:w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>

                        <svg class="h-3 w-3 sm:h-4 sm:w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>

                        <svg class="h-3 w-3 sm:h-4 sm:w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>
                    </div>

                    <p class="text-xs font-medium text-gray-900 dark:text-white sm:text-sm">5.0</p>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 sm:text-sm italic">(455)</p>
                    </div>

                    <ul class="mt-2 sm:mt-4 hidden items-center gap-4 sm:flex">
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                        </svg>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Fast Delivery</p>
                    </li>

                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M8 7V6c0-.6.4-1 1-1h11c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1h-1M3 18v-7c0-.6.4-1 1-1h11c.6 0 1 .4 1 1v7c0 .6-.4 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                        </svg>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Best Price</p>
                    </li>
                    </ul>

                    <div class="mt-4 sm:flex items-center justify-between gap-4">
                    <p class="text-lg sm:text-2xl font-extrabold leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                        $1,699</p>

                    <button type="button"
                        class="inline-flex items-center rounded-lg bg-primary-700 px-4 py-2.5 text-xs font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 w-full sm:w-auto justify-center">
                        <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                        </svg>
                        Add to cart
                    </button>
                    </div>
                </div>
                </div>

                <div
                class="rounded-lg border border-gray-200 bg-white p-2 sm:p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800 relative sm:static">
                <div class="h-40 w-full">
                    <a href="#">
                    <img class="mx-auto h-full dark:hidden"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/iphone-light.svg" alt="" />
                    <img class="mx-auto hidden h-full dark:block"
                        src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/iphone-dark.svg" alt="" />
                    </a>
                </div>
                <div class="pt-6">
                    <div class="mb-4 flex items-center justify-between gap-4">
                    <span
                        class="me-0 sm:me-2 rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                        Up to 15% off </span>

                    <div class="flex items-center justify-end gap-1">
                        <button type="button" data-tooltip-target="tooltip-add-to-favorites"
                        class="rounded-lg p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white absolute top-0 right-0 sm:static">
                        <span class="sr-only"> Add to Favorites </span>
                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6C6.5 1 1 8 5.8 13l6.2 7 6.2-7C23 8 17.5 1 12 6Z" />
                        </svg>
                        </button>

                        <div id="tooltip-add-to-favorites" role="tooltip"
                        class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700"
                        data-popper-placement="top">
                        Add to favorites
                        <div class="tooltip-arrow" data-popper-arrow=""></div>
                        </div>
                    </div>
                    </div>

                    <a href="#"
                    class="font-semibold text-gray-900 hover:underline dark:text-white text-xs sm:text-base sm:text-lg block leading-4 sm:leading-5">Apple
                    iPhone 15 Pro Max, 256GB, Blue Titanium</a>

                    <div class="mt-2 flex items-center gap-1 sm:gap-2">
                    <div class="flex items-center">
                        <svg class="h-3 w-3 sm:h-4 sm:w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>

                        <svg class="h-3 w-3 sm:h-4 sm:w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>

                        <svg class="h-3 w-3 sm:h-4 sm:w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>

                        <svg class="h-3 w-3 sm:h-4 sm:w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>

                        <svg class="h-3 w-3 sm:h-4 sm:w-4 text-yellow-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>
                    </div>

                    <p class="text-xs font-medium text-gray-900 dark:text-white sm:text-sm">3.9</p>
                    <p class="text-xs font-medium text-gray-500 dark:text-gray-400 sm:text-sm italic">(1,233)</p>
                    </div>

                    <ul class="mt-2 sm:mt-4 hidden items-center gap-4 sm:flex">
                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7.171 12.906-2.153 6.411 2.672-.89 1.568 2.34 1.825-5.183m5.73-2.678 2.154 6.411-2.673-.89-1.568 2.34-1.825-5.183M9.165 4.3c.58.068 1.153-.17 1.515-.628a1.681 1.681 0 0 1 2.64 0 1.68 1.68 0 0 0 1.515.628 1.681 1.681 0 0 1 1.866 1.866c-.068.58.17 1.154.628 1.516a1.681 1.681 0 0 1 0 2.639 1.682 1.682 0 0 0-.628 1.515 1.681 1.681 0 0 1-1.866 1.866 1.681 1.681 0 0 0-1.516.628 1.681 1.681 0 0 1-2.639 0 1.681 1.681 0 0 0-1.515-.628 1.681 1.681 0 0 1-1.867-1.866 1.681 1.681 0 0 0-.627-1.515 1.681 1.681 0 0 1 0-2.64c.458-.361.696-.935.627-1.515A1.681 1.681 0 0 1 9.165 4.3ZM14 9a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z" />
                        </svg>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Best Seller</p>
                    </li>

                    <li class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h6l2 4m-8-4v8m0-8V6a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v9h2m8 0H9m4 0h2m4 0h2v-4m0 0h-5m3.5 5.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Zm-10 0a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />
                        </svg>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Shipping Today</p>
                    </li>
                    </ul>

                    <div class="mt-4 sm:flex items-center justify-between gap-4">
                    <p class="text-lg sm:text-2xl font-extrabold leading-tight text-gray-900 dark:text-white mb-4 sm:mb-0">
                        $11,345</p>

                    <button type="button"
                        class="inline-flex items-center rounded-lg bg-primary-700 px-4 py-2.5 text-xs font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg class="-ms-2 me-2 h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                        </svg>
                        Add to cart
                    </button>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Filter modal -->
        <form action="#" method="get" id="filterModal" tabindex="-1" aria-hidden="true"
        class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0 md:h-full">
            <div class="relative h-full w-full max-w-xl md:h-auto">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-start justify-between rounded-t p-4 md:p-5">
                    <h3 class="text-lg font-normal text-gray-500 dark:text-gray-400">Filters</h3>
                    <button type="button"
                    class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="filterModal">
                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="px-4 md:px-5">
                    <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                    <ul class="-mb-px flex flex-wrap text-center text-sm font-medium" id="myTab"
                        data-tabs-toggle="#myTabContent" role="tablist">
                        <li class="mr-1" role="presentation">
                        <button class="inline-block pb-2 pr-1" id="brand-tab" data-tabs-target="#brand" type="button"
                            role="tab" aria-controls="profile" aria-selected="false">Brand</button>
                        </li>
                        <li class="mr-1" role="presentation">
                        <button
                            class="inline-block px-2 pb-2 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300"
                            id="advanced-filers-tab" data-tabs-target="#advanced-filters" type="button" role="tab"
                            aria-controls="advanced-filters" aria-selected="false">Advanced Filters</button>
                        </li>
                    </ul>
                    </div>
                    <div id="myTabContent">
                    <div class="grid grid-cols-2 gap-4 md:grid-cols-3" id="brand" role="tabpanel" aria-labelledby="brand-tab">
                        <div class="space-y-2">
                        <h5 class="text-lg font-medium uppercase text-black dark:text-white">A</h5>

                        <div class="flex items-center">
                            <input id="apple" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="apple" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Apple (56)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="asus" type="checkbox" value="" checked
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="asus" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Asus (97)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="acer" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="acer" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Acer (234)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="allview" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="allview" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Allview (45)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="atari" type="checkbox" value="" checked
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="asus" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Atari (176)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="amd" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="amd" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> AMD (49)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="aruba" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="aruba" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Aruba (16)
                            </label>
                        </div>
                        </div>

                        <div class="space-y-2">
                        <h5 class="text-lg font-medium uppercase text-black dark:text-white">B</h5>

                        <div class="flex items-center">
                            <input id="beats" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="beats" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Beats (56)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="bose" type="checkbox" value="" checked
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="bose" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Bose (97)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="benq" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="benq" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> BenQ (45)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="bosch" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="bosch" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Bosch (176)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="brother" type="checkbox" value="" checked
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="brother" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Brother
                            (176) </label>
                        </div>

                        <div class="flex items-center">
                            <input id="biostar" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="biostar" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Biostar (49)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="braun" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="braun" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Braun (16)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="blaupunkt" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="blaupunkt" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Blaupunkt
                            (45) </label>
                        </div>

                        <div class="flex items-center">
                            <input id="benq2" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="benq2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> BenQ (23)
                            </label>
                        </div>
                        </div>

                        <div class="space-y-2">
                        <h5 class="text-lg font-medium uppercase text-black dark:text-white">C</h5>

                        <div class="flex items-center">
                            <input id="canon" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="canon" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Canon (49)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="cisco" type="checkbox" value="" checked
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="cisco" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Cisco (97)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="cowon" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="cowon" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Cowon (234)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="clevo" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="clevo" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Clevo (45)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="corsair" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="corsair" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Corsair (15)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="csl" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="csl" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Canon (49)
                            </label>
                        </div>
                        </div>

                        <div class="space-y-2">
                        <h5 class="text-lg font-medium uppercase text-black dark:text-white">D</h5>

                        <div class="flex items-center">
                            <input id="dell" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="dell" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Dell (56)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="dogfish" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="dogfish" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Dogfish (24)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="dyson" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="dyson" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Dyson (234)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="dobe" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="dobe" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Dobe (5)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="digitus" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="digitus" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Digitus (1)
                            </label>
                        </div>
                        </div>

                        <div class="space-y-2">
                        <h5 class="text-lg font-medium uppercase text-black dark:text-white">E</h5>

                        <div class="flex items-center">
                            <input id="emetec" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="emetec" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Emetec (56)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="extreme" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="extreme" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Extreme (10)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="elgato" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="elgato" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Elgato (234)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="emerson" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="emerson" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Emerson (45)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="emi" type="checkbox" value="" checked
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="emi" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> EMI (176)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="fugoo" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="fugoo" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Fugoo (49)
                            </label>
                        </div>
                        </div>

                        <div class="space-y-2">
                        <h5 class="text-lg font-medium uppercase text-black dark:text-white">F</h5>

                        <div class="flex items-center">
                            <input id="fujitsu" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="fujitsu" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Fujitsu (97)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="fitbit" type="checkbox" value="" checked
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="fitbit" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Fitbit (56)
                            </label>
                        </div>

                        <div class="flex items-center">
                            <input id="foxconn" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="foxconn" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Foxconn
                            (234) </label>
                        </div>

                        <div class="flex items-center">
                            <input id="floston" type="checkbox" value=""
                            class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="floston" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Floston (45)
                            </label>
                        </div>
                        </div>
                    </div>
                    </div>

                    <div class="space-y-4" id="advanced-filters" role="tabpanel" aria-labelledby="advanced-filters-tab">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                        <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="min-price" class="block text-sm font-medium text-gray-900 dark:text-white"> Min Price
                            </label>
                            <input id="min-price" type="range" min="0" max="7000" value="300" step="1"
                            class="h-2 w-full cursor-pointer appearance-none rounded-lg bg-gray-200 dark:bg-gray-700" />
                        </div>

                        <div>
                            <label for="max-price" class="block text-sm font-medium text-gray-900 dark:text-white"> Max Price
                            </label>
                            <input id="max-price" type="range" min="0" max="7000" value="3500" step="1"
                            class="h-2 w-full cursor-pointer appearance-none rounded-lg bg-gray-200 dark:bg-gray-700" />
                        </div>

                        <div class="col-span-2 flex items-center justify-between space-x-2">
                            <input type="number" id="min-price-input" value="300" min="0" max="7000"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 "
                            placeholder="" required />

                            <div class="shrink-0 text-sm font-medium dark:text-gray-300">to</div>

                            <input type="number" id="max-price-input" value="3500" min="0" max="7000"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"
                            placeholder="" required />
                        </div>
                        </div>

                        <div class="space-y-3">
                        <div>
                            <label for="min-delivery-time" class="block text-sm font-medium text-gray-900 dark:text-white"> Min
                            Delivery Time (Days) </label>

                            <input id="min-delivery-time" type="range" min="3" max="50" value="30" step="1"
                            class="h-2 w-full cursor-pointer appearance-none rounded-lg bg-gray-200 dark:bg-gray-700" />
                        </div>

                        <input type="number" id="min-delivery-time-input" value="30" min="3" max="50"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 "
                            placeholder="" required />
                        </div>
                    </div>

                    <div>
                        <h6 class="mb-2 text-sm font-medium text-black dark:text-white">Condition</h6>

                        <ul
                        class="flex w-full items-center rounded-lg border border-gray-200 bg-white text-sm font-medium text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                        <li class="w-full border-r border-gray-200 dark:border-gray-600">
                            <div class="flex items-center pl-3">
                            <input id="condition-all" type="radio" value="" name="list-radio" checked
                                class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-primary-600" />
                            <label for="condition-all"
                                class="ml-2 w-full py-3 text-sm font-medium text-gray-900 dark:text-gray-300"> All </label>
                            </div>
                        </li>
                        <li class="w-full border-r border-gray-200 dark:border-gray-600">
                            <div class="flex items-center pl-3">
                            <input id="condition-new" type="radio" value="" name="list-radio"
                                class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-primary-600" />
                            <label for="condition-new"
                                class="ml-2 w-full py-3 text-sm font-medium text-gray-900 dark:text-gray-300"> New </label>
                            </div>
                        </li>
                        <li class="w-full">
                            <div class="flex items-center pl-3">
                            <input id="condition-used" type="radio" value="" name="list-radio"
                                class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-500 dark:bg-gray-600 dark:ring-offset-gray-700 dark:focus:ring-primary-600" />
                            <label for="condition-used"
                                class="ml-2 w-full py-3 text-sm font-medium text-gray-900 dark:text-gray-300"> Used </label>
                            </div>
                        </li>
                        </ul>
                    </div>

                    <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                        <div>
                        <h6 class="mb-2 text-sm font-medium text-black dark:text-white">Colour</h6>
                        <div class="space-y-2">
                            <div class="flex items-center">
                            <input id="blue" type="checkbox" value=""
                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="blue"
                                class="ml-2 flex items-center text-sm font-medium text-gray-900 dark:text-gray-300">
                                <div class="mr-2 h-3.5 w-3.5 rounded-full bg-primary-600"></div>
                                Blue
                            </label>
                            </div>

                            <div class="flex items-center">
                            <input id="gray" type="checkbox" value=""
                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="gray"
                                class="ml-2 flex items-center text-sm font-medium text-gray-900 dark:text-gray-300">
                                <div class="mr-2 h-3.5 w-3.5 rounded-full bg-gray-400"></div>
                                Gray
                            </label>
                            </div>

                            <div class="flex items-center">
                            <input id="green" type="checkbox" value="" checked
                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="green"
                                class="ml-2 flex items-center text-sm font-medium text-gray-900 dark:text-gray-300">
                                <div class="mr-2 h-3.5 w-3.5 rounded-full bg-green-400"></div>
                                Green
                            </label>
                            </div>

                            <div class="flex items-center">
                            <input id="pink" type="checkbox" value=""
                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="pink"
                                class="ml-2 flex items-center text-sm font-medium text-gray-900 dark:text-gray-300">
                                <div class="mr-2 h-3.5 w-3.5 rounded-full bg-pink-400"></div>
                                Pink
                            </label>
                            </div>

                            <div class="flex items-center">
                            <input id="red" type="checkbox" value="" checked
                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="red"
                                class="ml-2 flex items-center text-sm font-medium text-gray-900 dark:text-gray-300">
                                <div class="mr-2 h-3.5 w-3.5 rounded-full bg-red-500"></div>
                                Red
                            </label>
                            </div>
                        </div>
                        </div>

                        <div>
                        <h6 class="mb-2 text-sm font-medium text-black dark:text-white">Rating</h6>
                        <div class="space-y-2">
                            <div class="flex items-center">
                            <input id="five-stars" type="radio" value="" name="rating"
                                class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                            <label for="five-stars" class="ml-2 flex items-center">
                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>First star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>Second star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>Third star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>Fourth star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>Fifth star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                            </label>
                            </div>

                            <div class="flex items-center">
                            <input id="four-stars" type="radio" value="" name="rating"
                                class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                            <label for="four-stars" class="ml-2 flex items-center">
                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>First star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>Second star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>Third star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>Fourth star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Fifth star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                            </label>
                            </div>

                            <div class="flex items-center">
                            <input id="three-stars" type="radio" value="" name="rating" checked
                                class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                            <label for="three-stars" class="ml-2 flex items-center">
                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>First star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>Second star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>Third star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Fourth star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Fifth star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                            </label>
                            </div>

                            <div class="flex items-center">
                            <input id="two-stars" type="radio" value="" name="rating"
                                class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                            <label for="two-stars" class="ml-2 flex items-center">
                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>First star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>Second star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Third star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Fourth star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Fifth star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                            </label>
                            </div>

                            <div class="flex items-center">
                            <input id="one-star" type="radio" value="" name="rating"
                                class="h-4 w-4 border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                            <label for="one-star" class="ml-2 flex items-center">
                                <svg aria-hidden="true" class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <title>First star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Second star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Third star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Fourth star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                                <svg aria-hidden="true" class="h-5 w-5 text-gray-300 dark:text-gray-500" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <title>Fifth star</title>
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                </path>
                                </svg>
                            </label>
                            </div>
                        </div>
                        </div>

                        <div>
                        <h6 class="mb-2 text-sm font-medium text-black dark:text-white">Weight</h6>

                        <div class="space-y-2">
                            <div class="flex items-center">
                            <input id="under-1-kg" type="checkbox" value=""
                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="under-1-kg" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Under 1
                                kg </label>
                            </div>

                            <div class="flex items-center">
                            <input id="1-1-5-kg" type="checkbox" value="" checked
                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="1-1-5-kg" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> 1-1,5 kg
                            </label>
                            </div>

                            <div class="flex items-center">
                            <input id="1-5-2-kg" type="checkbox" value=""
                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="1-5-2-kg" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> 1,5-2 kg
                            </label>
                            </div>

                            <div class="flex items-center">
                            <input id="2-5-3-kg" type="checkbox" value=""
                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="2-5-3-kg" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> 2,5-3 kg
                            </label>
                            </div>

                            <div class="flex items-center">
                            <input id="over-3-kg" type="checkbox" value=""
                                class="h-4 w-4 rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />

                            <label for="over-3-kg" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"> Over 3
                                kg </label>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div>
                        <h6 class="mb-2 text-sm font-medium text-black dark:text-white">Delivery type</h6>

                        <ul class="grid grid-cols-2 gap-4">
                        <li>
                            <input type="radio" id="delivery-usa" name="delivery" value="delivery-usa" class="peer hidden"
                            checked />
                            <label for="delivery-usa"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-600 peer-checked:border-primary-600 peer-checked:text-primary-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:peer-checked:text-primary-500 md:p-5">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">USA</div>
                                <div class="w-full">Delivery only for USA</div>
                            </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="delivery-europe" name="delivery" value="delivery-europe"
                            class="peer hidden" />
                            <label for="delivery-europe"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-600 peer-checked:border-primary-600 peer-checked:text-primary-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:peer-checked:text-primary-500 md:p-5">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Europe</div>
                                <div class="w-full">Delivery only for USA</div>
                            </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="delivery-asia" name="delivery" value="delivery-asia" class="peer hidden"
                            checked />
                            <label for="delivery-asia"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-600 peer-checked:border-primary-600 peer-checked:text-primary-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:peer-checked:text-primary-500 md:p-5">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Asia</div>
                                <div class="w-full">Delivery only for Asia</div>
                            </div>
                            </label>
                        </li>
                        <li>
                            <input type="radio" id="delivery-australia" name="delivery" value="delivery-australia"
                            class="peer hidden" />
                            <label for="delivery-australia"
                            class="inline-flex w-full cursor-pointer items-center justify-between rounded-lg border border-gray-200 bg-white p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-600 peer-checked:border-primary-600 peer-checked:text-primary-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300 dark:peer-checked:text-primary-500 md:p-5">
                            <div class="block">
                                <div class="w-full text-lg font-semibold">Australia</div>
                                <div class="w-full">Delivery only for Australia</div>
                            </div>
                            </label>
                        </li>
                        </ul>
                    </div>
                    </div>
                </div>

                <!-- Modal footer -->
                <div class="flex items-center space-x-4 rounded-b p-4 dark:border-gray-600 md:p-5">
                    <button type="submit"
                    class="rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-700 dark:hover:bg-primary-800 dark:focus:ring-primary-800">Show
                    50 results</button>
                    <button type="reset"
                    class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Reset</button>
                </div>
                </div>
            </div>
        </form>
    </section>

    <section class="bg-white px-4 py-10 antialiased dark:bg-gray-900">
        <div class="mx-auto grid max-w-screen-xl rounded-lg bg-gray-50 p-4 dark:bg-gray-800 md:p-8 lg:grid-cols-12 lg:gap-8 lg:p-16 xl:gap-16">
            <div class="lg:col-span-5 lg:mt-0">
                <a href="#">
                    <img class="mb-4 h-56 w-56 dark:hidden sm:h-96 sm:w-96 md:h-full md:w-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-components.svg" alt="peripherals" />
                    <img class="mb-4 hidden dark:block md:h-full" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-components-dark.svg" alt="peripherals" />
                </a>
            </div>
            <div class="me-auto place-self-center lg:col-span-7">
                <h1 class="mb-3 text-2xl font-bold leading-tight tracking-tight text-gray-900 dark:text-white md:text-4xl">
                Save $500 today on your purchase <br />
                of a new iMac computer.
                </h1>

                <p class="mb-6 text-gray-500 dark:text-gray-400">Reserve your new Apple iMac 27” today and enjoy exclusive savings with qualified activation. Pre-order now to secure your discount.</p>

                <a href="#" class="inline-flex items-center justify-center rounded-lg bg-primary-700 px-5 py-3 text-center text-base font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:focus:ring-primary-900"> Pre-order now </a>
            </div>
        </div>
    </section>

    <footer class="bg-gray-200 antialiased dark:bg-gray-800">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
          <div class="border-b border-gray-100 py-6 dark:border-gray-700 md:py-8 lg:py-16">
            <div class="items-start gap-6 md:gap-8 lg:flex 2xl:gap-24">
              <div class="grid min-w-0 flex-1 grid-cols-2 gap-6 md:gap-8 xl:grid-cols-3">
                <div>
                  <h6 class="mb-4 text-sm font-semibold uppercase text-gray-900 dark:text-white">Company</h6>
                  <ul class="space-y-3">
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"> About </a>
                    </li>
      
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"> Premium </a>
                    </li>
      
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"> Blog </a>
                    </li>
      
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"> Affiliate Program </a>
                    </li>
      
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white"> Get Coupon </a>
                    </li>
                  </ul>
                </div>
      
                <div>
                  <h6 class="mb-4 text-sm font-semibold uppercase text-gray-900 dark:text-white">Order & Purchases</h6>
                  <ul class="space-y-3">
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Order Status</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Track Your Order</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Purchase History</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Returns & Refunds</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Payment Methods</a>
                    </li>
                  </ul>
                </div>
      
                <div>
                  <h6 class="mb-4 text-sm font-semibold uppercase text-gray-900 dark:text-white">Support & Services</h6>
                  <ul class="space-y-3">
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Contact Support</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">FAQs</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Service Centers</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Warranty Information</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Product Manuals</a>
                    </li>
                  </ul>
                </div>
      
                <div>
                  <h6 class="mb-4 text-sm font-semibold uppercase text-gray-900 dark:text-white">Partnerships</h6>
                  <ul class="space-y-3">
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Partner With Us</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Become a Supplier</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Affiliate Program</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Collaboration Opportunities</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Sponsorship Requests</a>
                    </li>
                  </ul>
                </div>
      
                <div>
                  <h6 class="mb-4 text-sm font-semibold uppercase text-gray-900 dark:text-white">Payment Options</h6>
                  <ul class="space-y-3">
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Credit & Debit Cards</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">PayPal</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Bank Transfers</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Installment Plans</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Gift Cards</a>
                    </li>
                  </ul>
                </div>
      
                <div>
                  <h6 class="mb-4 text-sm font-semibold uppercase text-gray-900 dark:text-white">Rewards</h6>
                  <ul class="space-y-3">
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Reward Points</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Referral Program</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">VIP Membership</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Exclusive Offers</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Redeem Rewards</a>
                    </li>
                  </ul>
                </div>
      
                <div>
                  <h6 class="mb-4 text-sm font-semibold uppercase text-gray-900 dark:text-white">Trade Assurance</h6>
                  <ul class="space-y-3">
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">What is Trade Assurance?</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">How It Works</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Buyer Protection</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Seller Guarantee</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">FAQs</a>
                    </li>
                  </ul>
                </div>
      
                <div>
                  <h6 class="mb-4 text-sm font-semibold uppercase text-gray-900 dark:text-white">Sell on Flowbite</h6>
                  <ul class="space-y-3">
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Seller Registration</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">How to Sell</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Seller Policies</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Seller Resources</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Seller Support</a>
                    </li>
                  </ul>
                </div>
      
                <div>
                  <h6 class="mb-4 text-sm font-semibold uppercase text-gray-900 dark:text-white">Get Support</h6>
                  <ul class="space-y-3">
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Contact Us</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Help Center</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Community Forums</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Technical Support</a>
                    </li>
                    <li>
                      <a href="#" title="" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">Live Chat</a>
                    </li>
                  </ul>
                </div>
              </div>
      
              <div class="mt-6 w-full md:mt-8 lg:mt-0 lg:max-w-lg">
                <div class="space-y-5 rounded-lg bg-gray-100 p-6 dark:bg-gray-700 shadow-lg">
                    <a href="#" title="" class="text-base font-medium text-primary-700 underline hover:no-underline dark:text-primary-500"> Sign In or Create Account </a>

                    <hr class="border-gray-200 dark:border-gray-600" />

                    <form action="#">
                        <div class="items-end space-y-4 sm:flex sm:space-y-0">
                            <div class="relative mr-3 w-full sm:w-96 lg:w-full">
                                <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-gray-300"> Get the latest deals and more. </label>
                                <input class="block w-full rounded-lg border border-gray-300 bg-white p-3 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-500 dark:bg-gray-600 dark:text-white dark:placeholder-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:w-96 lg:w-full" placeholder="Enter your email address" type="email" id="email" required="" />
                            </div>
                            <div>
                                <button type="submit" class="w-full cursor-pointer rounded-lg bg-primary-700 px-5 py-3 text-center text-sm font-medium text-white hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Subscribe</button>
                            </div>
                        </div>
                    </form>

                    <hr class="border-gray-200 dark:border-gray-600" />

                    <div>
                        <p class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Trade on the go with <a href="#" title="" class="underline hover:no-underline">Flowbite App</a></p>
        
                        <div class="gap-4 space-y-4 sm:flex sm:space-y-0">
                        <a href="#" class="inline-flex w-full items-center justify-center rounded-lg bg-gray-800 px-4 py-2.5 text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-800 sm:w-auto">
                            <svg class="mr-3 h-7 w-7" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="google-play" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M325.3 234.3L104.6 13l280.8 161.2-60.1 60.1zM47 0C34 6.8 25.3 19.2 25.3 35.3v441.3c0 16.1 8.7 28.5 21.7 35.3l256.6-256L47 0zm425.2 225.6l-58.9-34.1-65.7 64.5 65.7 64.5 60.1-34.1c18-14.3 18-46.5-1.2-60.8zM104.6 499l280.8-161.2-60.1-60.1L104.6 499z"></path>
                            </svg>
                            <div class="text-left">
                            <div class="mb-1 text-xs">Download on the</div>
                            <div class="-mt-1 font-sans text-sm font-semibold">Google Play</div>
                            </div>
                        </a>
        
                        <a href="#" class="inline-flex w-full items-center justify-center rounded-lg bg-gray-800 px-4 py-2.5 text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-800 sm:w-auto">
                            <svg class="mr-3 h-7 w-7" aria-hidden="true" focusable="false" data-prefix="fab" data-icon="apple" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                            <path
                                fill="currentColor"
                                d="M318.7 268.7c-.2-36.7 16.4-64.4 50-84.8-18.8-26.9-47.2-41.7-84.7-44.6-35.5-2.8-74.3 20.7-88.5 20.7-15 0-49.4-19.7-76.4-19.7C63.3 141.2 4 184.8 4 273.5q0 39.3 14.4 81.2c12.8 36.7 59 126.7 107.2 125.2 25.2-.6 43-17.9 75.8-17.9 31.8 0 48.3 17.9 76.4 17.9 48.6-.7 90.4-82.5 102.6-119.3-65.2-30.7-61.7-90-61.7-91.9zm-56.6-164.2c27.3-32.4 24.8-61.9 24-72.5-24.1 1.4-52 16.4-67.9 34.9-17.5 19.8-27.8 44.3-25.6 71.9 26.1 2 49.9-11.4 69.5-34.3z"
                            ></path>
                            </svg>
                            <div class="text-left">
                            <div class="mb-1 text-xs">Download on the</div>
                            <div class="-mt-1 font-sans text-sm font-semibold">Mac App Store</div>
                            </div>
                        </a>
                        </div>
                    </div>

                    <hr class="border-gray-200 dark:border-gray-600" />

                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                        </a>
        
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                            fill-rule="evenodd"
                            d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                            clip-rule="evenodd"
                            />
                        </svg>
                        </a>
        
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                        </a>
        
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                            fill-rule="evenodd"
                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                            clip-rule="evenodd"
                            />
                        </svg>
                        </a>
        
                        <a href="#" class="text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                            fill-rule="evenodd"
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10c5.51 0 10-4.48 10-10S17.51 2 12 2zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.416 25.416 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM12 3.475c2.17 0 4.154.813 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.687 8.687 0 0112 3.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM3.453 12.01v-.26c.37.01 4.512.065 8.775-1.215.25.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM12 20.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.659-6.084 2.679-.423 5.022.271 5.314.369a8.468 8.468 0 01-3.655 5.715z"
                            clip-rule="evenodd"
                            />
                        </svg>
                        </a>
                    </div>
                </div>
              </div>
            </div>
          </div>
      
          <div class="py-6 md:py-8">
            <div class="gap-4 space-y-5 xl:flex xl:items-center xl:justify-between xl:space-y-0">
              <a href="#" title="" class="block">
                <img class="block h-8 w-auto dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/logo-full.svg" alt="" />
                <img class="hidden h-8 w-auto dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/logo-full-dark.svg" alt="" />
              </a>
      
              <ul class="flex flex-wrap items-center gap-4 text-sm text-gray-900 dark:text-white xl:justify-center">
                <li><a href="#" title="" class="font-medium hover:underline"> Flowbite Express </a></li>
                <li><a href="#" title="" class="font-medium hover:underline"> Legal Notice </a></li>
                <li><a href="#" title="" class="font-medium hover:underline"> Product Listing Policy </a></li>
                <li><a href="#" title="" class="font-medium hover:underline"> Terms of Use </a></li>
              </ul>
      
              <p class="text-sm text-gray-500 dark:text-gray-400">© 2024 <a href="#" class="hover:underline">Flowbite</a>, Inc. All rights reserved.</p>
            </div>
          </div>
        </div>
    </footer>
</x-app-layout>