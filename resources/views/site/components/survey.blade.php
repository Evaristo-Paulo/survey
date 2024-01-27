<div class="item item-custom">
    <div class="info-item">
        <div class="enquete-body">

            <p class="icon-question"><span class="iconify" data-icon="bi:patch-question-fill"
                    style="color: #f8a300;"></span></p>
            <p class="enquete-title">{{ $item->question }}</p>
            <p class='enquete-vote'>
                @if($item->vote == 0)
                    {{ $item->vote }} Voto
                @else
                    {{ $item->vote }} Votos
                @endif
            </p>
            <div class="icon-info">
                <a href="{{ route('survey.details', encrypt($item->id) ) }}"
                    class="link text-view"><span class="iconify" data-icon="carbon:task-view"></span>
                    Detalhes</a>
                <a href="{{ route('survey.edit.form', encrypt($item->id) ) }}"
                    class="link text-warning"><span class="iconify text-dark"
                        data-icon="akar-icons:edit"></span> Editar</a>
                <form action="{{ route('survey.delete') }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}

                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <button type="submit" class="link text-danger"><span class="iconify"
                            data-icon="codicon:trash"></span> Excluir</button>
                </form>
            </div>
        </div>
        <div class="created_at">
            Publicado aos
            {{ date('d/m/Y', strtotime($item->created_at)) }}
        </div>
    </div>
</div>