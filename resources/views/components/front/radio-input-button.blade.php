@props([
    'id' => null,
    'name' => null,
    'value' => null,
    'checked' => false,
    'required' => false,
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
    ">
        {{ $slot }}
    </label>
</div>



{{-- @props([
    'id' => null,
    'name' => null,
    'value' => null,
    'checked' => false,
    'required' => false,
    // 'title' => null,
])

<input 
    type="radio" 
    id="{{ $id }}" 
    name="{{ $name }}" 
    value="{{ $value }}" 
    class="hidden peer" 
    // {{ $attributes->merge(['class' => 'hidden peer']) }}
    // {{ $attributes }}
    @if($required) required @endif 
    @if($checked) checked @endif 
/>

<label for="{{ $id }}" class="p-2 border border-gray-200 dark:border-gray-600 cursor-pointer 
    bg-gray-100 peer-checked:bg-gray-200 peer-checked:text-gray-800 peer-checked:border-gray-300
    dark:bg-gray-700 dark:peer-checked:bg-amber-800 dark:peer-checked:text-gray-300 dark:peer-checked:border-gray-700
">
    {{ $slot }}
</label> --}}

{{-- <label for="{{ $id }}" {{ $attributes->merge(['class' => 'h-[2rem] w-[2rem] inline-flex items-center justify-between p-1 
    text-gray-500 bg-white border border-gray-200 rounded cursor-pointer 
    hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600 
    dark:hover:text-gray-300 dark:border-gray-700 
    peer-checked:text-gray-50 peer-checked:bg-gray-400 peer-checked:border-gray-400 
    dark:peer-checked:text-gray-50 dark:peer-checked:bg-gray-900 dark:peer-checked:border-gray-600']) }} >
    {{ $content }}
</label> --}}