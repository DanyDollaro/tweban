<!-- About Section: VANNO INSERITI I PARAGRAFI "LA NOSTRA STORIA", "STRUTTURA E ATTREZZATURA MEDICA" E "STAFF MEDICO" -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4 gx-5">

          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="200">
            <img src="{{ asset('img/about.jpg') }}" class="img-fluid" alt="">
          </div>

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
          <h3>Il Nostro Poliambulatorio</h3>
          <p>
            Il nostro centro medico è una struttura sanitaria moderna e accogliente, specializzata in attività ambulatoriali polispecialistiche, situata nel cuore della città.
          </p>
          <ul>
            <li>
              <i class="fa-solid fa-hand-holding-medical"></i>
              <div>
                <h5>Missione e Servizi Offerti</h5>
                <p>
                  Promuoviamo la salute attraverso diagnosi accurate, cure tempestive e un approccio personalizzato al paziente, grazie alla presenza di medici esperti in vari dipartimenti.
                </p>
              </div>
            </li>
            <li>
              <i class="fa-solid fa-location-dot"></i>
              <div>
                <h5>Contatti e Localizzazione</h5>
                <p>
                  Ci trovi in Via della Salute 12, Ancona. Per informazioni e prenotazioni puoi contattarci al numero 071 123456 o scrivere a info@poliambulatorio.it.
                </p>
              </div>
            </li>
            <li>
              <i class="fa-solid fa-door-open"></i>
              <div>
                <h5>Accesso ai Servizi</h5>
                <p>
                  I servizi sono accessibili previa prenotazione online o telefonica. Il sito consente di consultare orari, disponibilità e accedere alle informazioni sui dipartimenti attivi.
                </p>
              </div>
            </li>
          </ul>
        </div>

      </div>

      @include('home_layouts.contents.gallery')

    </section>
<!-- /About Section -->