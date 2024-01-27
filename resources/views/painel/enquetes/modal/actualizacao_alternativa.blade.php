@foreach ($enquete['perguntas'] as $index => $dado)
    <div class="modal fade" id="actualizar_alternativa_{{ $dado['id'] }}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" method="POST" action="{{ url('sys/enquetes/perguntas/actualizacao-de-alternativa') }}">
                @csrf
                <div class="modal-header">
                    <h6 class="title"><i class="fa fa-edit"></i> Actualização de Pergunta</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <div class="tab-pane" id="seccao_altera_alternativa">
                        <div class="row clearfix">
                            <div class="col-12" id="sessao_alerta_altera_alternativa{{ $dado['id'] }}">
                                <div class="alert alert-danger d-none unstyled list-unstyled">
                                    <ul style="margin-bottom: 0px; padding-left: 0px ; position: relative">
                                        <li id='alerta_erro{{ $dado['id'] }}' class="unstyled list-unstyled"></li>
                                        <button type="button" class="close close-alert"
                                            style="position: absolute; top: 0px; right: 0px" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Pergunta:</label>
                                    <textarea name="pergunta" class="form-control" placeholder="Digite a pergunta" cols="30"
                                        rows="2">{{ $dado['pergunta'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Modelo de Resposta:</label>
                                    <select class="form-control" name="modelo">
                                        @foreach ($modelos as $item)
                                            <option value="{{ $item->id }}"
                                                @if ($item->id == $dado['modelo']) selected @endif>
                                                {{ $item->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label class="form-label">Nº Alternativas: </label>
                                    <input type="number" name="total_alternativa" data-id={{ $dado['id'] }}
                                        data-total={{ count($dado['alternativas']) }}
                                        class="form-control num_alternativa" value="{{ count($dado['alternativas']) }}"
                                        placeholder="Digite número de alternativas">
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">
                            @foreach ($dado['alternativas'] as $key => $alternativa)
                                <div class="col-6">
                                    <label class="form-label">{{ $key + 1 }}ª Alternativa: </label>
                                    <div class="form-group">
                                        <input type="text" readonly name="" required class="form-control"
                                            value="{{ $alternativa['alternativa'] }}"
                                            placeholder="Digite {{ $key + 1 }}ª Alternativa">
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div id="alternativas{{ $dado['id'] }}" class="row clearfix">
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" value="{{ $dado['id'] }}">
                <div class="modal-footer">
                    <button type="submit" class="btn text-white tag tag-success" style="background-color: green">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
@endforeach
@push('script')
    <script>
        $(document).ready(function() {
            $(function() {
                $(".num_alternativa").change(function(event) {
                    qtde_linha = event.target.value
                    total_alternativa = $(this).attr("data-total")
                    pergunta_id = $(this).attr("data-id")

                    obj_alternativa = $(`#alternativas${pergunta_id}`)
                    obj_alternativa.empty()

                    if (qtde_linha > total_alternativa) {
                        for (cont = Number(total_alternativa) + 1, i = qtde_linha; i >
                            total_alternativa; cont++, i--) {
                            obj_alternativa.append(
                                "<div class='col-6'><div class='form-group'><label class='form-label'>" +
                                cont +
                                "ª Alternativa:</label><input type='text' name='alternativas[]' required class='form-control alternativas' placeholder='Digite a " +
                                cont + "ª alternativa'></div></div>"
                            );
                        }
                    } else if (qtde_linha < total_alternativa) {
                        $(`#alerta_erro${pergunta_id}`).text(
                            'É permitido remover alternativas apenas na listagem das alternativas.'
                        );
                        $(`#sessao_alerta_altera_alternativa${pergunta_id} .alert-danger`).removeClass(
                            "d-none");

                        $(this).val(total_alternativa)

                        setTimeout(function() {
                            $(`#sessao_alerta_altera_alternativa${pergunta_id} .alert-danger`).addClass(
                            "d-none");
                        }, 6000)
                    }
                });
            })
        });
    </script>
@endpush
