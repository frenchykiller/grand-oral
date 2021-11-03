@if($item->isActive())
    <li class="col-3 mb-4" {!! $item->attr !!}>
        <x-boilerplate::card>
            <a href="{{ $item->href }}">{!! $item->label !!}</a>
        </x-boilerplate::card>
    </li>
@endif
