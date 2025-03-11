@props([
    'disabled' => false,
    'value' => false
])

<textarea 
    {{ $disabled ? 'disabled' : '' }} 
    {!! $attributes->merge(['class' => 'text-xs w-full dark:text-gray-300 rounded shadow-sm min-h-[3rem]
        border-gray-300 dark:border-gray-700 
        dark:bg-gray-900 dark:focus:border-primary-600 dark:focus:ring-primary-600 
        focus:border-primary-500 focus:ring-primary-500']) !!}
>@if($value){!! $value !!}@endif</textarea>