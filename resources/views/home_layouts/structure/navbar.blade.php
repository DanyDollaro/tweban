<div class="branding d-flex align-items-center">

    <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="" class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 class="sitename">Medilab</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="#hero" class="active">Home<br></a></li>
            <li><a href="#about">Chi siamo</a></li>
            <li><a href="#departments">Dipartimenti e Prestazioni</a></li>
            <li><a href="#contact">Contatti e dove trovarci</a></li>
            <li><a href="#faq">FAQ</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>


       @auth
          @switch(Auth::user()->ruolo)
              @case('paziente')
                  <a class="cta-btn d-none d-sm-block" href="{{ url('/paziente/dashboard') }}">Area Utente</a>
                  @break
              @case('staff')
                  <a class="cta-btn d-none d-sm-block" href="{{ url('/staff/dashboard') }}">Area Staff</a>
                  @break
              @case('amministratore')
                  <a class="cta-btn d-none d-sm-block" href="{{ url('/amministratore/dashboard') }}">Area Admin</a>
                  @break
          @endswitch
        @endauth

        @guest
            <a class="cta-btn d-none d-sm-block" href="{{ url('/login') }}">Login</a>
        @endguest

    </div>

</div>