@extends('layouts.auth')

@section('title', 'Fitrole - Login')

@section('content')
<div class="text-center mb-8">
    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Selamat Datang Kembali!</h2>
    <p class="text-sm text-slate-500 mt-2">Lanjutkan perjalanan hidup sehatmu hari ini.</p>
</div>

<form method="POST" action="{{ route('login') }}" class="space-y-5">
    @csrf

    <div class="group">
        <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Email</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" /></svg>
            </div>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                placeholder="nama@email.com"
                class="w-full pl-11 pr-4 py-3 bg-stone-50 border border-stone-200 rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none text-sm">
        </div>
        @error('email') <p class="text-xs text-red-500 mt-1.5 ml-1">{{ $message }}</p> @enderror
    </div>

    <div class="group">
        <label class="block text-sm font-semibold text-slate-700 mb-1.5 ml-1">Password</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-emerald-500 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
            </div>
            <input type="password" name="password" required
                placeholder="••••••••"
                class="w-full pl-11 pr-4 py-3 bg-stone-50 border border-stone-200 rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none text-sm">
        </div>
        @error('password') <p class="text-xs text-red-500 mt-1.5 ml-1">{{ $message }}</p> @enderror
    </div>

    <div class="flex items-center justify-between px-1">
        <label class="flex items-center gap-2 cursor-pointer group">
            <input type="checkbox" name="remember" class="w-4 h-4 rounded border-stone-300 text-emerald-600 focus:ring-emerald-500">
            <span class="text-sm text-slate-500 group-hover:text-slate-700 transition-colors">Ingat saya</span>
        </label>

        @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm font-semibold text-emerald-600 hover:text-emerald-700 transition-colors">
                Lupa password?
            </a>
        @endif
    </div>

    <button class="w-full py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-lg shadow-emerald-200 transition-all active:scale-[0.98]">
        Masuk Sekarang
    </button>
</form>

<div class="mt-8 pt-6 border-t border-stone-100 text-center">
    <p class="text-sm text-slate-500">
        Belum punya akun? 
        <a href="{{ route('register') }}" class="font-bold text-emerald-600 hover:text-emerald-700 transition-colors">
            Daftar Gratis
        </a>
    </p>
</div>
@endsection