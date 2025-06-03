document.addEventListener('DOMContentLoaded', function(){
        //funzione per ottenere la data corrente e formattarla 
        function getCurrentDateFormatted(){
            const today= new Date();
            const day= String (today.getDate()).padStart(2,'0');
            //today.getDate(): Ottiene il giorno del mese (es. 1, 2, ..., 10, 11, ..., 31).
            //String(...): Converte questo numero in una stringa.
            //.padStart(2, '0'): Questa è la parte chiave. Questo metodo controlla la lunghezza della stringa risultante. 
            // Se la stringa è più corta di 2 caratteri (cioè, se il giorno è 1-9), aggiunge '0' all'inizio finché la stringa non raggiunge 2 caratteri.
            // Se la stringa è già di 2 o più caratteri (cioè, il giorno è 10-31), non fa nulla e la lascia così com'è.
            const month= String(today.getMonth()+1).padStart(2,'0');//in JavaScript i mesi partono da 0 quindi aggiungo +1.
            //Quando usi today.getMonth(), il valore che ti viene restituito è questo indice basato su zero. Così avrò
            //Gennaio=1 invece di Gennaio=0
            const year = today.getFullYear();
            return `${day}/${month}/${year}`;
            //La riga returnday/{month}/${year}; serve a costruire la stringa finale della data nel formato desiderato (gg/mm/aaaa) 
            //e a restituirla alla funzione che l'ha chiamata.
            }
            // Seleziona gli elementi HTML necessari
            //Trova il campo input della data
            const dateInput = document.getElementById('date-selector'); 
            //Nuovo elemento per il filtro
            const serviceFilter = document.getElementById('service-filter'); 
            //Trova lo span dove mostrare la data
            const selectedDateDisplay = document.getElementById('selected-date-display');

            //Gestione degli appuntamenti
            const appointmentsResults = document.getElementById('appointments-results');
            const loadingMessage = appointmentsResults ? appointmentsResults.querySelector('.loading-message') : null;
            const noAppointmentsMessage = appointmentsResults ? appointmentsResults.querySelector('.no-appointments-message') : null;
            const appointmentsListTable = appointmentsResults ? appointmentsResults.querySelector('.appointments-list') : null;
            const appointmentsListBody = appointmentsListTable ? appointmentsListTable.querySelector('tbody') : null;
            //Queste righe di codice utilizzano un'espressione condizionale (l'operatore ternario "? :"") 
            //combinata con un controllo di null (o un valore falsy) per garantire che l'accesso alle proprietà 
            //o ai metodi di un oggetto avvenga solo se l'oggetto stesso esiste.

            // Pulsante di stampa (assumendo che esista nel tuo HTML)
            const printButton = document.getElementById('print-button');

            //Imposta la data del giorno
            const todayFormatted = getCurrentDateFormatted();
            //Se l'input della data esiste, imposta il suo valore
            if (dateInput) {
                dateInput.value = todayFormatted;
            }
            //Se lo span esiste, imposta il suo testo
            if (selectedDateDisplay) {
                selectedDateDisplay.textContent = todayFormatted;
            }

            //Funzione principale per recuperare e visualizzare gli appuntamenti
            function fetchAndDisplayAppointmenta(){
              //  if (loadingMessage) loadingMessage.style.display=CSSLayer
            }
        })