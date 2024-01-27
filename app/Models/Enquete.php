<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enquete extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function perguntas()
    {
        return $this->hasMany(Pergunta::class);
    }

    public static function estatistica_enquete_registadas($ano)
    {
        $id = Auth::user()->id;
        $meses = Mes::get();
        $enquetes = Enquete::get();
        $aux = [];
        $maior = 0;


        foreach ($meses as $mes) {
            $cont = 0;
            foreach ($enquetes as $enquete) {
                if ($id == $enquete->user_id && $mes->id == date('m', strtotime($enquete->created_at)) && date('Y', strtotime($enquete->created_at)) == $ano) {
                    $cont++;
                    if ($maior < $cont) {
                        $maior = $cont;
                    }
                }
            }

            array_push($aux, $cont);
        }

        $meses = Mes::get()->pluck('mes')->toArray();

        $dados = [
            'valores' => $aux,
            'meses' => $meses,
            'maior' => $maior
        ];

        return $dados;
    }

    public static function mostrar_notificacao()
    {
        $id = Auth::user()->id;

        $votos = DB::table('alternativas')
            ->join('perguntas', function (JoinClause $join) {
                $join->on('perguntas.id', '=', 'alternativas.pergunta_id')
                    ->where('alternativas.notifica', '!=', 0);
            })
            ->join('enquetes', 'enquetes.id', '=', 'perguntas.enquete_id')
            ->join('users', function (JoinClause $join) use ($id) {
                $join->on('users.id', '=', 'enquetes.user_id')
                    ->where('users.id', '=', $id)
                    ->Where('enquetes.estado', '=', 1);
            })
            ->select('alternativas.*', 'perguntas.enquete_id')
            ->orderByDesc('alternativas.updated_at')
            ->get()
            ->toArray();


        $enquetes_encerradas = DB::table('enquetes')
            ->join('users', function (JoinClause $join) use ($id) {
                $join->on('users.id', '=', 'enquetes.user_id')
                    ->where('users.id', '=', $id)
                    ->Where('enquetes.estado', '=', 0)
                    ->Where('enquetes.notifica', '!=', 0);
            })
            ->orderByDesc('enquetes.updated_at')
            ->get()
            ->toArray();


        $resultado = array();

        foreach ($enquetes_encerradas as $key => $item) {
            $dado = [
                'titulo' => $item->nome,
                'descricao' => 'Foi encerrada com sucesso.',
                'alternativa_id' => -1,
                'enquete_id' => $item->id,
            ];

            array_push($resultado, $dado);
        }

        foreach ($votos as $key => $item) {
            $dado = [
                'titulo' => $item->alternativa,
                'descricao' => 'Recebeu mais 1 voto.',
                'alternativa_id' => $item->id,
                'enquete_id' => $item->enquete_id,
            ];

            array_push($resultado, $dado);
        }


        return $resultado;
    }


    public static function listar_enquete()
    {
        $id = Auth::user()->id;
        $TAM = 70;

        $enquetes = DB::table('enquetes')->where('user_id', $id)->orderBy('id', 'desc')->get();
        $perguntas = DB::table('perguntas')->get();
        $dados = array();

        foreach ($enquetes as $enquete) {
            $total_pergunta = 0;
            $total_voto = 0;

            foreach ($perguntas as $pergunta) {
                if ($enquete->id == $pergunta->enquete_id) {
                    $total_pergunta++;
                    $total_voto += $pergunta->voto;
                }
            }

            $dado = [
                'id' => $enquete->id,
                'nome' => $enquete->nome,
                'total_pergunta' => $total_pergunta,
                'descricao' => Str::length($enquete->descricao) == $TAM ? str::substr($enquete->descricao, 0, $TAM) : str::substr($enquete->descricao, 0, $TAM) . "...",
                'voto' => $total_voto,
                'data_registo' => $enquete->created_at,
                'data_encerramento' => $enquete->data_encerramento,
                'url' => $enquete->url,
                'estado' => $enquete->estado,
                'user_id' => $enquete->user_id,
            ];

            array_push($dados, $dado);
        }

        return $dados;
    }

    public static function visualizar_enquete($id)
    {
        $enquete = Enquete::where('id', $id)->first();
        $perguntas = DB::table('perguntas')->get();

        $total_pergunta = 0;
        $total_voto = 0;
        $grupo_perguntas = [];

        foreach ($perguntas as $pergunta) {
            $total_voto_pergunta = 0;
            if ($enquete->id == $pergunta->enquete_id) {
                $alternativas = DB::table('alternativas')->where('pergunta_id', $pergunta->id)->get();
                $grupo_alternativas = [];
                foreach ($alternativas as $alternativa) {
                    $alternativa_aux = [
                        'id' => $alternativa->id,
                        'alternativa' => $alternativa->alternativa,
                        'voto' => $alternativa->voto,
                    ];

                    $total_voto_pergunta += $alternativa->voto;

                    // ADICIONA ALTERNATIVA
                    array_push($grupo_alternativas, $alternativa_aux);
                }

                $aux = [
                    'id' => $pergunta->id,
                    'pergunta' => $pergunta->pergunta,
                    'tipo_modelo' => Modelo::find($pergunta->modelo_id)->nome,
                    'modelo' => $pergunta->modelo_id,
                    'voto' => $total_voto_pergunta,
                    'alternativas' => $grupo_alternativas,
                ];

                array_push($grupo_perguntas, $aux);
                $total_pergunta++;
                $total_voto += $total_voto_pergunta;
            }
        }

        $dado = [
            'id' => $enquete->id,
            'nome' => $enquete->nome,
            'total_pergunta' => $total_pergunta,
            'descricao' =>  $enquete->descricao,
            'voto' => $total_voto,
            'data_registo' => $enquete->created_at,
            'data_encerramento' => $enquete->data_encerramento,
            'url' => $enquete->url,
            'estado' => $enquete->estado,
            'user_id' => $enquete->user_id,
            'perguntas' => $grupo_perguntas
        ];

        return $dado;
    }
}
