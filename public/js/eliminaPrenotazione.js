$(document).ready(function() {
    $('.btn-elimina').click(function() {
        const id = $(this).data('id');

        if (!confirm('Sei sicuro di voler eliminare questa prenotazione?')) {
            return;
        }

        $.ajax({
            url: '/paziente/prenotazioni/' + id,
            type: 'DELETE',
            data: {
                _token: window.Laravel.csrfToken
            },
            success: function(response) {
                $('#prenotazione-' + id).remove();
                $('#alert-success').text(response.success).show().delay(3000).fadeOut();
            },
            error: function(xhr) {
                let msg = 'Errore durante l\'eliminazione.';
                if(xhr.responseJSON && xhr.responseJSON.error) {
                    msg = xhr.responseJSON.error;
                }
                $('#alert-error').text(msg).show().delay(3000).fadeOut();
            }
        });
    });
});
