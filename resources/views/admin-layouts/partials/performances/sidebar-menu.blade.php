<div class="sidebar-menu">
    <div id="menu-selection">
        @foreach ($performances as $p)
            <div class="menu-item" data-performance="{{ $p["tipologia"]  }}" onclick="setSelection(this)">
                {{ $p["tipologia"]  }}
            </div>
        @endforeach
    </div>
</div>
