@props([
    'id' => null,
    'form' => null,
    'name' => null,
    'value' => null,
    'label' => null,
    'checked' => false,
])

<div 
    {!! $attributes->merge(['class' => 'flex items-center']) !!}

    @if ($label == 'Show password')
        x-data="{
            togglePassword() {
                {{-- const passwordFields = document.querySelectorAll('input[type=password], input[type=text]'); --}}
                const passwordFields = document.querySelectorAll('input[name*=password][type=password], input[name*=password][type=text]');
                passwordFields.forEach(input => {
                    input.type = input.type === 'password' ? 'text' : 'password';
                });
            }
        }"
    @endif
>
    <input 
        id="{{ $id }}" 
        @if ($form) form="{{ $form }}" @endif 
        @if ($checked) checked @endif 
        name="{{ $name }}" 
        value="{{ $value }}" 
        type="checkbox" 
        class="w-3 h-3 text-primary-600 bg-gray-100 rounded border-gray-300 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-800 focus:ring-2 
        dark:bg-gray-700 dark:border-gray-600 checked:bg-primary-700 dark:checked:bg-primary-700" 
        @if ($label == 'Show password')
            x-on:change="togglePassword()"
        @endif
    >
    @if ($label)
        <label 
            for="{{ $id }}" 
            class="ml-2 text-xs text-gray-600 dark:text-gray-300">
            {{ $label }}
        </label>
    @else
        <label 
            for="{{ $id }}" 
            class="sr-only">
            checkbox
        </label>
    @endif
</div>