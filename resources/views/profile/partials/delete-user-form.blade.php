<section class="space-y-6">
    <header>
        <div class="flex items-center gap-3 mb-2">
            <span class="p-2 bg-rose-50 rounded-lg">
                <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </span>
            <h2 class="text-xl font-bold text-slate-800 tracking-tight">
                {{ __('Hapus Akun') }}
            </h2>
        </div>

        <p class="text-sm text-slate-500 leading-relaxed max-w-lg">
            {{ __('Setelah akun dihapus, seluruh data progres kesehatan dan riwayat diet Anda akan hilang secara permanen. Harap unduh data penting Anda sebelum melanjutkan.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Hapus Akun Permanen') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-bold text-slate-800 tracking-tight">
                {{ __('Konfirmasi Penghapusan') }}
            </h2>

            <p class="mt-3 text-sm text-slate-500 leading-relaxed">
                {{ __('Untuk keamanan, silakan masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Fitrole secara permanen.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="block w-full sm:w-3/4"
                    placeholder="{{ __('Masukkan Password Anda') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>

                <x-danger-button>
                    {{ __('Ya, Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>