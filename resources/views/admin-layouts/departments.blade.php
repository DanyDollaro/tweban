<!DOCTYPE html>
<html lang="it">
<head>

    <meta charset="UTF-8">
    <title>Gestione dipartimenti</title>

    <!-- Styles definition -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/departments-page.css') }}" rel="stylesheet">

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
        // Make department globally available
        window.departments = @json($dipartimenti);
        // Set the first entry of the menu as selected
        setSelection($('.menu-item')[0]);
    </script>
</body>
</html>
