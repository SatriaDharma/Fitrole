<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta property="og:site_name" content="Fitrole">
    <meta property="og:type" content="website">

    @if(View::hasSection('meta'))
        @yield('meta')
    @else
        <meta property="og:title" content="Fitrole - Dashboard">
        <meta property="og:image" content="{{ asset('images/default-fitrole-share.jpg') }}">
    @endif

    <title>Fitrole - Mulai Perjalanan Sehatmu</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFBF7; }
        [x-cloak] { display: none !important; }
        
        .badge-glow {
            filter: drop-shadow(0 0 15px rgba(16, 185, 129, 0.6));
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px) rotate(12deg); }
            50% { transform: translateY(-5px) rotate(15deg); }
            100% { transform: translateY(0px) rotate(12deg); }
        }
    </style>
</head>

<body class="antialiased" x-data="{ mobileMenuOpen: false, userMenuOpen: false }">
    <div class="flex min-h-screen">
        
        <aside class="hidden lg:flex w-64 flex-col fixed inset-y-0 border-r bg-white z-50">
            @include('layouts.partials.sidebar')
        </aside>

        <div class="fixed inset-0 z-[60] lg:hidden" x-show="mobileMenuOpen" x-cloak>
            <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="mobileMenuOpen = false"></div>
            <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-xl">
                @include('layouts.partials.sidebar')
            </div>
        </div>

        <div class="flex flex-col flex-1 lg:pl-64">
            <header class="sticky top-0 z-40 flex h-16 bg-white/80 backdrop-blur-md border-b">
                @include('layouts.partials.navbar')
            </header>

            <main class="flex-1 p-6 lg:p-10 relative">
                <div class="relative z-10">

                    @if(session('new_badges'))
                    <div class="fixed top-24 lg:top-10 inset-x-0 z-[100] flex flex-col items-center gap-3 px-4 pointer-events-none">
                        @foreach(session('new_badges') as $index => $badge)
                        <div 
                            x-data="{ show: true }" 
                            x-show="show" 
                            x-init="setTimeout(() => show = false, {{ 8000 + ($index * 1000) }})"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0 transform -translate-y-10 scale-95"
                            x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90"
                            class="bg-slate-900 border-b-4 border-emerald-500 text-white px-5 py-4 rounded-[2rem] shadow-2xl flex items-center gap-4 pointer-events-auto max-w-sm lg:max-w-md w-full relative overflow-hidden"
                        >
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500/10 via-transparent to-transparent animate-pulse"></div>
                            
                            <div class="relative flex-shrink-0">
                                <div class="w-14 h-14 bg-white/10 backdrop-blur-md rounded-2xl rotate-6 flex items-center justify-center border border-white/20">
                                    @if($badge['image'])
                                        <img src="{{ asset('img/badges/' . $badge['image']) }}" class="w-10 h-10 object-contain -rotate-6">
                                    @else
                                        <span class="text-2xl -rotate-6">🏆</span>
                                    @endif
                                </div>
                            </div>

                            <div class="relative flex-1">
                                <h4 class="text-[9px] font-black uppercase tracking-[0.2em] text-emerald-400 mb-0.5">Achievement Unlocked!</h4>
                                <p class="text-xs font-medium text-slate-400 leading-tight italic">{{ $badge['name'] }}</p>
                                <p class="text-lg font-black text-white tracking-tight leading-none uppercase">Badge Didapatkan</p>
                            </div>

                            <button @click="show = false" class="relative text-slate-500 hover:text-white p-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                            </button>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>