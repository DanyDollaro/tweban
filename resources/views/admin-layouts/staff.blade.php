<!DOCTYPE html>
<html lang="it">
<head>
    <!-- Include fullcalendar -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>

    <!-- Styles definition -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">

</head>
<body>
        <!-- Include the navbar -->
        @include("admin-layouts.partials.navbar", ['title' => "Gestione staff"])

        <div>
            <!-- Setup the calendar div -->
            <div id="calendar" style="max-width: 900px; margin: 20px 0;"></div>
        </div>
</body>
