<div {{ $attributes->merge(['class' => 'flex items-center gap-2']) }}>
    <div class="relative flex items-center justify-center">
        <div class="absolute inset-0 bg-emerald-100 rounded-xl rotate-12 group-hover:rotate-45 transition-transform duration-500"></div>
        
        <div class="relative w-12 h-12 bg-emerald-600 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-200 overflow-hidden">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white">
                <path d="M12 3C12 3 8.5 7 8.5 10.5C8.5 12.433 10.067 14 12 14C13.933 14 15.5 12.433 15.5 10.5C15.5 7 12 3 12 3Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12 14V21M9 18H15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            
            <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-white/20 to-transparent"></div>
        </div>
    </div>
    
    <span class="text-2xl font-black text-slate-800 tracking-tighter">
        Fit<span class="text-emerald-600">role</span>
    </span>
</div>