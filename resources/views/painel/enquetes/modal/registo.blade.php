<div class="modal fade" id="adicionar_enquete" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-xl" role="document">
        <form class="modal-content" method="POST" id="form_adicionar_enquete" action="{{ url('sys/enquetes/registo') }}">
            @csrf
            <input type="hidden" name="referencia" id="referencia" value="{{ $uniqueid }}">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel"><i class="fa fa-plus"></i> Registo de Nova Enquete</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="d-lg-flex justify-content-between">
                            <ul class="nav nav-tabs page-header-tab">
                                <li class="nav-item"><a class="nav-link active show" id="sessao_cabecalho"
                                        data-toggle="tab" href="#seccao_enquete">1. Cabeçalho</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" id="sessao_pergunta" data-toggle="tab"
                                        href="#seccao_pergunta">2. Pergunta</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-12" id="sessao_alerta">
                        <div class="alert alert-success d-none unstyled list-unstyled">
                            <ul style="margin-bottom: 0px; padding-left: 0px ">
                                <li id='alerta_sucesso' class="unstyled list-unstyled"></li>
                            </ul>
                        </div>
                        <div class="alert alert-danger d-none unstyled list-unstyled">
                            <ul style="margin-bottom: 0px; padding-left: 0px ">
                                <li id='alerta_erro' class="unstyled list-unstyled"></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="seccao_enquete">
                                <div class="row clearfix">
                                    <div class="col-12">
                                        <label class="form-label">Nome: </label>
                                        <div class="form-group">
                                            <input type="text" name="nome" id="nome" required
                                                class="form-control" placeholder="Digite o nome">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Descrição:</label>
                                            <textarea name="descricao" id="descricao" required class="form-control" placeholder="Digite a descrição" cols="30"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Data de Início: </label>
                                            <div class="form-group">
                                                <input type="text" readonly value="{{ date('d/m/Y') }}"
                                                    name="" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Data de Encerramento: </label>
                                            <div class="form-group">
                                                <input type="date" required name="data_encerramento"
                                                    id="data_encerramento" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="seccao_pergunta">
                                <div class="row clearfix">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="form-label">Pergunta:</label>
                                            <textarea name="pergunta" id="pergunta" class="form-control" placeholder="Digite a pergunta" cols="30"
                                                rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Modelo de Resposta:</label>
                                            <select class="form-control" name="modelo" id="modelo">
                                                @foreach ($modelos as $item)
                                                    @if ($item->id == 1)
                                                        <option selected value="{{ $item->id }}">
                                                            {{ $item->nome }}
                                                        </option>
                                                    @else
                                                        <option selected value="{{ $item->id }}">
                                                            {{ $item->nome }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="form-label">Nº Alternativas: </label>
                                            <input type="number" id="num_alternativa" required
                                                name="num_alternativa" class="form-control"
                                                placeholder="Digite número de alternativas">
                                        </div>
                                    </div>
                                </div>
                                <div id="alternativas" class="row clearfix">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success tag tag-primary" id="adicionar_pergunta">Anexar
                    pergunta</button>
                <button type="submit" class="btn text-white tag tag-success" id="adicionar_pergunta_successo" disabled
                    style="background-color: green">Concluir
                    processo</button>
            </div>
    </div>
</div>
@push('script')
    <script>
        $('#adicionar_pergunta').hide();
        //CAPTURAR CLICK EM UMA DAS SESSÕES
        $(document).ready(function() {
            $(function() {
                $("#sessao_cabecalho").click(function(event) {
                    $('#adicionar_pergunta').hide();
                });
            })
        });
    </script>

    <script>
        //CAPTURAR CLICK EM UMA DAS SESSÕES
        $(document).ready(function() {
            $(function() {
                $("#sessao_pergunta").click(function(event) {
                    $('#adicionar_pergunta').show();
                });
            })
        });
    </script>

    <script>
        $(document).ready(function() {
            $(function() {
                $("#num_alternativa").change(function(event) {
                    qtde_linha = event.target.value
                    $("#alternativas").empty()

                    if (qtde_linha >= 2) {
                        for (i = 1; i <= qtde_linha; i++) {
                            $("#alternativas").append(
                                "<div class='col-6'><div class='form-group'><label class='form-label'>" +
                                i +
                                "ª Alternativa:</label><input type='text' name='alternativas' required class='form-control alternativas' placeholder='Digite a " +
                                i + "ª alternativa'></div></div>"
                            );
                        }
                    } else if (qtde_linha != 0) {
                        $('#alerta_erro').text('Deve ter no mínimo 2 alternativas.');
                        $("#sessao_alerta .alert-danger").removeClass(
                            "d-none");

                        setTimeout(function() {
                            $("#sessao_alerta .alert-danger").addClass(
                                "d-none");
                            $('#alerta_erro').text('');
                        }, 3000)
                    }
                });
            })
        });
    </script>

    <script>
        //ADICIONAR PERGUNTAS NA TABELA TEMPORÁRIA
        $(document).ready(function() {
            $(function() {
                $("#adicionar_pergunta").click(function(event) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr(
                                'content')
                        }
                    });

                    var referencia = $('#referencia').val();
                    var nome = $('#nome').val();
                    var descricao = $('#descricao').val();
                    var data_encerramento = $('#data_encerramento').val();
                    var pergunta = $('#pergunta').val();
                    var total_alternativa = $('#num_alternativa').val();
                    var modelo = $('#modelo').val();
                    var objects = $('.alternativas');
                    var error = false

                    var alternativas = [];

                    for (var obj of objects) {
                        if (obj.value == '') {
                            error = true
                        }
                        alternativas.push(obj.value);
                    }

                    var dados = {
                        "referencia": referencia,
                        "pergunta": pergunta,
                        "total_alternativa": total_alternativa,
                        "modelo": modelo,
                        "alternativas": alternativas,
                    };

                    if (pergunta == '' || descricao == '' || nome == '' || data_encerramento ==
                        '') {
                        error = true
                    }

                    if (error) {
                        $('#alerta_erro').text('Verifique todos os campos e tenta novamente.');
                        $("#sessao_alerta .alert-danger").removeClass(
                            "d-none");
                        setTimeout(function() {
                            $("#sessao_alerta .alert-danger").addClass(
                                "d-none");
                            $('#alerta_erro').text('');
                        }, 3000)
                    } else {
                        $.ajax({
                            contentType: 'application/json: charset=utf-8',
                            type: "POST",
                            url: "{{ url('sys/enquetes/perguntas/anexo') }}",
                            data: JSON.stringify(dados),
                            success: function(response) {
                                console.log(response)
                                $('#alerta_sucesso').text(response.mensagem);
                                $('#adicionar_pergunta_successo').prop("disabled",
                                    false);
                                $("#sessao_alerta .alert-success").removeClass(
                                    "d-none");
                                setTimeout(function() {
                                    $("#sessao_alerta .alert-success").addClass(
                                        "d-none");
                                    $('#alerta_sucesso').text('');
                                    $('#pergunta').val('');
                                    $('#num_alternativa').val(0);
                                    $("#alternativas").empty()
                                }, 3000)
                            },
                            error: function(response) {
                                console.log('error', response)
                            }
                        });
                    }
                });
            })
        });
    </script>
@endpush
