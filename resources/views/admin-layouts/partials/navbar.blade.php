<div class="header">
    <div class="header-title">
        {{ $title }}
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <nav class="navbar">
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Logout</a>
        <a href="{{ route('amministratore.analytics') }}" class="nav-link">Analytics</a>
        <a href="{{ route('amministratore.dashboard') }}" class="nav-link">Dipartimenti</a>
        <a href="{{ route('amministratore.staff') }}" class="nav-link">Personale</a>
        <a href="{{ route('amministratore.performances') }}" class="nav-link">Prestazioni</a>
    </nav>
</div>
