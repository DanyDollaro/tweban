{{--<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Staff</title>
    <link rel="stylesheet" href="{{ asset('css/login_staff1.css') }}"> {{-- Puoi usare un CSS diverso 
</head>
<body>

    <div class="login-container">
        <h2>Accedi Staff</h2>

        <form action="{{ route('login.post') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="username">Nome Utente</label> {{-- Qui potresti usare un username invece di email 
                <input
                    type="text"
                    id="username"
                    name="username" {{-- Notare 'name="username"' invece di 'email' 
                    value="{{ old('username') }}"
                    required
                    autofocus
                    autocomplete="username"
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
                />
                @error('password')
                    <span class="error-message" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="submit-btn">Accedi</button>

            <div class="alternative-login-link" style="margin-top: 15px; text-align: center;">
                <p><a href="{{ route('login') }}">Torna al login utente</a></p>
            </div>
        </form>
    </div>

</body>
</html>--}}