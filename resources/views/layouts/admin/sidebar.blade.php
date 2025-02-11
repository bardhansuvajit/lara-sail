<aside class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700 block" aria-label="Sidenav" id="drawer-navigation">
    <div class="overflow-y-auto py-5 px-3 bg-white dark:bg-gray-800" style="height: calc(100vh - 110px);">

        <ul class="space-y-2">
            <li>
                <a class="flex items-center p-2 font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group
                    @if(request()->routeIs('admin.dashboard.index')) bg-primary-200 dark:bg-gray-600 @endif"
                    href="{{ route('admin.dashboard.index') }}"
                >
                    <div class="flex-shrink-0 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                        <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                    </div>

                    <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Dashboard') }}</span>
                </a>
            </li>

            <li>
                <a class="flex items-center p-2 font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group
                    @if(request()->routeIs('admin.user.index')) bg-primary-200 dark:bg-gray-600 @endif"
                    href="{{ route('admin.user.index') }}"
                >
                    <div class="flex-shrink-0 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z"/></svg>
                    </div>

                    <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Users') }}</span>
                </a>
            </li>

            <li x-data="{ expanded: @if(request()->is('admin/product*')) true @else false @endif }">
                <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group
                    @if(request()->is('admin/product*')) bg-primary-200 dark:bg-gray-600 @endif "
                    @click="expanded = ! expanded" 
                >
                    <div class="flex-shrink-0 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 -960 960 960" fill="currentColor"><path d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h440q17 0 28.5 11.5T760-320q0 17-11.5 28.5T720-280H280q-45 0-68-39.5t-2-78.5l54-98-144-304H80q-17 0-28.5-11.5T40-840q0-17 11.5-28.5T80-880h65q11 0 21 6t15 17l27 57Zm134 280h280-280Z"/></svg>
                    </div>

                    <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Products') }}</span>

                    <svg x-show="!expanded" aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>

                    <svg x-show="expanded" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-520.35 327.83-368.17Q315.15-355.5 296-355.5t-31.83-12.67Q251.5-380.85 251.5-400t12.67-31.83l183.76-183.76q13.68-13.67 32.07-13.67t32.07 13.67l183.76 183.76Q708.5-419.15 708.5-400t-12.67 31.83Q683.15-355.5 664-355.5t-31.83-12.67L480-520.35Z"/></svg>
                </a>

                <div x-show="expanded" x-collapse>
                    <ul class="ml-6 my-3 space-y-2">
                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group
                                @if(request()->is('admin/product/listing*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.product.listing.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-80q-33 0-56.5-23.5T120-160v-480q0-33 23.5-56.5T200-720h80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720h80q33 0 56.5 23.5T840-640v480q0 33-23.5 56.5T760-80H200Zm0-80h560v-480H200v480Zm160-560h240q0-50-35-85t-85-35q-50 0-85 35t-35 85ZM200-160v-480 480Zm279-240q74 0 134-49t59-110q0-17-11-29t-28-12q-14 0-25 9t-16 27q-11 38-43 61t-70 23q-38 0-70.5-23T366-564q-5-19-15-27.5t-24-8.5q-17 0-28.5 12T287-559q0 61 59 110t133 49Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Listings') }}</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group
                                @if(request()->is('admin/product/category*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.product.category.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m297-581 149-243q6-10 15-14.5t19-4.5q10 0 19 4.5t15 14.5l149 243q6 10 6 21t-5 20q-5 9-14 14.5t-21 5.5H331q-12 0-21-5.5T296-540q-5-9-5-20t6-21ZM700-80q-75 0-127.5-52.5T520-260q0-75 52.5-127.5T700-440q75 0 127.5 52.5T880-260q0 75-52.5 127.5T700-80Zm-580-60v-240q0-17 11.5-28.5T160-420h240q17 0 28.5 11.5T440-380v240q0 17-11.5 28.5T400-100H160q-17 0-28.5-11.5T120-140Zm580-20q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29Zm-500-20h160v-160H200v160Zm202-420h156l-78-126-78 126Zm78 0ZM360-340Zm340 80Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Category') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li x-data="{ expanded: @if(request()->is('admin/master*')) true @else false @endif }">
                <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group
                    @if(request()->is('admin/master*')) bg-primary-200 dark:bg-gray-600 @endif "
                    @click="expanded = ! expanded" 
                >
                    <div class="flex-shrink-0 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-120q-151 0-255.5-46.5T120-280v-400q0-66 105.5-113T480-840q149 0 254.5 47T840-680v400q0 67-104.5 113.5T480-120Zm0-479q89 0 179-25.5T760-679q-11-29-100.5-55T480-760q-91 0-178.5 25.5T200-679q14 30 101.5 55T480-599Zm0 199q42 0 81-4t74.5-11.5q35.5-7.5 67-18.5t57.5-25v-120q-26 14-57.5 25t-67 18.5Q600-528 561-524t-81 4q-42 0-82-4t-75.5-11.5Q287-543 256-554t-56-25v120q25 14 56 25t66.5 18.5Q358-408 398-404t82 4Zm0 200q46 0 93.5-7t87.5-18.5q40-11.5 67-26t32-29.5v-98q-26 14-57.5 25t-67 18.5Q600-328 561-324t-81 4q-42 0-82-4t-75.5-11.5Q287-343 256-354t-56-25v99q5 15 31.5 29t66.5 25.5q40 11.5 88 18.5t94 7Z"/></svg>
                    </div>

                    <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Master') }}</span>

                    <svg x-show="!expanded" aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>

                    <svg x-show="expanded" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-520.35 327.83-368.17Q315.15-355.5 296-355.5t-31.83-12.67Q251.5-380.85 251.5-400t12.67-31.83l183.76-183.76q13.68-13.67 32.07-13.67t32.07 13.67l183.76 183.76Q708.5-419.15 708.5-400t-12.67 31.83Q683.15-355.5 664-355.5t-31.83-12.67L480-520.35Z"/></svg>
                </a>

                <div x-show="expanded" x-collapse>
                    <ul class="ml-6 my-3 space-y-2">
                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group
                                @if(request()->is('admin/master/country*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.master.country.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120v-680h360l16 80h224v400H520l-16-80H280v280h-80Zm300-440Zm86 160h134v-240H510l-16-80H280v240h290l16 80Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Country') }}</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li x-data="{ expanded: @if(request()->is('admin/developer*')) true @else false @endif }">
                <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group
                    @if(request()->is('admin/developer*')) bg-primary-200 dark:bg-gray-600 @endif "
                    @click="expanded = ! expanded" 
                >
                    <div class="flex-shrink-0 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m193-479 155 155q11 11 11 28t-11 28q-11 11-28 11t-28-11L108-452q-6-6-8.5-13T97-480q0-8 2.5-15t8.5-13l184-184q12-12 28.5-12t28.5 12q12 12 12 28.5T349-635L193-479Zm574-2L612-636q-11-11-11-28t11-28q11-11 28-11t28 11l184 184q6 6 8.5 13t2.5 15q0 8-2.5 15t-8.5 13L668-268q-12 12-28 11.5T612-269q-12-12-12-28.5t12-28.5l155-155Z"/></svg>
                    </div>

                    <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Developer options') }}</span>

                    <svg x-show="!expanded" aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>

                    <svg x-show="expanded" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-520.35 327.83-368.17Q315.15-355.5 296-355.5t-31.83-12.67Q251.5-380.85 251.5-400t12.67-31.83l183.76-183.76q13.68-13.67 32.07-13.67t32.07 13.67l183.76 183.76Q708.5-419.15 708.5-400t-12.67 31.83Q683.15-355.5 664-355.5t-31.83-12.67L480-520.35Z"/></svg>
                </a>

                <div x-show="expanded" x-collapse>
                    <ul class="ml-6 my-3 space-y-2">
                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group
                                @if(request()->is('admin/developer/trash*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.developer.trash.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 -960 960 960" fill="currentColor"><path d="m389-626 68-113-59-98q-12-20-34.5-20T329-837l-77 129q-8 14-4.5 30.5T265-653l69 41q14 8 30.5 4t24.5-18Zm366 306-68-113q-9-14-4.5-30.5T701-488l70-40q14-8 30-4t24 18l44 73q11 17 12 38t-9 39q-10 20-29.5 32T800-320h-45ZM606-74l-98-98q-12-12-12-28t12-28l98-98q10-10 22-5t12 19v32h190l-58 116q-11 20-30 32t-42 12h-60v32q0 14-12 19t-22-5Zm-353-46q-20 0-36.5-10.5T192-158q-8-16-7.5-33.5T194-224l34-56h132q17 0 28.5 11.5T400-240v80q0 17-11.5 28.5T360-120H253Zm-99-114L89-364q-9-18-8.5-38.5T92-441l16-27-27-16q-11-7-9-20.5T87-521l133-33q16-4 30.5 4.5T269-525l33 134q3 13-8 21t-22 1l-27-17-91 152Zm501-352-133-33q-13-3-14.5-16.5T517-656l27-16-125-208h141q21 0 39.5 10.5T629-841l52 87 26-16q11-7 22 1t8 21l-33 133q-4 16-18.5 24.5T655-586Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Trash') }}</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

        </ul>

    </div>
</aside>