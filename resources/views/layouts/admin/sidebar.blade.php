<aside class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700 block" aria-label="Sidenav" id="drawer-navigation">
    {{-- <div class="overflow-y-auto py-5 px-3 bg-white dark:bg-gray-800" style="height: calc(100vh - 110px);"> --}}
    <div class="overflow-y-auto overflow-x-hidden py-2 px-3 bg-white dark:bg-gray-800" style="height: calc(100vh - 110px);">

        <ul class="space-y-2">
            <li>
                <a class="flex items-center p-2 font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
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
                <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 cursor-pointer 
                    @if(request()->is('admin/user*')) bg-primary-200 dark:bg-gray-600 @endif "
                    href="{{ route('admin.user.index') }}"
                >
                    <div class="flex-shrink-0 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M40-160v-112q0-34 17.5-62.5T104-378q62-31 126-46.5T360-440q66 0 130 15.5T616-378q29 15 46.5 43.5T680-272v112H40Zm720 0v-120q0-44-24.5-84.5T666-434q51 6 96 20.5t84 35.5q36 20 55 44.5t19 53.5v120H760ZM360-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm400-160q0 66-47 113t-113 47q-11 0-28-2.5t-28-5.5q27-32 41.5-71t14.5-81q0-42-14.5-81T544-792q14-5 28-6.5t28-1.5q66 0 113 47t47 113ZM120-240h480v-32q0-11-5.5-20T580-306q-54-27-109-40.5T360-360q-56 0-111 13.5T140-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T440-640q0-33-23.5-56.5T360-720q-33 0-56.5 23.5T280-640q0 33 23.5 56.5T360-560Zm0 320Zm0-400Z"/></svg>
                    </div>

                    <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Users') }}</span>
                </a>
            </li>

            <li>
                <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 cursor-pointer 
                    @if(request()->is('admin/order*')) bg-primary-200 dark:bg-gray-600 @endif "
                    href="{{ route('admin.order.index') }}"
                >
                    <div class="flex-shrink-0 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-80q-33 0-56.5-23.5T160-160v-480q0-33 23.5-56.5T240-720h80q0-66 47-113t113-47q66 0 113 47t47 113h80q33 0 56.5 23.5T800-640v480q0 33-23.5 56.5T720-80H240Zm0-80h480v-480h-80v80q0 17-11.5 28.5T600-520q-17 0-28.5-11.5T560-560v-80H400v80q0 17-11.5 28.5T360-520q-17 0-28.5-11.5T320-560v-80h-80v480Zm160-560h160q0-33-23.5-56.5T480-800q-33 0-56.5 23.5T400-720ZM240-160v-480 480Z"/></svg>
                    </div>

                    <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Orders') }}</span>
                </a>
            </li>

            <li class="sidebar-dropdowns" x-data="{ expanded: @if(request()->is('admin/product*')) true @else false @endif }">
                <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 cursor-pointer 
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
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
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
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/product/category*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.product.category.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m297-581 149-243q6-10 15-14.5t19-4.5q10 0 19 4.5t15 14.5l149 243q6 10 6 21t-5 20q-5 9-14 14.5t-21 5.5H331q-12 0-21-5.5T296-540q-5-9-5-20t6-21ZM700-80q-75 0-127.5-52.5T520-260q0-75 52.5-127.5T700-440q75 0 127.5 52.5T880-260q0 75-52.5 127.5T700-80Zm-580-60v-240q0-17 11.5-28.5T160-420h240q17 0 28.5 11.5T440-380v240q0 17-11.5 28.5T400-100H160q-17 0-28.5-11.5T120-140Zm580-20q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29Zm-500-20h160v-160H200v160Zm202-420h156l-78-126-78 126Zm78 0ZM360-340Zm340 80Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Category') }}</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/product/collection*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.product.collection.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m195-588 125-69v237q-21 2-41 6.5T240-401v-120l-41 22q-14 8-30 3.5T145-514L65-653q-8-14-3.5-30.5T80-708l199-115q12-7 25-12t27-5q14 0 24 8.5t15 21.5q14 38 36.5 64t73.5 26q51 0 73.5-26t36.5-64q5-13 15.5-21.5T630-840q14 0 26.5 5t24.5 12l199 115q14 8 18 24t-4 30l-79 140q-8 14-24 18.5t-30-3.5l-41-22v192l-63 55q-4 3-8 5.5t-9 4.5v-393l125 69 40-70-153-89q-24 49-70.5 78T480-640q-55 0-101.5-29T308-747l-154 89 41 70Zm285-52ZM160-215q-11-13-9.5-29.5T165-272l56-48q23-20 52.5-30.5T335-361q32 0 61 10.5t52 30.5l116 99q12 10 28.5 15.5T626-200q18 0 33.5-5t27.5-16l56-48q13-11 29.5-10t27.5 14q11 13 9.5 29.5T795-208l-56 48q-23 20-52 30t-61 10q-32 0-61.5-10T512-160l-116-99q-12-10-27.5-15.5T335-280q-17 0-33.5 5.5T273-259l-57 48q-13 11-29 10t-27-14Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Collection') }}</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/product/feature*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.product.feature.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-440h360v-80H240v80Zm0-120h360v-80H240v80Zm-80 400q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm0-80h640v-480H160v480Zm0 0v-480 480Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Feature') }}</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/product/review*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.product.review.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-400h122l200-200q9-9 13.5-20.5T580-643q0-11-5-21.5T562-684l-36-38q-9-9-20-13.5t-23-4.5q-11 0-22.5 4.5T440-722L240-522v122Zm280-243-37-37 37 37ZM300-460v-38l101-101 20 18 18 20-101 101h-38Zm121-121 18 20-38-38 20 18Zm26 181h273v-80H527l-80 80ZM80-80v-720q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H240L80-80Zm126-240h594v-480H160v525l46-45Zm-46 0v-480 480Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Review') }}</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/product/variation*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.product.variation.attribute.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M680-120q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm0-80q33 0 56.5-23.5T760-280q0-33-23.5-56.5T680-360q-33 0-56.5 23.5T600-280q0 33 23.5 56.5T680-200Zm-400-40q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm0-80q33 0 56.5-23.5T360-400q0-33-23.5-56.5T280-480q-33 0-56.5 23.5T200-400q0 33 23.5 56.5T280-320Zm160-240q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm0-80q33 0 56.5-23.5T520-720q0-33-23.5-56.5T440-800q-33 0-56.5 23.5T360-720q0 33 23.5 56.5T440-640Zm240 360ZM280-400Zm160-320Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Variation') }}</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/product/coupon*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.product.coupon.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M160-280v80h640v-80H160Zm0-440h88q-5-9-6.5-19t-1.5-21q0-50 35-85t85-35q30 0 55.5 15.5T460-826l20 26 20-26q18-24 44-39t56-15q50 0 85 35t35 85q0 11-1.5 21t-6.5 19h88q33 0 56.5 23.5T880-640v440q0 33-23.5 56.5T800-120H160q-33 0-56.5-23.5T80-200v-440q0-33 23.5-56.5T160-720Zm0 320h640v-240H596l84 114-64 46-136-184-136 184-64-46 82-114H160v240Zm200-320q17 0 28.5-11.5T400-760q0-17-11.5-28.5T360-800q-17 0-28.5 11.5T320-760q0 17 11.5 28.5T360-720Zm240 0q17 0 28.5-11.5T640-760q0-17-11.5-28.5T600-800q-17 0-28.5 11.5T560-760q0 17 11.5 28.5T600-720Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Coupon') }}</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="sidebar-dropdowns" x-data="{ expanded: @if(request()->is('admin/master*')) true @else false @endif }">
                <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 cursor-pointer 
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
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/master/country*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.master.country.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120v-680h360l16 80h224v400H520l-16-80H280v280h-80Zm300-440Zm86 160h134v-240H510l-16-80H280v240h290l16 80Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Country') }}</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/master/state*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.master.state.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120v-680h360l16 80h224v400H520l-16-80H280v280h-80Zm300-440Zm86 160h134v-240H510l-16-80H280v240h290l16 80Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('State') }}</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/master/city*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.master.city.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120v-680h360l16 80h224v400H520l-16-80H280v280h-80Zm300-440Zm86 160h134v-240H510l-16-80H280v240h290l16 80Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('City') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="sidebar-dropdowns" x-data="{ expanded: @if(request()->is('admin/website*')) true @else false @endif }">
                <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 cursor-pointer 
                    @if(request()->is('admin/website*')) bg-primary-200 dark:bg-gray-600 @endif "
                    @click="expanded = ! expanded" 
                >
                    <div class="flex-shrink-0 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M838-65 720-183v89h-80v-226h226v80h-90l118 118-56 57ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 20-2 40t-6 40h-82q5-20 7.5-40t2.5-40q0-20-2.5-40t-7.5-40H654q3 20 4.5 40t1.5 40q0 20-1.5 40t-4.5 40h-80q3-20 4.5-40t1.5-40q0-20-1.5-40t-4.5-40H386q-3 20-4.5 40t-1.5 40q0 20 1.5 40t4.5 40h134v80H404q12 43 31 82.5t45 75.5q20 0 40-2.5t40-4.5v82q-20 2-40 4.5T480-80ZM170-400h136q-3-20-4.5-40t-1.5-40q0-20 1.5-40t4.5-40H170q-5 20-7.5 40t-2.5 40q0 20 2.5 40t7.5 40Zm34-240h118q9-37 22.5-72.5T376-782q-55 18-99 54.5T204-640Zm172 462q-18-34-31.5-69.5T322-320H204q29 51 73 87.5t99 54.5Zm28-462h152q-12-43-31-82.5T480-798q-26 36-45 75.5T404-640Zm234 0h118q-29-51-73-87.5T584-782q18 34 31.5 69.5T638-640Z"/></svg>
                    </div>

                    <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Website') }}</span>

                    <svg x-show="!expanded" aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>

                    <svg x-show="expanded" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-520.35 327.83-368.17Q315.15-355.5 296-355.5t-31.83-12.67Q251.5-380.85 251.5-400t12.67-31.83l183.76-183.76q13.68-13.67 32.07-13.67t32.07 13.67l183.76 183.76Q708.5-419.15 708.5-400t-12.67 31.83Q683.15-355.5 664-355.5t-31.83-12.67L480-520.35Z"/></svg>
                </a>

                <div x-show="expanded" x-collapse>
                    <ul class="ml-6 my-3 space-y-2">
                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/website/banner*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.website.banner.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm0-80h640v-480H160v480Zm80-80h480L570-520 450-360l-90-120-120 160Zm-80 80v-480 480Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Banner') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/website/advertisement*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.website.advertisement.index', ['page' => 'homepage']) }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentcolor"><path d="M468-240q-96-5-162-74t-66-166q0-100 70-170t170-70q97 0 166 66t74 162l-84-25q-13-54-56-88.5T480-640q-66 0-113 47t-47 113q0 57 34.5 100t88.5 56l25 84Zm48 158q-9 2-18 2h-18q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480v18q0 9-2 18l-78-24v-12q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93h12l24 78Zm305 22L650-231 600-80 480-480l400 120-151 50 171 171-79 79Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Advertisement') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/website/newsletter/email*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.website.newsletter.email.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480v58q0 59-40.5 100.5T740-280q-35 0-66-15t-52-43q-29 29-65.5 43.5T480-280q-83 0-141.5-58.5T280-480q0-83 58.5-141.5T480-680q83 0 141.5 58.5T680-480v58q0 26 17 44t43 18q26 0 43-18t17-44v-58q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93h200v80H480Zm0-280q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Newsletter Email') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/website/content/page*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.website.content.page.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M280-280h280v-80H280v80Zm0-160h400v-80H280v80Zm0-160h400v-80H280v80Zm-80 480q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Content Page') }}</span>
                            </a>
                        </li>
                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/website/social-media*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.website.social.media.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M720-440v-80h160v80H720Zm48 280-128-96 48-64 128 96-48 64Zm-80-480-48-64 128-96 48 64-128 96ZM200-200v-160h-40q-33 0-56.5-23.5T80-440v-80q0-33 23.5-56.5T160-600h160l200-120v480L320-360h-40v160h-80Zm240-182v-196l-98 58H160v80h182l98 58Zm120 36v-268q27 24 43.5 58.5T620-480q0 41-16.5 75.5T560-346ZM300-480Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Social Media') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="sidebar-dropdowns" x-data="{ expanded: @if(request()->is('admin/developer*') || request()->is('admin/application/settings*')) true @else false @endif }">
                <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 cursor-pointer 
                    @if(request()->is('admin/developer*') || request()->is('admin/application/settings*')) bg-primary-200 dark:bg-gray-600 @endif "
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
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/developer/trash*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.developer.trash.index') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 -960 960 960" fill="currentColor"><path d="m389-626 68-113-59-98q-12-20-34.5-20T329-837l-77 129q-8 14-4.5 30.5T265-653l69 41q14 8 30.5 4t24.5-18Zm366 306-68-113q-9-14-4.5-30.5T701-488l70-40q14-8 30-4t24 18l44 73q11 17 12 38t-9 39q-10 20-29.5 32T800-320h-45ZM606-74l-98-98q-12-12-12-28t12-28l98-98q10-10 22-5t12 19v32h190l-58 116q-11 20-30 32t-42 12h-60v32q0 14-12 19t-22-5Zm-353-46q-20 0-36.5-10.5T192-158q-8-16-7.5-33.5T194-224l34-56h132q17 0 28.5 11.5T400-240v80q0 17-11.5 28.5T360-120H253Zm-99-114L89-364q-9-18-8.5-38.5T92-441l16-27-27-16q-11-7-9-20.5T87-521l133-33q16-4 30.5 4.5T269-525l33 134q3 13-8 21t-22 1l-27-17-91 152Zm501-352-133-33q-13-3-14.5-16.5T517-656l27-16-125-208h141q21 0 39.5 10.5T629-841l52 87 26-16q11-7 22 1t8 21l-33 133q-4 16-18.5 24.5T655-586Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Trash') }}</span>
                            </a>
                        </li>

                        <li>
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(request()->is('admin/application/settings*')) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ route('admin.application.settings.index', 'basic') }}"
                            >
                                <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 -960 960 960" fill="currentColor"><path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"/></svg>
                                </div>

                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __('Settings') }}</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

        </ul>

    </div>
</aside>