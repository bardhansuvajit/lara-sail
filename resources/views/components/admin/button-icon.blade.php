@props([
    'element',
    'icon' => false,
    'type' => false,
    'tag' => 'primary',
    'disabled' => false
])

@php
    $classes = match($tag) {
        'danger' => 'h-[2rem] w-[2rem] flex items-center justify-center font-medium rounded text-sm p-1
                    text-white bg-red-600 border border-red-700
                    hover:bg-red-800 
                    focus:outline-none focus:ring-4 focus:ring-red-300 
                    dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800',

        'secondary' => 'h-[2rem] w-[2rem] flex items-center justify-center font-medium rounded text-sm p-1
                       text-secondary-500 border-gray-200 dark:border-gray-600 
                       hover:bg-gray-200 
                       focus:outline-none focus:ring-4 focus:ring-gray-100 
                       dark:text-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-4 dark:focus:ring-gray-600',

        'primary' => 'h-[2rem] w-[2rem] flex items-center justify-center font-medium rounded text-sm p-1
                     text-primary-500 bg-primary-100 border border-primary-200 dark:border-gray-600 
                     hover:bg-primary-200 
                     focus:outline-none focus:ring-4 focus:ring-primary-100 
                     dark:text-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-4 dark:focus:ring-gray-600',

        default => 'h-[2rem] w-[2rem] flex items-center justify-center font-medium rounded text-sm p-1
                    text-primary-500 bg-primary-100 border border-primary-200 dark:border-gray-600 
                    hover:bg-primary-200 
                    focus:outline-none focus:ring-4 focus:ring-primary-100 
                    dark:text-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-4 dark:focus:ring-gray-600',
    };

    $defaultIconClass = "h-4 w-4";
@endphp

<{{$element}} {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }} @if($type) type="{{ $type }}" @endif>

    @if($icon) <div class="{{ $defaultIconClass }}">{!! $icon !!}</div> @endif

    {{ $slot }}
</{{$element}}>