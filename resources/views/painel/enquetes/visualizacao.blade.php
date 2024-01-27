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
                            <p class="card-text" style="margin-top: -10px">{{ $enquete['nome'] }}
                            </p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Descrição</h5>
                            <p class="card-text" style="margin-top: -10px">{{ $enquete['descricao'] }}
                            </p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Data de registo</h5>
                            <p class="card-text" style="margin-top: -10px">
                                {{ date('Y-m-d', strtotime($enquete['data_registo'])) }}
                            </p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Data de encerramento</h5>
                            <p class="card-text" style="margin-top: -10px">
                                {{ date('Y-m-d', strtotime($enquete['data_encerramento'])) }}
                            </p>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Estado</h5>
                            @if ($enquete['estado'] == 1)
                                <p class="card-text" style="margin-top: -10px"><span class="tag tag-success"
                                        style="background-color: green">Activa</span>
                                </p>
                            @else
                                <p class="card-text" style="margin-top: -10px"><span class="tag tag-error">Encerrada</span>
                                </p>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">URL</h5>
                            <div class="d-flex justify-content-between align-center">
                                <input type="text" id="link-url" value="{{ $enquete['url'] }}" readonly
                                    class="form-control mr-3" style="margin-top: -10px" />
                                <button class="btn tag tag-info" id="copiar_url">Copiar</button>
                            </div>
                        </div>
                        <div class="card-body">
                            <a href="{{ url()->previous() }}" class="btn-sm btn-primary" style="padding: 6px 10px"><i
                                    class="fa fa-arrow-left" data-toggle="tooltip" title="Voltar"></i></a>
                            <button class="btn-sm btn-primary" data-toggle="modal" data-target="#actualizar_cabecalho"><i
                                    class="fa fa-edit"></i></button>
                            <button class="btn-sm btn-primary" data-toggle="modal"
                                data-target="#adicionar_pergunta_enquete"><i class="fa fa-plus"></i></button>
                            <button class="btn-sm btn-primary"><i class="fa fa-share-alt" data-toggle="modal" data-target="#envio_por_email"></i></button>
                            <a href="{{ $enquete['url'] }}" class="btn-sm btn-primary" style="padding: 6px 10px" target="_blank"><i class="fa fas fa-solid fa-globe" data-toggle="tooltip"
                                    title="Aceder no site"></i></a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Apagar</h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ url('sys/enquetes/remocao') }}" method="POST" id="form_enquete_apagar">
                                @csrf()
                                <input type="hidden" name="id" value="{{ $enquete['id'] }}">

                                <a class="btn btn-sm hidden-xs tag-success js-sweetalert btn-link text-white"
                                    id="enquete_apagar" href="javascript:void(0)" data-toggle="tooltip" title="Delete"><i
                                        class="fa fa-trash"></i></a>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-body widgets1">
                                    <div class="icon">
                                        <i style="border: 4px solid red; border-radius: 50%; padding: 1px 7px "
                                            class="fa-solid fa fas fa-question text-success font-30"></i>
                                    </div>
                                    <div class="details">
                                        <h6 class="mb-0 font600">Total Perguntas</h6>
                                        <span class="mb-0">{{ $enquete['total_pergunta'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-sm-6">
                            <div class="card">
                                <div class="card-body widgets1">
                                    <div class="icon">
                                        <i class="fas fa fa-thumbs-up text-primary font-30"></i>
                                    </div>
                                    <div class="details">
                                        <h6 class="mb-0 font600">Total Votos </h6>
                                        <span class="mb-0">{{ $enquete['voto'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-blog-tab" data-toggle="pill" href="#pills-blog"
                                role="tab" aria-controls="pills-blog" aria-selected="true">Perguntas</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-blog" role="tabpanel"
                            aria-labelledby="pills-blog-tab">
                            @foreach ($enquete['perguntas'] as $key => $pergunta)
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $key + 1 }}. {{ $pergunta['pergunta'] }}</h3>
                                        <div class="card-options">
                                            <a href="#" class="card-options-collapse"
                                                data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <button class="btn tag tag-error mb-3">{{ $pergunta['tipo_modelo'] }}</button>
                                        <ol class="list-group list-group-numbered">
                                            @foreach ($pergunta['alternativas'] as $alternativa)
                                                <li
                                                    class="list-group-item d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto">
                                                        <p class="mb-0">{{ $alternativa['alternativa'] }}</p>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <a href="javascript::void(0)">
                                                            <span class="badge bg-primary rounded-pill"><i
                                                                    class="fas fa fa-thumbs-up"></i>
                                                                {{ $alternativa['voto'] }}</span>
                                                        </a>

                                                        <form
                                                            action="{{ route('sys.enquete.pergunta.alternativa.remocao') }}"
                                                            method="POST" class="ml-1">
                                                            @csrf()
                                                            <input type="hidden" name="id"
                                                                value="{{ $alternativa['id'] }}">
                                                            <input type="hidden" name="pergunta_id"
                                                                value="{{ $pergunta['id'] }}">

                                                            <button type="submit"
                                                                class="badge bg-success btn-xm rounded-pill"><i
                                                                    class="fas fa fa-trash px-2"></i></button>
                                                        </form>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ol>

                                        <button class="btn-sm btn-primary mt-4" data-toggle="modal"
                                            data-target="#actualizar_alternativa_{{ $pergunta['id'] }}"><i
                                                class="fa fa-edit"></i></button>

                                        <form class="d-inline ml-2" action="{{ url('sys/enquetes/perguntas/remocao') }}"
                                            method="post">
                                            @csrf()

                                            <input type="hidden" name="id" value="{{ $pergunta['id'] }}">
                                            <button class="btn-sm btn tag-success pergunta_apagar"><i
                                                    class="fa fa-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('painel.enquetes.modal.actualizacao_cabecalho')
    @include('painel.enquetes.modal.adiciona_pergunta')
    @include('painel.enquetes.modal.actualizacao_alternativa')
    @include('painel.enquetes.modal.envio_por_email')
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $(function() {
                $("#enquete_apagar").click(function(event) {
                    swal({
                            title: "Tens a certeza?",
                            text: "Não poderá recuperar esta enquete novamente!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "Confirmar",
                            closeOnConfirm: false
                        },
                        function() {
                            $("#form_enquete_apagar").submit()
                        });
                });
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#copiar_url').click(function() {
                var textToCopy = $('#link-url').val();
                var tempTextarea = $('<textarea>');
                $('body').append(tempTextarea);
                tempTextarea.val(textToCopy).select();
                document.execCommand('copy');
                tempTextarea.remove();

                // Copy the text inside the text field
                $(this).text('Copiado!')
            });
        });
    </script>
@endpush
