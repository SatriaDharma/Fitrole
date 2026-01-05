@php
$steps = [
    1 => 'Profil',
    2 => 'Fisik',
    3 => 'Gaya Hidup',
    4 => 'Goal'
];
@endphp

<div class="flex items-center justify-between mb-12 relative px-2">
    <div class="absolute top-4 left-0 w-full h-[2px] bg-slate-100 -z-0"></div>

    @foreach($steps as $num => $label)
        <div class="relative z-10 flex flex-col items-center">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-500 border-2
                {{ $currentStep >= $num 
                    ? 'bg-emerald-600 border-emerald-600 text-white shadow-lg shadow-emerald-200' 
                    : 'bg-white border-slate-200 text-slate-400' }}">
                @if($currentStep > $num)
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                @else
                    <span class="text-sm font-bold">{{ $num }}</span>
                @endif
            </div>
            <p class="absolute -bottom-7 whitespace-nowrap text-[10px] font-bold uppercase tracking-wider
                {{ $currentStep >= $num ? 'text-emerald-700' : 'text-slate-400' }}">
                {{ $label }}
            </p>
        </div>

        @if(!$loop->last)
            <div class="flex-1 h-[2px] transition-all duration-700
                {{ $currentStep > $num ? 'bg-emerald-600' : 'bg-transparent' }}"></div>
        @endif
    @endforeach
</div>