//utilizzo js per disattivare le selezioni
document.addEventListener('DOMContentLoaded', () => {
    const dipSelect = document.getElementById('dipartimento_select');
    const dipText = document.getElementById('dipartimento_text');
    const prestSelect = document.getElementById('prestazione_select');
    const prestText = document.getElementById('prestazione_text');

    function toggleFields() {
        if (dipSelect.value) {
            dipText.disabled = true;
            prestSelect.disabled = true;
            prestText.disabled = true;
        } else if (dipText.value) {
            dipSelect.disabled = true;
            prestSelect.disabled = true;
            prestText.disabled = true;
        } else if (prestSelect.value) {
            prestText.disabled = true;
            dipSelect.disabled = true;
            dipText.disabled = true;
        } else if (prestText.value) {
            prestSelect.disabled = true;
            dipSelect.disabled = true;
            dipText.disabled = true;
        } else {
            dipSelect.disabled = false;
            dipText.disabled = false;
            prestSelect.disabled = false;
            prestText.disabled = false;
        }
    }

    dipSelect.addEventListener('change', toggleFields);
    dipText.addEventListener('input', toggleFields);
    prestSelect.addEventListener('change', toggleFields);
    prestText.addEventListener('input', toggleFields);

    // Al caricamento della pagina aggiorno subito lo stato
    toggleFields();
});
