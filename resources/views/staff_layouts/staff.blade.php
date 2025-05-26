<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Staff - Medilab</title> {{-- Titolo più specifico --}}
    {{-- Collegamento al file CSS esterno --}}
    <link rel="stylesheet" href="{{ asset('css/staff.css') }}">
</head>
<body>
    <header>
        <div class="top-bar">
            <div class="contact-info">
                <span>contact@example.com</span>
                <span>+1 5589 55488 55</span>
            </div>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="main-header">
            <div class="logo">Benvenuto nell'area Staff di Medilab</div>
            <nav>
                <ul>
                    {{-- Il link per l'Agenda Prestazioni, potresti volerlo più specifico, non 'login' --}}
                    <li><a href="{{ route('staff.dashboard') }}">Agenda Prestazioni</a></li> {{-- Modificato da 'login' --}}
                    <li><a href="#">Visualizzazione Referti</a></li>
                    <li><a href="#">Comunicazioni Interne</a></li>

                    {{-- Mostra il link Logout solo se l'utente è autenticato --}}
                    @auth
                    <li>
                        <a href="#" title="Esci dal sito" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf {{-- Importante per la sicurezza --}}
                    </form>
                    @endauth
                </ul>
            </nav>
        </div>
    </header>
    <main>
        <section class="agenda-display">
             <section class="agenda-controls">
                <label for="date-selector">Seleziona un giorno:</label>
                <input type="date" id="date-selector">
            </section>

            <section class="agenda-display">
                <h2>Appuntamenti del giorno <span id="selected-date-display"></span></h2>
                <div id="appointments-list">
                    <p>Seleziona una data per visualizzare gli appuntamenti.</p>
                </div>
            </section>
        </section>
    </main>

    <footer>
        <p>© {{ date('Y') }} Medilab. Tutti i diritti riservati.</p>
    </footer>
</body>
</html>