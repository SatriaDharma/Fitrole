@extends('layouts.app')

@section('title', 'Fitrole - Meal Scanner AI')

@section('content')
<div class="max-w-7xl mx-auto flex flex-col px-4 lg:px-0 pb-10" x-data="{ scanning: false, imageUrl: null }">
    
    <div class="mb-6 px-1 flex-shrink-0">
        <div class="flex items-center gap-4 mb-2">
            <div class="p-3 bg-emerald-100 rounded-2xl shadow-sm">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <h1 class="text-2xl lg:text-3xl font-black text-slate-800 tracking-tight leading-none">Meal Scanner</h1>
                <p class="text-slate-500 font-medium italic mt-1 text-xs lg:text-sm">Ambil foto makananmu, biar AI yang menghitung kalorinya.</p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-8 items-stretch flex-1 min-h-0 pb-10 lg:pb-0">
        
        <div class="flex flex-col h-[400px] lg:h-full">
            <section class="bg-white rounded-[2rem] lg:rounded-[2.5rem] p-3 lg:p-4 shadow-sm border border-slate-100 relative overflow-y-auto group flex-1 flex flex-col">
                <form action="{{ route('dashboard.meal.upload') }}" method="POST" enctype="multipart/form-data" id="mealForm" @submit="scanning = true" class="flex-1 flex flex-col">
                    @csrf
                    <label class="relative flex-1 block w-full rounded-[1.5rem] lg:rounded-[2rem] overflow-hidden cursor-pointer bg-slate-50 group-hover:bg-slate-100 transition-all border-2 border-dashed border-slate-200 group-hover:border-emerald-300">
                        
                        <template x-if="imageUrl">
                            <img :src="imageUrl" class="absolute inset-0 w-full h-full object-cover animate-fade-in">
                        </template>

                        <div x-show="!scanning && !imageUrl" class="flex flex-col items-center justify-center h-full space-y-4 p-4">
                            <div class="w-14 h-14 lg:w-16 lg:h-16 bg-white rounded-2xl lg:rounded-3xl shadow-md flex items-center justify-center group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-6 h-6 lg:w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </div>
                            <div class="text-center">
                                <p class="text-slate-800 font-black tracking-tight text-sm lg:text-base">Ketuk Untuk Memindai</p>
                                <p class="text-slate-400 text-[10px] font-medium uppercase tracking-widest">Max 2MB • JPG, PNG</p>
                            </div>
                        </div>

                        <div x-show="scanning" x-cloak 
                            class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm z-50 flex flex-col items-center justify-center">
                            <div class="absolute inset-x-0 h-1 bg-emerald-400 shadow-[0_0_20px_rgba(52,211,153,1)] z-10 animate-scan-line"></div>
                            
                            <div class="relative mb-6">
                                <div class="w-16 h-16 lg:w-20 lg:h-20 border-4 border-emerald-500/20 border-t-emerald-500 rounded-full animate-spin"></div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <svg class="w-6 h-6 lg:w-8 h-8 text-emerald-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>
                            <h3 class="text-white font-black tracking-[0.2em] uppercase text-[10px] animate-pulse">Scanning...</h3>
                        </div>

                        <input type="file" name="meal_image" class="hidden" accept="image/*" 
                            @change="
                                const file = $event.target.files[0];
                                if (file) {
                                    imageUrl = URL.createObjectURL(file);
                                    scanning = true;
                                    setTimeout(() => { document.getElementById('mealForm').submit(); }, 2000);
                                }
                            ">
                    </label>
                </form>
            </section>
        </div>

        <div class="flex flex-col h-full">
            @if(session('new_scan_id'))
                @php $scan = auth()->user()->mealScans()->find(session('new_scan_id')); @endphp
                <div class="bg-white rounded-[2rem] lg:rounded-[2.5rem] p-6 lg:p-8 shadow-xl border border-emerald-50 animate-fade-in-up flex-1 flex flex-col overflow-hidden">
                    
                    <div class="flex items-center gap-4 mb-6 flex-shrink-0">
                        <div class="w-16 h-16 lg:w-20 lg:h-20 rounded-xl lg:rounded-2xl overflow-hidden shadow-inner border-2 border-slate-50 flex-shrink-0">
                            <img src="{{ asset('storage/' . $scan->image_path) }}" class="w-full h-full object-cover">
                        </div>
                        <div class="min-w-0">
                            <span class="text-[9px] font-bold text-emerald-500 uppercase tracking-widest bg-emerald-50 px-2 py-1 rounded-md">Analisis Berhasil</span>
                            <h2 class="text-xl lg:text-2xl font-black text-slate-800 leading-tight mt-1 truncate">{{ $scan->food_name }}</h2>
                        </div>
                    </div>

                    <div class="flex-1 overflow-y-auto min-h-0 mb-6 pr-2 custom-scrollbar text-slate-500 text-sm italic leading-relaxed">
                        "{{ $scan->message }}"
                    </div>

                    <div class="grid grid-cols-2 gap-3 flex-shrink-0">
                        <div class="bg-orange-50 p-3 lg:p-4 rounded-2xl lg:rounded-3xl border border-orange-100/50">
                            <span class="block text-[8px] lg:text-[9px] font-bold text-orange-400 uppercase tracking-tighter mb-1 leading-none">Energi</span>
                            <span class="text-lg lg:text-xl font-black text-orange-700 leading-none">{{ round($scan->calories) }} <small class="text-[10px] font-bold">kcal</small></span>
                        </div>
                        <div class="bg-green-50 p-3 lg:p-4 rounded-2xl lg:rounded-3xl border border-green-100/50">
                            <span class="block text-[8px] lg:text-[9px] font-bold text-green-400 uppercase tracking-tighter mb-1 leading-none">Protein</span>
                            <span class="text-lg lg:text-xl font-black text-green-700 leading-none">{{ round($scan->protein) }} <small class="text-[10px] font-bold">g</small></span>
                        </div>
                        <div class="bg-purple-50 p-3 lg:p-4 rounded-2xl lg:rounded-3xl border border-purple-100/50">
                            <span class="block text-[8px] lg:text-[9px] font-bold text-purple-400 uppercase tracking-tighter mb-1 leading-none">Karbo</span>
                            <span class="text-lg lg:text-xl font-black text-purple-700 leading-none">{{ round($scan->carbs) }} <small class="text-[10px] font-bold">g</small></span>
                        </div>
                        <div class="bg-emerald-50 p-3 lg:p-4 rounded-2xl lg:rounded-3xl border border-emerald-100/50">
                            <span class="block text-[8px] lg:text-[9px] font-bold text-emerald-400 uppercase tracking-tighter mb-1 leading-none">Lemak</span>
                            <span class="text-lg lg:text-xl font-black text-emerald-700 leading-none">{{ round($scan->fat) }} <small class="text-[10px] font-bold">g</small></span>
                        </div>
                    </div>

                    <button onclick="window.location.reload()" class="w-full mt-6 py-4 bg-slate-900 text-white rounded-xl lg:rounded-2xl font-bold text-sm hover:bg-emerald-600 transition-colors shadow-lg flex-shrink-0">
                        Scan Makanan Lainnya
                    </button>
                </div>
            @else
                <div class="flex-1 min-h-[250px] flex flex-col items-center justify-center p-8 lg:p-12 text-center border-2 border-dashed border-slate-100 rounded-[2rem] lg:rounded-[2.5rem] bg-slate-50/30">
                    <div class="w-12 h-12 lg:w-16 lg:h-16 bg-white rounded-full flex items-center justify-center mb-4 shadow-sm">
                        <svg class="w-6 h-6 lg:w-8 h-8 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2" stroke-width="2" />
                        </svg>
                    </div>
                    <p class="text-slate-400 text-xs lg:text-sm font-medium">Belum ada analisis.<br>Unggah foto untuk melihat nutrisi.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 10px; }

    @keyframes scan-line {
        0% { top: 0%; opacity: 0; }
        20% { opacity: 1; }
        80% { opacity: 1; }
        100% { top: 100%; opacity: 0; }
    }
    .animate-scan-line { animation: scan-line 2.5s infinite ease-in-out; }
    .animate-fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
    .animate-fade-in { animation: fadeIn 0.4s ease-in forwards; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    [x-cloak] { display: none !important; }
</style>
@endsection