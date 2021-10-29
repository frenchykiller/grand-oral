@if($item->isActive())
<li class="nav-item{{ count($item->items) > 0 ? ' dropdown' : '' }}" {!! $item->attr !!}>
    @if(count($item->items) > 0)
    <a class="nav-link dropdown-toggle" href="{{ $item->href }}" id="dropdown{{ $item->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $item->label }}</a>
    @else
    <a class="nav-link{{ url($item->href) == url()->current() ? ' active' : '' }}" href="{{ $item->href }}">{{ $item->label }}</a>
    @endif
    @if($item->items->count() !== 0)
        <div class="dropdown-menu" aria-labelledby="dropdown{{ $item->id }}">
        @foreach($item->items as $subitem)
            @if($subitem->isActive())
                <a class="dropdown-item{{ url($subitem->href) == url()->current() ? ' active' : '' }}" href="{{ url($subitem->href) }}">{{ $subitem->label }}</a>
            @endif
        @endforeach
        </div>
    @endif
    </li>
@endif
