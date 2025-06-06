// Update the hours selection given the haurs array
function setPerformanceDayHoursSelection(hours)
{
    // Deselect all the checkbox
    $('input[name="hours[]"]').prop('checked', false);

    hours.forEach(function(timeStr) {
        // Take the "HH" part and convert it to an int
        const hour = parseInt(timeStr.split(':')[0], 10);

        $('input[name="hours[]"][value="' + hour + '"]').prop('checked', true);
    });
}

// Update the days list based on the given days array
function setPerformanceDaysSelection(days)
{
    const allDays = [
        'lunedi',
        'martedi',
        'mercoledi',
        'giovedi',
        'venerdi',
        'sabato',
        'domenica'
    ];

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
function setPerformancesSelectionDefault(performances)
{
    $('#content-performances').empty();
    $.each(performances, function(_, p) {
      $('<option>', { value: p.tipologia, text: p.tipologia }).appendTo('#content-performances');
    });
    // Set the first entry as selected
    $('#content-performances option:first').prop('selected', true);

    setPerformanceDaysSelection(performances[0].giorni);
    setPerformanceDayHoursSelection(performances[0].orari);
}

// Update the selection of the menu and update the content view
function setSelection(el)
{
    // Update the menu selection
    $('.menu-item')
        .removeClass('selected');
    $(el)
        .addClass('selected');

    // Get the selected department data using the specialization as key
    const department   = el.dataset.specialization;
    const performances = window.data[department];

    // Update the global variables according to the current selection
    window.current_department = department;

    // Update the content of the window
    $('#content-specialization')
        .val(department);
    $('#content-title')
        .text('Dipartimento ' + department);

    setPerformancesSelectionDefault(performances);
}

// This is the function associated to the select component for the performances
function performanceSelectOnChange()
{
    let selectedPerformance = $(this).val();

    const performances = window.data[window.current_department];
    const selected = performances.find(
        p => p.tipologia === selectedPerformance
    );

    if (selected)
    {
        setPerformanceDaysSelection(selected.giorni);
        setPerformanceDayHoursSelection(selected.orari);
    }
}
