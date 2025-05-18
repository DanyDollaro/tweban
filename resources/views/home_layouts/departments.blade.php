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
                <div class="col-12">
                  <div class="container">
                    <div class="row gy-4">
                      @foreach ($prestazioni[$dipartimento->specializzazione] ?? [] as $prestazione) <!-- UTILIZZO OPERATORE DI CALLBACK -->
                      <!-- Begin Service Item -->
                      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item  position-relative">
                          <h3>{{ $prestazione->tipologia }}</h3>
                          <p>{{ $prestazione->descrizione }}</p>
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

    