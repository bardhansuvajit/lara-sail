@props([
    'options',
    'selectTitle' => false,
    'selectId',
    'selectName',
    'selectModel' => null,
    'inputModel' => null,
    'disabled' => false,
    'required' => false,
    'focus' => false,
])

<div class="flex items-center">
    <select 
        id="{{ $selectId}}"
        name="{{ $selectName}}"
        @if($selectModel) wire:model.defer="{{ $selectModel }}" @endif
        {{ $disabled ? 'disabled' : '' }} 
        class="h-[2rem] border-gray-300 border-r-0 text-gray-800 text-xs {{ FD['rounded'] }}
               focus:ring-primary-500 focus:border-primary-500 block pr-8 py-1
               dark:bg-gray-700 dark:border-gray-700 dark:placeholder-gray-400
               dark:text-gray-300 dark:focus:ring-primary-500 dark:focus:border-primary-500"
        {{ ($required) ? 'required' : '' }}
    >
        @if ($selectTitle)
            <x-front.input-select-option value="" selected disabled hidden>
                {{ __($selectTitle) }}
            </x-front.input-select-option>
        @endif
        {!! $options !!}
    </select>

    <input 
        type="text"
        @if($inputModel) wire:model.defer="{{ $inputModel }}" @endif
        {{ $disabled ? 'disabled' : '' }} 
        {!! $attributes->merge([
            'class' => 'text-xs w-full dark:text-gray-300 '.FD['rounded'].' h-[2rem] 
            border-gray-300 dark:border-gray-700 border-l-0 
            dark:bg-gray-700 dark:focus:border-primary-600 dark:focus:ring-primary-600 
            focus:border-primary-500 focus:ring-primary-500'
        ]) !!}
        {{ ($required) ? 'required' : '' }}
        {{ ($focus) ? 'autofocus' : '' }}
    />
</div>



{{-- @props([
    'options',
    'selectTitle' => false,
    'selectId',
    'selectName',
    'disabled' => false,
    'required' => false,
    'focus' => false,
])

<div class="flex items-center">
    <select 
        id="{{ $selectId}}"
        name="{{ $selectName}}"
        {{ $disabled ? 'disabled' : '' }} 
        {{ $attributes->merge(['class' => ($attributes->get('disabled') ? 'bg-gray-300 cursor-not-allowed' : 'bg-white') . ' h-[2rem] border-gray-300 border-r-0 text-gray-800 text-xs '.FD['rounded'].' focus:ring-primary-500 focus:border-primary-500 block pr-8 py-1 dark:bg-gray-700 dark:border-gray-700 dark:placeholder-gray-400 dark:text-gray-300 dark:focus:ring-primary-500 dark:focus:border-primary-500']) }}
        {{ ($required) ? 'required' : '' }}
    >
        @if ($selectTitle)
            <x-front.input-select-option value="" selected="selected" disabled="disabled" hidden="hidden"> {{ __($selectTitle) }} </x-front.input-select-option>
        @endif
        {!! $options !!}
    </select>

    <input 
        {{ $disabled ? 'disabled' : '' }} 
        {!! $attributes->merge(['class' => 'text-xs w-full dark:text-gray-300 '.FD['rounded'].' h-[2rem] 
        border-gray-300 dark:border-gray-700 border-l-0 
        dark:bg-gray-700 dark:focus:border-primary-600 dark:focus:ring-primary-600 
        focus:border-primary-500 focus:ring-primary-500
        ']) !!}
        {{ ($required) ? 'required' : '' }}
        {{ ($focus) ? 'autofocus' : '' }}
        {{ $attributes }}
    />
</div> --}}