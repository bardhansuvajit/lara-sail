@props([
    'element',
    'icon' => false,
    'type' => false,
    'tag' => 'primary',
    'disabled' => false
])

@php
    $classes = match($tag) {
        'danger' =>     'h-[2rem] flex items-center justify-center font-medium rounded text-xs p-2 
                        text-white bg-red-600 border border-red-700
                        hover:bg-red-800 
                        focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-red-400 dark:focus:ring-offset-gray-800',

        'warning' =>     'h-[2rem] flex items-center justify-center font-medium rounded text-xs p-2 
                        text-white bg-orange-600 border border-orange-700
                        hover:bg-orange-800 
                        focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-orange-300 dark:focus:ring-offset-gray-800',

        'secondary' =>  'h-[2rem] flex items-center justify-center font-medium rounded text-xs p-2 
                        text-primary-500 bg-primary-100 border border-primary-200 dark:border-gray-600 
                        hover:bg-primary-200 
                        focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-primary-300 
                        dark:text-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-500 dark:focus:ring-offset-gray-800',

        'primary' =>    'h-[2rem] flex items-center justify-center font-medium rounded text-xs p-2 
                        text-white bg-primary-600 border border-primary-600 
                        hover:bg-primary-800 
                        focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-primary-300 
                        dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-600 dark:focus:ring-offset-gray-800',

        default =>  'h-[2rem] flex items-center justify-center font-medium rounded text-xs p-2 
                        text-primary-500 bg-primary-100 border border-primary-200 dark:border-gray-600 
                        hover:bg-primary-200 
                        focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-primary-300 
                        dark:text-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-600 dark:focus:ring-offset-gray-800',
    };

    $defaultIconClass = "h-4 w-4 mr-2";
@endphp

<{{$element}} {{ $disabled ? 'disabled' : '' }} {{ $attributes->merge(['class' => $classes]) }} @if($type) type="{{ $type }}" @endif>

    @if($icon) <div class="{{ $defaultIconClass }}">{!! $icon !!}</div> @endif

    {{ $slot }}
</{{$element}}>