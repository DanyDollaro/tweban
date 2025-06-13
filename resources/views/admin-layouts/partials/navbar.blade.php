<div class="header">
    <div class="header-title">
        {{ $title }}
    </div>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <nav class="navbar">
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Logout</a>
        <a href="/admin/analytics" class="nav-link">Analytics</a>
        <a href="/admin/dipartimenti" class="nav-link">Dipartimenti</a>
        <a href="/admin/personale" class="nav-link">Personale</a>
        <a href="/admin/prestazioni" class="nav-link">Prestazioni</a>
    </nav>
</div>
