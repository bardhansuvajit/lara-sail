@props([
    'id' => null,
    'name' => null,
    'value' => null,
    'checked' => false,
    'required' => false,
    'labelClass' => false,
])

<div class="group">
    <input 
        type="radio" 
        id="{{ $id }}" 
        name="{{ $name }}" 
        value="{{ $value }}"
        {{ $attributes->merge(['class' => 'hidden peer']) }}
        @required($required)
        @checked($checked)
    />

    <label for="{{ $id }}" class="block h-full p-2 border-2 border-gray-200 dark:border-gray-700 cursor-pointer 
        bg-gray-200 peer-checked:bg-gray-300 peer-checked:text-gray-800 peer-checked:border-gray-600
        dark:bg-gray-700 dark:peer-checked:bg-gray-600 dark:peer-checked:text-gray-300 dark:peer-checked:border-gray-100
        transition-colors duration-200 ease-in-out
        {{ $labelClass ?? '' }}
    ">
        {{ $slot }}
    </label>
</div>
