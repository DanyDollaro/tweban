<div class="user-edit-form">
    <form id="edit-user-form" method="POST" action="">
        <input type="hidden" name="id" id="user-id">

        <label for="username">Username</label><br>
        <input type="text" name="username" id="username" required><br><br>

        <label for="nome">Nome</label><br>
        <input type="text" name="nome" id="nome" required><br><br>

        <label for="cognome">Cognome</label><br>
        <input type="text" name="cognome" id="cognome" required><br><br>

        <label for="data_nascita">Data di nascita</label><br>
        <input type="date" name="data_nascita" id="data_nascita" required><br><br>

        <label for="telefono">Telefono</label><br>
        <input type="text" name="telefono" id="telefono" required><br><br>

        <label for="email">Email</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <label for="indirizzo">Indirizzo</label><br>
        <input type="text" name="indirizzo" id="indirizzo" required><br><br>

        <label for="password">Nuova Password (lasciare vuoto per non modificarla)</label><br>
        <input type="password" name="password" id="password"><br><br>

        <button type="submit">Salva modifiche</button>
    </form>
</div>
