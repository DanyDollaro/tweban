<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Prenotazione Prestazioni</title>
    <link rel="stylesheet" href="{{ asset('css/prenotazione.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


</head>
<body>
    <!-- bottone per tornare alla dash-->
    <div class="container">
        <div class="top-buttons">
            <form action="{{ route('dashboard') }}" method="GET">
                <button type="submit">← Torna alla Dashboard</button>
            </form>
    <!-- resetta la ricerca -->
            @if($ricercaEffettuata)
            <form method="GET" action="{{ route('prenotazioni.create') }}">
                <button type="submit">+ Nuova Ricerca</button>
            </form>
            @endif
        </div>
    <!--ricarca tramite text o selct -->
        <h2>Ricerca Prestazioni</h2>

        <form method="GET" action="{{ route('prenotazioni.create') }}">
            <div class="form-grid">
                <div class="form-column">
                    <label for="dipartimento_text">Cerca per Dipartimento :</label>
                    <input type="text" id="dipartimento_text" name="dipartimento_text" value="{{ request('dipartimento_text') }}" placeholder="es. o*">

                    <label for="prestazione_text">Cerca per Prestazione :</label>
                    <input type="text" id="prestazione_text" name="prestazione_text" value="{{ request('prestazione_text') }}" placeholder="es. visita*">
                </div>

                <div class="form-column">
                    <label for="dipartimento_select">Oppure seleziona Dipartimento:</label>
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
        <!--serve per non mostrare nulla prima di non aver eseguito una ricerca-->
        @if ($ricercaEffettuata)
        <!-- controllo della collezione-->
            @if($prestazioniFiltered->isEmpty())
                <p>Nessuna prestazione trovata. Prova con altri criteri.</p>
            @else
                <h3>Risultati della ricerca:</h3>
                
            @foreach ($prestazioniFiltered as $prestazione)
             <div class="result-item">
             <strong>{{ $prestazione->tipologia }}</strong> (Dipartimento: {{ $prestazione->sp_dipartimento }})

             


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
            
            <form method="POST" action="{{ route('prenotazioni.store') }}">
            @csrf
            <input type="hidden" name="tipologia_prestazione" value="{{ $prestazione->tipologia }}">
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

<!-- utilizzo JavaScript per disattivare le selezioni -->

   <script>
    document.addEventListener('DOMContentLoaded', () => {
    const dipSelect = document.getElementById('dipartimento_select');
    const dipText = document.getElementById('dipartimento_text');
    const prestSelect = document.getElementById('prestazione_select');
    const prestText = document.getElementById('prestazione_text');

    function toggleFields() {
        if (dipSelect.value) {
            dipText.disabled = true;
            prestSelect.disabled = true;
            prestText.disabled = true;
        } else if (dipText.value) {
            dipSelect.disabled = true;
            prestSelect.disabled = true;
            prestText.disabled = true;
        } else if (prestSelect.value) {
            prestText.disabled = true;
            dipSelect.disabled = true;
            dipText.disabled = true;
        } else if (prestText.value) {
            prestSelect.disabled = true;
            dipSelect.disabled = true;
            dipText.disabled = true;
        } else {
            dipSelect.disabled = false;
            dipText.disabled = false;
            prestSelect.disabled = false;
            prestText.disabled = false;
        }
    }

    dipSelect.addEventListener('change', toggleFields);
    dipText.addEventListener('input', toggleFields);
    prestSelect.addEventListener('change', toggleFields);
    prestText.addEventListener('input', toggleFields);

    //Al caricamento pagina aggiorno subito lo stato
    toggleFields();
});
</script>

</body>
</html>