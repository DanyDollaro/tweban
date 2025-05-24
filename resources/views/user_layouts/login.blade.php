<!-- resources/views/login.blade.php -->

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login Utente</title>

  <!-- Collegamento al CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

  <div class="form-container">
    <h2>Accedi al tuo Account</h2>

    <form action="{{ route('login.post') }}" method="POST">
      @csrf <!-- Token CSRF obbligatorio -->

      <div class="form-group">
        <label for="email">Nome Utente</label>
        <input type="email" id="emial" name="email" required />
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
      </div>

      <button type="submit" class="submit-btn">Accedi</button>
    </form>
  </div>

</body>
</html>


