<!-- dashboard.blade.php o simile -->
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dash.css') }}">
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
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

@include('user_layouts.structure.navbar')


<div class="welcome">
    <h1>Benvenuto in Area Riservata!</h1>
</div>

<div class="dashboard-container">
    @include('user_layouts.profile')
</div>


</body>

 <footer>
        <p>© {{ date('Y') }} Medilab. Tutti i diritti riservati.</p>
    </footer>
</html> 
