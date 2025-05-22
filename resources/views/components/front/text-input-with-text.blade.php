@props([
    'disabled' => false,
    'focus' => false,
    'required' => false,
    'text',
    'textPosition',
])

@php
    $textPositionClass = '';

    if (!empty($text)) {
        $length = strlen($text);
        if ($length > 20) {
            $spacing = 'ps-32';
        } elseif ($length > 15) {
            $spacing = 'ps-28';
        } elseif ($length > 10) {
            $spacing = 'ps-20';
        } else {
            $spacing = 'ps-10';
        }

        $textPositionClass = [
            'start' => $spacing,
            'end' => str_replace('ps', 'pe', $spacing),
        ][$textPosition] ?? '';
    }
@endphp

<div class="relative w-full">
    @if ($textPosition == "start")
        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <p class="font-medium text-gray-600 dark:text-gray-400 text-xs">{{ $text }}</p>
        </div>
    @endif

    <input 
        {!! $attributes->merge(['class' => $textPositionClass.' text-xs w-full dark:text-gray-300 rounded shadow-sm h-[2rem] 
        border-gray-300 dark:border-gray-700 
        dark:bg-gray-700 dark:focus:border-primary-600 dark:focus:ring-primary-600 
        focus:border-primary-500 focus:ring-primary-500']) !!} 
        {{ ($focus) ? 'autofocus' : '' }} 
        {{ $disabled ? 'disabled' : '' }} 
        {{ ($required) ? 'required' : '' }} 
    />

    @if ($textPosition == "end")
        <div class="absolute inset-y-0 end-0 flex items-center pe-3 pointer-events-none">
            <p class="font-medium text-gray-600 dark:text-gray-400 text-xs">{{ $text }}</p>
        </div>
    @endif
</div>