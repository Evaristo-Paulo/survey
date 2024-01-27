<!doctype html>
<html lang="en" dir="ltr">

<!-- Mirrored from nsdbytes.com/template/soccer/project/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Mar 2021 09:44:24 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('admin/assets/favicon.ico') }}" type="image/x-icon" />
    <title>iask</title>

    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/bootstrap/css/bootstrap.min.css') }} " />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/main.css') }} " />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/theme1.css') }} " />
    @stack('css')

</head>

<body class="font-montserrat">
    <table class="body-wrap"
        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;"
        bgcolor="#f6f6f6">
        <tbody>
            <tr
                style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                <td style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;"
                    valign="top"></td>
                <td class="container" width="600"
                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;"
                    valign="top">
                    <div class="content"
                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">
                        <table class="main" width="100%" cellpadding="0" cellspacing="0" itemprop="action"
                            itemscope="" itemtype="http://schema.org/ConfirmAction"
                            style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; margin: 0; border: none;">
                            <tbody>
                                <tr
                                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                    <td class="content-wrap"
                                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;padding: 30px;border: 3px solid #67a8e4;border-radius: 7px; background-color: #fff;"
                                        valign="top">
                                        <meta itemprop="name" content="Confirm Email"
                                            style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                        <table width="100%" cellpadding="0" cellspacing="0"
                                            style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                            <tbody>
                                                <tr
                                                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                    <td class="content-block"
                                                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                                        valign="top">
                                                        Prezado(a),
                                                    </td>
                                                </tr>
                                                <tr
                                                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                    <td class="content-block"
                                                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                                        valign="top">
                                                        Estamos a conduzir uma enquete importante e valorizamos muito
                                                        a sua participação. Ela tem como título <span
                                                            style="font-weight: bold">"{{ $enquete->nome }}"</span>
                                                </tr>
                                                <tr
                                                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                    <td class="content-block"
                                                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                                        valign="top">
                                                        Sei que o seu tempo é precioso, mas garantimos que a enquete não
                                                        deve levar mais de 5 minutos. Sua
                                                        participação é totalmente voluntária, mas ficaríamos imensamente
                                                        gratos se você pudesse reservar um momento para responder.
                                                </tr>
                                                <tr
                                                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                    <td class="content-block"
                                                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                                        valign="top">
                                                        Agradecemos antecipadamente pela sua atenção e participação, e
                                                        tiver alguma dúvida, não
                                                        hesite em entrar em contato conosco.
                                                </tr>
                                                <tr
                                                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                    <td class="content-block" itemprop="handler" itemscope=""
                                                        itemtype="http://schema.org/HttpActionHandler"
                                                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                                        valign="top">
                                                        <a href="{{ $enquete->url }}" class="btn-primary" itemprop="url"
                                                            style="width: 200px !important; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #000; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #F8BE86; margin: 0;">Visualizar
                                                            enquete</a>
                                                    </td>
                                                </tr>
                                                <tr
                                                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                    <td class="content-block"
                                                        style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;"
                                                        valign="top">
                                                        <p>Anteciosamente</p>
                                                        <b>{{ $remetente->name }}</b>
                                                        <p>{{ $remetente->email }}</p>
                                                        <p>IASK</p>
                                                    </td>
                                                </tr>

                                                <tr
                                                    style="font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
                                                    <td class="content-block"
                                                        style="text-align: center;font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0;"
                                                        valign="top">
                                                        &copy; {{ date('Y') }} IASK
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin/assets/bundles/lib.vendor.bundle.js')}} " type="d5d1e93ad4caaee1e321e262-text/javascript"></script>
    <script src="{{ asset('admin/assets/js/core.js')}} " type="d5d1e93ad4caaee1e321e262-text/javascript"></script>
    <script src="{{ asset('admin/ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js') }} "
        data-cf-settings="d5d1e93ad4caaee1e321e262-|49" defer=""></script>
</body>

</html>
