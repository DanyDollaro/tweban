<div class="sidebar-menu">
    <div id="menu-selection">
        @foreach ($performances as $p)
            <div class="menu-item">
                {{ $p["tipologia"]  }}
            </div>
        @endforeach
    </div>
</div>
