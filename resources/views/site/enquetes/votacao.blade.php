@extends('site.template')
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="javascript::void(0)">Home </a><span class="iconify" data-icon="akar-icons:chevron-right"></span></li>
        <li><a href="javascript::void">Faça aqui a sua votação </a></li>
    </ul>
@endsection
@section('content')
    <main>
        <section class="wrapper apartments n-default" id="section-highlight-apt">
            <div class="title">
                <h2>Faça aqui a sua <span class='lost-highlight'>votação</span> </h2>
                <span class='underline'></span>
                <h2 class="info_votacao">Clica por cima da alternativa que deseja atribuir o seu voto! </h2>
            </div>
        </section>
        <section class="wrapper" id="section-highlight-apt">
            <div id="logado" data-logado="{{ $enquete['user_id'] }}"></div>

            <div>
                @foreach ($enquete['perguntas'] as $key => $pergunta)
                    <div class="item">
                        <div class="info-item">
                            <p class="icon-question"><span class="iconify" data-icon="bi:patch-question-fill"
                                    style="color: #f8a300;"></span></p>
                            <p class="enquete-title">{{ $key + 1 }}. {{ $pergunta['pergunta'] }}</p>
                            <p class="enquete-vote">Total de Votos: <span
                                    id="pergunta_voto_{{ $pergunta['id'] }}">{{ $pergunta['voto'] }}</span></p>
                            <div class="vote-form">
                                <div>
                                    @if ($modelos->find($pergunta['modelo'])->alternativa_permitida == 1)
                                        @foreach ($pergunta['alternativas'] as $alternativa)
                                            <div class="radio input_votacao"
                                                data-total="pergunta_voto_{{ $pergunta['id'] }}"
                                                data-span="alternativa_{{ $alternativa['id'] }}"
                                                data-alternativa="{{ $alternativa['id'] }}"
                                                data-pergunta="{{ $pergunta['id'] }}">
                                                <input type="radio">
                                                <label for="{{ $alternativa['id'] }}">{{ $alternativa['alternativa'] }}
                                                    <span
                                                        id="alternativa_{{ $alternativa['id'] }}">({{ $alternativa['voto'] }})</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    @else
                                        <form id="checkbox_votacao_{{ $pergunta['id'] }}" class="form_checkbox"
                                            method="POST" action="">
                                            @csrf

                                            @foreach ($pergunta['alternativas'] as $alternativa)
                                                <div class="form-check">

                                                    <label class="form-check-label"
                                                        for="{{ $alternativa['alternativa'] }}_{{ $alternativa['id'] }}">
                                                        <input class="form-check-input" name="alternativas[]"
                                                            value="{{ $alternativa['id'] }}" type="checkbox" value=""
                                                            id="{{ $alternativa['alternativa'] }}_{{ $alternativa['id'] }}">
                                                        <span class="form-check-input">{{ $alternativa['alternativa'] }}
                                                            <span
                                                                id="alternativa_{{ $alternativa['id'] }}">({{ $alternativa['voto'] }})</span>
                                                        </span>
                                                    </label>
                                                </div>
                                            @endforeach
                                            <div class="vote-info">
                                                <button type="button" data-total="pergunta_voto_{{ $pergunta['id'] }}"
                                                    data-pergunta="{{ $pergunta['id'] }}"
                                                    data-form="checkbox_votacao_{{ $pergunta['id'] }}"
                                                    class="checkbox_votacao link text-warning">Confirmar
                                                    resposta</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </section>

    </main>
