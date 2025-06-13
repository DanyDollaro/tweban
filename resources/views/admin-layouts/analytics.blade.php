<!DOCTYPE html>
<html lang="it">
<head>
    <!-- Styles definition -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">

    <!-- JS modules -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/admin/analytics.js') }}"></script>
</head>
<body>
    <!-- Include the navbar -->
    @include("admin-layouts.partials.navbar", ['title' => "Analytics"])

    <div class="main">
        @include("admin-layouts.partials.analytics.sidebar-menu")

        <div class="analytics-main">
            <form method="GET">
                <div style="background-color: lightblue;">
                    <label>Da</label>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}">

                    <label>A</label>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}">
                </div>
            </form>

            @include('admin-layouts.partials.analytics.performances-view')
            @include('admin-layouts.partials.analytics.departments-view')
            @include('admin-layouts.partials.analytics.patients-view')

            <script>
                window.data = @json($data);
                console.log(window.data);

                $('#search-bar').on('input', searchBarOnInput);

                showGroup('performances');
            </script>
        </div>

    </div>
</body>
