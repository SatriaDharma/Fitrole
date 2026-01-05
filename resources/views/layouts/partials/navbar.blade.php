<nav class="w-full px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
        
        <div class="flex items-center gap-4">
            <button type="button" 
                @click="mobileMenuOpen = true" 
                class="lg:hidden p-2 rounded-xl text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition-all">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>

            <div class="lg:hidden flex items-center gap-2">
                <div class="flex items-center gap-3">
                    <span class="text-2xl font-black tracking-tighter text-slate-800">Fitrole<span class="text-emerald-600">.</span></span>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <div class="hidden sm:flex flex-col items-end mr-2">
                <span class="text-xs text-slate-400 font-medium">Selamat datang,</span>
                <span class="text-sm font-semibold text-slate-700">{{ auth()->user()->name }}</span>
            </div>

            <div class="relative" @click.away="userMenuOpen = false">
                <button type="button" 
                    @click="userMenuOpen = !userMenuOpen"
                    class="group relative w-10 h-10 rounded-xl bg-emerald-100 border-2 border-emerald-50 flex items-center justify-center transition-all hover:border-emerald-200 focus:outline-none">
                    <span class="text-emerald-700 font-bold pointer-events-none">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </span>
                    <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full"></span>
                </button>

                <div x-show="userMenuOpen" 
                    x-cloak
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-3 w-52 bg-white border border-stone-100 rounded-2xl shadow-xl shadow-slate-200/50 py-2 z-[9999] overflow-hidden">
                    
                    <a href="{{ route('profile.edit') }}" 
                       class="flex items-center gap-3 px-4 py-3 text-sm text-slate-600 hover:bg-emerald-50 hover:text-emerald-700 transition-colors">
                        <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span>Edit Profil</span>
                    </a>

                    <hr class="my-1 border-stone-50">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                            class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50 transition-colors">
                            <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <span class="font-medium">Keluar / Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>