<div class="sidebar-menu">
    <div id="menu-selection">
        @foreach ($data as $user)
            <div class="menu-item" data-taxidcode="{{ $user['codice_fiscale'] }}" onclick="setSelection(this)">
                {{ $user['username'] }}
            </div>
        @endforeach
        <div class="menu-item" id="new-user-selection" onclick="showNewUserContent()">
            * Nuovo utente
        </div>
    </div>
</div>
