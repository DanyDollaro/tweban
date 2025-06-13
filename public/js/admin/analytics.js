// Update the selection menu showing the performances types
function showPerformances(menu) {
    window.data.performances.forEach(i => {
        const item = $('<div></div>')
            .addClass('menu-item')
            .attr('data-id', i.tipologia)
            .attr('data-type', 'performance')
            .text(i.tipologia)
            .on('click', function () {
                setSelection(this);
            });
        menu.append(item);
    });
}

// Update the selection menu showing the departments
function showDepartments(menu) {
    // The departments are stored into a map, in this cose their key are used to create an array
    Object.keys(window.data.departments).forEach(i => {
        const item = $('<div></div>')
            .addClass('menu-item')
            .attr('data-id', i)
            .attr('data-type', 'department')
            .text(i)
            .on('click', function () {
                setSelection(this);
            });
        menu.append(item);
    });
}

// Update the selection menu showing the patients
function showPatients(menu) {
   window.data.patients.forEach(i => {
        const item = $('<div></div>')
            .addClass('menu-item')
            .attr('data-id', i.id)
            .attr('data-type', 'patient')
            .text(i.codice_fiscale)
            .on('click', function () {
                setSelection(this);
            });
        menu.append(item);
    });
}

function showGroup(type) {
    const menu = $('#menu-selection');
    menu.empty();

    switch (type) {
        case 'performances':
            showPerformances(menu);
        break;
        case 'departments':
            showDepartments(menu);
        break;
        case 'patients':
            showPatients(menu);
        break;
    }
}

function getPerformanceReservations(type) {
    return window.data.reservations.filter(i => {
        const startDate = $('#start_date').val();
        const endDate = $('#end_date').val();

        const inRange =
            i.data_prenotazione >= startDate &&
            i.data_prenotazione  <= endDate;

        return i.tipologia_prestazione === type && inRange;
    });
}

function getDepartmentReservations(sp_department) {
    // Get all the performances associated with the given department
    const performances = window.data.performances.filter(i => {
        return i.sp_dipartimento === sp_department;
    });

    // Extract all the performance types from those performances
    const types = performances.map(i => i.tipologia);

    // Get the start and end dates from input fields
    const startDate = $('#start_date').val();
    const endDate = $('#end_date').val();

    const reservations = window.data.reservations.filter(i => {
        const inRange = i.data_prenotazione >= startDate && i.data_prenotazione <= endDate;
        return types.includes(i.tipologia_prestazione) && inRange;
    });

    return reservations;
}

// id indicate the user id
function getPatientReservations(id) {
    return window.data.reservations.filter(i => {
        const startDate = $('#start_date').val();
        const endDate = $('#end_date').val();

        const inRange =
            i.data_prenotazione >= startDate &&
            i.data_prenotazione  <= endDate;

        return i.cliente_id === id && inRange;
    });
}

function setSelection(el) {
    // Update the menu selection
    $('.menu-item')
        .removeClass('selected');
    $(el)
        .addClass('selected');

    const message_base = 'prestazioni erogate: ';

    // Hide all the divs
    $('#performances-div').hide();
    $('#patients-div').hide();
    $('#departments-div').hide();

    // Set the div and the data to show based on the type
    switch($(el).data('type'))
    {
        case 'department':
            $('#departments-div').show();
            $('#departments-message').text(message_base + getDepartmentReservations($(el).data('id')).length);
            console.log(getDepartmentReservations($(el).data('id')));
        break;

        case 'performance':
            $('#performances-div').show();
            $('#performance-message').text(message_base + getPerformanceReservations($(el).data('id')).length);
            console.log(getPerformanceReservations($(el).data('id')));
        break;

        case 'patient':
            $('#patients-div').show();
            $('#patients-message').text(message_base + getPatientReservations($(el).data('id')).length);
            console.log(getPatientReservations($(el).data('id')));
        break;
    }
}

function searchBarOnInput() {
        const search = $(this).val().toLowerCase();

    $('.menu-item').each(function() {
        const name = $(this).text().toLowerCase();

        name.includes(search)
            ? $(this).show()
            : $(this).hide();
    });
}
