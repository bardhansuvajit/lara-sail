@props(['disabled' => false])

<input 
    {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge(['class' => 'text-sm w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-primary-500 dark:focus:border-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 rounded-md shadow-sm h-[2.3rem]']) !!}
>