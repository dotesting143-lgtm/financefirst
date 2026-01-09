@props(['active'])

@php
$classes = ($active ?? false)
            ? 'flex w-full items-center p-2 2xl:p-2.5 text-sm 2xl:text-base font-medium leading-5 text-white rounded-lg bg-gunmetal focus:outline-none transition duration-150 ease-in-out'
            : 'flex w-full items-center p-2 2xl:p-2.5 text-sm 2xl:text-base font-medium leading-5 text-white rounded-lg hover:bg-gunmetal focus:outline-none focus:text-white transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
