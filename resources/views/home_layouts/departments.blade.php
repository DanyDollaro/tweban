<!-- Departments Section -->
<section id="departments" class="departments section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Dipartimenti e Prestazioni</h2>
        <p>I nostri principali dipartimenti di servizio e le loro prestazioni in basso</p>
      </div>
      <!-- End Section Title -->
  
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              @foreach ($dipartimenti as $index => $dipartimento)
                <li class="nav-item">
                    <a class="nav-link {{ $index === 0 ? 'active show' : '' }}" data-bs-toggle="tab" href="#departments-tab-{{ $index + 1 }}">
                        {{ $dipartimento->specializzazione }}
                    </a>
                </li>
              @endforeach
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              @foreach ($dipartimenti as $index => $dipartimento)
              <div class="tab-pane {{ $index === 0 ? 'active show' : '' }}" id="departments-tab-{{ $index + 1 }}">
                <!-- 
                  ACTIVE SHOW NELLA CONDIZIONE DINAMICA PERCHE' SI VUOLE CHE LA PRIMA TAB 
                  SIA CARICATA E VISIBILE AL MOMENTO DEL CARICAMENTO DELL'INTERA PAGINA,
                  LE ALTRE SONO NASCOSTE 
                -->
                <div class="col-12">
                  <div class="container">
                    <div class="row gy-4">
                      @foreach ($prestazioni[$dipartimento->specializzazione] ?? [] as $prestazione) 
                      <!-- ACCESSO TRAMITE ARRAY ASSOCIATIVO, DOVE PER OGNI DIPARTIMENTO SI HANNO LE DETERMINATE PRESTAZIONI, 
                        UTILIZZO OPERATORE DI FALLBACK PER LIMITARE LA VISUALIZZAZIONE DI PRESTAZIONI NON CONSENTITE-->
                      <!-- Begin Service Item -->
                      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item  position-relative">
                          <h3>{{ $prestazione->tipologia }}</h3>
                          <p>{{ $prestazione->descrizione }}</p>
                          <p><b>PRESCRIZIONI: </b>{{ $prestazione->prescrizione}}</p>
                          <p><b>MEDICO ASSEGNATO: </b>{{$medici[$prestazione->tipologia]->nome .' '.  $medici[$prestazione->tipologia]->cognome}}</p>
                          @php
                            $orario = $orario_prestazioni[trim($prestazione->tipologia)] ?? null;
                          @endphp
                          @if ($orario)
                            <p>
                              <i>Disponibile dalle {{ \Carbon\Carbon::parse($orario->orario_iniziale)->format('H:i') }}
                              alle {{ \Carbon\Carbon::parse($orario->orario_finale)->format('H:i') }} <br>
                              da {{ $giorni_disponibili[$prestazione->tipologia]['inizio'] ?? 'N.D.' }}
                              a {{ $giorni_disponibili[$prestazione->tipologia]['fine'] ?? 'N.D.' }}</i>
                            </p>
                          @endif
                        </div>
                      </div>
                      <!-- End Service Item -->
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>  

    </section>
<!-- /Departments Section -->

    