@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-4 pt-1 border-b-2 border-emerald-500 text-sm font-bold leading-5 text-emerald-600 focus:outline-none transition duration-150 ease-in-out'
            : 'inline-flex items-center px-4 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-slate-500 hover:text-emerald-600 hover:border-slate-200 focus:outline-none focus:text-slate-700 focus:border-slate-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <span class="relative">
        {{ $slot }}
        @if($active)
            <span class="absolute -bottom-[2px] left-0 w-full h-[2px] bg-emerald-500 rounded-full animate-in fade-in zoom-in duration-500"></span>
        @endif
    </span>
</a>