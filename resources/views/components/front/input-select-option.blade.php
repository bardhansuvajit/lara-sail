@props([
    'value',
    'selected' => false,
    'disabled' => false,
    'hidden' => false,
])

<option value="{{ $value }}" {{ $selected ? 'selected' : '' }} {{ $disabled ? 'disabled' : '' }} {{ $hidden ? 'hidden' : '' }}>
    {{ $slot }}
</option>
