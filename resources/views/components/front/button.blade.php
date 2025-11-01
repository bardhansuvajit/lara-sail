@props([
    'element',
    'icon' => false,
    'type' => false,
    'tag' => 'primary',
    'size' => 'sm', // default size
    'disabled' => false
])

@php
    $roundedClass = FD['rounded'];

    // Base classes common to all buttons
    $baseClasses = "flex items-center justify-center font-medium {$roundedClass} transition-all duration-200";

    // Size mapping
    $sizeClasses = match($size) {
        'xxs' => "h-4 ".FD['text']." p-1",
        'xs' => "h-4 ".FD['text']." px-2 py-3",
        'sm' => "h-8 ".FD['text']." px-3 py-1.5",
        'md' => "h-10 ".FD['text-1']." px-4 py-2",
        'lg' => "h-10 ".FD['text-2']." px-5 py-2.5",
        'xl' => "h-12 ".FD['text-2']." px-5 py-2.5",
        default => "h-8 ".FD['text']." px-3 py-1.5",
    };

    // Icon size mapping based on button size
    $defaultIconClass = match($size) {
        'xxs' => "h-3 w-3 mr-1",
        'xs' => "h-3 w-3 mr-1",
        'sm' => "h-3.5 w-3.5 mr-1.5",
        'md' => "h-4 w-4 mr-2",
        'lg' => "h-5 w-5 mr-2.5",
        'xl' => "h-5 w-5 mr-2.5",
        default => "h-3.5 w-3.5 mr-1.5",
    };

    // Gradient & color mapping
    $gradientClasses = match($tag) {
        'danger' => "bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 focus:ring-4 focus:ring-red-400 text-white shadow-md hover:shadow-lg",
        'warning' => "bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 focus:ring-4 focus:ring-orange-300 text-white shadow-md hover:shadow-lg",
        'success' => "bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-900 text-white shadow-md hover:shadow-lg",
        'secondary' => "bg-gradient-to-r from-slate-200 to-zinc-300 hover:from-slate-300 hover:to-zinc-400 focus:ring-4 focus:ring-gray-400 text-gray-800 shadow-md hover:shadow-lg",
        'primary' => "bg-gradient-to-r from-[#0d47a1] to-[#43a1ff] hover:from-[#1565c0] hover:to-[#54afff] focus:ring-4 focus:ring-[#42a5f5]/40 text-white shadow-md hover:shadow-lg",
        default => "bg-gradient-to-r from-[#0d47a1] to-[#43a1ff] hover:from-[#1565c0] hover:to-[#54afff] focus:ring-4 focus:ring-[#42a5f5]/40 text-white shadow-md hover:shadow-lg",
    };

    // $defaultIconClass = "h-4 w-4 mr-2";
@endphp

<{{$element}} 
    {{ $disabled ? 'disabled' : '' }} 
    {{ $attributes->merge(['class' => $baseClasses . ' ' . $sizeClasses . ' ' . $gradientClasses]) }} 
    @if($type) type="{{ $type }}" @endif
>
    @if($icon)
        <div class="{{ $defaultIconClass }}">{!! $icon !!}</div>
    @endif

    {{ $slot }}
</{{$element}}>
