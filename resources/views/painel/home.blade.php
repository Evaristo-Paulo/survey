@extends('painel.template')
@section('content')
    <div class="section-body mt-3">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="mb-4">
                    </div>
                </div>
            </div>
            <div class="row clearfix row-deck">
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Enquetes</h3>
                        </div>
                        <div class="card-body">
                            <h5 class="number mb-0 font-32 counter">{{ $enquete_activa + $enquete_encerrada }}</h5>
                            <span class="font-12">Total de enquetes registadas</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Enquetes Activas</h3>
                        </div>
                        <div class="card-body">
                            <h5 class="number mb-0 font-32 counter">{{ $enquete_activa }}</h5>
                            <span class="font-12">Total de enquetes activas</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Enquentes Encerradas</h3>
                        </div>
                        <div class="card-body">
                            <h5 class="number mb-0 font-32 counter">{{ $enquete_encerrada }}</h5>
                            <span class="font-12">Total de enquetes encerradas</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Votos Contabilizados</h3>
                        </div>
                        <div class="card-body">
                            <h5 class="number mb-0 font-32 counter">{{ $total_votos }}</h5>
                            <span class="font-12">Total de votos contabilizados</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix row-deck">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dados estatísticos referente ao ano de {{ $ano }}</h3>
                            <div class="card-options">
                                <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                                        class="fe fe-maximize"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between">
                                <div class="font-12">Enquetes registadas entre Janeiro à Dezembro de {{ $ano }}
                                </div>
                            </div>
                            <div id="chart-main" style="height: 350px"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-body">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista de enquetes</h3>
                            <div class="card-options">
                                <button class="btn btn-success tag tag-success" data-toggle="modal"
                                    data-target="#adicionar_enquete"><i class="fa fa-plus"
                                        style="margin-top: 6px; margin-right: 7px"></i> Nova Enquete</button>
                            </div>
                        </div>
                    </div>

                    <div class="d-lg-flex justify-content-between">
                        <ul class="nav nav-tabs page-header-tab">
                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab"
                                    href="#Company_Settings">Enquetes Activas ({{ $enquete_activa }})</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#Localization">Enquetes
                                    Encerradas ({{ $enquete_encerrada }})</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-body">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="Company_Settings">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Listagem de todas as enquetes activas</h3>
                                    <div class="card-options">
                                        <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                                                class="fe fe-maximize"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped text-nowrap table-vcenter mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Título</th>
                                                    <th>Descrição</th>
                                                    <th>Total Perguntas</th>
                                                    <th>Total Votos</th>
                                                    <th>Data de encerramento</th>
                                                    <th>Estado</th>
                                                    <th>Opção</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($enquetes as $key => $item)
                                                    @if ($item['estado'] == 1)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $item['nome'] }}</td>
                                                            <td>{{ $item['descricao'] }}</td>
                                                            <td>{{ $item['total_pergunta'] }}</td>
                                                            <td>{{ $item['voto'] }}</td>
                                                            <td>{{ $item['data_encerramento'] }}</td>
                                                            <td>
                                                                @if ($item['estado'] == 1)
                                                                    <span class="tag tag-success"
                                                                        style="background-color: green">Activo</span>
                                                                @else
                                                                    <span class="tag tag-error">Encerrado</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="card-options">
                                                                    <div class="item-action dropdown ml-2">
                                                                        <a href="javascript:void(0)"
                                                                            data-toggle="dropdown"><i
                                                                                class="fe fe-more-vertical"></i></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a href="{{ route('sys.enquete.visualizacao', $item['id']) }}"
                                                                                class="dropdown-item"><i
                                                                                    class="dropdown-icon fa fa-eye"></i>
                                                                                Ver
                                                                                Detalhes</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="Localization">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Listagem de todas as enquetes encerradas</h3>
                                    <div class="card-options">
                                        <a href="#" class="card-options-fullscreen"
                                            data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-striped text-nowrap table-vcenter mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Título</th>
                                                    <th>Descrição</th>
                                                    <th>Total Perguntas</th>
                                                    <th>Total Votos</th>
                                                    <th>Data de encerramento</th>
                                                    <th>Estado</th>
                                                    <th>Opção</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($enquetes as $key => $item)
                                                    @if ($item['estado'] != 1)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $item['nome'] }}</td>
                                                            <td>{{ $item['descricao'] }}</td>
                                                            <td>{{ $item['total_pergunta'] }}</td>
                                                            <td>{{ $item['voto'] }}</td>
                                                            <td>{{ $item['data_encerramento'] }}</td>
                                                            <td>
                                                                @if ($item['estado'] == 1)
                                                                    <span class="tag tag-success"
                                                                        style="background-color: green">Activo</span>
                                                                @else
                                                                    <span class="tag tag-error">Encerrado</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <div class="card-options">
                                                                    <div class="item-action dropdown ml-2">
                                                                        <a href="javascript:void(0)"
                                                                            data-toggle="dropdown"><i
                                                                                class="fe fe-more-vertical"></i></a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a href="{{ route('sys.enquete.visualizacao', $item['id']) }}"
                                                                                class="dropdown-item"><i
                                                                                    class="dropdown-icon fa fa-eye"></i>
                                                                                Ver
                                                                                Detalhes</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('painel.enquetes.modal.registo')
@endsection
@push('script')
    <script src="{{ asset('admin/assets/bundles/apexcharts.bundle.js')}} " type="d5d1e93ad4caaee1e321e262-text/javascript"></script>
    <script src="{{ asset('admin/assets/bundles/knobjs.bundle.js')}} " type="d5d1e93ad4caaee1e321e262-text/javascript"></script>
    <script src="{{ asset('admin/assets/bundles/c3.bundle.js')}} " type="d5d1e93ad4caaee1e321e262-text/javascript"></script>
    <script src="{{ asset('admin/assets/js/page/project-index.js')}} " type="d5d1e93ad4caaee1e321e262-text/javascript"></script>
    <script src=" https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js "></script>


    <script>
        var main = document.getElementById('chart-main')

        var myChart = echarts.init(main);

        option = {

            legend: {
                data: ['Mês', 'Linha']
            },
            xAxis: [{
                type: 'category',
                data: {{ Js::from($estatistica_enquete_registadas['meses']) }},
                axisPointer: {
                    type: 'shadow'
                }
            }],

            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow'
                },
                formatter: function(params) {
                    var tar;
                    if (params[1].value !== '-') {
                        tar = params[1];
                    } else {
                        tar = params[0];
                    }
                    return tar.name + '<br/><span style="font-size: 11px">Nº Enquete: ' + tar.value + '</span>';
                }
            },
            yAxis: [{
                type: 'value',
                name: 'Nº Enquete',
                min: 0,
                max: {{ Js::from($estatistica_enquete_registadas['maior'] + 2) }},
                interval: 1,
                axisLabel: {
                    formatter: '{value}'
                }
            }],
            color: [
                "#DEEDE7",
                "#BB3940"
            ],
            series: [{
                    name: 'Mês',
                    type: 'bar',
                    label: {
                        show: true,
                        position: 'top'
                    },
                    data: {{ Js::from($estatistica_enquete_registadas['valores']) }}
                },
                {
                    name: 'Linha',
                    type: 'line',
                    yAxisIndex: 0,
                    data: {{ Js::from($estatistica_enquete_registadas['valores']) }}
                }
            ]
        };

        // use configuration item and data specified to show chart
        myChart.setOption(option);
    </script>
@endpush
