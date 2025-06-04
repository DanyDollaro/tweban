// Update the days list based on the currently selected perforamnce
function setPerformanceDaysSelection(days)
{
    const allDays = ['lunedi', 'martedi', 'mercoledi', 'giovedi', 'venerdi', 'sabato', 'domenica'];

    $('#content-days').empty();

    $.each(allDays, function(_, day) {
        const isSelected = days.includes(day);

        $('<option>', {
            value: day,
            text: day,
            selected: isSelected
        }).appendTo('#content-days');
    });
}

// Update the performances selection for the current department
function setPerformancesSelection(performances)
{
    $('#content-performances').empty();
    $.each(performances, function(_, p) {
      $('<option>', { value: p.tipologia, text: p.tipologia }).appendTo('#content-performances');
    });
    // Set the first entry as selected
    $('#content-performances option:first').prop('selected', true);

    setPerformanceDaysSelection(performances[0].giorni);
}

// Update the selection of the menu and update the content view
function setSelection(el) {
    // Update the menu selection
    $('.menu-item')
        .removeClass('selected');
    $(el)
        .addClass('selected');

    // Get the selected department data using the specialization as key
    const department   = el.dataset.specialization;
    const performances = window.data[department];

    // Update the content of the window
    $('#content-specialization')
        .val(department);
    $('#content-title')
        .text('Dipartimento ' + department);

    setPerformancesSelection(performances);
}

function calendarDateClick(info) {
    info.dayEl.style.backgroundColor = '#ffcc00';
}
