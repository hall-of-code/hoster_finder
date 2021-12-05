@extends('Layout.main')

@section('extraCSS')
    <link rel="stylesheet" href="{{ asset('/css/login_page_only/login_buttons.css') }}">
@endsection

@section('title')
    Hoster-Finder.de - Login
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <h6 class="col-12 col-md-4 _login_box">
                <form action="{{ route('user.login', ['locale' => \request()->route()->locale]) }}" method="post" id="l_form">
                    @if ($errors->any())
                        <div class="alert _alert_custom _text_black">
                            @foreach ($errors->all() as $error)
                                <div><b style="color: #DB3656;"> {{ $error }}</b><br><br></div>
                            @endforeach
                        </div>
                    @endif
                    @csrf
                    <input name="email" class="form-control _form_control_dark _form_abstand" value="" placeholder="{{ __('E-Mail Adresse') }}">
                    <input name="password" class="form-control _form_control_dark _form_abstand" value="" type="password" placeholder="{{ __('Passwort') }}">
                    <div class="d-flex _text_light _form_abstand" style="margin-left: 4px;"><input name="remember" type="checkbox" class="form-check" checked>&nbsp {{ __('Eingeloggt bleiben.') }}</div>
                    <div class="d-flex align-items-center justify-content-start flex-wrap mt-4">
                        <button type="submit" class="_btn_loader_father me-3 ms-1 mb-2 login-normalization _lila_button text-dark d-flex justify-content-center align-items-center">
                            <span class="me-2 _btn_loader"></span>
                            {{ __('Einloggen') }}
                        </button>
                        <a type="button" class="me-3 ms-1 mb-2 login-with-google-btn text-decoration-none">
                            {{ __('Login mit Google') }}
                        </a>
                        <a type="button" class="me-3 ms-1 mb-2 login-with-github-btn text-decoration-none">
                            {{ __('Login mit Github') }}
                        </a>
                    </div>
                    <div class="mt-4 ms-1">
                        <a class="small" href="{{ route('user.register_page', ['locale'=>request()->route()->parameter('locale')]) }}">{{ __('Noch kein Konto bei Hoster-Finder? Jetzt kostenlos Registrieren!') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('optionalJS')
    <script src="{{ asset('/scripts/quick_load_animations/button_load.js') }}"></script>
@endsection
