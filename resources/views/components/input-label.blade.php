@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-semibold text-sm text-slate-700 tracking-tight mb-1 ml-1']) }}>
    {{ $value ?? $slot }}
</label>