<div class="flex flex-col h-full bg-white">
    <div class="h-16 flex items-center px-6 gap-3 mb-4">
        <div class="flex items-center gap-3">
            <span class="text-2xl font-black tracking-tighter text-slate-800">Fitrole<span class="text-emerald-600">.</span></span>
        </div>
    </div>

    <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto">
        <p class="px-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">Menu Utama</p>
        
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all group {{ request()->routeIs('dashboard') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'text-slate-500 hover:bg-emerald-50 hover:text-emerald-600' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
            </svg>
            <span class="font-semibold text-sm">Dashboard</span>
        </a>

        <a href="{{ route('dashboard.ai') }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all group {{ request()->routeIs('dashboard.ai') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'text-slate-500 hover:bg-emerald-50 hover:text-emerald-600' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('dashboard.ai') ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
            </svg>
            <span class="font-semibold text-sm">Fitrole AI</span>
        </a>

        <a href="{{ route('dashboard.meal.scan') }}"
        class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all group {{ request()->routeIs('dashboard.meal.scan') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-200' : 'text-slate-500 hover:bg-emerald-50 hover:text-emerald-600' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('dashboard.meal.scan') ? 'text-white' : 'text-slate-400 group-hover:text-emerald-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <span class="font-semibold text-sm">Meal Scanner</span>
        </a>
    </nav>

    <div class="p-4 mt-auto">
        <div class="bg-blue-50 rounded-2xl p-4 border border-blue-100">
            <p class="text-[11px] font-bold text-blue-600 uppercase mb-1">Reminder</p>
            <p class="text-xs text-blue-800 leading-relaxed">Jangan lupa minum air mineral 2L hari ini agar metabolisme lancar!</p>
        </div>
    </div>
</div>