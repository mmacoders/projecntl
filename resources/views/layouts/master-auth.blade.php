<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>Masuk Akun</title>
    <meta name="description" content="">
    <meta name="keywords" content="" />
    <link rel="icon" type="image/png"  href="{{ asset('assets/img/ico.ico') }}" sizes="32x32">
   <link rel="stylesheet" href="assets/css/style.css">
    <link rel="manifest" href="__manifest.json">
</head>

<body class="bg-white">

    @include('partials.user.loader')

    <!-- App Capsule -->
    <div id="appCapsule" class="pt-0">
        @yield('content')
    </div>
    <!-- * App Capsule -->


    @include('partials.script.master-user')

</body>

</html>