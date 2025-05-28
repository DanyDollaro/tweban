<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nome -->
        <div>
            <x-input-label for="nome" :value="__('Nome')" />
            <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome" :value="old('nome')" required autofocus autocomplete="given-name" />
            <x-input-error :messages="$errors->get('nome')" class="mt-2" />
        </div>

        <!-- Cognome -->
        <div class="mt-4">
            <x-input-label for="cognome" :value="__('Cognome')" />
            <x-text-input id="cognome" class="block mt-1 w-full" type="text" name="cognome" :value="old('cognome')" required autocomplete="family-name" />
            <x-input-error :messages="$errors->get('cognome')" class="mt-2" />
        </div>

        <!-- Codice Fiscale -->
        <div class="mt-4">
            <x-input-label for="codice_fiscale" :value="__('Codice Fiscale')" />
            <x-text-input id="codice_fiscale" class="block mt-1 w-full" type="text" name="codice_fiscale" :value="old('codice_fiscale')" required />
            <x-input-error :messages="$errors->get('codice_fiscale')" class="mt-2" />
        </div>

        <!-- Username -->
        <div class="mt-4">
            <x-input-label for="username" :value="__('Username')" />
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Data di nascita -->
        <div class="mt-4">
            <x-input-label for="data_nascita" :value="__('Data di nascita')" />
            <x-text-input id="data_nascita" class="block mt-1 w-full" type="date" name="data_nascita" :value="old('data_nascita')" required />
            <x-input-error :messages="$errors->get('data_nascita')" class="mt-2" />
        </div>

        <!-- Telefono -->
        <div class="mt-4">
            <x-input-label for="telefono" :value="__('Telefono')" />
            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" :value="old('telefono')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Indirizzo -->
        <div class="mt-4">
            <x-input-label for="indirizzo" :value="__('Indirizzo')" />
            <x-text-input id="indirizzo" class="block mt-1 w-full" type="text" name="indirizzo" :value="old('indirizzo')" required />
            <x-input-error :messages="$errors->get('indirizzo')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Conferma Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Conferma Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Hai già un account?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrati') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
