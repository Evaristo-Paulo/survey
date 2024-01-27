<div class="modal fade" id="envio_por_email" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <form class="modal-content" method="POST" action="{{ url('sys/enquetes/partilha-por-email') }}">
            @csrf
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel"><i class="fa fa-edit"></i> Envio de enquete</h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-12">
                        <label class="form-label">Enquete </label>
                        <div class="form-group">
                            <input type="text" readonly name="nome" value="{{ $enquete['nome'] }}" required
                                class="form-control" placeholder="Digite o nome">
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-group">
                            <label class="form-label">Total Perguntas: </label>
                            <div class="form-group">
                                <input type="number" readonly required name="total_pergunta"
                                    value="{{ count($enquete['perguntas']) }}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label class="form-label">Data de Encerramento: </label>
                            <div class="form-group">
                                <input type="date" readonly required name="data_encerramento"
                                    value="{{ date('Y-m-d', strtotime($enquete['data_encerramento'])) }}"
                                    id="data_encerramento" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Email do Destinatário:</label>
                        <div class="form-group">
                            <input type="email" @error('email') is-invalid @enderror name="email" required class="form-control"
                                placeholder="Digite o email do destinatário">
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="{{ $enquete['id'] }}">
            <div class="modal-footer">
                <button type="submit" class="btn text-white tag tag-success"
                    style="background-color: green">Enviar</button>
            </div>
        </form>
    </div>
</div>
