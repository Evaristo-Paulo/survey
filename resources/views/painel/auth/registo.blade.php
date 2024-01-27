<!doctype html>
<html lang="en" dir="ltr">

<!-- Mirrored from nsdbytes.com/template/soccer/project/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Mar 2021 09:45:08 GMT -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('admin/assets/favicon.ico') }}" type="image/x-icon" />
    <title>Cadastra-se | iask</title>
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/bootstrap/css/bootstrap.min.css') }} " />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/main.css') }} " />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/theme1.css') }} " />
    @stack('css')
</head>

<body class="font-montserrat">
    <div class="auth">
        <form class="auth_left" method="POST" action="{{ url('sys/register') }}">
            @csrf()

            <div class="card">
                <div class="text-center mb-2">
                    <a class="header-brand" href="index-2.html"><i class="fa fa-soccer-ball-o brand-logo"></i></a>
                </div>
                <div class="card-body">
                    <div class="card-title">Criar nova conta</div>
                    <div class="form-group">
                        <label class="form-label">Nome:</label>
                        <input type="text" required class="form-control  @error('name') is-invalid @enderror"
                            value="{{ old('name') }}" name="name" placeholder="Digite o nome">
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Digite o email">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Senha:</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required id="exampleInputPassword1" placeholder="Digite a senha">
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Confirma Senha:</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation" required id="exampleInputPassword1"
                            placeholder="Confirma a senha">
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="termos" />
                            <span class="custom-control-label">Concordo com os <a href="#">termos e
                                    políticas</a></span>
                        </label>
                    </div>
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block">Criar</button>
                    </div>
                </div>
                <div class="text-center text-muted">
                    Já tem uma conta? <a href="{{ url('sys/login') }}">Faça login</a>
                </div>
            </div>
        </form>
        <div class="auth_right full_img"></div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('admin/assets/bundles/lib.vendor.bundle.js')}} " type="45b31778f469fa4508371aee-text/javascript"></script>
    <script src="{{ asset('admin/assets/js/core.js')}} " type="45b31778f469fa4508371aee-text/javascript"></script>
    <script src="{{ asset('admin/ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js') }} "
        data-cf-settings="45b31778f469fa4508371aee-|49" defer=""></script>

    <script>
        $(document).ready(function() {
            $(function() {
                $(".auth_left").submit(function(event) {
                    event.preventDefault()
                    let termos = $("#termos")
                    // VERIFICA SE O TERMO FOI ACEITE
                    if(termos.is(':checked')){
                        $(".auth_left").submit()
                    }
                });
            })
        });
    </script>
</body>

<!-- Mirrored from nsdbytes.com/template/soccer/project/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 17 Mar 2021 09:45:08 GMT -->

</html>
