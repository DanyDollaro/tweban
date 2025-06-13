// Update the hours selection given the hours array
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
    const allDays = window.data.allowed_days.map(d =>
        d.valore_giorno
         .toLowerCase()
         .replace(/ì$/, 'i')
    );

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
    // Show all the elements hidden by the previvious new department page
    $('#content-available-performances').show();
    $('#content-performances').show();
    $('#content-days').show();
    $('#hours-div').show();
    $('#bok-1').show();
    $('#bok-2').show();
    $('#bok-3').show();
    $('#bok-4').show();

    // Update the menu selection
    $('.menu-item')
        .removeClass('selected');
    $(el)
        .addClass('selected');

    // Update the hide status of the buttons
    $('#modify-button').show();
    $('#delete-button').show();
    $('#create-button').hide();

    // Get the selected department data using the specialization as key
    const department   = el.dataset.specialization;
    const performances = window.data.departments[department];

    // Update the global variables according to the current selection
    $('#current_department').val(department);

    // Set the available performances
    $('#content-available-performances').empty();
    $.each(window.data.performances, function(_, p) {
        const isSelected = performances.some(perf => perf.tipologia === p.tipologia);

        $('<option>', { value: p.tipologia, text: p.tipologia, selected: isSelected }).appendTo('#content-available-performances');
    });

    // Update the content of the window
    $('#content-specialization').val(department);
    $('#content-title').text('Dipartimento ' + department);

    setPerformancesSelectionDefault(performances);
}

function availablePerformanceSelectOnChange(performances)
{
    // Update the select
    $('#content-performances').empty();
    $.each(performances, function(_, p) {
        $('<option>', {
            value: p,
            text: p
        }).appendTo('#content-performances');
    });

    // Recupera il nome del dipartimento selezionato
    const departmentKey = $('#current_department').val();

    // Crea l'array degli oggetti performance, filtrati per tipologia
    const selected_performances = window.data.performances.filter(p =>
        performances.includes(p.tipologia)
    );

    // Aggiorna direttamente la voce del dipartimento
    window.data.departments[departmentKey] = selected_performances;

    console.log("Selected performances:", selected_performances);
    console.log("Updated department:", window.data.departments[departmentKey]);
}

// This is the function associated to the select component for the performances
function performanceSelectOnChange()
{
    let selectedPerformance = $(this).val();
    // selected will contains the selected performance

    let selected = null;

    // In the first place this view was meant to get forwarded a map
    // to associate each department to the corresponding performances,
    // and each performance with each day and hours, but then I realized
    // this was not the best way to deal with it, ad I decided to add
    // in a second moment the performances array allowing me to write
    // this loop to associate new performances to an already existing
    // department
    for (const [specializzazione, performances] of Object.entries(window.data.departments)) {
        const match = performances.find(p => p.tipologia === selectedPerformance);
        if (match) {
            selected = match;
            break;
        }
    }

    setPerformanceDaysSelection(selected.giorni);
    setPerformanceDayHoursSelection(selected.orari);
}

function createNewDepartment(el)
{
    // Set the available performances
    $('#content-available-performances').empty();
    $.each(window.data.performances, function(_, p) {
        $('<option>', { value: p.tipologia, text: p.tipologia }).appendTo('#content-available-performances');
    });

    // Clear the current department
    const department = $('#current_department').val('');

    // Update the menu selection
    $('.menu-item')
        .removeClass('selected');
    $(el)
        .addClass('selected');

    $('#content-title').text('Nuovo dipartimento');

    // Reset all the components
    $('#content-specialization').val('');
    $('#content-performances').empty();
    $('#content-days').empty();
    $('input[name="hours[]"]').prop('checked', false);

    // Update the hide status of the buttons
    $('#modify-button').hide();
    $('#delete-button').hide();
    $('#create-button').show();

    // Hide the not required elements
    $('#content-available-performances').hide();
    $('#content-performances').hide();
    $('#content-days').hide();
    $('#hours-div').hide();
    $('#bok-1').hide();
    $('#bok-2').hide();
    $('#bok-3').hide();
    $('#bok-4').hide();
}

function updateSelectedHours()
{
    let selectedHours = [];
    $('input[name="hours[]"]:checked').each(function() {
        selectedHours.push($(this).val());
    });

    // Convert the hours array to an array of strings with the following format "HH:00"
    const formattedHours = selectedHours.map(h => {
        const hour = parseInt(h, 10);
        return `${hour.toString().padStart(2, '0')}:00`;
    });

    // Get the selected department and performance
    const selectedPerformance = $('#content-performances').val();

    for (const [departmentName, performances] of Object.entries(window.data.departments)) {
        const match = performances.find(p => p.tipologia === selectedPerformance);
        if (match) {
            match.orari = formattedHours;
            break;
        }
    }
}

function updateSelectedDays()
{
    const days = $(this).val();

    const performance = $('#content-performances').val();
    const department = $('#current_department').val();
    const performances = window.data.departments[department];

    console.log("target performances: ");
    console.log(performances);

    const targetPerformance = performances.find(p => {
        return p.tipologia === performance
    });

    targetPerformance.giorni = days;
}

function contentSpecializationOnChange()
{
    $('#current_department').val($('#content-specialization').val());
}
