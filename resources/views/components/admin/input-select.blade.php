@props([
    'options',
    'title' => false
])

<select {{ $attributes->merge(['class' => 'h-[2.3rem] bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block p-y-3 dark:bg-gray-900 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-primary-500 dark:focus:border-primary-500']) }}>
    @if (isset($title))
        <x-admin.input-select-option value="" selected="selected" disabled="disabled" hidden="hidden"> {{ __($title) }} </x-admin.input-select-option>
    @endif
    {!! $options !!}
</select>