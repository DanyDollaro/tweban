<!-- Collegamento al CSS -->
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">

<div class="profile-container">
    <h2>Profilo Personale</h2>
    <div class="profile-photo">
        <img src="{{ asset('img/omino-removebg-preview.png') }}" alt="Foto profilo" class="profile-pic"/>
    </div>
    <div class="photo-label"></div>

    <div class="info">
        <h3>{{ Auth::user()->nome }} {{ Auth::user()->cognome }}</h3>
        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
        <p><strong>Telefono:</strong> {{ Auth::user()->telefono }}</p>
        <p><strong>Data di nascita:</strong> {{ Auth::user()->data_nascita }}</p>
        <p><strong>Codice Fiscale:</strong> {{ Auth::user()->codice_fiscale }}</p>
        <p><strong>Indirizzo:</strong> {{ Auth::user()->indirizzo }}</p>
    </div>

    <div class="buttons">
        <a href="{{ route('profile.edit') }}">
            <button>Modifica Profilo ✏️</button>
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

