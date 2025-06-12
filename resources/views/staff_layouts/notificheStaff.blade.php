<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Staff - Medilab</title>
    <link rel="stylesheet" href="{{ asset('css/notifiche.css') }}">
</head>
<body>
    <header>
        <div class="top-bar">
            <a href="{{ route('staff.dashboard') }}">Torna alla Dashboard</a>
        </div>
        <div class="main-header">
            <div class="logo">Le tue notifiche</div>
            <nav>
                <ul>
                    <li><a href="{{ route('staff.agenda') }}">Prenotazioni</a></li>
                    @auth
                    <li>
                        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <h2>Notifiche recenti</h2>

        @if($notifications->isEmpty())
            <p class="no-notifications">Nessuna notifica da mostrare.</p>
        @else
            <table class="notifiche-table">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Messaggio</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notifications as $notifica)
                        <tr>
                            <td>{{ ucfirst(str_replace('_', ' ', $notifica->type)) }}</td>
                            <td>{{ $notifica->message }}</td>
                            <td>{{ $notifica->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </main>
</body>
</html>
