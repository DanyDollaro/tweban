   <!-- Collegamento al CSS -->
  <link rel="stylesheet" href="{{ asset('css/navbar_user.css') }}">

 <nav class="navbar">
    <div class="logo"><a href="{{ url('/') }}">Medilab</a></div>
    <ul class="nav-links">
      <!--  <li><a href="#">Visualizza Appuntamenti</a></li> -->
      <li><a href="{{ route('prenotazioni.create') }}" class="btn btn-primary"> Prenota Prestazione</a><li>
      <li><a href="{{ route('paziente.prenotazioni.passate') }}">Storico Visite</a></li>
      <li><a href="#">Comunicazioni Medico-Paziente</a></li>
      
  <form method="POST" action="{{ route('logout') }}">
    @csrf

        <li><a href="route('logout')"
              onclick="event.preventDefault();
              this.closest('form').submit();">
        {{ __('Logout') }} </a></li>
  </form>
    </ul>
  </nav>

  
   