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
             <section class="agenda-controls">
                <label for="date-selector">Appuntamenti del giorno <span id="selected-date-display"></label>
            </section>
            <section class="agenda-display">
    </main>
    <script>
        //funzione per ottenere la data corrente e formattarla 
        function getCurrentDateFormatted(){
            const today= new Date();
            const day= String (today.getDate()).padStart(2,'0');
            //today.getDate(): Ottiene il giorno del mese (es. 1, 2, ..., 10, 11, ..., 31).
            //String(...): Converte questo numero in una stringa.
            //.padStart(2, '0'): Questa è la parte chiave. Questo metodo controlla la lunghezza della stringa risultante. 
            // Se la stringa è più corta di 2 caratteri (cioè, se il giorno è 1-9), aggiunge '0' all'inizio finché la stringa non raggiunge 2 caratteri.
            // Se la stringa è già di 2 o più caratteri (cioè, il giorno è 10-31), non fa nulla e la lascia così com'è.
            const month= String(today.getMonth()+1).padStart(2,'0');//in JavaScript i mesi partono da 0 quindi aggiungo +1.
            //Quando usi today.getMonth(), il valore che ti viene restituito è questo indice basato su zero. Così avrò
            //Gennaio=1 invece di Gennaio=0
            const year = today.getFullYear();
            return `${day}/${month}/${year}`;
            //La riga returnday/{month}/${year}; serve a costruire la stringa finale della data nel formato desiderato (gg/mm/aaaa) 
            //e a restituirla alla funzione che l'ha chiamata.
            }
            // Seleziona gli elementi HTML necessari
            //Trova il campo input della data
            const dateInput = document.getElementById('date-selector'); 
            //Trova lo span dove mostrare la data
            const selectedDateDisplay = document.getElementById('selected-date-display');
            //Imposta la data del giorno
            const todayFormatted = getCurrentDateFormatted();
            //Se l'input della data esiste, imposta il suo valore
            if (dateInput) {
                dateInput.value = todayFormatted;
            }
            //Se lo span esiste, imposta il suo testo
            if (selectedDateDisplay) {
                selectedDateDisplay.textContent = todayFormatted;
            }
    </script>

    <footer>
        <p>© {{ date('Y') }} Medilab. Tutti i diritti riservati.</p>
    </footer>
</body>
</html>