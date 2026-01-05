<button {{ $attributes->merge([
    'type' => 'submit', 
    'class' => 'inline-flex items-center justify-center px-6 py-3 bg-emerald-600 border border-transparent rounded-2xl font-bold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-200 focus:bg-emerald-700 active:scale-95 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all duration-150'
]) }}>
    <span class="flex items-center gap-2">
        {{ $slot }}
        <svg class="w-4 h-4 opacity-70 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
        </svg>
    </span>
</button>