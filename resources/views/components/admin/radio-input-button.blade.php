@props([
    'id' => null,
    'value' => null,
    'name' => null,
    'title' => null,
    'required' => false,
    'checked' => false
])

<input 
    type="radio" 
    id="{{ $id }}" 
    name="{{ $name }}" 
    value="{{ $value }}" 
    {{ $attributes->merge(['class' => 'hidden peer']) }}
    {{-- {{ $attributes }} --}}
    @if($required) required @endif 
    @if($checked) checked @endif 
/>

<label for="{{ $id }}" {{ $attributes->merge(['class' => 'h-[2rem] w-[2rem] inline-flex items-center justify-between p-1 
    text-gray-500 dark:text-gray-400 rounded cursor-pointer 
    bg-gray-200 peer-checked:bg-gray-300 peer-checked:text-gray-800 peer-checked:border-gray-600
    dark:bg-gray-700 dark:peer-checked:bg-gray-600 dark:peer-checked:text-gray-300 dark:peer-checked:border-gray-300
    border-2 border-gray-200 dark:border-gray-700']) }} >
    <div class="block w-full text-center">
        <div class="w-full text-sm font-semibold">{!! $title ? $title : $value !!}</div>
    </div>
</label>