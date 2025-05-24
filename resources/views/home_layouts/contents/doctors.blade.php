<!-- Doctors Section -->
   {{--   <section id="doctors" class="doctors section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Dottori in servizio</h2>
        <p>I nostri dottori più esperti</p>
      </div><!-- End Section Title -->

      <div class="container">
        <div class="row gy-4">
          @foreach($medico as $medico)
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member d-flex align-items-start">
              <div class="pic"><img src="{{ asset('img/doctors/doctors-'. ($loop->index + 1) .'.jpg') }}" class="img-fluid" alt=""></div>
              <div class="member-info">
                <h4>{{ $medico->nome .' '.$medico->cognome }}</h4>
                <span><b>Prestazione associata: </b>{{ $medico->prestazione_assegnata }} </span>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""> <i class="bi bi-linkedin"></i> </a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->
          @endforeach

        </div>

      </div>

    </section><!-- /Doctors Section -->--}}