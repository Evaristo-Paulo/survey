@extends('painel.template')
@section('content')
    <div class="section-body mt-4">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-4">
                    <div class="form-group">
                        <label class="form-label">Pergunta:</label>
                        <select class="form-control" name="pergunta" id="enquente_pergunta">
                            <option value="-1" selected disabled>-- Selecionar pergunta ---</option>
                            @foreach ($enquetes as $enquete)
                                @foreach ($enquete->perguntas as $pergunta)
                                    <option value="{{ $pergunta->id }}" data-votos="{{ $pergunta->voto }}">
                                        {{ $pergunta->pergunta }}
                                    </option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row clearfix row-deck">
                <div class="col-xl-8 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dados estatísticos referente ao ano de 2023</h3>
                            <div class="card-options">
                                <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                                        class="fe fe-maximize"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between">
                                <div class="font-12">Enquetes registadas entre Janeiro à Dezembro de 2023</div>
                            </div>
                            <div id="main" style="height: 400px"></div>
                        </div>

                    </div>
                </div>
                <div class="col-xl-4 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dados estatísticos referente ao ano de 2023</h3>
                            <div class="card-options">
                                <a href="#" class="card-options-fullscreen" data-toggle="card-fullscreen"><i
                                        class="fe fe-maximize"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-4 border-right pb-4 pt-4">
                                    <label class="mb-0 font-13">Votos contabilizados</label>
                                    <h4 class="font-30 font-weight-bold text-col-blue counter" id="pergunta_voto">0</h4>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-vcenter mb-0">
                                <tbody id="stat_cluna_diteita">
                                    <tr>
                                        <td>
                                            <div class="clearfix">
                                                <div class="float-left"><strong></strong></div>
                                                <div class="float-right"><small class="text-muted">0 voto(s)</small></div>
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar" role="progressbar" style="width: 0%"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="clearfix">
                                                <div class="float-left"><strong></strong></div>
                                                <div class="float-right"><small class="text-muted">0 voto(s)</small></div>
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-azure" role="progressbar" style="width: 0%"
                                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="0"></div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('admin/assets/bundles/knobjs.bundle.js')}} " type="d5d1e93ad4caaee1e321e262-text/javascript"></script>
    <script src="{{ asset('admin/assets/bundles/c3.bundle.js')}} " type="d5d1e93ad4caaee1e321e262-text/javascript"></script>
    <script src="{{ asset('admin/assets/js/page/project-index.js')}} " type="d5d1e93ad4caaee1e321e262-text/javascript"></script>
    <script src=" https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js "></script>


    <script>
        $(document).ready(function() {
            $(function() {
                $("#enquente_pergunta").change(function(event) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr(
                                'content')
                        }
                    });

                    pergunta = $(this).val()
                    var pergunta_voto = $('#pergunta_voto');
                    var estatistica_coluna_direita = $('#stat_cluna_diteita')
                    var votos = $("#enquente_pergunta option:selected").attr("data-votos")

                    var dados = {
                        "pergunta": pergunta,
                    };

                    $.ajax({
                        contentType: 'application/json: charset=utf-8',
                        type: "POST",
                        url: "{{ url('sys/perguntas/alternativas/popula') }}",
                        data: JSON.stringify(dados),
                        success: function(response) {
                            console.log(response)
                            estatistica_coluna_direita.empty()

                            var alternativas = response.dados
                            pergunta_voto.text(votos)

                            grafico_titulos = [];
                            grafico_dados = []

                            for (i = 0; i < alternativas.length; i++) {
                                grafico_titulos.push(alternativas[i].alternativa)
                                grafico_dados.push({
                                    value: alternativas[i].voto,
                                    name: alternativas[i].alternativa,
                                })

                                estatistica_coluna_direita.append(
                                    "<tr><td><div class='clearfix'><div class='float-left'><strong>" +
                                    alternativas[i].alternativa +
                                    "</strong></div><div class='float-right'><small class='text-muted'>" +
                                    alternativas[i].voto +
                                    " voto(s)</small></div></div><div class='progress progress-xs'><div class='progress-bar' role='progressbar' style=';background-color: #53A451!important; width: " +
                                    (alternativas[i].voto * 100) / votos +
                                    "%'aria-valuenow='" + votos +
                                    "' aria-valuemin='0' aria-valuemax='" + votos +
                                    "'></div></div></td></tr>");
                            }


                            // GRAFICO
                            // based on prepared DOM, initialize echarts instance
                            var main = document.getElementById('main')

                            var myChart = echarts.init(main);

                            // specify chart configuration item and data
                            var weatherIcons = {};

                            option = {
                                title: {
                                    text: '',
                                    subtext: `Votos contabilizados: ${votos}`,
                                    left: 'center'
                                },
                                tooltip: {
                                    trigger: 'item',
                                    formatter: '<b>Total<b>: {d}%'
                                },
                                legend: {
                                    // orient: 'vertical',
                                    // top: 'middle',
                                    bottom: 0,
                                    left: 'center',
                                    data: grafico_titulos
                                },
                                color: [
                                    "#c23531",
                                    "#2f4554",
                                    "#91c7ae",
                                    "#ca8622",
                                    "#749f83",
                                    "#61a0a8",
                                    "#d48265",
                                    "#bda29a",
                                    "#6e7074",
                                    "#546570",
                                    "#c4ccd3"
                                ],
                                series: [{
                                    type: 'pie',
                                    radius: '65%',
                                    center: ['50%', '50%'],
                                    selectedMode: 'single',
                                    data: grafico_dados,
                                    emphasis: {
                                        itemStyle: {
                                            shadowBlur: 10,
                                            shadowOffsetX: 0,
                                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                                        }
                                    }
                                }]
                            };

                            // use configuration item and data specified to show chart
                            myChart.setOption(option);

                        },
                        error: function(response) {
                            console.log('error', response)
                        }
                    });
                });
            })
        });
    </script>
@endpush
