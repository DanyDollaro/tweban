function updateCalendarPerformances(performance)
{
    window.calendar.removeAllEvents();

    // Check if there are reservations
    if (!performance || !performance.prenotazioni) return;

    // Create an array of reservations to show
    const events = performance.prenotazioni.map(p => ({
        title: p.cliente_id,
        start: `${p.data_prenotazione}T${p.orario_prenotazione}`,
    }));

    // Add all the reservation to the calendar
    window.calendar.addEventSource(events);
}

function setSelection(el)
{
    // Update the menu selection
    $('.menu-item')
        .removeClass('selected');
    $(el)
        .addClass('selected');

    $('#performance-post-form').show();
    $('#new-performance-post-form').hide();

    const performance = window.data.performances.find(
        obj => obj.tipologia === el.dataset.performance
    );

    // Update the hidden element in order to contain the current performance type
    $('#hidden-performance-type').val(performance.tipologia);

    // Update the page content
    updateCalendarPerformances(performance);
}

function calendarDateClick(info)
{
    // Remove the old selection
    $('.fc-daygrid-day').removeClass('selected-day');
    // Add the current selection
    $(info.dayEl).addClass('selected-day');

    const date = info.dayEl.dataset.date;

    // Empty the selector
    $('#appointments-select').empty();

    window.data.performances.forEach(function(i, ii) {
        i.prenotazioni.forEach(function(j, jj) {
            if ((j.data_prenotazione === date) && (j.tipologia_prestazione === $('#hidden-performance-type').val())) {
                $('<option>', {
                    value: j.id,
                    text: date.toString()
                }).appendTo('#appointments-select');
            }
        });
    });

    $('#appointments-select').blur();
}

function appointmentSelectOnChange()
{
    // Get the currently selected prenotation
    const reservation = window.data.reservations.find(r => { return r.id == $(this).val()});

    // Get the associated client
    const user = window.data.users.find(u => { return u.id == reservation.cliente_id });

    $('#appointment-datetime').val(reservation.data_prenotazione);
    $('#appointment-time').val(reservation.orario_prenotazione);

    $('#p-name').text(user.nome);
    $('#p-taxidcode').text(user.codice_fiscale);
    $('#p-excluded-day').text(reservation.giorno_escluso);
    $('#p-performance').text(reservation.tipologia_prestazione);

    // Update the hidden input in order to store the reservation id
    $('#reservation-id').val(reservation.id);

}

