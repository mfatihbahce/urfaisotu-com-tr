@php
    $icons = config('spice_icons.icons', []);
    $iconKey = $icon ?? 'default';
    $iconData = $icons[$iconKey] ?? $icons['default'] ?? null;
    $size = $size ?? 'w-8 h-8';
@endphp
@if($iconData && isset($iconData['svg']))
<svg class="{{ $size }} {{ $class ?? '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" {{ $attributes }}>
    {!! $iconData['svg'] !!}
</svg>
@else
<svg class="{{ $size }} {{ $class ?? '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24" {{ $attributes }}>
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h7v7H4V6zm9 5h7v7h-7v-7z"/>
</svg>
@endif
