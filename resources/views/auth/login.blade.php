<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 text-[#9a3412] shadow-sm focus:ring-[#9a3412]"
                       name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#9a3412]" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            {{-- AQUI ESTABA EL ERROR: Faltaban clases de estructura --}}
            <x-primary-button class="ms-3 bg-[#9a3412] hover:bg-[#7c2d12] px-2 py-1 rounded-md">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        @if (Route::has('register'))
            <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                <p class="text-sm text-gray-500 mb-3">{{ __('¿No tienes cuenta?') }}</p>

                {{-- Botón REGISTER: Estilo bordeado (Outline) para no confundir --}}
                <a href="{{ route('register') }}"
                   class="inline-flex items-center px-4 py-2 bg-white border border-[#9a3412] rounded-md font-semibold text-xs text-[#9a3412] uppercase tracking-widest hover:bg-[#9a3412] hover:text-white transition ease-in-out duration-150 focus:outline-none focus:ring-2 focus:ring-[#9a3412] focus:ring-offset-2">
                    {{ __('Register') }}
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>
