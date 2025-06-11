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
        <form action="{{ route('paziente.dashboard') }}" method="GET">
            <button type="submit">← Torna alla Dashboard</button>
        </form>
    </div>

    <header>
        <h1>Notifiche</h1>
    </header>

    @forelse($notifications as $notifica)
        <div class="notification {{ $notifica->type }}">
            <p class="notification-type">
                {{ ucfirst(str_replace('_', ' ', $notifica->type)) }}
            </p>
            <p class="notification-message">
                {{ $notifica->message }}
            </p>

            @if($notifica->prenotazione)
                <p class="notification-date">
                    Data prenotazione: {{ \Carbon\Carbon::parse($notifica->prenotazione->data_prenotazione)->format('d/m/Y') }}
                    ore {{ \Carbon\Carbon::parse($notifica->prenotazione->orario_prenotazione)->format('H:i') }}
                </p>
            @else
                <p class="notification-date">Nessuna data disponibile.</p>
            @endif
        </div>
    @empty
        <p class="no-notifications">Nessuna notifica disponibile.</p>
    @endforelse
    
</body>
</html>
