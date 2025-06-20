@props(['value', 'textSize' => 'text-sm'])

<label {{ $attributes->class(['block', 'font-medium', $textSize, 'text-gray-700']) }}>
    {{ $value ?? $slot }}
</label>