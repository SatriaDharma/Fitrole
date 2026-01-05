@extends('layouts.auth')

@section('title', 'Fitrole - Onboarding Langkah 3')

@section('content')
@php($currentStep = 3)

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-50 to-white px-4 py-10">
    <div class="w-full max-w-xl bg-white rounded-3xl shadow-xl p-8 md:p-10 border border-green-100">

        @include('onboarding._stepper',['currentStep'=>$currentStep])

        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Aktivitas Harian</h1>
            <p class="text-gray-500">Seberapa aktif kamu dalam seminggu?</p>
        </div>

        <form method="POST" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tingkat Aktivitas</label>
                <select name="activity_level" required
                    class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 py-3">
                    <option value="">Pilih Tingkat Aktivitas</option>
                    <option value="sedentary">Tidak olahraga sama sekali (Sedentary)</option>
                    <option value="light">Olahraga ringan 1-3x seminggu</option>
                    <option value="moderate">Olahraga sedang 4-5x seminggu</option>
                    <option value="active">Olahraga berat setiap hari</option>
                    <option value="very_active">Olahraga sangat intens / Atlet</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Pekerjaan</label>
                <input type="text" name="job" placeholder="Contoh: Karyawan Swasta" required
                    class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 py-3">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Olahraga Favorit</label>
                <input type="text" name="exercise_preference" placeholder="Contoh: Berenang, Lari" required
                    class="w-full rounded-xl border-gray-300 focus:border-green-500 focus:ring-green-500 py-3">
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
                    <p class="text-xs text-gray-400 font-medium">Langkah 3 dari 4</p>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection