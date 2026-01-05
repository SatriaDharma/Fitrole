@extends('layouts.auth')

@section('title', 'Fitrole - Reset Password')

@section('content')
<div class="text-center mb-8">
    <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-50 rounded-full mb-4">
        <svg class="w-8 h-8 text-blue-500 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
        </svg>
    </div>
    
    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Perbarui Password</h2>
    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
        Satu langkah lagi untuk kembali ke perjalanan sehatmu. Silakan buat password baru yang kuat.
    </p>
</div>

<form method="POST" action="{{ route('password.store') }}" class="space-y-5">
    @csrf

    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div class="group">
        <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Alamat Email</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" /></svg>
            </div>
            <input type="email" name="email" value="{{ old('email', $request->email) }}" required readonly
                class="w-full pl-11 pr-4 py-3 bg-stone-100 border border-stone-200 rounded-2xl text-slate-500 text-sm cursor-not-allowed outline-none">
        </div>
        @error('email') <p class="text-xs text-red-500 mt-1.5 ml-1">{{ $message }}</p> @enderror
    </div>

    <div class="group">
        <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Password Baru</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
            </div>
            <input type="password" name="password" required autofocus
                placeholder="••••••••"
                class="w-full pl-11 pr-4 py-3 bg-stone-50 border border-stone-200 rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none text-sm">
        </div>
    </div>

    <div class="group">
        <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Konfirmasi Password Baru</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2C9.47 2 7.153 3.002 5.442 4.634c-1.53 1.487-2.6 3.384-2.833 5.49a11.946 11.946 0 004.287 9.417 11.973 11.973 0 0010.212 0 11.946 11.946 0 004.287-9.417c-.232-2.106-1.303-4.003-2.833-5.49z" /></svg>
            </div>
            <input type="password" name="password_confirmation" required
                placeholder="••••••••"
                class="w-full pl-11 pr-4 py-3 bg-stone-50 border border-stone-200 rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none text-sm">
        </div>
    </div>
    @error('password') <p class="text-xs text-red-500 mt-1.5 ml-1">{{ $message }}</p> @enderror

    <div class="pt-2">
        <button type="submit"
            class="w-full py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-lg shadow-emerald-200 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
            Perbarui & Masuk
        </button>
    </div>
</form>
@endsection