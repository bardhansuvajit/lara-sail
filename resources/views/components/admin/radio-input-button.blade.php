@props([
    'id',
    'value',
    'name' => '',
    'required' => false,
    'checked' => false
])

<input 
    type="radio" 
    id="{{ $id }}" 
    name="{{ $name }}" 
    value="{{ $value }}" 
    class="hidden peer" 
    @if($required) required @endif 
    @if($checked) checked @endif 
/>

<label for="{{ $id }}" class="h-[2rem] w-[2rem] inline-flex items-center justify-between p-1 text-gray-500 bg-white border border-gray-200 rounded cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-gray-50 dark:peer-checked:bg-gray-700 peer-checked:bg-gray-400 dark:peer-checked:border-gray-700 peer-checked:border-gray-400 peer-checked:text-gray-50 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
    <div class="block w-full text-center">
        <div class="w-full text-lg font-semibold">{{ $value }}</div>
    </div>
</label>