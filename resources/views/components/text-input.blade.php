@props(['disabled' => false, 'error' => false])

@php
$baseClasses = 'w-full px-4 py-3 bg-stone-50 border rounded-2xl transition-all duration-300 outline-none text-sm placeholder:text-slate-300';
$stateClasses = $error 
    ? 'border-red-300 text-red-900 focus:border-red-500 focus:ring-4 focus:ring-red-500/10' 
    : 'border-stone-200 text-slate-700 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-500/10 focus:bg-white';
$disabledClasses = $disabled ? 'opacity-50 cursor-not-allowed bg-stone-100' : '';
@endphp

<input 
    @disabled($disabled) 
    {{ $attributes->merge(['class' => "$baseClasses $stateClasses $disabledClasses"]) }}
>