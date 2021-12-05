@extends('Layout.main')

@section('extraCSS')
    <link rel="stylesheet" href="{{ asset('/css/login_page_only/login_buttons.css') }}">
@endsection

@section('title')
    Hoster-Finder.de - Registrieren
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-4 _login_box">
                <form action="{{ route('user.register', ['locale' => \request()->route()->locale]) }}" method="post" id="r_form">
                    @if ($errors->any())
                        <div class="alert _alert_custom _text_black">
                            @foreach ($errors->all() as $error)
                                <div><b style="color: #DB3656;"> {{ $error }}</b><br><br></div>
                            @endforeach
                        </div>
                    @endif
                    @csrf
                    <input name="username" class="form-control _form_control_dark _form_abstand" value="" placeholder="{{ __('Username') }}">
                    <input name="email" class="form-control _form_control_dark _form_abstand" value="" placeholder="{{ __('E-Mail Adresse') }}">
                    <input name="password" class="form-control _form_control_dark _form_abstand" value="{{ $placeholder_password ?? '' }}" type="password" placeholder="{{ __('Passwort (min. 12 Zeichen)') }}">
                    <div class="d-flex _text_light _form_abstand mb-5 mt-4 d-flex align-items-start" style="margin-left: 4px;"><input name="accept" type="checkbox" class="form-check" checked><p class="ms-2">{{ __('Ich Akzeptiere die allgemeinen Community Richtlinien.') }}</p></div>
                    <div class="h-captcha mb-2 ms-1" data-sitekey="3d13f6a1-9e2e-4d3e-a0ab-62fc334e2d98"></div>
                    <div class="d-flex align-items-center justify-content-md-between justify-content-center flex-wrap flex-md-nowrap mt-5 ms-1 me-1">
                        <button type="submit" class="_btn_loader_father mb-2 login-normalization login-width _lila_button text-dark d-flex justify-content-center align-items-center">
                            <span class="me-2 _btn_loader"></span>
                                {{ __('Account Erstellen') }}
                        </button>
                        <a type="button" href="{{ route('user.socialite.redirect', ['locale'=>request()->route()->locale, 'method'=>1]) }}" class="mb-2 login-width justify-content-center login-with-google-btn text-decoration-none">
                            {{ __('Über Google') }}
                        </a>
                        <a type="button" href="{{ route('user.socialite.redirect', ['locale'=>request()->route()->locale, 'method'=>2]) }}" class="mb-2 login-width justify-content-center login-with-github-btn text-decoration-none">
                            {{ __('Über Github') }}
                        </a>
                    </div>
                    <div class="mt-4 ms-1">
                            <a class="small" href="{{ route('user.login_page', ['locale'=>request()->route()->parameter('locale')]) }}">{{ __('Du hast schon einen Account? Hier gehts zum Login!') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('optionalJS')
    <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
    <script src="{{ asset('/scripts/quick_load_animations/button_load.js') }}"></script>
@endsection
