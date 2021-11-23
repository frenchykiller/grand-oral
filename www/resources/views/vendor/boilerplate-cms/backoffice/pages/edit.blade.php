@extends('boilerplate::layout.index', [
    'title' => __('boilerplate-cms::pages.edit.title'),
    'subtitle' => isset($page) ? __('boilerplate-cms::pages.edit.subtitle') : __('boilerplate-cms::pages.edit.add_subtitle'),
    'breadcrumb' => [
        __('boilerplate-cms::pages.edit.title') => 'cms.pages.index',
        isset($page) ? __('boilerplate-cms::pages.edit.subtitle') : __('boilerplate-cms::pages.edit.add_subtitle'),
    ]
])

@section('content')
    {!! Form::open(['route' => isset($page) ? ['cms.pages.update', $page] : 'cms.pages.store', 'method' => isset($page) ? 'patch' : 'post', 'autocomplete'=> 'off', 'id' => 'edit-page']) !!}
    <div class="row mb-2" id="header">
        <div class="col-12">
            <a href="{{ route('cms.pages.index') }}" class="btn btn-default">
                <span class="far fa-arrow-alt-circle-left"></span>
            </a>
            <button type="button" class="btn btn-secondary" data-toggle="settings" data-tooltip="{{ __('boilerplate-cms::pages.edit.parameters') }}">
                <span class="far fa-fw fa-file-alt"></span>
            </button>
            @isset($page)
                <div id="page-switch" class="dropdown d-inline">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-selected="desktop" aria-haspopup="true" aria-expanded="false" data-tooltip="{{ __('boilerplate-cms::pages.edit.edition') }}">
                        <span class="fa fa-fw fa-desktop"></span>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" data-toggle="desktop"><span class="fa fa-fw fa-desktop"></span> {{ __('boilerplate-cms::pages.edit.desktop') }}</a>
                        <a class="dropdown-item" href="#" data-toggle="tablet"><span class="fa fa-fw fa-tablet-alt"></span> {{ __('boilerplate-cms::pages.edit.tablet') }}</a>
                        <a class="dropdown-item" href="#" data-toggle="mobile"><span class="fa fa-fw fa-mobile-alt"></span> {{ __('boilerplate-cms::pages.edit.mobile') }}</a>
                    </div>
                </div>
                @ability('admin', 'cms_page_code')
                    <div class="d-inline">
                        <button type="button" class="btn btn-default" data-toggle="source" data-tooltip="{{ __('boilerplate-cms::pages.edit.code') }}">
                            <span class="fa fa-fw fa-code"></span>
                        </button>
                        <button type="button" class="btn btn-success" id="save-code" style="display: none">
                            {{ __('boilerplate-cms::pages.edit.apply') }}
                        </button>
                    </div>
                @endability
            @endisset
            <span class="float-right" id="buttons">
                @include('boilerplate-cms::backoffice.pages.buttons')
            </span>
        </div>
    </div>
    <div id="page-content">
        <div id="page-settings">
            @include('boilerplate-cms::backoffice.pages.settings')
        </div>
        @isset($page)
            <iframe id="page-iframe" style="display:none"></iframe>
            <div id="page-source" style="display:none"></div>
        @endisset
    </div>
    {!! Form::close() !!}
    <aside id="widget-sidebar">
        <div class="buttons-wrapper">
            <div class="buttons">
                <button data-toggle="widget">
                    <span class="fa fa-times"></span>
                </button>
                <button style="display: none" id="widget-attributes-submit">
                    <span class="fa fa-check"></span>
                </button>
            </div>
        </div>
        <div class="wrapper">
            <div class="content"></div>
        </div>
    </aside>
@endsection

@include('boilerplate::load.datatables')
@include('boilerplate::load.codemirror', ['theme' => 'storm'])
@include('boilerplate::load.select2')

@push('css')
    <link rel="stylesheet" type="text/css" href="{{ mix('edit.css', 'assets/vendor/boilerplate-cms') }}" />
@endpush

@push('js')
    @websocket(['userunique'])
@endpush

@push('js')
    <script>
        var msg = {!! json_encode(__('boilerplate-cms::pages.message')) !!};
        var blockListRoute = "{{ route('cms.pages.widget.list') }}";
        var parseRoute = "{{ route('cms.pages.code') }}";
        @isset($page)
            var checkDuplicate = "{{ route('cms.pages.check.duplicate', ['page' => $page]) }}";
            var blockContentRoute = "{{ route('cms.pages.block.content', ['page' => $page]) }}";
            var iframeRoute = "{{ route('cms.pages.iframe', ['page' => $page]) }}";
        @else
            var iframeRoute = false;
        @endisset
    </script>
    <script type="text/javascript" src="{{ mix('edit.js', 'assets/vendor/boilerplate-cms') }}"></script>
    <link rel="stylesheet" href="{{ mix('/select-media.min.css', '/assets/vendor/boilerplate-media-manager') }}">
@endpush
