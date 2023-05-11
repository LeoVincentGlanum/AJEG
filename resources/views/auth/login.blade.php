<x-guest-layout>
    <x-auth-card>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="text-center flex flex-col items-center">
                <span class="text-3xl font-bold">{{ __('Connexion') }}</span>
            </div>
            <!-- Email Address -->
            <div class="mt-[60px]">
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-2 w-full" type="email" name="email" :value="old('email')" required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-[20px]">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-start mt-4">
                @if (Route::has('password.request'))
                    <a class="underline hover:no-underline text-sm text-[#443F37] hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Mot de passe oublié') }}
                    </a>
                @endif

                
            </div>

            <!-- Remember Me -->
            <div class="block mt-8">
                <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                    <input id="remember_me" type="checkbox" class="rounded border-[#E8E8E8] text-[#EEBC42] shadow-sm cursor-pointer focus:border-[#EEBC42] focus:ring focus:ring-[#EEBC42] focus:ring-opacity-60 checked:bg-[#EEBC42]" name="remember">
                    <span class="ml-3 text-[16px] text-[#443F37] ">{{ __('Se souvenir de moi') }}</span>
                </label>
            </div>
            
            <div class="block mt-16">
                <x-primary-button class="normal-case w-full text-[20px]">
                    {{ __('Valider') }}
                </x-primary-button>
            </div>
            
        </form>
    </x-auth-card>
</x-guest-layout>
