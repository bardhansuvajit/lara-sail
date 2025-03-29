@props(['disabled' => false])

<input 
    {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge(['class' => 'text-xs w-full dark:text-gray-300 '.FD['rounded'].' shadow-sm h-[2rem]
        border-gray-300 dark:border-gray-700 
        dark:bg-gray-700 dark:focus:border-primary-600 dark:focus:ring-primary-600 
        focus:border-primary-500 focus:ring-primary-500']) !!}
>