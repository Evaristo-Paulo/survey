    <div class="modal fade" id="actualizar_info" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <form class="modal-content" method="POST"
                action="{{ url('sys/utilizadores/info-pessoal/actualizacao') }}">
                @csrf
                <div class="modal-header">
                    <h6 class="title"><i class="fa fa-edit"></i> Actualização de Informação Pessoal</h6>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <input type="hidden" name="id" value="{{ $utilizador->id }}">

                <div class="modal-body">
                    <div class="tab-pane" id="seccao_altera_alternativa">
                        <div class="clearfix">
                            <div class="form-group">
                                <label class="form-label">Nome:</label>
                                <input type="text" required class="form-control  @error('name') is-invalid @enderror"
                                    name="name" value="{{ $utilizador->name }}" placeholder="Digite o nome">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Email:</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $utilizador->email }}" required 
                                    aria-describedby="emailHelp" placeholder="Digite o email">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn text-white tag tag-success"
                            style="background-color: green">Actualizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
