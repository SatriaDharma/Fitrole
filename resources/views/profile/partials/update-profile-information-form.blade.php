<section>
    <header class="mb-8">
        <div class="flex items-center gap-3 mb-2">
            <span class="p-2 bg-emerald-100 rounded-lg">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </span>
            <h2 class="text-xl font-bold text-slate-800 tracking-tight">
                {{ __('Informasi Dasar') }}
            </h2>
        </div>

        <p class="text-sm text-slate-500 leading-relaxed">
            {{ __("Perbarui nama akun dan alamat email resmi Anda di sini.") }}
        </p>
    </header>

    {{-- Hidden form for verification link --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <div class="max-w-md">
            <x-input-label for="name" :value="__('Nama Lengkap')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" placeholder="Contoh: Budi Santoso" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="max-w-md">
            <x-input-label for="email" :value="__('Alamat Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 rounded-2xl bg-amber-50 border border-amber-100">
                    <div class="flex items-center gap-2 text-amber-700 mb-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                        <span class="text-xs font-bold uppercase tracking-wider">{{ __('Email Belum Terverifikasi') }}</span>
                    </div>
                    
                    <p class="text-sm text-amber-600 mb-2">
                        {{ __('Akses Anda terbatas sebelum melakukan verifikasi email.') }}
                    </p>

                    <button form="send-verification" class="text-sm font-bold text-amber-700 underline hover:text-amber-800 transition-colors">
                        {{ __('Kirim ulang tautan verifikasi') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-bold text-xs text-emerald-600 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                            {{ __('Tautan baru telah meluncur ke inbox Anda!') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4 pt-2">
            <x-primary-button>{{ __('Simpan Perubahan') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <div 
                    x-data="{ show: true }" 
                    x-show="show" 
                    x-transition 
                    x-init="setTimeout(() => show = false, 2500)" 
                    class="flex items-center gap-2 text-emerald-600"
                >
                    <svg class="w-5 h-5 animate-bounce-subtle" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span class="text-sm font-bold">{{ __('Profil Diperbarui!') }}</span>
                </div>
            @endif
        </div>
    </form>
</section>