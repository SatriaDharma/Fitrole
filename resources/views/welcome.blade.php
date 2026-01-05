<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitrole - Mulai Perjalanan Sehatmu</title>

    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo-fitrole.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo-fitrole.png') }}">

    @vite(['resources/css/app.css'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); }
        .text-gradient { @apply bg-clip-text text-transparent bg-gradient-to-r from-emerald-600 to-teal-500; }
    </style>
</head>

<body class="bg-[#FBFCF4] text-slate-900 overflow-x-hidden selection:bg-emerald-100 selection:text-emerald-900">

<nav class="fixed top-0 w-full z-50 glass border-b border-slate-100/50">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <span class="text-2xl font-black tracking-tighter text-slate-800">Fitrole<span class="text-emerald-600">.</span></span>
        </div>

        <div class="flex items-center gap-4">
            @auth
                <a href="{{ route('dashboard') }}" class="px-6 py-3 rounded-2xl bg-slate-900 text-white text-sm font-bold hover:bg-slate-800 transition shadow-xl shadow-slate-200 active:scale-95">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="hidden sm:block px-4 py-2 text-sm font-bold text-slate-600 hover:text-emerald-600 transition">Login</a>
                <a href="{{ route('register') }}" class="px-6 py-3 rounded-2xl bg-emerald-600 text-white text-sm font-bold hover:bg-emerald-700 transition shadow-xl shadow-emerald-200 active:scale-95">Mulai Gratis</a>
            @endauth
        </div>
    </div>
</nav>

<section class="relative pt-40 pb-24 px-6 overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-10">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-emerald-100 rounded-full blur-[120px] opacity-60"></div>
        <div class="absolute bottom-[10%] right-[-5%] w-[30%] h-[30%] bg-blue-100 rounded-full blur-[100px] opacity-40"></div>
    </div>

    <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-16 items-center">
        <div class="z-10 text-center md:text-left">
            <div class="inline-flex items-center gap-3 px-4 py-1.5 rounded-full bg-emerald-50 border border-emerald-100 text-emerald-700 text-xs font-extrabold mb-8 animate-fade-in">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                </span>
                AI-POWERED DIET
            </div>
            
            <h1 class="text-5xl md:text-7xl font-black leading-relaxed mb-8 text-slate-900 tracking-tight">
                Kontrol Diet <br>
                <span class="text-gradient leading-snug">Jauh Lebih Konsisten.</span>
            </h1>

            <p class="text-lg text-slate-500 leading-relaxed mb-10 max-w-md mx-auto md:mx-0 font-medium">
                Lacak berat badan, nutrisi, dan kebiasaan sehatmu dalam satu aplikasi. Dilengkapi asisten AI dan pengingat harian.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                <a href="{{ route('register') }}" class="px-10 py-5 rounded-2xl bg-emerald-600 text-white font-extrabold text-center hover:bg-emerald-700 transition shadow-2xl shadow-emerald-200/50 active:scale-95">
                    Mulai Perjalananmu!
                </a>
                <a href="#features" class="px-10 py-5 rounded-2xl bg-white border-2 border-slate-100 text-slate-700 font-extrabold text-center hover:border-emerald-200 hover:bg-emerald-50/30 transition active:scale-95">
                    Lihat Fitur
                </a>
            </div>

            <div class="mt-12 flex items-center justify-center md:justify-start gap-4">
                <div class="flex -space-x-3">
                    @for($i=1; $i<=4; $i++)
                        <img class="w-10 h-10 rounded-full border-4 border-white shadow-sm" src="https://i.pravatar.cc/150?u={{$i}}" alt="User">
                    @endfor
                </div>
                <p class="text-sm font-bold text-slate-400">
                    <span class="text-slate-800">500+</span> Pejuang Sehat
                </p>
            </div>
        </div>

        <div class="relative group mt-10 md:mt-0">
            <div class="relative glass border-[8px] border-white/50 rounded-[3rem] p-3 shadow-[0_32px_64px_-16px_rgba(0,0,0,0.1)] transition-all duration-700 group-hover:scale-[1.02] group-hover:-rotate-1">
                <div class="bg-slate-900 rounded-[2.2rem] overflow-hidden aspect-[4/3] relative">
                    <img src="{{ asset('images/hero-image.png') }}" 
                         alt="Fitrole Dashboard" 
                         class="w-full h-full object-cover opacity-90">
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 to-transparent"></div>
                </div>
                
                <div class="absolute -bottom-10 -right-6 md:-right-12 bg-white p-6 rounded-[2rem] shadow-2xl border border-slate-100 animate-bounce-slow max-w-[200px]">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-12 h-12 bg-orange-100 rounded-2xl flex items-center justify-center text-orange-600 mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mb-1">Streak Hari Ini</p>
                        <p class="text-2xl font-black text-slate-800">12 Hari 🔥</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="features" class="py-32 bg-white">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <div class="mb-24">
            <h2 class="text-emerald-600 font-black text-sm uppercase tracking-[0.4em] mb-4">The Experience</h2>
            <p class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight">Semua yang kamu butuhkan <br>untuk <span class="text-emerald-600 underline decoration-emerald-100 decoration-8 underline-offset-8">Body Goals.</span></p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @php
                $features = [
                    ['title'=>'Interactive Dashboard', 'icon'=>'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 002 2h2a2 2 0 002-2', 'color'=>'emerald'],
                    ['title'=>'Smart Health Logs', 'icon'=>'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4', 'color'=>'blue'],
                    ['title'=>'Fitrole AI', 'icon'=>'M13 10V3L4 14h7v7l9-11h-7z', 'color'=>'amber']
                ];
            @endphp

            @foreach($features as $f)
                <div class="group p-10 rounded-[3rem] border-2 border-slate-50 hover:border-emerald-100 bg-white hover:bg-emerald-50/20 transition-all duration-500 text-left relative overflow-hidden">
                    <div class="w-14 h-14 rounded-2xl bg-{{$f['color']}}-100 text-{{$f['color']}}-600 flex items-center justify-center mb-8 group-hover:scale-110 transition-transform duration-500">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path d="{{$f['icon']}}" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800 mb-4">{{$f['title']}}</h3>
                    <p class="text-slate-500 leading-relaxed text-sm font-medium">Lacak nutrisi dan konsultasikan pola latihanmu dengan asisten digital tercanggih.</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-24 px-6">
    <div class="max-w-6xl mx-auto rounded-[4rem] bg-slate-900 p-12 md:p-24 text-center relative overflow-hidden shadow-2xl shadow-emerald-200">
        <div class="absolute top-0 left-0 w-full h-full bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-10"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-500/20 rounded-full blur-[100px]"></div>
        
        <h2 class="text-4xl md:text-6xl font-black text-white mb-8 relative z-10 leading-tight">
            Ubah Kebiasaan, <br><span class="text-emerald-400">Ubah Hidupmu.</span>
        </h2>
        
        <div class="relative z-10 flex flex-col sm:flex-row justify-center gap-6">
            <a href="{{ route('register') }}" class="px-12 py-5 mt-8 bg-emerald-500 text-slate-900 font-black rounded-2xl hover:bg-emerald-400 transition transform hover:-translate-y-1">
                Daftar Sekarang
            </a>
        </div>
    </div>
</section>

<footer class="py-16 text-center border-t border-slate-100">
    <p class="text-slate-400 text-sm font-medium">© {{ date('Y') }} Fitrole Smart Assistant. Crafted for Health.</p>
</footer>

<style>
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(2deg); }
    }
    .animate-bounce-slow { animation: bounce-slow 5s ease-in-out infinite; }
</style>

</body>
</html>