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
            .attr('data-id', i.tipologia)
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
            .attr('data-id', i.codice_fiscale)
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

function setSelection(el) {
    // Update the menu selection
    $('.menu-item')
        .removeClass('selected');
    $(el)
        .addClass('selected');

    // Get the selection type
    switch($(el).data('type'))
    {
        case 'patient':

        break;

        case 'department':
        break;

        case 'performance':
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
