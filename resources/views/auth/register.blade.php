@extends('layouts.auth')

@section('title', 'Fitrole - Register')

@section('content')
<div class="text-center mb-8">
    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Buat Akun Fitrole</h2>
    <p class="text-sm text-slate-500 mt-2">Langkah awal menuju tubuh ideal dan sehat.</p>
</div>

<form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf

    <div class="group">
        <label class="block text-sm font-semibold text-slate-700 mb-1 ml-1">Nama Lengkap</label>
        <input type="text" name="name" value="{{ old('name') }}" required autofocus
            placeholder="Contoh: Budi Santoso"
            class="w-full px-4 py-3 bg-stone-50 border border-stone-200 rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none text-sm">
        @error('name') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
    </div>

    <div class="group">
        <label class="block text-sm font-semibold text-slate-700 mb-1 ml-1">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required
            placeholder="budi@email.com"
            class="w-full px-4 py-3 bg-stone-50 border border-stone-200 rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none text-sm">
        @error('email') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="group">
            <label class="block text-sm font-semibold text-slate-700 mb-1 ml-1">Password</label>
            <input type="password" name="password" required
                placeholder="••••••••"
                class="w-full px-4 py-3 bg-stone-50 border border-stone-200 rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none text-sm">
        </div>
        <div class="group">
            <label class="block text-sm font-semibold text-slate-700 mb-1 ml-1">Konfirmasi</label>
            <input type="password" name="password_confirmation" required
                placeholder="••••••••"
                class="w-full px-4 py-3 bg-stone-50 border border-stone-200 rounded-2xl focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 focus:bg-white transition-all outline-none text-sm">
        </div>
    </div>
    @error('password') <p class="text-xs text-red-500 mt-1 ml-1">{{ $message }}</p> @enderror

    <div class="pt-2">
        <button class="w-full py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-2xl shadow-lg shadow-emerald-200 transition-all active:scale-[0.98]">
            Mulai Hidup Sehat
        </button>
    </div>
</form>

<div class="mt-8 pt-6 border-t border-stone-100 text-center">
    <p class="text-sm text-slate-500">
        Sudah punya akun? 
        <a href="{{ route('login') }}" class="font-bold text-emerald-600 hover:text-emerald-700 transition-colors">
            Masuk di sini
        </a>
    </p>
</div>
@endsection