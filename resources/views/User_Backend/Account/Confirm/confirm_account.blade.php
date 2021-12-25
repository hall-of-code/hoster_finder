@extends('Layout.main')
@section('title')
    Hoster-Finder.de - Confirm
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row flex-wrap pt-5">
            <div class="d-none d-xl-block col-xl-2"></div>
            <div class="col-12 col-xl-5 bg_tertiar left_roundet_box box_shadow d-flex justify-content-center mb-xl-5 mb-0 margin_top_10rem">
                <!-- Main part form and button -->
                <div class="w-75 mt-5 mb-4">
                    <form id="confirm_code_form" action="{{ route('user.account.confirm_post', app()->getLocale()) }}" method="POST">
                        <div id="register_form_email_border" class="register_input_box d-flex align-items-center col-xl-7 col-10 m-3 w-100">
                            <div class="register_input_icon_box justify-content-center align-items-center d-flex me-1">
                                <i id="register_form_email_icon" class="material-icons register_input_icon ms-2">password</i>
                            </div>
                            @csrf
                            <input name="confirm_code" oninput="check_confirm_code()" id="confirm_code_input" value="" placeholder="{{ __('6-stelliger Bestätigungscode') }}" class="register_input">
                        </div>

                        <button type="submit" class="account_create_button w-100 m-3 mb-xl-5 mb-0 text_light">
                            {{ __('Account bestätigen') }}
                        </button>
                    </form>
                </div>
            </div>
            <div class="d-none d-xl-flex col-xl-3 bg_lila right_roundet_box box_shadow mb-5 margin_top_10rem">
                <!-- Lila block -->
            </div>
            <div class="d-none d-xl-block col-xl-2"></div>
            <div class="d-none d-xl-block col-xl-2"></div>
            <div class="d-none d-xl-flex col-xl-2 bg_lila left_roundet_box box_shadow mt-xl-4 mt-0">
                <!-- Little lila block -->

            </div>
            <div class="col-12 col-xl-6 bg_tertiar right_roundet_box box_shadow pe-4 ps-5 mt-xl-4 mt-0">
                <!-- text block -->
                <p class="mt-5 ms-5 me-5 mb-4 text-light">
                    <b>{{ __('Verifizierungs Email nicht angekommen?') }}</b>
                    {{ __('Melde dich gerne bei uns per Mail, Discord oder über Twitter um deinen Account manuell zu bestätigen.') }}
                </p>
                <p class="mb-5 ms-5 me-5 mt-1 text-light">
                    <b>{{ __('Warum muss ich meinen Account bestätigen?') }}</b>
                    {{ __('Um sicher zu gehen, dass es sich um einen echte Person handelt, ist eine Bestätigung deines Accounts notwendig.') }}
                    {{ __('Der Besitz eines Zweit-Accounts ist erlaubt, solange man diesen als Zweitaccount kennzeichnet (unter: Mein Profil > Identitäten),') }}
                    {{ __('dieser Schritt ist erforderlich um sicherzustellen, dass Neutralität gewehrleistet ist (Follower, Bewertungen, Gewinnspiel Teilname, uvm.)') }}
                </p>
            </div>
            <div class="d-none d-xl-block col-xl-2"></div>
        </div>
    </div>
@endsection

@section('optionalJS')
    <script src="{{ asset('/scripts/form_validation/confirmation.js') }}"></script>
@endsection
