@extends('layouts.auth')

@section('title', 'Fitrole - Onboarding Langkah 2')

@section('content')
@php($currentStep = 2)

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-white px-4 py-10">
    <div class="w-full max-w-xl bg-white rounded-3xl shadow-xl p-8 md:p-10 border border-green-100">

        @include('onboarding._stepper',['currentStep'=>$currentStep])

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Data Tubuh</h1>
            <p class="text-gray-500">Digunakan untuk kalkulasi BMI & kalori harianmu</p>
        </div>

        <form method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tinggi Badan (cm)</label>
                <input type="number" name="height_cm" placeholder="Contoh: 170" required
                    class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 py-3">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Berat Badan (kg)</label>
                <input type="number" step="0.1" name="weight_kg" placeholder="Contoh: 65.5" required
                    class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 py-3">
            </div>

            <div class="grid grid-cols-2 gap-4 pt-2">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Lingkar Pinggang</label>
                    <input type="number" name="waist_cm" placeholder="cm (Opsional)"
                        class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 py-3">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Lingkar Leher</label>
                    <input type="number" name="neck_cm" placeholder="cm (Opsional)"
                        class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 py-3">
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
                    <p class="text-xs text-gray-400 font-medium">Langkah 2 dari 4</p>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection