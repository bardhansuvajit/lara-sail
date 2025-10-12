@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl',
    'vertical' => false,
    'backdrop' => false
])

@php
$maxWidth = [
    'xs' => 'sm:max-w-xs',
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
    '4xl' => 'sm:max-w-4xl',
    '6xl' => 'sm:max-w-6xl'
][$maxWidth];
@endphp

<div
    x-data="{
        show: @js($show),
        focusables() {
            // All focusable element types...
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])'
            return [...$el.querySelectorAll(selector)]
                // All non-disabled elements...
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
    x-on:open-modal.window="$event.detail == '{{ $name }}' ? show = true : null"
    x-on:close-modal.window="$event.detail == '{{ $name }}' ? show = false : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey || nextFocusable().focus()"
    x-on:keydown.shift.tab.prevent="prevFocusable().focus()"
    x-show="show"
    class="fixed inset-0 overflow-y-auto @if (!$name == "search-modal") px-4 py-6 @else p-0 md:px-4 md:py-6 @endif md:px-0 z-50 {{ $vertical == "middle" ? 'flex items-center' : '' }}"
    style="display: {{ $show ? 'block' : 'none' }};"
>
    <div
        x-show="show"
        class="fixed inset-0 transform transition-all"
        x-on:click="@js(!$backdrop) && (show = false)"
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
        class="@if (!$name == "search-modal") mb-6 @endif bg-white dark:bg-gray-700 {{ FD['rounded'] }} overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} mx-auto"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        {{ $slot }}
    </div>

    <!-- Search Modal close button -->
    @if ($name == "search-modal")
        <!-- centered floating close (mobile only) with transparent left/right gradient -->
        <div class="block fixed bottom-4 inset-x-0 z-50 pointer-events-none">
            <div class="mx-auto pointer-events-auto max-w-max px-3 py-1 rounded-full
                    backdrop-blur-sm bg-gradient-to-r from-transparent via-white/80 to-transparent
                    hover:bg-gray-100 dark:hover:bg-gray-700
                    dark:via-gray-800/60 shadow-lg">
                <button
                    type="button"
                    title="Close search"
                    aria-label="Close search"
                    x-on:click="show = false"
                    x-on:keydown.enter.prevent="show = false"
                    x-on:keydown.space.prevent="show = false"
                    class="h-10 w-10 flex items-center justify-center font-medium {{ FD['rounded'] }}
                        text-sm p-1 text-secondary-500 border border-transparent 
                        focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 dark:focus:ring-offset-gray-800
                        transition-transform hover:scale-105 active:scale-95"
                    >
                    <svg class="w-8 h-8 text-gray-700 dark:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" fill="currentColor" aria-hidden="true">
                        <path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z"/>
                    </svg>

                    <span class="sr-only">Close search modal</span>
                </button>
            </div>
        </div>
    @endif
</div>
