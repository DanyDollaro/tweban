/**
 * Mostra il modale per accettare una prenotazione.
 * @param {number} id L'ID della richiesta di prenotazione.
 */
function showAcceptModal(id) {
    $('#accept-id').val(id);
    const today = new Date();
    const formattedDate = today.toISOString().split('T')[0];
    const formattedTime = today.toTimeString().split(' ')[0].substring(0, 5); // HH:MM

    // Utilizza display: flex per il centraggio del modale
    $('#accept-modal').css('display', 'flex');
}

function showModifyModal(id) {
    $('#modify-id').val(id);

    // Prendo i dati dalla riga della tabella corrispondente all'id
    const row = $(`tr[data-id="${id}"]`);
    const dataPrenotazione = row.find('td:nth-child(1)').text().trim();
    const orarioPrenotazione = row.find('td:nth-child(2)').text().trim();

    // Popolo i campi del form nel modale
    $('#modify-giorno').val(dataPrenotazione);
    $('#modify-orario').val(orarioPrenotazione);

    // Mostro il modale centrato
    $('#modify-modal').css('display', 'flex');
}


/**
 * Gestisce la conferma dell'accettazione di una prenotazione.
 */
function confirmAcceptReservation() {
    const id = $('#accept-id').val();
    const giorno = $('#accept-giorno').val();
    const orario = $('#accept-orario').val();

    if (!giorno || !orario) {
        alert('Per favore, inserisci sia il giorno che l\'ora dell\'appuntamento.');
        return;
    }
    $.ajax({
        url: `/staff/prenotazioni/${id}/accetta`,  // endpoint con id e azione specifica
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            data_prenotazione: giorno,      // CORRETTO
            orario_prenotazione: orario     // CORRETTO
        },
        success: function (response) {
            alert(response.message || 'Richiesta accettata con successo!');
            $('#accept-modal').hide();            
            const row = $(`tr[data-id="${id}"]`);
            row.find('.stato').text('Accettata'); // aggiorna stato
            row.find('td:nth-child(1)').text(giorno); // aggiorna data
            row.find('td:nth-child(2)').text(orario); // aggiorna orario

            // CREA UN NUOVO BOTTONE "Modifica" con classe corretta per il colore rosa
            const newBtn = $(`<button type="button" class="btn btn-update bottone-modifica">Modifica</button>`);
            newBtn.on('click', function () {
                showModifyModal(id);
            });

            // SOSTITUISCE l'ultima cella (quella col bottone) con il nuovo bottone
            row.find('td:last-child').html(newBtn);
        }

    });
}

function confirmModifyReservation() {
    const id = $('#modify-id').val();
    const giorno = $('#modify-giorno').val();
    const orario = $('#modify-orario').val();

    if (!giorno && !orario) {
        alert('Per favore, inserisci almeno il giorno o l\'ora dell\'appuntamento.');
        return;
    }

    const dataDaInviare = {};
    if (giorno) dataDaInviare.data_prenotazione = giorno;
    if (orario) dataDaInviare.orario_prenotazione = orario;

    $.ajax({
        url: `/staff/prenotazioni/${id}/modifica`,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            ...dataDaInviare
        },
        success: function(response) {
            alert(response.message || 'Richiesta modificata con successo!');
            $('#modify-modal').css('display', 'none');

            const row = $(`tr[data-id="${id}"]`);
            if (giorno) row.find('td:nth-child(1)').text(giorno);
            if (orario) row.find('td:nth-child(2)').text(orario);

            row.find('.stato').text('Accettata');
        },
    });
}

function deleteReservation(id) {
    if (confirm('Sei sicuro di voler eliminare questa prenotazione?')) {
        $.ajax({
            url: `/staff/prenotazioni/${id}/elimina`,
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message || 'Prenotazione eliminata con successo!');
                // Rimuovi la riga della tabella corrispondente
                $(`tr[data-id="${id}"]`).remove();
                $('#modify-modal').hide();
            },
            error: function(xhr) {
                alert('Errore durante l\'eliminazione della prenotazione.');
            }
  
        });
    }
}

$('#confirm-accept').on('click', function() {
    console.log('Conferma cliccata');
    confirmAcceptReservation();
});

$('#confirm-modify').on('click', function() {
    console.log('Conferma modifica cliccata');
    confirmModifyReservation();
});

$('#confirm-elimination').on('click', function() {
    console.log('Conferma eliminazione cliccata');
    const id = $('#modify-id').val();
    deleteReservation(id);
});
