<header class="d-lg-flex flex-column justify-content-center">
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex flex-column flex-lg-row align-items-lg-center">
                    <div class="d-flex flex-row justify-content-between py-2">
                        <button class="d-lg-none mobile-menu px-0" aria-label="Menu">
                            <i class="fas fa-bars fa-2x"></i>
                        </button>
                    </div>
                    <div id="menu-wrapper">
                        <div class="d-flex flex-column flex-lg-row justify-content-start align-items-lg-center">
                            <a class="navbar-brand h1 mb-0" href="/">{{ config('app.name') }}</a>
                            @widget('boilerplate-cms::menu', ['slug' => 'main-menu', 'id' => 'main-menu'])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