@endsection
@push('js')
    <script>
        //ADICIONAR PERGUNTAS NA TABELA TEMPORÁRIA
        $(document).ready(function() {
            $(function() {
                $(".input_votacao").click(function(event) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr(
                                'content')
                        }
                    });

                    var alternativa = $(this).attr("data-alternativa");
                    var pergunta = $(this).attr("data-pergunta");
                    var span_referencia = $(this).attr("data-span");
                    var total_votacao = $(this).attr("data-total");

                    console.log(alternativa, pergunta)

                    var dados = {
                        "pergunta": pergunta,
                        "alternativa": alternativa,
                    };

                    $.ajax({
                        contentType: 'application/json: charset=utf-8',
                        type: "POST",
                        url: "{{ url('enquetes/perguntas/alternativas/escolha-unica/votacao') }}",
                        data: JSON.stringify(dados),
                        success: function(response) {
                            console.log(response)

                            if (response.tipo == 'success') {
                                swal({
                                    title: "Voto contabilizado!",
                                    text: "Obrigado pela sua participação :)",
                                    type: "success",
                                    timer: 3000
                                });

                                $(`#${span_referencia}`).text(
                                    `(${response.dados.alternativa.voto})`)
                                $(`#${total_votacao}`).text(
                                    `(${response.dados.pergunta.voto})`)

                                window.Echo.private(`enquete.1`).listen('VotoRegistado',
                                    (
                                        data) => {
                                        var dados = data.dado

                                        console.log(dados, dados.length)
                                        $('.feeds_widget').empty();

                                        $('#alerta_notificacao').hide();
                                        $('.notificacao').append(
                                            "<span class='badge badge-danger nav-unread'></span>"
                                        );

                                        for (let i = 0; i < dados.length; i++) {
                                            $('.feeds_widget').append(
                                                "<li><div class='feeds-left'><i class='fa fa-thumbs-o-up'></i></div><a href='' class='feeds-body'><h4 class='title text-danger'>" +
                                                dados[i]['titulo'] +
                                                "<small class='float-right text-muted'>+1</small></h4><small>" +
                                                dados[i]['descricao'] +
                                                "</small></a></li>"
                                            );
                                        }

                                    });

                            } else {
                                swal({
                                    title: "Esta enquete foi encerrada!",
                                    text: "Obrigado pela sua participação :)",
                                    type: "warning",
                                    timer: 3000
                                });
                            }

                        },
                        error: function(response) {
                            console.log('error', response)
                        }
                    });
                });
            })


            // MULTIPLA ESCOLHA
            $(function() {
                $(".checkbox_votacao").click(function(event) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr(
                                'content')
                        }
                    });

                    var alternativas = [];
                    var form_id = $(this).attr("data-form");
                    var pergunta = $(this).attr("data-pergunta");
                    var total_votacao = $(this).attr("data-total");

                    $(`#${form_id}`).find('input:checkbox').each(function(i) {
                        var input_checkbox = (this)
                        // VERIFICA SE ESTE ELEMENTO CHECKEBOX FOI SELECIONADO
                        if (input_checkbox.checked) {
                            alternativas.push(input_checkbox.value);
                        }
                    });

                    // VERIFICA SE ALGUMA ALTERNATIVA FOI SELECIONADA/CHECADA
                    if (alternativas.length == 0) {
                        swal({
                            title: "Nenhuma alternativa marcada",
                            text: "Marque pelo menos 1 alternativa para validar o seu voto!",
                            type: "warning",
                            confirmButtonColor: "#F8BE86",
                            confirmButtonText: "OK",
                            closeOnConfirm: true
                        });
                    } else {
                        var dados = {
                            "pergunta": pergunta,
                            "alternativas": alternativas,
                        };

                        $.ajax({
                            contentType: 'application/json: charset=utf-8',
                            type: "POST",
                            url: "{{ url('enquetes/perguntas/alternativas/escolha-multipla/votacao') }}",
                            data: JSON.stringify(dados),
                            success: function(response) {
                                // console.log(response)
                                if (response.tipo == 'success') {
                                    swal({
                                        title: "Voto contabilizado!",
                                        text: "Obrigado pela sua participação :)",
                                        type: "success",
                                        timer: 3000
                                    });

                                    var alternativas_actualizadas = response.dados
                                        .alternativas

                                    for (i = 0; i < alternativas_actualizadas
                                        .length; i++) {
                                        var item = alternativas_actualizadas[i]
                                        $(`#alternativa_${item.id}`).text(
                                            `(${item.voto})`)
                                    }

                                    $(`#${total_votacao}`).text(
                                        `(${response.dados.pergunta.voto})`)

                                    // SETAR TODOS OS CHECKBOX FALSOS OU SEJA SEM ESTAREM MARCADOS
                                    $(`#${form_id}`).find('input:checkbox').each(
                                        function() {
                                            var input_checkbox = (this)
                                            // VERIFICA SE ESTE ELEMENTO CHECKEBOX FOI SELECIONADO
                                            if (input_checkbox.checked) {
                                                input_checkbox.checked = false
                                            }
                                        });

                                } else {
                                    swal({
                                        title: "Esta enquete foi encerrada!",
                                        text: "Obrigado pela sua participação :)",
                                        type: "warning",
                                        timer: 3000
                                    });
                                }

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
