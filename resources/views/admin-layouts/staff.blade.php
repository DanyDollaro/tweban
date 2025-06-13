<!DOCTYPE html>
<html lang="it">
<head>
    <!-- Styles definition -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">

    <!-- JS modules -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Include the navbar -->
    @include("admin-layouts.partials.navbar", ['title' => "Gestione personale"])

    <div class="main">
        <div class="sidebar-menu">
            @include("admin-layouts.partials.staff.sidebar-menu")
        </div>
        <div class="content-container">
            @include("admin-layouts.partials.staff.content-page")
        </div>
    </div>

    <script src="{{ asset('js/admin/staff.js') }}"></script>
    <script>
        window.data = @json($data);
        console.log(window.data);

        $(document).ready(function() {
            setSelection($('.menu-item')[0]);
        });
    </script>
</body>
