<!DOCTYPE html>
<html lang="it">
<head>

    <meta charset="UTF-8">
    <title>Gestione dipartimenti</title>

    <!-- Styles definition -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">

    <!-- JS modules -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

    <!-- Include the navbar -->
    @include("admin-layouts.partials.navbar", ['title' => "Gestione dipartimenti"])

    <!-- Main page layout -->
    <div class="main">
        @include("admin-layouts.partials.departments.sidebar-menu")
        @include("admin-layouts.partials.departments.content-page")
    </div>

    <!-- JS Scripts -->
    <script src="{{ asset('js/admin/departments.js') }}"></script>
    <script>
        // Make the data globally available
        window.data = @json($data);
        console.log(window.data);

        $(document).ready(function() {
            // Set the first entry of the menu as selected
            setSelection($('.menu-item')[0]);

            $('#department-form').on('submit', function () {
                const department = $('#current_department').val();
                const json = JSON.stringify(
                        window.data.departments[department]
                );
                $('#department_data').val(json);
            });
         });
    </script>
</body>
</html>
