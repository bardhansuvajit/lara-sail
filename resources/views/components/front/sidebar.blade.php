@props([
    'name',
    'show' => false,
    'width' => 'sm', // sm, md, lg, xl, 2xl
    'mobileWidth' => 'full', // full, screen (full screen), or specific max-width
    'direction' => 'right',
    'header' => false
])

@php
$desktopWidth = [
    'sm' => 'sm:w-80',      // 320px
    'md' => 'sm:w-96',      // 384px  
    'lg' => 'sm:w-[448px]', // 448px
    'xl' => 'sm:w-[512px]', // 512px
    '2xl' => 'sm:w-[672px]',// 672px
][$width];

$mobileWidth = [
    'full' => 'w-full',
    'screen' => 'w-screen',
    'xs' => 'w-full max-w-[20rem]',
    'sm' => 'w-full max-w-sm',
    'md' => 'w-full max-w-md',
    'lg' => 'w-full max-w-lg',
    'xl' => 'w-full max-w-xl',
    '2xl' => 'w-full max-w-2xl',
][$mobileWidth];

$direction = $direction === 'left' ? 'left-0' : 'right-0';
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                .filter(el => ! el.hasAttribute('disabled'))
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() { return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable() },
        prevFocusable() { return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable() },
        nextFocusableIndex() { return (this.focusables().indexOf(document.activeElement) + 1) % (this.focusables().length + 1) },
        prevFocusableIndex() { return Math.max(0, this.focusables().indexOf(document.activeElement)) -1 },
    }"
    x-init="$watch('show', value => {
        if (value) {
            document.body.classList.add('overflow-y-hidden');
            {{ $attributes->has('focusable') ? 'setTimeout(() => firstFocusable().focus(), 100)' : '' }}
        } else {
            document.body.classList.remove('overflow-y-hidden');
        }
    })"
    x-on:open-sidebar.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-sidebar.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <div
        x-show="show"
        class="fixed inset-0 transform transition-all"
        x-on:click="show = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="absolute inset-0 bg-gray-500 dark:bg-gray-900 opacity-75"></div>
    </div>

    <div
        x-show="show"
        class="fixed top-0 z-20 {{ $direction }} h-full overflow-auto mb-6 bg-white dark:bg-gray-700 shadow-xl transform transition-all {{ $mobileWidth }} {{ $desktopWidth }}"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="{{ $direction === 'left-0' ? '-translate-x-full' : 'translate-x-full' }}"
        x-transition:enter-end="translate-x-0"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="translate-x-0"
        x-transition:leave-end="{{ $direction === 'left-0' ? '-translate-x-full' : 'translate-x-full' }}"
    >
        @if($header)
            <header class="flex items-center justify-between p-2 md:p-4 border-b dark:border-gray-800/50">
                <h2 class="text-lg font-semibold">{{ $header }}</h2>

                <button title="Close" class="h-6 w-6 flex items-center justify-center font-medium {{ FD['rounded'] }} text-sm p-1 text-secondary-500 border-gray-200 hover:bg-gray-200 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-gray-100 dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-600 dark:focus:ring-offset-gray-800" x-on:click="show = false" >
                    <svg class="{{FD['iconClass']}} text-gray-700 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/></svg>
                </button>
            </header>
        @else
            <div class="absolute top-4 right-4 shadow-lg z-50">
                <button title="Close" class="h-6 w-6 flex items-center justify-center font-medium {{ FD['rounded'] }} text-sm p-1 text-secondary-500 border-gray-200 hover:bg-gray-200 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-gray-100 dark:text-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-600 dark:focus:ring-offset-gray-800" x-on:click="show = false" >
                    <svg class="{{FD['iconClass']}} text-gray-700 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor"><path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/></svg>
                </button>
            </div>
        @endif

        {{ $slot }}
    </div>
</div>