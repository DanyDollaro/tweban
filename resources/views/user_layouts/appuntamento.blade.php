
 
 <!-- Collegamento al CSS -->
  <link rel="stylesheet" href="{{ asset('css/appointment.css') }}">

 

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <form action="{{ route('appointment.submit') }}" method="POST" class="php-email-form">
      @csrf
        <h2>Prenota una prestazione con i nostri specialisti</h2> 
        
      <div class="row">
        <div class="col-md-4 form-group mt-md-0">
          <input type="text" name="name" class="form-control" placeholder="Nome e Cognome" required>
        </div>
        <div class="col-md-4 form-group mt-md-0">
          <input type="email" name="email" class="form-control" placeholder="Email" required>
        </div>
        <div class="col-md-4 form-group mt-md-0">
          <input type="tel" name="phone" class="form-control" placeholder="Telefono" required>
        </div>
      </div>

      <div class="row mt-3">
        <div class="col-md-4 form-group mt-md-0">
          <input type="datetime-local" name="date" class="form-control" required>
        </div>
        <div class="col-md-4 form-group mt-md-0">
          <select name="department" class="form-select" required>
            <option value="">Seleziona Prestazione</option>
            <option value="prestazione 1">Prestazione 1</option>
            <option value="prestazione 2">Prestazione 2</option>
            <option value="prestazione 3">Prestazione 3</option>
          </select>
        </div>
        <div class="col-md-4 form-group mt-md-0">
          <select name="doctor" class="form-select" required>
            <option value="">Seleziona Specialista</option>
            <option value="specialista 1">Specialista 1</option>
            <option value="specialista 2">Specialista 2</option>
            <option value="specialista 3">Specialista 3</option>
          </select>
        </div>
      </div>

      <div class="form-group mt-3">
        <textarea class="form-control" name="message" rows="5" placeholder="Messaggio (Opzionale)"></textarea>
      </div>

      <div class="text-center mt-4">
        <button type="submit" class="btn-submit">Prenota</button>
      </div>

    </form>

  </div>
</section>

