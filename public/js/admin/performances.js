function updateCalendarPerformances(performance) {
    window.calendar.removeAllEvents();

    // Check if there are reservations
    if (!performance || !performance.prenotazioni) return;

    // Create an array of reservations to show
    const events = performance.prenotazioni.map(p => ({
        title: p.cliente_id,
        start: `${p.data_prenotazione}T${p.orario_prenotazione}`,
        allDay: false,
    }));

    // Add all the events to the calendar
    window.calendar.addEventSource(events);
}

function setSelection(el)
{
    // Update the menu selection
    $('.menu-item')
        .removeClass('selected');
    $(el)
        .addClass('selected');

    const performance = window.data.find(
        obj => obj.tipologia === el.dataset.performance
    );

    // Update the page content
    updateCalendarPerformances(performance);
}

function calendarDateClick(info)
{

}
