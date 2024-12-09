@props([
    'title',
    'active' => false,
    'icon',
    'menu',
    'badge' => false
])

@php
$classes = ($active ?? false)
        ? 'flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700'
        : 'flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700';

$badge ? $badgeClass = 'flex-1 whitespace-nowrap' : $badgeClass = '';
$defaultIconClass = "flex-shrink-0 w-4 h-4 sm:w-5 sm:h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white";

if ($active !== false) {
    $collapseMenu = "block";
    $collapseIcon = '<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 sm:w-5 sm:h-5" viewBox="0 -960 960 960" fill="currentColor"><path d="m480-520.35-184 184L232.35-400 480-647.65 727.65-400 664-336.35l-184-184Z"/></svg>';
} else {
    $collapseMenu = "hidden";
    $collapseIcon = '<svg aria-hidden="true" class="w-4 h-4 sm:w-5 sm:h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>';
}
@endphp

<li>
    <button 
        {{ $attributes->merge(['class' => $classes]) }}
        type="button" 
        aria-controls="dropdown-{{ Str::slug($title) }}" 
        data-collapse-toggle="dropdown-{{ Str::slug($title) }}">

        <div class="{{ $defaultIconClass }}">
            {!! $icon !!}
        </div>

        <span class="flex-1 text-left whitespace-nowrap ml-6 text-xs sm:text-sm">{{ $slot }}</span>

        <div class="collapse-icon">{!! $collapseIcon !!}</div>

        {!! $badge !!}
    </button>

    <ul id="dropdown-{{ Str::slug($title) }}" class="{{ $collapseMenu }} py-2 space-y-2">
        {{ $menu }}
    </ul>
</li>