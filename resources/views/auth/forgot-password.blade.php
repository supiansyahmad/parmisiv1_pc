<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Lupa Kata Sandi? Tidak masalah. Cukup beri tahu kami alamat email Anda, dan kami akan mengirimkan tautan pengaturan ulang kata sandi melalui email agar Anda dapat memilih kata sandi baru.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center mt-6 gap-4">
            
            <x-primary-button class="w-full justify-center py-3">
                {{ __('EMAIL LINK RESET KATA SANDI') }}
            </x-primary-button>

            <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-green-700 font-bold transition duration-150 ease-in-out">
                &larr; {{ __('KEMBALI KE HALAMAN MASUK') }}
            </a>
        </div>
    </form>
</x-guest-layout>