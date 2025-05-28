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
    @include("admin-layouts.partials.navbar")

    <!-- Setup the calendar div -->
    <div id="calendar"></div>

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/sidebar-menu.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
                calendar = new FullCalendar.Calendar($('#calendar')[0], { dateClick: calendarDateClick });
                calendar.render();
        });
    </script>
</body>
