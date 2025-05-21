
<h2>Prenota una Prestazione</h2>

@if(session('success'))
    <div style="color: green; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('prenotazioni.store') }}">
    @csrf

    <label for="dipartimento">Dipartimento:</label><br>
    <select name="dipartimento" id="dipartimento" required>
        <option value="">-- Seleziona Dipartimento --</option>
        @foreach ($dipartimenti as $dipartimento)
            <option value="{{ $dipartimento->specializzazione }}" {{ old('dipartimento') == $dipartimento->specializzazione ? 'selected' : '' }}>
                {{ $dipartimento->specializzazione }}
            </option>
        @endforeach
    </select>
    <br><br>

    <label for="prestazione">Prestazione:</label><br>
    <select name="prestazione" id="prestazione" required>
        <option value="">-- Seleziona Prestazione --</option>
        @foreach ($prestazioni as $prestazione)
            <option value="{{ $prestazione->tipologia }}" {{ old('prestazione') == $prestazione->tipologia ? 'selected' : '' }}>
                {{ $prestazione->tipologia }}
            </option>
        @endforeach
    </select>
    <br><br>

    <label for="data_prenotazione">Data Prenotazione:</label><br>
    <input type="date" name="data_prenotazione" id="data_prenotazione" value="{{ old('data_prenotazione') }}" required>
    <br><br>

    <label for="orario">Orario:</label><br>
    <input type="time" name="orario" id="orario" value="{{ old('orario') }}" required>
    <br><br>

    <button type="submit">Prenota</button>
</form>
