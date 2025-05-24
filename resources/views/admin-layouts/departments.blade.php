<!DOCTYPE html>
<html lang="it">
<head>

    <meta charset="UTF-8">
    <title>Gestione dipartimenti</title>

    <!-- Styles definition -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/departments-page.css') }}" rel="stylesheet">

    <!-- Include fullcalendar -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>

</head>
<body>

    <!-- Include the navbar -->
    @include("admin-layouts.partials.navbar")

    <!-- Main page layout -->
    <div class="main">
        @include("admin-layouts.partials.sidebar-menu")
        @include("admin-layouts.partials.departments-content-page")
        @include("admin-layouts.partials.sidebar-properties")
   </div>

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/sidebar-menu.js') }}"></script>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            if (!calendarEl) {
                console.error("#calendar NOT found!");
                return;
            }

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                dateClick: calendarDateClick
            });

            calendar.render();
        });

        // Make department globally available
        window.departments = @json($dipartimenti);
        // Set the first entry of the menu as selected
        setSelection($('.menu-item')[0]);
    </script>
</body>
</html>
