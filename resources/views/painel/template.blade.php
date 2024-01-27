<!doctype html>
<html lang="en" dir="ltr">

<!-- Mirrored from nsdbytes.com/template/soccer/project/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Mar 2021 09:44:24 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>iask</title>
    <link rel="icon" href="{{ asset('admin/assets/favicon.ico') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('admin/fontawesome/css/all.min.css') }} " />
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/bootstrap/css/bootstrap.min.css') }} " />

    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/charts-c3/c3.min.css') }} " />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/main.css') }} " />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/theme1.css') }} " />
    <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">


    @stack('css')

</head>

<body class="font-montserrat">
    @include('sweetalert::alert')
    <div class="page-loader-wrapper">
        <div class="loader">
        </div>
    </div>
    <div id="main_content">
        @include('painel.includes.sidebar1')
        <div class="user_div">
            <h5 class="brand-name mb-4">Iask<a href="javascript:void(0)" class="user_btn"><i
                        class="icon-logout"></i></a></h5>
            <div class="card-body">
                <a href="{{ route('sys.utilizadores.perfil', Auth::user()->id) }}"><img class="card-profile-img"
                        src="{{ asset('admin/assets/images/user.png') }} " alt=""></a>
                <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                <span><a href="javascript:void(0)" class="__cf_email__"
                        data-cfemail="5424312031267a263d373c352630143339353d387a373b39">{{ Auth::user()->email }}</a></span>
            </div>
        </div>
        @include('painel.includes.sidebar2')
        <div class="page">
            @include('painel.includes.nav')
            @yield('content')
            <div id="logado" data-logado="{{ Auth::user()->id }}"></div>
            @include('painel.includes.footer')
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin/assets/bundles/lib.vendor.bundle.js')}} " type="d5d1e93ad4caaee1e321e262-text/javascript"></script>
    <script src="{{ asset('admin/assets/bundles/counterup.bundle.js')}} " type="d5d1e93ad4caaee1e321e262-text/javascript"></script>
    <script src="{{ asset('admin/assets/js/core.js')}} " type="d5d1e93ad4caaee1e321e262-text/javascript"></script>
    <script src="{{ asset('admin/ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js') }} "
        data-cf-settings="d5d1e93ad4caaee1e321e262-|49" defer=""></script>

    <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>

    <script>
        $(document).ready(function() {
            $(function() {
                $("#logout_btn").click(function(event) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr(
                                'content')
                        }
                    });
                    $.ajax({
                        contentType: 'application/json: charset=utf-8',
                        type: "POST",
                        url: "{{ url('sys/logout') }}",
                        success: function(response) {
                            window.location.assign("{{ url('sys/login') }}");
                        },
                        error: function(response) {}
                    });
                });
            })
        });
    </script>

    <script src="/js/app.js"></script>

    @stack('script')
</body>

<!-- Mirrored from nsdbytes.com/template/soccer/project/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Mar 2021 09:44:45 GMT -->

</html>
