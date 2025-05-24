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
                    <li><a href="{{ route('staff') }}">Agenda Prestazioni</a></li> {{-- Qui useresti la route 'staff' --}}
                    <li><a href="#">Visualizzazione Referti</a></li>
                    <li><a href="#">Comunicazioni Interne</a></li>
                    {{-- link per il logout 
                    @auth {{-- Mostra il link logout solo se l'utente è loggato 
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" style="background:none;border:none;color:inherit;cursor:pointer;">Logout</button>
                            </form>
                        </li>
                    @endauth--}}
                </ul>
            </nav>
        </div>
    </header>
    <footer>
        <p>© 2023 Medilab.</p>
    </footer>
    <script>
    </script>
</body>
</html>