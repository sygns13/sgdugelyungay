<head>
        <meta charset = "UTF-8" />
    <title> SGD UGEL YUNGAY - @yield('htmlheader_title', '') </title>
    <link rel="icon" type="image/png" href="{{ asset('/img/logo-yungay.png') }}" />
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('login/css/bootstrapF.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('login/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('login/css/styles.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/alertify.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/spinkit.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" /> 




    




    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
