<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Modifica Profilo</title>
    <link rel="stylesheet" href="{{ asset('css/editprofile.css') }}">
  
</head>

<body>
   
    
    <div class="background-blur"></div>

    <div class="main-content">
        <h2>Modifica Profilo</h2>

        <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PUT') 


            <table>
                <tr>
                    <td>
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" value="{{ old('nome', $user->nome) }}">
                    </td>
                    <td>
                        <label for="cognome">Cognome</label>
                        <input type="text" id="cognome" name="cognome" value="{{ old('cognome', $user->cognome) }}">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}">
                    </td>
                    <td>
                        <label for="telefono">Telefono</label>
                        <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $user->telefono) }}">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="data_nascita">Data di Nascita</label>
                        <input type="date" id="data_nascita" name="data_nascita" value="{{ old('data_nascita', $user->data_nascita) }}">
                    </td>
                    <td>
                        <label for="codice_fiscale">Codice Fiscale</label>
                        <input type="text" id="codice_fiscale" name="codice_fiscale" value="{{ old('codice_fiscale', $user->codice_fiscale) }}">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <label for="indirizzo">Indirizzo</label>
                        <input type="text" id="indirizzo" name="indirizzo" value="{{ old('indirizzo', $user->indirizzo) }}">
                    </td>
                </tr>
            </table>

            <div class="form-actions">
                <button type="submit" class="btn-save">Salva Modifiche</button>
                <a href="{{ route('dashboard') }}" class="btn-cancel">Annulla</a>
            </div>
        </form>
    </div>
</body>
</html>
