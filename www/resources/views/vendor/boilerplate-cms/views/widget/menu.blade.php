<nav{!! empty($id) ? '' : ' id="'.$id.'"' !!}{!! empty($class) ? '' : ' class="'.$class.'"' !!}>
    <ol class="list-unstyled">
        @foreach($menu->child_items($tree_origin_id)->get() as $item)
            @include($item_view, ['item' => $item])
        @endforeach
    </ol>
</nav>
