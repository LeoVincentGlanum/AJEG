@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center p-[10px] bg-custom-text text-custom-nav rounded-[10px]'
            : 'inline-flex items-center p-[10px] bg-custom-button rounded-[10px]';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
