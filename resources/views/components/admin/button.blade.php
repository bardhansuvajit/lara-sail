@props([
    'element',
    'icon' => false,
    'type' => false,
    'tag' => 'primary',
    'disabled' => false
])

@php
    $classes = ($tag == 'primary')
            ? 'h-[2.3rem] flex items-center justify-center font-medium rounded-lg text-sm p-2 
            text-white bg-primary-600 border border-primary-600 
            hover:bg-primary-800 
            focus:outline-none focus:ring-4 focus:ring-primary-300 
            dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800'

            : 'h-[2.3rem] flex items-center justify-center font-medium rounded-lg text-sm p-2 
            text-primary-500 bg-primary-100 border border-primary-200 dark:border-gray-600 
            hover:bg-primary-200 
            focus:outline-none focus:ring-4 focus:ring-primary-300 
            dark:text-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-4 dark:focus:ring-gray-600';

    $defaultIconClass = "h-4 w-4 mr-2";
@endphp

<{{$element}} {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }} @if($type) type="{{ $type }}" @endif>

    @if($icon) <div class="{{ $defaultIconClass }}">{!! $icon !!}</div> @endif

    {{ $slot }}
</{{$element}}>