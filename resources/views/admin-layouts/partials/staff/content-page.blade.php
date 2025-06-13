<div class="user-edit-form">
    <form method="POST" action="{{ route('admin.staffAction') }}">
        @csrf
        <input type="hidden" name="id" id="user-id">

        <label class="label-text">Username</label><br>
        <input type="text" name="username" id="username" required><br><br>

        <label class="label-text">Nome</label><br>
        <input type="text" name="name" id="name" required><br><br>

        <label class="label-text"> Cognome</label><br>
        <input type="text" name="surname" id="surname" required><br><br>

        <label class="label-text">Data di nascita</label><br>
        <input type="date" name="date_of_birth" id="date_of_birth" required><br><br>

        <label class="label-text">Codice Fiscale</label><br>
        <input type="text" name="codice_fiscale" id="codice_fiscale" required><br><br>

        <label class="label-text">Telefono</label><br>
        <input type="text" name="phone" id="phone" required><br><br>

        <label class="label-text">Email</label><br>
        <input type="email" name="email" id="email" required><br><br>

        <label class="label-text">Indirizzo</label><br>
        <input type="text" name="address" id="address" required><br><br>

        <label class="label-text">Nuova Password (lasciare vuoto per non modificarla)</label><br>
        <input type="password" name="password" id="password"><br><br>

        <button type="submit" name="action" value="modify" id="modify-button">Modifica</button>
        <button type="submit" name="action" value="delete" id="delete-button">Eilimina</button>
        <button type="submit" name="action" value="create" id="create-button" hidden>Crea</button>
    </form>
</div>
