<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Staff - Medilab</title> {{-- Titolo più specifico --}}
    {{-- Collegamento al file CSS esterno --}}
    <link rel="stylesheet" href="{{ asset('css/agenda.css') }}">
    {{-- AGGIUNTO: Meta tag CSRF per la sicurezza delle richieste AJAX --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <div class="top-bar">
            {{-- Modificato: link "Torna alla home" --}}
            <a href="{{route('staff.dashboard') }}">Torna alla Dashboard</a>
        </div>
        <div class="main-header">
            {{-- Modificato: il logo "Gestione Prenotazioni" ora è un link alla dashboard (Agenda) --}}
            <div class="logo">
                <a>Gestione Prenotazioni</a>
            </div>
            <nav>
                <ul>
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
    <table id="appointments-table">
        <thead>
            <tr>
                <th>Data Prenotazione</th>
                <th>Ora Prenotazione</th>
                <th>Cliente Id</th>
                <th>Staff Id</th>
                <th>Prestazione</th>
                <th>Stato</th>
            </tr>
        </thead>
    {{-- Modale per l'accettazione della prenotazione --}}
    <div id="accept-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-button" onclick="$('#accept-modal').hide()">&times;</span>
            <h2>Conferma Appuntamento</h2>
            <input type="hidden" id="accept-id">
            <label for="accept-giorno">Giorno Appuntamento:</label>
            <input type="date" id="accept-giorno" required>
            <label for="accept-orario">Ora Appuntamento:</label>
            <input type="time" id="accept-orario" required>
            <button id="confirm-accept" class="bottone-conferma" style="background-color: green;">Conferma</button>
        </div>
    </div>

    {{-- Modale per la modifica della prenotazione --}}
    <div id="modify-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-button" onclick="$('#modify-modal').hide()">&times;</span>
            <h2>Modifica Appuntamento</h2>
            <input type="hidden" id="modify-id">
            <label for="modify-giorno">Nuovo Giorno Appuntamento:</label>
            <input type="date" id="modify-giorno" required>
            <label for="modify-orario">Nuovo Orario Appuntamento:</label>
            <input type="time" id="modify-orario" required>
            <button id="confirm-modify" class="bottone-conferma" style="background-color: green;">Conferma</button> 
            <button id="confirm-elimination" class="bottone-elimina" style="background-color: red;">Elimina Appuntamento</button> 
        </div>
    </div>

    {{-- Modale per aggiornare data e ora della prenotazione --}}
    <div id="updateReservationModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close-button" onclick="$('#updateReservationModal').hide()">&times;</span> {{-- Aggiunto onclick per chiudere --}}
            <h2>Aggiorna Prenotazione</h2>
            <form id="updateReservationForm">
                <input type="hidden" id="reservationIdToUpdate">
                <label for="new_data_prenotazione">Nuova Data:</label>
                <input type="date" id="new_data_prenotazione" required>
                <label for="new_orario_prenotazione">Nuovo Orario:</label>
                <input type="time" id="new_orario_prenotazione" required>
                <button type="submit">Aggiorna</button>
            </form>
        </div>
    </div>

        <tbody>
            @foreach ($prenotazioni as $p)
            <tr data-id="{{ $p->id }}">
                    <td>{{ $p->data_prenotazione }}</td>
                    <td>{{ $p->orario_prenotazione }}</td>
                    <td>{{ $p->cliente->id ?? $p->cliente_id }}</td>
                    <td>{{ $p->staff->id ?? ($p->staff_id ?? '-') }}</td>
                    <td>{{ $p->tipologia_prestazione }}</td>
                    <td class="stato">{{ ucfirst($p->stato) }}</td>
                    <td>
                    @if ($p->stato == 'in_attesa')
                    <button type="button" class="btn btn-accept" onclick="showAcceptModal({{ $p->id }}, '{{ $p->data_prenotazione }}', '{{ $p->orario_prenotazione }}')">Accetta</button>                        
                    @elseif ($p->stato == 'accettata')
                    <button type="button" class="btn btn-update bottone-modifica" onclick="showModifyModal({{ $p->id }}, '{{ $p->data_prenotazione }}', '{{ $p->orario_prenotazione }}')">Modifica</button>
                    @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
   
</main>
    <footer>
        <p>© {{ date('Y') }} Medilab. Tutti i diritti riservati.</p>
    </footer>
    <script src="{{ asset('js/agendaPrenotazioni.js') }}"></script>
</body>
</html>
