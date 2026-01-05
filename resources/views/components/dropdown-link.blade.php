<a {{ $attributes->merge([
    'class' => 'group flex items-center w-full px-4 py-3 text-start text-sm font-medium leading-5 text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 focus:outline-none focus:bg-emerald-50 transition-all duration-200 ease-in-out'
]) }}>
    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-3 opacity-0 group-hover:opacity-100 transition-opacity"></span>
    
    <span class="flex-1">
        {{ $slot }}
    </span>
    
    <svg class="w-3.5 h-3.5 opacity-0 -translate-x-2 group-hover:opacity-100 group-hover:translate-x-0 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
    </svg>
</a>