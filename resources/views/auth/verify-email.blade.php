@extends('layouts.auth')

@section('title', 'Fitrole - Verifikasi Email')

@section('content')
<div class="text-center">
    <div class="relative inline-flex items-center justify-center w-20 h-20 bg-sky-50 rounded-3xl mb-6 rotate-3">
        <svg class="w-10 h-10 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
        </svg>
        <span class="absolute -top-1 -right-1 flex h-4 w-4">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500 border-2 border-white"></span>
        </span>
    </div>
    
    <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Verifikasi Email Kamu</h2>
    <p class="text-sm text-slate-500 mt-3 leading-relaxed">
        Hampir selesai! Kami telah mengirimkan link verifikasi ke alamat email kamu. Silakan klik link tersebut untuk mengaktifkan akun **Fitrole** kamu.
    </p>
</div>

@if (session('status') === 'verification-link-sent')
    <div class="mt-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-100 flex items-center gap-3 animate-bounce-subtle">
        <div class="flex-shrink-0 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm">
            <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
        </div>
        <span class="text-xs font-semibold text-emerald-800 tracking-tight">
            Link baru berhasil dikirim ke email kamu!
        </span>
    </div>
@endif

<div class="mt-8 space-y-4">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit"
            class="group w-full py-3.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-2xl shadow-lg shadow-emerald-100 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
            <span>Kirim Ulang Email</span>
            <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </button>
    </form>

    <div class="flex flex-col items-center gap-4 pt-4 border-t border-stone-100">
        <p class="text-xs text-slate-400">Tidak menerima email? Cek folder Spam atau coba lagi.</p>
        
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="text-sm font-bold text-slate-500 hover:text-red-500 transition-colors flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Keluar / Logout
            </button>
        </form>
    </div>
</div>
@endsection