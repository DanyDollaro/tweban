<x-guest-layout>
    {{-- Aggiungi qui la gestione dei messaggi di stato della sessione (es. "Siamo stati disconnessi") --}}
    {{-- Ho modificato la classe in "alert alert-danger" per usare gli stili che hai definito nel CSS --}}
    <x-auth-session-status class="alert alert-danger" :status="session('status')" />

    {{-- Contenitore interno del form di login personalizzato --}}
    <div class="custom-login-form-wrapper">
        {{-- Il titolo del form: "Accedi Staff" come nell'immagine --}}
        <h2>Accedi</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                {{-- Etichetta "Username" --}}
                <label for="username">Username</label>
                <input
                    type="text" {{-- Meglio usare "text" per username, anche se email funziona --}}
                    id="username"
                    name="username"
                    value="{{ old('username') }}"
                    required
                    autofocus
                    autocomplete="username"
                    class="custom-input" {{-- Questa classe è fondamentale per la grandezza --}}
                />
                @error('username')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    class="custom-input" {{-- Questa classe è fondamentale per la grandezza --}}
                />
                @error('password')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            {{-- Questo div gestisce il "Ricordami" e il "Password Dimenticata"
                 Le classi Tailwind qui sono per il layout interno di questi elementi.
                 Se vuoi rimuoverli completamente, devi eliminare questo blocco. --}}
            <div class="block mt-4" style="text-align: left;"> {{-- Ho aggiunto text-align: left per coerenza --}}
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Ricordami') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 float-right" href="{{ route('password.request') }}"> {{-- Ho aggiunto float-right per allinearlo a destra --}}
                        {{ __('Password dimenticata?') }}
                    </a>
                @endif
            </div>

            <div>
                <p>Non hai un account? <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}"><i>Registrati</i></a></p>
            </div>

            {{-- Il bottone di submit "Accedi", centrato e senza margini laterali di Tailwind --}}
            {{-- Ho rimosso il flex justify-center, il tuo submit-btn-custom ha già width: 100% --}}
            <div class="mt-4"> {{-- Ho messo solo un margine superiore --}}
                <button type="submit" class="submit-btn-custom">Accedi</button>
            </div>
            
        </form>
    </div>
</x-guest-layout>
