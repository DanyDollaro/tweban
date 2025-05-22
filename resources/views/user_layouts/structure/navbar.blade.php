   <!-- Collegamento al CSS -->
  <link rel="stylesheet" href="{{ asset('css/navbar_user.css') }}">

 <nav class="navbar">
    <div class="logo">Medilab</div>
    <ul class="nav-links">
      <!--  <li><a href="#">Visualizza Appuntamenti</a></li> -->
      <li> <a href="{{ route('prenotazioni.create') }}" class="btn btn-primary">
        Prenota Prestazione</a> <li>
      <li><a href="#">Visualizza Referti</a></li>
      <li><a href="#">Comunicazioni Medico-Paziente</a></li>
      

    </ul>
  </nav>
   