<!DOCTYPE html>
<html lang="it">
<head>
    <!-- Styles definition -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">

    <!-- JS modules -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Include the navbar -->
    @include("admin-layouts.partials.navbar", ['title' => "Gestione prestazioni"])

    <!-- Create the calendar holder -->
    <div class="main">
        <div class="sidebar-menu" style="flex: 0 0 18%;">
            @include("admin-layouts.partials.performances.sidebar-menu")
        </div>
        <div id="calendar" style="flex: 1; padding: 35px;"></div>
    </div>

    <!-- JS Scripts -->
    <script src="{{ asset('js/admin/performances.js') }}"></script>
    <script>
        window.data = @json($data);
        console.log(window.data);

        $(document).ready(function() {
            window.calendar = new FullCalendar.Calendar($('#calendar')[0], {
                dateClick: calendarDateClick
            });
            window.calendar.render();
        });
    </script>
</body>
