@extends('layouts.app')

@section('title', 'Fitrole - Dashboard Progres')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[10px] font-black uppercase tracking-widest mb-3 border border-emerald-100">
                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                System Live
            </div>
            <h1 class="text-4xl font-black text-slate-900 tracking-tight">
                Ringkasan <span class="text-emerald-600">Performa.</span>
            </h1>
            <p class="text-slate-500 mt-2 font-medium italic">
                "Disiplin adalah jembatan antara target dan pencapaian."
            </p>
        </div>

        @php 
            $todayFilled = $todayEntry ?? false; 
            $isEndOfMonth = now()->isLastOfMonth();
        @endphp

        <button 
            @if($todayFilled) 
                disabled 
                class="group bg-slate-100 text-slate-400 py-4 px-8 rounded-2xl font-bold border border-slate-200 cursor-not-allowed"
            @else
                onclick="document.getElementById('dailyModal').classList.remove('hidden')"
                class="group bg-slate-900 hover:bg-emerald-600 text-white py-4 px-8 rounded-2xl font-bold shadow-2xl shadow-slate-200 hover:shadow-emerald-200 transform hover:-translate-y-1 transition-all active:scale-95"
            @endif
        >
            <div class="flex items-center justify-center gap-3">
                @if($todayFilled)
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                    <span>Laporan Selesai</span>
                @else
                    <svg class="h-5 w-5 text-emerald-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
                    <span>Update Berat Badan</span>
                @endif
            </div>
        </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-slate-900 rounded-[2.5rem] p-8 relative overflow-hidden group shadow-2xl shadow-slate-200">
            <div class="absolute -right-10 -bottom-10 opacity-10 transform group-hover:scale-110 group-hover:-rotate-12 transition-all duration-700">
                <svg class="h-64 w-64 text-emerald-400" fill="currentColor" viewBox="0 0 24 24"><path d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.5-7 3 3 3 6 3 6s3.5-1 3.5-6c1 4 2 11-2.5 15z" /></svg>
            </div>
            <div class="relative z-10">
                <p class="text-emerald-400 font-black uppercase tracking-[0.2em] text-[10px] mb-4">Current Streak</p>
                <h3 class="text-6xl font-black text-white leading-none">{{ $streak }} <span class="text-2xl font-light text-slate-400">Hari</span></h3>
                <p class="text-slate-400 mt-6 text-sm font-medium">🔥 Pertahankan konsistensimu!</p>
            </div>
        </div>

        <div class="lg:col-span-2 bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm relative">
            <div class="flex items-center justify-between mb-8">
                <p class="text-slate-400 font-black uppercase tracking-[0.2em] text-[10px]">Perjalanan Target</p>
                <span class="px-4 py-1 rounded-full bg-emerald-50 text-emerald-600 text-xs font-bold border border-emerald-100 italic">Target: {{ ucfirst($profile->target_program) }}</span>
            </div>

            @php
                $initial = $profile->weight_kg;
                $current = $progress->last()?->weight_kg ?? $initial;
                $target = $profile->target_weight;
                $diff = abs($initial - $target);
                $done = abs($initial - $current);
                $percent = $diff != 0 ? min(max(($done / $diff) * 100, 0), 100) : 0;
            @endphp

            <div class="grid grid-cols-3 gap-8 mb-10">
                <div>
                    <p class="text-[10px] font-bold text-slate-300 uppercase mb-1">Awal</p>
                    <p class="text-2xl font-black text-slate-700">{{ $initial }}<span class="text-xs ml-1 text-slate-400">kg</span></p>
                </div>
                <div class="border-x border-slate-50 px-8">
                    <p class="text-[10px] font-bold text-slate-300 uppercase mb-1">Sekarang</p>
                    <p class="text-2xl font-black text-emerald-600">{{ $current }}<span class="text-xs ml-1 text-emerald-400">kg</span></p>
                </div>
                <div class="text-right">
                    <p class="text-[10px] font-bold text-slate-300 uppercase mb-1">Target</p>
                    <p class="text-2xl font-black text-slate-700">{{ $target }}<span class="text-xs ml-1 text-slate-400">kg</span></p>
                </div>
            </div>

            <div class="relative h-4 bg-slate-50 rounded-full overflow-hidden border border-slate-100">
                <div class="absolute inset-0 bg-emerald-500 transition-all duration-1000 ease-out shadow-[0_0_20px_rgba(16,185,129,0.4)]" style="width: {{ $percent }}%"></div>
            </div>
            <p class="mt-4 text-center text-xs font-bold text-slate-400 tracking-widest uppercase">{{ round($percent) }}% Menuju Body Goals</p>
        </div>
    </div>

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @php
            $bmi = $profile->bmi;
            if ($bmi < 18.5) { $bmiStatus = 'Underweight'; $bmiColor = 'text-amber-500'; }
            elseif ($bmi < 23) { $bmiStatus = 'Ideal'; $bmiColor = 'text-emerald-500'; } // Standar Asia lebih ketat (23)
            elseif ($bmi < 25) { $bmiStatus = 'Normal Risk'; $bmiColor = 'text-orange-400'; }
            elseif ($bmi < 30) { $bmiStatus = 'Overweight'; $bmiColor = 'text-orange-600'; }
            else { $bmiStatus = 'Obese'; $bmiColor = 'text-rose-600'; }

            $bf = $profile->body_fat;
            if ($bf <= 13) { $bfStatus = 'Athletic'; $bfColor = 'text-cyan-500'; }
            elseif ($bf <= 17) { $bfStatus = 'Fitness'; $bfColor = 'text-emerald-500'; }
            elseif ($bf <= 24) { $bfStatus = 'Average'; $bfColor = 'text-green-400'; }
            elseif ($bf <= 30) { $bfStatus = 'Fat'; $bfColor = 'text-orange-300'; }
            else { $bfStatus = 'Obese'; $bfColor = 'text-rose-600'; }
        @endphp

        @foreach ([ 
            ['label'=>'BMI Status','value'=>$bmi, 'icon' => '⚖️', 'sub' => $bmiStatus, 'subColor' => $bmiColor],
            ['label'=>'Kadar Lemak','value'=>$bf.'%', 'icon' => '💧', 'sub' => $bfStatus, 'subColor' => $bfColor],
            ['label'=>'Daily Intake','value'=>$profile->daily_calories, 'unit' => 'kcal', 'icon' => '⚡', 'sub' => 'Target', 'subColor' => 'text-emerald-500'],
            ['label'=>'Water Goal','value'=>'2.5', 'unit' => 'Liters', 'icon' => '🥤', 'sub' => 'Daily', 'subColor' => 'text-emerald-500']
        ] as $item)
        <div class="bg-white rounded-[2rem] p-6 border border-slate-100 hover:border-emerald-200 hover:shadow-xl hover:shadow-emerald-900/5 transition-all group">
            <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-xl mb-6 group-hover:scale-110 transition-transform">{{ $item['icon'] }}</div>
            <p class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-1">{{ $item['label'] }}</p>
            <h4 class="text-2xl font-black text-slate-800">{{ $item['value'] }}<span class="text-[10px] ml-1 text-slate-400">{{ $item['unit'] ?? '' }}</span></h4>
            <p class="text-[10px] font-bold {{ $item['subColor'] }} mt-2 uppercase tracking-tighter">{{ $item['sub'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-lg font-black text-slate-800 tracking-tight">Kebutuhan Makro</h3>
                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Estimasi / Hari</span>
            </div>
            
            <div class="grid grid-cols-1 gap-4">
                @if($profile->daily_macros)
                    @foreach($profile->daily_macros as $macro => $value)
                    @php 
                        $config = [
                            'protein' => ['color' => 'blue', 'label' => 'Protein', 'desc' => 'Otot & Sel'],
                            'carbs'   => ['color' => 'orange', 'label' => 'Karbohidrat', 'desc' => 'Energi Utama'],
                            'fat'     => ['color' => 'rose', 'label' => 'Lemak', 'desc' => 'Hormon & Otak']
                        ][strtolower($macro)] ?? ['color' => 'emerald', 'label' => $macro, 'desc' => 'Nutrisi'];
                    @endphp
                    <div class="group p-4 rounded-3xl bg-{{ $config['color'] }}-50/30 border border-{{ $config['color'] }}-100/50 hover:bg-{{ $config['color'] }}-50 transition-colors">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-white shadow-sm flex items-center justify-center font-bold text-{{ $config['color'] }}-500 text-xs">
                                {{ strtoupper(substr($macro, 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-1">
                                    <span class="text-xs font-black text-slate-700 uppercase tracking-tight">{{ $config['label'] }}</span>
                                    <span class="text-sm font-black text-{{ $config['color'] }}-600">{{ $value }}<span class="text-[10px] ml-0.5">g</span></span>
                                </div>
                                <div class="h-1.5 w-full bg-white rounded-full overflow-hidden border border-{{ $config['color'] }}-100/30">
                                    <div class="h-full bg-{{ $config['color'] }}-500 rounded-full" style="width: 100%"></div>
                                </div>
                                <p class="text-[9px] font-bold text-{{ $config['color'] }}-400 mt-2 uppercase tracking-widest">{{ $config['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="flex flex-col items-center py-10 opacity-50">
                        <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                        <p class="text-slate-400 text-xs italic">Data nutrisi belum tersedia.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="lg:col-span-2 bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-lg font-black text-slate-800 tracking-tight italic">Analisis Berat Badan</h3>
                <div class="px-3 py-1 bg-slate-50 rounded-lg text-[10px] font-bold text-slate-400 uppercase">7 Hari Terakhir</div>
            </div>
            <div class="h-64">
                <canvas id="progressChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div id="dailyModal" class="hidden fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[100] flex items-center justify-center transition-all">
    <div class="bg-white rounded-[2.5rem] p-8 max-w-md w-full mx-4 shadow-2xl transform transition-all">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-black text-slate-800 tracking-tight">Update <span class="text-emerald-600">Progress.</span></h3>
            <button onclick="document.getElementById('dailyModal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <form action="{{ route('dashboard.daily.store') }}" method="POST">
            @csrf
            <div class="space-y-5">
                {{-- Berat Badan (Required Every Day) --}}
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Berat Badan Hari Ini (kg)</label>
                    <input type="number" step="0.1" name="weight_kg" placeholder="{{ $current }}" required
                           class="w-full bg-slate-50 border-2 border-slate-50 focus:border-emerald-500 focus:bg-white rounded-2xl p-4 transition-all outline-none font-bold text-slate-700">
                </div>

                @if($isEndOfMonth)
                <div class="p-5 bg-emerald-50 rounded-3xl border border-emerald-100">
                    <p class="text-xs font-bold text-emerald-700 mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z"/></svg>
                        Laporan Lingkar Tubuh (Akhir Bulan)
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black text-emerald-600/60 uppercase mb-2">Pinggang (cm)</label>
                            <input type="number" name="waist_cm" required
                                   class="w-full bg-white border-none rounded-xl p-3 focus:ring-2 focus:ring-emerald-500 font-bold">
                        </div>
                        <div>
                            <label class="block text-[10px] font-black text-emerald-600/60 uppercase mb-2">Leher (cm)</label>
                            <input type="number" name="neck_cm" required
                                   class="w-full bg-white border-none rounded-xl p-3 focus:ring-2 focus:ring-emerald-500 font-bold">
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <button type="submit" class="w-full mt-8 bg-emerald-600 hover:bg-emerald-700 text-white py-4 rounded-2xl font-black shadow-xl shadow-emerald-100 transform active:scale-95 transition-all tracking-widest uppercase text-xs">
                Simpan Progress
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('progressChart').getContext('2d');

    const initialWeight = {{ $profile->weight_kg }};
    const initialDate = "{{ \Carbon\Carbon::parse($profile->created_at)->format('d M') }}";
    
    const logs = {!! json_encode($weights) !!};

    let labels = [initialDate];
    let dataPoints = [initialWeight];

    logs.forEach(log => {
        if (log.date !== initialDate) {
            labels.push(log.date);
            dataPoints.push(log.weight_kg);
        }
    });

    if (dataPoints.length === 1) {
        labels.push("Progres"); 
        dataPoints.push(initialWeight); 
    }

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Berat Badan (kg)',
                data: dataPoints,
                borderColor: '#10b981',
                backgroundColor: 'rgba(16, 185, 129, 0.1)',
                borderWidth: 4,
                fill: true,
                tension: 0, 
                pointBackgroundColor: '#ffffff',
                pointBorderColor: '#10b981',
                pointBorderWidth: 2,
                pointRadius: (context) => {
                    if (logs.length === 0 && context.dataIndex === 1) return 0;
                    return 5;
                },
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    filter: function (tooltipItem) {
                        return tooltipItem.label !== "Progres";
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    grace: '10%', 
                    grid: { color: 'rgba(226, 232, 240, 0.5)' },
                    ticks: {
                        font: { weight: 'bold' },
                        callback: (val) => val + ' kg'
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { 
                        font: { weight: 'bold' },
                        callback: function(value, index) {
                            return this.getLabelForValue(value) === "Progres" ? "" : this.getLabelForValue(value);
                        }
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection