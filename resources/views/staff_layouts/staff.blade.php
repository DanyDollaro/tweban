<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Staff - Medilab</title> {{-- Titolo più specifico --}}
    {{-- Collegamento al file CSS esterno --}}
    <link rel="stylesheet" href="{{ asset('css/staff.css') }}">

    {{-- IMPORTANTE: QUESTA PAGINA UTILIZZA SOLO JAVASCRIPT NATIVO, NESSUNA DIPENDENZA DA JQUERY --}}
    <!-- importa pagina blade in component header-admin-->


</head>
<body>
    <header>
        <div class="top-bar">
            <div class="contact-info">
                <span>contact@example.com</span>
                <span>+1 5589 55488 55</span>
                <a href="{{ url('/') }}">Torna alla home</a>
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
                    <li><a href="{{ route('staff.agenda') }}">Prenotazioni</a></li> {{-- Modificato da 'login' --}}
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
    </header> {{-- Importa il componente staff-header con i dati dell'utente --}}

    {{-- Inizio del contenuto principale della pagina --}}
    <main>
        <section class="agenda-controls">
            <div class="agenda-header">
                {{-- Label per la data con lo span per la visualizzazione formattata --}}
                <label for="date-selector">Appuntamenti del giorno <span id="selected-date-display"></span></label>
                {{-- Input type="date" nascosto che viene aperto cliccando sullo span --}}
                <input type="date" id="date-selector" style="display: none;">
            </div>
            <section class="agenda-display">
                <div class="control-group">
                    <label for="service-filter">Filtra per Prestazione:</label>
                    {{-- Select per il filtro delle prestazioni, popolato dinamicamente da Laravel --}}
                    <select id="service-filter">
                        {{-- Opzione di default per visualizzare tutte le prestazioni --}}
                        <option value="">Tutte le Prestazioni</option>
                        {{-- Ciclo per popolare le opzioni con le prestazioni disponibili --}}
                        @foreach ($prestazioni_per_select as $prestazione)
                        <option value="{{ $prestazione->id }}">
                            {{ $prestazione->nome }}
                        </option> {{-- IMPORTANTE: chiusura del tag <option> --}}
                        @endforeach
                    </select>
                </div>
                {{-- Rimosso il foreach $prenotazioni qui,
                     poiché i dati degli appuntamenti verranno caricati e visualizzati
                     dinamicamente nella tabella dal JavaScript tramite l'API. --}}
            </section> {{-- Chiusura della sezione agenda-display --}}

            <div class="container">
                {{-- Contenitore per i risultati degli appuntamenti --}}
                <div id="appointments-results">
                    {{-- Messaggio di caricamento, inizialmente nascosto, visibile durante il fetch --}}
                    <p class="loading-message" style="display: none;">Caricamento appuntamenti...</p>
                    {{-- Messaggio per quando non ci sono appuntamenti, inizialmente nascosto --}}
                    <p class="no-appointments-message" style="display: none;">Nessun appuntamento trovato per la selezione.</p>
                    {{-- Tabella per visualizzare gli appuntamenti --}}
                    <table class="appointments-list">
                        <thead>
                            <tr>
                                <th>Orario</th>
                                <th>Prestazione</th>
                                <th>Paziente</th>
                                <th>Medico</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Le righe degli appuntamenti verranno inserite qui dal JavaScript --}}
                        </tbody>
                    </table>
                </div>

                {{-- Pulsante per stampare la pagina --}}
                <div class="action-buttons" style="margin-top: 30px; text-align: center;">
                    <button id="print-button" class="btn btn-primary">Stampa Appuntamenti</button>
                </div>
            </div>
        </section> {{-- Chiusura della sezione agenda-controls --}}
    </main>
    {{-- Collegamento al file JavaScript per la logica frontend --}}
    <script src="{{ asset('js/staff.js') }}"></script>
    <footer>
        <p>© {{ date('Y') }} Medilab. Tutti i diritti riservati.</p>
    </footer>
</body>
</html>