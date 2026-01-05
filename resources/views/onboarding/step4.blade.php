@extends('layouts.auth')

@section('title', 'Fitrole - Onboarding Langkah 4')

@section('content')
@php($currentStep = 4)

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-white px-4 py-10">
    <div class="w-full max-w-xl bg-white rounded-3xl shadow-xl p-8 md:p-10 border border-green-100">

        @include('onboarding._stepper',['currentStep'=>$currentStep])

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Target Kamu</h1>
            <p class="text-gray-500">Langkah terakhir untuk mempersonalisasi programmu</p>
        </div>

        <form method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Program yang Diinginkan</label>
                <select name="target_program" required
                    class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 py-4 text-gray-700">
                    <option value="">Pilih Target</option>
                    <option value="fat_loss">Turun Berat Badan (Fat Loss)</option>
                    <option value="muscle_gain">Naik Massa Otot (Muscle Gain)</option>
                    <option value="maintain">Menjaga Berat Badan (Maintain)</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Target Berat Badan (kg)</label>
                <div class="relative">
                    <input type="number" step="0.1" name="target_weight" placeholder="Contoh: 60.0" required
                        class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 py-4 pr-12 text-lg font-medium">
                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                        <span class="text-gray-400 font-bold uppercase text-xs">kg</span>
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white py-4 rounded-xl font-bold shadow-lg shadow-green-100 transition-all flex items-center justify-center gap-2">
                    Lanjut
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="flex justify-between items-center mt-4">
                    <button type="button" onclick="window.history.back()" class="text-sm font-semibold text-gray-400 hover:text-green-600 transition-colors">← Kembali</button>
                    <p class="text-xs text-gray-400 font-medium">Langkah 4 dari 4</p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection