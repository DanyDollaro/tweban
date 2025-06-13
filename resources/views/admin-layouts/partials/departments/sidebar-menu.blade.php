<div class="sidebar-menu">
    <div id="menu-selection">
        @foreach ($data['departments'] as $dipartimento => $prestazioni)
            <div class="menu-item" data-specialization="{{ $dipartimento }}" onclick="setSelection(this)">
                {{ $dipartimento }}
            </div>
        @endforeach
    </div>
    <div id="menu-selection">
        <div class="menu-item" data-specialization="{{ $dipartimento }}" onclick="createNewDepartment(this)">
            * Nuovo dipartimento
        </div>
    </div>
</div>
