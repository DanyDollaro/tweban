// Update the selection of the menu and update the content view
function setSelection(el) {
    // Update the menu selection
    $('.menu-item')
        .removeClass('selected');
    $(el)
        .addClass('selected');

    // Get the selected departments data using the specialization as key
    const department = window.departments
        .find(d => d.specializzazione === el.dataset.specialization);

    // Update the content of the window
    $('#content-specialization')
        .val(department.specializzazione);
    $('#content-title')
        .text('Dipartimento ' + department.specializzazione);
}

function calendarDateClick(info) {
    console.log('Giorno cliccato:', info.dateStr);
}
