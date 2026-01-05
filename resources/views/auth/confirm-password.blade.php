@extends('layouts.auth')

@section('title', 'Fitrole - Konfirmasi Password')

@section('content')
<div class="text-center mb-8">
    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-50 rounded-full mb-4">
        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
        </svg>
    </div>
    
    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">
        Area Keamanan
    </h2>
    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
        Demi menjaga data progres diet Anda tetap aman, silakan masukkan kata sandi untuk melanjutkan.
    </p>
</div>

<form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
    @csrf

    <div class="group">
        <label for="password" class="block text-sm font-semibold text-slate-700 mb-2 ml-1">
            Kata Sandi
        </label>
        <div class="relative transition-all duration-300">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-slate-400 group-focus-within:text-emerald-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
            </div>
            <input id="password" type="password" name="password" required autofocus
                placeholder="••••••••"
                class="block w-full pl-11 pr-4 py-3 bg-stone-50 border border-stone-200 text-slate-900 text-sm rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all placeholder:text-slate-300">
        </div>
        
        @error('password')
            <p class="text-xs text-red-500 mt-2 ml-1 flex items-center gap-1">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    <button type="submit"
        class="group w-full relative flex justify-center py-3.5 px-4 border border-transparent text-sm font-bold rounded-2xl text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all shadow-lg shadow-emerald-200 active:scale-[0.98]">
        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
            <svg class="h-5 w-5 text-emerald-300 group-hover:text-emerald-200 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2C9.47 2 7.153 3.002 5.442 4.634c-1.53 1.487-2.6 3.384-2.833 5.49a11.946 11.946 0 004.287 9.417 11.973 11.973 0 0010.212 0 11.946 11.946 0 004.287-9.417c-.232-2.106-1.303-4.003-2.833-5.49z" />
            </svg>
        </span>
        Konfirmasi Akses
    </button>

    <div class="text-center">
        <a href="{{ route('dashboard') }}" class="text-xs font-medium text-slate-400 hover:text-emerald-600 transition-colors">
            Kembali ke Dashboard
        </a>
    </div>
</form>
@endsection