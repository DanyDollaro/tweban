<div class="sidebar-menu">
    <div id="menu-selection">
        @foreach ($data as $dipartimento => $prestazioni)
            <div class="menu-item" data-specialization="{{ $dipartimento }}" onclick="setSelection(this)">
                {{ $dipartimento }}
            </div>
        @endforeach
    </div>
</div>
