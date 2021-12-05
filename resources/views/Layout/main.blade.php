<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <!-- link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Additional CSS -->
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/external/checkbox.css') }}">
    @yield('extraCSS', '')

    <title>
        @yield('title', 'Hoster-Finder.de - Finde deinen nächsten Hoster!')
    </title>
</head>
<body>
<!-- Other Layer -->
<div class="position-fixed z-index-20 vh-100 d-none d-xl-block social_banner">
    <div>
        <div class="row flex-wrap justify-content-end">
            <div class="col-12">
                <a href="" class="social_banner_item bg_discord border_discord d-flex align-items-center justify-content-center m-1">
                    <img src="{{ asset('/res/images/icons/discord.png') }}" alt="discord link" class="social_banner_icon">
                </a>
            </div>
            <div class="col-12">
                <a href="" class="social_banner_item bg_telegram border_telegram d-flex align-items-center justify-content-center m-1">
                    <img src="{{ asset('/res/images/icons/telegram.png') }}" alt="telegram link" class="social_banner_icon">
                </a>
            </div>
            <div class="col-12">
                <a href="" class="social_banner_item bg_twitter border_twitter d-flex align-items-center justify-content-center m-1">
                    <img src="{{ asset('/res/images/icons/twitter.png') }}" alt="twitter link" class="social_banner_icon">
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Layer -->
<div class="container-fluid">
    <div class="row flex-wrap">
        <div class="col-xl-2 col-12">
            <!-- Sidebar Content -->
            <div class="row flex-wrap sidebar bg_secondary">
                <!-- Links and Logo -->
                <div id="logo_box" class="col-12">
                    <img class="logo" src="{{ asset('/res/images/logo.png') }}" alt="Hoster-Finder Logo">
                </div>
                <div class="col-12">
                    @yield('menuComingSoon', '')
                </div>
            </div>
        </div>
        <div class="col-xl-10 col-12 p-0 m-0">
            <!-- Right Content -->
            <div class="container-fluid bg_primary vh-100 overflow-auto overflow_bar p-0 m-0">
                <div class="row flex-wrap m-0">
                    <div class="col-12 container m-0 p-0">
                        <div class="row flex-wrap m-0">
                            <!-- Top-Bar -->
                            <div class="col-xl-6 col-12">
                                <!-- Heading Area -->
                            </div>
                            <div class="col-xl-6 col-12 flex-column justify-content-center flex-xl-row d-flex flex-wrap justify-content-xl-end justify-content-center align-items-center">
                                <!-- Menu Bar -->
                                <a class="text-decoration-none nav_link text_light justify-content-center align-items-center d-flex m-3" href="">
                                    Anbieterliste
                                </a>
                                <a class="text-decoration-none nav_link text_light justify-content-center align-items-center d-flex m-3 me-xl-4" href="">
                                    Vergleichen
                                </a>
                                <div class="d-flex flex-wrap justify-content-center align-items-center mt-xl-0 mt-4 ms-xl-1">
                                    <a class="btn text-decoration-none nav_button me-2" href="{{ route('user.login_page', ['locale'=>request()->route()->parameter('locale')]) }}">
                                        Einloggen
                                    </a>
                                    <a class="btn text-decoration-none nav_button me-0 ms-2" href="{{ route('user.register_page', ['locale'=>request()->route()->parameter('locale')]) }}">
                                        Registrieren
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 p-0 m-0">
                        <div class="row flex-wrap m-0 p-0">
                            <!-- Content -->
                                 @yield('content', '')
                        </div>
                    </div>
                </div>
                <div class="col-12 pt-2 mt-5 bg_tertiar footer">
                    <div class="container-fluid mt-3 pb-3">
                        <div class="row align-items-center">
                            <div class="col-xl-6 col-12 d-flex justify-content-center align-items-center">
                                <div class="text_light text-decoration-none d-flex align-items-center cursor_pointer mt-3">
                                    <p class="d-flex align-items-center">Made with &nbsp
                                        <span class="material-icons material-icons-round text_light small text_red">favorite</span>
                                        &nbsp; in Germany.
                                    </p>
                                </div>
                            </div>
                            <div class="col-xl-4 col-12 d-flex justify-content-xl-end justify-content-center ">
                                <a href="" class="text_light text-decoration-none p-2 ps-3 text_red_hover">
                                    Kontakt
                                </a>
                                <a href="" class="text_light text-decoration-none p-2 ps-3 text_red_hover">
                                    Rechtliches
                                </a>
                                <a href="" class="text_light text-decoration-none p-2 ps-3 text_red_hover">
                                    Impressum
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->
<script src="https://cdn.jsdelivr.net/gh/manucaralmo/GlowCookies@3.1.4/src/glowCookies.min.js"></script>
<script>
    glowCookies.start('de', {
        style: 1,
        policyLink: 'https://link-to-your-policy.com',
        bannerDescription: 'Hoster-Finder benötigt möglicherweise Cookies um richtig zu funktionnieren.',
        bannerBackground: '#E3E3E3',
        manageBackground: '#E3E3E3',
        rejectBtnBackground: '#B4B8D7',
        acceptBtnBackground: '#7661C0',
        acceptBtnColor: '#313455',
        rejectBtnColor: '#313455',
        acceptBtnText: 'Akzeptieren',
        manageText: ' ',
        hideAfterClick: true
    });
</script>
@yield('optionalJS', '')
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>
</html>
