@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-xs text-gray-400 dark:text-gray-300 mb-1']) }}>
    {{ $value ?? $slot }}
</label>
