<div id="page_top" class="section-body top_dark">
    <div class="container-fluid">
        <div class="page-header">
            <div class="left">
                <a href="javascript:void(0)" class="icon menu_toggle mr-3"><i class="fa  fa-align-left"></i></a>
                <h1 class="page-title">{{ $pagina }}</h1>
            </div>
            <div class="right">
                <div class="notification d-flex">
                    <div class="dropdown d-flex">
                        <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-2 notificacao"
                            data-toggle="dropdown"><i class="fa fa-bell"></i>
                            @if (!empty($notificacao_votacao))
                            <span class="badge badge-danger nav-unread" id="alerta_notificacao"></span>
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <ul class="list-unstyled feeds_widget">
                                @forelse ($notificacao_votacao as $notificacao)
                                    <li>
                                        <div class="feeds-left"><i class="fa fa-thumbs-o-up"></i></div>
                                        <a href="{{ route('sys.enquete.notificacao.leitura', [$notificacao['enquete_id'] ,$notificacao['alternativa_id']]) }}" class="feeds-body">
                                            <h4 class="title text-danger">{{ $notificacao['titulo'] }}<small
                                                    class="float-right text-muted">+1</small></h4>
                                            <small>{{ $notificacao['descricao'] }}</small>
                                        </a>
                                    </li>
                                @empty
                                    <li>
                                        <div class="feeds-left"><i class="fa fa-solid fa-exclamation"></i></div>
                                        <a href="javascript:void(0)" class="feeds-body">
                                            <h4 class="title text-danger"><small
                                                    class="float-right text-muted"></small></h4>
                                            <small>Nenhuma notificação</small>
                                        </a>
                                    </li>
                                @endforelse
                            </ul>
                            <div class="dropdown-divider"></div>
                            <a href="javascript:void(0)"
                                class="dropdown-item text-center text-muted-dark readall">Marcar todas como lidas</a>
                        </div>
                    </div>
                    <div class="dropdown d-flex">
                        <a class="nav-link icon d-none d-md-flex btn btn-default btn-icon ml-2"
                            data-toggle="dropdown"><i class="fa fa-user"></i></a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                            <a class="dropdown-item" href="{{ route('sys.utilizadores.perfil', Auth::user()->id) }}"><i
                                    class="dropdown-icon fe fe-user"></i> Perfil</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i
                                    class="dropdown-icon fe fe-help-circle"></i> Ajuda</a>
                            <a class="dropdown-item" href="javascript::void(0)" id="logout_btn"><i
                                    class="dropdown-icon fe fe-log-out"></i> Sair</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
