<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dash.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    window.Laravel = { csrfToken: '{{ csrf_token() }}' };
    </script>
     <script src="{{ asset('js/user/eliminaPrenotazione.js') }}"></script>

</head>
<body>

    {{-- Notifica aggiornamento profilo --}}
    @if (session('profile_updated'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Modifica avvenuta con successo',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    {{-- Navbar --}}
    @include('user_layouts.structure.navbar')

    {{-- Contenuto principale --}}
    <main class="dashboard-main">
        <section class="welcome">
            <h1>Benvenuto in Area Riservata!</h1>
        </section>

        <div class="dashboard-container">
            <div class="profile-box">
                @include('user_layouts.profile')
            </div>

            <div class="appointments-box">

                @if($stampa->isEmpty())
                    <p class="no-appointments">Nessuna prestazione futura accettata.</p>
                @else
                    <div class="appointments-table-container">
                        <h2>Appuntamenti in Agenda</h2>
        <table class="appointments-table">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Orario</th>
                    <th>Prestazione</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stampa as $pren)
                    <tr id="prenotazione-{{ $pren->id }}">
                        <td>{{ $pren->data_prenotazione }}</td>
                        <td>{{ $pren->orario_prenotazione }}</td>
                        <td>{{ $pren->tipologia_prestazione }}</td>
                        <td>
                            <button class="btn-rosso btn-elimina" data-id="{{ $pren->id }}">
                                Elimina
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

{{-- Messaggi di conferma/errore fuori dalla tabella --}}
<div id="alert-success"class="alert alert-success"></div>
<div id="alert-error" class="alert alert-danger"></div>

                    </div>
                @endif
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="dashboard-footer">
        <p>© {{ date('Y') }} Medilab. Tutti i diritti riservati.</p>
    </footer>

</body>
</html>
