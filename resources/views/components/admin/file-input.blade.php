@props(['disabled' => false])

<input 
    {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge(['class' => 'text-xs text-gray-500 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded shadow-sm h-[2rem] 
    border focus:outline-primary-500 dark:focus:outline-primary-500 file:dark:focus:outline-primary-500
    file:bg-gray-100 file:border-0 file:me-3 file:py-2 file:px-2 dark:file:bg-neutral-700 dark:file:text-neutral-400 file:border-e-1 
    dark:focus:border-primary-600
    ']) !!}
    type="file"
>
