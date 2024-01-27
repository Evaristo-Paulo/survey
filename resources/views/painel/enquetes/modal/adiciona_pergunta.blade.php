<div class="modal fade" id="adicionar_pergunta_enquete" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form class="modal-content" method="POST" action="{{ url('sys/enquetes/perguntas/actualizacao-de-anexo') }}">
            @csrf
            <input type="hidden" name="referencia" id="referencia" value="{{ $uniqueid }}">
            <input type="hidden" name="id" value="{{ $enquete['id'] }}">

            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel"><i class="fa fa-plus"></i> Anexa Nova Pergunta</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
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
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Pergunta:</label>
                            <textarea name="pergunta" id="pergunta_add" class="form-control" placeholder="Digite a pergunta" cols="30"
                                rows="2"></textarea>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">Modelo de Resposta:</label>
                            <select class="form-control" name="modelo" id="modelo_add">
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
                            <input type="number" id="num_alternativa_add" required name="num_alternativa"
                                class="form-control" placeholder="Digite número de alternativas">
                        </div>
                    </div>
                </div>
                <div id="alternativas" class="row clearfix">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success tag tag-success" id="adicionar_pergunta">Anexar
                    pergunta</button>
                <button type="submit" class="btn text-white tag tag-success" id="adicionar_pergunta_successo_add" disabled
                    style="background-color: green">Concluir
                    processo</button>
            </div>
        </form>
    </div>
</div>
@push('script')
    <script>
        $(document).ready(function() {
            $(function() {
                $("#num_alternativa_add").change(function(event) {
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
                    var pergunta = $('#pergunta_add').val();
                    var total_alternativa = $('#num_alternativa_add').val();
                    var modelo = $('#modelo_add').val();
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

                    if (pergunta == '') {
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
                                $('#adicionar_pergunta_successo_add').prop("disabled",
                                    false);
                                $("#sessao_alerta .alert-success").removeClass(
                                    "d-none");
                                setTimeout(function() {
                                    $("#sessao_alerta .alert-success").addClass(
                                        "d-none");
                                    $('#alerta_sucesso').text('');
                                    $('#pergunta_add').val('');
                                    $('#num_alternativa_add').val(0);
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
