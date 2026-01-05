@extends('layouts.auth')

@section('title', 'Fitrole - Lupa Password')

@section('content')
<div class="text-center mb-8">
    <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-50 rounded-full mb-4">
        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
    </div>
    
    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">
        Lupa Kata Sandi?
    </h2>
    <p class="text-sm text-slate-500 mt-2 leading-relaxed px-4">
        Jangan khawatir, kami akan mengirimkan instruksi pemulihan ke email Anda.
    </p>
</div>

@if (session('status'))
    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-start gap-3 animate-pulse">
        <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-sm font-medium text-emerald-800 tracking-tight leading-snug">
            {{ session('status') }}
        </span>
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}" class="space-y-6">
    @csrf

    <div class="group">
        <label for="email" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">
            Alamat Email
        </label>
        <div class="relative transition-all duration-300">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-slate-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                </svg>
            </div>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                placeholder="nama@email.com"
                class="block w-full pl-11 pr-4 py-3 bg-stone-50 border border-stone-200 text-slate-900 text-sm rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all placeholder:text-slate-300">
        </div>
        
        @error('email')
            <p class="text-xs text-red-500 mt-2 ml-1 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    <button type="submit"
        class="w-full py-3.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-2xl shadow-lg shadow-emerald-200 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
        <span>Kirim Link Pemulihan</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
        </svg>
    </button>
</form>

<div class="mt-8 pt-6 border-t border-stone-100 text-center">
    <a href="{{ route('login') }}" class="group inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-emerald-600 transition-colors">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
        Kembali ke halaman Masuk
    </a>
</div>
@endsection