@props([
    'name' => false,
    'align' => 'right', 
    'width' => '48', 
    'contentClasses' => 'py-1 bg-white dark:bg-gray-700'
])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    'right' => 'ltr:origin-top-right rtl:origin-top-left end-0',
    'top-left' => 'ltr:origin-bottom-left rtl:origin-bottom-right start-0',
    'top-right' => 'ltr:origin-bottom-right rtl:origin-bottom-left end-0',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$width = match ($width) {
    '32' => 'sm:w-32',
    '48' => 'sm:w-48',
    '60' => 'sm:w-60',
    '96' => 'sm:w-96',
    'full' => 'sm:w-full',
    // default => $width,
    default => $width,
};

// Determine whether it's a drop-up or drop-down based on align
$positionClasses = str_starts_with($align, 'top') ? 'bottom-full mb-2' : 'top-full mt-2';

// category dropdown wants a large min-width at xl+; use Tailwind arbitrary value
$specialMinClass = $name === 'category-dropdown' ? 'md:min-w-[1280px] w-screen' : '';
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute z-50 mt-2 {{ $positionClasses }} w-sc reen {{ $width }} {{ FD['rounded'] }} shadow-lg {{ $alignmentClasses }} {{ $specialMinClass }}"
            style="display: none;"
            @click="open = false">
        <div class="{{ FD['rounded'] }} ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
