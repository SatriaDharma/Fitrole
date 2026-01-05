@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-3 border-l-4 border-emerald-500 text-start text-base font-bold text-emerald-700 bg-emerald-50/50 focus:outline-none transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-3 border-l-4 border-transparent text-start text-base font-medium text-slate-600 hover:text-emerald-600 hover:bg-slate-50 hover:border-slate-200 focus:outline-none transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes . ' rounded-r-2xl my-1']) }}>
    <div class="flex items-center">
        {{ $slot }}
    </div>
</a>