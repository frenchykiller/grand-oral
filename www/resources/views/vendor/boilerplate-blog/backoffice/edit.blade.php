@extends('boilerplate::layout.index', [
    'title' => __('boilerplate-blog::bo.edit.title'),
    'subtitle' => __('boilerplate-blog::bo.edit.subtitle'),
    'breadcrumb' => [
        __('boilerplate-blog::bo.edit.title') => 'blog.post.index',
        __('boilerplate-blog::bo.edit.subtitle'),
    ]
])

@section('content')
    <section class="content" id="form-article">
        @include('boilerplate-blog::backoffice.form.post')
    </section>
@endsection

@include('boilerplate-media-manager::load.tinymce')
@include('boilerplate::load.select2')
@include('boilerplate::load.datepicker')
@include('boilerplate::load.datatables')

@push('js')
    @if(isset($post))
        @websocket(['userunique' => ['url' => 'post']])
    @endif
@endpush

@push('js')
    <script>
        var locales = {!! json_encode(__('boilerplate-blog::bo')) !!};

        var routes = {
            ajaxIndex: "{{ route('blog.post.index') }}",
            ajaxEdit: "{{ route('blog.post.edit', ':id') }}",
            ajaxPreview: "{{ route('blog.post.preview') }}",
            ajaxPreviewPost: "{{ route('blog.post.previewPost') }}",
            ajaxCompare: "{{ route('blog.post.compare') }}",
            ajaxRevertChange: "{{ route('blog.change.revert') }}",
            ajaxCommitChange: "{{ route('blog.change.commit') }}",
            @isset($post)
                ajaxDelete: "{{ route('blog.post.destroy', $post) }}",
                ajaxDuplicate: "{{ route('blog.post.duplicate', $post) }}",
            @endisset
        };
    </script>
    <script src="{{ mix('/article.min.js', '/assets/vendor/boilerplate-blog') }}"></script>
@endpush

@push('css')
    <link rel="stylesheet" href="{{ mix('/article.min.css', 'assets/vendor/boilerplate-blog') }}">
@endpush
