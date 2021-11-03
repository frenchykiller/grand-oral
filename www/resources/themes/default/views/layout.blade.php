<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        @stack('meta')
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('css/app.css', 'themes/default') }}">
        @stack('css')
    </head>
    <body ontouchstart="">
        <div id="page" class="d-flex flex-column">
            @include('theme::partials.header')
            <main role="main" class="flex-grow-1">
                {!! $content !!}
            </main>
            <footer class="footer">
                <div class="container text-center">
                    <span class="text-muted">{{ config('app.name') }} &copy; {{ date('Y') }}</span>
                </div>
            </footer>
        </div>
        <script src="{{ mix('js/app.js', 'themes/default') }}"></script>
        @stack('js')
    </body>
</html>
