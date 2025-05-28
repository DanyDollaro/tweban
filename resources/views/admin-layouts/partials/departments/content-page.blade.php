<h1 id="content-title">Prenotazione</h1>

<form method="POST">

    <!-- Specializzazione -->
    <label class="label-text">Specializzazione</label><br>
    <input type="text" name="specialization" id="specialization"><br><br>

    <!-- Prestazione -->
    <label class="label-text">Prestazione</label><br>
    <select name="performance" id="performance" size="3">
        @foreach ($prestazioni as $prestazione)
            <option value="{{ $prestazione->id }}">{{ $prestazione->nome }}</option>
        @endforeach
    </select><br><br>

    <!-- Giorni disponibili -->
    <label class="label-text">Giorni disponibili</label><br>
    <select name="days[]" id="days" multiple size="5">
        @foreach ($giorni as $giorno)
            <option value="{{ $giorno }}">{{ $giorno }}</option>
        @endforeach
    </select><br><br>

    <!-- Orario -->
    <label class="label-text">Orario</label><br>
    <select name="time_slot" id="time_slot">
        @for ($h = 8; $h <= 18; $h++)
            <option value="{{ $h }}:00">{{ sprintf('%02d:00', $h) }}</option>
        @endfor
    </select><br><br>

    <button type="submit">Invia</button>
</form>

