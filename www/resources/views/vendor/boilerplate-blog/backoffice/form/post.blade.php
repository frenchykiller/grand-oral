{!! Form::open(['route' => isset($post) ? ['blog.post.update', $post] : 'blog.post.store', 'method' => isset($post) ? 'patch' : 'post', 'autocomplete'=> 'off', 'id' => 'edit-article']) !!}
<div class="row" id="header">
    <div class="col-12">
        <a href="{{ route('blog.post.index') }}" class="btn btn-default">
            <span class="far fa-arrow-alt-circle-left text-muted"></span>
        </a>
        <span class="float-right" id="buttons">
            @include('boilerplate-blog::backoffice.form.buttons')
        </span>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 col-xl-9">
        @component('boilerplate::card', ['color' => 'primary'])
            <div class="form-group">
                {{ Form::hidden('status', old('status', $post->status ?? 'draft'), ['id' => 'status']) }}
                <div class="form-group">
                    <div class="d-flex align-items-center" id="blog-title">
                        <span class="counter" title="{{ __('boilerplate-blog::bo.tool_tips.seo_length') }}" data-toggle="tooltip" data-field="title" data-limit="70"></span>
                        {{ Form::text('meta_title', old('meta_title', $post->meta_title ?? null), ['class' => 'form-control'.$errors->first('meta_title',' is-invalid'), 'id' => 'title', 'placeholder' => __('boilerplate-blog::bo.edit.art_title'), 'maxlength' => 255]) }}
                    </div>
                    {!! $errors->first('meta_title','<div class="error-bubble"><div>:message</div></div>') !!}
                </div>
                <div class="form-group has-feedback">
                    <label class="control-label" for="alias">{{ __('boilerplate-blog::bo.edit.slug') }}</label>
                    <div class="input-group">
                        {{ Form::text('slug', old('slug', $post->slug ?? null), ['class' => 'form-control'.$errors->first('slug',' is-invalid'), 'id' => 'alias']) }}
                        <div class="input-group-append">
                                <span class="input-group-text pointer" id="refresh-alias"
                                      title="{{ __('boilerplate-blog::bo.tool_tips.slug_gen') }}">
                                    <i class="fa fa-sync-alt">
                                    </i>
                                </span>
                        </div>
                    </div>
                    {!! $errors->first('slug','<div class="error-bubble"><div>:message</div></div>') !!}
                </div>
                <div class="form-group">
                    <label class="control-label" for="description">Problématique</label>
                    <span class="counter tip" title="{{ __('boilerplate-blog::bo.tool_tips.description_length') }}" data-field="description" data-limit="160"></span>
                    {{ Form::textarea('meta_description', old('meta_description', $post->meta_description ?? null), ['class' => 'form-control'.$errors->first('meta_description',' is-invalid'), 'id' => 'description', 'rows' => 3]) }}
                    {!! $errors->first('meta_description', '<div class="error-bubble"><div>:message</div></div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::textarea('summary', old('summary', $post->summary ?? null), ['class' => 'form-control'.$errors->first('summary',' is-invalid'), 'id' => 'summary', 'placeholder' => 'Résumé']) }}
                    {!! $errors->first('summary','<div class="error-bubble"><div>:message</div></div>') !!}
                </div>
                <div class="form-group article">
                    {{ Form::textarea('content', old('content', $post->content ?? null), ['class' => 'form-control'.$errors->first('content',' is-invalid'), 'id' => 'content', 'placeholder' => __('boilerplate-blog::bo.edit.content')]) }}
                    {!! $errors->first('content','<div class="error-bubble"><div>:message</div></div>') !!}
                </div>
            </div>
        @endcomponent
    </div>

    <div class="col-lg-4 col-xl-3" id="form-article-aside">
        @include('boilerplate-blog::backoffice.form.post_aside')
    </div>
</div>
{!! Form::close() !!}
