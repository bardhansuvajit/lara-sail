@php
    $sidebarItems = getSidebarItems($companyDomain);
@endphp

<aside class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700 block" aria-label="Sidenav" id="drawer-navigation">
    <div class="overflow-y-auto overflow-x-hidden py-2 px-3 bg-white dark:bg-gray-800" style="height: calc(100vh - 60px);">
        <ul class="space-y-2">
            @foreach($sidebarItems as $item)
                @if(canAccess($item['permission'] ?? null))
                    @if($item['type'] === 'single')
                        <li>
                            <a class="flex items-center p-2 font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                @if(isRouteActive($item['route'])) bg-primary-200 dark:bg-gray-600 @endif"
                                href="{{ generateRouteUrl($item) }}">
                                <div class="flex-shrink-0 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <div class="w-4 h-4">
                                        <x-admin.panel-sidebar-icon :name="$item['icon']" />
                                    </div>
                                </div>
                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __($item['title']) }}</span>
                            </a>
                        </li>
                    @elseif($item['type'] === 'dropdown')
                        <li class="sidebar-dropdowns" x-data="{ expanded: @if(isDropdownActive($item['children'])) true @else false @endif }">
                            <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 cursor-pointer 
                                @if(isDropdownActive($item['children'])) bg-primary-200 dark:bg-gray-600 @endif"
                                @click="expanded = ! expanded">
                                <div class="flex-shrink-0 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                    <div class="w-4 h-4">
                                        <x-admin.panel-sidebar-icon :name="$item['icon']" />
                                    </div>
                                </div>
                                <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __($item['title']) }}</span>
                                <svg x-show="!expanded" aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                                <svg x-show="expanded" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 -960 960 960" fill="currentColor">
                                    <path d="M480-520.35 327.83-368.17Q315.15-355.5 296-355.5t-31.83-12.67Q251.5-380.85 251.5-400t12.67-31.83l183.76-183.76q13.68-13.67 32.07-13.67t32.07 13.67l183.76 183.76Q708.5-419.15 708.5-400t-12.67 31.83Q683.15-355.5 664-355.5t-31.83-12.67L480-520.35Z"/>
                                </svg>
                            </a>
                            <div x-show="expanded" x-collapse>
                                <ul class="ml-6 my-3 space-y-2">
                                    @foreach($item['children'] as $child)
                                        @if(canAccess($child['permission'] ?? null))
                                            <li>
                                                <a class="flex items-center p-2 text-base font-medium text-gray-900 rounded dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 
                                                    @if(isRouteActive($child['route'])) bg-primary-200 dark:bg-gray-600 @endif"
                                                    href="{{ generateRouteUrl($child) }}">
                                                    <div class="flex-shrink-0 w-4 h-4 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white">
                                                        <x-admin.panel-sidebar-icon :name="$child['icon'] ?? 'default'" />
                                                    </div>
                                                    <span class="flex-1 whitespace-nowrap ml-6 text-xs">{{ __($child['title']) }}</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </li>
                    @endif
                @endif
            @endforeach
        </ul>
    </div>
</aside>
