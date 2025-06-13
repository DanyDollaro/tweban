$(document).ready(function() {
    console.log("Script notifiche caricato.");

    setInterval(function() {
        $.ajax({
            url: '/notifiche',
            method: 'GET',
            success: function(data) {
                let message = '';
                if(data.unreadCount > 0){
                    message = 'Hai ' + data.unreadCount + ' nuove notifiche.';
                } else {
                    message = 'Nessuna nuova notifica.';
                }
                $('#notification-message').text(message);
            },
            error: function(xhr, status, error) {
                console.error("Errore nella richiesta AJAX:", error);
            }
        });
    }, 5000); // ogni 5 secondi
});
