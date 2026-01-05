@extends('layouts.auth')

@section('title', 'Fitrole - Onboarding Langkah 1')

@section('content')
@php($currentStep = 1)

<div class="min-h-screen flex items-center justify-center bg-[#FBFCF4] px-4 py-12">
    <div class="w-full max-w-lg bg-white rounded-[2.5rem] shadow-xl shadow-emerald-900/5 p-8 md:p-12 border border-emerald-50/50">

        @include('onboarding._stepper', ['currentStep' => $currentStep])

        <div class="text-center mb-10">
            <h1 class="text-3xl font-black text-slate-800 tracking-tight mb-2">
                Halo, Siapa Kamu?
            </h1>
            <p class="text-slate-500 font-medium">
                Data ini membantu AI kami menghitung metabolisme tubuhmu secara akurat.
            </p>
        </div>

        <form method="POST" class="space-y-8" x-data="{ gender: '' }">
            @csrf

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-4 ml-1 italic text-center md:text-left">Jenis Kelamin</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="relative cursor-pointer group">
                        <input type="radio" name="gender" value="male" class="sr-only peer" x-model="gender">
                        <div class="p-6 rounded-3xl border-2 border-slate-100 bg-slate-50 transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:ring-4 peer-checked:ring-emerald-500/10 group-hover:bg-white flex flex-col items-center">
                            <span class="text-3xl mb-2">👦</span>
                            <span class="font-bold text-slate-600 peer-checked:text-emerald-700">Pria</span>
                        </div>
                    </label>

                    <label class="relative cursor-pointer group">
                        <input type="radio" name="gender" value="female" class="sr-only peer" x-model="gender">
                        <div class="p-6 rounded-3xl border-2 border-slate-100 bg-slate-50 transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:ring-4 peer-checked:ring-emerald-500/10 group-hover:bg-white flex flex-col items-center">
                            <span class="text-3xl mb-2">👧</span>
                            <span class="font-bold text-slate-600 peer-checked:text-emerald-700">Wanita</span>
                        </div>
                    </label>
                </div>
            </div>

            <div>
                <x-input-label for="birth_date" value="Kapan kamu lahir?" class="text-center md:text-left" />
                <x-text-input 
                    type="date" 
                    name="birth_date" 
                    id="birth_date"
                    required
                    class="mt-1 text-center font-bold tracking-widest text-slate-600"
                />
            </div>

            <div class="pt-4 text-center">
                <x-primary-button class="w-full py-4 text-base shadow-lg shadow-emerald-200">
                    Lanjut Ke Fisik 
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </x-primary-button>
                <p class="mt-4 text-xs text-slate-400 font-medium">Langkah 1 dari 4</p>
            </div>

        </form>
    </div>
</div>
@endsection