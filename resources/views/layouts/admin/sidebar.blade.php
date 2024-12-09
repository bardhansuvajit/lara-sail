<aside class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700 block" aria-label="Sidenav" id="drawer-navigation">
    <div class="overflow-y-auto py-5 px-3 bg-white dark:bg-gray-800" style="height: calc(100vh - 110px);">

        <ul class="space-y-2">
            <li>
                <a class="flex items-center p-2 font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group
                    @if(request()->routeIs('admin.dashboard.index')) bg-primary-200 dark:bg-gray-600 @endif"
                    href="{{ route('admin.dashboard.index') }}"
                >
                    <div class="flex-shrink-0 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                    </div>

                    <span class="flex-1 whitespace-nowrap ml-6 text-xs sm:text-sm">{{ __('Dashboard') }}</span>
                </a>
            </li>

            <li>
                <a class="flex items-center p-2 font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group
                    @if(request()->routeIs('admin.user.index')) bg-primary-200 dark:bg-gray-600 @endif"
                    href="{{ route('admin.user.index') }}"
                >
                    <div class="flex-shrink-0 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z"/></svg>
                    </div>

                    <span class="flex-1 whitespace-nowrap ml-6 text-xs sm:text-sm">{{ __('Users') }}</span>
                </a>
            </li>

            <li>
                <a class="flex items-center p-2 font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group
                    @if(request()->is('admin/product*')) bg-primary-200 dark:bg-gray-600 @endif"
                    href="{{ route('admin.product.index') }}"
                >
                    <div class="flex-shrink-0 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-80q-33 0-56.5-23.5T120-160v-480q0-33 23.5-56.5T200-720h80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720h80q33 0 56.5 23.5T840-640v480q0 33-23.5 56.5T760-80H200Zm0-80h560v-480H200v480Zm160-560h240q0-50-35-85t-85-35q-50 0-85 35t-35 85ZM200-160v-480 480Zm279-240q74 0 134-49t59-110q0-17-11-29t-28-12q-14 0-25 9t-16 27q-11 38-43 61t-70 23q-38 0-70.5-23T366-564q-5-19-15-27.5t-24-8.5q-17 0-28.5 12T287-559q0 61 59 110t133 49Z"/></svg>
                    </div>

                    <span class="flex-1 whitespace-nowrap ml-6 text-xs sm:text-sm">{{ __('Products') }}</span>
                </a>
            </li>

            <li x-data="{ expanded: true }">
                <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group
                    @if(request()->routeIs('admin.profile.index')) bg-primary-200 dark:bg-gray-600 @endif "
                    @click="expanded = ! expanded" 
                >
                    <div class="flex-shrink-0 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-120q-151 0-255.5-46.5T120-280v-400q0-66 105.5-113T480-840q149 0 254.5 47T840-680v400q0 67-104.5 113.5T480-120Zm0-479q89 0 179-25.5T760-679q-11-29-100.5-55T480-760q-91 0-178.5 25.5T200-679q14 30 101.5 55T480-599Zm0 199q42 0 81-4t74.5-11.5q35.5-7.5 67-18.5t57.5-25v-120q-26 14-57.5 25t-67 18.5Q600-528 561-524t-81 4q-42 0-82-4t-75.5-11.5Q287-543 256-554t-56-25v120q25 14 56 25t66.5 18.5Q358-408 398-404t82 4Zm0 200q46 0 93.5-7t87.5-18.5q40-11.5 67-26t32-29.5v-98q-26 14-57.5 25t-67 18.5Q600-328 561-324t-81 4q-42 0-82-4t-75.5-11.5Q287-343 256-354t-56-25v99q5 15 31.5 29t66.5 25.5q40 11.5 88 18.5t94 7Z"/></svg>
                    </div>

                    <span class="flex-1 whitespace-nowrap ml-6 text-xs sm:text-sm">{{ __('Master') }}</span>

                    <svg x-show="!expanded" aria-hidden="true" class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>

                    <svg x-show="expanded" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-520.35 327.83-368.17Q315.15-355.5 296-355.5t-31.83-12.67Q251.5-380.85 251.5-400t12.67-31.83l183.76-183.76q13.68-13.67 32.07-13.67t32.07 13.67l183.76 183.76Q708.5-419.15 708.5-400t-12.67 31.83Q683.15-355.5 664-355.5t-31.83-12.67L480-520.35Z"/></svg>
                </a>

                <div x-show="expanded" x-collapse>
                    <ul class="ml-6 my-3 space-y-2">
                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group
                                @if(request()->routeIs('admin.dashboard.index')) bg-primary-200 dark:bg-gray-600 @endif
                            ">
                                <div class="flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120v-680h360l16 80h224v400H520l-16-80H280v280h-80Zm300-440Zm86 160h134v-240H510l-16-80H280v240h290l16 80Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-sm">{{ __('Country') }}</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group
                                @if(request()->routeIs('admin.dashboard.index')) bg-primary-200 dark:bg-gray-600 @endif
                            ">
                                <div class="flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-sm">{{ __('State') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>

    </div>
</aside>