<section id="blog-article" class="my-4">
    <article class="container">
        <div class="row">
            <div class="col-12">
                <div id="blog-article-card" class="d-flex flex-column flex-md-row py-3 bg-light">
                    @if(!empty($post->image))
                        <div class="col-12 col-md-4 mb-3">
                            <a href="{{ $post->url }}">
                                <img class="img-fluid ml-auto" src="{{ img_url($post->image, 500, 300, 'fit') }}" alt="{{ $post->image_alt ?? $post->meta_title }}">
                            </a>
                        </div>
                    @endif
                    <div class="col-12{{ $show_image ?? false == 1 ? ' col-md-8' : '' }}">
                        <h1>{{ $post->meta_title }}</h1>
                        <div
                            class="text-muted small @if(($show_author ?? false == 1) || ($show_date ?? false == 1)) mb-2 @endif">
                            @if($show_author ?? false == 1 && !empty($post->author))
                                <span class="mr-1"><a class="font-weight-bold" href="#">{{ $post->author }}</a></span>
                            @endif
                            @if($show_date ?? false == 1)
                                <time
                                    datetime="{{ $post->publish_after->setTimezone(new DateTimeZone('UTC'))->format('Y-m-d\TH:i:s') }}">
                                    {{ $post->publish_after->isoFormat(empty($date_format) ? __('boilerplate::date.lFdY') : $date_format) }}
                                </time>
                            @endif
                        </div>
                        @if(!empty($post->summary))
                            <div class="card-text">{!! $post->summary !!}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row pt-4">
            <div class="col-12">
                <div class="h3 border-bottom pb-5">
                    {!! $post->meta_description !!}
                </div>
                <div id="blog-article-content">
                    {!! $post->content !!}
                </div>
            </div>
        </div>
    </article>
</section>
