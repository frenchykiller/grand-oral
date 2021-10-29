@if($item->isActive())
    <div class="col-3 mb-4">
    <x-boilerplate::card>
        @slot('header')
            <li{!! $item->attr !!}>
                <a href="{{ $item->href }}">{!! $item->label !!}</a>
                @if($item->items->count() !== 0)
                    @php($ol = false)
                    @foreach($item->items as $subitem)
                        @if($subitem->isActive() && $ol === false)
                            <ol class="list-unstyled">
                                @php($ol = true)
                                @endif
                                @include($item_view, ['item' => $subitem])
                                @endforeach
                                @if($ol === true)
                            </ol>
                        @endif
                        @endif
            </li>
        @endslot
    </x-boilerplate::card>
    </div>
@endif
