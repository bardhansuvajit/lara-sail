@props([
    'active',
    'icon',
    'badge' => false
])

@php
$classes = ($active ?? false)
            ? 'flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group bg-primary-200 dark:bg-gray-600'
            : 'flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-primary-300 dark:hover:bg-gray-700 group';

$badge ? $badgeClass = 'flex-1 whitespace-nowrap' : $badgeClass = '';
$defaultIconClass = "flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-700 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white";
@endphp

<li>
    <a {{ $attributes->merge(['class' => $classes]) }}>
        <div class="{{ $defaultIconClass }}">
            {!! $icon !!}
        </div>
    
        <span class="{{ $badgeClass }} ml-6 text-xs sm:text-sm">{{ $slot }}</span>

        {!! $badge !!}
    </a>
</li>