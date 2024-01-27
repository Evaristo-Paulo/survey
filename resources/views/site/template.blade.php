<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('admin/assets/favicon.ico') }}" type="image/x-icon" />


    <link href="{{ secure_asset('site/survey/logo.png') }}" rel="icon">
    <link href="{{ secure_asset('site/survey/logo.png') }}" rel="apple-touch-icon">


    <link href="{{ url('site/survey/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
    <link href="{{ url('site/survey/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ url('site/survey/vendor/aos/aos.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('site/survey/style.css') }}">
    <link rel="stylesheet" href="{{ url('site/survey/enquete.css') }}">
    <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">

    <title>
        iask
    </title>
</head>

<body>
    <div id="container">
        @include('sweetalert::alert')
        @include('site.partials.nav')

        @yield('content')
        @include('site.partials.footer')
    </div>
    <!-- MODAL -->
    @include('site.partials.modal')
    <script src="https://code.iconify.design/2/2.0.3/iconify.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="{{ url('site/survey/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ url('site/survey/vendor/counterup/counterup.min.js') }}"></script>
    <script src="{{ url('site/survey/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ url('site/survey/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ url('site/survey/vendor/aos/aos.js') }}"></script>
    <script src="{{ url('site/survey/script.js') }}"></script>
    <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
    @stack('js')
    <script src="/js/app.js"></script>

</body>

</html>
