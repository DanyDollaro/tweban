<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Staff - Medilab</title>
    <link rel="stylesheet" href="{{ asset('css/notifiche.css') }}">
</head>
<body>

    <!-- Bottone per tornare alla Dashboard -->
    <div class="top-buttons">
        <form action="{{ route('dashboard') }}" method="GET">
            <button type="submit">← Torna alla Dashboard</button>
        </form>
    </div>

    <header>
        <h1>Notifiche</h1>
    </header>

    @forelse(auth()->user()->notifications as $notifica)
        <div class="notification {{ $notifica->type }}">
            <p class="notification-type">
                {{ ucfirst(str_replace('_', ' ', $notifica->type)) }}
            </p>
            <p class="notification-message">
                {{ $notifica->message }}
            </p>
            <p class="notification-date">
                {{ $notifica->created_at->format('d/m/Y H:i') }}
            </p>
        </div>
    @empty
        <p style="padding: 20px;">Nessuna notifica disponibile.</p>
    @endforelse

</body>
</html>
