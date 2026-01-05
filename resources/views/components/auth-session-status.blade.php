@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'relative flex items-center gap-3 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 mb-6 animate-in fade-in slide-in-from-top-4 duration-500']) }}>
        <div class="flex-shrink-0 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center shadow-sm shadow-emerald-200">
            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <div class="flex flex-col">
            <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-widest leading-none mb-1">Berhasil</span>
            <span class="text-sm font-semibold text-emerald-800 leading-tight">
                {{ $status }}
            </span>
        </div>

        <div class="absolute top-2 right-2 flex gap-1">
            <div class="w-1 h-1 bg-emerald-200 rounded-full"></div>
            <div class="w-1 h-1 bg-emerald-300 rounded-full"></div>
        </div>
    </div>
@endif