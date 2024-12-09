@props([
    'options'
])

<select {{ $attributes->merge(['class' => 'w-28 h-[2.3rem] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-2.5 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-primary-500 dark:focus:border-primary-500']) }}>
    {!! $options !!}
</select>