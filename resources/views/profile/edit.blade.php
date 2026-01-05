@extends('layouts.app')

@section('title', 'Fitrole - Profil')

<meta property="og:site_name" content="Fitrole">
    <meta property="og:type" content="website">

    @if(View::hasSection('meta'))
        @yield('meta')
    @else
        <meta property="og:title" content="Fitrole - Dashboard">
        <meta property="og:image" content="{{ asset('images/default-fitrole-share.png') }}">
    @endif

    <title>@yield('title', 'Fitrole')</title>

@section('content')

@if (session('status'))
<div
    x-data="{ show: true }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-y-4 scale-95"
    x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 transform translate-y-4 scale-95"
    x-init="setTimeout(() => show = false, 4000)"
    class="fixed bottom-6 right-6 z-[100] w-[calc(100%-3rem)] sm:w-auto"
>
    <div class="bg-slate-900 text-white rounded-2xl shadow-2xl shadow-slate-200 p-4 flex items-center gap-4 border border-slate-800">
        <div class="flex-shrink-0 w-10 h-10 bg-emerald-500/20 rounded-xl flex items-center justify-center">
            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <div class="flex flex-col pr-8">
            <span class="text-xs font-bold uppercase tracking-widest text-emerald-400">Notifikasi</span>
            <p class="text-sm font-medium text-slate-200">
                @if (session('status') === 'profile-updated')
                    Profil Anda berhasil diperbarui.
                @elseif (session('status') === 'password-updated')
                    Kata sandi berhasil diamankan.
                @else
                    {{ session('status') }}
                @endif
            </p>
        </div>

        <button @click="show = false" class="absolute top-4 right-4 text-slate-500 hover:text-white transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
    </div>
</div>
@endif

<div class="mb-10 px-1">
    <div class="flex items-center gap-4 mb-2">
        <div class="p-3 bg-emerald-100 rounded-2xl">
            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </div>
        <div>
            <h1 class="text-3xl font-black text-slate-800 tracking-tight">Pengaturan Profil</h1>
            <p class="text-slate-500 font-medium">Kelola informasi pribadi dan keamanan akun Fitrole Anda.</p>
        </div>
    </div>
</div>

<div class="space-y-8 pb-12">
    <section class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-stone-100 relative overflow-hidden group transition-all hover:shadow-md">
        <div class="absolute top-0 right-0 p-8 opacity-[0.03] group-hover:opacity-[0.05] transition-opacity">
            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
        </div>
        <div class="max-w-2xl relative">
            @include('profile.partials.update-profile-information-form')
        </div>
    </section>

    <section class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-stone-100 relative overflow-hidden group transition-all hover:shadow-md">
        <div class="absolute top-0 right-0 p-8 opacity-[0.03] group-hover:opacity-[0.05] transition-opacity">
            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M12 1L9 9l-8 3 8 3 3 8 3-8 8-3-8-3-3-8z"/></svg>
        </div>
        
        <div class="relative">
            <div class="mb-8">
                <h3 class="text-xl font-black text-slate-800 tracking-tight">Koleksi Badge Fitrole</h3>
                <p class="text-sm text-slate-500 font-medium">Kumpulkan semua badge dengan tetap disiplin dan mencapai targetmu.</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6">
                @php
                    $allBadges = \App\Models\Badge::all();
                    $userBadgeIds = auth()->user()->badges->pluck('id')->toArray();
                @endphp

                @foreach($allBadges as $badge)
                    @php 
                        $isOwned = in_array($badge->id, $userBadgeIds);
                        $achievedAt = $isOwned ? auth()->user()->badges->where('id', $badge->id)->first()->pivot->achieved_at : null;
                    @endphp
                    
                    <div class="flex flex-col items-center group/item relative">
                        <div class="relative w-24 h-24 mb-3 flex items-center justify-center">
                            
                            @if($isOwned)
                                <div class="absolute inset-0 bg-emerald-400/20 blur-xl rounded-full animate-pulse"></div>
                            @endif

                            <div class="relative w-20 h-20 rounded-3xl flex items-center justify-center transition-all duration-500 z-10 {{ $isOwned ? 'bg-emerald-50 shadow-lg shadow-emerald-100' : 'bg-slate-50 opacity-40 grayscale' }}">
                                <img src="{{ asset('storage/' . $badge->icon_path) }}" 
                                    alt="{{ $badge->name }}" 
                                    class="w-14 h-14 object-contain transition-transform group-hover/item:scale-110">
                            </div>

                            @if($isOwned)
                                {{-- Centang Hijau (Pojok Kanan Atas) --}}
                                <div class="absolute -top-1 -right-1 bg-emerald-500 text-white rounded-full p-1 shadow-lg border-2 border-white z-20">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                </div>

                                <button 
                                    onclick="shareBadge('{{ $badge->name }}', '{{ $badge->description }}')"
                                    class="absolute -bottom-1 -left-1 z-30 bg-white p-2 rounded-xl shadow-md border border-slate-100 text-slate-400 hover:text-emerald-600 hover:border-emerald-200 transition-all hover:scale-110 active:scale-95 shadow-sm"
                                    title="Share Badge"
                                >
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                </button>
                            @endif
                        </div>

                        <div class="text-center">
                            <h4 class="text-[11px] font-black uppercase tracking-widest {{ $isOwned ? 'text-emerald-700' : 'text-slate-400' }}">
                                {{ $badge->name }}
                            </h4>
                            @if($isOwned)
                                <p class="text-[9px] text-emerald-500 font-bold mt-1">
                                    {{ \Carbon\Carbon::parse($achievedAt)->format('d M Y') }}
                                </p>
                            @else
                                <p class="text-[9px] text-slate-300 font-bold mt-1 uppercase tracking-tighter">Terkunci</p>
                            @endif
                        </div>

                        <div class="absolute z-40 bottom-full mb-4 w-40 p-2 bg-slate-800 text-white text-[10px] rounded-xl opacity-0 invisible group-hover/item:opacity-100 group-hover/item:visible transition-all text-center shadow-xl pointer-events-none">
                            {{ $badge->description }}
                            <div class="absolute top-full left-1/2 -translate-x-1/2 border-8 border-transparent border-t-slate-800"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-stone-100 relative overflow-hidden group transition-all hover:shadow-md">
        <div class="absolute top-0 right-0 p-8 opacity-[0.03] group-hover:opacity-[0.05] transition-opacity">
            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
        </div>
        <div class="max-w-2xl relative">
            @include('profile.partials.update-password-form')
        </div>
    </section>

    <section class="bg-rose-50/30 rounded-[2.5rem] p-8 border border-rose-100 relative overflow-hidden group">
        <div class="max-w-2xl relative">
            @include('profile.partials.delete-user-form')
        </div>
    </section>
</div>

<script>
    function shareBadge(name, description) {
        const shareData = {
            title: 'Badge Fitrole Baru!',
            text: `Saya baru saja mendapatkan badge "${name}" di Fitrole: ${description}. Ayo hidup sehat bersama!`,
            url: window.location.origin + '/dashboard'
        };

        if (navigator.share) {
            navigator.share(shareData)
                .then(() => console.log('Berhasil dibagikan'))
                .catch((error) => console.log('Gagal membagikan', error));
        } else {
            const dummyText = `${shareData.text} ${shareData.url}`;
            navigator.clipboard.writeText(dummyText).then(() => {
                alert('Link dan teks share berhasil disalin ke clipboard!');
            });
        }
    }
</script>

@endsection