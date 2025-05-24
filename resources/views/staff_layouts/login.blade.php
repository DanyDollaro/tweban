<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Area Riservata</title>
    <link rel="stylesheet" href="{{ asset('css/login_staff1.css') }}">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>

        {{-- Errore di autenticazione (es: credenziali errate) --}}
        @if(session('error'))
            <div class="invalid-feedback" role="alert" style="text-align:center; margin-bottom:10px;">
                <strong>{{ session('error') }}</strong>
            </div>
        @endif

       <form method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf

            {{-- Username o Email --}}
            <label for="username">Email o Nome utente</label>
            <input 
                type="text" 
                id="username" 
                name="username" 
                value="{{ old('username') }}" 
                required 
                autofocus
                aria-describedby="username-error"
            >
            @error('username')
                <span id="username-error" class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            {{-- Password --}}
            <label for="password">Password</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                required
                aria-describedby="password-error"
            >
            @error('password')
                <span id="password-error" class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            {{-- Pulsante invio --}}
            <button type="submit" class="testo-pulsante">Accedi</button>
            
        </form>
    </div>
</body>
</html>
