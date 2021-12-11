<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=ISO-8859-1">
</head>
<body style="">
    <p>
        {{ __("Hallo") }} {{ $username }}, <br>
            {{ __("Willkommen bei Hoster-Finder! Dein Bestätigungscode lautet: ") }} <b> {{ $confirm_code }} </b> <br>
            {{ __("Oder klicke einfach bequem hier direkt auf den Link:") }}
        <a href=" {{ Route('user.account.verify', ['locale' => app()->getLocale(), 'code' => $confirm_code, 'uid' => $uid]) }}">
            {{ Route('user.account.verify', ['locale' => app()->getLocale(), 'code' => $confirm_code, 'uid' => $uid]) }}
        </a> <br>
            {{ __("Viel Spaß!") }}
</p>
</body>
</html>
