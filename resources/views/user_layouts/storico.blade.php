 <!-- Collegamento al CSS -->
  <link rel="stylesheet" href="{{ asset('css/storico.css') }}">

<div class="visite-wrapper">
    <h2 class="visite-title">Storico Visite</h2>
</div>
    @if($visite->isEmpty())
        <div class="no-visite">Non ci sono visite registrate.</div>
    @else
        <div class="visite-container">
            <table class="visite-table">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Descrizione</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($visite as $visita)
                        <tr>
                            <td data-label="Data">{{ \Carbon\Carbon::parse($visita->data_visita)->format('d/m/Y') }}</td>
                            <td data-label="Descrizione">{{ $visita->descrizione }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
