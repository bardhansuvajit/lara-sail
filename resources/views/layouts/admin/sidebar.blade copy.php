<aside class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700 block" aria-label="Sidenav" id="drawer-navigation">
    <div class="overflow-y-auto py-5 px-3 bg-white dark:bg-gray-800" style="height: calc(100vh - 110px);">
        <form action="#" method="GET" class="md:hidden mb-2">
            <label for="sidebar-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z">
                        </path>
                    </svg>
                </div>

                <input type="text" name="search" id="sidebar-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" />
            </div>
        </form>

        <ul class="space-y-2">
            <!-- link -->
            <x-admin.sidebar-link
                :href="route('admin.dashboard.index')" 
                :active="request()->routeIs('admin.dashboard.index')">

                @slot('icon')
                    <svg aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                @endslot

                {{ __('Dashboard') }}
            </x-admin.sidebar-link>

            <!-- collapse menu -->
            <x-admin.sidebar-link-collapse 
                title="master"
                :active="request()->is('admin/country*')">
                @slot('icon')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-120q-151 0-255.5-46.5T120-280v-400q0-66 105.5-113T480-840q149 0 254.5 47T840-680v400q0 67-104.5 113.5T480-120Zm0-479q89 0 179-25.5T760-679q-11-29-100.5-55T480-760q-91 0-178.5 25.5T200-679q14 30 101.5 55T480-599Zm0 199q42 0 81-4t74.5-11.5q35.5-7.5 67-18.5t57.5-25v-120q-26 14-57.5 25t-67 18.5Q600-528 561-524t-81 4q-42 0-82-4t-75.5-11.5Q287-543 256-554t-56-25v120q25 14 56 25t66.5 18.5Q358-408 398-404t82 4Zm0 200q46 0 93.5-7t87.5-18.5q40-11.5 67-26t32-29.5v-98q-26 14-57.5 25t-67 18.5Q600-328 561-324t-81 4q-42 0-82-4t-75.5-11.5Q287-343 256-354t-56-25v99q5 15 31.5 29t66.5 25.5q40 11.5 88 18.5t94 7Z"/></svg>
                @endslot

                {{ __('Master') }}

                @slot('menu')
                    <x-admin.sidebar-link
                        :href="route('admin.profile.index')" 
                        :active="request()->routeIs('admin.profile.index')">

                        @slot('icon')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M200-120v-680h360l16 80h224v400H520l-16-80H280v280h-80Zm300-440Zm86 160h134v-240H510l-16-80H280v240h290l16 80Z"/></svg>
                        @endslot

                        {{ __('Country') }}
                    </x-admin.sidebar-link>

                    <x-admin.sidebar-link
                        href="/" 
                        :active="request()->routeIs('admin.language.index')">

                        @slot('icon')
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M40-320v-320h80v320H40Zm120 0v-320h80l89 178-9 2v-180h80v320h-80l-89-178 9-2v180h-80Zm360 0v-240h-80v-80h240v80h-80v240h-80Zm200 0v-320h80v240h120v80H720Z"/></svg>
                        @endslot

                        {{ __('Language') }}
                    </x-admin.sidebar-link>
                @endslot
            </x-admin.sidebar-link-collapse>

            <!-- collapse menu -->
            <x-admin.sidebar-link-collapse 
                title="pages"
                :active="request()->is('admin/dashboard*')">
                @slot('icon')
                    <svg aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                @endslot

                {{ __('Pages') }}

                @slot('menu')
                <x-admin.sidebar-link
                    :href="route('admin.dashboard.index')" 
                    :active="request()->routeIs('admin.dashboard.index')">

                    @slot('icon')
                        <svg aria-hidden="true"  fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
                    @endslot

                    {{ __('Dashboard') }}
                </x-admin.sidebar-link>
                @endslot
            </x-admin.sidebar-link-collapse>

            <li>
                <button type="button" class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-sales" data-collapse-toggle="dropdown-sales">
                    <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"></path>
                    </svg>

                    <span class="flex-1 ml-6 text-left whitespace-nowrap text-xs sm:text-sm">Sales</span>

                    <div class="collapse-icon">
                        <svg aria-hidden="true" class="w-4 h-4 sm:w-5 sm:h-5 collapse-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </button>
                <ul id="dropdown-sales" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#" class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor"><path d="M363.07-71.87 346.59-202.5q-11.09-4.28-21.04-10.33-9.94-6.04-19.51-12.84l-121.39 51.19L67.48-377.39l104.91-79.44q-.76-6.04-.76-11.58v-23.18q0-5.54.76-11.58L67.48-582.61l117.17-202.43 121.87 50.95q9.57-6.8 19.65-12.73 10.09-5.92 20.42-10.2l16.48-131.11h233.86l16.48 131.11q11.09 4.28 21.04 10.2 9.94 5.93 19.51 12.73l121.39-50.95 117.17 202.43-105.15 79.44q.76 6.04.76 11.58V-480q0 6.04-.12 11.59-.12 5.54-1.64 11.58l105.15 79.44-117.41 202.91-120.63-51.19q-9.57 6.8-19.65 12.84-10.09 6.05-20.42 10.33L596.93-71.87H363.07Zm79.56-91h73.5l14.24-105.52q31.24-8 58.34-23.62 27.09-15.62 49.09-38.58l98.77 41 36.13-63.69-85.29-64.52q5-14.48 7.24-30.22 2.24-15.74 2.24-31.98 0-16.24-2.24-31.98-2.24-15.74-7.24-30.22l85.76-64.52-36.6-63.69-98.53 42q-22-23.72-49.09-39.58-27.1-15.86-58.58-23.62l-13-105.52h-73.98l-13.52 105.28q-31.72 7.76-58.94 23.62-27.21 15.86-49.45 38.82l-98.28-41-36.37 63.69 85.04 63.29q-5 15.47-7.24 30.83-2.24 15.36-2.24 32.6 0 16.24 2.24 31.72t7.24 30.95l-85.04 64.05 36.37 63.69 98.28-41.76q22.24 23.48 49.57 39.34 27.34 15.86 58.82 23.86l12.76 105.28ZM481.28-340q58 0 99-41t41-99q0-58-41-99t-99-41q-58.76 0-99.38 41t-40.62 99q0 58 40.62 99t99.38 41ZM480-480Z"/></svg>

                            <span class="ml-10 text-xs sm:text-sm">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor"><path d="M281.43-281.43h80v-397.14h-80v397.14Zm317.14-80h80v-317.14h-80v317.14ZM440-481.43h80v-197.14h-80v197.14ZM202.87-111.87q-37.78 0-64.39-26.61t-26.61-64.39v-554.26q0-37.78 26.61-64.39t64.39-26.61h554.26q37.78 0 64.39 26.61t26.61 64.39v554.26q0 37.78-26.61 64.39t-64.39 26.61H202.87Zm0-91h554.26v-554.26H202.87v554.26Zm0-554.26v554.26-554.26Z"/></svg>

                            <span class="ml-10 text-xs sm:text-sm">Kanban</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor"><path d="M202.87-71.87q-37.78 0-64.39-26.61t-26.61-64.39v-554.26q0-37.78 26.61-64.39t64.39-26.61H240v-80h85.5v80h309v-80H720v80h37.13q37.78 0 64.39 26.61t26.61 64.39v554.26q0 37.78-26.61 64.39t-64.39 26.61H202.87Zm0-91h554.26V-560H202.87v397.13Zm0-477.13h554.26v-77.13H202.87V-640Zm0 0v-77.13V-640ZM480-398.09q-17.81 0-29.86-12.05T438.09-440q0-17.81 12.05-29.86T480-481.91q17.81 0 29.86 12.05T521.91-440q0 17.81-12.05 29.86T480-398.09Zm-160 0q-17.81 0-29.86-12.05T278.09-440q0-17.81 12.05-29.86T320-481.91q17.81 0 29.86 12.05T361.91-440q0 17.81-12.05 29.86T320-398.09Zm320 0q-17.48 0-29.7-12.05-12.21-12.05-12.21-29.86t12.21-29.86q12.22-12.05 29.82-12.05t29.7 12.05q12.09 12.05 12.09 29.86t-12.05 29.86q-12.05 12.05-29.86 12.05Zm-160 160q-17.81 0-29.86-12.21-12.05-12.22-12.05-29.82t12.05-29.7q12.05-12.09 29.86-12.09t29.86 12.05q12.05 12.05 12.05 29.86 0 17.48-12.05 29.7-12.05 12.21-29.86 12.21Zm-160 0q-17.81 0-29.86-12.21-12.05-12.22-12.05-29.82t12.05-29.7q12.05-12.09 29.86-12.09t29.86 12.05q12.05 12.05 12.05 29.86 0 17.48-12.05 29.7-12.05 12.21-29.86 12.21Zm320 0q-17.48 0-29.7-12.21-12.21-12.22-12.21-29.82t12.21-29.7q12.22-12.09 29.82-12.09t29.7 12.05q12.09 12.05 12.09 29.86 0 17.48-12.05 29.7-12.05 12.21-29.86 12.21Z"/></svg>

                            <span class="ml-10 text-xs sm:text-sm">Calendar</span>
                        </a>
                    </li>
                </ul>
            </li>

            <x-admin.sidebar-link
                :href="route('admin.dashboard.index')" 
                :active="request()->routeIs('admin.dashboard.index')">

                @slot('icon')
                    <svg class="flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-500 transition duration-75 dark:text-gray-100 group-hover:text-gray-900 dark:group-hover:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M240-400h320v-80H240v80Zm0-120h480v-80H240v80Zm0-120h480v-80H240v80ZM80-80v-720q0-33 23.5-56.5T160-880h640q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H240L80-80Zm126-240h594v-480H160v525l46-45Zm-46 0v-480 480Z"/></svg>
                @endslot

                {{ __('Messages') }}

                @slot('badge')
                    <span class="inline-flex justify-center items-center w-4 h-4 sm:w-5 sm:h-5 text-xs font-semibold rounded-full text-primary-100 bg-primary-600 dark:bg-primary-200 dark:text-primary-800">4</span>
                @endslot
            </x-admin.sidebar-link>

            <li>
                <button type="button" class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="dropdown-authentication" data-collapse-toggle="dropdown-authentication">
                    <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                    </svg>

                    <span class="flex-1 ml-6 text-left whitespace-nowrap text-xs sm:text-sm">Authentication</span>

                    <div class="collapse-icon">
                        <svg aria-hidden="true" class="w-4 h-4 sm:w-5 sm:h-5 collapse-icon" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </button>
                <ul id="dropdown-authentication" class="hidden py-2 space-y-2">
                    <li>
                        <a href="#" class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor"><path d="M363.07-71.87 346.59-202.5q-11.09-4.28-21.04-10.33-9.94-6.04-19.51-12.84l-121.39 51.19L67.48-377.39l104.91-79.44q-.76-6.04-.76-11.58v-23.18q0-5.54.76-11.58L67.48-582.61l117.17-202.43 121.87 50.95q9.57-6.8 19.65-12.73 10.09-5.92 20.42-10.2l16.48-131.11h233.86l16.48 131.11q11.09 4.28 21.04 10.2 9.94 5.93 19.51 12.73l121.39-50.95 117.17 202.43-105.15 79.44q.76 6.04.76 11.58V-480q0 6.04-.12 11.59-.12 5.54-1.64 11.58l105.15 79.44-117.41 202.91-120.63-51.19q-9.57 6.8-19.65 12.84-10.09 6.05-20.42 10.33L596.93-71.87H363.07Zm79.56-91h73.5l14.24-105.52q31.24-8 58.34-23.62 27.09-15.62 49.09-38.58l98.77 41 36.13-63.69-85.29-64.52q5-14.48 7.24-30.22 2.24-15.74 2.24-31.98 0-16.24-2.24-31.98-2.24-15.74-7.24-30.22l85.76-64.52-36.6-63.69-98.53 42q-22-23.72-49.09-39.58-27.1-15.86-58.58-23.62l-13-105.52h-73.98l-13.52 105.28q-31.72 7.76-58.94 23.62-27.21 15.86-49.45 38.82l-98.28-41-36.37 63.69 85.04 63.29q-5 15.47-7.24 30.83-2.24 15.36-2.24 32.6 0 16.24 2.24 31.72t7.24 30.95l-85.04 64.05 36.37 63.69 98.28-41.76q22.24 23.48 49.57 39.34 27.34 15.86 58.82 23.86l12.76 105.28ZM481.28-340q58 0 99-41t41-99q0-58-41-99t-99-41q-58.76 0-99.38 41t-40.62 99q0 58 40.62 99t99.38 41ZM480-480Z"/></svg>

                            <span class="ml-10 text-xs sm:text-sm">Settings</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor"><path d="M281.43-281.43h80v-397.14h-80v397.14Zm317.14-80h80v-317.14h-80v317.14ZM440-481.43h80v-197.14h-80v197.14ZM202.87-111.87q-37.78 0-64.39-26.61t-26.61-64.39v-554.26q0-37.78 26.61-64.39t64.39-26.61h554.26q37.78 0 64.39 26.61t26.61 64.39v554.26q0 37.78-26.61 64.39t-64.39 26.61H202.87Zm0-91h554.26v-554.26H202.87v554.26Zm0-554.26v554.26-554.26Z"/></svg>

                            <span class="ml-10 text-xs sm:text-sm">Kanban</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" class="flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor"><path d="M202.87-71.87q-37.78 0-64.39-26.61t-26.61-64.39v-554.26q0-37.78 26.61-64.39t64.39-26.61H240v-80h85.5v80h309v-80H720v80h37.13q37.78 0 64.39 26.61t26.61 64.39v554.26q0 37.78-26.61 64.39t-64.39 26.61H202.87Zm0-91h554.26V-560H202.87v397.13Zm0-477.13h554.26v-77.13H202.87V-640Zm0 0v-77.13V-640ZM480-398.09q-17.81 0-29.86-12.05T438.09-440q0-17.81 12.05-29.86T480-481.91q17.81 0 29.86 12.05T521.91-440q0 17.81-12.05 29.86T480-398.09Zm-160 0q-17.81 0-29.86-12.05T278.09-440q0-17.81 12.05-29.86T320-481.91q17.81 0 29.86 12.05T361.91-440q0 17.81-12.05 29.86T320-398.09Zm320 0q-17.48 0-29.7-12.05-12.21-12.05-12.21-29.86t12.21-29.86q12.22-12.05 29.82-12.05t29.7 12.05q12.09 12.05 12.09 29.86t-12.05 29.86q-12.05 12.05-29.86 12.05Zm-160 160q-17.81 0-29.86-12.21-12.05-12.22-12.05-29.82t12.05-29.7q12.05-12.09 29.86-12.09t29.86 12.05q12.05 12.05 12.05 29.86 0 17.48-12.05 29.7-12.05 12.21-29.86 12.21Zm-160 0q-17.81 0-29.86-12.21-12.05-12.22-12.05-29.82t12.05-29.7q12.05-12.09 29.86-12.09t29.86 12.05q12.05 12.05 12.05 29.86 0 17.48-12.05 29.7-12.05 12.21-29.86 12.21Zm320 0q-17.48 0-29.7-12.21-12.21-12.22-12.21-29.82t12.21-29.7q12.22-12.09 29.82-12.09t29.7 12.05q12.09 12.05 12.09 29.86 0 17.48-12.05 29.7-12.05 12.21-29.86 12.21Z"/></svg>

                            <span class="ml-10 text-xs sm:text-sm">Calendar</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
            <li>
                <a href="#"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                    <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd"
                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-6 text-xs sm:text-sm">Docs</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                    <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z">
                        </path>
                    </svg>
                    <span class="ml-6 text-xs sm:text-sm">Components</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg transition duration-75 hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-white group">
                    <svg aria-hidden="true" class="flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-2 0c0 .993-.241 1.929-.668 2.754l-1.524-1.525a3.997 3.997 0 00.078-2.183l1.562-1.562C15.802 8.249 16 9.1 16 10zm-5.165 3.913l1.58 1.58A5.98 5.98 0 0110 16a5.976 5.976 0 01-2.516-.552l1.562-1.562a4.006 4.006 0 001.789.027zm-4.677-2.796a4.002 4.002 0 01-.041-2.08l-.08.08-1.53-1.533A5.98 5.98 0 004 10c0 .954.223 1.856.619 2.657l1.54-1.54zm1.088-6.45A5.974 5.974 0 0110 4c.954 0 1.856.223 2.657.619l-1.54 1.54a4.002 4.002 0 00-2.346.033L7.246 4.668zM12 10a2 2 0 11-4 0 2 2 0 014 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-6 text-xs sm:text-sm">Help</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="flex absolute bottom-0 left-0 justify-center p-4 space-x-4 w-full bg-white dark:bg-gray-800 z-20" id="drawer-footer">
        <a href="#" class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark:text-gray-400 hover:text-gray-900 dark:hover:text-white hover:bg-gray-100 dark:hover:bg-gray-600">
            <svg aria-hidden="true" class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path></svg>
        </a>

        <a href="#" class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
            <svg aria-hidden="true" class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path></svg>
        </a>

        <x-dropdown align="top" width="48">
            <x-slot name="trigger">
                <button type="button" data-dropdown-toggle="notification-dropdown" class="p-2 mr-1 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 relative">
                    <span class="sr-only">Application profile</span>
                    <div class="w-4 h-4 sm:w-5 sm:h-5" id="applicationTheme">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M320-280h320v-400H320v400Zm80-80v-240h160v240H400Zm40-120h80v-80h-80v80ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z"/></svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link href="javascript: void(0)" id="systemTheme">
                    <div class="text-left">
                        <div class="font-semibold leading-tight text-gray-900 dark:text-white mb-0.5 text-sm">Company</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Created August, 2014</div>
                    </div>
                </x-dropdown-link>
                <x-dropdown-link href="javascript: void(0)" id="lightTheme">
                    <div class="text-left">
                        <div class="font-semibold leading-tight text-gray-900 dark:text-white mb-0.5 text-sm">Personal</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">Created September, 2018</div>
                    </div>
                </x-dropdown-link>
            </x-slot>
        </x-dropdown>

        <x-dropdown align="top" width="24">
            <x-slot name="trigger">
                <button type="button" data-dropdown-toggle="notification-dropdown" class="p-2 mr-1 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600 relative">
                    <span class="sr-only">Language</span>
                    <div class="w-4 h-4 sm:w-5 sm:h-5" id="applicationTheme">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="m476-80 182-480h84L924-80h-84l-43-122H603L560-80h-84ZM160-200l-56-56 202-202q-35-35-63.5-80T190-640h84q20 39 40 68t48 58q33-33 68.5-92.5T484-720H40v-80h280v-80h80v80h280v80H564q-21 72-63 148t-83 116l96 98-30 82-122-125-202 201Zm468-72h144l-72-204-72 204Z"/></svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link href="javascript: void(0)" id="systemTheme">
                    <div class="text-left">
                        <div class="font-semibold leading-tight text-gray-900 dark:text-white mb-0.5 text-sm">English</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">India</div>
                    </div>
                </x-dropdown-link>
                <x-dropdown-link href="javascript: void(0)" id="lightTheme">
                    <div class="text-left">
                        <div class="font-semibold leading-tight text-gray-900 dark:text-white mb-0.5 text-sm">Hindi</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">India</div>
                    </div>
                </x-dropdown-link>
            </x-slot>
        </x-dropdown>

    </div>
</aside>