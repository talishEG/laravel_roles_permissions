@props(['class'])

@php
    $classes = $class.' text-sm rounded-md text-white px-3 py-3';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
