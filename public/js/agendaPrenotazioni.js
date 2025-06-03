

/**
 * Mostra il modale per accettare una prenotazione.
 * @param {number} id L'ID della richiesta di prenotazione.
 */
function showAcceptModal(id) {
    $('#accept-id').val(id);
    const today = new Date();
    const formattedDate = today.toISOString().split('T')[0];
    const formattedTime = today.toTimeString().split(' ')[0].substring(0, 5); // HH:MM

    $('#accept-giorno').val(formattedDate); // Preimposta con la data corrente
    $('#accept-orario').val(formattedTime); // Preimposta con l'ora corrente

    // Utilizza display: flex per il centraggio del modale
    $('#accept-modal').css('display', 'flex');
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
        url: '/staff/prenotazioni/accetta-richiesta/' + id,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            giorno_appuntamento: giorno,
            orario_appuntamento: orario
        },
        success: function (response) {
            console.log('Risposta accettazione:', response);
            alert(response.message || 'Richiesta accettata con successo!');
            $('#accept-modal').hide();
            fetchAppointments(); // Ricarica le richieste per aggiornare la tabella
        },
        error: function (xhr, status, error) {
            console.error('Errore durante l\'accettazione della richiesta:', xhr.responseText);
            alert('Errore durante l\'accettazione della richiesta. Riprova più tardi.');
        }
    });
}

/**
 * Gestisce il rifiuto di una prenotazione.
 * @param {number} id L'ID della richiesta di prenotazione.
 */
/*function rifiutaPrenotazione(id) {
    if (!confirm('Sei sicuro di voler rifiutare questa richiesta di appuntamento?')) {
        return;
    }

    $.ajax({
        url: '/staff/prenotazioni/rifiuta-richiesta/' + id,
        method: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            console.log('Risposta rifiuto:', response);
            alert(response.message || 'Richiesta rifiutata con successo.');
            fetchAppointments(); // Ricarica le richieste per aggiornare la tabella
        },
        error: function (xhr, status, error) {
            console.error('Errore durante il rifiuto della richiesta:', xhr.responseText);
            alert('Errore durante il rifiuto della richiesta. Riprova più tardi.');
        }
    });
}*/