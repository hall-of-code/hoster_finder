@extends('Layout.main')
@section('title')
    Hoster-Finder.de - 2FA
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row flex-wrap pt-5">
            <div class="d-none d-xl-block col-xl-2"></div>
            <div class="col-12 col-xl-5 bg_telegram left_roundet_box box_shadow  mb-xl-5 mb-0 margin_top_10rem">
                <!-- Main part form and button -->
                <!-- text block -->
                <p class="mt-5 pt-2 ms-5 me-5 mb-5 text-light">
                    <b>{{ __('Du hast die 2 Faktor Authentifizierung eingeschaltet.') }}</b>
                    {{ __('Wir haben dir einen 4-stelligen TAN-Code als Email und (falls aktiviert) an deinen Telegram-account geschickt.') }}
                </p>
                <p class="mb-5 ms-5 me-5 mt-1 text-light">
                    <b>{{ __('Du hast den TAN nicht erhalten?') }}</b>
                    {{ __('Kontaktiere uns gerne via Discord oder Twitter um das aufgetretene Problem auch in Zukunft zu beheben.') }}
                </p>
            </div>
            <div class="d-flex col-12 col-xl-3 bg_tertiar right_roundet_box box_shadow mb-xl-5 mb-0 margin_top_10rem_xl d-flex justify-content-center">
                <!-- Formular -->
                <div class="w-75 mt-5 mb-4">
                    <form id="tan_code_form" action="{{ route('user.protection.post_2fa', app()->getLocale()) }}" method="POST">
                        <div id="register_form_email_border" class="register_input_box d-flex align-items-center col-xl-7 col-10 m-3 w-100">
                            <div class="register_input_icon_box justify-content-center align-items-center d-flex me-1">
                                <i id="register_form_email_icon" class="material-icons register_input_icon ms-2">https</i>
                            </div>
                            @csrf
                            <input type="number" maxlength="4" minlength="4" name="tan_code" oninput="check_tan_code()" id="tan_code_input" value="" placeholder="{{ __('4-stelliger Bestätigungscode') }}" class="register_input">
                        </div>

                        <button type="submit" class="telegram_button w-100 m-3 mb-xl-5 mb-0 text-light">
                            {{ __('Jetzt Einloggen') }}
                        </button>
                    </form>
                </div>
            </div>
            <div class="d-none d-xl-block col-xl-2"></div>
            <div class="d-none d-xl-block col-xl-2"></div>
            <div class="col-12 col-xl-8 bg_tertiar right_roundet_box box_shadow pe-4 ps-5 mt-xl-4 mt-0">
                <!-- text block -->
                <p class="mt-5 ms-5 me-5 mb-5 text-light">
                    <b>{{ __('Sicherheit kostet Zeit.') }}</b>
                    {{ __('Dir stehen zwei Varianten der 2-Faktor-Authentifizierung berreit. Hast du den Zusätzlichen Schutz aktiviert, musst du dich nach 0:00 Uhr erneut per TAN verifizieren.') }}
                    {{ __('Du kannst die 2-Faktor-Authentifizierung jederzeit in deinen Profil-Einstellungen aus- oder erneut einschalten. Es gibt Schwierigkeiten? Kein Problem wir stehen dir') }}
                    {{ __('über unsere offiziellen Support-Kanäle jederzeit zur Verfügung.') }}
                </p>
            </div>
        </div>
    </div>
@endsection

@section('optionalJS')
    <script src="{{ asset('/scripts/form_validation/2fa.js') }}"></script>
@endsection
