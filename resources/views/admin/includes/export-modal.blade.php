<x-modal name="export" maxWidth="md" >
    <div class="p-4">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Export data?') }}
        </h2>

        <p class="mt-1 text-xs text-gray-600 dark:text-gray-400">
            {!! __('Export data in following format') !!}
        </p>

        <div class="mt-4 flex space-x-2">
            <x-admin.button
                element="a"
                tag="primary"
                href="{{ route('admin.product.category.export', 'excel') . '?' . http_build_query(request()->query()) }}"
                title="Cancel"
                class="border"
                x-on:click="$dispatch('close')"
            >
                @slot('icon')
                    <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 50 50" fill="currentColor">
                        <path d="M 16 4 C 14.35 4 13 5.35 13 7 L 13 11 L 15 11 L 15 7 C 15 6.45 15.45 6 16 6 L 30 6 L 30 14 L 26.509766 14 C 26.799766 14.61 26.970234 15.28 26.990234 16 L 30 16 L 30 24 L 27 24 L 27 26 L 30 26 L 30 34 L 26.990234 34 C 26.970234 34.72 26.799766 35.39 26.509766 36 L 30 36 L 30 44 L 16 44 C 15.45 44 15 43.55 15 43 L 15 39 L 13 39 L 13 43 C 13 44.65 14.35 46 16 46 L 46 46 C 47.65 46 49 44.65 49 43 L 49 7 C 49 5.35 47.65 4 46 4 L 16 4 z M 32 6 L 46 6 C 46.55 6 47 6.45 47 7 L 47 14 L 32 14 L 32 6 z M 4.1992188 13 C 2.4437524 13 1 14.443752 1 16.199219 L 1 33.800781 C 1 35.556248 2.4437524 37 4.1992188 37 L 21.800781 37 C 23.556248 37 25 35.556248 25 33.800781 L 25 16.199219 C 25 14.443752 23.556248 13 21.800781 13 L 4.1992188 13 z M 4.1992188 15 L 21.800781 15 C 22.475315 15 23 15.524685 23 16.199219 L 23 33.800781 C 23 34.475315 22.475315 35 21.800781 35 L 4.1992188 35 C 3.5246851 35 3 34.475315 3 33.800781 L 3 16.199219 C 3 15.524685 3.5246851 15 4.1992188 15 z M 32 16 L 47 16 L 47 24 L 32 24 L 32 16 z M 7.96875 19 L 11.462891 24.978516 L 7.6308594 31 L 10.494141 31 L 13.015625 26.283203 L 15.548828 31 L 18.369141 31 L 14.599609 25 L 18.285156 19 L 15.609375 19 L 13.154297 23.505859 L 10.830078 19 L 7.96875 19 z M 32 26 L 47 26 L 47 34 L 32 34 L 32 26 z M 32 36 L 47 36 L 47 43 C 47 43.55 46.55 44 46 44 L 32 44 L 32 36 z"></path>
                    </svg>
                @endslot
                {{ __('Excel') }}
            </x-admin.button>

            <x-admin.button
                element="a"
                tag="primary"
                href="{{ route('admin.product.category.export', 'csv') . '?' . http_build_query(request()->query()) }}"
                title="Cancel"
                class="border"
                x-on:click="$dispatch('close')"
            >
                @slot('icon')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M230-360h120v-60H250v-120h100v-60H230q-17 0-28.5 11.5T190-560v160q0 17 11.5 28.5T230-360Zm156 0h120q17 0 28.5-11.5T546-400v-60q0-17-11.5-31.5T506-506h-60v-34h100v-60H426q-17 0-28.5 11.5T386-560v60q0 17 11.5 30.5T426-456h60v36H386v60Zm264 0h60l70-240h-60l-40 138-40-138h-60l70 240ZM160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm0-80h640v-480H160v480Zm0 0v-480 480Z"/></svg>
                @endslot
                {{ __('CSV') }}
            </x-admin.button>

            <x-admin.button
                element="a"
                tag="primary"
                href="{{ route('admin.product.category.export', 'html') . '?' . http_build_query(request()->query()) }}"
                title="Cancel"
                class="border"
                x-on:click="$dispatch('close')"
            >
                @slot('icon')
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M0-390v-180q0-13 8.5-21.5T30-600q13 0 21.5 8.5T60-570v50h80v-50q0-13 8.5-21.5T170-600q13 0 21.5 8.5T200-570v180q0 13-8.5 21.5T170-360q-13 0-21.5-8.5T140-390v-70H60v70q0 13-8.5 21.5T30-360q-13 0-21.5-8.5T0-390Zm310 0v-150h-40q-13 0-21.5-8.5T240-570q0-13 8.5-21.5T270-600h140q13 0 21.5 8.5T440-570q0 13-8.5 21.5T410-540h-40v150q0 13-8.5 21.5T340-360q-13 0-21.5-8.5T310-390Zm170 0v-170q0-17 11.5-28.5T520-600h180q17 0 28.5 11.5T740-560v170q0 13-8.5 21.5T710-360q-13 0-21.5-8.5T680-390v-150h-40v110q0 13-8.5 21.5T610-400q-13 0-21.5-8.5T580-430v-110h-40v150q0 13-8.5 21.5T510-360q-13 0-21.5-8.5T480-390Zm350 30q-13 0-21.5-8.5T800-390v-180q0-13 8.5-21.5T830-600q13 0 21.5 8.5T860-570v150h70q13 0 21.5 8.5T960-390q0 13-8.5 21.5T930-360H830Z"/></svg>
                @endslot
                {{ __('HTML') }}
            </x-admin.button>

            <x-admin.button
                element="a"
                tag="primary"
                href="{{ route('admin.product.category.export', 'pdf') }}"
                title="Cancel"
                class="border"
                x-on:click="$dispatch('close')"
            >
                @slot('icon')
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 256 256" xml:space="preserve" fill="currentColor">
                        <defs></defs>
                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                            <path d="M 45 47.357 c -0.633 0 -1.228 -0.246 -1.676 -0.693 l -10.63 -10.63 c -0.681 -0.68 -0.882 -1.694 -0.514 -2.583 c 0.369 -0.889 1.228 -1.463 2.19 -1.463 h 2.682 v -8.751 c 0 -1.307 1.063 -2.371 2.37 -2.371 h 11.155 c 1.308 0 2.371 1.063 2.371 2.371 v 8.751 h 2.682 c 0.964 0 1.823 0.575 2.19 1.465 c 0.367 0.888 0.165 1.901 -0.515 2.581 l -10.63 10.63 C 46.229 47.111 45.633 47.357 45 47.357 z M 35.89 34.987 l 9.11 9.11 l 9.109 -9.11 h -2.661 c -0.828 0 -1.5 -0.671 -1.5 -1.5 v -9.622 h -9.896 v 9.622 c 0 0.829 -0.671 1.5 -1.5 1.5 H 35.89 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: currentColor; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path d="M 77.474 17.28 L 61.526 1.332 C 60.668 0.473 59.525 0 58.311 0 H 15.742 c -2.508 0 -4.548 2.04 -4.548 4.548 v 80.904 c 0 2.508 2.04 4.548 4.548 4.548 h 58.516 c 2.508 0 4.549 -2.04 4.549 -4.548 V 20.496 C 78.807 19.281 78.333 18.138 77.474 17.28 z M 61.073 5.121 l 12.611 12.612 H 62.35 c -0.704 0 -1.276 -0.573 -1.276 -1.277 V 5.121 z M 15.742 3 h 42.332 v 13.456 c 0 2.358 1.918 4.277 4.276 4.277 h 13.457 v 33.2 H 14.194 V 4.548 C 14.194 3.694 14.888 3 15.742 3 z M 74.258 87 H 15.742 c -0.854 0 -1.548 -0.694 -1.548 -1.548 V 56.934 h 61.613 v 28.519 C 75.807 86.306 75.112 87 74.258 87 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: currentColor; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path d="M 31.116 62.679 h -5.944 c -0.829 0 -1.5 0.672 -1.5 1.5 v 9.854 v 6.748 c 0 0.828 0.671 1.5 1.5 1.5 s 1.5 -0.672 1.5 -1.5 v -5.248 h 4.444 c 2.392 0 4.338 -1.946 4.338 -4.338 v -4.177 C 35.454 64.625 33.508 62.679 31.116 62.679 z M 32.454 71.194 c 0 0.737 -0.6 1.338 -1.338 1.338 h -4.444 v -6.854 h 4.444 c 0.738 0 1.338 0.601 1.338 1.339 V 71.194 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: currentColor; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path d="M 46.109 82.28 h -5.652 c -0.829 0 -1.5 -0.672 -1.5 -1.5 V 64.179 c 0 -0.828 0.671 -1.5 1.5 -1.5 h 5.652 c 2.553 0 4.63 2.077 4.63 4.63 V 77.65 C 50.739 80.203 48.662 82.28 46.109 82.28 z M 41.957 79.28 h 4.152 c 0.898 0 1.63 -0.731 1.63 -1.63 V 67.309 c 0 -0.898 -0.731 -1.63 -1.63 -1.63 h -4.152 V 79.28 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: currentColor; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path d="M 64.828 62.679 h -8.782 c -0.828 0 -1.5 0.672 -1.5 1.5 V 80.78 c 0 0.828 0.672 1.5 1.5 1.5 s 1.5 -0.672 1.5 -1.5 v -6.801 h 4.251 c 0.828 0 1.5 -0.672 1.5 -1.5 s -0.672 -1.5 -1.5 -1.5 h -4.251 v -5.301 h 7.282 c 0.828 0 1.5 -0.672 1.5 -1.5 S 65.656 62.679 64.828 62.679 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: currentColor; fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                        </g>
                    </svg>
                @endslot
                {{ __('PDF') }}
            </x-admin.button>

        </div>

        <div class="mt-9 flex justify-end">
            <x-admin.button
                element="a"
                tag="secondary"
                href="javascript: void(0)"
                title="Cancel"
                class="border"
                x-on:click="$dispatch('close')"
            >
                {{ __('Cancel') }}
            </x-admin.button>
        </div>
    </div>
</x-modal>