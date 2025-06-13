function setSelection(el)
{
    $('#modify-button').show();
    $('#delete-button').show();
    $('#create-button').hide();

    // Aggiorna la selezione del menu
    $('.menu-item').removeClass('selected');
    $(el).addClass('selected');

    const codiceFiscale = $(el).data('taxidcode');
    const user = window.data.find(u => u.codice_fiscale === codiceFiscale);

    $('#user-id').val(user.id);
    $('#username').val(user.username);
    $('#name').val(user.nome);
    $('#surname').val(user.cognome);
    $('#date_of_birth').val(user.data_nascita);
    $('#codice_fiscale').val(user.codice_fiscale);
    $('#phone').val(user.telefono);
    $('#email').val(user.email);
    $('#address').val(user.indirizzo);
}

function showNewUserContent()
{
    // Aggiorna la selezione del menu
    $('.menu-item').removeClass('selected');
    $('#new-user-selection').addClass('selected');

    $('#modify-button').hide();
    $('#delete-button').hide();
    $('#create-button').show();


    $('#user-id').val('');
    $('#username').val('');
    $('#name').val('');
    $('#surname').val('');
    $('#date_of_birth').val('');
    $('#codice_fiscale').val('');
    $('#phone').val('');
    $('#email').val('');
    $('#address').val('');
}
