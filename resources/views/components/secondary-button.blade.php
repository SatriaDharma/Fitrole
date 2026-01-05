<button {{ $attributes->merge([
    'type' => 'button', 
    'class' => 'inline-flex items-center justify-center px-6 py-3 bg-white border border-stone-200 rounded-2xl font-bold text-xs text-slate-600 uppercase tracking-widest shadow-sm hover:bg-stone-50 hover:text-slate-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 disabled:opacity-25 transition-all duration-150 active:scale-95'
]) }}>
    {{ $slot }}
</button>