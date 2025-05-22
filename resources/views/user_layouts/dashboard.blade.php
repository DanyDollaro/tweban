<!-- dashboard.blade.php o simile -->
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/dash.css') }}">
</head>
<body>

@include('user_layouts.structure.navbar')

<div class="welcome">
    <h1>Benvenuto in Area Riservata!</h1>
</div>

<div class="dashboard-container">
    @include('user_layouts.profile')
</div>


</body>
</html>
