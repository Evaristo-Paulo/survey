@extends('painel.template')
@section('content')
    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('admin/assets/images/gallery/6.jpg') }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Nome</h5>
                            <p class="card-text" style="margin-top: -10px">
                                {{ $utilizador->name }}
                            </p>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Email</h5>
                            <p class="card-text" style="margin-top: -10px">
                                {{ $utilizador->email }}
                            </p>
                        </div>

                        <div class="card-body">
                            <h5 class="card-title">Perfil</h5>
                            <p class="card-text" style="margin-top: -10px">
                                {{ $utilizador->role()->first()->role }}
                            </p>
                        </div>

                        <div class="card-body">
                            <a href="{{ url()->previous() }}" class="btn-sm btn-primary" style="padding: 6px 10px"><i
                                    class="fa fa-arrow-left" data-toggle="tooltip" title="Voltar"></i></a>
                            <button class="btn-sm btn-primary" data-toggle="modal" data-target="#actualizar_info"><i
                                    class="fa fa-edit"></i></button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        @if (!empty($utilizador->password))
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Actualização de Senha</h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">Para que estejas
                                            sempre seguro, tenha a garantia de que usas uma senha longa e forte!
                                        <p>

                                        <form action="{{ url('sys/utilizadores/senha/actualizacao') }}" method="post"
                                            class="mt-4">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $utilizador->id }}">

                                            <div class="form-group">
                                                <label class="form-label">Senha Actual:</label>
                                                <input type="password" value="{{ old('current_password') }}"
                                                    class="form-control @error('current_password') is-invalid @enderror"
                                                    name="current_password" required placeholder="Digite a senha actual">
                                                @error('current_password')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Nova Senha:</label>
                                                <input type="password" value="{{ old('password') }}"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required placeholder="Digite a nova senha">
                                                @error('password')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Confirma Senha:</label>
                                                <input type="password"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    name="password_confirmation" required placeholder="Confirma a senha">
                                                @error('password_confirmation')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn text-white tag tag-success"
                                                    style="background-color: green">Actualizar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Apagar Conta</h3>
                                </div>
                                <div class="card-body">
                                    <p class="card-text">Apagar a conta permanentemente!
                                    <p>

                                    <form action="{{ url('sys/utilizadores/remocao') }}" method="post" class="mt-4"
                                        id="form_conta_apagar">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $utilizador->id }}">

                                        <div class="d-flex justify-content-end">
                                            <button type="button" id="conta_apagar"
                                                class="btn text-white tag tag-success">Apagar conta</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('painel.utilizadores.modal.actualizacao_info')
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $(function() {
                $("#conta_apagar").click(function(event) {
                    swal({
                            title: "Tens a certeza?",
                            text: "Não poderá recuperar esta conta novamente!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Confirmar",
                            closeOnConfirm: false
                        },
                        function() {
                            $("#form_conta_apagar").submit()
                        });
                });
            })
        });
    </script>
@endpush
