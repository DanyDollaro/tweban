<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Prenotazione Prestazioni</title>
    <link rel="stylesheet" href="{{ asset('css/prenotazione.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
    <div class="container">
        <div class="top-buttons">
            <form action="{{ route('dashboard') }}" method="GET">
                <button type="submit">← Torna alla Dashboard</button>
            </form>

            @if($ricercaEffettuata)
            <form method="GET" action="{{ route('prenotazioni.create') }}">
                <button type="submit">+ Nuova Ricerca</button>
            </form>
            @endif
        </div>

        <h2>Ricerca Prestazioni</h2>

        <form method="GET" action="{{ route('prenotazioni.create') }}">
            <div class="form-grid">
                <div class="form-column">
                    <label for="dipartimento_text">Cerca per Specializzazione :</label>
                    <input type="text" id="dipartimento_text" name="dipartimento_text" value="{{ request('dipartimento_text') }}" placeholder="es. O*">

                    <label for="prestazione_text">Cerca per Prestazione :</label>
                    <input type="text" id="prestazione_text" name="prestazione_text" value="{{ request('prestazione_text') }}" placeholder="es. visita*">
                </div>

                <div class="form-column">
                    <label for="dipartimento_select">Oppure seleziona Specializzazione:</label>
                    <select id="dipartimento_select" name="dipartimento_select">
                        <option value="">-- Nessuna selezione --</option>
                        @foreach ($dipartimenti as $dip)
                            <option value="{{ $dip->specializzazione }}" {{ request('dipartimento_select') == $dip->specializzazione ? 'selected' : '' }}>
                                {{ $dip->specializzazione }}
                            </option>
                        @endforeach
                    </select>

                    <label for="prestazione_select">Oppure seleziona Prestazione:</label>
                    <select id="prestazione_select" name="prestazione_select">
                        <option value="">-- Nessuna selezione --</option>
                        @foreach ($prestazioni as $prest)
                            <option value="{{ $prest->tipologia }}" {{ request('prestazione_select') == $prest->tipologia ? 'selected' : '' }}>
                                {{ $prest->tipologia }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit">Cerca</button>
        </form>

        <hr>

        @if ($ricercaEffettuata)
            @if($prestazioniFiltered->isEmpty())
                <p>Nessuna prestazione trovata. Prova con altri criteri.</p>
            @else
                <h3>Risultati della ricerca:</h3>
               @foreach ($prestazioniFiltered as $prestazione)
    <div class="result-item">
        <strong>{{ $prestazione->tipologia }}</strong> (Dipartimento: {{ $prestazione->sp_dipartimento }})

        <form method="POST" action="{{ route('prenotazioni.store') }}">
            @csrf
            <input type="hidden" name="tipologia_prestazione" value="{{ $prestazione->tipologia }}">


            @if($prestazione->medico)
                <p class="info-blocchi">
                    <i class="fas fa-user-md icon"></i>
                    <strong>Medico:</strong> {{ $prestazione->medico->nome ?? 'Non assegnato' }} {{ $prestazione->medico->cognome ?? '' }}
                </p>
            @endif

            <p class="info-blocchi">
                <i class="fas fa-calendar-alt icon"></i>
                <strong>Giorni Operativi:</strong>
                @if($prestazione->giorni_operativi->isNotEmpty())
                    {{ $prestazione->giorni_operativi->pluck('giorno')->join(', ') }}
                @else
                    Nessun giorno disponibile
                @endif
            </p>

             <button type="submit">Prenota</button>
         </form>
      </div>
    @endforeach

            @endif
        @endif
  



        @if(session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>
</body>
</html>