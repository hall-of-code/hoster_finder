<!doctype html>
<html lang="de">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('/css/main.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @yield('extraCSS', '')

    <title>
        @yield('title', 'Hoster-Finder.de - Finde deinen nächsten Hoster!')
    </title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-md-2 _bg_dark lh-100" style="border-right: 2px solid var(--c_lila);">
                <img class="_logo_nav" src="{{ asset('/res/images/logo.png') }}" alt="Hoster-Finder.de">
            </div>
            <div class="col-12 col-md-10" style="height: 100vh;">
                <div class="container-fluid __mg_top_105rem">
                    <div class="row">
                        <div class="col-12 col-md-7"></div>
                        <div class="col-12 col-md-5 d-none d-md-flex flex-md-nowrap flex-wrap justify-content-end">
                                <a class="btn _text_light" href="">{{ __('Vergleichen') }}</a>
                                <a class="btn _text_light" href="">{{ __('Hoster Liste') }}</a>
                            @if(! \Auth::check())
                                <a class="btn _lila_button text-dark px-4 ms-3 mb-2 mb-md-0" href="{{ route('user.login_page', ['locale' => \request()->route()->locale]) }}">{{ __('Login') }}</a>
                                <a class="btn _lila_button text-dark ms-2" href="{{ route('user.register_page', ['locale' => \request()->route()->locale]) }}">{{ __('Registrieren') }}</a>
                            @else
                                <div class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle _text_lila" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">{{ __('Mein Account') }}</a>
                                    <ul class="dropdown-menu _bg_ultra">
                                        <li><a class="dropdown-item _text_light d-flex align-items-center" href="#"><span class="material-icons me-2">settings</span>{{ __('Einstellungen') }}</a></li>
                                        <li><hr class="dropdown-divider _text_light"></li>
                                        <li><a class="dropdown-item _text_light d-flex align-items-center" href="#"><span class="material-icons material-icons-rounded me-2">dashboard</span>{{ __('Dashboard') }}</a></li>
                                        <li><a class="dropdown-item _text_light d-flex align-items-center" href="#"><span class="material-icons material-icons-rounded me-2">business_center</span>{{ __('Anbieter Berreich') }}</a></li>
                                        <li><a class="dropdown-item _text_light d-flex align-items-center" href="#"><span class="material-icons material-icons-rounded me-2">local_police</span>{{ __('Admin Berreich') }}</a></li>
                                        <li><hr class="dropdown-divider _text_light"></li>
                                        <li><a class="dropdown-item _text_light d-flex align-items-center _text_red" href="{{ route('user.logout', ['locale'=>request()->route()->parameter('locale')]) }}"><span class="material-icons material-icons-rounded me-2">power_settings_new</span>{{ __('Abmelden') }}</a></li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                @yield('content', '')
            </div>
        </div>
    </div>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
@yield('optionalJS', '')
<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>
</html>
