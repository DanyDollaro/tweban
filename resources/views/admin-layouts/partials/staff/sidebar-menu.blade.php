<div class="sidebar-menu">
    <div id="menu-selection">
        @foreach ($data as $user)
            <div class="menu-item" data-specialization="{{ $user['username'] }}" onclick="setSelection(this)">
                {{ $user['username'] }}
            </div>
        @endforeach
    </div>
</div>
