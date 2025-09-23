@props([
    'title',
    'subtitle' => null,
])

<header class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4 mb-3">
    <div>
        <h2 class="{{ FD['text-2'] }} font-semibold text-gray-700 dark:text-gray-200">{{ $title }}</h2>

        @if ($subtitle)
            <p class="{{ FD['text'] }} text-gray-600 dark:text-gray-400">{{ $subtitle }}</p>
        @endif
    </div>
</header>