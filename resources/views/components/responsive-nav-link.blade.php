@props(['active'])

@php
@endphp

<a {{ $attributes }}>
    {{ $slot }}
</a>
