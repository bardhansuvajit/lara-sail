@props([
    'options',
    'title' => false
])

<select {{ $attributes->merge(['class' => ($attributes->get('disabled') ? 'bg-gray-300 cursor-not-allowed' : 'bg-white') . ' '. FD['rounded'] .' h-[2rem] border border-gray-300 text-gray-800 text-xs focus:ring-primary-500 focus:border-primary-500 block py-1 dark:bg-gray-700 dark:border-gray-700 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-primary-500 dark:focus:border-primary-500']) }}>
    @if ($title)
        <x-admin.input-select-option value="" selected="selected" disabled="disabled" hidden="hidden"> {{ __($title) }} </x-admin.input-select-option>
    @endif
    {!! $options !!}
</select>