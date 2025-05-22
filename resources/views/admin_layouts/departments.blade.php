<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione dipartimenti</title>
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <style>

        :root {
            --accent-color-light-test: color-mix(in srgb, var(--accent-color) 6%, white);
        }

        body {
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--contrast-color);
            background-color: var(--accent-color);
            padding: 10px 20px;
            flex-shrink: 0;
        }

        .header-title {
            font-weight: bold;
        }

        .navbar {
            display: flex;
            gap: 20px;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: #ff0000;
        }

        .main {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        .sidebar {
            width: 18vw;
            overflow-y: auto;
            padding: 10px;
            background: var(--accent-color-light-test);
        }

        .content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .menu-item {
            margin-bottom: 6px;
            padding: 10px;
            border-radius: 2px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .menu-item:hover {
            background-color: #d0e3ff;
        }

        .menu-item.selected {
            background-color: var(--accent-color);
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <!-- Page header -->
    <div class="header">
        <div class="header-title">
            Intestazione – Gestione Dipartimenti
        </div>
        <nav class="navbar">
            <a href="#" class="nav-link">Dipartimenti</a>
            <a href="#" class="nav-link">Personale</a>
            <a href="#" class="nav-link">Agenda</a>
        </nav>
    </div>

    <!-- Main page layout -->
    <div class="main">
        <!-- Left sidebar menu -->
        <div class="sidebar">
            <div id="menu-selection">
                @foreach ($dipartimenti as $dipartimento)
                    <div class="menu-item" onclick="selectDepartment(this, '{{ $dipartimento->specializzazione }}')">
                        {{ $dipartimento->specializzazione }}
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Content area -->
        <div class="content" id="content">
            <h1>Contenuto principale</h1>
            <p>Seleziona un dipartimento dal menu per visualizzare i dettagli.</p>
        </div>

        <div class="sidebar">
            <div id="menu-properties">
                Proprieta'
            </div>
        </div>
    </div>

    <!-- JS Script -->
    <script>
        function selectDepartment(el, specialization) {
            // Rimuove la selezione precedente
            document.querySelectorAll('.menu-item').forEach(item => item.classList.remove('selected'));

            // Aggiunge lo stile selezionato al cliccato
            el.classList.add('selected');

            // Aggiorna il contenuto dinamico
            const content = document.getElementById('content');
            content.innerHTML = specialization;
        }
    </script>

</body>
</html>

