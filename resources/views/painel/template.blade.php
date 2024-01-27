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
                <a href="page-profile.html"><img class="card-profile-img"
                        src="{{ asset('admin/assets/images/sm/avatar1.jpg') }} " alt=""></a>
                <h6 class="mb-0">Peter Richards</h6>
                <span><a href="https://nsdbytes.com/cdn-cgi/l/email-protection" class="__cf_email__"
                        data-cfemail="5424312031267a263d373c352630143339353d387a373b39">[email&#160;protected]</a></span>
                <div class="d-flex align-items-baseline mt-3">
                    <h3 class="mb-0 mr-2">9.8</h3>
                    <p class="mb-0"><span class="text-success">1.6% <i class="fa fa-arrow-up"></i></span></p>
                </div>
                <div class="progress progress-xs">
                    <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    <div class="progress-bar bg-info" role="progressbar" style="width: 20%" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-orange" role="progressbar" style="width: 5%" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-indigo" role="progressbar" style="width: 13%" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <h6 class="text-uppercase font-10 mt-1">Performance Score</h6>
                <hr>
                <p>Activity</p>
                <ul class="new_timeline">
                    <li>
                        <div class="bullet pink"></div>
                        <div class="time">11:00am</div>
                        <div class="desc">
                            <h3>Attendance</h3>
                            <h4>Computer Class</h4>
                        </div>
                    </li>
                    <li>
                        <div class="bullet pink"></div>
                        <div class="time">11:30am</div>
                        <div class="desc">
                            <h3>Added an interest</h3>
                            <h4>“Volunteer Activities”</h4>
                        </div>
                    </li>
                    <li>
                        <div class="bullet green"></div>
                        <div class="time">12:00pm</div>
                        <div class="desc">
                            <h3>Developer Team</h3>
                            <h4>Hangouts</h4>
                            <ul class="list-unstyled team-info margin-0 p-t-5">
                                <li><img src="{{ asset('admin/assets/images/xs/avatar1.jpg') }} " alt="Avatar"></li>
                                <li><img src="{{ asset('admin/assets/images/xs/avatar2.jpg') }} " alt="Avatar">
                                </li>
                                <li><img src="{{ asset('admin/assets/images/xs/avatar3.jpg') }} " alt="Avatar">
                                </li>
                                <li><img src="{{ asset('admin/assets/images/xs/avatar4.jpg') }} " alt="Avatar">
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="bullet green"></div>
                        <div class="time">2:00pm</div>
                        <div class="desc">
                            <h3>Responded to need</h3>
                            <a href="javascript:void(0)">“In-Kind Opportunity”</a>
                        </div>
                    </li>
                    <li>
                        <div class="bullet orange"></div>
                        <div class="time">1:30pm</div>
                        <div class="desc">
                            <h3>Lunch Break</h3>
                        </div>
                    </li>
                    <li>
                        <div class="bullet green"></div>
                        <div class="time">2:38pm</div>
                        <div class="desc">
                            <h3>Finish</h3>
                            <h4>Go to Home</h4>
                        </div>
                    </li>
                </ul>
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
