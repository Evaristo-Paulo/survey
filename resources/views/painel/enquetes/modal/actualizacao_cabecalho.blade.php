<div class="modal fade" id="actualizar_cabecalho" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form class="modal-content" method="POST" action="{{ url('sys/enquetes/perguntas/actualizacao-de-cabecalho') }}">
            @csrf
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel"><i class="fa fa-edit"></i> Actualização de Cabeçalho</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-12">
                        <label class="form-label">Nome: </label>
                        <div class="form-group">
                            <input type="text" name="nome" id="nome" @error('nome') is-invalid @enderror
                                value="{{ $enquete['nome'] }}" required class="form-control"
                                placeholder="Digite o nome">
                            @error('nome')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="form-label">Descrição:</label>
                            <textarea @error('descricao') is-invalid @enderror name="descricao" id="descricao" required class="form-control" placeholder="Digite a descrição" cols="30"
                                rows="3">{{ $enquete['descricao'] }}</textarea>
                            @error('descricao')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">Estado:</label>
                            <select class="form-control" name="estado">
                                <option value="1" @if ($enquete['estado'] == 1) selected @endif>Activo</option>
                                <option value="2" @if ($enquete['estado'] == 2) selected @endif>Encerrada
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-label">Data de Encerramento: </label>
                            <div class="form-group">
                                <input type="date" required name="data_encerramento"
                                    value="{{ date('Y-m-d', strtotime($enquete['data_encerramento'])) }}"
                                    id="data_encerramento" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="{{ $enquete['id'] }}">
            <div class="modal-footer">
                <button type="submit" class="btn text-white tag tag-success"
                    style="background-color: green">Actualizar</button>
            </div>
        </form>
    </div>
</div>
