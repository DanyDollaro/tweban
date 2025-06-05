// Funzione per ottenere la data corrente formattata in ISO per input date (YYYY-MM-DD)
function getCurrentDateISO() {
    const today = new Date();

    const day = String(today.getDate()).padStart(2, '0');
    const month = String(today.getMonth() + 1).padStart(2, '0'); // Mesi da 0
    const year = today.getFullYear();
    return `${year}-${month}-${day}`; // formato ISO valido per input[type=date]
}

// Funzione per formattare data in formato italiano (DD/MM/YYYY)
function formatDateItalian(dateString) {
    const datePart = dateString.split('T')[0]; // estrae solo 'YYYY-MM-DD'
    const [year, month, day] = datePart.split('-');
    return `${day}/${month}/${year}`;
}

// Funzione per formattare orario da stringa ISO (es: 17:19)
function formatTimeFromISO(isoString) {
    if (!isoString) return '-';
    const timePart = isoString.split('T')[1]; // "17:19:00.000000Z"
    const [hours, minutes] = timePart.split(':');
    return `${hours}:${minutes}`;
}

// Elementi HTML
const dateInput = document.getElementById('date-selector');
const serviceFilter = document.getElementById('service-filter');
const selectedDateDisplay = document.getElementById('selected-date-display');

const appointmentsResults = document.getElementById('appointments-results');
const loadingMessage = appointmentsResults ? appointmentsResults.querySelector('.loading-message') : null;
const noAppointmentsMessage = appointmentsResults ? appointmentsResults.querySelector('.no-appointments-message') : null;
const appointmentsTable = document.getElementById('appointments-table');
const appointmentsTbody = document.getElementById('appointments-tbody');

// Imposta data di oggi nell'input date e nello span (visualizzazione)
if (dateInput) {
    dateInput.value = getCurrentDateISO();
}
if (selectedDateDisplay && dateInput) {
    selectedDateDisplay.textContent = formatDateItalian(dateInput.value);
}

// Listener sulla select per filtro prestazioni
if (serviceFilter) {
    serviceFilter.addEventListener('change', function() {
        const tipologia = serviceFilter.value;

        // Pulisci i risultati
        if (appointmentsTbody) appointmentsTbody.innerHTML = '';
        if (appointmentsTable) appointmentsTable.style.display = 'none';
        if (noAppointmentsMessage) noAppointmentsMessage.style.display = 'none';

        if (!tipologia) {
            // Nessuna prestazione selezionata, esci
            return;
        }

        if (loadingMessage) loadingMessage.style.display = 'block';

        fetch(`/staff/prenotazioni-oggi/${tipologia}`)
            .then(response => {
                if (!response.ok) throw new Error('Errore nella risposta dal server');
                return response.json();
            })
            .then(data => {
                if (loadingMessage) loadingMessage.style.display = 'none';

                const now = new Date();

                // Filtra le prenotazioni per escludere quelle già svolte
                const upcomingAppointments = data.filter(item => {
                    const datePart = item.data_prenotazione.split('T')[0];
                    const timePart = item.orario_prenotazione.split('T')[1];

                    const [year, month, day] = datePart.split('-');
                    const [hour, minute] = timePart.split(':');

                    const appointmentDate = new Date(year, month - 1, day, hour, minute);

                    return appointmentDate > now;
                });

                if (!upcomingAppointments.length) {
                    if (noAppointmentsMessage) {
                        noAppointmentsMessage.style.display = 'block';
                        noAppointmentsMessage.textContent = 'Nessun appuntamento futuro trovato per la selezione.';
                    }
                    if (appointmentsTable) appointmentsTable.style.display = 'none';
                    return;
                }

                if (noAppointmentsMessage) noAppointmentsMessage.style.display = 'none';
                if (appointmentsTable) appointmentsTable.style.display = 'table';

                upcomingAppointments.forEach(item => {
                    const row = document.createElement('tr');

                    // Formatta la data in italiano
                    const dataCell = document.createElement('td');
                    dataCell.textContent = formatDateItalian(item.data_prenotazione);
                    row.appendChild(dataCell);

                    // Formatta l'orario in formato HH:MM
                    const orarioCell = document.createElement('td');
                    orarioCell.textContent = formatTimeFromISO(item.orario_prenotazione);
                    row.appendChild(orarioCell);

                    const clienteCell = document.createElement('td');
                    clienteCell.textContent = item.cliente?.id || 'ID cliente non disponibile';
                    row.appendChild(clienteCell);

                    const prestazioneCell = document.createElement('td');
                    prestazioneCell.textContent = item.tipologia_prestazione || '';
                    row.appendChild(prestazioneCell);

                    const statoCell = document.createElement('td');
                    statoCell.textContent = item.stato || '';
                    row.appendChild(statoCell);

                    appointmentsTbody.appendChild(row);
                });
            })
            .catch(error => {
                console.error('Errore nel fetch:', error);
                if (loadingMessage) loadingMessage.style.display = 'none';
                if (appointmentsTbody) appointmentsTbody.innerHTML = '';
                if (appointmentsTable) appointmentsTable.style.display = 'none';
                if (noAppointmentsMessage) {
                    noAppointmentsMessage.style.display = 'block';
                    noAppointmentsMessage.textContent = 'Errore nel caricamento delle prenotazioni.';
                }
            });
    });
}
