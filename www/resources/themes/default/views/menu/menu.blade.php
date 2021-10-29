<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="mainMenu">
    <ul class="navbar-nav mr-auto">
        @foreach($menu->child_items as $item)
            @include($item_view, ['item' => $item])
        @endforeach
    </ul>
</div>
