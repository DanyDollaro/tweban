<!-- Used to store the current performance type -->
<input type="hidden" id="hidden-performance-type">

<form method="POST" action="{{ route('amministratore.updateReservation') }}" style="display: contents;">
    @csrf

    <!-- Used to store the reservation id -->
    <input type="hidden" id="reservation-id" name="reservation_id">

    <div id="calendar" style="flex: 1; margin-bottom: 20px;"></div>

    <div style="width: 100%; height: 400px; margin-bottom: 20px;">
        <select multiple id="appointments-select" style="width: 100%; height: 100%;" onchange="appointmentSelectOnChange"></select>
    </div>

    <label class="label-text">Nome</label>
    <p id="p-name"></p>

    <label class="label-text">Codice fiscale</label>
    <p id="p-taxidcode"></p>

    <label class="label-text">Giorno escluso</label>
    <p id="p-excluded-day"></p>

    <label class="label-text">Prestazione richiesta</label>
    <p id="p-performance"></p>

    <label class="label-text">Data dell'appuntamento</label>
    <input type="date" id="appointment-datetime" name="appointment-datetime" style="margin-bottom: 20px">

    <label class="label-text">Orari dell'appuntamento</label>
    <input type="time" id="appointment-time" name="appointment-time">

    <button style="margin: 20px 0px 0px 0px;">Modifica</button>
</form>
