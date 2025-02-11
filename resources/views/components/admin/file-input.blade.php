@props(['disabled' => false])

<input 
    {{ $disabled ? 'disabled' : '' }}

    {!! $attributes->merge(['class' => 'text-xs w-full dark:text-gray-300 rounded shadow-sm h-[2rem]
        border border-gray-300 dark:border-gray-700 
        dark:bg-gray-900 dark:focus:border-primary-600 dark:focus:ring-primary-600 
        focus:outline-none focus:ring-1 
        focus:border-primary-500 focus:ring-primary-500
        file:dark:focus:outline-primary-500 file:bg-gray-100 file:border-0 file:me-3 file:py-2 file:px-2 dark:file:bg-neutral-700 dark:file:text-neutral-400 file:border-e-1 
    ']) !!}

    {{-- {!! $attributes->merge(['class' => 'text-xs w-full dark:text-gray-300 rounded shadow-sm h-[2rem]
        border border-gray-300 dark:border-gray-700 
        dark:bg-gray-900 dark:focus:border-primary-600 dark:focus:ring-primary-600 
        focus:outline focus:outline-2 focus:outline-primary-600 
        focus:border-primary-500 focus:ring-primary-500
        file:dark:focus:outline-primary-500 file:bg-gray-100 file:border-0 file:me-3 file:py-2 file:px-2 dark:file:bg-neutral-700 dark:file:text-neutral-400 file:border-e-1 
    ']) !!} --}}

    type="file"
>
