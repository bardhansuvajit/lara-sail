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
    text-gray-500 bg-white border border-gray-200 rounded cursor-pointer 
    hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-700 dark:hover:bg-gray-600 
    dark:hover:text-gray-300 dark:border-gray-700 
    peer-checked:text-gray-50 peer-checked:bg-gray-400 peer-checked:border-gray-400 
    dark:peer-checked:text-gray-50 dark:peer-checked:bg-gray-900 dark:peer-checked:border-gray-600']) }} >
    <div class="block w-full text-center">
        <div class="w-full text-sm font-semibold">{!! $title ? $title : $value !!}</div>
    </div>
</label>