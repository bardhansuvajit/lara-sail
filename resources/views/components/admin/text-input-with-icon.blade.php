@props([
    'disabled' => false,
    'icon',
    'iconPosition',
])

@php
$iconPositionClass = [
    'start' => 'ps-10',
    'end' => 'pe-10',
][$iconPosition];
@endphp

<div class="relative w-full">
    @if ($iconPosition == "start")
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            {!! str_replace('<svg', '<svg class="w-4 h-4 text-gray-500 dark:text-gray-400"', $icon) !!}
        </div>
    @endif

    <input 
        {!! $attributes->merge(['class' => $iconPositionClass.' text-xs w-full dark:text-gray-300 rounded shadow-sm h-[2rem]
        border-gray-300 dark:border-gray-700 
        dark:bg-gray-900 dark:focus:border-primary-600 dark:focus:ring-primary-600 
        focus:border-primary-500 focus:ring-primary-500']) !!}
        {{ $disabled ? 'disabled' : '' }} 
    />

    @if ($iconPosition == "end")
        <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
            {!! str_replace('<svg', '<svg class="w-4 h-4 text-gray-500 dark:text-gray-400"', $icon) !!}
        </div>
    @endif
</div>