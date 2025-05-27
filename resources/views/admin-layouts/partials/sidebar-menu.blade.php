<div class="sidebar-menu">
    <div id="menu-selection">
        @foreach ($departments as $d)
            <div class="menu-item" data-specialization="{{ $d->specializzazione }}" onclick="setSelection(this)">
                {{ $d->specializzazione }}
            </div>
        @endforeach
    </div>
</div>
