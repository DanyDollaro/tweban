<div class="sidebar-menu">
    <div id="menu-selection">
        @foreach ($dipartimenti as $dipartimento)
            <div class="menu-item" data-specialization="{{ $dipartimento->specializzazione }}" onclick="setSelection(this)">
                {{ $dipartimento->specializzazione }}
            </div>
        @endforeach
    </div>
</div>
