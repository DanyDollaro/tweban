 <!-- Collegamento al CSS -->
  <link rel="stylesheet" href="{{ asset('css/storico.css') }}">
<body>
<div class="appointments-table-container">
    <!-- bottone per tornare alla dash-->
    <div class="container">
        <div class="top-buttons">
            <form action="{{ route('dashboard') }}" method="GET">
                <button type="submit">← Torna alla Dashboard</button>
            </form>
            
        <h2>Storico degli Appuntamenti</h2>
        <table class="storico-table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Orario</th>
                    <th>Prestazione</th>
                </tr>
            </thead>
            <tbody>
                @foreach($passate as $pre)
                    <tr id="prenotazione-{{ $pre->id }}">
                        <td>{{ $pre->data_prenotazione }}</td>
                        <td>{{ $pre->orario_prenotazione }}</td>
                        <td>{{ $pre->tipologia_prestazione }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>         
</body>