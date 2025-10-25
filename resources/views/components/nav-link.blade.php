@props(['active' => false])

@php

@endphp

<a {{ $attributes }} class="text-white w-24 {{ $active ? 'bg-gray-700' : 'bg-black' }} p-1 rounded-md hover:bg-gray-800"
>{{ $slot }}</a>
