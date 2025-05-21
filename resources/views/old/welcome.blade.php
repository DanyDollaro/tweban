<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>Poliambulatorio - Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/stile.css') }}">
    </head>
    <body>
        <header>
            <div class="contenuto_intestazione">
                <div class="logo-titolo">
                    <img id="logo" src="{{ asset('img/logo.png') }}" alt="alt" width="50" height="50"/>
                    <h1>POLIAMBULATORIO SPECIALIZZATO</h1>
                </div>
                <nav>
                    <a href="">Dashboard</a> |
                    <a href="">Chi siamo</a> |
                    <a href="">Prenotazioni</a> |
                    <a href="">Orari e contatti</a> |
                    <a href="">News e aggiornamenti</a> |
                    <a href="">FAQ</a> |
                    <a href="">Login</a> |
                    <a href="">Registrazione</a>
                    <form action="/cerca.html" method="get" class="search-form">
                        <input type="text" name="query" placeholder="Cerca..." />
                        <button type="submit">🔍</button>
                    </form>
                </nav>
                <img id="center" src="{{ asset('img/poliambulatorio.png') }}" alt="Description" height="200" width="600"/>
            </div>
        </header>
        <div class="contenuto_paragrafi">
            <h1>COSA OFFRIAMO</h1>
            <p>Lorem ipsum dolor sit amet, commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
            <h1>PERCHE' SCEGLIERCI</h1>
            <p>Qui potrai prenotare visite specialistiche...</p>
         </div>
    </body>
</html>
