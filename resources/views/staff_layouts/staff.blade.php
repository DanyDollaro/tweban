<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medilab</title>
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
            <div class="logo">Medilab</div>
            <nav>
                <ul>
                    <li><a href="{{ route('staff') }}">Agenda Prestazioni</a></li>
                    <li><a href="#">Visualizzazione Referti</a></li>
                    <li><a href="#">Comunicazioni Interne</a></li>
                   <!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medilab</title>
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
            <div class="logo">Medilab</div>
            <nav>
                <ul>
                    <li><a href="{{ route('staff') }}">Agenda Prestazioni</a></li>
                    <li><a href="#">Visualizzazione Referti</a></li>
                    <li><a href="#">Comunicazioni Interne</a></li>
                    
                    {{-- Mostra il link Logout solo se l'utente è autenticato --}}
                    @auth
                    <li>
                        <a href="#" title="Esci dal sito" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf {{-- Usa @csrf per il token, è più moderno di {{ csrf_field() }} --}}
                    </form>
                    @endauth

                </ul>
            </nav>
        </div>
    </header>

    <main>

        <section class="staff-dashboard-section">
            <h1>Benvenuto nell'area Staff di Medilab</h1>
            <p>Seleziona una delle opzioni dal menu di navigazione per iniziare.</p>
      

        </section>

    </main>

    <footer>
        <p>© {{ date('Y') }} Medilab. Tutti i diritti riservati.</p> 
    </footer>
</body>
</html>