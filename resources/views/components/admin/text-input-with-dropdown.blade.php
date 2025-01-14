@props([
    'options',
    'selectTitle' => false,
    'selectId',
    'selectName',
    'disabled' => false,
    'selectRequired' => false,
    'textRequired' => false,
])

<div class="flex items-center">
    <select 
        id="{{ $selectId}}"
        name="{{ $selectName}}"
        {{ $disabled ? 'disabled' : '' }} 
        {{ $attributes->merge(['class' => ($attributes->get('disabled') ? 'bg-gray-300 cursor-not-allowed' : 'bg-white') . ' h-[2rem] border-gray-300 border-r-0 text-gray-800 text-xs rounded-l focus:ring-primary-500 focus:border-primary-500 block pr-8 py-1 dark:bg-gray-900 dark:border-gray-700 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-primary-500 dark:focus:border-primary-500']) }}
    >
        @if ($selectTitle)
            <x-admin.input-select-option value="" selected="selected" disabled="disabled" hidden="hidden"> {{ __($selectTitle) }} </x-admin.input-select-option>
        @endif
        {!! $options !!}
    </select>

    <input 
        {{ $disabled ? 'disabled' : '' }} 
        {!! $attributes->merge(['class' => 'text-xs w-full dark:text-gray-300 rounded-r h-[2rem] 
        border-gray-300 dark:border-gray-700 border-l-0 
        dark:bg-gray-900 dark:focus:border-primary-600 dark:focus:ring-primary-600 
        focus:border-primary-500 focus:ring-primary-500
        ']) !!}
        {{ $textRequired ? 'required' : '' }}
    />
</div>
